DROP TABLE IF EXISTS `{#}users_google2fa`;
CREATE TABLE `{#}users_google2fa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `is_enabled` tinyint(1) DEFAULT 0,
  `secret_key` varchar(50) DEFAULT NULL,
  `restore_code` mediumtext DEFAULT NULL,
  PRIMARY KEY (`id`,`user_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

