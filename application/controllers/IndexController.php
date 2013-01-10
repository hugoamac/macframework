<?php

class IndexController extends Controller {

    public function indexAction() {
        $this->view->data = date("d/m/Y");
        $this->view->render("index/index");
    }

}

