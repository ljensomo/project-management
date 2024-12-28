

CREATE TABLE `database_backups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(150) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO database_backups VALUES('7','db-backup-20241215054306.sql','2024-12-15 12:43:06');
INSERT INTO database_backups VALUES('8','db-backup-20241223180602.sql','2024-12-24 01:06:02');





CREATE TABLE `module_functions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `function_name` varchar(150) NOT NULL,
  `function_description` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;

INSERT INTO module_functions VALUES('1','1','Create ticket','To create a ticket for specific project','1','2024-10-17 20:15:09');
INSERT INTO module_functions VALUES('2','2','Add module','Add module of a project.','1','2024-10-17 20:17:05');
INSERT INTO module_functions VALUES('3','2','Edit Module','Edit module of a project.','1','2024-10-17 20:17:21');
INSERT INTO module_functions VALUES('4','2','Delete Module','Delete module of a project','1','2024-10-17 20:17:59');
INSERT INTO module_functions VALUES('5','2','Add Owner','Add owner of the project.','1','2024-10-17 20:19:00');
INSERT INTO module_functions VALUES('6','2','Remove Owner','Remove Owner of the project.','1','2024-10-17 20:19:20');
INSERT INTO module_functions VALUES('7','3','Add Project','Add new project.','1','2024-10-17 20:23:11');
INSERT INTO module_functions VALUES('8','3','Edit Project','Edit project details','1','2024-10-17 20:23:23');
INSERT INTO module_functions VALUES('9','3','Delete Project','Delete project from projects list.','1','2024-10-17 20:23:46');
INSERT INTO module_functions VALUES('10','5','Add user','Adding of new user.','1','2024-10-17 21:50:26');
INSERT INTO module_functions VALUES('11','5','Edit User','Editing of user details.','1','2024-10-17 21:51:01');
INSERT INTO module_functions VALUES('12','5','Activate/Deactivate of user','Activating and deactivating of user.','1','2024-10-17 21:51:54');
INSERT INTO module_functions VALUES('13','2','Edit Project Details','Updating of project details.','1','2024-10-17 21:53:07');
INSERT INTO module_functions VALUES('14','2','Add attachment','Adding of attachment.','1','2024-10-17 21:53:59');
INSERT INTO module_functions VALUES('15','2','Remove attachment','Removing of attachment.','1','2024-10-17 21:54:16');
INSERT INTO module_functions VALUES('16','1','Edit Ticket','Updating of ticket details.','1','2024-10-17 22:02:49');
INSERT INTO module_functions VALUES('17','1','Add comment','Adding of comments in the ticket.','3','2024-10-17 22:04:06');
INSERT INTO module_functions VALUES('18','6','Login','Loggin in the system for valid users only.','1','2024-10-17 22:05:33');
INSERT INTO module_functions VALUES('19','6','Logout','Logging out to system.','1','2024-10-17 22:05:53');
INSERT INTO module_functions VALUES('20','1','Delete Ticket','Deleting of ticket.','1','2024-10-17 22:09:56');
INSERT INTO module_functions VALUES('21','1','Download CSV','Downloading of ticket records to CSV file.','3','2024-10-17 22:14:32');
INSERT INTO module_functions VALUES('22','7','Login','Function to input username/userid and password and validate by the system if user is valid and active.','3','2024-10-27 11:11:54');
INSERT INTO module_functions VALUES('23','7','Logout','Function to logout the session of logged user. When logging out, all session details will be destroyed and cleared.','3','2024-10-27 11:13:08');
INSERT INTO module_functions VALUES('24','8','Add Member','Function to register a new member in to the system.','3','2024-10-27 11:14:10');
INSERT INTO module_functions VALUES('25','8','Edit Member','Function to edit the details of the member.','3','2024-10-27 11:14:43');
INSERT INTO module_functions VALUES('26','8','Delete Member','Function to delete member from the list. (Record is not totally deleted in the system but is only removed from the system view.','3','2024-10-27 11:16:09');
INSERT INTO module_functions VALUES('27','11','Add Machine','Function to add new machine.','3','2024-10-27 11:23:47');
INSERT INTO module_functions VALUES('28','11','Edit Machine','Function to update the details of the machine.','3','2024-10-27 11:33:50');
INSERT INTO module_functions VALUES('29','12','Create ticket','To create a ticket for specific project','1','2024-11-24 15:06:40');
INSERT INTO module_functions VALUES('30','12','Create ticket','To create a ticket for specific project','1','2024-11-24 15:06:54');
INSERT INTO module_functions VALUES('31','12','Delete','Function to delete entry.','1','2024-11-24 15:07:04');
INSERT INTO module_functions VALUES('35','14','Generate Backup','Allows user to genarate a backup of database currently.','1','2024-12-15 12:15:11');
INSERT INTO module_functions VALUES('36','14','Delete Backup','This module allows user to remove selected backup.','1','2024-12-15 12:18:28');
INSERT INTO module_functions VALUES('37','1','Ticket Page','Ticket Page','3','2024-12-23 23:42:13');





