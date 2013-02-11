<?php

class Controller {

    public $view;

    public function __construct()
    {

        $this->view = new View();
    }

    public function getPost()
    {

        $_POST['id'] = 1;
        $_POST['buscar'] = '<script>alert("ola mundo");</script>';


        return isset($_POST) ? $_POST : array();
    }

    public function getParams($param = null, $sanitize = false)
    {

        $Bootstap = new Bootstrap();

        $params = $Bootstap->getParams();

        $post = $this->getPost();

        if (!empty($post))
        {

            foreach ($post as $key => $val)
            {
                $params[$key] = $val;
            }
        }

        if ($sanitize)
        {

            array_walk($params, 'Controller::sanitize');
        }

        if ($param && key_exists($param, $params))
        {

            return $params[$param];
        }
        return $params;
    }

    public function sanitize(&$array)
    {
        if (is_array($array))
        {
            array_walk($array, 'Controller::sanitize');
        } else
        {

            if (is_string($array))
            {
                $array = filter_var($array, FILTER_SANITIZE_STRING);
                $array = filter_var($array, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $array;
    }

    public function redirect($path)
    {
        header('location:' . $path);
        exit;
    }

}