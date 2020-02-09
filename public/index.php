<?php
error_reporting(E_ALL);

ini_set('display_errors', 'ON');

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance();

$doctypeHelper = new Zend_View_Helper_Doctype();
$doctypeHelper->doctype('XHTML1_TRANSITIONAL');
/** Zend_Application */
require_once 'Zend/Application.php';

		$front = Zend_Controller_Front::getInstance();
    	//$front->addModuleDirectory('./application');
    	$front->setParam('useDefaultControllerAlways', false);
		
    	include_once ('router.php'); 

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

$application->bootstrap()
            ->run();