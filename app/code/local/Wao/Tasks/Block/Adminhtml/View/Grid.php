<?php

class Wao_Tasks_Block_Adminhtml_View_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public $roleName;
    
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('tasks/grid.phtml');
        $this->setGridHeader(__('Tasks for this project'));
        $this->setFilterVisibility(false);
        $this->setPagerVisibility(false);
        $this->setUseAjax(true);
        $this->setId('taskGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        
    }

    protected function _prepareCollection()
    {
        $this->roleName = Mage::getSingleton('admin/session')->getWorkerRole();
        $collection = Mage::getModel('tasks/tasks')->getCollection();
        if($this->roleName == 'manager' || $this->roleName == 'admin'){
            $tasksForProject = Mage::getModel('tasks/developers')->getCollection()->getTasksForProject($this->getRequest()->getParam('pr'));
            $collection->addFieldToFilter('id',$tasksForProject);
        }else  {
            $tasksForProjectForUser = Mage::getModel('tasks/developers')->getCollection()->getTasksForProjectForUser($this->getRequest()->getParam('pr'));
            $collection->addFieldToFilter('id',$tasksForProjectForUser);
        }
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
                    'format' => 'dd.MM.yyyy HH:mm:ss',
                    'width' => '180px'
              ));
        $this->addColumn('end_date',
               array(
                    'header' => __('End date'),
                    'align' =>'left',
                    'index' => 'end_date',
                    'type'      => 'datetime',
                    'format' => 'dd.MM.yyyy HH:mm:ss',
                    'width' => '180px'
              ));
        
        if(Mage::helper('core')->isModuleEnabled('Wao_Statuses') ){
        $this->addColumn('status',
               array(
                    'header' => __('Status'),
                    'align' =>'left',
                    'index' => 'status',
                    'width' => '180px'
              ));
        }

        return parent::_prepareColumns();
    }
    public function getRowUrl($row)
    {
         return $this->getUrl('tasks/adminhtml_index/edit', array('id' => $row->getId()));
    }
    
    public function getGridUrl() {
        return $this->getUrl('tasks/adminhtml_index/grid2', array('_current' => true));
    }
    

}
