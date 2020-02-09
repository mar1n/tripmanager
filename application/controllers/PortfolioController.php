<?php

class PortfolioController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }
	
    public function  indexAction() 
    {
    	$itemsDAO = new Model_Portfolio();
    	
		$perPage = 2000;
		
		$page = Zend_Filter_Int::filter($this->_getParam('page'));
		
		$page = $page ? $page : 1;
    	    
        $paginator = Zend_Paginator::factory($itemsDAO->fetchAllPaginator());
  		$paginator->setCurrentPageNumber($page);
  		$paginator->setItemCountPerPage($perPage);

        $items = $itemsDAO->itemsToRowset($paginator->getCurrentItems());
        
        $this->view->items			= $items;
        $this->view->paginator 		= $paginator;	
    }
    
   	public function listAction()
    {
        // action body
    }

	public function addAction()
    {
    	$itemsDAO = new Model_Portfolio();
    	
    	$itemForm = new Form_PortfolioForm();
    	
    	$this->view->form  = $itemForm;
			
		if( $this->_request->isPost() ) {
			
           	$formData = $this->_request->getPost();
           
           	if( !$itemForm->isValid($formData) ) {
				$itemForm->populate($formData);
				
				$this->view->form = $itemForm;
				
				/*$this->_helper->flashMessenger->addMessage('Wystąpił błąd podczas sprawdzania formularza. Popraw zaznaczone pola.'); */
               	return;
            }

        	$itemsDAO->insert($formData);
            print  'Portfolio zostało dodane.';
            
           /* $this->_helper->flashMessenger->addMessage('Dziękujemy za dodanie.');
            $this->_helper->redirector->gotoRouteAndExit(array('page' => 1), 'account-item-list', true);*/
		}
    }

    public function editAction()
    {
        // action body
    }

 


}







