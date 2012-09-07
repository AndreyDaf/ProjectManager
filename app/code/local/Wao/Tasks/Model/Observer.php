<?php

class Wao_Tasks_Model_Observer
{
    public function configAccessLevel($observer)
    {
        $roleId = Mage::helper('tasks')->getUserRole();
        
        switch($roleId){
            case 1: $roleName = 'admin'; break;
            case 3: $roleName = 'manager'; break;
            default: $roleName = 'worker';
        }
        
        Mage::getSingleton('core/session')->setWorkerRole($roleName);
        
        return $this;
    }
}
