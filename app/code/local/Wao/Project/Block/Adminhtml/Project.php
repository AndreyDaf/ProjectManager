<?php

class Wao_Project_Block_Adminhtml_Project extends Mage_Adminhtml_Block_Widget_Container
{

    public function __construct()
    {
        parent::__construct();
        
        $this->setTemplate('wao/ProjectButtons.phtml');
        
        $this->_addButton('projects', array(
            'label'     => 'All projects',
            'onclick'   => 'setLocation(\'' . $this->getUrl('*/*/index') .'\')',
            'class'     => 'back',
        ));
    }
    
}

?>