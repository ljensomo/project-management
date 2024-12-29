

CREATE TABLE `database_backups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(150) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

INSERT INTO database_backups VALUES('11','db-backup-20241229153608.sql','1','2024-12-29 22:36:08');
INSERT INTO database_backups VALUES('12','db-backup-20241229154213.sql','1','2024-12-29 22:42:13');





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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO ticket_categories VALUES('1','Bug Report','Report software bugs or issues.');
INSERT INTO ticket_categories VALUES('2','Feature Request','Suggest new features or enhancements.');
INSERT INTO ticket_categories VALUES('3','Support Request','Seek help or support with a specific problem.');
INSERT INTO ticket_categories VALUES('4','To-Do','Track and manage individual tasks or action items.');
INSERT INTO ticket_categories VALUES('5','Change Request','Propose changes to existing processes, systems, or projects.');
INSERT INTO ticket_categories VALUES('6','Incident Report','Document and manage incidents or unexpected events.');
INSERT INTO ticket_categories VALUES('7','Maintenance Request','Request regular maintenance or updates.');
INSERT INTO ticket_categories VALUES('8','Review','Provide feedback or conduct a review.');





CREATE TABLE `ticket_statuses` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `category_id` tinyint(2) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;

INSERT INTO ticket_statuses VALUES('1','1','New','The bug has just been reported and hasn\'t been reviewed yet.');
INSERT INTO ticket_statuses VALUES('2','1','Triaged','The bug has been reviewed, and its severity and priority have been assessed.');
INSERT INTO ticket_statuses VALUES('3','1','In Progress','The bug is currently being worked on by a developer or team.');
INSERT INTO ticket_statuses VALUES('4','1','On Hold','Work on the bug is temporarily paused, possibly due to dependencies or other issues.');
INSERT INTO ticket_statuses VALUES('5','1','Fixed','The bug has been resolved, and a fix has been implemented.');
INSERT INTO ticket_statuses VALUES('6','1','Verified','The fix has been tested and confirmed to resolve the bug.');
INSERT INTO ticket_statuses VALUES('7','1','Closed','The bug has been fully resolved and no further action is needed.');
INSERT INTO ticket_statuses VALUES('8','1','Reopened','The bug has resurfaced or was not fully fixed, and it requires further attention.');
INSERT INTO ticket_statuses VALUES('9','2','New','The feature request has been submitted but not yet reviewed.');
INSERT INTO ticket_statuses VALUES('10','2','Under Review','The feature request is being evaluated for feasibility and priority.');
INSERT INTO ticket_statuses VALUES('11','2','Approved','The feature request has been approved for development.');
INSERT INTO ticket_statuses VALUES('12','2','In Progress','The feature is currently being developed.');
INSERT INTO ticket_statuses VALUES('13','2','On Hold','Development of the feature is paused, possibly due to shifting priorities or dependencies.');
INSERT INTO ticket_statuses VALUES('14','2','Completed','The feature has been developed and is ready for deployment.');
INSERT INTO ticket_statuses VALUES('15','2','Released','The feature has been deployed and is available for use.');
INSERT INTO ticket_statuses VALUES('16','2','Closed','The feature request has been fully addressed and no further action is needed.');
INSERT INTO ticket_statuses VALUES('17','3','New','The support request has been received and awaits review.');
INSERT INTO ticket_statuses VALUES('18','3','In Progress','The support team is actively working on the request.');
INSERT INTO ticket_statuses VALUES('19','3','Awaiting User Response','The support team needs more information from the user to proceed.');
INSERT INTO ticket_statuses VALUES('20','3','Resolved','The issue has been addressed, and the support request is considered resolved.');
INSERT INTO ticket_statuses VALUES('21','3','Closed','The support request is fully resolved and no further action is needed.');
INSERT INTO ticket_statuses VALUES('22','4','New','The task has been created and is awaiting action.');
INSERT INTO ticket_statuses VALUES('23','4','In Progress','The task is currently being worked on.');
INSERT INTO ticket_statuses VALUES('24','4','On Hold','The task is temporarily paused.');
INSERT INTO ticket_statuses VALUES('25','4','Completed','The task has been finished.');
INSERT INTO ticket_statuses VALUES('26','4','Archived','The task is no longer active and has been archived for record-keeping.');
INSERT INTO ticket_statuses VALUES('27','5','New','The change request has been submitted and is awaiting review.');
INSERT INTO ticket_statuses VALUES('28','5','Under Review','The change request is being evaluated for feasibility and impact.');
INSERT INTO ticket_statuses VALUES('29','5','Approved','The change request has been approved for implementation.');
INSERT INTO ticket_statuses VALUES('30','5','Rejected','The change request has been reviewed but not approved.');
INSERT INTO ticket_statuses VALUES('31','5','In Progress','The change is currently being implemented.');
INSERT INTO ticket_statuses VALUES('32','5','Implemented','The change has been made.');
INSERT INTO ticket_statuses VALUES('33','6','New','The incident has been reported and is awaiting initial review.');
INSERT INTO ticket_statuses VALUES('34','6','Investigating','The incident is being actively investigated to determine the cause.');
INSERT INTO ticket_statuses VALUES('35','6','Identified','The cause of the incident has been identified.');
INSERT INTO ticket_statuses VALUES('36','6','In Progress','Steps are being taken to resolve the incident.');
INSERT INTO ticket_statuses VALUES('37','6','Resolved','The incident has been resolved, and normal operations have been restored.');
INSERT INTO ticket_statuses VALUES('38','6','Closed','The incident has been fully addressed and no further action is needed.');
INSERT INTO ticket_statuses VALUES('39','7','New','The maintenance request has been submitted and awaits review.');
INSERT INTO ticket_statuses VALUES('40','7','Scheduled','The maintenance has been scheduled for a specific time.');
INSERT INTO ticket_statuses VALUES('41','7','In Progress','The maintenance is currently being performed.');
INSERT INTO ticket_statuses VALUES('42','7','Completed','The maintenance has been finished.');
INSERT INTO ticket_statuses VALUES('43','7','Closed','The maintenance request has been fully addressed and no further action is needed.');
INSERT INTO ticket_statuses VALUES('44','8','New','The feedback or review has been received and awaits review.');
INSERT INTO ticket_statuses VALUES('45','8','Under Review','The feedback or review is being evaluated.');
INSERT INTO ticket_statuses VALUES('46','8','In Progress','Actions are being taken based on the feedback or review.');
INSERT INTO ticket_statuses VALUES('47','8','Completed','Actions based on the feedback or review have been completed.');
INSERT INTO ticket_statuses VALUES('48','8','Closed','The feedback or review has been fully addressed and no further action is needed.');





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
  `date_completed` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

INSERT INTO tickets VALUES('2','1',NULL,'0','','Testing',NULL,'4','1',NULL,'2024-12-24 00:27:57');
INSERT INTO tickets VALUES('3','1',NULL,'1','asd','asd',NULL,'4','1',NULL,'2024-12-25 19:58:16');
INSERT INTO tickets VALUES('4','1',NULL,'1','asd','asd',NULL,'4','1',NULL,'2024-12-25 19:59:01');
INSERT INTO tickets VALUES('5','1',NULL,'1','aasd','asd',NULL,'4','1',NULL,'2024-12-25 20:06:27');
INSERT INTO tickets VALUES('6','1',NULL,'2','asd','asd',NULL,'4','1',NULL,'2024-12-25 20:09:42');
INSERT INTO tickets VALUES('7','1',NULL,'1','asd','asd',NULL,'4','1',NULL,'2024-12-25 20:09:49');
INSERT INTO tickets VALUES('8','1',NULL,'1','asd','asd',NULL,'4','1',NULL,'2024-12-25 20:16:31');
INSERT INTO tickets VALUES('9','1',NULL,'1','asd','asd',NULL,'4','1',NULL,'2024-12-25 20:18:22');
INSERT INTO tickets VALUES('10','2',NULL,'1','asd','asd',NULL,'4','1',NULL,'2024-12-25 20:25:23');
INSERT INTO tickets VALUES('11','1',NULL,'1','asd','asd',NULL,'4','1',NULL,'2024-12-25 20:40:57');
INSERT INTO tickets VALUES('12','1',NULL,'1','123','123',NULL,'4','1',NULL,'2024-12-26 13:14:26');
INSERT INTO tickets VALUES('13','1',NULL,'1','Delete Backup','Cannot delete generated backup in Database Backup',NULL,'7','1','2024-12-29 15:15:50','2024-12-26 23:32:24');
INSERT INTO tickets VALUES('14','1',NULL,'1','Ticket Module','Tickets module in project details is not working.','0','1','1',NULL,'2024-12-26 23:33:04');
INSERT INTO tickets VALUES('15','1',NULL,'2','Database Backup Module','Include the user name who generated the backup.',NULL,'15','1','2024-12-29 15:44:30','2024-12-27 13:13:00');
INSERT INTO tickets VALUES('16','1',NULL,'2','te','te',NULL,'4','1',NULL,'2024-12-27 13:21:38');
INSERT INTO tickets VALUES('17','10',NULL,'2','asd','asd',NULL,'4','1',NULL,'2024-12-27 13:22:55');





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





CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_database_backups` AS (select `a`.`id` AS `id`,`a`.`filename` AS `filename`,`a`.`created_by` AS `created_by`,`a`.`date_created` AS `date_created`,concat(`b`.`first_name`,' ',`b`.`last_name`) AS `created_by_name` from (`database_backups` `a` left join `users` `b` on(`a`.`created_by` = `b`.`id`)));






CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_project_details` AS (select `a`.`id` AS `id`,`a`.`project_name` AS `project_name`,`a`.`project_description` AS `project_description`,`a`.`status` AS `status`,`a`.`date_created` AS `date_created`,concat(`b`.`first_name`,' ',`b`.`last_name`) AS `created_by` from (`projects` `a` left join `users` `b` on(`a`.`created_by` = `b`.`id`)));






CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_project_modules` AS (select `a`.`id` AS `id`,`a`.`project_id` AS `project_id`,`a`.`module_name` AS `module_name`,`a`.`module_description` AS `module_description`,`a`.`date_created` AS `date_created`,floor(if(`b`.`complete` is null,0,`b`.`complete` / (`b`.`complete` + `b`.`not_complete`) * 100)) AS `progress` from (`db_project_management`.`project_modules` `a` left join (select `db_project_management`.`module_functions`.`module_id` AS `module_id`,sum(case when `db_project_management`.`module_functions`.`status` = 1 then 1 else 0 end) AS `complete`,sum(case when `db_project_management`.`module_functions`.`status` = 2 or `db_project_management`.`module_functions`.`status` = 3 then 1 else 0 end) AS `not_complete` from `db_project_management`.`module_functions` group by `db_project_management`.`module_functions`.`module_id`) `b` on(`a`.`id` = `b`.`module_id`)));






CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_project_owners` AS (select `a`.`id` AS `id`,concat(`b`.`first_name`,' ',`b`.`last_name`) AS `owner`,`a`.`project_id` AS `project_id`,`a`.`owner_id` AS `owner_id` from (`project_owners` `a` join `users` `b` on(`a`.`owner_id` = `b`.`id`)));






CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_projects` AS (select `a`.`id` AS `id`,`a`.`project_name` AS `project_name`,`a`.`project_description` AS `project_description`,`a`.`status` AS `status`,`a`.`is_deleted` AS `is_deleted`,`a`.`date_created` AS `date_created`,`a`.`created_by` AS `created_by`,`b`.`name` AS `project_status` from (`projects` `a` join `project_statuses` `b` on(`a`.`status` = `b`.`id`)));






CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_tickets` AS (select `a`.`id` AS `id`,`a`.`category_id` AS `category_id`,`a`.`status` AS `status_id`,`b`.`project_name` AS `project_name`,`a`.`subject` AS `subject`,`a`.`date_created` AS `date_created`,concat(`c`.`first_name`,' ',`c`.`last_name`) AS `created_by`,`d`.`name` AS `status_name`,`e`.`name` AS `category`,`a`.`description` AS `description`,`a`.`date_completed` AS `date_completed` from ((((`tickets` `a` join `projects` `b` on(`a`.`project_id` = `b`.`id`)) join `users` `c` on(`a`.`created_by` = `c`.`id`)) join `ticket_statuses` `d` on(`a`.`status` = `d`.`id`)) join `ticket_categories` `e` on(`a`.`category_id` = `e`.`id`)));




