<?php
class Wao_Tasks_Block_Adminhtml_Task_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{
   
    public function __construct()
   {
        $id = $this->getRequest()->getParam('id');
        parent::__construct();
        $this->_objectId = 'id';

        $this->_blockGroup = 'tasks';

        $this->_controller = 'adminhtml_task';

        $this->_updateButton('save', 'label',__('Save task'));
        $this->_updateButton('delete', 'label', __('Delete task'));
       
        if(Mage::helper('tasks')->getUserRole() == 3){
         $this->_removeButton('save');
         $this->_removeButton('delete');
         $this->_removeButton('reset');
          $this->_addButton('submit', array(
            'label'     => __('Submit'),//
            'onclick'   => 'setLocation(\'' . $this->getUrl('*/*/submit/',array('id'=>$id))  . '\')',
        ));
          $this->_updateButton('back', 'onclick', 'setLocation(\'' . $_SERVER['HTTP_REFERER'] .'\')');
        
        }
       
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