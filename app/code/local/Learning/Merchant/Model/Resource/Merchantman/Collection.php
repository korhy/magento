<?php

class Learning_Merchant_Model_Resource_Merchantman_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Magento class constructor
     */
    protected function _construct()
    {
        $this->_init('learning_merchant/merchantman');
    }

}