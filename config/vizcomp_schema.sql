/* vizcomp sql */
DROP DATABASE IF EXISTS `vizcomp`;
CREATE DATABASE `vizcomp` CHARSET=utf8 COLLATE=utf8_bin;
USE `vizcomp`;

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

/* Table structure for users */

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(255) NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	`first_name` VARCHAR(255) NOT NULL,
	`last_name` VARCHAR(255) NOT NULL,
	`email` VARCHAR(255),
	`group_id` INT,
	`client_id` INT,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Table structure for clients */

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Table structure for documents */

DROP TABLE IF EXISTS `documents`;
CREATE TABLE `documents` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`original` VARCHAR(255) NOT NULL,
	`file_type` VARCHAR(255),
	`file_name` VARCHAR(255),
	`extension` VARCHAR(255),
	`created` DATETIME,
	`modified` DATETIME,
	`description` VARCHAR(255),
	`client_id` INT,
	`user_id` INT,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Table structure for groups */

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Table structure for acl */

DROP TABLE IF EXISTS `acos`;
CREATE TABLE `acos` (
  `id` INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` INTEGER(10) DEFAULT NULL,
  `model` VARCHAR(255) DEFAULT '',
  `foreign_key` INTEGER(10) UNSIGNED DEFAULT NULL,
  `alias` VARCHAR(255) DEFAULT '',
  `lft` INTEGER(10) DEFAULT NULL,
  `rght` INTEGER(10) DEFAULT NULL,
  PRIMARY KEY  (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `aros_acos`;
CREATE TABLE `aros_acos` (
  `id` INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `aro_id` INTEGER(10) UNSIGNED NOT NULL,
  `aco_id` INTEGER(10) UNSIGNED NOT NULL,
  `_create` CHAR(2) NOT NULL DEFAULT 0,
  `_read` CHAR(2) NOT NULL DEFAULT 0,
  `_update` CHAR(2) NOT NULL DEFAULT 0,
  `_delete` CHAR(2) NOT NULL DEFAULT 0,
  PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `aros`;
CREATE TABLE `aros` (
  `id` INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` INTEGER(10) DEFAULT NULL,
  `model` VARCHAR(255) DEFAULT '',
  `foreign_key` INTEGER(10) UNSIGNED DEFAULT NULL,
  `alias` VARCHAR(255) DEFAULT '',
  `lft` INTEGER(10) DEFAULT NULL,
  `rght` INTEGER(10) DEFAULT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Record inserts */

/* Groups */

BEGIN;
INSERT INTO `groups` VALUES
(1, 'admin'),
(2, 'user'),
(3, 'anonymous');
COMMIT;

/* Clients */

BEGIN;
INSERT INTO `clients` VALUES
(1, 'geneo');
COMMIT;

/* Users */

BEGIN;
INSERT INTO `users` VALUES
(1, 'admin', '11b1ee0dfe53534c6d88037175159d679642c291', 'firstname', 'lastname', 'pur3forlyphe@gmail.com', 1, 1);
COMMIT;


/* Documents */
