<?php
session_start();
$error_message = "";

$input['item_name'] = $_POST['item_name']; 
$input['user_id'] = $_POST['user_id'];
$input['expire_date'] = $_POST['expire_date'];  

$input['item_name']=htmlspecialchars($input['item_name'],ENT_QUOTES,'UTF-8');
$input['user_id']=htmlspecialchars($input['user_id'],ENT_QUOTES,'UTF-8');
$input['expire_date']=htmlspecialchars($input['expire_date'],ENT_QUOTES,'UTF-8');

list($Y,$m,$d)=explode('-',$input['expire_date']);

if($input['item_name']==""){
    $error_message = "※項目が入力されていません。<br>　もう一度入力して下さい。";
    $_SESSION['error_message']=$error_message;
    header("Location:edit.php");
  } else if( mb_strlen($input['item_name'])>100){
    $error_message = "※入力が長すぎます。<br>　100文字以内で力して下さい。";
    $_SESSION['error_message']=$error_message;
    header("Location:edit.php");
  }else if(checkdate($m,$d,$Y)==false){
    $error_message = "※存在しない日付けです。<br>　もう一度入力して下さい。";
    $_SESSION['error_message']=$error_message;
    header("Location:entry.php");
}
else{
    
try{

$dsn='mysql:dbname=todo;host=localhost;charset=utf8';
$user='root';
$pass='';
$dbh=new PDO($dsn,$user,$pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$date_db=date("Y-m-d");
//var_dump($date_db);
//exit();
if(isset($_POST['finished'])){
    $sql="INSERT INTO todo_items(user_id,item_name,registration_date,expire_date,finished_date)
    value('".$input['user_id']."','".$input['item_name']."','".$date_db."','".$input['expire_date']."','".$date_db."')";
}else{
$sql="INSERT INTO todo_items(user_id,item_name,registration_date,expire_date)
      value('".$input['user_id']."','".$input['item_name']."','".$date_db."','".$input['expire_date']."')";
}
//var_dump($sql);
//exit();
$stmt=$dbh->prepare($sql);
$stmt->execute();
$dbh=null;

header("Location: index.php");
}
catch(Exception $e){
    print 'ただいま障害により大変ご迷惑をお掛けしております。'.$e;
    exit();
}
}
