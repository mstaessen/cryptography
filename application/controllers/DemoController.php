<?php
class DemoController extends Zend_Controller_Action
{
    public function indexAction()
    {
    }
    
    public function rot13Action()
    {
        $form = new Cryptography_Form_Input();
        $this->view->form = $form;
        if($this->getRequest()->isPost())
        {
            $input = $this->getRequest()->getPost('input');
            $output = str_rot13($input);
            $this->view->output = $output;
            $form->populate($this->getRequest()->getPost());
        }
    }
    
//    public function sdesAction()
//    {
//        $permutation = array(2, 4, 1, 6, 3, 9, 0, 8, 7, 5);
//        $string10 = "1010000010";
//        echo "<pre>";
//        echo 'isValidBinary$trueCase:       ' .
//         Model_SDES::isValidBinary("0110100110") . "\n";
//        echo 'isValidBinary$falseCase:      ' .
//         Model_SDES::isValidBinary("0123456789") . "\n";
//        echo 'isValidPermutation$trueCase:  ' .
//         Model_SDES::isValidPermuation(array(2, 4, 1, 3, 0)) . "\n";
//        echo 'isValidPermutation$falseCase: ' .
//         Model_SDES::isValidPermuation(array(2, 4, 1, 3)) . "\n";
//        echo 'permutate$validCase:          ' .
//         Model_SDES::permutate($string10, $permutation) . "\n";
//        try {
//            echo 'permutate$invalidCase:        ' .
//             Model_SDES::permutate("10100010", $permutation) . "\n";
//        } catch (Exception $e) {
//            echo 'permutate$invalidCase failed';
//        }
//        echo "</pre>";
//    }
    
    public function ggdAction()
    {
        $form = new Cryptography_Form_TwoNumbers();
        $this->view->form = $form;
        if($this->getRequest()->isPost()) {
        	if($form->isValid($this->getRequest()->getPost()))
        	{
	            $firstNumber = $this->getRequest()->getPost('firstNumber');
	            $secondNumber = $this->getRequest()->getPost('secondNumber');
	            $output = Cryptography_Model_RSA::gcd($firstNumber, $secondNumber);
	            $this->view->output = $output;
        	}
	        $form->populate($this->getRequest()->getPost());
        }
    }
    public function phiAction()
    {
        $form = new Zend_Form();
        $number = new Zend_Form_Element_Text('number');
        $number->setLabel('Getal');
        $number->addValidator(new Zend_Validate_Int());
        $number->addValidator(new Zend_Validate_GreaterThan(-1));
        $form->addElement($number);
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Bereken!');
        $form->addElement($submit);
        $this->view->form = $form;
        if($this->getRequest()->isPost())
        {
        	if($form->isValid($this->getRequest()->getPost()))
        	{
	            $number = $this->getRequest()->getPost('number');
	            $output = Cryptography_Model_RSA::phi($number);
	            $this->view->output = $output;
        	}
            $form->populate($this->getRequest()->getPost());
        }
    }
    
    public function priemfactorenAction()
    {
        $form = new Zend_Form();
        $number = new Zend_Form_Element_Text('number');
        $number->setLabel('Getal');
        $number->addValidator(new Zend_Validate_Digits());
        $form->addElement($number);
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Bereken!');
        $form->addElement($submit);
        $this->view->form = $form;
        if($this->getRequest()->isPost())
        {
            $formData = $this->getRequest()->getPost();
            if($form->isValid($formData))
            {
                $number = $this->getRequest()->getPost('number');
                $output = Cryptography_Model_RSA::findPrimeFactors($number);
                $this->view->output = $output;
            }
            $form->populate($formData);
        }
    }
    
    public function rsaAction()
    {
        $encryptionForm = new Cryptography_Form_RSA();
        $decryptionForm = new Cryptography_Form_RSA();
        $encryptionForm->getElement('submit')->setLabel('versleutelen');
        $encryptionForm->getElement('key')->setLabel('e');
        $decryptionForm->getElement('submit')->setLabel('ontcijferen');
        $decryptionForm->getElement('key')->setLabel('d');
        $this->view->encryptionForm = $encryptionForm;
        $this->view->decryptionForm = $decryptionForm;
        if($this->getRequest()->isPost())
        {
            $formData = $this->getRequest()->getPost();
            $method = $this->getRequest()->getPost('submit', null);
            // encryption            if($method == 'versleutelen')
            {
                if($encryptionForm->isValid($formData))
                {
                    $encrypted = Cryptography_Model_RSA::encryption($formData['input'], 
                    $formData['n'], $formData['key']);
                    $decryptionForm->getElement('input')->setValue($encrypted);
                    $decryptionForm->getElement('n')->setValue($formData['n']);
                }
                else
                {
                    $encryptionForm->populate($formData);
                }
            } // decryption            elseif($method == 'ontcijferen')
            {
                if($decryptionForm->isValid($formData))
                {
                    $decrypted = Cryptography_Model_RSA::decryption($formData['input'], 
                    $formData['n'], $formData['key']);
                    $encryptionForm->getElement('input')->setValue($decrypted);
                    $encryptionForm->getElement('n')->setValue($formData['n']);
                }
                $decryptionForm->populate($formData);
            }
            else 
           	{
                die("What are you doing?!");
            }
        }
    }
    
    public function md5Action ()
    {
        $form = new Cryptography_Form_Input();
        $this->view->form = $form;
        if($this->getRequest()->isPost())
        {
            $input = $this->getRequest()->getPost('input');
            $output = md5($input);
            $this->view->output = $output;
            $form->populate($this->getRequest()->getPost());
        }
    }
    
    public function sha1Action ()
    {
        $form = new Cryptography_Form_Input();
        $this->view->form = $form;
        if($this->getRequest()->isPost())
        {
            $input = $this->getRequest()->getPost('input');
            $output = sha1($input);
            $this->view->output = $output;
            $form->populate($this->getRequest()->getPost());
        }
    }
}