<?php
class Wao_Tasks_Block_Adminhtml_Task_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
   protected function _prepareForm()
   {
        
        $user_values = Mage::getModel('tasks/tasks')->getCollection()->getUserToArray();
        
        if(Mage::helper('tasks')->isModuleEnabled('Wao_Project')){
          $projects = Mage::getModel('tasks/projects')->getCollection()->getProjectNames();
        
        }
        if(Mage::helper('tasks')->isModuleEnabled('Wao_Statuses')){
            $statuses = Mage::getModel('statuses/status')->getCollection()->statusesToArray();
        }
        
       $form = new Varien_Data_Form();
       $this->setForm($form);
       $fieldset = $form->addFieldset('tasks_form', array('legend'=>__('Quest')));
        
       $fieldset->addField('project_id', 'select', array(
            'label'     => __('Project'),
            'title'     => __('Project'),
            'name'      => 'project_id',
            'class'     => 'required-entry',
            'required' => true,
            'value' => '',
            'values' => $projects
           )); 
       
       $fieldset->addField('title', 'text', array(
                          'label' => __('Title'),
                          'title' => __('Title'),
                          'required' => true,
                          'name' => 'title',
                    ));
        $fieldset->addField('description', 'textarea', array(
                          'label' => __('Description'),
                          'title' => __('Description'),
                          'required' => true,
                          'name' => 'description',
                    ));
        
       
        if(Mage::registry('is_new')){
            $dateFormatIso = "dd.MM.yyyy 00:00:00";
        } else {
            $dateFormatIso = "dd.MM.yyyy HH:mm:ss";
        }
        $fieldset->addField('start_date', 'date', array(
            'name'   => 'start_date',
            'label'  => __('Start date'),
            'title'  => __('Start date'),
            'required' => true,
            'style' => 'width: 120px;',
            'image'  => $this->getSkinUrl('images/grid-cal.gif'),
            'input_format' => Varien_Date::DATETIME_INTERNAL_FORMAT,
            'format'       => $dateFormatIso
        ));
        
        
        $fieldset->addField('end_date', 'date', array(
            'name'   => 'end_date',
            'label'  => __('End date'),
            'title'  => __('End date'),
            'required' => true,
            'style' => 'width: 120px;',
            'image'  => $this->getSkinUrl('images/grid-cal.gif'),
            'input_format' => Varien_Date::DATETIME_INTERNAL_FORMAT,
            'format'       => $dateFormatIso
        ));
        
        if(Mage::helper('core')->isModuleEnabled('Wao_Statuses') ){
            $fieldset->addField('status', 'select', array(
                'label'     => __('Status'),
                'title'     => __('Status'),
                'name'      => 'status',
                'required' => true,
                'values'    => $statuses));
        }
        
        $fieldset->addField('developers', 'multiselect', array(
            'name'      => 'developers',
            'label'     => __('Developers'),
            'title'     => __('Developers'),
            'required'  => true,
            'values'    => $user_values,
        ));
        
        
        
 if ( Mage::registry('tasks_data') )
 {
    $tasks_data = Mage::registry('tasks_data')->getData();
    if(Mage::helper('core')->isModuleEnabled('Wao_Project')){
        $projectData = Mage::getModel('tasks/projects')->getCollection()->getProjectId($tasks_data['id']);
    }
    $developers = Mage::getModel('tasks/developers')->getCollection()->getUsers($tasks_data['id']);
    $data = $tasks_data;
    $data['project_id'] = $projectData;
    $data['id'] = $tasks_data['id'];
    $data['developers'] = $developers;
    
    $form->setValues($data);
  }
  return parent::_prepareForm();
  
 }
}