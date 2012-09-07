<?php

class Wao_Project_Block_Adminhtml_Project_Tab_Project extends Mage_Adminhtml_Block_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('wao/CurrentProject.phtml');
    }

    public function getProject()
    {
        $projectId = $this->getRequest()->getParam('pr');
        $project = Mage::getModel('project/project')->load($projectId);

        return $project;
    }
}

?>
