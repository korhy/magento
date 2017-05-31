<?php
class Learning_Merchant_Model_Resource_Merchantman_Product
    extends Mage_Core_Model_Resource_Db_Abstract {
    protected function  _construct(){
        $this->_init('learning_merchant/merchantman_product', 'rel_id');
    }
    public function saveMerchantmanRelation($merchantman, $data){
        if (!is_array($data)) {
            $data = array();
        }
        $deleteCondition = $this->_getWriteAdapter()->quoteInto('merchantman_id=?', $merchantman->getId());
        $this->_getWriteAdapter()->delete($this->getMainTable(), $deleteCondition);

        foreach ($data as $productId => $info) {
            $this->_getWriteAdapter()->insert($this->getMainTable(), array(
                'merchantman_id'      => $merchantman->getId(),
                'product_id'     => $productId,
                'position'      => @$info['position']
            ));
        }
        return $this;
    }
}
