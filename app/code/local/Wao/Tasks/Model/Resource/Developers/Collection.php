<?php
class Wao_Tasks_Model_Resource_Developers_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('tasks/developers');
    }
    
    
    
    
    
    public function getUsers($tasks_id){
        $developers = array();
        $select= $this->getConnection()->select()->from("wao_developers")
                ->where('id_task = ?', $tasks_id)->where('active = ?', 0);
       
        $result = $this->getConnection()->fetchAll($select);
        foreach($result as $item){
            $id = $item['id'];
            $developers[$id] = $item['id_user'];
        }
        //$data = $result[0]['id_project'];
       
        
        return $developers;
    }
    
    public function resetActive($taskId){
        $where = 'id_task = '.$taskId;
        $update = $this->getConnection()->update('wao_developers', array('active'=>1), $where);
        return $taskId;
       
    }
    
    public function getTasksForUser(){
        $id_user = Mage::getSingleton('admin/session')->getUser()->getId();
        $tasks = array();
        $select= $this->getConnection()->select()->from("wao_developers")
                ->where('id_user = ?', $id_user)->where('active = ?', 0);
       
        $result = $this->getConnection()->fetchAll($select);
        foreach($result as $item){
            $id = $item['id'];
            $tasks[$id] = $item['id_task'];
        }
        //$data = $result[0]['id_project'];
       
        
        return $tasks;
    }
}