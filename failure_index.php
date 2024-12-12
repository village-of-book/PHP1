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

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>失敗アプリ</title>
  <style>
    #output li {
      background: #ccc;
    }
  </style>  

</head>

<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    // JSではPHPの配列を扱えないため，サーバ上でJSON形式に変換する
    const data = <?=json_encode($str)?>;
    console.log(data)
    let result1 = data.split("<tr><td>");
    console.log(result1);
    // let result2 = result1.split("\n</td></tr>")
    console.log((result1.length)-2)
    let result2 = result1.length -2
    console.log(result2)

    window.onload = function(){
    // ページ読み込み時に実行したい処理
    $('#data_count').text(result2)
    }
  </script>

  <form action="failure_create.php" method="POST">
    <fieldset>
      <legend>失敗メモ</legend>
      <div>
        発生日: <input type="date" name="date">
      </div>
      <div>
        タイトル: <input type="text" name="title">
      </div>
      <div>
        失敗: <input type="text" name="text_failure">
      </div>
      <div>
        成功: <input type="text" name="text_success">
      </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

  <fieldset>
    <legend>成功のもの</legend>
    <table>
      <thead>
        <tr>
          <th>失敗データ</th>
        </tr>
      </thead>
      <p>積み上げた失敗は</p>
      <p id=data_count></p>
      <tbody>
        <?= $str ?>

      </tbody>
    </table>
  </fieldset>

</body>

</html>