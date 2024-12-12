<?php
//データの確認
// var_dump($_POST);
// exit();

//データの受け取り
$todo = $_POST["todo"];
$deadline = $_POST["deadline"];

//データを１行にまとめる
$write_data = "{$deadline} {$todo}\n";

//ファイルを開く（引数が’a’である部分に注目）
$file = fopen('data/todo.txt','a');
//ファイルをロックする
flock($file, LOCK_EX);

//指定したファイルに指定したデータを書き込む
fwrite($file, $write_data);

//ファイルのロックを解除する
flock($file,LOCK_UN);
//ファイルを閉じる
fclose($file);

//データ入力画面に移動する
header("Location:todo_txt_input.php");