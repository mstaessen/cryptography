<?php
class Cryptography_Form_TwoNumbers extends Zend_Form
{
    public function __construct($options = null)
    {
        parent::__construct($options);
        
        $firstNumber = new Zend_Form_Element_Text('firstNumber');
        $firstNumber->setLabel('Getal 1');
        $firstNumber->addValidator(new Zend_Validate_Int());
        $firstNumber->addValidator(new Zend_Validate_GreaterThan(-1));
        
        $secondNumber = new Zend_Form_Element_Text('secondNumber');
        $secondNumber->setLabel('Getal 2');
        $secondNumber->addValidator(new Zend_Validate_Int());
        $secondNumber->addValidator(new Zend_Validate_GreaterThan(-1));
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Bereken!');
        
        $this->addElements(array($firstNumber, $secondNumber, $submit));
        $this->setAttrib('class', 'form-input');
    }
}