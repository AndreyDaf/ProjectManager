<?php

class Wao_Files_Helper_Data extends Mage_Core_Helper_Data
{
    public function getMaxUploadSize()
    {
        return min(ini_get('post_max_size'), ini_get('upload_max_filesize'));
    }

    
}
