<?php

class Wao_Project_Block_Adminhtml_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'project';
        $this->_mode = 'edit';
        $this->_controller = 'adminhtml';
        
        $project_id = (int)$this->getRequest()->getParam($this->_objectId);
        $project = Mage::getModel('project/project')->load($project_id);
        Mage::register('current_project', $project);
    }
 
    public function getHeaderText()
    {   
        $project = Mage::registry('current_project');
        if ($project->getId()) {
            return __('Edit project') . ' "' . $this->escapeHtml($project->getName()) . '"';
        } else {
            return __('Add new project');
        }
    }
}

?>
