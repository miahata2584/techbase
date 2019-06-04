<?php
 //データベース接続
$dsn = 'データベース名';
$user = "ユーザー名";
$password = 'パスワード';
$pdo = new PDO($dsn,$user,$password);

 //テーブル作成
$sql= "CREATE TABLE mission_4"
." ("
. "id INT,"
. "name char(32),"
. "comment TEXT,"
. "password TEXT"
.");";
$stmt = $pdo->query($sql);

 if(!empty($_POST["edit"])){
  //3-6の方法で要素の取り出し
   $edit = (int) $_POST["edit"];
   $pw3 = $_POST["pw3"];

   $sql = 'SELECT * FROM mission_4';
   $results = $pdo -> query($sql);
   foreach ($results as $row){
   //$rowの中にはテーブルのカラム名が入る
      if($edit == $row['id']){
          $number = $row['id'];
          $name1 = $row['name'];
          $comment1 = $row['comment'];
        }
      }
   }

?>
<!DOCTYPE>
<html>
<form action = " " method = "post">
  <input type = "text" name ="name" value = "<?php echo $name1; ?>"><br/>
  <input type = "text" name ="comment" value = "<?php echo $comennt1; ?>"><br/>
  <input type = "hidden" name ="count" value = "<?php echo $ecount; ?>">
  <input type = "text" name ="pw1" value = ""><br/>
  <input type = "submit" value ="送信"><br/>
  <input type = "hidden" name ="editNo" value = "<?php echo $edit; ?>">
  <input type = "hidden" name ="editpw" value = "<?php echo $pw3; ?>">

  <input type = "text" name ="delete" value = "削除対象番号"><br/>
  <input type = "text" name ="pw2" value = ""><br/>
  <input type = "submit" value ="削除"><br/>

  <input type = "text" name ="edit" value = "編集対象番号"><br/>
  <input type = "text" name ="pw3" value = ""><br/>
  <input type = "submit" value ="編集">
 </form>
</html>

<?php
$sql = 'SELECT * FROM mission_4';
$results = $pdo -> query($sql);
$results->execute();
$cnt = $results->rowCount();

//3-5 insertを行って、データを入力

if((!empty($_POST["name"]))&&(!empty($_POST["comment"]))){

   if(!empty($_POST["editNo"])){//編集
        $id = (int) $_POST["editNo"];
	$nm =  $_POST["name"];
	$com =  $_POST["comment"];
	$ep = $_POST["pw1"];
	$sql = "update mission_4 set name='$nm' ,comment='$com' where id = '$id' and password = '$ep'";
	$result = $pdo->query($sql);
		
		var_dump($_POST["editNo"]);
		var_dump($id);
		var_dump($nm);
		var_dump($ep);


	}else{//書き込み

		$sql = $pdo -> prepare("INSERT INTO mission_4 (id,name,comment,password) VALUES (:id, :name, :comment, :password)");
		$sql -> bindParam(':id', $id, PDO::PARAM_INT);
		$sql -> bindParam(':name', $name, PDO::PARAM_STR);
		$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
		$sql -> bindParam(':password', $password, PDO::PARAM_STR);

		$ido = "$cnt";
		$id = $ido + 1;
		$name = $_POST["name"];
		$comment = $_POST["comment"];
		$password = $_POST["pw1"];

		$sql -> execute();
		
		var_dump($id);
		var_dump($name);
		var_dump($comment);
		var_dump($password);
	}

}


if(!empty($_POST["delete"])){//削除
	$id = (int) $_POST["delete"];
	$inpassdel = $_POST["pw2"];
	$sql = "delete from mission_4 where id='$id' and password = '$inpassdel'";
	$result = $pdo->query($sql);

}

//3-6 入力したデータをselectによって表示する

$sql = 'SELECT * FROM mission_4';
$results = $pdo -> query($sql);
foreach ($results as $row){
//$rowの中にはテーブルのカラム名が入る
	echo $row['id'].',';
	echo $row['name'].',';
	echo $row['comment'].'<br>';
}


?>