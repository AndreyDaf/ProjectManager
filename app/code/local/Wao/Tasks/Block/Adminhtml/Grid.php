<?php
class Wao_Tasks_Block_Adminhtml_Grid extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {

     $this->_controller = 'adminhtml_task';
     $this->_blockGroup = 'tasks';

     $this->_headerText = __('Tasks editor');

     $this->_addButtonLabel = __('Add task');
     parent::__construct();
     }
     
    
}