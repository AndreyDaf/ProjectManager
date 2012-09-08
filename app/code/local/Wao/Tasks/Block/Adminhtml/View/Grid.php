<?php

class Wao_Tasks_Block_Adminhtml_View_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public $roleName;
    public function __construct()
    {
        parent::__construct();
        $this->setFilterVisibility(false);
        $this->setPagerVisibility(false);
        $this->setUseAjax(false);
    }

    protected function _getUpdatedAt($reportCode)
    {
        $flag = Mage::getModel('reports/flag')->setReportFlagCode($reportCode)->loadSelf();
        return ($flag->hasData())
            ? Mage::app()->getLocale()->storeDate(
                0, new Zend_Date($flag->getLastUpdate(), Varien_Date::DATETIME_INTERNAL_FORMAT), true
            )
            : '';
    }

    protected function _prepareCollection()
    {
//        $collection = new Varien_Data_Collection();
//
//        $data = array(
//            array(
//                'id'            => 'sales',
//                'report'        => Mage::helper('sales')->__('Orders'),
//                'comment'       => Mage::helper('sales')->__('Total Ordered Report'),
//                'updated_at'    => $this->_getUpdatedAt(Mage_Reports_Model_Flag::REPORT_ORDER_FLAG_CODE)
//            ),
//            array(
//                'id'            => 'tax',
//                'report'        => Mage::helper('sales')->__('Tax'),
//                'comment'       => Mage::helper('sales')->__('Order Taxes Report Grouped by Tax Rates'),
//                'updated_at'    => $this->_getUpdatedAt(Mage_Reports_Model_Flag::REPORT_TAX_FLAG_CODE)
//            ),
//            array(
//                'id'            => 'shipping',
//                'report'        => Mage::helper('sales')->__('Shipping'),
//                'comment'       => Mage::helper('sales')->__('Total Shipped Report'),
//                'updated_at'    => $this->_getUpdatedAt(Mage_Reports_Model_Flag::REPORT_SHIPPING_FLAG_CODE)
//            ),
//            array(
//                'id'            => 'invoiced',
//                'report'        => Mage::helper('sales')->__('Total Invoiced'),
//                'comment'       => Mage::helper('sales')->__('Total Invoiced VS Paid Report'),
//                'updated_at'    => $this->_getUpdatedAt(Mage_Reports_Model_Flag::REPORT_INVOICE_FLAG_CODE)
//            ),
//            array(
//                'id'            => 'refunded',
//                'report'        => Mage::helper('sales')->__('Total Refunded'),
//                'comment'       => Mage::helper('sales')->__('Total Refunded Report'),
//                'updated_at'    => $this->_getUpdatedAt(Mage_Reports_Model_Flag::REPORT_REFUNDED_FLAG_CODE)
//            ),
//            array(
//                'id'            => 'coupons',
//                'report'        => Mage::helper('sales')->__('Coupons'),
//                'comment'       => Mage::helper('sales')->__('Promotion Coupons Usage Report'),
//                'updated_at'    => $this->_getUpdatedAt(Mage_Reports_Model_Flag::REPORT_COUPONS_FLAG_CODE)
//            ),
//            array(
//                'id'            => 'bestsellers',
//                'report'        => Mage::helper('sales')->__('Bestsellers'),
//                'comment'       => Mage::helper('sales')->__('Products Bestsellers Report'),
//                'updated_at'    => $this->_getUpdatedAt(Mage_Reports_Model_Flag::REPORT_BESTSELLERS_FLAG_CODE)
//            ),
//            array(
//                'id'            => 'viewed',
//                'report'        => Mage::helper('sales')->__('Most Viewed'),
//                'comment'       => Mage::helper('sales')->__('Most Viewed Products Report'),
//                'updated_at'    => $this->_getUpdatedAt(Mage_Reports_Model_Flag::REPORT_PRODUCT_VIEWED_FLAG_CODE)
//            ),
//        );
//
//        foreach ($data as $value) {
//            $item = new Varien_Object();
//            $item->setData($value);
//            $collection->addItem($item);
//        }
        $this->roleName = Mage::getSingleton('admin/session')->getWorkerRole();
        $collection = Mage::getModel('tasks/tasks')->getCollection();
        if($this->roleName == 'manager'){
            $tasksForProject = Mage::getModel('tasks/developers')->getCollection()->getTasksForProject($this->getRequest()->getParam('pr'));
            $collection->addFieldToFilter('id',$tasksForProject);
        } elseif($this->roleName == 'admin') {} else {
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
                   'format' => 'dd.MM.yyyy HH:mm:ss'
              ));
        $this->addColumn('end_date',
               array(
                    'header' => __('End date'),
                    'align' =>'left',
                    'index' => 'end_date',
                   'type'      => 'datetime',
                   'format' => 'dd.MM.yyyy HH:mm:ss'
              ));
        
        if(Mage::helper('core')->isModuleEnabled('Wao_Statuses') ){
        $this->addColumn('status',
               array(
                    'header' => __('Status'),
                    'align' =>'left',
                    'index' => 'status',
                   'width' => '100px',
              ));
        }

        return parent::_prepareColumns();
    }
    public function getRowUrl($row)
    {
         return $this->getUrl('tasks/adminhtml_index/edit', array('id' => $row->getId()));
    }

}
