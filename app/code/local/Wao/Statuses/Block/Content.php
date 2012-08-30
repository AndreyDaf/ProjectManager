<?php
class Wao_Statuses_Block_Content extends Mage_Core_Block_Template
{
    public function getCollection()
    {
      $model = Mage::getModel('statuses/status');
      $statuses = $model->getCollection();
      var_dump($statuses);
      //return $statuses;
    }
}
