<?php
class Wao_Tasks_Block_Adminhtml_Grid extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {

     $this->_controller = 'adminhtml_task';
     
     $this->_blockGroup = 'tasks';

     $this->_headerText = __('Tasks editor');
     $this->_addButtonLabel = __('Add New Tasks');
     parent::__construct();
     
//     if(Mage::helper('tasks')->getUserRole() == 3){
//         $this->_removeButton('add');
//     }
     }
     
    
}