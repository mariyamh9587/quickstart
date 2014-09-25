<?php
class M_S_Block_Adminhtml_S extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_s';
    $this->_blockGroup = 's';
    $this->_headerText = Mage::helper('s')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('s')->__('Add Item');
    parent::__construct();
  }
}