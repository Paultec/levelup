<?php

class Application_Model_DbTable_Status extends Zend_Db_Table_Abstract
{

    protected $_name = 'status';

    public function getStatus($id)
    {
        $status = $this->fetchRow('id ='. $id );
        if (!$status) {
            throw new Exception('Нет статуса с таким id');
        }
        return $status->toArray();
    }

    public function addStatus($status)
    {
        return $this->insert($status);
    }
}

