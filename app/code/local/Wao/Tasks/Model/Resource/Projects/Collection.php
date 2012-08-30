<?php
class Wao_Tasks_Model_Resource_Projects_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('tasks/projects');
    }
    
    public function getProjectNames(){
        
        $collection = $this->getData();
        
        $projects = array();
        $projects[''] = "-- Выберите --";
        foreach($collection as $pro){
            $id = $pro['id'];
            $projects[$id] = $pro['name'];
        }
        
        return $projects;
    }
    
    public function getProjectId($task_id){
        $select= $this->getConnection()->select()->from("wao_developers")
                ->where('id_task = ?', $task_id)->where('active = ?', 0);
       
       $result = $this->getConnection()->fetchAll($select);
        if($result){
            $data = $result[0]['id_project'];
            return $data;
        }
        
        else {
                return false;
            }
    }
    
    public function getProjectName($id){
        $select= $this->getConnection()->select()->from("wao_projects")
                ->where('id = ?', $id);
       
       $result = $this->getConnection()->fetchAll($select);
        if($result){
            $data = $result[0]['name'];
            return $data;
        }
        
        else {
                return false;
            }
    }
}