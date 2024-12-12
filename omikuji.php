<?php
// １から5の乱数を作成
$random_number = rand(1,5);

//　乱数の値で条件分岐
if ($random_number === 1) {
    $result = '大吉';
} elseif ($random_number === 2) {
    $result = '中吉';
} elseif ($random_number === 3) {
    $result = '小吉';
} elseif ($random_number === 4) {
    $result = '凶';
} else {
    $result = '大凶';
}

var_dump($result);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>おみくじの結果は「<?=$result ?>」です。</h1>
    
</body>
</html>