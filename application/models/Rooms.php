<?php 
class Model_Rooms extends Model_Table
{
	protected $_name 	= 'rooms';
	protected $_primary = 'id';

    
	public function fetchRowById($id)
	{
	    $db = $this->getAdapter();
	    
		$select = $db->select()
		   ->from(array('r' => $this->_name))
		   ->join(array('p' => 'provinces'), 'p.id = r.province_id', array('province_name' => 'name', 'province_id' => 'id', 'province_guid' => 'guid'))
		   ->join(array('rt' => 'rooms_types'), 'rt.id = r.room_type_id', array('room_type_name' => 'name', 'room_type_id' => 'id', 'room_type_guid' => 'guid'))
		   ->where('r.id = ?', $id);
           
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
	
	
	public function fetchAllPaginator()
	{
		$db = $this->getAdapter();
		
		$select = $db->select()
		   	->from(array('r' => $this->_name))
		   	->join(array('p' => 'provinces'), 'p.id = r.province_id', array('province_name' => 'name', 'province_id' => 'id', 'province_guid' => 'guid'))
		   	->join(array('rt' => 'rooms_types'), 'rt.id = r.room_type_id', array('room_type_name' => 'name', 'room_type_id' => 'id', 'room_type_guid' => 'guid'));

		   	
        return $select;
	}
	
	
	public function fetchAllCity($provinceId)
	{
		$db = $this->getAdapter();
		
		$select = $db->select()
		   	->from(array('r' => $this->_name))
		   	->where('r.province_id = ?', $provinceId)
		   	->group('r.city')
		   	->order('r.city ASC');
		   	
        $result = $select->query()->fetchAll();
 
		$params          = array();
		$params['db']    = $db;
		$params['table'] = $this;
		$params['data']  = $result;
       
		return new Zend_Db_Table_Rowset($params);
	}
	
	
	public function fetchAllPaginatorByRoomType($roomType)
	{
		$db = $this->getAdapter();
		
		$select = $db->select()
		   	->from(array('r' => $this->_name))
		   	->join(array('p' => 'provinces'), 'p.id = r.province_id', array('province_name' => 'name', 'province_id' => 'id', 'province_guid' => 'guid'))
		   	->join(array('rt' => 'rooms_types'), 'rt.id = r.room_type_id', array('room_type_name' => 'name', 'room_type_id' => 'id', 'room_type_guid' => 'guid'));
		   	
		$select->where('r.room_type_id = ?', $roomType);   	
		
        return $select;
	}
	
	
	public function fetchAllPaginatorByProvinceId($provinceId)
	{
		$db = $this->getAdapter();
		
		$select = $db->select()
		   	->from(array('r' => $this->_name))
		   	->join(array('p' => 'provinces'), 'p.id = r.province_id', array('province_name' => 'name', 'province_id' => 'id', 'province_guid' => 'guid'))
		   	->join(array('rt' => 'rooms_types'), 'rt.id = r.room_type_id', array('room_type_name' => 'name', 'room_type_id' => 'id', 'room_type_guid' => 'guid'));
		   	
		$select->where('r.province_id = ?', $provinceId); 	
		
        return $select;
	}
	
	
	public function search($data)
	{
	    $db = $this->getAdapter();
	    
		$select = $db->select()
		   ->from(array('r' => $this->_name))
		   ->join(array('p' => 'provinces'), 'p.id = r.province_id', array('province_name' => 'name', 'province_id' => 'id', 'province_guid' => 'guid'))
		   ->join(array('rt' => 'rooms_types'), 'rt.id = r.room_type_id', array('room_type_name' => 'name', 'room_type_id' => 'id', 'room_type_guid' => 'guid'));
 
		if($data['province_id']){
			$select->where('r.province_id = ?', $data['province_id']);
		}
		
		if($data['city']){
			$select->where('r.city = ?', $data['city']);
			//$select->where("r.city LIKE '%". $data['city']. "%'");
		}
		
		if($data['room_type_id']){
			$select->where('r.room_type_id = ?', $data['room_type_id']);
		}
		
		if(!$data['province_id'] && !$data['city'] && !$data['room_type_id']){
			$select->where("r.id = ?", 0);
		}
		
		return $select;
	}
	
}

?>