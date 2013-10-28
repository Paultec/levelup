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

    public function addSubjectAction()
    {
        $form = new Application_Form_Subject();
        if ($this->_request->isPost()){
            if ($form->isValid($this->_request->getParams())){
                $formData = $form->getValues();
                $subject = new Application_Model_DbTable_Subjects();
                $subject->addSubject($formData);
                return $this->_forward('get-all-subjects', 'data');
            } else {
                $this->view->form = $form;
            }
        }
        $this->view->form = $form;
    }

    public function editSubjectAction()
    {
        $form = new Application_Form_Subject();
        if ($this->_request->isPost()){
            if ($form->isValid($this->_request->getParams())){
                $formData = $form->getValues();
                $id = $this->_getParam('id');
                $subject = new Application_Model_DbTable_Subjects();
                $subject->editSubject($id, $formData);
                return $this->_forward('get-all-subjects', 'data');
            } else {
                $id = $this->_getParam('id', 0);
                if ($id > 0) {
                    $subject = new Application_Model_DbTable_Subjects();
                    $form->populate($subject->getSubject($id));
                }
            }
        }
        $this->view->form = $form;
    }

    public function getSubjectAction()
    {
        $id = $this->_getParam('id');
        $subject = new Application_Model_DbTable_Subjects();
        $this->view->classroom = $subject->getSubject($id);
    }

    public function getAllSubjectsAction()
    {
        $subject = new Application_Model_DbTable_Subjects();
        $this->view->subjects = $subject->getAllSubjects();
    }

    public function deleteSubjectAction()
    {
        // action body
    }

    public function addSpecialisationAction()
    {
        $form = new Application_Form_Specialisation();
        if ($this->_request->isPost()){
            if ($form->isValid($this->_request->getParams())){
                $formData = $form->getValues();
                $specialisation = new Application_Model_DbTable_Specialisation();
                $specialisation->addSpecialisation($formData);
                return $this->_forward('get-all-specialisations', 'data');
            } else {
                $this->view->form = $form;
            }
        }
        $this->view->form = $form;
    }

    public function editSpecialisationAction()
    {
        $form = new Application_Form_Specialisation();
        if ($this->_request->isPost()){
            if ($form->isValid($this->_request->getParams())){
                $formData = $form->getValues();
                $id = $this->_getParam('id');
                $specialisation = new Application_Model_DbTable_Specialisation();
                $specialisation->editSpecialisation($id, $formData);
                return $this->_forward('get-all-specialisations', 'data');
            } else {
                $id = $this->_getParam('id', 0);
                if ($id > 0) {
                    $specialisation = new Application_Model_DbTable_Specialisation();
                    $form->populate($specialisation->getSpecialisation($id));
                }
            }
        }
        $this->view->form = $form;
    }

    public function getSpecialisationAction()
    {
        $id = $this->_getParam('id');
        $specialisation = new Application_Model_DbTable_Specialisation();
        $this->view->specialisation = $specialisation->getSpecialisation($id);
    }

    public function getAllSpecialisationsAction()
    {
        $specialisation = new Application_Model_DbTable_Specialisation();
        $this->view->specialisations = $specialisation->getAllSpecialisations();
    }

    public function deleteSpecialisationAction()
    {
        // action body
    }

    public function addGroupAction()
    {
        // action body
    }

    public function editGroupAction()
    {
        // action body
    }

    public function getGroupAction()
    {
        // action body
    }

    public function getAllGroupsAction()
    {
        // action body
    }

    public function deleteGroupAction()
    {
        // action body
    }

    public function addStatusAction()
    {
        $form = new Application_Form_Status();
        if ($this->_request->isPost()){
            if ($form->isValid($this->_request->getParams())){
                $formData = $form->getValues();
                $status = new Application_Model_DbTable_Status();
                $status->addStatus($formData);
                return $this->_forward('get-all-statuses', 'data');
            } else {
                $this->view->form = $form;
            }
        }
        $this->view->form = $form;
    }

    public function editStatusAction()
    {
        $form = new Application_Form_Status();
        if ($this->_request->isPost()){
            if ($form->isValid($this->_request->getParams())){
                $formData = $form->getValues();
                $id = $this->_getParam('id');
                $status = new Application_Model_DbTable_Status();
                $status->editStatus($id, $formData);
                return $this->_forward('get-all-statuses', 'data');
            } else {
                $id = $this->_getParam('id', 0);
                if ($id > 0) {
                    $status = new Application_Model_DbTable_Status();
                    $form->populate($status->getStatus($id));
                }
            }
        }
        $this->view->form = $form;
    }

    public function getStatusAction()
    {
        $id = $this->_getParam('id');
        $status= new Application_Model_DbTable_Status();
        $this->view->status = $status->getStatus($id);
    }

    public function getAllStatusesAction()
    {
        $status = new Application_Model_DbTable_Status();
        $this->view->statuses = $status->getAllStatuses();
    }

    public function deleteStatusAction()
    {
        // action body
    }


}

























































