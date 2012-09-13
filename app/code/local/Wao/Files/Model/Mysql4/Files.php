<?php

class Wao_Files_Model_Mysql4_Files extends Mage_Core_Model_Mysql4_Abstract
{
     public function _construct()
    {
        $this->_init('files/files', 'id');
    }    
}
?>
