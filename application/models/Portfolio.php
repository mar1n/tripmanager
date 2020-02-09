<?php 
class Model_Portfolio extends Model_Table
{
	protected $_name 	= 'portfolio';
	protected $_primary = 'i_id';
	
	
 	public function insert($data)
 	{
    	unset($data['Zapisz']);
   
    	$itemId = parent::insert($data);
		
		return $itemId;
    }
    
    
	public function update($data, $itemId)
 	{
    	unset($data['Zapisz']);
    	
    	parent::update($data, 'i_id = '.$itemId);
    }
    
    
	public function fetchRowById($id)
	{
	    $db = $this->getAdapter();
	    
		$select = $db->select()
		   ->from($this->_name)
		   ->where('i_id = ?', $id);
           
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
		   ->from(
		       $this->_name
		   );
		   
        return $select;
	}
	
}

?>