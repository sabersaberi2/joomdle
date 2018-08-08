CREATE TABLE IF NOT EXISTS `#__coursegroups_groups` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`usergroups_id` int(11) NOT NULL,
`courses` text NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;
