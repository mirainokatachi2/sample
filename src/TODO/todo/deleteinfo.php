<?php

session_start();

$input['item_id'] = $_POST['item_id'];

$input['item_id']=htmlspecialchars($input['item_id'],ENT_QUOTES,'UTF-8');

try{

$dsn='mysql:dbname=todo;host=localhost;charset=utf8';
$user='root';
$pass='';
$dbh=new PDO($dsn,$user,$pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql="SELECT *
      FROM users join todo_items on users.id=todo_items.user_id 
      where todo_items.id=?";

$stmt=$dbh->prepare($sql);
$data[]=$input['item_id'];
$stmt->execute($data);
$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$dbh=null;

$_SESSION['item_name']=$rec['item_name'];
$_SESSION['family_name']=$rec['family_name'];
$_SESSION['first_name']=$rec['first_name'];
$_SESSION['expire_date']=$rec['expire_date'];
$_SESSION['finished_date']=$rec['finished_date'];
$_SESSION['item_id']=$input['item_id'];

//var_dump($input['expire_date']);
//exit();
header("Location: delete.php");
}
catch(Exception $e){
    print 'ただいま障害により大変ご迷惑をお掛けしております。'.$e;
    exit();
}
