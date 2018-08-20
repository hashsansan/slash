/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.57-MariaDB-wsrep : Database - otrs2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`otrs2` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;

USE `otrs2`;

/*Table structure for table `article` */

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ticket_id` bigint(20) NOT NULL,
  `article_type_id` smallint(6) NOT NULL,
  `article_sender_type_id` smallint(6) NOT NULL,
  `a_from` text,
  `a_reply_to` text,
  `a_to` text,
  `a_cc` text,
  `a_subject` text,
  `a_message_id` text,
  `a_message_id_md5` varchar(32) DEFAULT NULL,
  `a_in_reply_to` text,
  `a_references` text,
  `a_content_type` varchar(250) DEFAULT NULL,
  `a_body` mediumtext NOT NULL,
  `incoming_time` int(11) NOT NULL,
  `content_path` varchar(250) DEFAULT NULL,
  `valid_id` smallint(6) NOT NULL,
  `create_time` datetime NOT NULL,
  `create_by` int(11) NOT NULL,
  `change_time` datetime NOT NULL,
  `change_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
  /*KEY `article_article_sender_type_id` (`article_sender_type_id`),
  KEY `article_article_type_id` (`article_type_id`),
  KEY `article_message_id_md5` (`a_message_id_md5`),
  KEY `article_ticket_id` (`ticket_id`),
  KEY `FK_article_create_by_id` (`create_by`),
  KEY `FK_article_change_by_id` (`change_by`),
  KEY `FK_article_valid_id_id` (`valid_id`),
  CONSTRAINT `FK_article_article_sender_type_id_id` FOREIGN KEY (`article_sender_type_id`) REFERENCES `article_sender_type` (`id`),
  CONSTRAINT `FK_article_article_type_id_id` FOREIGN KEY (`article_type_id`) REFERENCES `article_type` (`id`),
  CONSTRAINT `FK_article_change_by_id` FOREIGN KEY (`change_by`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_article_create_by_id` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_article_ticket_id_id` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`),
  CONSTRAINT `FK_article_valid_id_id` FOREIGN KEY (`valid_id`) REFERENCES `valid` (`id`)*/
) ENGINE=InnoDB AUTO_INCREMENT=716697 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
