<?php

class Form_Contact extends Zend_Form
{
    public function __construct($options = null)
    {
        parent::__construct($options);
        $this->setName('contact_us');

        $firstName = new Zend_Form_Element_Text('imie');
        $firstName->setLabel('Imię')
        		  ->setAttrib('id', 'test')
        		  ->setAttrib('class', 'required')
                  ->addValidators(array(
            					array('NotEmpty', true, array('messages' => array(
                					  'isEmpty' => 'Proszę podać Imię.',
            					)))	
         	  				  )) ;

       
           
        $Subject = new Zend_Form_Element_Text('subject');
        $Subject  ->setLabel('Temat')
                  ->setAttrib('class', 'required')
                  ->addValidators(array(
            					array('NotEmpty', true, array('messages' => array(
                					  'isEmpty' => 'Proszę podać Temat.',
            					)))	
         	  				  )) ;

      

        $telefon = new Zend_Form_Element_Text('telefon');
        $telefon->setLabel('Telefon')
                ->setAttrib('class', 'required')
                ->addValidators(array(
            					array('NotEmpty', true, array('messages' => array(
                					  'isEmpty' => 'Proszę podać Telefon.',
            					)))	
         	  				  )) ;

        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email')
              ->addFilter('StringToLower')
              ->setAttrib('class', 'required email')
              ->setRequired(true)
              ->addValidators(array(
            					array('NotEmpty', true, array('messages' => array(
                					  'isEmpty' => 'Proszę podać Email.',
            					)))	
         	  				  )) 
              ->addValidator('EmailAddress');

        

        $wiadomosc = new Zend_Form_Element_Textarea('wiadomosc');
        $wiadomosc->setLabel('Wiadomość')
                  ->setRequired(true)
                  ->addFilter('StripTags')
	         	  ->setAttrib("rows", 10)
		          ->setAttrib("cols", 30)
		          ->setAttrib('class', 'required')
                  ->addValidators(array(
            					array('NotEmpty', true, array('messages' => array(
                					  'isEmpty' => 'Proszę podać Wiadomość.',
            					)))	
         	  				  )) ;

       

         
         // tworzymy obiekt Zend_Captcha_Image  
       /*  $captchaImage = new Zend_Captcha_Image('captchaImg');
         $captchaImage->setFont('./fonts/arial.ttf') // pełna ścieżka do czcionki, jaka ma zostać użyta
			          ->setImgDir('./images/captcha') // pełna ścieżka do katalogu gdzie ma zostać wygenerowany obrazek
			          ->setWordlen(1) // ilość znaków w kodzie captcha
			          ->setWidth(100) // szerokość obrazka
			          ->setHeight(60) // wysokość obrazka
			          ->generate();
        
         // tworzymy właściwy element formularza
         $captcha = new Zend_Form_Element_Captcha('captcha', array('captcha' => $captchaImage));  
         $captcha->setLabel('Przepisz kod z obrazka widoczny poniżej:'); */
         
         
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Wyślij');

        $this->addElements(array( $firstName, $Subject, $email, $telefon, $wiadomosc,/* $captcha,*/ $submit));

        $this->setMethod('post');
        $this->setAttrib('id', 'commentForm');
        $this->setAction(Zend_Controller_Front::getInstance()->getBaseUrl().'/contact');

    }
}

