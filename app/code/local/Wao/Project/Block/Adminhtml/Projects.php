<?php

class Wao_Project_Block_Adminhtml_Projects extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_addButtonLabel = __('Add New Project');
        $this->_blockGroup = 'project';
        $this->_controller = 'adminhtml_projects';
        $this->_headerText = __('Projects');
        
        parent::__construct();
        
        $roleId = $this->helper('project/data')->getUserRoleId();
        
        if ($roleId != 1 && $roleId != 3) {
            $this->_removeButton('add');
        }
    }
}

?>
