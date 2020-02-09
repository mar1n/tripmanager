<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	//metoda zmieniajca nazwe klas (namesapce nazwa klasy jaka ma byc wczytywana) basePath jest to sciezka ktora jest zdefinowana w publc/index.php z ktorej pobierana jest cala architektura aplikacjia.
	protected function _initAutoload()
	{
		// Add autoloader empty namespace
		$autoLoader = Zend_Loader_Autoloader::getInstance();
		$resourceLoader = new Zend_Loader_Autoloader_Resource(array(
			'basePath' => APPLICATION_PATH,
			'namespace' => '',
			//dodaje przestrzenie nazw odpowiednie dla katalogu oraz funkcjonalno�ci.
			'resourceTypes' => array(
					'form' => array(
					'path' => 'forms/',
					'namespace' => 'Form_',
				),
					'model' => array(
					'path' => 'models/',
					'namespace' => 'Model_'
				),
					'plugin' => array(
					'path' => 'plugin',
					'namespace' => 'Plugin_'
				),
			),
		));
		// Return it so that it can be stored by the bootstrap
		return $autoLoader;
	}
	
	//metoda pomagajaca zapisac dane do bazy danych w kodowaniu utf8
	public function _initDatabase()
    {
        $this->bootstrapDb();
        $db = $this->getResource('db');
        $db->query("SET NAMES 'utf8'");
        $db->query("SET CHARACTER SET 'utf8'");
        return $db;
    }
    
	//metoda inicjujca Doctype czyli typ dokumentu. Deklaracja ta powinna sie pojawic jako pierwszy element kodu XHTML. Informuje ona przegladarke o wersji jezyka(HTML lub XHTML) kodu.


}

