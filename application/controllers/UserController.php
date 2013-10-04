<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function authAction()
    {
        // action body
    }

    public function addAction()
    {
        // action body
    }

    public function updateAction()
    {
        // action body
    }

    public function loginAction()
    {
        $form = new Application_Form_Auth();

        if ($this->isAjax)
            $this->_helper->ViewRenderer->setNoRender();

        if ($this->_request->isPost()) {
            if ($form->isValid($this->_getAllParams())){
                $usersLogin = $form->getElement('usersLogin')->getValue();
                $usersPassword = $form->getElement('usersPassword')->getValue();
                $db = Zend_Db_Table::getDefaultAdapter();
                $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'users_login', 'usersLogin', 'usersPassword');
                $authAdapter->setIdentity($usersLogin);
                $authAdapter->setCredential($usersPassword);
                $result = $authAdapter->authenticate();
                if($result->isValid()) {
                    $storage = Zend_Auth::getInstance()->getStorage();
                    $storage->write($authAdapter->getResultRowObject(
                        array('usersLogin', 'idUsersInfo')));
                    if ($this->isAjax)
                        return $this->_helper->json(array('status' => 'ok'));
                    $this->_redirect($this->view->baseUrl());
                } else {
                    if ($this->isAjax)
                        return $this->_helper->json(array('status' => 'fail', 'message' => $usersPassword));
                    $this->view->layout()->message = 'Неверный email или пароль';
                    $this->view->layout()->message_class = 'alert-error';
                }
            } else {
                if ($this->isAjax)
                    return $this->_helper->json(array('status' => 'fail', 'message' => 'Поля должны быть заполненны'));
            }
        }

        $this->view->form = $form;
    }

    public function logoutAction()
    {
        $this->_helper->ViewRenderer->setNoRender();
        $this->_helper->layout()->disableLayout();
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity())
            $auth->clearIdentity ();
        $this->_redirect($this->view->baseUrl());
    }


}











