<?php

class Application_Model_DbTable_Specialisation extends Zend_Db_Table_Abstract
{

    protected $_name = 'specialisation';

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
        $select->order('specialisation');
        return $this->fetchAll($select);
    }

    public function getIdSpecialisation($specialisation)
    {
        $select = $this->select();
        $select->where("specialisation = '" . $specialisation."'");
        $idSpec = $this->fetchAll($select);
        return $idSpec[0]['id'];
    }

    public function addSpecialisation($data)
    {
        return $this->insert($data);
    }

    public function editSpecialisation($id, $data)
    {
        return $this->update($data, 'id='.(int)$id);
    }

    public function deleteSpecialisation($id)
    {
        $this->delete('id IN(' . $id . ')');
    }

}

