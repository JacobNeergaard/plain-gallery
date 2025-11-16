CREATE TABLE `auth_user` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`username` varchar(50) NOT NULL,
	`password` varchar(255) NOT NULL DEFAULT '',
	`confirmation` varchar(255) NOT NULL DEFAULT '',
	`tfa` varchar(255) DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `username` (`username`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `auth_access` (
	`user_id` int(10) unsigned NOT NULL,
	`permission` varchar(30) NOT NULL,
	PRIMARY KEY (`user_id`,`permission`),
	FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `auth_token` (
	`user_id` int(10) unsigned NOT NULL,
	`token` varchar(44) NOT NULL,
	`expires` DATETIME NOT NULL,
	PRIMARY KEY (`token`),
	KEY `user_id` (`user_id`),
	FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `auth_pending` (
	`user_id` int(10) unsigned NOT NULL,
	`username` varchar(50) NOT NULL,
	`expires` DATETIME NOT NULL,
	PRIMARY KEY (`user_id`),
	FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `collection` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`text` text NOT NULL,
	`created` datetime NOT NULL DEFAULT current_timestamp(),
	PRIMARY KEY (`id`),
	KEY `created` (`created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `collection_file` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`collection_id` int(10) unsigned NOT NULL,
	`name` varchar(100) NOT NULL,
	`mime` varchar(128) NOT NULL,
	`size` int(10) unsigned NOT NULL,
	`checksum` char(64) NOT NULL,
	`meta_datetime` datetime NULL,
	PRIMARY KEY (`id`),
	KEY `collection_id` (`collection_id`),
	FOREIGN KEY (`collection_id`) REFERENCES `collection` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
