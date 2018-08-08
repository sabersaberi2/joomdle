CREATE TABLE IF NOT EXISTS `#__jgroups_mappings` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`moodle_group_id` INT(11)  NOT NULL ,
`joomla_group_id` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;
