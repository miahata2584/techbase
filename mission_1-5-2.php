<!DOCTYPE html>
 <html lang = “ja”>
 <head>
 <meta charset = “UFT-8”>
 </head>
 <body>
 <form method = "post" action = "mission_1-5-2.php">
 <input type = "text" name ="comment" value = "コメント"><br/>
 <input type = "submit" value ="送信">
 </form>
 </body>
 </html>
<?php
$comment = $_POST["comment"];
if(empty($comment)){
echo "";
}elseif($comment == "完成！"){
 echo "おめでとう！";
}

$filename = 'mission_1-5_kajii.txt';
$comment = $_POST['comment'];
$fp = fopen($filename, 'w');
fwrite($fp, $_POST["comment"]);
fclose($fp);

?>
