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
        
        return $developers;
    }
    
    public function resetActive($taskId){
        $where = 'id_task = '.$taskId;
        $update = $this->getConnection()->update('wao_developers', array('active'=>1), $where);
        return $taskId;
       
    }
    
    public function getTasksForUser(){
        $id_user = Mage::getSingleton('admin/session')->getUser()->getId();
        $user = Mage::getSingleton('admin/session')->getWorkerRole();
        $select = $this->getConnection()->select();
        if($user == 'admin'){
            $select->from('wao_tasks');
            $this->_select = $select;
            return $this;
        } elseif($user == 'worker'){
            $select->from(array('t'=>'wao_tasks'))
                    ->join(array('d'=>'wao_developers'),'t.id=d.id_task',array())
                    ->where('id_user = ?', $id_user);
            $this->_select = $select;
            return $this;
        } elseif($user == 'manager'){
            $projects = $this->getConnection()->select()
                    ->from('wao_developers')
                    ->where('id_task = ?',0)
                    ->where('id_user = ?', $id_user);
            
            $array = $this->getConnection()->fetchAll($projects);
            $newarray = array();
            foreach($array as $item){
                $newarray[] = $item['id_project'];
            }
           
            $select->from(array('t'=>'wao_tasks'))
                    ->join(array('d'=>'wao_developers'),'t.id = d.id_task',array());
            //$select->where('id_task != ?', 0);
            
            $this->_select = $select;
            $this->addFieldToFilter('id_project',$newarray);
            
            return $this;
        }
        
        return $this;
    }
    
     public function getTasksForProject($id_project){
        $tasks = array();
        $select= $this->getConnection()->select()->from("wao_developers")
                ->where('id_project = ?', $id_project)->where('active = ?', 0);
       
        $result = $this->getConnection()->fetchAll($select);
        foreach($result as $item){
            $tasks[] = $item['id_task'];
        }
        
        return $tasks;
    }
    
    public function getTasksForProjectForUser($id_project){
        $id_user = Mage::getSingleton('admin/session')->getUser()->getId();
        $tasks = array();
        $select= $this->getConnection()->select()->from("wao_developers")
                ->where('id_project = ?', $id_project)->where('id_user = ?', $id_user)->where('active = ?', 0);
               
        $result = $this->getConnection()->fetchAll($select);
        foreach($result as $item){
            $tasks[] = $item['id_task'];
        }
        return $tasks;
    }
    
}