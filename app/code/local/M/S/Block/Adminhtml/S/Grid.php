<?php

class M_S_Block_Adminhtml_S_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('sGrid');
      $this->setDefaultSort('s_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('s/s')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('s_id', array(
          'header'    => Mage::helper('s')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 's_id',
      ));

      $this->addColumn('title', array(
          'header'    => Mage::helper('s')->__('User'),
          'align'     =>'left',
          'index'     => 'title',
      ));

      $this->addColumn('url', array(
          'header'    => Mage::helper('s')->__('URL'),
          'align'     =>'left',
          'index'     => 'url',
      ));

      $this->addColumn('price', array(
          'header'    => Mage::helper('s')->__('Price'),
          'align'     =>'right',
          'index'     => 'price',
          'width'     => '80px',
      ));

	  
      $this->addColumn('content', array(
			'header'    => Mage::helper('s')->__('Item Content'),
			'width'     => '400px',
			'index'     => 'content',
      ));
	 

      $this->addColumn('status', array(
          'header'    => Mage::helper('s')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('s')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('s')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('s')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('s')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('s_id');
        $this->getMassactionBlock()->setFormFieldName('s');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('s')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('s')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('s/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('s')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('s')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}