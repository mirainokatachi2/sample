<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/todo2/TodoItemsModel.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/todo2/CommonUtil.php');

    try {

        $db = new TodoItemsModel();
        $items = $db->getTodoItemAll();

    } catch (Exception $e) {
         var_dump($e);
         print 'ただいま障害により大変ご迷惑をお掛けしております。';
       // header('Location: ../error/error.php');
    }
    
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>TODOリスト</title>
<link rel="stylesheet" href="./css/normalize.css">
<link rel="stylesheet" href="./css/main.css">
</head>
<body>
<div class="container">
<h1>TODOリスト</h1>
<form action="add.php" method="post">
    <input type="date" name="expiration_date" value="2019-06-20">
    <input type="text" name="todo_item" value="" class="item">
    <input type="submit" value="追加">
</form>

<form action="action.php" method="POST">
<table class="list">
    

    <tr>
        <th>期限日</th>
        <th>項目</th>
        <th>未完了</th>
        <th>完了</th>
        <th>削除</th>
    </tr>

<?php

foreach ($items as $rec) {

    if ($rec['is_completed']==1) {
        print '
        <tr>
            <td class="del">'.$rec['expiration_date'].'</td>
            <td class="del">'.$rec['todo_item'].'</td>
            <td class="center"><input type="radio" name="is_completed['.$rec['id'].']" value="0"></td>
            <td class="center"><input type="radio" name="is_completed['.$rec['id'].']" checked value="1"></td>';
    } else {
        print '
        <tr>
            <td>'.$rec['expiration_date'].'</td>
            <td>'.$rec['todo_item'].'</td>
            <td class="center"><input type="radio" name="is_completed['.$rec['id'].']" checked value="0"></td>
            <td class="center"><input type="radio" name="is_completed['.$rec['id'].']" value="1"></td>';
    }

        print '
        <td class="center"><input type="checkbox" name="is_deleted['.$rec['id'].']" value="1"></td>
        </tr>';
}

?>

</table>
<input type="submit"  value="実行">
</form>

</div>
</body>
</html>
