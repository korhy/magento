<?php


class Learning_Merchant_Model_Merchantman extends Mage_Core_Model_Abstract
{
    /**
     * Name of object id field
     *
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * Magento class constructor
     */
    protected function _construct()
    {
        $this->_init('learning_merchant/merchantman');
    }

    public function loadInstanceBySlug($slug)
    {
       $this->_getResource()->loadInstanceBySlug($slug, $this);

        return $this;
    }

    public function getProducts(){
       return $this->_getResource()->getProducts();

    }


    protected $_productInstance = null;
        public function getProductInstance(){
            if (!$this->_productInstance) {
                $this->_productInstance = Mage::getSingleton('learning_merchant/merchantman_product');
            }
            return $this->_productInstance;
        }
        protected function _afterSave() {
            $this->getProductInstance()->saveMerchantmanRelation($this);
            return parent::_afterSave();
        }
        public function getSelectedProducts(){
            if (!$this->hasSelectedProducts()) {
                $products = array();
                foreach ($this->getSelectedProductsCollection() as $product) {
                    $products[] = $product;
                }
                $this->setSelectedProducts($products);
            }
            return $this->getData('selected_products');
        }
        public function getSelectedProductsCollection(){
            $collection = $this->getProductInstance()->getProductCollection($this);
            return $collection;
        }
}
