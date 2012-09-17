<?php

class Wao_Project_Block_Adminhtml_Project extends Mage_Adminhtml_Block_Widget_Container
{

    public function __construct()
    {
        parent::__construct();
        $this->_headerText = __('Project');
        
        $this->setTemplate('widget/form/container.phtml');
        
        $this->_addButton('projects', array(
            'label'     => 'All projects',
            'onclick'   => 'setLocation(\'' . $this->getUrl('*/*/index') .'\')',
            'class'     => 'back',
        ));
    }
    
}

?>