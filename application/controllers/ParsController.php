<?php
class ParsController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    $request = $this->getRequest();
        $form = new Application_Form_Csv();

        if($this->getRequest()->isPost()){
            if($form->isValid($request->getPost())){
    		$result = $form->parseData($_FILES["csv"]["tmp_name"]);

    		if($result){                    
                    // Для вставки в базу
                    $student = new Application_Model_DbTable_Students();
                    for($i = 0, $count = count($result[0]); $i < $count; $i++){
                        $student->addStudent($result[0][$i]);
                    }
                    // Для вывода таблицы
                    $this->view->results = $result[1];
    		}
    		else{
                    $this->view->errorMessage = "Ошибка! Нечего показывать.";
    		}
                $this->render('result');
    		return;
            }
        }
    $this->view->form = $form;
    }        
}