<?php


class Wao_Uploader_Helper_Data extends Mage_Core_Helper_Data
{
    
    const XML_PATH_EXPORT_LOCAL_VALID_PATH = 'general/file/importexport_local_valid_paths';
    const XML_PATH_BUNCH_SIZE = 'general/file/bunch_size';

    
    public function getMaxUploadSize()
    {
        return min(ini_get('post_max_size'), ini_get('upload_max_filesize'));
    }

    
}
