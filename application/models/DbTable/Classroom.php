<?php

class Application_Model_DbTable_Classroom extends Zend_Db_Table_Abstract
{

    protected $_name = 'classroom';

    public function getClassroom($id)
    {
        $classroom = $this->fetchRow('id ='. $id );
        if (!$classroom) {
            throw new Exception('Нет аудитории с таким id');
        }
        return $classroom->toArray();
    }

    public function getAllClassrooms()
    {
        $select = $this->select();
        $select->order('number');
        return $this->fetchAll($select);
    }

    public function addClassroom($data)
    {
        return $this->insert($data);
    }

    public function editClassroom($id, $data)
    {
        return $this->update($data, 'id='.(int)$id);
    }
}

