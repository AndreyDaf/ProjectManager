<?php

$installer = $this;

$installer->startSetup();

$installer->run("
       
CREATE TABLE IF NOT EXISTS `{$installer->getTable('files/files')}` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `entity` int(11) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `path` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

");

$installer->endSetup();
