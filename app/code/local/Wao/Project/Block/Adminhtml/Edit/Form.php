<?php

class Wao_Project_Block_Adminhtml_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }
    
    protected function _prepareForm() {
        $project = Mage::registry('current_project');
        $form = new Varien_Data_Form();
        $fieldset = $form->addFieldset('edit_project', array(
            'legend' => __('Project Details')
                ));
        
        if (Mage::registry('new_project')) {
            $dateFormatIso = 'dd.MM.yyyy HH:mm:ss';
        } else {
            $dateFormatIso = 'dd.MM.yyyy 00:00:00';
        }
        
        if ($project->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
                'required' => true
            ));
        }

        $fieldset->addField('name', 'text', array(
            'name' => 'name',
            'label' => __('Title'),
            'maxlength' => '250',
            'required' => true,
        ));
        
        $fieldset->addField('description', 'editor', array(
            'name'      => 'description',
            'label'     => __('Contents'),
            'style'     => 'width: 600px; height: 350px;',
            'required'  => true,
            'wysiwyg'   => true
        ));

        $fieldset->addField('repository', 'text', array(
            'name' => 'repository',
            'label' => __('Repository'),
            'maxlength' => '250',
        ));

        $fieldset->addField('start_date', 'date', array(
            'name' => 'start_date',
            'label' => __('Start date'),
            'style' => 'width: 120px;',
            'maxlength' => '19',
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'input_format' => Varien_Date::DATETIME_INTERNAL_FORMAT,
            'format' => $dateFormatIso,
            'required' => true,
        ));

        $fieldset->addField('end_date', 'date', array(
            'name' => 'end_date',
            'label' => __('End date'),
            'style' => 'width: 120px;',
            'maxlength' => '19',
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'input_format' => Varien_Date::DATETIME_INTERNAL_FORMAT,
            'format' => $dateFormatIso,
            'required' => true,
        ));

        if (Mage::helper('core')->isModuleEnabled('Wao_Statuses') &&
            Mage::helper('core')->isModuleOutputEnabled('Wao_Statuses')) {

            $allStatuses = array();
            $statuses = Mage::getModel('statuses/status')->getCollection()->getData();
            
            foreach ($statuses as $status) {
                
                $allStatuses[$status['status']] = $status['status'];
            }
            
            $fieldset->addField('status', 'select', array(
                'name' => 'status',
                'label' => __('Status'),
                'style' => 'width: 120px;',
                'maxlength' => '100',
                'options' => $allStatuses,
                'required' => true,
            ));
        }

        $form->setMethod('post');
        $form->setUseContainer(true);
        $form->setId('edit_form');
        $form->setAction($this->getUrl('*/*/save'));
        $form->setValues($project->getData());

        $this->setForm($form);
        
        return parent::_prepareForm();
    }
}
?>
