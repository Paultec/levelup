<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $users = new Application_Model_DbTable_UsersInfo();
        $this->view->users = $users->getAllUsers();
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

    public function getInfoAction()
    {
        $id = $this->_getParam('id');
        $user = new Application_Model_DbTable_UsersInfo();
        $currentUser = $user->getUser($id);
        $idUsers = $currentUser['id'];
        $idUsersRole = $currentUser['idUsersRole'];
        $idStatus = $currentUser['idStatus'];
        $loginPass = new Application_Model_DbTable_UsersLogin();
        $currentUsersLoginPass = $loginPass->getUsersLoginPass($idUsers);
        $role = new Application_Model_DbTable_UsersRole();
        $currentUsersRole = $role->getUsersRole($idUsersRole);
        $status = new Application_Model_DbTable_Status();
        $currentUsersStatus = $status->getStatus($idStatus);
        $this->view->usersInfo = array('user'=>$currentUser, 'loginPass'=>$currentUsersLoginPass,
                                        'role'=>$currentUsersRole, 'status'=>$currentUsersStatus);
    }

    public function addAction()
    {
        $form = new Application_Form_AddUser();
        if ($this->_request->isPost()){
            if ($form->isValid($this->_request->getParams())){
                $allValues = $form->getValues();

                $loginValues = array('usersLogin'=>null, 'usersPassword'=>null);
                $infoValues = array_diff_key($allValues, $loginValues);
                $loginValues = array_diff_key($allValues, $infoValues);

                $user = new Application_Model_DbTable_UsersInfo();
                $user->addUsersInfo($infoValues);

                $currentUser = $user->getIdUser($infoValues['inn']);
                $loginValues['idUsersInfo'] = $currentUser['id'];
                $loginPass = new Application_Model_DbTable_UsersLogin();
                $loginPass->addUsersLoginPass($loginValues);

                //$this->_helper->layout()->message = 'Вы добавили пользователя ' . $this->_request->getParam('usersLogin') .'!';
                //$this->_helper->layout()->message_class = 'alert-success';
                return $this->_forward('index');
            } else {
                $this->view->form = $form;
            }
        }
        $this->view->form = $form;
    }

    public function editAction()
    {
        $form = new Application_Form_AddUser();
        if ($this->_request->isPost()){
            if ($form->isValid($this->_request->getParams())){
                $allValues = $form->getValues();
                $id = $this->_getParam('id');

                $loginValues = array('usersLogin'=>null, 'usersPassword'=>null);
                $infoValues = array_diff_key($allValues, $loginValues);
                $loginValues = array_diff_key($allValues, $infoValues);

                $user = new Application_Model_DbTable_UsersInfo();
                $user->editUsersInfo($id, $infoValues);
                $loginValues['idUsersInfo'] = $id;

                $loginPass = new Application_Model_DbTable_UsersLogin();
                $loginPass->editUsersLoginPass($id, $loginValues);

                return $this->_forward('index');
            } else {
                $id = $this->_getParam('id', 0);
                if ($id > 0) {
                    $user = new Application_Model_DbTable_UsersInfo();
                    $loginPass = new Application_Model_DbTable_UsersLogin();
                    $form->populate($loginPass->getUsersLoginPass($id));
                    $form->populate($user->getUser($id));
                }
            }
        }
        $this->view->form = $form;
    }


}











