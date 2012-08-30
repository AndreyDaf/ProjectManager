<?php
  
class Wao_Tasks_Block_Adminhtml_Task_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
  {
     
    public $blockManager = 'tasks/adminhtml_task_edit_tab_form';
    public $blockUser = 'tasks/adminhtml_task_edit_tab_view';
    
    public function __construct()
     {
          parent::__construct();
          $this->setId('tasks_tabs');
          $this->setDestElementId('edit_form');
          $this->setTitle(__('Tasks editor'));
      }
      protected function _beforeToHtml()
      {
          if(Mage::helper('tasks')->getUserRole() == 3){
         
              $block = $this->blockManager;
         } else {$block = $this->blockUser;}
          $this->addTab('form_section', array(
                   'label' => __('General'),
                   'title' => __('General'),
                   'content' => $this->getLayout()
                  ->createBlock($block)->toHtml()
         ));
          
         return parent::_beforeToHtml();
    }
}