<?php

//phpとMysqlの連携 データベースへの接続

$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn,$user,$password);

//テーブル作成
$sql= "CREATE TABLE mission4-1"
." ("
. "id INT,"
. "name char(32),"
. "comment TEXT,"
. "password TEXT"
.");";
$stmt = $pdo->query($sql);


if($_POST["editnum"] != ""){
	$editnum = (int) $_POST["editnum"];
	$editpassword = $_POST["pass"];

	$sql = 'SELECT * FROM mission4-1';
	$results = $pdo -> query($sql);
	foreach ($results as $row){
	
		if($editnum == $row['id']){
			$number = $row['id'];
			$namedef = $row['name'];
			$commentdef = $row['comment'];
		}

	}

}

?>

<html>
  <form action=" " method="post">
    <input type="text" name="name" placeholder="名前" value="<?php echo $namedef; ?>" >
    <br>
    <input type="text" name="comment" placeholder="コメント" value="<?php echo  $commentdef; ?>">
    <br>
    <input type="text" name="password" placeholder="パスワード">
    <br>
    <input type="submit" value="投稿"><br>
    <input type="hidden" name="number" value="<?php echo  $editnum; ?>">
    <input type="hidden" name="editpass" value="<?php echo  $editpassword; ?>">

    <input type="text" name="delete" placeholder="削除対象番号"><br>
    <input type="text" name="passdel" placeholder="パスワード"><br>
    <input type="submit" value="削除"><br>

    <input type="text" name="editnum" placeholder="編集対象番号"><br>
    <input type="text" name="pass" placeholder="パスワード"><br>
    <input type="submit" value="編集"><br>
  
  </form>
</html>


<?php


$inpass = $_POST["editpass"];
$editpassword = $_POST["pass"];

$sql = 'SELECT * FROM mission4-1 order by id';//order by idはなくても良い
$results = $pdo -> query($sql);
$results->execute();
$cnt = $results->rowCount();

//3-5 insertを行って、データを入力

if($_POST["name"] != "" && $_POST["comment"] != ""){

	if($_POST["number"] != ""){//編集

		$id = (int) $_POST["number"];
		$nm =  $_POST["name"];
		$kome =  $_POST["comment"];
		$epass = $editpass = $_POST["password"];
		$sql = "update mission4-1 set name='$nm' ,comment='$kome' ,password='$epass' where id = $id and password=$epass";
		$result = $pdo->query($sql);
		
		var_dump($_POST["number"]);
		var_dump($id);
		var_dump($nm);
		var_dump($epass);


	}else{//書き込み

		$sql = $pdo -> prepare("INSERT INTO mission4-1 (id,name,comment,password) VALUES (:id, :name, :comment, :password)");
		$sql -> bindParam(':id', $id, PDO::PARAM_INT);
		$sql -> bindParam(':name', $name, PDO::PARAM_STR);
		$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
		$sql -> bindParam(':password', $password, PDO::PARAM_STR);

		$ido = "$cnt";
		$id = $ido + 1;
		$name = $_POST["name"];
		$comment = $_POST["comment"];
		$password = $_POST["password"];

		$sql -> execute();
		
		var_dump($id);
		var_dump($name);
		var_dump($comment);
		var_dump($password);
	}

}


if($_POST["delete"] != ""){//削除
	$id = (int) $_POST["delete"];
	$inpassdel = $_POST["passdel"];
	$sql = "delete from mission4-1 where id=$id";
	$result = $pdo->query($sql);

}

//3-6 入力したデータをselectによって表示する

$sql = 'SELECT * FROM mission4-1';
$results = $pdo -> query($sql);
foreach ($results as $row){
//$rowの中にはテーブルのカラム名が入る
	echo $row['id'].',';
	echo $row['name'].',';
	echo $row['comment'].'<br>';
}

?>
