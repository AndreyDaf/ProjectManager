<?php

class Wao_Statuses_Block_Adminhtml_Statuses extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        
        $this->_controller = 'adminhtml_statuses';
        $this->_blockGroup = 'statuses';
        $this->_headerText = Mage::helper('adminhtml')->__('Statuses List');
        parent::__construct();
        
        
        
        
//        $this->_controller = 'adminhtml_index';
//        $this->_blockGroup = 'statuses';
//        $this->_headerText = Mage::helper('statuses')->__("All statuses");
        //$this->_addButtonLabel = Mage::helper('feedback')->__('Add Item');
        //parent::__construct();
    }
}
