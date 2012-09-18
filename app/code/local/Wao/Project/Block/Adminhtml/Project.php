<?php

class Wao_Project_Block_Adminhtml_Project extends Mage_Adminhtml_Block_Widget_Container
{

    public function __construct()
    {
        parent::__construct();
        
        $projectId = $this->getRequest()->getParam('pr');
        $project = Mage::getModel('project/project')->load($projectId);
        
        $this->_headerText = $project->getName();
        $this->setTemplate('widget/form/container.phtml');
        
        $this->_addButton('projects', array(
            'label'     => __('All projects'),
            'onclick'   => 'setLocation(\'' . $this->getUrl('*/*/index') .'\')',
            'class'     => 'back',
        ));
    }
    
}

?>