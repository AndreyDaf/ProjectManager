<?php
  
class Wao_Tasks_Block_Adminhtml_Task_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
  {
     
    public $blockManager = 'tasks/adminhtml_task_edit_tab_form';
    public $blockUser = 'tasks/adminhtml_task_edit_tab_view';
    public $roleName;
    
    public function __construct()
     {
          parent::__construct();
          $this->setId('tasks_form');
          $this->setDestElementId('edit_form');
          $this->setTitle(__('Tasks editor'));
          
      }
      public function _beforeToHtml()
      {
          $this->roleName = Mage::getSingleton('admin/session')->getWorkerRole();
          if($this->roleName == 'manager'){
            $block = $this->blockManager;
         } else {
             $block = $this->blockUser;
             
             }
         
          $this->addTab('currentTasks', array(
                   'label' => __('General'),
                   'title' => __('General'),
                   'content' => $this->getLayout()
                  ->createBlock($block)->toHtml()
         ));
          $this->setActiveTab('currentTasks');
          
         return parent::_beforeToHtml();
    }
    
    public function addTabAfter($tabId, $tab, $afterTabId)
    {
        $request = $_SERVER['REQUEST_URI'];
        if(!preg_match('/new/',$request)){
            $this->addTab($tabId, $tab);
            $this->_tabs[$tabId]->setAfter($afterTabId);
        }
        
    }
}