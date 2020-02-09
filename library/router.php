<?php 

	$router = $front->getRouter();
	
	$route = new Zend_Controller_Router_Route_Static(
	   '',
	    array(
	    	'module'	 => 'default',
	        'controller' => 'index',
	        'action'     => 'index'
	    )
	);

	$router->addRoute('default-index-index', $route);

	
	$route = new Zend_Controller_Router_Route_Static(
	   'dodaj-item',
	    array(
	    	'module'	 => 'default',
	        'controller' => 'article',
	        'action'     => 'add'
	    )
	);

	$router->addRoute('account-item-add', $route);
	

	$route = new Zend_Controller_Router_Route(
    	'rejestracja-pierwsza/:id',
    	array(
    		'id'		 => '',
    		'module'	 => 'account',
	        'controller' => 'registration',
	        'action'     => 'register'
    	)
	);
				
	$router->addRoute('account-registration-register', $route);
	
	
	$route = new Zend_Controller_Router_Route_Static(
	   'logowanie',
	    array(
	    	'module'	 => 'account',
	        'controller' => 'authorization',
	        'action'     => 'login'
	    )
	);

	$router->addRoute('account-authorization-login', $route);
	
	
	$route = new Zend_Controller_Router_Route_Static(
	   'wyloguj',
	    array(
	    	'module'	 => 'account',
	        'controller' => 'authorization',
	        'action'     => 'logout'
	    )
	);

	$router->addRoute('account-authorization-logout', $route);
	
	
	$route = new Zend_Controller_Router_Route_Regex(
		'rejestracja/([0-9]+)/([a-zA-Z0-9-]+)', 
		array(
			'module' 	 => 'account', 
			'controller' => 'registration', 
			'action' 	 => 'activation'
		), 
		array(
			1 => 'id',
			2 => 'code'
		), 
		'rejestracja/%s/%s'
	);
	
	$router->addRoute('account-registration-activation', $route);
	
	
	$route = new Zend_Controller_Router_Route_Regex(
		'produkt/([0-9]+)', 
		array(
			'module' 	 => 'account', 
			'controller' => 'item', 
			'action' 	 => 'display'
		), 
		array(
			1 => 'id'
		), 
		'produkt/%s'
	);
	
	$router->addRoute('account-item-display', $route);
	
	
	$route = new Zend_Controller_Router_Route_Regex(
		'produkt-edytuj/([0-9]+)', 
		array(
			'module' 	 => 'default', 
			'controller' => 'article', 
			'action' 	 => 'edit'
		), 
		array(
			1 => 'id'
		), 
		'produkt-edytuj/%s'
	);
	
	$router->addRoute('account-item-edit', $route);
	
	
	$route = new Zend_Controller_Router_Route_Regex(
		'produkty/([0-9]+)', 
		array(
			'module' 	 => 'account', 
			'controller' => 'item', 
			'action' 	 => 'list'
		), 
		array(
			1 => 'page'
		), 
		'produkty/%s'
	);
	
	$router->addRoute('account-item-list', $route);
	
	/*
	$route = new Zend_Controller_Router_Route(
    	'przykład/:id/:page',
    	array(
    		'id'		 => '',
    		'page'		 => 1,
        	'controller' => 'place',
        	'action'     => 'display'
    	)
	);
				
	$router->addRoute('place-display', $route);
	*/
?>