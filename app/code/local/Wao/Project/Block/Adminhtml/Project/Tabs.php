<?php

class Wao_Project_Block_Adminhtml_Project_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct() {
        parent::__construct();
        $this->setId('project_tabs');
    }

    protected function _beforeToHtml() {
        $this->addTab('currentProject', array(
            'label' => __('Project'),
            'title' => __('Current project'),
            'content' => $this->getLayout()
                    ->createBlock('project/adminhtml_project_tab_project', 'project.current')
                    ->toHtml()
        ));

        return parent::_beforeToHtml();
    }

}

?>