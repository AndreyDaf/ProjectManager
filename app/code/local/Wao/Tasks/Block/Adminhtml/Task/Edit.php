<?php
class Wao_Tasks_Block_Adminhtml_Task_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{
   
    public function __construct()
   {
        parent::__construct();
        $this->_objectId = 'id';

        $this->_blockGroup = 'tasks';

        $this->_controller = 'adminhtml_task';

        $this->_updateButton('save', 'label',__('Save task'));
        $this->_updateButton('delete', 'label', __('Delete task'));
       
    }

    
    public function getHeaderText()
    {
        if( Mage::registry('tasks_data')&&Mage::registry('tasks_data')->getId())
         {
              return __('Edit')." - ".$this->htmlEscape(
              Mage::registry('tasks_data')->getTitle()).'<br />';
         }
         else
         {
             return __('Edd task');
         }
    }
    
    
}