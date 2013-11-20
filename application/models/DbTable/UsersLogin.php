<?php

class Application_Model_DbTable_UsersLogin extends Zend_Db_Table_Abstract
{

    protected $_name = 'users_login';

    public function getUsersLoginPass($id)
    {
        $usersLoginPass = $this->fetchRow('idUsersInfo ='. $id );
        if (!$usersLoginPass) {
            throw new Exception('Нет пользователя с таким id');
        }
        return $usersLoginPass->toArray();
    }

    public function addUsersLoginPass($data)
    {
        return $this->insert($data);
    }

    public function editUsersLoginPass($id, $data)
    {
        return $this->update($data, 'id='.(int)$id);
    }

    public function deleteUsersLoginPass($id)
    {
        $this->delete('id IN(' . $id . ')');
    }
}

