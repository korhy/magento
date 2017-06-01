<?php

class Learning_Merchant_Block_Adminhtml_Merchantman extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller     = 'adminhtml_merchantman';
        $this->_blockGroup     = 'learning_merchant';
        $this->_headerText     = Mage::helper('learning_merchant')->__('Manage Merchant');
        $this->_addButtonLabel = Mage::helper('learning_merchant')->__('Add Merchantman');
        parent::__construct();
    }
}