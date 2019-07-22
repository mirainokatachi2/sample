<?php

    session_start();
    session_regenerate_id(true);
    $error_message = "";

    $input['user'] = $_POST["user"];  // ユーザー名
    $input['pass'] = $_POST["password"];  // ユーザー名のパスワード

    $input['user']=htmlspecialchars($input['user'],ENT_QUOTES,'UTF-8');
    $input['pass']=htmlspecialchars($input['pass'],ENT_QUOTES,'UTF-8');
 
try{

    $dsn='mysql:dbname=todo;host=localhost;charset=utf8';
    $user='root';
    $pass='';
    $dbh=new PDO($dsn,$user,$pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql='SELECT  user,pass,family_name,first_name FROM users WHERE user=? ';
    $stmt=$dbh->prepare($sql);
    $data[]=$input["user"];
    $stmt->execute($data);

    $dbh=null;

    $rec=$stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION['user']=$rec['user'];
    $_SESSION['family_name']=$rec['family_name'];
    $_SESSION['first_name']=$rec['first_name'];
    
    if ($input['user']==$rec['user']  && password_verify($input['pass'],$rec['pass']) ) {
        header("Location: ../todo/index.php");
    }else{
        $error_message = "※ID、もしくはパスワードが間違っています。<br>　もう一度入力して下さい。";
    }
}
catch(Exception $e){
    print 'ただいま障害により大変ご迷惑をお掛けしております。'.$e;
    exit();
}

if($error_message) {
    $_SESSION['error_message']=$error_message;
    header("Location: index.php");
    }
    