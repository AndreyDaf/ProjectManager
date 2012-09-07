<?php
class Wao_Tasks_Block_Adminhtml_Task_Edit_Tab_View extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
    {
        parent::__construct();
        $this->setTemplate('tasks/view.phtml');
        
    }
    
    public function getTasksData(){

        if(Mage::helper('tasks')->isModuleEnabled('Wao_Project')){
            $projects = Mage::getModel('tasks/projects')->getCollection()->getProjectNames();
        }
        if(Mage::helper('tasks')->isModuleEnabled('Wao_Statuses')){
            $statuses = Mage::getModel('statuses/status')->getCollection();

        }
        
        $tasks_data = Mage::registry('tasks_data')->getData();
        if(Mage::helper('tasks')->isModuleEnabled('Wao_Project')){
            $projectId = Mage::getModel('tasks/projects')->getCollection()->getProjectId($tasks_data['id']);
            $projectName = Mage::getModel('tasks/projects')->getCollection()->getProjectName($projectId);
        }
        $developers = Mage::getModel('tasks/developers')->getCollection()->getUsers($tasks_data['id']);
        $data = $tasks_data;
        $data['project_name'] = $projectName;
       
        return $data;
    }
    
    
}