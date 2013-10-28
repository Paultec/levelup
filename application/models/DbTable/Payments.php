<?php

class Application_Model_DbTable_Payments extends Zend_Db_Table_Abstract
{

    protected $_name = 'payments';

    public function getPayments($id)
    {
        $select = $this->select();
        if (!$select) {
            throw new Exception('Нет платежей от этого студента');
        }
        $select->where('idStudent =' . $id);
        return $this->fetchAll($select);
    }

    public function addPayment($data)
    {
        return $this->insert($data);
    }

    public function editPayment($id, $data)
    {
        return $this->update($data, 'id='.(int)$id);
    }

    public function getPayment($id)
    {
        $payment = $this->fetchRow('id ='. $id );
        if (!$payment) {
            throw new Exception('Нет платежа с таким id');
        }
        return $payment->toArray();
    }
}

