<?php

class Learning_Slider_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        //die('it works !');
        $this->loadLayout();
        $this->renderLayout();
    }

    public function detailAction(){
        echo $this->getRequest()->getParam('name');
    }
}
