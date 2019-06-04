<!DOCTYPE html>
 <html lang = “ja”>
 <head>
 <meta charset = “UFT-8”>
 </head>
 <body>
 <form method = "post" action = "mission_1-7.php">
 <input type = "text" name ="comment" value = "コメント"><br/>
 <input type = "submit" value ="送信">
 </form>

<?php

$filename = 'mission_1-6_kajii.txt';
$comment = $_POST["comment"];
$fp = fopen($filename, 'a');
fwrite($fp, $_POST["comment"]."\n");
fclose($fp);
$file_name = "mission_1-6_kajii.txt";
$ret_array = file($file_name); //配列にいれる
for( $i = 0; $i < count($ret_array); ++$i ) {    // 配列を順番に表示する
    echo( $ret_array[$i] . "<br />\n" );
}
?>

 </body>
 </html>