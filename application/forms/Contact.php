<?php

class Cryptography_Form_Contact extends Zend_Form
{
    public function __construct ($options = null)
    {
        parent::__construct($options);
        $this->setName('contact');

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Naam');
        $name->setRequired();
        $name->addFilter(new Zend_Filter_StringTrim());
        
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('e-mail');
        $email->setRequired();
        $email->addFilter(new Zend_Filter_StringTrim());
        $email->addValidator(new Zend_Validate_EmailAddress());
        
        $text = new Zend_Form_Element_Textarea('text');
        $text->setLabel('Bericht');
        $text->setRequired();
        $text->addFilter(new Zend_Filter_StringTrim());
        
        $service = new Zend_Captcha_ReCaptcha();
        $service->setPrivkey('6LdKD8cSAAAAAAWR7zBPCXOzWtV1GeJpd3sy7zFc');
        $service->setPubkey('6LdKD8cSAAAAAA0FO39gBk74kSW55wJoVWrx3pi6');
        
        $captcha = new Zend_Form_Element_Captcha('captcha', array('captcha' => $service));
        $captcha->setLabel('Anti-SPAM');
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Verzenden');
        $submit->setAttrib('id', 'submitbutton');
        
        $this->addElements(array($name, $email, $text, $captcha, $submit));
    }
}