<?php 
class Model_Table extends Zend_Db_Table_Abstract
{

	public function itemsToRowset($data)
	{
		$db = $this->getAdapter();
		
		$params          = array();
		$params['db']    = $db;
		$params['table'] = $this;
		$params['data']  = $data;

		return new Zend_Db_Table_Rowset($params);
	}
}

?>