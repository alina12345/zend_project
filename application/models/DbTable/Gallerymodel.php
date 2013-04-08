<?php

class Application_Model_DbTable_Gallerymodel extends Zend_Db_Table_Abstract
{
    public $_name = 'tbl_photos';//from pdiary db
    
    
    public function deleteProfile($id) {
        $this->delete('page_id=' . (int) $id);
    }
    
}

