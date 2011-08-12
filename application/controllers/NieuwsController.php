<?php
class NieuwsController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $table = new Cryptography_Model_DbTable_News();
        $news = $table->findAll();
        $this->view->news = $news;
    }
    
    public function leesAction()
    {
        $id = (int) $this->getRequest()->getParam('id', 0);
        if($id > 0)
        {
            $table = new Cryptography_Model_DbTable_News();
            $post = $table->getPost($id);
            $this->view->post = $post;
        }
    }
}