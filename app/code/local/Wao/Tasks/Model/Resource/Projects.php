<?php
class Wao_Tasks_Model_Resource_Projects extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('tasks/projects', 'id');
    }
}