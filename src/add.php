<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/todo2/CommonUtil.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/todo2/ModelBase.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/todo2/TodoItemsModel.php');

    // サニタイズ
    $post = CommonUtil::sanitaize($_POST);

    try {
       $db = new TodoItemsModel();
       $db->addTodoItem($post);

       $db = null;
       header("Location: index.php");
    }
    catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をお掛けしております。'.$e;
        exit();
    }
