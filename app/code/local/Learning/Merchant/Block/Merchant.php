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
}