/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.1.73-log : Database - uspchat
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`uspchat` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `uspchat`;

/*Table structure for table `barge_logs` */

DROP TABLE IF EXISTS `barge_logs`;

CREATE TABLE `barge_logs` (
  `rowid` int(20) NOT NULL AUTO_INCREMENT,
  `tranid` int(20) DEFAULT NULL,
  `sup` int(20) DEFAULT NULL,
  `trandate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB AUTO_INCREMENT=755 DEFAULT CHARSET=latin1;

/*Table structure for table `barge_tool_history` */

DROP TABLE IF EXISTS `barge_tool_history`;

CREATE TABLE `barge_tool_history` (
  `rowid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(20) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  `pos` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB AUTO_INCREMENT=1894 DEFAULT CHARSET=latin1;

/*Table structure for table `chat_aht` */

DROP TABLE IF EXISTS `chat_aht`;

CREATE TABLE `chat_aht` (
  `rowid` int(20) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(20) DEFAULT NULL,
  `agentid` varchar(20) DEFAULT NULL,
  `agent_name` varchar(20) DEFAULT NULL,
  `aht` varchar(10) DEFAULT NULL,
  `aht1` int(20) DEFAULT NULL,
  `trandate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rowid`),
  KEY `aht` (`aht`),
  KEY `transid` (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=123284801 DEFAULT CHARSET=utf8;

/*Table structure for table `chat_aht_backup` */

DROP TABLE IF EXISTS `chat_aht_backup`;

CREATE TABLE `chat_aht_backup` (
  `rowid` int(20) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(20) DEFAULT NULL,
  `agentid` varchar(20) DEFAULT NULL,
  `agent_name` varchar(20) DEFAULT NULL,
  `aht` varchar(10) DEFAULT NULL,
  `aht1` int(20) DEFAULT NULL,
  `trandate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rowid`),
  KEY `aht` (`aht`),
  KEY `transid` (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=928480 DEFAULT CHARSET=utf8;

/*Table structure for table `departments` */

DROP TABLE IF EXISTS `departments`;

CREATE TABLE `departments` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `dept_region` varchar(150) DEFAULT NULL,
  `online_hours` int(2) DEFAULT '0',
  `time_avail` varchar(10) CHARACTER SET latin1 DEFAULT '6:00',
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

/*Table structure for table `dispose_logs` */

DROP TABLE IF EXISTS `dispose_logs`;

CREATE TABLE `dispose_logs` (
  `rowid` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `trans_id` int(11) DEFAULT NULL,
  `trandate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `result` varchar(50) DEFAULT NULL COMMENT 'Disposed / Cancelled',
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `group` */

DROP TABLE IF EXISTS `group`;

CREATE TABLE `group` (
  `rowid` int(20) NOT NULL AUTO_INCREMENT,
  `group_desc` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Table structure for table `istyping` */

DROP TABLE IF EXISTS `istyping`;

CREATE TABLE `istyping` (
  `rowid` int(20) NOT NULL AUTO_INCREMENT,
  `transid` int(20) DEFAULT NULL,
  `user` int(20) DEFAULT NULL,
  `comment` int(20) DEFAULT NULL,
  PRIMARY KEY (`rowid`),
  KEY `transid` (`transid`),
  KEY `user` (`user`),
  KEY `comment` (`comment`)
) ENGINE=InnoDB AUTO_INCREMENT=8353991 DEFAULT CHARSET=latin1;

/*Table structure for table `messages_barge` */

DROP TABLE IF EXISTS `messages_barge`;

CREATE TABLE `messages_barge` (
  `rowid` int(11) NOT NULL AUTO_INCREMENT,
  `message` longtext CHARACTER SET latin1,
  `trans_id` int(11) DEFAULT NULL,
  `cust_name` varchar(50) DEFAULT NULL,
  `comment` varchar(50) DEFAULT NULL,
  `time_sent` int(11) DEFAULT NULL,
  `user_id` varchar(20) CHARACTER SET latin1 DEFAULT 'XXX',
  `support_name` varchar(50) CHARACTER SET latin1 DEFAULT 'XXX',
  PRIMARY KEY (`rowid`),
  KEY `trans_id` (`trans_id`),
  KEY `time_sent` (`time_sent`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `messages_canned` */

DROP TABLE IF EXISTS `messages_canned`;

CREATE TABLE `messages_canned` (
  `rowid` int(11) NOT NULL AUTO_INCREMENT,
  `message` text CHARACTER SET latin1,
  `department` int(11) DEFAULT '0',
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

/*Table structure for table `messages_copy` */

DROP TABLE IF EXISTS `messages_copy`;

CREATE TABLE `messages_copy` (
  `rowid` int(11) NOT NULL DEFAULT '0',
  `message_blob` longblob,
  `message` longtext CHARACTER SET latin1,
  `trans_id` int(11) DEFAULT NULL,
  `time_sent` int(11) DEFAULT NULL,
  `user_id` varchar(20) CHARACTER SET latin1 DEFAULT 'XXX',
  `support_name` varchar(50) CHARACTER SET latin1 DEFAULT 'XXX'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `messages_system` */

DROP TABLE IF EXISTS `messages_system`;

CREATE TABLE `messages_system` (
  `rowid` int(11) NOT NULL AUTO_INCREMENT,
  `message` text,
  `type` varchar(50) DEFAULT NULL COMMENT 'customer/agent',
  `department` int(11) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

/*Table structure for table `offline_messages` */

DROP TABLE IF EXISTS `offline_messages`;

CREATE TABLE `offline_messages` (
  `rowid` int(11) NOT NULL AUTO_INCREMENT,
  `chat_created` int(11) DEFAULT NULL,
  `client_title` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `client_name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `client_email` varchar(60) CHARACTER SET latin1 DEFAULT NULL,
  `client_phone` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `ip_referrer` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `chat_from` varchar(50) DEFAULT NULL,
  `region` varchar(150) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `concern` text,
  `routing` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB AUTO_INCREMENT=46333 DEFAULT CHARSET=utf8;

/*Table structure for table `online_operators` */

DROP TABLE IF EXISTS `online_operators`;

CREATE TABLE `online_operators` (
  `user` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `name` varchar(70) CHARACTER SET latin1 DEFAULT NULL,
  `last_activity` int(11) DEFAULT NULL COMMENT 'updating every 30s'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `region` */

DROP TABLE IF EXISTS `region`;

CREATE TABLE `region` (
  `rowid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `dept` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `setting_name` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `setting_value` longtext CHARACTER SET latin1,
  `setting_group` varchar(150) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `survey_result` */

DROP TABLE IF EXISTS `survey_result`;

CREATE TABLE `survey_result` (
  `rowid` int(11) NOT NULL AUTO_INCREMENT,
  `transid` int(11) DEFAULT NULL,
  `survey1` varchar(5) DEFAULT NULL,
  `survey2` varchar(5) DEFAULT NULL,
  `transcript` varchar(5) DEFAULT NULL,
  `comments` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`rowid`),
  KEY `survey1` (`survey1`),
  KEY `survey2` (`survey2`),
  KEY `transid` (`transid`)
) ENGINE=InnoDB AUTO_INCREMENT=18515 DEFAULT CHARSET=utf8;

/*Table structure for table `tagging` */

DROP TABLE IF EXISTS `tagging`;

CREATE TABLE `tagging` (
  `rowid` int(20) NOT NULL AUTO_INCREMENT COMMENT '0|1|Text||0|0|1',
  `closecallid` int(20) DEFAULT '0',
  `customer_no` varchar(50) DEFAULT NULL COMMENT '0|1|Text||0|0|1',
  `xgroup` varchar(20) DEFAULT NULL COMMENT '0|0|Combo|»SELECT DISTINCT group_desc FROM uspchat.group|0|1|1',
  `touchpoint` varchar(50) DEFAULT NULL COMMENT '0|0|Combo|»SELECT DISTINCT touchpoint FROM uspchat.workcodes|0|1|1',
  `productline` varchar(50) DEFAULT NULL COMMENT '0|0|Combo|»SELECT DISTINCT productline FROM uspchat.workcodes|0|1|1',
  `workcode_desc` text COMMENT '0|0|Combo|»SELECT DISTINCT workcode_desc FROM uspchat.workcodes|0|1|1',
  `remarks` text,
  `agent_id` varchar(20) DEFAULT NULL,
  `agent_name` varchar(40) DEFAULT NULL,
  `transdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `source` varchar(50) DEFAULT NULL,
  `em_tagtimer` varchar(100) DEFAULT NULL,
  `i_action` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB AUTO_INCREMENT=393342 DEFAULT CHARSET=utf8;

/*Table structure for table `tagging_copy` */

DROP TABLE IF EXISTS `tagging_copy`;

CREATE TABLE `tagging_copy` (
  `rowid` int(20) NOT NULL AUTO_INCREMENT COMMENT '0|1|Text||0|0|1',
  `closecallid` int(20) DEFAULT '0',
  `customer_no` varchar(50) DEFAULT NULL COMMENT '0|1|Text||0|0|1',
  `xgroup` varchar(20) DEFAULT NULL COMMENT '0|0|Combo|»SELECT DISTINCT group_desc FROM uspchat.group|0|1|1',
  `touchpoint` varchar(50) DEFAULT NULL COMMENT '0|0|Combo|»SELECT DISTINCT touchpoint FROM uspchat.workcodes|0|1|1',
  `productline` varchar(50) DEFAULT NULL COMMENT '0|0|Combo|»SELECT DISTINCT productline FROM uspchat.workcodes|0|1|1',
  `workcode_desc` text COMMENT '0|0|Combo|»SELECT DISTINCT workcode_desc FROM uspchat.workcodes|0|1|1',
  `remarks` text,
  `agent_id` varchar(20) DEFAULT NULL,
  `agent_name` varchar(40) DEFAULT NULL,
  `transdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `source` varchar(50) DEFAULT NULL,
  `em_tagtimer` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB AUTO_INCREMENT=27096 DEFAULT CHARSET=utf8;

/*Table structure for table `timezones` */

DROP TABLE IF EXISTS `timezones`;

CREATE TABLE `timezones` (
  `rowid` int(3) NOT NULL AUTO_INCREMENT,
  `region` varchar(50) DEFAULT NULL,
  `timediff` int(3) DEFAULT NULL,
  `timediff_dst` int(3) DEFAULT NULL,
  `on_server_non_dst` int(3) DEFAULT NULL,
  PRIMARY KEY (`rowid`),
  KEY `rowid` (`rowid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `rowid` int(11) NOT NULL AUTO_INCREMENT,
  `chat_created` int(11) DEFAULT NULL,
  `chat_start` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `client_title` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `client_name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `client_email` varchar(60) CHARACTER SET latin1 DEFAULT NULL,
  `client_phone` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `ip_referrer` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `browser` varchar(50) DEFAULT NULL,
  `chat_duration` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `chat_end` int(11) DEFAULT NULL,
  `chat_end_agent` datetime DEFAULT NULL,
  `operator_id` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `operator_name` varchar(50) DEFAULT NULL,
  `last_message_time` int(11) DEFAULT NULL,
  `chat_from` varchar(50) DEFAULT NULL,
  `region` varchar(150) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `transfered_by` int(11) DEFAULT NULL,
  `term_reason` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `resume_count` int(11) DEFAULT '0',
  `routing` varchar(50) DEFAULT NULL,
  `tfcid` varchar(50) DEFAULT NULL,
  `goms_url` text,
  PRIMARY KEY (`rowid`),
  KEY `chat_created` (`chat_created`),
  KEY `chat_start` (`chat_start`),
  KEY `status` (`status`),
  KEY `region` (`region`),
  KEY `dept_id` (`dept_id`),
  KEY `operator_id` (`operator_id`),
  KEY `chat_from` (`chat_from`)
) ENGINE=InnoDB AUTO_INCREMENT=197861 DEFAULT CHARSET=utf8;

/*Table structure for table `transactions_copy` */

DROP TABLE IF EXISTS `transactions_copy`;

CREATE TABLE `transactions_copy` (
  `rowid` int(11) NOT NULL AUTO_INCREMENT,
  `chat_created` int(11) DEFAULT NULL,
  `chat_start` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `client_title` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `client_name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `client_email` varchar(60) CHARACTER SET latin1 DEFAULT NULL,
  `client_phone` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `ip_referrer` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `browser` varchar(50) DEFAULT NULL,
  `chat_duration` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `chat_end` int(11) DEFAULT NULL,
  `chat_end_agent` datetime DEFAULT NULL,
  `operator_id` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `operator_name` varchar(50) DEFAULT NULL,
  `last_message_time` int(11) DEFAULT NULL,
  `chat_from` varchar(50) DEFAULT NULL,
  `region` varchar(150) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `transfered_by` int(11) DEFAULT NULL,
  `term_reason` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `resume_count` int(11) DEFAULT '0',
  `routing` varchar(50) DEFAULT NULL,
  `tfcid` varchar(50) DEFAULT NULL,
  `goms_url` text,
  PRIMARY KEY (`rowid`),
  KEY `chat_created` (`chat_created`),
  KEY `chat_start` (`chat_start`),
  KEY `status` (`status`),
  KEY `region` (`region`),
  KEY `dept_id` (`dept_id`),
  KEY `operator_id` (`operator_id`)
) ENGINE=InnoDB AUTO_INCREMENT=99994 DEFAULT CHARSET=utf8;

/*Table structure for table `transfer_logs` */

DROP TABLE IF EXISTS `transfer_logs`;

CREATE TABLE `transfer_logs` (
  `rowid` int(20) NOT NULL AUTO_INCREMENT,
  `transid` int(10) DEFAULT NULL,
  `xfrom` int(10) DEFAULT NULL,
  `xto` int(10) DEFAULT NULL,
  `aht` varchar(10) DEFAULT NULL,
  `trandate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB AUTO_INCREMENT=4920 DEFAULT CHARSET=utf8;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `rowid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `name` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `hide_online` int(1) DEFAULT '0',
  `group_id` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `skillset` text,
  `isadmin` int(11) DEFAULT '0',
  `chat_count` int(20) DEFAULT NULL,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB AUTO_INCREMENT=1042 DEFAULT CHARSET=utf8;

/*Table structure for table `users_copy` */

DROP TABLE IF EXISTS `users_copy`;

CREATE TABLE `users_copy` (
  `rowid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `name` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `hide_online` int(1) DEFAULT '0',
  `group_id` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `isadmin` int(11) DEFAULT '0',
  `chat_count` int(20) DEFAULT NULL,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `workcodes` */

DROP TABLE IF EXISTS `workcodes`;

CREATE TABLE `workcodes` (
  `rowid` int(20) NOT NULL AUTO_INCREMENT,
  `touchpoint` varchar(50) DEFAULT NULL,
  `productline` varchar(50) DEFAULT NULL,
  `workcode_desc` text,
  `group` varchar(50) DEFAULT NULL,
  `trandate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(50) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB AUTO_INCREMENT=21043 DEFAULT CHARSET=utf8;

/*Table structure for table `workcodes_20160624` */

DROP TABLE IF EXISTS `workcodes_20160624`;

CREATE TABLE `workcodes_20160624` (
  `rowid` int(20) NOT NULL AUTO_INCREMENT,
  `touchpoint` varchar(50) DEFAULT NULL,
  `productline` varchar(50) DEFAULT NULL,
  `workcode_desc` text,
  `group` varchar(50) DEFAULT NULL,
  `trandate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB AUTO_INCREMENT=12614 DEFAULT CHARSET=utf8;

/*Table structure for table `workcodes_20170703` */

DROP TABLE IF EXISTS `workcodes_20170703`;

CREATE TABLE `workcodes_20170703` (
  `rowid` int(20) NOT NULL AUTO_INCREMENT,
  `touchpoint` varchar(50) DEFAULT NULL,
  `productline` varchar(50) DEFAULT NULL,
  `workcode_desc` text,
  `group` varchar(50) DEFAULT NULL,
  `trandate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(50) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB AUTO_INCREMENT=83539 DEFAULT CHARSET=utf8;

/*Table structure for table `workcodes_copy` */

DROP TABLE IF EXISTS `workcodes_copy`;

CREATE TABLE `workcodes_copy` (
  `rowid` int(20) NOT NULL AUTO_INCREMENT,
  `touchpoint` varchar(50) DEFAULT NULL,
  `productline` varchar(50) DEFAULT NULL,
  `workcode_desc` text,
  `group` varchar(50) DEFAULT NULL,
  `trandate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB AUTO_INCREMENT=312 DEFAULT CHARSET=utf8;

/*Table structure for table `workcodes_kris` */

DROP TABLE IF EXISTS `workcodes_kris`;

CREATE TABLE `workcodes_kris` (
  `rowid` int(20) NOT NULL AUTO_INCREMENT,
  `touchpoint` varchar(50) DEFAULT NULL,
  `productline` varchar(50) DEFAULT NULL,
  `workcode_desc` text,
  `group` varchar(50) DEFAULT NULL,
  `trandate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
