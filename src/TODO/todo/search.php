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
<title>検索結果</title>
<link rel="stylesheet" href="../css/normalize.css">
<link rel="stylesheet" href="../css/main.css">
</head>
<body>
<div class="container">
    <header>
        <div class="title">
            <h1>検索結果</h1>
        </div>
        <div class="login_info">
            <ul>
                <li>ようこそ<?php print $_SESSION['family_name'].$_SESSION['first_name'];?>さん</li>
                <li>
                    <form>
                        <input type="button" value="ログアウト" onclick="location.href='../login/index.php';">
                    </form>
                </li>
            </ul>
        </div>
    </header>

    <main>
        <div class="main-header">
            <form action="./search.php" method="post">
                <div class="entry">
                    <input type="button" name="entry-button" id="entry-button" class="entry-button" value="作業登録" onclick="location.href='./entry.php'">
                </div>
                <div class="search">
                    <input type="text" name="search-button" id="search-button" class="search-button">
                    <input type="submit" value="🔍検索" name="kensaku">
                </div>
            </form>
        </div>

        <table class="list">
            <tr>
                <th>項目名</th>
                <th>担当者</th>
                <th>登録日</th>
                <th>期限日</th>
                <th>完了日</th>
                <th>操作</th>
            </tr>

<?php

$word='';
//if (isset($_POST['kensaku'])){
$word=$_POST['search-button'];
$word=htmlspecialchars($word,ENT_QUOTES,'UTF-8');
//}
//var_dump($word);
//exit();

try{

    $dsn='mysql:dbname=todo;host=localhost;charset=utf8';
    $user='root';
    $pass='';
    $dbh=new PDO($dsn,$user,$pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    $sql="SELECT  * FROM users join todo_items on users.id=todo_items.user_id 
          WHERE (CONCAT(todo_items.item_name,users.family_name,users.first_name) LIKE '%$word%') AND todo_items.is_deleted=0";
  //var_dump($sql);
  //exit();
    $stmt=$dbh->prepare($sql);
    $stmt->execute();
    $dbh=null;

    $even_odd=0;
    
    while(true){
        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
        $even_odd++;
        
    if($rec==false){
        break;
    }

    if(isset($rec['finished_date'])){
        if($even_odd%2==0){
            print '<tr class="even">';
        }else{
            print '<tr class="odd">';
        }
    }else{
        if(date("Y-m-d")>$rec['expire_date']){
            print '<tr class="warning">';
        }else{
            if($even_odd%2==0){
                print '<tr class="even">';
            }else{
                print '<tr class="odd">';
            }
        }
    }

    print '<td class="align-left">
    '.$rec['item_name'].'を実施する
    </td>
    <td class="align-left">
    '.$rec['family_name'].$rec['first_name'].'
    </td>
    <td>
    '.$rec['registration_date'].'
    </td>
    <td>
    '.$rec['expire_date'].'
    </td>
    <td>';
//var_dump($rec['finished_date']);
//exit();
    if(isset($rec['finished_date'])){
        print $rec['finished_date'];
    }else{
        print '未';
    }

    print '</td>
    <td>
                    <form action="kanryou.php" method="post">
                        <input type="hidden" name="kanryou" value="'.$rec['id'].'">
                        <input type="submit" value="完了">
                        </form>
                    <form action="edit.php" method="post">
                        <input type="hidden" name="item_id" value="'.$rec['id'].'">
                        <input type="submit" value="更新" >
                    </form>
                    <form action="delete.php" method="post">
                        <input type="hidden" name="item_id" value="'.$rec['id'].'">
                        <input type="submit" value="削除">
                    </form>
                </td>
            </tr>
            ';
}

    }
    catch(Exception $e){
        print 'ただいま障害により大変ご迷惑をお掛けしております。'.$e;
        exit();
    }

?>
<!--

            <tr class="warning">
                <td class="align-left">
                    test1を実施する
                </td>
                <td class="align-left">
                    テスト1
                </td>
                <td>
                    2019-01-30
                </td>
                <td>
                    2019-01-30
                </td>
                <td>
                    未
                </td>
                <td>
                    <form action="#" method="post">
                        <input type="hidden" name="item_id" value="1">
                        <input type="submit" value="完了">
                    </form>
                    <form action="edit.html" method="post">
                        <input type="hidden" name="item_id" value="1">
                        <input type="submit" value="更新">
                    </form>
                    <form action="delete.html" method="post">
                        <input type="hidden" name="item_id" value="1">
                        <input type="submit" value="削除">
                    </form>
                </td>
            </tr>
            <tr class="even">
                <td class="align-left">
                    test2の結果を報告する
                </td>
                <td class="align-left">
                    テスト2
                </td>
                <td>
                    2019-01-30
                </td>
                <td>
                    2019-05-10
                </td>
                <td>
                    2019-05-10
                </td>
                <td>
                    <form action="#" method="post">
                        <input type="hidden" name="item_id" value="1">
                        <input type="submit" value="完了">
                    </form>
                    <form action="edit.html" method="post">
                        <input type="hidden" name="item_id" value="1">
                        <input type="submit" value="更新">
                    </form>
                    <form action="delete.html" method="post">
                        <input type="hidden" name="item_id" value="1">
                        <input type="submit" value="削除">
                    </form>
                </td>
            </tr>
            <tr class="odd">
                <td class="align-left">
                    test3はどうなっているのか尋ねる
                </td>
                <td class="align-left">
                    テスト3
                </td>
                <td>
                    2019-01-30
                </td>
                <td>
                    2019-05-10
                </td>
                <td>
                    2019-05-10
                </td>
                <td>
                    <form action="#" method="post">
                        <input type="hidden" name="item_id" value="1">
                        <input type="submit" value="完了">
                    </form>
                    <form action="edit.html" method="post">
                        <input type="hidden" name="item_id" value="1">
                        <input type="submit" value="更新">
                    </form>
                    <form action="delete.html" method="post">
                        <input type="hidden" name="item_id" value="1">
                        <input type="submit" value="削除">
                    </form>
                </td>        -->
            </tr>
        </table>

        <div class="main-footer">
            <form>
                <div class="goback">
                    <input type="button" value="戻る" onclick="location.href='./index.php';">
                </div>
            </form>
        </div>

    </main>

    <footer>

    </footer>
</div>
</body>
</html>