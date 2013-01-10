<?php

class NoticiaController extends Controller {

    public function indexAction() {

        $model = new Noticia();
        $noticia = $model->listar();
        
//        var_dump($noticia);

        //$this->view->noticia = $noticia;

        //$this->view->render("noticia/index");
    }

}

