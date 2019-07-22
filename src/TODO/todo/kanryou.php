<?php
//var_dump($_POST['kanryou']);
//exit();
try{

$dsn='mysql:dbname=todo;host=localhost;charset=utf8';
$user='root';
$pass='';
$dbh=new PDO($dsn,$user,$pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql="UPDATE todo_items SET finished_date=update_date_time where id=?";

$stmt=$dbh->prepare($sql);
$data[]=$_POST['kanryou'];
$stmt->execute($data);
$dbh=null;

header("Location: index.php");
}
catch(Exception $e){
    var_dump($e);
    print 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}
