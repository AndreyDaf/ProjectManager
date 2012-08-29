<?php
  
class Wao_Tasks_Block_Adminhtml_Task_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
  {
     public function __construct()
     {
          parent::__construct();
          $this->setId('tasks_tabs');
          $this->setDestElementId('edit_form');
          $this->setTitle(__('Tasks editor'));
      }
      protected function _beforeToHtml()
      {
          $this->addTab('form_section', array(
                   'label' => __('General'),
                   'title' => __('General'),
                   'content' => $this->getLayout()
     ->createBlock('tasks/adminhtml_task_edit_tab_form')
     ->toHtml()
         ));
          
         return parent::_beforeToHtml();
    }
}