<?php
class Wao_Project_Model_Project extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('project/project');
    }
}