<?php
/**
 * Created by PhpStorm.
 * User: korhy
 * Date: 30/05/2017
 * Time: 16:14
 */

class Learning_Merchant_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function detailAction(){
        $slug = $this->getRequest()->getParam('name');

        if($slug == null){
            $this->norouteAction();
            return;
        }

        $entity = Mage::getModel('learning_merchant/merchantman')->loadInstanceBySlug($slug);

        if($entity->getName() == null){
            $this->norouteAction();
            return;
        }

        Mage::register('merchant', $entity);
        $this->loadLayout();
        $this->renderLayout();

    }
}
