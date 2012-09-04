<?php

class Wao_Statuses_Block_Adminhtml_Statuses_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('statusGrid');
      $this->setDefaultSort('id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $model = Mage::getModel('statuses/status');
      $statuses = $model->getCollection();
      $this->setCollection($statuses);
  }

  protected function _prepareColumns()
  {
      $this->addColumn('id', array(
          'header'    => Mage::helper('statuses')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'id',
      ));

      $this->addColumn('sender', array(
          'header'    => Mage::helper('statuses')->__('Status'),
          'align'     => 'right',
          'width'     => '40px',
          'index'     => 'status',
      ));
      
       $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('statuses')->__('Action'),
                'width'     => '10',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('statuses')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )  
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
  }
}