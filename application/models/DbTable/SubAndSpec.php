<?php

class Application_Model_DbTable_SubAndSpec extends Zend_Db_Table_Abstract
{

    protected $_name = 'ref_sub_spec';

    public function getSubjectBySpec($id)
    {
        $select = $this->select();
        $select->where('idSpecialisation = ' . $id);
        return $this->fetchAll($select);
    }

    public function getSpecBySubject($id)
    {
        $select = $this->select();
        $select->where('idSubject = ' . $id);
        return $this->fetchAll($select);
    }

    public function addRegister($data)
    {
        return $this->insert($data);
    }

    public function deleteStatus($id)
    {
        $this->delete('id IN(' . $id . ')');
    }

}

