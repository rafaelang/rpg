SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `rpg` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `rpg`;

INSERT INTO `player` (`resource_id`, `speed`, `strong`, `life`, `name`, `id`) VALUES
  (1,	2,	1,	12,	'Humano',	1),
  (2,	0,	2,	20,	'Orc',	2);

INSERT INTO `resource` (`dice`, `defense`, `attack`, `name`, `id`) VALUES
  (6,	2,	1,	'Espada longa',	1),
  (8,	0,	1,	'Clava de madeira',	2);