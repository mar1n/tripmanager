<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $auth = Zend_Auth::getInstance();
        if($auth->hasIdentity()) {
            $this->view->identity = $auth->getIdentity();
            $id = $auth->getIdentity()->id;
        }
    }

    public function createAction()
    {
        // action body
		$userForm = new Form_User();
		if ($this->_request->isPost()) {
		if ($userForm->isValid($_POST)) {
		$userModel = new Model_User();
		$userModel->createUser(
		$userForm->getValue('username'),
		$userForm->getValue('password'),
		$userForm->getValue('first_name'),
		$userForm->getValue('last_name'),
		$userForm->getValue('role')
		);
		return $this->_forward('list'); }
		}
		$userForm->setAction('/user/create');
		$this->view->form = $userForm;
    }

    public function listAction()
    {

        $id = Zend_Auth::getInstance()->getIdentity()->id;
        $itemsDAO = new  Model_BasicInfo();

        $itemForm = new Form_BasicInfo();

        $item = $itemsDAO->fetchRowById($id);

        if($item){

            if($this->_request->isPost() ) {

                $formData = $this->_request->getPost();

                if( !$itemForm->isValid($formData) ) {
                    $itemForm->populate($formData);

                    $this->view->form = $itemForm;

                    return;
                }

                $itemsDAO->update($formData, $id);

                $this->_redirect('/user/list');

            } else {

                $itemForm->populate($item->toArray());

                $this->view->form = $itemForm;
            }

        } else {
            $this->_forward('error404', 'error', 'default');
        }

        $passangers = new Model_Passangers();

        $this->view->passangers = $passangers->fetchAll();

        $trips = new Model_Trips();

        $this->view->trips = $trips->fetchAll();
    }

    public function updateAction()
    {
		$userForm = new Form_User();
		$userForm->setAction('/user/update');
		$userForm->removeElement('password');
		$userModel = new Model_User();
		if ($this->_request->isPost()) {
                if ($userForm->isValid($_POST)) {
                    $userModel->updateUser(
                        $userForm->getValue('id'),
                        $userForm->getValue('username'),
                        $userForm->getValue('first_name'),
                        $userForm->getValue('last_name'),
                        $userForm->getValue('role')
                    );

                    return $this->_forward('list');
                }
		} else {
		$id = $this->_request->getParam('id');
		$currentUser = $userModel->find($id)->current();
		$userForm->populate($currentUser->toArray());
		}
		$this->view->form = $userForm;
    }

    public function passwordAction()
    {
        // action body
		$passwordForm = new Form_User();
		$passwordForm->setAction('/user/password');
		$passwordForm->removeElement('first_name');
		$passwordForm->removeElement('last_name');
		$passwordForm->removeElement('username');
		$passwordForm->removeElement('role');
		$userModel = new Model_User();
		if ($this->_request->isPost()) {
		if ($passwordForm->isValid($_POST)) {
		$userModel->updatePassword(
		$passwordForm->getValue('id'),
		$passwordForm->getValue('password')
		);
		return $this->_forward('list');
		}
		} else {
		$id = $this->_request->getParam('id');
		$currentUser = $userModel->find($id)->current();
		$passwordForm->populate($currentUser->toArray());
		}
		$this->view->form = $passwordForm;
    }

    public function deleteAction()
    {
		$id = $this->_request->getParam('id');
		$userModel = new Model_User();
		$userModel->deleteUser($id);
		return $this->_forward('list');
    }

    public function loginAction()
    {
        // action body
        $userForm = new Form_User();
		$userForm->setAction('/user/login');
		$userForm->removeElement('first_name');
		$userForm->removeElement('last_name');
		$userForm->removeElement('role');
        if ($this->_request->isPost() && $userForm->isValid($_POST)) {
		$data = $userForm->getValues();
		//set up the auth adapter
		// get the default db adapter
		$db = Zend_Db_Table::getDefaultAdapter();
		//create the auth adapter
		$authAdapter = new Zend_Auth_Adapter_DbTable($db, 'users',
		'username', 'password');
		//set the username and password
		$authAdapter->setIdentity($data['username']);
		$authAdapter->setCredential(md5($data['password']));
		//authenticate
		$result = $authAdapter->authenticate();
		if ($result->isValid()) {
		// store the username, first and last names of the user
		$auth = Zend_Auth::getInstance();
		$storage = $auth->getStorage();
		$storage->write($authAdapter->getResultRowObject(
		array('id','username' , 'first_name' , 'last_name', 'role')));
		return $this->_redirect('/user/list'); } else {
		$this->view->loginMessage = "Sorry, your username or
		password was incorrect";
		}
		}
		$this->view->form = $userForm;
    }

    public function logoutAction()
    {
        // action body
        $authAdapter = Zend_Auth::getInstance();
		$authAdapter->clearIdentity();
    }

    public function passangersAction()
    {
        // Action body
        $itemsDAO = new Model_Passangers();

        $itemForm = new Form_Passangers();

        $this->view->form  = $itemForm;

        if( $this->_request->isPost() ) {

            $formData = $this->_request->getPost();

            if( !$itemForm->isValid($formData) ) {
                $itemForm->populate($formData);
                //$itemForm->addElement(array("customer_ID", "1"));
                $this->view->form = $itemForm;

                return;
            }
                print_r($itemForm);
            $itemsDAO->insert($formData);

            return $this->_redirect('/user/list');

        }
    }

    public function deletepassangerAction()
    {
        $id = $this->_request->getParam('id');
        $passangerModel = new Model_Passangers();
        $passangerModel->deletePassangers($id);
        return $this->_redirect('/user/list');
    }

    public function tripsAction()
    {
        // Action body
        $itemsDAO = new Model_Trips();

        $itemForm = new Form_Trips();
        $this->view->form  = $itemForm;

        if( $this->_request->isPost() ) {

            $formData = $this->_request->getPost();

            if( !$itemForm->isValid($formData) ) {
                $itemForm->populate($formData);
                //$itemForm->addElement(array("customer_ID", "1"));
                $this->view->form = $itemForm;

                return;
            }
            unset($formData['passangers']);
            //unset($itemForm['Checkbox']);
            $itemsDAO->insert($formData);
            $values = $itemForm->getValues();
            $users = $values['passangers']; //'users' is the element name
            var_dump($users);
            print($itemsDAO->getAdapter()->lastInsertId());

           // return $this->_redirect('/user/list');

        }
    }

}