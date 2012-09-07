<?php

class Wao_Project_Block_Adminhtml_Projects_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    protected function _construct() {
        $this->setId('projectsGrid');
        $this->_controller = 'adminhtml_projects';
        $this->setUseAjax(true);
        $this->setDefaultSort('id');
        $this->setDefaultDir('desc');
    }

    protected function _prepareCollection() {
        $userId = $this->helper('project/data')->getCurrentUserId();
        
        $collection = Mage::getModel('project/project')->getCollection()->getProjectsForUser($userId);
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        
        $this->addColumn('id', array(
            'header' => __('Id'),
            'align' => 'right',
            'width' => '20px',
            'filter_index' => 'id',
            'index' => 'id'
        ));

        $this->addColumn('name', array(
            'header' => __('Title'),
            'align' => 'left',
            'filter_index' => 'name',
            'index' => 'name',
            'type' => 'text',
            'truncate' => 255,
            'escape' => true,
        ));

        $this->addColumn('repository', array(
            'header' => __('Repository'),
            'align' => 'left',
            'filter_index' => 'repository',
            'index' => 'repository',
            'type' => 'text',
            'truncate' => 255,
            'escape' => true,
        ));

        $this->addColumn('start_date', array(
            'header' => __('Start date'),
            'align' => 'left',
            'filter_index' => 'start_date',
            'index' => 'start_date',
            'type' => 'datetime',
            'escape' => true,
        ));

        $this->addColumn('end_date', array(
            'header' => __('End date'),
            'align' => 'left',
            'filter_index' => 'end_date',
            'index' => 'end_date',
            'type' => 'datetime',
            'escape' => true,
        ));

        if (Mage::helper('core')->isModuleEnabled('Wao_Statuses') &&
            Mage::helper('core')->isModuleOutputEnabled('Wao_Statuses')) {

            $allStatuses = array();
            $statuses = Mage::getModel('statuses/status')->getCollection()->getData();
            
            foreach ($statuses as $status) {
                
                $allStatuses[$status['status']] = $status['status'];
            }
            
            $this->addColumn('status', array(
                'header' => __('Status'),
                'align' => 'left',
                'filter_index' => 'status',
                'index' => 'status',
                'type' => 'options',
                'options' => $allStatuses,
                'truncate' => 100,
                'escape' => true,
            ));
        }
        
        $roleName = Mage::getSingleton('admin/session')->getWorkerRole();
        
        if ($roleName == 'manager') {

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

    public function getRowUrl($quote) {
        return $this->getUrl('*/*/project', array(
                    'pr' => $quote->getId(),
                ));
    }

    public function getGridUrl() {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }

}

?>
