<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {	
    	$itemsDAO = new Model_Items();
    	
		$perPage = 2000;
		
		$page = Zend_Filter_Int::filter($this->_getParam('page'));
		
		$page = $page ? $page : 1;
    	    
        $paginator = Zend_Paginator::factory($itemsDAO->fetchAllPaginator());
  		$paginator->setCurrentPageNumber($page);
  		$paginator->setItemCountPerPage($perPage);

        $items = $itemsDAO->itemsToRowset($paginator->getCurrentItems());
        
        $this->view->items			= $items;
        $this->view->paginator 		= $paginator;
        
    /*	print 'akcja index';
	    $itemsDAO = new Model_Items();
	
		$perPage = 20;
		
		$page = Zend_Filter_Int::filter($this->_getParam('page'));
		
		$page = $page ? $page : 1;
    	    
        $paginator = Zend_Paginator::factory($itemsDAO->fetchAllPaginator());
  		$paginator->setCurrentPageNumber($page);
  		$paginator->setItemCountPerPage($perPage);

        $this->view->items          = $itemsDAO->itemsToRowset($paginator->getCurrentItems());
  		$this->view->paginator 		= $paginator;
  		//$this->view->query          = $_SERVER['QUERY_STRING']; */
    }
    
	public function testAction()
    {
        print  'slowo';
    }


}

