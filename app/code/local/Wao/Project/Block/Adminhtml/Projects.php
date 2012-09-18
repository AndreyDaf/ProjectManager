<?php

class Wao_Project_Block_Adminhtml_Projects extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_addButtonLabel = __('Add new project');
        $this->_blockGroup = 'project';
        $this->_controller = 'adminhtml_projects';
        $this->_headerText = __('Projects');
        
        parent::__construct();
        
        $roleName = Mage::getSingleton('admin/session')->getWorkerRole();
        
        if ($roleName != 'manager') {
            $this->_removeButton('add');
        }
    }
}

?>
