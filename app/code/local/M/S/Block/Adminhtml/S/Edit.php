<?php

class M_S_Block_Adminhtml_S_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 's';
        $this->_controller = 'adminhtml_s';
        
        $this->_updateButton('save', 'label', Mage::helper('s')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('s')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('s_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 's_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 's_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('s_data') && Mage::registry('s_data')->getId() ) {
            return Mage::helper('s')->__("Edit Item for '%s'", $this->htmlEscape(Mage::registry('s_data')->getTitle()));
        } else {
            return Mage::helper('s')->__('Add Item');
        }
    }
}