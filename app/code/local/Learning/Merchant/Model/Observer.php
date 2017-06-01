<?php


class Learning_Merchant_Model_Observer extends Mage_Core_Model_Abstract
{
    public function addToTopmenu(Varien_Event_Observer $observer)
    {
        $menu = $observer->getMenu();
        $tree = $menu->getTree();

        $node = new Varien_Data_Tree_Node(array(
            'name'   => 'Merchants',
            'id'     => 'Merchants',
            'url'    => Mage::getUrl('merchant/index'),
        ), 'id', $tree, $menu);

        $menu->addChild($node);
    }
}