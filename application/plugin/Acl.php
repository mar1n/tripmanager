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
		$acl->add(new Zend_Acl_Resource('user'));
		// set up the access rules

		$acl->allow('guest', 'user');

        $acl->deny('guest', 'user', array('list'));
        $acl->deny('guest', 'user', array('passangers'));
		// administrators can do anything
        $acl->allow('administrator', 'user', array('list'));
        $acl->allow('administrator', 'user', array('passangers'));

		
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
