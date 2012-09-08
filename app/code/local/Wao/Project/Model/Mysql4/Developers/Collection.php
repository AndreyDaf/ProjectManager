<?php
class Wao_Project_Model_Mysql4_Developers_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('project/developers');
    }
}