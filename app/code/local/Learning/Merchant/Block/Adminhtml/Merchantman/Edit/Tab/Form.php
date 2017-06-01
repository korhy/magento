<?php

class Learning_Merchant_Block_Adminhtml_Merchantman_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    protected function _prepareLayout()
    {
        $return = parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        return $return;
    }

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('merchantman_form', array('legend' => Mage::helper('learning_merchant')->__('Merchantman information')));

        $fieldset->addType('image', 'Learning_Merchant_Block_Adminhtml_Form_Renderer_Image');
        $fieldset->addField('name', 'text', array(
            'label'    => Mage::helper('learning_merchant')->__('Name'),
            'name'     => 'name',
            'class'    => 'required-entry',
            'required' => true
        ));

        $fieldset->addField('surname', 'text', array(
            'label'    => Mage::helper('learning_merchant')->__('Surname'),
            'name'     => 'surname',
            'class'    => 'required-entry',
            'required' => true
        ));

        $fieldset->addField('description', 'editor', array(
            'name'     => 'description',
            'label'    => Mage::helper('learning_merchant')->__('Description'),
            'title'    => Mage::helper('learning_merchant')->__('Description'),
            'style'     => 'height: 300px;',
            'class'    => 'required-entry',
            'required' => true,
            'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
        ));

        $fieldset->addField('image_url', 'image', array(
            'label'     => Mage::helper('learning_merchant')->__('Image'),
            'required'  => false,
            'name'      => 'image_url',
            'directory' => 'merchantman/'
        ));


        if (Mage::getSingleton('adminhtml/session')->getMerchantmanData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getMerchantmanData());
            Mage::getSingleton('adminhtml/session')->getMerchantmanData(null);
        } elseif (Mage::registry('merchantman_data')) {
            $form->setValues(Mage::registry('merchantman_data')->getData());
        }

        return parent::_prepareForm();
    }

    public function getTabLabel()
    {
        return Mage::helper('learning_merchant')->__('Merchantman Information');
    }

    public function getTabTitle()
    {
        return Mage::helper('learning_merchant')->__('Merchantman Information');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }
}