<?php

class Application_Model_DbTable_Subjects extends Zend_Db_Table_Abstract
{

    protected $_name = 'subjects';

    public function getSubject($id)
    {
        $subject = $this->fetchRow('id ='. $id );
        if (!$subject) {
            throw new Exception('Нет предмета с таким id');
        }
        return $subject->toArray();
    }

    public function getAllSubject()
    {
        $select = $this->select();
        $select->order('subject');
        return $this->fetchAll($select);
    }

    public function addSubject($data)
    {
        return $this->insert($data);
    }

    public function editSubject($id, $data)
    {
        return $this->update($data, 'id='.(int)$id);
    }

    public function deleteSubject($id)
    {
        $this->delete('id IN(' . $id . ')');
    }
}

