<?php

class Wao_Comments_Adminhtml_CommentsController extends Mage_Adminhtml_Controller_Action
{
  public function indexAction()
  {
          $this->loadLayout();
          $this->renderLayout();        
  }


  
  public function addAction()
  {
    $data       = $this->getRequest()->getPost();
    $comment    = Mage::getModel('comments/post');        
    $comment    ->setAuthor($data['Author']);
    $comment    ->setComment($data['Comment']);
    $comment    ->setDate(date("Y-m-d H:i:s"));
    $comment    ->setTask($data['Task_id']);
    $comment    ->setProject($data['Project_id']);
    $comment    ->save();
    $this       ->_redirectUrl($_SERVER['HTTP_REFERER']);
  }



  public function deleteAction()
  {
    $id         = $this->getRequest()->getParam('id');
    $comment    = Mage::getModel('comments/post');
    try 
      {
        $comment  ->setId($id)->delete();
        $this     ->_redirectUrl($_SERVER['HTTP_REFERER']);
      }
    catch (Exception $e){
        echo $e->getMessage();
        $this     ->_redirectUrl($_SERVER['HTTP_REFERER']);
}

  }
}