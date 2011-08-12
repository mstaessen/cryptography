<?php
class Cryptography_Form_RSA extends Zend_Form
{
    public function __construct($options = null)
    {
        parent::__construct($options);
        
        $n = new Zend_Form_Element_Text('n');
        $n->setLabel('n');
        $n->addValidator(new Zend_Validate_Int());
        $n->setRequired(true);
        
        $key = new Zend_Form_Element_Text('key');
        $key->addValidator(new Zend_Validate_Int());
        $key->setRequired(true);
        
        $input = new Zend_Form_Element_Textarea('input');
        $input->setLabel('Invoer');
        
        $submit = new Zend_Form_Element_Submit('submit');
        
        $this->addElements(array($n, $key, $input, $submit));
        $this->setAttrib('class', 'form-input');
    }
}