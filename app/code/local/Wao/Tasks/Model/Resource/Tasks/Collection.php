<?php

class Wao_Tasks_Model_Resource_Tasks_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    
    protected function _construct()
    {
        parent::_construct();
        $this->_init('tasks/tasks');
    }
    
    public function readData(){
        echo $this->_data;
    }
}