<?php
class Wao_Files_Block_Adminhtml_Edit extends Mage_Adminhtml_Block_Template implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
   
    public function __construct(){
       
       parent::__construct();
       $this->setTemplate('files/container.phtml');
    }  

    public function getTabLabel(){
        return __('Files');
    }

    public function getTabTitle(){
        return __('Files');
    }

    public function canShowTab(){
        return true;
    }

    public function isHidden(){
        return false;
    }
}