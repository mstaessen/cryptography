<?php
class Cryptography_Model_DbTable_News extends Zend_Db_Table
{
    protected $_name = 'news';
    protected $_primary = 'id';
    public function findAll ()
    {
        $select = $this->select()->order('date DESC');
        return $this->fetchAll($select);
    }
    public function findLatest ()
    {
        $select = $this->select()
            ->order('date DESC')
            ->limit(5, 0);
        return $this->fetchAll($select);
    }
    public function getPost ($id)
    {
        $select = $this->select()->where('id = ?', (int) $id);
        return $this->fetchRow($select);
    }
}