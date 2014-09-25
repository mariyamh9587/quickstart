<?php

class M_S_Block_Adminhtml_S_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('s_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('s')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('s')->__('Item Information'),
          'title'     => Mage::helper('s')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('s/adminhtml_s_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}