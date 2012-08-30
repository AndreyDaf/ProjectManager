<?php

class Wao_Uploader_Block_Adminhtml_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id'      => 'edit_form',
            'action'  => $this->getUrl('*/*/validate'),
            'method'  => 'post',
            'enctype' => 'multipart/form-data'
        ));
        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('Upload files')));
        
        
        $fieldset->addField(Mage_ImportExport_Model_Import::FIELD_NAME_SOURCE_FILE, 'file', array(
            'name'     => Mage_ImportExport_Model_Import::FIELD_NAME_SOURCE_FILE,
            'label'    => __('Select File to Import'),
            'title'    => __('Select File to Import'),
            'required' => true
        ));
        

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
