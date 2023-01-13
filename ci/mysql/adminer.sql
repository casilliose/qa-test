-- Adminer 4.8.1 MySQL 5.7.20 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `myfintest` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `myfintest`;

DROP TABLE IF EXISTS `credits`;
CREATE TABLE `credits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `min_amount` int(10) unsigned NOT NULL,
  `max_amount` int(10) unsigned NOT NULL,
  `min_term` int(10) unsigned NOT NULL,
  `max_term` int(10) unsigned NOT NULL,
  `target` int(10) unsigned NOT NULL,
  `history` int(10) unsigned NOT NULL,
  `real_estate` int(10) unsigned NOT NULL,
  `have_car` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;

INSERT INTO `credits` (`id`, `min_amount`, `max_amount`, `min_term`, `max_term`, `target`, `history`, `real_estate`, `have_car`) VALUES
(1,	1000,	10000,	1,	6,	1,	4,	1,	1),
(2,	1000,	10000,	6,	12,	2,	2,	2,	2),
(3,	1000,	10000,	12,	22,	3,	1,	3,	1),
(4,	1000,	10000,	22,	36,	1,	4,	1,	1),
(5,	10000,	100000,	1,	6,	2,	1,	3,	2),
(6,	100000,	1000000,	1,	6,	3,	1,	2,	1),
(7,	1000,	100000,	1,	6,	1,	4,	1,	2),
(8,	1000,	10000,	12,	26,	2,	1,	3,	2),
(9,	5000,	15000,	1,	32,	3,	1,	1,	2),
(10,	3000,	12000,	1,	6,	1,	1,	1,	1),
(11,	1001,	999999,	2,	3,	2,	3,	2,	1),
(12,	7000,	12000,	1,	6,	3,	1,	1,	2),
(13,	1000,	10000,	10,	26,	1,	1,	1,	2),
(14,	1000,	10000,	12,	16,	2,	2,	3,	2),
(15,	500000,	1000000,	1,	36,	3,	1,	1,	2),
(16,	1000,	100000,	12,	26,	1,	1,	1,	1),
(17,	1000,	10000,	1,	36,	2,	2,	2,	1),
(18,	1000,	10000,	1,	6,	3,	1,	1,	1),
(19,	3000,	10000,	1,	7,	1,	1,	1,	1),
(20,	1000,	10000,	1,	8,	2,	3,	2,	1),
(21,	2000,	100000,	1,	9,	3,	1,	1,	1),
(22,	1000,	1000000,	1,	10,	1,	1,	1,	1),
(23,	1000,	10000,	1,	11,	2,	4,	3,	1),
(24,	1000,	100000,	1,	12,	3,	1,	1,	1),
(25,	4000,	100000,	1,	13,	1,	1,	1,	1),
(26,	1000,	10000,	13,	15,	2,	3,	3,	1),
(27,	1000,	100000,	13,	16,	3,	1,	1,	1),
(28,	5000,	100000,	13,	17,	1,	1,	1,	2),
(29,	10000,	10000,	14,	20,	2,	2,	2,	1),
(30,	1000,	10000,	15,	21,	3,	1,	1,	2),
(31,	8000,	10000,	16,	22,	1,	1,	1,	1),
(32,	1000,	10000,	17,	23,	2,	4,	2,	1),
(33,	80000,	100000,	18,	24,	3,	1,	1,	2),
(34,	1000,	100000,	19,	26,	1,	3,	1,	1),
(35,	1000,	10000,	1,	12,	2,	1,	1,	1),
(36,	60000,	10000,	1,	25,	3,	2,	3,	1),
(37,	1000,	100000,	1,	6,	1,	1,	1,	2),
(38,	5000,	100000,	1,	6,	2,	1,	1,	1);

DROP TABLE IF EXISTS `request_offers`;
CREATE TABLE `request_offers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `credits_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `credits_id` (`credits_id`),
  CONSTRAINT `request_offers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `request_offers_ibfk_2` FOREIGN KEY (`credits_id`) REFERENCES `credits` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `is_confirm` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- 2023-01-13 00:56:24
