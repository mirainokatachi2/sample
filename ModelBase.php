<?php

class ModelBase
{

    /** @var string データベース接続ユーザー名 */
    protected const DB_USER = "root";

    /** @var string データベース接続パスワード */
    protected const DB_PASS = "";

    /** @var string データベースホスト名 */
    protected const DB_HOST = "localhost";

    /** @var string データベース名 */
    protected const DB_NAME = "todo_list";

    /** @var object PDOインスタンス */
    protected $dbh;


    public function __construct() {
        $dsn = 'mysql:dbname='.self::DB_NAME.';host='.self::DB_HOST.';charset=utf8';
        $this->dbh = new PDO($dsn, self::DB_USER, self::DB_PASS);
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    /**
     * トランザクションを開始します。
     */
    public function begin() {
        $this->dbh->beginTransaction();
    }

    /**
     * トランザクションをコミットします。
     */
    public function commit() {
        $this->dbh->commit();
    }

    /**
     * トランザクションをロールバックします。
     */
    public function rollback() {
        $this->dbh->rollback();
    }
}
