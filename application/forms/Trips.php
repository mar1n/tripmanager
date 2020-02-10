<?php
class Form_Trips extends Zend_Form {
    public function __construct()
    {
        parent::__construct();

        $this->setAttrib('id', 'trips');

        $depaAirport = new Zend_Form_Element_Text('departure airport');

        $depaAirport->setLabel('Departure airport')
            ->setRequired(true)
            ->setAttrib('maxlength', '3');


        $destAirport = new Zend_Form_Element_Text('destination airport');

        $destAirport->setLabel('Destination airport')
            ->setRequired(true)
            ->setAttrib('maxlength', '3');

        $depaDate = new Zend_Form_Element_Text('departure date');

        $depaDate->setLabel('Departure Date')
            ->setRequired(true)
            ->setAttrib('maxlength', '255');

        $arriDate = new Zend_Form_Element_Text('arrival date');

        $arriDate->setLabel('Arrival Date')
            ->setRequired(true)
            ->setAttrib('maxlength', '255');

        $submit = new Zend_Form_Element_Submit('Save');

        $this->addElements(array($depaAirport, $destAirport, $depaDate, $arriDate, $submit));

    }
}