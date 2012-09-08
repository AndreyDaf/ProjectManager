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
    
    public function getUserToArray(){

        $select = $this->getConnection()
                ->select()
                ->from('admin_role')->where('role_type = ?','U')->where('parent_id != ?', '1')->where('parent_id != ?', '3');
        
        $this->_select = $select;

        $user_values = array();
        $i = 0;
        foreach($this->getData() as $user){
            $value = $user["user_id"];
            $label = $user["role_name"];
            $user_values[$i]['value'] = $value;
            $user_values[$i]['label'] = $label;
            $i++;
        }
        
        
        return $user_values;
    }
}