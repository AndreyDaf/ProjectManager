<?php
class Wao_Project_Model_Observer {
    
    public function configAccessLevel($observer)
    {   
        $roleId = Mage::helper('project/data')->getUserRoleId();
        
        switch ($roleId) {
            case 1:
                $roleName = 'admin';
                break;
            case 3:
                $roleName = 'manager';
                break;
            default:
                $roleName = 'worker';
        }
        
        Mage::getSingleton('admin/session')->setWorkerRole($roleName);
        
        return $this;
    }
}
?>
