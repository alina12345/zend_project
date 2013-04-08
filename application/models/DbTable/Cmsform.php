<?php

class Application_Model_DbTable_Cmsform extends Zend_Db_Table_Abstract
{
    public $_name = 'tbl_pages';//from pdiary db
    //public $_primary = 'page_id';   
    
    public function getPages()
    {
        $data = $this->fetchAll()->toArray();
        return $data;
    }

    
    public function deletePage($id) 
    {
        $this->delete('page_id=' . (int) $id);
    }
    
    public function getImages()
    {
        $db = new Zend_Db_Table(array('name' => 'tbl_photos')); 
        $data = $db->fetchAll()->toArray();
        return $data;
    }
    
    public function deletePhoto($id) 
    {
        $db = new Zend_Db_Table(array('name' => 'tbl_photos'));
        $db->delete('photo_id=' . (int) $id);
    }
}

