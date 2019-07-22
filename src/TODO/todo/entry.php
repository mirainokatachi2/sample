<?php
    session_start();
    if(empty($_SESSION['user'])){
        header("Location: ../login/index.php");
    }else{

    }
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>作業登録</title>
<link rel="stylesheet" href="../css/normalize.css">
<link rel="stylesheet" href="../css/main.css">
</head>
<body>
<div class="container">
    <header>
         <div class="title">
            <h1>作業登録</h1>
        </div>
        <div class="login_info">
            <ul>
                <li>ようこそ<?php print $_SESSION['family_name'].$_SESSION['first_name'];?>さん</li>
                <li>
                    <form>
                        <input type="button" value="ログアウト" onclick="location.href='../login/logout.php';">
                    </form>
                </li>
            </ul>
        </div>
    </header>

    <main>
        <p class="error">
        
        <?php

        if($_SESSION['error_message']){
            print $_SESSION['error_message'];
        }
         ?>
        </p>

        <form action="touroku.php" method="post">
            <input type="hidden" name="item_id" value="3">
            <table class="list">
                <tr>
                    <th>項目名</th>
                    <td class="align-left">
                        <input type="text" name="item_name" id="item_name" class="item_name" value="">
                    </td>
                </tr>
                <tr>
                    <th>担当者</th>
                    <td class="align-left">
                        <select name="user_id" id="user_id" class="user_id">
                            <option value="1" selected>テスト花子</option>
                            <option value="2" >テスト太郎</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>期限</th>
                    <td class="align-left">
                        <input type="text" name="expire_date" id="expire_date" class="expire_date" value="<?php print date("Y-m-d");?>">
                    </td>
                </tr>
                <tr>
                    <th>
                        完了
                    </th>
                    <td class="align-left">
                        <input type="checkbox" name="finished" id="finished" class="finished" value="1" size="8"> 完了
                    </td>
                </tr>
            </table>

            <input type="submit" value="登録">
            <input type="button" value="キャンセル" onclick="location.href='./index.php';">
        </form>


    </main>

    <footer>

    </footer>
</div>
</body>
</html>