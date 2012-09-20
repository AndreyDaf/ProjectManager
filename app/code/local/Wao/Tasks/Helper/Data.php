<?php

class Wao_Tasks_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getUserRole(){
        $roleId = Mage::getSingleton('admin/session')->getUser()->getRole()->getRoleId();
        return $roleId;
        
    }
    
    public function arrayToCollection($array){
        $collection = new Varien_Data_Collection();
        foreach ($array as $value) {
            $item = new Varien_Object();
            $item->setData($value);
            $collection->addItem($item);
        }
        
        return $collection;
    }

}
