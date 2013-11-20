<?php

class StudentsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    protected function _makeFilename($name, $thumbnail = false)
    {
if ($thumbnail) {
            return $name . '.thumb.jpg';
        }
        return $name . '.jpg';
    }

    public function indexAction()
    {
        $students = new Application_Model_DbTable_Students();
        $this->view->students = $students->getAllStudents();
    }

    public function getInfoAction()
    {
        $id = $this->_getParam('id');
        $student = new Application_Model_DbTable_Students();
        //print_r($student->getStudent($id));
        $this->view->student = $student->getStudent($id);
    }

    public function addAction()
    {
        $form = new Application_Form_Student();
        if ($this->_request->isPost()){
            if ($form->isValid($this->_request->getParams())){
                $formData = $form->getValues();
                if (!$formData['lastNameStudent']) {
                    $formData['lastNameStudent'] = $formData['lastNameCustomer'];
                }
                if (!$formData['nameStudent']) {
                    $formData['nameStudent'] = $formData['nameCustomer'];
                }
                if (!$formData['patronymicStudent']) {
                    $formData['patronymicStudent'] = $formData['patronymicCustomer'];
                }
                if (!$formData['passportStudent']) {
                    $formData['passportStudent'] = $formData['passportCustomer'];
                }
                if (!$formData['INNStudent']) {
                    $formData['INNStudent'] = $formData['INNCustomer'];
                }
                if (!$formData['addressStudent']) {
                    $formData['addressStudent'] = $formData['addressCustomer'];
                }
                if (!$formData['telHouseStudent']) {
                    $formData['telHouseStudent'] = $formData['telHouseCustomer'];
                }
                if (!$formData['telMobStudent']) {
                    $formData['telMobStudent'] = $formData['telMobCustomer'];
                }
                if (!$formData['telMobStudent']) {
                    $formData['telMobStudent'] = $formData['telMobCustomer'];
                }
                if (!$formData['emailStudent']) {
                    $formData['emailStudent'] = $formData['emailCustomer'];
                }

                $student = new Application_Model_DbTable_Students();
                $student->addStudent($formData);
                return $this->_forward('index', 'students');
            } else {
                $this->view->form = $form;
            }
        }
        $this->view->form = $form;
    }

    public function editAction()
    {
        $form = new Application_Form_Student();
        if ($this->_request->isPost()){
            if ($form->isValid($this->_request->getParams())){
                $formData = $form->getValues();
                $id = $this->_getParam('id');
                $student = new Application_Model_DbTable_Students();
                $student->editStudent($id, $formData);
                return $this->_forward('index');
            } else {
                $id = $this->_getParam('id', 0);
                if ($id > 0) {
                    $student = new Application_Model_DbTable_Students();
                    $form->populate($student->getStudent($id));
                }
            }
        }
        $this->view->form = $form;
    }

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

    public function deleteAction()
    {
        $data = $this->_request->getParams();
        if ($data['deleteStudent'] == 'Удалить') {
            $student = new Application_Model_DbTable_Students();
            $this->view->student = $student->getStudent($data['id']);
        } else {
            if ($data['delete'] == 'yes') {
                $student = new Application_Model_DbTable_Students();
                $student->deleteStudent($data['id']);
                return $this->_forward('index');
            }
            else {
                return $this->_forward('index');
            }
        }
    }


}















