<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->message = '<h3>Welcome to Level Up</h3>';
    }

    public function getScheduleByClassroomAction()
    {
        // action body
    }


}



