<?php

class Learning_Merchant_Adminhtml_Merchant_MerchantmanController extends Mage_Adminhtml_Controller_Action
{
    /**
     * @return Mage_Adminhtml_Controller_Action
     */
    protected function _initAction()
    {
        return $this->loadLayout()->_setActiveMenu('learning_merchant');
    }

    /**
     * @return Mage_Core_Controller_Varien_Action
     */
    public function indexAction()
    {
        return $this->_initAction()->renderLayout();
    }

    /**
     * @return $this
     */
    public function newAction()
    {
        $this->_forward('edit');

        return $this;
    }

    /**
     * @return $this|Mage_Core_Controller_Varien_Action
     */
    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var Learning_Merchant_Model_Merchantman $merchantman */
        $merchantman = Mage::getModel('learning_merchant/merchantman')->load($id);

        if ($merchantman->getId() || $id == 0) {

            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $merchantman->setData($data);
            }
            Mage::register('merchantman_data', $merchantman);

            return $this->_initAction()->renderLayout();
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('learning_merchant')->__('Merchantman does not exist'));

        return $this->_redirect('*/*/');
    }

    /**
     * @return $this|Mage_Core_Controller_Varien_Action
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {

            $delete = (!isset($data['image_url']['delete']) || $data['image_url']['delete'] != '1') ? false : true;
            $data['image_url'] = $this->_saveImage('image_url', $delete);

            /** @var Learning_Merchant_Model_Merchantman $merchantman */
            $merchantman = Mage::getModel('learning_merchant/merchantman');

            if ($id = $this->getRequest()->getParam('id')) {
                $merchantman->load($id);
            }

            try {
                $merchantman->addData($data);
                $merchantman->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('learning_merchant')->__('The merchantman has been saved.'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array(
                        'id'       => $merchantman->getId(),
                        '_current' => true
                    ));

                    return;
                }

                $this->_redirect('*/*/');

                return;
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                $this->_getSession()->addException($e, Mage::helper('learning_merchant')->__('An error occurred while saving the merchantman.'));
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', array(
                'id' => $this->getRequest()->getParam('id')
            ));

            return;
        }
        $this->_redirect('*/*/');
    }

    /**
     * @return $this|Mage_Core_Controller_Varien_Action
     */
    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                /** @var Learning_Merchant_Model_Merchantman $merchantman */
                $merchantman = Mage::getModel('learning_merchant/merchantman');
                $merchantman->load($id)->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('learning_merchant')->__('Merchantman was successfully deleted'));
                $this->_redirect('*/*/');

                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));

                return;
            }
        }

        return $this->_redirect('*/*/');
    }

    /**
     *
     */
    protected function _saveImage($imageAttr, $delete)
    {
        if ($delete) {
            $image = '';
        } elseif (isset($_FILES[$imageAttr]['name']) && $_FILES[$imageAttr]['name'] != '') {
            try {
                $uploader = new Varien_File_Uploader($imageAttr);
                $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'png'));
                $uploader->setAllowRenameFiles(false);
                $uploader->setFilesDispersion(false);
                $path = Mage::getBaseDir('media') . DS . 'merchantman' . DS;
                $uploader->save($path, $_FILES[$imageAttr]['name']);
                $image = $_FILES[$imageAttr]['name'];
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                return $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        } else {
            $model = Mage::getModel('learning_merchant/merchantman')->load($this->getRequest()->getParam('id'));
            $image = $model->getData($imageAttr);
        }
        return $image;
    }

    /**
     * @return $this|Mage_Core_Controller_Varien_Action
     */
    public function massDeleteAction()
    {
        $merchantmanIds = $this->getRequest()->getParam('merchantman');
        if (!is_array($merchantmanIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('learning_merchant')->__('Please select merchant(s)'));
        } else {
            try {
                foreach ($merchantmanIds as $merchantman) {
                    Mage::getModel('learning_merchant/merchantman')->load($merchantman)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('learning_merchant')->__('Total of %d merchantman(s) were successfully deleted', count($merchantmanIds)));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        return $this->_redirect('*/*/index');
    }

}