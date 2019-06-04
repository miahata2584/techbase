<?php
//3-1
$dsn = 'データベース名';
$user = "ユーザー名";
$password = 'パスワード';
$pdo = new PDO($dsn,$user,$password);

//3-2
$sql= "CREATE TABLE tbtest"
." ("
. "id INT,"
. "name char(32),"
. "comment TEXT"
.");";
$stmt = $pdo->query($sql);

//3-3
$sql ='SHOW TABLES';
$result = $pdo -> query($sql);
foreach ($result as $row){
echo $row[0];
echo '<br>';
}
echo "<hr>";

//3-4
$sql ='SHOW CREATE TABLE tbtest';
$result = $pdo -> query($sql);
foreach ($result as $row){
print_r($row);
}
echo "<hr>";

//3-5
$sql = $pdo -> prepare("INSERT INTO tbtest (id,name, comment) VALUES ('1',:name, :comment)");
$sql -> bindParam(':name', $name, PDO::PARAM_STR);
$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
$name = 'kajii';
$comment = 'comment'; //好きな名前、好きな言葉は自分で決めること
$sql -> execute();

//3-7
/*$id = 1;
$nm = "aya";
$kome = "com"; //好きな名前、好きな言葉は自分で決めること
$sql = "update tbtest set name='$nm' , comment='$kome' where id = $id";
$result = $pdo->query($sql);
*/

//3-8
$id = 2;
$sql = "delete from tbtest where id=$id";
$result = $pdo->query($sql);

//3-6
$sql = 'SELECT * FROM tbtest';
$results = $pdo -> query($sql);
foreach ($results as $row){
//$rowの中にはテーブルのカラム名が入る
echo $row['id'].',';
echo $row['name'].',';
echo $row['comment'].'<br>';
}
?>