<?php

class Model extends Database {

    private $_cols = array();
    private $_where;
    private $_bind_where;
    protected $_table;

    public function __construct() {
        parent::__construct();
    }

    public function insert(array $data) {
        
    }

    public function update(array $data, $where) {
        
    }

    public function find(array $where) {

        $this->_buildWhere($where);
        $where = $this->getWhere();
        $bind = $this->getBindWhere();
        $sql = "SELECT  * FROM {$this->_table} WHERE {$where} ";
        $stm = $this->prepare($sql);
        $stm->execute($bind);

        return $stm->fetch(PDO::FETCH_OBJ);
    }

    public function findAll(array $where, $operator = array(), $order, $limit) {
        
    }

    public function delete(array $where, array $operator = array()) {
        
    }

    public function _buildWhere(array $where, array $operator = array()) {

        foreach ($where as $col => $val) {
            if (in_array($col, $this->_getCols())) {
                $val = $this->_sanitize($val);
                $this->_bind_where[":{$col}"] = "{$val}";
                $operador = isset($operator[$col]) ? $operator[$col] : " = ";
                $this->_where .= $and . "{$col} {$operador} :{$col}";
                $and = "  AND ";
            }
        }
    }

    private function _getCols() {

        $sql = "describe {$this->_table}";
        $stm = $this->prepare($sql);
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        if (count($data) > 0) {
            foreach ($data as $val) {
                if (!in_array($val->Field, $this->_cols)) {
                    array_push($this->_cols, $val->Field);
                }
            }
        }

        return $this->_cols;
    }

    private function _sanitize($val) {

        $val = trim($val);
        $val = filter_var($val, FILTER_SANITIZE_STRING);
        $val = filter_var($val, FILTER_SANITIZE_SPECIAL_CHARS);
        $val = filter_var($val, FILTER_SANITIZE_MAGIC_QUOTES);
        return $val;
    }

    public function getWhere() {
        return $this->_where;
    }

    public function getBindWhere() {
        return $this->_bind_where;
    }

}
