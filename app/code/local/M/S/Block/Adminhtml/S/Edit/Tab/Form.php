<?php

class M_S_Block_Adminhtml_S_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('s_form', array('legend'=>Mage::helper('s')->__('Item information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('s')->__('User'),
          'required'  => false,
          'name'      => 'title',
          'disabled'  => 'disabled',
      ));

      $fieldset->addField('url', 'text', array(
          'label'     => Mage::helper('s')->__('URL'),
          'required'  => false,
          'name'      => 'url',
          'maxlength' => '250',
      ));

      $fieldset->addField('price', 'text', array(
          'label'     => Mage::helper('s')->__('Price'),
          'required'  => false,
          'maxlength' => '12',
          'name'      => 'price',
      ));

//      $fieldset->addField('filename', 'file', array(
//          'label'     => Mage::helper('s')->__('File'),
//          'required'  => false,
//          'name'      => 'filename',
//	  ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('s')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('s')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('s')->__('Disabled'),
              ),
          ),
      ));
     
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('s')->__('Content'),
          'title'     => Mage::helper('s')->__('Content'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getSData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getSData());
          Mage::getSingleton('adminhtml/session')->setSData(null);
      } elseif ( Mage::registry('s_data') ) {
          $form->setValues(Mage::registry('s_data')->getData());
      }
      return parent::_prepareForm();
  }
}