/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 10.4.22-MariaDB : Database - db_project_management
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_project_management` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_project_management`;

/*Table structure for table `module_functions` */

DROP TABLE IF EXISTS `module_functions`;

CREATE TABLE `module_functions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `function_name` varchar(150) NOT NULL,
  `function_description` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `project_attachments` */

DROP TABLE IF EXISTS `project_attachments`;

CREATE TABLE `project_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `real_filename` varchar(255) NOT NULL,
  `added_by` tinyint(1) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `project_modules` */

DROP TABLE IF EXISTS `project_modules`;

CREATE TABLE `project_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` tinyint(4) NOT NULL,
  `module_name` varchar(150) NOT NULL,
  `module_description` text DEFAULT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `project_owners` */

DROP TABLE IF EXISTS `project_owners`;

CREATE TABLE `project_owners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` tinyint(3) NOT NULL,
  `owner_id` tinyint(3) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `project_statuses` */

DROP TABLE IF EXISTS `project_statuses`;

CREATE TABLE `project_statuses` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `project_techs` */

DROP TABLE IF EXISTS `project_techs`;

CREATE TABLE `project_techs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `tech_name` varchar(150) NOT NULL,
  `tech_description` text DEFAULT NULL,
  `tech_version` varchar(50) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `projects` */

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(150) NOT NULL,
  `project_description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `ticket_categories` */

DROP TABLE IF EXISTS `ticket_categories`;

CREATE TABLE `ticket_categories` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `ticket_statuses` */

DROP TABLE IF EXISTS `ticket_statuses`;

CREATE TABLE `ticket_statuses` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `tickets` */

DROP TABLE IF EXISTS `tickets`;

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` tinyint(4) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `category_id` tinyint(4) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `assigned_to` tinyint(4) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `role_id` tinyint(1) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `vw_projects` */

DROP TABLE IF EXISTS `vw_projects`;

/*!50001 DROP VIEW IF EXISTS `vw_projects` */;
/*!50001 DROP TABLE IF EXISTS `vw_projects` */;

/*!50001 CREATE TABLE  `vw_projects`(
 `id` int(11) ,
 `project_name` varchar(150) ,
 `project_description` text ,
 `status` tinyint(1) ,
 `is_deleted` tinyint(1) ,
 `date_created` datetime ,
 `created_by` int(11) ,
 `project_status` varchar(150) 
)*/;

/*Table structure for table `vw_project_details` */

DROP TABLE IF EXISTS `vw_project_details`;

/*!50001 DROP VIEW IF EXISTS `vw_project_details` */;
/*!50001 DROP TABLE IF EXISTS `vw_project_details` */;

/*!50001 CREATE TABLE  `vw_project_details`(
 `id` int(11) ,
 `project_name` varchar(150) ,
 `project_description` text ,
 `status` tinyint(1) ,
 `date_created` datetime ,
 `created_by` varchar(201) 
)*/;

/*Table structure for table `vw_project_modules` */

DROP TABLE IF EXISTS `vw_project_modules`;

/*!50001 DROP VIEW IF EXISTS `vw_project_modules` */;
/*!50001 DROP TABLE IF EXISTS `vw_project_modules` */;

/*!50001 CREATE TABLE  `vw_project_modules`(
 `id` int(11) ,
 `project_id` tinyint(4) ,
 `module_name` varchar(150) ,
 `module_description` text ,
 `date_created` datetime ,
 `progress` decimal(26,0) 
)*/;

/*View structure for view vw_projects */

/*!50001 DROP TABLE IF EXISTS `vw_projects` */;
/*!50001 DROP VIEW IF EXISTS `vw_projects` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_projects` AS (select `a`.`id` AS `id`,`a`.`project_name` AS `project_name`,`a`.`project_description` AS `project_description`,`a`.`status` AS `status`,`a`.`is_deleted` AS `is_deleted`,`a`.`date_created` AS `date_created`,`a`.`created_by` AS `created_by`,`b`.`name` AS `project_status` from (`projects` `a` join `project_statuses` `b` on(`a`.`status` = `b`.`id`))) */;

/*View structure for view vw_project_details */

/*!50001 DROP TABLE IF EXISTS `vw_project_details` */;
/*!50001 DROP VIEW IF EXISTS `vw_project_details` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_project_details` AS (select `a`.`id` AS `id`,`a`.`project_name` AS `project_name`,`a`.`project_description` AS `project_description`,`a`.`status` AS `status`,`a`.`date_created` AS `date_created`,concat(`b`.`first_name`,' ',`b`.`last_name`) AS `created_by` from (`projects` `a` left join `users` `b` on(`a`.`created_by` = `b`.`id`))) */;

/*View structure for view vw_project_modules */

/*!50001 DROP TABLE IF EXISTS `vw_project_modules` */;
/*!50001 DROP VIEW IF EXISTS `vw_project_modules` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_project_modules` AS (select `a`.`id` AS `id`,`a`.`project_id` AS `project_id`,`a`.`module_name` AS `module_name`,`a`.`module_description` AS `module_description`,`a`.`date_created` AS `date_created`,floor(if(`b`.`complete` is null,0,`b`.`complete` / (`b`.`complete` + `b`.`not_complete`) * 100)) AS `progress` from (`db_project_management`.`project_modules` `a` left join (select `db_project_management`.`module_functions`.`module_id` AS `module_id`,sum(case when `db_project_management`.`module_functions`.`status` = 1 then 1 else 0 end) AS `complete`,sum(case when `db_project_management`.`module_functions`.`status` = 2 or `db_project_management`.`module_functions`.`status` = 3 then 1 else 0 end) AS `not_complete` from `db_project_management`.`module_functions` group by `db_project_management`.`module_functions`.`module_id`) `b` on(`a`.`id` = `b`.`module_id`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
