<?php
class Wao_Tasks_Block_Adminhtml_Task_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{
  
    public $roleName;
    
    public function __construct() { 
        $this->roleName = Mage::getSingleton('core/session')->getWorkerRole();
        $myRequest = Mage::getSingleton('core/session')->getMyRequest();
        $id = $this->getRequest()->getParam('id');
        parent::__construct();
        $this->_objectId = 'id';

        $this->_blockGroup = 'tasks';

        $this->_controller = 'adminhtml_task';

        $this->_updateButton('save', 'label',__('Save task'));
        $this->_updateButton('delete', 'label', __('Delete task'));
        $this->_updateButton('back', 'onclick', 'setLocation(\'' . $myRequest['url'] .'\')');
        
        if($this->roleName == 'manager'){
         $this->_removeButton('save');
         $this->_removeButton('delete');
         $this->_removeButton('reset');
          $this->_addButton('submit', array(
            'label'     => __('Send to check'),//
            'onclick'   => 'setLocation(\'' . $this->getUrl('*/*/submit/',array('id'=>$id))  . '\')',
        )); 
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