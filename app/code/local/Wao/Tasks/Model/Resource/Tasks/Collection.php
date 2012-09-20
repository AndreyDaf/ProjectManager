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
    
        
    public function getTasksForUser(){
        $id_user = Mage::getSingleton('admin/session')->getUser()->getId();
        $user = Mage::getSingleton('admin/session')->getWorkerRole();
        $connect = $this->getConnection()->select()
                ->from(array('d'=>'wao_developers'),array('id_project','id_user'))
                ->join(array('t'=>'wao_tasks'),
                        't.id=d.id_task',
                        array('id','title','start_date','end_date','status'))
                ->join(array('p'=>'wao_projects'),'d.id_project=p.id',array('name'));
        
        
        $this->_select = $connect;
        switch($user){
            case 'admin':
                
                return $this;
                break;
            case 'manager':
                $progects = Mage::getModel('tasks/projects')
                    ->getCollection()->getProjectsIdsForManager();
                $this->addFieldToFilter('id_project',$progects);
                return $this;
                break;
            default:
                $tasks = $this->getTasksIdsForWorker($id_user);
                $this->addFieldToFilter('t.id',$tasks);
                return $this;
        }
        
        
    }
    
    public function getTasksIdsForWorker($id_user){
        $tasks_select = $this->getConnection()->select()
                    ->from('wao_developers')
                    ->where('id_user = ?', $id_user);
        $tasks = $this->getConnection()->fetchAll($tasks_select);
        $tasksIds = array();
        foreach($tasks as $item){
            $tasksIds[] = $item['id_task'];
        }
        return $tasksIds;
    }
}