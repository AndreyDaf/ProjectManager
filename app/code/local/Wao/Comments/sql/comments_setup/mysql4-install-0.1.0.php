<?php

$installer = $this;
 
$installer->startSetup();
 
$installer->run("

-- DROP TABLE IF EXISTS `{$this->getTable('comments/post')}`;
CREATE TABLE `{$this->getTable('comments/post')}` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `task` int(11) unsigned,
  `project` int(11) unsigned,
  `comment` text NOT NULL default '',
  `date` datetime NULL,
  `author` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  
    ");
 
$installer->endSetup();