<?php

class Noticia extends Model {

    protected $_table = "usu_usuario";

    public function listar() {

        $data = array(
                        
            'id_grupo'=>2,
            'nome'=>'topanga_peidona',
            'login'=>'topanga',
            'email'=>'topanga@live.com',
            'senha'=>'teste3'
        );

        $where = array(
            
            'id'=>26,


  
        );
        $operator = array();

       var_dump($this->find($where,array()));
     
        


    }

}
