<?php
//データまとめ用のから文字変数
$str = '';

//ファイルを開く（読み取り専用）
$file = fopen('data/failure.txt', 'r');
//ファイルをロック
flock($file, LOCK_EX);

// fgets()で１行ずつ取得→$lineに格納
if ($file){
  while ($line = fgets($file)){
    //取得したデータを'$str'に追加する
    $str .="<tr><td>{$line}</td></tr>";
  }
}

//ロックを解除する
flock($file, LOCK_UN);
//ファイルを閉じる
fclose($file);

//'$str'に全てのデータ（ダグに入った状態）がまとまるので、HTML内の任意の場所に表示する
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>成功のものデータ</title>
</head>

<body>
  <fieldset>
    <legend>成功のもの</legend>
    <a href="failure_index.php">入力画面</a>
    <table>
      <thead>
        <tr>
          <th>失敗データ</th>
        </tr>
      </thead>
      <tbody>
        <?= $str ?>

      </tbody>
    </table>
  </fieldset>
</body>

</html>