<?php

class IndexController extends Controller {

    public function indexAction() {

        $this->view->render("index/index");
    }

}

