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
        //$collection = Mage::getModel('admin/user')->getCollection()->getData();
        
       
        $userId = '3';
        $select = $this->getConnection()
                ->select()
                ->from(array('p' => 'admin_role'))
                ->join(array('d' => 'admin_user'), 'p.user_id = d.user_id', array());
                //->where('user_id = 3');
        
        
        $this->_select = $select;
        
        return $this;
        
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