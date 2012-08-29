<?php
class Wao_Tasks_Model_Resource_Statuses extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('tasks/statuses', 'id');
    }
}