CREATE TABLE `project_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `real_filename` varchar(255) NOT NULL,
  `added_by` tinyint(1) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;






CREATE TABLE `project_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` tinyint(4) NOT NULL,
  `module_name` varchar(150) NOT NULL,
  `module_description` text DEFAULT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

INSERT INTO project_modules VALUES('1','1','Ticket','Creating of tickets related to the application, whether about issue or request.','2024-10-17 21:56:27');
INSERT INTO project_modules VALUES('2','1','Project Details','Management of details of the projects such as project name, description, owner.','2024-10-17 21:56:27');
INSERT INTO project_modules VALUES('3','1','Project','Managemet of list of projects.','2024-10-17 21:56:27');
INSERT INTO project_modules VALUES('5','1','Users','Management of users.','2024-10-17 21:56:27');
INSERT INTO project_modules VALUES('6','1','Login/Logout','Function to validating of users to access the system.','2024-10-17 22:05:14');
INSERT INTO project_modules VALUES('7','2','Login','This module includes the login and logout feature for the system. Only valid users are allowed to login in the system.','2024-10-27 11:09:32');
INSERT INTO project_modules VALUES('8','2','Members Management','This module allows the user to manage the details of all members of the gym.','2024-10-27 11:10:58');
INSERT INTO project_modules VALUES('9','2','Admin Users Management','This module allows user to manage the user admins of the system.','2024-10-27 11:16:49');
INSERT INTO project_modules VALUES('10','2','Dashboard','This module allows user to view visual reports related to gym\'s relevant information.','2024-10-27 11:18:39');
INSERT INTO project_modules VALUES('11','2','Machines Management','This module allows user to manage the details of the machines in the gym.','2024-10-27 11:23:28');
INSERT INTO project_modules VALUES('12','1','Technology','This module allow users to manage all technologies used for the certain project.','2024-11-24 11:34:34');
INSERT INTO project_modules VALUES('14','1','Database Backup','This module allows user to perform backup of database manually. This also allows users to view all created backups.','2024-11-24 15:30:00');
INSERT INTO project_modules VALUES('15','1','Audit Logs','This module allows user to view all logs within the system.','2024-11-24 15:32:53');





CREATE TABLE `project_owners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` tinyint(3) NOT NULL,
  `owner_id` tinyint(3) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

INSERT INTO project_owners VALUES('3','2','1','2024-10-27 11:01:33');
INSERT INTO project_owners VALUES('22','1','1','2024-12-26 22:23:06');





CREATE TABLE `project_statuses` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO project_statuses VALUES('1','New','Newly created.');
INSERT INTO project_statuses VALUES('2','Planning',NULL);
INSERT INTO project_statuses VALUES('3','On Hold',NULL);
INSERT INTO project_statuses VALUES('4','In Progress',NULL);





CREATE TABLE `project_techs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `tech_name` varchar(150) NOT NULL,
  `tech_description` text DEFAULT NULL,
  `tech_version` varchar(50) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

INSERT INTO project_techs VALUES('2','1','MySQL','Database','10.4.22-MariaDB','2024-11-24 10:09:43');
INSERT INTO project_techs VALUES('3','1','SweetAlert2','Pretty Alerts\r\njs: https://cdn.jsdelivr.net/npm/sweetalert2@11','v11.14.5','2024-11-24 10:27:12');
INSERT INTO project_techs VALUES('4','1','Bootstrap5','Front-end\r\njs: https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\r\ncss: https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css','v5.3.0','2024-11-24 10:27:29');
INSERT INTO project_techs VALUES('5','1','jQuery','Javascript Framework\r\njs: https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js','v3.6.4','2024-11-24 11:08:36');
INSERT INTO project_techs VALUES('6','1','Fontawesome','User for icons in buttons and menu. https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css','4.7.0','2024-11-24 11:10:24');
INSERT INTO project_techs VALUES('7','1','jQuery DataTables','css: //cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css\r\njs: //cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css','1.10.21','2024-11-24 11:15:52');





CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(150) NOT NULL,
  `project_description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

INSERT INTO projects VALUES('1','Project Management','This application is used to monitor all applications developed and ongoing development.','4','0','2024-10-17 18:20:39','0');
INSERT INTO projects VALUES('2','Gym Management System','System for management of data for a gym facility.','2','0','2024-10-27 11:01:15','0');
INSERT INTO projects VALUES('3','test','asd','1','1','2024-11-21 20:22:19','0');
INSERT INTO projects VALUES('4','asd','asd','1','1','2024-11-21 21:56:58','0');
INSERT INTO projects VALUES('5','asdd','asd','1','1','2024-11-21 23:39:47','0');
INSERT INTO projects VALUES('6','asdddd','asd','1','1','2024-11-21 23:40:21','0');
INSERT INTO projects VALUES('7','asd','asdd','1','1','2024-11-21 23:46:23','0');
INSERT INTO projects VALUES('8','asdd','asd','1','1','2024-11-21 23:47:08','0');
INSERT INTO projects VALUES('9','dsa','asd','1','1','2024-11-21 23:48:09','0');
INSERT INTO projects VALUES('10','AI','An application that would assist me.','1','0','2024-11-23 20:03:47','0');
INSERT INTO projects VALUES('11','Discord Bot','Commandable bot in discord','1','0','2024-11-23 20:20:16','0');
INSERT INTO projects VALUES('12','sample','sample','1','1','2024-11-23 21:42:00','0');
INSERT INTO projects VALUES('13','sample2asd','sample22','1','1','2024-11-23 21:44:20','1');
INSERT INTO projects VALUES('14','hagsjhdgajhs',' asjhgasd','1','1','2024-11-24 15:33:38','1');
INSERT INTO projects VALUES('15','Expense Tracker Application','This application is used to track all the expenses the user will have. This also gives user a overview of the expenses.','1','0','2024-12-15 13:31:52','1');
INSERT INTO projects VALUES('16','Sample','test','1','1','2024-12-25 21:48:57','1');
INSERT INTO projects VALUES('17','asd4321','asd','1','1','2024-12-25 22:26:17','1');
INSERT INTO projects VALUES('18','asd','asdddasda','1','1','2024-12-25 22:30:58','1');
INSERT INTO projects VALUES('19','asd','asdddasdad','1','1','2024-12-25 22:42:48','1');
INSERT INTO projects VALUES('20','asd','asdddasdad123','1','1','2024-12-26 00:07:42','1');
INSERT INTO projects VALUES('21','asd23','asdddasdad12345','1','1','2024-12-26 00:08:05','1');
INSERT INTO projects VALUES('22','asd','asdddasdad123456','1','1','2024-12-26 10:20:59','1');
INSERT INTO projects VALUES('23','asd','asdddasdad1234567','1','1','2024-12-26 10:21:41','1');
INSERT INTO projects VALUES('24','asd','asdddasdad12345678','1','1','2024-12-26 10:22:04','1');
INSERT INTO projects VALUES('25','asd22','asd','1','1','2024-12-26 11:06:43','1');
INSERT INTO projects VALUES('26','3214','asd','1','1','2024-12-26 11:06:59','1');
INSERT INTO projects VALUES('27','asd123','asd','1','1','2024-12-26 13:14:06','1');





CREATE TABLE `ticket_categories` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO ticket_categories VALUES('1','Incident',NULL);
INSERT INTO ticket_categories VALUES('2','Request',NULL);





CREATE TABLE `ticket_statuses` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO ticket_statuses VALUES('1','Open','Open ticket that are not yet solved.');
INSERT INTO ticket_statuses VALUES('2','In Progress','Ongoing ticket.');
INSERT INTO ticket_statuses VALUES('3','On Hold','On Hold tickets due to specific reason.');
INSERT INTO ticket_statuses VALUES('4','Canceled','Canceled ticket, maybe invalid or incorrect.');
INSERT INTO ticket_statuses VALUES('5','Resolved','Completed tickets.');





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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

INSERT INTO tickets VALUES('2','1',NULL,'1','Testing','Testing','0','1','1','2024-12-24 00:27:57');
INSERT INTO tickets VALUES('3','1',NULL,'1','asd','asd','0','1','1','2024-12-25 19:58:16');
INSERT INTO tickets VALUES('4','1',NULL,'1','asd','asd','0','1','1','2024-12-25 19:59:01');
INSERT INTO tickets VALUES('5','1',NULL,'1','aasd','asd','0','1','1','2024-12-25 20:06:27');
INSERT INTO tickets VALUES('6','1',NULL,'2','asd','asd','0','1','1','2024-12-25 20:09:42');
INSERT INTO tickets VALUES('7','1',NULL,'1','asd','asd','0','1','1','2024-12-25 20:09:49');
INSERT INTO tickets VALUES('8','1',NULL,'1','asd','asd','0','1','1','2024-12-25 20:16:31');
INSERT INTO tickets VALUES('9','1',NULL,'1','asd','asd','0','1','1','2024-12-25 20:18:22');
INSERT INTO tickets VALUES('10','2',NULL,'1','asd','asd','0','1','1','2024-12-25 20:25:23');
INSERT INTO tickets VALUES('11','1',NULL,'1','asd','asd','0','1','1','2024-12-25 20:40:57');
INSERT INTO tickets VALUES('12','1',NULL,'1','123','123','0','1','1','2024-12-26 13:14:26');





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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO users VALUES('1','lensomo','LJ','Ensomo','1','ensomolj@gmail.com','$2y$10$8OcFb1RUliZsk4kU4/CcO.QkQjH0sPuD4MiQirF23oMAEjCguH74.','1','2024-10-17 18:14:17');
INSERT INTO users VALUES('2','ttest','test','test','1','test@testuser','$2y$10$YGcOsK6Mt1yYRz4/BUFNfOXxZRjDSV7PcJe.8mQuNiQziH0R8vRBm','1','2024-12-15 13:36:03');





CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_project_details` AS (select `a`.`id` AS `id`,`a`.`project_name` AS `project_name`,`a`.`project_description` AS `project_description`,`a`.`status` AS `status`,`a`.`date_created` AS `date_created`,concat(`b`.`first_name`,' ',`b`.`last_name`) AS `created_by` from (`projects` `a` left join `users` `b` on(`a`.`created_by` = `b`.`id`)));






CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_project_modules` AS (select `a`.`id` AS `id`,`a`.`project_id` AS `project_id`,`a`.`module_name` AS `module_name`,`a`.`module_description` AS `module_description`,`a`.`date_created` AS `date_created`,floor(if(`b`.`complete` is null,0,`b`.`complete` / (`b`.`complete` + `b`.`not_complete`) * 100)) AS `progress` from (`db_project_management`.`project_modules` `a` left join (select `db_project_management`.`module_functions`.`module_id` AS `module_id`,sum(case when `db_project_management`.`module_functions`.`status` = 1 then 1 else 0 end) AS `complete`,sum(case when `db_project_management`.`module_functions`.`status` = 2 or `db_project_management`.`module_functions`.`status` = 3 then 1 else 0 end) AS `not_complete` from `db_project_management`.`module_functions` group by `db_project_management`.`module_functions`.`module_id`) `b` on(`a`.`id` = `b`.`module_id`)));






CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_project_owners` AS (select `a`.`id` AS `id`,concat(`b`.`first_name`,' ',`b`.`last_name`) AS `owner`,`a`.`project_id` AS `project_id`,`a`.`owner_id` AS `owner_id` from (`project_owners` `a` join `users` `b` on(`a`.`owner_id` = `b`.`id`)));






CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_projects` AS (select `a`.`id` AS `id`,`a`.`project_name` AS `project_name`,`a`.`project_description` AS `project_description`,`a`.`status` AS `status`,`a`.`is_deleted` AS `is_deleted`,`a`.`date_created` AS `date_created`,`a`.`created_by` AS `created_by`,`b`.`name` AS `project_status` from (`projects` `a` join `project_statuses` `b` on(`a`.`status` = `b`.`id`)));






CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_tickets` AS (select `a`.`id` AS `id`,`b`.`project_name` AS `project_name`,`a`.`subject` AS `subject`,`a`.`date_created` AS `date_created`,concat(`c`.`first_name`,' ',`c`.`last_name`) AS `created_by`,`d`.`name` AS `status` from (((`tickets` `a` join `projects` `b` on(`a`.`project_id` = `b`.`id`)) join `users` `c` on(`a`.`created_by` = `c`.`id`)) join `ticket_statuses` `d` on(`a`.`status` = `d`.`id`)));




