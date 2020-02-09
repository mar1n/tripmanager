<?php

class ArticleController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
    	$itemsDAO = new Model_Items();
    	
    	$itemForm = new Form_ItemForm();
    	
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
            print  'Artykuł został dodany.';
            
           /* $this->_helper->flashMessenger->addMessage('Dziękujemy za dodanie.');
            $this->_helper->redirector->gotoRouteAndExit(array('page' => 1), 'account-item-list', true);*/
		}
    }

    public function editAction()
    {
    	$itemsDAO = new  Model_Items();
    	
    	$itemForm = new Form_ItemForm();
    	
    	$id = Zend_Filter_Int::filter($this->_getParam('id'));
		
		$item = $itemsDAO->fetchRowById($id);
		
		if($item){
				
			if($this->_request->isPost() ) {
				
	           	$formData = $this->_request->getPost();
	           
	           	if( !$itemForm->isValid($formData) ) {
					$itemForm->populate($formData);
					
					$this->view->form = $itemForm;
					
					//$this->_helper->flashMessenger->addMessage('Wystąpił błąd podczas sprawdzania formularza. Popraw zaznaczone pola.');
	               	return;
	            }
	
	        	$itemsDAO->update($formData, $item->i_id);
	        	//$id = 'produkt-edytuj/'.$item->i_id;
	        	
				$this->_redirect('produkt-edytuj/'.$item->i_id);	           
				// $this->_helper->flashMessenger->addMessage('Dziękujemy za dodanie.');
	            // $this->_helper->redirector->gotoRouteAndExit(array('page' => 1), 'account-item-list', true);
			} else {

				$itemForm->populate($item->toArray());
				
				$this->view->form = $itemForm;
			}
			
		} else {
			$this->_forward('error404', 'error', 'default');
		}
    }

    public function listAction()
    {
        // action body
    }

    public function displayAction()
    {
        // action body
    }


}









