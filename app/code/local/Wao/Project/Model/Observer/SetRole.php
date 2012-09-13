<?php
class Wao_Project_Model_Observer_SetRole {
    
    public function configAccessLevel($observer, $rolesId = array())
    {   
        if (empty($rolesId)) {
            $rolesId = Mage::getStoreConfig('wao_roles/set_roles');
        }

        $currentRoleId = Mage::helper('project/data')->getUserRoleId();

        switch ($currentRoleId) {
            case $rolesId['admin_role']:
                $roleName = 'admin';
                break;

            case $rolesId['manager_role']:
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
