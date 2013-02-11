<?php

class My_Controller extends Controller {

    protected $_data;
    protected $_session;

    public function init()
    {
        $this->_session = Session::getInstance();
        $this->_session->initialize();

        if (!$this->_session->check('admin'))
        {
            $this->redirect('/login/index');
        } 
    }

}

