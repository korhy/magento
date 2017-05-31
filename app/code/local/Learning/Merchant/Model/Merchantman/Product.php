<?php
class Learning_Merchant_Model_Merchantman_Product
    extends Mage_Core_Model_Abstract {
    protected function _construct(){
        $this->_init('learning_merchant/merchantman_product');
    }
    public function saveMerchantmanRelation($merchantman){
        $data = $merchantman->getProductsData();
        if (!is_null($data)) {
            $this->_getResource()->saveMerchantmanRelation($merchantman, $data);
        }
        return $this;
    }
    public function getProductCollection($merchantman){
        $collection = Mage::getResourceModel('learning_merchant/merchantman_product_collection')
            ->addMerchantmanFilter($merchantman);
        return $collection;
    }
}
