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
        $data = $this->_request->getParams();
        if ($data['deleteClassroom'] == 'Удалить') {
            $classroom = new Application_Model_DbTable_Classroom();
            $this->view->classroom = $classroom->getClassroom($data['id']);
        } else {
            if ($data['delete'] == 'yes') {
                $classroom = new Application_Model_DbTable_Classroom();
                $classroom->deleteClassroom($data['id']);
                return $this->_forward('get-all-classrooms');
            }
            else {
                return $this->_forward('get-all-classrooms');
            }
        }
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

    public function getAllStatusesAction()
    {
        $status = new Application_Model_DbTable_Status();
        $this->view->statuses = $status->getAllStatuses();
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

    public function deleteStatusAction()
    {
        $data = $this->_request->getParams();
        if ($data['deleteStatus'] == 'Удалить') {
            $status = new Application_Model_DbTable_Status();
            $this->view->status = $status->getStatus($data['id']);
        } else {
            if ($data['delete'] == 'yes') {
                $status = new Application_Model_DbTable_Status();
                $status->deleteStatus($data['id']);
                return $this->_forward('get-all-statuses');
            }
            else {
                return $this->_forward('get-all-statuses');
            }
        }
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

    public function getSubjectAction()
    {
        // action body
    }

    public function getAllSubjectsAction()
    {
        $subject = new Application_Model_DbTable_Subjects();
        $this->view->subjects = $subject->getAllSubject();
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

    public function deleteSubjectAction()
    {
        $data = $this->_request->getParams();
        if ($data['deleteSubject'] == 'Удалить') {
            $subject = new Application_Model_DbTable_Subjects();
            $this->view->subject = $subject->getSubject($data['id']);
        } else {
            if ($data['delete'] == 'yes') {
                $subject = new Application_Model_DbTable_Subjects();
                $subject->deleteSubject($data['id']);
                return $this->_forward('get-all-subjects');
            }
            else {
                return $this->_forward('get-all-subjects');
            }
        }
    }

    public function addSpecialisationAction()
    {
        $form = new Application_Form_Specialisation();
        if ($this->_request->isPost()){
            if ($form->isValid($this->_request->getParams())){
                $formData = $form->getValues();
                $subjectData = array('idSubject' => null);
                $formDataSpec = array_diff_key($formData, $subjectData);
                $specialisation = new Application_Model_DbTable_Specialisation();
                $specialisation->addSpecialisation($formDataSpec);
                $idSpec = $specialisation->getIdSpecialisation($formData['specialisation']);
                foreach ($formData['idSubject'] as $idSub) {
                    $data = array('idSpecialisation' => $idSpec, 'idSubject' => $idSub);
                    $register = new Application_Model_DbTable_SubAndSpec();
                    $register->addRegister($data);
                }
                return $this->_forward('get-all-specialisations', 'data');
            } else {
                $this->view->form = $form;
            }
        }
        $this->view->form = $form;
    }

    public function getSpecialisationAction()
    {
        // action body
    }

    public function getAllSpecialisationsAction()
    {
        $specialisation = new Application_Model_DbTable_Specialisation();
        $this->view->specialisations = $specialisation->getAllSpecialisations();
    }

    public function editSpecialisationAction()
    {
        $form = new Application_Form_Specialisation();
        if ($this->_request->isPost()){
            if ($form->isValid($this->_request->getParams())){
                $formData = $form->getValues();
                print_r($formData);
                $subjectData = array('idSubject' => null);
                $formDataSpec = array_diff_key($formData, $subjectData);
                $id = $this->_getParam('id');
                print_r($formDataSpec);
                $specialisation = new Application_Model_DbTable_Specialisation();
                //$specialisation->editSpecialisation($id, $formDataSpec);
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

    public function deleteSpecialisationAction()
    {
        $data = $this->_request->getParams();
        if ($data['deleteSpecialisation'] == 'Удалить') {
            $specialisation = new Application_Model_DbTable_Specialisation();
            $this->view->specialisation = $specialisation->getSpecialisation($data['id']);
        } else {
            if ($data['delete'] == 'yes') {
                $specialisation = new Application_Model_DbTable_Specialisation();
                $specialisation->deleteSpecialisation($data['id']);
                return $this->_forward('get-all-specialisations');
            }
            else {
                return $this->_forward('get-all-specialisations');
            }
        }
    }

    public function addGroupAction()
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

    public function editGriopAction()
    {
        // action body
    }

    public function deleteGroupAction()
    {
        // action body
    }


}























































