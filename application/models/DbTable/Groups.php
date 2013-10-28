<?php

class Application_Model_DbTable_Groups extends Zend_Db_Table_Abstract
{

    protected $_name = 'groups';

    public function getGroup($id)
    {
        $group = $this->fetchRow('id ='. $id );
        if (!$group) {
            throw new Exception('Нет группы с таким id');
        }
        return $group->toArray();
    }

    public function getAllGroups()
    {
        $select = $this->select();
        $select->order('name');
        return $this->fetchAll($select);
    }

    public function addGroup($data)
    {
        return $this->insert($data);
    }

    public function editGroup($id, $data)
    {
        return $this->update($data, 'id='.(int)$id);
    }
}

