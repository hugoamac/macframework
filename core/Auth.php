<?php

class Auth {

    private $_table;
    private $_colum_credential;
    private $_colum_pass;
    private $_credential;
    private $_pass;
    private $_info;

    public function setTable($table) {

        $this->_table = $table;
    }

    public function getTable() {

        return $this->_table;
    }

    public function setCollumCredential($collumCredential) {

        $this->_colum_credential = $collumCredential;
    }

    public function getCollumCredential() {

        return $this->_colum_credential;
    }

    public function setCollumPass($collumPass) {

        $this->_colum_pass = $collumPass;
    }

    public function getCollumPass() {

        return $this->_colum_pass;
    }

    public function setCredential($credential) {

        $this->_credential = $credential;
    }

    public function getCredential() {

        return $this->_credential;
    }

    public function setPass($pass) {

        $this->_pass = $pass;
    }

    public function getPass() {

        return $this->_pass;
    }

    public function setInfo($info) {

        $this->_info = $info;
    }

    public function getInfo() {

        return $this->_info;
    }

    public function authenticate() {


        $colCredential = $this->getCollumCredential();
        $colPass = $this->getCollumPass();
        $credential = $this->getCredential();
        $pass = $this->getPass();
        $table = $this->getTable();

        $db = new Database();

        $sql = "SELECT * FROM {$table} WHERE {$colCredential}='{$credential}' AND {$colPass} = {$pass}";
        $stm = $db->prepare($sql);
        $stm->execute;

        if ($stm->rowCount() > 0) {

            $this->setInfo($stm->fetch());

            return true;
        }

        return false;
    }

}