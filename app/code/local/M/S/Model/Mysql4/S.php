<?php

class M_S_Model_Mysql4_S extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the s_id refers to the key field in your database table.
        $this->_init('s/s', 's_id');
    }
}