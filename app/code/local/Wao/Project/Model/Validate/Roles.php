<?php
class Wao_Project_Model_Validate_Roles extends Mage_Core_Model_Config_Data {

    protected $_formData = array();

    public function __construct()
    {
        parent::__construct();
        $this->_eventPrefix = 'wao_roles';
    }

    protected function _beforeSave()
    {
        if ($this->isValueChanged()) {

            $this->_formData = $this->getFieldset_data();
            
            if ($this->_formData['admin_role'][0] == 0 OR $this->_formData['manager_role'][0] == 0) {
                Mage::throwException(__('Fields haven\'t been valid! First character must be greater than zero.'));
            }
            
            parent::_beforeSave();
        }
        
        return $this;
    }
    
    public function save()
    {
        if ($this->isValueChanged()) {
            parent::save();
        }
        
        return $this;
    }

    protected function _afterSave()
    {
        if ($this->isValueChanged()) {
            parent::_afterSave();

            Mage::getModel('project/observer_setRole')->configAccessLevel(NULL, $this->_formData);
        }
        
        return $this;
    }
}
?>
