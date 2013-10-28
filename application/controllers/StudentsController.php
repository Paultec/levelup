<?php

class StudentsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $students = new Application_Model_DbTable_Students();
        $this->view->students = $students->getAllStudents();
    }

    public function getInfoAction()
    {
        // action body
    }

    public function addAction()
    {
        $form = new Application_Form_Student();
        if ($this->_request->isPost()){
            if ($form->isValid($this->_request->getParams())){
                $formData = $form->getValues();

                $student = new Application_Model_DbTable_Students();
                $student->addStudent($formData);

                //$this->_helper->layout()->message = 'Вы добавили пользователя ' . $this->_request->getParam('usersLogin') .'!';
                //$this->_helper->layout()->message_class = 'alert-success';
                return $this->_forward('index', 'students');
            } else {
                $this->view->form = $form;
            }
        }
        $this->view->form = $form;
    }

    public function editAction()
    {
        // action body
    }

    /*Разобраться, почему в методе не срабатывает $formData = $form->getValues();
    Из-за этого пришлось получать значения из формы явным путем и присваивать в массив $formData*/
    public function addPaymentAction()
    {
        $form = new Application_Form_Payment();
        $formData = $form->getValues();
        if ($this->getParam('idStudent')) {
            $idStudent = $this->getParam('idStudent');
            $form->idStudent->setValue($idStudent);
        }
//        начало костыля
        $date = $this->getParam('date');
        $sum = $this->getParam('sum');
        $formData['date'] = $date;
        $formData['sum'] = $sum;
        $formData['idStudent'] = $idStudent;
//        конец костыля

        if ($formData['date'] && $formData['sum'] && $form->isValid($this->_request->getParams())){
            $payment = new Application_Model_DbTable_Payments();
            $payment->addPayment($formData);

            return $this->_forward('index', 'students');
        } else {
            $this->view->form = $form;
        }

    }

    public function editPaymentAction()
    {
        // action body
    }

    public function getPaymentAction()
    {
        // action body
    }


}













