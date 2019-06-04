<!DOCTYPE html>
 <html lang = “ja”>
 <head>
 <meta charset = “UFT-8”>
 </head>
 <body>
 <form method = "post" action = "mission_1-4-2.php">
 <input type = "text" name ="comment" value = "コメント"><br/>
 <input type = "submit" value ="送信">
 </form>
 </body>
 </html>
<?php
  echo "「ご入力ありがとうございます。<br>".date("Y年m月d日 H時i分s秒")."に".$_POST["comment"]."を受け付けました」";
 ?>
