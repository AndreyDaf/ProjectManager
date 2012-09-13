<?php

class Wao_Files_Model_Mysql4_Files_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct(){
        parent::_construct();
        $this->_init('files/files');
    } 
    
    public function checkPath($path){
        $result = $this->getConnection()
                ->select()
                ->from('wao_files')
                ->where('path = ?', $path);
        $this->_select = $result;
        if($this->getData()){
            return true;
        } else {
            return false;
        }
    }
    
    public function insertFileData($post,$fileName,$path){
        $sql = "INSERT INTO `wao_files`(`name`,`module_name`,`entity`,`date`,`path`,`author`)
            VALUES('$fileName','{$post['module_name']}',{$post['entity']},'{$post['date']}','$path','{$post['author']}')";
        $res = $this->getConnection()->query($sql);
           if($res) return true; else return false;
    }
}
