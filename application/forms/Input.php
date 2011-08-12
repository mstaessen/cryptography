<?php
class Cryptography_Form_Input extends Zend_Form
{
    public function __construct($options = null)
    {
        parent::__construct($options);
        
        $input = new Zend_Form_Element_Textarea('input');
        $input->setLabel('Invoer');
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Versleutelen!');
        
        $this->addElements(array($input, $submit));
        $this->setAttrib('class', 'form-input');
    }
}