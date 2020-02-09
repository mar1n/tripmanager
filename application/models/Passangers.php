<?php

class Model_Passangers extends Model_Table {

    protected $_name 	= 'passangers';


    public function insert($data)
    {
        unset($data['Save']);

        $itemId = parent::insert($data);

        return $itemId;
    }

    public function fetchRowById($id)
    {
        $db = $this->getAdapter();

        $select = $db->select()
            ->from($this->_name)
            ->where('id = ?', $id);

        $result = $select->query()->fetch();

        if (!$result) {
            return false;
        }

        $params          = array();
        $params['db']    = $db;
        $params['table'] = $this;
        $params['data']  = $result;

        return new Zend_Db_Table_Row($params);
    }

    public function deleteUser($id)
    {
        // fetch the user's row
        $rowUser = $this->find($id)->current();
        if($rowUser) {
            $rowUser->delete();
        }else{
            throw new Zend_Exception("Could not delete user. User not found!");
        }
    }
}