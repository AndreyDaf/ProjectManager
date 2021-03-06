<?php
    class Wao_Tasks_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action {
     
        public function indexAction(){
          $this->loadLayout()->_title($this->__('Tasks'));
          $this->_setActiveMenu('tasks');
          $this->renderLayout();
        }
    
      public function editAction()
      {
        $request = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $referer = $_SERVER['HTTP_REFERER'];
         if($request != $referer){
              Mage::getSingleton('core/session')->setMyRequest(array('url'=> $referer));
          }
        
          
           $id = $this->getRequest()->getParam('id');
           $modelTasks = Mage::getModel('tasks/tasks')->load($id);
            
           if(!$modelTasks->getId()) Mage::register('is_new',1);
           if ($modelTasks->getId() || $id == 0)
           {
             
             Mage::register('tasks_data', $modelTasks);
             Mage::register('projects_data', Mage::getModel('tasks/projects'));
             
             $this->loadLayout()->_title($this->__('Tasks editor'));
             
             if(preg_match('/project/',$referer)){
                 $this->_setActiveMenu('project');
                 Mage::register('pro_data', 1);
             } else {
               $this->_setActiveMenu('tasks');  
             }
             
             $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
             $this->renderLayout();
           }
           else
           {
                 Mage::getSingleton('adminhtml/session')
                       ->addError('Does not exist');
                 $this->_redirect('*/*/');
            }
       }
       public function newAction()
       {
           $this->_forward('edit');
       }
       public function saveAction()
       {
         
           if ($this->getRequest()->getPost()){
           try {
             
                 $postData = $this->getRequest()->getPost();
                 $project_id = $postData['project_id'];
                 $developersData = $postData['developers'];
                 unset($postData['project_id']);
                 unset($postData['developers']);
                 
                 $taskModel = Mage::getModel('tasks/tasks');
                 $taskModel->addData($postData)
                    ->setId($this->getRequest()->getParam('id'))->save();
                 $taskId = $taskModel->getId();
                 
                 
                 $taskUsers = Mage::getModel('tasks/developers')->getCollection()->getUsers($taskId);
                 $developers = array();
                 $i = 0;
                 foreach($developersData as $devel){
                     
                        foreach($taskUsers as $key=>$value){
                            if($value == $devel){
                                $developers[$i]['id'] = $key;
                                $developers[$i]['id_project'] = $project_id;
                                $developers[$i]['id_user'] = $devel;
                                $developers[$i]['id_task'] = $taskId;
                                $developers[$i]['active'] = 0;
                            }
                        }
                    
                         $developers[$i]['id_project'] = $project_id;
                         $developers[$i]['id_user'] = $devel;
                         $developers[$i]['id_task'] = $taskId;
                         $developers[$i]['active'] = 0;
                     
                     $i++;
                 }
                 
                 
                 Mage::getModel('tasks/developers')->getCollection()->resetActive($taskId);
           
                 $devModel = Mage::getModel('tasks/developers');
               
                  foreach($developers as $dev){
                    $devModel
                      ->setData($dev)->setId($dev['id'])->save();
                    }
                 Mage::getSingleton('adminhtml/session')
                               ->addSuccess(__('Success save'));
                 
                 $this->_redirect('*/*/');
                 
                return;
          } catch (Exception $e){
                Mage::getSingleton('adminhtml/session')
                                  ->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')
                 ->settestData($this->getRequest()
                                    ->getPost()
                );
                $this->_redirect('*/*/edit',
                            array('id' => $this->getRequest()
                                                ->getParam('id')));
                return;
                }
              }
              $this->_redirect('*/*/');
            }
          public function deleteAction()
          {
              $myRequest = Mage::getSingleton('core/session')->getMyRequest();
              if($this->getRequest()->getParam('id') > 0)
              {
                try
                {
                    $testModel = Mage::getModel('tasks/tasks');
                    $testModel->setId($this->getRequest()
                                        ->getParam('id'))
                              ->delete();
                    Mage::getSingleton('adminhtml/session')
                               ->addSuccess(__('Success delete'));
                    $this->_redirectUrl($myRequest['url']);
                 }
                 catch (Exception $e)
                  {
                           Mage::getSingleton('adminhtml/session')
                                ->addError($e->getMessage());
                           $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                  }
             }
            $this->_redirectUrl($myRequest['url']);
       }
       
       public function submitAction()
       {
           $id = $this->getRequest()->getParam('id');
         if ($id) {
             
           try {
             
                 $taskModel = Mage::getModel('tasks/tasks');
                 if(Mage::helper('tasks')->isModuleEnabled('Wao_Statuses')){
                     $statuses = Mage::getModel('statuses/status')->getCollection()->getData();
                     
                 $taskModel->setStatus($statuses[2]['status'])
                    ->setId($id)->save();
                 }
                 
                 Mage::getSingleton('adminhtml/session')
                               ->addSuccess(__('Task is sent to the moderation'));
                 Mage::getSingleton('adminhtml/session')
                                ->settestData(false);
                 //$this->_redirect('*/*/');
                 $this     ->_redirectUrl($_SERVER['HTTP_REFERER']);
                return;
          } catch (Exception $e){
                Mage::getSingleton('adminhtml/session')
                                  ->addError($e->getMessage());
               
                $this->_redirect('*/*/edit',
                            array('id' => $this->getRequest()
                                                ->getParam('id')));
                return;
                }
              }
              $this->_redirect('*/*/');
            }
            
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('tasks/adminhtml_task_grid')->toHtml()
        );
    }
    
    public function grid2Action()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('tasks/adminhtml_view_grid')->toHtml()
        );
    }
   
}
    