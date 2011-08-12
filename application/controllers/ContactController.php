<?php

class ContactController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $form = new Cryptography_Form_Contact();
        if($this->getRequest()->isPost())
       	{
            $formData = $this->getRequest()->getPost();
            if($form->isValid($formData))
            {
                $mail = new Zend_Mail();
                $mail->setFrom(
                	$form->getValue('email'), 
                	$form->getValue('name')
                );
                $mail->addTo('info@michielstaessen.be', 'Michiel Staessen');
                $mail->setSubject('Reactie Cryptografie');
                $mail->setBodyText($form->getValue('text'));
                $mail->send();
                $this->view->msg = 'Dankjewel voor de feedback. Ik zal zo snel mogelijk proberen antwoorden.';
            } 
            else 
            {
                $this->view->form = $form;
                $form->populate($formData);
            }
        }
        else 
        {
            $this->view->form = $form;
        }
    }
}