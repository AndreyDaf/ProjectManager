<?php
class Wao_Statuses_Block_Adminhtml_Statuses_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        if (Mage::getSingleton('adminhtml/session')->getExampleData())
        {
            $data = Mage::getSingleton('adminhtml/session')->getExamplelData();
            Mage::getSingleton('adminhtml/session')->getExampleData(null);
        }
        elseif (Mage::registry('example_data'))
        {
            $data = Mage::registry('example_data')->getData();
        }
        else
        {
            $data = array();
        }
 
        $form = new Varien_Data_Form(array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
                'method' => 'post',
                'enctype' => 'multipart/form-data',
        ));
 
        $form->setUseContainer(true);
 
        $this->setForm($form);
 
        $fieldset = $form->addFieldset('example_form', array(
             'legend' =>Mage::helper('statuses')->__('Example Information')
        ));
 
        $fieldset->addField('status', 'text', array(
             'label'     => Mage::helper('statuses')->__('Status'),
             'class'     => 'required-entry',
             'required'  => true,
             'name'      => 'status',
             'note'     => Mage::helper('statuses')->__('Status description.')
        ));
 
        $form->setValues($data);
 
        return parent::_prepareForm();
    }
}
