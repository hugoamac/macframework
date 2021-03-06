<?php

class Bootstrap {

    private $_url;
    private $_piece_url;
    private $_controller;
    private $_action;
    private $_params;

    public function __construct() {

        $this->load();
        $this->setUrl();
        $this->setPieceUrl();
        $this->setController();
        $this->setAction();
        $this->setParams();
    }

    private function setUrl() {

        if (isset($_SERVER["REQUEST_URI"]) && strlen($_SERVER["REQUEST_URI"]) != 1) {
            $this->_url = filter_var(trim($_SERVER["REQUEST_URI"], "/"), FILTER_SANITIZE_STRING);
        } else {
            $this->_url = "index/index";
        }
    }

    private function getUrl() {
        return $this->_url;
    }

    private function setPieceUrl() {
        if ($this->getUrl()) {
            $piece_url = explode("/", $this->getUrl());
            if (count($piece_url) == 1) {
                array_push($piece_url, "index");
            }
            $this->_piece_url = $piece_url;
        }
    }

    private function getPieceUrl() {

        return $this->_piece_url;
    }

    private function setController() {

        if (is_array($this->getPieceUrl())) {

            $piece_url = $this->getPieceUrl();

            $this->_controller = ucfirst(strtolower($piece_url[0]));
        }
    }

    private function getController() {

        return $this->_controller;
    }

    private function setAction() {
        if (is_array($this->getPieceUrl())) {

            $piece_url = $this->getPieceUrl();

            $this->_action = strtolower($piece_url[1]);
        }
    }

    private function getAction() {

        return $this->_action;
    }

    private function setParams() {

        if (is_array($this->getPieceUrl()) && count($this->getPieceUrl()) >= 0) {
            $piece_url = $this->getPieceUrl();

            $this->_params['controller'] = $piece_url[0];
            $this->_params['action'] = $piece_url[1];

            unset($piece_url[0], $piece_url[1]);
            foreach ($piece_url as $key => $val) {
                if ($key % 2 == 0) {
                    $par[] = $val;
                } else {
                    $impar[] = $val;
                }
            }
            if (isset($par) && isset($impar)) {
                foreach ($par as $key => $val) {
                    if (key_exists($key, $impar)) {
                        $this->_params[$val] = $impar[$key];
                    }
                }
            }
        }
    }

    public function getParams($name = NULL) {

        return $name ? $this->_params[$name] : $this->_params;
    }

    public function getUri($numero) {
        return $this->_piece_url[$numero];
    }

    private function load() {

        spl_autoload_register('Bootstrap::myautoloader');
    }

    public function run() {

        if (file_exists(APPLICATION_PATH . "/controllers/{$this->getController()}Controller.php")) {
            require_once APPLICATION_PATH . "/controllers/{$this->getController()}Controller.php";
            $controller_name = $this->getController() . "Controller";
            $controller = new $controller_name();

            if (is_object($controller)) {
                $action_name = $this->getAction() . "Action";
                if (method_exists($controller, $action_name)) {
                    if (method_exists($controller, "init")) {
                        $controller->init();
                    }
                    $controller->$action_name();
                } else {

                    die('A página que você solicitou não existe !');
                }
            }
        } else {

            die("A página que você solicitou não existe !");
        }
    }

    private function myautoloader($class) {

        require_once APPLICATION_PATH . "/config/config.php";

        if (isset($config['library']) && !empty($config['library'])) {

            $folderlibrary = true;
            $library = $config['library'];
        }

        if (file_exists(CORE_PATH . "/{$class}.php")) {
            return require_once CORE_PATH . "/{$class}.php";
        } elseif (file_exists(APPLICATION_PATH . "/models/{$class}.php")) {
            return require_once APPLICATION_PATH . "/models/{$class}.php";
        } elseif (file_exists(APPLICATION_PATH . "/helpers/{$class}.php")) {
            return require_once APPLICATION_PATH . "/helpers/{$class}.php";
        } elseif ($folderlibrary) {
            foreach ($library as $pasta) {

                if (file_exists(APPLICATION_PATH . "/library/{$pasta}/{$class}.php")) {
                    return require_once APPLICATION_PATH . "/library/{$pasta}/{$class}.php";
                }
            }
        } else {

            die("A classe {$class} não foi encontrada!");
        }
    }

}
