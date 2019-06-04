<!DOCTYPE html>
 <html lang = “ja”>
 <head>
 <meta charset = “UFT-8”>
 </head>
 <body>
 <form method = "post" action = "mission_1-6.php">
 <input type = "text" name ="comment" value = "コメント"><br/>
 <input type = "submit" value ="送信">
 </form>
 </body>
 </html>
<?php
$comment = $_POST["comment"];
if(empty($comment)){
echo "";
}elseif($comment){
 echo $_POST["comment"];
}

$filename = 'mission_1-6_kajii.txt';
$comment = $_POST["comment"];
$fp = fopen($filename, 'a');
fwrite($fp, $_POST["comment"]."\n");
fclose($fp);
?>