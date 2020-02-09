<?php 
class Form_PortfolioForm extends Zend_Form {
	
	public function __construct()
	{	
		parent::__construct();

		
		$this->setAttrib('id', 'item' );

		
		$name = new Zend_Form_Element_Text('i_name');
        
		$name->setLabel('Tytuł')
			  ->setRequired(true)
			  ->addFilter('StripTags')
			  ->addValidators(array(
            					array('NotEmpty', true, array('messages' => array(
                					  'isEmpty' => 'Proszę podać nazwę.',
            					)))	
         	  				  )) 
			  ->setAttrib('maxlength', '255');
			  
			  
		$text = new Zend_Form_Element_TextArea('i_text');
        
		$text->setLabel('Treść')
			  ->setRequired(true)
			  ->addValidators(array(
            					array('NotEmpty', true, array('messages' => array(
                					  'isEmpty' => 'Proszę podać treść.',
            					)))	
         	  				  )) 
			  ->setAttrib('maxlength', '255');
			  
			  
		$submit = new Zend_Form_Element_Submit('Zapisz');
	
		
		$this->addElements(array($name, $text, $submit));


		$this->clearDecorators();
		 
		$this->setDecorators(
            array(
                'FormElements',
                'Form'
            )
        );
        
        $this->setElementDecorators(
            array(
                'ViewHelper',
                'Label',
                array('Description', array('tag' => 'span', 'escape' => false)),
                array('Errors', array()),
                array('HtmlTag', array('tag' => 'p'))
            )
        );
        
        
        $submit->setDecorators(
            array(
                'ViewHelper',
                array('HtmlTag', array('tag' => 'p', 'class' => 'buttons'))
            )
        );
        
	}
}

?>