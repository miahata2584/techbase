﻿<?php
if((!empty($_POST["edit"]))&&(!empty($_POST["pw3"]))){		//編集番号・パスが入力されたとき
	$filename = "mission_2-1_kajii.txt";
	$file2 = file($filename);
  foreach($file2 as $v2){		//for始
	$date2 = explode("<>",$v2);
    if($_POST["edit"] == $date2[0]){	//編集番号が投稿番号と一致したとき
      if($_POST["pw3"] === $date2[4]){	//パスワードがあっているとき
	$ecount = $date2[0];
	$ename = $date2[1];
	$ecom = $date2[2];
	
        }else{
	  echo "パスワードが間違っています<br>";
      }
     }
   }
 }else{
}
?>

<!DOCTYPE html>
<html lang = “ja”>
<head>
<meta charset = “UFT-8”>
</head>
<form action = "/mission_2-1.php" method = "post">
  <input type = "text" name ="name" value = "<?php echo $ename; ?>"><br/>
  <input type = "text" name ="comment" value = "<?php echo $ecom; ?>"><br/>
  <input type = "hidden" name ="count" value = "<?php echo $ecount; ?>">
  <input type = "text" name ="pw1" value = ""><br/>
  <input type = "submit" value ="送信"><br/>
  <input type = "text" name ="delete" value = "削除対象番号"><br/>
  <input type = "text" name ="pw2" value = ""><br/>
  <input type = "submit" value ="削除"><br/>
  <input type = "text" name ="edit" value = "編集対象番号"><br/>
  <input type = "text" name ="pw3" value = ""><br/>
  <input type = "submit" value ="編集">
 </form>

<?php
if(!empty($_POST["name"])&&(!empty($_POST["comment"]))){	//名前・コメントが空でないとき
    if(!empty($_POST["count"])){
	$filename = "mission_2-1_kajii.txt";
	$file3 = file($filename);
	$fp = fopen($filename, 'a');
	ftruncate($fp,0); 
	foreach($file3 as $v3){		//for始
	$date3 = explode("<>",$v3);
	if($_POST["count"] == $date3[0]){	//一致したとき
	  $date3[1] = $_POST["name"];
	  $date3[2] = $_POST["comment"];
	  $date4 = "$date3[0]<>$date3[1]<>$date3[2]<>$date3[3]";
	}else{
	fwrite($fp, $v3);

	}
	}					//for終
	fclose($fp);
}
	$filename = "mission_2-1_kajii.txt";
	$fp = fopen($filename, 'a');
	$name = $_POST["name"];
	$comment = $_POST["comment"];
	$pw1 = $_POST["pw1"];
	$time = date("Y/m/d H:i:s");
	$count = count(file($filename));
	$count++;
	$text = "$count<>$name<>$comment<>$time<>$pw1<>\n";
	fwrite($fp, $text);
	fclose($fp);
}
if((!empty($_POST["delete"]))&&(!empty($_POST["pw2"]))){	//削除番号・パスが入力されたとき始まり
	$filename = "mission_2-1_kajii.txt";
	$file1 = file($filename);
	$fp = fopen($filename,'a');	//ファイルを開く
	ftruncate($fp,0); 
   foreach($file1 as $v1){		//foreach文始まり
	$date = explode("<>",$v1);	//分解
     if($date[0] == $_POST["delete"]){	//削除番号と投稿番号が一致する始まり
       if($date[4] === $_POST["pw2"]){	//パスワードあっているとき
         }else{
	   echo "パスワードが間違っています<br>";
	   fwrite($fp,$v1);
	      }
                }else{
	     fwrite($fp,$v1);
              }
    }
		fclose($fp);
}					//削除番号入力終わり
$ret_array = file($filename);		//配列にいれる
foreach((array)$ret_array as $value){		//配列を順番に表示する
	$text1 = explode("<>", $value);	//分裂、値取得
	echo $text1[0]." ";
	echo $text1[1]." ";
	echo $text1[2]." ";
	echo $text1[3]."<br />\n";
}
?>
</html>