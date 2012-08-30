<?php

class Wao_Uploader_Block_Adminhtml_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    
    public function __construct()
    {
        parent::__construct();

        $this->removeButton('back')
            ->removeButton('reset')
            ->_updateButton('save', 'label', $this->__('Check Data'))
            ->_updateButton('save', 'id', 'upload_button')
            ->_updateButton('save', 'onclick', 'editForm.submit();');
    }

    
    protected function _construct()
    {
        parent::_construct();

        //$this->_objectId   = 'import_id';
        $this->_blockGroup = 'uploader';
        $this->_controller = 'adminhtml';
    }

    
    public function getHeaderText()
    {
        return __('Uploader');
    }
}
