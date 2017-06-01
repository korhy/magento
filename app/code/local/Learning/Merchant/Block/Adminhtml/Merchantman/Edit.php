<?php

class Learning_Merchant_Block_Adminhtml_Merchantman_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->_objectId   = 'id';
        $this->_blockGroup = 'learning_merchant';
        $this->_controller = 'adminhtml_merchantman';

        $this->_updateButton('save', 'label', Mage::helper('learning_merchant')->__('Save Merchant'));
        $this->_updateButton('delete', 'label', Mage::helper('learning_merchant')->__('Delete Merchant'));
        $this->_removeButton('reset');

        $this->_addButton('saveandcontinue', array(
            'label'   => Mage::helper('learning_merchant')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class'   => 'save',
        ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * Get header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('merchantman_data') && Mage::registry('merchantman_data')->getId()) {
            return Mage::helper('learning_merchant')->__("Edit Merchant '%s'", Mage::registry('merchantman_data')->getName());
        } else {
            return Mage::helper('learning_merchant')->__('Add Merchantman');
        }
    }
}