<?php
class SitemapController extends Zend_Controller_Action
{
	public function init()
	{
		parent::init();
		$contextSwitch = $this->_helper->getHelper('contextSwitch');
        $contextSwitch->addActionContext('index', 'xml')
                      ->initContext();
	}
	
    public function indexAction()
    {

        $this->view->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        echo $this->view->navigation()->sitemap();
    }
}