<?php

class Controller {

    private $_post;
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

}

