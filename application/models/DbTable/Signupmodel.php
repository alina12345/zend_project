<?php

class Application_Model_DbTable_Signupmodel extends Zend_Db_Table_Abstract
{
    protected $_name = 'tbl_user';
    
    function checkUnique($username)
    {
        $select = $this->_db->select()
                       ->from($this->_name,array('username'))
                       ->where('username=?',$username);
        $result = $this->getAdapter()->fetchOne($select);
        if ($result)
        {
            return true;
        }
        return false;
    }
}