<?php
class Wao_Project_Model_Mysql4_Developers extends Mage_Core_Model_Mysql4_Abstract {
    
    public function _construct()
    {
        $this->_init('project/developers', 'id');
    }
}