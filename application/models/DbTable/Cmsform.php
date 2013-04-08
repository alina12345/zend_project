<?php

class Application_Model_DbTable_Cmsform extends Zend_Db_Table_Abstract
{
    public $_name = 'tbl_pages';//from pdiary db
    
    
    public function deleteProfile($id) {
        $this->delete('page_id=' . (int) $id);
    }
    
//    public function getAlbum($id) {
//        $id = (int) $id;
//        $rowset = $this->select('page_id=' . $id);
//                
//       
//        
//        return $rowset;
//    }

//    public function updateAlbum($id) {
//        $data = array(
//            'page_title' => $page_title,
//            'page_content' => $page_content,
//        );
//        $this->update($data, 'page_id = ' . (int) $id);
//    }
//    
}

