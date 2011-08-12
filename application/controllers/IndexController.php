<?php

class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
		$table = new Cryptography_Model_DbTable_News();
		$news = $table->findAll();
		$this->view->news = $news;
    }
}