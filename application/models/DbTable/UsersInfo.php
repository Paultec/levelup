<?php

class Application_Model_DbTable_UsersInfo extends Zend_Db_Table_Abstract
{

    protected $_name = 'users_info';

    public function getUser($id)
    {
        $user = $this->fetchRow('id ='. $id );
        if (!$user) {
            throw new Exception('Нет пользователя с таким id');
        }
        return $user->toArray();
    }

    public function getAllUsers()
    {
        $select = $this->select();
        $select->order('idUsersRole DESC');
        return $this->fetchAll($select);
    }

    public function getSomeUsers($id)
    {
        $select = $this->select();
        $select->where('id IN(' . $id . ')');
        return $this->fetchAll($select);
    }

    public function addUsersInfo($data)
    {
        return $this->insert($data);
    }

    public function getIdUser($inn)
    {
        $user = $this->fetchRow('inn ='. $inn );
        if (!$user) {
            throw new Exception('Нет пользователя с таким inn');
        }
        return $user->toArray();
    }

    public function editUsersInfo($id, $data)
    {
        return $this->update($data, 'id='.(int)$id);
    }

    public function deleteUser($id)
    {
        $this->delete('id IN(' . $id . ')');
    }
}

