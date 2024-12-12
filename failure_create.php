<?php
//データの確認
// var_dump($_POST);
// exit();

//データの受け取り
$date = $_POST["date"];
$title = $_POST["title"];
$text_failure = $_POST["text_failure"];
$text_success = $_POST["text_success"];

//データを１行にまとめる
$write_data = "{$date} {$title} {$text_failure} {$text_success}\n";

//ファイルを開く（引数が’a’である部分に注目）
$file = fopen('data/failure.txt','a');
//ファイルをロックする
flock($file, LOCK_EX);

//指定したファイルに指定したデータを書き込む
fwrite($file, $write_data);

//ファイルのロックを解除する
flock($file,LOCK_UN);
//ファイルを閉じる
fclose($file);

//データ入力画面に移動する
header("Location:failure_index.php");