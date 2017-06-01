<?php
/**
 * Created by PhpStorm.
 * User: korhy
 * Date: 30/05/2017
 * Time: 16:22
 */

class Learning_Merchant_Block_Merchant extends Mage_Core_Block_Template
{

    public function getMerchantmans()
    {
        $merchantman = Mage::getModel('learning_merchant/merchantman')
            ->getCollection();

        return $merchantman;
    }

    public function getMerchantProducts ($merchantman){
        $product = $merchantman->getSelectedProductsCollection()
            ->addAttributeToSelect(array('name', 'price', 'image'))
            ->addAttributeToFilter(
                'status',
                array('eq' => Mage_Catalog_Model_Product_Status::STATUS_ENABLED)
            )
            ->addFieldToFilter('visibility', Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH);


        return $product;
    }


}