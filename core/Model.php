<?php

class Model extends Database {

    private $_cols = array();
    private $_where;
    private $_bind_where;
    private $_set;
    private $_bind_set;
    protected $_table;

    public function __construct() {
        parent::__construct();
    }

    public function insert(array $data) {

        $set = $this->buildSet($data);
        $bindSet = $this->getBindWhereSet();
        $sql = "INSERT into `{$this->_table}` SET {$set}";     
        $stm = $this->prepare($sql);
        $stm->execute($bindSet);

        return $this->lastInsertId();

        
    }

    public function update(array $data, $where) {
        $set = $this->buildSet($data);
        $bindSet = $this->getBindWhereSet();
        $where = $this->buildWhere($where);
        $bindWhere = $this->getBindWhere();
        $sql ="UPDATE `{$this->_table}` SET {$set} WHERE {$where}";
        $binds = array_merge($bindSet,$bindWhere);
        $stm = $this->prepare($sql);
        $stm->execute($binds);        
        
        return $stm->rowCount();

    }

    public function find(array $where,$cols = array()) {

        $where = $this->buildWhere($where);
        $bindWhere = $this->getBindWhere();

        $sql = "SELECT " . (!empty($cols) ? implode(',', $cols) : "*") . " FROM `{$this->_table}` WHERE {$where}";

        $stm = $this->prepare($sql);
        $stm->execute($bindWhere);

        return $stm->fetch(PDO::FETCH_OBJ);
        
    }

    public function findAll($where=array(), $operator = array(),$order = null, $limit = null) {

        if(count($where)>0)
        {
            $where = " WHERE " . $this->buildWhere($where,$operator);
            $bindWhere = $this->getBindWhere();

        }else
        {
            $where = null;
        }
        if($order!=null)
        {

            $order = " ORDER BY " . $order;
        }
        if($limit!=null)
        {
            $limit = " LIMIT " . $limit;
        }

        $sql = "SELECT * FROM `{$this->_table}` {$where} {$order} {$limit}";        
        $stm = $this->prepare($sql);
        $stm->execute($bindWhere);

        return $stm->fetchAll(PDO::FETCH_OBJ);
        
    }

    public function delete(array $where = array(), array $operator = array()) {

        if(count($where)>0)
        {

            $where = " WHERE " . $this->buildWhere($where,$operator);
            $bindWhere = $this->getBindWhere();
        }else
        {

            $where = null;
        }
        

        $sql = "DELETE FROM `{$this->_table}` {$where}";
        $stm = $this->prepare($sql);
        $stm->execute($bindWhere);

        return $stm->rowCount();

        
    }  

    public function getBindWhere(){

        return $this->_bind_where;
    } 

    public function getBindWhereSet(){

        return $this->_bind_set;

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

    public function buildWhere(array $where, array $operator = array()) {

        foreach ($where as $col => $val) {
            if (in_array($col, $this->_getCols())) {
                $val = $this->_sanitize($val);
                $this->_bind_where[":where_{$col}"] = $val;
                $operador = isset($operator[$col]) ? $operator[$col] : " = ";
                $this->_where .= $and . "{$col} {$operador} :where_{$col}";
                $and = "  AND ";
            }
        }

        return $this->_where;
        
    }

    public function buildSet(array $set) {

        foreach ($set as $col => $val) {
            if (in_array($col, $this->_getCols())) {
                $val = $this->_sanitize($val);
                $this->_bind_set[":set_{$col}"] = $val;       
                $this->_set .= $separador . "{$col} = :set_{$col}";
                $separador = "  , ";
            }
        }

        return $this->_set;
        
    } 

    private function _sanitize($val) {

        $val = trim($val);
        $val = filter_var($val, FILTER_SANITIZE_STRING);
        $val = filter_var($val, FILTER_SANITIZE_SPECIAL_CHARS);
        $val = filter_var($val, FILTER_SANITIZE_MAGIC_QUOTES);

        return $val;
    }



}
