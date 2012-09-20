<?php
class Wao_Tasks_Block_Adminhtml_Grid extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public $roleName;
    
    public function __construct() {
     $this->roleName = Mage::getSingleton('admin/session')->getWorkerRole();
     $this->_controller = 'adminhtml_task';
     $this->_blockGroup = 'tasks';
     $this->_headerText = __('Tasks editor');
     $this->_addButtonLabel = __('Add New Task');
     parent::__construct();
     
     if($this->roleName != 'manager'){
         $this->_removeButton('add');
     }
     }
     
    
}