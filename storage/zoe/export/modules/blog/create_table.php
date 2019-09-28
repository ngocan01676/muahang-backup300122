<?php return array (
  'blog_post' => 'CREATE TABLE @TABLE@ (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `views` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8',
  'blog_post_category' => 'CREATE TABLE @TABLE@ (
  `category_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`category_id`,`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci',
  'blog_post_translation' => 'CREATE TABLE @TABLE@ (
  `post_id` int(10) NOT NULL,
  `lang_code` varchar(5) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  UNIQUE KEY `post_id` (`post_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1',
);