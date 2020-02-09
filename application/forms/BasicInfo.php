<?php
class Form_BasicInfo extends Zend_Form {
    public function __construct()
    {
        parent::__construct();


        $this->setAttrib('id', 'item');

        $email = new Zend_Form_Element_Text('email');

        $email->setLabel('Email')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addValidators(array(
                array('NotEmpty', true,
                array('messages' => array(
                    'isEmpty' => 'Pleas pass email',
                ))),
                array('EmailAddress', true)
            ))
            ->setAttrib('maxlength', '255');


        $name = new Zend_Form_Element_Text('name');

        $name->setLabel('Name')
            ->setRequired(true)
            ->addValidators(array(
                array('NotEmpty', true, array('messages' => array(
                    'isEmpty' => 'Pleas pass your name',
                )))
            ))
            ->setAttrib('maxlength', '255');

        $address = new Zend_Form_Element_Text('address');

        $address->setLabel('Address')
            ->setRequired(true)
            ->addValidators(array(
                array('NotEmpty', true, array('messages' => array(
                    'isEmpty' => 'Pleas pass your address',
                )))
            ))
            ->setAttrib('maxlength', '255');

        $city = new Zend_Form_Element_Text('city');

        $city->setLabel('City')
            ->setRequired(true)
            ->addValidators(array(
                array('NotEmpty', true, array('messages' => array(
                    'isEmpty' => 'Pleas pass name of your city',
                )))
            ))
            ->setAttrib('maxlength', '255');


        $submit = new Zend_Form_Element_Submit('Save');

        $country = new Zend_Form_Element_Text('country');

        $country->setLabel('Country')
            ->setRequired(true)
            ->addValidators(array(
                array('NotEmpty', true, array('messages' => array(
                    'isEmpty' => 'Pleas pass name of country',
                )))
            ))
            ->setAttrib('maxlength', '255');



        $this->addElements(array($email, $name, $address, $city, $country, $submit));




    }
}