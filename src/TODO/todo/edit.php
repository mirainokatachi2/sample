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
<title>作業更新</title>
<link rel="stylesheet" href="../css/normalize.css">
<link rel="stylesheet" href="../css/main.css">
</head>
<body>
<div class="container">
    <header>
         <div class="title">
            <h1>作業更新</h1>
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

//$input['item_name'] = $_POST['item_name']; 
//$input['item_name']=htmlspecialchars($input['item_name'],ENT_QUOTES,'UTF-8');
 ?>
        </p>

        <form action="kousin.php" method="post">
            <input type="hidden" name="item_id" value="<?php echo $_SESSION['item_id'] ?>">
            <table class="list">
                <tr>
                    <th>項目名</th>
                    <td class="align-left">
                        <input type="text" name="item_name" id="item_name" class="item_name" value="<?php print $_SESSION['item_name'];?>">
                    </td>
                </tr>
                <tr>
                    <th>担当者</th>
                    <td class="align-left">
                        <input type="text" name="user_id" id="user_id" class="user_id" value="<?php print $_SESSION['family_name'].$_SESSION['first_name'];?>">
                    </td>
                </tr>
                <tr>
                    <th>期限</th>
                    <td class="align-left">
                        <input type="text" name="expire_date" id="expire_date" class="expire_date" value="<?php print $_SESSION['expire_date'];?>">
                    </td>
                </tr>
                <tr>
                    <th>
                        完了
                    </th>
                    <td class="align-left">
                        <input type="checkbox" name="finished" id="finished" class="finished" value="1" size="8" <?php if(isset($_SESSION['finished_date'])){ echo 'checked';}?>> 完了
                    </td>
                </tr>
            </table>

            <input type="submit" value="更新" name="kousin2">
            <input type="button" value="キャンセル" onclick="location.href='./index.php';">
        </form>


    </main>

    <footer>

    </footer>
</div>
</body>
</html>