<?php

$installer = $this;

$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS {$this->getTable('s')};
CREATE TABLE {$this->getTable('s')} (
`s_id` int(11) unsigned NOT NULL auto_increment,
`title` varchar(255) NOT NULL default '',
`filename` varchar(255) NOT NULL default '',
`content` text NOT NULL default '',
`url` varchar(50) NOT NULL default '',
`price` int(11) NOT NULL default '0',
`date` datetime NULL,
`status` smallint(6) NOT NULL default '0',
`created_time` datetime NULL,
`update_time` datetime NULL,
PRIMARY KEY (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");


$installer->endSetup(); 