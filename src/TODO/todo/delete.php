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
<title>削除確認</title>
<link rel="stylesheet" href="../css/normalize.css">
<link rel="stylesheet" href="../css/main.css">
</head>
<body>
<div class="container">
    <header>
         <div class="title">
            <h1>削除確認</h1>
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
        <?php// print 'エラー'; ?>
        </p>

        <p>
            下記の項目を削除します。よろしいですか？
        </p>
        <form action="./sakujo.php" method="post">
            <input type="hidden" name="item_id" value="<?php echo $_SESSION['item_id'] ?>">
            <table class="list">
                <tr>
                    <th>項目名</th>
                    <td class="align-left">
                        <?php echo $_SESSION['item_name'];?>
                    </td>
                </tr>
                <tr>
                    <th>担当者</th>
                    <td class="align-left">
                    <?php echo $_SESSION['family_name'].$_SESSION['first_name'];?>
                    </td>
                </tr>
                <tr>
                    <th>期限</th>
                    <td class="align-left">
                    <?php echo $_SESSION['expire_date'];?>
                    </td>
                </tr>
                <tr>
                    <th>
                        完了
                    </th>
                    <td class="align-left">
                        <?php if(isset($_SESSION['finished_date'])){print '完了';}else{print '未';}?>
                    </td>
                </tr>
            </table>

            <input type="submit" value="削除">
            <input type="button" value="キャンセル" onclick="location.href='./index.php';">
        </form>


    </main>

    <footer>

    </footer>
</div>
</body>
</html>