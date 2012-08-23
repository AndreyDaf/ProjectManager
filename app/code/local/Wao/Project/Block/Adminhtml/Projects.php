<?php

class Wao_Project_Block_Adminhtml_Projects extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {
        $this->_addButtonLabel = __('Add New Project');
        $this->_blockGroup = 'project';
        $this->_controller = 'adminhtml_projects';
        $this->_headerText = __('Projects');
    }
}

?>
