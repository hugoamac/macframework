<?php

class LoginController extends Controller {

    private $_data;
    private $_session;
    private $_auth;

    public function init()
    {
        $this->_session = Session::getInstance();
        $this->_session->initialize();

        $this->_auth = Auth::getInstance();

        $this->_data = $this->getPost();

        $this->view->disabledLayout(true);
    }

    public function indexAction()
    {

        $this->view->render('login/index');
    }

    public function logarAction()
    {
        if (!empty($this->_data))
        {

            $this->_data = $this->sanitize($this->_data);

            $login = $this->_data['login'];
            $pass = md5($this->_data['pass']);

            $this->_auth->setTable('usu_usuario')
                    ->setCollumCredential('login')
                    ->setCollumPass('senha')
                    ->setCredential($login)
                    ->setPass($pass);
            $this->_auth->authenticate();

            if ($this->_auth->isValid())
            {
                $dados = $this->_auth->getInfo('senha', null);

                $this->_session->create('admin', $dados);

                $this->redirect('/admin/index');
            } else
            {

                $this->redirect('/login/index');
            }
        } else
        {
            $this->redirect('/login/index');
        }
    }

    public function logoutAction()
    {
        if (isset($this->_session->get('admin')))
        {

            $this->_session->delete('admin');

            $this->redirect('/login/index');
        }
    }

}

