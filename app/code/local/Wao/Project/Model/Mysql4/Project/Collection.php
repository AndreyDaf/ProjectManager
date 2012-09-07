<?php
class Wao_Project_Model_Mysql4_Project_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('project/project');
    }
    
    public function getProjectsForUser($userId)
    {
        $select = $this->getConnection()
                ->select()
                ->from(array('p' => 'wao_projects'));
        
        $roleId = Mage::helper('project/data')->getUserRoleId();
        if ($roleId != 1) {
            $select = $select
                ->join(array('d' => 'wao_developers'), 'p.id = d.id_project', array())
                ->where('id_user = ?', $userId);
        }
        
        $this->_select = $select;
        
        return $this;
    }
}