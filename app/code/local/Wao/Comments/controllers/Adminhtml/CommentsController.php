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
  } 


  public function deleteAction()
  {
    $id         = $this->getRequest()->getParam('id');
    $comment    = Mage::getModel('comments/post');
    try {
      $comment  ->setId($id)->delete();
    }
    catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function editAction()
  {
    $data       = $this->getRequest()->getPost();
    $comment    = Mage::getModel('comments/post')->load($data['id']);

    $comment    ->setAuthor($data['Author']);
    $comment    ->setComment($data['Comment']);
    $comment    ->setDate(date("Y-m-d H:i:s"));
    $comment    ->setTask($data['Task_id']);
    $comment    ->setProject($data['Project_id']);

    $comment    ->setId($data['id'])->save();
    $this       ->_redirectUrl($_SERVER['HTTP_REFERER']);
  }

  public function sortAction()
  {
    $data = $this->getRequest()->getPost();
    Mage::getSingleton('core/session')->setOrder($data['sort']);
    $this->_redirectUrl($_SERVER['HTTP_REFERER']);
  }


}