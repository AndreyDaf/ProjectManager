<?php

class Wao_Comments_Model_Mysql4_Post extends Mage_Core_Model_Mysql4_Abstract
{
     public function _construct()
    {
        $this->_init('comments/post', 'id');
    }    
}
?>
