<?php

$installer = $this;
 
$installer->startSetup();
 
$installer->run("

-- DROP TABLE IF EXISTS `{$this->getTable('statuses/status')}`;
CREATE TABLE `{$this->getTable('statuses/status')}` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  
    ");
 
$installer->endSetup();