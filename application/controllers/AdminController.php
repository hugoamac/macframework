<?php

class AdminController extends My_Controller {

    public function indexAction()
    {
        $this->view->usuario = $this->_session->get('admin')->login;
        $this->view->render('admin/index');
    }

}
