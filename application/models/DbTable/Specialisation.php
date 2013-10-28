<?php

class Application_Model_DbTable_Specialisation extends Zend_Db_Table_Abstract
{

    protected $_name = 'specialisation';

    public function addSpecialisation($data)
    {
        return $this->insert($data);
    }

    public function editSpecialisation($id, $data)
    {
        return $this->update($data, 'id='.(int)$id);
    }

    public function getSpecialisation($id)
    {
        $specialisation = $this->fetchRow('id ='. $id );
        if (!$specialisation) {
            throw new Exception('Нет специальности с таким id');
        }
        return $specialisation->toArray();
    }

    public function getAllSpecialisations()
    {
        $select = $this->select();
        $select->order('id');
        return $this->fetchAll($select);
    }


}

