<?php
class Wao_Tasks_Model_Resource_Projects_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('tasks/projects');
    }
    
    public function getProjectNames(){
        if(Mage::getSingleton('admin/session')->getWorkerRole() == 'manager'){
            $id_user = Mage::getSingleton('admin/session')->getUser()->getId();
            $projects = $this->getConnection()->select()
                        ->from('wao_developers')
                        ->where('id_task = ?',0)
                        ->where('id_user = ?', $id_user);

            $array = $this->getConnection()->fetchAll($projects);
            $newarray = array();
            foreach($array as $item){
                $newarray[] = $item['id_project'];
            }
            $collection = $this->addFieldToFilter('id',$newarray)->getData();
            
        }
        $res = array(
            array(
                'value' => '',
                'label' => __('-- Please Select --')
            )
        );
        foreach ($collection as $value) {
            $res[] = array(
               'value' => $value['id'],
               'label' => $value['name']
            );
            
        }
        return $res;
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
        } else {
            return false;
        }
    }
    
    public function getProjectsIdsForManager(){
        $id_user = Mage::getSingleton('admin/session')->getUser()->getId();
        $projects_select = $this->getConnection()->select()
                    ->from('wao_developers')
                    ->where('id_user = ?', $id_user);
        $projects = $this->getConnection()->fetchAll($projects_select);
        $projectsIds = array();
        foreach($projects as $item){
            $projectsIds[] = $item['id_project'];
        }
        return $projectsIds;
    }
}