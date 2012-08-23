<?php

class Wao_Statuses_Model_Mysql4_Status_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('statuses/status');
    } 
}