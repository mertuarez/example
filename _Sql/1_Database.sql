-- phpMyAdmin SQL Dump

-- version 4.7.4


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET AUTOCOMMIT = 0;

START TRANSACTION;

SET time_zone = "+00:00";



CREATE DATABASE IF NOT EXISTS `example` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;

USE `example`;



DROP TABLE IF EXISTS `users`;

CREATE TABLE IF NOT EXISTS `users` (

  `id` int(11) NOT NULL AUTO_INCREMENT,

  `firstname` varchar(255) NOT NULL,

  `lastname` varchar(255) NOT NULL,

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (`id`)

) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;




COMMIT;
