<?php

class Application_Model_DbTable_Students extends Zend_Db_Table_Abstract
{

    protected $_name = 'students';

    public function getStudent($id)
    {
        $student = $this->fetchRow('id ='. $id );
        if (!$student) {
            throw new Exception('Нет студента с таким id');
        }
        return $student->toArray();
    }

    public function getAllStudents()
    {
        $select = $this->select();
        $select->order('id');
        return $this->fetchAll($select);
    }

    public function addStudent($data)
    {        
        //$data['photo'] = base64_encode($data['photo']);
        return $this->insert($data);
    }

    public function editStudent($id, $data)
    {
        return $this->update($data, 'id='.(int)$id);
    }
}

