<?php
class Model_BasicInfo extends Model_Table {

        protected $_name 	= 'basicinfo';
        protected $_primary = 'id';


        public function insert($data)
        {
            unset($data['Save']);

            $itemId = parent::insert($data);

            return $itemId;
        }

    public function update($data, $itemId)
    {
        unset($data['Zapisz']);

        parent::update($data, 'id = '.$itemId);
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
}