-- MySQL dump 10.13  Distrib 5.7.35, for Win64 (x86_64)
--
-- Host: localhost    Database: mvcdocker2
-- ------------------------------------------------------
-- Server version	5.7.38

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `esgi_category`;
CREATE TABLE `esgi_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `color` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


LOCK TABLES `esgi_category` WRITE;

  UNLOCK TABLES;

DROP TABLE IF EXISTS  `".$db_prefix."template`;

  CREATE TABLE  `".$db_prefix."template` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL,
    `color` varchar(6) NOT NULL,
    `font` varchar(255) NOT NULL,
    `background` varchar(6) NOT NULL,
    `logo` varchar(6) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

  LOCK TABLES `".$db_prefix."template` WRITE;

UNLOCK TABLES;

DROP TABLE IF EXISTS `esgi_checkout`;

CREATE TABLE `esgi_checkout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `esgi_checkout_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `esgi_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;


LOCK TABLES `esgi_checkout` WRITE;

UNLOCK TABLES;


DROP TABLE IF EXISTS `esgi_checkout_product`;

CREATE TABLE `esgi_checkout_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_checkout` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_checkout` (`id_checkout`),
  CONSTRAINT `esgi_checkout_product_ibfk_1` FOREIGN KEY (`id_checkout`) REFERENCES `esgi_checkout` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;


LOCK TABLES `esgi_checkout_product` WRITE;

UNLOCK TABLES;


DROP TABLE IF EXISTS `esgi_comment`;

CREATE TABLE `esgi_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_page` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` mediumtext NOT NULL,
  `verified` tinyint(4) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `reported` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_page` (`id_page`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `esgi_comment_ibfk_1` FOREIGN KEY (`id_page`) REFERENCES `esgi_page` (`id`),
  CONSTRAINT `esgi_comment_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `esgi_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


LOCK TABLES `esgi_comment` WRITE;

UNLOCK TABLES;



DROP TABLE IF EXISTS `esgi_page`;

CREATE TABLE `esgi_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;


LOCK TABLES `esgi_page` WRITE;

UNLOCK TABLES;



DROP TABLE IF EXISTS `esgi_product`;

CREATE TABLE `esgi_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` float NOT NULL,
  `stock` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


LOCK TABLES `esgi_product` WRITE;

UNLOCK TABLES;



DROP TABLE IF EXISTS `esgi_role`;

CREATE TABLE `esgi_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


LOCK TABLES `esgi_role` WRITE;
INSERT INTO `esgi_role` VALUES (1,'user'),(2,'editor'),(3,'admin');
UNLOCK TABLES;


DROP TABLE IF EXISTS `esgi_user`;

CREATE TABLE `esgi_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(320) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `id_role` int(11) DEFAULT NULL,
  `token` char(255) DEFAULT NULL,
  `reset_token` char(255) DEFAULT NULL,
  `auth_token` char(255) DEFAULT NULL,
  `reset_token_expiration` timestamp NULL DEFAULT NULL,
  `token_expiration` timestamp NULL DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `esgi_user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `esgi_role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `esgi_user` WRITE;

UNLOCK TABLES;

