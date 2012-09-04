<?php
class Wao_Tasks_Block_Adminhtml_Task_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
   public function __construct()
   {
       parent::__construct();
       $this->setId('taskGrid');
       $this->setDefaultSort('id');
       $this->setDefaultDir('ASC');
       $this->setSaveParametersInSession(true);
   }
   protected function _prepareCollection()
   {
      $collection = Mage::getModel('tasks/tasks')->getCollection();//->addFieldToFilter('id',);
      //$tasksForUser = Mage::getModel('tasks/developers')->getCollection()->getTasksForUser();
      $this->setCollection($collection);
      return parent::_prepareCollection();
    }
   protected function _prepareColumns()
   {
       $this->addColumn('id',
             array(
                    'header' => 'id',
                    'align' =>'right',
                    'width' => '50px',
                    'index' => 'id',
               ));
       $this->addColumn('title',
               array(
                    'header' => __('Title'),
                    'align' =>'left',
                    'index' => 'title',
              ));
        $this->addColumn('start_date',
               array(
                    'header' => __('Start date'),
                    'align' =>'left',
                    'index' => 'start_date',
                    'type'      => 'datetime',
                    'width' => '180px'
              ));
        $this->addColumn('end_date',
               array(
                    'header' => __('End date'),
                    'align' =>'left',
                    'index' => 'end_date',
                    'type'      => 'datetime',
                    'width' => '180px'
              ));
        
        if(Mage::helper('core')->isModuleEnabled('Wao_Statuses') ){
        $this->addColumn('status',
               array(
                    'header' => __('Status'),
                    'align' =>'left',
                    'index' => 'status',
                    'width' => '180px',
              ));
        }
        if(Mage::helper('tasks')->getUserRole() == 3){
        $this->addColumn('action', array(
            'header' => __('Action'),
            'width' => '50px',
            'type' => 'action',
            'getter' => 'getId',
            'actions' => array(
                array(
                    'caption' => __('Edit'),
                    'url' => array(
                        'base' => '*/*/edit',
                    ),
                    'field' => 'id'
                )
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'id',
        ));
        }
         return parent::_prepareColumns();
    }
    public function getRowUrl($row)
    {
         return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}