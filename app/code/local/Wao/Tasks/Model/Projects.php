<?php
class Wao_Tasks_Model_Projects extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('tasks/projects');
    }
}