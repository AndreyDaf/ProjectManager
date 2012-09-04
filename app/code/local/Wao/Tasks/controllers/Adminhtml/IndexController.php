<?php
    class Wao_Tasks_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action {
     
    public function indexAction(){
          $this->loadLayout();
          //$this->_addContent($this->getLayout()->createBlock('tasks/adminhtml_grid'));
          $this->renderLayout();
    }
    
    protected function _initAction()
    {
        $this->loadLayout()->_setActiveMenu('tasks');
                //->_addBreadcrumb('test Manager','test Manager');
       return $this;
     }
    
      public function editAction()
      {
        $request = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $referer = $_SERVER['HTTP_REFERER'];
         if($request != $referer){
              Mage::getSingleton('core/session')->setMyRequest(array('url'=> $_SERVER['HTTP_REFERER']));
          }
        
          
           $id = $this->getRequest()->getParam('id');
           $modelTasks = Mage::getModel('tasks/tasks')->load($id);
            //var_dump($testModel); 
           if(!$modelTasks->getId()) Mage::register('is_new',1);
           if ($modelTasks->getId() || $id == 0)
           {
             
             Mage::register('tasks_data', $modelTasks);
             Mage::register('projects_data', Mage::getModel('tasks/projects'));
             $this->loadLayout();
             
             
             
             $this->_setActiveMenu('tasks');
             //$this->_addBreadcrumb('test Manager', 'test Manager');
             //$this->_addBreadcrumb('Test Description', 'Test Description');
             $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
//             $this->_addContent($this->getLayout()
//                  ->createBlock('tasks/adminhtml_task_edit'))
//                  ->_addLeft($this->getLayout()
//                  ->createBlock('tasks/adminhtml_task_edit_tabs')
//              );
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
           //$test = Mage::getModel('tasks/tasks')->getCollection()->addFieldToFilter('id',array(1));
           
           
           //echo "<pre>";
           //print_r($tasks);
           //Reflection::export(new ReflectionClass('Mage_Admin_Model_Session'));
          //die;
           $this->_forward('edit');
       }
       public function saveAction()
       {
           
         if ($this->getRequest()->getPost())
         {
           try {
             
                 $postData = $this->getRequest()->getPost();
//                 header('Content-Type: text/html;charset=UTF-8');
//                 echo "<pre>";
//                 var_dump($postData); die;
//                 echo "</pre>";
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
                 //echo $this->getRequest()->getParam('id'); exit;
                 echo "<pre>";
                 //var_dump($developers); exit;
                 echo "</pre>";
                 
                 
                 $devModel = Mage::getModel('tasks/developers');
               
                  foreach($developers as $dev){
                    $devModel
                      ->setData($dev)->setId($dev['id'])->save();
                    }
                 Mage::getSingleton('adminhtml/session')
                               ->addSuccess('Успешно сохранено');
                 Mage::getSingleton('adminhtml/session')
                                ->settestData(false);
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
              if($this->getRequest()->getParam('id') > 0)
              {
                try
                {
                    $testModel = Mage::getModel('tasks/tasks');
                    $testModel->setId($this->getRequest()
                                        ->getParam('id'))
                              ->delete();
                    Mage::getSingleton('adminhtml/session')
                               ->addSuccess('Успешно удалено');
                    $this->_redirect('*/*/');
                 }
                 catch (Exception $e)
                  {
                           Mage::getSingleton('adminhtml/session')
                                ->addError($e->getMessage());
                           $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                  }
             }
            $this->_redirect('*/*/');
       }
       
       public function submitAction()
       {
           $id = $this->getRequest()->getParam('id');
         if ($id) {
             
           try {
             
                 $taskModel = Mage::getModel('tasks/tasks');
                 if(!Mage::helper('tasks')->isModuleEnabled('Wao_Statuses')){
                     $statuses = Mage::getModel('statuses/status')->getCollection()->statusesToArray();
                     
                 }
                 
                 $taskModel->setStatus('Отправлено на проверку')
                    ->setId($id)->save();
                 
                 
                 
                 
                 Mage::getSingleton('adminhtml/session')
                               ->addSuccess('Задание отправлено на проверку');
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
   
}
    