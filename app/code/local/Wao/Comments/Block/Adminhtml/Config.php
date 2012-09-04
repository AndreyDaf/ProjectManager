<?php
class Wao_Comments_Block_Adminhtml_Config extends Mage_Adminhtml_Block_Template
											implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
	public function __construct(){
		$this->setTemplate('comments/content.phtml');
		parent::__construct();
	}

	//Label to be shown in the tab
	public function getTabLabel(){
		return Mage::helper('core')->__('Comments');
	}

	public function getTabTitle(){
		return Mage::helper('core')->__('Comments');
	}

	public function canShowTab(){
		return true;
	}

	public function isHidden(){
		return false;
	}
}  
