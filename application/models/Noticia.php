<?php

class Noticia extends Model {

    protected $_table = "usu_usuario";

    public function listar() {
//
//        $sql = "SELECT * FROM usu_usuario";
//        $rs = $this->query($sql);
//
//        return $rs->fetchAll(PDO::FETCH_ASSOC);
        $where = array(
            
            'login'=>'hugo'
//            'id_grupo'=>2,
//            'nome'=>'hugo',
//            'login'=>'lordshinoda',
//            'email'=>'hugoamac@live.com',
//            'senha'=>'teste'
        );
        $operator = array('id'=>'<>');
        $this->find($where);
    }

}
