<?php

class Database extends PDO {

    public function __construct() {

        require_once APPLICATION_PATH . "/config/database.php";

        $type = $database["type"];
        $host = $database["host"];
        $name = $database["name"];

        $dsn = $type . ":host=" . $host . ";dbname=" . $name;

        $username = $database["user"];
        $passwd = $database["pass"];
        $options = $database["options"] ? $database["options"] : NULL;

        try {
            parent::__construct($dsn, $username, $passwd, $options);
        } catch (PDOException $e) {
            print '<pre>';
            print $e->getMessage();
            die();
        }
    }

}
