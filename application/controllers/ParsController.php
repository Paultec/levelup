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
    		$result_array = $form->parseData($_FILES["csv"]["tmp_name"]);

    		if($result_array){
                $this->view->results = $result_array;
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