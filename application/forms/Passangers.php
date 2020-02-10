<?php
class Form_Passangers extends Zend_Form {
    public function __construct()
    {
        parent::__construct();

        $this->setAttrib('id', 'passangers');

//        $title = new Zend_Form_Element_Multiselect('title');
//
//        $title->setLabel('Title')
//            ->setRequired(true);
//        $title->addMultiOption(array(
//            "Mr" => 1,
//            "Ms" => 2,
//        ));

        $title = new Zend_Form_Element_Select('title', array(
            "label" => "Title",
            "required" => true,
        ));
        $title->addMultiOptions(array(
            "lady" => "Ms",
            "man" => "Mr",
        ));

        //$form->addElement($multi);

        $firstname = new Zend_Form_Element_Text('firstname');

        $firstname->setLabel('First name')
            ->setRequired(true)
            ->setAttrib('maxlength', '255');

        $surname = new Zend_Form_Element_Text('surname');

        $surname->setLabel('Surname')
            ->setRequired(true)
            ->setAttrib('maxlength', '255');

        $passportID = new Zend_Form_Element_Text('passportID');

        $passportID->setLabel('PassportID')
            ->setRequired(true)
            ->setAttrib('maxlength', '255');

        $submit = new Zend_Form_Element_Submit('Save');

        $this->addElements(array($title, $firstname, $surname, $passportID, $submit));

    }
}