<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/todo2/ModelBase.php');

/**
 * 作業項目モデルクラスです。
 */
class TodoItemsModel extends ModelBase
{
    /**
     * コンストラクタです。
     */
    public function __construct() {
        // 親クラスのコンストラクタを呼び出す
        parent::__construct();
    }

    /**
     * 作業項目を全件取得します。（削除済みの作業項目は含みません）
     *
     * @return array 作業項目の配列
     */
    public function getTodoItemAll()
    {
        $sql = '';
        $sql .= 'select ';
        $sql .= '* ';
        $sql .= 'from ';
        $sql .= 'todo_items ';
        $sql .= 'where is_deleted=0 ';        // 論理削除されている作業項目は表示対象外

        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        $ret = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $ret;
    }

    /**
     * 完了フラグ(0 or 1)をデータベースに更新します。
     */
    public function completeTodoItem($id, $flag)
    {
        $sql = '';
        $sql .= 'update ';
        $sql .= 'todo_items ';
        $sql .= 'set ';
        $sql .= "is_completed = $flag ";
        $sql .= 'where ';        
        $sql .= "id = $id ";

        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();

    }

    /**
     * 削除フラグ(0 or 1)をデータベースに更新します。
     */
    public function deleteTodoItem($key,$value)
    {
        $sql = '';
        $sql .= 'update ';
        $sql .= 'todo_items ';
        $sql .= 'set ';
        $sql .= "is_deleted = $value ";
        $sql .= 'where ';        
        $sql .= "id = $key ";

        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();

    }

    /**
     * 作業項目ををデータベースに追加します。
     */
    public function addTodoItem($post)
    {
        
        $sql = '';
        $sql .= 'insert ';
        $sql .= 'into ';
        $sql .= 'todo_items( ';
        $sql .= 'expiration_date, ';
        $sql .= 'todo_item) ';
        $sql .= 'value(?,?) ';

        $stmt = $this->dbh->prepare($sql);
        $data[]=$post['expiration_date'];
        $data[]=$post['todo_item'];

        $stmt->execute($data);
    }
}
