<?php

class View {

    private $_layout;
    private $_content;
    private $_disabled;
    private $_baseUrul;

    public function __construct() {
        $this->setBaseUrl();
        $this->setLayout();
        $this->disabledLayout(FALSE);
    }

    public function setBaseUrl() {
        require APPLICATION_PATH . "/config/config.php";
        if (!empty($config["base_url"]))
            $this->_baseUrul = $config["base_url"];
        else
            $this->_baseUrul = "/";
    }

    public function baseUrl() {

        return $this->_baseUrul;
    }

    public function setContent($content) {
        $this->_content = $content;
    }

    public function getContent() {
        return $this->_content;
    }

    public function content() {

        require_once $this->getContent();
    }

    public function disabledLayout($bool) {
        $this->_disabled = $bool;
    }

    public function getDisabledLayout() {
        return $this->_disabled;
    }

    public function getLayout() {
        return $this->_layout;
    }

    public function setLayout($file = NULL) {
        require APPLICATION_PATH . "/config/config.php";

        if (!empty($config["layout"])) {

            $filename = $file ? $file : $config["layout"];
            $this->_layout = APPLICATION_PATH . "/layout/" . $filename . ".php";
        } else {
            $this->_layout = NULL;
        }
    }

    public function render($file) {
        $filename = APPLICATION_PATH . "/views/" . $file . ".php";
        if (file_exists($filename)) {
            if ($this->getLayout() && $this->getDisabledLayout() == FALSE) {
                $this->setContent($filename);
                require_once $this->getLayout();
            } else {
                require_once $filename;
            }
        } else {
            die("a view não existe!");
        }
    }

}
