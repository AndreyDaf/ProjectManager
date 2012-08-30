<?php

$installer = $this;

$installer->startSetup();

$installer->run("

    DROP TABLE IF EXISTS {$this->getTable('project/project')};

    CREATE TABLE {$this->getTable('project/project')} (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `description` text NOT NULL,
        `repository` varchar(255) NOT NULL,
        `start_date` datetime NOT NULL,
        `end_date` datetime NOT NULL,
        `fk_status` int(11) unsigned NOT NULL,
        `status` varchar(100) NOT NULL,
        PRIMARY KEY (`id`),
        KEY `fk_status` (`fk_status`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

INSERT INTO {$this->getTable('project/project')} (`id`, `name`, `description`, `repository`, `start_date`, `end_date`, `fk_status`, `status`) VALUES
(1, 'forpix', 'Project''s description', '', '2012-08-17 15:00:00', '2012-08-24 17:00:00', 1, 'в разработке');

  ");

$installer->endSetup();
?>
