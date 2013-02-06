<?php

class Noticia extends Model {

    protected $_table = "not_noticia";

    public function listar() 
    {
        return  $this->findAll();
    }
    public function busca($id)
    {
        return $this->find(array('id'=>(int)$id));
    }
    public function salvar(array $data)
    {

        if(isset($data['id']) && !empty($data['id']))
        {
            $id = (int)$data['id'];
            return $this->update($data,array('id'=>$id));
        }

        return $this->insert($data);
    }
    public function exclui($id)
    {
        return $this->delete(array('id'=>(int)$id));
    }

}
