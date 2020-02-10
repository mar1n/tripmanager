<?php
class Form_Passangers extends Zend_Form {
    public function __construct()
    {
        parent::__construct();

        $this->setAttrib('id', 'passangers');

        $title = new Zend_Form_Element_Select('title', array(
            "label" => "Title",
            "required" => true,
        ));
        $title->addMultiOptions(array(
            "Miss" => "Miss",
            "Mr" => "Mr",
        ));


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