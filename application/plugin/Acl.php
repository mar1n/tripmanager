<?php

class Plugin_Acl extends Zend_Controller_Plugin_Abstract
{
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		// set up acl
		$acl = new Zend_Acl();
		
		// add the roles
		$acl->addRole(new Zend_Acl_Role('guest'));
		$acl->addRole(new Zend_Acl_Role('user'), 'guest');
		$acl->addRole(new Zend_Acl_Role('administrator'), 'user');
		// add the resources
		$acl->add(new Zend_Acl_Resource('index'));
		$acl->add(new Zend_Acl_Resource('error'));
		$acl->add(new Zend_Acl_Resource('article'));
		$acl->add(new Zend_Acl_Resource('portfolio'));
		$acl->add(new Zend_Acl_Resource('contact'));
		$acl->add(new Zend_Acl_Resource('user'));
		
		// set up the access rules
		$acl->allow(null, array('index', 'error'));
		// a guest can only read content and login
		$acl->allow('guest', 'article');
		$acl->allow('guest', 'portfolio');
		$acl->allow('guest', 'contact');
		$acl->allow('guest', 'user');
		// cms users can also work with content
		$acl->deny('guest', 'article', array('add', 'edit'));
        $acl->deny('guest', 'user', array('list'));
		// administrators can do anything
        $acl->allow('administrator', 'article', array('add', 'edit'));
        $acl->allow('administrator', 'user', array('list'));

		
		// fetch the current user
		$auth = Zend_Auth::getInstance();
		if($auth->hasIdentity()) {
			$identity = $auth->getIdentity();
			$role = strtolower($identity->role);
			}else{
			$role = 'guest';
		}
		$controller = $request->controller;
		$action = $request->action;
		if (!$acl->isAllowed($role, $controller, $action)) {
			if ($role == 'guest') {
				$request->setControllerName('user');
				$request->setActionName('login');
				} else {
				$request->setControllerName('error');
				$request->setActionName('noauth');
			}
		}
	}
}
