<?php

class Wao_Statuses_Model_Mysql4_Status extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        
        $this->_init('statuses/status', 'id');
    } 
}