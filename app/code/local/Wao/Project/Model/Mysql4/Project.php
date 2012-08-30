<?php
class Wao_Project_Model_Mysql4_Project extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('project/project', 'id');
    }
}