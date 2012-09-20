<?php
class Wao_Tasks_Block_Adminhtml_Task_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
   public function __construct()
   {
       parent::__construct();
       
       $this->setId('taskGrid');
       $this->setUseAjax(true);
       $this->setDefaultSort('id');
       $this->setDefaultDir('DESC');
       $this->setSaveParametersInSession(true);
   }
   protected function _prepareCollection()
   {
      $collection = Mage::getModel('tasks/tasks')->getCollection()->getTasksForUser();
      $this->setCollection($collection);
      return parent::_prepareCollection();
    }
   protected function _prepareColumns()
   {
       $this->addColumn('id',
             array(
                    'header' => 'id',
                    'align' =>'right',
                    'filter_index' => 't.id',
                    'width' => '50px',
                    'index' => 'id',
                 
               ));
       $this->addColumn('title',
               array(
                    'header' => __('Title'),
                    'align' =>'left',
                    'index' => 'title',
                    
              ));
       
       $this->addColumn('project',
               array(
                    'header' => __('Project'),
                    'align' =>'left',
                    'index' => 'name',
              ));
        $this->addColumn('start_date',
               array(
                    'header' => __('Start date'),
                    'align' =>'left',
                    'filter_index' => 't.start_date',
                    'index' => 'start_date',
                    'type'      => 'datetime',
                    'format' => 'dd.MM.yyyy HH:mm:ss',
                    'width' => '180px'
              ));
        $this->addColumn('end_date',
               array(
                    'header' => __('End date'),
                    'align' =>'left',
                    'filter_index' => 't.end_date',
                    'index' => 'end_date',
                    'type'      => 'datetime',
                    'format' => 'dd.MM.yyyy HH:mm:ss',
                    'width' => '180px'
              ));
        
        if(Mage::helper('tasks')->isModuleEnabled('Wao_Statuses') ){
        $statuses = Mage::getModel('statuses/status')->getCollection()->statusesToArray();
        $this->addColumn('status',array(
                    'header' => __('Status'),
                    'align' => 'left',
                    'filter_index' => 't.status',
                    'index' => 'status',
                    'type' => 'options',
                    'options' => $statuses,
                    'width' => '180px',
              ));
        }
        if(Mage::getSingleton('admin/session')->getWorkerRole() == 'manager'){
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
    public function getGridUrl() {
        return $this->getUrl('tasks/adminhtml_index/grid', array('_current' => true));
    }

}