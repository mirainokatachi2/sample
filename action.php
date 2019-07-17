<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/todo2/TodoItemsModel.php');

    
try {

    $db = new TodoItemsModel();
    
    foreach ($_POST['is_completed'] as $key => $value) {
        $db->completeTodoItem($key, $value);
    }

    foreach ($_POST['is_deleted'] as $key => $value) {
        $db->deleteTodoItem($key, $value);
    }

    $db = null;
    header("Location: index.php");
    
    }
    catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をお掛けしております。'.$e;
        exit();
    }
