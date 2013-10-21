<?php

class Application_Model_DbTable_UsersRole extends Zend_Db_Table_Abstract
{

    protected $_name = 'users_role';

    public function getUsersRole($id)
    {
        $usersRole = $this->fetchRow('id ='. $id );
        if (!$usersRole) {
            throw new Exception('Нет роли с таким id');
        }
        return $usersRole->toArray();
    }

    public function addUsersRole($role)
    {
        return $this->insert($role);
    }
}

