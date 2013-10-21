<?php

class Application_Model_DbTable_Schedule extends Zend_Db_Table_Abstract
{

    protected $_name = 'schedule';

    public function getScheduleByClassroom($id)
    {
        $select = $this->select();
        $select->where('idClassroom =' . $id);
        return $this->fetchAll($select);
    }

    public function getScheduleByUser($id)
    {
        $select = $this->select();
        $select->where('idUsersInfo =' . $id);
        return $this->fetchAll($select);
    }

    public function getScheduleByGroup($id)
    {
        $select = $this->select();
        $select->where('idGroup =' . $id);
        return $this->fetchAll($select);
    }

    public function getScheduleByDay($id)
    {
        $select = $this->select();
        $select->where('idDay =' . $id);
        return $this->fetchAll($select);
    }
}

