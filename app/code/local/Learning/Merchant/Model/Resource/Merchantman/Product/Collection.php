<?php
class Learning_Merchant_Model_Resource_Merchantman_Product_Collection
    extends Mage_Catalog_Model_Resource_Product_Collection {
    protected $_joinedFields = false;
    public function joinFields(){
        if (!$this->_joinedFields){
            $this->getSelect()->join(
                array('related' => $this->getTable('learning_merchant/merchantman_product')),
                'related.product_id = e.entity_id',
                array('position')
            );
            $this->_joinedFields = true;
        }
        return $this;
    }
    public function addMerchantmanFilter($merchantman){
        if ($merchantman instanceof Learning_Merchant_Model_Merchantman){
            $merchantman = $merchantman->getId();
        }
        if (!$this->_joinedFields){
            $this->joinFields();
        }
        $this->getSelect()->where('related.merchantman_id = ?', $merchantman);
        return $this;
    }
}
