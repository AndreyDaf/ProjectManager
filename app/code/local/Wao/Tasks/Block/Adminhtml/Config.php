<?php
class Wao_Tasks_Block_Adminhtml_Config extends Mage_Adminhtml_Block_Widget_Grid_Container implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    public function __construct(){
        //$this->setTemplate('tasks/list.phtml');
        $this->_controller = 'adminhtml_view';
        $this->_blockGroup = 'tasks';
        $this->_headerText = __('View task');
        parent::__construct();
        $this->_removeButton('add');
    }

    public function getTabLabel(){
        return __('Tasks');
    }

    public function getTabTitle(){
        return __('Tasks');
    }

    public function canShowTab(){
        return true;
    }

    public function isHidden(){
        return false;
    }
}