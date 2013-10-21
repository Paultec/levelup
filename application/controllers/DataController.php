<?php

class DataController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->message = '<h3>Выберите раздел</h3>';
    }

    public function addClassroomAction()
    {
        $form = new Application_Form_Classroom();
        if ($this->_request->isPost()){
            if ($form->isValid($this->_request->getParams())){
                $formData = $form->getValues();
                $classroom = new Application_Model_DbTable_Classroom();
                $classroom->addClassroom($formData);
                return $this->_forward('get-all-classrooms', 'data');
            } else {
                $this->view->form = $form;
            }
        }
        $this->view->form = $form;
    }

    public function getAllClassroomsAction()
    {
        $classroom = new Application_Model_DbTable_Classroom();
        $this->view->classrooms = $classroom->getAllClassrooms();
    }

    public function getClassroomAction()
    {
        $id = $this->_getParam('id');
        $classroom = new Application_Model_DbTable_Classroom();
        $this->view->classroom = $classroom->getClassroom($id);
    }

    public function editClassroomAction()
    {
        $form = new Application_Form_Classroom();
        if ($this->_request->isPost()){
            if ($form->isValid($this->_request->getParams())){
                $formData = $form->getValues();
                $id = $this->_getParam('id');
                $classroom = new Application_Model_DbTable_Classroom();
                $classroom->editClassroom($id, $formData);
                return $this->_forward('get-all-classrooms', 'data');
            } else {
                $id = $this->_getParam('id', 0);
                if ($id > 0) {
                    $classroom = new Application_Model_DbTable_Classroom();
                    $form->populate($classroom->getClassroom($id));
                }
            }
        }
        $this->view->form = $form;
    }

    public function deleteClassroomAction()
    {
        // action body
    }

    public function getScheduleByClassroomAction()
    {
        $id = $this->_getParam('id');
        $schedule = new Application_Model_DbTable_Schedule();
        $scheduleByClassroom = $schedule->getScheduleByClassroom($id);
        $classroom = new Application_Model_DbTable_Classroom();
        $numberClassroom = $classroom->getClassroom($id)['number'];
        $scheduleTable['classroom'] = $numberClassroom;
        $users = array();
        $currentSchedule = array();

        foreach ($scheduleByClassroom as $elem) {
            foreach ($elem as $key => $value) {
                switch ($key)
                {
                    case 'idUsersInfo' :
                        $user = new Application_Model_DbTable_UsersInfo();
                        $currentUser = $user->getUser($value);
                        $current['lecturer'] = $currentUser['firstName'].$currentUser['lastName'];
                        $users[] = $current['lecturer'];
                        break;
                    case 'idGroup' :
                        $group = new Application_Model_DbTable_Groups();
                        $currentGroup = $group->getGroup($value);
                        $current['group'] = 'группа '.$currentGroup['name'].'<br/> в '.$currentGroup['timeStartLession'];
                        break;
                    case 'idDay' :
                        $current['day'] = $value;
                        break;
                }
            }
            $currentSchedule[] = $current;
        }

        $users = array_unique($users);
        foreach ($users as $val) {
            $lecturers[] = $val;
        }

        $days = array('Lecturer', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su');
        for ($count = 0; $count < count($lecturers); ++$count) {
            $scheduleRow = array_fill(0, 8, '');
            $scheduleRow[0] = $lecturers[$count];
            foreach ($currentSchedule as $elem) {
                if ($elem['lecturer'] == $scheduleRow[0]) {
                    $scheduleRow[$elem['day']] = $elem['group'];
                }
            }
            $scheduleTableAssoc = array_combine($days, $scheduleRow);
            $scheduleTable[] = $scheduleTableAssoc;
        }

        $this->view->scheduleByClassroom = $scheduleTable;
    }

    public function getScheduleByUserAction()
    {
        // action body
    }

    public function getScheduleByGroupAction()
    {
        // action body
    }


}

















