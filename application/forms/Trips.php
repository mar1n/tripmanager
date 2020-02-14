<?php
class Form_Trips extends Zend_Form {
    public function __construct()
    {
        parent::__construct();

        $this->setAttrib('id', 'trips');

        $depaAirport = new Zend_Form_Element_Text('departure_airport');

        $depaAirport->setLabel('Departure airport')
            ->setRequired(true)
            ->setAttrib('maxlength', '3');


        $destAirport = new Zend_Form_Element_Text('destination_airport');

        $destAirport->setLabel('Destination airport')
            ->setRequired(true)
            ->setAttrib('maxlength', '3');

        $depaDate = new Zend_Form_Element_Text('departure_dateTime');

        $depaDate->setLabel('Departure Date')
            ->setRequired(true)
            ->setAttrib('maxlength', '255');

        $arriDate = new Zend_Form_Element_Text('arrival_dateTime');

        $arriDate->setLabel('Arrival Date')
            ->setRequired(true)
            ->setAttrib('maxlength', '255');


//        $checkbox->setLabel('A checkbox');
//        //$checkbox->setUseHiddenElement(true);
//        $checkbox->setCheckedValue("good");
//        $checkbox->setUncheckedValue("bad");

        $passanger = new Model_Passangers();

        $multicheckboxElement = new Zend_Form_Element_MultiCheckbox('passangers');
        foreach ($passanger->fetchAll() as $name) {
            $asdas = "$name->first_name $name->surname";
            $multicheckboxElement->addMultiOption($name['id'],$asdas);
        }
//
//        $multicheckboxElement->addMultiOption(2,'text-2');
//        $multicheckboxElement->addMultiOption(3,'text-3');
//        $multicheckboxElement->addMultiOption(4,'text-4');
        $answer = new Zend_Form_Element_Checkbox('answer');
        for($i = 0; $i <= 5; $i++){


        }


        $submit = new Zend_Form_Element_Submit('Save');

        $this->addElements(array($depaAirport, $destAirport, $depaDate, $arriDate,$multicheckboxElement, $submit));

    }
}