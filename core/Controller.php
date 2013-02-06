<?php

class Controller {

    private $_post;
    private $_params;
    public $view;

    public function __construct() {

        $this->view = new View();
        $this->setPost();
    }

    private function setPost() {

        $this->_post = isset($_POST) ? $_POST : array();
    }

    public function getPost() {

        return $this->_post;
    }
    private function setParams()
    {

        $Bootstrap = new Bootstrap();

        return $Bootstrap->getParams();

    }

}

