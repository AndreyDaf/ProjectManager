<?php

class Wao_Statuses_Adminhtml_IndexController extends Mage_Adminhtml_Controller_action {

    public function indexAction() {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock("statuses/adminhtml_statuses"));
        $this->renderLayout();
    }

    public function editAction() {
        $id = $this->getRequest()->getParam('id', null);
        $model = Mage::getModel('statuses/status');
        if ($id) {
            $model->load($id);
            if ($model->getId()) {
                $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
                if ($data) {
                    $model->setData($data)->setId($id);
                }
            } else {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('statuses')->__('Example does not exist'));
                $this->_redirect('*/*/');
            }
        }
        Mage::register('example_data', $model);

        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->_addContent($this->getLayout()->createBlock("statuses/adminhtml_statuses_edit"));
        $this->renderLayout();
    }

    public function saveAction() {
        $id = $this->getRequest()->getParam('id', null);
        $data = $this->getRequest()->getPost();
        if (!empty($data)) {
            try {
                Mage::getModel('statuses/status')->setData($data)->setId($id)->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('statuses')->__('Changes successfully saved'));
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('adminhtml/session')->addError($this->__('Somethings went wrong'));
            }
        }
        return $this->_redirect('*/*/');
    }

    public function deleteAction() {
        $tipId = $this->getRequest()->getParam('id', false);

        try {
            Mage::getModel('statuses/status')->setId($tipId)->delete();
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('statuses')->__('Row successfully deleted'));

            return $this->_redirect('*/*/');
        } catch (Mage_Core_Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($this->__('Somethings went wrong'));
        }

        $this->_redirectReferer();
    }

    public function newAction() {
        $this->_forward('edit');
    }

}