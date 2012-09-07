<?php
class Wao_Tasks_Model_Tasks extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('tasks/tasks');
    }
    
    public function getUserToArray(){
        $collection = Mage::getModel('admin/user')->getCollection()->getData();
        $user_values = array();
        $i = 0;
        foreach($collection as $user){
            $value = $user["user_id"];
            $label = $user["firstname"]." ".$user["lastname"];
            $user_values[$i]['value'] = $value;
            $user_values[$i]['label'] = $label;
            $i++;
        }
       
        
        return $user_values;
    }
}