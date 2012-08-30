<?php

class Wao_Project_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action {
    
    public function indexAction()
    {
        $this->_title($this->__('Projects'));
        $this->loadLayout();
        $this->_setActiveMenu('project');
        $this->renderLayout();
    }
    
    public function newAction()
    {
        $this->_title($this->__('Add new project'));
        $this->loadLayout();
        $this->_setActiveMenu('project');
        $this->renderLayout();
    }
    
    public function editAction()
    {
        Mage::register('new_project', 1);
        
        $this->_title($this->__('Edit project'));
        $this->_forward('new');
    }
    
    public function deleteAction()
    {
        $tipId = $this->getRequest()->getParam('id', false);
 
        try {
            Mage::getModel('project/project')->setId($tipId)->delete();
            Mage::getSingleton('adminhtml/session')->addSuccess('Project successfully deleted');
            
            return $this->_redirect('*/*/');
        } catch (Mage_Core_Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($this->__('Somethings went wrong'));
        }
 
        $this->_redirectReferer();
    }

    public function saveAction()
    {
        $data = $this->getRequest()->getPost();
        if (!empty($data)) {
            try {
                Mage::getModel('project/project')->setData($data)
                    ->save();
                Mage::getSingleton('adminhtml/session')->addSuccess('Project successfully saved');
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('adminhtml/session')->addError($this->__('Somethings went wrong'));
            }
        }
        return $this->_redirect('*/*/');
    }
    
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('project/adminhtml_projects_grid')->toHtml()
        );
    }
    
    public function projectAction()
    {
        $this->_title($this->__('Current projects'));
        
        $this->loadLayout();
        $this->_setActiveMenu('project');
        
        $this->_addContent($this->getLayout()
                  ->createBlock('project/adminhtml_project'));
        
        $this->_addLeft($this->getLayout()
                  ->createBlock('project/adminhtml_project_tabs', 'project.tabs'));
        
        $this->renderLayout();
    }

}

?>
