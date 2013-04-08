<?php
class Application_Model_DbTable_Frontmodel extends Zend_Db_Table_Abstract{

     public $_name = 'tbl_pages';
     
    public function getPages($page)
    {   $where = 'alias = "'. $page . '" and page_publish=1';
        // print_r($where);die;
        $data = $this->fetchRow($where);
        
        if($data){
            $data = $data->toArray();
                    return $data;
        }
        return false;
    }
    
}
