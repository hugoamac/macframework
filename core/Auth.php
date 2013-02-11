<?php

class Auth {

    private static $_instance;
    private $_table;
    private $_colum_credential;
    private $_colum_pass;
    private $_credential;
    private $_pass;
    private $_info;
    private $_valid = false;

    private function __construct()
    {
        
    }

    public static function getInstance()
    {

        if (NULL === self::$_instance)
        {

            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function setTable($table)
    {

        $this->_table = $table;

        return $this;
    }

    public function getTable()
    {

        return $this->_table;
    }

    public function setCollumCredential($collumCredential)
    {

        $this->_colum_credential = $collumCredential;
        return $this;
    }

    public function getCollumCredential()
    {

        return $this->_colum_credential;
    }

    public function setCollumPass($collumPass)
    {

        $this->_colum_pass = $collumPass;
        return $this;
    }

    public function getCollumPass()
    {

        return $this->_colum_pass;
    }

    public function setCredential($credential)
    {

        $this->_credential = $credential;
        return $this;
    }

    public function getCredential()
    {

        return $this->_credential;
    }

    public function setPass($pass)
    {

        $this->_pass = $pass;
        return $this;
    }

    public function getPass()
    {

        return $this->_pass;
    }

    public function setInfo($info)
    {

        $this->_info = $info;
    }

    public function getInfo($col = null, $val = null)
    {

        if ($col)
        {
            if (isset($this->_info->$col))
            {

                $this->_info->$col = $val;
            }
        }

        return $this->_info;
    }

    public function authenticate()
    {

        $colCredential = $this->getCollumCredential();
        $colPass = $this->getCollumPass();
        $credential = $this->getCredential();
        $pass = $this->getPass();
        $table = $this->getTable();

        $db = new Database();

        $sql = "SELECT * FROM `{$table}` WHERE {$colCredential}='{$credential}' AND {$colPass} = '{$pass}'";

        $stm = $db->prepare($sql);
        $stm->execute();
        $res = $stm->fetch(PDO::FETCH_OBJ);

        if ($stm->rowCount() > 0)
        {

            $this->setInfo($res);
            $this->_valid = true;
        }
    }

    public function isValid()
    {

        return $this->_valid;
    }

}