<?php
class Form_Passangers extends Zend_Form {
    public function __construct()
    {
        parent::__construct();


        $this->setAttrib('id', 'item');

        $email = new Zend_Form_Element_Text('email');

        $email->setLabel('Email')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->setAttrib('maxlength', '255');


        $name = new Zend_Form_Element_Text('name');

        $name->setLabel('Name')
            ->setRequired(true)
            ->setAttrib('maxlength', '255');

        $address = new Zend_Form_Element_Text('address');

        $address->setLabel('Address')
            ->setRequired(true)
            ->setAttrib('maxlength', '255');

        $city = new Zend_Form_Element_Text('city');

        $city->setLabel('City')
            ->setRequired(true)
            ->setAttrib('maxlength', '255');


        $submit = new Zend_Form_Element_Submit('Save');

        $country = new Zend_Form_Element_Text('country');

        $country->setLabel('Country')
            ->setRequired(true)
            ->setAttrib('maxlength', '255');



        $this->addElements(array($email, $name, $address, $city, $country, $submit));




    }
}