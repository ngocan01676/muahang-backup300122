<?php return array (
  'plugin_comments' => 'CREATE TABLE @TABLE@ (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT \'0\',
  `parent_id` int(10) unsigned NOT NULL DEFAULT \'0\',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cms_comments_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci',
);