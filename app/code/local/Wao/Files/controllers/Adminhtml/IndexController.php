<?php
    class Wao_Files_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action {
     
    public function indexAction(){
          $this->loadLayout();
          $this->renderLayout();
    }
    
    
    
    public function addAction(){
       
        if(isset($_FILES['import_file']['name']) && $_FILES['import_file']['name'] != ''){
        try {
            
            $uploader = new Varien_File_Uploader('import_file');
            
            $post = $this->getRequest()->getPost();
            $model = Mage::getModel('files/files');
            $format =  Mage::getStoreConfig('files_options/files_group/files'); 
            $format = explode("|", $format);
            
            $path = Mage::getBaseDir().DS.'media'.DS.'files'.DS.$post['module_name'].DS.$post['entity'].DS;
            $spath = DS.'media'.DS.'files'.DS.$post['module_name'].DS.$post['entity'].DS;
            $fname = Mage::helper('files')->transName($_FILES['import_file']['name']);
            
            $fname = $uploader->getCorrectFileName($fname);
            $fullPath = $spath.$fname;
            if($model->getCollection()->checkPath($fullPath)) throw new Exception(__("File already exists"));
            
            
            $uploader->setAllowedExtensions($format); 
            $uploader->setAllowCreateFolders(true); 
            $uploader->setAllowRenameFiles(false); 
            $uploader->setFilesDispersion(false);
            
            $uploader->save($path,$fname); 
            
            $model->getCollection()->insertFileData($post,$fname,$fullPath);
            
            Mage::getSingleton('adminhtml/session')->addSuccess(__('Success upload'));
            $this->_redirectUrl($_SERVER['HTTP_REFERER']);
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirectUrl($_SERVER['HTTP_REFERER']);
            }
        }
    }   
    
     
}
    