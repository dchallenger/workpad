/*
SQLyog Professional v12.09 (64 bit)
MySQL - 5.1.41 : Database - ortigas
*********************************************************************
*/ 
/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `applicant_details` */

DROP TABLE IF EXISTS `applicant_details`;

/*!50001 DROP VIEW IF EXISTS `applicant_details` */;
/*!50001 DROP TABLE IF EXISTS `applicant_details` */;

/*!50001 CREATE TABLE  `applicant_details`(
 `recruit_id` int(11) unsigned ,
 `position_desired` longtext ,
 `desired_salary` longtext ,
 `fullname` varchar(66) ,
 `firstname` varchar(32) ,
 `middlename` varchar(32) ,
 `lastname` varchar(32) ,
 `birthdate` date ,
 `nickname` varchar(32) ,
 `gender` enum('Male','Female') ,
 `age` tinyint(3) unsigned ,
 `present_address_no` longtext ,
 `present_address_street` longtext ,
 `present_address_village` longtext ,
 `present_address_barangay` longtext ,
 `present_address_town` longtext ,
 `present_address_city_town` longtext ,
 `present_address_province` longtext ,
 `present_address_country` longtext ,
 `present_address` longtext ,
 `present_province` longtext ,
 `phone` longtext ,
 `mobile` longtext ,
 `birth_place` longtext ,
 `height` longtext ,
 `weight` longtext ,
 `religion` longtext ,
 `citizenship` longtext ,
 `civil_status` longtext ,
 `tin_number` longtext ,
 `sss_number` longtext ,
 `pagibig_number` longtext ,
 `philhealth_number` longtext ,
 `emergency_name` longtext ,
 `emergency_phone` longtext ,
 `emergency_relationship` longtext ,
 `language` longtext ,
 `dialect` longtext ,
 `interests_hobbies` longtext ,
 `machine_operated` longtext ,
 `driver_license` longtext ,
 `driver_type_license` longtext ,
 `prc_license` longtext ,
 `prc_type_license` longtext ,
 `prc_license_no` longtext ,
 `prc_date_expiration` longtext ,
 `illness_question` longtext ,
 `illness_yes` longtext ,
 `trial_court` longtext ,
 `how_hiring_heard` longtext ,
 `work_start` longtext ,
 `referred_employee` longtext ,
 `emergency_ddress` longtext ,
 `recruitment_date` date 
)*/;

/*Table structure for table `applicant_personal` */

DROP TABLE IF EXISTS `applicant_personal`;

/*!50001 DROP VIEW IF EXISTS `applicant_personal` */;
/*!50001 DROP TABLE IF EXISTS `applicant_personal` */;

/*!50001 CREATE TABLE  `applicant_personal`(
 `recruit_id` int(11) unsigned ,
 `position_desired` longtext ,
 `desired_salary` longtext ,
 `present_address_no` longtext ,
 `present_address_street` longtext ,
 `present_address_village` longtext ,
 `present_address_barangay` longtext ,
 `present_address_town` longtext ,
 `present_address_city_town` longtext ,
 `present_address_province` longtext ,
 `present_address_country` longtext ,
 `phone` longtext ,
 `mobile` longtext ,
 `birth_place` longtext ,
 `height` longtext ,
 `weight` longtext ,
 `religion` longtext ,
 `nationality` longtext ,
 `civil_status` longtext ,
 `tin_number` longtext ,
 `sss_number` longtext ,
 `philhealth_number` longtext ,
 `pagibig_number` longtext ,
 `emergency_name` longtext ,
 `emergency_phone` longtext ,
 `emergency_relationship` longtext ,
 `emergency_address` longtext ,
 `emergency_city` longtext ,
 `emergency_country` longtext ,
 `language` longtext ,
 `dialect` longtext ,
 `interests_hobbies` longtext ,
 `machine_operated` longtext ,
 `driver_license` longtext ,
 `driver_type_license` longtext ,
 `prc_license` longtext ,
 `prc_type_license` longtext ,
 `prc_license_no` longtext ,
 `prc_date_expiration` longtext ,
 `illness_question` longtext ,
 `illness_yes` longtext ,
 `trial_court` longtext ,
 `how_hiring_heard` longtext ,
 `work_start` longtext ,
 `referred_employee` longtext 
)*/;

/*Table structure for table `applicant_personal_history` */

DROP TABLE IF EXISTS `applicant_personal_history`;

/*!50001 DROP VIEW IF EXISTS `applicant_personal_history` */;
/*!50001 DROP TABLE IF EXISTS `applicant_personal_history` */;

/*!50001 CREATE TABLE  `applicant_personal_history`(
 `recruit_id` int(11) unsigned ,
 `father_name` longtext ,
 `mother_name` longtext ,
 `brother_name` longtext ,
 `sister_name` longtext ,
 `son_name` longtext ,
 `daughter_name` longtext ,
 `guardian_name` longtext ,
 `spouse_name` longtext ,
 `father_occupation` longtext ,
 `mother_occupation` longtext ,
 `brother_occupation` longtext ,
 `sister_occupation` longtext ,
 `son_occupation` longtext ,
 `daughter_occupation` longtext ,
 `guardian_occupation` longtext ,
 `spouse_occupation` longtext ,
 `father_age` longtext ,
 `mother_age` longtext ,
 `brother_age` longtext ,
 `sister_age` longtext ,
 `son_age` longtext ,
 `daughter_age` longtext ,
 `guardian_age` longtext ,
 `spouse_age` longtext ,
 `relationship` varchar(128) ,
 `name` varchar(128) ,
 `birthday` varchar(128) ,
 `occupation` varchar(128) 
)*/;

/*Table structure for table `approver_class_department` */

DROP TABLE IF EXISTS `approver_class_department`;

/*!50001 DROP VIEW IF EXISTS `approver_class_department` */;
/*!50001 DROP TABLE IF EXISTS `approver_class_department` */;

/*!50001 CREATE TABLE  `approver_class_department`(
 `company_id` int(1) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) 
)*/;

/*Table structure for table `approver_class_position` */

DROP TABLE IF EXISTS `approver_class_position`;

/*!50001 DROP VIEW IF EXISTS `approver_class_position` */;
/*!50001 DROP TABLE IF EXISTS `approver_class_position` */;

/*!50001 CREATE TABLE  `approver_class_position`(
 `company_id` int(1) ,
 `department_id` int(1) ,
 `position_id` int(11) unsigned ,
 `position` varchar(64) 
)*/;

/*Table structure for table `approver_position_users` */

DROP TABLE IF EXISTS `approver_position_users`;

/*!50001 DROP VIEW IF EXISTS `approver_position_users` */;
/*!50001 DROP TABLE IF EXISTS `approver_position_users` */;

/*!50001 CREATE TABLE  `approver_position_users`(
 `user_id` int(11) unsigned ,
 `full_name` varchar(64) ,
 `company_id` int(1) ,
 `department_id` int(1) ,
 `position_id` int(1) 
)*/;

/*Table structure for table `attrition_report` */

DROP TABLE IF EXISTS `attrition_report`;

/*!50001 DROP VIEW IF EXISTS `attrition_report` */;
/*!50001 DROP TABLE IF EXISTS `attrition_report` */;

/*!50001 CREATE TABLE  `attrition_report`(
 `company` varchar(64) ,
 `company_id` int(1) ,
 `division_id` int(1) ,
 `division` varchar(64) ,
 `year` int(4) ,
 `jan_headcount` int(11) ,
 `jan_managed` int(11) ,
 `jan_unmanaged` int(11) ,
 `jan_total_attrition` int(11) ,
 `jan_actual_ytd_attrition` int(11) ,
 `jan_ytd_attrition` decimal(13,2) ,
 `feb_headcount` int(11) ,
 `feb_managed` int(11) ,
 `feb_unmanaged` int(11) ,
 `feb_total_attrition` int(11) ,
 `feb_actual_ytd_attrition` int(11) ,
 `feb_ytd_attrition` decimal(13,2) ,
 `mar_headcount` int(11) ,
 `mar_managed` int(11) ,
 `mar_unmanaged` int(11) ,
 `mar_total_attrition` int(11) ,
 `mar_actual_ytd_attrition` int(11) ,
 `mar_ytd_attrition` decimal(13,2) ,
 `apr_headcount` int(11) ,
 `apr_managed` int(11) ,
 `apr_unmanaged` int(11) ,
 `apr_total_attrition` int(11) ,
 `apr_actual_ytd_attrition` int(11) ,
 `apr_ytd_attrition` decimal(13,2) ,
 `may_headcount` int(11) ,
 `may_managed` int(11) ,
 `may_unmanaged` int(11) ,
 `may_total_attrition` int(11) ,
 `may_actual_ytd_attrition` int(11) ,
 `may_ytd_attrition` decimal(13,2) ,
 `jun_headcount` int(11) ,
 `jun_managed` int(11) ,
 `jun_unmanaged` int(11) ,
 `jun_total_attrition` int(11) ,
 `jun_actual_ytd_attrition` int(11) ,
 `jun_ytd_attrition` decimal(13,2) ,
 `jul_headcount` int(11) ,
 `jul_managed` int(11) ,
 `jul_unmanaged` int(11) ,
 `jul_total_attrition` int(11) ,
 `jul_actual_ytd_attrition` int(11) ,
 `jul_ytd_attrition` decimal(13,2) ,
 `aug_headcount` int(11) ,
 `aug_managed` int(11) ,
 `aug_unmanaged` int(11) ,
 `aug_total_attrition` int(11) ,
 `aug_actual_ytd_attrition` int(11) ,
 `aug_ytd_attrition` decimal(13,2) ,
 `sep_headcount` int(11) ,
 `sep_managed` int(11) ,
 `sep_unmanaged` int(11) ,
 `sep_total_attrition` int(11) ,
 `sep_actual_ytd_attrition` int(11) ,
 `sep_ytd_attrition` decimal(13,2) ,
 `oct_headcount` int(11) ,
 `oct_managed` int(11) ,
 `oct_unmanaged` int(11) ,
 `oct_total_attrition` int(11) ,
 `oct_actual_ytd_attrition` int(11) ,
 `oct_ytd_attrition` decimal(13,2) ,
 `nov_headcount` int(11) ,
 `nov_managed` int(11) ,
 `nov_unmanaged` int(11) ,
 `nov_total_attrition` int(11) ,
 `nov_actual_ytd_attrition` int(11) ,
 `nov_ytd_attrition` decimal(13,2) ,
 `dec_headcount` int(11) ,
 `dec_managed` int(11) ,
 `dec_unmanaged` int(11) ,
 `dec_total_attrition` int(11) ,
 `dec_actual_ytd_attrition` int(11) ,
 `dec_ytd_attrition` decimal(13,2) 
)*/;

/*Table structure for table `birthday_list_for_the_year` */

DROP TABLE IF EXISTS `birthday_list_for_the_year`;

/*!50001 DROP VIEW IF EXISTS `birthday_list_for_the_year` */;
/*!50001 DROP TABLE IF EXISTS `birthday_list_for_the_year` */;

/*!50001 CREATE TABLE  `birthday_list_for_the_year`(
 `celebrant_id` int(11) unsigned ,
 `full_name` varchar(64) ,
 `company_id` int(1) ,
 `company` varchar(64) ,
 `position` varchar(64) ,
 `birth_date` varchar(41) 
)*/;

/*Table structure for table `dashboard_birthday` */

DROP TABLE IF EXISTS `dashboard_birthday`;

/*!50001 DROP VIEW IF EXISTS `dashboard_birthday` */;
/*!50001 DROP TABLE IF EXISTS `dashboard_birthday` */;

/*!50001 CREATE TABLE  `dashboard_birthday`(
 `celebrant_id` int(11) unsigned ,
 `photo` varchar(128) ,
 `display_name` varchar(64) ,
 `position` varchar(64) ,
 `birth_date` date ,
 `time_line` varchar(16) ,
 `datetime` date 
)*/;

/*Table structure for table `dashboard_birthday_greetings` */

DROP TABLE IF EXISTS `dashboard_birthday_greetings`;

/*!50001 DROP VIEW IF EXISTS `dashboard_birthday_greetings` */;
/*!50001 DROP TABLE IF EXISTS `dashboard_birthday_greetings` */;

/*!50001 CREATE TABLE  `dashboard_birthday_greetings`(
 `id` int(11) unsigned ,
 `status` enum('info','success','warning','danger') ,
 `user_id` int(11) ,
 `display_name` varchar(64) ,
 `content` text ,
 `birthday` date ,
 `recipient_id` int(11) ,
 `position` varchar(64) ,
 `photo` varchar(128) ,
 `time_line` varchar(32) ,
 `createdon` timestamp 
)*/;

/*Table structure for table `dashboard_birthday_list` */

DROP TABLE IF EXISTS `dashboard_birthday_list`;

/*!50001 DROP VIEW IF EXISTS `dashboard_birthday_list` */;
/*!50001 DROP TABLE IF EXISTS `dashboard_birthday_list` */;

/*!50001 CREATE TABLE  `dashboard_birthday_list`(
 `celebrant_id` int(11) unsigned ,
 `photo` varchar(128) ,
 `display_name` varchar(64) ,
 `position` varchar(64) ,
 `birth_date` date ,
 `time_line` varchar(16) 
)*/;

/*Table structure for table `dashboard_feeds` */

DROP TABLE IF EXISTS `dashboard_feeds`;

/*!50001 DROP VIEW IF EXISTS `dashboard_feeds` */;
/*!50001 DROP TABLE IF EXISTS `dashboard_feeds` */;

/*!50001 CREATE TABLE  `dashboard_feeds`(
 `id` int(11) unsigned ,
 `user_id` int(11) ,
 `message_type` enum('Admin','Announcement','Birthday','Comment','Company News','Feedback','Partners','Personnel','System','Time Record','Code of Conduct','Movement','Signatories','Clearance','Recruitment','Performance Appraisal') ,
 `class` varchar(13) ,
 `display_name` varchar(64) ,
 `feed_content` text ,
 `recipient_id` bigint(11) ,
 `recipients` varchar(255) ,
 `readon` datetime ,
 `createdon_datetime` timestamp ,
 `createdon` varchar(32) ,
 `avatar` varchar(128) ,
 `uri` varchar(128) ,
 `record_id` int(11) ,
 `like` tinyint(1) ,
 `deleted` tinyint(1) 
)*/;

/*Table structure for table `dashboard_feeds2` */

DROP TABLE IF EXISTS `dashboard_feeds2`;

/*!50001 DROP VIEW IF EXISTS `dashboard_feeds2` */;
/*!50001 DROP TABLE IF EXISTS `dashboard_feeds2` */;

/*!50001 CREATE TABLE  `dashboard_feeds2`(
 `id` int(11) unsigned ,
 `user_id` int(11) ,
 `message_type` enum('Admin','Announcement','Birthday','Comment','Company News','Feedback','Partners','Personnel','System','Time Record','Code of Conduct','Movement','Signatories','Clearance','Recruitment','Performance Appraisal') ,
 `class` varchar(13) ,
 `display_name` varchar(64) ,
 `feed_content` text ,
 `recipient_id` bigint(11) ,
 `recipients` varchar(255) ,
 `readon` datetime ,
 `createdon_datetime` timestamp ,
 `createdon` varchar(32) ,
 `avatar` varchar(128) ,
 `deleted` tinyint(1) 
)*/;

/*Table structure for table `dashboard_group_notification` */

DROP TABLE IF EXISTS `dashboard_group_notification`;

/*!50001 DROP VIEW IF EXISTS `dashboard_group_notification` */;
/*!50001 DROP TABLE IF EXISTS `dashboard_group_notification` */;

/*!50001 CREATE TABLE  `dashboard_group_notification`(
 `post` longtext ,
 `type_id` int(11) ,
 `url` varchar(255) ,
 `created_on` timestamp ,
 `created_by` int(11) ,
 `recipient` int(11) ,
 `notif` text ,
 `read` tinyint(1) ,
 `read_on` datetime ,
 `full_name` varchar(64) ,
 `photo` varchar(128) ,
 `timeline` varchar(32) ,
 `type` varchar(64) 
)*/;

/*Table structure for table `dashboard_inbox` */

DROP TABLE IF EXISTS `dashboard_inbox`;

/*!50001 DROP VIEW IF EXISTS `dashboard_inbox` */;
/*!50001 DROP TABLE IF EXISTS `dashboard_inbox` */;

/*!50001 CREATE TABLE  `dashboard_inbox`(
 `id` int(11) unsigned ,
 `status` enum('info','success','warning','danger') ,
 `user_id` int(11) ,
 `display_name` varchar(64) ,
 `avatar` varchar(128) ,
 `recipient_id` int(11) ,
 `content` longtext ,
 `readon` datetime ,
 `timeline` varchar(32) ,
 `reactedon` datetime ,
 `createdon` timestamp 
)*/;

/*Table structure for table `dashboard_notification` */

DROP TABLE IF EXISTS `dashboard_notification`;

/*!50001 DROP VIEW IF EXISTS `dashboard_notification` */;
/*!50001 DROP TABLE IF EXISTS `dashboard_notification` */;

/*!50001 CREATE TABLE  `dashboard_notification`(
 `id` int(11) unsigned ,
 `status` enum('info','success','warning','danger') ,
 `message_type` enum('Admin','Announcement','Birthday','Comment','Company News','Feedback','Partners','Personnel','System','Time Record','Code of Conduct','Movement','Signatories','Clearance','Recruitment','Performance Appraisal') ,
 `recipient_id` bigint(11) ,
 `feed_content` longtext ,
 `readon` datetime ,
 `timeline` varchar(32) ,
 `uri` varchar(128) ,
 `record_id` int(11) ,
 `reactedon` datetime ,
 `createdon` timestamp 
)*/;

/*Table structure for table `dashboard_todo` */

DROP TABLE IF EXISTS `dashboard_todo`;

/*!50001 DROP VIEW IF EXISTS `dashboard_todo` */;
/*!50001 DROP TABLE IF EXISTS `dashboard_todo` */;

/*!50001 CREATE TABLE  `dashboard_todo`(
 `forms_id` int(11) unsigned ,
 `form_status_id` tinyint(1) ,
 `form_status` varchar(16) ,
 `form_id` int(1) ,
 `form` varchar(32) ,
 `form_code` varchar(8) ,
 `user_id` int(11) ,
 `display_name` varchar(64) ,
 `date_from` date ,
 `date_to` date ,
 `reason` text ,
 `createdon` varchar(32) ,
 `deleted` tinyint(1) 
)*/;

/*Table structure for table `dashboard_todos` */

DROP TABLE IF EXISTS `dashboard_todos`;

/*!50001 DROP VIEW IF EXISTS `dashboard_todos` */;
/*!50001 DROP TABLE IF EXISTS `dashboard_todos` */;

/*!50001 CREATE TABLE  `dashboard_todos`(
 `forms_id` int(11) unsigned ,
 `form_status_id` tinyint(1) ,
 `form_status` varchar(16) ,
 `form_id` int(1) ,
 `form_code` varchar(8) ,
 `form` varchar(32) ,
 `reason` text ,
 `user_id` int(11) ,
 `display_name` varchar(64) ,
 `day` decimal(5,2) ,
 `hrs` decimal(5,2) ,
 `date_range` varchar(140) ,
 `date_from` date ,
 `date_to` date ,
 `createdon` varchar(32) ,
 `created_on` timestamp ,
 `approver_status_id` int(1) ,
 `approver_status` varchar(16) ,
 `approver_id` int(11) ,
 `approver_name` varchar(64) ,
 `timeline` varchar(16) 
)*/;

/*Table structure for table `incident_report` */

DROP TABLE IF EXISTS `incident_report`;

/*!50001 DROP VIEW IF EXISTS `incident_report` */;
/*!50001 DROP TABLE IF EXISTS `incident_report` */;

/*!50001 CREATE TABLE  `incident_report`(
 `company_id` int(1) unsigned ,
 `department_id` int(11) unsigned ,
 `user_id` int(11) unsigned ,
 `offense_id` int(11) ,
 `sanction_id` int(11) ,
 `name` varchar(64) ,
 `position` varchar(64) ,
 `company` varchar(64) ,
 `department` varchar(64) ,
 `frequency` varchar(32) ,
 `penalty` text ,
 `payment` varchar(128) ,
 `from` varbinary(10) ,
 `to` varbinary(10) ,
 `date_of_offense` date ,
 `date_of_offense_from` date ,
 `date_of_offense_to` date ,
 `date_serve` varbinary(19) ,
 `remarks` text ,
 `ir_closed_date` varbinary(19) ,
 `superior` varchar(64) ,
 `offense` text ,
 `details_of_violations` text 
)*/;

/*Table structure for table `leave_balance_monitoring` */

DROP TABLE IF EXISTS `leave_balance_monitoring`;

/*!50001 DROP VIEW IF EXISTS `leave_balance_monitoring` */;
/*!50001 DROP TABLE IF EXISTS `leave_balance_monitoring` */;

/*!50001 CREATE TABLE  `leave_balance_monitoring`(
 `company_id` int(1) ,
 `company` varchar(64) ,
 `full_name` varchar(129) ,
 `year` int(1) ,
 `leave_type` varchar(8) ,
 `previous` decimal(7,4) ,
 `current` decimal(7,4) ,
 `used` decimal(7,4) ,
 `converted` decimal(7,4) ,
 `forfeited` decimal(7,4) ,
 `balance` decimal(7,4) 
)*/;

/*Table structure for table `loan_application_manage` */

DROP TABLE IF EXISTS `loan_application_manage`;

/*!50001 DROP VIEW IF EXISTS `loan_application_manage` */;
/*!50001 DROP TABLE IF EXISTS `loan_application_manage` */;

/*!50001 CREATE TABLE  `loan_application_manage`(
 `loan_application_id` int(11) unsigned ,
 `loan_application_status_id` tinyint(1) ,
 `loan_application_status` varchar(16) ,
 `loan_type_id` int(11) unsigned ,
 `loan_type_code` varchar(8) ,
 `loan_type` varchar(32) ,
 `user_id` int(11) ,
 `display_name` varchar(64) ,
 `createdon` varchar(32) ,
 `created_on` timestamp ,
 `approver_status_id` int(1) ,
 `approver_status` varchar(16) ,
 `approver_id` int(11) ,
 `approver_name` varchar(64) ,
 `company_id` int(1) 
)*/;

/*Table structure for table `manpower_movement_report` */

DROP TABLE IF EXISTS `manpower_movement_report`;

/*!50001 DROP VIEW IF EXISTS `manpower_movement_report` */;
/*!50001 DROP TABLE IF EXISTS `manpower_movement_report` */;

/*!50001 CREATE TABLE  `manpower_movement_report`(
 `effectivity_date` date ,
 `display_name` varchar(64) ,
 `from_name_promote` varchar(128) ,
 `to_name_promote` varchar(128) ,
 `from_name_transfer` varchar(128) ,
 `to_name_transfer` varchar(128) ,
 `manage` varbinary(1) ,
 `unmanaged` varbinary(1) ,
 `EOC` varbinary(1) ,
 `company_id` int(1) ,
 `division_id` int(1) ,
 `year` int(4) 
)*/;

/*Table structure for table `month` */

DROP TABLE IF EXISTS `month`;

/*!50001 DROP VIEW IF EXISTS `month` */;
/*!50001 DROP TABLE IF EXISTS `month` */;

/*!50001 CREATE TABLE  `month`(
 `MONTH` varchar(9) 
)*/;

/*Table structure for table `new_hires_report` */

DROP TABLE IF EXISTS `new_hires_report`;

/*!50001 DROP VIEW IF EXISTS `new_hires_report` */;
/*!50001 DROP TABLE IF EXISTS `new_hires_report` */;

/*!50001 CREATE TABLE  `new_hires_report`(
 `prf_no` varchar(16) ,
 `name` varchar(32) ,
 `status` varchar(32) ,
 `recruiter` varchar(64) ,
 `company_id` int(1) ,
 `division_id` int(1) ,
 `year` int(4) 
)*/;

/*Table structure for table `night_differential` */

DROP TABLE IF EXISTS `night_differential`;

/*!50001 DROP VIEW IF EXISTS `night_differential` */;
/*!50001 DROP TABLE IF EXISTS `night_differential` */;

/*!50001 CREATE TABLE  `night_differential`(
 `user_id` int(11) ,
 `DATE` date ,
 `transaction_code` varchar(32) ,
 `quantity` decimal(12,3) 
)*/;

/*Table structure for table `overtime_checking` */

DROP TABLE IF EXISTS `overtime_checking`;

/*!50001 DROP VIEW IF EXISTS `overtime_checking` */;
/*!50001 DROP TABLE IF EXISTS `overtime_checking` */;

/*!50001 CREATE TABLE  `overtime_checking`(
 `display_name` varchar(64) ,
 `date` date ,
 `payroll_date` date ,
 `form_status_id` tinyint(1) ,
 `shift` varchar(32) ,
 `time_in` datetime ,
 `time_out` datetime ,
 `focus_date` date ,
 `date_approved` datetime ,
 `time_from` datetime ,
 `time_to` datetime ,
 `ot_hours_application` decimal(5,2) ,
 `ot_processed` decimal(5,2) 
)*/;

/*Table structure for table `overtime_checking_on_approved` */

DROP TABLE IF EXISTS `overtime_checking_on_approved`;

/*!50001 DROP VIEW IF EXISTS `overtime_checking_on_approved` */;
/*!50001 DROP TABLE IF EXISTS `overtime_checking_on_approved` */;

/*!50001 CREATE TABLE  `overtime_checking_on_approved`(
 `display_name` varchar(64) ,
 `date` date ,
 `payroll_date` date ,
 `form_status_id` tinyint(1) ,
 `shift` varchar(32) ,
 `time_in` datetime ,
 `time_out` datetime ,
 `date_approved` datetime ,
 `focus_date` date ,
 `time_from` datetime ,
 `time_to` datetime ,
 `ot_hours_application` decimal(5,2) ,
 `ot_processed` decimal(5,2) 
)*/;

/*Table structure for table `partner_contribution` */

DROP TABLE IF EXISTS `partner_contribution`;

/*!50001 DROP VIEW IF EXISTS `partner_contribution` */;
/*!50001 DROP TABLE IF EXISTS `partner_contribution` */;

/*!50001 CREATE TABLE  `partner_contribution`(
 `user_id` int(11) ,
 `year` int(1) ,
 `month` varchar(9) ,
 `SSS` varbinary(255) ,
 `PhilHealth` varbinary(255) ,
 `PagIBIG` varbinary(255) ,
 `WTax` varbinary(255) 
)*/;

/*Table structure for table `partner_contribution_view` */

DROP TABLE IF EXISTS `partner_contribution_view`;

/*!50001 DROP VIEW IF EXISTS `partner_contribution_view` */;
/*!50001 DROP TABLE IF EXISTS `partner_contribution_view` */;

/*!50001 CREATE TABLE  `partner_contribution_view`(
 `user_id` int(11) ,
 `YEAR` int(1) ,
 `summary_code` varchar(32) ,
 `MONTH` varchar(9) ,
 `VALUE` varbinary(255) 
)*/;

/*Table structure for table `partner_loan_payment` */

DROP TABLE IF EXISTS `partner_loan_payment`;

/*!50001 DROP VIEW IF EXISTS `partner_loan_payment` */;
/*!50001 DROP TABLE IF EXISTS `partner_loan_payment` */;

/*!50001 CREATE TABLE  `partner_loan_payment`(
 `user_id` int(11) ,
 `partner_loan_id` int(11) ,
 `principal` double(19,2) ,
 `interest` double(19,2) ,
 `amount` varbinary(255) ,
 `date_paid` date ,
 `transaction` varchar(128) 
)*/;

/*Table structure for table `partner_manpower_status_position_filter` */

DROP TABLE IF EXISTS `partner_manpower_status_position_filter`;

/*!50001 DROP VIEW IF EXISTS `partner_manpower_status_position_filter` */;
/*!50001 DROP TABLE IF EXISTS `partner_manpower_status_position_filter` */;

/*!50001 CREATE TABLE  `partner_manpower_status_position_filter`(
 `user_id` int(11) unsigned ,
 `position` varchar(17) 
)*/;

/*Table structure for table `partner_manpower_status_report` */

DROP TABLE IF EXISTS `partner_manpower_status_report`;

/*!50001 DROP VIEW IF EXISTS `partner_manpower_status_report` */;
/*!50001 DROP TABLE IF EXISTS `partner_manpower_status_report` */;

/*!50001 CREATE TABLE  `partner_manpower_status_report`(
 `active` tinyint(1) ,
 `status_id` int(1) ,
 `status` varchar(32) ,
 `position` varchar(17) ,
 `company_id` int(1) ,
 `company` varchar(64) ,
 `department_id` int(1) ,
 `department` varchar(64) ,
 `payroll_rate_type_id` int(1) ,
 `payroll_rate_type` varchar(64) ,
 `count` bigint(21) ,
 `employed` decimal(23,0) ,
 `resigned` decimal(23,0) 
)*/;

/*Table structure for table `partner_movement` */

DROP TABLE IF EXISTS `partner_movement`;

/*!50001 DROP VIEW IF EXISTS `partner_movement` */;
/*!50001 DROP TABLE IF EXISTS `partner_movement` */;

/*!50001 CREATE TABLE  `partner_movement`(
 `record_id` int(11) unsigned ,
 `employee_name` varchar(341) ,
 `movement_type` varchar(341) ,
 `cause` varchar(32) ,
 `deleted` tinyint(1) ,
 `created_by` int(11) 
)*/;

/*Table structure for table `partner_movement_current` */

DROP TABLE IF EXISTS `partner_movement_current`;

/*!50001 DROP VIEW IF EXISTS `partner_movement_current` */;
/*!50001 DROP TABLE IF EXISTS `partner_movement_current` */;

/*!50001 CREATE TABLE  `partner_movement_current`(
 `role_id` int(1) unsigned ,
 `role` varchar(64) ,
 `company_id` int(1) ,
 `company` varchar(64) ,
 `department_id` int(1) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `department` varchar(83) ,
 `division_id` int(1) ,
 `division` varchar(64) ,
 `project_id` int(11) unsigned ,
 `project` varchar(64) ,
 `location_id` int(1) ,
 `location` varchar(64) ,
 `position_id` int(1) ,
 `position` varchar(64) ,
 `reports_to_id` int(11) ,
 `reports_to` varchar(64) ,
 `employment_status_id` int(1) ,
 `employment_status` varchar(32) ,
 `employment_type_id` int(1) ,
 `employment_type` varchar(32) ,
 `job_grade_id` int(11) ,
 `job_level` varchar(64) ,
 `user_id` int(11) unsigned ,
 `partner_id` int(11) unsigned 
)*/;

/*Table structure for table `partner_payslip` */

DROP TABLE IF EXISTS `partner_payslip`;

/*!50001 DROP VIEW IF EXISTS `partner_payslip` */;
/*!50001 DROP TABLE IF EXISTS `partner_payslip` */;

/*!50001 CREATE TABLE  `partner_payslip`(
 `employee` int(11) unsigned ,
 `status` varchar(32) ,
 `position` varchar(64) ,
 `company_id` int(11) ,
 `company` varchar(64) ,
 `address` varchar(128) ,
 `city` varchar(32) ,
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `full_name` varchar(64) ,
 `department_id` int(1) ,
 `department_code` varchar(16) ,
 `project_id` int(11) unsigned ,
 `project_code` varchar(16) ,
 `project` varchar(64) ,
 `payroll_rate_type_id` int(11) ,
 `payroll_rate_type` varchar(64) ,
 `adjustment` double(19,2) ,
 `other_taxable` int(1) ,
 `absent` double(19,2) ,
 `late` double(19,2) ,
 `undertime` double(19,2) ,
 `lwop` double(19,2) ,
 `absent_hours` double(19,2) ,
 `late_hours` double(19,2) ,
 `undertime_hours` double(19,2) ,
 `lwop_hours` double(19,2) ,
 `absent_tardy` double(19,2) ,
 `sss` int(1) ,
 `philhealth` int(1) ,
 `pag_ibig` int(1) ,
 `nontax_income` int(1) ,
 `nd` double(19,2) ,
 `reg` double(19,2) ,
 `nd_otnd` double(19,2) ,
 `reg_otnd` double(19,2) ,
 `rest` double(19,2) ,
 `rest_otnd` double(19,2) ,
 `rest_x8_otnd` double(19,2) ,
 `rest_x8` double(19,2) ,
 `doff` double(19,2) ,
 `doff_x8` double(19,2) ,
 `hourly_rate` double(19,2) ,
 `legal` double(19,2) ,
 `legal_x8` double(19,2) ,
 `legal_otnd` double(19,2) ,
 `legal_x8_otnd` double(19,2) ,
 `rest_legal` double(19,2) ,
 `rest_leg_x8` double(19,2) ,
 `rest_legal_otnd` double(19,2) ,
 `rest_leg_x8_otnd` double(19,2) ,
 `sp` double(19,2) ,
 `sp_x8` double(19,2) ,
 `sp_otnd` double(19,2) ,
 `sp_x8_otnd` double(19,2) ,
 `rest_sp` double(19,2) ,
 `rest_sp_x8` double(19,2) ,
 `rest_sp_otnd` double(19,2) ,
 `rest_sp_x8_otnd` double(19,2) ,
 `dobot` double(19,2) ,
 `dobot_x8` double(19,2) ,
 `dobot_otnd` double(19,2) ,
 `dobot_x8_otnd` double(19,2) ,
 `rest_dobot` double(19,2) ,
 `rest_dobot_x8` double(19,2) ,
 `rest_dobot_otnd` double(19,2) ,
 `rest_dobot_x8_otnd` double(19,2) ,
 `reg_hrs` double(19,2) ,
 `nd_hrs` double(19,2) ,
 `rest_hrs` double(19,2) ,
 `rest_otnd_hrs` double(19,2) ,
 `rest_x8_otnd_hrs` double(19,2) ,
 `rest_x8_hrs` double(19,2) ,
 `doff_hrs` double(19,2) ,
 `doff_x8_hrs` double(19,2) ,
 `legal_hrs` double(19,2) ,
 `legal_x8_hrs` double(19,2) ,
 `rest_legal_hrs` double(19,2) ,
 `rest_leg_x8_hrs` double(19,2) ,
 `sp_hrs` double(19,2) ,
 `sp_x8_hrs` double(19,2) ,
 `rest_sp_hrs` double(19,2) ,
 `rest_sp_x8_hrs` double(19,2) ,
 `dobot_hrs` double(19,2) ,
 `dobot_x8_hrs` double(19,2) ,
 `dobot_otnd_hrs` double(19,2) ,
 `dobot_x8_otnd_hrs` double(19,2) ,
 `rest_dobot_hrs` double(19,2) ,
 `rest_dobot_x8_hrs` double(19,2) ,
 `rest_dobot_otnd_hrs` double(19,2) ,
 `rest_dobot_x8_otnd_hrs` double(19,2) ,
 `health_card` int(1) ,
 `other_deduction_one` int(1) ,
 `other_deduction_two` int(1) ,
 `other_deduction_three` int(1) ,
 `sss_sal_loan_payments` int(1) ,
 `sss_cal_loan_payments` int(1) ,
 `hdmf_sal_loan_payments` int(1) ,
 `hdmf_cal_loan_payments` int(1) ,
 `company_loan_payments` int(1) ,
 `sss_sal_loan_balance` int(1) ,
 `sss_cal_loan_balance` int(1) ,
 `hdmf_sal_loan_balance` int(1) ,
 `hdmf_cal_loan_balance` int(1) ,
 `tax_status` int(1) ,
 `ytd_sss` int(1) ,
 `ytd_philhealth` int(1) ,
 `ytd_pag_ibig` int(1) ,
 `tin` varchar(16) ,
 `transaction_label` varchar(128) ,
 `transaction_class_code` varchar(32) ,
 `transaction_code` varchar(32) ,
 `qty` varbinary(291) ,
 `amount` double(19,2) ,
 `transaction_type_id` int(1) ,
 `group` varchar(10) ,
 `type` varchar(10) ,
 `record_id` varbinary(11) ,
 `beginning_balance` double(19,2) ,
 `running_balance` double(19,2) ,
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `date_from_applicable` varchar(10) ,
 `date_to_applicable` varchar(10) ,
 `taxcode` varchar(50) ,
 `phone_no` varchar(255) ,
 `fax_no` varchar(255) 
)*/;

/*Table structure for table `partner_payslip_orig` */

DROP TABLE IF EXISTS `partner_payslip_orig`;

/*!50001 DROP VIEW IF EXISTS `partner_payslip_orig` */;
/*!50001 DROP TABLE IF EXISTS `partner_payslip_orig` */;

/*!50001 CREATE TABLE  `partner_payslip_orig`(
 `employee` int(11) unsigned ,
 `company_id` int(11) ,
 `company` varchar(64) ,
 `address` varchar(128) ,
 `city` varchar(32) ,
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `full_name` varchar(64) ,
 `department_id` int(11) ,
 `department_code` varchar(16) ,
 `project_id` int(11) unsigned ,
 `project_code` varchar(16) ,
 `project` varchar(64) ,
 `payroll_rate_type_id` int(11) ,
 `payroll_rate_type` varchar(64) ,
 `adjustment` bigint(20) ,
 `other_taxable` bigint(20) ,
 `absent_tardy` double(19,2) ,
 `sss` bigint(20) ,
 `philhealth` bigint(20) ,
 `pag_ibig` bigint(20) ,
 `nontax_income` bigint(20) ,
 `nd` double(19,2) ,
 `reg` bigint(20) ,
 `rest` double(19,2) ,
 `rest_x8` double(19,2) ,
 `sp` double(19,2) ,
 `sp_x8` double(19,2) ,
 `rest_sp` double(19,2) ,
 `rest_sp_x8` double(19,2) ,
 `hourly_rate` double(19,2) ,
 `legal` double(19,2) ,
 `legal_x8` double(19,2) ,
 `rest_legal` double(19,2) ,
 `rest_leg_x8` double(19,2) ,
 `nd_otnd` double(19,2) ,
 `reg_otnd` double(19,2) ,
 `rest_otnd` double(19,2) ,
 `rest_x8_otnd` double(19,2) ,
 `sp_otnd` double(19,2) ,
 `sp_x8_otnd` double(19,2) ,
 `rest_sp_otnd` double(19,2) ,
 `rest_sp_x8_otnd` double(19,2) ,
 `legal_otnd` double(19,2) ,
 `legal_x8_otnd` double(19,2) ,
 `rest_legal_otnd` double(19,2) ,
 `rest_leg_x8_otnd` double(19,2) ,
 `nd_hrs` double(19,2) ,
 `reg_hrs` bigint(20) ,
 `rest_hrs` double(19,2) ,
 `rest_x8_hrs` double(19,2) ,
 `sp_hrs` double(19,2) ,
 `sp_x8_hrs` double(19,2) ,
 `rest_sp_hrs` double(19,2) ,
 `rest_sp_x8_hrs` double(19,2) ,
 `legal_hrs` double(19,2) ,
 `legal_x8_hrs` double(19,2) ,
 `rest_legal_hrs` double(19,2) ,
 `rest_leg_x8_hrs` double(19,2) ,
 `health_card` bigint(20) ,
 `other_deduction_one` bigint(20) ,
 `other_deduction_two` bigint(20) ,
 `other_deduction_three` bigint(20) ,
 `sss_sal_loan_payments` bigint(20) ,
 `sss_cal_loan_payments` bigint(20) ,
 `hdmf_sal_loan_payments` bigint(20) ,
 `hdmf_cal_loan_payments` bigint(20) ,
 `company_loan_payments` bigint(20) ,
 `sss_sal_loan_balance` bigint(20) ,
 `sss_cal_loan_balance` bigint(20) ,
 `hdmf_sal_loan_balance` bigint(20) ,
 `hdmf_cal_loan_balance` bigint(20) ,
 `tax_status` bigint(20) ,
 `ytd_sss` bigint(20) ,
 `ytd_philhealth` bigint(20) ,
 `ytd_pag_ibig` bigint(20) ,
 `tin` varchar(16) ,
 `transaction_label` varchar(128) ,
 `transaction_class_code` varchar(32) ,
 `transaction_code` varchar(32) ,
 `qty` varbinary(291) ,
 `amount` double(19,2) ,
 `transaction_type_id` int(11) ,
 `group` varchar(10) ,
 `type` varchar(10) ,
 `record_id` varbinary(11) ,
 `beginning_balance` double(19,2) ,
 `running_balance` double(19,2) ,
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `taxcode` varchar(50) ,
 `phone_no` varchar(255) ,
 `fax_no` varchar(255) 
)*/;

/*Table structure for table `partners` */

DROP TABLE IF EXISTS `partners`;

/*!50001 DROP VIEW IF EXISTS `partners` */;
/*!50001 DROP TABLE IF EXISTS `partners` */;

/*!50001 CREATE TABLE  `partners`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `biometric` varchar(16) ,
 `partner_id` int(11) unsigned ,
 `deleted` tinyint(1) ,
 `shift_id` int(1) ,
 `shift` varchar(32) ,
 `calendar_id` int(11) ,
 `calendar` varchar(32) ,
 `full_name` varchar(64) ,
 `alias` varchar(32) ,
 `status_id` int(1) ,
 `status` varchar(32) ,
 `employment_type_id` int(1) ,
 `employment_type` varchar(16) ,
 `company_id` int(11) ,
 `job_grade_id` int(11) ,
 `v_job_grade` varchar(64) ,
 `position_classification_id` int(11) ,
 `position_classification` varchar(32) ,
 `salary` varchar(373) ,
 `sss_no` varchar(16) ,
 `phic_no` varchar(16) ,
 `hdmf_no` varchar(16) ,
 `resigned_date` date ,
 `email` varchar(128) ,
 `year` int(4) ,
 `month` int(2) ,
 `effectivity_date` date ,
 `regularization_date` date ,
 `created_on` timestamp ,
 `created_by` int(11) ,
 `modified_on` datetime ,
 `modified_by` int(11) ,
 `company` varchar(64) ,
 `sss` varchar(32) ,
 `tin` varchar(32) ,
 `phic` varchar(32) ,
 `hdmf` varchar(32) ,
 `address` varchar(128) ,
 `birth_date` date ,
 `position_id` int(1) ,
 `position` varchar(64) 
)*/;

/*Table structure for table `partners_details` */

DROP TABLE IF EXISTS `partners_details`;

/*!50001 DROP VIEW IF EXISTS `partners_details` */;
/*!50001 DROP TABLE IF EXISTS `partners_details` */;

/*!50001 CREATE TABLE  `partners_details`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `status` varchar(32) ,
 `full_name` varchar(64) ,
 `active` tinyint(1) ,
 `company_id` int(1) ,
 `division_id` int(1) ,
 `department_id` int(1) ,
 `project_id` int(11) ,
 `lastname` varchar(64) ,
 `firstname` varchar(64) ,
 `middlename` varchar(64) ,
 `salary` varchar(373) ,
 `sss_no` varchar(16) ,
 `phic_no` varchar(16) ,
 `hdmf_no` varchar(16) ,
 `tin` varchar(16) ,
 `resigned_date` date ,
 `email` varchar(128) ,
 `year` int(4) ,
 `month` int(2) ,
 `date_hired` date ,
 `address` varchar(128) ,
 `position_id` int(1) ,
 `end_date` date ,
 `birthdate` date ,
 `position` varchar(64) ,
 `project` varchar(64) ,
 `project_code` varchar(16) ,
 `age` tinyint(3) unsigned ,
 `birth_place` longtext ,
 `gender` longtext ,
 `civil_status` longtext 
)*/;

/*Table structure for table `partners_gender_age` */

DROP TABLE IF EXISTS `partners_gender_age`;

/*!50001 DROP VIEW IF EXISTS `partners_gender_age` */;
/*!50001 DROP TABLE IF EXISTS `partners_gender_age` */;

/*!50001 CREATE TABLE  `partners_gender_age`(
 `gender` longtext ,
 `edad` varchar(11) ,
 `bilang` decimal(23,0) 
)*/;

/*Table structure for table `partners_personal` */

DROP TABLE IF EXISTS `partners_personal`;

/*!50001 DROP VIEW IF EXISTS `partners_personal` */;
/*!50001 DROP TABLE IF EXISTS `partners_personal` */;

/*!50001 CREATE TABLE  `partners_personal`(
 `user_id` int(11) ,
 `alias` varchar(32) ,
 `organization` longtext ,
 `phone_1` longtext ,
 `phone_2` longtext ,
 `phone_3` longtext ,
 `mobile_1` longtext ,
 `mobile_2` longtext ,
 `mobile_3` longtext ,
 `address` longtext ,
 `city_town` longtext ,
 `country` longtext ,
 `zip_code` longtext ,
 `emergency_name` longtext ,
 `emergency_relationship` longtext ,
 `emergency_phone` longtext ,
 `emergency_mobile` longtext ,
 `emergency_address` longtext ,
 `emergency_city` longtext ,
 `emergency_country` longtext ,
 `emergency_zip_code` longtext ,
 `taxcode` longtext ,
 `sss_number` longtext ,
 `pagibig_number` longtext ,
 `philhealth_number` longtext ,
 `tin_number` longtext ,
 `bank_account_number_savings` longtext ,
 `bank_account_number_current` longtext ,
 `bank_account_name` longtext ,
 `gender` longtext ,
 `birth_place` longtext ,
 `religion` longtext ,
 `nationality` longtext ,
 `civil_status` longtext ,
 `solo_parent` longtext 
)*/;

/*Table structure for table `partners_personal_history_accountabilities` */

DROP TABLE IF EXISTS `partners_personal_history_accountabilities`;

/*!50001 DROP VIEW IF EXISTS `partners_personal_history_accountabilities` */;
/*!50001 DROP TABLE IF EXISTS `partners_personal_history_accountabilities` */;

/*!50001 CREATE TABLE  `partners_personal_history_accountabilities`(
 `user_id` int(11) ,
 `alias` varchar(32) ,
 `name` longtext ,
 `code` longtext ,
 `qty` longtext ,
 `date_issued` longtext ,
 `date_returned` longtext ,
 `remarks` longtext ,
 `photo` longtext 
)*/;

/*Table structure for table `partners_report` */

DROP TABLE IF EXISTS `partners_report`;

/*!50001 DROP VIEW IF EXISTS `partners_report` */;
/*!50001 DROP TABLE IF EXISTS `partners_report` */;

/*!50001 CREATE TABLE  `partners_report`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `full_name` varchar(64) ,
 `company_id` int(11) ,
 `salary` varchar(373) ,
 `sss_no` varchar(16) ,
 `phic_no` varchar(16) ,
 `hdmf_no` varchar(16) ,
 `resigned_date` date ,
 `email` varchar(128) ,
 `year` int(4) ,
 `month` int(2) ,
 `effectivity_date` date ,
 `company` varchar(64) ,
 `sss` varchar(32) ,
 `tin` varchar(32) ,
 `phic` varchar(32) ,
 `hdmf` varchar(32) ,
 `address` varchar(128) ,
 `birth_date` date ,
 `position_id` int(1) ,
 `position` varchar(64) 
)*/;

/*Table structure for table `partners_termination_letter_view` */

DROP TABLE IF EXISTS `partners_termination_letter_view`;

/*!50001 DROP VIEW IF EXISTS `partners_termination_letter_view` */;
/*!50001 DROP TABLE IF EXISTS `partners_termination_letter_view` */;

/*!50001 CREATE TABLE  `partners_termination_letter_view`(
 `full_name` varchar(64) ,
 `user_id` int(11) unsigned ,
 `position` varchar(64) ,
 `company_id` int(1) ,
 `company` varchar(64) ,
 `project_id` int(11) ,
 `project` varchar(64) ,
 `department_id` int(1) ,
 `department` varchar(64) ,
 `end_date` date 
)*/;

/*Table structure for table `payroll_1601c` */

DROP TABLE IF EXISTS `payroll_1601c`;

/*!50001 DROP VIEW IF EXISTS `payroll_1601c` */;
/*!50001 DROP TABLE IF EXISTS `payroll_1601c` */;

/*!50001 CREATE TABLE  `payroll_1601c`(
 `company_id` int(11) ,
 `company` varchar(64) ,
 `year` int(4) ,
 `month` int(2) ,
 `address` varchar(128) ,
 `tin` varchar(32) ,
 `rdo` varchar(4) ,
 `contact_no` varchar(16) ,
 `zipcode` varchar(16) ,
 `line_business` varchar(8) ,
 `other_nontax_compensation` double(19,2) ,
 `total_compensation` double(19,2) ,
 `wtax` double(19,2) ,
 `statutory_minimum` double(19,2) ,
 `overtime` double(19,2) 
)*/;

/*Table structure for table `payroll_1604cf_7_1` */

DROP TABLE IF EXISTS `payroll_1604cf_7_1`;

/*!50001 DROP VIEW IF EXISTS `payroll_1604cf_7_1` */;
/*!50001 DROP TABLE IF EXISTS `payroll_1604cf_7_1` */;

/*!50001 CREATE TABLE  `payroll_1604cf_7_1`(
 `user_id` int(11) ,
 `year` int(1) ,
 `company_id` int(11) ,
 `company` varchar(64) ,
 `schedule_num` varchar(4) ,
 `ftype_code` varchar(6) ,
 `comp_tin` varchar(32) ,
 `branch_code_employer` varchar(4) ,
 `return_period` datetime ,
 `seq_num` char(0) ,
 `emp_tin` varchar(255) ,
 `branch_code_employees` varchar(4) ,
 `lastname` varchar(30) ,
 `firstname` varchar(30) ,
 `middlename` varchar(30) ,
 `employment_from` date ,
 `employment_to` datetime ,
 `gross_compensation` decimal(12,2) ,
 `pres_nontax_13th_month` decimal(12,2) ,
 `pres_nontax_de_minimis` decimal(12,2) ,
 `pres_nontax_sss_etc` decimal(12,2) ,
 `pres_nontax_salaries` decimal(12,2) ,
 `total_nontax_comp_income` decimal(12,2) ,
 `pres_taxable_basic_salary` decimal(12,2) ,
 `pres_taxable_13th_month` decimal(12,2) ,
 `pres_taxable_salaries` decimal(13,2) ,
 `total_taxable_comp_income` decimal(12,2) ,
 `exmpn_code` varchar(3) ,
 `exmpn_amt` decimal(12,2) ,
 `premium_paid` decimal(3,2) ,
 `net_table_comp_income` decimal(12,2) ,
 `tax_due` decimal(12,2) ,
 `pres_tax_wthld` decimal(12,2) ,
 `amt_wthld_dec` decimal(3,2) ,
 `over_wthld` decimal(3,2) ,
 `actual_amt_wthld` decimal(14,2) ,
 `subs_filing` varchar(1) ,
 `resigned_date` date 
)*/;

/*Table structure for table `payroll_1604cf_7_3` */

DROP TABLE IF EXISTS `payroll_1604cf_7_3`;

/*!50001 DROP VIEW IF EXISTS `payroll_1604cf_7_3` */;
/*!50001 DROP TABLE IF EXISTS `payroll_1604cf_7_3` */;

/*!50001 CREATE TABLE  `payroll_1604cf_7_3`(
 `user_id` int(11) ,
 `year` int(1) ,
 `company_id` int(11) ,
 `company` varchar(64) ,
 `schedule_num` varchar(4) ,
 `ftype_code` varchar(6) ,
 `comp_tin` varchar(32) ,
 `branch_code_employer` varchar(4) ,
 `return_period` datetime ,
 `seq_num` char(0) ,
 `emp_tin` varchar(255) ,
 `branch_code_employees` varchar(4) ,
 `lastname` varchar(30) ,
 `firstname` varchar(30) ,
 `middlename` varchar(30) ,
 `employment_from` date ,
 `employment_to` datetime ,
 `gross_compensation` decimal(12,2) ,
 `pres_nontax_13th_month` decimal(12,2) ,
 `pres_nontax_de_minimis` decimal(12,2) ,
 `pres_nontax_sss_etc` decimal(12,2) ,
 `pres_nontax_salaries` decimal(12,2) ,
 `total_nontax_comp_income` decimal(12,2) ,
 `pres_taxable_basic_salary` decimal(12,2) ,
 `pres_taxable_13th_month` decimal(12,2) ,
 `pres_taxable_salaries` decimal(13,2) ,
 `total_taxable_comp_income` decimal(12,2) ,
 `exmpn_code` varchar(3) ,
 `exmpn_amt` decimal(12,2) ,
 `premium_paid` decimal(3,2) ,
 `net_table_comp_income` decimal(12,2) ,
 `tax_due` decimal(12,2) ,
 `pres_tax_wthld` decimal(12,2) ,
 `amt_wthld_dec` decimal(3,2) ,
 `over_wthld` decimal(3,2) ,
 `actual_amt_wthld` decimal(14,2) ,
 `subs_filing` varchar(1) ,
 `resigned_date` date 
)*/;

/*Table structure for table `payroll_1604cf_7_4` */

DROP TABLE IF EXISTS `payroll_1604cf_7_4`;

/*!50001 DROP VIEW IF EXISTS `payroll_1604cf_7_4` */;
/*!50001 DROP TABLE IF EXISTS `payroll_1604cf_7_4` */;

/*!50001 CREATE TABLE  `payroll_1604cf_7_4`(
 `user_id` int(11) ,
 `year` int(1) ,
 `company_id` int(11) ,
 `company` varchar(64) ,
 `schedule_num` varchar(4) ,
 `ftype_code` varchar(6) ,
 `comp_tin` varchar(32) ,
 `branch_code_employer` varchar(4) ,
 `return_period` datetime ,
 `seq_num` char(0) ,
 `emp_tin` varchar(255) ,
 `branch_code_employees` varchar(4) ,
 `lastname` varchar(30) ,
 `firstname` varchar(30) ,
 `middlename` varchar(30) ,
 `employment_from` date ,
 `employment_to` datetime ,
 `gross_compensation` decimal(12,2) ,
 `prev_nontax_13th_month` varbinary(255) ,
 `prev_nontax_de_minimis` varbinary(255) ,
 `prev_nontax_sss_etc` varchar(255) ,
 `prev_nontax_salaries` varbinary(255) ,
 `prev_total_nontax_comp_income` varbinary(255) ,
 `prev_taxable_basic_salary` varbinary(255) ,
 `prev_taxable_13th_month` varbinary(255) ,
 `prev_taxable_salaries` varbinary(255) ,
 `prev_total_taxable` varbinary(255) ,
 `pres_nontax_13th_month` decimal(12,2) ,
 `pres_nontax_de_minimis` decimal(12,2) ,
 `pres_nontax_sss_etc` decimal(12,2) ,
 `pres_nontax_salaries` decimal(12,2) ,
 `total_nontax_comp_income` decimal(12,2) ,
 `pres_taxable_basic_salary` decimal(12,2) ,
 `pres_taxable_13th_month` decimal(12,2) ,
 `pres_taxable_salaries` decimal(13,2) ,
 `pres_total_comp` decimal(12,2) ,
 `total_taxable_comp_income` decimal(12,2) ,
 `exmpn_code` varchar(3) ,
 `exmpn_amt` decimal(12,2) ,
 `premium_paid` decimal(3,2) ,
 `net_table_comp_income` decimal(12,2) ,
 `tax_due` decimal(12,2) ,
 `pres_tax_wthld` decimal(12,2) ,
 `prev_tax_wthld` varbinary(255) ,
 `amt_wthld_dec` decimal(3,2) ,
 `over_wthld` decimal(3,2) ,
 `actual_amt_wthld` decimal(14,2) ,
 `subs_filing` varchar(1) ,
 `resigned_date` date 
)*/;

/*Table structure for table `payroll_1604cf_7_5` */

DROP TABLE IF EXISTS `payroll_1604cf_7_5`;

/*!50001 DROP VIEW IF EXISTS `payroll_1604cf_7_5` */;
/*!50001 DROP TABLE IF EXISTS `payroll_1604cf_7_5` */;

/*!50001 CREATE TABLE  `payroll_1604cf_7_5`(
 `user_id` int(11) ,
 `year` int(1) ,
 `company_id` int(11) ,
 `company` varchar(64) ,
 `schedule_num` varchar(4) ,
 `ftype_code` varchar(6) ,
 `comp_tin` varchar(32) ,
 `branch_code_employer` varchar(4) ,
 `return_period` datetime ,
 `seq_num` char(0) ,
 `emp_tin` varchar(255) ,
 `branch_code_employees` varchar(4) ,
 `lastname` varchar(30) ,
 `firstname` varchar(30) ,
 `middlename` varchar(30) ,
 `employment_from` date ,
 `employment_to` datetime ,
 `gross_compensation` decimal(12,2) ,
 `pres_nontax_13th_month` decimal(12,2) ,
 `pres_nontax_de_minimis` decimal(12,2) ,
 `pres_nontax_sss_etc` decimal(12,2) ,
 `pres_nontax_salaries` decimal(12,2) ,
 `total_nontax_comp_income` decimal(12,2) ,
 `pres_taxable_basic_salary` decimal(12,2) ,
 `pres_taxable_13th_month` decimal(12,2) ,
 `pres_taxable_salaries` decimal(13,2) ,
 `total_taxable_comp_income` decimal(12,2) ,
 `exmpn_code` varchar(3) ,
 `exmpn_amt` decimal(12,2) ,
 `premium_paid` decimal(3,2) ,
 `net_table_comp_income` decimal(12,2) ,
 `tax_due` decimal(12,2) ,
 `pres_tax_wthld` decimal(12,2) ,
 `amt_wthld_dec` decimal(3,2) ,
 `over_wthld` decimal(3,2) ,
 `actual_amt_wthld` decimal(14,2) ,
 `subs_filing` varchar(1) ,
 `resigned_date` date 
)*/;

/*Table structure for table `payroll_account_report` */

DROP TABLE IF EXISTS `payroll_account_report`;

/*!50001 DROP VIEW IF EXISTS `payroll_account_report` */;
/*!50001 DROP TABLE IF EXISTS `payroll_account_report` */;

/*!50001 CREATE TABLE  `payroll_account_report`(
 `account_code` varchar(32) ,
 `account_name` varchar(255) ,
 `account_type` varchar(255) 
)*/;

/*Table structure for table `payroll_alpha_breakdown` */

DROP TABLE IF EXISTS `payroll_alpha_breakdown`;

/*!50001 DROP VIEW IF EXISTS `payroll_alpha_breakdown` */;
/*!50001 DROP TABLE IF EXISTS `payroll_alpha_breakdown` */;

/*!50001 CREATE TABLE  `payroll_alpha_breakdown`(
 `full_name` varchar(64) ,
 `year` int(4) ,
 `payroll_date` date ,
 `tax_basic` decimal(15,2) ,
 `tax_income` decimal(12,2) ,
 `min_basic` decimal(12,2) ,
 `min_income` decimal(12,2) ,
 `bonus` decimal(12,2) ,
 `deminimis` decimal(12,2) ,
 `wtax` decimal(12,2) ,
 `sss` decimal(12,2) ,
 `hdmf` decimal(12,2) ,
 `phic` decimal(12,2) ,
 `tot_contri` decimal(14,2) ,
 `employee` int(11) unsigned ,
 `company` int(11) 
)*/;

/*Table structure for table `payroll_alpha_minimum_wage_earner` */

DROP TABLE IF EXISTS `payroll_alpha_minimum_wage_earner`;

/*!50001 DROP VIEW IF EXISTS `payroll_alpha_minimum_wage_earner` */;
/*!50001 DROP TABLE IF EXISTS `payroll_alpha_minimum_wage_earner` */;

/*!50001 CREATE TABLE  `payroll_alpha_minimum_wage_earner`(
 `tin` varchar(255) ,
 `employee_name` varchar(98) ,
 `location` varchar(30) ,
 `hired_date` date ,
 `resigned_date` varbinary(17) ,
 `minwage_day` decimal(12,2) ,
 `minwage_month` decimal(12,2) ,
 `total_year_days` decimal(12,2) ,
 `col_5a` decimal(3,2) ,
 `col_5q` decimal(20,2) ,
 `col_5b` decimal(3,2) ,
 `col_5t` decimal(12,2) ,
 `col_5c` decimal(3,2) ,
 `col_5v` decimal(12,2) ,
 `col_5d` decimal(3,2) ,
 `col_5w` decimal(12,2) ,
 `col_5e` decimal(3,2) ,
 `col_5x` decimal(12,2) ,
 `col_5f` decimal(3,2) ,
 `col_5y` decimal(12,2) ,
 `col_5g` decimal(3,2) ,
 `col_5z` decimal(12,2) ,
 `col_5h` decimal(3,2) ,
 `col_5aa` decimal(12,2) ,
 `col_5i` decimal(3,2) ,
 `col_5ab` decimal(12,2) ,
 `col_5j` decimal(3,2) ,
 `col_5ac` decimal(12,2) ,
 `col_5k` decimal(20,2) ,
 `col_5l` decimal(3,2) ,
 `col_5ad` decimal(3,2) ,
 `col_5m` decimal(3,2) ,
 `col_5ae` decimal(3,2) ,
 `col_5n` decimal(3,2) ,
 `col_5af` decimal(3,2) ,
 `col_5ag` decimal(3,2) ,
 `exempt_code` varchar(3) ,
 `exempt_amount` decimal(12,2) ,
 `premium` decimal(3,2) ,
 `net_taxable` decimal(3,2) ,
 `taxdue` decimal(12,2) ,
 `wtax` decimal(12,2) ,
 `payable` decimal(13,2) ,
 `refund` decimal(13,2) ,
 `total_tax` decimal(12,2) ,
 `sub_filing` varchar(3) ,
 `company` int(11) ,
 `company_name` varchar(64) ,
 `company_address` varchar(128) ,
 `employee` int(11) ,
 `pay_year` int(1) 
)*/;

/*Table structure for table `payroll_alpha_terminated` */

DROP TABLE IF EXISTS `payroll_alpha_terminated`;

/*!50001 DROP VIEW IF EXISTS `payroll_alpha_terminated` */;
/*!50001 DROP TABLE IF EXISTS `payroll_alpha_terminated` */;

/*!50001 CREATE TABLE  `payroll_alpha_terminated`(
 `tin` varchar(255) ,
 `employee_name` varchar(98) ,
 `hired_date` date ,
 `resigned_date` date ,
 `col_4a` decimal(12,2) ,
 `col_4b` decimal(12,2) ,
 `col_4c` decimal(12,2) ,
 `col_4d` decimal(12,2) ,
 `col_4e` decimal(12,2) ,
 `col_4f` decimal(12,2) ,
 `col_4g` decimal(12,2) ,
 `col_4h` decimal(12,2) ,
 `col_4i` decimal(21,2) ,
 `col_4j` decimal(12,2) ,
 `exempt_code` varchar(3) ,
 `exempt_amount` decimal(12,2) ,
 `net_taxable` decimal(12,2) ,
 `taxdue` decimal(12,2) ,
 `wtax` decimal(12,2) ,
 `payable` decimal(13,2) ,
 `refund` decimal(13,2) ,
 `total_tax` decimal(12,2) ,
 `sub_filing` varchar(3) ,
 `company` int(11) ,
 `company_name` varchar(64) ,
 `company_address` varchar(128) ,
 `employee` int(11) ,
 `pay_year` int(1) 
)*/;

/*Table structure for table `payroll_alpha_without_previous` */

DROP TABLE IF EXISTS `payroll_alpha_without_previous`;

/*!50001 DROP VIEW IF EXISTS `payroll_alpha_without_previous` */;
/*!50001 DROP TABLE IF EXISTS `payroll_alpha_without_previous` */;

/*!50001 CREATE TABLE  `payroll_alpha_without_previous`(
 `tin` varchar(255) ,
 `employee_name` varchar(98) ,
 `hired_date` date ,
 `resigned_date` varbinary(17) ,
 `col_4a` decimal(12,2) ,
 `col_4b` decimal(12,2) ,
 `col_4c` decimal(12,2) ,
 `col_4d` decimal(12,2) ,
 `col_4e` decimal(12,2) ,
 `col_4f` decimal(12,2) ,
 `col_4g` decimal(12,2) ,
 `col_4h` decimal(12,2) ,
 `col_4i` decimal(21,2) ,
 `col_4j` decimal(12,2) ,
 `exempt_code` varchar(3) ,
 `exempt_amount` decimal(12,2) ,
 `net_taxable` decimal(12,2) ,
 `taxdue` decimal(12,2) ,
 `wtax` decimal(12,2) ,
 `payable` decimal(13,2) ,
 `refund` decimal(13,2) ,
 `total_tax` decimal(12,2) ,
 `sub_filing` varchar(3) ,
 `company` int(11) ,
 `company_name` varchar(64) ,
 `company_address` varchar(128) ,
 `employee` int(11) ,
 `pay_year` int(1) 
)*/;

/*Table structure for table `payroll_atm_register` */

DROP TABLE IF EXISTS `payroll_atm_register`;

/*!50001 DROP VIEW IF EXISTS `payroll_atm_register` */;
/*!50001 DROP TABLE IF EXISTS `payroll_atm_register` */;

/*!50001 CREATE TABLE  `payroll_atm_register`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `bank_id` int(11) ,
 `bank_account` varchar(32) ,
 `payout_schedule` tinyint(4) ,
 `payout_scheme` tinyint(4) ,
 `amount` decimal(12,2) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `department_id` int(11) ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `transaction_code` varchar(32) ,
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `record_reference` varchar(11) ,
 `address` varchar(128) ,
 `posting_date` date ,
 `account_no` varchar(128) ,
 `batch_no` int(11) ,
 `bank_code_numeric` varchar(20) ,
 `bank_code_alpha` varchar(30) ,
 `schedule` varchar(3) ,
 `bank_posting_date` varchar(4) 
)*/;

/*Table structure for table `payroll_attendance_adjustment` */

DROP TABLE IF EXISTS `payroll_attendance_adjustment`;

/*!50001 DROP VIEW IF EXISTS `payroll_attendance_adjustment` */;
/*!50001 DROP TABLE IF EXISTS `payroll_attendance_adjustment` */;

/*!50001 CREATE TABLE  `payroll_attendance_adjustment`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `full_name` varchar(64) ,
 `company_id` int(11) ,
 `company` varchar(64) ,
 `department_id` int(1) ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `logo` varchar(128) ,
 `date` date ,
 `payroll_date` date ,
 `original_payroll_date` date ,
 `transaction_id` int(1) ,
 `transaction_code` varchar(32) ,
 `transaction_label` varchar(128) ,
 `quantity` decimal(12,3) ,
 `type` varchar(10) ,
 `type_id` int(0) 
)*/;

/*Table structure for table `payroll_authority_debit` */

DROP TABLE IF EXISTS `payroll_authority_debit`;

/*!50001 DROP VIEW IF EXISTS `payroll_authority_debit` */;
/*!50001 DROP TABLE IF EXISTS `payroll_authority_debit` */;

/*!50001 CREATE TABLE  `payroll_authority_debit`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `amount` varbinary(255) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) unsigned ,
 `department_id` int(11) ,
 `department` varchar(64) ,
 `transaction_code` varchar(32) ,
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `city` varchar(32) ,
 `bank_name` varchar(50) ,
 `bank_account_no` varchar(128) ,
 `address1` text ,
 `address2` text ,
 `branch_officer` varchar(64) ,
 `branch_position` varchar(64) ,
 `signatory_1` varchar(64) ,
 `signatory_2` varchar(64) ,
 `account_name` varchar(128) 
)*/;

/*Table structure for table `payroll_bank_details_report` */

DROP TABLE IF EXISTS `payroll_bank_details_report`;

/*!50001 DROP VIEW IF EXISTS `payroll_bank_details_report` */;
/*!50001 DROP TABLE IF EXISTS `payroll_bank_details_report` */;

/*!50001 CREATE TABLE  `payroll_bank_details_report`(
 `account_name` varchar(64) ,
 `id_number` varchar(16) ,
 `bank_id` int(11) ,
 `account_number` varchar(32) ,
 `payout_schedule` tinyint(4) ,
 `payout_scheme` tinyint(4) ,
 `company_id` int(11) ,
 `company` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `amount` varbinary(255) ,
 `schedule` varchar(3) ,
 `payroll_date_actuall` varchar(4) 
)*/;

/*Table structure for table `payroll_bir` */

DROP TABLE IF EXISTS `payroll_bir`;

/*!50001 DROP VIEW IF EXISTS `payroll_bir` */;
/*!50001 DROP TABLE IF EXISTS `payroll_bir` */;

/*!50001 CREATE TABLE  `payroll_bir`(
 `user_id` int(11) ,
 `year` int(1) ,
 `month_from` varchar(4) ,
 `month_to` varchar(4) ,
 `emp_tin` varchar(255) ,
 `full_name` varchar(100) ,
 `emp_address` varchar(255) ,
 `emp_zipcode` varchar(4) ,
 `birth_date` date ,
 `company_id` int(11) ,
 `civil_status_id` int(11) ,
 `dep_name1` varchar(128) ,
 `dep_bday1` date ,
 `dep_name2` varchar(128) ,
 `dep_bday2` date ,
 `dep_name3` varchar(128) ,
 `dep_bday3` date ,
 `dep_name4` varchar(128) ,
 `dep_bday4` date ,
 `minwage_day` decimal(12,2) ,
 `minwage_month` decimal(12,2) ,
 `minwageflag` tinyint(1) ,
 `comp_tin` varchar(32) ,
 `company` varchar(64) ,
 `rdo` varchar(4) ,
 `comp_address` varchar(128) ,
 `comp_zipcode` varchar(16) ,
 `prev_tin` varchar(32) ,
 `prev_employer` varchar(64) ,
 `prev_address` varchar(128) ,
 `prev_zip` varchar(4) ,
 `item21` decimal(12,2) ,
 `item22` decimal(12,2) ,
 `item23` decimal(12,2) ,
 `item24` decimal(12,2) ,
 `item25` decimal(14,2) ,
 `item26` decimal(12,2) ,
 `item27` decimal(3,2) ,
 `item28` decimal(12,2) ,
 `item29` decimal(12,2) ,
 `item30A` decimal(12,2) ,
 `item30B` decimal(12,2) ,
 `item31` decimal(14,2) ,
 `item32` decimal(12,2) ,
 `item33` decimal(12,2) ,
 `item34` decimal(12,2) ,
 `item35` decimal(12,2) ,
 `item36` decimal(12,2) ,
 `item37` decimal(12,2) ,
 `item38` decimal(12,2) ,
 `item39` decimal(12,2) ,
 `item40` decimal(12,2) ,
 `item41` decimal(12,2) ,
 `item42` decimal(12,2) ,
 `item43` decimal(12,2) ,
 `item44` decimal(12,2) ,
 `item45` decimal(12,2) ,
 `item46` decimal(12,2) ,
 `nitem47A` char(0) ,
 `item47A` decimal(12,2) ,
 `nitem47B` char(0) ,
 `item47B` decimal(12,2) ,
 `item48` decimal(12,2) ,
 `item49` decimal(12,2) ,
 `item50` decimal(12,2) ,
 `item51` decimal(12,2) ,
 `item52` decimal(12,2) ,
 `item53` decimal(12,2) ,
 `nitem54A` char(0) ,
 `item54A` char(0) ,
 `nitem54B` char(0) ,
 `item54B` char(0) ,
 `item55` decimal(12,2) 
)*/;

/*Table structure for table `payroll_bonus_basis` */

DROP TABLE IF EXISTS `payroll_bonus_basis`;

/*!50001 DROP VIEW IF EXISTS `payroll_bonus_basis` */;
/*!50001 DROP TABLE IF EXISTS `payroll_bonus_basis` */;

/*!50001 CREATE TABLE  `payroll_bonus_basis`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `lastname` varchar(64) ,
 `firstname` varchar(64) ,
 `middlename` varchar(64) ,
 `company_id` int(11) ,
 `company` varchar(64) ,
 `department_id` int(11) ,
 `department` varchar(64) ,
 `pay_year` int(4) ,
 `jan_reg` double(19,2) ,
 `jan_saladj` double(19,2) ,
 `jan_deminimis` double(19,2) ,
 `feb_reg` double(19,2) ,
 `feb_saladj` double(19,2) ,
 `feb_deminimis` double(19,2) ,
 `mar_reg` double(19,2) ,
 `mar_saladj` double(19,2) ,
 `mar_deminimis` double(19,2) ,
 `apr_reg` double(19,2) ,
 `apr_saladj` double(19,2) ,
 `apr_deminimis` double(19,2) ,
 `may_reg` double(19,2) ,
 `may_saladj` double(19,2) ,
 `may_deminimis` double(19,2) ,
 `jun_reg` double(19,2) ,
 `jun_saladj` double(19,2) ,
 `jun_deminimis` double(19,2) ,
 `jul_reg` double(19,2) ,
 `jul_saladj` double(19,2) ,
 `jul_deminimis` double(19,2) ,
 `aug_reg` double(19,2) ,
 `aug_saladj` double(19,2) ,
 `aug_deminimis` double(19,2) ,
 `sep_reg` double(19,2) ,
 `sep_saladj` double(19,2) ,
 `sep_deminimis` double(19,2) ,
 `oct_reg` double(19,2) ,
 `oct_saladj` double(19,2) ,
 `oct_deminimis` double(19,2) ,
 `nov_reg` double(19,2) ,
 `nov_saladj` double(19,2) ,
 `nov_deminimis` double(19,2) ,
 `dec_reg` double(19,2) ,
 `dec_saladj` double(19,2) ,
 `dec_deminimis` double(19,2) ,
 `total` double(19,2) ,
 `month_count` decimal(4,2) ,
 `bonus` double(19,2) ,
 `ceiling_amount` decimal(12,2) ,
 `taxable` double(19,2) 
)*/;

/*Table structure for table `payroll_contribution_loan_summary` */

DROP TABLE IF EXISTS `payroll_contribution_loan_summary`;

/*!50001 DROP VIEW IF EXISTS `payroll_contribution_loan_summary` */;
/*!50001 DROP TABLE IF EXISTS `payroll_contribution_loan_summary` */;

/*!50001 CREATE TABLE  `payroll_contribution_loan_summary`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `department_id` int(11) ,
 `department` varchar(64) ,
 `transaction_label` varchar(128) ,
 `transaction_id` int(11) unsigned ,
 `transaction_code` varchar(32) ,
 `reference_no` bigint(20) ,
 `payroll_date` date ,
 `year` bigint(20) ,
 `month` bigint(20) ,
 `date_from` date ,
 `date_to` date ,
 `amount` double(19,2) ,
 `record_reference` varchar(11) ,
 `address` varchar(128) ,
 `phone_no` varchar(255) ,
 `fax_no` varchar(255) 
)*/;

/*Table structure for table `payroll_deduction` */

DROP TABLE IF EXISTS `payroll_deduction`;

/*!50001 DROP VIEW IF EXISTS `payroll_deduction` */;
/*!50001 DROP TABLE IF EXISTS `payroll_deduction` */;

/*!50001 CREATE TABLE  `payroll_deduction`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `full_name` varchar(64) ,
 `lastname` varchar(64) ,
 `firstname` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `project_id` int(11) unsigned ,
 `project` varchar(64) ,
 `project_code` varchar(16) ,
 `department_id` int(11) ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `transaction_label` varchar(128) ,
 `transaction_id` int(11) unsigned ,
 `payroll_rate_type` varchar(64) ,
 `payroll_rate_type_id` int(11) ,
 `reference_no` bigint(20) ,
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `start_date` varbinary(10) ,
 `amount` varbinary(255) ,
 `record_reference` varchar(11) ,
 `address` varchar(128) ,
 `phone_no` varchar(255) ,
 `fax_no` varchar(255) 
)*/;

/*Table structure for table `payroll_deduction_schedule_dtl` */

DROP TABLE IF EXISTS `payroll_deduction_schedule_dtl`;

/*!50001 DROP VIEW IF EXISTS `payroll_deduction_schedule_dtl` */;
/*!50001 DROP TABLE IF EXISTS `payroll_deduction_schedule_dtl` */;

/*!50001 CREATE TABLE  `payroll_deduction_schedule_dtl`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `department_id` int(11) ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `transaction_label` varchar(128) ,
 `transaction_id` int(11) unsigned ,
 `reference_no` bigint(20) ,
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `amount` varbinary(255) ,
 `record_reference` varchar(11) ,
 `address` varchar(128) 
)*/;

/*Table structure for table `payroll_exit_clearance_report` */

DROP TABLE IF EXISTS `payroll_exit_clearance_report`;

/*!50001 DROP VIEW IF EXISTS `payroll_exit_clearance_report` */;
/*!50001 DROP TABLE IF EXISTS `payroll_exit_clearance_report` */;

/*!50001 CREATE TABLE  `payroll_exit_clearance_report`(
 `user_id` int(11) unsigned ,
 `full_name` varchar(64) ,
 `id_number` varchar(16) ,
 `payroll_date` date ,
 `year` int(4) ,
 `date_from` date ,
 `date_to` date ,
 `company_id` int(11) ,
 `company` varchar(64) ,
 `project_id` int(11) unsigned ,
 `project_code` varchar(16) ,
 `project` varchar(64) ,
 `position` varchar(64) ,
 `effectivity_date` date ,
 `regularization_date` date ,
 `resigned_date` date ,
 `remarks` char(0) ,
 `payroll_rate_type_id` int(11) ,
 `payroll_rate_type` varchar(64) ,
 `basic` double ,
 `misc` double ,
 `ot` double ,
 `nd` double ,
 `holiday` double ,
 `other_earnings` double ,
 `gross` double ,
 `sss_ee` double ,
 `sss_er` double(19,2) ,
 `sss_ec` double(19,2) ,
 `phic_ee` double ,
 `phic_er` double ,
 `hdmf_ee` double ,
 `hdmf_er` double ,
 `tax` double ,
 `loan` double ,
 `other_nontax` double(19,2) ,
 `employee_ledger` double ,
 `other_deduction` double ,
 `deduction` double ,
 `net_amount` double 
)*/;

/*Table structure for table `payroll_journal_voucher` */

DROP TABLE IF EXISTS `payroll_journal_voucher`;

/*!50001 DROP VIEW IF EXISTS `payroll_journal_voucher` */;
/*!50001 DROP TABLE IF EXISTS `payroll_journal_voucher` */;

/*!50001 CREATE TABLE  `payroll_journal_voucher`(
 `description` text ,
 `account_name` varchar(255) ,
 `account_code` varchar(32) ,
 `credit` varbinary(23) ,
 `debit` varbinary(23) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `department_id` int(11) ,
 `department` varchar(64) ,
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `address` varchar(128) ,
 `arrangement` varchar(3) 
)*/;

/*Table structure for table `payroll_journal_voucher_extended` */

DROP TABLE IF EXISTS `payroll_journal_voucher_extended`;

/*!50001 DROP VIEW IF EXISTS `payroll_journal_voucher_extended` */;
/*!50001 DROP TABLE IF EXISTS `payroll_journal_voucher_extended` */;

/*!50001 CREATE TABLE  `payroll_journal_voucher_extended`(
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `company` varchar(64) ,
 `address` varchar(128) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `account` varchar(32) ,
 `description` varchar(255) ,
 `sub_account` varchar(32) ,
 `project` char(0) ,
 `project_task` char(0) ,
 `ref_number` char(0) ,
 `quantity` int(1) ,
 `uom` char(0) ,
 `debit_amount` double ,
 `credit_amount` double ,
 `transaction_description` text ,
 `non_billable` varchar(5) 
)*/;

/*Table structure for table `payroll_manpower_charging` */

DROP TABLE IF EXISTS `payroll_manpower_charging`;

/*!50001 DROP VIEW IF EXISTS `payroll_manpower_charging` */;
/*!50001 DROP TABLE IF EXISTS `payroll_manpower_charging` */;

/*!50001 CREATE TABLE  `payroll_manpower_charging`(
 `date` date ,
 `employee` int(11) ,
 `id_number` varchar(16) ,
 `classification_id` int(1) ,
 `classification` varchar(32) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(1) ,
 `project_code` varchar(16) ,
 `project` varchar(64) ,
 `project_id` int(11) ,
 `payroll_rate_type_id` int(1) ,
 `payroll_rate_type` varchar(64) ,
 `payroll_date` date ,
 `date_to` date ,
 `date_from` date ,
 `num_days` bigint(21) ,
 `num_days_cutoff` int(8) ,
 `percent` decimal(27,4) 
)*/;

/*Table structure for table `payroll_manpower_charging_detail` */

DROP TABLE IF EXISTS `payroll_manpower_charging_detail`;

/*!50001 DROP VIEW IF EXISTS `payroll_manpower_charging_detail` */;
/*!50001 DROP TABLE IF EXISTS `payroll_manpower_charging_detail` */;

/*!50001 CREATE TABLE  `payroll_manpower_charging_detail`(
 `project_code` varchar(16) ,
 `project` varchar(64) ,
 `project_id` int(11) unsigned ,
 `employee` int(11) ,
 `date` date ,
 `id_number` varchar(16) ,
 `classification_id` int(1) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(1) ,
 `payroll_rate_type_id` int(1) ,
 `payroll_rate_type` varchar(64) ,
 `payroll_date` date ,
 `date_to` date ,
 `date_from` date ,
 `P14007` varbinary(52) ,
 `P15024` varbinary(52) ,
 `P16000` varbinary(52) ,
 `P16003` varbinary(52) ,
 `P16004` varbinary(52) ,
 `P16010` varbinary(52) ,
 `P16014` varbinary(52) ,
 `P16015` varbinary(52) ,
 `P16016` varbinary(52) 
)*/;

/*Table structure for table `payroll_manpower_charging_summary` */

DROP TABLE IF EXISTS `payroll_manpower_charging_summary`;

/*!50001 DROP VIEW IF EXISTS `payroll_manpower_charging_summary` */;
/*!50001 DROP TABLE IF EXISTS `payroll_manpower_charging_summary` */;

/*!50001 CREATE TABLE  `payroll_manpower_charging_summary`(
 `employee` int(11) unsigned ,
 `id_number` varchar(16) ,
 `full_name` varchar(64) ,
 `position` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) unsigned ,
 `project_code` varchar(16) ,
 `project` varchar(64) ,
 `project_id` int(11) unsigned ,
 `payroll_rate_type_id` int(11) ,
 `payroll_rate_type` varchar(64) ,
 `payroll_date` date ,
 `cost_center` text ,
 `total_basic` double(19,2) ,
 `misc` double ,
 `overtime` double(19,2) ,
 `other_tax` bigint(20) ,
 `adjustment` bigint(20) ,
 `gross` double ,
 `tax` double ,
 `sss_ee` double ,
 `other_nontax` double(19,2) ,
 `sss_er` double(19,2) ,
 `sss_ec` double(19,2) ,
 `hdmf_er` double(19,2) ,
 `phic_er` double(19,2) ,
 `meal` bigint(20) ,
 `transpo` bigint(20) ,
 `hardship` bigint(20) ,
 `loan` double ,
 `deduction` double ,
 `net_amount` double ,
 `net_orig` bigint(20) ,
 `percent_allocation` bigint(20) 
)*/;

/*Table structure for table `payroll_monthly_deduction` */

DROP TABLE IF EXISTS `payroll_monthly_deduction`;

/*!50001 DROP VIEW IF EXISTS `payroll_monthly_deduction` */;
/*!50001 DROP TABLE IF EXISTS `payroll_monthly_deduction` */;

/*!50001 CREATE TABLE  `payroll_monthly_deduction`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `department_id` int(11) ,
 `department` varchar(64) ,
 `transaction_label` varchar(128) ,
 `transaction_id` int(11) unsigned ,
 `loan_id` int(11) unsigned ,
 `loan` varchar(128) ,
 `reference_no` bigint(20) ,
 `year` bigint(20) ,
 `month` bigint(20) ,
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `amount` varbinary(255) ,
 `record_reference` varchar(11) ,
 `address` varchar(128) ,
 `phone_no` varchar(255) ,
 `fax_no` varchar(255) 
)*/;

/*Table structure for table `payroll_non_atm_register` */

DROP TABLE IF EXISTS `payroll_non_atm_register`;

/*!50001 DROP VIEW IF EXISTS `payroll_non_atm_register` */;
/*!50001 DROP TABLE IF EXISTS `payroll_non_atm_register` */;

/*!50001 CREATE TABLE  `payroll_non_atm_register`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `bank_account` varchar(32) ,
 `payout_schedule` tinyint(4) ,
 `payout_scheme` tinyint(4) ,
 `amount` decimal(12,2) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `department_id` int(11) ,
 `department` varbinary(192) ,
 `branch_id` varbinary(192) ,
 `branch` varchar(64) ,
 `transaction_code` varchar(32) ,
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `record_reference` varchar(11) ,
 `address` varchar(128) ,
 `schedule` varchar(3) 
)*/;

/*Table structure for table `payroll_pagibig_loan_to_disk` */

DROP TABLE IF EXISTS `payroll_pagibig_loan_to_disk`;

/*!50001 DROP VIEW IF EXISTS `payroll_pagibig_loan_to_disk` */;
/*!50001 DROP TABLE IF EXISTS `payroll_pagibig_loan_to_disk` */;

/*!50001 CREATE TABLE  `payroll_pagibig_loan_to_disk`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `lastname` varchar(64) ,
 `firstname` varchar(64) ,
 `middlename` varchar(64) ,
 `suffix` varchar(16) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(1) unsigned ,
 `pagibig_branch_code` varchar(32) ,
 `tin` varchar(16) ,
 `co_sss` varchar(32) ,
 `co_phic` varchar(32) ,
 `co_hdmf` varchar(32) ,
 `co_address` varchar(128) ,
 `zipcode` varchar(16) ,
 `contact_no` varchar(255) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `year` int(4) ,
 `month` int(2) ,
 `birth_date` date ,
 `sss_no` varchar(16) ,
 `phic_no` varchar(16) ,
 `hdmf_no` varchar(16) ,
 `loan_type` varchar(128) ,
 `loan_type_id` int(11) unsigned ,
 `partner_loan_id` int(11) ,
 `description` text ,
 `balance` decimal(12,2) ,
 `loan_principal` varbinary(255) ,
 `amount` double(19,2) ,
 `record` varchar(168) ,
 `document_date` datetime 
)*/;

/*Table structure for table `payroll_pagibig_to_disk` */

DROP TABLE IF EXISTS `payroll_pagibig_to_disk`;

/*!50001 DROP VIEW IF EXISTS `payroll_pagibig_to_disk` */;
/*!50001 DROP TABLE IF EXISTS `payroll_pagibig_to_disk` */;

/*!50001 CREATE TABLE  `payroll_pagibig_to_disk`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `title` varchar(16) ,
 `lastname` varchar(64) ,
 `firstname` varchar(64) ,
 `middlename` varchar(64) ,
 `suffix` varchar(16) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `bcode` varchar(32) ,
 `pagibig_branch_code` varchar(32) ,
 `co_hdmf` varchar(32) ,
 `co_address` varchar(128) ,
 `zipcode` varchar(16) ,
 `contact_no` varchar(255) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `year` int(4) ,
 `month` int(2) ,
 `payroll_date` date ,
 `birth_date` date ,
 `hdmf_no` varchar(16) ,
 `hired_date` date ,
 `resigned_date` date ,
 `sbr_no_hdmf` char(0) ,
 `sbr_date_hdmf` char(0) ,
 `govt_status` varchar(1) ,
 `hdmf_emp` double ,
 `hdmf_com` double ,
 `PagIbigAdd` double ,
 `record` varchar(168) ,
 `document_date` datetime 
)*/;

/*Table structure for table `payroll_partners` */

DROP TABLE IF EXISTS `payroll_partners`;

/*!50001 DROP VIEW IF EXISTS `payroll_partners` */;
/*!50001 DROP TABLE IF EXISTS `payroll_partners` */;

/*!50001 CREATE TABLE  `payroll_partners`(
 `user_id` int(11) unsigned ,
 `company_id` int(11) ,
 `taxcode_id` int(1) ,
 `payroll_rate_type_id` int(1) ,
 `payroll_schedule_id` int(1) ,
 `total_year_days` decimal(5,2) ,
 `salary` varbinary(255) ,
 `minimum_takehome` varbinary(255) ,
 `bank_account` varchar(32) ,
 `quitclaim` tinyint(1) ,
 `location_id` int(11) ,
 `sss_no` varchar(16) ,
 `sss_mode` int(1) ,
 `sss_week` varchar(32) ,
 `sss_amount` varbinary(255) ,
 `hdmf_no` varchar(16) ,
 `hdmf_mode` int(1) ,
 `hdmf_week` varchar(32) ,
 `hdmf_amount` varbinary(255) ,
 `phic_no` varchar(16) ,
 `phic_mode` int(11) ,
 `phic_week` varchar(32) ,
 `phic_amount` varbinary(255) ,
 `ecola_week` varchar(32) ,
 `tin` varchar(16) ,
 `tax_mode` int(1) ,
 `tax_week` varchar(32) ,
 `payment_type_id` int(11) ,
 `fixed_rate` tinyint(1) ,
 `sensitivity` tinyint(1) ,
 `created_by` int(11) ,
 `created_on` timestamp ,
 `modified_by` int(11) ,
 `modified_on` datetime ,
 `remain` int(11) ,
 `deleted` tinyint(1) 
)*/;

/*Table structure for table `payroll_partners_contribution` */

DROP TABLE IF EXISTS `payroll_partners_contribution`;

/*!50001 DROP VIEW IF EXISTS `payroll_partners_contribution` */;
/*!50001 DROP TABLE IF EXISTS `payroll_partners_contribution` */;

/*!50001 CREATE TABLE  `payroll_partners_contribution`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `title` varchar(16) ,
 `lastname` varchar(64) ,
 `firstname` varchar(64) ,
 `middlename` varchar(64) ,
 `suffix` varchar(16) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `tin` varchar(32) ,
 `co_sss` varchar(32) ,
 `co_phic` varchar(32) ,
 `co_hdmf` varchar(32) ,
 `co_address` varchar(128) ,
 `zipcode` varchar(16) ,
 `company_code` varchar(16) ,
 `contact_no` varchar(255) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `year` int(4) ,
 `month` int(2) ,
 `payroll_date` date ,
 `birth_date` date ,
 `sss_no` varchar(16) ,
 `phic_no` varchar(16) ,
 `hdmf_no` varchar(16) ,
 `hired_date` date ,
 `resigned_date` date ,
 `sbr_no_hdmf` varchar(16) ,
 `sbr_no_phic` varchar(16) ,
 `sbr_no_sss` varchar(16) ,
 `sbr_date_hdmf` date ,
 `sbr_date_phic` date ,
 `sbr_date_sss` date ,
 `govt_status` varchar(1) ,
 `sss_emp` double ,
 `sss_com` double ,
 `sss_ecc` double ,
 `hdmf_emp` double ,
 `hdmf_com` double ,
 `phic_emp` double ,
 `phic_com` double 
)*/;

/*Table structure for table `payroll_partners_contribution_current_and_closed` */

DROP TABLE IF EXISTS `payroll_partners_contribution_current_and_closed`;

/*!50001 DROP VIEW IF EXISTS `payroll_partners_contribution_current_and_closed` */;
/*!50001 DROP TABLE IF EXISTS `payroll_partners_contribution_current_and_closed` */;

/*!50001 CREATE TABLE  `payroll_partners_contribution_current_and_closed`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `title` varchar(16) ,
 `lastname` varchar(64) ,
 `firstname` varchar(64) ,
 `middlename` varchar(64) ,
 `suffix` varchar(16) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `tin` varchar(32) ,
 `co_sss` varchar(32) ,
 `co_phic` varchar(32) ,
 `co_hdmf` varchar(32) ,
 `co_address` varchar(128) ,
 `zipcode` varchar(16) ,
 `company_code` varchar(16) ,
 `contact_no` varchar(255) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `year` bigint(20) ,
 `month` bigint(20) ,
 `payroll_date` date ,
 `birth_date` date ,
 `sss_no` varchar(16) ,
 `phic_no` varchar(16) ,
 `hdmf_no` varchar(16) ,
 `hired_date` date ,
 `resigned_date` date ,
 `sbr_no_hdmf` varchar(16) ,
 `sbr_no_phic` varchar(16) ,
 `sbr_no_sss` varchar(16) ,
 `sbr_date_hdmf` date ,
 `sbr_date_phic` date ,
 `sbr_date_sss` date ,
 `govt_status` varchar(1) ,
 `sss_emp` double ,
 `sss_com` double ,
 `sss_ecc` double ,
 `hdmf_emp` double ,
 `hdmf_com` double ,
 `phic_emp` double ,
 `phic_com` double 
)*/;

/*Table structure for table `payroll_partners_contribution_hdmf` */

DROP TABLE IF EXISTS `payroll_partners_contribution_hdmf`;

/*!50001 DROP VIEW IF EXISTS `payroll_partners_contribution_hdmf` */;
/*!50001 DROP TABLE IF EXISTS `payroll_partners_contribution_hdmf` */;

/*!50001 CREATE TABLE  `payroll_partners_contribution_hdmf`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `title` varchar(16) ,
 `lastname` varchar(64) ,
 `firstname` varchar(64) ,
 `middlename` varchar(64) ,
 `suffix` varchar(16) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `bcode` varchar(32) ,
 `pagibig_branch_code` varchar(32) ,
 `co_hdmf` varchar(32) ,
 `co_address` varchar(128) ,
 `zipcode` varchar(16) ,
 `company_code` varchar(16) ,
 `contact_no` varchar(255) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `year` int(4) ,
 `month` int(2) ,
 `payroll_date` date ,
 `birth_date` date ,
 `hdmf_no` varchar(16) ,
 `hired_date` date ,
 `resigned_date` date ,
 `sbr_no_hdmf` char(0) ,
 `sbr_date_hdmf` char(0) ,
 `govt_status` varchar(1) ,
 `hdmf_emp` double ,
 `hdmf_com` double ,
 `PagIbigAdd` double ,
 `record` varchar(168) 
)*/;

/*Table structure for table `payroll_partners_contribution_phic` */

DROP TABLE IF EXISTS `payroll_partners_contribution_phic`;

/*!50001 DROP VIEW IF EXISTS `payroll_partners_contribution_phic` */;
/*!50001 DROP TABLE IF EXISTS `payroll_partners_contribution_phic` */;

/*!50001 CREATE TABLE  `payroll_partners_contribution_phic`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `title` varchar(16) ,
 `lastname` varchar(64) ,
 `firstname` varchar(64) ,
 `middlename` varchar(64) ,
 `suffix` varchar(16) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `tin` varchar(32) ,
 `co_sss` varchar(32) ,
 `co_phic` varchar(32) ,
 `co_hdmf` varchar(32) ,
 `co_address` varchar(128) ,
 `zipcode` varchar(16) ,
 `company_code` varchar(16) ,
 `contact_no` varchar(255) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `year` int(4) ,
 `month` int(2) ,
 `payroll_date` date ,
 `birth_date` date ,
 `sss_no` varchar(16) ,
 `phic_no` varchar(16) ,
 `hdmf_no` varchar(16) ,
 `hired_date` date ,
 `resigned_date` date ,
 `sbr_no_phic` char(0) ,
 `sbr_date_phic` char(0) ,
 `govt_status` varchar(1) ,
 `phic_emp` double ,
 `phic_com` double 
)*/;

/*Table structure for table `payroll_partners_contribution_quarterly` */

DROP TABLE IF EXISTS `payroll_partners_contribution_quarterly`;

/*!50001 DROP VIEW IF EXISTS `payroll_partners_contribution_quarterly` */;
/*!50001 DROP TABLE IF EXISTS `payroll_partners_contribution_quarterly` */;

/*!50001 CREATE TABLE  `payroll_partners_contribution_quarterly`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `lastname` varchar(64) ,
 `firstname` varchar(64) ,
 `middlename` varchar(64) ,
 `suffix` varchar(16) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `tin` varchar(32) ,
 `co_sss` varchar(32) ,
 `co_phic` varchar(32) ,
 `co_hdmf` varchar(32) ,
 `co_address` varchar(128) ,
 `zipcode` varchar(16) ,
 `contact_no` varchar(255) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `birth_date` date ,
 `sss_no` varchar(16) ,
 `phic_no` varchar(16) ,
 `hdmf_no` varchar(16) ,
 `year` int(4) ,
 `period_month` int(0) ,
 `sss_1` double ,
 `sss_2` double ,
 `sss_3` double ,
 `ec_1` double ,
 `ec_2` double ,
 `ec_3` double ,
 `hdmf_e1` double ,
 `hdmf_e2` double ,
 `hdmf_e3` double ,
 `hdmf_c1` double ,
 `hdmf_c2` double ,
 `hdmf_c3` double ,
 `phic_e1` double ,
 `phic_e2` double ,
 `phic_e3` double ,
 `phic_c1` double ,
 `phic_c2` double ,
 `phic_c3` double 
)*/;

/*Table structure for table `payroll_partners_contribution_sss` */

DROP TABLE IF EXISTS `payroll_partners_contribution_sss`;

/*!50001 DROP VIEW IF EXISTS `payroll_partners_contribution_sss` */;
/*!50001 DROP TABLE IF EXISTS `payroll_partners_contribution_sss` */;

/*!50001 CREATE TABLE  `payroll_partners_contribution_sss`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `title` varchar(16) ,
 `lastname` varchar(64) ,
 `firstname` varchar(64) ,
 `middlename` varchar(64) ,
 `suffix` varchar(16) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `tin` varchar(32) ,
 `co_sss` varchar(32) ,
 `co_address` varchar(128) ,
 `zipcode` varchar(16) ,
 `company_code` varchar(16) ,
 `contact_no` varchar(255) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `year` int(4) ,
 `month` int(2) ,
 `payroll_date` date ,
 `birth_date` date ,
 `sss_no` varchar(16) ,
 `phic_no` varchar(16) ,
 `hdmf_no` varchar(16) ,
 `hired_date` date ,
 `resigned_date` date ,
 `sbr_no_sss` char(0) ,
 `sbr_date_sss` char(0) ,
 `govt_status` varchar(1) ,
 `sss_emp` double ,
 `sss_com` double ,
 `sss_ecc` double 
)*/;

/*Table structure for table `payroll_partners_loan` */

DROP TABLE IF EXISTS `payroll_partners_loan`;

/*!50001 DROP VIEW IF EXISTS `payroll_partners_loan` */;
/*!50001 DROP TABLE IF EXISTS `payroll_partners_loan` */;

/*!50001 CREATE TABLE  `payroll_partners_loan`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `lastname` varchar(64) ,
 `firstname` varchar(64) ,
 `middlename` varchar(64) ,
 `suffix` varchar(16) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `tin` varchar(32) ,
 `co_sss` varchar(32) ,
 `co_phic` varchar(32) ,
 `co_hdmf` varchar(32) ,
 `co_address` varchar(128) ,
 `zipcode` varchar(16) ,
 `contact_no` varchar(255) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `year` int(4) ,
 `month` int(2) ,
 `birth_date` date ,
 `sss_no` varchar(16) ,
 `phic_no` varchar(16) ,
 `hdmf_no` varchar(16) ,
 `loan` int(11) ,
 `loan_type` varchar(128) ,
 `loan_type_id` int(11) unsigned ,
 `partner_loan_id` int(11) ,
 `description` text ,
 `balance` double(19,2) ,
 `entry_date` date ,
 `category` varchar(128) ,
 `loan_principal` double(19,2) ,
 `amount` double(19,2) 
)*/;

/*Table structure for table `payroll_partners_loan_hdmf` */

DROP TABLE IF EXISTS `payroll_partners_loan_hdmf`;

/*!50001 DROP VIEW IF EXISTS `payroll_partners_loan_hdmf` */;
/*!50001 DROP TABLE IF EXISTS `payroll_partners_loan_hdmf` */;

/*!50001 CREATE TABLE  `payroll_partners_loan_hdmf`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `lastname` varchar(64) ,
 `firstname` varchar(64) ,
 `middlename` varchar(64) ,
 `suffix` varchar(16) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `tin` varchar(16) ,
 `co_sss` varchar(32) ,
 `co_phic` varchar(32) ,
 `co_hdmf` varchar(32) ,
 `co_address` varchar(128) ,
 `zipcode` varchar(16) ,
 `contact_no` varchar(255) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `year` int(4) ,
 `month` int(2) ,
 `birth_date` date ,
 `sss_no` varchar(16) ,
 `phic_no` varchar(16) ,
 `hdmf_no` varchar(16) ,
 `loan_type` varchar(128) ,
 `loan_type_id` int(11) unsigned ,
 `partner_loan_id` int(11) ,
 `description` text ,
 `balance` decimal(12,2) ,
 `loan_principal` varbinary(255) ,
 `amount` double(19,2) 
)*/;

/*Table structure for table `payroll_partners_loan_sss` */

DROP TABLE IF EXISTS `payroll_partners_loan_sss`;

/*!50001 DROP VIEW IF EXISTS `payroll_partners_loan_sss` */;
/*!50001 DROP TABLE IF EXISTS `payroll_partners_loan_sss` */;

/*!50001 CREATE TABLE  `payroll_partners_loan_sss`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `lastname` varchar(64) ,
 `firstname` varchar(64) ,
 `middlename` varchar(64) ,
 `suffix` varchar(16) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `tin` varchar(32) ,
 `co_sss` varchar(32) ,
 `co_phic` varchar(32) ,
 `co_hdmf` varchar(32) ,
 `co_address` varchar(128) ,
 `zipcode` varchar(16) ,
 `contact_no` varchar(255) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `year` int(4) ,
 `month` int(2) ,
 `birth_date` date ,
 `sss_no` varchar(16) ,
 `phic_no` varchar(16) ,
 `hdmf_no` varchar(16) ,
 `loan_type` varchar(128) ,
 `loan_type_id` int(11) unsigned ,
 `partner_loan_id` int(11) ,
 `description` text ,
 `balance` decimal(12,2) ,
 `loan_principal` varbinary(255) ,
 `amount` varbinary(255) 
)*/;

/*Table structure for table `payroll_payslip` */

DROP TABLE IF EXISTS `payroll_payslip`;

/*!50001 DROP VIEW IF EXISTS `payroll_payslip` */;
/*!50001 DROP TABLE IF EXISTS `payroll_payslip` */;

/*!50001 CREATE TABLE  `payroll_payslip`(
 `employee` int(11) unsigned ,
 `company_id` int(11) ,
 `company` varchar(64) ,
 `address` varchar(128) ,
 `city` varchar(32) ,
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `full_name` varchar(64) ,
 `department_id` int(11) ,
 `department_code` varchar(16) ,
 `project_id` int(11) unsigned ,
 `project_code` varchar(16) ,
 `project` varchar(64) ,
 `payroll_rate_type_id` int(11) ,
 `payroll_rate_type` varchar(64) ,
 `adjustment` bigint(20) ,
 `other_taxable` bigint(20) ,
 `absent_tardy` bigint(20) ,
 `sss` bigint(20) ,
 `philhealth` bigint(20) ,
 `pag_ibig` bigint(20) ,
 `nontax_income` bigint(20) ,
 `nd` bigint(20) ,
 `reg` bigint(20) ,
 `rest` bigint(20) ,
 `rest_x8` bigint(20) ,
 `sp` bigint(20) ,
 `sp_x8` bigint(20) ,
 `rest_sp` bigint(20) ,
 `rest_sp_x8` bigint(20) ,
 `legal` double(19,2) ,
 `legal_x8` bigint(20) ,
 `rest_legal` bigint(20) ,
 `rest_leg_x8` bigint(20) ,
 `nd_otnd` bigint(20) ,
 `reg_otnd` bigint(20) ,
 `rest_otnd` bigint(20) ,
 `rest_x8_otnd` bigint(20) ,
 `sp_otnd` bigint(20) ,
 `sp_x8_otnd` bigint(20) ,
 `rest_sp_otnd` bigint(20) ,
 `rest_sp_x8_otnd` bigint(20) ,
 `legal_otnd` bigint(20) ,
 `legal_x8_otnd` bigint(20) ,
 `rest_legal_otnd` bigint(20) ,
 `rest_leg_x8_otnd` bigint(20) ,
 `nd_hrs` bigint(20) ,
 `reg_hrs` bigint(20) ,
 `rest_hrs` bigint(20) ,
 `rest_x8_hrs` bigint(20) ,
 `sp_hrs` bigint(20) ,
 `sp_x8_hrs` bigint(20) ,
 `rest_sp_hrs` bigint(20) ,
 `rest_sp_x8_hrs` bigint(20) ,
 `legal_hrs` bigint(20) ,
 `legal_x8_hrs` bigint(20) ,
 `rest_legal_hrs` bigint(20) ,
 `rest_leg_x8_hrs` bigint(20) ,
 `health_card` bigint(20) ,
 `other_deduction_one` bigint(20) ,
 `other_deduction_two` bigint(20) ,
 `other_deduction_three` bigint(20) ,
 `sss_sal_loan_payments` bigint(20) ,
 `sss_cal_loan_payments` bigint(20) ,
 `hdmf_sal_loan_payments` bigint(20) ,
 `hdmf_cal_loan_payments` bigint(20) ,
 `company_loan_payments` bigint(20) ,
 `sss_sal_loan_balance` bigint(20) ,
 `sss_cal_loan_balance` bigint(20) ,
 `hdmf_sal_loan_balance` bigint(20) ,
 `hdmf_cal_loan_balance` bigint(20) ,
 `tax_status` bigint(20) ,
 `ytd_sss` bigint(20) ,
 `ytd_philhealth` bigint(20) ,
 `ytd_pag_ibig` bigint(20) ,
 `tin` varchar(16) ,
 `transaction_label` varchar(128) ,
 `transaction_class_code` varchar(32) ,
 `transaction_code` varchar(32) ,
 `qty` varbinary(291) ,
 `amount` double(19,2) ,
 `transaction_type_id` int(11) ,
 `group` varchar(10) ,
 `type` varchar(10) ,
 `record_id` varbinary(11) ,
 `beginning_balance` double(19,2) ,
 `running_balance` double(19,2) ,
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `taxcode` varchar(50) ,
 `phone_no` varchar(255) ,
 `fax_no` varchar(255) 
)*/;

/*Table structure for table `payroll_preliminary_cost_center` */

DROP TABLE IF EXISTS `payroll_preliminary_cost_center`;

/*!50001 DROP VIEW IF EXISTS `payroll_preliminary_cost_center` */;
/*!50001 DROP TABLE IF EXISTS `payroll_preliminary_cost_center` */;

/*!50001 CREATE TABLE  `payroll_preliminary_cost_center`(
 `company` varchar(64) ,
 `company_id` int(1) unsigned ,
 `department_id` int(11) ,
 `department` varchar(64) ,
 `payroll_date` date ,
 `payment_type_id` tinyint(1) ,
 `location_id` int(11) ,
 `sensitivity` tinyint(1) ,
 `date_from` date ,
 `date_to` date ,
 `basic` double ,
 `aut` double ,
 `ot` double ,
 `nd` double ,
 `holiday` double ,
 `other_earnings` double ,
 `sss` double ,
 `phic` double ,
 `hdmf` double ,
 `tax` double ,
 `loan` double ,
 `employee_ledger` double ,
 `other_deduction` double ,
 `net_amount` double 
)*/;

/*Table structure for table `payroll_preliminary_deduction` */

DROP TABLE IF EXISTS `payroll_preliminary_deduction`;

/*!50001 DROP VIEW IF EXISTS `payroll_preliminary_deduction` */;
/*!50001 DROP TABLE IF EXISTS `payroll_preliminary_deduction` */;

/*!50001 CREATE TABLE  `payroll_preliminary_deduction`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `payroll_rate_type_id` int(11) ,
 `payroll_rate_type` varchar(64) ,
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `transaction_id` int(1) unsigned ,
 `transaction_label` varchar(128) ,
 `amount` double 
)*/;

/*Table structure for table `payroll_preliminary_earnings` */

DROP TABLE IF EXISTS `payroll_preliminary_earnings`;

/*!50001 DROP VIEW IF EXISTS `payroll_preliminary_earnings` */;
/*!50001 DROP TABLE IF EXISTS `payroll_preliminary_earnings` */;

/*!50001 CREATE TABLE  `payroll_preliminary_earnings`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `transaction_label` varchar(128) ,
 `amount` double ,
 `transaction_type` varchar(32) 
)*/;

/*Table structure for table `payroll_preliminary_report` */

DROP TABLE IF EXISTS `payroll_preliminary_report`;

/*!50001 DROP VIEW IF EXISTS `payroll_preliminary_report` */;
/*!50001 DROP TABLE IF EXISTS `payroll_preliminary_report` */;

/*!50001 CREATE TABLE  `payroll_preliminary_report`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `sensitivity` tinyint(1) ,
 `basic` double ,
 `cola` double ,
 `nd` double ,
 `overtime` double ,
 `transpo` double ,
 `comm` double ,
 `oth_inc_taxable` double(19,2) ,
 `oth_inc_nontax` double ,
 `absences` double ,
 `gross_pay` double ,
 `whtax` double ,
 `sss` double ,
 `Ssser` double ,
 `phic` double ,
 `Phicer` double ,
 `hdmf` double ,
 `Hdmfer` double ,
 `hdmf_add` double ,
 `sss_loan` double ,
 `hdmf_loan` double ,
 `oth_ded` double ,
 `netpay` double 
)*/;

/*Table structure for table `payroll_register_closed_report` */

DROP TABLE IF EXISTS `payroll_register_closed_report`;

/*!50001 DROP VIEW IF EXISTS `payroll_register_closed_report` */;
/*!50001 DROP TABLE IF EXISTS `payroll_register_closed_report` */;

/*!50001 CREATE TABLE  `payroll_register_closed_report`(
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `company_id` int(11) ,
 `company` varchar(64) ,
 `department_id` int(11) ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `employee_code` varchar(16) ,
 `employee_name` varchar(64) ,
 `basic` double ,
 `aut` double ,
 `ot` double ,
 `nd` double ,
 `holiday` double ,
 `other_earnings` double ,
 `gross` double ,
 `sss` double ,
 `phic` double ,
 `hdmf` double ,
 `tax` double ,
 `loan` double ,
 `employee_ledger` double ,
 `other_deduction` double ,
 `deduction` double ,
 `net_amount` double 
)*/;

/*Table structure for table `payroll_register_cost_center` */

DROP TABLE IF EXISTS `payroll_register_cost_center`;

/*!50001 DROP VIEW IF EXISTS `payroll_register_cost_center` */;
/*!50001 DROP TABLE IF EXISTS `payroll_register_cost_center` */;

/*!50001 CREATE TABLE  `payroll_register_cost_center`(
 `company` varchar(64) ,
 `company_id` int(1) unsigned ,
 `department_id` int(11) ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `payroll_date` date ,
 `payment_type_id` tinyint(1) ,
 `location_id` int(11) ,
 `sensitivity` tinyint(1) ,
 `date_from` date ,
 `date_to` date ,
 `basic` double ,
 `aut` double ,
 `ot` double ,
 `nd` double ,
 `holiday` double ,
 `other_earnings` double ,
 `gross` double ,
 `sss` double ,
 `phic` double ,
 `hdmf` double ,
 `tax` double ,
 `loan` double ,
 `employee_ledger` double ,
 `other_deduction` double ,
 `deduction` double ,
 `net_amount` double 
)*/;

/*Table structure for table `payroll_register_current_report` */

DROP TABLE IF EXISTS `payroll_register_current_report`;

/*!50001 DROP VIEW IF EXISTS `payroll_register_current_report` */;
/*!50001 DROP TABLE IF EXISTS `payroll_register_current_report` */;

/*!50001 CREATE TABLE  `payroll_register_current_report`(
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `company_id` int(11) ,
 `company` varchar(64) ,
 `department_id` int(11) ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `employee_code` varchar(16) ,
 `employee_name` varchar(64) ,
 `basic` double ,
 `aut` double ,
 `ot` double ,
 `nd` double ,
 `holiday` double ,
 `other_earnings` double ,
 `gross` double ,
 `sss` double ,
 `phic` double ,
 `hdmf` double ,
 `tax` double ,
 `loan` double ,
 `employee_ledger` double ,
 `other_deduction` double ,
 `deduction` double ,
 `net_amount` double 
)*/;

/*Table structure for table `payroll_register_deduction` */

DROP TABLE IF EXISTS `payroll_register_deduction`;

/*!50001 DROP VIEW IF EXISTS `payroll_register_deduction` */;
/*!50001 DROP TABLE IF EXISTS `payroll_register_deduction` */;

/*!50001 CREATE TABLE  `payroll_register_deduction`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `transaction_label` varchar(128) ,
 `amount` double 
)*/;

/*Table structure for table `payroll_register_earnings` */

DROP TABLE IF EXISTS `payroll_register_earnings`;

/*!50001 DROP VIEW IF EXISTS `payroll_register_earnings` */;
/*!50001 DROP TABLE IF EXISTS `payroll_register_earnings` */;

/*!50001 CREATE TABLE  `payroll_register_earnings`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `department` varchar(64) ,
 `department_id` int(11) unsigned ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `payroll_date` date ,
 `transaction_label` varchar(128) ,
 `date_from` date ,
 `date_to` date ,
 `amount` double ,
 `transaction_type` varchar(32) 
)*/;

/*Table structure for table `payroll_register_per_department` */

DROP TABLE IF EXISTS `payroll_register_per_department`;

/*!50001 DROP VIEW IF EXISTS `payroll_register_per_department` */;
/*!50001 DROP TABLE IF EXISTS `payroll_register_per_department` */;

/*!50001 CREATE TABLE  `payroll_register_per_department`(
 `company` varchar(64) ,
 `company_id` int(11) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `total_dept` int(11) ,
 `basic` double ,
 `cola` double ,
 `nd` double ,
 `overtime` double ,
 `transpo` double ,
 `comm` double ,
 `oth_inc_taxable` double(19,2) ,
 `oth_inc_nontax` double ,
 `absences` double ,
 `gross_pay` double ,
 `whtax` double ,
 `sss` double ,
 `Ssser` double ,
 `phic` double ,
 `Phicer` double ,
 `hdmf` double ,
 `Hdmfer` double ,
 `hdmf_add` double ,
 `sss_loan` double ,
 `hdmf_loan` double ,
 `oth_ded` double ,
 `netpay` double 
)*/;

/*Table structure for table `payroll_register_position` */

DROP TABLE IF EXISTS `payroll_register_position`;

/*!50001 DROP VIEW IF EXISTS `payroll_register_position` */;
/*!50001 DROP TABLE IF EXISTS `payroll_register_position` */;

/*!50001 CREATE TABLE  `payroll_register_position`(
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `company_id` int(11) ,
 `company` varchar(64) ,
 `project_id` int(11) unsigned ,
 `project` varchar(64) ,
 `department_id` int(11) ,
 `department` varchar(64) ,
 `employee_code` varchar(16) ,
 `position` varchar(64) ,
 `payroll_rate_type_id` int(11) ,
 `payroll_rate_type` varchar(64) ,
 `basic` double ,
 `aut` double ,
 `ot` double ,
 `nd` double ,
 `holiday` double ,
 `other_earnings` double ,
 `gross` double ,
 `sss` double ,
 `phic` double ,
 `hdmf` double ,
 `tax` double ,
 `loan` double ,
 `employee_ledger` double ,
 `other_deduction` double ,
 `deduction` double ,
 `net_amount` double 
)*/;

/*Table structure for table `payroll_register_position_closed_report` */

DROP TABLE IF EXISTS `payroll_register_position_closed_report`;

/*!50001 DROP VIEW IF EXISTS `payroll_register_position_closed_report` */;
/*!50001 DROP TABLE IF EXISTS `payroll_register_position_closed_report` */;

/*!50001 CREATE TABLE  `payroll_register_position_closed_report`(
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `company_id` int(11) ,
 `company` varchar(64) ,
 `project_id` int(11) unsigned ,
 `project_code` varchar(16) ,
 `project` varchar(64) ,
 `position` varchar(64) ,
 `payroll_rate_type_id` int(11) ,
 `payroll_rate_type` varchar(64) ,
 `ot_percent` int(1) ,
 `other_tax` int(1) ,
 `adjustment` int(1) ,
 `basic` double ,
 `misc` double ,
 `ot` double ,
 `nd` double ,
 `holiday` double ,
 `other_earnings` double ,
 `gross` double ,
 `sss_ee` double ,
 `sss_er` double(19,2) ,
 `sss_ec` double(19,2) ,
 `phic_ee` double ,
 `phic_er` double ,
 `hdmf_ee` double ,
 `hdmf_er` double ,
 `tax` double ,
 `loan` double ,
 `other_nontax` double(19,2) ,
 `employee_ledger` double ,
 `other_deduction` double ,
 `deduction` double ,
 `net_amount` double 
)*/;

/*Table structure for table `payroll_register_position_current_report` */

DROP TABLE IF EXISTS `payroll_register_position_current_report`;

/*!50001 DROP VIEW IF EXISTS `payroll_register_position_current_report` */;
/*!50001 DROP TABLE IF EXISTS `payroll_register_position_current_report` */;

/*!50001 CREATE TABLE  `payroll_register_position_current_report`(
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `company_id` int(11) ,
 `company` varchar(64) ,
 `project_id` int(11) unsigned ,
 `project_code` varchar(16) ,
 `project` varchar(64) ,
 `position` varchar(64) ,
 `payroll_rate_type_id` int(11) ,
 `payroll_rate_type` varchar(64) ,
 `ot_percent` int(1) ,
 `other_tax` int(1) ,
 `adjustment` int(1) ,
 `basic` double ,
 `misc` double ,
 `ot` double ,
 `nd` double ,
 `holiday` double ,
 `other_earnings` double ,
 `gross` double ,
 `sss_ee` double ,
 `sss_er` double(19,2) ,
 `sss_ec` double(19,2) ,
 `phic_ee` double ,
 `phic_er` double ,
 `hdmf_ee` double ,
 `hdmf_er` double ,
 `tax` double ,
 `loan` double ,
 `other_nontax` double(19,2) ,
 `employee_ledger` double ,
 `other_deduction` double ,
 `deduction` double ,
 `net_amount` double 
)*/;

/*Table structure for table `payroll_register_report` */

DROP TABLE IF EXISTS `payroll_register_report`;

/*!50001 DROP VIEW IF EXISTS `payroll_register_report` */;
/*!50001 DROP TABLE IF EXISTS `payroll_register_report` */;

/*!50001 CREATE TABLE  `payroll_register_report`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `full_name` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `basic` double ,
 `cola` double ,
 `nd` double ,
 `overtime` double ,
 `transpo` double ,
 `comm` double ,
 `oth_inc_taxable` double(19,2) ,
 `oth_inc_nontax` double ,
 `absences` double ,
 `gross_pay` double ,
 `whtax` double ,
 `sss` double ,
 `Ssser` double ,
 `phic` double ,
 `Phicer` double ,
 `hdmf` double ,
 `Hdmfer` double ,
 `hdmf_add` double ,
 `sss_loan` double ,
 `hdmf_loan` double ,
 `oth_ded` double ,
 `netpay` double 
)*/;

/*Table structure for table `payroll_salary_distribution` */

DROP TABLE IF EXISTS `payroll_salary_distribution`;

/*!50001 DROP VIEW IF EXISTS `payroll_salary_distribution` */;
/*!50001 DROP TABLE IF EXISTS `payroll_salary_distribution` */;

/*!50001 CREATE TABLE  `payroll_salary_distribution`(
 `employee` int(11) unsigned ,
 `id_number` varchar(16) ,
 `full_name` varchar(64) ,
 `position` varchar(64) ,
 `classification_id` int(11) ,
 `classification` varchar(32) ,
 `company` varchar(64) ,
 `company_id` int(11) unsigned ,
 `project_code` varchar(16) ,
 `project` varchar(64) ,
 `project_id` int(11) unsigned ,
 `payroll_rate_type_id` int(11) ,
 `payroll_rate_type` varchar(64) ,
 `payroll_date` date ,
 `cost_center` text ,
 `total_basic` double(19,2) ,
 `overtime` double(19,2) ,
 `other_nontax` double(19,2) ,
 `sss_er` double(19,2) ,
 `sss_ec` double(19,2) ,
 `hdmf_er` double(19,2) ,
 `phic_er` double(19,2) 
)*/;

/*Table structure for table `payroll_salary_per_department` */

DROP TABLE IF EXISTS `payroll_salary_per_department`;

/*!50001 DROP VIEW IF EXISTS `payroll_salary_per_department` */;
/*!50001 DROP TABLE IF EXISTS `payroll_salary_per_department` */;

/*!50001 CREATE TABLE  `payroll_salary_per_department`(
 `Department` varchar(64) ,
 `Payroll` date ,
 `Reg. Sal` double(19,2) ,
 `Overtime` double(19,2) ,
 `Salary Adjustment` double(19,2) ,
 `Absences` double(19,2) ,
 `UT/Tardiness` double(19,2) ,
 `Incentives` double(19,2) ,
 `SIL` double(19,2) ,
 `Leave Conversion` double(19,2) ,
 `BIP/PBB` double(19,2) ,
 `COLA` double(19,2) ,
 `Transportation Allowance` double(19,2) ,
 `Tax Adj` double(19,2) ,
 `Loan Refund` double(19,2) ,
 `SSS` double(19,2) ,
 `Pag-Ibig` double(19,2) ,
 `PhilHealth` double(19,2) 
)*/;

/*Table structure for table `payroll_sss_loan` */

DROP TABLE IF EXISTS `payroll_sss_loan`;

/*!50001 DROP VIEW IF EXISTS `payroll_sss_loan` */;
/*!50001 DROP TABLE IF EXISTS `payroll_sss_loan` */;

/*!50001 CREATE TABLE  `payroll_sss_loan`(
 `company_id` int(1) unsigned ,
 `company` varchar(64) ,
 `sss` varchar(32) ,
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `sss_no` varchar(16) ,
 `year` int(4) ,
 `month_id` int(2) ,
 `month` varchar(16) ,
 `partner_loan_id` int(11) ,
 `employee_name` varchar(195) ,
 `lastname` varchar(64) ,
 `firstname` varchar(64) ,
 `middlename` varchar(64) ,
 `suffix` varchar(16) ,
 `loan_code` varchar(3) ,
 `release_date` date ,
 `loan_type_id` int(11) unsigned ,
 `loan_principal` double(19,2) ,
 `current` double(19,2) ,
 `overdue` decimal(3,2) ,
 `due` double(19,2) ,
 `remarks` char(0) ,
 `resigned_date` varbinary(10) 
)*/;

/*Table structure for table `payroll_sss_loan_to_disk_report` */

DROP TABLE IF EXISTS `payroll_sss_loan_to_disk_report`;

/*!50001 DROP VIEW IF EXISTS `payroll_sss_loan_to_disk_report` */;
/*!50001 DROP TABLE IF EXISTS `payroll_sss_loan_to_disk_report` */;

/*!50001 CREATE TABLE  `payroll_sss_loan_to_disk_report`(
 `company_id` int(1) unsigned ,
 `company` varchar(64) ,
 `sss_branch_code` varchar(32) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `sss` varchar(32) ,
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `sss_no` varchar(16) ,
 `year` int(4) ,
 `month_id` int(2) ,
 `month` varchar(16) ,
 `partner_loan_id` int(11) ,
 `employee_name` varchar(195) ,
 `lastname` varchar(64) ,
 `firstname` varchar(64) ,
 `middlename` varchar(64) ,
 `suffix` varchar(16) ,
 `loan_code` varchar(3) ,
 `release_date` date ,
 `loan_type_id` int(11) unsigned ,
 `loan_principal` double(19,2) ,
 `current` double(19,2) ,
 `overdue` decimal(3,2) ,
 `due` double(19,2) ,
 `remarks` char(0) ,
 `resigned_date` varbinary(10) ,
 `record` varchar(73) ,
 `document_date` datetime 
)*/;

/*Table structure for table `payroll_sss_to_disk_report` */

DROP TABLE IF EXISTS `payroll_sss_to_disk_report`;

/*!50001 DROP VIEW IF EXISTS `payroll_sss_to_disk_report` */;
/*!50001 DROP TABLE IF EXISTS `payroll_sss_to_disk_report` */;

/*!50001 CREATE TABLE  `payroll_sss_to_disk_report`(
 `lastname` varchar(64) ,
 `firstname` varchar(64) ,
 `middlename` varchar(64) ,
 `year` int(4) ,
 `month` int(2) ,
 `contribution` double ,
 `ec` double ,
 `user_id` int(11) unsigned ,
 `department_id` int(11) unsigned ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `company_id` int(11) ,
 `company` varchar(64) ,
 `company_code` varchar(16) ,
 `co_sss` varchar(32) ,
 `doc_date` date ,
 `doc_no` varchar(16) ,
 `record` varchar(109) ,
 `document_date` datetime 
)*/;

/*Table structure for table `payroll_sssr5_report` */

DROP TABLE IF EXISTS `payroll_sssr5_report`;

/*!50001 DROP VIEW IF EXISTS `payroll_sssr5_report` */;
/*!50001 DROP TABLE IF EXISTS `payroll_sssr5_report` */;

/*!50001 CREATE TABLE  `payroll_sssr5_report`(
 `company` varchar(64) ,
 `company_id` int(11) ,
 `tin` varchar(32) ,
 `co_sss` varchar(32) ,
 `co_phic` varchar(32) ,
 `co_hdmf` varchar(32) ,
 `co_address` varchar(128) ,
 `zipcode` varchar(16) ,
 `contact_no` varchar(255) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `year` int(4) ,
 `month` int(2) ,
 `birth_date` date ,
 `sss_no` varchar(16) ,
 `phic_no` varchar(16) ,
 `hdmf_no` varchar(16) ,
 `sss_emp` double(19,2) ,
 `sss_com` double(19,2) ,
 `sss_ecc` double(19,2) 
)*/;

/*Table structure for table `payroll_summary` */

DROP TABLE IF EXISTS `payroll_summary`;

/*!50001 DROP VIEW IF EXISTS `payroll_summary` */;
/*!50001 DROP TABLE IF EXISTS `payroll_summary` */;

/*!50001 CREATE TABLE  `payroll_summary`(
 `employee_id` int(11) ,
 `full_name` varchar(64) ,
 `company_id` int(11) ,
 `company` varchar(64) ,
 `exempt` double(15,2) ,
 `no_dependent` varchar(1) ,
 `year` int(4) ,
 `tot_basic` double(19,2) ,
 `overtime` double(19,2) ,
 `benefits` double(19,2) ,
 `allowance` double(19,2) ,
 `leave_nt` double(19,2) ,
 `leave_tax` double(19,2) ,
 `bonus_nt` double(19,2) ,
 `bonus_tax` double(19,2) ,
 `contribution` double(19,2) ,
 `wtax` double(19,2) ,
 `sss` double(19,2) ,
 `philhealth` double(19,2) ,
 `pagibig` double(19,2) 
)*/;

/*Table structure for table `payroll_tax` */

DROP TABLE IF EXISTS `payroll_tax`;

/*!50001 DROP VIEW IF EXISTS `payroll_tax` */;
/*!50001 DROP TABLE IF EXISTS `payroll_tax` */;

/*!50001 CREATE TABLE  `payroll_tax`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `full_name` varchar(64) ,
 `tin` varchar(16) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `year` int(4) ,
 `month` int(2) ,
 `sensitivity` tinyint(1) ,
 `gross_pay1` double ,
 `whtax1` double ,
 `gross_pay2` double ,
 `whtax2` double 
)*/;

/*Table structure for table `payroll_tax_contribution` */

DROP TABLE IF EXISTS `payroll_tax_contribution`;

/*!50001 DROP VIEW IF EXISTS `payroll_tax_contribution` */;
/*!50001 DROP TABLE IF EXISTS `payroll_tax_contribution` */;

/*!50001 CREATE TABLE  `payroll_tax_contribution`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `full_name` varchar(64) ,
 `tin` varchar(16) ,
 `company` varchar(64) ,
 `company_id` int(11) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `payroll_date` date ,
 `date_from` date ,
 `date_to` date ,
 `sensitivity` tinyint(1) ,
 `period` int(0) ,
 `gross_pay` double ,
 `whtax` double 
)*/;

/*Table structure for table `play_partner` */

DROP TABLE IF EXISTS `play_partner`;

/*!50001 DROP VIEW IF EXISTS `play_partner` */;
/*!50001 DROP TABLE IF EXISTS `play_partner` */;

/*!50001 CREATE TABLE  `play_partner`(
 `user_id` int(11) unsigned ,
 `alias` varchar(64) ,
 `league_id` int(11) ,
 `league` varchar(64) ,
 `level_no` int(11) ,
 `points` int(11) ,
 `end_point` int(1) ,
 `jars` int(11) ,
 `total_points` int(11) ,
 `used_points` int(11) ,
 `redeemed` int(11) 
)*/;

/*Table structure for table `play_partner_badge` */

DROP TABLE IF EXISTS `play_partner_badge`;

/*!50001 DROP VIEW IF EXISTS `play_partner_badge` */;
/*!50001 DROP TABLE IF EXISTS `play_partner_badge` */;

/*!50001 CREATE TABLE  `play_partner_badge`(
 `user_id` int(11) unsigned ,
 `alias` varchar(64) ,
 `badge_id` int(11) unsigned ,
 `badge` varchar(32) ,
 `badge_points` bigint(11) ,
 `points` int(3) ,
 `image_path` varchar(128) ,
 `description` text 
)*/;

/*Table structure for table `recruitment_request` */

DROP TABLE IF EXISTS `recruitment_request`;

/*!50001 DROP VIEW IF EXISTS `recruitment_request` */;
/*!50001 DROP TABLE IF EXISTS `recruitment_request` */;

/*!50001 CREATE TABLE  `recruitment_request`(
 `document_no` varchar(16) ,
 `position` varchar(64) ,
 `company_id` int(1) unsigned ,
 `company` varchar(64) ,
 `department` varchar(64) ,
 `requested_by` varchar(64) ,
 `recruitment_request_date` varchar(73) ,
 `recruitment_request_date_approved` varchar(50) ,
 `recruit_status` varchar(16) 
)*/;

/*Table structure for table `report_late_monitoring` */

DROP TABLE IF EXISTS `report_late_monitoring`;

/*!50001 DROP VIEW IF EXISTS `report_late_monitoring` */;
/*!50001 DROP TABLE IF EXISTS `report_late_monitoring` */;

/*!50001 CREATE TABLE  `report_late_monitoring`(
 `payroll_date` date ,
 `company_id` int(1) ,
 `company` varchar(64) ,
 `project_id` int(11) ,
 `project_code` varchar(16) ,
 `project` varchar(64) ,
 `full_name` varchar(64) ,
 `id_number` varchar(16) ,
 `date` date ,
 `late` decimal(5,2) ,
 `payroll_rate_type_id` int(1) ,
 `payroll_rate_type` varchar(64) ,
 `project_title` varchar(83) 
)*/;

/*Table structure for table `report_leave_summary` */

DROP TABLE IF EXISTS `report_leave_summary`;

/*!50001 DROP VIEW IF EXISTS `report_leave_summary` */;
/*!50001 DROP TABLE IF EXISTS `report_leave_summary` */;

/*!50001 CREATE TABLE  `report_leave_summary`(
 `form_status` varchar(16) ,
 `form_code` varchar(8) ,
 `user_id` int(11) ,
 `full_name` varchar(64) ,
 `day` decimal(5,2) ,
 `date_from` date ,
 `date_to` date ,
 `reason` text ,
 `id_number` varchar(16) ,
 `company_id` int(1) ,
 `company` varchar(64) 
)*/;

/*Table structure for table `report_monthly_overtime` */

DROP TABLE IF EXISTS `report_monthly_overtime`;

/*!50001 DROP VIEW IF EXISTS `report_monthly_overtime` */;
/*!50001 DROP TABLE IF EXISTS `report_monthly_overtime` */;

/*!50001 CREATE TABLE  `report_monthly_overtime`(
 `employee_number` varchar(16) ,
 `name` varchar(129) ,
 `year` int(4) ,
 `month_id` int(2) ,
 `company_id` int(1) ,
 `company` varchar(64) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `Jan` decimal(27,2) ,
 `Feb` decimal(27,2) ,
 `Mar` decimal(27,2) ,
 `Apr` decimal(27,2) ,
 `May` decimal(27,2) ,
 `Jun` decimal(27,2) ,
 `Jul` decimal(27,2) ,
 `Aug` decimal(27,2) ,
 `Sep` decimal(27,2) ,
 `Oct` decimal(27,2) ,
 `Nov` decimal(27,2) ,
 `Dec` decimal(27,2) ,
 `number_of_ot_months` char(0) ,
 `total_ot_hours` decimal(27,2) ,
 `average_per_ee` char(0) 
)*/;

/*Table structure for table `report_partners_manpower` */

DROP TABLE IF EXISTS `report_partners_manpower`;

/*!50001 DROP VIEW IF EXISTS `report_partners_manpower` */;
/*!50001 DROP TABLE IF EXISTS `report_partners_manpower` */;

/*!50001 CREATE TABLE  `report_partners_manpower`(
 `title` varchar(16) ,
 `lastname` varchar(64) ,
 `firstname` varchar(64) ,
 `middlename` varchar(64) ,
 `suffix` varchar(16) ,
 `maidenname` varchar(64) ,
 `nickname` varchar(32) ,
 `specialization_id` int(11) ,
 `specialization` varchar(64) ,
 `company_id` int(1) ,
 `company` varchar(64) ,
 `location_id` int(1) ,
 `location` varchar(64) ,
 `position_id` int(1) ,
 `position` varbinary(64) ,
 `role_id` int(1) ,
 `role` varchar(64) ,
 `id_number` varchar(16) ,
 `biometric` varchar(16) ,
 `calendar_id` int(11) ,
 `calendar` varchar(32) ,
 `status_id` int(1) ,
 `status` varchar(32) ,
 `employment_type_id` int(1) ,
 `employment_type` varchar(16) ,
 `job_grade_id` int(11) ,
 `job_grade` varchar(64) ,
 `classification_id` int(1) ,
 `classification` varchar(32) ,
 `date_hired` date ,
 `employment_end_date` date ,
 `original_hired_date` date ,
 `reports_to_id` int(11) ,
 `reports_to` varchar(64) ,
 `project_hr_id` int(11) ,
 `project_hr` varchar(64) ,
 `organization` longtext ,
 `division_id` int(1) ,
 `division` varchar(64) ,
 `department_id` int(1) ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `section_id` int(11) ,
 `section` varchar(64) ,
 `project_id` int(11) ,
 `project` varchar(64) ,
 `start_date` date ,
 `end_date` date ,
 `credit_setup` varchar(66) ,
 `phone_1` longtext ,
 `phone_2` longtext ,
 `phone_3` longtext ,
 `mobile_1` longtext ,
 `mobile_2` longtext ,
 `mobile_3` longtext ,
 `email` varchar(128) ,
 `address` longtext ,
 `city_town` longtext ,
 `country` longtext ,
 `zip_code` longtext ,
 `emergency_name` longtext ,
 `emergency_relationship` longtext ,
 `emergency_phone` longtext ,
 `emergency_mobile` longtext ,
 `emergency_address` longtext ,
 `emergency_city` longtext ,
 `emergency_country` longtext ,
 `emergency_zip_code` longtext ,
 `taxcode` varchar(50) ,
 `sss_number` longtext ,
 `pagibig_number` longtext ,
 `philhealth_number` longtext ,
 `tin_number` longtext ,
 `bank_account_number_savings` longtext ,
 `bank_account_number_current` longtext ,
 `bank_account_name` longtext ,
 `gender` longtext ,
 `birth_date` date ,
 `birth_place` longtext ,
 `religion` longtext ,
 `nationality` longtext ,
 `civil_status` longtext ,
 `solo_parent` varchar(3) ,
 `active` int(1) 
)*/;

/*Table structure for table `report_recruitment_funnel` */

DROP TABLE IF EXISTS `report_recruitment_funnel`;

/*!50001 DROP VIEW IF EXISTS `report_recruitment_funnel` */;
/*!50001 DROP TABLE IF EXISTS `report_recruitment_funnel` */;

/*!50001 CREATE TABLE  `report_recruitment_funnel`(
 `poc` varchar(64) ,
 `status` varchar(64) ,
 `no_of_headcount_required` int(11) ,
 `prf` varchar(16) ,
 `date_opened` date ,
 `date_closed` datetime ,
 `headcount_type` varchar(32) ,
 `position_title` varchar(64) ,
 `hiring_manage` varchar(64) ,
 `department` varchar(64) ,
 `cat_employee_type` varchar(32) ,
 `sourcing_tool` int(1) ,
 `candidates_name` varchar(65) 
)*/;

/*Table structure for table `report_resume_bidding` */

DROP TABLE IF EXISTS `report_resume_bidding`;

/*!50001 DROP VIEW IF EXISTS `report_resume_bidding` */;
/*!50001 DROP TABLE IF EXISTS `report_resume_bidding` */;

/*!50001 CREATE TABLE  `report_resume_bidding`(
 `user_id` int(11) unsigned ,
 `employee_name` int(11) unsigned ,
 `lastname` varchar(64) ,
 `firstname` varchar(64) ,
 `middlename` varchar(64) ,
 `suffix` varchar(16) ,
 `project` varchar(64) ,
 `project_name` int(11) unsigned ,
 `project_id` int(11) unsigned ,
 `position_display` varchar(64) ,
 `postion_id` int(11) unsigned ,
 `position` int(11) unsigned ,
 `department` varchar(64) ,
 `company` varchar(64) ,
 `company_id` int(1) unsigned ,
 `birth_date` date ,
 `birth_place` text ,
 `civil_status` text ,
 `resigned_date` date ,
 `location` varchar(64) ,
 `effectivity_date` date 
)*/;

/*Table structure for table `report_time_compliance` */

DROP TABLE IF EXISTS `report_time_compliance`;

/*!50001 DROP VIEW IF EXISTS `report_time_compliance` */;
/*!50001 DROP TABLE IF EXISTS `report_time_compliance` */;

/*!50001 CREATE TABLE  `report_time_compliance`(
 `payroll_date` date ,
 `company_id` int(1) ,
 `company` varchar(64) ,
 `full_name` varchar(64) ,
 `id_number` varchar(16) ,
 `date` date ,
 `shift` varchar(32) ,
 `time_from` datetime ,
 `time_to` datetime ,
 `aux_time_from` datetime ,
 `aux_time_to` datetime ,
 `particulars` varchar(13) 
)*/;

/*Table structure for table `report_time_daily_time_record` */

DROP TABLE IF EXISTS `report_time_daily_time_record`;

/*!50001 DROP VIEW IF EXISTS `report_time_daily_time_record` */;
/*!50001 DROP TABLE IF EXISTS `report_time_daily_time_record` */;

/*!50001 CREATE TABLE  `report_time_daily_time_record`(
 `user_id` int(11) unsigned ,
 `id_number` varchar(16) ,
 `firstname` varchar(64) ,
 `lastname` varchar(64) ,
 `company_id` int(1) ,
 `company` varchar(64) ,
 `department_id` int(1) ,
 `department` varchar(64) ,
 `date` date ,
 `shift` varchar(32) ,
 `time_in` datetime ,
 `time_out` datetime ,
 `hours_work` decimal(5,2) ,
 `late` decimal(5,2) ,
 `ut` decimal(5,2) ,
 `ot` decimal(5,2) ,
 `remarks` char(0) 
)*/;

/*Table structure for table `report_time_iar` */

DROP TABLE IF EXISTS `report_time_iar`;

/*!50001 DROP VIEW IF EXISTS `report_time_iar` */;
/*!50001 DROP TABLE IF EXISTS `report_time_iar` */;

/*!50001 CREATE TABLE  `report_time_iar`(
 `payroll_date` date ,
 `company_id` int(1) ,
 `company` varchar(64) ,
 `user_id` int(11) unsigned ,
 `full_name` varchar(64) ,
 `id_number` varchar(16) ,
 `date` date ,
 `shift` varchar(32) ,
 `time_from` datetime ,
 `time_to` datetime ,
 `aux_time_from` datetime ,
 `aux_time_to` datetime ,
 `particulars` varchar(35) ,
 `Deduction` varbinary(17) 
)*/;

/*Table structure for table `report_time_overtime` */

DROP TABLE IF EXISTS `report_time_overtime`;

/*!50001 DROP VIEW IF EXISTS `report_time_overtime` */;
/*!50001 DROP TABLE IF EXISTS `report_time_overtime` */;

/*!50001 CREATE TABLE  `report_time_overtime`(
 `company_id` int(1) ,
 `payroll_date` date ,
 `time_period_date_from` date ,
 `time_period_date_to` date ,
 `company` varchar(64) ,
 `id_number` varchar(16) ,
 `full_name` varchar(64) ,
 `HOURS` decimal(12,2) ,
 `ABSENCES` decimal(34,2) ,
 `REGOT` decimal(34,2) ,
 `REGOT_ND` decimal(34,2) ,
 `REGND` decimal(34,2) ,
 `RDOT` decimal(34,2) ,
 `RDOT_ND` decimal(34,2) ,
 `RDOT_EXCESS` decimal(34,2) ,
 `RDOT_ND_EXCESS` decimal(34,2) ,
 `LEGOT` decimal(34,2) ,
 `LEGOT_ND` decimal(34,2) ,
 `LEGOT_EXCESS` decimal(34,2) ,
 `LEGOT_ND_EXCESS` decimal(34,2) ,
 `SPEOT` decimal(34,2) ,
 `SPEOT_ND` decimal(34,2) ,
 `SPEOT_EXCESS` decimal(34,2) ,
 `SPEOT_ND_EXCESS` decimal(34,2) ,
 `DOBOT` decimal(34,2) ,
 `DOBOT_ND` decimal(34,2) ,
 `DOBOT_EXCESS` decimal(34,2) ,
 `DOBOT_ND_EXCESS` decimal(34,2) ,
 `LEGRDOT` decimal(34,2) ,
 `LEGRDOT_ND` decimal(34,2) ,
 `LEGRDOT_EXCESS` decimal(34,2) ,
 `LEGRDOT_ND_EXCESS` decimal(34,2) ,
 `SPERDOT` decimal(34,2) ,
 `SPERDOT_ND` decimal(34,2) ,
 `SPERDOT_EXCESS` decimal(34,2) ,
 `SPERDOT_ND_EXCESS` decimal(34,2) ,
 `DOBRDOT` decimal(34,2) ,
 `DOBRDOT_ND` decimal(34,2) ,
 `DOBRDOT_EXCESS` decimal(34,2) ,
 `DOBRDOT_ND_EXCESS` decimal(34,2) 
)*/;

/*Table structure for table `report_time_perfect_attendance` */

DROP TABLE IF EXISTS `report_time_perfect_attendance`;

/*!50001 DROP VIEW IF EXISTS `report_time_perfect_attendance` */;
/*!50001 DROP TABLE IF EXISTS `report_time_perfect_attendance` */;

/*!50001 CREATE TABLE  `report_time_perfect_attendance`(
 `id_number` varchar(16) ,
 `lastname` varchar(64) ,
 `firstname` varchar(64) ,
 `year` int(4) ,
 `month_id` int(2) ,
 `month` varchar(16) ,
 `company_id` int(1) ,
 `company` varchar(64) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `sum_lwp_forms` tinyint(1) 
)*/;

/*Table structure for table `report_time_tardiness` */

DROP TABLE IF EXISTS `report_time_tardiness`;

/*!50001 DROP VIEW IF EXISTS `report_time_tardiness` */;
/*!50001 DROP TABLE IF EXISTS `report_time_tardiness` */;

/*!50001 CREATE TABLE  `report_time_tardiness`(
 `payroll_date` date ,
 `company_id` int(1) ,
 `company` varchar(64) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `branch_id` int(11) ,
 `branch` varchar(64) ,
 `full_name` varchar(64) ,
 `id_number` varchar(16) ,
 `date` date ,
 `shift` varchar(32) ,
 `time_from` datetime ,
 `time_to` datetime ,
 `aux_shift` varchar(32) ,
 `aux_time_from` datetime ,
 `aux_time_to` datetime ,
 `late` decimal(6,0) ,
 `undertime` decimal(5,2) ,
 `year` int(4) ,
 `month` int(2) 
)*/;

/*Table structure for table `tfb_accrual_final` */

DROP TABLE IF EXISTS `tfb_accrual_final`;

/*!50001 DROP VIEW IF EXISTS `tfb_accrual_final` */;
/*!50001 DROP TABLE IF EXISTS `tfb_accrual_final` */;

/*!50001 CREATE TABLE  `tfb_accrual_final`(
 `user_id` int(11) unsigned ,
 `full_name` varchar(64) ,
 `leave_balance_id` int(11) unsigned ,
 `date` date ,
 `accrual` varbinary(20) ,
 `usage` decimal(18,2) ,
 `form_code` varchar(10) ,
 `form_id` int(11) unsigned ,
 `form` varchar(32) ,
 `company_id` int(11) ,
 `department_id` int(11) 
)*/;

/*Table structure for table `time_form_balance` */

DROP TABLE IF EXISTS `time_form_balance`;

/*!50001 DROP VIEW IF EXISTS `time_form_balance` */;
/*!50001 DROP TABLE IF EXISTS `time_form_balance` */;

/*!50001 CREATE TABLE  `time_form_balance`(
 `id` int(11) unsigned ,
 `year` int(1) ,
 `user_id` int(11) ,
 `form_id` int(1) ,
 `form_code` varchar(8) ,
 `previous` decimal(7,4) ,
 `current` decimal(7,4) ,
 `used` decimal(7,4) ,
 `used_insert` decimal(7,4) ,
 `balance` decimal(7,4) ,
 `paid_unit` decimal(7,4) ,
 `period_from` date ,
 `period_to` date ,
 `period_extension` date ,
 `created_on` timestamp ,
 `created_by` int(11) ,
 `modified_on` datetime ,
 `modified_by` int(11) ,
 `deleted` tinyint(1) ,
 `employee_number` varchar(16) ,
 `partner` varchar(32) ,
 `company_id` int(1) unsigned ,
 `company` varchar(64) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `form` varchar(32) 
)*/;

/*Table structure for table `time_form_code` */

DROP TABLE IF EXISTS `time_form_code`;

/*!50001 DROP VIEW IF EXISTS `time_form_code` */;
/*!50001 DROP TABLE IF EXISTS `time_form_code` */;

/*!50001 CREATE TABLE  `time_form_code`(
 `date` date ,
 `form_code` varchar(8) ,
 `user_id` int(11) 
)*/;

/*Table structure for table `time_form_code_with_blanket` */

DROP TABLE IF EXISTS `time_form_code_with_blanket`;

/*!50001 DROP VIEW IF EXISTS `time_form_code_with_blanket` */;
/*!50001 DROP TABLE IF EXISTS `time_form_code_with_blanket` */;

/*!50001 CREATE TABLE  `time_form_code_with_blanket`(
 `date` date ,
 `form_code` varchar(8) ,
 `user_id` int(11) 
)*/;

/*Table structure for table `time_forms` */

DROP TABLE IF EXISTS `time_forms`;

/*!50001 DROP VIEW IF EXISTS `time_forms` */;
/*!50001 DROP TABLE IF EXISTS `time_forms` */;

/*!50001 CREATE TABLE  `time_forms`(
 `forms_id` int(11) unsigned ,
 `form_status_id` tinyint(1) ,
 `form_id` int(1) ,
 `form_code` varchar(8) ,
 `user_id` int(11) ,
 `display_name` varchar(64) ,
 `day` decimal(5,2) ,
 `hrs` decimal(5,2) ,
 `date_from` date ,
 `date_to` date ,
 `date_approved` datetime ,
 `date_declined` datetime ,
 `date_cancelled` datetime ,
 `date_sent` datetime ,
 `reason` text ,
 `scheduled` enum('YES','NO') ,
 `type` enum('File','Use') ,
 `created_on` timestamp ,
 `created_by` int(11) ,
 `modified_on` datetime ,
 `modified_by` int(11) ,
 `deleted` tinyint(1) ,
 `company_id` int(1) ,
 `focus_date` date 
)*/;

/*Table structure for table `time_forms_admin` */

DROP TABLE IF EXISTS `time_forms_admin`;

/*!50001 DROP VIEW IF EXISTS `time_forms_admin` */;
/*!50001 DROP TABLE IF EXISTS `time_forms_admin` */;

/*!50001 CREATE TABLE  `time_forms_admin`(
 `forms_id` int(11) unsigned ,
 `form_status_id` tinyint(1) ,
 `form_status` varchar(16) ,
 `form_id` int(1) ,
 `form_code` varchar(8) ,
 `form` varchar(32) ,
 `reason` text ,
 `user_id` int(11) ,
 `display_name` varchar(64) ,
 `day` decimal(5,2) ,
 `hrs` decimal(5,2) ,
 `date_range` varchar(140) ,
 `date_from` date ,
 `date_to` date ,
 `createdon` varchar(32) ,
 `created_on` timestamp ,
 `approver_status_id` bigint(11) ,
 `approver_status` varchar(16) ,
 `approver_id` int(11) ,
 `approver_name` varchar(64) ,
 `deleted` tinyint(1) ,
 `type` enum('File','Use') ,
 `focus_date` date 
)*/;

/*Table structure for table `time_forms_blanket` */

DROP TABLE IF EXISTS `time_forms_blanket`;

/*!50001 DROP VIEW IF EXISTS `time_forms_blanket` */;
/*!50001 DROP TABLE IF EXISTS `time_forms_blanket` */;

/*!50001 CREATE TABLE  `time_forms_blanket`(
 `forms_id` int(11) unsigned ,
 `form_code` varchar(8) ,
 `form_status_id` tinyint(1) ,
 `form_id` int(1) ,
 `display_name` varchar(64) ,
 `date` date ,
 `date_from` date ,
 `date_to` date ,
 `date_start` varchar(73) ,
 `date_end` varchar(73) ,
 `date_time_start` varchar(82) ,
 `date_time_end` varchar(82) ,
 `user_id` int(11) ,
 `form_name` varchar(32) ,
 `detail` varbinary(96) ,
 `reason` text ,
 `blanket_name` varchar(97) 
)*/;

/*Table structure for table `time_forms_date` */

DROP TABLE IF EXISTS `time_forms_date`;

/*!50001 DROP VIEW IF EXISTS `time_forms_date` */;
/*!50001 DROP TABLE IF EXISTS `time_forms_date` */;

/*!50001 CREATE TABLE  `time_forms_date`(
 `id` int(11) unsigned ,
 `forms_id` int(11) unsigned ,
 `date` date ,
 `day` decimal(3,2) ,
 `hrs` decimal(5,2) ,
 `duration_id` tinyint(1) ,
 `time_from` datetime ,
 `time_to` datetime ,
 `shift_id` int(1) ,
 `shift_to` int(1) ,
 `credit` decimal(5,2) ,
 `credit_back` decimal(5,2) ,
 `approved_comment` text ,
 `declined_comment` text ,
 `cancelled_comment` text ,
 `deleted` tinyint(1) 
)*/;

/*Table structure for table `time_forms_leave_monitoring` */

DROP TABLE IF EXISTS `time_forms_leave_monitoring`;

/*!50001 DROP VIEW IF EXISTS `time_forms_leave_monitoring` */;
/*!50001 DROP TABLE IF EXISTS `time_forms_leave_monitoring` */;

/*!50001 CREATE TABLE  `time_forms_leave_monitoring`(
 `full_name` varchar(64) ,
 `user_id` int(11) unsigned ,
 `position` varchar(64) ,
 `company_id` int(1) ,
 `company` varchar(64) ,
 `project_id` int(11) ,
 `project` varchar(64) ,
 `department_id` int(1) ,
 `department` varchar(64) ,
 `effectivity_date` date ,
 `date_hired` date ,
 `end_date` date ,
 `id_number` varchar(16) ,
 `form_code` varchar(8) ,
 `form_id` int(1) ,
 `year` int(1) ,
 `date_used` date ,
 `credit` decimal(5,2) ,
 `day` decimal(3,2) ,
 `current` decimal(7,4) ,
 `reason` text ,
 `running_balance` decimal(8,4) ,
 `total_bal` decimal(9,4) 
)*/;

/*Table structure for table `time_forms_leave_type_filter` */

DROP TABLE IF EXISTS `time_forms_leave_type_filter`;

/*!50001 DROP VIEW IF EXISTS `time_forms_leave_type_filter` */;
/*!50001 DROP TABLE IF EXISTS `time_forms_leave_type_filter` */;

/*!50001 CREATE TABLE  `time_forms_leave_type_filter`(
 `form_id` int(11) unsigned ,
 `form_code` varchar(8) ,
 `form` varchar(32) 
)*/;

/*Table structure for table `time_forms_logs_monitoring` */

DROP TABLE IF EXISTS `time_forms_logs_monitoring`;

/*!50001 DROP VIEW IF EXISTS `time_forms_logs_monitoring` */;
/*!50001 DROP TABLE IF EXISTS `time_forms_logs_monitoring` */;

/*!50001 CREATE TABLE  `time_forms_logs_monitoring`(
 `date` date ,
 `shift` varchar(32) ,
 `time_in` varchar(8) ,
 `time_out` varchar(8) ,
 `hrs_work` decimal(5,2) ,
 `total_ot` decimal(6,2) ,
 `late` decimal(5,2) ,
 `absent` tinyint(1) ,
 `form_code` varchar(8) ,
 `is_leave` int(4) ,
 `company_id` int(1) ,
 `company` varchar(64) ,
 `department_id` int(11) unsigned ,
 `department` varchar(64) ,
 `full_name` varchar(32) ,
 `employee_code` varchar(16) ,
 `user_id` int(11) unsigned ,
 `project_id` int(11) ,
 `project` varchar(64) ,
 `payroll_rate_type_id` int(1) ,
 `payroll_rate_type` varchar(64) ,
 `payroll_date` date ,
 `payroll_date_from` date ,
 `payroll_date_to` date 
)*/;

/*Table structure for table `time_forms_manage` */

DROP TABLE IF EXISTS `time_forms_manage`;

/*!50001 DROP VIEW IF EXISTS `time_forms_manage` */;
/*!50001 DROP TABLE IF EXISTS `time_forms_manage` */;

/*!50001 CREATE TABLE  `time_forms_manage`(
 `forms_id` int(11) unsigned ,
 `form_status_id` tinyint(1) ,
 `form_status` varchar(16) ,
 `form_id` int(1) ,
 `form_code` varchar(8) ,
 `form` varchar(32) ,
 `reason` text ,
 `user_id` int(11) ,
 `display_name` varchar(64) ,
 `day` decimal(5,2) ,
 `hrs` decimal(5,2) ,
 `date_range` varchar(140) ,
 `date_from` date ,
 `date_to` date ,
 `createdon` varchar(32) ,
 `created_on` timestamp ,
 `approver_status_id` int(1) ,
 `approver_status` varchar(16) ,
 `approver_id` int(11) ,
 `approver_name` varchar(64) ,
 `company_id` int(1) ,
 `focus_date` date 
)*/;

/*Table structure for table `time_forms_sl_vl` */

DROP TABLE IF EXISTS `time_forms_sl_vl`;

/*!50001 DROP VIEW IF EXISTS `time_forms_sl_vl` */;
/*!50001 DROP TABLE IF EXISTS `time_forms_sl_vl` */;

/*!50001 CREATE TABLE  `time_forms_sl_vl`(
 `full_name` varchar(64) ,
 `user_id` int(11) unsigned ,
 `position` varchar(64) ,
 `company_id` int(1) ,
 `company` varchar(64) ,
 `project_id` int(11) ,
 `project` varchar(64) ,
 `department_id` int(1) ,
 `department` varchar(64) ,
 `effectivity_date` date ,
 `date_hired` date ,
 `id_number` varchar(16) ,
 `current` decimal(7,4) ,
 `form_code` varchar(8) ,
 `year` int(1) ,
 `month` int(2) ,
 `credit` decimal(5,2) ,
 `1` varbinary(29) ,
 `2` varbinary(29) ,
 `3` varbinary(29) ,
 `4` varbinary(29) ,
 `5` varbinary(29) ,
 `6` varbinary(29) ,
 `7` varbinary(29) ,
 `8` varbinary(29) ,
 `9` varbinary(29) ,
 `10` varbinary(29) ,
 `11` varbinary(29) ,
 `12` varbinary(29) ,
 `13` varbinary(29) ,
 `14` varbinary(29) ,
 `15` varbinary(29) ,
 `16` varbinary(29) ,
 `17` varbinary(29) ,
 `18` varbinary(29) ,
 `19` varbinary(29) ,
 `20` varbinary(29) ,
 `21` varbinary(29) ,
 `22` varbinary(29) ,
 `23` varbinary(29) ,
 `24` varbinary(29) ,
 `25` varbinary(29) ,
 `26` varbinary(29) ,
 `27` varbinary(29) ,
 `28` varbinary(29) ,
 `29` varbinary(29) ,
 `30` varbinary(29) ,
 `31` varbinary(29) ,
 `running_balance` decimal(8,4) ,
 `monthly_earning` decimal(3,2) ,
 `used` decimal(24,1) ,
 `total_bal` decimal(28,4) 
)*/;

/*Table structure for table `time_forms_sl_vl_detail` */

DROP TABLE IF EXISTS `time_forms_sl_vl_detail`;

/*!50001 DROP VIEW IF EXISTS `time_forms_sl_vl_detail` */;
/*!50001 DROP TABLE IF EXISTS `time_forms_sl_vl_detail` */;

/*!50001 CREATE TABLE  `time_forms_sl_vl_detail`(
 `user_id` int(11) unsigned ,
 `full_name` varchar(64) ,
 `form_code` varchar(8) ,
 `month` int(11) ,
 `position` varchar(64) ,
 `company_id` int(1) ,
 `company` varchar(64) ,
 `project_id` int(11) ,
 `project` varchar(64) ,
 `department_id` int(1) ,
 `department` varchar(64) ,
 `effectivity_date` date ,
 `date_hired` date ,
 `id_number` varchar(16) ,
 `credit` decimal(24,1) ,
 `current` decimal(5,2) ,
 `year` int(1) ,
 `monthly_earning` decimal(3,2) ,
 `1` double ,
 `2` double ,
 `3` double ,
 `4` double ,
 `5` double ,
 `6` double ,
 `7` double ,
 `8` double ,
 `9` double ,
 `10` double ,
 `11` double ,
 `12` double ,
 `13` double ,
 `14` double ,
 `15` double ,
 `16` double ,
 `17` double ,
 `18` double ,
 `19` double ,
 `20` double ,
 `21` double ,
 `22` double ,
 `23` double ,
 `24` double ,
 `25` double ,
 `26` double ,
 `27` double ,
 `28` double ,
 `29` double ,
 `30` double ,
 `31` double ,
 `running_balance` double(19,2) ,
 `used` decimal(46,1) ,
 `total_bal` double(19,2) 
)*/;

/*Table structure for table `time_forms_sl_vl_month` */

DROP TABLE IF EXISTS `time_forms_sl_vl_month`;

/*!50001 DROP VIEW IF EXISTS `time_forms_sl_vl_month` */;
/*!50001 DROP TABLE IF EXISTS `time_forms_sl_vl_month` */;

/*!50001 CREATE TABLE  `time_forms_sl_vl_month`(
 `user_id` int(11) unsigned ,
 `month_id` int(11) ,
 `form_code` varchar(8) 
)*/;

/*Table structure for table `time_forms_validate_if_exist` */

DROP TABLE IF EXISTS `time_forms_validate_if_exist`;

/*!50001 DROP VIEW IF EXISTS `time_forms_validate_if_exist` */;
/*!50001 DROP TABLE IF EXISTS `time_forms_validate_if_exist` */;

/*!50001 CREATE TABLE  `time_forms_validate_if_exist`(
 `forms_id` int(11) unsigned ,
 `user_id` int(11) ,
 `form_status` varchar(16) ,
 `form_id` int(1) ,
 `day` decimal(3,2) ,
 `hrs` decimal(5,2) ,
 `date` date ,
 `time_from` datetime ,
 `time_to` datetime ,
 `duration_id` tinyint(1) ,
 `duration` varchar(32) ,
 `credit` decimal(5,2) 
)*/;

/*Table structure for table `time_forms_validation` */

DROP TABLE IF EXISTS `time_forms_validation`;

/*!50001 DROP VIEW IF EXISTS `time_forms_validation` */;
/*!50001 DROP TABLE IF EXISTS `time_forms_validation` */;

/*!50001 CREATE TABLE  `time_forms_validation`(
 `forms_id` int(11) unsigned ,
 `user_id` int(11) ,
 `form_status` varchar(16) ,
 `form_id` int(1) ,
 `day` decimal(3,2) ,
 `hrs` decimal(5,2) ,
 `date` date ,
 `time_from` datetime ,
 `time_to` datetime ,
 `duration_id` tinyint(1) ,
 `duration` varchar(32) ,
 `credit` decimal(5,2) 
)*/;

/*Table structure for table `time_holiday` */

DROP TABLE IF EXISTS `time_holiday`;

/*!50001 DROP VIEW IF EXISTS `time_holiday` */;
/*!50001 DROP TABLE IF EXISTS `time_holiday` */;

/*!50001 CREATE TABLE  `time_holiday`(
 `holiday_id` int(11) ,
 `holiday` varchar(64) ,
 `holiday_date` date ,
 `status_id` tinyint(1) ,
 `legal` tinyint(1) ,
 `location_count` int(1) ,
 `user_count` int(1) ,
 `deleted` tinyint(1) 
)*/;

/*Table structure for table `time_period_list` */

DROP TABLE IF EXISTS `time_period_list`;

/*!50001 DROP VIEW IF EXISTS `time_period_list` */;
/*!50001 DROP TABLE IF EXISTS `time_period_list` */;

/*!50001 CREATE TABLE  `time_period_list`(
 `record_id` int(11) unsigned ,
 `period_id` int(11) unsigned ,
 `period_year` varchar(4) ,
 `period_month` varchar(32) ,
 `process_count` int(1) ,
 `proces_status` varchar(10) ,
 `payroll_date` varchar(67) ,
 `company` varchar(64) ,
 `date_from` varchar(35) ,
 `date_from_day` varchar(32) ,
 `date_from_year` int(4) ,
 `date_to` varchar(35) ,
 `date_to_day` varchar(32) ,
 `date_to_year` int(4) ,
 `company_id` int(11) ,
 `from` date ,
 `to` date ,
 `created_on` timestamp ,
 `created_by` int(11) ,
 `modified_by` int(11) ,
 `modified_on` datetime ,
 `ww_time_period.deleted` tinyint(1) 
)*/;

/*Table structure for table `time_record` */

DROP TABLE IF EXISTS `time_record`;

/*!50001 DROP VIEW IF EXISTS `time_record` */;
/*!50001 DROP TABLE IF EXISTS `time_record` */;

/*!50001 CREATE TABLE  `time_record`(
 `record_id` int(11) unsigned ,
 `user_id` int(11) ,
 `biometric` varchar(8) ,
 `shift_id` int(1) ,
 `shift` varchar(32) ,
 `date` date ,
 `processed` tinyint(1) ,
 `override` tinyint(1) ,
 `aux_shift_id` int(1) ,
 `aux_shift` varchar(32) ,
 `aux_time_in` datetime ,
 `aux_time_out` datetime ,
 `time_in` datetime ,
 `time_out` datetime ,
 `breaka_in` datetime ,
 `breaka_out` datetime ,
 `breakb_in` datetime ,
 `breakb_out` datetime ,
 `ot_in` datetime ,
 `ot_out` datetime ,
 `created_on` timestamp ,
 `created_by` int(11) ,
 `modified_on` datetime ,
 `modified_by` int(11) 
)*/;

/*Table structure for table `time_record_holiday` */

DROP TABLE IF EXISTS `time_record_holiday`;

/*!50001 DROP VIEW IF EXISTS `time_record_holiday` */;
/*!50001 DROP TABLE IF EXISTS `time_record_holiday` */;

/*!50001 CREATE TABLE  `time_record_holiday`(
 `holiday_id` int(11) ,
 `holiday` varchar(64) ,
 `holiday_date` date ,
 `legal` tinyint(1) ,
 `holiday_type` varchar(15) ,
 `holiday_icon` varchar(11) ,
 `user_id` int(11) 
)*/;

/*Table structure for table `time_record_list` */

DROP TABLE IF EXISTS `time_record_list`;

/*!50001 DROP VIEW IF EXISTS `time_record_list` */;
/*!50001 DROP TABLE IF EXISTS `time_record_list` */;

/*!50001 CREATE TABLE  `time_record_list`(
 `record_id` int(11) unsigned ,
 `user_id` int(11) ,
 `date` date ,
 `date_tag` varchar(35) ,
 `day_tag` varchar(32) ,
 `shift` varchar(32) ,
 `notes_icon` varchar(11) ,
 `notes_title` varchar(32) ,
 `notes` varchar(64) ,
 `remind_icon` varchar(3) ,
 `remind_title` varchar(5) ,
 `remind` varchar(6) ,
 `timein` varchar(5) ,
 `timein_ampm` varchar(2) ,
 `timeout` varchar(5) ,
 `timeout_ampm` varchar(2) ,
 `timeout_date` varchar(35) ,
 `late` decimal(5,2) ,
 `late_tag` varchar(3) ,
 `undertime` decimal(5,2) ,
 `undertime_tag` varchar(3) ,
 `ot` decimal(5,2) ,
 `ot_break` decimal(5,2) ,
 `ot_tag` varchar(2) ,
 `hrs_worked` decimal(5,2) ,
 `awol` tinyint(1) ,
 `biometric` varchar(8) ,
 `shift_id` int(1) ,
 `processed` tinyint(1) ,
 `override` tinyint(1) ,
 `aux_shift_id` int(1) ,
 `aux_shift` varchar(32) ,
 `aux_time_in` datetime ,
 `aux_time_out` datetime ,
 `time_in` datetime ,
 `time_out` datetime ,
 `breaka_in` datetime ,
 `breaka_out` datetime ,
 `breakb_in` datetime ,
 `breakb_out` datetime ,
 `ot_in` datetime ,
 `ot_out` datetime ,
 `created_on` timestamp ,
 `created_by` int(11) ,
 `modified_on` datetime ,
 `modified_by` int(11) ,
 `form_id` int(1) ,
 `forms_id` int(1) ,
 `form_code` char(0) ,
 `blanket_form_id` int(1) ,
 `blanket_forms_id` int(11) unsigned ,
 `blanket_date_from` varchar(73) ,
 `blanket_date_to` varchar(73) ,
 `blanket_date_time_from` varchar(82) ,
 `blanket_date_time_to` varchar(82) ,
 `blanket_name` varchar(97) ,
 `blanket_detail` varbinary(96) ,
 `blanket_reason` text ,
 `non_swipe` tinyint(1) 
)*/;

/*Table structure for table `time_record_list_forms` */

DROP TABLE IF EXISTS `time_record_list_forms`;

/*!50001 DROP VIEW IF EXISTS `time_record_list_forms` */;
/*!50001 DROP TABLE IF EXISTS `time_record_list_forms` */;

/*!50001 CREATE TABLE  `time_record_list_forms`(
 `forms_id` int(11) unsigned ,
 `form_status_id` tinyint(1) ,
 `form_id` int(1) ,
 `form_code` varchar(8) ,
 `user_id` int(11) ,
 `display_name` varchar(64) ,
 `day` decimal(3,2) ,
 `hrs` decimal(5,2) ,
 `date_from` date ,
 `date_to` date ,
 `date_approved` datetime ,
 `date_declined` datetime ,
 `date_cancelled` datetime ,
 `date_sent` datetime ,
 `reason` text ,
 `scheduled` enum('YES','NO') ,
 `created_on` timestamp ,
 `created_by` int(11) ,
 `modified_on` datetime ,
 `modified_by` int(11) ,
 `deleted` tinyint(1) ,
 `color` varchar(8) ,
 `form` varchar(32) ,
 `approver_id` int(11) ,
 `approver_name` varchar(64) ,
 `form_status` varchar(16) ,
 `date` date ,
 `time_from` datetime ,
 `time_to` datetime ,
 `curr_shift` varchar(32) ,
 `to_shift` varchar(32) ,
 `contact_no` varchar(32) ,
 `name` varchar(64) ,
 `position` varchar(64) ,
 `company_to_visit` varchar(64) ,
 `location` varchar(128) 
)*/;

/*Table structure for table `time_record_raw` */

DROP TABLE IF EXISTS `time_record_raw`;

/*!50001 DROP VIEW IF EXISTS `time_record_raw` */;
/*!50001 DROP TABLE IF EXISTS `time_record_raw` */;

/*!50001 CREATE TABLE  `time_record_raw`(
 `raw_id` timestamp ,
 `user_id` int(11) ,
 `biometric` varchar(8) ,
 `date` date ,
 `location_id` int(1) ,
 `device_id` int(1) ,
 `checktime` datetime ,
 `checktype` varchar(8) ,
 `processed` tinyint(1) 
)*/;

/*Table structure for table `time_record_schedule_history` */

DROP TABLE IF EXISTS `time_record_schedule_history`;

/*!50001 DROP VIEW IF EXISTS `time_record_schedule_history` */;
/*!50001 DROP TABLE IF EXISTS `time_record_schedule_history` */;

/*!50001 CREATE TABLE  `time_record_schedule_history`(
 `branch_id` int(11) unsigned ,
 `department_id` int(11) unsigned ,
 `branch` varchar(64) ,
 `department` varchar(64) ,
 `user_id` int(11) ,
 `created_by_user_id` int(11) ,
 `id_number` varchar(16) ,
 `name` varchar(64) ,
 `type` varchar(12) ,
 `new_schedule` varchar(64) ,
 `date_from` varchar(73) ,
 `date_to` varchar(73) ,
 `change_by` varchar(64) ,
 `created_on` timestamp ,
 `date_and_time` varchar(82) 
)*/;

/*Table structure for table `time_record_summary` */

DROP TABLE IF EXISTS `time_record_summary`;

/*!50001 DROP VIEW IF EXISTS `time_record_summary` */;
/*!50001 DROP TABLE IF EXISTS `time_record_summary` */;

/*!50001 CREATE TABLE  `time_record_summary`(
 `record_id` int(11) unsigned ,
 `user_id` int(11) ,
 `id_number` varchar(8) ,
 `date` date ,
 `payroll_date` date ,
 `day_type` varchar(16) ,
 `hrs_rendered` decimal(5,2) ,
 `hrs_actual` decimal(5,2) ,
 `hrs_break` decimal(5,2) ,
 `absent` tinyint(1) ,
 `lwp` decimal(5,2) ,
 `lwop` decimal(5,2) ,
 `late` decimal(5,2) ,
 `undertime` decimal(5,2) ,
 `ot` decimal(5,2) ,
 `ot_break` decimal(5,2) ,
 `resigned` tinyint(1) ,
 `awol` tinyint(1) 
)*/;

/*Table structure for table `time_record_tardiness` */

DROP TABLE IF EXISTS `time_record_tardiness`;

/*!50001 DROP VIEW IF EXISTS `time_record_tardiness` */;
/*!50001 DROP TABLE IF EXISTS `time_record_tardiness` */;

/*!50001 CREATE TABLE  `time_record_tardiness`(
 `period_year` int(1) ,
 `period_month` int(1) ,
 `user_id` int(11) ,
 `id_number` varchar(8) ,
 `instances` decimal(5,2) ,
 `total_minutes` decimal(5,2) ,
 `date` date ,
 `late` decimal(5,2) 
)*/;

/*Table structure for table `time_shift` */

DROP TABLE IF EXISTS `time_shift`;

/*!50001 DROP VIEW IF EXISTS `time_shift` */;
/*!50001 DROP TABLE IF EXISTS `time_shift` */;

/*!50001 CREATE TABLE  `time_shift`(
 `shift_id` int(1) ,
 `shift` varchar(32) ,
 `status_id` tinyint(1) ,
 `time_start` time ,
 `time_end` time ,
 `created_on` timestamp ,
 `created_by` int(11) ,
 `modified_on` datetime ,
 `modified_by` int(11) ,
 `deleted` tinyint(1) 
)*/;

/*Table structure for table `time_shift_class` */

DROP TABLE IF EXISTS `time_shift_class`;

/*!50001 DROP VIEW IF EXISTS `time_shift_class` */;
/*!50001 DROP TABLE IF EXISTS `time_shift_class` */;

/*!50001 CREATE TABLE  `time_shift_class`(
 `id` int(11) unsigned ,
 `shift_id` int(1) ,
 `shift` varchar(32) ,
 `company_id` int(1) ,
 `company` varchar(64) ,
 `class_id` int(1) ,
 `class_code` varchar(32) ,
 `class_value` varchar(64) 
)*/;

/*Table structure for table `time_shift_class_company` */

DROP TABLE IF EXISTS `time_shift_class_company`;

/*!50001 DROP VIEW IF EXISTS `time_shift_class_company` */;
/*!50001 DROP TABLE IF EXISTS `time_shift_class_company` */;

/*!50001 CREATE TABLE  `time_shift_class_company`(
 `shift_id` int(1) ,
 `shift` varchar(32) ,
 `company_id` int(1) ,
 `time_start` time ,
 `time_end` time ,
 `class_id` int(1) unsigned ,
 `class_code` varchar(32) ,
 `class` varchar(64) ,
 `class_value` varchar(64) ,
 `employment_status_id` varchar(32) ,
 `employment_type_id` varchar(32) ,
 `partners_id` varchar(32) 
)*/;

/*Table structure for table `time_shift_logs` */

DROP TABLE IF EXISTS `time_shift_logs`;

/*!50001 DROP VIEW IF EXISTS `time_shift_logs` */;
/*!50001 DROP TABLE IF EXISTS `time_shift_logs` */;

/*!50001 CREATE TABLE  `time_shift_logs`(
 `user_id` int(11) unsigned ,
 `date` date ,
 `shift_id` bigint(11) ,
 `shift_time_start` time ,
 `shift_time_end` time ,
 `logs_time_in` varbinary(19) ,
 `logs_time_out` varbinary(19) 
)*/;

/*Table structure for table `time_shift_rest_days` */

DROP TABLE IF EXISTS `time_shift_rest_days`;

/*!50001 DROP VIEW IF EXISTS `time_shift_rest_days` */;
/*!50001 DROP TABLE IF EXISTS `time_shift_rest_days` */;

/*!50001 CREATE TABLE  `time_shift_rest_days`(
 `user_id` int(11) unsigned ,
 `shift_id` bigint(11) ,
 `rest_day` varchar(9) 
)*/;

/*Table structure for table `time_stats` */

DROP TABLE IF EXISTS `time_stats`;

/*!50001 DROP VIEW IF EXISTS `time_stats` */;
/*!50001 DROP TABLE IF EXISTS `time_stats` */;

/*!50001 CREATE TABLE  `time_stats`(
 `user_id` int(11) ,
 `mandays` decimal(23,0) ,
 `manhours` decimal(29,2) ,
 `late_undertime` decimal(28,2) ,
 `abs_lwop` decimal(28,2) ,
 `attendance` decimal(31,0) ,
 `dispute` decimal(33,1) ,
 `overtime` decimal(27,2) 
)*/;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

/*!50001 DROP VIEW IF EXISTS `users` */;
/*!50001 DROP TABLE IF EXISTS `users` */;

/*!50001 CREATE TABLE  `users`(
 `user_id` int(11) unsigned ,
 `role_id` int(1) unsigned ,
 `company_id` int(11) ,
 `can_view` tinyint(1) ,
 `can_delete` tinyint(1) ,
 `email` varchar(128) ,
 `full_name` varchar(64) ,
 `login` varchar(64) ,
 `hash` varchar(128) ,
 `last_login` datetime ,
 `display_name` varchar(64) ,
 `timezone` char(64) ,
 `language` enum('en','id') ,
 `active` tinyint(1) ,
 `lastactivity` int(11) ,
 `created_on` timestamp ,
 `created_by` int(11) ,
 `modified_on` timestamp ,
 `modified_by` int(11) ,
 `deleted` tinyint(1) 
)*/;

/*Table structure for table `users_position` */

DROP TABLE IF EXISTS `users_position`;

/*!50001 DROP VIEW IF EXISTS `users_position` */;
/*!50001 DROP TABLE IF EXISTS `users_position` */;

/*!50001 CREATE TABLE  `users_position`(
 `position_id` int(11) unsigned ,
 `position_code` varchar(16) ,
 `position` varchar(64) ,
 `status_id` tinyint(1) ,
 `can_delete` tinyint(1) ,
 `employee_type_id` int(1) ,
 `employee_type` varchar(32) ,
 `immediate_id` int(11) ,
 `immediate` varchar(64) ,
 `created_on` timestamp ,
 `created_by` int(11) ,
 `modified_on` datetime ,
 `modified_by` int(11) ,
 `deleted` tinyint(1) 
)*/;

/*Table structure for table `users_profile` */

DROP TABLE IF EXISTS `users_profile`;

/*!50001 DROP VIEW IF EXISTS `users_profile` */;
/*!50001 DROP TABLE IF EXISTS `users_profile` */;

/*!50001 CREATE TABLE  `users_profile`(
 `user_id` int(11) unsigned ,
 `partner_id` int(11) ,
 `coordinator_id` varchar(64) ,
 `recruit_id` int(11) ,
 `display_name` varchar(64) ,
 `title` varchar(16) ,
 `suffix` varchar(16) ,
 `lastname` varchar(64) ,
 `firstname` varchar(64) ,
 `middlename` varchar(64) ,
 `maidenname` varchar(64) ,
 `nickname` varchar(32) ,
 `project_id` int(11) ,
 `company` varchar(64) ,
 `company_id` int(1) ,
 `group_id` int(1) ,
 `division_id` int(1) ,
 `department_id` int(1) ,
 `branch_id` int(11) ,
 `position_id` int(1) ,
 `reports_to_id` int(11) ,
 `project_hr_id` int(11) ,
 `job_title_id` int(1) ,
 `location_id` int(1) ,
 `photo` varchar(128) ,
 `birth_date` date ,
 `age` tinyint(3) unsigned ,
 `gender` longtext ,
 `active` tinyint(1) 
)*/;

/*View structure for view applicant_details */

/*!50001 DROP TABLE IF EXISTS `applicant_details` */;
/*!50001 DROP VIEW IF EXISTS `applicant_details` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `applicant_details` AS (select `r`.`recruit_id` AS `recruit_id`,`ap`.`position_desired` AS `position_desired`,`ap`.`desired_salary` AS `desired_salary`,concat(`r`.`firstname`,', ',`r`.`lastname`) AS `fullname`,`r`.`firstname` AS `firstname`,`r`.`middlename` AS `middlename`,`r`.`lastname` AS `lastname`,`r`.`birth_date` AS `birthdate`,`r`.`nickname` AS `nickname`,`r`.`gender` AS `gender`,`getage`(`r`.`birth_date`) AS `age`,`ap`.`present_address_no` AS `present_address_no`,`ap`.`present_address_street` AS `present_address_street`,`ap`.`present_address_village` AS `present_address_village`,`ap`.`present_address_barangay` AS `present_address_barangay`,`ap`.`present_address_town` AS `present_address_town`,`ap`.`present_address_city_town` AS `present_address_city_town`,`ap`.`present_address_province` AS `present_address_province`,`ap`.`present_address_country` AS `present_address_country`,concat(`ap`.`present_address_no`,' ',`ap`.`present_address_street`,' ',`ap`.`present_address_village`,' ',`ap`.`present_address_barangay`,' ',`ap`.`present_address_town`,' ',`ap`.`present_address_city_town`) AS `present_address`,concat(`ap`.`present_address_province`,' ',`ap`.`present_address_country`) AS `present_province`,`ap`.`phone` AS `phone`,`ap`.`mobile` AS `mobile`,`ap`.`birth_place` AS `birth_place`,`ap`.`height` AS `height`,`ap`.`weight` AS `weight`,`ap`.`religion` AS `religion`,`ap`.`nationality` AS `citizenship`,`ap`.`civil_status` AS `civil_status`,`ap`.`tin_number` AS `tin_number`,`ap`.`sss_number` AS `sss_number`,`ap`.`pagibig_number` AS `pagibig_number`,`ap`.`philhealth_number` AS `philhealth_number`,`ap`.`present_address_country` AS `emergency_name`,`ap`.`emergency_phone` AS `emergency_phone`,`ap`.`emergency_relationship` AS `emergency_relationship`,`ap`.`language` AS `language`,`ap`.`dialect` AS `dialect`,`ap`.`interests_hobbies` AS `interests_hobbies`,`ap`.`machine_operated` AS `machine_operated`,`ap`.`driver_license` AS `driver_license`,`ap`.`driver_type_license` AS `driver_type_license`,`ap`.`prc_license` AS `prc_license`,`ap`.`prc_type_license` AS `prc_type_license`,`ap`.`prc_license_no` AS `prc_license_no`,`ap`.`prc_date_expiration` AS `prc_date_expiration`,`ap`.`illness_question` AS `illness_question`,`ap`.`illness_yes` AS `illness_yes`,`ap`.`trial_court` AS `trial_court`,`ap`.`how_hiring_heard` AS `how_hiring_heard`,`ap`.`work_start` AS `work_start`,`ap`.`referred_employee` AS `referred_employee`,concat(`ap`.`emergency_address`,' ',`ap`.`emergency_city`,' ',`ap`.`emergency_country`) AS `emergency_ddress`,`r`.`recruitment_date` AS `recruitment_date` from (`ww_recruitment` `r` left join `applicant_personal` `ap` on((`r`.`recruit_id` = `ap`.`recruit_id`)))) */;

/*View structure for view applicant_personal */

/*!50001 DROP TABLE IF EXISTS `applicant_personal` */;
/*!50001 DROP VIEW IF EXISTS `applicant_personal` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `applicant_personal` AS (select `r`.`recruit_id` AS `recruit_id`,max(if((`rp`.`key` = 'position_sought'),`rp`.`key_value`,'')) AS `position_desired`,max(if((`rp`.`key` = 'desired_salary'),`rp`.`key_value`,'')) AS `desired_salary`,max(if((`rp`.`key` = 'presentadd_no'),`rp`.`key_value`,'')) AS `present_address_no`,max(if((`rp`.`key` = 'address_1'),`rp`.`key_value`,'')) AS `present_address_street`,max(if((`rp`.`key` = 'presentadd_village'),`rp`.`key_value`,'')) AS `present_address_village`,max(if((`rp`.`key` = 'address_2'),`rp`.`key_value`,'')) AS `present_address_barangay`,max(if((`rp`.`key` = 'town'),`rp`.`key_value`,'')) AS `present_address_town`,max(if((`rp`.`key` = 'city_town'),`rp`.`key_value`,'')) AS `present_address_city_town`,max(if((`rp`.`key` = 'province'),`rp`.`key_value`,'')) AS `present_address_province`,max(if((`rp`.`key` = 'country'),`rp`.`key_value`,'')) AS `present_address_country`,max(if((`rp`.`key` = 'phone'),`rp`.`key_value`,'')) AS `phone`,max(if((`rp`.`key` = 'mobile'),`rp`.`key_value`,'')) AS `mobile`,max(if((`rp`.`key` = 'birth_place'),`rp`.`key_value`,'')) AS `birth_place`,max(if((`rp`.`key` = 'height'),`rp`.`key_value`,'')) AS `height`,max(if((`rp`.`key` = 'weight'),`rp`.`key_value`,'')) AS `weight`,max(if((`rp`.`key` = 'religion'),`rp`.`key_value`,'')) AS `religion`,max(if((`rp`.`key` = 'nationality'),`rp`.`key_value`,'')) AS `nationality`,max(if((`rp`.`key` = 'civil_status'),`rp`.`key_value`,'')) AS `civil_status`,max(if((`rp`.`key` = 'tin_number'),`rp`.`key_value`,'')) AS `tin_number`,max(if((`rp`.`key` = 'sss_number'),`rp`.`key_value`,'')) AS `sss_number`,max(if((`rp`.`key` = 'philhealth_number'),`rp`.`key_value`,'')) AS `philhealth_number`,max(if((`rp`.`key` = 'pagibig_number'),`rp`.`key_value`,'')) AS `pagibig_number`,max(if((`rp`.`key` = 'emergency_name'),`rp`.`key_value`,'')) AS `emergency_name`,max(if((`rp`.`key` = 'emergency_phone'),`rp`.`key_value`,'')) AS `emergency_phone`,max(if((`rp`.`key` = 'emergency_relationship'),`rp`.`key_value`,'')) AS `emergency_relationship`,max(if((`rp`.`key` = 'emergency_address'),`rp`.`key_value`,'')) AS `emergency_address`,max(if((`rp`.`key` = 'emergency_city'),`rp`.`key_value`,'')) AS `emergency_city`,max(if((`rp`.`key` = 'emergency_country'),`rp`.`key_value`,'')) AS `emergency_country`,max(if((`rp`.`key` = 'language'),`rp`.`key_value`,'')) AS `language`,max(if((`rp`.`key` = 'dialect'),`rp`.`key_value`,'')) AS `dialect`,max(if((`rp`.`key` = 'interests_hobbies'),`rp`.`key_value`,'')) AS `interests_hobbies`,max(if((`rp`.`key` = 'machine_operated'),`rp`.`key_value`,'')) AS `machine_operated`,max(if((`rp`.`key` = 'driver_license'),`rp`.`key_value`,'')) AS `driver_license`,max(if((`rp`.`key` = 'driver_type_license'),`rp`.`key_value`,'')) AS `driver_type_license`,max(if((`rp`.`key` = 'prc_license'),`rp`.`key_value`,'')) AS `prc_license`,max(if((`rp`.`key` = 'prc_type_license'),`rp`.`key_value`,'')) AS `prc_type_license`,max(if((`rp`.`key` = 'prc_license_no'),`rp`.`key_value`,'')) AS `prc_license_no`,max(if((`rp`.`key` = 'prc_date_expiration'),`rp`.`key_value`,'')) AS `prc_date_expiration`,max(if((`rp`.`key` = 'illness_question'),`rp`.`key_value`,'')) AS `illness_question`,max(if((`rp`.`key` = 'illness_yes'),`rp`.`key_value`,'')) AS `illness_yes`,max(if((`rp`.`key` = 'trial_court'),`rp`.`key_value`,'')) AS `trial_court`,max(if((`rp`.`key` = 'how_hiring_heard'),`rp`.`key_value`,'')) AS `how_hiring_heard`,max(if((`rp`.`key` = 'work_start'),`rp`.`key_value`,'')) AS `work_start`,max(if((`rp`.`key` = 'referred_employee'),`rp`.`key_value`,'')) AS `referred_employee` from (`ww_recruitment_personal` `rp` join `ww_recruitment` `r`) where (`r`.`recruit_id` = `rp`.`recruit_id`) group by `r`.`recruit_id`) */;

/*View structure for view applicant_personal_history */

/*!50001 DROP TABLE IF EXISTS `applicant_personal_history` */;
/*!50001 DROP VIEW IF EXISTS `applicant_personal_history` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `applicant_personal_history` AS (select `r`.`recruit_id` AS `recruit_id`,max(if(((`rph`.`key` = 'family-name') and (`rph`.`sequence` = 1)),`rph`.`key_value`,'')) AS `father_name`,max(if(((`rph`.`key` = 'family-name') and (`rph`.`sequence` = 2)),`rph`.`key_value`,'')) AS `mother_name`,max(if(((`rph`.`key` = 'family-name') and (`rph`.`sequence` = 3)),`rph`.`key_value`,'')) AS `brother_name`,max(if(((`rph`.`key` = 'family-name') and (`rph`.`sequence` = 4)),`rph`.`key_value`,'')) AS `sister_name`,max(if(((`rph`.`key` = 'family-name') and (`rph`.`sequence` = 5)),`rph`.`key_value`,'')) AS `son_name`,max(if(((`rph`.`key` = 'family-name') and (`rph`.`sequence` = 6)),`rph`.`key_value`,'')) AS `daughter_name`,max(if(((`rph`.`key` = 'family-name') and (`rph`.`sequence` = 7)),`rph`.`key_value`,'')) AS `guardian_name`,max(if(((`rph`.`key` = 'family-name') and (`rph`.`sequence` = 8)),`rph`.`key_value`,'')) AS `spouse_name`,max(if(((`rph`.`key` = 'family-occupation') and (`rph`.`sequence` = 1)),`rph`.`key_value`,'')) AS `father_occupation`,max(if(((`rph`.`key` = 'family-occupation') and (`rph`.`sequence` = 2)),`rph`.`key_value`,'')) AS `mother_occupation`,max(if(((`rph`.`key` = 'family-occupation') and (`rph`.`sequence` = 3)),`rph`.`key_value`,'')) AS `brother_occupation`,max(if(((`rph`.`key` = 'family-occupation') and (`rph`.`sequence` = 4)),`rph`.`key_value`,'')) AS `sister_occupation`,max(if(((`rph`.`key` = 'family-occupation') and (`rph`.`sequence` = 5)),`rph`.`key_value`,'')) AS `son_occupation`,max(if(((`rph`.`key` = 'family-occupation') and (`rph`.`sequence` = 6)),`rph`.`key_value`,'')) AS `daughter_occupation`,max(if(((`rph`.`key` = 'family-occupation') and (`rph`.`sequence` = 7)),`rph`.`key_value`,'')) AS `guardian_occupation`,max(if(((`rph`.`key` = 'family-occupation') and (`rph`.`sequence` = 8)),`rph`.`key_value`,'')) AS `spouse_occupation`,max(if(((`rph`.`key` = 'family-age') and (`rph`.`sequence` = 1)),`rph`.`key_value`,'')) AS `father_age`,max(if(((`rph`.`key` = 'family-age') and (`rph`.`sequence` = 2)),`rph`.`key_value`,'')) AS `mother_age`,max(if(((`rph`.`key` = 'family-age') and (`rph`.`sequence` = 3)),`rph`.`key_value`,'')) AS `brother_age`,max(if(((`rph`.`key` = 'family-age') and (`rph`.`sequence` = 4)),`rph`.`key_value`,'')) AS `sister_age`,max(if(((`rph`.`key` = 'family-age') and (`rph`.`sequence` = 5)),`rph`.`key_value`,'')) AS `son_age`,max(if(((`rph`.`key` = 'family-age') and (`rph`.`sequence` = 6)),`rph`.`key_value`,'')) AS `daughter_age`,max(if(((`rph`.`key` = 'family-age') and (`rph`.`sequence` = 7)),`rph`.`key_value`,'')) AS `guardian_age`,max(if(((`rph`.`key` = 'family-age') and (`rph`.`sequence` = 8)),`rph`.`key_value`,'')) AS `spouse_age`,`get_relation`('family-relationship',`rph`.`sequence`,'Relationship',`rph`.`recruit_id`) AS `relationship`,`get_relation`('family-name',`rph`.`sequence`,'Name',`rph`.`recruit_id`) AS `name`,`get_relation`('family-birthdate',`rph`.`sequence`,'Birthday',`rph`.`recruit_id`) AS `birthday`,`get_relation`('family-occupation',`rph`.`sequence`,'Occupation',`rph`.`recruit_id`) AS `occupation` from (`ww_recruitment_personal_history` `rph` join `ww_recruitment` `r`) where (`r`.`recruit_id` = `rph`.`recruit_id`) group by `r`.`recruit_id`,`rph`.`sequence`) */;

/*View structure for view approver_class_department */

/*!50001 DROP TABLE IF EXISTS `approver_class_department` */;
/*!50001 DROP VIEW IF EXISTS `approver_class_department` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `approver_class_department` AS (select `up`.`company_id` AS `company_id`,`ud`.`department_id` AS `department_id`,`ud`.`department` AS `department` from (`ww_users_department` `ud` join `users_profile` `up` on((`ud`.`department_id` = `up`.`department_id`))) group by 1,2 order by 1,3) */;

/*View structure for view approver_class_position */

/*!50001 DROP TABLE IF EXISTS `approver_class_position` */;
/*!50001 DROP VIEW IF EXISTS `approver_class_position` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `approver_class_position` AS (select distinct `profile`.`company_id` AS `company_id`,`profile`.`department_id` AS `department_id`,`position`.`position_id` AS `position_id`,`position`.`position` AS `position` from (`ww_users_position` `position` join `users_profile` `profile` on((`profile`.`position_id` = `position`.`position_id`))) where ((`profile`.`company_id` > 0) and (`profile`.`department_id` > 0)) order by 1,2,4) */;

/*View structure for view approver_position_users */

/*!50001 DROP TABLE IF EXISTS `approver_position_users` */;
/*!50001 DROP VIEW IF EXISTS `approver_position_users` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `approver_position_users` AS (select `a`.`user_id` AS `user_id`,`a`.`full_name` AS `full_name`,`b`.`company_id` AS `company_id`,`b`.`department_id` AS `department_id`,`b`.`position_id` AS `position_id` from (`users` `a` join `users_profile` `b` on(((`b`.`user_id` = `a`.`user_id`) and (`a`.`active` = 1))))) */;

/*View structure for view attrition_report */

/*!50001 DROP TABLE IF EXISTS `attrition_report` */;
/*!50001 DROP VIEW IF EXISTS `attrition_report` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `attrition_report` AS (select `up`.`company` AS `company`,`up`.`company_id` AS `company_id`,`up`.`division_id` AS `division_id`,`ud`.`division` AS `division`,year(`p`.`effectivity_date`) AS `year`,`get_headcount_within_active`(year(`p`.`effectivity_date`),1,`up`.`company_id`,`up`.`division_id`) AS `jan_headcount`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1',`up`.`company_id`,`up`.`division_id`,'10,11') AS `jan_managed`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1',`up`.`company_id`,`up`.`division_id`,'8') AS `jan_unmanaged`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `jan_total_attrition`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `jan_actual_ytd_attrition`,round((`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1',`up`.`company_id`,`up`.`division_id`,'8,10,11') / `get_headcount_within_active`(year(`p`.`effectivity_date`),1,`up`.`company_id`,`up`.`division_id`)),2) AS `jan_ytd_attrition`,`get_headcount_within_active`(year(`p`.`effectivity_date`),2,`up`.`company_id`,`up`.`division_id`) AS `feb_headcount`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'2',`up`.`company_id`,`up`.`division_id`,'10,11') AS `feb_managed`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'2',`up`.`company_id`,`up`.`division_id`,'8') AS `feb_unmanaged`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'2',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `feb_total_attrition`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1,2',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `feb_actual_ytd_attrition`,round((`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1,2',`up`.`company_id`,`up`.`division_id`,'8,10,11') / `get_headcount_within_active`(year(`p`.`effectivity_date`),2,`up`.`company_id`,`up`.`division_id`)),2) AS `feb_ytd_attrition`,`get_headcount_within_active`(year(`p`.`effectivity_date`),3,`up`.`company_id`,`up`.`division_id`) AS `mar_headcount`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'3',`up`.`company_id`,`up`.`division_id`,'10,11') AS `mar_managed`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'3',`up`.`company_id`,`up`.`division_id`,'8') AS `mar_unmanaged`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'3',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `mar_total_attrition`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1,2,3',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `mar_actual_ytd_attrition`,round((`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1,2,3',`up`.`company_id`,`up`.`division_id`,'8,10,11') / `get_headcount_within_active`(year(`p`.`effectivity_date`),3,`up`.`company_id`,`up`.`division_id`)),2) AS `mar_ytd_attrition`,`get_headcount_within_active`(year(`p`.`effectivity_date`),4,`up`.`company_id`,`up`.`division_id`) AS `apr_headcount`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'4',`up`.`company_id`,`up`.`division_id`,'10,11') AS `apr_managed`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'4',`up`.`company_id`,`up`.`division_id`,'8') AS `apr_unmanaged`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'4',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `apr_total_attrition`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1,2,3,4',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `apr_actual_ytd_attrition`,round((`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1,2,3,4',`up`.`company_id`,`up`.`division_id`,'8,10,11') / `get_headcount_within_active`(year(`p`.`effectivity_date`),4,`up`.`company_id`,`up`.`division_id`)),2) AS `apr_ytd_attrition`,`get_headcount_within_active`(year(`p`.`effectivity_date`),5,`up`.`company_id`,`up`.`division_id`) AS `may_headcount`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'5',`up`.`company_id`,`up`.`division_id`,'10,11') AS `may_managed`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'5',`up`.`company_id`,`up`.`division_id`,'8') AS `may_unmanaged`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'5',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `may_total_attrition`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1,2,3,4,5',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `may_actual_ytd_attrition`,round((`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1,2,3,4,5',`up`.`company_id`,`up`.`division_id`,'8,10,11') / `get_headcount_within_active`(year(`p`.`effectivity_date`),5,`up`.`company_id`,`up`.`division_id`)),2) AS `may_ytd_attrition`,`get_headcount_within_active`(year(`p`.`effectivity_date`),6,`up`.`company_id`,`up`.`division_id`) AS `jun_headcount`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'6',`up`.`company_id`,`up`.`division_id`,'10,11') AS `jun_managed`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'6',`up`.`company_id`,`up`.`division_id`,'8') AS `jun_unmanaged`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'6',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `jun_total_attrition`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1,2,3,4,5,6',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `jun_actual_ytd_attrition`,round((`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1,2,3,4,5,6',`up`.`company_id`,`up`.`division_id`,'8,10,11') / `get_headcount_within_active`(year(`p`.`effectivity_date`),5,`up`.`company_id`,`up`.`division_id`)),2) AS `jun_ytd_attrition`,`get_headcount_within_active`(year(`p`.`effectivity_date`),7,`up`.`company_id`,`up`.`division_id`) AS `jul_headcount`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'7',`up`.`company_id`,`up`.`division_id`,'10,11') AS `jul_managed`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'7',`up`.`company_id`,`up`.`division_id`,'8') AS `jul_unmanaged`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'7',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `jul_total_attrition`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1,2,3,4,5,6,7',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `jul_actual_ytd_attrition`,round((`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1,2,3,4,5,6,7',`up`.`company_id`,`up`.`division_id`,'8,10,11') / `get_headcount_within_active`(year(`p`.`effectivity_date`),5,`up`.`company_id`,`up`.`division_id`)),2) AS `jul_ytd_attrition`,`get_headcount_within_active`(year(`p`.`effectivity_date`),8,`up`.`company_id`,`up`.`division_id`) AS `aug_headcount`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'8',`up`.`company_id`,`up`.`division_id`,'10,11') AS `aug_managed`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'8',`up`.`company_id`,`up`.`division_id`,'8') AS `aug_unmanaged`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'8',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `aug_total_attrition`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1,2,3,4,5,6,7,8',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `aug_actual_ytd_attrition`,round((`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1,2,3,4,5,6,7,8',`up`.`company_id`,`up`.`division_id`,'8,10,11') / `get_headcount_within_active`(year(`p`.`effectivity_date`),5,`up`.`company_id`,`up`.`division_id`)),2) AS `aug_ytd_attrition`,`get_headcount_within_active`(year(`p`.`effectivity_date`),9,`up`.`company_id`,`up`.`division_id`) AS `sep_headcount`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'9',`up`.`company_id`,`up`.`division_id`,'10,11') AS `sep_managed`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'9',`up`.`company_id`,`up`.`division_id`,'8') AS `sep_unmanaged`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'9',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `sep_total_attrition`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1,2,3,4,5,6,7,8,9',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `sep_actual_ytd_attrition`,round((`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1,2,3,4,5,6,7,8,9',`up`.`company_id`,`up`.`division_id`,'8,10,11') / `get_headcount_within_active`(year(`p`.`effectivity_date`),5,`up`.`company_id`,`up`.`division_id`)),2) AS `sep_ytd_attrition`,`get_headcount_within_active`(year(`p`.`effectivity_date`),10,`up`.`company_id`,`up`.`division_id`) AS `oct_headcount`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'10',`up`.`company_id`,`up`.`division_id`,'10,11') AS `oct_managed`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'10',`up`.`company_id`,`up`.`division_id`,'8') AS `oct_unmanaged`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'10',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `oct_total_attrition`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1,2,3,4,5,6,7,8,9,10',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `oct_actual_ytd_attrition`,round((`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1,2,3,4,5,6,7,8,9,10',`up`.`company_id`,`up`.`division_id`,'8,10,11') / `get_headcount_within_active`(year(`p`.`effectivity_date`),5,`up`.`company_id`,`up`.`division_id`)),2) AS `oct_ytd_attrition`,`get_headcount_within_active`(year(`p`.`effectivity_date`),11,`up`.`company_id`,`up`.`division_id`) AS `nov_headcount`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'11',`up`.`company_id`,`up`.`division_id`,'10,11') AS `nov_managed`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'11',`up`.`company_id`,`up`.`division_id`,'8') AS `nov_unmanaged`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'11',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `nov_total_attrition`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1,2,3,4,5,6,7,8,9,10,11',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `nov_actual_ytd_attrition`,round((`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1,2,3,4,5,6,7,8,9,10,11',`up`.`company_id`,`up`.`division_id`,'8,10,11') / `get_headcount_within_active`(year(`p`.`effectivity_date`),5,`up`.`company_id`,`up`.`division_id`)),2) AS `nov_ytd_attrition`,`get_headcount_within_active`(year(`p`.`effectivity_date`),12,`up`.`company_id`,`up`.`division_id`) AS `dec_headcount`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'12',`up`.`company_id`,`up`.`division_id`,'10,11') AS `dec_managed`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'12',`up`.`company_id`,`up`.`division_id`,'8') AS `dec_unmanaged`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'12',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `dec_total_attrition`,`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1,2,3,4,5,6,7,8,9,10,11,12',`up`.`company_id`,`up`.`division_id`,'8,10,11') AS `dec_actual_ytd_attrition`,round((`get_headcount_within_resigned`(year(`p`.`effectivity_date`),'1,2,3,4,5,6,7,8,9,10,11,12',`up`.`company_id`,`up`.`division_id`,'8,10,11') / `get_headcount_within_active`(year(`p`.`effectivity_date`),5,`up`.`company_id`,`up`.`division_id`)),2) AS `dec_ytd_attrition` from (((`ww_users` `u` join `ww_partners` `p` on((`u`.`user_id` = `p`.`user_id`))) join `ww_users_profile` `up` on((`u`.`user_id` = `up`.`user_id`))) left join `ww_users_division` `ud` on((`up`.`division_id` = `ud`.`division_id`))) where ((`p`.`deleted` = 0) and (`u`.`deleted` = 0)) group by `up`.`division_id`,year(`p`.`effectivity_date`),`up`.`company_id`) */;

/*View structure for view birthday_list_for_the_year */

/*!50001 DROP TABLE IF EXISTS `birthday_list_for_the_year` */;
/*!50001 DROP VIEW IF EXISTS `birthday_list_for_the_year` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `birthday_list_for_the_year` AS (select `u`.`user_id` AS `celebrant_id`,`u`.`display_name` AS `full_name`,`up`.`company_id` AS `company_id`,`up`.`company` AS `company`,`upos`.`position` AS `position`,date_format(concat(year(curdate()),'-',lpad(month(`up`.`birth_date`),2,'0'),'-',lpad(dayofmonth(`up`.`birth_date`),2,'0')),'%b %e, %Y') AS `birth_date` from ((`users` `u` join `users_profile` `up` on((`u`.`user_id` = `up`.`user_id`))) left join `users_position` `upos` on((`up`.`position_id` = `upos`.`position_id`))) where ((`u`.`can_view` = 1) and (`u`.`active` = 1) and (`u`.`deleted` = 0)) order by `up`.`birth_date`) */;

/*View structure for view dashboard_birthday */

/*!50001 DROP TABLE IF EXISTS `dashboard_birthday` */;
/*!50001 DROP VIEW IF EXISTS `dashboard_birthday` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dashboard_birthday` AS (select `u`.`user_id` AS `celebrant_id`,ifnull(`up`.`photo`,'assets/img/avatar.png') AS `photo`,`u`.`display_name` AS `display_name`,`upos`.`position` AS `position`,`nextbday2`(`up`.`birth_date`) AS `birth_date`,`getdaystimeline`(`nextbday2`(`up`.`birth_date`)) AS `time_line`,`nextbday2`(`up`.`birth_date`) AS `datetime` from (((`users` `u` join `users_profile` `up` on((`u`.`user_id` = `up`.`user_id`))) join `users_position` `upos` on((`up`.`position_id` = `upos`.`position_id`))) join `partners` `p` on(((`u`.`user_id` = `p`.`user_id`) and (ifnull(`p`.`resigned_date`,0) = 0)))) where ((`u`.`active` = 1) and (`nextbday2`(`up`.`birth_date`) between (curdate() - interval 2 day) and (curdate() + interval 31 day))) order by 5) */;

/*View structure for view dashboard_birthday_greetings */

/*!50001 DROP TABLE IF EXISTS `dashboard_birthday_greetings` */;
/*!50001 DROP VIEW IF EXISTS `dashboard_birthday_greetings` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dashboard_birthday_greetings` AS (select `sb`.`id` AS `id`,`sb`.`status` AS `status`,`sb`.`user_id` AS `user_id`,`up`.`display_name` AS `display_name`,`sb`.`content` AS `content`,`sb`.`birthday` AS `birthday`,`sb`.`recipient_id` AS `recipient_id`,`upos`.`position` AS `position`,ifnull(`up`.`photo`,'assets/img/avatar.png') AS `photo`,`gettimeline`(`sb`.`createdon`) AS `time_line`,`sb`.`createdon` AS `createdon` from ((`ww_system_birthday` `sb` join `users_profile` `up`) join `ww_users_position` `upos`) where ((`up`.`user_id` = `sb`.`user_id`) and (`upos`.`position_id` = `up`.`position_id`)) order by `sb`.`createdon` desc) */;

/*View structure for view dashboard_birthday_list */

/*!50001 DROP TABLE IF EXISTS `dashboard_birthday_list` */;
/*!50001 DROP VIEW IF EXISTS `dashboard_birthday_list` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dashboard_birthday_list` AS (select `u`.`user_id` AS `celebrant_id`,ifnull(`up`.`photo`,'assets/img/avatar.png') AS `photo`,`u`.`display_name` AS `display_name`,`upos`.`position` AS `position`,`up`.`birth_date` AS `birth_date`,`getbdaystimeline`(`up`.`birth_date`) AS `time_line` from ((`users` `u` left join `users_profile` `up` on((`u`.`user_id` = `up`.`user_id`))) left join `users_position` `upos` on((`up`.`position_id` = `upos`.`position_id`))) where ((`u`.`can_view` = 1) and (`u`.`active` = 1) and (`u`.`deleted` = 0)) order by `up`.`birth_date`) */;

/*View structure for view dashboard_feeds */

/*!50001 DROP TABLE IF EXISTS `dashboard_feeds` */;
/*!50001 DROP VIEW IF EXISTS `dashboard_feeds` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dashboard_feeds` AS (select `wsf`.`id` AS `id`,`wsf`.`user_id` AS `user_id`,`wsf`.`message_type` AS `message_type`,if((`wsf`.`user_id` = `wsf`.`recipient_id`),'label-default',(case `wsf`.`message_type` when 'Comment' then 'label-default' when 'Time Record' then 'label-danger' when 'System' then 'label-success' else 'label-warning' end)) AS `class`,`wsf`.`display_name` AS `display_name`,`wsf`.`feed_content` AS `feed_content`,if((`wsf`.`recipient_id` = 0),`sfr`.`user_id`,`wsf`.`recipient_id`) AS `recipient_id`,if((`wsf`.`recipient_id` = 0),if((`sfr`.`user_id` = `wsf`.`user_id`),`getrecipients`(`wsf`.`id`,`wsf`.`user_id`),''),'') AS `recipients`,`wsf`.`readon` AS `readon`,`wsf`.`createdon` AS `createdon_datetime`,`gettimeline`(`wsf`.`createdon`) AS `createdon`,ifnull(if((`wsf`.`user_id` = `wsf`.`recipient_id`),`photome`.`photo`,`photoyou`.`photo`),'assets/img/avatar.png') AS `avatar`,`wsf`.`uri` AS `uri`,`wsf`.`record_id` AS `record_id`,`sfr`.`like` AS `like`,`wsf`.`deleted` AS `deleted` from (((`ww_system_feeds` `wsf` left join `users_profile` `photome` on((`photome`.`user_id` = `wsf`.`recipient_id`))) left join `users_profile` `photoyou` on((`photoyou`.`user_id` = `wsf`.`user_id`))) left join `ww_system_feeds_recipient` `sfr` on((`sfr`.`id` = `wsf`.`id`))) where (`wsf`.`deleted` = 0) order by if(isnull(`wsf`.`modifiedon`),`wsf`.`createdon`,`wsf`.`modifiedon`) desc,`wsf`.`createdon` desc) */;

/*View structure for view dashboard_feeds2 */

/*!50001 DROP TABLE IF EXISTS `dashboard_feeds2` */;
/*!50001 DROP VIEW IF EXISTS `dashboard_feeds2` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dashboard_feeds2` AS (select `wsf`.`id` AS `id`,`wsf`.`user_id` AS `user_id`,`wsf`.`message_type` AS `message_type`,if((`wsf`.`user_id` = `wsf`.`recipient_id`),'label-default',(case `wsf`.`message_type` when 'Comment' then 'label-default' when 'Time Record' then 'label-danger' when 'System' then 'label-success' else 'label-warning' end)) AS `class`,`wsf`.`display_name` AS `display_name`,`wsf`.`feed_content` AS `feed_content`,if((`wsf`.`recipient_id` = 0),`sfr`.`user_id`,`wsf`.`recipient_id`) AS `recipient_id`,`getrecipients`(`wsf`.`id`) AS `recipients`,`wsf`.`readon` AS `readon`,`wsf`.`createdon` AS `createdon_datetime`,`gettimeline`(`wsf`.`createdon`) AS `createdon`,ifnull(if((`wsf`.`user_id` = `wsf`.`recipient_id`),`photome`.`photo`,`photoyou`.`photo`),'assets/img/avatar.png') AS `avatar`,`wsf`.`deleted` AS `deleted` from (((`ww_system_feeds` `wsf` left join `users_profile` `photome` on((`photome`.`user_id` = `wsf`.`recipient_id`))) left join `users_profile` `photoyou` on((`photoyou`.`user_id` = `wsf`.`user_id`))) left join `ww_system_feeds_recipient` `sfr` on((`sfr`.`id` = `wsf`.`id`))) where (`wsf`.`deleted` = 0) order by `wsf`.`createdon` desc) */;

/*View structure for view dashboard_group_notification */

/*!50001 DROP TABLE IF EXISTS `dashboard_group_notification` */;
/*!50001 DROP VIEW IF EXISTS `dashboard_group_notification` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dashboard_group_notification` AS (select replace(replace(if((length(`f`.`post`) >= 60),concat(left(`f`.`post`,if((locate('<br>',`f`.`post`) > 1),(locate('<br>',`f`.`post`) - 1),60)),'...'),`f`.`post`),'<h4>',''),'</h4>','') AS `post`,`a`.`type_id` AS `type_id`,`a`.`url` AS `url`,`a`.`created_on` AS `created_on`,`a`.`created_by` AS `created_by`,`b`.`user_id` AS `recipient`,`a`.`notif` AS `notif`,`b`.`read` AS `read`,`b`.`read_on` AS `read_on`,`c`.`full_name` AS `full_name`,`d`.`photo` AS `photo`,`gettimeline`(`a`.`created_on`) AS `timeline`,`e`.`type` AS `type` from (((((`ww_groups_notif` `a` left join `ww_groups_notif_recipient` `b` on((`b`.`notif_id` = `a`.`notif_id`))) left join `ww_users` `c` on((`c`.`user_id` = `a`.`created_by`))) left join `ww_users_profile` `d` on((`d`.`user_id` = `c`.`user_id`))) left join `ww_groups_notif_type` `e` on((`e`.`type_id` = `a`.`type_id`))) left join `ww_groups_post` `f` on((`f`.`post_id` = `a`.`post_id`))) where (`f`.`deleted` = 0) order by `a`.`created_on` desc) */;

/*View structure for view dashboard_inbox */

/*!50001 DROP TABLE IF EXISTS `dashboard_inbox` */;
/*!50001 DROP VIEW IF EXISTS `dashboard_inbox` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dashboard_inbox` AS (select `wsi`.`id` AS `id`,`wsi`.`status` AS `status`,`wsi`.`user_id` AS `user_id`,`wsi`.`display_name` AS `display_name`,ifnull(`photome`.`photo`,'assets/img/avatar.png') AS `avatar`,`wsi`.`recipient_id` AS `recipient_id`,replace(replace(if((length(`wsi`.`content`) >= 60),concat(left(`wsi`.`content`,60),'...'),`wsi`.`content`),'<h4>',''),'</h4>','') AS `content`,`wsi`.`readon` AS `readon`,`gettimeline`(`wsi`.`createdon`) AS `timeline`,`wsi`.`reactedon` AS `reactedon`,`wsi`.`createdon` AS `createdon` from (`ww_system_inbox` `wsi` left join `users_profile` `photome` on((`photome`.`user_id` = `wsi`.`user_id`))) where (`wsi`.`deleted` = 0) order by `wsi`.`createdon` desc) */;

/*View structure for view dashboard_notification */

/*!50001 DROP TABLE IF EXISTS `dashboard_notification` */;
/*!50001 DROP VIEW IF EXISTS `dashboard_notification` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dashboard_notification` AS (select `wsf`.`id` AS `id`,`wsf`.`status` AS `status`,`wsf`.`message_type` AS `message_type`,if((`wsf`.`recipient_id` = 0),`sfr`.`user_id`,`wsf`.`recipient_id`) AS `recipient_id`,replace(replace(if((length(`wsf`.`feed_content`) >= 60),concat(`wsf`.`display_name`,'<br>',left(`wsf`.`feed_content`,if((locate('<br>',`wsf`.`feed_content`) > 1),(locate('<br>',`wsf`.`feed_content`) - 1),60)),'...'),`wsf`.`feed_content`),'<h4>',''),'</h4>','') AS `feed_content`,`wsf`.`readon` AS `readon`,`gettimeline`(`wsf`.`createdon`) AS `timeline`,`wsf`.`uri` AS `uri`,`wsf`.`record_id` AS `record_id`,`wsf`.`reactedon` AS `reactedon`,`wsf`.`createdon` AS `createdon` from (`ww_system_feeds` `wsf` left join `ww_system_feeds_recipient` `sfr` on((`sfr`.`id` = `wsf`.`id`))) where (`wsf`.`deleted` = 0) order by `wsf`.`createdon` desc) */;

/*View structure for view dashboard_todo */

/*!50001 DROP TABLE IF EXISTS `dashboard_todo` */;
/*!50001 DROP VIEW IF EXISTS `dashboard_todo` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dashboard_todo` AS (select `forms_submitted`.`forms_id` AS `forms_id`,`forms_submitted`.`form_status_id` AS `form_status_id`,`form_status`.`form_status` AS `form_status`,`forms_submitted`.`form_id` AS `form_id`,`forms`.`form` AS `form`,`forms_submitted`.`form_code` AS `form_code`,`forms_submitted`.`user_id` AS `user_id`,`forms_submitted`.`display_name` AS `display_name`,`forms_submitted`.`date_from` AS `date_from`,`forms_submitted`.`date_to` AS `date_to`,`forms_submitted`.`reason` AS `reason`,`gettimeline`(`forms_submitted`.`created_on`) AS `createdon`,`forms_submitted`.`deleted` AS `deleted` from ((`ww_time_forms` `forms_submitted` join `ww_time_form` `forms`) join `ww_time_form_status` `form_status`) where ((`forms`.`form_id` = `forms_submitted`.`form_id`) and (`forms_submitted`.`form_status_id` = `form_status`.`form_status_id`) and (`forms_submitted`.`deleted` = 0)) order by `forms_submitted`.`created_on` desc) */;

/*View structure for view dashboard_todos */

/*!50001 DROP TABLE IF EXISTS `dashboard_todos` */;
/*!50001 DROP VIEW IF EXISTS `dashboard_todos` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dashboard_todos` AS (select `tf`.`forms_id` AS `forms_id`,`tf`.`form_status_id` AS `form_status_id`,`status`.`form_status` AS `form_status`,`tf`.`form_id` AS `form_id`,`tf`.`form_code` AS `form_code`,`form`.`form` AS `form`,`tf`.`reason` AS `reason`,`tf`.`user_id` AS `user_id`,`tf`.`display_name` AS `display_name`,`tf`.`day` AS `day`,`tf`.`hrs` AS `hrs`,concat(date_format(`tf`.`date_from`,'%b-%e %a'),if((`tf`.`date_from` = `tf`.`date_to`),'',concat(' To ',date_format(`tf`.`date_to`,'%b-%e %a')))) AS `date_range`,`tf`.`date_from` AS `date_from`,`tf`.`date_to` AS `date_to`,`gettimeline`(`tf`.`created_on`) AS `createdon`,`tf`.`created_on` AS `created_on`,`approver`.`form_status_id` AS `approver_status_id`,`approver_status`.`form_status` AS `approver_status`,`approver`.`user_id` AS `approver_id`,`approver`.`display_name` AS `approver_name`,`getdaystimeline`(`tf`.`created_on`) AS `timeline` from ((((`time_forms` `tf` join `ww_time_forms_approver` `approver` on((`approver`.`forms_id` = `tf`.`forms_id`))) join `ww_time_form_status` `status` on((`status`.`form_status_id` = `tf`.`form_status_id`))) join `ww_time_form` `form` on((`form`.`form_id` = `tf`.`form_id`))) join `ww_time_form_status` `approver_status` on((`approver_status`.`form_status_id` = `approver`.`form_status_id`)))) */;

/*View structure for view incident_report */

/*!50001 DROP TABLE IF EXISTS `incident_report` */;
/*!50001 DROP VIEW IF EXISTS `incident_report` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `incident_report` AS select `uc`.`company_id` AS `company_id`,`ud`.`department_id` AS `department_id`,`u`.`user_id` AS `user_id`,`i`.`offense_id` AS `offense_id`,`da`.`sanction_id` AS `sanction_id`,`u`.`full_name` AS `name`,`upos`.`position` AS `position`,`uc`.`company` AS `company`,`ud`.`department` AS `department`,`pol`.`offense_level` AS `frequency`,`pos`.`sanction` AS `penalty`,`da`.`damages_payment` AS `payment`,if((`da`.`date_from` <> '1970-01-01'),`da`.`date_from`,'') AS `from`,if((`da`.`date_to` <> '1970-01-01'),`da`.`date_to`,'') AS `to`,cast(`i`.`date_time_of_offense` as date) AS `date_of_offense`,cast(`i`.`date_time_of_offense` as date) AS `date_of_offense_from`,cast(`i`.`date_time_of_offense` as date) AS `date_of_offense_to`,if((`da`.`sanction_id` is not null),`da`.`created_on`,'') AS `date_serve`,`da`.`remarks` AS `remarks`,if(isnull(`da`.`sanction_id`),`i`.`modified_on`,'') AS `ir_closed_date`,`u1`.`full_name` AS `superior`,`po`.`offense` AS `offense`,`i`.`violation_details` AS `details_of_violations` from (((((((((((`ww_partners_incident` `i` left join `ww_partners_disciplinary_action` `da` on((`da`.`incident_id` = `i`.`incident_id`))) left join `ww_partners_incident_immediate` `ii` on((`ii`.`incident_id` = `i`.`incident_id`))) left join `ww_partners_offense_sanction` `pos` on((`da`.`sanction_id` = `pos`.`sanction_id`))) left join `ww_partners_offense` `po` on((`i`.`offense_id` = `po`.`offense_id`))) left join `ww_partners_offense_level` `pol` on((`pos`.`offense_level_id` = `pol`.`offense_level_id`))) left join `ww_users` `u` on((`i`.`involved_partners` = `u`.`user_id`))) left join `ww_users_profile` `up` on((`u`.`user_id` = `up`.`user_id`))) left join `ww_users` `u1` on((`ii`.`user_id` = `u1`.`user_id`))) left join `ww_users_company` `uc` on((`up`.`company_id` = `uc`.`company_id`))) left join `ww_users_department` `ud` on((`up`.`department_id` = `ud`.`department_id`))) left join `ww_users_position` `upos` on((`up`.`position_id` = `upos`.`position_id`))) */;

/*View structure for view leave_balance_monitoring */

/*!50001 DROP TABLE IF EXISTS `leave_balance_monitoring` */;
/*!50001 DROP VIEW IF EXISTS `leave_balance_monitoring` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `leave_balance_monitoring` AS select `up`.`company_id` AS `company_id`,`up`.`company` AS `company`,concat(`up`.`firstname`,' ',`up`.`lastname`) AS `full_name`,`tfb`.`year` AS `year`,`tfb`.`form_code` AS `leave_type`,`tfb`.`previous` AS `previous`,`tfb`.`current` AS `current`,`tfb`.`used` AS `used`,`tfb`.`paid_unit` AS `converted`,`tfb`.`forfeited` AS `forfeited`,`tfb`.`balance` AS `balance` from (`ww_time_form_balance` `tfb` left join `ww_users_profile` `up` on((`tfb`.`user_id` = `up`.`user_id`))) where (`tfb`.`form_code` = 'LIP') */;

/*View structure for view loan_application_manage */

/*!50001 DROP TABLE IF EXISTS `loan_application_manage` */;
/*!50001 DROP VIEW IF EXISTS `loan_application_manage` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `loan_application_manage` AS (select `pla`.`loan_application_id` AS `loan_application_id`,`pla`.`loan_application_status_id` AS `loan_application_status_id`,`status`.`loan_application_status` AS `loan_application_status`,`plt`.`loan_type_id` AS `loan_type_id`,`plt`.`loan_type_code` AS `loan_type_code`,`plt`.`loan_type` AS `loan_type`,`pla`.`user_id` AS `user_id`,`pla`.`display_name` AS `display_name`,`gettimeline`(`pla`.`created_on`) AS `createdon`,`pla`.`created_on` AS `created_on`,`approver`.`loan_application_status_id` AS `approver_status_id`,`approver_status`.`loan_application_status` AS `approver_status`,`approver`.`user_id` AS `approver_id`,`approver`.`display_name` AS `approver_name`,`up`.`company_id` AS `company_id` from (((((`ww_partners_loan_application` `pla` join `ww_partners_loan_application_approver` `approver` on((`pla`.`loan_application_id` = `approver`.`loan_application_id`))) join `ww_partners_loan_application_status` `status` on((`status`.`loan_application_status_id` = `pla`.`loan_application_status_id`))) join `ww_partners_loan_type` `plt` on((`plt`.`loan_type_id` = `pla`.`loan_type_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `pla`.`user_id`))) join `ww_partners_loan_application_status` `approver_status` on((`approver_status`.`loan_application_status_id` = `approver`.`loan_application_status_id`))) where ((`pla`.`loan_application_status_id` > 1) and (`pla`.`deleted` = 0))) */;

/*View structure for view manpower_movement_report */

/*!50001 DROP TABLE IF EXISTS `manpower_movement_report` */;
/*!50001 DROP VIEW IF EXISTS `manpower_movement_report` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `manpower_movement_report` AS (select `pma`.`effectivity_date` AS `effectivity_date`,`pma`.`display_name` AS `display_name`,(case when (`pmt`.`type_code` = 'PROMOTE') then `t`.`from_name` else '' end) AS `from_name_promote`,(case when (`pmt`.`type_code` = 'PROMOTE') then `t`.`to_name` else '' end) AS `to_name_promote`,(case when (`pmt`.`type_code` = 'TRANSFER') then `t`.`from_name` else '' end) AS `from_name_transfer`,(case when (`pmt`.`type_code` = 'TRANSFER') then `t`.`to_name` else '' end) AS `to_name_transfer`,(case when (`pmt`.`type_code` = 'TERMINATE') then 1 else '' end) AS `manage`,(case when (`pmt`.`type_code` = 'RESIGN') then 1 else '' end) AS `unmanaged`,(case when (`pmt`.`type_code` = 'ENDCNTRCT') then 1 else '' end) AS `EOC`,`up`.`company_id` AS `company_id`,`up`.`division_id` AS `division_id`,year(`pma`.`effectivity_date`) AS `year` from (((((`partner_movement` `pm` left join `ww_partners_movement` `wpm` on((`wpm`.`movement_id` = `pm`.`record_id`))) left join `ww_partners_movement_action` `pma` on((`pma`.`movement_id` = `wpm`.`movement_id`))) left join `ww_partners_movement_action_transfer` `t` on((`t`.`movement_id` = `pma`.`movement_id`))) left join `ww_partners_movement_type` `pmt` on((`pmt`.`type_id` = `pma`.`type_id`))) left join `ww_users_profile` `up` on((`up`.`user_id` = `pma`.`user_id`)))) */;

/*View structure for view month */

/*!50001 DROP TABLE IF EXISTS `month` */;
/*!50001 DROP VIEW IF EXISTS `month` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `month` AS select 'January' AS `MONTH` union all select 'February' AS `February` union all select 'March' AS `March` union all select 'April' AS `April` union all select 'May' AS `May` union all select 'June' AS `June` union all select 'July' AS `July` union all select 'August' AS `August` union all select 'September' AS `September` union all select 'October' AS `October` union all select 'November' AS `November` union all select 'December' AS `December` */;

/*View structure for view new_hires_report */

/*!50001 DROP TABLE IF EXISTS `new_hires_report` */;
/*!50001 DROP VIEW IF EXISTS `new_hires_report` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `new_hires_report` AS (select `rr`.`document_no` AS `prf_no`,`p`.`alias` AS `name`,`p`.`status` AS `status`,`u`.`full_name` AS `recruiter`,`up`.`company_id` AS `company_id`,`up`.`division_id` AS `division_id`,year(`p`.`effectivity_date`) AS `year` from ((((`ww_partners` `p` left join `ww_users_profile` `up` on((`up`.`user_id` = `p`.`user_id`))) left join `ww_recruitment` `r` on((`r`.`partner_id` = `p`.`partner_id`))) left join `ww_recruitment_request` `rr` on((`rr`.`request_id` = `r`.`request_id`))) left join `ww_users` `u` on((`u`.`user_id` = `rr`.`hr_assigned`))) where (`p`.`deleted` = 0)) */;

/*View structure for view night_differential */

/*!50001 DROP TABLE IF EXISTS `night_differential` */;
/*!50001 DROP VIEW IF EXISTS `night_differential` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `night_differential` AS (select `ww_time_record_process`.`user_id` AS `user_id`,`ww_time_record_process`.`date` AS `DATE`,`ww_time_record_process`.`transaction_code` AS `transaction_code`,`ww_time_record_process`.`quantity` AS `quantity` from `ww_time_record_process` where (`ww_time_record_process`.`transaction_code` like '%nd%')) */;

/*View structure for view overtime_checking */

/*!50001 DROP TABLE IF EXISTS `overtime_checking` */;
/*!50001 DROP VIEW IF EXISTS `overtime_checking` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `overtime_checking` AS (select `tf`.`display_name` AS `display_name`,`tfd`.`date` AS `date`,`trs`.`payroll_date` AS `payroll_date`,`tf`.`form_status_id` AS `form_status_id`,if((`tr`.`aux_shift_id` = 0),`tr`.`shift`,`tr`.`aux_shift`) AS `shift`,ifnull(`tr`.`time_in`,`tr`.`aux_time_in`) AS `time_in`,ifnull(`tr`.`time_out`,`tr`.`aux_time_out`) AS `time_out`,`tf`.`focus_date` AS `focus_date`,`tf`.`date_approved` AS `date_approved`,`tfd`.`time_from` AS `time_from`,`tfd`.`time_to` AS `time_to`,`tfd`.`hrs` AS `ot_hours_application`,`trs`.`ot` AS `ot_processed` from (((`ww_time_forms` `tf` left join `ww_time_forms_date` `tfd` on((`tf`.`forms_id` = `tfd`.`forms_id`))) left join `ww_time_record_summary` `trs` on(((`tfd`.`date` = `trs`.`date`) and (`trs`.`user_id` = `tf`.`user_id`)))) left join `ww_time_record` `tr` on(((`tr`.`date` = `trs`.`date`) and (`tr`.`user_id` = `trs`.`user_id`)))) where (`tf`.`form_code` = 'OT')) */;

/*View structure for view overtime_checking_on_approved */

/*!50001 DROP TABLE IF EXISTS `overtime_checking_on_approved` */;
/*!50001 DROP VIEW IF EXISTS `overtime_checking_on_approved` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `overtime_checking_on_approved` AS (select `tf`.`display_name` AS `display_name`,`tfd`.`date` AS `date`,`trs`.`payroll_date` AS `payroll_date`,`tf`.`form_status_id` AS `form_status_id`,if((`tr`.`aux_shift_id` = 0),`tr`.`shift`,`tr`.`aux_shift`) AS `shift`,ifnull(`tr`.`time_in`,`tr`.`aux_time_in`) AS `time_in`,ifnull(`tr`.`time_out`,`tr`.`aux_time_out`) AS `time_out`,`tf`.`date_approved` AS `date_approved`,`tf`.`focus_date` AS `focus_date`,`tfd`.`time_from` AS `time_from`,`tfd`.`time_to` AS `time_to`,`tfd`.`hrs` AS `ot_hours_application`,`trs`.`ot` AS `ot_processed` from (((`ww_time_forms` `tf` left join `ww_time_forms_date` `tfd` on((`tf`.`forms_id` = `tfd`.`forms_id`))) left join `ww_time_record_summary` `trs` on(((`tfd`.`date` = `trs`.`date`) and (`trs`.`user_id` = `tf`.`user_id`)))) left join `ww_time_record` `tr` on(((`tr`.`date` = `trs`.`date`) and (`tr`.`user_id` = `trs`.`user_id`)))) where ((`tf`.`form_code` = 'OT') and (`tf`.`form_status_id` = 6))) */;

/*View structure for view partner_contribution */

/*!50001 DROP TABLE IF EXISTS `partner_contribution` */;
/*!50001 DROP VIEW IF EXISTS `partner_contribution` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `partner_contribution` AS select `partner_contribution_view`.`user_id` AS `user_id`,`partner_contribution_view`.`YEAR` AS `year`,`partner_contribution_view`.`MONTH` AS `month`,max((case when (`partner_contribution_view`.`summary_code` = 'SSS_EMP') then `partner_contribution_view`.`VALUE` end)) AS `SSS`,max((case when (`partner_contribution_view`.`summary_code` = 'PHIC_EMP') then `partner_contribution_view`.`VALUE` end)) AS `PhilHealth`,max((case when (`partner_contribution_view`.`summary_code` = 'HDMF_EMP') then `partner_contribution_view`.`VALUE` end)) AS `PagIBIG`,max((case when (`partner_contribution_view`.`summary_code` = 'WHTAX') then `partner_contribution_view`.`VALUE` end)) AS `WTax` from `partner_contribution_view` group by `partner_contribution_view`.`MONTH`,`partner_contribution_view`.`user_id`,`partner_contribution_view`.`YEAR` order by `partner_contribution_view`.`YEAR` desc,field(`partner_contribution_view`.`MONTH`,'January','February','March','April','May','June','July','August','September','October','November','December') */;

/*View structure for view partner_contribution_view */

/*!50001 DROP TABLE IF EXISTS `partner_contribution_view` */;
/*!50001 DROP VIEW IF EXISTS `partner_contribution_view` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `partner_contribution_view` AS select `ww_payroll_closed_summary`.`user_id` AS `user_id`,`ww_payroll_closed_summary`.`year` AS `YEAR`,`ww_payroll_closed_summary`.`summary_code` AS `summary_code`,`month`.`MONTH` AS `MONTH`,(case `month`.`MONTH` when 'January' then aes_decrypt(`ww_payroll_closed_summary`.`january`,`encryption_key`()) when 'February' then aes_decrypt(`ww_payroll_closed_summary`.`february`,`encryption_key`()) when 'March' then aes_decrypt(`ww_payroll_closed_summary`.`march`,`encryption_key`()) when 'April' then aes_decrypt(`ww_payroll_closed_summary`.`april`,`encryption_key`()) when 'May' then aes_decrypt(`ww_payroll_closed_summary`.`may`,`encryption_key`()) when 'June' then aes_decrypt(`ww_payroll_closed_summary`.`june`,`encryption_key`()) when 'July' then aes_decrypt(`ww_payroll_closed_summary`.`july`,`encryption_key`()) when 'August' then aes_decrypt(`ww_payroll_closed_summary`.`august`,`encryption_key`()) when 'September' then aes_decrypt(`ww_payroll_closed_summary`.`september`,`encryption_key`()) when 'October' then aes_decrypt(`ww_payroll_closed_summary`.`october`,`encryption_key`()) when 'November' then aes_decrypt(`ww_payroll_closed_summary`.`november`,`encryption_key`()) when 'December' then aes_decrypt(`ww_payroll_closed_summary`.`december`,`encryption_key`()) end) AS `VALUE` from (`ww_payroll_closed_summary` join `month`) */;

/*View structure for view partner_loan_payment */

/*!50001 DROP TABLE IF EXISTS `partner_loan_payment` */;
/*!50001 DROP VIEW IF EXISTS `partner_loan_payment` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `partner_loan_payment` AS select `l`.`user_id` AS `user_id`,`p`.`partner_loan_id` AS `partner_loan_id`,sum(if((`p`.`type` = 1),round(aes_decrypt(`p`.`amount`,`encryption_key`()),2),0)) AS `principal`,sum(if((`p`.`type` = 2),round(aes_decrypt(`p`.`amount`,`encryption_key`()),2),0)) AS `interest`,aes_decrypt(`p`.`amount`,`encryption_key`()) AS `amount`,`p`.`date_paid` AS `date_paid`,`pta`.`transaction_label` AS `transaction` from ((((`ww_payroll_partners_loan_payment` `p` left join `ww_payroll_partners_loan` `l` on((`p`.`partner_loan_id` = `l`.`partner_loan_id`))) left join `ww_payroll_loan` `pl` on((`pl`.`loan_id` = `l`.`loan_id`))) left join `ww_payroll_transaction` `pta` on((`pl`.`amortization_transid` = `pta`.`transaction_id`))) left join `ww_payroll_transaction` `ptb` on((`pl`.`interest_transid` = `ptb`.`transaction_id`))) where (`p`.`paid` = 1) group by `l`.`user_id`,`p`.`date_paid`,`p`.`partner_loan_id` order by `p`.`date_paid`,`l`.`user_id`,`pl`.`loan` */;

/*View structure for view partner_manpower_status_position_filter */

/*!50001 DROP TABLE IF EXISTS `partner_manpower_status_position_filter` */;
/*!50001 DROP VIEW IF EXISTS `partner_manpower_status_position_filter` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `partner_manpower_status_position_filter` AS (select `u`.`user_id` AS `user_id`,(case when (`upos`.`position` in ('Assistant Vice President','Senior Vice President','Manager','Deputy Manager','Manager-ISO','PGAD Deputy Manager','Senior Procument Manager','Senior Treasury Manager','Treasury Assistant Manager')) then 'Manager and Above' when (`upos`.`position` = 'Assistant Manager') then 'Assistant Manager' when (`upos`.`position` like '%Engineer%') then 'Engineer' else 'Others' end) AS `position` from ((`ww_users` `u` left join `ww_users_profile` `up` on((`up`.`user_id` = `u`.`user_id`))) left join `ww_users_position` `upos` on((`upos`.`position_id` = `up`.`position_id`)))) */;

/*View structure for view partner_manpower_status_report */

/*!50001 DROP TABLE IF EXISTS `partner_manpower_status_report` */;
/*!50001 DROP VIEW IF EXISTS `partner_manpower_status_report` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `partner_manpower_status_report` AS (select `u`.`active` AS `active`,`p`.`status_id` AS `status_id`,`p`.`status` AS `status`,`upos`.`position` AS `position`,`up`.`company_id` AS `company_id`,`up`.`company` AS `company`,`up`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`pp`.`payroll_rate_type_id` AS `payroll_rate_type_id`,`prt`.`payroll_rate_type` AS `payroll_rate_type`,count(`u`.`user_id`) AS `count`,sum((case when (`u`.`active` = 1) then 1 else 0 end)) AS `employed`,sum((case when (`u`.`active` = 0) then 1 else 0 end)) AS `resigned` from ((((((`ww_users` `u` left join `ww_users_profile` `up` on((`up`.`user_id` = `u`.`user_id`))) left join `ww_partners` `p` on((`p`.`user_id` = `u`.`user_id`))) left join `ww_users_department` `ud` on((`ud`.`department_id` = `up`.`department_id`))) left join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `u`.`user_id`))) left join `ww_payroll_rate_type` `prt` on((`prt`.`payroll_rate_type_id` = `pp`.`payroll_rate_type_id`))) left join `partner_manpower_status_position_filter` `upos` on((`upos`.`user_id` = `u`.`user_id`))) group by `u`.`active`,`p`.`status`,`upos`.`position`,`up`.`company`,`ud`.`department` order by `u`.`active`,`p`.`status`,`up`.`company`,`ud`.`department`) */;

/*View structure for view partner_movement */

/*!50001 DROP TABLE IF EXISTS `partner_movement` */;
/*!50001 DROP VIEW IF EXISTS `partner_movement` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `partner_movement` AS (select `pm`.`movement_id` AS `record_id`,group_concat(`pma`.`display_name` separator '<br> ') AS `employee_name`,group_concat(distinct `pma`.`type` separator ',<br> ') AS `movement_type`,`pmc`.`cause` AS `cause`,`pm`.`deleted` AS `deleted`,`pm`.`created_by` AS `created_by` from ((`ww_partners_movement` `pm` left join `ww_partners_movement_action` `pma` on((`pm`.`movement_id` = `pma`.`movement_id`))) left join `ww_partners_movement_cause` `pmc` on((`pm`.`due_to_id` = `pmc`.`cause_id`))) where ((`pm`.`deleted` = 0) and (`pma`.`deleted` = 0)) group by `pm`.`movement_id` order by `pm`.`created_by`) */;

/*View structure for view partner_movement_current */

/*!50001 DROP TABLE IF EXISTS `partner_movement_current` */;
/*!50001 DROP VIEW IF EXISTS `partner_movement_current` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `partner_movement_current` AS (select `u`.`role_id` AS `role_id`,`r`.`role` AS `role`,`up`.`company_id` AS `company_id`,`comp`.`company` AS `company`,`up`.`department_id` AS `department_id`,`up`.`branch_id` AS `branch_id`,`branch`.`branch` AS `branch`,concat(`dept`.`department_code`,' - ',`dept`.`department`) AS `department`,`up`.`division_id` AS `division_id`,`di`.`division` AS `division`,`uproj`.`project_id` AS `project_id`,`uproj`.`project` AS `project`,`up`.`location_id` AS `location_id`,`loc`.`location` AS `location`,`up`.`position_id` AS `position_id`,`pos`.`position` AS `position`,`up`.`reports_to_id` AS `reports_to_id`,`rto`.`display_name` AS `reports_to`,`prt`.`status_id` AS `employment_status_id`,`prt`.`status` AS `employment_status`,`prt`.`employment_type_id` AS `employment_type_id`,`pet`.`employment_type` AS `employment_type`,`prt`.`job_grade_id` AS `job_grade_id`,`jgl`.`job_level` AS `job_level`,`u`.`user_id` AS `user_id`,`prt`.`partner_id` AS `partner_id` from (((((((((((((`users` `u` join `ww_roles` `r` on((`u`.`role_id` = `r`.`role_id`))) join `users_profile` `up` on((`u`.`user_id` = `up`.`user_id`))) left join `ww_users_company` `comp` on((`up`.`company_id` = `comp`.`company_id`))) left join `ww_users_department` `dept` on((`up`.`department_id` = `dept`.`department_id`))) left join `ww_users_branch` `branch` on((`up`.`branch_id` = `branch`.`branch_id`))) left join `ww_users_project` `uproj` on((`up`.`project_id` = `uproj`.`project_id`))) left join `ww_users_division` `di` on((`up`.`division_id` = `di`.`division_id`))) left join `ww_users_location` `loc` on((`up`.`location_id` = `loc`.`location_id`))) left join `ww_users_position` `pos` on((`up`.`position_id` = `pos`.`position_id`))) left join `ww_users` `rto` on((`up`.`reports_to_id` = `rto`.`user_id`))) join `ww_partners` `prt` on((`u`.`user_id` = `prt`.`user_id`))) join `ww_users_job_grade_level` `jgl` on((`jgl`.`job_grade_id` = `prt`.`job_grade_id`))) left join `ww_partners_employment_type` `pet` on((`prt`.`employment_type_id` = `pet`.`employment_type_id`)))) */;

/*View structure for view partner_payslip */

/*!50001 DROP TABLE IF EXISTS `partner_payslip` */;
/*!50001 DROP VIEW IF EXISTS `partner_payslip` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `partner_payslip` AS select `u`.`user_id` AS `employee`,`p`.`status` AS `status`,`upos`.`position` AS `position`,`pp`.`company_id` AS `company_id`,`uc`.`company` AS `company`,`uc`.`address` AS `address`,`uc`.`city` AS `city`,`u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`up`.`department_id` AS `department_id`,`d`.`department_code` AS `department_code`,`uproj`.`project_id` AS `project_id`,`uproj`.`project_code` AS `project_code`,`uproj`.`project` AS `project`,`prt`.`payroll_rate_type_id` AS `payroll_rate_type_id`,`prt`.`payroll_rate_type` AS `payroll_rate_type`,((((((((case when (`pct`.`transaction_code` = 'DEDUCTION_LATE_ADJ') then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) + (case when (`pct`.`transaction_code` = 'DEDUCTION_UNDERTIME_ADJ') then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end)) + (case when (`pct`.`transaction_code` = 'SALADJ') then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end)) + (case when (`pct`.`transaction_code` = 'OTADJ') then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end)) + (case when (`pct`.`transaction_code` = 'RICEALLOWRETRO') then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end)) + (case when (`pct`.`transaction_code` = 'MEDALLOWRETRO') then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end)) + (case when (`pct`.`transaction_code` = 'LAUNDRYALLOWRETRO') then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end)) + (case when (`pct`.`transaction_code` = 'ABSENCES_ADJ') then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end)) AS `adjustment`,0 AS `other_taxable`,(case when (`pct`.`transaction_code` = 'ABSENCES') then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `absent`,(case when (`pct`.`transaction_code` = 'DEDUCTION_LATE') then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `late`,(case when (`pct`.`transaction_code` = 'DEDUCTION_UNDERTIME') then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `undertime`,(case when (`pct`.`transaction_code` = 'LWOP') then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `lwop`,(case when (`pct`.`transaction_code` = 'ABSENCES') then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `absent_hours`,(case when (`pct`.`transaction_code` = 'DEDUCTION_LATE') then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `late_hours`,(case when (`pct`.`transaction_code` = 'DEDUCTION_UNDERTIME') then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `undertime_hours`,(case when (`pct`.`transaction_code` = 'LWOP') then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `lwop_hours`,(((case when (`pct`.`transaction_code` = 'ABSENCES') then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) + (case when (`pct`.`transaction_code` = 'DEDUCTION_LATE') then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end)) + (case when (`pct`.`transaction_code` = 'DEDUCTION_UNDERTIME') then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end)) AS `absent_tardy`,0 AS `sss`,0 AS `philhealth`,0 AS `pag_ibig`,0 AS `nontax_income`,(case when (`pct`.`transaction_code` = 'REGND') then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `nd`,(case when (`pct`.`transaction_code` = 'REGOT') then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `reg`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'REGOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `nd_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'REGOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `reg_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'RDOT')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'RDOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'RDOT_ND_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_x8_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'RDOT_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_x8`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'DOFF')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `doff`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'DOFF_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `doff_x8`,round((((aes_decrypt(`pp`.`salary`,`encryption_key`()) * 12) / `pp`.`total_year_days`) / 8),2) AS `hourly_rate`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGOT')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `legal`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGOT_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `legal_x8`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `legal_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGOT_ND_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `legal_x8_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGRDOT')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_legal`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGRDOT_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_leg_x8`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGRDOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_legal_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGRDOT_ND_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_leg_x8_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPEOT')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `sp`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPEOT_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `sp_x8`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPEOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `sp_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPEOT_ND_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `sp_x8_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPERDOT')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_sp`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPERDOT_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_sp_x8`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPERDOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_sp_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPERDOT_ND_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_sp_x8_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'DOBOT')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `dobot`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'DOBOT_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `dobot_x8`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'DOBOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `dobot_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'DOBOT_ND_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `dobot_x8_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'DOBRDOT')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_dobot`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'DOBRDOT_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_dobot_x8`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'DOBRDOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_dobot_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'DOBRDOT_ND_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_dobot_x8_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'REGOT')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `reg_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'REGOT_ND')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `nd_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'RDOT')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'RDOT_ND')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_otnd_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'RDOT_ND_EXCESS')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_x8_otnd_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'RDOT_EXCESS')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_x8_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'DOFF')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `doff_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'DOFF_EXCESS')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `doff_x8_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGOT')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `legal_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGOT_EXCESS')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `legal_x8_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGRDOT')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_legal_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGRDOT_EXCESS')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_leg_x8_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPEOT')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `sp_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPEOT_EXCESS')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `sp_x8_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPERDOT')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_sp_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPERDOT_EXCESS')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_sp_x8_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'DOBOT')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `dobot_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'DOBOT_EXCESS')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `dobot_x8_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'DOBOT_ND')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `dobot_otnd_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'DOBOT_ND_EXCESS')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `dobot_x8_otnd_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'DOBRDOT')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_dobot_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'DOBRDOT_EXCESS')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_dobot_x8_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'DOBRDOT_ND')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_dobot_otnd_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'DOBRDOT_ND_EXCESS')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_dobot_x8_otnd_hrs`,0 AS `health_card`,0 AS `other_deduction_one`,0 AS `other_deduction_two`,0 AS `other_deduction_three`,0 AS `sss_sal_loan_payments`,0 AS `sss_cal_loan_payments`,0 AS `hdmf_sal_loan_payments`,0 AS `hdmf_cal_loan_payments`,0 AS `company_loan_payments`,0 AS `sss_sal_loan_balance`,0 AS `sss_cal_loan_balance`,0 AS `hdmf_sal_loan_balance`,0 AS `hdmf_cal_loan_balance`,0 AS `tax_status`,0 AS `ytd_sss`,0 AS `ytd_philhealth`,0 AS `ytd_pag_ibig`,`pp`.`tin` AS `tin`,`pt`.`transaction_label` AS `transaction_label`,`ptc`.`transaction_class_code` AS `transaction_class_code`,`pt`.`transaction_code` AS `transaction_code`,(case when (`pct`.`transaction_code` in ('ABSENCES','ABSENCES_ADJ','LWOP','LWOP_ADJ')) then concat(aes_decrypt(`pct`.`quantity`,`encryption_key`()),' (',`getabsent`(`t`.`payroll_date`,`u`.`user_id`,`pct`.`transaction_code`),') ') else aes_decrypt(`pct`.`quantity`,`encryption_key`()) end) AS `qty`,round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) AS `amount`,`pct`.`transaction_type_id` AS `transaction_type_id`,(case when (`pct`.`transaction_type_id` in (1,2,6,7,8)) then 'Earnings' when (`pct`.`transaction_type_id` in (3,4,5)) then 'Deductions' when (`pct`.`transaction_code` = 'NETPAY') then 'Netpay' else '' end) AS `group`,(case when ((`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) and (`ptc`.`government_mandated` = 0)) then 'Loan' when ((`ptc`.`government_mandated` = 1) or (`ptc`.`transaction_class_code` = 'WHTAX')) then 'government' when (`ptc`.`transaction_class_code` = 'OVERTIME') then 'overtime' when ((`ptc`.`transaction_class_code` in ('ABSENCES','DEDUCTION_LATE','DEDUCTION_UNDERTIME')) or (`pt`.`transaction_code` = 'LWOP')) then 'attnd_ded' when (`pt`.`transaction_type_id` = 8) then 'Bonus' when (`pt`.`transaction_type_id` in (2,6)) then 'Benefits' when ((`pt`.`transaction_type_id` = 1) and (`pt`.`transaction_id` <> 1)) then 'Earnings' when (`pt`.`transaction_id` = 1) then 'salary' when (`pt`.`transaction_code` = 'NETPAY') then 'Netpay' else (case when (`pt`.`transaction_type_id` in (3,4,5)) then 'Oth_ded' when (`pt`.`transaction_type_id` in (1,2,6,7,8)) then 'Oth_inc' else '' end) end) AS `type`,(case when (`ptc`.`transaction_class_code` = 'LOAN_AMORTIZATION') then `pct`.`record_id` else '' end) AS `record_id`,(case when (`ptc`.`transaction_class_code` = 'LOAN_AMORTIZATION') then round(aes_decrypt(`pl`.`beginning_balance`,`encryption_key`()),2) else 0 end) AS `beginning_balance`,(case when (`ptc`.`transaction_class_code` = 'LOAN_AMORTIZATION') then round(aes_decrypt(`pl`.`running_balance`,`encryption_key`()),2) else 0 end) AS `running_balance`,`t`.`payroll_date` AS `payroll_date`,`t`.`date_from` AS `date_from`,`t`.`date_to` AS `date_to`,concat(date_format(if((`ptc`.`transaction_class_code` = 'NETPAY'),`t`.`payroll_date`,`t`.`date_from`),'%Y-%m'),'-',date_format(`t`.`date_from`,'%d')) AS `date_from_applicable`,date_format(if((`ptc`.`transaction_class_code` = 'NETPAY'),last_day(`t`.`payroll_date`),`t`.`date_to`),'%Y-%m-%d') AS `date_to_applicable`,`tc`.`taxcode` AS `taxcode`,`getcompany_contact`(`pct`.`company_id`,'Phone') AS `phone_no`,`getcompany_contact`(`pct`.`company_id`,'Fax') AS `fax_no` from (((((((((((((((`ww_payroll_closed_transaction` `pct` join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_partners` `p` on((`u`.`user_id` = `p`.`user_id`))) join `ww_partners_personal` `ppe` on((`p`.`partner_id` = `ppe`.`partner_id`))) join `ww_taxcode` `tc` on((`tc`.`taxcode_id` = `ppe`.`key_value`))) join `ww_users_profile` `up` on((`u`.`user_id` = `up`.`user_id`))) join `ww_users_position` `upos` on((`up`.`position_id` = `upos`.`position_id`))) join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `u`.`user_id`))) join `ww_users_department` `d` on((`d`.`department_id` = `pct`.`department_id`))) join `ww_users_company` `uc` on((`uc`.`company_id` = `pct`.`company_id`))) left join `ww_payroll_period` `t` on((`t`.`payroll_period_id` = `pct`.`period_id`))) left join `ww_payroll_transaction` `pt` on((`pt`.`transaction_id` = `pct`.`transaction_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_payroll_partners_loan` `pl` on((`pl`.`partner_loan_id` = `pct`.`record_id`))) left join `ww_users_project` `uproj` on((`pct`.`project_id` = `uproj`.`project_id`))) left join `ww_payroll_rate_type` `prt` on((`pct`.`payroll_rate_type_id` = `prt`.`payroll_rate_type_id`))) where ((`pct`.`on_hold` = 0) and (`ppe`.`key` = 'taxcode')) */;

/*View structure for view partner_payslip_orig */

/*!50001 DROP TABLE IF EXISTS `partner_payslip_orig` */;
/*!50001 DROP VIEW IF EXISTS `partner_payslip_orig` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `partner_payslip_orig` AS select `u`.`user_id` AS `employee`,`pp`.`company_id` AS `company_id`,`uc`.`company` AS `company`,`uc`.`address` AS `address`,`uc`.`city` AS `city`,`u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`up`.`department_id` AS `department_id`,`d`.`department_code` AS `department_code`,`uproj`.`project_id` AS `project_id`,`uproj`.`project_code` AS `project_code`,`uproj`.`project` AS `project`,`prt`.`payroll_rate_type_id` AS `payroll_rate_type_id`,`prt`.`payroll_rate_type` AS `payroll_rate_type`,0 AS `adjustment`,0 AS `other_taxable`,(case when (`pct`.`transaction_code` = 'ABSENCES') then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `absent_tardy`,0 AS `sss`,0 AS `philhealth`,0 AS `pag_ibig`,0 AS `nontax_income`,(case when (`pct`.`transaction_code` = 'REGND') then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `nd`,0 AS `reg`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'RDOT')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'RDOT_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_x8`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPEOT')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `sp`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPEOT_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `sp_x8`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPERDOT')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_sp`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPERDOT_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_sp_x8`,round((((aes_decrypt(`pp`.`salary`,`encryption_key`()) * 12) / `pp`.`total_year_days`) / 8),2) AS `hourly_rate`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGOT')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `legal`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGOT_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `legal_x8`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGRDOT')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_legal`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGRDOT_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_leg_x8`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'REGOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `nd_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `reg_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'RDOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'RDOT_ND_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_x8_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPEOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `sp_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPEOT_ND_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `sp_x8_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPERDOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_sp_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPERDOT_ND_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_sp_x8_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `legal_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGOT_ND_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `legal_x8_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGRDOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_legal_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGRDOT_ND_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_leg_x8_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGRDOT_ND_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `nd_hrs`,0 AS `reg_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'RDOT')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'RDOT_EXCESS')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_x8_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPEOT')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `sp_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPEOT_EXCESS')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `sp_x8_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPERDOT')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_sp_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPERDOT_EXCESS')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_sp_x8_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGOT')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `legal_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGOT_EXCESS')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `legal_x8_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGRDOT')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_legal_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGRDOT_EXCESS')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_leg_x8_hrs`,0 AS `health_card`,0 AS `other_deduction_one`,0 AS `other_deduction_two`,0 AS `other_deduction_three`,0 AS `sss_sal_loan_payments`,0 AS `sss_cal_loan_payments`,0 AS `hdmf_sal_loan_payments`,0 AS `hdmf_cal_loan_payments`,0 AS `company_loan_payments`,0 AS `sss_sal_loan_balance`,0 AS `sss_cal_loan_balance`,0 AS `hdmf_sal_loan_balance`,0 AS `hdmf_cal_loan_balance`,0 AS `tax_status`,0 AS `ytd_sss`,0 AS `ytd_philhealth`,0 AS `ytd_pag_ibig`,`pp`.`tin` AS `tin`,`pt`.`transaction_label` AS `transaction_label`,`ptc`.`transaction_class_code` AS `transaction_class_code`,`pt`.`transaction_code` AS `transaction_code`,(case when (`pct`.`transaction_code` in ('ABSENCES','ABSENCES_ADJ','LWOP','LWOP_ADJ')) then concat(aes_decrypt(`pct`.`quantity`,`encryption_key`()),' (',`getabsent`(`t`.`payroll_date`,`u`.`user_id`,`pct`.`transaction_code`),') ') else aes_decrypt(`pct`.`quantity`,`encryption_key`()) end) AS `qty`,round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) AS `amount`,`pct`.`transaction_type_id` AS `transaction_type_id`,(case when (`pct`.`transaction_type_id` in (1,2,6,7,8)) then 'Earnings' when (`pct`.`transaction_type_id` in (3,4,5)) then 'Deductions' when (`pct`.`transaction_code` = 'NETPAY') then 'Netpay' else '' end) AS `group`,(case when ((`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) and (`ptc`.`government_mandated` = 0)) then 'Loan' when ((`ptc`.`government_mandated` = 1) or (`ptc`.`transaction_class_code` = 'WHTAX')) then 'government' when (`ptc`.`transaction_class_code` = 'OVERTIME') then 'overtime' when ((`ptc`.`transaction_class_code` in ('ABSENCES','DEDUCTION_LATE','DEDUCTION_UNDERTIME')) or (`pt`.`transaction_code` = 'LWOP')) then 'attnd_ded' when (`pt`.`transaction_type_id` = 8) then 'Bonus' when (`pt`.`transaction_type_id` in (2,6)) then 'Benefits' when ((`pt`.`transaction_type_id` = 1) and (`pt`.`transaction_id` <> 1)) then 'Earnings' when (`pt`.`transaction_id` = 1) then 'salary' when (`pt`.`transaction_code` = 'NETPAY') then 'Netpay' else (case when (`pt`.`transaction_type_id` in (3,4,5)) then 'Oth_ded' when (`pt`.`transaction_type_id` in (1,2,6,7,8)) then 'Oth_inc' else '' end) end) AS `type`,(case when (`ptc`.`transaction_class_code` = 'LOAN_AMORTIZATION') then `pct`.`record_id` else '' end) AS `record_id`,(case when (`ptc`.`transaction_class_code` = 'LOAN_AMORTIZATION') then round(aes_decrypt(`pl`.`beginning_balance`,`encryption_key`()),2) else 0 end) AS `beginning_balance`,(case when (`ptc`.`transaction_class_code` = 'LOAN_AMORTIZATION') then round(aes_decrypt(`pl`.`running_balance`,`encryption_key`()),2) else 0 end) AS `running_balance`,`t`.`payroll_date` AS `payroll_date`,`t`.`date_from` AS `date_from`,`t`.`date_to` AS `date_to`,`tc`.`taxcode` AS `taxcode`,`getcompany_contact`(`pct`.`company_id`,'Phone') AS `phone_no`,`getcompany_contact`(`pct`.`company_id`,'Fax') AS `fax_no` from ((((((((((((((`ww_payroll_current_transaction` `pct` join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_partners` `p` on((`u`.`user_id` = `p`.`user_id`))) join `ww_partners_personal` `ppe` on((`p`.`partner_id` = `ppe`.`partner_id`))) join `ww_taxcode` `tc` on((`tc`.`taxcode_id` = `ppe`.`key_value`))) join `ww_users_profile` `up` on((`u`.`user_id` = `up`.`user_id`))) join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `u`.`user_id`))) join `ww_users_department` `d` on((`d`.`department_id` = `up`.`department_id`))) join `ww_users_company` `uc` on((`uc`.`company_id` = `pp`.`company_id`))) left join `ww_payroll_period` `t` on((`t`.`payroll_period_id` = `pct`.`period_id`))) left join `ww_payroll_transaction` `pt` on((`pt`.`transaction_id` = `pct`.`transaction_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_payroll_partners_loan` `pl` on((`pl`.`partner_loan_id` = `pct`.`record_id`))) left join `ww_users_project` `uproj` on((`pct`.`project_id` = `uproj`.`project_id`))) left join `ww_payroll_rate_type` `prt` on((`pct`.`payroll_rate_type_id` = `prt`.`payroll_rate_type_id`))) where ((`pct`.`on_hold` = 0) and (`ppe`.`key` = 'taxcode')) union all select `u`.`user_id` AS `employee`,`pp`.`company_id` AS `company_id`,`uc`.`company` AS `company`,`uc`.`address` AS `address`,`uc`.`city` AS `city`,`u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`up`.`department_id` AS `department_id`,`d`.`department_code` AS `department_code`,`uproj`.`project_id` AS `project_id`,`uproj`.`project_code` AS `project_code`,`uproj`.`project` AS `project`,`prt`.`payroll_rate_type_id` AS `payroll_rate_type_id`,`prt`.`payroll_rate_type` AS `payroll_rate_type`,0 AS `adjustment`,0 AS `other_taxable`,(case when (`pct`.`transaction_code` = 'ABSENCES') then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `absent_tardy`,0 AS `sss`,0 AS `philhealth`,0 AS `pag_ibig`,0 AS `nontax_income`,(case when (`pct`.`transaction_code` = 'REGND') then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `nd`,0 AS `reg`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'RDOT')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'RDOT_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_x8`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPEOT')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `sp`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPEOT_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `sp_x8`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPERDOT')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_sp`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPERDOT_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_sp_x8`,round((((aes_decrypt(`pp`.`salary`,`encryption_key`()) * 12) / `pp`.`total_year_days`) / 8),2) AS `hourly_rate`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGOT')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `legal`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGOT_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `legal_x8`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGRDOT')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_legal`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGRDOT_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_leg_x8`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'REGOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `nd_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `reg_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'RDOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'RDOT_ND_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_x8_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPEOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `sp_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPEOT_ND_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `sp_x8_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPERDOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_sp_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPERDOT_ND_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_sp_x8_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `legal_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGOT_ND_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `legal_x8_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGRDOT_ND')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_legal_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGRDOT_ND_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `rest_leg_x8_otnd`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGRDOT_ND_EXCESS')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `nd_hrs`,0 AS `reg_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'RDOT')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'RDOT_EXCESS')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_x8_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPEOT')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `sp_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPEOT_EXCESS')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `sp_x8_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPERDOT')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_sp_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'SPERDOT_EXCESS')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_sp_x8_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGOT')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `legal_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGOT_EXCESS')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `legal_x8_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGRDOT')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_legal_hrs`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGRDOT_EXCESS')) then round(aes_decrypt(`pct`.`quantity`,`encryption_key`()),2) else 0 end) AS `rest_leg_x8_hrs`,0 AS `health_card`,0 AS `other_deduction_one`,0 AS `other_deduction_two`,0 AS `other_deduction_three`,0 AS `sss_sal_loan_payments`,0 AS `sss_cal_loan_payments`,0 AS `hdmf_sal_loan_payments`,0 AS `hdmf_cal_loan_payments`,0 AS `company_loan_payments`,0 AS `sss_sal_loan_balance`,0 AS `sss_cal_loan_balance`,0 AS `hdmf_sal_loan_balance`,0 AS `hdmf_cal_loan_balance`,0 AS `tax_status`,0 AS `ytd_sss`,0 AS `ytd_philhealth`,0 AS `ytd_pag_ibig`,`pp`.`tin` AS `tin`,`pt`.`transaction_label` AS `transaction_label`,`ptc`.`transaction_class_code` AS `transaction_class_code`,`pt`.`transaction_code` AS `transaction_code`,(case when (`pct`.`transaction_code` in ('ABSENCES','ABSENCES_ADJ','LWOP','LWOP_ADJ')) then concat(aes_decrypt(`pct`.`quantity`,`encryption_key`()),' (',`getabsent`(`t`.`payroll_date`,`u`.`user_id`,`pct`.`transaction_code`),') ') else aes_decrypt(`pct`.`quantity`,`encryption_key`()) end) AS `qty`,round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) AS `amount`,`pct`.`transaction_type_id` AS `transaction_type_id`,(case when (`pct`.`transaction_type_id` in (1,2,6,7,8)) then 'Earnings' when (`pct`.`transaction_type_id` in (3,4,5)) then 'Deductions' when (`pct`.`transaction_code` = 'NETPAY') then 'Netpay' else '' end) AS `group`,(case when ((`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) and (`ptc`.`government_mandated` = 0)) then 'Loan' when ((`ptc`.`government_mandated` = 1) or (`ptc`.`transaction_class_code` = 'WHTAX')) then 'government' when (`ptc`.`transaction_class_code` = 'OVERTIME') then 'overtime' when ((`ptc`.`transaction_class_code` in ('ABSENCES','DEDUCTION_LATE','DEDUCTION_UNDERTIME')) or (`pt`.`transaction_code` = 'LWOP')) then 'attnd_ded' when (`pt`.`transaction_type_id` = 8) then 'Bonus' when (`pt`.`transaction_type_id` in (2,6)) then 'Benefits' when ((`pt`.`transaction_type_id` = 1) and (`pt`.`transaction_id` <> 1)) then 'Earnings' when (`pt`.`transaction_id` = 1) then 'salary' when (`pt`.`transaction_code` = 'NETPAY') then 'Netpay' else (case when (`pt`.`transaction_type_id` in (3,4,5)) then 'Oth_ded' when (`pt`.`transaction_type_id` in (1,2,6,7,8)) then 'Oth_inc' else '' end) end) AS `type`,(case when (`ptc`.`transaction_class_code` = 'LOAN_AMORTIZATION') then `pct`.`record_id` else '' end) AS `record_id`,(case when (`ptc`.`transaction_class_code` = 'LOAN_AMORTIZATION') then round(aes_decrypt(`pl`.`beginning_balance`,`encryption_key`()),2) else 0 end) AS `beginning_balance`,(case when (`ptc`.`transaction_class_code` = 'LOAN_AMORTIZATION') then round(aes_decrypt(`pl`.`running_balance`,`encryption_key`()),2) else 0 end) AS `running_balance`,`t`.`payroll_date` AS `payroll_date`,`t`.`date_from` AS `date_from`,`t`.`date_to` AS `date_to`,`tc`.`taxcode` AS `taxcode`,`getcompany_contact`(`pct`.`company_id`,'Phone') AS `phone_no`,`getcompany_contact`(`pct`.`company_id`,'Fax') AS `fax_no` from ((((((((((((((`ww_payroll_closed_transaction` `pct` join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_partners` `p` on((`u`.`user_id` = `p`.`user_id`))) join `ww_partners_personal` `ppe` on((`p`.`partner_id` = `ppe`.`partner_id`))) join `ww_taxcode` `tc` on((`tc`.`taxcode_id` = `ppe`.`key_value`))) join `ww_users_profile` `up` on((`u`.`user_id` = `up`.`user_id`))) join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `u`.`user_id`))) join `ww_users_department` `d` on((`d`.`department_id` = `up`.`department_id`))) join `ww_users_company` `uc` on((`uc`.`company_id` = `pp`.`company_id`))) left join `ww_payroll_period` `t` on((`t`.`payroll_period_id` = `pct`.`period_id`))) left join `ww_payroll_transaction` `pt` on((`pt`.`transaction_id` = `pct`.`transaction_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_payroll_partners_loan` `pl` on((`pl`.`partner_loan_id` = `pct`.`record_id`))) left join `ww_users_project` `uproj` on((`pct`.`project_id` = `uproj`.`project_id`))) left join `ww_payroll_rate_type` `prt` on((`pct`.`payroll_rate_type_id` = `prt`.`payroll_rate_type_id`))) where ((`pct`.`on_hold` = 0) and (`ppe`.`key` = 'taxcode')) */;

/*View structure for view partners */

/*!50001 DROP TABLE IF EXISTS `partners` */;
/*!50001 DROP VIEW IF EXISTS `partners` */;

/*!50001 CREATE ALGORITHM=MERGE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `partners` AS (select `t0`.`user_id` AS `user_id`,`t1`.`id_number` AS `id_number`,`t1`.`biometric` AS `biometric`,`t1`.`partner_id` AS `partner_id`,`t1`.`deleted` AS `deleted`,`t1`.`shift_id` AS `shift_id`,`t1`.`shift` AS `shift`,`t1`.`calendar_id` AS `calendar_id`,`t1`.`calendar` AS `calendar`,`t2`.`full_name` AS `full_name`,`t1`.`alias` AS `alias`,`t1`.`status_id` AS `status_id`,`t1`.`status` AS `status`,`t1`.`employment_type_id` AS `employment_type_id`,`t1`.`employment_type` AS `employment_type`,`t0`.`company_id` AS `company_id`,`t1`.`job_grade_id` AS `job_grade_id`,`t1`.`v_job_grade` AS `v_job_grade`,`t1`.`position_classification_id` AS `position_classification_id`,`t1`.`position_classification` AS `position_classification`,format(aes_decrypt(`t0`.`salary`,`encryption_key`()),2) AS `salary`,`t0`.`sss_no` AS `sss_no`,`t0`.`phic_no` AS `phic_no`,`t0`.`hdmf_no` AS `hdmf_no`,`t1`.`resigned_date` AS `resigned_date`,`t2`.`email` AS `email`,year(`t1`.`effectivity_date`) AS `year`,month(`t1`.`effectivity_date`) AS `month`,`t1`.`effectivity_date` AS `effectivity_date`,`t1`.`regularization_date` AS `regularization_date`,`t1`.`created_on` AS `created_on`,`t1`.`created_by` AS `created_by`,`t1`.`modified_on` AS `modified_on`,`t1`.`modified_by` AS `modified_by`,`t3`.`company` AS `company`,`t3`.`sss` AS `sss`,`t3`.`tin` AS `tin`,`t3`.`phic` AS `phic`,`t3`.`hdmf` AS `hdmf`,`t3`.`address` AS `address`,`t4`.`birth_date` AS `birth_date`,`t4`.`position_id` AS `position_id`,`t5`.`position` AS `position` from (((((`ww_payroll_partners` `t0` left join `ww_partners` `t1` on((`t1`.`user_id` = `t0`.`user_id`))) left join `ww_users` `t2` on((`t2`.`user_id` = `t0`.`user_id`))) left join `ww_users_company` `t3` on((`t3`.`company_id` = `t0`.`company_id`))) left join `ww_users_profile` `t4` on((`t4`.`partner_id` = `t1`.`partner_id`))) left join `ww_users_position` `t5` on((`t5`.`position_id` = `t4`.`position_id`)))) */;

/*View structure for view partners_details */

/*!50001 DROP TABLE IF EXISTS `partners_details` */;
/*!50001 DROP VIEW IF EXISTS `partners_details` */;

/*!50001 CREATE ALGORITHM=MERGE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `partners_details` AS (select `t0`.`user_id` AS `user_id`,`t1`.`id_number` AS `id_number`,`t1`.`status` AS `status`,`t2`.`full_name` AS `full_name`,`t2`.`active` AS `active`,`t4`.`company_id` AS `company_id`,`t4`.`division_id` AS `division_id`,`t4`.`department_id` AS `department_id`,`t4`.`project_id` AS `project_id`,`t4`.`lastname` AS `lastname`,`t4`.`firstname` AS `firstname`,`t4`.`middlename` AS `middlename`,format(aes_decrypt(`t0`.`salary`,`encryption_key`()),2) AS `salary`,`t0`.`sss_no` AS `sss_no`,`t0`.`phic_no` AS `phic_no`,`t0`.`hdmf_no` AS `hdmf_no`,`t0`.`tin` AS `tin`,`t1`.`resigned_date` AS `resigned_date`,`t2`.`email` AS `email`,year(`t1`.`effectivity_date`) AS `year`,month(`t1`.`effectivity_date`) AS `month`,`t1`.`effectivity_date` AS `date_hired`,`t3`.`address` AS `address`,`t4`.`position_id` AS `position_id`,`t4`.`end_date` AS `end_date`,`t4`.`birth_date` AS `birthdate`,`t5`.`position` AS `position`,`t6`.`project` AS `project`,`t6`.`project_code` AS `project_code`,`getage`(`t4`.`birth_date`) AS `age`,`t7`.`birth_place` AS `birth_place`,`t7`.`gender` AS `gender`,`t7`.`civil_status` AS `civil_status` from (((((((`ww_payroll_partners` `t0` left join `ww_partners` `t1` on((`t1`.`user_id` = `t0`.`user_id`))) left join `ww_users` `t2` on((`t2`.`user_id` = `t0`.`user_id`))) left join `ww_users_company` `t3` on((`t3`.`company_id` = `t0`.`company_id`))) left join `ww_users_profile` `t4` on((`t4`.`partner_id` = `t1`.`partner_id`))) left join `ww_users_project` `t6` on((`t6`.`project_id` = `t4`.`project_id`))) left join `ww_users_position` `t5` on((`t5`.`position_id` = `t4`.`position_id`))) left join `partners_personal` `t7` on((`t7`.`user_id` = `t1`.`user_id`)))) */;

/*View structure for view partners_gender_age */

/*!50001 DROP TABLE IF EXISTS `partners_gender_age` */;
/*!50001 DROP VIEW IF EXISTS `partners_gender_age` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `partners_gender_age` AS (select `up`.`gender` AS `gender`,(case when (`up`.`age` between 18 and 24) then '18-24' when (`up`.`age` between 25 and 34) then '25-34' when (`up`.`age` between 35 and 44) then '35-44' when (`up`.`age` between 45 and 54) then '45-54' when (`up`.`age` between 55 and 64) then '55-64' when (`up`.`age` between 65 and 99) then '65 and Over' else '' end) AS `edad`,sum((case when (`up`.`age` between 18 and 24) then 1 when (`up`.`age` between 25 and 34) then 1 when (`up`.`age` between 35 and 44) then 1 when (`up`.`age` between 45 and 54) then 1 when (`up`.`age` between 55 and 64) then 1 when (`up`.`age` between 65 and 99) then 1 else 0 end)) AS `bilang` from (`partners` `p` join `users_profile` `up`) where ((`p`.`user_id` = `up`.`user_id`) and (`up`.`gender` <> ''))) */;

/*View structure for view partners_personal */

/*!50001 DROP TABLE IF EXISTS `partners_personal` */;
/*!50001 DROP VIEW IF EXISTS `partners_personal` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `partners_personal` AS (select `p`.`user_id` AS `user_id`,`p`.`alias` AS `alias`,max(if((`wp`.`key` = 'organization'),`wp`.`key_value`,'')) AS `organization`,max(if(((`wp`.`key` = 'phone') and (`wp`.`sequence` = 1)),`wp`.`key_value`,'')) AS `phone_1`,max(if(((`wp`.`key` = 'phone') and (`wp`.`sequence` = 2)),`wp`.`key_value`,'')) AS `phone_2`,max(if(((`wp`.`key` = 'phone') and (`wp`.`sequence` = 3)),`wp`.`key_value`,'')) AS `phone_3`,max(if(((`wp`.`key` = 'mobile') and (`wp`.`sequence` = 1)),`wp`.`key_value`,'')) AS `mobile_1`,max(if(((`wp`.`key` = 'mobile') and (`wp`.`sequence` = 2)),`wp`.`key_value`,'')) AS `mobile_2`,max(if(((`wp`.`key` = 'mobile') and (`wp`.`sequence` = 3)),`wp`.`key_value`,'')) AS `mobile_3`,max(if((`wp`.`key` = 'address_1'),`wp`.`key_value`,'')) AS `address`,max(if((`wp`.`key` = 'city_town'),`wp`.`key_value`,'')) AS `city_town`,max(if((`wp`.`key` = 'country'),`wp`.`key_value`,'')) AS `country`,max(if((`wp`.`key` = 'zip_code'),`wp`.`key_value`,'')) AS `zip_code`,max(if((`wp`.`key` = 'emergency_name'),`wp`.`key_value`,'')) AS `emergency_name`,max(if((`wp`.`key` = 'emergency_relationship'),`wp`.`key_value`,'')) AS `emergency_relationship`,max(if((`wp`.`key` = 'emergency_phone'),`wp`.`key_value`,'')) AS `emergency_phone`,max(if((`wp`.`key` = 'emergency_mobile'),`wp`.`key_value`,'')) AS `emergency_mobile`,max(if((`wp`.`key` = 'emergency_address'),`wp`.`key_value`,'')) AS `emergency_address`,max(if((`wp`.`key` = 'emergency_city'),`wp`.`key_value`,'')) AS `emergency_city`,max(if((`wp`.`key` = 'emergency_country'),`wp`.`key_value`,'')) AS `emergency_country`,max(if((`wp`.`key` = 'emergency_zip_code'),`wp`.`key_value`,'')) AS `emergency_zip_code`,max(if((`wp`.`key` = 'taxcode'),`wp`.`key_value`,'')) AS `taxcode`,max(if((`wp`.`key` = 'sss_number'),`wp`.`key_value`,'')) AS `sss_number`,max(if((`wp`.`key` = 'pagibig_number'),`wp`.`key_value`,'')) AS `pagibig_number`,max(if((`wp`.`key` = 'philhealth_number'),`wp`.`key_value`,'')) AS `philhealth_number`,max(if((`wp`.`key` = 'tin_number'),`wp`.`key_value`,'')) AS `tin_number`,max(if((`wp`.`key` = 'bank_account_number_savings'),`wp`.`key_value`,'')) AS `bank_account_number_savings`,max(if((`wp`.`key` = 'bank_account_number_current'),`wp`.`key_value`,'')) AS `bank_account_number_current`,max(if((`wp`.`key` = 'bank_account_name'),`wp`.`key_value`,'')) AS `bank_account_name`,max(if((`wp`.`key` = 'gender'),`wp`.`key_value`,'')) AS `gender`,max(if((`wp`.`key` = 'birth_place'),`wp`.`key_value`,'')) AS `birth_place`,max(if((`wp`.`key` = 'religion'),`wp`.`key_value`,'')) AS `religion`,max(if((`wp`.`key` = 'nationality'),`wp`.`key_value`,'')) AS `nationality`,max(if((`wp`.`key` = 'civil_status'),`wp`.`key_value`,'')) AS `civil_status`,max(if((`wp`.`key` = 'solo_parent'),`wp`.`key_value`,'')) AS `solo_parent` from (`ww_partners_personal` `wp` join `ww_partners` `p`) where (`wp`.`partner_id` = `p`.`partner_id`) group by `p`.`partner_id`) */;

/*View structure for view partners_personal_history_accountabilities */

/*!50001 DROP TABLE IF EXISTS `partners_personal_history_accountabilities` */;
/*!50001 DROP VIEW IF EXISTS `partners_personal_history_accountabilities` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `partners_personal_history_accountabilities` AS (select `p`.`user_id` AS `user_id`,`p`.`alias` AS `alias`,max(if((`pph`.`key` = 'accountabilities-name'),`pph`.`key_value`,'')) AS `name`,max(if((`pph`.`key` = 'accountabilities-code'),`pph`.`key_value`,'')) AS `code`,max(if((`pph`.`key` = 'accountabilities-quantity'),`pph`.`key_value`,'')) AS `qty`,max(if((`pph`.`key` = 'accountabilities-date-issued'),`pph`.`key_value`,'')) AS `date_issued`,max(if((`pph`.`key` = 'accountabilities-date-returned'),`pph`.`key_value`,'')) AS `date_returned`,max(if((`pph`.`key` = 'accountabilities-remarks'),`pph`.`key_value`,'')) AS `remarks`,max(if((`pph`.`key` = 'accountabilities-attachment'),`pph`.`key_value`,'')) AS `photo` from (`ww_partners_personal_history` `pph` join `ww_partners` `p`) where ((`pph`.`partner_id` = `p`.`partner_id`) and (`pph`.`key` like 'accountabilities%')) group by `p`.`partner_id`,`pph`.`sequence`) */;

/*View structure for view partners_report */

/*!50001 DROP TABLE IF EXISTS `partners_report` */;
/*!50001 DROP VIEW IF EXISTS `partners_report` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `partners_report` AS (select `t0`.`user_id` AS `user_id`,`t1`.`id_number` AS `id_number`,`t2`.`full_name` AS `full_name`,`t0`.`company_id` AS `company_id`,format(aes_decrypt(`t0`.`salary`,`encryption_key`()),2) AS `salary`,`t0`.`sss_no` AS `sss_no`,`t0`.`phic_no` AS `phic_no`,`t0`.`hdmf_no` AS `hdmf_no`,`t1`.`resigned_date` AS `resigned_date`,`t2`.`email` AS `email`,year(`t1`.`effectivity_date`) AS `year`,month(`t1`.`effectivity_date`) AS `month`,`t1`.`effectivity_date` AS `effectivity_date`,`t3`.`company` AS `company`,`t3`.`sss` AS `sss`,`t3`.`tin` AS `tin`,`t3`.`phic` AS `phic`,`t3`.`hdmf` AS `hdmf`,`t3`.`address` AS `address`,`t4`.`birth_date` AS `birth_date`,`t4`.`position_id` AS `position_id`,`t5`.`position` AS `position` from (((((`ww_payroll_partners` `t0` left join `ww_partners` `t1` on((`t1`.`user_id` = `t0`.`user_id`))) left join `ww_users` `t2` on((`t2`.`user_id` = `t0`.`user_id`))) left join `ww_users_company` `t3` on((`t3`.`company_id` = `t0`.`company_id`))) left join `ww_users_profile` `t4` on((`t4`.`partner_id` = `t1`.`partner_id`))) left join `ww_users_position` `t5` on((`t5`.`position_id` = `t4`.`position_id`)))) */;

/*View structure for view partners_termination_letter_view */

/*!50001 DROP TABLE IF EXISTS `partners_termination_letter_view` */;
/*!50001 DROP VIEW IF EXISTS `partners_termination_letter_view` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `partners_termination_letter_view` AS (select `u`.`full_name` AS `full_name`,`u`.`user_id` AS `user_id`,`upos`.`position` AS `position`,`up`.`company_id` AS `company_id`,`up`.`company` AS `company`,`up`.`project_id` AS `project_id`,`uproj`.`project` AS `project`,`up`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`up`.`end_date` AS `end_date` from (((((`ww_users` `u` left join `ww_users_profile` `up` on((`u`.`user_id` = `up`.`user_id`))) left join `ww_users_position` `upos` on((`up`.`position_id` = `upos`.`position_id`))) left join `ww_partners` `p` on((`p`.`user_id` = `u`.`user_id`))) left join `ww_users_department` `ud` on((`ud`.`department_id` = `up`.`department_id`))) left join `ww_users_project` `uproj` on((`uproj`.`project_id` = `up`.`project_id`))) where (`u`.`active` = 1)) */;

/*View structure for view payroll_1601c */

/*!50001 DROP TABLE IF EXISTS `payroll_1601c` */;
/*!50001 DROP VIEW IF EXISTS `payroll_1601c` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_1601c` AS (select `pct`.`company_id` AS `company_id`,`uc`.`company` AS `company`,year(`pct`.`payroll_date`) AS `year`,month(`pct`.`payroll_date`) AS `month`,`uc`.`address` AS `address`,`uc`.`vat` AS `tin`,`uc`.`rdo` AS `rdo`,`ucc`.`contact_no` AS `contact_no`,`uc`.`zipcode` AS `zipcode`,'Business' AS `line_business`,round(sum((((case when ((`pt`.`transaction_type_id` in (2,6,7,8)) and (`ptc`.`transaction_class_code` <> 'BONUS_TAXABLE')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())) + ((case when ((`pt`.`transaction_type_id` = 5) and (`ptc`.`government_mandated` = 1)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))),2) AS `other_nontax_compensation`,round(sum((((case when (`pt`.`transaction_type_id` in (1,2,6,7,8)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())) - ((case when ((`pt`.`transaction_type_id` = 5) and (`ptc`.`government_mandated` = 0)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))),2) AS `total_compensation`,round(sum(((case when (`ptc`.`transaction_class_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `wtax`,round(sum(((case when ((`ptc`.`transaction_class_code` = 'SALARY') and (`pct`.`minwageflag` = 1)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `statutory_minimum`,round(sum(((case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`minwageflag` = 1)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `overtime` from (((((`ww_payroll_closed_transaction` `pct` left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_payroll_transaction_type` `ptt` on((`ptt`.`transaction_type_id` = `pt`.`transaction_type_id`))) left join `ww_users_company` `uc` on((`pct`.`company_id` = `uc`.`company_id`))) left join `ww_users_company_contact` `ucc` on(((`uc`.`company_id` = `ucc`.`company_id`) and (`ucc`.`contact_type` = 'Phone') and (`ucc`.`deleted` = 0)))) where ((`pct`.`deleted` = 0) and (`pt`.`deleted` = 0)) group by `pct`.`company_id`,year(`pct`.`payroll_date`),month(`pct`.`payroll_date`)) */;

/*View structure for view payroll_1604cf_7_1 */

/*!50001 DROP TABLE IF EXISTS `payroll_1604cf_7_1` */;
/*!50001 DROP VIEW IF EXISTS `payroll_1604cf_7_1` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_1604cf_7_1` AS select `pb`.`user_id` AS `user_id`,`pb`.`pay_year` AS `year`,`pb`.`company_id` AS `company_id`,`uc`.`company` AS `company`,'D7.1' AS `schedule_num`,'1604CF' AS `ftype_code`,`uc`.`vat` AS `comp_tin`,'0000' AS `branch_code_employer`,now() AS `return_period`,'' AS `seq_num`,`pb`.`tin` AS `emp_tin`,'0000' AS `branch_code_employees`,`pb`.`lastname` AS `lastname`,`pb`.`firstname` AS `firstname`,`pb`.`middlename` AS `middlename`,`pb`.`employed_date` AS `employment_from`,ifnull(`pb`.`resigned_date`,now()) AS `employment_to`,`pb`.`gross_compensation` AS `gross_compensation`,`pb`.`bonus_nontax` AS `pres_nontax_13th_month`,`pb`.`min_deminimis` AS `pres_nontax_de_minimis`,`pb`.`govt_contri` AS `pres_nontax_sss_etc`,`pb`.`benefit` AS `pres_nontax_salaries`,`pb`.`total_non_tax` AS `total_nontax_comp_income`,`pb`.`tax_basic` AS `pres_taxable_basic_salary`,`pb`.`bonus_tax` AS `pres_taxable_13th_month`,(ifnull(`pb`.`tempo_allowance`,0) + ifnull(`pb`.`service_allowance`,0)) AS `pres_taxable_salaries`,`pb`.`total_taxable` AS `total_taxable_comp_income`,`pb`.`exempt_code` AS `exmpn_code`,`pb`.`exempt` AS `exmpn_amt`,0.00 AS `premium_paid`,`pb`.`net_taxable` AS `net_table_comp_income`,`pb`.`taxdue` AS `tax_due`,`pb`.`wtax` AS `pres_tax_wthld`,0.00 AS `amt_wthld_dec`,0.00 AS `over_wthld`,((ifnull(`pb`.`taxdue`,0) - ifnull(`pb`.`wtax`,0)) - ifnull(`pb`.`prev_wtax`,0)) AS `actual_amt_wthld`,'N' AS `subs_filing`,`pb`.`resigned_date` AS `resigned_date` from (`ww_payroll_bir` `pb` join `ww_users_company` `uc` on(((`pb`.`company_id` = `uc`.`company_id`) and (`pb`.`resigned_date` <> '0000-00-00')))) */;

/*View structure for view payroll_1604cf_7_3 */

/*!50001 DROP TABLE IF EXISTS `payroll_1604cf_7_3` */;
/*!50001 DROP VIEW IF EXISTS `payroll_1604cf_7_3` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_1604cf_7_3` AS select `pb`.`user_id` AS `user_id`,`pb`.`pay_year` AS `year`,`pb`.`company_id` AS `company_id`,`uc`.`company` AS `company`,'D7.3' AS `schedule_num`,'1604CF' AS `ftype_code`,`uc`.`vat` AS `comp_tin`,'0000' AS `branch_code_employer`,now() AS `return_period`,'' AS `seq_num`,`pb`.`tin` AS `emp_tin`,'0000' AS `branch_code_employees`,`pb`.`lastname` AS `lastname`,`pb`.`firstname` AS `firstname`,`pb`.`middlename` AS `middlename`,`pb`.`employed_date` AS `employment_from`,ifnull(`pb`.`resigned_date`,now()) AS `employment_to`,`pb`.`gross_compensation` AS `gross_compensation`,`pb`.`bonus_nontax` AS `pres_nontax_13th_month`,`pb`.`min_deminimis` AS `pres_nontax_de_minimis`,`pb`.`govt_contri` AS `pres_nontax_sss_etc`,`pb`.`benefit` AS `pres_nontax_salaries`,`pb`.`total_non_tax` AS `total_nontax_comp_income`,`pb`.`tax_basic` AS `pres_taxable_basic_salary`,`pb`.`bonus_tax` AS `pres_taxable_13th_month`,(ifnull(`pb`.`tempo_allowance`,0) + ifnull(`pb`.`service_allowance`,0)) AS `pres_taxable_salaries`,`pb`.`total_taxable` AS `total_taxable_comp_income`,`pb`.`exempt_code` AS `exmpn_code`,`pb`.`exempt` AS `exmpn_amt`,0.00 AS `premium_paid`,`pb`.`net_taxable` AS `net_table_comp_income`,`pb`.`taxdue` AS `tax_due`,`pb`.`wtax` AS `pres_tax_wthld`,0.00 AS `amt_wthld_dec`,0.00 AS `over_wthld`,((ifnull(`pb`.`taxdue`,0) - ifnull(`pb`.`wtax`,0)) - ifnull(`pb`.`prev_wtax`,0)) AS `actual_amt_wthld`,'Y' AS `subs_filing`,`pb`.`resigned_date` AS `resigned_date` from (`ww_payroll_bir` `pb` join `ww_users_company` `uc` on(((`pb`.`company_id` = `uc`.`company_id`) and (`pb`.`resigned_date` = '0000-00-00') and (`pb`.`prev_employer` = '')))) */;

/*View structure for view payroll_1604cf_7_4 */

/*!50001 DROP TABLE IF EXISTS `payroll_1604cf_7_4` */;
/*!50001 DROP VIEW IF EXISTS `payroll_1604cf_7_4` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_1604cf_7_4` AS select `pb`.`user_id` AS `user_id`,`pb`.`pay_year` AS `year`,`pb`.`company_id` AS `company_id`,`uc`.`company` AS `company`,'D7.4' AS `schedule_num`,'1604CF' AS `ftype_code`,`uc`.`vat` AS `comp_tin`,'0000' AS `branch_code_employer`,now() AS `return_period`,'' AS `seq_num`,`pb`.`tin` AS `emp_tin`,'0000' AS `branch_code_employees`,`pb`.`lastname` AS `lastname`,`pb`.`firstname` AS `firstname`,`pb`.`middlename` AS `middlename`,`pb`.`employed_date` AS `employment_from`,ifnull(`pb`.`resigned_date`,now()) AS `employment_to`,`pb`.`gross_compensation` AS `gross_compensation`,`prev`.`prev_nontax_thirten_month` AS `prev_nontax_13th_month`,`prev`.`prev_nontax_deminimis` AS `prev_nontax_de_minimis`,`prev`.`prev_nontax_sss_etc` AS `prev_nontax_sss_etc`,`prev`.`prev_nontax_salaries` AS `prev_nontax_salaries`,`prev`.`prev_nontax_comp_income` AS `prev_total_nontax_comp_income`,`prev`.`prev_taxable_basic_salary` AS `prev_taxable_basic_salary`,`prev`.`prev_taxable_thirten_month` AS `prev_taxable_13th_month`,`prev`.`prev_taxable_salaries` AS `prev_taxable_salaries`,`prev`.`prev_total_taxable` AS `prev_total_taxable`,`pb`.`bonus_nontax` AS `pres_nontax_13th_month`,`pb`.`min_deminimis` AS `pres_nontax_de_minimis`,`pb`.`govt_contri` AS `pres_nontax_sss_etc`,`pb`.`benefit` AS `pres_nontax_salaries`,`pb`.`total_non_tax` AS `total_nontax_comp_income`,`pb`.`tax_basic` AS `pres_taxable_basic_salary`,`pb`.`bonus_tax` AS `pres_taxable_13th_month`,(ifnull(`pb`.`tempo_allowance`,0) + ifnull(`pb`.`service_allowance`,0)) AS `pres_taxable_salaries`,`pb`.`gross_compensation` AS `pres_total_comp`,`pb`.`total_taxable` AS `total_taxable_comp_income`,`pb`.`exempt_code` AS `exmpn_code`,`pb`.`exempt` AS `exmpn_amt`,0.00 AS `premium_paid`,`pb`.`net_taxable` AS `net_table_comp_income`,`pb`.`taxdue` AS `tax_due`,`pb`.`wtax` AS `pres_tax_wthld`,`prev`.`prev_tax_w_held` AS `prev_tax_wthld`,0.00 AS `amt_wthld_dec`,0.00 AS `over_wthld`,((ifnull(`pb`.`taxdue`,0) - ifnull(`pb`.`wtax`,0)) - ifnull(`pb`.`prev_wtax`,0)) AS `actual_amt_wthld`,'Y' AS `subs_filing`,`pb`.`resigned_date` AS `resigned_date` from ((`ww_payroll_bir` `pb` join `ww_payroll_partners_previous_employer` `prev` on((`pb`.`user_id` = `prev`.`user_id`))) join `ww_users_company` `uc` on((`pb`.`company_id` = `uc`.`company_id`))) */;

/*View structure for view payroll_1604cf_7_5 */

/*!50001 DROP TABLE IF EXISTS `payroll_1604cf_7_5` */;
/*!50001 DROP VIEW IF EXISTS `payroll_1604cf_7_5` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_1604cf_7_5` AS select `pb`.`user_id` AS `user_id`,`pb`.`pay_year` AS `year`,`pb`.`company_id` AS `company_id`,`uc`.`company` AS `company`,'D7.1' AS `schedule_num`,'1604CF' AS `ftype_code`,`uc`.`vat` AS `comp_tin`,'0000' AS `branch_code_employer`,now() AS `return_period`,'' AS `seq_num`,`pb`.`tin` AS `emp_tin`,'0000' AS `branch_code_employees`,`pb`.`lastname` AS `lastname`,`pb`.`firstname` AS `firstname`,`pb`.`middlename` AS `middlename`,`pb`.`employed_date` AS `employment_from`,ifnull(`pb`.`resigned_date`,now()) AS `employment_to`,`pb`.`gross_compensation` AS `gross_compensation`,`pb`.`bonus_nontax` AS `pres_nontax_13th_month`,`pb`.`min_deminimis` AS `pres_nontax_de_minimis`,`pb`.`govt_contri` AS `pres_nontax_sss_etc`,`pb`.`benefit` AS `pres_nontax_salaries`,`pb`.`total_non_tax` AS `total_nontax_comp_income`,`pb`.`tax_basic` AS `pres_taxable_basic_salary`,`pb`.`bonus_tax` AS `pres_taxable_13th_month`,(ifnull(`pb`.`tempo_allowance`,0) + ifnull(`pb`.`service_allowance`,0)) AS `pres_taxable_salaries`,`pb`.`total_taxable` AS `total_taxable_comp_income`,`pb`.`exempt_code` AS `exmpn_code`,`pb`.`exempt` AS `exmpn_amt`,0.00 AS `premium_paid`,`pb`.`net_taxable` AS `net_table_comp_income`,`pb`.`taxdue` AS `tax_due`,`pb`.`wtax` AS `pres_tax_wthld`,0.00 AS `amt_wthld_dec`,0.00 AS `over_wthld`,((ifnull(`pb`.`taxdue`,0) - ifnull(`pb`.`wtax`,0)) - ifnull(`pb`.`prev_wtax`,0)) AS `actual_amt_wthld`,'Y' AS `subs_filing`,`pb`.`resigned_date` AS `resigned_date` from (`ww_payroll_bir` `pb` join `ww_users_company` `uc` on(((`pb`.`company_id` = `uc`.`company_id`) and (`pb`.`resigned_date` <> '0000-00-00')))) */;

/*View structure for view payroll_account_report */

/*!50001 DROP TABLE IF EXISTS `payroll_account_report` */;
/*!50001 DROP VIEW IF EXISTS `payroll_account_report` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_account_report` AS select if((`pas`.`account_sub_code` <> NULL),convert(`pa`.`account_code` using utf8),`pas`.`account_sub_code`) AS `account_code`,if((`pas`.`account_sub` <> NULL),convert(`pa`.`account_name` using utf8),`pas`.`account_sub`) AS `account_name`,`pat`.`account_type` AS `account_type` from ((`ww_payroll_account` `pa` join `ww_payroll_account_sub` `pas` on((`pa`.`account_id` = `pas`.`account_id`))) join `ww_payroll_account_type` `pat` on((`pa`.`account_type_id` = `pat`.`account_type_id`))) */;

/*View structure for view payroll_alpha_breakdown */

/*!50001 DROP TABLE IF EXISTS `payroll_alpha_breakdown` */;
/*!50001 DROP VIEW IF EXISTS `payroll_alpha_breakdown` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_alpha_breakdown` AS select `u`.`full_name` AS `full_name`,year(`pct`.`payroll_date`) AS `year`,`pct`.`payroll_date` AS `payroll_date`,(ifnull(`get_paydate_tax_basic`(`pct`.`payroll_date`,`pct`.`employee_id`),0.00) - ((ifnull(`get_paydate_sss`(`pct`.`payroll_date`,`pct`.`employee_id`),0.00) + ifnull(`get_paydate_hdmf`(`pct`.`payroll_date`,`pct`.`employee_id`),0.00)) + ifnull(`get_paydate_phic`(`pct`.`payroll_date`,`pct`.`employee_id`),0.00))) AS `tax_basic`,ifnull(`get_paydate_tax_income`(`pct`.`payroll_date`,`pct`.`employee_id`),0.00) AS `tax_income`,ifnull(`get_paydate_tax_basic_min`(`pct`.`payroll_date`,`pct`.`employee_id`),0.00) AS `min_basic`,ifnull(`get_paydate_nontax_income`(`pct`.`payroll_date`,`pct`.`employee_id`),0.00) AS `min_income`,ifnull(`get_paydate_bonus`(`pct`.`payroll_date`,`pct`.`employee_id`),0.00) AS `bonus`,ifnull(`get_paydate_deminimis`(`pct`.`payroll_date`,`pct`.`employee_id`),0.00) AS `deminimis`,ifnull(`get_paydate_wtax`(`pct`.`payroll_date`,`pct`.`employee_id`),0.00) AS `wtax`,ifnull(`get_paydate_sss`(`pct`.`payroll_date`,`pct`.`employee_id`),0.00) AS `sss`,ifnull(`get_paydate_hdmf`(`pct`.`payroll_date`,`pct`.`employee_id`),0.00) AS `hdmf`,ifnull(`get_paydate_phic`(`pct`.`payroll_date`,`pct`.`employee_id`),0.00) AS `phic`,((ifnull(`get_paydate_sss`(`pct`.`payroll_date`,`pct`.`employee_id`),0.00) + ifnull(`get_paydate_hdmf`(`pct`.`payroll_date`,`pct`.`employee_id`),0.00)) + ifnull(`get_paydate_phic`(`pct`.`payroll_date`,`pct`.`employee_id`),0.00)) AS `tot_contri`,`u`.`user_id` AS `employee`,`pct`.`company_id` AS `company` from ((`ww_payroll_closed_transaction` `pct` left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) where ((`pct`.`deleted` = 0) and (`pt`.`deleted` = 0) and (`u`.`deleted` = 0)) group by `pct`.`payroll_date`,`pct`.`employee_id` */;

/*View structure for view payroll_alpha_minimum_wage_earner */

/*!50001 DROP TABLE IF EXISTS `payroll_alpha_minimum_wage_earner` */;
/*!50001 DROP VIEW IF EXISTS `payroll_alpha_minimum_wage_earner` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_alpha_minimum_wage_earner` AS select ifnull(`ww_payroll_bir`.`tin`,'') AS `tin`,concat(`ww_payroll_bir`.`lastname`,if(((`ww_payroll_bir`.`suffix` <> NULL) or (`ww_payroll_bir`.`suffix` <> '')),concat(' ',`ww_payroll_bir`.`suffix`),''),', ',`ww_payroll_bir`.`firstname`,' ',`ww_payroll_bir`.`middlename`) AS `employee_name`,`ww_payroll_bir`.`location` AS `location`,`ww_payroll_bir`.`employed_date` AS `hired_date`,if(((`ww_payroll_bir`.`resigned_date` = '0000-00-00') or isnull(`ww_payroll_bir`.`resigned_date`)),concat(`ww_payroll_bir`.`pay_year`,'-12-31'),`ww_payroll_bir`.`resigned_date`) AS `resigned_date`,`ww_payroll_bir`.`minwage_day` AS `minwage_day`,`ww_payroll_bir`.`minwage_month` AS `minwage_month`,`ww_payroll_bir`.`total_year_days` AS `total_year_days`,0.00 AS `col_5a`,((((((((`ww_payroll_bir`.`min_basic` + `ww_payroll_bir`.`min_holpay`) + `ww_payroll_bir`.`min_overtime`) + `ww_payroll_bir`.`min_ndiff`) + `ww_payroll_bir`.`min_hazardpay`) + `ww_payroll_bir`.`bonus_nontax`) + `ww_payroll_bir`.`min_deminimis`) + `ww_payroll_bir`.`govt_contri`) + `ww_payroll_bir`.`benefit`) AS `col_5q`,0.00 AS `col_5b`,`ww_payroll_bir`.`min_basic` AS `col_5t`,0.00 AS `col_5c`,`ww_payroll_bir`.`min_holpay` AS `col_5v`,0.00 AS `col_5d`,`ww_payroll_bir`.`min_overtime` AS `col_5w`,0.00 AS `col_5e`,`ww_payroll_bir`.`min_ndiff` AS `col_5x`,0.00 AS `col_5f`,`ww_payroll_bir`.`min_hazardpay` AS `col_5y`,0.00 AS `col_5g`,`ww_payroll_bir`.`bonus_nontax` AS `col_5z`,0.00 AS `col_5h`,`ww_payroll_bir`.`min_deminimis` AS `col_5aa`,0.00 AS `col_5i`,`ww_payroll_bir`.`govt_contri` AS `col_5ab`,0.00 AS `col_5j`,`ww_payroll_bir`.`benefit` AS `col_5ac`,((((((((`ww_payroll_bir`.`min_basic` + `ww_payroll_bir`.`min_holpay`) + `ww_payroll_bir`.`min_overtime`) + `ww_payroll_bir`.`min_ndiff`) + `ww_payroll_bir`.`min_hazardpay`) + `ww_payroll_bir`.`bonus_nontax`) + `ww_payroll_bir`.`min_deminimis`) + `ww_payroll_bir`.`govt_contri`) + `ww_payroll_bir`.`benefit`) AS `col_5k`,0.00 AS `col_5l`,0.00 AS `col_5ad`,0.00 AS `col_5m`,0.00 AS `col_5ae`,0.00 AS `col_5n`,0.00 AS `col_5af`,0.00 AS `col_5ag`,`ww_payroll_bir`.`exempt_code` AS `exempt_code`,`ww_payroll_bir`.`exempt` AS `exempt_amount`,0.00 AS `premium`,0.00 AS `net_taxable`,`ww_payroll_bir`.`taxdue` AS `taxdue`,`ww_payroll_bir`.`wtax` AS `wtax`,if((`ww_payroll_bir`.`taxdue` > `ww_payroll_bir`.`wtax`),(`ww_payroll_bir`.`taxdue` - `ww_payroll_bir`.`wtax`),0) AS `payable`,if((`ww_payroll_bir`.`wtax` > `ww_payroll_bir`.`taxdue`),(`ww_payroll_bir`.`wtax` - `ww_payroll_bir`.`taxdue`),0) AS `refund`,`ww_payroll_bir`.`taxdue` AS `total_tax`,`ww_payroll_bir`.`sub_filing` AS `sub_filing`,`ww_payroll_bir`.`company_id` AS `company`,`ww_users_company`.`company` AS `company_name`,`ww_users_company`.`address` AS `company_address`,`ww_payroll_bir`.`user_id` AS `employee`,`ww_payroll_bir`.`pay_year` AS `pay_year` from (`ww_payroll_bir` left join `ww_users_company` on((`ww_payroll_bir`.`company_id` = `ww_users_company`.`company_id`))) where ((`ww_payroll_bir`.`deleted` = 0) and (`ww_payroll_bir`.`minwageflag` = 1) and (year(`ww_payroll_bir`.`resigned_date`) < `ww_payroll_bir`.`pay_year`)) */;

/*View structure for view payroll_alpha_terminated */

/*!50001 DROP TABLE IF EXISTS `payroll_alpha_terminated` */;
/*!50001 DROP VIEW IF EXISTS `payroll_alpha_terminated` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_alpha_terminated` AS select ifnull(`ww_payroll_bir`.`tin`,'') AS `tin`,concat(`ww_payroll_bir`.`lastname`,if(((`ww_payroll_bir`.`suffix` <> NULL) or (`ww_payroll_bir`.`suffix` <> '')),concat(' ',`ww_payroll_bir`.`suffix`),''),', ',`ww_payroll_bir`.`firstname`,' ',`ww_payroll_bir`.`middlename`) AS `employee_name`,`ww_payroll_bir`.`employed_date` AS `hired_date`,`ww_payroll_bir`.`resigned_date` AS `resigned_date`,`ww_payroll_bir`.`gross_compensation` AS `col_4a`,`ww_payroll_bir`.`bonus_nontax` AS `col_4b`,`ww_payroll_bir`.`min_deminimis` AS `col_4c`,`ww_payroll_bir`.`govt_contri` AS `col_4d`,`ww_payroll_bir`.`benefit` AS `col_4e`,`ww_payroll_bir`.`total_non_tax` AS `col_4f`,`ww_payroll_bir`.`tax_basic` AS `col_4g`,`ww_payroll_bir`.`bonus_tax` AS `col_4h`,(((((((((`ww_payroll_bir`.`tax_overtime` + `ww_payroll_bir`.`allow`) + `ww_payroll_bir`.`representation`) + `ww_payroll_bir`.`transportation`) + `ww_payroll_bir`.`cost_living`) + `ww_payroll_bir`.`fixed_housing`) + `ww_payroll_bir`.`commission`) + `ww_payroll_bir`.`profit_sharing`) + `ww_payroll_bir`.`fees`) + `ww_payroll_bir`.`tax_hazardpay`) AS `col_4i`,`ww_payroll_bir`.`total_taxable` AS `col_4j`,`ww_payroll_bir`.`exempt_code` AS `exempt_code`,`ww_payroll_bir`.`exempt` AS `exempt_amount`,`ww_payroll_bir`.`net_taxable` AS `net_taxable`,`ww_payroll_bir`.`taxdue` AS `taxdue`,`ww_payroll_bir`.`wtax` AS `wtax`,if((`ww_payroll_bir`.`taxdue` > `ww_payroll_bir`.`wtax`),(`ww_payroll_bir`.`taxdue` - `ww_payroll_bir`.`wtax`),0) AS `payable`,if((`ww_payroll_bir`.`wtax` > `ww_payroll_bir`.`taxdue`),(`ww_payroll_bir`.`wtax` - `ww_payroll_bir`.`taxdue`),0) AS `refund`,`ww_payroll_bir`.`taxdue` AS `total_tax`,`ww_payroll_bir`.`sub_filing` AS `sub_filing`,`ww_payroll_bir`.`company_id` AS `company`,`ww_users_company`.`company` AS `company_name`,`ww_users_company`.`address` AS `company_address`,`ww_payroll_bir`.`user_id` AS `employee`,`ww_payroll_bir`.`pay_year` AS `pay_year` from (`ww_payroll_bir` left join `ww_users_company` on((`ww_payroll_bir`.`company_id` = `ww_users_company`.`company_id`))) where ((`ww_payroll_bir`.`deleted` = 0) and (`ww_payroll_bir`.`minwageflag` = 0) and (`ww_payroll_bir`.`resigned_date` is not null) and (year(`ww_payroll_bir`.`resigned_date`) = `ww_payroll_bir`.`pay_year`)) */;

/*View structure for view payroll_alpha_without_previous */

/*!50001 DROP TABLE IF EXISTS `payroll_alpha_without_previous` */;
/*!50001 DROP VIEW IF EXISTS `payroll_alpha_without_previous` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_alpha_without_previous` AS select ifnull(`ww_payroll_bir`.`tin`,'') AS `tin`,concat(`ww_payroll_bir`.`lastname`,if(((`ww_payroll_bir`.`suffix` <> NULL) or (`ww_payroll_bir`.`suffix` <> '')),concat(' ',`ww_payroll_bir`.`suffix`),''),', ',`ww_payroll_bir`.`firstname`,' ',`ww_payroll_bir`.`middlename`) AS `employee_name`,`ww_payroll_bir`.`employed_date` AS `hired_date`,if(((`ww_payroll_bir`.`resigned_date` = '0000-00-00') or isnull(`ww_payroll_bir`.`resigned_date`)),concat(`ww_payroll_bir`.`pay_year`,'-12-31'),`ww_payroll_bir`.`resigned_date`) AS `resigned_date`,`ww_payroll_bir`.`gross_compensation` AS `col_4a`,`ww_payroll_bir`.`bonus_nontax` AS `col_4b`,`ww_payroll_bir`.`min_deminimis` AS `col_4c`,`ww_payroll_bir`.`govt_contri` AS `col_4d`,`ww_payroll_bir`.`benefit` AS `col_4e`,`ww_payroll_bir`.`total_non_tax` AS `col_4f`,`ww_payroll_bir`.`tax_basic` AS `col_4g`,`ww_payroll_bir`.`bonus_tax` AS `col_4h`,(((((((((`ww_payroll_bir`.`tax_overtime` + `ww_payroll_bir`.`allow`) + `ww_payroll_bir`.`representation`) + `ww_payroll_bir`.`transportation`) + `ww_payroll_bir`.`cost_living`) + `ww_payroll_bir`.`fixed_housing`) + `ww_payroll_bir`.`commission`) + `ww_payroll_bir`.`profit_sharing`) + `ww_payroll_bir`.`fees`) + `ww_payroll_bir`.`tax_hazardpay`) AS `col_4i`,`ww_payroll_bir`.`total_taxable` AS `col_4j`,`ww_payroll_bir`.`exempt_code` AS `exempt_code`,`ww_payroll_bir`.`exempt` AS `exempt_amount`,`ww_payroll_bir`.`net_taxable` AS `net_taxable`,`ww_payroll_bir`.`taxdue` AS `taxdue`,`ww_payroll_bir`.`wtax` AS `wtax`,if((`ww_payroll_bir`.`taxdue` > `ww_payroll_bir`.`wtax`),(`ww_payroll_bir`.`taxdue` - `ww_payroll_bir`.`wtax`),0) AS `payable`,if((`ww_payroll_bir`.`wtax` > `ww_payroll_bir`.`taxdue`),(`ww_payroll_bir`.`wtax` - `ww_payroll_bir`.`taxdue`),0) AS `refund`,`ww_payroll_bir`.`taxdue` AS `total_tax`,`ww_payroll_bir`.`sub_filing` AS `sub_filing`,`ww_payroll_bir`.`company_id` AS `company`,`ww_users_company`.`company` AS `company_name`,`ww_users_company`.`address` AS `company_address`,`ww_payroll_bir`.`user_id` AS `employee`,`ww_payroll_bir`.`pay_year` AS `pay_year` from (`ww_payroll_bir` left join `ww_users_company` on((`ww_payroll_bir`.`company_id` = `ww_users_company`.`company_id`))) where ((`ww_payroll_bir`.`deleted` = 0) and (`ww_payroll_bir`.`minwageflag` = 0) and (year(`ww_payroll_bir`.`resigned_date`) < `ww_payroll_bir`.`pay_year`)) */;

/*View structure for view payroll_atm_register */

/*!50001 DROP TABLE IF EXISTS `payroll_atm_register` */;
/*!50001 DROP VIEW IF EXISTS `payroll_atm_register` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_atm_register` AS select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`pp`.`bank_id` AS `bank_id`,`pp`.`bank_account` AS `bank_account`,`pp`.`payout_schedule` AS `payout_schedule`,`pp`.`whole_half` AS `payout_scheme`,`set_2_decimal`(if((`pp`.`whole_half` = 0),aes_decrypt(`pct`.`amount`,`encryption_key`()),(aes_decrypt(`pct`.`amount`,`encryption_key`()) / if((`t`.`bonus_tag` = 1),1,2)))) AS `amount`,`u`.`full_name` AS `full_name`,`c`.`company` AS `company`,`pp`.`company_id` AS `company_id`,`up`.`department_id` AS `department_id`,`d`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`pct`.`transaction_code` AS `transaction_code`,`pct`.`payroll_date` AS `payroll_date`,`t`.`date_from` AS `date_from`,`t`.`date_to` AS `date_to`,'PRELIMINARY' AS `record_reference`,`c`.`address` AS `address`,`t`.`posting_date` AS `posting_date`,`pb`.`account_no` AS `account_no`,`pb`.`batch_no` AS `batch_no`,`pb`.`bank_code_numeric` AS `bank_code_numeric`,`pb`.`bank_code_alpha` AS `bank_code_alpha`,'tmp' AS `schedule`,'tmp1' AS `bank_posting_date` from (((((((((`ww_payroll_current_transaction` `pct` join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) join `ww_partners` `p` on((`p`.`user_id` = `pct`.`employee_id`))) left join `ww_payroll_partners` `pp` on((`pct`.`employee_id` = `pp`.`user_id`))) left join `ww_users_department` `d` on((`up`.`department_id` = `d`.`department_id`))) left join `ww_users_branch` `b` on((`up`.`branch_id` = `b`.`branch_id`))) left join `ww_payroll_period` `t` on((`t`.`payroll_period_id` = `pct`.`period_id`))) left join `ww_users_company` `c` on((`c`.`company_id` = `pp`.`company_id`))) left join `ww_payroll_bank` `pb` on((`pb`.`bank_id` = `pp`.`bank_id`))) where ((`pct`.`deleted` = 0) and (`pct`.`on_hold` = 0) and (`pp`.`on_hold` = 0) and (`u`.`active` = 1) and (`pp`.`bank_account` <> '') and (`pp`.`bank_account` <> 0) and (`pct`.`transaction_code` = 'NETPAY')) union select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`pp`.`bank_id` AS `bank_id`,`pp`.`bank_account` AS `bank_account`,`pp`.`payout_schedule` AS `payout_schedule`,`pp`.`whole_half` AS `payout_scheme`,`set_2_decimal`(if((`pp`.`whole_half` = 0),aes_decrypt(`pct`.`amount`,`encryption_key`()),(aes_decrypt(`pct`.`amount`,`encryption_key`()) / if((`t`.`bonus_tag` = 1),1,2)))) AS `amount`,`u`.`full_name` AS `full_name`,`c`.`company` AS `company`,`pp`.`company_id` AS `company_id`,`up`.`department_id` AS `department_id`,`d`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`pct`.`transaction_code` AS `transaction_code`,`pct`.`payroll_date` AS `payroll_date`,`t`.`date_from` AS `date_from`,`t`.`date_to` AS `date_to`,'HISTORICAL' AS `record_reference`,`c`.`address` AS `address`,`t`.`posting_date` AS `posting_date`,`pb`.`account_no` AS `account_no`,`pb`.`batch_no` AS `batch_no`,`pb`.`bank_code_numeric` AS `bank_code_numeric`,`pb`.`bank_code_alpha` AS `bank_code_alpha`,'tmp' AS `schedule`,'tmp1' AS `bank_posting_date` from (((((((((`ww_payroll_closed_transaction` `pct` join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) join `ww_partners` `p` on((`p`.`user_id` = `pct`.`employee_id`))) left join `ww_payroll_partners` `pp` on((`pct`.`employee_id` = `pp`.`user_id`))) left join `ww_users_department` `d` on((`up`.`department_id` = `d`.`department_id`))) left join `ww_users_branch` `b` on((`up`.`branch_id` = `b`.`branch_id`))) left join `ww_payroll_period` `t` on((`t`.`payroll_period_id` = `pct`.`period_id`))) left join `ww_users_company` `c` on((`c`.`company_id` = `pp`.`company_id`))) left join `ww_payroll_bank` `pb` on((`pb`.`bank_id` = `pp`.`bank_id`))) where ((`pct`.`deleted` = 0) and (`pct`.`on_hold` = 0) and (`pp`.`on_hold` = 0) and (`u`.`active` = 1) and (`pp`.`bank_account` <> '') and (`pp`.`bank_account` <> 0) and (`pct`.`transaction_code` = 'NETPAY')) */;

/*View structure for view payroll_attendance_adjustment */

/*!50001 DROP TABLE IF EXISTS `payroll_attendance_adjustment` */;
/*!50001 DROP VIEW IF EXISTS `payroll_attendance_adjustment` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_attendance_adjustment` AS select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`pp`.`company_id` AS `company_id`,`uc`.`company` AS `company`,`up`.`department_id` AS `department_id`,`d`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`uc`.`logo` AS `logo`,`t`.`date` AS `date`,`t`.`payroll_date` AS `payroll_date`,if((ifnull(`t`.`original_payroll_date`,'0000-00-00') = '0000-00-00'),`t`.`payroll_date`,`t`.`original_payroll_date`) AS `original_payroll_date`,`t`.`transaction_id` AS `transaction_id`,`t`.`transaction_code` AS `transaction_code`,`pt`.`transaction_label` AS `transaction_label`,`t`.`quantity` AS `quantity`,(case when (`t`.`latefile` = 1) then 'Adjustment' when ((`t`.`latefile` = 0) and (`t`.`transaction_code` in ('LWOP','ABSENCES','DEDUCTION_LATE','DEDUCTION_UNDERTIME'))) then 'Deduction' when ((`t`.`latefile` = 0) and (`ptc`.`transaction_class_code` = 'OVERTIME')) then 'Overtime' when ((`t`.`latefile` = 0) and (`ptc`.`transaction_class_code` = 'LEAVES')) then 'Leaves' end) AS `type`,(case when (`t`.`latefile` = 1) then 1 when ((`t`.`latefile` = 0) and (`t`.`transaction_code` in ('LWOP','ABSENCES','DEDUCTION_LATE','DEDUCTION_UNDERTIME'))) then 2 when ((`t`.`latefile` = 0) and (`ptc`.`transaction_class_code` = 'OVERTIME')) then 3 when ((`t`.`latefile` = 0) and (`ptc`.`transaction_class_code` = 'LEAVES')) then 4 end) AS `type_id` from (((((((((`ww_time_record_process` `t` join `ww_users_profile` `up` on((`t`.`user_id` = `up`.`user_id`))) join `ww_users_department` `d` on((`up`.`department_id` = `d`.`department_id`))) join `ww_users` `u` on((`t`.`user_id` = `u`.`user_id`))) join `ww_partners` `p` on((`p`.`user_id` = `u`.`user_id`))) join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `u`.`user_id`))) join `ww_users_company` `uc` on((`uc`.`company_id` = `pp`.`company_id`))) left join `ww_users_branch` `b` on((`b`.`branch_id` = `up`.`branch_id`))) left join `ww_payroll_transaction` `pt` on((`pt`.`transaction_id` = `t`.`transaction_id`))) left join `ww_payroll_transaction_class` `ptc` on((`ptc`.`transaction_class_id` = `pt`.`transaction_class_id`))) where (`t`.`deleted` = 0) */;

/*View structure for view payroll_authority_debit */

/*!50001 DROP TABLE IF EXISTS `payroll_authority_debit` */;
/*!50001 DROP VIEW IF EXISTS `payroll_authority_debit` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_authority_debit` AS select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,aes_decrypt(`pct`.`amount`,`encryption_key`()) AS `amount`,`u`.`full_name` AS `full_name`,`c`.`company` AS `company`,`c`.`company_id` AS `company_id`,`up`.`department_id` AS `department_id`,`d`.`department` AS `department`,`pct`.`transaction_code` AS `transaction_code`,`pct`.`payroll_date` AS `payroll_date`,`t`.`date_from` AS `date_from`,`t`.`date_to` AS `date_to`,`c`.`city` AS `city`,`pb`.`bank` AS `bank_name`,`pb`.`account_no` AS `bank_account_no`,`pb`.`address` AS `address1`,`pb`.`address_2` AS `address2`,`pb`.`branch_officer` AS `branch_officer`,`pb`.`branch_position` AS `branch_position`,`pb`.`signatory_1` AS `signatory_1`,`pb`.`signatory_2` AS `signatory_2`,`pb`.`account_name` AS `account_name` from ((((((((`ww_payroll_current_transaction` `pct` left join `ww_payroll_partners` `pp` on((`pct`.`employee_id` = `pp`.`user_id`))) left join `ww_users_company` `c` on((`c`.`company_id` = `pp`.`company_id`))) left join `ww_payroll_bank` `pb` on((`pb`.`bank_id` = `c`.`bank_id`))) left join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) left join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) left join `ww_partners` `p` on((`p`.`user_id` = `pct`.`employee_id`))) left join `ww_users_department` `d` on((`up`.`department_id` = `d`.`department_id`))) left join `ww_payroll_period` `t` on((`t`.`payroll_period_id` = `pct`.`period_id`))) where ((`pct`.`deleted` = 0) and (`pct`.`transaction_code` = 'NETPAY') and (aes_decrypt(`pct`.`amount`,`encryption_key`()) > 0)) union all select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,aes_decrypt(`pct`.`amount`,`encryption_key`()) AS `amount`,`u`.`full_name` AS `full_name`,`c`.`company` AS `company`,`c`.`company_id` AS `company_id`,`up`.`department_id` AS `department_id`,`d`.`department` AS `department`,`pct`.`transaction_code` AS `transaction_code`,`pct`.`payroll_date` AS `payroll_date`,`t`.`date_from` AS `date_from`,`t`.`date_to` AS `date_to`,`c`.`city` AS `city`,`pb`.`bank` AS `bank_name`,`pb`.`account_no` AS `bank_account_no`,`pb`.`address` AS `address1`,`pb`.`address_2` AS `address2`,`pb`.`branch_officer` AS `branch_officer`,`pb`.`branch_position` AS `branch_position`,`pb`.`signatory_1` AS `signatory_1`,`pb`.`signatory_2` AS `signatory_2`,`pb`.`account_name` AS `account_name` from ((((((((`ww_payroll_closed_transaction` `pct` left join `ww_payroll_partners` `pp` on((`pct`.`employee_id` = `pp`.`user_id`))) left join `ww_users_company` `c` on((`c`.`company_id` = `pp`.`company_id`))) left join `ww_payroll_bank` `pb` on((`pb`.`bank_id` = `c`.`bank_id`))) left join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) left join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) left join `ww_partners` `p` on((`p`.`user_id` = `pct`.`employee_id`))) left join `ww_users_department` `d` on((`up`.`department_id` = `d`.`department_id`))) left join `ww_payroll_period` `t` on((`t`.`payroll_period_id` = `pct`.`period_id`))) where ((`pct`.`deleted` = 0) and (`pct`.`transaction_code` = 'NETPAY') and (aes_decrypt(`pct`.`amount`,`encryption_key`()) > 0)) */;

/*View structure for view payroll_bank_details_report */

/*!50001 DROP TABLE IF EXISTS `payroll_bank_details_report` */;
/*!50001 DROP VIEW IF EXISTS `payroll_bank_details_report` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_bank_details_report` AS select `u`.`full_name` AS `account_name`,`par`.`id_number` AS `id_number`,`pp`.`bank_id` AS `bank_id`,`pp`.`bank_account` AS `account_number`,`pp`.`payout_schedule` AS `payout_schedule`,`pp`.`whole_half` AS `payout_scheme`,`pct`.`company_id` AS `company_id`,`uc`.`company` AS `company`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`pct`.`payroll_date` AS `payroll_date`,`pay`.`date_from` AS `date_from`,`pay`.`date_to` AS `date_to`,if((`pp`.`whole_half` = 0),aes_decrypt(`pct`.`amount`,`encryption_key`()),(aes_decrypt(`pct`.`amount`,`encryption_key`()) / if((`pay`.`bonus_tag` = 1),1,2))) AS `amount`,'tmp' AS `schedule`,'tmp1' AS `payroll_date_actuall` from (((((((`ww_payroll_closed_transaction` `pct` left join `ww_users` `u` on((`u`.`user_id` = `pct`.`employee_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) join `ww_users_branch` `b` on((`b`.`branch_id` = `up`.`branch_id`))) left join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `pct`.`employee_id`))) left join `ww_partners` `par` on((`par`.`user_id` = `pct`.`employee_id`))) left join `ww_users_company` `uc` on((`pct`.`company_id` = `uc`.`company_id`))) left join `ww_payroll_period` `pay` on((`pct`.`period_id` = `pay`.`payroll_period_id`))) where ((`pct`.`transaction_code` = 'NETPAY') and (`pct`.`on_hold` = 0) and (`pp`.`on_hold` = 0) and (`u`.`active` = 1) and (`pp`.`bank_account` <> '') and (`pp`.`bank_account` <> 0) and (`pct`.`deleted` = 0)) union all select `u`.`full_name` AS `account_name`,`par`.`id_number` AS `id_number`,`pp`.`bank_id` AS `bank_id`,`pp`.`bank_account` AS `account_number`,`pp`.`payout_schedule` AS `payout_schedule`,`pp`.`whole_half` AS `payout_scheme`,`pct`.`company_id` AS `company_id`,`uc`.`company` AS `company`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`pct`.`payroll_date` AS `payroll_date`,`pay`.`date_from` AS `date_from`,`pay`.`date_to` AS `date_to`,if((`pp`.`whole_half` = 0),aes_decrypt(`pct`.`amount`,`encryption_key`()),(aes_decrypt(`pct`.`amount`,`encryption_key`()) / if((`pay`.`bonus_tag` = 1),1,2))) AS `amount`,'tmp' AS `schedule`,'tmp1' AS `payroll_date_actuall` from (((((((`ww_payroll_current_transaction` `pct` left join `ww_users` `u` on((`u`.`user_id` = `pct`.`employee_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) left join `ww_users_branch` `b` on((`b`.`branch_id` = `up`.`branch_id`))) left join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `pct`.`employee_id`))) left join `ww_partners` `par` on((`par`.`user_id` = `pct`.`employee_id`))) left join `ww_users_company` `uc` on((`pct`.`company_id` = `uc`.`company_id`))) left join `ww_payroll_period` `pay` on((`pct`.`period_id` = `pay`.`payroll_period_id`))) where ((`pct`.`transaction_code` = 'NETPAY') and (`pct`.`on_hold` = 0) and (`pp`.`on_hold` = 0) and (`u`.`active` = 1) and (`pp`.`bank_account` <> '') and (`pp`.`bank_account` <> 0) and (`pct`.`deleted` = 0)) */;

/*View structure for view payroll_bir */

/*!50001 DROP TABLE IF EXISTS `payroll_bir` */;
/*!50001 DROP VIEW IF EXISTS `payroll_bir` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_bir` AS select `pb`.`user_id` AS `user_id`,`pb`.`pay_year` AS `year`,if((year(`pb`.`employed_date`) < `pb`.`pay_year`),'0101',date_format(`pb`.`employed_date`,'%m%d')) AS `month_from`,ifnull(date_format(`pb`.`resigned_date`,'%m%d'),'1231') AS `month_to`,`pb`.`tin` AS `emp_tin`,concat(`pb`.`lastname`,', ',`pb`.`firstname`,if((`pb`.`suffix` <> ''),concat(' ',`pb`.`suffix`,' '),' '),if(((`pb`.`middlename` <> '') and (`pb`.`middlename` is not null)),concat(' ',`pb`.`middlename`,' '),' ')) AS `full_name`,`pb`.`address` AS `emp_address`,`get_zipcode`(`pb`.`user_id`) AS `emp_zipcode`,`pb`.`birth_date` AS `birth_date`,`pb`.`company_id` AS `company_id`,`pb`.`civil_status_id` AS `civil_status_id`,`pb`.`dep_name1` AS `dep_name1`,`pb`.`dep_bday1` AS `dep_bday1`,`pb`.`dep_name2` AS `dep_name2`,`pb`.`dep_bday2` AS `dep_bday2`,`pb`.`dep_name3` AS `dep_name3`,`pb`.`dep_bday3` AS `dep_bday3`,`pb`.`dep_name4` AS `dep_name4`,`pb`.`dep_bday4` AS `dep_bday4`,`pb`.`minwage_day` AS `minwage_day`,`pb`.`minwage_month` AS `minwage_month`,`pb`.`minwageflag` AS `minwageflag`,`uc`.`vat` AS `comp_tin`,`uc`.`company` AS `company`,`uc`.`rdo` AS `rdo`,`uc`.`address` AS `comp_address`,`uc`.`zipcode` AS `comp_zipcode`,`pb`.`prev_tin` AS `prev_tin`,`pb`.`prev_employer` AS `prev_employer`,`pb`.`prev_address` AS `prev_address`,`pb`.`prev_zip` AS `prev_zip`,`pb`.`gross_compensation` AS `item21`,`pb`.`total_non_tax` AS `item22`,`pb`.`total_taxable` AS `item23`,`pb`.`prev_gross_tax` AS `item24`,((ifnull(`pb`.`gross_compensation`,0) + ifnull(`pb`.`prev_gross_tax`,0)) - ifnull(`pb`.`total_non_tax`,0)) AS `item25`,`pb`.`exempt` AS `item26`,0.00 AS `item27`,`pb`.`net_taxable` AS `item28`,`pb`.`taxdue` AS `item29`,`pb`.`wtax` AS `item30A`,`pb`.`prev_wtax` AS `item30B`,((ifnull(`pb`.`taxdue`,0) - ifnull(`pb`.`wtax`,0)) - ifnull(`pb`.`prev_wtax`,0)) AS `item31`,`pb`.`min_basic` AS `item32`,`pb`.`min_holpay` AS `item33`,`pb`.`min_overtime` AS `item34`,`pb`.`min_ndiff` AS `item35`,`pb`.`min_hazardpay` AS `item36`,`pb`.`bonus_nontax` AS `item37`,`pb`.`min_deminimis` AS `item38`,`pb`.`govt_contri` AS `item39`,`pb`.`benefit` AS `item40`,`pb`.`total_non_tax` AS `item41`,`pb`.`tax_basic` AS `item42`,`pb`.`representation` AS `item43`,`pb`.`transportation` AS `item44`,`pb`.`cost_living` AS `item45`,`pb`.`fixed_housing` AS `item46`,'' AS `nitem47A`,`pb`.`tempo_allowance` AS `item47A`,'' AS `nitem47B`,`pb`.`service_allowance` AS `item47B`,`pb`.`commission` AS `item48`,`pb`.`profit_sharing` AS `item49`,`pb`.`tax_basic` AS `item50`,`pb`.`bonus_tax` AS `item51`,`pb`.`tax_hazardpay` AS `item52`,`pb`.`tax_overtime` AS `item53`,'' AS `nitem54A`,'' AS `item54A`,'' AS `nitem54B`,'' AS `item54B`,`pb`.`total_taxable` AS `item55` from (`ww_payroll_bir` `pb` join `ww_users_company` `uc` on((`pb`.`company_id` = `uc`.`company_id`))) */;

/*View structure for view payroll_bonus_basis */

/*!50001 DROP TABLE IF EXISTS `payroll_bonus_basis` */;
/*!50001 DROP VIEW IF EXISTS `payroll_bonus_basis` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_bonus_basis` AS (select `up`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`up`.`lastname` AS `lastname`,`up`.`firstname` AS `firstname`,`up`.`middlename` AS `middlename`,`pct`.`company_id` AS `company_id`,`uc`.`company` AS `company`,`pct`.`department_id` AS `department_id`,`ud`.`department` AS `department`,year(`pct`.`payroll_date`) AS `pay_year`,round(sum(((case when ((month(`pct`.`payroll_date`) = 1) and (`pct`.`transaction_code` = 'SALARY')) then 1 when ((month(`pct`.`payroll_date`) = 1) and (`pct`.`transaction_code` in ('ABSENCES','ABSENCES_ADJ','LWOP','LWOP_ADJ','DEDUCTION_LATE','DEDUCTION_LATE_ADJ','DEDUCTION_UNDERTIME','DEDUCTION_UNDERTIME_ADJ'))) then -(1) else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `jan_reg`,round(sum(((case when ((month(`pct`.`payroll_date`) = 1) and (`pct`.`transaction_code` = 'SALADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `jan_saladj`,round(sum(((case when ((month(`pct`.`payroll_date`) = 1) and (`pct`.`transaction_type_id` = 6)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `jan_deminimis`,round(sum(((case when ((month(`pct`.`payroll_date`) = 2) and (`pct`.`transaction_code` = 'SALARY')) then 1 when ((month(`pct`.`payroll_date`) = 2) and (`pct`.`transaction_code` in ('ABSENCES','ABSENCES_ADJ','LWOP','LWOP_ADJ','DEDUCTION_LATE','DEDUCTION_LATE_ADJ','DEDUCTION_UNDERTIME','DEDUCTION_UNDERTIME_ADJ'))) then -(1) else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `feb_reg`,round(sum(((case when ((month(`pct`.`payroll_date`) = 2) and (`pct`.`transaction_code` = 'SALADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `feb_saladj`,round(sum(((case when ((month(`pct`.`payroll_date`) = 2) and (`pct`.`transaction_type_id` = 6)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `feb_deminimis`,round(sum(((case when ((month(`pct`.`payroll_date`) = 3) and (`pct`.`transaction_code` = 'SALARY')) then 1 when ((month(`pct`.`payroll_date`) = 3) and (`pct`.`transaction_code` in ('ABSENCES','ABSENCES_ADJ','LWOP','LWOP_ADJ','DEDUCTION_LATE','DEDUCTION_LATE_ADJ','DEDUCTION_UNDERTIME','DEDUCTION_UNDERTIME_ADJ'))) then -(1) else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `mar_reg`,round(sum(((case when ((month(`pct`.`payroll_date`) = 3) and (`pct`.`transaction_code` = 'SALADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `mar_saladj`,round(sum(((case when ((month(`pct`.`payroll_date`) = 3) and (`pct`.`transaction_type_id` = 6)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `mar_deminimis`,round(sum(((case when ((month(`pct`.`payroll_date`) = 4) and (`pct`.`transaction_code` = 'SALARY')) then 1 when ((month(`pct`.`payroll_date`) = 4) and (`pct`.`transaction_code` in ('ABSENCES','ABSENCES_ADJ','LWOP','LWOP_ADJ','DEDUCTION_LATE','DEDUCTION_LATE_ADJ','DEDUCTION_UNDERTIME','DEDUCTION_UNDERTIME_ADJ'))) then -(1) else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `apr_reg`,round(sum(((case when ((month(`pct`.`payroll_date`) = 4) and (`pct`.`transaction_code` = 'SALADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `apr_saladj`,round(sum(((case when ((month(`pct`.`payroll_date`) = 4) and (`pct`.`transaction_type_id` = 6)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `apr_deminimis`,round(sum(((case when ((month(`pct`.`payroll_date`) = 5) and (`pct`.`transaction_code` = 'SALARY')) then 1 when ((month(`pct`.`payroll_date`) = 5) and (`pct`.`transaction_code` in ('ABSENCES','ABSENCES_ADJ','LWOP','LWOP_ADJ','DEDUCTION_LATE','DEDUCTION_LATE_ADJ','DEDUCTION_UNDERTIME','DEDUCTION_UNDERTIME_ADJ'))) then -(1) else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `may_reg`,round(sum(((case when ((month(`pct`.`payroll_date`) = 5) and (`pct`.`transaction_code` = 'SALADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `may_saladj`,round(sum(((case when ((month(`pct`.`payroll_date`) = 5) and (`pct`.`transaction_type_id` = 6)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `may_deminimis`,round(sum(((case when ((month(`pct`.`payroll_date`) = 6) and (`pct`.`transaction_code` = 'SALARY')) then 1 when ((month(`pct`.`payroll_date`) = 6) and (`pct`.`transaction_code` in ('ABSENCES','ABSENCES_ADJ','LWOP','LWOP_ADJ','DEDUCTION_LATE','DEDUCTION_LATE_ADJ','DEDUCTION_UNDERTIME','DEDUCTION_UNDERTIME_ADJ'))) then -(1) else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `jun_reg`,round(sum(((case when ((month(`pct`.`payroll_date`) = 6) and (`pct`.`transaction_code` = 'SALADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `jun_saladj`,round(sum(((case when ((month(`pct`.`payroll_date`) = 6) and (`pct`.`transaction_type_id` = 6)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `jun_deminimis`,round(sum(((case when ((month(`pct`.`payroll_date`) = 7) and (`pct`.`transaction_code` = 'SALARY')) then 1 when ((month(`pct`.`payroll_date`) = 7) and (`pct`.`transaction_code` in ('ABSENCES','ABSENCES_ADJ','LWOP','LWOP_ADJ','DEDUCTION_LATE','DEDUCTION_LATE_ADJ','DEDUCTION_UNDERTIME','DEDUCTION_UNDERTIME_ADJ'))) then -(1) else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `jul_reg`,round(sum(((case when ((month(`pct`.`payroll_date`) = 7) and (`pct`.`transaction_code` = 'SALADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `jul_saladj`,round(sum(((case when ((month(`pct`.`payroll_date`) = 7) and (`pct`.`transaction_type_id` = 6)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `jul_deminimis`,round(sum(((case when ((month(`pct`.`payroll_date`) = 8) and (`pct`.`transaction_code` = 'SALARY')) then 1 when ((month(`pct`.`payroll_date`) = 8) and (`pct`.`transaction_code` in ('ABSENCES','ABSENCES_ADJ','LWOP','LWOP_ADJ','DEDUCTION_LATE','DEDUCTION_LATE_ADJ','DEDUCTION_UNDERTIME','DEDUCTION_UNDERTIME_ADJ'))) then -(1) else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `aug_reg`,round(sum(((case when ((month(`pct`.`payroll_date`) = 8) and (`pct`.`transaction_code` = 'SALADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `aug_saladj`,round(sum(((case when ((month(`pct`.`payroll_date`) = 8) and (`pct`.`transaction_type_id` = 6)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `aug_deminimis`,round(sum(((case when ((month(`pct`.`payroll_date`) = 9) and (`pct`.`transaction_code` = 'SALARY')) then 1 when ((month(`pct`.`payroll_date`) = 9) and (`pct`.`transaction_code` in ('ABSENCES','ABSENCES_ADJ','LWOP','LWOP_ADJ','DEDUCTION_LATE','DEDUCTION_LATE_ADJ','DEDUCTION_UNDERTIME','DEDUCTION_UNDERTIME_ADJ'))) then -(1) else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `sep_reg`,round(sum(((case when ((month(`pct`.`payroll_date`) = 9) and (`pct`.`transaction_code` = 'SALADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `sep_saladj`,round(sum(((case when ((month(`pct`.`payroll_date`) = 9) and (`pct`.`transaction_type_id` = 6)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `sep_deminimis`,round(sum(((case when ((month(`pct`.`payroll_date`) = 10) and (`pct`.`transaction_code` = 'SALARY')) then 1 when ((month(`pct`.`payroll_date`) = 10) and (`pct`.`transaction_code` in ('ABSENCES','ABSENCES_ADJ','LWOP','LWOP_ADJ','DEDUCTION_LATE','DEDUCTION_LATE_ADJ','DEDUCTION_UNDERTIME','DEDUCTION_UNDERTIME_ADJ'))) then -(1) else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `oct_reg`,round(sum(((case when ((month(`pct`.`payroll_date`) = 10) and (`pct`.`transaction_code` = 'SALADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `oct_saladj`,round(sum(((case when ((month(`pct`.`payroll_date`) = 10) and (`pct`.`transaction_type_id` = 6)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `oct_deminimis`,round(sum(((case when ((month(`pct`.`payroll_date`) = 11) and (`pct`.`transaction_code` = 'SALARY')) then 1 when ((month(`pct`.`payroll_date`) = 11) and (`pct`.`transaction_code` in ('ABSENCES','ABSENCES_ADJ','LWOP','LWOP_ADJ','DEDUCTION_LATE','DEDUCTION_LATE_ADJ','DEDUCTION_UNDERTIME','DEDUCTION_UNDERTIME_ADJ'))) then -(1) else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `nov_reg`,round(sum(((case when ((month(`pct`.`payroll_date`) = 11) and (`pct`.`transaction_code` = 'SALADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `nov_saladj`,round(sum(((case when ((month(`pct`.`payroll_date`) = 11) and (`pct`.`transaction_type_id` = 6)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `nov_deminimis`,round(sum(((case when ((month(`pct`.`payroll_date`) = 12) and (`pct`.`transaction_code` = 'SALARY')) then 1 when ((month(`pct`.`payroll_date`) = 12) and (`pct`.`transaction_code` in ('ABSENCES','ABSENCES_ADJ','LWOP','LWOP_ADJ','DEDUCTION_LATE','DEDUCTION_LATE_ADJ','DEDUCTION_UNDERTIME','DEDUCTION_UNDERTIME_ADJ'))) then -(1) else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `dec_reg`,round(sum(((case when ((month(`pct`.`payroll_date`) = 12) and (`pct`.`transaction_code` = 'SALADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `dec_saladj`,round(sum(((case when ((month(`pct`.`payroll_date`) = 12) and (`pct`.`transaction_type_id` = 6)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `dec_deminimis`,round(sum(((case when ((`pct`.`transaction_code` in ('SALARY','SALADJ')) or (`pct`.`transaction_type_id` = 6)) then 1 when (`pct`.`transaction_code` in ('ABSENCES','ABSENCES_ADJ','LWOP','LWOP_ADJ','DEDUCTION_LATE','DEDUCTION_LATE_ADJ','DEDUCTION_UNDERTIME','DEDUCTION_UNDERTIME_ADJ')) then -(1) else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `total`,12.00 AS `month_count`,round((sum(((case when ((`pct`.`transaction_code` in ('SALARY','SALADJ')) or (`pct`.`transaction_type_id` = 6)) then 1 when (`pct`.`transaction_code` in ('ABSENCES','ABSENCES_ADJ','LWOP','LWOP_ADJ','DEDUCTION_LATE','DEDUCTION_LATE_ADJ','DEDUCTION_UNDERTIME','DEDUCTION_UNDERTIME_ADJ')) then -(1) else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) / 12),2) AS `bonus`,`get_max_bonus`() AS `ceiling_amount`,if((((sum(((case when ((`pct`.`transaction_code` in ('SALARY','SALADJ')) or (`pct`.`transaction_type_id` = 6)) then 1 when (`pct`.`transaction_code` in ('ABSENCES','ABSENCES_ADJ','LWOP','LWOP_ADJ','DEDUCTION_LATE','DEDUCTION_LATE_ADJ','DEDUCTION_UNDERTIME','DEDUCTION_UNDERTIME_ADJ')) then -(1) else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) / 12) - `get_max_bonus`()) < 0),0,round(((sum(((case when ((`pct`.`transaction_code` in ('SALARY','SALADJ')) or (`pct`.`transaction_type_id` = 6)) then 1 when (`pct`.`transaction_code` in ('ABSENCES','ABSENCES_ADJ','LWOP','LWOP_ADJ','DEDUCTION_LATE','DEDUCTION_LATE_ADJ','DEDUCTION_UNDERTIME','DEDUCTION_UNDERTIME_ADJ')) then -(1) else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) / 12) - `get_max_bonus`()),2)) AS `taxable` from ((((`ww_payroll_closed_transaction` `pct` left join `ww_users_profile` `up` on((`pct`.`employee_id` = `up`.`user_id`))) left join `ww_partners` `p` on((`pct`.`employee_id` = `p`.`user_id`))) left join `ww_users_department` `ud` on((`pct`.`department_id` = `ud`.`department_id`))) left join `ww_users_company` `uc` on((`pct`.`company_id` = `uc`.`company_id`))) group by `up`.`user_id`,year(`pct`.`payroll_date`)) */;

/*View structure for view payroll_contribution_loan_summary */

/*!50001 DROP TABLE IF EXISTS `payroll_contribution_loan_summary` */;
/*!50001 DROP VIEW IF EXISTS `payroll_contribution_loan_summary` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_contribution_loan_summary` AS select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`c`.`company` AS `company`,`wpp`.`company_id` AS `company_id`,`up`.`department_id` AS `department_id`,`d`.`department` AS `department`,`pt`.`transaction_label` AS `transaction_label`,`pt`.`transaction_id` AS `transaction_id`,`pt`.`transaction_code` AS `transaction_code`,extract(year_month from `pct`.`payroll_date`) AS `reference_no`,`pct`.`payroll_date` AS `payroll_date`,year(`pct`.`payroll_date`) AS `year`,month(`pct`.`payroll_date`) AS `month`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,round(sum(aes_decrypt(`pct`.`amount`,`encryption_key`())),2) AS `amount`,'PRELIMINARY' AS `record_reference`,`c`.`address` AS `address`,`getcompany_contact`(`pct`.`company_id`,'Phone') AS `phone_no`,`getcompany_contact`(`pct`.`company_id`,'Fax') AS `fax_no` from (((((((((`ww_payroll_current_transaction` `pct` join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) join `ww_users_department` `d` on((`up`.`department_id` = `d`.`department_id`))) join `ww_partners` `p` on((`p`.`user_id` = `pct`.`employee_id`))) join `ww_payroll_partners` `wpp` on((`wpp`.`user_id` = `pct`.`employee_id`))) left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_payroll_period` `pp` on((`pp`.`payroll_period_id` = `pct`.`period_id`))) left join `ww_users_company` `c` on((`c`.`company_id` = `wpp`.`company_id`))) where ((`pct`.`deleted` = 0) and (`pt`.`deleted` = 0) and ((`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) or (`pt`.`transaction_code` in ('SSS_EMP','PHIC_EMP','HDMF_EMP')))) group by `pct`.`employee_id`,`pt`.`transaction_label` union select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`c`.`company` AS `company`,`wpp`.`company_id` AS `company_id`,`up`.`department_id` AS `department_id`,`d`.`department` AS `department`,`pt`.`transaction_label` AS `transaction_label`,`pt`.`transaction_id` AS `transaction_id`,`pt`.`transaction_code` AS `transaction_code`,extract(year_month from `pct`.`payroll_date`) AS `reference_no`,`pct`.`payroll_date` AS `payroll_date`,year(`pct`.`payroll_date`) AS `year`,month(`pct`.`payroll_date`) AS `month`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,round(sum(aes_decrypt(`pct`.`amount`,`encryption_key`())),2) AS `amount`,'HISTORICAL' AS `record_reference`,`c`.`address` AS `address`,`getcompany_contact`(`pct`.`company_id`,'Phone') AS `phone_no`,`getcompany_contact`(`pct`.`company_id`,'Fax') AS `fax_no` from (((((((((`ww_payroll_closed_transaction` `pct` join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) join `ww_users_department` `d` on((`up`.`department_id` = `d`.`department_id`))) join `ww_partners` `p` on((`p`.`user_id` = `pct`.`employee_id`))) join `ww_payroll_partners` `wpp` on((`wpp`.`user_id` = `pct`.`employee_id`))) left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_payroll_period` `pp` on((`pp`.`payroll_period_id` = `pct`.`period_id`))) left join `ww_users_company` `c` on((`c`.`company_id` = `wpp`.`company_id`))) where ((`pct`.`deleted` = 0) and (`pt`.`deleted` = 0) and ((`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) or (`pt`.`transaction_code` in ('SSS_EMP','PHIC_EMP','HDMF_EMP')))) group by `pct`.`employee_id`,`pt`.`transaction_label` */;

/*View structure for view payroll_deduction */

/*!50001 DROP TABLE IF EXISTS `payroll_deduction` */;
/*!50001 DROP VIEW IF EXISTS `payroll_deduction` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_deduction` AS select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`up`.`lastname` AS `lastname`,`up`.`firstname` AS `firstname`,`c`.`company` AS `company`,`wpp`.`company_id` AS `company_id`,`uproj`.`project_id` AS `project_id`,`uproj`.`project` AS `project`,`uproj`.`project_code` AS `project_code`,`up`.`department_id` AS `department_id`,`d`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`pt`.`transaction_label` AS `transaction_label`,`pt`.`transaction_id` AS `transaction_id`,`prt`.`payroll_rate_type` AS `payroll_rate_type`,`prt`.`payroll_rate_type_id` AS `payroll_rate_type_id`,extract(year_month from `pct`.`payroll_date`) AS `reference_no`,`pct`.`payroll_date` AS `payroll_date`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,(case when (`pct`.`record_from` = 'employee_loan') then `get_loan_started`(`pct`.`record_id`) else '' end) AS `start_date`,aes_decrypt(`pct`.`amount`,`encryption_key`()) AS `amount`,'PRELIMINARY' AS `record_reference`,`c`.`address` AS `address`,`getcompany_contact`(`pct`.`company_id`,'Phone') AS `phone_no`,`getcompany_contact`(`pct`.`company_id`,'Fax') AS `fax_no` from (((((((((((`ww_payroll_current_transaction` `pct` left join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) left join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) left join `ww_users_project` `uproj` on((`uproj`.`project_id` = `up`.`project_id`))) left join `ww_users_department` `d` on((`up`.`department_id` = `d`.`department_id`))) left join `ww_users_branch` `b` on((`up`.`branch_id` = `b`.`branch_id`))) left join `ww_partners` `p` on((`p`.`user_id` = `pct`.`employee_id`))) left join `ww_payroll_partners` `wpp` on((`wpp`.`user_id` = `pct`.`employee_id`))) left join `ww_payroll_rate_type` `prt` on((`prt`.`payroll_rate_type_id` = `wpp`.`payroll_rate_type_id`))) left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_payroll_period` `pp` on((`pp`.`payroll_period_id` = `pct`.`period_id`))) left join `ww_users_company` `c` on((`c`.`company_id` = `wpp`.`company_id`))) where ((`pct`.`deleted` = 0) and (`pt`.`deleted` = 0) and (`pt`.`transaction_type_id` = 3) and (`pt`.`transaction_code` <> 'WHTAX')) union select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`up`.`lastname` AS `lastname`,`up`.`firstname` AS `firstname`,`c`.`company` AS `company`,`wpp`.`company_id` AS `company_id`,`uproj`.`project_id` AS `project_id`,`uproj`.`project` AS `project`,`uproj`.`project_code` AS `project_code`,`up`.`department_id` AS `department_id`,`d`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`pt`.`transaction_label` AS `transaction_label`,`pt`.`transaction_id` AS `transaction_id`,`prt`.`payroll_rate_type` AS `payroll_rate_type`,`prt`.`payroll_rate_type_id` AS `payroll_rate_type_id`,extract(year_month from `pct`.`payroll_date`) AS `reference_no`,`pct`.`payroll_date` AS `payroll_date`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,(case when (`pct`.`record_from` = 'employee_loan') then `get_loan_started`(`pct`.`record_id`) else '' end) AS `start_date`,aes_decrypt(`pct`.`amount`,`encryption_key`()) AS `amount`,'HISTORICAL' AS `record_reference`,`c`.`address` AS `address`,`getcompany_contact`(`pct`.`company_id`,'Phone') AS `phone_no`,`getcompany_contact`(`pct`.`company_id`,'Fax') AS `fax_no` from (((((((((((`ww_payroll_closed_transaction` `pct` left join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) left join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) left join `ww_users_project` `uproj` on((`uproj`.`project_id` = `up`.`project_id`))) left join `ww_users_department` `d` on((`up`.`department_id` = `d`.`department_id`))) left join `ww_users_branch` `b` on((`up`.`branch_id` = `b`.`branch_id`))) left join `ww_partners` `p` on((`p`.`user_id` = `pct`.`employee_id`))) left join `ww_payroll_partners` `wpp` on((`wpp`.`user_id` = `pct`.`employee_id`))) join `ww_payroll_rate_type` `prt` on((`prt`.`payroll_rate_type_id` = `wpp`.`payroll_rate_type_id`))) left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_payroll_period` `pp` on((`pp`.`payroll_period_id` = `pct`.`period_id`))) left join `ww_users_company` `c` on((`c`.`company_id` = `wpp`.`company_id`))) where ((`pct`.`deleted` = 0) and (`pt`.`deleted` = 0) and (`pt`.`transaction_type_id` = 3) and (`pt`.`transaction_code` <> 'WHTAX')) */;

/*View structure for view payroll_deduction_schedule_dtl */

/*!50001 DROP TABLE IF EXISTS `payroll_deduction_schedule_dtl` */;
/*!50001 DROP VIEW IF EXISTS `payroll_deduction_schedule_dtl` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_deduction_schedule_dtl` AS select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`c`.`company` AS `company`,`wpp`.`company_id` AS `company_id`,`up`.`department_id` AS `department_id`,`d`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`pt`.`transaction_label` AS `transaction_label`,`pt`.`transaction_id` AS `transaction_id`,extract(year_month from `pct`.`payroll_date`) AS `reference_no`,`pct`.`payroll_date` AS `payroll_date`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,aes_decrypt(`pct`.`amount`,`encryption_key`()) AS `amount`,'PRELIMINARY' AS `record_reference`,`c`.`address` AS `address` from (((((((((`ww_payroll_current_transaction` `pct` join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) join `ww_users_department` `d` on((`up`.`department_id` = `d`.`department_id`))) join `ww_users_branch` `b` on((`b`.`branch_id` = `up`.`branch_id`))) join `ww_partners` `p` on((`p`.`user_id` = `pct`.`employee_id`))) join `ww_payroll_partners` `wpp` on((`wpp`.`user_id` = `pct`.`employee_id`))) left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_payroll_period` `pp` on((`pp`.`payroll_period_id` = `pct`.`period_id`))) left join `ww_users_company` `c` on((`c`.`company_id` = `wpp`.`company_id`))) where ((`pct`.`deleted` = 0) and (`pt`.`deleted` = 0) and (`pt`.`transaction_type_id` = 3) and (`pt`.`transaction_code` <> 'WHTAX') and (`pt`.`transaction_code` <> 'PagIbigAdd')) union select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`c`.`company` AS `company`,`wpp`.`company_id` AS `company_id`,`up`.`department_id` AS `department_id`,`d`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`pt`.`transaction_label` AS `transaction_label`,`pt`.`transaction_id` AS `transaction_id`,extract(year_month from `pct`.`payroll_date`) AS `reference_no`,`pct`.`payroll_date` AS `payroll_date`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,aes_decrypt(`pct`.`amount`,`encryption_key`()) AS `amount`,'HISTORICAL' AS `record_reference`,`c`.`address` AS `address` from (((((((((`ww_payroll_closed_transaction` `pct` join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) join `ww_users_department` `d` on((`up`.`department_id` = `d`.`department_id`))) join `ww_users_branch` `b` on((`b`.`branch_id` = `up`.`branch_id`))) join `ww_partners` `p` on((`p`.`user_id` = `pct`.`employee_id`))) join `ww_payroll_partners` `wpp` on((`wpp`.`user_id` = `pct`.`employee_id`))) left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_payroll_period` `pp` on((`pp`.`payroll_period_id` = `pct`.`period_id`))) left join `ww_users_company` `c` on((`c`.`company_id` = `wpp`.`company_id`))) where ((`pct`.`deleted` = 0) and (`pt`.`deleted` = 0) and (`pt`.`transaction_type_id` = 3) and (`pt`.`transaction_code` <> 'WHTAX') and (`pt`.`transaction_code` <> 'PagIbigAdd')) */;

/*View structure for view payroll_exit_clearance_report */

/*!50001 DROP TABLE IF EXISTS `payroll_exit_clearance_report` */;
/*!50001 DROP VIEW IF EXISTS `payroll_exit_clearance_report` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_exit_clearance_report` AS select `u`.`user_id` AS `user_id`,`u`.`full_name` AS `full_name`,`par`.`id_number` AS `id_number`,`pct`.`payroll_date` AS `payroll_date`,year(`pct`.`payroll_date`) AS `year`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,`pct`.`company_id` AS `company_id`,`uc`.`company` AS `company`,`uproj`.`project_id` AS `project_id`,`uproj`.`project_code` AS `project_code`,`uproj`.`project` AS `project`,`po`.`position` AS `position`,`par`.`effectivity_date` AS `effectivity_date`,`par`.`regularization_date` AS `regularization_date`,`par`.`resigned_date` AS `resigned_date`,'' AS `remarks`,`prt`.`payroll_rate_type_id` AS `payroll_rate_type_id`,`prt`.`payroll_rate_type` AS `payroll_rate_type`,sum(((case when (`ptc`.`transaction_class_code` = 'SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `basic`,sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `misc`,sum(((case when (`pt`.`transaction_code` in ('REGOT','REGOT_ADJ','RDOT','RDOT_ADJ','RDOT_EXCESS','RDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `ot`,sum(((case when (`pt`.`transaction_code` in ('REGND','REGND_ADJ','REGOT_ND','REGOT_ND_ADJ','LEGOT_ND','LEGOT_ND_ADJ','LEGOT_ND_EXCESS','LEGOT_ND_EXCESS_ADJ','LEGRDOT_ND','LEGRDOT_ND_ADJ','LEGRDOT_ND_EXCESS','LEGRDOT_ND_EXCESS_ADJ','RDOT_ND','RDOT_ND_ADJ','RDOT_ND_EXCESS','RDOT_ND_EXCESS_ADJ','SPEOT_ND','SPEOT_ND_ADJ','SPEOT_ND_EXCESS','SPEOT_ND_EXCESS_ADJ','SPERDOT_ND','SPERDOT_ND_ADJ','SPERDOT_ND_EXCESS','SPERDOT_ND_EXCESS_ADJ','DOBOT_ND','DOBOT_ND_ADJ','DOBOT_ND_EXCESS','DOBOT_ND_EXCESS_ADJ','DOBRDOT_ND','DOBRDOT_ND_ADJ','DOBRDOT_ND_EXCESS','DOBRDOT_ND_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `nd`,sum(((case when (`pt`.`transaction_code` in ('LEGOT','LEGOT_ADJ','LEGOT_EXCESS','LEGOT_EXCESS_ADJ','LEGRDOT','LEGRDOT_ADJ','LEGRDOT_EXCESS','LEGRDOT_EXCESS_ADJ','SPEOT','SPEOT_ADJ','SPEOT_EXCESS','SPEOT_EXCESS_ADJ','SPERDOT','SPERDOT_ADJ','SPERDOT_EXCESS','SPERDOT_EXCESS_ADJ','DOBOT','DOBOT_ADJ','DOBOT_EXCESS','DOBOT_EXCESS_ADJ','DOBRDOT','DOBRDOT_ADJ','DOBRDOT_EXCESS','DOBRDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `holiday`,sum(((case when ((`ptt`.`operation` = '+') and (`ptc`.`transaction_class_code` not in ('SALARY','OVERTIME'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `other_earnings`,(((((sum(((case when (`ptc`.`transaction_class_code` = 'SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`pt`.`transaction_code` in ('REGOT','REGOT_ADJ','RDOT','RDOT_ADJ','RDOT_EXCESS','RDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`pt`.`transaction_code` in ('REGND','REGND_ADJ','REGOT_ND','REGOT_ND_ADJ','LEGOT_ND','LEGOT_ND_ADJ','LEGOT_ND_EXCESS','LEGOT_ND_EXCESS_ADJ','LEGRDOT_ND','LEGRDOT_ND_ADJ','LEGRDOT_ND_EXCESS','LEGRDOT_ND_EXCESS_ADJ','RDOT_ND','RDOT_ND_ADJ','RDOT_ND_EXCESS','RDOT_ND_EXCESS_ADJ','SPEOT_ND','SPEOT_ND_ADJ','SPEOT_ND_EXCESS','SPEOT_ND_EXCESS_ADJ','SPERDOT_ND','SPERDOT_ND_ADJ','SPERDOT_ND_EXCESS','SPERDOT_ND_EXCESS_ADJ','DOBOT_ND','DOBOT_ND_ADJ','DOBOT_ND_EXCESS','DOBOT_ND_EXCESS_ADJ','DOBRDOT_ND','DOBRDOT_ND_ADJ','DOBRDOT_ND_EXCESS','DOBRDOT_ND_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`pt`.`transaction_code` in ('LEGOT','LEGOT_ADJ','LEGOT_EXCESS','LEGOT_EXCESS_ADJ','LEGRDOT','LEGRDOT_ADJ','LEGRDOT_EXCESS','LEGRDOT_EXCESS_ADJ','SPEOT','SPEOT_ADJ','SPEOT_EXCESS','SPEOT_EXCESS_ADJ','SPERDOT','SPERDOT_ADJ','SPERDOT_EXCESS','SPERDOT_EXCESS_ADJ','DOBOT','DOBOT_ADJ','DOBOT_EXCESS','DOBOT_EXCESS_ADJ','DOBRDOT','DOBRDOT_ADJ','DOBRDOT_EXCESS','DOBRDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when ((`ptt`.`operation` = '+') and (`ptc`.`transaction_class_code` not in ('SALARY','OVERTIME'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) - sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `gross`,sum(((case when (`ptc`.`transaction_class_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss_ee`,round(sum(((case when (`ptc`.`transaction_class_code` = 'SSS_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `sss_er`,round(sum(((case when (`ptc`.`transaction_class_code` = 'SSS_ECC') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `sss_ec`,sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `phic_ee`,sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `phic_er`,sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf_ee`,sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf_er`,sum(((case when (`ptc`.`transaction_class_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `tax`,sum(((case when (`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `loan`,round(sum(((case when (`pt`.`transaction_type_id` in (2,6,7)) then 1 when ((`pt`.`transaction_type_id` = 6) and (`ptc`.`transaction_class_code` <> 'BONUS_TAXABLE')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `other_nontax`,sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `employee_ledger`,sum(((case when ((`ptt`.`operation` = '-') and (`ptc`.`transaction_class_code` not in ('SSS_EMP','PHIC_EMP','HDMF_EMP','WHTAX','LOAN_AMORTIZATION','LOAN_INTEREST'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `other_deduction`,((((((sum(((case when (`ptc`.`transaction_class_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when ((`ptt`.`operation` = '-') and (`ptc`.`transaction_class_code` not in ('SSS_EMP','PHIC_EMP','HDMF_EMP','WHTAX','LOAN_AMORTIZATION','LOAN_INTEREST'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `deduction`,sum(((case when (`pt`.`transaction_code` = 'NETPAY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `net_amount` from ((((((((((`ww_payroll_current_transaction` `pct` left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_payroll_transaction_type` `ptt` on((`ptt`.`transaction_type_id` = `pt`.`transaction_type_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_payroll_period` `pp` on((`pct`.`period_id` = `pp`.`payroll_period_id`))) left join `ww_users_company` `uc` on((`pct`.`company_id` = `uc`.`company_id`))) left join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) left join `ww_partners` `par` on((`pct`.`employee_id` = `par`.`user_id`))) left join `ww_users_position` `po` on((`pct`.`position_id` = `po`.`position_id`))) left join `ww_users_project` `uproj` on((`pct`.`project_id` = `uproj`.`project_id`))) left join `ww_payroll_rate_type` `prt` on((`pct`.`payroll_rate_type_id` = `prt`.`payroll_rate_type_id`))) group by `pct`.`employee_id`,`pct`.`payroll_date` order by `pct`.`project_id` */;

/*View structure for view payroll_journal_voucher */

/*!50001 DROP TABLE IF EXISTS `payroll_journal_voucher` */;
/*!50001 DROP VIEW IF EXISTS `payroll_journal_voucher` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_journal_voucher` AS select if((`t`.`credit_account_id` > 0),`pb`.`description`,`pa`.`description`) AS `description`,if((`t`.`credit_account_id` > 0),`pb`.`account_name`,`pa`.`account_name`) AS `account_name`,if((`t`.`credit_account_id` > 0),`pb`.`account_code`,`pa`.`account_code`) AS `account_code`,if((`t`.`credit_account_id` > 0),sum(aes_decrypt(`pct`.`amount`,`encryption_key`())),'') AS `credit`,if((`t`.`debit_account_id` > 0),sum((case when (`pct`.`transaction_type_id` in (3,4,5)) then (-(1) * aes_decrypt(`pct`.`amount`,`encryption_key`())) else aes_decrypt(`pct`.`amount`,`encryption_key`()) end)),'') AS `debit`,`uc`.`company` AS `company`,`pp`.`company_id` AS `company_id`,`u`.`department_id` AS `department_id`,`d`.`department` AS `department`,`pct`.`payroll_date` AS `payroll_date`,`p`.`date_from` AS `date_from`,`p`.`date_to` AS `date_to`,`uc`.`address` AS `address`,ifnull(`pa`.`arrangement`,`pb`.`arrangement`) AS `arrangement` from (((((((((`ww_payroll_current_transaction` `pct` join `ww_users_profile` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_department` `d` on((`u`.`department_id` = `d`.`department_id`))) join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `u`.`user_id`))) left join `ww_payroll_transaction` `t` on((`pct`.`transaction_id` = `t`.`transaction_id`))) left join `ww_payroll_transaction_class` `c` on((`t`.`transaction_class_id` = `c`.`transaction_class_id`))) left join `ww_payroll_period` `p` on((`pct`.`period_id` = `p`.`payroll_period_id`))) left join `ww_users_company` `uc` on((`uc`.`company_id` = `pp`.`company_id`))) left join `ww_payroll_account` `pb` on((`t`.`credit_account_id` = `pb`.`account_id`))) left join `ww_payroll_account` `pa` on((`t`.`debit_account_id` = `pa`.`account_id`))) where ((`pct`.`deleted` = 0) and ((`t`.`credit_account_id` > 0) or (`t`.`debit_account_id` > 0)) and (`pct`.`on_hold` = 0)) group by `u`.`company_id`,`pct`.`payroll_date`,if((`t`.`credit_account_id` > 0),`pb`.`account_name`,`pa`.`account_name`) union select if((`t`.`credit_account_id` > 0),`pb`.`description`,`pa`.`description`) AS `description`,if((`t`.`credit_account_id` > 0),`pb`.`account_name`,`pa`.`account_name`) AS `account_name`,if((`t`.`credit_account_id` > 0),`pb`.`account_code`,`pa`.`account_code`) AS `account_code`,if((`t`.`credit_account_id` > 0),sum(aes_decrypt(`pct`.`amount`,`encryption_key`())),'') AS `credit`,if((`t`.`debit_account_id` > 0),sum((case when (`pct`.`transaction_type_id` in (3,4,5)) then (-(1) * aes_decrypt(`pct`.`amount`,`encryption_key`())) else aes_decrypt(`pct`.`amount`,`encryption_key`()) end)),'') AS `debit`,`uc`.`company` AS `company`,`pp`.`company_id` AS `company_id`,`u`.`department_id` AS `department_id`,`d`.`department` AS `department`,`pct`.`payroll_date` AS `payroll_date`,`p`.`date_from` AS `date_from`,`p`.`date_to` AS `date_to`,`uc`.`address` AS `address`,ifnull(`pa`.`arrangement`,`pb`.`arrangement`) AS `arrangement` from (((((((((`ww_payroll_closed_transaction` `pct` join `ww_users_profile` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_department` `d` on((`u`.`department_id` = `d`.`department_id`))) join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `u`.`user_id`))) left join `ww_payroll_transaction` `t` on((`pct`.`transaction_id` = `t`.`transaction_id`))) left join `ww_payroll_transaction_class` `c` on((`t`.`transaction_class_id` = `c`.`transaction_class_id`))) left join `ww_payroll_period` `p` on((`pct`.`period_id` = `p`.`payroll_period_id`))) left join `ww_users_company` `uc` on((`uc`.`company_id` = `pp`.`company_id`))) left join `ww_payroll_account` `pb` on((`t`.`credit_account_id` = `pb`.`account_id`))) left join `ww_payroll_account` `pa` on((`t`.`debit_account_id` = `pa`.`account_id`))) where ((`pct`.`deleted` = 0) and ((`t`.`credit_account_id` > 0) or (`t`.`debit_account_id` > 0)) and (`pct`.`on_hold` = 0)) group by `u`.`company_id`,`pct`.`payroll_date`,if((`t`.`credit_account_id` > 0),`pb`.`account_name`,`pa`.`account_name`) */;

/*View structure for view payroll_journal_voucher_extended */

/*!50001 DROP TABLE IF EXISTS `payroll_journal_voucher_extended` */;
/*!50001 DROP VIEW IF EXISTS `payroll_journal_voucher_extended` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_journal_voucher_extended` AS select `pct`.`payroll_date` AS `payroll_date`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,`uc`.`company` AS `company`,`uc`.`address` AS `address`,`pct`.`branch_id` AS `branch_id`,if((ifnull(`pas`.`category_value`,'') = ''),`ub`.`branch_code`,`pas`.`category_value`) AS `branch`,if((ifnull(`pas`.`account_code`,'') = ''),convert(`pa`.`account_code` using utf8),`pas`.`account_code`) AS `account`,if((ifnull(`pas`.`account_code`,'') = ''),convert(`pa`.`account_name` using utf8),`pas`.`account_sub`) AS `description`,if((ifnull(`pas`.`account_code`,'') = ''),if((`pa`.`department_breakdown` = 0),'000-000-000',`ud`.`department_code`),`pas`.`account_sub_code`) AS `sub_account`,'' AS `project`,'' AS `project_task`,'' AS `ref_number`,1 AS `quantity`,'' AS `uom`,sum(if((if((`pa`.`department_breakdown` = 0),1,((`pct`.`department_id` = `ud`.`department_id`) and (`pa`.`department_breakdown` = `ud`.`category_id`))) and find_in_set(`pa`.`account_id`,`pt`.`debit_account`)),(if(((`pt`.`transaction_type_id` = 5) and (`ptc`.`government_mandated` = 0)),-(1),1) * aes_decrypt(`pct`.`amount`,`encryption_key`())),0)) AS `debit_amount`,sum(if((if((`pa`.`department_breakdown` = 0),1,((`pct`.`department_id` = `ud`.`department_id`) and (`ud`.`category_id` = `pa`.`department_breakdown`))) and find_in_set(`pa`.`account_id`,`pt`.`credit_account`)),aes_decrypt(`pct`.`amount`,`encryption_key`()),0)) AS `credit_amount`,`pp`.`remarks` AS `transaction_description`,'FALSE' AS `non_billable` from ((((((((((`ww_payroll_closed_transaction` `pct` join `ww_payroll_account` `pa`) left join `ww_payroll_period` `pp` on((`pp`.`payroll_period_id` = `pct`.`period_id`))) left join `ww_users_company` `uc` on((`uc`.`company_id` = `pct`.`company_id`))) left join `ww_users_branch` `ub` on((`ub`.`branch_id` = `pct`.`branch_id`))) left join `ww_users_department` `ud` on((`ud`.`department_id` = `pct`.`department_id`))) left join `ww_payroll_transaction` `pt` on((`pt`.`transaction_id` = `pct`.`transaction_id`))) left join `ww_payroll_transaction_class` `ptc` on((`ptc`.`transaction_class_id` = `pt`.`transaction_class_id`))) left join `ww_payroll_account_type` `pat` on((`pat`.`account_type_id` = `pa`.`account_type_id`))) left join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) left join `ww_payroll_account_sub` `pas` on(((`pas`.`deleted` = 0) and (`pas`.`account_id` = `pa`.`account_id`) and (`pas`.`category_val_id` = `ub`.`branch_id`) and if((`pas`.`sub_category_id` = 0),1,(`pas`.`sub_category_id` = `ud`.`department_id`))))) where (`pa`.`deleted` = 0) group by `pct`.`payroll_date`,`pct`.`branch_id`,`pa`.`account_code`,if((`pa`.`department_breakdown` = 0),1,`ud`.`department_id`) having (((`debit_amount` = 0) and (`credit_amount` = 0)) = 0) order by `pct`.`payroll_date`,`pct`.`branch_id`,`pa`.`account_code`,`ud`.`department_code` */;

/*View structure for view payroll_manpower_charging */

/*!50001 DROP TABLE IF EXISTS `payroll_manpower_charging` */;
/*!50001 DROP VIEW IF EXISTS `payroll_manpower_charging` */;

/*!50001 CREATE ALGORITHM=TEMPTABLE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_manpower_charging` AS select `trs`.`date` AS `date`,`trs`.`user_id` AS `employee`,`p`.`id_number` AS `id_number`,`p`.`classification_id` AS `classification_id`,`p`.`classification` AS `classification`,`u`.`full_name` AS `full_name`,`up`.`company` AS `company`,`up`.`company_id` AS `company_id`,`uproj`.`project_code` AS `project_code`,`uproj`.`project` AS `project`,`trs`.`project_id` AS `project_id`,`pp`.`payroll_rate_type_id` AS `payroll_rate_type_id`,`prt`.`payroll_rate_type` AS `payroll_rate_type`,`trs`.`payroll_date` AS `payroll_date`,`tp`.`date_to` AS `date_to`,`tp`.`date_from` AS `date_from`,count(`trs`.`project_id`) AS `num_days`,((to_days(`tp`.`date_to`) - to_days(`tp`.`date_from`)) + 1) AS `num_days_cutoff`,((count(`trs`.`project_id`) / ((to_days(`tp`.`date_to`) - to_days(`tp`.`date_from`)) + 1)) * 100) AS `percent` from (((((((`ww_time_record_summary` `trs` left join `ww_users` `u` on((`u`.`user_id` = `trs`.`user_id`))) left join `ww_users_profile` `up` on((`up`.`user_id` = `trs`.`user_id`))) left join `ww_partners` `p` on((`p`.`user_id` = `trs`.`user_id`))) left join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `trs`.`user_id`))) left join `ww_payroll_rate_type` `prt` on((`prt`.`payroll_rate_type_id` = `pp`.`payroll_rate_type_id`))) left join `ww_users_project` `uproj` on((`uproj`.`project_id` = `trs`.`project_id`))) left join `ww_time_period` `tp` on(((`tp`.`payroll_date` = `trs`.`payroll_date`) and (`tp`.`company_id` = `u`.`company_id`)))) group by `trs`.`user_id`,`trs`.`project_id` order by `trs`.`project_id` */;

/*View structure for view payroll_manpower_charging_detail */

/*!50001 DROP TABLE IF EXISTS `payroll_manpower_charging_detail` */;
/*!50001 DROP VIEW IF EXISTS `payroll_manpower_charging_detail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_manpower_charging_detail` AS select `proj`.`project_code` AS `project_code`,`proj`.`project` AS `project`,`proj`.`project_id` AS `project_id`,`pmc`.`employee` AS `employee`,`pmc`.`date` AS `date`,`pmc`.`id_number` AS `id_number`,`pmc`.`classification_id` AS `classification_id`,`pmc`.`full_name` AS `full_name`,`pmc`.`company` AS `company`,`pmc`.`company_id` AS `company_id`,`pmc`.`payroll_rate_type_id` AS `payroll_rate_type_id`,`pmc`.`payroll_rate_type` AS `payroll_rate_type`,`pmc`.`payroll_date` AS `payroll_date`,`pmc`.`date_to` AS `date_to`,`pmc`.`date_from` AS `date_from`,ifnull(sum(((case when (`pmc`.`project_code` = 'P14007') then 1 else 0 end) * `pmc`.`percent`)),'') AS `P14007`,ifnull(sum(((case when (`pmc`.`project_code` = 'P15024') then 1 else 0 end) * `pmc`.`percent`)),'') AS `P15024`,ifnull(sum(((case when (`pmc`.`project_code` = 'P16000') then 1 else 0 end) * `pmc`.`percent`)),'') AS `P16000`,ifnull(sum(((case when (`pmc`.`project_code` = 'P16003') then 1 else 0 end) * `pmc`.`percent`)),'') AS `P16003`,ifnull(sum(((case when (`pmc`.`project_code` = 'P16004') then 1 else 0 end) * `pmc`.`percent`)),'') AS `P16004`,ifnull(sum(((case when (`pmc`.`project_code` = 'P16010') then 1 else 0 end) * `pmc`.`percent`)),'') AS `P16010`,ifnull(sum(((case when (`pmc`.`project_code` = 'P16014') then 1 else 0 end) * `pmc`.`percent`)),'') AS `P16014`,ifnull(sum(((case when (`pmc`.`project_code` = 'P16015') then 1 else 0 end) * `pmc`.`percent`)),'') AS `P16015`,ifnull(sum(((case when (`pmc`.`project_code` = 'P16016') then 1 else 0 end) * `pmc`.`percent`)),'') AS `P16016` from ((`payroll_manpower_charging` `pmc` join `ww_users_profile` `up` on((`up`.`user_id` = `pmc`.`employee`))) left join `ww_users_project` `proj` on((`proj`.`project_id` = `up`.`project_id`))) group by `pmc`.`employee` order by `proj`.`project_code` */;

/*View structure for view payroll_manpower_charging_summary */

/*!50001 DROP TABLE IF EXISTS `payroll_manpower_charging_summary` */;
/*!50001 DROP VIEW IF EXISTS `payroll_manpower_charging_summary` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_manpower_charging_summary` AS select `u`.`user_id` AS `employee`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`po`.`position` AS `position`,`uc`.`company` AS `company`,`uc`.`company_id` AS `company_id`,`uproj`.`project_code` AS `project_code`,`uproj`.`project` AS `project`,`uproj`.`project_id` AS `project_id`,`prt`.`payroll_rate_type_id` AS `payroll_rate_type_id`,`prt`.`payroll_rate_type` AS `payroll_rate_type`,`pct`.`payroll_date` AS `payroll_date`,ifnull(trim(`pp`.`key_value`),'') AS `cost_center`,round(sum(((case when (`ptc`.`transaction_class_code` = 'SALARY') then 1 when (`ptc`.`transaction_class_code` in ('ABSENCES','DEDUCTION_LATE','DEDUCTION_UNDERTIME')) then -(1) when (`pct`.`transaction_code` in ('LWOP','LWOP_ADJ')) then -(1) else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `total_basic`,sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `misc`,round(sum(((case when (`ptc`.`transaction_class_code` = 'OVERTIME') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `overtime`,0 AS `other_tax`,0 AS `adjustment`,(((((sum(((case when (`ptc`.`transaction_class_code` = 'SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`pt`.`transaction_code` in ('REGOT','REGOT_ADJ','RDOT','RDOT_ADJ','RDOT_EXCESS','RDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`pt`.`transaction_code` in ('REGND','REGND_ADJ','REGOT_ND','REGOT_ND_ADJ','LEGOT_ND','LEGOT_ND_ADJ','LEGOT_ND_EXCESS','LEGOT_ND_EXCESS_ADJ','LEGRDOT_ND','LEGRDOT_ND_ADJ','LEGRDOT_ND_EXCESS','LEGRDOT_ND_EXCESS_ADJ','RDOT_ND','RDOT_ND_ADJ','RDOT_ND_EXCESS','RDOT_ND_EXCESS_ADJ','SPEOT_ND','SPEOT_ND_ADJ','SPEOT_ND_EXCESS','SPEOT_ND_EXCESS_ADJ','SPERDOT_ND','SPERDOT_ND_ADJ','SPERDOT_ND_EXCESS','SPERDOT_ND_EXCESS_ADJ','DOBOT_ND','DOBOT_ND_ADJ','DOBOT_ND_EXCESS','DOBOT_ND_EXCESS_ADJ','DOBRDOT_ND','DOBRDOT_ND_ADJ','DOBRDOT_ND_EXCESS','DOBRDOT_ND_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`pt`.`transaction_code` in ('LEGOT','LEGOT_ADJ','LEGOT_EXCESS','LEGOT_EXCESS_ADJ','LEGRDOT','LEGRDOT_ADJ','LEGRDOT_EXCESS','LEGRDOT_EXCESS_ADJ','SPEOT','SPEOT_ADJ','SPEOT_EXCESS','SPEOT_EXCESS_ADJ','SPERDOT','SPERDOT_ADJ','SPERDOT_EXCESS','SPERDOT_EXCESS_ADJ','DOBOT','DOBOT_ADJ','DOBOT_EXCESS','DOBOT_EXCESS_ADJ','DOBRDOT','DOBRDOT_ADJ','DOBRDOT_EXCESS','DOBRDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when ((`ptt`.`operation` = '+') and (`ptc`.`transaction_class_code` not in ('SALARY','OVERTIME'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) - sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `gross`,sum(((case when (`ptc`.`transaction_class_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `tax`,sum(((case when (`ptc`.`transaction_class_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss_ee`,round(sum(((case when (`pt`.`transaction_type_id` in (2,6,7)) then 1 when ((`pt`.`transaction_type_id` = 6) and (`ptc`.`transaction_class_code` <> 'BONUS_TAXABLE')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `other_nontax`,round(sum(((case when (`ptc`.`transaction_class_code` = 'SSS_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `sss_er`,round(sum(((case when (`ptc`.`transaction_class_code` = 'SSS_ECC') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `sss_ec`,round(sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `hdmf_er`,round(sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `phic_er`,0 AS `meal`,0 AS `transpo`,0 AS `hardship`,sum(((case when (`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `loan`,((((((sum(((case when (`ptc`.`transaction_class_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when ((`ptt`.`operation` = '-') and (`ptc`.`transaction_class_code` not in ('SSS_EMP','PHIC_EMP','HDMF_EMP','WHTAX','LOAN_AMORTIZATION','LOAN_INTEREST'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `deduction`,sum(((case when (`pt`.`transaction_code` = 'NETPAY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `net_amount`,0 AS `net_orig`,0 AS `percent_allocation` from ((((((((((`ww_payroll_current_transaction` `pct` left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_payroll_transaction_type` `ptt` on((`ptt`.`transaction_type_id` = `pt`.`transaction_type_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) left join `ww_users_company` `uc` on((`pct`.`company_id` = `uc`.`company_id`))) left join `ww_partners` `p` on((`pct`.`employee_id` = `p`.`user_id`))) left join `ww_partners_personal` `pp` on(((`pp`.`deleted` = 0) and (`pp`.`partner_id` = `p`.`partner_id`) and (`pp`.`key` = 'cost_center-cost_center')))) left join `ww_users_position` `po` on((`pct`.`position_id` = `po`.`position_id`))) left join `ww_users_project` `uproj` on((`pct`.`project_id` = `uproj`.`project_id`))) left join `ww_payroll_rate_type` `prt` on((`pct`.`payroll_rate_type_id` = `prt`.`payroll_rate_type_id`))) where ((`pct`.`deleted` = 0) and (`pct`.`on_hold` = 0) and (`pt`.`deleted` = 0) and (`u`.`deleted` = 0)) group by `pct`.`employee_id`,`pp`.`key_value` union all select `u`.`user_id` AS `employee`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`po`.`position` AS `position`,`uc`.`company` AS `company`,`uc`.`company_id` AS `company_id`,`uproj`.`project_code` AS `project_code`,`uproj`.`project` AS `project`,`uproj`.`project_id` AS `project_id`,`prt`.`payroll_rate_type_id` AS `payroll_rate_type_id`,`prt`.`payroll_rate_type` AS `payroll_rate_type`,`pct`.`payroll_date` AS `payroll_date`,ifnull(trim(`pp`.`key_value`),'') AS `cost_center`,round(sum(((case when (`ptc`.`transaction_class_code` = 'SALARY') then 1 when (`ptc`.`transaction_class_code` in ('ABSENCES','DEDUCTION_LATE','DEDUCTION_UNDERTIME')) then -(1) when (`pct`.`transaction_code` in ('LWOP','LWOP_ADJ')) then -(1) else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `total_basic`,sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `misc`,round(sum(((case when (`ptc`.`transaction_class_code` = 'OVERTIME') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `overtime`,0 AS `other_tax`,0 AS `adjustment`,(((((sum(((case when (`ptc`.`transaction_class_code` = 'SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`pt`.`transaction_code` in ('REGOT','REGOT_ADJ','RDOT','RDOT_ADJ','RDOT_EXCESS','RDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`pt`.`transaction_code` in ('REGND','REGND_ADJ','REGOT_ND','REGOT_ND_ADJ','LEGOT_ND','LEGOT_ND_ADJ','LEGOT_ND_EXCESS','LEGOT_ND_EXCESS_ADJ','LEGRDOT_ND','LEGRDOT_ND_ADJ','LEGRDOT_ND_EXCESS','LEGRDOT_ND_EXCESS_ADJ','RDOT_ND','RDOT_ND_ADJ','RDOT_ND_EXCESS','RDOT_ND_EXCESS_ADJ','SPEOT_ND','SPEOT_ND_ADJ','SPEOT_ND_EXCESS','SPEOT_ND_EXCESS_ADJ','SPERDOT_ND','SPERDOT_ND_ADJ','SPERDOT_ND_EXCESS','SPERDOT_ND_EXCESS_ADJ','DOBOT_ND','DOBOT_ND_ADJ','DOBOT_ND_EXCESS','DOBOT_ND_EXCESS_ADJ','DOBRDOT_ND','DOBRDOT_ND_ADJ','DOBRDOT_ND_EXCESS','DOBRDOT_ND_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`pt`.`transaction_code` in ('LEGOT','LEGOT_ADJ','LEGOT_EXCESS','LEGOT_EXCESS_ADJ','LEGRDOT','LEGRDOT_ADJ','LEGRDOT_EXCESS','LEGRDOT_EXCESS_ADJ','SPEOT','SPEOT_ADJ','SPEOT_EXCESS','SPEOT_EXCESS_ADJ','SPERDOT','SPERDOT_ADJ','SPERDOT_EXCESS','SPERDOT_EXCESS_ADJ','DOBOT','DOBOT_ADJ','DOBOT_EXCESS','DOBOT_EXCESS_ADJ','DOBRDOT','DOBRDOT_ADJ','DOBRDOT_EXCESS','DOBRDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when ((`ptt`.`operation` = '+') and (`ptc`.`transaction_class_code` not in ('SALARY','OVERTIME'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) - sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `gross`,sum(((case when (`ptc`.`transaction_class_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `tax`,sum(((case when (`ptc`.`transaction_class_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss_ee`,round(sum(((case when (`pt`.`transaction_type_id` in (2,6,7)) then 1 when ((`pt`.`transaction_type_id` = 6) and (`ptc`.`transaction_class_code` <> 'BONUS_TAXABLE')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `other_nontax`,round(sum(((case when (`ptc`.`transaction_class_code` = 'SSS_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `sss_er`,round(sum(((case when (`ptc`.`transaction_class_code` = 'SSS_ECC') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `sss_ec`,round(sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `hdmf_er`,round(sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `phic_er`,0 AS `meal`,0 AS `transpo`,0 AS `hardship`,sum(((case when (`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `loan`,((((((sum(((case when (`ptc`.`transaction_class_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when ((`ptt`.`operation` = '-') and (`ptc`.`transaction_class_code` not in ('SSS_EMP','PHIC_EMP','HDMF_EMP','WHTAX','LOAN_AMORTIZATION','LOAN_INTEREST'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `deduction`,sum(((case when (`pt`.`transaction_code` = 'NETPAY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `net_amount`,0 AS `net_orig`,0 AS `percent_allocation` from ((((((((((`ww_payroll_closed_transaction` `pct` left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_payroll_transaction_type` `ptt` on((`ptt`.`transaction_type_id` = `pt`.`transaction_type_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) left join `ww_users_company` `uc` on((`pct`.`company_id` = `uc`.`company_id`))) left join `ww_partners` `p` on((`pct`.`employee_id` = `p`.`user_id`))) left join `ww_partners_personal` `pp` on(((`pp`.`deleted` = 0) and (`pp`.`partner_id` = `p`.`partner_id`) and (`pp`.`key` = 'cost_center-cost_center')))) left join `ww_users_position` `po` on((`pct`.`position_id` = `po`.`position_id`))) left join `ww_users_project` `uproj` on((`pct`.`project_id` = `uproj`.`project_id`))) left join `ww_payroll_rate_type` `prt` on((`pct`.`payroll_rate_type_id` = `prt`.`payroll_rate_type_id`))) where ((`pct`.`deleted` = 0) and (`pt`.`deleted` = 0) and (`u`.`deleted` = 0)) group by `pct`.`employee_id`,`pp`.`key_value` order by `cost_center`,`project_id` */;

/*View structure for view payroll_monthly_deduction */

/*!50001 DROP TABLE IF EXISTS `payroll_monthly_deduction` */;
/*!50001 DROP VIEW IF EXISTS `payroll_monthly_deduction` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_monthly_deduction` AS select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`c`.`company` AS `company`,`wpp`.`company_id` AS `company_id`,`up`.`department_id` AS `department_id`,`d`.`department` AS `department`,`pt`.`transaction_label` AS `transaction_label`,`pt`.`transaction_id` AS `transaction_id`,`pl`.`loan_id` AS `loan_id`,`pl`.`loan` AS `loan`,extract(year_month from `pct`.`payroll_date`) AS `reference_no`,year(`pct`.`payroll_date`) AS `year`,month(`pct`.`payroll_date`) AS `month`,`pct`.`payroll_date` AS `payroll_date`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,aes_decrypt(`pct`.`amount`,`encryption_key`()) AS `amount`,'PRELIMINARY' AS `record_reference`,`c`.`address` AS `address`,`getcompany_contact`(`pct`.`company_id`,'Phone') AS `phone_no`,`getcompany_contact`(`pct`.`company_id`,'Fax') AS `fax_no` from ((((((((((`ww_payroll_current_transaction` `pct` join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) join `ww_users_department` `d` on((`up`.`department_id` = `d`.`department_id`))) join `ww_partners` `p` on((`p`.`user_id` = `pct`.`employee_id`))) join `ww_payroll_partners` `wpp` on((`wpp`.`user_id` = `pct`.`employee_id`))) left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_payroll_loan` `pl` on((`pct`.`transaction_id` = `pl`.`amortization_transid`))) left join `ww_payroll_period` `pp` on((`pp`.`payroll_period_id` = `pct`.`period_id`))) left join `ww_users_company` `c` on((`c`.`company_id` = `wpp`.`company_id`))) where ((`pct`.`deleted` = 0) and (`pt`.`deleted` = 0) and (`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST'))) union select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`c`.`company` AS `company`,`wpp`.`company_id` AS `company_id`,`up`.`department_id` AS `department_id`,`d`.`department` AS `department`,`pt`.`transaction_label` AS `transaction_label`,`pt`.`transaction_id` AS `transaction_id`,`pl`.`loan_id` AS `loan_id`,`pl`.`loan` AS `loan`,extract(year_month from `pct`.`payroll_date`) AS `reference_no`,year(`pct`.`payroll_date`) AS `year`,month(`pct`.`payroll_date`) AS `month`,`pct`.`payroll_date` AS `payroll_date`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,aes_decrypt(`pct`.`amount`,`encryption_key`()) AS `amount`,'HISTORICAL' AS `record_reference`,`c`.`address` AS `address`,`getcompany_contact`(`pct`.`company_id`,'Phone') AS `phone_no`,`getcompany_contact`(`pct`.`company_id`,'Fax') AS `fax_no` from ((((((((((`ww_payroll_closed_transaction` `pct` join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) join `ww_users_department` `d` on((`up`.`department_id` = `d`.`department_id`))) join `ww_partners` `p` on((`p`.`user_id` = `pct`.`employee_id`))) join `ww_payroll_partners` `wpp` on((`wpp`.`user_id` = `pct`.`employee_id`))) left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_payroll_loan` `pl` on((`pct`.`transaction_id` = `pl`.`amortization_transid`))) left join `ww_payroll_period` `pp` on((`pp`.`payroll_period_id` = `pct`.`period_id`))) left join `ww_users_company` `c` on((`c`.`company_id` = `wpp`.`company_id`))) where ((`pct`.`deleted` = 0) and (`pt`.`deleted` = 0) and (`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST'))) */;

/*View structure for view payroll_non_atm_register */

/*!50001 DROP TABLE IF EXISTS `payroll_non_atm_register` */;
/*!50001 DROP VIEW IF EXISTS `payroll_non_atm_register` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_non_atm_register` AS select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`pp`.`bank_account` AS `bank_account`,`pp`.`payout_schedule` AS `payout_schedule`,`pp`.`whole_half` AS `payout_scheme`,`set_2_decimal`(if((`pp`.`whole_half` = 0),aes_decrypt(`pct`.`amount`,`encryption_key`()),(aes_decrypt(`pct`.`amount`,`encryption_key`()) / 2))) AS `amount`,`u`.`full_name` AS `full_name`,`c`.`company` AS `company`,`pp`.`company_id` AS `company_id`,`up`.`department_id` AS `department_id`,`d`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`pct`.`transaction_code` AS `transaction_code`,`pct`.`payroll_date` AS `payroll_date`,`t`.`date_from` AS `date_from`,`t`.`date_to` AS `date_to`,'PRELIMINARY' AS `record_reference`,`c`.`address` AS `address`,'tmp' AS `schedule` from ((((((((`ww_payroll_current_transaction` `pct` join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) join `ww_partners` `p` on((`p`.`user_id` = `pct`.`employee_id`))) join `ww_payroll_partners` `pp` on((`pct`.`employee_id` = `pp`.`user_id`))) join `ww_users_department` `d` on((`up`.`department_id` = `d`.`department_id`))) left join `ww_users_branch` `b` on((`up`.`branch_id` = `b`.`branch_id`))) left join `ww_payroll_period` `t` on((`t`.`payroll_period_id` = `pct`.`period_id`))) join `ww_users_company` `c` on((`c`.`company_id` = `up`.`company_id`))) where ((`pct`.`deleted` = 0) and (`pct`.`transaction_code` = 'NETPAY') and (`pct`.`on_hold` = 0) and (`pp`.`on_hold` = 0) and (`u`.`active` = 1) and (aes_decrypt(`pct`.`amount`,`encryption_key`()) > 0) and (`pp`.`payment_type_id` > 1)) union select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`pp`.`bank_account` AS `bank_account`,`pp`.`payout_schedule` AS `payout_schedule`,`pp`.`whole_half` AS `payout_scheme`,`set_2_decimal`(if((`pp`.`whole_half` = 0),aes_decrypt(`pct`.`amount`,`encryption_key`()),(aes_decrypt(`pct`.`amount`,`encryption_key`()) / 2))) AS `amount`,`u`.`full_name` AS `full_name`,`c`.`company` AS `company`,`pp`.`company_id` AS `company_id`,`up`.`department_id` AS `department_id`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`d`.`department` AS `department`,`pct`.`transaction_code` AS `transaction_code`,`pct`.`payroll_date` AS `payroll_date`,`t`.`date_from` AS `date_from`,`t`.`date_to` AS `date_to`,'HISTORICAL' AS `record_reference`,`c`.`address` AS `address`,'tmp' AS `schedule` from ((((((((`ww_payroll_closed_transaction` `pct` join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) join `ww_partners` `p` on((`p`.`user_id` = `pct`.`employee_id`))) join `ww_payroll_partners` `pp` on((`pct`.`employee_id` = `pp`.`user_id`))) join `ww_users_department` `d` on((`up`.`department_id` = `d`.`department_id`))) left join `ww_users_branch` `b` on((`up`.`branch_id` = `b`.`branch_id`))) left join `ww_payroll_period` `t` on((`t`.`payroll_period_id` = `pct`.`period_id`))) join `ww_users_company` `c` on((`c`.`company_id` = `up`.`company_id`))) where ((`pct`.`deleted` = 0) and (`pct`.`transaction_code` = 'NETPAY') and (`pct`.`on_hold` = 0) and (`pp`.`on_hold` = 0) and (`u`.`active` = 1) and (aes_decrypt(`pct`.`amount`,`encryption_key`()) > 0) and (`pp`.`payment_type_id` > 1)) */;

/*View structure for view payroll_pagibig_loan_to_disk */

/*!50001 DROP TABLE IF EXISTS `payroll_pagibig_loan_to_disk` */;
/*!50001 DROP VIEW IF EXISTS `payroll_pagibig_loan_to_disk` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_pagibig_loan_to_disk` AS (select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`up`.`lastname` AS `lastname`,`up`.`firstname` AS `firstname`,`up`.`middlename` AS `middlename`,`up`.`suffix` AS `suffix`,`u`.`full_name` AS `full_name`,`uc`.`company` AS `company`,`uc`.`company_id` AS `company_id`,ifnull(`uc`.`hdmf_branch_code`,'00') AS `pagibig_branch_code`,`pp`.`tin` AS `tin`,`uc`.`sss` AS `co_sss`,`uc`.`phic` AS `co_phic`,`uc`.`hdmf` AS `co_hdmf`,`uc`.`address` AS `co_address`,`uc`.`zipcode` AS `zipcode`,`getcompany_contact`(`pp`.`company_id`,'phone') AS `contact_no`,`ud`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,year(`lp`.`date_paid`) AS `year`,month(`lp`.`date_paid`) AS `month`,`up`.`birth_date` AS `birth_date`,`pp`.`sss_no` AS `sss_no`,`pp`.`phic_no` AS `phic_no`,`pp`.`hdmf_no` AS `hdmf_no`,`plt`.`loan_type` AS `loan_type`,`plt`.`loan_type_id` AS `loan_type_id`,`pl`.`partner_loan_id` AS `partner_loan_id`,`pl`.`description` AS `description`,`lp`.`balance` AS `balance`,aes_decrypt(`pl`.`loan_principal`,`encryption_key`()) AS `loan_principal`,round(sum(aes_decrypt(`lp`.`amount`,`encryption_key`())),2) AS `amount`,concat('DT',rpad(`pp`.`hdmf_no`,12,' '),rpad(`p`.`id_number`,15,' '),(case when (locate('ñ',`up`.`lastname`) <> 'false') then rpad(replace(`up`.`lastname`,' *',''),30,' ') else rpad(replace(`up`.`lastname`,' *',''),30,' ') end),(case when (locate('ñ',`up`.`firstname`) <> 'false') then rpad(`up`.`firstname`,30,' ') else rpad(`up`.`firstname`,30,' ') end),(case when ((`up`.`middlename` <> '') and (`up`.`middlename` is not null)) then rpad(`up`.`middlename`,30,' ') else rpad('',30,' ') end),rpad(round(sum(aes_decrypt(`lp`.`amount`,`encryption_key`())),2),13,' '),rpad('0',13,' '),rpad(ifnull(replace(`pp`.`tin`,'-',''),''),15,' '),rpad(if((`up`.`birth_date` is not null),date_format(`up`.`birth_date`,'%Y%m%d'),''),8,'0')) AS `record`,now() AS `document_date` from ((((((((((`ww_payroll_partners_loan` `pl` left join `ww_payroll_partners_loan_payment` `lp` on((`pl`.`partner_loan_id` = `lp`.`partner_loan_id`))) left join `ww_payroll_partners` `pp` on((`pl`.`user_id` = `pp`.`user_id`))) left join `ww_partners` `p` on((`pl`.`user_id` = `p`.`user_id`))) left join `ww_users` `u` on((`pl`.`user_id` = `u`.`user_id`))) left join `ww_users_profile` `up` on((`pl`.`user_id` = `up`.`user_id`))) left join `ww_users_company` `uc` on((`pp`.`company_id` = `uc`.`company_id`))) left join `ww_users_department` `ud` on((`up`.`department_id` = `ud`.`department_id`))) left join `ww_users_branch` `b` on((`b`.`branch_id` = `up`.`branch_id`))) left join `ww_payroll_loan` `pln` on((`pl`.`loan_id` = `pln`.`loan_id`))) left join `ww_payroll_loan_type` `plt` on((`pln`.`loan_type_id` = `plt`.`loan_type_id`))) where ((`plt`.`loan_type` like '%Pag-Ibig%') and (`lp`.`paid` = 1)) group by `u`.`user_id`,`p`.`id_number`,`up`.`lastname`,`up`.`firstname`,`up`.`middlename`,`up`.`suffix`,`u`.`full_name`,`uc`.`company`,`pp`.`company_id`,`uc`.`tin`,`uc`.`sss`,`uc`.`phic`,`uc`.`hdmf`,`uc`.`address`,`uc`.`zipcode`,`getcompany_contact`(`pp`.`company_id`,'phone'),`ud`.`department_id`,`ud`.`department`,year(`lp`.`date_paid`),month(`lp`.`date_paid`),`up`.`birth_date`,`pp`.`sss_no`,`pp`.`phic_no`,`pp`.`hdmf_no`,`plt`.`loan_type`,`plt`.`loan_type_id`,`pl`.`partner_loan_id`,`pl`.`description`) */;

/*View structure for view payroll_pagibig_to_disk */

/*!50001 DROP TABLE IF EXISTS `payroll_pagibig_to_disk` */;
/*!50001 DROP VIEW IF EXISTS `payroll_pagibig_to_disk` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_pagibig_to_disk` AS select `payroll_partners_contribution_hdmf`.`user_id` AS `user_id`,`payroll_partners_contribution_hdmf`.`id_number` AS `id_number`,`payroll_partners_contribution_hdmf`.`title` AS `title`,`payroll_partners_contribution_hdmf`.`lastname` AS `lastname`,`payroll_partners_contribution_hdmf`.`firstname` AS `firstname`,`payroll_partners_contribution_hdmf`.`middlename` AS `middlename`,`payroll_partners_contribution_hdmf`.`suffix` AS `suffix`,`payroll_partners_contribution_hdmf`.`full_name` AS `full_name`,`payroll_partners_contribution_hdmf`.`company` AS `company`,`payroll_partners_contribution_hdmf`.`company_id` AS `company_id`,`payroll_partners_contribution_hdmf`.`pagibig_branch_code` AS `bcode`,`payroll_partners_contribution_hdmf`.`pagibig_branch_code` AS `pagibig_branch_code`,`payroll_partners_contribution_hdmf`.`co_hdmf` AS `co_hdmf`,`payroll_partners_contribution_hdmf`.`co_address` AS `co_address`,`payroll_partners_contribution_hdmf`.`zipcode` AS `zipcode`,`payroll_partners_contribution_hdmf`.`contact_no` AS `contact_no`,`payroll_partners_contribution_hdmf`.`department_id` AS `department_id`,`payroll_partners_contribution_hdmf`.`department` AS `department`,`payroll_partners_contribution_hdmf`.`branch_id` AS `branch_id`,`payroll_partners_contribution_hdmf`.`branch` AS `branch`,`payroll_partners_contribution_hdmf`.`year` AS `year`,`payroll_partners_contribution_hdmf`.`month` AS `month`,`payroll_partners_contribution_hdmf`.`payroll_date` AS `payroll_date`,`payroll_partners_contribution_hdmf`.`birth_date` AS `birth_date`,`payroll_partners_contribution_hdmf`.`hdmf_no` AS `hdmf_no`,`payroll_partners_contribution_hdmf`.`hired_date` AS `hired_date`,`payroll_partners_contribution_hdmf`.`resigned_date` AS `resigned_date`,`payroll_partners_contribution_hdmf`.`sbr_no_hdmf` AS `sbr_no_hdmf`,`payroll_partners_contribution_hdmf`.`sbr_date_hdmf` AS `sbr_date_hdmf`,`payroll_partners_contribution_hdmf`.`govt_status` AS `govt_status`,`payroll_partners_contribution_hdmf`.`hdmf_emp` AS `hdmf_emp`,`payroll_partners_contribution_hdmf`.`hdmf_com` AS `hdmf_com`,`payroll_partners_contribution_hdmf`.`PagIbigAdd` AS `PagIbigAdd`,`payroll_partners_contribution_hdmf`.`record` AS `record`,now() AS `document_date` from `payroll_partners_contribution_hdmf` */;

/*View structure for view payroll_partners */

/*!50001 DROP TABLE IF EXISTS `payroll_partners` */;
/*!50001 DROP VIEW IF EXISTS `payroll_partners` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_partners` AS (select `ww_payroll_partners`.`user_id` AS `user_id`,`ww_payroll_partners`.`company_id` AS `company_id`,`ww_payroll_partners`.`taxcode_id` AS `taxcode_id`,`ww_payroll_partners`.`payroll_rate_type_id` AS `payroll_rate_type_id`,`ww_payroll_partners`.`payroll_schedule_id` AS `payroll_schedule_id`,`ww_payroll_partners`.`total_year_days` AS `total_year_days`,`ww_payroll_partners`.`salary` AS `salary`,`ww_payroll_partners`.`minimum_takehome` AS `minimum_takehome`,`ww_payroll_partners`.`bank_account` AS `bank_account`,`ww_payroll_partners`.`quitclaim` AS `quitclaim`,`ww_payroll_partners`.`location_id` AS `location_id`,`ww_payroll_partners`.`sss_no` AS `sss_no`,`ww_payroll_partners`.`sss_mode` AS `sss_mode`,`ww_payroll_partners`.`sss_week` AS `sss_week`,`ww_payroll_partners`.`sss_amount` AS `sss_amount`,`ww_payroll_partners`.`hdmf_no` AS `hdmf_no`,`ww_payroll_partners`.`hdmf_mode` AS `hdmf_mode`,`ww_payroll_partners`.`hdmf_week` AS `hdmf_week`,`ww_payroll_partners`.`hdmf_amount` AS `hdmf_amount`,`ww_payroll_partners`.`phic_no` AS `phic_no`,`ww_payroll_partners`.`phic_mode` AS `phic_mode`,`ww_payroll_partners`.`phic_week` AS `phic_week`,`ww_payroll_partners`.`phic_amount` AS `phic_amount`,`ww_payroll_partners`.`ecola_week` AS `ecola_week`,`ww_payroll_partners`.`tin` AS `tin`,`ww_payroll_partners`.`tax_mode` AS `tax_mode`,`ww_payroll_partners`.`tax_week` AS `tax_week`,`ww_payroll_partners`.`payment_type_id` AS `payment_type_id`,`ww_payroll_partners`.`fixed_rate` AS `fixed_rate`,`ww_payroll_partners`.`sensitivity` AS `sensitivity`,`ww_payroll_partners`.`created_by` AS `created_by`,`ww_payroll_partners`.`created_on` AS `created_on`,`ww_payroll_partners`.`modified_by` AS `modified_by`,`ww_payroll_partners`.`modified_on` AS `modified_on`,`ww_payroll_partners`.`remain` AS `remain`,`ww_payroll_partners`.`deleted` AS `deleted` from `ww_payroll_partners` where (`ww_payroll_partners`.`deleted` = 0)) */;

/*View structure for view payroll_partners_contribution */

/*!50001 DROP TABLE IF EXISTS `payroll_partners_contribution` */;
/*!50001 DROP VIEW IF EXISTS `payroll_partners_contribution` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_partners_contribution` AS select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`up`.`title` AS `title`,`up`.`lastname` AS `lastname`,`up`.`firstname` AS `firstname`,`up`.`middlename` AS `middlename`,`up`.`suffix` AS `suffix`,`u`.`full_name` AS `full_name`,`uc`.`company` AS `company`,`pp`.`company_id` AS `company_id`,`uc`.`tin` AS `tin`,`uc`.`sss` AS `co_sss`,`uc`.`phic` AS `co_phic`,`uc`.`hdmf` AS `co_hdmf`,`uc`.`address` AS `co_address`,`uc`.`zipcode` AS `zipcode`,`uc`.`company_code` AS `company_code`,`getcompany_contact`(`pp`.`company_id`,'phone') AS `contact_no`,`ud`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,year(`pct`.`payroll_date`) AS `year`,month(`pct`.`payroll_date`) AS `month`,`pct`.`payroll_date` AS `payroll_date`,`up`.`birth_date` AS `birth_date`,`pp`.`sss_no` AS `sss_no`,`pp`.`phic_no` AS `phic_no`,`pp`.`hdmf_no` AS `hdmf_no`,`p`.`effectivity_date` AS `hired_date`,`p`.`resigned_date` AS `resigned_date`,`get_sbr_no`(`pct`.`employee_id`,`pct`.`payroll_date`,'HDMF_EMP') AS `sbr_no_hdmf`,`get_sbr_no`(`pct`.`employee_id`,`pct`.`payroll_date`,'PHIC_EMP') AS `sbr_no_phic`,`get_sbr_no`(`pct`.`employee_id`,`pct`.`payroll_date`,'SSS_EMP') AS `sbr_no_sss`,`get_sbr_date`(`pct`.`employee_id`,`pct`.`payroll_date`,'HDMF_EMP') AS `sbr_date_hdmf`,`get_sbr_date`(`pct`.`employee_id`,`pct`.`payroll_date`,'PHIC_EMP') AS `sbr_date_phic`,`get_sbr_date`(`pct`.`employee_id`,`pct`.`payroll_date`,'SSS_EMP') AS `sbr_date_sss`,(case when ((year(`p`.`effectivity_date`) = year(`pct`.`payroll_date`)) and (month(`p`.`effectivity_date`) = month(`pct`.`payroll_date`))) then '1' when ((year(`p`.`resigned_date`) = year(`pct`.`payroll_date`)) and (month(`p`.`resigned_date`) = month(`pct`.`payroll_date`))) then '2' else 'N' end) AS `govt_status`,sum(((case when (`pct`.`transaction_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss_emp`,sum(((case when (`pct`.`transaction_code` = 'SSS_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss_com`,sum(((case when (`pct`.`transaction_code` = 'SSS_ECC') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss_ecc`,(sum(((case when (`pct`.`transaction_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`pct`.`transaction_code` = 'PagIbigAdd') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `hdmf_emp`,sum(((case when (`pct`.`transaction_code` = 'HDMF_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf_com`,sum(((case when (`pct`.`transaction_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `phic_emp`,sum(((case when (`pct`.`transaction_code` = 'PHIC_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `phic_com` from (((((((`ww_payroll_closed_transaction` `pct` join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `pct`.`employee_id`))) join `ww_partners` `p` on((`pct`.`employee_id` = `p`.`user_id`))) join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`pct`.`employee_id` = `up`.`user_id`))) join `ww_users_company` `uc` on((`uc`.`company_id` = `pp`.`company_id`))) join `ww_users_department` `ud` on((`up`.`department_id` = `ud`.`department_id`))) left join `ww_users_branch` `b` on((`b`.`branch_id` = `up`.`branch_id`))) where ((`pct`.`transaction_code` in ('SSS_EMP','SSS_COM','SSS_ECC','HDMF_EMP','HDMF_COM','PHIC_EMP','PHIC_COM','PagIbigAdd')) and (`pct`.`deleted` = 0) and (`pct`.`on_hold` = 0)) group by `u`.`user_id`,`p`.`id_number`,`u`.`full_name`,`up`.`company`,`up`.`company_id`,`uc`.`sss`,`uc`.`phic`,`uc`.`hdmf`,`uc`.`address`,`ud`.`department_id`,`ud`.`department`,year(`pct`.`payroll_date`),month(`pct`.`payroll_date`),`up`.`birth_date`,`pp`.`sss_no`,`pp`.`phic_no`,`pp`.`hdmf_no` */;

/*View structure for view payroll_partners_contribution_current_and_closed */

/*!50001 DROP TABLE IF EXISTS `payroll_partners_contribution_current_and_closed` */;
/*!50001 DROP VIEW IF EXISTS `payroll_partners_contribution_current_and_closed` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_partners_contribution_current_and_closed` AS select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`up`.`title` AS `title`,`up`.`lastname` AS `lastname`,`up`.`firstname` AS `firstname`,`up`.`middlename` AS `middlename`,`up`.`suffix` AS `suffix`,`u`.`full_name` AS `full_name`,`uc`.`company` AS `company`,`pp`.`company_id` AS `company_id`,`uc`.`tin` AS `tin`,`uc`.`sss` AS `co_sss`,`uc`.`phic` AS `co_phic`,`uc`.`hdmf` AS `co_hdmf`,`uc`.`address` AS `co_address`,`uc`.`zipcode` AS `zipcode`,`uc`.`company_code` AS `company_code`,`getcompany_contact`(`pp`.`company_id`,'phone') AS `contact_no`,`ud`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,year(`pct`.`payroll_date`) AS `year`,month(`pct`.`payroll_date`) AS `month`,`pct`.`payroll_date` AS `payroll_date`,`up`.`birth_date` AS `birth_date`,`pp`.`sss_no` AS `sss_no`,`pp`.`phic_no` AS `phic_no`,`pp`.`hdmf_no` AS `hdmf_no`,`p`.`effectivity_date` AS `hired_date`,`p`.`resigned_date` AS `resigned_date`,`get_sbr_no`(`pct`.`employee_id`,`pct`.`payroll_date`,'HDMF_EMP') AS `sbr_no_hdmf`,`get_sbr_no`(`pct`.`employee_id`,`pct`.`payroll_date`,'PHIC_EMP') AS `sbr_no_phic`,`get_sbr_no`(`pct`.`employee_id`,`pct`.`payroll_date`,'SSS_EMP') AS `sbr_no_sss`,`get_sbr_date`(`pct`.`employee_id`,`pct`.`payroll_date`,'HDMF_EMP') AS `sbr_date_hdmf`,`get_sbr_date`(`pct`.`employee_id`,`pct`.`payroll_date`,'PHIC_EMP') AS `sbr_date_phic`,`get_sbr_date`(`pct`.`employee_id`,`pct`.`payroll_date`,'SSS_EMP') AS `sbr_date_sss`,(case when ((year(`p`.`effectivity_date`) = year(`pct`.`payroll_date`)) and (month(`p`.`effectivity_date`) = month(`pct`.`payroll_date`))) then '1' when ((year(`p`.`resigned_date`) = year(`pct`.`payroll_date`)) and (month(`p`.`resigned_date`) = month(`pct`.`payroll_date`))) then '2' else 'N' end) AS `govt_status`,sum(((case when (`pct`.`transaction_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss_emp`,sum(((case when (`pct`.`transaction_code` = 'SSS_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss_com`,sum(((case when (`pct`.`transaction_code` = 'SSS_ECC') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss_ecc`,(sum(((case when (`pct`.`transaction_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`pct`.`transaction_code` = 'PagIbigAdd') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `hdmf_emp`,sum(((case when (`pct`.`transaction_code` = 'HDMF_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf_com`,sum(((case when (`pct`.`transaction_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `phic_emp`,sum(((case when (`pct`.`transaction_code` = 'PHIC_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `phic_com` from (((((((`ww_payroll_current_transaction` `pct` join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `pct`.`employee_id`))) join `ww_partners` `p` on((`pct`.`employee_id` = `p`.`user_id`))) join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`pct`.`employee_id` = `up`.`user_id`))) join `ww_users_company` `uc` on((`uc`.`company_id` = `pp`.`company_id`))) join `ww_users_department` `ud` on((`up`.`department_id` = `ud`.`department_id`))) left join `ww_users_branch` `b` on((`b`.`branch_id` = `up`.`branch_id`))) where ((`pct`.`transaction_code` in ('SSS_EMP','SSS_COM','SSS_ECC','HDMF_EMP','HDMF_COM','PHIC_EMP','PHIC_COM','PagIbigAdd')) and (`pct`.`deleted` = 0) and (`pct`.`on_hold` = 0)) group by `u`.`user_id`,`p`.`id_number`,`u`.`full_name`,`up`.`company`,`up`.`company_id`,`uc`.`sss`,`uc`.`phic`,`uc`.`hdmf`,`uc`.`address`,`ud`.`department_id`,`ud`.`department`,year(`pct`.`payroll_date`),month(`pct`.`payroll_date`),`up`.`birth_date`,`pp`.`sss_no`,`pp`.`phic_no`,`pp`.`hdmf_no` union select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`up`.`title` AS `title`,`up`.`lastname` AS `lastname`,`up`.`firstname` AS `firstname`,`up`.`middlename` AS `middlename`,`up`.`suffix` AS `suffix`,`u`.`full_name` AS `full_name`,`uc`.`company` AS `company`,`pp`.`company_id` AS `company_id`,`uc`.`tin` AS `tin`,`uc`.`sss` AS `co_sss`,`uc`.`phic` AS `co_phic`,`uc`.`hdmf` AS `co_hdmf`,`uc`.`address` AS `co_address`,`uc`.`zipcode` AS `zipcode`,`uc`.`company_code` AS `company_code`,`getcompany_contact`(`pp`.`company_id`,'phone') AS `contact_no`,`ud`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,year(`pct`.`payroll_date`) AS `year`,month(`pct`.`payroll_date`) AS `month`,`pct`.`payroll_date` AS `payroll_date`,`up`.`birth_date` AS `birth_date`,`pp`.`sss_no` AS `sss_no`,`pp`.`phic_no` AS `phic_no`,`pp`.`hdmf_no` AS `hdmf_no`,`p`.`effectivity_date` AS `hired_date`,`p`.`resigned_date` AS `resigned_date`,`get_sbr_no`(`pct`.`employee_id`,`pct`.`payroll_date`,'HDMF_EMP') AS `sbr_no_hdmf`,`get_sbr_no`(`pct`.`employee_id`,`pct`.`payroll_date`,'PHIC_EMP') AS `sbr_no_phic`,`get_sbr_no`(`pct`.`employee_id`,`pct`.`payroll_date`,'SSS_EMP') AS `sbr_no_sss`,`get_sbr_date`(`pct`.`employee_id`,`pct`.`payroll_date`,'HDMF_EMP') AS `sbr_date_hdmf`,`get_sbr_date`(`pct`.`employee_id`,`pct`.`payroll_date`,'PHIC_EMP') AS `sbr_date_phic`,`get_sbr_date`(`pct`.`employee_id`,`pct`.`payroll_date`,'SSS_EMP') AS `sbr_date_sss`,(case when ((year(`p`.`effectivity_date`) = year(`pct`.`payroll_date`)) and (month(`p`.`effectivity_date`) = month(`pct`.`payroll_date`))) then '1' when ((year(`p`.`resigned_date`) = year(`pct`.`payroll_date`)) and (month(`p`.`resigned_date`) = month(`pct`.`payroll_date`))) then '2' else 'N' end) AS `govt_status`,sum(((case when (`pct`.`transaction_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss_emp`,sum(((case when (`pct`.`transaction_code` = 'SSS_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss_com`,sum(((case when (`pct`.`transaction_code` = 'SSS_ECC') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss_ecc`,(sum(((case when (`pct`.`transaction_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`pct`.`transaction_code` = 'PagIbigAdd') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `hdmf_emp`,sum(((case when (`pct`.`transaction_code` = 'HDMF_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf_com`,sum(((case when (`pct`.`transaction_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `phic_emp`,sum(((case when (`pct`.`transaction_code` = 'PHIC_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `phic_com` from (((((((`ww_payroll_closed_transaction` `pct` join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `pct`.`employee_id`))) join `ww_partners` `p` on((`pct`.`employee_id` = `p`.`user_id`))) join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`pct`.`employee_id` = `up`.`user_id`))) join `ww_users_company` `uc` on((`uc`.`company_id` = `pp`.`company_id`))) join `ww_users_department` `ud` on((`up`.`department_id` = `ud`.`department_id`))) left join `ww_users_branch` `b` on((`b`.`branch_id` = `up`.`branch_id`))) where ((`pct`.`transaction_code` in ('SSS_EMP','SSS_COM','SSS_ECC','HDMF_EMP','HDMF_COM','PHIC_EMP','PHIC_COM','PagIbigAdd')) and (`pct`.`deleted` = 0) and (`pct`.`on_hold` = 0)) group by `u`.`user_id`,`p`.`id_number`,`u`.`full_name`,`up`.`company`,`up`.`company_id`,`uc`.`sss`,`uc`.`phic`,`uc`.`hdmf`,`uc`.`address`,`ud`.`department_id`,`ud`.`department`,year(`pct`.`payroll_date`),month(`pct`.`payroll_date`),`up`.`birth_date`,`pp`.`sss_no`,`pp`.`phic_no`,`pp`.`hdmf_no` */;

/*View structure for view payroll_partners_contribution_hdmf */

/*!50001 DROP TABLE IF EXISTS `payroll_partners_contribution_hdmf` */;
/*!50001 DROP VIEW IF EXISTS `payroll_partners_contribution_hdmf` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_partners_contribution_hdmf` AS select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`up`.`title` AS `title`,`up`.`lastname` AS `lastname`,`up`.`firstname` AS `firstname`,`up`.`middlename` AS `middlename`,`up`.`suffix` AS `suffix`,`u`.`full_name` AS `full_name`,`uc`.`company` AS `company`,`pp`.`company_id` AS `company_id`,`b`.`hdmf_branch_code` AS `bcode`,if(((`b`.`hdmf_branch_code` <> '00') and (`b`.`hdmf_branch_code` is not null)),`b`.`hdmf_branch_code`,ifnull(`uc`.`hdmf_branch_code`,'00')) AS `pagibig_branch_code`,`uc`.`hdmf` AS `co_hdmf`,`uc`.`address` AS `co_address`,`uc`.`zipcode` AS `zipcode`,`uc`.`company_code` AS `company_code`,`getcompany_contact`(`pp`.`company_id`,'phone') AS `contact_no`,`ud`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,year(`pct`.`payroll_date`) AS `year`,month(`pct`.`payroll_date`) AS `month`,`pct`.`payroll_date` AS `payroll_date`,`up`.`birth_date` AS `birth_date`,`pp`.`hdmf_no` AS `hdmf_no`,`p`.`effectivity_date` AS `hired_date`,`p`.`resigned_date` AS `resigned_date`,'' AS `sbr_no_hdmf`,'' AS `sbr_date_hdmf`,(case when ((year(`p`.`effectivity_date`) = year(`pct`.`payroll_date`)) and (month(`p`.`effectivity_date`) = month(`pct`.`payroll_date`))) then '1' when ((year(`p`.`resigned_date`) = year(`pct`.`payroll_date`)) and (month(`p`.`resigned_date`) = month(`pct`.`payroll_date`))) then '2' else 'N' end) AS `govt_status`,(sum(((case when (`pct`.`transaction_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`pct`.`transaction_code` = 'PagIbigAdd') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `hdmf_emp`,sum(((case when (`pct`.`transaction_code` = 'HDMF_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf_com`,sum(((case when (`pct`.`transaction_code` = 'PagIbigAdd') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `PagIbigAdd`,concat('DT',rpad(`pp`.`hdmf_no`,12,' '),rpad(`p`.`id_number`,15,' '),(case when (locate('ñ',`up`.`lastname`) <> 'false') then rpad(replace(`up`.`lastname`,' *',''),30,' ') else rpad(replace(`up`.`lastname`,' *',''),30,' ') end),(case when (locate('ñ',`up`.`firstname`) <> 'false') then rpad(`up`.`firstname`,30,' ') else rpad(`up`.`firstname`,30,' ') end),(case when ((`up`.`middlename` <> '') and (`up`.`middlename` is not null)) then rpad(`up`.`middlename`,30,' ') else rpad('',30,' ') end),rpad(round((sum(((case when (`pct`.`transaction_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`pct`.`transaction_code` = 'PagIbigAdd') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))),2),13,' '),rpad(round(sum(((case when (`pct`.`transaction_code` = 'HDMF_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2),13,' '),rpad(ifnull(replace(`pp`.`tin`,'-',''),''),15,' '),rpad(if((`up`.`birth_date` is not null),date_format(`up`.`birth_date`,'%Y%m%d'),''),8,'0')) AS `record` from (((((((`ww_payroll_closed_transaction` `pct` join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `pct`.`employee_id`))) join `ww_partners` `p` on((`pct`.`employee_id` = `p`.`user_id`))) join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`pct`.`employee_id` = `up`.`user_id`))) join `ww_users_company` `uc` on((`uc`.`company_id` = `pp`.`company_id`))) join `ww_users_department` `ud` on((`up`.`department_id` = `ud`.`department_id`))) left join `ww_users_branch` `b` on((`b`.`branch_id` = `up`.`branch_id`))) where ((`pct`.`transaction_code` in ('HDMF_EMP','HDMF_COM','PagIbigAdd')) and (`pct`.`deleted` = 0) and (`pct`.`on_hold` = 0)) group by `u`.`user_id`,`p`.`id_number`,`u`.`full_name`,`up`.`company`,`up`.`company_id`,`uc`.`hdmf`,`uc`.`address`,`ud`.`department_id`,`ud`.`department`,year(`pct`.`payroll_date`),month(`pct`.`payroll_date`),`up`.`birth_date`,`pp`.`hdmf_no` */;

/*View structure for view payroll_partners_contribution_phic */

/*!50001 DROP TABLE IF EXISTS `payroll_partners_contribution_phic` */;
/*!50001 DROP VIEW IF EXISTS `payroll_partners_contribution_phic` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_partners_contribution_phic` AS select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`up`.`title` AS `title`,`up`.`lastname` AS `lastname`,`up`.`firstname` AS `firstname`,`up`.`middlename` AS `middlename`,`up`.`suffix` AS `suffix`,`u`.`full_name` AS `full_name`,`uc`.`company` AS `company`,`pp`.`company_id` AS `company_id`,`uc`.`tin` AS `tin`,`uc`.`sss` AS `co_sss`,`uc`.`phic` AS `co_phic`,`uc`.`hdmf` AS `co_hdmf`,`uc`.`address` AS `co_address`,`uc`.`zipcode` AS `zipcode`,`uc`.`company_code` AS `company_code`,`getcompany_contact`(`pp`.`company_id`,'phone') AS `contact_no`,`ud`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,year(`pct`.`payroll_date`) AS `year`,month(`pct`.`payroll_date`) AS `month`,`pct`.`payroll_date` AS `payroll_date`,`up`.`birth_date` AS `birth_date`,`pp`.`sss_no` AS `sss_no`,`pp`.`phic_no` AS `phic_no`,`pp`.`hdmf_no` AS `hdmf_no`,`p`.`effectivity_date` AS `hired_date`,`p`.`resigned_date` AS `resigned_date`,'' AS `sbr_no_phic`,'' AS `sbr_date_phic`,(case when ((year(`p`.`effectivity_date`) = year(`pct`.`payroll_date`)) and (month(`p`.`effectivity_date`) = month(`pct`.`payroll_date`))) then '1' when ((year(`p`.`resigned_date`) = year(`pct`.`payroll_date`)) and (month(`p`.`resigned_date`) = month(`pct`.`payroll_date`))) then '2' else 'N' end) AS `govt_status`,sum(((case when (`pct`.`transaction_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `phic_emp`,sum(((case when (`pct`.`transaction_code` = 'PHIC_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `phic_com` from (((((((`ww_payroll_closed_transaction` `pct` join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `pct`.`employee_id`))) join `ww_partners` `p` on((`pct`.`employee_id` = `p`.`user_id`))) join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`pct`.`employee_id` = `up`.`user_id`))) join `ww_users_company` `uc` on((`uc`.`company_id` = `pp`.`company_id`))) join `ww_users_department` `ud` on((`up`.`department_id` = `ud`.`department_id`))) left join `ww_users_branch` `b` on((`b`.`branch_id` = `up`.`branch_id`))) where ((`pct`.`transaction_code` in ('PHIC_EMP','PHIC_COM')) and (`pct`.`deleted` = 0) and (`pct`.`on_hold` = 0)) group by `u`.`user_id`,`p`.`id_number`,`u`.`full_name`,`up`.`company`,`up`.`company_id`,`uc`.`phic`,`uc`.`address`,`ud`.`department_id`,`ud`.`department`,year(`pct`.`payroll_date`),month(`pct`.`payroll_date`),`up`.`birth_date`,`pp`.`phic_no` */;

/*View structure for view payroll_partners_contribution_quarterly */

/*!50001 DROP TABLE IF EXISTS `payroll_partners_contribution_quarterly` */;
/*!50001 DROP VIEW IF EXISTS `payroll_partners_contribution_quarterly` */;

/*!50001 CREATE ALGORITHM=TEMPTABLE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_partners_contribution_quarterly` AS (select `payroll_partners_contribution`.`user_id` AS `user_id`,`payroll_partners_contribution`.`id_number` AS `id_number`,`payroll_partners_contribution`.`lastname` AS `lastname`,`payroll_partners_contribution`.`firstname` AS `firstname`,`payroll_partners_contribution`.`middlename` AS `middlename`,`payroll_partners_contribution`.`suffix` AS `suffix`,`payroll_partners_contribution`.`full_name` AS `full_name`,`payroll_partners_contribution`.`company` AS `company`,`payroll_partners_contribution`.`company_id` AS `company_id`,`payroll_partners_contribution`.`tin` AS `tin`,`payroll_partners_contribution`.`co_sss` AS `co_sss`,`payroll_partners_contribution`.`co_phic` AS `co_phic`,`payroll_partners_contribution`.`co_hdmf` AS `co_hdmf`,`payroll_partners_contribution`.`co_address` AS `co_address`,`payroll_partners_contribution`.`zipcode` AS `zipcode`,`payroll_partners_contribution`.`contact_no` AS `contact_no`,`payroll_partners_contribution`.`department_id` AS `department_id`,`payroll_partners_contribution`.`department` AS `department`,`payroll_partners_contribution`.`birth_date` AS `birth_date`,`payroll_partners_contribution`.`sss_no` AS `sss_no`,`payroll_partners_contribution`.`phic_no` AS `phic_no`,`payroll_partners_contribution`.`hdmf_no` AS `hdmf_no`,extract(year from `payroll_partners_contribution`.`payroll_date`) AS `year`,(case when (extract(month from `payroll_partners_contribution`.`payroll_date`) in (1,2,3)) then 1 when (extract(month from `payroll_partners_contribution`.`payroll_date`) in (4,5,6)) then 2 when (extract(month from `payroll_partners_contribution`.`payroll_date`) in (7,8,9)) then 3 when (extract(month from `payroll_partners_contribution`.`payroll_date`) in (10,11,12)) then 4 end) AS `period_month`,sum(((case extract(month from `payroll_partners_contribution`.`payroll_date`) when 1 then 1 when 4 then 1 when 7 then 1 when 10 then 1 else 0 end) * (`payroll_partners_contribution`.`sss_emp` + `payroll_partners_contribution`.`sss_com`))) AS `sss_1`,sum(((case extract(month from `payroll_partners_contribution`.`payroll_date`) when 2 then 1 when 5 then 1 when 8 then 1 when 11 then 1 else 0 end) * (`payroll_partners_contribution`.`sss_emp` + `payroll_partners_contribution`.`sss_com`))) AS `sss_2`,sum(((case extract(month from `payroll_partners_contribution`.`payroll_date`) when 3 then 1 when 6 then 1 when 9 then 1 when 12 then 1 else 0 end) * (`payroll_partners_contribution`.`sss_emp` + `payroll_partners_contribution`.`sss_com`))) AS `sss_3`,sum(((case extract(month from `payroll_partners_contribution`.`payroll_date`) when 1 then 1 when 4 then 1 when 7 then 1 when 10 then 1 else 0 end) * `payroll_partners_contribution`.`sss_ecc`)) AS `ec_1`,sum(((case extract(month from `payroll_partners_contribution`.`payroll_date`) when 2 then 1 when 5 then 1 when 8 then 1 when 11 then 1 else 0 end) * `payroll_partners_contribution`.`sss_ecc`)) AS `ec_2`,sum(((case extract(month from `payroll_partners_contribution`.`payroll_date`) when 3 then 1 when 6 then 1 when 9 then 1 when 12 then 1 else 0 end) * `payroll_partners_contribution`.`sss_ecc`)) AS `ec_3`,sum(((case extract(month from `payroll_partners_contribution`.`payroll_date`) when 1 then 1 when 4 then 1 when 7 then 1 when 10 then 1 else 0 end) * `payroll_partners_contribution`.`hdmf_emp`)) AS `hdmf_e1`,sum(((case extract(month from `payroll_partners_contribution`.`payroll_date`) when 2 then 1 when 5 then 1 when 8 then 1 when 11 then 1 else 0 end) * `payroll_partners_contribution`.`hdmf_emp`)) AS `hdmf_e2`,sum(((case extract(month from `payroll_partners_contribution`.`payroll_date`) when 3 then 1 when 6 then 1 when 9 then 1 when 12 then 1 else 0 end) * `payroll_partners_contribution`.`hdmf_emp`)) AS `hdmf_e3`,sum(((case extract(month from `payroll_partners_contribution`.`payroll_date`) when 1 then 1 when 4 then 1 when 7 then 1 when 10 then 1 else 0 end) * `payroll_partners_contribution`.`hdmf_com`)) AS `hdmf_c1`,sum(((case extract(month from `payroll_partners_contribution`.`payroll_date`) when 2 then 1 when 5 then 1 when 8 then 1 when 11 then 1 else 0 end) * `payroll_partners_contribution`.`hdmf_com`)) AS `hdmf_c2`,sum(((case extract(month from `payroll_partners_contribution`.`payroll_date`) when 3 then 1 when 6 then 1 when 9 then 1 when 12 then 1 else 0 end) * `payroll_partners_contribution`.`hdmf_com`)) AS `hdmf_c3`,sum(((case extract(month from `payroll_partners_contribution`.`payroll_date`) when 1 then 1 when 4 then 1 when 7 then 1 when 10 then 1 else 0 end) * `payroll_partners_contribution`.`phic_emp`)) AS `phic_e1`,sum(((case extract(month from `payroll_partners_contribution`.`payroll_date`) when 2 then 1 when 5 then 1 when 8 then 1 when 11 then 1 else 0 end) * `payroll_partners_contribution`.`phic_emp`)) AS `phic_e2`,sum(((case extract(month from `payroll_partners_contribution`.`payroll_date`) when 3 then 1 when 6 then 1 when 9 then 1 when 12 then 1 else 0 end) * `payroll_partners_contribution`.`phic_emp`)) AS `phic_e3`,sum(((case extract(month from `payroll_partners_contribution`.`payroll_date`) when 1 then 1 when 4 then 1 when 7 then 1 when 10 then 1 else 0 end) * `payroll_partners_contribution`.`phic_com`)) AS `phic_c1`,sum(((case extract(month from `payroll_partners_contribution`.`payroll_date`) when 2 then 1 when 5 then 1 when 8 then 1 when 11 then 1 else 0 end) * `payroll_partners_contribution`.`phic_com`)) AS `phic_c2`,sum(((case extract(month from `payroll_partners_contribution`.`payroll_date`) when 3 then 1 when 6 then 1 when 9 then 1 when 12 then 1 else 0 end) * `payroll_partners_contribution`.`phic_com`)) AS `phic_c3` from `ortigas`.`payroll_partners_contribution` group by `payroll_partners_contribution`.`user_id`,`payroll_partners_contribution`.`id_number`,`payroll_partners_contribution`.`full_name`,`payroll_partners_contribution`.`company`,`payroll_partners_contribution`.`company_id`,`payroll_partners_contribution`.`co_sss`,`payroll_partners_contribution`.`co_phic`,`payroll_partners_contribution`.`co_hdmf`,`payroll_partners_contribution`.`co_address`,`payroll_partners_contribution`.`contact_no`,`payroll_partners_contribution`.`department_id`,`payroll_partners_contribution`.`department`,`payroll_partners_contribution`.`birth_date`,`payroll_partners_contribution`.`sss_no`,`payroll_partners_contribution`.`phic_no`,`payroll_partners_contribution`.`hdmf_no`,extract(year from `payroll_partners_contribution`.`payroll_date`),(case when (extract(month from `payroll_partners_contribution`.`payroll_date`) in (1,2,3)) then 1 when (extract(month from `payroll_partners_contribution`.`payroll_date`) in (4,5,6)) then 2 when (extract(month from `payroll_partners_contribution`.`payroll_date`) in (7,8,9)) then 3 when (extract(month from `payroll_partners_contribution`.`payroll_date`) in (10,11,12)) then 4 end)) */;

/*View structure for view payroll_partners_contribution_sss */

/*!50001 DROP TABLE IF EXISTS `payroll_partners_contribution_sss` */;
/*!50001 DROP VIEW IF EXISTS `payroll_partners_contribution_sss` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_partners_contribution_sss` AS select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`up`.`title` AS `title`,`up`.`lastname` AS `lastname`,`up`.`firstname` AS `firstname`,`up`.`middlename` AS `middlename`,`up`.`suffix` AS `suffix`,`u`.`full_name` AS `full_name`,`uc`.`company` AS `company`,`pp`.`company_id` AS `company_id`,`uc`.`tin` AS `tin`,`uc`.`sss` AS `co_sss`,`uc`.`address` AS `co_address`,`uc`.`zipcode` AS `zipcode`,`uc`.`company_code` AS `company_code`,`getcompany_contact`(`pp`.`company_id`,'phone') AS `contact_no`,`ud`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,year(`pct`.`payroll_date`) AS `year`,month(`pct`.`payroll_date`) AS `month`,`pct`.`payroll_date` AS `payroll_date`,`up`.`birth_date` AS `birth_date`,`pp`.`sss_no` AS `sss_no`,`pp`.`phic_no` AS `phic_no`,`pp`.`hdmf_no` AS `hdmf_no`,`p`.`effectivity_date` AS `hired_date`,`p`.`resigned_date` AS `resigned_date`,'' AS `sbr_no_sss`,'' AS `sbr_date_sss`,(case when ((year(`p`.`effectivity_date`) = year(`pct`.`payroll_date`)) and (month(`p`.`effectivity_date`) = month(`pct`.`payroll_date`))) then '1' when ((year(`p`.`resigned_date`) = year(`pct`.`payroll_date`)) and (month(`p`.`resigned_date`) = month(`pct`.`payroll_date`))) then '2' else 'N' end) AS `govt_status`,sum(((case when (`pct`.`transaction_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss_emp`,sum(((case when (`pct`.`transaction_code` = 'SSS_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss_com`,sum(((case when (`pct`.`transaction_code` = 'SSS_ECC') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss_ecc` from (((((((`ww_payroll_closed_transaction` `pct` join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `pct`.`employee_id`))) join `ww_partners` `p` on((`pct`.`employee_id` = `p`.`user_id`))) join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`pct`.`employee_id` = `up`.`user_id`))) join `ww_users_company` `uc` on((`uc`.`company_id` = `pp`.`company_id`))) join `ww_users_department` `ud` on((`up`.`department_id` = `ud`.`department_id`))) left join `ww_users_branch` `b` on((`b`.`branch_id` = `up`.`branch_id`))) where ((`pct`.`transaction_code` in ('SSS_EMP','SSS_COM','SSS_ECC')) and (`pct`.`deleted` = 0) and (`pct`.`on_hold` = 0)) group by `u`.`user_id`,`p`.`id_number`,`u`.`full_name`,`up`.`company`,`up`.`company_id`,`uc`.`sss`,`uc`.`address`,`ud`.`department_id`,`ud`.`department`,year(`pct`.`payroll_date`),month(`pct`.`payroll_date`),`up`.`birth_date`,`pp`.`sss_no` */;

/*View structure for view payroll_partners_loan */

/*!50001 DROP TABLE IF EXISTS `payroll_partners_loan` */;
/*!50001 DROP VIEW IF EXISTS `payroll_partners_loan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_partners_loan` AS (select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`up`.`lastname` AS `lastname`,`up`.`firstname` AS `firstname`,`up`.`middlename` AS `middlename`,`up`.`suffix` AS `suffix`,`u`.`full_name` AS `full_name`,`uc`.`company` AS `company`,`pp`.`company_id` AS `company_id`,`uc`.`tin` AS `tin`,`uc`.`sss` AS `co_sss`,`uc`.`phic` AS `co_phic`,`uc`.`hdmf` AS `co_hdmf`,`uc`.`address` AS `co_address`,`uc`.`zipcode` AS `zipcode`,`getcompany_contact`(`pp`.`company_id`,'phone') AS `contact_no`,`ud`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,year(`lp`.`date_paid`) AS `year`,month(`lp`.`date_paid`) AS `month`,`up`.`birth_date` AS `birth_date`,`pp`.`sss_no` AS `sss_no`,`pp`.`phic_no` AS `phic_no`,`pp`.`hdmf_no` AS `hdmf_no`,`pl`.`loan_id` AS `loan`,`plt`.`loan_type` AS `loan_type`,`plt`.`loan_type_id` AS `loan_type_id`,`pl`.`partner_loan_id` AS `partner_loan_id`,`pl`.`description` AS `description`,round(aes_decrypt(`pl`.`running_balance`,`encryption_key`()),2) AS `balance`,`pl`.`entry_date` AS `entry_date`,(case when (`plt`.`loan_type` like '%SSS%') then 'SSS' when (`plt`.`loan_type` like '%Pag-ibig%') then 'HDMF' else `plt`.`loan_type` end) AS `category`,round(aes_decrypt(`pl`.`loan_principal`,`encryption_key`()),2) AS `loan_principal`,round(sum(aes_decrypt(`lp`.`amount`,`encryption_key`())),2) AS `amount` from ((((((((((`ww_payroll_partners_loan` `pl` left join `ww_payroll_partners_loan_payment` `lp` on((`pl`.`partner_loan_id` = `lp`.`partner_loan_id`))) left join `ww_payroll_partners` `pp` on((`pl`.`user_id` = `pp`.`user_id`))) left join `ww_partners` `p` on((`pl`.`user_id` = `p`.`user_id`))) left join `ww_users` `u` on((`pl`.`user_id` = `u`.`user_id`))) left join `ww_users_profile` `up` on((`pl`.`user_id` = `up`.`user_id`))) left join `ww_users_company` `uc` on((`pp`.`company_id` = `uc`.`company_id`))) left join `ww_users_department` `ud` on((`up`.`department_id` = `ud`.`department_id`))) left join `ww_users_branch` `b` on((`b`.`branch_id` = `up`.`branch_id`))) left join `ww_payroll_loan` `pln` on((`pl`.`loan_id` = `pln`.`loan_id`))) left join `ww_payroll_loan_type` `plt` on((`pln`.`loan_type_id` = `plt`.`loan_type_id`))) where (`lp`.`paid` = 1) group by `u`.`user_id`,`p`.`id_number`,`up`.`lastname`,`up`.`firstname`,`up`.`middlename`,`up`.`suffix`,`u`.`full_name`,`uc`.`company`,`pp`.`company_id`,`uc`.`tin`,`uc`.`sss`,`uc`.`phic`,`uc`.`hdmf`,`uc`.`address`,`uc`.`zipcode`,`getcompany_contact`(`pp`.`company_id`,'phone'),`ud`.`department_id`,`ud`.`department`,year(`lp`.`date_paid`),month(`lp`.`date_paid`),`up`.`birth_date`,`pp`.`sss_no`,`pp`.`phic_no`,`pp`.`hdmf_no`,`plt`.`loan_type`,`plt`.`loan_type_id`,`pl`.`partner_loan_id`,`pl`.`description`) */;

/*View structure for view payroll_partners_loan_hdmf */

/*!50001 DROP TABLE IF EXISTS `payroll_partners_loan_hdmf` */;
/*!50001 DROP VIEW IF EXISTS `payroll_partners_loan_hdmf` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_partners_loan_hdmf` AS (select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`up`.`lastname` AS `lastname`,`up`.`firstname` AS `firstname`,`up`.`middlename` AS `middlename`,`up`.`suffix` AS `suffix`,`u`.`full_name` AS `full_name`,`uc`.`company` AS `company`,`pp`.`company_id` AS `company_id`,`pp`.`tin` AS `tin`,`uc`.`sss` AS `co_sss`,`uc`.`phic` AS `co_phic`,`uc`.`hdmf` AS `co_hdmf`,`uc`.`address` AS `co_address`,`uc`.`zipcode` AS `zipcode`,`getcompany_contact`(`pp`.`company_id`,'phone') AS `contact_no`,`ud`.`department_id` AS `department_id`,`ud`.`department` AS `department`,year(`lp`.`date_paid`) AS `year`,month(`lp`.`date_paid`) AS `month`,`up`.`birth_date` AS `birth_date`,`pp`.`sss_no` AS `sss_no`,`pp`.`phic_no` AS `phic_no`,`pp`.`hdmf_no` AS `hdmf_no`,`plt`.`loan_type` AS `loan_type`,`plt`.`loan_type_id` AS `loan_type_id`,`pl`.`partner_loan_id` AS `partner_loan_id`,`pl`.`description` AS `description`,`lp`.`balance` AS `balance`,aes_decrypt(`pl`.`loan_principal`,`encryption_key`()) AS `loan_principal`,round(sum(aes_decrypt(`lp`.`amount`,`encryption_key`())),2) AS `amount` from (((((((((`ww_payroll_partners_loan` `pl` left join `ww_payroll_partners_loan_payment` `lp` on((`pl`.`partner_loan_id` = `lp`.`partner_loan_id`))) left join `ww_payroll_partners` `pp` on((`pl`.`user_id` = `pp`.`user_id`))) left join `ww_partners` `p` on((`pl`.`user_id` = `p`.`user_id`))) left join `ww_users` `u` on((`pl`.`user_id` = `u`.`user_id`))) left join `ww_users_profile` `up` on((`pl`.`user_id` = `up`.`user_id`))) left join `ww_users_company` `uc` on((`pp`.`company_id` = `uc`.`company_id`))) left join `ww_users_department` `ud` on((`up`.`department_id` = `ud`.`department_id`))) left join `ww_payroll_loan` `pln` on((`pl`.`loan_id` = `pln`.`loan_id`))) left join `ww_payroll_loan_type` `plt` on((`pln`.`loan_type_id` = `plt`.`loan_type_id`))) where ((`plt`.`loan_type` like '%Pag-Ibig%') and (`lp`.`paid` = 1)) group by `u`.`user_id`,`p`.`id_number`,`up`.`lastname`,`up`.`firstname`,`up`.`middlename`,`up`.`suffix`,`u`.`full_name`,`uc`.`company`,`pp`.`company_id`,`uc`.`tin`,`uc`.`sss`,`uc`.`phic`,`uc`.`hdmf`,`uc`.`address`,`uc`.`zipcode`,`getcompany_contact`(`pp`.`company_id`,'phone'),`ud`.`department_id`,`ud`.`department`,year(`lp`.`date_paid`),month(`lp`.`date_paid`),`up`.`birth_date`,`pp`.`sss_no`,`pp`.`phic_no`,`pp`.`hdmf_no`,`plt`.`loan_type`,`plt`.`loan_type_id`,`pl`.`partner_loan_id`,`pl`.`description`) */;

/*View structure for view payroll_partners_loan_sss */

/*!50001 DROP TABLE IF EXISTS `payroll_partners_loan_sss` */;
/*!50001 DROP VIEW IF EXISTS `payroll_partners_loan_sss` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_partners_loan_sss` AS (select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`up`.`lastname` AS `lastname`,`up`.`firstname` AS `firstname`,`up`.`middlename` AS `middlename`,`up`.`suffix` AS `suffix`,`u`.`full_name` AS `full_name`,`uc`.`company` AS `company`,`pp`.`company_id` AS `company_id`,`uc`.`tin` AS `tin`,`uc`.`sss` AS `co_sss`,`uc`.`phic` AS `co_phic`,`uc`.`hdmf` AS `co_hdmf`,`uc`.`address` AS `co_address`,`uc`.`zipcode` AS `zipcode`,`getcompany_contact`(`pp`.`company_id`,'phone') AS `contact_no`,`ud`.`department_id` AS `department_id`,`ud`.`department` AS `department`,year(`lp`.`payroll_date`) AS `year`,month(`lp`.`payroll_date`) AS `month`,`up`.`birth_date` AS `birth_date`,`pp`.`sss_no` AS `sss_no`,`pp`.`phic_no` AS `phic_no`,`pp`.`hdmf_no` AS `hdmf_no`,`plt`.`loan_type` AS `loan_type`,`plt`.`loan_type_id` AS `loan_type_id`,`pl`.`partner_loan_id` AS `partner_loan_id`,`pl`.`description` AS `description`,`lp`.`balance` AS `balance`,aes_decrypt(`pl`.`loan_principal`,`encryption_key`()) AS `loan_principal`,aes_decrypt(`lp`.`amount`,`encryption_key`()) AS `amount` from (((((((((`ww_payroll_partners_loan` `pl` left join `ww_payroll_partners_loan_payment` `lp` on((`pl`.`partner_loan_id` = `lp`.`partner_loan_id`))) left join `ww_payroll_partners` `pp` on((`pl`.`user_id` = `pp`.`user_id`))) left join `ww_partners` `p` on((`pl`.`user_id` = `p`.`user_id`))) left join `ww_users` `u` on((`pl`.`user_id` = `u`.`user_id`))) left join `ww_users_profile` `up` on((`pl`.`user_id` = `up`.`user_id`))) left join `ww_users_company` `uc` on((`pp`.`company_id` = `uc`.`company_id`))) left join `ww_users_department` `ud` on((`up`.`department_id` = `ud`.`department_id`))) left join `ww_payroll_loan` `pln` on((`pl`.`loan_id` = `pln`.`loan_id`))) left join `ww_payroll_loan_type` `plt` on((`pln`.`loan_type_id` = `plt`.`loan_type_id`))) where ((`plt`.`loan_type` like '%SSS%') and (`lp`.`paid` = 1)) group by `u`.`user_id`,`p`.`id_number`,`up`.`lastname`,`up`.`firstname`,`up`.`middlename`,`up`.`suffix`,`u`.`full_name`,`uc`.`company`,`pp`.`company_id`,`uc`.`tin`,`uc`.`sss`,`uc`.`phic`,`uc`.`hdmf`,`uc`.`address`,`uc`.`zipcode`,`getcompany_contact`(`pp`.`company_id`,'phone'),`ud`.`department_id`,`ud`.`department`,year(`lp`.`payroll_date`),month(`lp`.`payroll_date`),`up`.`birth_date`,`pp`.`sss_no`,`pp`.`phic_no`,`pp`.`hdmf_no`,`plt`.`loan_type`,`plt`.`loan_type_id`,`pl`.`partner_loan_id`,`pl`.`description`) */;

/*View structure for view payroll_payslip */

/*!50001 DROP TABLE IF EXISTS `payroll_payslip` */;
/*!50001 DROP VIEW IF EXISTS `payroll_payslip` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_payslip` AS select `u`.`user_id` AS `employee`,`pp`.`company_id` AS `company_id`,`uc`.`company` AS `company`,`uc`.`address` AS `address`,`uc`.`city` AS `city`,`u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`up`.`department_id` AS `department_id`,`d`.`department_code` AS `department_code`,`uproj`.`project_id` AS `project_id`,`uproj`.`project_code` AS `project_code`,`uproj`.`project` AS `project`,`prt`.`payroll_rate_type_id` AS `payroll_rate_type_id`,`prt`.`payroll_rate_type` AS `payroll_rate_type`,0 AS `adjustment`,0 AS `other_taxable`,0 AS `absent_tardy`,0 AS `sss`,0 AS `philhealth`,0 AS `pag_ibig`,0 AS `nontax_income`,0 AS `nd`,0 AS `reg`,0 AS `rest`,0 AS `rest_x8`,0 AS `sp`,0 AS `sp_x8`,0 AS `rest_sp`,0 AS `rest_sp_x8`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGOT')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `legal`,0 AS `legal_x8`,0 AS `rest_legal`,0 AS `rest_leg_x8`,0 AS `nd_otnd`,0 AS `reg_otnd`,0 AS `rest_otnd`,0 AS `rest_x8_otnd`,0 AS `sp_otnd`,0 AS `sp_x8_otnd`,0 AS `rest_sp_otnd`,0 AS `rest_sp_x8_otnd`,0 AS `legal_otnd`,0 AS `legal_x8_otnd`,0 AS `rest_legal_otnd`,0 AS `rest_leg_x8_otnd`,0 AS `nd_hrs`,0 AS `reg_hrs`,0 AS `rest_hrs`,0 AS `rest_x8_hrs`,0 AS `sp_hrs`,0 AS `sp_x8_hrs`,0 AS `rest_sp_hrs`,0 AS `rest_sp_x8_hrs`,0 AS `legal_hrs`,0 AS `legal_x8_hrs`,0 AS `rest_legal_hrs`,0 AS `rest_leg_x8_hrs`,0 AS `health_card`,0 AS `other_deduction_one`,0 AS `other_deduction_two`,0 AS `other_deduction_three`,0 AS `sss_sal_loan_payments`,0 AS `sss_cal_loan_payments`,0 AS `hdmf_sal_loan_payments`,0 AS `hdmf_cal_loan_payments`,0 AS `company_loan_payments`,0 AS `sss_sal_loan_balance`,0 AS `sss_cal_loan_balance`,0 AS `hdmf_sal_loan_balance`,0 AS `hdmf_cal_loan_balance`,0 AS `tax_status`,0 AS `ytd_sss`,0 AS `ytd_philhealth`,0 AS `ytd_pag_ibig`,`pp`.`tin` AS `tin`,`pt`.`transaction_label` AS `transaction_label`,`ptc`.`transaction_class_code` AS `transaction_class_code`,`pt`.`transaction_code` AS `transaction_code`,(case when (`pct`.`transaction_code` in ('ABSENCES','ABSENCES_ADJ','LWOP','LWOP_ADJ')) then concat(aes_decrypt(`pct`.`quantity`,`encryption_key`()),' (',`getabsent`(`t`.`payroll_date`,`u`.`user_id`,`pct`.`transaction_code`),') ') else aes_decrypt(`pct`.`quantity`,`encryption_key`()) end) AS `qty`,round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) AS `amount`,`pct`.`transaction_type_id` AS `transaction_type_id`,(case when (`pct`.`transaction_type_id` in (1,2,6,7,8)) then 'Earnings' when (`pct`.`transaction_type_id` in (3,4,5)) then 'Deductions' when (`pct`.`transaction_code` = 'NETPAY') then 'Netpay' else '' end) AS `group`,(case when ((`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) and (`ptc`.`government_mandated` = 0)) then 'Loan' when ((`ptc`.`government_mandated` = 1) or (`ptc`.`transaction_class_code` = 'WHTAX')) then 'government' when (`ptc`.`transaction_class_code` = 'OVERTIME') then 'overtime' when ((`ptc`.`transaction_class_code` in ('ABSENCES','DEDUCTION_LATE','DEDUCTION_UNDERTIME')) or (`pt`.`transaction_code` = 'LWOP')) then 'attnd_ded' when (`pt`.`transaction_type_id` = 8) then 'Bonus' when (`pt`.`transaction_type_id` in (2,6)) then 'Benefits' when ((`pt`.`transaction_type_id` = 1) and (`pt`.`transaction_id` <> 1)) then 'Earnings' when (`pt`.`transaction_id` = 1) then 'salary' when (`pt`.`transaction_code` = 'NETPAY') then 'Netpay' else (case when (`pt`.`transaction_type_id` in (3,4,5)) then 'Oth_ded' when (`pt`.`transaction_type_id` in (1,2,6,7,8)) then 'Oth_inc' else '' end) end) AS `type`,(case when (`ptc`.`transaction_class_code` = 'LOAN_AMORTIZATION') then `pct`.`record_id` else '' end) AS `record_id`,(case when (`ptc`.`transaction_class_code` = 'LOAN_AMORTIZATION') then round(aes_decrypt(`pl`.`beginning_balance`,`encryption_key`()),2) else 0 end) AS `beginning_balance`,(case when (`ptc`.`transaction_class_code` = 'LOAN_AMORTIZATION') then round(aes_decrypt(`pl`.`running_balance`,`encryption_key`()),2) else 0 end) AS `running_balance`,`t`.`payroll_date` AS `payroll_date`,`t`.`date_from` AS `date_from`,`t`.`date_to` AS `date_to`,`tc`.`taxcode` AS `taxcode`,`getcompany_contact`(`pct`.`company_id`,'Phone') AS `phone_no`,`getcompany_contact`(`pct`.`company_id`,'Fax') AS `fax_no` from ((((((((((((((`ww_payroll_current_transaction` `pct` join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_partners` `p` on((`u`.`user_id` = `p`.`user_id`))) join `ww_partners_personal` `ppe` on((`p`.`partner_id` = `ppe`.`partner_id`))) join `ww_taxcode` `tc` on((`tc`.`taxcode_id` = `ppe`.`key_value`))) join `ww_users_profile` `up` on((`u`.`user_id` = `up`.`user_id`))) join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `u`.`user_id`))) join `ww_users_department` `d` on((`d`.`department_id` = `up`.`department_id`))) join `ww_users_company` `uc` on((`uc`.`company_id` = `pp`.`company_id`))) left join `ww_payroll_period` `t` on((`t`.`payroll_period_id` = `pct`.`period_id`))) left join `ww_payroll_transaction` `pt` on((`pt`.`transaction_id` = `pct`.`transaction_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_payroll_partners_loan` `pl` on((`pl`.`partner_loan_id` = `pct`.`record_id`))) left join `ww_users_project` `uproj` on((`pct`.`project_id` = `uproj`.`project_id`))) left join `ww_payroll_rate_type` `prt` on((`pct`.`payroll_rate_type_id` = `prt`.`payroll_rate_type_id`))) where ((`pct`.`on_hold` = 0) and (`ppe`.`key` = 'taxcode')) union all select `u`.`user_id` AS `employee`,`pp`.`company_id` AS `company_id`,`uc`.`company` AS `company`,`uc`.`address` AS `address`,`uc`.`city` AS `city`,`u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`up`.`department_id` AS `department_id`,`d`.`department_code` AS `department_code`,`uproj`.`project_id` AS `project_id`,`uproj`.`project_code` AS `project_code`,`uproj`.`project` AS `project`,`prt`.`payroll_rate_type_id` AS `payroll_rate_type_id`,`prt`.`payroll_rate_type` AS `payroll_rate_type`,0 AS `adjustment`,0 AS `other_taxable`,0 AS `absent_tardy`,0 AS `sss`,0 AS `philhealth`,0 AS `pag_ibig`,0 AS `nontax_income`,0 AS `nd`,0 AS `reg`,0 AS `rest`,0 AS `rest_x8`,0 AS `sp`,0 AS `sp_x8`,0 AS `rest_sp`,0 AS `rest_sp_x8`,(case when ((`ptc`.`transaction_class_code` = 'OVERTIME') and (`pct`.`transaction_code` = 'LEGOT')) then round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) else 0 end) AS `legal`,0 AS `legal_x8`,0 AS `rest_legal`,0 AS `rest_leg_x8`,0 AS `nd_otnd`,0 AS `reg_otnd`,0 AS `rest_otnd`,0 AS `rest_x8_otnd`,0 AS `sp_otnd`,0 AS `sp_x8_otnd`,0 AS `rest_sp_otnd`,0 AS `rest_sp_x8_otnd`,0 AS `legal_otnd`,0 AS `legal_x8_otnd`,0 AS `rest_legal_otnd`,0 AS `rest_leg_x8_otnd`,0 AS `nd_hrs`,0 AS `reg_hrs`,0 AS `rest_hrs`,0 AS `rest_x8_hrs`,0 AS `sp_hrs`,0 AS `sp_x8_hrs`,0 AS `rest_sp_hrs`,0 AS `rest_sp_x8_hrs`,0 AS `legal_hrs`,0 AS `legal_x8_hrs`,0 AS `rest_legal_hrs`,0 AS `rest_leg_x8_hrs`,0 AS `health_card`,0 AS `other_deduction_one`,0 AS `other_deduction_two`,0 AS `other_deduction_three`,0 AS `sss_sal_loan_payments`,0 AS `sss_cal_loan_payments`,0 AS `hdmf_sal_loan_payments`,0 AS `hdmf_cal_loan_payments`,0 AS `company_loan_payments`,0 AS `sss_sal_loan_balance`,0 AS `sss_cal_loan_balance`,0 AS `hdmf_sal_loan_balance`,0 AS `hdmf_cal_loan_balance`,0 AS `tax_status`,0 AS `ytd_sss`,0 AS `ytd_philhealth`,0 AS `ytd_pag_ibig`,`pp`.`tin` AS `tin`,`pt`.`transaction_label` AS `transaction_label`,`ptc`.`transaction_class_code` AS `transaction_class_code`,`pt`.`transaction_code` AS `transaction_code`,(case when (`pct`.`transaction_code` in ('ABSENCES','ABSENCES_ADJ','LWOP','LWOP_ADJ')) then concat(aes_decrypt(`pct`.`quantity`,`encryption_key`()),' (',`getabsent`(`t`.`payroll_date`,`u`.`user_id`,`pct`.`transaction_code`),') ') else aes_decrypt(`pct`.`quantity`,`encryption_key`()) end) AS `qty`,round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2) AS `amount`,`pct`.`transaction_type_id` AS `transaction_type_id`,(case when (`pct`.`transaction_type_id` in (1,2,6,7,8)) then 'Earnings' when (`pct`.`transaction_type_id` in (3,4,5)) then 'Deductions' when (`pct`.`transaction_code` = 'NETPAY') then 'Netpay' else '' end) AS `group`,(case when ((`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) and (`ptc`.`government_mandated` = 0)) then 'Loan' when ((`ptc`.`government_mandated` = 1) or (`ptc`.`transaction_class_code` = 'WHTAX')) then 'government' when (`ptc`.`transaction_class_code` = 'OVERTIME') then 'overtime' when ((`ptc`.`transaction_class_code` in ('ABSENCES','DEDUCTION_LATE','DEDUCTION_UNDERTIME')) or (`pt`.`transaction_code` = 'LWOP')) then 'attnd_ded' when (`pt`.`transaction_type_id` = 8) then 'Bonus' when (`pt`.`transaction_type_id` in (2,6)) then 'Benefits' when ((`pt`.`transaction_type_id` = 1) and (`pt`.`transaction_id` <> 1)) then 'Earnings' when (`pt`.`transaction_id` = 1) then 'salary' when (`pt`.`transaction_code` = 'NETPAY') then 'Netpay' else (case when (`pt`.`transaction_type_id` in (3,4,5)) then 'Oth_ded' when (`pt`.`transaction_type_id` in (1,2,6,7,8)) then 'Oth_inc' else '' end) end) AS `type`,(case when (`ptc`.`transaction_class_code` = 'LOAN_AMORTIZATION') then `pct`.`record_id` else '' end) AS `record_id`,(case when (`ptc`.`transaction_class_code` = 'LOAN_AMORTIZATION') then round(aes_decrypt(`pl`.`beginning_balance`,`encryption_key`()),2) else 0 end) AS `beginning_balance`,(case when (`ptc`.`transaction_class_code` = 'LOAN_AMORTIZATION') then round(aes_decrypt(`pl`.`running_balance`,`encryption_key`()),2) else 0 end) AS `running_balance`,`t`.`payroll_date` AS `payroll_date`,`t`.`date_from` AS `date_from`,`t`.`date_to` AS `date_to`,`tc`.`taxcode` AS `taxcode`,`getcompany_contact`(`pct`.`company_id`,'Phone') AS `phone_no`,`getcompany_contact`(`pct`.`company_id`,'Fax') AS `fax_no` from ((((((((((((((`ww_payroll_closed_transaction` `pct` join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_partners` `p` on((`u`.`user_id` = `p`.`user_id`))) join `ww_partners_personal` `ppe` on((`p`.`partner_id` = `ppe`.`partner_id`))) join `ww_taxcode` `tc` on((`tc`.`taxcode_id` = `ppe`.`key_value`))) join `ww_users_profile` `up` on((`u`.`user_id` = `up`.`user_id`))) join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `u`.`user_id`))) join `ww_users_department` `d` on((`d`.`department_id` = `up`.`department_id`))) join `ww_users_company` `uc` on((`uc`.`company_id` = `pp`.`company_id`))) left join `ww_payroll_period` `t` on((`t`.`payroll_period_id` = `pct`.`period_id`))) left join `ww_payroll_transaction` `pt` on((`pt`.`transaction_id` = `pct`.`transaction_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_payroll_partners_loan` `pl` on((`pl`.`partner_loan_id` = `pct`.`record_id`))) left join `ww_users_project` `uproj` on((`pct`.`project_id` = `uproj`.`project_id`))) left join `ww_payroll_rate_type` `prt` on((`pct`.`payroll_rate_type_id` = `prt`.`payroll_rate_type_id`))) where ((`pct`.`on_hold` = 0) and (`ppe`.`key` = 'taxcode')) */;

/*View structure for view payroll_preliminary_cost_center */

/*!50001 DROP TABLE IF EXISTS `payroll_preliminary_cost_center` */;
/*!50001 DROP VIEW IF EXISTS `payroll_preliminary_cost_center` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_preliminary_cost_center` AS select `uc`.`company` AS `company`,`uc`.`company_id` AS `company_id`,`pct`.`department_id` AS `department_id`,`d`.`department` AS `department`,`pct`.`payroll_date` AS `payroll_date`,`pct`.`payment_type_id` AS `payment_type_id`,`pct`.`location_id` AS `location_id`,`p`.`sensitivity` AS `sensitivity`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,sum(((case when (`ptc`.`transaction_class_code` = 'SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `basic`,sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `aut`,sum(((case when (`pt`.`transaction_code` in ('REGOT','REGOT_ADJ','RDOT','RDOT_ADJ','RDOT_EXCESS','RDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `ot`,sum(((case when (`pt`.`transaction_code` in ('REGND','REGND_ADJ','REGOT_ND','REGOT_ND_ADJ','LEGOT_ND','LEGOT_ND_ADJ','LEGOT_ND_EXCESS','LEGOT_ND_EXCESS_ADJ','LEGRDOT_ND','LEGRDOT_ND_ADJ','LEGRDOT_ND_EXCESS','LEGRDOT_ND_EXCESS_ADJ','RDOT_ND','RDOT_ND_ADJ','RDOT_ND_EXCESS','RDOT_ND_EXCESS_ADJ','SPEOT_ND','SPEOT_ND_ADJ','SPEOT_ND_EXCESS','SPEOT_ND_EXCESS_ADJ','SPERDOT_ND','SPERDOT_ND_ADJ','SPERDOT_ND_EXCESS','SPERDOT_ND_EXCESS_ADJ','DOBOT_ND','DOBOT_ND_ADJ','DOBOT_ND_EXCESS','DOBOT_ND_EXCESS_ADJ','DOBRDOT_ND','DOBRDOT_ND_ADJ','DOBRDOT_ND_EXCESS','DOBRDOT_ND_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `nd`,sum(((case when (`pt`.`transaction_code` in ('LEGOT','LEGOT_ADJ','LEGOT_EXCESS','LEGOT_EXCESS_ADJ','LEGRDOT','LEGRDOT_ADJ','LEGRDOT_EXCESS','LEGRDOT_EXCESS_ADJ','SPEOT','SPEOT_ADJ','SPEOT_EXCESS','SPEOT_EXCESS_ADJ','SPERDOT','SPERDOT_ADJ','SPERDOT_EXCESS','SPERDOT_EXCESS_ADJ','DOBOT','DOBOT_ADJ','DOBOT_EXCESS','DOBOT_EXCESS_ADJ','DOBRDOT','DOBRDOT_ADJ','DOBRDOT_EXCESS','DOBRDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `holiday`,sum(((case when ((`ptt`.`operation` = '+') and (`ptc`.`transaction_class_code` not in ('SALARY','OVERTIME'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `other_earnings`,sum(((case when (`ptc`.`transaction_class_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss`,sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `phic`,sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf`,sum(((case when (`ptc`.`transaction_class_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `tax`,sum(((case when (`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `loan`,sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `employee_ledger`,sum(((case when ((`ptt`.`operation` = '-') and (`ptc`.`transaction_class_code` not in ('SSS_EMP','PHIC_EMP','HDMF_EMP','WHTAX','LOAN_AMORTIZATION','LOAN_INTEREST'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `other_deduction`,sum(((case when (`pt`.`transaction_code` = 'NETPAY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `net_amount` from (((((((`ww_payroll_current_transaction` `pct` left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_payroll_transaction_type` `ptt` on((`ptt`.`transaction_type_id` = `pt`.`transaction_type_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_users_department` `d` on((`pct`.`department_id` = `d`.`department_id`))) left join `ww_payroll_partners` `p` on((`pct`.`employee_id` = `p`.`user_id`))) left join `ww_payroll_period` `pp` on((`pct`.`period_id` = `pp`.`payroll_period_id`))) left join `ww_users_company` `uc` on((`pct`.`company_id` = `uc`.`company_id`))) group by `pct`.`department_id`,`pct`.`payroll_date`,`pct`.`company_id` */;

/*View structure for view payroll_preliminary_deduction */

/*!50001 DROP TABLE IF EXISTS `payroll_preliminary_deduction` */;
/*!50001 DROP VIEW IF EXISTS `payroll_preliminary_deduction` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_preliminary_deduction` AS (select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`uc`.`company` AS `company`,`wpp`.`company_id` AS `company_id`,`ud`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`prt`.`payroll_rate_type_id` AS `payroll_rate_type_id`,`prt`.`payroll_rate_type` AS `payroll_rate_type`,`pct`.`payroll_date` AS `payroll_date`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,`pt`.`transaction_id` AS `transaction_id`,`pt`.`transaction_label` AS `transaction_label`,sum(aes_decrypt(`pct`.`amount`,`encryption_key`())) AS `amount` from (((((((((((`ww_payroll_current_transaction` `pct` left join `ww_payroll_transaction_class` `ptc` on((`ptc`.`transaction_class_id` = `pct`.`transaction_class_id`))) left join `ww_payroll_transaction` `pt` on((`pt`.`transaction_id` = `pct`.`transaction_id`))) join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) join `ww_users_department` `ud` on((`ud`.`department_id` = `up`.`department_id`))) left join `ww_users_branch` `b` on((`b`.`branch_id` = `up`.`branch_id`))) join `ww_partners` `p` on((`p`.`user_id` = `pct`.`employee_id`))) join `ww_payroll_partners` `wpp` on((`wpp`.`user_id` = `pct`.`employee_id`))) join `ww_users_company` `uc` on((`uc`.`company_id` = `wpp`.`company_id`))) left join `ww_payroll_period` `pp` on((`pp`.`payroll_period_id` = `pct`.`period_id`))) left join `ww_payroll_rate_type` `prt` on((`wpp`.`payroll_rate_type_id` = `prt`.`payroll_rate_type_id`))) where ((`pct`.`on_hold` = 0) and (`pct`.`deleted` = 0) and (`ptc`.`deleted` = 0) and (`pt`.`deleted` = 0) and (`pt`.`transaction_type_id` in (3,4,5)) and (`ptc`.`government_mandated` <> 1)) group by `u`.`user_id`,`pct`.`payroll_date`,`pt`.`transaction_label`) */;

/*View structure for view payroll_preliminary_earnings */

/*!50001 DROP TABLE IF EXISTS `payroll_preliminary_earnings` */;
/*!50001 DROP VIEW IF EXISTS `payroll_preliminary_earnings` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_preliminary_earnings` AS (select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`uc`.`company` AS `company`,`wpp`.`company_id` AS `company_id`,`ud`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`pct`.`payroll_date` AS `payroll_date`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,`pt`.`transaction_label` AS `transaction_label`,sum(aes_decrypt(`pct`.`amount`,`encryption_key`())) AS `amount`,`t`.`transaction_type` AS `transaction_type` from (((((((((((`ww_payroll_current_transaction` `pct` left join `ww_payroll_transaction_class` `ptc` on((`ptc`.`transaction_class_id` = `pct`.`transaction_class_id`))) left join `ww_payroll_transaction` `pt` on((`pt`.`transaction_id` = `pct`.`transaction_id`))) join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) join `ww_users_department` `ud` on((`ud`.`department_id` = `up`.`department_id`))) left join `ww_users_branch` `b` on((`b`.`branch_id` = `up`.`branch_id`))) left join `ww_payroll_transaction_type` `t` on((`t`.`transaction_type_id` = `pct`.`transaction_type_id`))) join `ww_partners` `p` on((`p`.`user_id` = `pct`.`employee_id`))) join `ww_payroll_partners` `wpp` on((`wpp`.`user_id` = `pct`.`employee_id`))) join `ww_users_company` `uc` on((`uc`.`company_id` = `wpp`.`company_id`))) left join `ww_payroll_period` `pp` on((`pct`.`period_id` = `pp`.`payroll_period_id`))) where ((`pct`.`on_hold` = 0) and (`pct`.`deleted` = 0) and (`ptc`.`deleted` = 0) and (`pt`.`deleted` = 0) and (`pt`.`transaction_type_id` in (1,2,6,7,8)) and (`ptc`.`transaction_class_code` <> 'SALARY')) group by `pct`.`employee_id`,`pct`.`transaction_id`,`pct`.`payroll_date`) */;

/*View structure for view payroll_preliminary_report */

/*!50001 DROP TABLE IF EXISTS `payroll_preliminary_report` */;
/*!50001 DROP VIEW IF EXISTS `payroll_preliminary_report` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_preliminary_report` AS (select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`uc`.`company` AS `company`,`wpp`.`company_id` AS `company_id`,`ud`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`pct`.`payroll_date` AS `payroll_date`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,`wpp`.`sensitivity` AS `sensitivity`,sum(((case when (`pct`.`transaction_code` = 'SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `basic`,sum(((case when (`pt`.`transaction_code` = 'E-COLA') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `cola`,sum(((case when (`pt`.`transaction_code` = 'REGND') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `nd`,sum(((case when (`ptc`.`transaction_class_code` = 'OVERTIME') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `overtime`,sum(((case when (`pct`.`transaction_code` = 'ALLOWANCE_TRANSPO') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `transpo`,sum(((case when (`pct`.`transaction_code` = 'ALLOWANCE_COMMUNICATION') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `comm`,((((((sum(((case when (`pct`.`transaction_type_id` in (1,6)) then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2))) + sum(((case when ((`pct`.`transaction_type_id` = 8) and (`ptc`.`transaction_class_code` = 'BONUS_TAXABLE')) then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2)))) - sum(((case when (`pct`.`transaction_code` = 'SALARY') then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2)))) - sum(((case when ((`pt`.`transaction_code` = 'ECOLA') and (`pct`.`transaction_type_id` = 6)) then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2)))) - sum(((case when (`ptc`.`transaction_class_code` = 'OVERTIME') then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2)))) - sum(((case when (`pct`.`transaction_code` = 'ALLOWANCE_TRANSPO') then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2)))) - sum(((case when (`pct`.`transaction_code` = 'ALLOWANCE_COMMUNICATION') then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2)))) AS `oth_inc_taxable`,((sum(((case when (`pct`.`transaction_type_id` in (2,7,8)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) - sum(((case when ((`pct`.`transaction_type_id` = 8) and (`ptc`.`transaction_class_code` = 'BONUS_TAXABLE')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) - sum(((case when ((`pt`.`transaction_code` = 'ECOLA') and (`pct`.`transaction_type_id` = 1)) then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2)))) AS `oth_inc_nontax`,sum(((case when ((`pt`.`transaction_type_id` = 5) and (`ptc`.`government_mandated` = 0)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `absences`,(sum(((case when (`pct`.`transaction_type_id` in (1,2,6,7,8)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) - sum(((case when ((`pt`.`transaction_type_id` = 5) and (`ptc`.`government_mandated` = 0)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `gross_pay`,sum(((case when (`pct`.`transaction_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `whtax`,sum(((case when (`pct`.`transaction_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss`,(sum(((case when (`pct`.`transaction_code` = 'SSS_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`pct`.`transaction_code` = 'SSS_ECC') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `Ssser`,sum(((case when (`pct`.`transaction_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `phic`,sum(((case when (`pct`.`transaction_code` = 'PHIC_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `Phicer`,sum(((case when (`pct`.`transaction_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf`,sum(((case when (`pct`.`transaction_code` = 'HDMF_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `Hdmfer`,sum(((case when (`pct`.`transaction_code` = 'PagIbigAdd') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf_add`,sum(((case when (`pct`.`transaction_code` = 'SSSLN_SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss_loan`,sum(((case when (`pct`.`transaction_code` = 'HDMFLNA') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf_loan`,((((sum(((case when (`pct`.`transaction_type_id` = 3) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) - sum(((case when (`pct`.`transaction_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) - sum(((case when (`pct`.`transaction_code` = 'PagIbigAdd') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) - sum(((case when (`pct`.`transaction_code` = 'SSSLN_SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) - sum(((case when (`pct`.`transaction_code` = 'HDMFLNA') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `oth_ded`,sum(((case when (`pct`.`transaction_code` = 'NETPAY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `netpay` from ((((((((((`ww_payroll_current_transaction` `pct` join `ww_payroll_transaction_class` `ptc` on((`ptc`.`transaction_class_id` = `pct`.`transaction_class_id`))) join `ww_payroll_transaction` `pt` on((`pt`.`transaction_id` = `pct`.`transaction_id`))) join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) join `ww_users_department` `ud` on((`ud`.`department_id` = `up`.`department_id`))) left join `ww_users_branch` `b` on((`b`.`branch_id` = `up`.`branch_id`))) join `ww_partners` `p` on((`p`.`user_id` = `pct`.`employee_id`))) join `ww_payroll_period` `pp` on((`pp`.`payroll_period_id` = `pct`.`period_id`))) join `ww_payroll_partners` `wpp` on((`wpp`.`user_id` = `up`.`user_id`))) join `ww_users_company` `uc` on((`uc`.`company_id` = `wpp`.`company_id`))) where ((`pct`.`on_hold` = 0) and (`pct`.`deleted` = 0) and (`ptc`.`deleted` = 0) and (`pt`.`deleted` = 0)) group by `pct`.`employee_id`,`pct`.`payroll_date`) */;

/*View structure for view payroll_register_closed_report */

/*!50001 DROP TABLE IF EXISTS `payroll_register_closed_report` */;
/*!50001 DROP VIEW IF EXISTS `payroll_register_closed_report` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_register_closed_report` AS select `pct`.`payroll_date` AS `payroll_date`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,`pct`.`company_id` AS `company_id`,`uc`.`company` AS `company`,`pct`.`department_id` AS `department_id`,`d`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`par`.`id_number` AS `employee_code`,`u`.`full_name` AS `employee_name`,sum(((case when (`ptc`.`transaction_class_code` = 'SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `basic`,sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `aut`,sum(((case when (`pt`.`transaction_code` in ('REGOT','REGOT_ADJ','RDOT','RDOT_ADJ','RDOT_EXCESS','RDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `ot`,sum(((case when (`pt`.`transaction_code` in ('REGND','REGND_ADJ','REGOT_ND','REGOT_ND_ADJ','LEGOT_ND','LEGOT_ND_ADJ','LEGOT_ND_EXCESS','LEGOT_ND_EXCESS_ADJ','LEGRDOT_ND','LEGRDOT_ND_ADJ','LEGRDOT_ND_EXCESS','LEGRDOT_ND_EXCESS_ADJ','RDOT_ND','RDOT_ND_ADJ','RDOT_ND_EXCESS','RDOT_ND_EXCESS_ADJ','SPEOT_ND','SPEOT_ND_ADJ','SPEOT_ND_EXCESS','SPEOT_ND_EXCESS_ADJ','SPERDOT_ND','SPERDOT_ND_ADJ','SPERDOT_ND_EXCESS','SPERDOT_ND_EXCESS_ADJ','DOBOT_ND','DOBOT_ND_ADJ','DOBOT_ND_EXCESS','DOBOT_ND_EXCESS_ADJ','DOBRDOT_ND','DOBRDOT_ND_ADJ','DOBRDOT_ND_EXCESS','DOBRDOT_ND_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `nd`,sum(((case when (`pt`.`transaction_code` in ('LEGOT','LEGOT_ADJ','LEGOT_EXCESS','LEGOT_EXCESS_ADJ','LEGRDOT','LEGRDOT_ADJ','LEGRDOT_EXCESS','LEGRDOT_EXCESS_ADJ','SPEOT','SPEOT_ADJ','SPEOT_EXCESS','SPEOT_EXCESS_ADJ','SPERDOT','SPERDOT_ADJ','SPERDOT_EXCESS','SPERDOT_EXCESS_ADJ','DOBOT','DOBOT_ADJ','DOBOT_EXCESS','DOBOT_EXCESS_ADJ','DOBRDOT','DOBRDOT_ADJ','DOBRDOT_EXCESS','DOBRDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `holiday`,sum(((case when ((`ptt`.`operation` = '+') and (`ptc`.`transaction_class_code` not in ('SALARY','OVERTIME','NIGHT DIFF'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `other_earnings`,(((((sum(((case when (`ptc`.`transaction_class_code` = 'SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`pt`.`transaction_code` in ('REGOT','REGOT_ADJ','RDOT','RDOT_ADJ','RDOT_EXCESS','RDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`pt`.`transaction_code` in ('REGND','REGND_ADJ','REGOT_ND','REGOT_ND_ADJ','LEGOT_ND','LEGOT_ND_ADJ','LEGOT_ND_EXCESS','LEGOT_ND_EXCESS_ADJ','LEGRDOT_ND','LEGRDOT_ND_ADJ','LEGRDOT_ND_EXCESS','LEGRDOT_ND_EXCESS_ADJ','RDOT_ND','RDOT_ND_ADJ','RDOT_ND_EXCESS','RDOT_ND_EXCESS_ADJ','SPEOT_ND','SPEOT_ND_ADJ','SPEOT_ND_EXCESS','SPEOT_ND_EXCESS_ADJ','SPERDOT_ND','SPERDOT_ND_ADJ','SPERDOT_ND_EXCESS','SPERDOT_ND_EXCESS_ADJ','DOBOT_ND','DOBOT_ND_ADJ','DOBOT_ND_EXCESS','DOBOT_ND_EXCESS_ADJ','DOBRDOT_ND','DOBRDOT_ND_ADJ','DOBRDOT_ND_EXCESS','DOBRDOT_ND_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`pt`.`transaction_code` in ('LEGOT','LEGOT_ADJ','LEGOT_EXCESS','LEGOT_EXCESS_ADJ','LEGRDOT','LEGRDOT_ADJ','LEGRDOT_EXCESS','LEGRDOT_EXCESS_ADJ','SPEOT','SPEOT_ADJ','SPEOT_EXCESS','SPEOT_EXCESS_ADJ','SPERDOT','SPERDOT_ADJ','SPERDOT_EXCESS','SPERDOT_EXCESS_ADJ','DOBOT','DOBOT_ADJ','DOBOT_EXCESS','DOBOT_EXCESS_ADJ','DOBRDOT','DOBRDOT_ADJ','DOBRDOT_EXCESS','DOBRDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when ((`ptt`.`operation` = '+') and (`ptc`.`transaction_class_code` not in ('SALARY','OVERTIME','NIGHT DIFF'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) - sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `gross`,sum(((case when (`ptc`.`transaction_class_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss`,sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `phic`,sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf`,sum(((case when (`ptc`.`transaction_class_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `tax`,sum(((case when (`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `loan`,sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `employee_ledger`,sum(((case when ((`ptt`.`operation` = '-') and (`ptc`.`transaction_class_code` not in ('SSS_EMP','PHIC_EMP','HDMF_EMP','WHTAX','LOAN_AMORTIZATION','LOAN_INTEREST'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `other_deduction`,((((((sum(((case when (`ptc`.`transaction_class_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when ((`ptt`.`operation` = '-') and (`ptc`.`transaction_class_code` not in ('SSS_EMP','PHIC_EMP','HDMF_EMP','WHTAX','LOAN_AMORTIZATION','LOAN_INTEREST'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `deduction`,sum(((case when (`pt`.`transaction_code` = 'NETPAY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `net_amount` from (((((((((((`ww_payroll_closed_transaction` `pct` left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_payroll_transaction_type` `ptt` on((`ptt`.`transaction_type_id` = `pt`.`transaction_type_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_users_department` `d` on((`pct`.`department_id` = `d`.`department_id`))) left join `ww_payroll_partners` `p` on((`pct`.`employee_id` = `p`.`user_id`))) left join `ww_payroll_period` `pp` on((`pct`.`period_id` = `pp`.`payroll_period_id`))) left join `ww_users_company` `uc` on((`pct`.`company_id` = `uc`.`company_id`))) left join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) left join `ww_users_profile` `up` on((`u`.`user_id` = `up`.`user_id`))) left join `ww_users_branch` `b` on((`up`.`branch_id` = `b`.`branch_id`))) left join `ww_partners` `par` on((`pct`.`employee_id` = `par`.`user_id`))) group by `pct`.`department_id`,`pct`.`employee_id`,`pct`.`payroll_date` */;

/*View structure for view payroll_register_cost_center */

/*!50001 DROP TABLE IF EXISTS `payroll_register_cost_center` */;
/*!50001 DROP VIEW IF EXISTS `payroll_register_cost_center` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_register_cost_center` AS (select `uc`.`company` AS `company`,`uc`.`company_id` AS `company_id`,`pct`.`department_id` AS `department_id`,`d`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`pct`.`payroll_date` AS `payroll_date`,`pct`.`payment_type_id` AS `payment_type_id`,`pct`.`location_id` AS `location_id`,`p`.`sensitivity` AS `sensitivity`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,sum(((case when (`ptc`.`transaction_class_code` = 'SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `basic`,sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `aut`,sum(((case when (`pt`.`transaction_code` in ('REGOT','REGOT_ADJ','RDOT','RDOT_ADJ','RDOT_EXCESS','RDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `ot`,sum(((case when (`pt`.`transaction_code` in ('REGND','REGND_ADJ','REGOT_ND','REGOT_ND_ADJ','LEGOT_ND','LEGOT_ND_ADJ','LEGOT_ND_EXCESS','LEGOT_ND_EXCESS_ADJ','LEGRDOT_ND','LEGRDOT_ND_ADJ','LEGRDOT_ND_EXCESS','LEGRDOT_ND_EXCESS_ADJ','RDOT_ND','RDOT_ND_ADJ','RDOT_ND_EXCESS','RDOT_ND_EXCESS_ADJ','SPEOT_ND','SPEOT_ND_ADJ','SPEOT_ND_EXCESS','SPEOT_ND_EXCESS_ADJ','SPERDOT_ND','SPERDOT_ND_ADJ','SPERDOT_ND_EXCESS','SPERDOT_ND_EXCESS_ADJ','DOBOT_ND','DOBOT_ND_ADJ','DOBOT_ND_EXCESS','DOBOT_ND_EXCESS_ADJ','DOBRDOT_ND','DOBRDOT_ND_ADJ','DOBRDOT_ND_EXCESS','DOBRDOT_ND_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `nd`,sum(((case when (`pt`.`transaction_code` in ('LEGOT','LEGOT_ADJ','LEGOT_EXCESS','LEGOT_EXCESS_ADJ','LEGRDOT','LEGRDOT_ADJ','LEGRDOT_EXCESS','LEGRDOT_EXCESS_ADJ','SPEOT','SPEOT_ADJ','SPEOT_EXCESS','SPEOT_EXCESS_ADJ','SPERDOT','SPERDOT_ADJ','SPERDOT_EXCESS','SPERDOT_EXCESS_ADJ','DOBOT','DOBOT_ADJ','DOBOT_EXCESS','DOBOT_EXCESS_ADJ','DOBRDOT','DOBRDOT_ADJ','DOBRDOT_EXCESS','DOBRDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `holiday`,sum(((case when ((`ptt`.`operation` = '+') and (`ptc`.`transaction_class_code` not in ('SALARY','OVERTIME'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `other_earnings`,(((((sum(((case when (`ptc`.`transaction_class_code` = 'SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`pt`.`transaction_code` in ('REGOT','REGOT_ADJ','RDOT','RDOT_ADJ','RDOT_EXCESS','RDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`pt`.`transaction_code` in ('REGND','REGND_ADJ','REGOT_ND','REGOT_ND_ADJ','LEGOT_ND','LEGOT_ND_ADJ','LEGOT_ND_EXCESS','LEGOT_ND_EXCESS_ADJ','LEGRDOT_ND','LEGRDOT_ND_ADJ','LEGRDOT_ND_EXCESS','LEGRDOT_ND_EXCESS_ADJ','RDOT_ND','RDOT_ND_ADJ','RDOT_ND_EXCESS','RDOT_ND_EXCESS_ADJ','SPEOT_ND','SPEOT_ND_ADJ','SPEOT_ND_EXCESS','SPEOT_ND_EXCESS_ADJ','SPERDOT_ND','SPERDOT_ND_ADJ','SPERDOT_ND_EXCESS','SPERDOT_ND_EXCESS_ADJ','DOBOT_ND','DOBOT_ND_ADJ','DOBOT_ND_EXCESS','DOBOT_ND_EXCESS_ADJ','DOBRDOT_ND','DOBRDOT_ND_ADJ','DOBRDOT_ND_EXCESS','DOBRDOT_ND_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`pt`.`transaction_code` in ('LEGOT','LEGOT_ADJ','LEGOT_EXCESS','LEGOT_EXCESS_ADJ','LEGRDOT','LEGRDOT_ADJ','LEGRDOT_EXCESS','LEGRDOT_EXCESS_ADJ','SPEOT','SPEOT_ADJ','SPEOT_EXCESS','SPEOT_EXCESS_ADJ','SPERDOT','SPERDOT_ADJ','SPERDOT_EXCESS','SPERDOT_EXCESS_ADJ','DOBOT','DOBOT_ADJ','DOBOT_EXCESS','DOBOT_EXCESS_ADJ','DOBRDOT','DOBRDOT_ADJ','DOBRDOT_EXCESS','DOBRDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when ((`ptt`.`operation` = '+') and (`ptc`.`transaction_class_code` not in ('SALARY','OVERTIME'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) - sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `gross`,sum(((case when (`ptc`.`transaction_class_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss`,sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `phic`,sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf`,sum(((case when (`ptc`.`transaction_class_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `tax`,sum(((case when (`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `loan`,sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `employee_ledger`,sum(((case when ((`ptt`.`operation` = '-') and (`ptc`.`transaction_class_code` not in ('SSS_EMP','PHIC_EMP','HDMF_EMP','WHTAX','LOAN_AMORTIZATION','LOAN_INTEREST'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `other_deduction`,((((((sum(((case when (`ptc`.`transaction_class_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when ((`ptt`.`operation` = '-') and (`ptc`.`transaction_class_code` not in ('SSS_EMP','PHIC_EMP','HDMF_EMP','WHTAX','LOAN_AMORTIZATION','LOAN_INTEREST'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `deduction`,sum(((case when (`pt`.`transaction_code` = 'NETPAY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `net_amount` from ((((((((((`ww_payroll_closed_transaction` `pct` left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_payroll_transaction_type` `ptt` on((`ptt`.`transaction_type_id` = `pt`.`transaction_type_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_users_department` `d` on((`pct`.`department_id` = `d`.`department_id`))) left join `ww_payroll_partners` `p` on((`pct`.`employee_id` = `p`.`user_id`))) left join `ww_payroll_period` `pp` on((`pct`.`period_id` = `pp`.`payroll_period_id`))) left join `ww_users_company` `uc` on((`pct`.`company_id` = `uc`.`company_id`))) left join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) left join `ww_users_profile` `up` on((`u`.`user_id` = `up`.`user_id`))) left join `ww_users_branch` `b` on((`up`.`branch_id` = `b`.`branch_id`))) group by `pct`.`department_id`,`pct`.`payroll_date`,`pct`.`company_id`) */;

/*View structure for view payroll_register_current_report */

/*!50001 DROP TABLE IF EXISTS `payroll_register_current_report` */;
/*!50001 DROP VIEW IF EXISTS `payroll_register_current_report` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_register_current_report` AS select `pct`.`payroll_date` AS `payroll_date`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,`pct`.`company_id` AS `company_id`,`uc`.`company` AS `company`,`pct`.`department_id` AS `department_id`,`d`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`par`.`id_number` AS `employee_code`,`u`.`full_name` AS `employee_name`,sum(((case when (`ptc`.`transaction_class_code` = 'SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `basic`,sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `aut`,sum(((case when (`pt`.`transaction_code` in ('REGOT','REGOT_ADJ','RDOT','RDOT_ADJ','RDOT_EXCESS','RDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `ot`,sum(((case when (`pt`.`transaction_code` in ('REGND','REGND_ADJ','REGOT_ND','REGOT_ND_ADJ','LEGOT_ND','LEGOT_ND_ADJ','LEGOT_ND_EXCESS','LEGOT_ND_EXCESS_ADJ','LEGRDOT_ND','LEGRDOT_ND_ADJ','LEGRDOT_ND_EXCESS','LEGRDOT_ND_EXCESS_ADJ','RDOT_ND','RDOT_ND_ADJ','RDOT_ND_EXCESS','RDOT_ND_EXCESS_ADJ','SPEOT_ND','SPEOT_ND_ADJ','SPEOT_ND_EXCESS','SPEOT_ND_EXCESS_ADJ','SPERDOT_ND','SPERDOT_ND_ADJ','SPERDOT_ND_EXCESS','SPERDOT_ND_EXCESS_ADJ','DOBOT_ND','DOBOT_ND_ADJ','DOBOT_ND_EXCESS','DOBOT_ND_EXCESS_ADJ','DOBRDOT_ND','DOBRDOT_ND_ADJ','DOBRDOT_ND_EXCESS','DOBRDOT_ND_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `nd`,sum(((case when (`pt`.`transaction_code` in ('LEGOT','LEGOT_ADJ','LEGOT_EXCESS','LEGOT_EXCESS_ADJ','LEGRDOT','LEGRDOT_ADJ','LEGRDOT_EXCESS','LEGRDOT_EXCESS_ADJ','SPEOT','SPEOT_ADJ','SPEOT_EXCESS','SPEOT_EXCESS_ADJ','SPERDOT','SPERDOT_ADJ','SPERDOT_EXCESS','SPERDOT_EXCESS_ADJ','DOBOT','DOBOT_ADJ','DOBOT_EXCESS','DOBOT_EXCESS_ADJ','DOBRDOT','DOBRDOT_ADJ','DOBRDOT_EXCESS','DOBRDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `holiday`,sum(((case when ((`ptt`.`operation` = '+') and (`ptc`.`transaction_class_code` not in ('SALARY','OVERTIME','NIGHT DIFF'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `other_earnings`,(((((sum(((case when (`ptc`.`transaction_class_code` = 'SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`pt`.`transaction_code` in ('REGOT','REGOT_ADJ','RDOT','RDOT_ADJ','RDOT_EXCESS','RDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`pt`.`transaction_code` in ('REGND','REGND_ADJ','REGOT_ND','REGOT_ND_ADJ','LEGOT_ND','LEGOT_ND_ADJ','LEGOT_ND_EXCESS','LEGOT_ND_EXCESS_ADJ','LEGRDOT_ND','LEGRDOT_ND_ADJ','LEGRDOT_ND_EXCESS','LEGRDOT_ND_EXCESS_ADJ','RDOT_ND','RDOT_ND_ADJ','RDOT_ND_EXCESS','RDOT_ND_EXCESS_ADJ','SPEOT_ND','SPEOT_ND_ADJ','SPEOT_ND_EXCESS','SPEOT_ND_EXCESS_ADJ','SPERDOT_ND','SPERDOT_ND_ADJ','SPERDOT_ND_EXCESS','SPERDOT_ND_EXCESS_ADJ','DOBOT_ND','DOBOT_ND_ADJ','DOBOT_ND_EXCESS','DOBOT_ND_EXCESS_ADJ','DOBRDOT_ND','DOBRDOT_ND_ADJ','DOBRDOT_ND_EXCESS','DOBRDOT_ND_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`pt`.`transaction_code` in ('LEGOT','LEGOT_ADJ','LEGOT_EXCESS','LEGOT_EXCESS_ADJ','LEGRDOT','LEGRDOT_ADJ','LEGRDOT_EXCESS','LEGRDOT_EXCESS_ADJ','SPEOT','SPEOT_ADJ','SPEOT_EXCESS','SPEOT_EXCESS_ADJ','SPERDOT','SPERDOT_ADJ','SPERDOT_EXCESS','SPERDOT_EXCESS_ADJ','DOBOT','DOBOT_ADJ','DOBOT_EXCESS','DOBOT_EXCESS_ADJ','DOBRDOT','DOBRDOT_ADJ','DOBRDOT_EXCESS','DOBRDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when ((`ptt`.`operation` = '+') and (`ptc`.`transaction_class_code` not in ('SALARY','OVERTIME','NIGHT DIFF'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) - sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `gross`,sum(((case when (`ptc`.`transaction_class_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss`,sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `phic`,sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf`,sum(((case when (`ptc`.`transaction_class_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `tax`,sum(((case when (`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `loan`,sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `employee_ledger`,sum(((case when ((`ptt`.`operation` = '-') and (`ptc`.`transaction_class_code` not in ('SSS_EMP','PHIC_EMP','HDMF_EMP','WHTAX','LOAN_AMORTIZATION','LOAN_INTEREST'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `other_deduction`,((((((sum(((case when (`ptc`.`transaction_class_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when ((`ptt`.`operation` = '-') and (`ptc`.`transaction_class_code` not in ('SSS_EMP','PHIC_EMP','HDMF_EMP','WHTAX','LOAN_AMORTIZATION','LOAN_INTEREST'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `deduction`,sum(((case when (`pt`.`transaction_code` = 'NETPAY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `net_amount` from (((((((((((`ww_payroll_current_transaction` `pct` left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_payroll_transaction_type` `ptt` on((`ptt`.`transaction_type_id` = `pt`.`transaction_type_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_users_department` `d` on((`pct`.`department_id` = `d`.`department_id`))) left join `ww_payroll_partners` `p` on((`pct`.`employee_id` = `p`.`user_id`))) left join `ww_payroll_period` `pp` on((`pct`.`period_id` = `pp`.`payroll_period_id`))) left join `ww_users_company` `uc` on((`pct`.`company_id` = `uc`.`company_id`))) left join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) left join `ww_users_profile` `up` on((`u`.`user_id` = `up`.`user_id`))) left join `ww_users_branch` `b` on((`up`.`branch_id` = `b`.`branch_id`))) left join `ww_partners` `par` on((`pct`.`employee_id` = `par`.`user_id`))) group by `pct`.`department_id`,`pct`.`employee_id`,`pct`.`payroll_date` */;

/*View structure for view payroll_register_deduction */

/*!50001 DROP TABLE IF EXISTS `payroll_register_deduction` */;
/*!50001 DROP VIEW IF EXISTS `payroll_register_deduction` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_register_deduction` AS (select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`uc`.`company` AS `company`,`wpp`.`company_id` AS `company_id`,`ud`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`pct`.`payroll_date` AS `payroll_date`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,`pt`.`transaction_label` AS `transaction_label`,sum(aes_decrypt(`pct`.`amount`,`encryption_key`())) AS `amount` from ((((((((((`ww_payroll_closed_transaction` `pct` join `ww_payroll_transaction_class` `ptc` on((`ptc`.`transaction_class_id` = `pct`.`transaction_class_id`))) join `ww_payroll_transaction` `pt` on((`pt`.`transaction_id` = `pct`.`transaction_id`))) join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) join `ww_users_department` `ud` on((`ud`.`department_id` = `up`.`department_id`))) left join `ww_users_branch` `b` on((`b`.`branch_id` = `up`.`branch_id`))) join `ww_partners` `p` on((`p`.`user_id` = `pct`.`employee_id`))) join `ww_payroll_partners` `wpp` on((`wpp`.`user_id` = `pct`.`employee_id`))) join `ww_users_company` `uc` on((`uc`.`company_id` = `wpp`.`company_id`))) join `ww_payroll_period` `pp` on((`pp`.`payroll_period_id` = `pct`.`period_id`))) where ((`pct`.`on_hold` = 0) and (`pct`.`deleted` = 0) and (`ptc`.`deleted` = 0) and (`pt`.`deleted` = 0) and (`pt`.`transaction_type_id` in (3,4,5)) and (`ptc`.`government_mandated` <> 1)) group by `u`.`user_id`,`pct`.`payroll_date`,`pt`.`transaction_label`) */;

/*View structure for view payroll_register_earnings */

/*!50001 DROP TABLE IF EXISTS `payroll_register_earnings` */;
/*!50001 DROP VIEW IF EXISTS `payroll_register_earnings` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_register_earnings` AS (select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`uc`.`company` AS `company`,`wpp`.`company_id` AS `company_id`,`ud`.`department` AS `department`,`ud`.`department_id` AS `department_id`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`pct`.`payroll_date` AS `payroll_date`,(case when (`pt`.`transaction_label` = 'Salaries and Wages') then 'Basic Pay' else `pt`.`transaction_label` end) AS `transaction_label`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,sum(aes_decrypt(`pct`.`amount`,`encryption_key`())) AS `amount`,`t`.`transaction_type` AS `transaction_type` from (((((((((((`ww_payroll_closed_transaction` `pct` join `ww_payroll_transaction_class` `ptc` on((`ptc`.`transaction_class_id` = `pct`.`transaction_class_id`))) join `ww_payroll_transaction` `pt` on((`pt`.`transaction_id` = `pct`.`transaction_id`))) join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) join `ww_users_department` `ud` on((`ud`.`department_id` = `up`.`department_id`))) join `ww_users_branch` `b` on((`b`.`branch_id` = `up`.`branch_id`))) join `ww_payroll_transaction_type` `t` on((`t`.`transaction_type_id` = `pct`.`transaction_type_id`))) join `ww_partners` `p` on((`p`.`user_id` = `pct`.`employee_id`))) join `ww_payroll_partners` `wpp` on((`wpp`.`user_id` = `pct`.`employee_id`))) join `ww_users_company` `uc` on((`uc`.`company_id` = `wpp`.`company_id`))) join `ww_payroll_period` `pp` on((`pp`.`payroll_period_id` = `pct`.`period_id`))) where ((`pct`.`on_hold` = 0) and (`pct`.`deleted` = 0) and (`ptc`.`deleted` = 0) and (`pt`.`deleted` = 0) and (`pt`.`transaction_type_id` in (1,2,6,7,8))) group by `pct`.`employee_id`,`pct`.`transaction_id`,`pct`.`payroll_date`) */;

/*View structure for view payroll_register_per_department */

/*!50001 DROP TABLE IF EXISTS `payroll_register_per_department` */;
/*!50001 DROP VIEW IF EXISTS `payroll_register_per_department` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_register_per_department` AS (select `uc`.`company` AS `company`,`wpp`.`company_id` AS `company_id`,`ud`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`pct`.`payroll_date` AS `payroll_date`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,`get_headcount_per_dept`(`ud`.`department_id`,`pct`.`company_id`,`up`.`branch_id`,`pct`.`payroll_date`) AS `total_dept`,sum(((case when (`pct`.`transaction_code` = 'SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `basic`,sum(((case when (`pt`.`transaction_code` = 'E-COLA') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `cola`,sum(((case when (`pt`.`transaction_code` = 'REGND') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `nd`,sum(((case when (`ptc`.`transaction_class_code` = 'OVERTIME') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `overtime`,sum(((case when (`pct`.`transaction_code` = 'ALLOWANCE_TRANSPO') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `transpo`,sum(((case when (`pct`.`transaction_code` = 'ALLOWANCE_COMMUNICATION') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `comm`,((((((sum(((case when (`pct`.`transaction_type_id` in (1,6)) then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2))) + sum(((case when ((`pct`.`transaction_type_id` = 8) and (`ptc`.`transaction_class_code` = 'BONUS_TAXABLE')) then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2)))) - sum(((case when (`pct`.`transaction_code` = 'SALARY') then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2)))) - sum(((case when ((`pt`.`transaction_code` = 'ECOLA') and (`pct`.`transaction_type_id` = 6)) then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2)))) - sum(((case when (`ptc`.`transaction_class_code` = 'OVERTIME') then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2)))) - sum(((case when (`pct`.`transaction_code` = 'ALLOWANCE_TRANSPO') then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2)))) - sum(((case when (`pct`.`transaction_code` = 'ALLOWANCE_COMMUNICATION') then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2)))) AS `oth_inc_taxable`,((sum(((case when (`pct`.`transaction_type_id` in (2,7,8)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) - sum(((case when ((`pct`.`transaction_type_id` = 8) and (`ptc`.`transaction_class_code` = 'BONUS_TAXABLE')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) - sum(((case when ((`pt`.`transaction_code` = 'ECOLA') and (`pct`.`transaction_type_id` = 1)) then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2)))) AS `oth_inc_nontax`,sum(((case when ((`pt`.`transaction_type_id` = 5) and (`ptc`.`government_mandated` = 0)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `absences`,(sum(((case when (`pct`.`transaction_type_id` in (1,2,6,7,8)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) - sum(((case when ((`pt`.`transaction_type_id` = 5) and (`ptc`.`government_mandated` = 0)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `gross_pay`,sum(((case when (`pct`.`transaction_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `whtax`,sum(((case when (`pct`.`transaction_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss`,(sum(((case when (`pct`.`transaction_code` = 'SSS_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`pct`.`transaction_code` = 'SSS_ECC') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `Ssser`,sum(((case when (`pct`.`transaction_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `phic`,sum(((case when (`pct`.`transaction_code` = 'PHIC_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `Phicer`,sum(((case when (`pct`.`transaction_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf`,sum(((case when (`pct`.`transaction_code` = 'HDMF_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `Hdmfer`,sum(((case when (`pct`.`transaction_code` = 'PagIbigAdd') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf_add`,sum(((case when (`pct`.`transaction_code` = 'SSSLN_SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss_loan`,sum(((case when (`pct`.`transaction_code` = 'HDMFLNA') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf_loan`,((((sum(((case when (`pct`.`transaction_type_id` = 3) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) - sum(((case when (`pct`.`transaction_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) - sum(((case when (`pct`.`transaction_code` = 'PagIbigAdd') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) - sum(((case when (`pct`.`transaction_code` = 'SSSLN_SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) - sum(((case when (`pct`.`transaction_code` = 'HDMFLNA') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `oth_ded`,sum(((case when (`pct`.`transaction_code` = 'NETPAY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `netpay` from ((((((((((`ww_payroll_closed_transaction` `pct` join `ww_payroll_transaction_class` `ptc` on((`ptc`.`transaction_class_id` = `pct`.`transaction_class_id`))) join `ww_payroll_transaction` `pt` on((`pt`.`transaction_id` = `pct`.`transaction_id`))) join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) join `ww_users_department` `ud` on((`ud`.`department_id` = `up`.`department_id`))) left join `ww_users_branch` `b` on((`up`.`branch_id` = `b`.`branch_id`))) join `ww_partners` `p` on((`p`.`user_id` = `pct`.`employee_id`))) join `ww_payroll_period` `pp` on((`pp`.`payroll_period_id` = `pct`.`period_id`))) join `ww_payroll_partners` `wpp` on((`wpp`.`user_id` = `up`.`user_id`))) join `ww_users_company` `uc` on((`uc`.`company_id` = `wpp`.`company_id`))) where ((`pct`.`on_hold` = 0) and (`u`.`active` = 1) and (`pct`.`deleted` = 0) and (`ptc`.`deleted` = 0) and (`pt`.`deleted` = 0)) group by `pct`.`department_id`,`pct`.`payroll_date`,`pct`.`company_id`,`up`.`branch_id`) */;

/*View structure for view payroll_register_position */

/*!50001 DROP TABLE IF EXISTS `payroll_register_position` */;
/*!50001 DROP VIEW IF EXISTS `payroll_register_position` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_register_position` AS select `pct`.`payroll_date` AS `payroll_date`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,`pct`.`company_id` AS `company_id`,`uc`.`company` AS `company`,`uproj`.`project_id` AS `project_id`,`uproj`.`project` AS `project`,`pct`.`department_id` AS `department_id`,`d`.`department` AS `department`,`par`.`id_number` AS `employee_code`,`po`.`position` AS `position`,`prt`.`payroll_rate_type_id` AS `payroll_rate_type_id`,`prt`.`payroll_rate_type` AS `payroll_rate_type`,sum(((case when (`ptc`.`transaction_class_code` = 'SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `basic`,sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `aut`,sum(((case when (`pt`.`transaction_code` in ('REGOT','REGOT_ADJ','RDOT','RDOT_ADJ','RDOT_EXCESS','RDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `ot`,sum(((case when (`pt`.`transaction_code` in ('REGND','REGND_ADJ','REGOT_ND','REGOT_ND_ADJ','LEGOT_ND','LEGOT_ND_ADJ','LEGOT_ND_EXCESS','LEGOT_ND_EXCESS_ADJ','LEGRDOT_ND','LEGRDOT_ND_ADJ','LEGRDOT_ND_EXCESS','LEGRDOT_ND_EXCESS_ADJ','RDOT_ND','RDOT_ND_ADJ','RDOT_ND_EXCESS','RDOT_ND_EXCESS_ADJ','SPEOT_ND','SPEOT_ND_ADJ','SPEOT_ND_EXCESS','SPEOT_ND_EXCESS_ADJ','SPERDOT_ND','SPERDOT_ND_ADJ','SPERDOT_ND_EXCESS','SPERDOT_ND_EXCESS_ADJ','DOBOT_ND','DOBOT_ND_ADJ','DOBOT_ND_EXCESS','DOBOT_ND_EXCESS_ADJ','DOBRDOT_ND','DOBRDOT_ND_ADJ','DOBRDOT_ND_EXCESS','DOBRDOT_ND_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `nd`,sum(((case when (`pt`.`transaction_code` in ('LEGOT','LEGOT_ADJ','LEGOT_EXCESS','LEGOT_EXCESS_ADJ','LEGRDOT','LEGRDOT_ADJ','LEGRDOT_EXCESS','LEGRDOT_EXCESS_ADJ','SPEOT','SPEOT_ADJ','SPEOT_EXCESS','SPEOT_EXCESS_ADJ','SPERDOT','SPERDOT_ADJ','SPERDOT_EXCESS','SPERDOT_EXCESS_ADJ','DOBOT','DOBOT_ADJ','DOBOT_EXCESS','DOBOT_EXCESS_ADJ','DOBRDOT','DOBRDOT_ADJ','DOBRDOT_EXCESS','DOBRDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `holiday`,sum(((case when ((`ptt`.`operation` = '+') and (`ptc`.`transaction_class_code` not in ('SALARY','OVERTIME'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `other_earnings`,(((((sum(((case when (`ptc`.`transaction_class_code` = 'SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`pt`.`transaction_code` in ('REGOT','REGOT_ADJ','RDOT','RDOT_ADJ','RDOT_EXCESS','RDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`pt`.`transaction_code` in ('REGND','REGND_ADJ','REGOT_ND','REGOT_ND_ADJ','LEGOT_ND','LEGOT_ND_ADJ','LEGOT_ND_EXCESS','LEGOT_ND_EXCESS_ADJ','LEGRDOT_ND','LEGRDOT_ND_ADJ','LEGRDOT_ND_EXCESS','LEGRDOT_ND_EXCESS_ADJ','RDOT_ND','RDOT_ND_ADJ','RDOT_ND_EXCESS','RDOT_ND_EXCESS_ADJ','SPEOT_ND','SPEOT_ND_ADJ','SPEOT_ND_EXCESS','SPEOT_ND_EXCESS_ADJ','SPERDOT_ND','SPERDOT_ND_ADJ','SPERDOT_ND_EXCESS','SPERDOT_ND_EXCESS_ADJ','DOBOT_ND','DOBOT_ND_ADJ','DOBOT_ND_EXCESS','DOBOT_ND_EXCESS_ADJ','DOBRDOT_ND','DOBRDOT_ND_ADJ','DOBRDOT_ND_EXCESS','DOBRDOT_ND_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`pt`.`transaction_code` in ('LEGOT','LEGOT_ADJ','LEGOT_EXCESS','LEGOT_EXCESS_ADJ','LEGRDOT','LEGRDOT_ADJ','LEGRDOT_EXCESS','LEGRDOT_EXCESS_ADJ','SPEOT','SPEOT_ADJ','SPEOT_EXCESS','SPEOT_EXCESS_ADJ','SPERDOT','SPERDOT_ADJ','SPERDOT_EXCESS','SPERDOT_EXCESS_ADJ','DOBOT','DOBOT_ADJ','DOBOT_EXCESS','DOBOT_EXCESS_ADJ','DOBRDOT','DOBRDOT_ADJ','DOBRDOT_EXCESS','DOBRDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when ((`ptt`.`operation` = '+') and (`ptc`.`transaction_class_code` not in ('SALARY','OVERTIME'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) - sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `gross`,sum(((case when (`ptc`.`transaction_class_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss`,sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `phic`,sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf`,sum(((case when (`ptc`.`transaction_class_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `tax`,sum(((case when (`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `loan`,sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `employee_ledger`,sum(((case when ((`ptt`.`operation` = '-') and (`ptc`.`transaction_class_code` not in ('SSS_EMP','PHIC_EMP','HDMF_EMP','WHTAX','LOAN_AMORTIZATION','LOAN_INTEREST'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `other_deduction`,((((((sum(((case when (`ptc`.`transaction_class_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when ((`ptt`.`operation` = '-') and (`ptc`.`transaction_class_code` not in ('SSS_EMP','PHIC_EMP','HDMF_EMP','WHTAX','LOAN_AMORTIZATION','LOAN_INTEREST'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `deduction`,sum(((case when (`pt`.`transaction_code` = 'NETPAY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `net_amount` from ((((((((((((`ww_payroll_current_transaction` `pct` left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_payroll_transaction_type` `ptt` on((`ptt`.`transaction_type_id` = `pt`.`transaction_type_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_users_department` `d` on((`pct`.`department_id` = `d`.`department_id`))) left join `ww_payroll_partners` `p` on((`pct`.`employee_id` = `p`.`user_id`))) left join `ww_payroll_period` `pp` on((`pct`.`period_id` = `pp`.`payroll_period_id`))) left join `ww_users_company` `uc` on((`pct`.`company_id` = `uc`.`company_id`))) left join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) left join `ww_partners` `par` on((`pct`.`employee_id` = `par`.`user_id`))) left join `ww_users_position` `po` on((`pct`.`position_id` = `po`.`position_id`))) left join `ww_users_project` `uproj` on((`pct`.`project_id` = `uproj`.`project_id`))) left join `ww_payroll_rate_type` `prt` on((`pct`.`payroll_rate_type_id` = `prt`.`payroll_rate_type_id`))) group by `pct`.`department_id`,`pct`.`employee_id`,`pct`.`payroll_date` */;

/*View structure for view payroll_register_position_closed_report */

/*!50001 DROP TABLE IF EXISTS `payroll_register_position_closed_report` */;
/*!50001 DROP VIEW IF EXISTS `payroll_register_position_closed_report` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_register_position_closed_report` AS select `pct`.`payroll_date` AS `payroll_date`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,`pct`.`company_id` AS `company_id`,`uc`.`company` AS `company`,`uproj`.`project_id` AS `project_id`,`uproj`.`project_code` AS `project_code`,`uproj`.`project` AS `project`,`po`.`position` AS `position`,`prt`.`payroll_rate_type_id` AS `payroll_rate_type_id`,`prt`.`payroll_rate_type` AS `payroll_rate_type`,0 AS `ot_percent`,0 AS `other_tax`,0 AS `adjustment`,sum(((case when (`ptc`.`transaction_class_code` = 'SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `basic`,sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `misc`,sum(((case when (`pt`.`transaction_code` in ('REGOT','REGOT_ADJ','RDOT','RDOT_ADJ','RDOT_EXCESS','RDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `ot`,sum(((case when (`pt`.`transaction_code` in ('REGND','REGND_ADJ','REGOT_ND','REGOT_ND_ADJ','LEGOT_ND','LEGOT_ND_ADJ','LEGOT_ND_EXCESS','LEGOT_ND_EXCESS_ADJ','LEGRDOT_ND','LEGRDOT_ND_ADJ','LEGRDOT_ND_EXCESS','LEGRDOT_ND_EXCESS_ADJ','RDOT_ND','RDOT_ND_ADJ','RDOT_ND_EXCESS','RDOT_ND_EXCESS_ADJ','SPEOT_ND','SPEOT_ND_ADJ','SPEOT_ND_EXCESS','SPEOT_ND_EXCESS_ADJ','SPERDOT_ND','SPERDOT_ND_ADJ','SPERDOT_ND_EXCESS','SPERDOT_ND_EXCESS_ADJ','DOBOT_ND','DOBOT_ND_ADJ','DOBOT_ND_EXCESS','DOBOT_ND_EXCESS_ADJ','DOBRDOT_ND','DOBRDOT_ND_ADJ','DOBRDOT_ND_EXCESS','DOBRDOT_ND_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `nd`,sum(((case when (`pt`.`transaction_code` in ('LEGOT','LEGOT_ADJ','LEGOT_EXCESS','LEGOT_EXCESS_ADJ','LEGRDOT','LEGRDOT_ADJ','LEGRDOT_EXCESS','LEGRDOT_EXCESS_ADJ','SPEOT','SPEOT_ADJ','SPEOT_EXCESS','SPEOT_EXCESS_ADJ','SPERDOT','SPERDOT_ADJ','SPERDOT_EXCESS','SPERDOT_EXCESS_ADJ','DOBOT','DOBOT_ADJ','DOBOT_EXCESS','DOBOT_EXCESS_ADJ','DOBRDOT','DOBRDOT_ADJ','DOBRDOT_EXCESS','DOBRDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `holiday`,sum(((case when ((`ptt`.`operation` = '+') and (`ptc`.`transaction_class_code` not in ('SALARY','OVERTIME'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `other_earnings`,(((((sum(((case when (`ptc`.`transaction_class_code` = 'SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`pt`.`transaction_code` in ('REGOT','REGOT_ADJ','RDOT','RDOT_ADJ','RDOT_EXCESS','RDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`pt`.`transaction_code` in ('REGND','REGND_ADJ','REGOT_ND','REGOT_ND_ADJ','LEGOT_ND','LEGOT_ND_ADJ','LEGOT_ND_EXCESS','LEGOT_ND_EXCESS_ADJ','LEGRDOT_ND','LEGRDOT_ND_ADJ','LEGRDOT_ND_EXCESS','LEGRDOT_ND_EXCESS_ADJ','RDOT_ND','RDOT_ND_ADJ','RDOT_ND_EXCESS','RDOT_ND_EXCESS_ADJ','SPEOT_ND','SPEOT_ND_ADJ','SPEOT_ND_EXCESS','SPEOT_ND_EXCESS_ADJ','SPERDOT_ND','SPERDOT_ND_ADJ','SPERDOT_ND_EXCESS','SPERDOT_ND_EXCESS_ADJ','DOBOT_ND','DOBOT_ND_ADJ','DOBOT_ND_EXCESS','DOBOT_ND_EXCESS_ADJ','DOBRDOT_ND','DOBRDOT_ND_ADJ','DOBRDOT_ND_EXCESS','DOBRDOT_ND_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`pt`.`transaction_code` in ('LEGOT','LEGOT_ADJ','LEGOT_EXCESS','LEGOT_EXCESS_ADJ','LEGRDOT','LEGRDOT_ADJ','LEGRDOT_EXCESS','LEGRDOT_EXCESS_ADJ','SPEOT','SPEOT_ADJ','SPEOT_EXCESS','SPEOT_EXCESS_ADJ','SPERDOT','SPERDOT_ADJ','SPERDOT_EXCESS','SPERDOT_EXCESS_ADJ','DOBOT','DOBOT_ADJ','DOBOT_EXCESS','DOBOT_EXCESS_ADJ','DOBRDOT','DOBRDOT_ADJ','DOBRDOT_EXCESS','DOBRDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when ((`ptt`.`operation` = '+') and (`ptc`.`transaction_class_code` not in ('SALARY','OVERTIME'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) - sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `gross`,sum(((case when (`ptc`.`transaction_class_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss_ee`,round(sum(((case when (`ptc`.`transaction_class_code` = 'SSS_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `sss_er`,round(sum(((case when (`ptc`.`transaction_class_code` = 'SSS_ECC') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `sss_ec`,sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `phic_ee`,sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `phic_er`,sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf_ee`,sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf_er`,sum(((case when (`ptc`.`transaction_class_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `tax`,sum(((case when (`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `loan`,round(sum(((case when (`pt`.`transaction_type_id` in (2,6,7)) then 1 when ((`pt`.`transaction_type_id` = 6) and (`ptc`.`transaction_class_code` <> 'BONUS_TAXABLE')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `other_nontax`,sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `employee_ledger`,sum(((case when ((`ptt`.`operation` = '-') and (`ptc`.`transaction_class_code` not in ('SSS_EMP','PHIC_EMP','HDMF_EMP','WHTAX','LOAN_AMORTIZATION','LOAN_INTEREST'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `other_deduction`,((((((sum(((case when (`ptc`.`transaction_class_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when ((`ptt`.`operation` = '-') and (`ptc`.`transaction_class_code` not in ('SSS_EMP','PHIC_EMP','HDMF_EMP','WHTAX','LOAN_AMORTIZATION','LOAN_INTEREST'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `deduction`,sum(((case when (`pt`.`transaction_code` = 'NETPAY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `net_amount` from ((((((((((`ww_payroll_closed_transaction` `pct` left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_payroll_transaction_type` `ptt` on((`ptt`.`transaction_type_id` = `pt`.`transaction_type_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_payroll_period` `pp` on((`pct`.`period_id` = `pp`.`payroll_period_id`))) left join `ww_users_company` `uc` on((`pct`.`company_id` = `uc`.`company_id`))) left join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) left join `ww_partners` `par` on((`pct`.`employee_id` = `par`.`user_id`))) left join `ww_users_position` `po` on((`pct`.`position_id` = `po`.`position_id`))) left join `ww_users_project` `uproj` on((`pct`.`project_id` = `uproj`.`project_id`))) left join `ww_payroll_rate_type` `prt` on((`pct`.`payroll_rate_type_id` = `prt`.`payroll_rate_type_id`))) group by `pct`.`position_id`,`pct`.`payroll_date` order by `pct`.`project_id` */;

/*View structure for view payroll_register_position_current_report */

/*!50001 DROP TABLE IF EXISTS `payroll_register_position_current_report` */;
/*!50001 DROP VIEW IF EXISTS `payroll_register_position_current_report` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_register_position_current_report` AS select `pct`.`payroll_date` AS `payroll_date`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,`pct`.`company_id` AS `company_id`,`uc`.`company` AS `company`,`uproj`.`project_id` AS `project_id`,`uproj`.`project_code` AS `project_code`,`uproj`.`project` AS `project`,`po`.`position` AS `position`,`prt`.`payroll_rate_type_id` AS `payroll_rate_type_id`,`prt`.`payroll_rate_type` AS `payroll_rate_type`,0 AS `ot_percent`,0 AS `other_tax`,0 AS `adjustment`,sum(((case when (`ptc`.`transaction_class_code` = 'SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `basic`,sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `misc`,sum(((case when (`pt`.`transaction_code` in ('REGOT','REGOT_ADJ','RDOT','RDOT_ADJ','RDOT_EXCESS','RDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `ot`,sum(((case when (`pt`.`transaction_code` in ('REGND','REGND_ADJ','REGOT_ND','REGOT_ND_ADJ','LEGOT_ND','LEGOT_ND_ADJ','LEGOT_ND_EXCESS','LEGOT_ND_EXCESS_ADJ','LEGRDOT_ND','LEGRDOT_ND_ADJ','LEGRDOT_ND_EXCESS','LEGRDOT_ND_EXCESS_ADJ','RDOT_ND','RDOT_ND_ADJ','RDOT_ND_EXCESS','RDOT_ND_EXCESS_ADJ','SPEOT_ND','SPEOT_ND_ADJ','SPEOT_ND_EXCESS','SPEOT_ND_EXCESS_ADJ','SPERDOT_ND','SPERDOT_ND_ADJ','SPERDOT_ND_EXCESS','SPERDOT_ND_EXCESS_ADJ','DOBOT_ND','DOBOT_ND_ADJ','DOBOT_ND_EXCESS','DOBOT_ND_EXCESS_ADJ','DOBRDOT_ND','DOBRDOT_ND_ADJ','DOBRDOT_ND_EXCESS','DOBRDOT_ND_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `nd`,sum(((case when (`pt`.`transaction_code` in ('LEGOT','LEGOT_ADJ','LEGOT_EXCESS','LEGOT_EXCESS_ADJ','LEGRDOT','LEGRDOT_ADJ','LEGRDOT_EXCESS','LEGRDOT_EXCESS_ADJ','SPEOT','SPEOT_ADJ','SPEOT_EXCESS','SPEOT_EXCESS_ADJ','SPERDOT','SPERDOT_ADJ','SPERDOT_EXCESS','SPERDOT_EXCESS_ADJ','DOBOT','DOBOT_ADJ','DOBOT_EXCESS','DOBOT_EXCESS_ADJ','DOBRDOT','DOBRDOT_ADJ','DOBRDOT_EXCESS','DOBRDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `holiday`,sum(((case when ((`ptt`.`operation` = '+') and (`ptc`.`transaction_class_code` not in ('SALARY','OVERTIME'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `other_earnings`,(((((sum(((case when (`ptc`.`transaction_class_code` = 'SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`pt`.`transaction_code` in ('REGOT','REGOT_ADJ','RDOT','RDOT_ADJ','RDOT_EXCESS','RDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`pt`.`transaction_code` in ('REGND','REGND_ADJ','REGOT_ND','REGOT_ND_ADJ','LEGOT_ND','LEGOT_ND_ADJ','LEGOT_ND_EXCESS','LEGOT_ND_EXCESS_ADJ','LEGRDOT_ND','LEGRDOT_ND_ADJ','LEGRDOT_ND_EXCESS','LEGRDOT_ND_EXCESS_ADJ','RDOT_ND','RDOT_ND_ADJ','RDOT_ND_EXCESS','RDOT_ND_EXCESS_ADJ','SPEOT_ND','SPEOT_ND_ADJ','SPEOT_ND_EXCESS','SPEOT_ND_EXCESS_ADJ','SPERDOT_ND','SPERDOT_ND_ADJ','SPERDOT_ND_EXCESS','SPERDOT_ND_EXCESS_ADJ','DOBOT_ND','DOBOT_ND_ADJ','DOBOT_ND_EXCESS','DOBOT_ND_EXCESS_ADJ','DOBRDOT_ND','DOBRDOT_ND_ADJ','DOBRDOT_ND_EXCESS','DOBRDOT_ND_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`pt`.`transaction_code` in ('LEGOT','LEGOT_ADJ','LEGOT_EXCESS','LEGOT_EXCESS_ADJ','LEGRDOT','LEGRDOT_ADJ','LEGRDOT_EXCESS','LEGRDOT_EXCESS_ADJ','SPEOT','SPEOT_ADJ','SPEOT_EXCESS','SPEOT_EXCESS_ADJ','SPERDOT','SPERDOT_ADJ','SPERDOT_EXCESS','SPERDOT_EXCESS_ADJ','DOBOT','DOBOT_ADJ','DOBOT_EXCESS','DOBOT_EXCESS_ADJ','DOBRDOT','DOBRDOT_ADJ','DOBRDOT_EXCESS','DOBRDOT_EXCESS_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when ((`ptt`.`operation` = '+') and (`ptc`.`transaction_class_code` not in ('SALARY','OVERTIME'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) - sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `gross`,sum(((case when (`ptc`.`transaction_class_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss_ee`,round(sum(((case when (`ptc`.`transaction_class_code` = 'SSS_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `sss_er`,round(sum(((case when (`ptc`.`transaction_class_code` = 'SSS_ECC') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `sss_ec`,sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `phic_ee`,sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `phic_er`,sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf_ee`,sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf_er`,sum(((case when (`ptc`.`transaction_class_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `tax`,sum(((case when (`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `loan`,round(sum(((case when (`pt`.`transaction_type_id` in (2,6,7)) then 1 when ((`pt`.`transaction_type_id` = 6) and (`ptc`.`transaction_class_code` <> 'BONUS_TAXABLE')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `other_nontax`,sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `employee_ledger`,sum(((case when ((`ptt`.`operation` = '-') and (`ptc`.`transaction_class_code` not in ('SSS_EMP','PHIC_EMP','HDMF_EMP','WHTAX','LOAN_AMORTIZATION','LOAN_INTEREST'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `other_deduction`,((((((sum(((case when (`ptc`.`transaction_class_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when (`ptc`.`transaction_class_code` in ('LOAN_AMORTIZATION','LOAN_INTEREST')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum((0.00 * aes_decrypt(`pct`.`amount`,`encryption_key`())))) + sum(((case when ((`ptt`.`operation` = '-') and (`ptc`.`transaction_class_code` not in ('SSS_EMP','PHIC_EMP','HDMF_EMP','WHTAX','LOAN_AMORTIZATION','LOAN_INTEREST'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `deduction`,sum(((case when (`pt`.`transaction_code` = 'NETPAY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `net_amount` from ((((((((((`ww_payroll_current_transaction` `pct` left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_payroll_transaction_type` `ptt` on((`ptt`.`transaction_type_id` = `pt`.`transaction_type_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_payroll_period` `pp` on((`pct`.`period_id` = `pp`.`payroll_period_id`))) left join `ww_users_company` `uc` on((`pct`.`company_id` = `uc`.`company_id`))) left join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) left join `ww_partners` `par` on((`pct`.`employee_id` = `par`.`user_id`))) left join `ww_users_position` `po` on((`pct`.`position_id` = `po`.`position_id`))) left join `ww_users_project` `uproj` on((`pct`.`project_id` = `uproj`.`project_id`))) left join `ww_payroll_rate_type` `prt` on((`pct`.`payroll_rate_type_id` = `prt`.`payroll_rate_type_id`))) group by `pct`.`position_id`,`pct`.`payroll_date` order by `pct`.`project_id` */;

/*View structure for view payroll_register_report */

/*!50001 DROP TABLE IF EXISTS `payroll_register_report` */;
/*!50001 DROP VIEW IF EXISTS `payroll_register_report` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_register_report` AS (select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`uc`.`company` AS `company`,`wpp`.`company_id` AS `company_id`,`ud`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`pct`.`payroll_date` AS `payroll_date`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,sum(((case when (`pct`.`transaction_code` = 'SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `basic`,sum(((case when (`pt`.`transaction_code` = 'E-COLA') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `cola`,sum(((case when (`pt`.`transaction_code` = 'REGND') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `nd`,sum(((case when (`ptc`.`transaction_class_code` = 'OVERTIME') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `overtime`,sum(((case when (`pct`.`transaction_code` = 'ALLOWANCE_TRANSPO') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `transpo`,sum(((case when (`pct`.`transaction_code` = 'ALLOWANCE_COMMUNICATION') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `comm`,((((((sum(((case when (`pct`.`transaction_type_id` in (1,6)) then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2))) + sum(((case when ((`pct`.`transaction_type_id` = 8) and (`ptc`.`transaction_class_code` = 'BONUS_TAXABLE')) then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2)))) - sum(((case when (`pct`.`transaction_code` = 'SALARY') then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2)))) - sum(((case when ((`pt`.`transaction_code` = 'ECOLA') and (`pct`.`transaction_type_id` = 6)) then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2)))) - sum(((case when (`ptc`.`transaction_class_code` = 'OVERTIME') then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2)))) - sum(((case when (`pct`.`transaction_code` = 'ALLOWANCE_TRANSPO') then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2)))) - sum(((case when (`pct`.`transaction_code` = 'ALLOWANCE_COMMUNICATION') then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2)))) AS `oth_inc_taxable`,((sum(((case when (`pct`.`transaction_type_id` in (2,7,8)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) - sum(((case when ((`pct`.`transaction_type_id` = 8) and (`ptc`.`transaction_class_code` = 'BONUS_TAXABLE')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) - sum(((case when ((`pt`.`transaction_code` = 'ECOLA') and (`pct`.`transaction_type_id` = 1)) then 1 else 0 end) * round(aes_decrypt(`pct`.`amount`,`encryption_key`()),2)))) AS `oth_inc_nontax`,sum(((case when ((`pt`.`transaction_type_id` = 5) and (`ptc`.`government_mandated` = 0)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `absences`,(sum(((case when (`pct`.`transaction_type_id` in (1,2,6,7,8)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) - sum(((case when ((`pt`.`transaction_type_id` = 5) and (`ptc`.`government_mandated` = 0)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `gross_pay`,sum(((case when (`pct`.`transaction_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `whtax`,sum(((case when (`pct`.`transaction_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss`,(sum(((case when (`pct`.`transaction_code` = 'SSS_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) + sum(((case when (`pct`.`transaction_code` = 'SSS_ECC') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `Ssser`,sum(((case when (`pct`.`transaction_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `phic`,sum(((case when (`pct`.`transaction_code` = 'PHIC_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `Phicer`,sum(((case when (`pct`.`transaction_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf`,sum(((case when (`pct`.`transaction_code` = 'HDMF_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `Hdmfer`,sum(((case when (`pct`.`transaction_code` = 'PagIbigAdd') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf_add`,sum(((case when (`pct`.`transaction_code` = 'SSSLN_SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `sss_loan`,sum(((case when (`pct`.`transaction_code` = 'HDMFLNA') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `hdmf_loan`,((((sum(((case when (`pct`.`transaction_type_id` = 3) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) - sum(((case when (`pct`.`transaction_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) - sum(((case when (`pct`.`transaction_code` = 'PagIbigAdd') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) - sum(((case when (`pct`.`transaction_code` = 'SSSLN_SALARY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) - sum(((case when (`pct`.`transaction_code` = 'HDMFLNA') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `oth_ded`,sum(((case when (`pct`.`transaction_code` = 'NETPAY') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `netpay` from ((((((((((`ww_payroll_closed_transaction` `pct` join `ww_payroll_transaction_class` `ptc` on((`ptc`.`transaction_class_id` = `pct`.`transaction_class_id`))) join `ww_payroll_transaction` `pt` on((`pt`.`transaction_id` = `pct`.`transaction_id`))) join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) join `ww_users_department` `ud` on((`ud`.`department_id` = `up`.`department_id`))) left join `ww_users_branch` `b` on((`b`.`branch_id` = `up`.`branch_id`))) join `ww_partners` `p` on((`p`.`user_id` = `pct`.`employee_id`))) join `ww_payroll_period` `pp` on((`pp`.`payroll_period_id` = `pct`.`period_id`))) join `ww_payroll_partners` `wpp` on((`wpp`.`user_id` = `up`.`user_id`))) join `ww_users_company` `uc` on((`uc`.`company_id` = `wpp`.`company_id`))) where ((`pct`.`on_hold` = 0) and ((`u`.`active` = 1) or ((`u`.`active` = 0) and (`p`.`resigned_date` <= now()))) and (`pct`.`deleted` = 0) and (`ptc`.`deleted` = 0) and (`pt`.`deleted` = 0)) group by `pct`.`employee_id`,`pct`.`payroll_date` order by `ud`.`department_id`) */;

/*View structure for view payroll_salary_distribution */

/*!50001 DROP TABLE IF EXISTS `payroll_salary_distribution` */;
/*!50001 DROP VIEW IF EXISTS `payroll_salary_distribution` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_salary_distribution` AS select `u`.`user_id` AS `employee`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`po`.`position` AS `position`,`p`.`classification_id` AS `classification_id`,`p`.`classification` AS `classification`,`uc`.`company` AS `company`,`uc`.`company_id` AS `company_id`,`uproj`.`project_code` AS `project_code`,`uproj`.`project` AS `project`,`uproj`.`project_id` AS `project_id`,`prt`.`payroll_rate_type_id` AS `payroll_rate_type_id`,`prt`.`payroll_rate_type` AS `payroll_rate_type`,`pct`.`payroll_date` AS `payroll_date`,ifnull(trim(`pp`.`key_value`),'') AS `cost_center`,round(sum(((case when (`ptc`.`transaction_class_code` = 'SALARY') then 1 when (`ptc`.`transaction_class_code` in ('ABSENCES','DEDUCTION_LATE','DEDUCTION_UNDERTIME')) then -(1) when (`pct`.`transaction_code` in ('LWOP','LWOP_ADJ')) then -(1) else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `total_basic`,round(sum(((case when (`ptc`.`transaction_class_code` = 'OVERTIME') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `overtime`,round(sum(((case when (`pt`.`transaction_type_id` in (2,6,7)) then 1 when ((`pt`.`transaction_type_id` = 6) and (`ptc`.`transaction_class_code` <> 'BONUS_TAXABLE')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `other_nontax`,round(sum(((case when (`ptc`.`transaction_class_code` = 'SSS_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `sss_er`,round(sum(((case when (`ptc`.`transaction_class_code` = 'SSS_ECC') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `sss_ec`,round(sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `hdmf_er`,round(sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `phic_er` from (((((((((`ww_payroll_current_transaction` `pct` left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) left join `ww_users_company` `uc` on((`pct`.`company_id` = `uc`.`company_id`))) left join `ww_partners` `p` on((`pct`.`employee_id` = `p`.`user_id`))) left join `ww_partners_personal` `pp` on(((`pp`.`deleted` = 0) and (`pp`.`partner_id` = `p`.`partner_id`) and (`pp`.`key` = 'cost_center-cost_center')))) left join `ww_users_position` `po` on((`pct`.`position_id` = `po`.`position_id`))) left join `ww_users_project` `uproj` on((`pct`.`project_id` = `uproj`.`project_id`))) left join `ww_payroll_rate_type` `prt` on((`pct`.`payroll_rate_type_id` = `prt`.`payroll_rate_type_id`))) where ((`pct`.`deleted` = 0) and (`pct`.`on_hold` = 0) and (`pt`.`deleted` = 0) and (`u`.`deleted` = 0)) group by `pct`.`employee_id`,`pp`.`key_value` union all select `u`.`user_id` AS `employee`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`po`.`position` AS `position`,`p`.`classification_id` AS `classification_id`,`p`.`classification` AS `classification`,`uc`.`company` AS `company`,`uc`.`company_id` AS `company_id`,`uproj`.`project_code` AS `project_code`,`uproj`.`project` AS `project`,`uproj`.`project_id` AS `project_id`,`prt`.`payroll_rate_type_id` AS `payroll_rate_type_id`,`prt`.`payroll_rate_type` AS `payroll_rate_type`,`pct`.`payroll_date` AS `payroll_date`,ifnull(trim(`pp`.`key_value`),'') AS `cost_center`,round(sum(((case when (`ptc`.`transaction_class_code` = 'SALARY') then 1 when (`ptc`.`transaction_class_code` in ('ABSENCES','DEDUCTION_LATE','DEDUCTION_UNDERTIME')) then -(1) when (`pct`.`transaction_code` in ('LWOP','LWOP_ADJ')) then -(1) else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `total_basic`,round(sum(((case when (`ptc`.`transaction_class_code` = 'OVERTIME') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `overtime`,round(sum(((case when (`pt`.`transaction_type_id` in (2,6,7)) then 1 when ((`pt`.`transaction_type_id` = 6) and (`ptc`.`transaction_class_code` <> 'BONUS_TAXABLE')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `other_nontax`,round(sum(((case when (`ptc`.`transaction_class_code` = 'SSS_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `sss_er`,round(sum(((case when (`ptc`.`transaction_class_code` = 'SSS_ECC') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `sss_ec`,round(sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `hdmf_er`,round(sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `phic_er` from (((((((((`ww_payroll_closed_transaction` `pct` left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) left join `ww_users_company` `uc` on((`pct`.`company_id` = `uc`.`company_id`))) left join `ww_partners` `p` on((`pct`.`employee_id` = `p`.`user_id`))) left join `ww_partners_personal` `pp` on(((`pp`.`deleted` = 0) and (`pp`.`partner_id` = `p`.`partner_id`) and (`pp`.`key` = 'cost_center-cost_center')))) left join `ww_users_position` `po` on((`pct`.`position_id` = `po`.`position_id`))) left join `ww_users_project` `uproj` on((`pct`.`project_id` = `uproj`.`project_id`))) left join `ww_payroll_rate_type` `prt` on((`pct`.`payroll_rate_type_id` = `prt`.`payroll_rate_type_id`))) where ((`pct`.`deleted` = 0) and (`pt`.`deleted` = 0) and (`u`.`deleted` = 0)) group by `pct`.`employee_id`,`pp`.`key_value` order by `cost_center`,`project_id` */;

/*View structure for view payroll_salary_per_department */

/*!50001 DROP TABLE IF EXISTS `payroll_salary_per_department` */;
/*!50001 DROP VIEW IF EXISTS `payroll_salary_per_department` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_salary_per_department` AS select `d`.`department` AS `Department`,`pct`.`payroll_date` AS `Payroll`,round(aes_decrypt(`p`.`salary`,`encryption_key`()),2) AS `Reg. Sal`,round(sum(((case when (`ptc`.`transaction_class_code` = 'OVERTIME') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `Overtime`,round(sum(((case when (`pct`.`transaction_code` = 'SALADJ') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `Salary Adjustment`,round(sum(((case when (`pct`.`transaction_code` in ('ABSENCES','ABSENCES_ADJ','LWOP','LWOP_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `Absences`,round(sum(((case when (`pct`.`transaction_code` in ('DEDUCTION_LATE','DEDUCTION_LATE_ADJ','DEDUCTION_UNDERTIME','DEDUCTION_UNDERTIME_ADJ')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `UT/Tardiness`,round(sum(((case when (`pct`.`transaction_code` = 'INCENTIVES') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `Incentives`,round(sum(((case when (`pct`.`transaction_code` = 'SIL') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `SIL`,round(sum(((case when (`pct`.`transaction_code` in ('VLSLNT','VLSLTAX')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `Leave Conversion`,round(sum(((case when (`pct`.`transaction_code` in ('BIP','PBBPA','PBBSB')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `BIP/PBB`,round(sum(((case when (`pct`.`transaction_code` like 'ECOLA') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `COLA`,round(sum(((case when (`pct`.`transaction_code` = 'TRANSPO') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `Transportation Allowance`,round(sum(((case when (`pct`.`transaction_code` = 'TAXREF') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `Tax Adj`,round(sum(((case when (`pct`.`transaction_code` = 'LNREF') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `Loan Refund`,round(sum(((case when (`pct`.`transaction_code` = 'SSS_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `SSS`,round(sum(((case when (`pct`.`transaction_code` = 'HDMF_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `Pag-Ibig`,round(sum(((case when (`pct`.`transaction_code` = 'PHIC_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `PhilHealth` from (((`ww_payroll_closed_transaction` `pct` left join `ww_payroll_transaction_class` `ptc` on((`ptc`.`transaction_class_id` = `pct`.`transaction_class_id`))) left join `ww_payroll_partners` `p` on((`pct`.`employee_id` = `p`.`user_id`))) left join `ww_users_department` `d` on((`d`.`department_id` = `pct`.`department_id`))) group by `d`.`department` */;

/*View structure for view payroll_sss_loan */

/*!50001 DROP TABLE IF EXISTS `payroll_sss_loan` */;
/*!50001 DROP VIEW IF EXISTS `payroll_sss_loan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_sss_loan` AS select `uc`.`company_id` AS `company_id`,`uc`.`company` AS `company`,`uc`.`sss` AS `sss`,`u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`pp`.`sss_no` AS `sss_no`,year(`lp`.`payroll_date`) AS `year`,month(`lp`.`payroll_date`) AS `month_id`,`m`.`month` AS `month`,`pl`.`partner_loan_id` AS `partner_loan_id`,concat(replace(`u`.`lastname`,' *',''),', ',`u`.`firstname`,' ',`u`.`middlename`) AS `employee_name`,`u`.`lastname` AS `lastname`,`u`.`firstname` AS `firstname`,`u`.`middlename` AS `middlename`,`u`.`suffix` AS `suffix`,`lt`.`loan_code` AS `loan_code`,`pl`.`entry_date` AS `release_date`,`lt`.`loan_type_id` AS `loan_type_id`,ifnull(round(aes_decrypt(`pl`.`loan_principal`,`encryption_key`()),2),0) AS `loan_principal`,round(sum(aes_decrypt(`lp`.`amount`,`encryption_key`())),2) AS `current`,0.00 AS `overdue`,round(sum(aes_decrypt(`lp`.`amount`,`encryption_key`())),2) AS `due`,'' AS `remarks`,if((isnull(`p`.`resigned_date`) or (`p`.`resigned_date` = '0000-00-00')),'/ /',`p`.`resigned_date`) AS `resigned_date` from ((((((((`ww_payroll_partners_loan` `pl` left join `ww_payroll_partners_loan_payment` `lp` on((`pl`.`partner_loan_id` = `lp`.`partner_loan_id`))) left join `ww_users_profile` `u` on((`pl`.`user_id` = `u`.`user_id`))) left join `ww_partners` `p` on((`pl`.`user_id` = `p`.`user_id`))) left join `ww_payroll_partners` `pp` on((`pl`.`user_id` = `pp`.`user_id`))) left join `ww_users_company` `uc` on((`u`.`company_id` = `uc`.`company_id`))) left join `ww_payroll_loan` `l` on((`pl`.`loan_id` = `l`.`loan_id`))) left join `ww_payroll_loan_type` `lt` on((`l`.`loan_type_id` = `lt`.`loan_type_id`))) left join `ww_month` `m` on((month(`lp`.`date_paid`) = `m`.`month_id`))) where ((`lt`.`loan_type` like '%SSS%') and (`lt`.`deleted` = 0) and (`pl`.`deleted` = 0) and (`lp`.`deleted` = 0)) group by `uc`.`company_id`,`uc`.`company`,`uc`.`sss`,`u`.`user_id`,`p`.`id_number`,`pp`.`sss_no`,year(`lp`.`date_paid`),month(`lp`.`date_paid`),`m`.`month`,`pl`.`partner_loan_id`,`lt`.`loan_code`,`pl`.`release_date` */;

/*View structure for view payroll_sss_loan_to_disk_report */

/*!50001 DROP TABLE IF EXISTS `payroll_sss_loan_to_disk_report` */;
/*!50001 DROP VIEW IF EXISTS `payroll_sss_loan_to_disk_report` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_sss_loan_to_disk_report` AS select `uc`.`company_id` AS `company_id`,`uc`.`company` AS `company`,ifnull(`uc`.`sss_branch_code`,'00') AS `sss_branch_code`,`d`.`department_id` AS `department_id`,`d`.`department` AS `department`,`u`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,replace(`uc`.`sss`,'-','') AS `sss`,`u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`pp`.`sss_no` AS `sss_no`,year(`lp`.`payroll_date`) AS `year`,month(`lp`.`payroll_date`) AS `month_id`,`m`.`month` AS `month`,`pl`.`partner_loan_id` AS `partner_loan_id`,concat(replace(`u`.`lastname`,' *',''),', ',`u`.`firstname`,' ',`u`.`middlename`) AS `employee_name`,`u`.`lastname` AS `lastname`,`u`.`firstname` AS `firstname`,`u`.`middlename` AS `middlename`,`u`.`suffix` AS `suffix`,`lt`.`loan_code` AS `loan_code`,`pl`.`entry_date` AS `release_date`,`lt`.`loan_type_id` AS `loan_type_id`,ifnull(round(aes_decrypt(`pl`.`loan_principal`,`encryption_key`()),2),0) AS `loan_principal`,round(sum(aes_decrypt(`lp`.`amount`,`encryption_key`())),2) AS `current`,0.00 AS `overdue`,round(sum(aes_decrypt(`lp`.`amount`,`encryption_key`())),2) AS `due`,'' AS `remarks`,if((isnull(`p`.`resigned_date`) or (`p`.`resigned_date` = '0000-00-00')),'/ /',`p`.`resigned_date`) AS `resigned_date`,concat('10',lpad(replace(`pp`.`sss_no`,'-',''),10,'0'),(case when (locate('ñ',`u`.`lastname`) <> 'false') then rpad(replace(`u`.`lastname`,' *',''),15,' ') else rpad(replace(`u`.`lastname`,' *',''),15,' ') end),(case when (locate('ñ',`u`.`firstname`) <> 'false') then rpad(`u`.`firstname`,15,' ') else rpad(`u`.`firstname`,15,' ') end),(case when (`u`.`middlename` <> '') then rpad(substr(`u`.`middlename`,1,1),2,' ') else rpad('',2,' ') end),`lt`.`loan_code`,date_format(`pl`.`entry_date`,'%y%m%d'),'0',rpad(ifnull(round(aes_decrypt(`pl`.`loan_principal`,`encryption_key`()),0),0),13,'0'),lpad(replace(round(sum(aes_decrypt(`lp`.`amount`,`encryption_key`())),2),'.',''),6,'0')) AS `record`,now() AS `document_date` from ((((((((((`ww_payroll_partners_loan` `pl` left join `ww_payroll_partners_loan_payment` `lp` on((`pl`.`partner_loan_id` = `lp`.`partner_loan_id`))) left join `ww_users_profile` `u` on((`pl`.`user_id` = `u`.`user_id`))) left join `ww_partners` `p` on((`pl`.`user_id` = `p`.`user_id`))) left join `ww_payroll_partners` `pp` on((`pl`.`user_id` = `pp`.`user_id`))) left join `ww_users_company` `uc` on((`u`.`company_id` = `uc`.`company_id`))) left join `ww_users_department` `d` on((`u`.`department_id` = `d`.`department_id`))) left join `ww_users_branch` `b` on((`b`.`branch_id` = `u`.`branch_id`))) left join `ww_payroll_loan` `l` on((`pl`.`loan_id` = `l`.`loan_id`))) left join `ww_payroll_loan_type` `lt` on((`l`.`loan_type_id` = `lt`.`loan_type_id`))) left join `ww_month` `m` on((month(`lp`.`date_paid`) = `m`.`month_id`))) where ((`lt`.`loan_type` like '%SSS%') and (`lt`.`deleted` = 0) and (`pl`.`deleted` = 0) and (`lp`.`deleted` = 0)) group by `uc`.`company_id`,`uc`.`company`,`uc`.`sss`,`u`.`user_id`,`p`.`id_number`,`pp`.`sss_no`,year(`lp`.`date_paid`),month(`lp`.`date_paid`),`m`.`month`,`pl`.`partner_loan_id`,`lt`.`loan_code`,`pl`.`release_date` */;

/*View structure for view payroll_sss_to_disk_report */

/*!50001 DROP TABLE IF EXISTS `payroll_sss_to_disk_report` */;
/*!50001 DROP VIEW IF EXISTS `payroll_sss_to_disk_report` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_sss_to_disk_report` AS (select `payroll_partners_contribution_sss`.`lastname` AS `lastname`,`payroll_partners_contribution_sss`.`firstname` AS `firstname`,`payroll_partners_contribution_sss`.`middlename` AS `middlename`,`payroll_partners_contribution_sss`.`year` AS `year`,`payroll_partners_contribution_sss`.`month` AS `month`,(`payroll_partners_contribution_sss`.`sss_emp` + `payroll_partners_contribution_sss`.`sss_com`) AS `contribution`,`payroll_partners_contribution_sss`.`sss_ecc` AS `ec`,`payroll_partners_contribution_sss`.`user_id` AS `user_id`,`payroll_partners_contribution_sss`.`department_id` AS `department_id`,`payroll_partners_contribution_sss`.`branch_id` AS `branch_id`,`payroll_partners_contribution_sss`.`branch` AS `branch`,`payroll_partners_contribution_sss`.`company_id` AS `company_id`,`payroll_partners_contribution_sss`.`company` AS `company`,`payroll_partners_contribution_sss`.`company_code` AS `company_code`,`payroll_partners_contribution_sss`.`co_sss` AS `co_sss`,`get_sbr_date`(`payroll_partners_contribution_sss`.`user_id`,`payroll_partners_contribution_sss`.`payroll_date`,'SSS_EMP') AS `doc_date`,`get_sbr_no`(`payroll_partners_contribution_sss`.`user_id`,`payroll_partners_contribution_sss`.`payroll_date`,'SSS_EMP') AS `doc_no`,concat(rpad('20',5,' '),(case when (locate('ñ',`payroll_partners_contribution_sss`.`lastname`) <> 'false') then rpad(replace(`payroll_partners_contribution_sss`.`lastname`,' *',''),21,' ') else rpad(replace(`payroll_partners_contribution_sss`.`lastname`,' *',''),20,' ') end),(case when (locate('ñ',`payroll_partners_contribution_sss`.`firstname`) <> 'false') then rpad(`payroll_partners_contribution_sss`.`firstname`,21,' ') else rpad(`payroll_partners_contribution_sss`.`firstname`,20,' ') end),(case when (`payroll_partners_contribution_sss`.`middlename` <> '') then rpad(replace(`payroll_partners_contribution_sss`.`middlename`,'.',''),1,'') else ' ' end),rpad(replace(`payroll_partners_contribution_sss`.`sss_no`,'-',''),11,'0'),round((`payroll_partners_contribution_sss`.`sss_emp` + `payroll_partners_contribution_sss`.`sss_com`),2),'000',round(`payroll_partners_contribution_sss`.`sss_ecc`,2),lpad(if((`payroll_partners_contribution_sss`.`govt_status` = 1),date_format(`payroll_partners_contribution_sss`.`hired_date`,'%Y%m%d'),''),8,' '),`payroll_partners_contribution_sss`.`govt_status`) AS `record`,now() AS `document_date` from `payroll_partners_contribution_sss`) */;

/*View structure for view payroll_sssr5_report */

/*!50001 DROP TABLE IF EXISTS `payroll_sssr5_report` */;
/*!50001 DROP VIEW IF EXISTS `payroll_sssr5_report` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_sssr5_report` AS (select `uc`.`company` AS `company`,`pp`.`company_id` AS `company_id`,`uc`.`tin` AS `tin`,`uc`.`sss` AS `co_sss`,`uc`.`phic` AS `co_phic`,`uc`.`hdmf` AS `co_hdmf`,`uc`.`address` AS `co_address`,`uc`.`zipcode` AS `zipcode`,`getcompany_contact`(`pp`.`company_id`,'phone') AS `contact_no`,`ud`.`department_id` AS `department_id`,`ud`.`department` AS `department`,year(`pct`.`payroll_date`) AS `year`,month(`pct`.`payroll_date`) AS `month`,`up`.`birth_date` AS `birth_date`,`pp`.`sss_no` AS `sss_no`,`pp`.`phic_no` AS `phic_no`,`pp`.`hdmf_no` AS `hdmf_no`,round(sum(((case when (`pct`.`transaction_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `sss_emp`,round(sum(((case when (`pct`.`transaction_code` = 'SSS_COM') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `sss_com`,round(sum(((case when (`pct`.`transaction_code` = 'SSS_ECC') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `sss_ecc` from ((((((`ww_payroll_closed_transaction` `pct` join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `pct`.`employee_id`))) join `ww_partners` `p` on((`pct`.`employee_id` = `p`.`user_id`))) join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`pct`.`employee_id` = `up`.`user_id`))) join `ww_users_company` `uc` on((`uc`.`company_id` = `pp`.`company_id`))) join `ww_users_department` `ud` on((`up`.`department_id` = `ud`.`department_id`))) group by `pct`.`company_id`,year(`pct`.`payroll_date`),month(`pct`.`payroll_date`)) */;

/*View structure for view payroll_summary */

/*!50001 DROP TABLE IF EXISTS `payroll_summary` */;
/*!50001 DROP VIEW IF EXISTS `payroll_summary` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_summary` AS select `pct`.`employee_id` AS `employee_id`,`u`.`full_name` AS `full_name`,`pct`.`company_id` AS `company_id`,`uc`.`company` AS `company`,`t`.`amount` AS `exempt`,`t`.`dependent` AS `no_dependent`,year(`pct`.`payroll_date`) AS `year`,round(sum(((case when (`pt`.`transaction_code` in ('SALARY','SALADJ')) then 1 when ((`pt`.`transaction_type_id` = 5) and (`ptc`.`government_mandated` = 0)) then -(1) else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `tot_basic`,round(sum(((case when (`ptc`.`transaction_class_code` = 'OVERTIME') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `overtime`,round(sum(((case when ((`pt`.`transaction_type_id` = 2) and (`ptc`.`transaction_class_code` not in ('BONUS','LEAVES','BONUS_TAXABLE'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `benefits`,round(sum(((case when ((`pt`.`transaction_type_id` = 1) and (`pt`.`transaction_code` not in ('SALARY','SALADJ')) and (`ptc`.`transaction_class_code` not in ('OVERTIME','BONUS','LEAVES','BONUS_TAXABLE'))) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `allowance`,round(sum(((case when ((`pt`.`transaction_type_id` = 2) and (`ptc`.`transaction_class_code` = 'LEAVES')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `leave_nt`,round(sum(((case when ((`pt`.`transaction_type_id` = 1) and (`ptc`.`transaction_class_code` = 'LEAVES')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `leave_tax`,round(sum(((case when ((`pt`.`transaction_type_id` = 2) and (`ptc`.`transaction_class_code` = 'BONUS')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `bonus_nt`,round(sum(((case when ((`pt`.`transaction_type_id` = 1) and (`ptc`.`transaction_class_code` = 'BONUS_TAXABLE')) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `bonus_tax`,round(sum(((case when ((`pt`.`transaction_type_id` = 5) and (`ptc`.`government_mandated` = 1)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `contribution`,round(sum(((case when (`ptc`.`transaction_class_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `wtax`,round(sum(((case when (`ptc`.`transaction_class_code` = 'SSS_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `sss`,round(sum(((case when (`ptc`.`transaction_class_code` = 'PHIC_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `philhealth`,round(sum(((case when (`ptc`.`transaction_class_code` = 'HDMF_EMP') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))),2) AS `pagibig` from (((((((`ww_payroll_closed_transaction` `pct` left join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `pct`.`employee_id`))) left join `ww_users` `u` on((`u`.`user_id` = `pct`.`employee_id`))) left join `ww_users_profile` `up` on((`up`.`user_id` = `u`.`user_id`))) left join `ww_payroll_transaction` `pt` on((`pct`.`transaction_id` = `pt`.`transaction_id`))) left join `ww_payroll_transaction_class` `ptc` on((`pt`.`transaction_class_id` = `ptc`.`transaction_class_id`))) left join `ww_taxcode` `t` on((`t`.`taxcode_id` = `pp`.`taxcode_id`))) left join `ww_users_company` `uc` on((`uc`.`company_id` = `pct`.`company_id`))) group by `pct`.`employee_id`,year(`pct`.`payroll_date`) */;

/*View structure for view payroll_tax */

/*!50001 DROP TABLE IF EXISTS `payroll_tax` */;
/*!50001 DROP VIEW IF EXISTS `payroll_tax` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_tax` AS (select `payroll_tax_contribution`.`user_id` AS `user_id`,`payroll_tax_contribution`.`id_number` AS `id_number`,`payroll_tax_contribution`.`full_name` AS `full_name`,`payroll_tax_contribution`.`tin` AS `tin`,`payroll_tax_contribution`.`company` AS `company`,`payroll_tax_contribution`.`company_id` AS `company_id`,`payroll_tax_contribution`.`department_id` AS `department_id`,`payroll_tax_contribution`.`department` AS `department`,year(`payroll_tax_contribution`.`payroll_date`) AS `year`,month(`payroll_tax_contribution`.`payroll_date`) AS `month`,`payroll_tax_contribution`.`sensitivity` AS `sensitivity`,sum(((case `payroll_tax_contribution`.`period` when 1 then 1 else 0 end) * `payroll_tax_contribution`.`gross_pay`)) AS `gross_pay1`,sum(((case `payroll_tax_contribution`.`period` when 1 then 1 else 0 end) * `payroll_tax_contribution`.`whtax`)) AS `whtax1`,sum(((case `payroll_tax_contribution`.`period` when 2 then 1 else 0 end) * `payroll_tax_contribution`.`gross_pay`)) AS `gross_pay2`,sum(((case `payroll_tax_contribution`.`period` when 2 then 1 else 0 end) * `payroll_tax_contribution`.`whtax`)) AS `whtax2` from `payroll_tax_contribution` group by `payroll_tax_contribution`.`user_id`,year(`payroll_tax_contribution`.`payroll_date`),month(`payroll_tax_contribution`.`payroll_date`)) */;

/*View structure for view payroll_tax_contribution */

/*!50001 DROP TABLE IF EXISTS `payroll_tax_contribution` */;
/*!50001 DROP VIEW IF EXISTS `payroll_tax_contribution` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payroll_tax_contribution` AS (select `u`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`wpp`.`tin` AS `tin`,`uc`.`company` AS `company`,`wpp`.`company_id` AS `company_id`,`ud`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`pct`.`payroll_date` AS `payroll_date`,`pp`.`date_from` AS `date_from`,`pp`.`date_to` AS `date_to`,`wpp`.`sensitivity` AS `sensitivity`,(case `pp`.`week` when 1 then 1 when 2 then 1 when 3 then 2 when 4 then 2 else 0 end) AS `period`,(sum(((case when (`pct`.`transaction_type_id` in (1,6)) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) - sum(((case when (`pt`.`transaction_type_id` = 5) then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`())))) AS `gross_pay`,sum(((case when (`pct`.`transaction_code` = 'WHTAX') then 1 else 0 end) * aes_decrypt(`pct`.`amount`,`encryption_key`()))) AS `whtax` from (((((((((`ww_payroll_closed_transaction` `pct` join `ww_payroll_transaction_class` `ptc` on((`ptc`.`transaction_class_id` = `pct`.`transaction_class_id`))) join `ww_payroll_transaction` `pt` on((`pt`.`transaction_id` = `pct`.`transaction_id`))) join `ww_users` `u` on((`pct`.`employee_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `pct`.`employee_id`))) join `ww_users_department` `ud` on((`ud`.`department_id` = `up`.`department_id`))) join `ww_partners` `p` on((`p`.`user_id` = `pct`.`employee_id`))) join `ww_payroll_period` `pp` on((`pp`.`payroll_period_id` = `pct`.`period_id`))) join `ww_payroll_partners` `wpp` on((`wpp`.`user_id` = `up`.`user_id`))) join `ww_users_company` `uc` on((`uc`.`company_id` = `wpp`.`company_id`))) where ((`pct`.`on_hold` = 0) and (`pct`.`deleted` = 0) and (`ptc`.`deleted` = 0) and (`pt`.`deleted` = 0)) group by `pct`.`employee_id`,`pct`.`payroll_date`) */;

/*View structure for view play_partner */

/*!50001 DROP TABLE IF EXISTS `play_partner` */;
/*!50001 DROP VIEW IF EXISTS `play_partner` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `play_partner` AS (select `ww_users`.`user_id` AS `user_id`,`ww_users`.`display_name` AS `alias`,`ww_play_partner_points`.`league_id` AS `league_id`,`ww_play_league`.`league` AS `league`,`ww_play_partner_points`.`level_no` AS `level_no`,`ww_play_partner_points`.`points` AS `points`,`ww_play_level`.`points_to` AS `end_point`,`ww_play_partner_points`.`jars` AS `jars`,`ww_play_partner_points`.`total_points` AS `total_points`,`ww_play_partner_points`.`used_points` AS `used_points`,`ww_play_partner_points`.`redeemed` AS `redeemed` from (((`ww_users` left join `ww_play_partner_points` on((`ww_play_partner_points`.`user_id` = `ww_users`.`user_id`))) left join `ww_play_league` on((`ww_play_league`.`league_id` = `ww_play_partner_points`.`league_id`))) left join `ww_play_level` on((`ww_play_level`.`level_id` = `ww_play_partner_points`.`level_no`))) where ((`ww_users`.`deleted` = 0) and (`ww_users`.`active` = 1))) */;

/*View structure for view play_partner_badge */

/*!50001 DROP TABLE IF EXISTS `play_partner_badge` */;
/*!50001 DROP VIEW IF EXISTS `play_partner_badge` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `play_partner_badge` AS (select `ww_users`.`user_id` AS `user_id`,`ww_users`.`display_name` AS `alias`,`ww_play_badges`.`badge_id` AS `badge_id`,`ww_play_badges`.`badge` AS `badge`,ifnull(`ww_play_partner_badge`.`badge_points`,0) AS `badge_points`,`ww_play_badges`.`points` AS `points`,`ww_play_badges`.`image_path` AS `image_path`,`ww_play_badges`.`description` AS `description` from ((`ww_users` join `ww_play_badges` on((`ww_play_badges`.`deleted` = 0))) left join `ww_play_partner_badge` on(((`ww_play_partner_badge`.`user_id` = `ww_users`.`user_id`) and (`ww_play_badges`.`badge_id` = `ww_play_partner_badge`.`badge_id`)))) where ((`ww_users`.`deleted` = 0) and (`ww_users`.`active` = 1))) */;

/*View structure for view recruitment_request */

/*!50001 DROP TABLE IF EXISTS `recruitment_request` */;
/*!50001 DROP VIEW IF EXISTS `recruitment_request` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `recruitment_request` AS (select `rq`.`document_no` AS `document_no`,`p`.`position` AS `position`,`c`.`company_id` AS `company_id`,`c`.`company` AS `company`,`d`.`department` AS `department`,`u`.`full_name` AS `requested_by`,date_format(`rq`.`date_needed`,'%M %d, %Y') AS `recruitment_request_date`,date_format(`ra`.`modified_on`,'%b %d, %Y %h:%i %p') AS `recruitment_request_date_approved`,`rs`.`recruit_status` AS `recruit_status` from ((((((`ww_recruitment_request` `rq` left join `ww_users_department` `d` on((`rq`.`department_id` = `d`.`department_id`))) left join `ww_users_company` `c` on((`rq`.`company_id` = `c`.`company_id`))) left join `ww_users_position` `p` on((`rq`.`position_id` = `p`.`position_id`))) left join `ww_recruitment_request_status` `rs` on((`rq`.`status_id` = `rs`.`recruit_status_id`))) left join `ww_recruitment_request_approver` `ra` on((`rq`.`request_id` = `ra`.`request_id`))) left join `ww_users` `u` on((`rq`.`user_id` = `u`.`user_id`))) where (`rq`.`deleted` = 0)) */;

/*View structure for view report_late_monitoring */

/*!50001 DROP TABLE IF EXISTS `report_late_monitoring` */;
/*!50001 DROP VIEW IF EXISTS `report_late_monitoring` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report_late_monitoring` AS (select `tp`.`payroll_date` AS `payroll_date`,`up`.`company_id` AS `company_id`,`up`.`company` AS `company`,`up`.`project_id` AS `project_id`,`uproj`.`project_code` AS `project_code`,`uproj`.`project` AS `project`,`u`.`full_name` AS `full_name`,`p`.`id_number` AS `id_number`,`tr`.`date` AS `date`,`trs`.`late` AS `late`,`pp`.`payroll_rate_type_id` AS `payroll_rate_type_id`,`prt`.`payroll_rate_type` AS `payroll_rate_type`,concat(`uproj`.`project_code`,' - ',`uproj`.`project`) AS `project_title` from ((((((((`ww_time_period` `tp` join `time_record` `tr` on((`tr`.`date` between `tp`.`date_from` and `tp`.`date_to`))) join `time_record_summary` `trs` on(((`trs`.`date` = `tr`.`date`) and (`trs`.`user_id` = `tr`.`user_id`)))) join `users` `u` on((`u`.`user_id` = `tr`.`user_id`))) join `users_profile` `up` on(((`up`.`user_id` = `u`.`user_id`) and (`up`.`company_id` = `tp`.`company_id`)))) join `partners` `p` on((`p`.`user_id` = `u`.`user_id`))) left join `ww_users_project` `uproj` on((`uproj`.`project_id` = `up`.`project_id`))) left join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `u`.`user_id`))) left join `ww_payroll_rate_type` `prt` on((`prt`.`payroll_rate_type_id` = `pp`.`payroll_rate_type_id`))) order by `uproj`.`project`,`u`.`full_name`,`tr`.`date`) */;

/*View structure for view report_leave_summary */

/*!50001 DROP TABLE IF EXISTS `report_leave_summary` */;
/*!50001 DROP VIEW IF EXISTS `report_leave_summary` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report_leave_summary` AS (select `tfs`.`form_status` AS `form_status`,`tf`.`form_code` AS `form_code`,`tf`.`user_id` AS `user_id`,`u`.`full_name` AS `full_name`,`tf`.`day` AS `day`,`tf`.`date_from` AS `date_from`,`tf`.`date_to` AS `date_to`,`tf`.`reason` AS `reason`,`p`.`id_number` AS `id_number`,`up`.`company_id` AS `company_id`,`up`.`company` AS `company` from ((((`ww_time_forms` `tf` join `users` `u` on((`u`.`user_id` = `tf`.`user_id`))) join `users_profile` `up` on((`up`.`user_id` = `u`.`user_id`))) join `partners` `p` on((`p`.`user_id` = `u`.`user_id`))) join `ww_time_form_status` `tfs` on((`tfs`.`form_status_id` = `tf`.`form_status_id`))) where ((`tf`.`form_code` in ('SL','VL')) and (`tf`.`deleted` = 0)) order by `u`.`full_name`) */;

/*View structure for view report_monthly_overtime */

/*!50001 DROP TABLE IF EXISTS `report_monthly_overtime` */;
/*!50001 DROP VIEW IF EXISTS `report_monthly_overtime` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report_monthly_overtime` AS (select `p`.`id_number` AS `employee_number`,concat(`up`.`firstname`,' ',`up`.`lastname`) AS `name`,year(`trs`.`date`) AS `year`,month(`trs`.`date`) AS `month_id`,`up`.`company_id` AS `company_id`,`up`.`company` AS `company`,`ud`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,sum((case when (`m`.`month_id` = 1) then `trs`.`ot` else 0 end)) AS `Jan`,sum((case when (`m`.`month_id` = 2) then `trs`.`ot` else 0 end)) AS `Feb`,sum((case when (`m`.`month_id` = 3) then `trs`.`ot` else 0 end)) AS `Mar`,sum((case when (`m`.`month_id` = 4) then `trs`.`ot` else 0 end)) AS `Apr`,sum((case when (`m`.`month_id` = 5) then `trs`.`ot` else 0 end)) AS `May`,sum((case when (`m`.`month_id` = 6) then `trs`.`ot` else 0 end)) AS `Jun`,sum((case when (`m`.`month_id` = 7) then `trs`.`ot` else 0 end)) AS `Jul`,sum((case when (`m`.`month_id` = 8) then `trs`.`ot` else 0 end)) AS `Aug`,sum((case when (`m`.`month_id` = 9) then `trs`.`ot` else 0 end)) AS `Sep`,sum((case when (`m`.`month_id` = 10) then `trs`.`ot` else 0 end)) AS `Oct`,sum((case when (`m`.`month_id` = 11) then `trs`.`ot` else 0 end)) AS `Nov`,sum((case when (`m`.`month_id` = 12) then `trs`.`ot` else 0 end)) AS `Dec`,'' AS `number_of_ot_months`,sum(`trs`.`ot`) AS `total_ot_hours`,'' AS `average_per_ee` from (((((((`ww_users` `u` join `ww_partners` `p` on((`u`.`user_id` = `p`.`user_id`))) join `ww_payroll_partners` `pp` on((`u`.`user_id` = `pp`.`user_id`))) join `ww_users_profile` `up` on((`p`.`user_id` = `up`.`user_id`))) join `ww_time_record_summary` `trs` on((`u`.`user_id` = `trs`.`user_id`))) join `ww_users_department` `ud` on((`up`.`department_id` = `ud`.`department_id`))) left join `ww_users_branch` `b` on((`b`.`branch_id` = `up`.`branch_id`))) join `ww_month` `m` on((month(`trs`.`date`) = `m`.`month_id`))) where (`u`.`active` = 1) group by `u`.`user_id`,year(`trs`.`date`) order by `up`.`company`,`ud`.`department`,`up`.`lastname`,`up`.`firstname`) */;

/*View structure for view report_partners_manpower */

/*!50001 DROP TABLE IF EXISTS `report_partners_manpower` */;
/*!50001 DROP VIEW IF EXISTS `report_partners_manpower` */;

/*!50001 CREATE ALGORITHM=MERGE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report_partners_manpower` AS (select `up`.`title` AS `title`,`up`.`lastname` AS `lastname`,`up`.`firstname` AS `firstname`,`up`.`middlename` AS `middlename`,`up`.`suffix` AS `suffix`,`up`.`maidenname` AS `maidenname`,`up`.`nickname` AS `nickname`,`up`.`specialization_id` AS `specialization_id`,`up`.`v_specialization` AS `specialization`,`up`.`company_id` AS `company_id`,`up`.`company` AS `company`,`up`.`location_id` AS `location_id`,`up`.`v_location` AS `location`,`up`.`position_id` AS `position_id`,`up`.`v_position` AS `position`,`role`.`role_id` AS `role_id`,`role`.`role` AS `role`,`p`.`id_number` AS `id_number`,`p`.`biometric` AS `biometric`,`p`.`calendar_id` AS `calendar_id`,`p`.`calendar` AS `calendar`,`p`.`status_id` AS `status_id`,`p`.`status` AS `status`,`p`.`employment_type_id` AS `employment_type_id`,`p`.`employment_type` AS `employment_type`,`p`.`job_grade_id` AS `job_grade_id`,`p`.`v_job_grade` AS `job_grade`,`p`.`classification_id` AS `classification_id`,`p`.`classification` AS `classification`,`p`.`effectivity_date` AS `date_hired`,`p`.`employment_end_date` AS `employment_end_date`,`p`.`original_hired_date` AS `original_hired_date`,`up`.`reports_to_id` AS `reports_to_id`,`up`.`v_reports_to` AS `reports_to`,`up`.`project_hr_id` AS `project_hr_id`,`up`.`v_project_hr` AS `project_hr`,`pp`.`organization` AS `organization`,`up`.`division_id` AS `division_id`,`up`.`v_division` AS `division`,`up`.`department_id` AS `department_id`,`up`.`v_department` AS `department`,`up`.`branch_id` AS `branch_id`,`up`.`v_branch` AS `branch`,`up`.`section_id` AS `section_id`,`up`.`v_section` AS `section`,`up`.`project_id` AS `project_id`,`up`.`v_project` AS `project`,`up`.`start_date` AS `start_date`,`up`.`end_date` AS `end_date`,`up`.`v_credit_setup` AS `credit_setup`,`pp`.`phone_1` AS `phone_1`,`pp`.`phone_2` AS `phone_2`,`pp`.`phone_3` AS `phone_3`,`pp`.`mobile_1` AS `mobile_1`,`pp`.`mobile_2` AS `mobile_2`,`pp`.`mobile_3` AS `mobile_3`,`u`.`email` AS `email`,`pp`.`address` AS `address`,`pp`.`city_town` AS `city_town`,`pp`.`country` AS `country`,`pp`.`zip_code` AS `zip_code`,`pp`.`emergency_name` AS `emergency_name`,`pp`.`emergency_relationship` AS `emergency_relationship`,`pp`.`emergency_phone` AS `emergency_phone`,`pp`.`emergency_mobile` AS `emergency_mobile`,`pp`.`emergency_address` AS `emergency_address`,`pp`.`emergency_city` AS `emergency_city`,`pp`.`emergency_country` AS `emergency_country`,`pp`.`emergency_zip_code` AS `emergency_zip_code`,`tc`.`taxcode` AS `taxcode`,`pp`.`sss_number` AS `sss_number`,`pp`.`pagibig_number` AS `pagibig_number`,`pp`.`philhealth_number` AS `philhealth_number`,`pp`.`tin_number` AS `tin_number`,`pp`.`bank_account_number_savings` AS `bank_account_number_savings`,`pp`.`bank_account_number_current` AS `bank_account_number_current`,`pp`.`bank_account_name` AS `bank_account_name`,`pp`.`gender` AS `gender`,`up`.`birth_date` AS `birth_date`,`pp`.`birth_place` AS `birth_place`,`pp`.`religion` AS `religion`,`pp`.`nationality` AS `nationality`,`pp`.`civil_status` AS `civil_status`,if((`pp`.`solo_parent` = 0),'No','Yes') AS `solo_parent`,if((`u`.`active` = 1),1,2) AS `active` from (((((`ww_users` `u` join `ww_partners` `p` on((`p`.`user_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `p`.`user_id`))) left join `partners_personal` `pp` on((`p`.`user_id` = `pp`.`user_id`))) left join `ww_roles` `role` on((`u`.`role_id` = `role`.`role_id`))) left join `ww_taxcode` `tc` on((`pp`.`taxcode` = `tc`.`taxcode_id`))) order by `up`.`company`,`up`.`v_department`,`up`.`lastname`,`up`.`firstname`) */;

/*View structure for view report_recruitment_funnel */

/*!50001 DROP TABLE IF EXISTS `report_recruitment_funnel` */;
/*!50001 DROP VIEW IF EXISTS `report_recruitment_funnel` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report_recruitment_funnel` AS (select `up`.`firstname` AS `poc`,`rs`.`recruit_status` AS `status`,`rr`.`quantity` AS `no_of_headcount_required`,`rr`.`document_no` AS `prf`,`rr`.`date_needed` AS `date_opened`,`rr`.`closed_on` AS `date_closed`,`rrn`.`nature` AS `headcount_type`,`upo`.`position` AS `position_title`,`u`.`full_name` AS `hiring_manage`,`ud`.`department` AS `department`,`pes`.`employment_status` AS `cat_employee_type`,`r`.`source_id` AS `sourcing_tool`,concat(`r`.`firstname`,' ',`r`.`lastname`) AS `candidates_name` from (((((((((`ww_recruitment` `r` left join `ww_recruitment_request` `rr` on((`rr`.`request_id` = `r`.`request_id`))) left join `ww_users` `u` on((`u`.`user_id` = `rr`.`hr_remarks_by`))) left join `ww_users_profile` `up` on((`up`.`user_id` = `rr`.`hr_assigned`))) left join `ww_recruitment_request_nature` `rrn` on((`rrn`.`nature_id` = `rr`.`nature_id`))) left join `ww_users_position` `upo` on((`upo`.`position_id` = `rr`.`position_id`))) left join `ww_users_department` `ud` on((`ud`.`department_id` = `rr`.`department_id`))) left join `ww_partners_employment_status` `pes` on((`pes`.`employment_status_id` = `rr`.`employment_status_id`))) left join `ww_recruitment_status` `rs` on((`rs`.`recruit_status_id` = `r`.`status_id`))) left join `ww_partners` `p` on((`p`.`partner_id` = `r`.`partner_id`))) order by `r`.`status_id`,`rr`.`document_no`) */;

/*View structure for view report_resume_bidding */

/*!50001 DROP TABLE IF EXISTS `report_resume_bidding` */;
/*!50001 DROP VIEW IF EXISTS `report_resume_bidding` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report_resume_bidding` AS (select `u`.`user_id` AS `user_id`,`u`.`user_id` AS `employee_name`,`u_prof`.`lastname` AS `lastname`,`u_prof`.`firstname` AS `firstname`,`u_prof`.`middlename` AS `middlename`,`u_prof`.`suffix` AS `suffix`,`u_proj`.`project` AS `project`,`u_proj`.`project_id` AS `project_name`,`u_proj`.`project_id` AS `project_id`,`u_pos`.`position` AS `position_display`,`u_pos`.`position_id` AS `postion_id`,`u_pos`.`position_id` AS `position`,`u_dept`.`department` AS `department`,`u_comp`.`company` AS `company`,`u_comp`.`company_id` AS `company_id`,`u_prof`.`birth_date` AS `birth_date`,`part_per`.`key_value` AS `birth_place`,`part_status`.`key_value` AS `civil_status`,`p`.`resigned_date` AS `resigned_date`,`u_loc`.`location` AS `location`,`p`.`effectivity_date` AS `effectivity_date` from (((((((((((((`ww_users` `u` left join `ww_users_profile` `u_prof` on((`u`.`user_id` = `u_prof`.`user_id`))) left join `ww_users_project` `u_proj` on((`u_prof`.`project_id` = `u_proj`.`project_id`))) left join `ww_users_position` `u_pos` on((`u_prof`.`position_id` = `u_pos`.`position_id`))) left join `ww_users_department` `u_dept` on((`u_prof`.`department_id` = `u_dept`.`department_id`))) left join `ww_users_company` `u_comp` on((`u_prof`.`company_id` = `u_comp`.`company_id`))) left join `ww_users_location` `u_loc` on((`u_prof`.`location_id` = `u_loc`.`location_id`))) left join `ww_partners` `p` on((`u_prof`.`user_id` = `p`.`user_id`))) left join `ww_partners_employment_type` `p_emp_type` on((`p`.`employment_type_id` = `p_emp_type`.`employment_type_id`))) left join `ww_partners_personal` `part_per` on(((`p`.`partner_id` = `part_per`.`partner_id`) and (`part_per`.`key` = 'birth_place')))) left join `ww_partners_personal` `part_status` on(((`p`.`partner_id` = `part_status`.`partner_id`) and (`part_status`.`key` = 'civil_status')))) left join `ww_users_division` `u_div` on((`u_prof`.`division_id` = `u_div`.`division_id`))) left join `ww_users_group` `u_group` on((`u_prof`.`group_id` = `u_group`.`group_id`))) left join `ww_roles` `r` on((`u`.`role_id` = `r`.`role_id`)))) */;

/*View structure for view report_time_compliance */

/*!50001 DROP TABLE IF EXISTS `report_time_compliance` */;
/*!50001 DROP VIEW IF EXISTS `report_time_compliance` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report_time_compliance` AS (select `tp`.`payroll_date` AS `payroll_date`,`up`.`company_id` AS `company_id`,`up`.`company` AS `company`,`u`.`full_name` AS `full_name`,`p`.`id_number` AS `id_number`,`tr`.`date` AS `date`,`tr`.`shift` AS `shift`,`tr`.`time_in` AS `time_from`,`tr`.`time_out` AS `time_to`,`tr`.`aux_time_in` AS `aux_time_from`,`tr`.`aux_time_out` AS `aux_time_to`,concat(if(((`trs`.`absent` > 0) or (`trs`.`awol` > 0)),'AWOL',''),if((`trs`.`lwop` > 0),'LWOP',''),if(((`trs`.`late` > 0) or (`trs`.`undertime` > 0)),'TARDY','')) AS `particulars` from (((((`ww_time_period` `tp` join `time_record_summary` `trs` on((`trs`.`date` < `tp`.`date_from`))) join `time_record` `tr` on(((`tr`.`date` < `tp`.`date_from`) and (`trs`.`user_id` = `tr`.`user_id`)))) join `users` `u` on((`u`.`user_id` = `tr`.`user_id`))) join `users_profile` `up` on(((`up`.`user_id` = `u`.`user_id`) and (`up`.`company_id` = `tp`.`company_id`)))) join `partners` `p` on((`p`.`user_id` = `u`.`user_id`))) where ((`tp`.`deleted` = 0) and ((`trs`.`absent` > 0) or (`trs`.`awol` > 0) or (`trs`.`lwop` > 0) or (`trs`.`late` > 0) or (`trs`.`undertime` > 0))) order by `tp`.`payroll_date`,`u`.`full_name`,`tr`.`date`) */;

/*View structure for view report_time_daily_time_record */

/*!50001 DROP TABLE IF EXISTS `report_time_daily_time_record` */;
/*!50001 DROP VIEW IF EXISTS `report_time_daily_time_record` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report_time_daily_time_record` AS (select `up`.`user_id` AS `user_id`,`p`.`id_number` AS `id_number`,`up`.`firstname` AS `firstname`,`up`.`lastname` AS `lastname`,`up`.`company_id` AS `company_id`,`up`.`company` AS `company`,`up`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`tr`.`date` AS `date`,if((`tr`.`aux_shift_id` = 0),`tr`.`shift`,`tr`.`aux_shift`) AS `shift`,ifnull(`tr`.`time_in`,`tr`.`aux_time_in`) AS `time_in`,ifnull(`tr`.`time_out`,`tr`.`aux_time_out`) AS `time_out`,`trs`.`hrs_rendered` AS `hours_work`,`trs`.`late` AS `late`,`trs`.`undertime` AS `ut`,`trs`.`ot` AS `ot`,'' AS `remarks` from ((((`ww_time_record` `tr` join `ww_time_record_summary` `trs` on(((`trs`.`user_id` = `tr`.`user_id`) and (`trs`.`date` = `tr`.`date`)))) left join `ww_users_profile` `up` on((`up`.`user_id` = `tr`.`user_id`))) left join `ww_partners` `p` on((`p`.`user_id` = `up`.`user_id`))) left join `ww_users_department` `ud` on((`ud`.`department_id` = `up`.`department_id`))) where (`trs`.`resigned` = 0)) */;

/*View structure for view report_time_iar */

/*!50001 DROP TABLE IF EXISTS `report_time_iar` */;
/*!50001 DROP VIEW IF EXISTS `report_time_iar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report_time_iar` AS (select `tp`.`payroll_date` AS `payroll_date`,`up`.`company_id` AS `company_id`,`up`.`company` AS `company`,`u`.`user_id` AS `user_id`,`u`.`full_name` AS `full_name`,`p`.`id_number` AS `id_number`,`tr`.`date` AS `date`,if((`tr`.`aux_shift_id` = 0),`tr`.`shift`,`tr`.`aux_shift`) AS `shift`,ifnull(`tr`.`time_in`,`tr`.`aux_time_in`) AS `time_from`,ifnull(`tr`.`time_out`,`tr`.`aux_time_out`) AS `time_to`,`tr`.`aux_time_in` AS `aux_time_from`,`tr`.`aux_time_out` AS `aux_time_to`,concat_ws(', ',if((`trs`.`awol` > 0),'AWOL',NULL),if((`trs`.`absent` > 0),'ABSENT',NULL),if((`trs`.`lwop` > 0),'LWOP',NULL),if((`trs`.`late` > 0),'LATE',NULL),if((`trs`.`undertime` > 0),'UNDERTIME',NULL)) AS `particulars`,concat(if((`trs`.`awol` > 0),'8',''),if((`trs`.`absent` > 0),'8',''),if((`trs`.`lwop` > 0),'8',''),if((`trs`.`late` > 0),`trs`.`late`,''),if((`trs`.`undertime` > 0),`trs`.`undertime`,'')) AS `Deduction` from (((((`ww_time_period` `tp` join `time_record` `tr` on((`tr`.`date` between `tp`.`date_from` and `tp`.`date_to`))) join `time_record_summary` `trs` on(((`trs`.`date` = `tr`.`date`) and (`trs`.`user_id` = `tr`.`user_id`)))) join `users` `u` on((`u`.`user_id` = `tr`.`user_id`))) join `users_profile` `up` on(((`up`.`user_id` = `u`.`user_id`) and (`up`.`company_id` = `tp`.`company_id`)))) join `partners` `p` on((`p`.`user_id` = `u`.`user_id`))) where ((`tp`.`deleted` = 0) and ((`trs`.`absent` > 0) or (`trs`.`awol` > 0) or (`trs`.`lwop` > 0) or (`trs`.`late` > 0) or (`trs`.`undertime` > 0)) and if((ifnull(`p`.`resigned_date`,'0000-00-00') = '0000-00-00'),1,(`tr`.`date` <= `p`.`resigned_date`))) order by `tp`.`payroll_date`,`u`.`full_name`,`tr`.`date`) */;

/*View structure for view report_time_overtime */

/*!50001 DROP TABLE IF EXISTS `report_time_overtime` */;
/*!50001 DROP VIEW IF EXISTS `report_time_overtime` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report_time_overtime` AS (select `up`.`company_id` AS `company_id`,`trp`.`payroll_date` AS `payroll_date`,`tp`.`date_from` AS `time_period_date_from`,`tp`.`date_to` AS `time_period_date_to`,`up`.`company` AS `company`,`p`.`id_number` AS `id_number`,`u`.`full_name` AS `full_name`,`get_total_hours`(`trp`.`user_id`,`trp`.`payroll_date`) AS `HOURS`,round(sum(if((`trp`.`transaction_code` = 'ABSENCES'),`trp`.`quantity`,0)),2) AS `ABSENCES`,round(sum(if((`trp`.`transaction_code` in ('REGOT','REGOT_ADJ')),`trp`.`quantity`,0)),2) AS `REGOT`,round(sum(if((`trp`.`transaction_code` in ('REGOT_ND','REGOT_ND_ADJ')),`trp`.`quantity`,0)),2) AS `REGOT_ND`,round(sum(if((`trp`.`transaction_code` in ('REGND','REGND_ADJ')),`trp`.`quantity`,0)),2) AS `REGND`,round(sum(if((`trp`.`transaction_code` in ('RDOT','RDOT_ADJ')),`trp`.`quantity`,0)),2) AS `RDOT`,round(sum(if((`trp`.`transaction_code` in ('RDOT_ND','RDOT_ND_ADJ')),`trp`.`quantity`,0)),2) AS `RDOT_ND`,round(sum(if((`trp`.`transaction_code` in ('RDOT_EXCESS','RDOT_EXCESS_ADJ')),`trp`.`quantity`,0)),2) AS `RDOT_EXCESS`,round(sum(if((`trp`.`transaction_code` in ('RDOT_ND_EXCESS','RDOT_ND_EXCESS_ADJ')),`trp`.`quantity`,0)),2) AS `RDOT_ND_EXCESS`,round(sum(if((`trp`.`transaction_code` in ('LEGOT','LEGOT_ADJ')),`trp`.`quantity`,0)),2) AS `LEGOT`,round(sum(if((`trp`.`transaction_code` in ('LEGOT_ND','LEGOT_ND_ADJ')),`trp`.`quantity`,0)),2) AS `LEGOT_ND`,round(sum(if((`trp`.`transaction_code` in ('LEGOT_EXCESS','LEGOT_EXCESS_ADJ')),`trp`.`quantity`,0)),2) AS `LEGOT_EXCESS`,round(sum(if((`trp`.`transaction_code` in ('LEGOT_ND_EXCESS','LEGOT_ND_EXCESS_ADJ')),`trp`.`quantity`,0)),2) AS `LEGOT_ND_EXCESS`,round(sum(if((`trp`.`transaction_code` in ('SPEOT','SPEOT_ADJ')),`trp`.`quantity`,0)),2) AS `SPEOT`,round(sum(if((`trp`.`transaction_code` in ('SPEOT_ND','SPEOT_ND_ADJ')),`trp`.`quantity`,0)),2) AS `SPEOT_ND`,round(sum(if((`trp`.`transaction_code` in ('SPEOT_EXCESS','SPEOT_EXCESS_ADJ')),`trp`.`quantity`,0)),2) AS `SPEOT_EXCESS`,round(sum(if((`trp`.`transaction_code` in ('SPEOT_ND_EXCESS','SPEOT_ND_EXCESS_ADJ')),`trp`.`quantity`,0)),2) AS `SPEOT_ND_EXCESS`,round(sum(if((`trp`.`transaction_code` in ('DOBOT','DOBOT_ADJ')),`trp`.`quantity`,0)),2) AS `DOBOT`,round(sum(if((`trp`.`transaction_code` in ('DOBOT_ND','DOBOT_ND_ADJ')),`trp`.`quantity`,0)),2) AS `DOBOT_ND`,round(sum(if((`trp`.`transaction_code` in ('DOBOT_EXCESS','DOBOT_EXCESS_ADJ')),`trp`.`quantity`,0)),2) AS `DOBOT_EXCESS`,round(sum(if((`trp`.`transaction_code` in ('DOBOT_ND_EXCESS','DOBOT_ND_EXCESS_ADJ')),`trp`.`quantity`,0)),2) AS `DOBOT_ND_EXCESS`,round(sum(if((`trp`.`transaction_code` in ('LEGRDOT','LEGRDOT_ADJ')),`trp`.`quantity`,0)),2) AS `LEGRDOT`,round(sum(if((`trp`.`transaction_code` in ('LEGRDOT_ND','LEGRDOT_ND_ADJ')),`trp`.`quantity`,0)),2) AS `LEGRDOT_ND`,round(sum(if((`trp`.`transaction_code` in ('LEGRDOT_EXCESS','LEGRDOT_EXCESS_ADJ')),`trp`.`quantity`,0)),2) AS `LEGRDOT_EXCESS`,round(sum(if((`trp`.`transaction_code` in ('LEGRDOT_ND_EXCESS','LEGRDOT_ND_EXCESS_ADJ')),`trp`.`quantity`,0)),2) AS `LEGRDOT_ND_EXCESS`,round(sum(if((`trp`.`transaction_code` in ('SPERDOT','SPERDOT_ADJ')),`trp`.`quantity`,0)),2) AS `SPERDOT`,round(sum(if((`trp`.`transaction_code` in ('SPERDOT_ND','SPERDOT_ND_ADJ')),`trp`.`quantity`,0)),2) AS `SPERDOT_ND`,round(sum(if((`trp`.`transaction_code` in ('SPERDOT_EXCESS','SPERDOT_EXCESS_ADJ')),`trp`.`quantity`,0)),2) AS `SPERDOT_EXCESS`,round(sum(if((`trp`.`transaction_code` in ('SPERDOT_ND_EXCESS','SPERDOT_ND_EXCESS_ADJ')),`trp`.`quantity`,0)),2) AS `SPERDOT_ND_EXCESS`,round(sum(if((`trp`.`transaction_code` in ('DOBRDOT','DOBRDOT_ADJ')),`trp`.`quantity`,0)),2) AS `DOBRDOT`,round(sum(if((`trp`.`transaction_code` in ('DOBRDOT_ND','DOBRDOT_ND_ADJ')),`trp`.`quantity`,0)),2) AS `DOBRDOT_ND`,round(sum(if((`trp`.`transaction_code` in ('DOBRDOT_EXCESS','DOBRDOT_EXCESS_ADJ')),`trp`.`quantity`,0)),2) AS `DOBRDOT_EXCESS`,round(sum(if((`trp`.`transaction_code` in ('DOBRDOT_ND_EXCESS','DOBRDOT_ND_EXCESS_ADJ')),`trp`.`quantity`,0)),2) AS `DOBRDOT_ND_EXCESS` from (((((((`ww_time_record_process` `trp` join `ww_time_forms_date` `tfd` on(((`tfd`.`date` = `trp`.`date`) and (`trp`.`deleted` = 0)))) join `ww_time_period` `tp` on((`trp`.`time_period_id` = `tp`.`period_id`))) join `ww_time_forms` `tf` on(((`tf`.`forms_id` = `tfd`.`forms_id`) and (`tf`.`form_code` = 'OT') and (`tf`.`form_status_id` = 6) and (`tf`.`deleted` = 0) and (`tf`.`user_id` = `trp`.`user_id`)))) left join `ww_time_record_summary` `trs` on(((`trs`.`date` = `tfd`.`date`) and (`trs`.`user_id` = `trp`.`user_id`)))) join `ww_users` `u` on((`u`.`user_id` = `trp`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `u`.`user_id`))) join `ww_partners` `p` on((`p`.`user_id` = `u`.`user_id`))) where (`trp`.`deleted` = 0) group by `trp`.`payroll_date`,`up`.`company_id`,`u`.`user_id` order by `trp`.`payroll_date`,`u`.`full_name`) */;

/*View structure for view report_time_perfect_attendance */

/*!50001 DROP TABLE IF EXISTS `report_time_perfect_attendance` */;
/*!50001 DROP VIEW IF EXISTS `report_time_perfect_attendance` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report_time_perfect_attendance` AS (select `p`.`id_number` AS `id_number`,`up`.`lastname` AS `lastname`,`up`.`firstname` AS `firstname`,year(`trs`.`date`) AS `year`,month(`trs`.`date`) AS `month_id`,`m`.`month` AS `month`,`up`.`company_id` AS `company_id`,`up`.`company` AS `company`,`ud`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`trs`.`lip_approved_below_13_days` AS `sum_lwp_forms` from (((((((`ww_users` `u` join `ww_partners` `p` on((`u`.`user_id` = `p`.`user_id`))) join `ww_payroll_partners` `pp` on((`u`.`user_id` = `pp`.`user_id`))) join `ww_users_profile` `up` on((`p`.`user_id` = `up`.`user_id`))) join `ww_time_record_summary` `trs` on((`u`.`user_id` = `trs`.`user_id`))) join `ww_users_department` `ud` on((`up`.`department_id` = `ud`.`department_id`))) left join `ww_users_branch` `b` on((`b`.`branch_id` = `up`.`branch_id`))) join `ww_month` `m` on((month(`trs`.`date`) = `m`.`month_id`))) where ((`trs`.`day_type` <> 'RESTDAY') and (`u`.`active` = 1) and (`pp`.`attendance_base` = 1) and (`p`.`status_id` in (1,2)) and (`p`.`employment_type_id` in (5,6))) group by `u`.`user_id`,year(`trs`.`date`),month(`trs`.`date`) having ((sum(`trs`.`lwop`) = 0) and (`trs`.`lip_approved_below_13_days` = 0) and (sum(`trs`.`late`) = 0) and (sum(`trs`.`undertime`) = 0) and (sum(`trs`.`absent`) = 0)) order by `up`.`company`,`ud`.`department`,`up`.`lastname`,`up`.`firstname`) */;

/*View structure for view report_time_tardiness */

/*!50001 DROP TABLE IF EXISTS `report_time_tardiness` */;
/*!50001 DROP VIEW IF EXISTS `report_time_tardiness` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report_time_tardiness` AS (select `tp`.`payroll_date` AS `payroll_date`,`up`.`company_id` AS `company_id`,`up`.`company` AS `company`,`ud`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`up`.`branch_id` AS `branch_id`,`b`.`branch` AS `branch`,`u`.`full_name` AS `full_name`,`p`.`id_number` AS `id_number`,`tr`.`date` AS `date`,if(((`tr`.`aux_shift` is not null) and (`tr`.`aux_shift` <> '')),`tr`.`aux_shift`,`tr`.`shift`) AS `shift`,ifnull(`tr`.`time_in`,`tr`.`aux_time_in`) AS `time_from`,ifnull(`tr`.`time_out`,`tr`.`aux_time_out`) AS `time_to`,`tr`.`aux_shift` AS `aux_shift`,`tr`.`aux_time_in` AS `aux_time_from`,`tr`.`aux_time_out` AS `aux_time_to`,round((`trs`.`late` * 60),0) AS `late`,`trs`.`undertime` AS `undertime`,year(`trs`.`date`) AS `year`,month(`tr`.`date`) AS `month` from (((((((`ww_time_period` `tp` join `time_record` `tr` on((`tr`.`date` between `tp`.`date_from` and `tp`.`date_to`))) join `time_record_summary` `trs` on(((`trs`.`date` = `tr`.`date`) and (`trs`.`user_id` = `tr`.`user_id`)))) join `users` `u` on((`u`.`user_id` = `tr`.`user_id`))) join `users_profile` `up` on(((`up`.`user_id` = `u`.`user_id`) and (`up`.`company_id` = `tp`.`company_id`)))) left join `ww_users_branch` `b` on((`b`.`branch_id` = `up`.`branch_id`))) join `ww_users_department` `ud` on((`up`.`department_id` = `ud`.`department_id`))) join `partners` `p` on((`p`.`user_id` = `u`.`user_id`))) where ((`tp`.`deleted` = 0) and (`trs`.`late` > 0)) group by `p`.`id_number`,`tr`.`date` order by `tp`.`payroll_date`,`u`.`full_name`,`tr`.`date`) */;

/*View structure for view tfb_accrual_final */

/*!50001 DROP TABLE IF EXISTS `tfb_accrual_final` */;
/*!50001 DROP VIEW IF EXISTS `tfb_accrual_final` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tfb_accrual_final` AS select `tfba`.`user_id` AS `user_id`,`u`.`full_name` AS `full_name`,`tfba`.`leave_balance_id` AS `leave_balance_id`,`tfba`.`date_accrued` AS `date`,`tfba`.`accrual` AS `accrual`,0 AS `usage`,`tfba`.`form_code` AS `form_code`,`tfo`.`form_id` AS `form_id`,`tfo`.`form` AS `form`,`up`.`company_id` AS `company_id`,`up`.`department_id` AS `department_id` from (((`ww_time_form_balance_accrual` `tfba` join `ww_users` `u` on((`u`.`user_id` = `tfba`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `u`.`user_id`))) join `ww_time_form` `tfo` on((`tfo`.`form_code` = `tfba`.`form_code`))) union all select `tf`.`user_id` AS `user_id`,`u`.`full_name` AS `full_name`,`tfba`.`leave_balance_id` AS `leave_balance_id`,`tfd`.`date` AS `date`,'-' AS `-`,`tfd`.`day` AS `day`,`tf`.`form_code` AS `form_code`,`tfo`.`form_id` AS `form_id`,`tfo`.`form` AS `form`,`up`.`company_id` AS `company_id`,`up`.`department_id` AS `department_id` from (((((`ww_time_forms` `tf` join `ww_time_forms_date` `tfd` on((`tf`.`forms_id` = `tfd`.`forms_id`))) join `ww_time_form_balance_accrual` `tfba` on((`tf`.`user_id` = `tfba`.`user_id`))) join `ww_users` `u` on((`u`.`user_id` = `tfba`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `u`.`user_id`))) join `ww_time_form` `tfo` on((`tfo`.`form_code` = `tf`.`form_code`))) where ((`tf`.`display_name` <> 'Blanket') and (`tf`.`form_code` in ('SL','VL')) and (`tf`.`form_status_id` = 6)) group by `tfd`.`date` union all select `tf`.`user_id` AS `user_id`,`u`.`full_name` AS `full_name`,`tfd`.`leave_balance_id` AS `leave_balance_id`,`tfd`.`date` AS `date`,0 AS `accrual`,`tfd`.`day` AS `usage`,`tf`.`form_code` AS `form_code`,`tfo`.`form_id` AS `form_id`,`tfo`.`form` AS `form`,`up`.`company_id` AS `company_id`,`up`.`department_id` AS `department_id` from ((((((`ww_time_form_balance_accrual` `tfba` left join `ww_time_forms` `tf` on((`tf`.`user_id` = `tfba`.`user_id`))) left join `ww_time_forms_date` `tfd` on((`tf`.`forms_id` = `tfd`.`forms_id`))) left join `ww_time_forms_blanket` `tfb` on((`tf`.`forms_id` = `tfb`.`forms_id`))) join `ww_users` `u` on((`tf`.`user_id` = `u`.`user_id`))) join `ww_users_profile` `up` on((`u`.`user_id` = `up`.`user_id`))) join `ww_time_form` `tfo` on((`tf`.`form_id` = `tfo`.`form_id`))) where ((`tf`.`form_code` = 'EL') and (`tf`.`form_status_id` = 6) and (`tf`.`deleted` = 0) and (`tfb`.`deleted` = 0)) union all select `tf`.`user_id` AS `user_id`,`u`.`full_name` AS `full_name`,`tfd`.`leave_balance_id` AS `leave_balance_id`,`tfd`.`date` AS `date`,`tfd`.`day` AS `day`,0 AS `usage`,`tf`.`form_code` AS `form_code`,`tfo`.`form_id` AS `form_id`,`tfo`.`form` AS `form`,`up`.`company_id` AS `company_id`,`up`.`department_id` AS `department_id` from ((((((`ww_time_forms` `tf` left join `ww_time_forms_date` `tfd` on((`tfd`.`forms_id` = `tf`.`forms_id`))) left join `ww_time_forms_ot_leave` `tfol` on((`tfol`.`forms_id` = `tfd`.`forms_id`))) join `ww_time_form_balance_accrual` `tfba` on((`tfba`.`user_id` = `tf`.`user_id`))) join `ww_users` `u` on((`u`.`user_id` = `tfba`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `u`.`user_id`))) join `ww_time_form` `tfo` on((`tf`.`form_code` = `tfo`.`form_code`))) where ((`tf`.`form_code` = 'ADDL') and (`tf`.`type` = 'FILE')) group by `tfd`.`date` union all select `tf`.`user_id` AS `user_id`,`u`.`full_name` AS `full_name`,`tfd`.`leave_balance_id` AS `leave_balance_id`,`tfd`.`date` AS `date`,0 AS `accrual`,`tfd`.`day` AS `usage`,`tf`.`form_code` AS `form_code`,`tfo`.`form_id` AS `form_id`,`tfo`.`form` AS `form`,`up`.`company_id` AS `company_id`,`up`.`department_id` AS `department_id` from ((((((`ww_time_forms` `tf` left join `ww_time_forms_date` `tfd` on((`tfd`.`forms_id` = `tf`.`forms_id`))) left join `ww_time_forms_ot_leave_used` `tfol` on((`tfol`.`forms_id` = `tfd`.`forms_id`))) join `ww_time_form_balance_accrual` `tfba` on((`tfba`.`user_id` = `tf`.`user_id`))) join `ww_users` `u` on((`u`.`user_id` = `tfba`.`user_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `u`.`user_id`))) join `ww_time_form` `tfo` on((`tf`.`form_code` = `tfo`.`form_code`))) where ((`tf`.`form_code` = 'ADDL') and (`tf`.`type` = 'USE') and (`tf`.`form_status_id` = 6)) group by `tfd`.`date` */;

/*View structure for view time_form_balance */

/*!50001 DROP TABLE IF EXISTS `time_form_balance` */;
/*!50001 DROP VIEW IF EXISTS `time_form_balance` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_form_balance` AS (select `ww_time_form_balance`.`id` AS `id`,`ww_time_form_balance`.`year` AS `year`,`ww_time_form_balance`.`user_id` AS `user_id`,`ww_time_form_balance`.`form_id` AS `form_id`,`ww_time_form_balance`.`form_code` AS `form_code`,`ww_time_form_balance`.`previous` AS `previous`,`ww_time_form_balance`.`current` AS `current`,`ww_time_form_balance`.`used` AS `used`,`ww_time_form_balance`.`used_insert` AS `used_insert`,`ww_time_form_balance`.`balance` AS `balance`,`ww_time_form_balance`.`paid_unit` AS `paid_unit`,`ww_time_form_balance`.`period_from` AS `period_from`,`ww_time_form_balance`.`period_to` AS `period_to`,`ww_time_form_balance`.`period_extension` AS `period_extension`,`ww_time_form_balance`.`created_on` AS `created_on`,`ww_time_form_balance`.`created_by` AS `created_by`,`ww_time_form_balance`.`modified_on` AS `modified_on`,`ww_time_form_balance`.`modified_by` AS `modified_by`,`ww_time_form_balance`.`deleted` AS `deleted`,`ww_partners`.`id_number` AS `employee_number`,`ww_partners`.`alias` AS `partner`,`ww_users_company`.`company_id` AS `company_id`,`ww_users_company`.`company` AS `company`,`ww_users_department`.`department_id` AS `department_id`,`ww_users_department`.`department` AS `department`,`ww_time_form`.`form` AS `form` from (((((`ww_time_form_balance` join `ww_users_profile` on((`ww_users_profile`.`user_id` = `ww_time_form_balance`.`user_id`))) join `ww_partners` on((`ww_partners`.`user_id` = `ww_time_form_balance`.`user_id`))) join `ww_time_form` on((`ww_time_form`.`form_id` = `ww_time_form_balance`.`form_id`))) join `ww_users_company` on((`ww_users_company`.`company_id` = `ww_users_profile`.`company_id`))) join `ww_users_department` on((`ww_users_department`.`department_id` = `ww_users_profile`.`department_id`))) where (`ww_time_form_balance`.`deleted` = 0)) */;

/*View structure for view time_form_code */

/*!50001 DROP TABLE IF EXISTS `time_form_code` */;
/*!50001 DROP VIEW IF EXISTS `time_form_code` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_form_code` AS (select `tr`.`date` AS `date`,`tf`.`form_code` AS `form_code`,`tr`.`user_id` AS `user_id` from ((`ww_time_record` `tr` join `ww_time_forms` `tf` on((`tr`.`user_id` = `tf`.`user_id`))) join `ww_time_forms_date` `tfd` on(((`tf`.`forms_id` = `tfd`.`forms_id`) and (`tr`.`date` = `tfd`.`date`))))) */;

/*View structure for view time_form_code_with_blanket */

/*!50001 DROP TABLE IF EXISTS `time_form_code_with_blanket` */;
/*!50001 DROP VIEW IF EXISTS `time_form_code_with_blanket` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_form_code_with_blanket` AS select `tr`.`date` AS `date`,`tf`.`form_code` AS `form_code`,`tr`.`user_id` AS `user_id` from ((`ww_time_record` `tr` join `ww_time_forms` `tf` on((`tr`.`user_id` = `tf`.`user_id`))) join `ww_time_forms_date` `tfd` on(((`tf`.`forms_id` = `tfd`.`forms_id`) and (`tr`.`date` = `tfd`.`date`)))) union select `tfd`.`date` AS `date`,`tf`.`form_code` AS `form_code`,`tfb`.`user_id` AS `user_id` from ((`ww_time_forms_blanket` `tfb` join `ww_time_forms_date` `tfd` on((`tfd`.`forms_id` = `tfb`.`forms_id`))) join `ww_time_forms` `tf` on((`tf`.`user_id` = `tfb`.`user_id`))) */;

/*View structure for view time_forms */

/*!50001 DROP TABLE IF EXISTS `time_forms` */;
/*!50001 DROP VIEW IF EXISTS `time_forms` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_forms` AS (select `ww_time_forms`.`forms_id` AS `forms_id`,`ww_time_forms`.`form_status_id` AS `form_status_id`,`ww_time_forms`.`form_id` AS `form_id`,`ww_time_forms`.`form_code` AS `form_code`,`ww_time_forms`.`user_id` AS `user_id`,`ww_time_forms`.`display_name` AS `display_name`,`ww_time_forms`.`day` AS `day`,`ww_time_forms`.`hrs` AS `hrs`,`ww_time_forms`.`date_from` AS `date_from`,`ww_time_forms`.`date_to` AS `date_to`,`ww_time_forms`.`date_approved` AS `date_approved`,`ww_time_forms`.`date_declined` AS `date_declined`,`ww_time_forms`.`date_cancelled` AS `date_cancelled`,`ww_time_forms`.`date_sent` AS `date_sent`,`ww_time_forms`.`reason` AS `reason`,`ww_time_forms`.`scheduled` AS `scheduled`,`ww_time_forms`.`type` AS `type`,`ww_time_forms`.`created_on` AS `created_on`,`ww_time_forms`.`created_by` AS `created_by`,`ww_time_forms`.`modified_on` AS `modified_on`,`ww_time_forms`.`modified_by` AS `modified_by`,`ww_time_forms`.`deleted` AS `deleted`,`up`.`company_id` AS `company_id`,`ww_time_forms`.`focus_date` AS `focus_date` from (`ww_time_forms` join `ww_users_profile` `up` on((`up`.`user_id` = `ww_time_forms`.`user_id`))) where (`ww_time_forms`.`deleted` = 0)) */;

/*View structure for view time_forms_admin */

/*!50001 DROP TABLE IF EXISTS `time_forms_admin` */;
/*!50001 DROP VIEW IF EXISTS `time_forms_admin` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_forms_admin` AS (select `tf`.`forms_id` AS `forms_id`,`tf`.`form_status_id` AS `form_status_id`,`status`.`form_status` AS `form_status`,`tf`.`form_id` AS `form_id`,`tf`.`form_code` AS `form_code`,`form`.`form` AS `form`,`tf`.`reason` AS `reason`,`tf`.`user_id` AS `user_id`,`tf`.`display_name` AS `display_name`,`tf`.`day` AS `day`,`tf`.`hrs` AS `hrs`,concat(date_format(`tf`.`date_from`,'%b-%e %a'),if((`tf`.`date_from` = `tf`.`date_to`),'',concat(' To ',date_format(`tf`.`date_to`,'%b-%e %a')))) AS `date_range`,`tf`.`date_from` AS `date_from`,`tf`.`date_to` AS `date_to`,`gettimeline`(`tf`.`created_on`) AS `createdon`,`tf`.`created_on` AS `created_on`,if((`tf`.`user_id` = 0),`tf`.`form_status_id`,`approver`.`form_status_id`) AS `approver_status_id`,if((`tf`.`user_id` = 0),`status`.`form_status`,`approver_status`.`form_status`) AS `approver_status`,`approver`.`user_id` AS `approver_id`,`approver`.`display_name` AS `approver_name`,`tf`.`deleted` AS `deleted`,`tf`.`type` AS `type`,`tf`.`focus_date` AS `focus_date` from ((((`time_forms` `tf` left join `ww_time_forms_approver` `approver` on((`approver`.`forms_id` = `tf`.`forms_id`))) join `ww_time_form_status` `status` on((`status`.`form_status_id` = `tf`.`form_status_id`))) join `ww_time_form` `form` on((`form`.`form_id` = `tf`.`form_id`))) left join `ww_time_form_status` `approver_status` on((`approver_status`.`form_status_id` = `approver`.`form_status_id`))) where ((`tf`.`form_status_id` > 1) and (`tf`.`deleted` = 0)) group by `tf`.`forms_id`) */;

/*View structure for view time_forms_blanket */

/*!50001 DROP TABLE IF EXISTS `time_forms_blanket` */;
/*!50001 DROP VIEW IF EXISTS `time_forms_blanket` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_forms_blanket` AS (select `tf`.`forms_id` AS `forms_id`,`tf`.`form_code` AS `form_code`,`tf`.`form_status_id` AS `form_status_id`,`tf`.`form_id` AS `form_id`,`tf`.`display_name` AS `display_name`,`tfd`.`date` AS `date`,`tf`.`date_from` AS `date_from`,`tf`.`date_to` AS `date_to`,date_format(`tf`.`date_from`,'%M %d, %Y') AS `date_start`,date_format(`tf`.`date_to`,'%M %d, %Y') AS `date_end`,date_format(`tfd`.`time_from`,'%M %d, %Y %T') AS `date_time_start`,date_format(`tfd`.`time_to`,'%M %d, %Y %T') AS `date_time_end`,`tfb`.`user_id` AS `user_id`,`tfm`.`form` AS `form_name`,(case when ((`tf`.`form_id` = 1) or (`tf`.`form_id` = 2) or (`tf`.`form_id` = 3) or (`tf`.`form_id` = 4) or (`tf`.`form_id` = 5) or (`tf`.`form_id` = 6) or (`tf`.`form_id` = 7) or (`tf`.`form_id` = 8) or (`tf`.`form_id` = 9) or (`tf`.`form_id` = 14) or (`tf`.`form_id` = 16) or (`tf`.`form_id` = 19) or (`tf`.`form_id` = 20)) then if(isnull(`td`.`duration`),`tfd`.`hrs`,`td`.`duration`) when ((`tf`.`form_id` = 10) or (`tf`.`form_id` = 11) or (`tf`.`form_id` = 15)) then date_format(`tfd`.`time_from`,'%H:%i %p') when (`tf`.`form_id` = 12) then `ts`.`shift` end) AS `detail`,`tf`.`reason` AS `reason`,concat(`tfm`.`form`,' ',`tf`.`display_name`) AS `blanket_name` from (((((`ww_time_forms` `tf` join `ww_time_forms_blanket` `tfb` on((`tf`.`forms_id` = `tfb`.`forms_id`))) join `ww_time_form` `tfm` on((`tf`.`form_id` = `tfm`.`form_id`))) join `ww_time_forms_date` `tfd` on((`tf`.`forms_id` = `tfd`.`forms_id`))) left join `ww_time_shift` `ts` on((`ts`.`shift_id` = `tfd`.`shift_to`))) left join `ww_time_duration` `td` on((`tfd`.`duration_id` = `td`.`duration_id`))) where ((lcase(`tf`.`display_name`) = 'blanket') and (`tf`.`deleted` = 0) and (`tfb`.`deleted` = 0)) group by `tf`.`date_from`,`tf`.`date_to`,`tfb`.`user_id`,`tf`.`form_id`) */;

/*View structure for view time_forms_date */

/*!50001 DROP TABLE IF EXISTS `time_forms_date` */;
/*!50001 DROP VIEW IF EXISTS `time_forms_date` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_forms_date` AS (select `tfd`.`id` AS `id`,`tfd`.`forms_id` AS `forms_id`,`tfd`.`date` AS `date`,`tfd`.`day` AS `day`,`tfd`.`hrs` AS `hrs`,`tfd`.`duration_id` AS `duration_id`,`tfd`.`time_from` AS `time_from`,`tfd`.`time_to` AS `time_to`,`tfd`.`shift_id` AS `shift_id`,`tfd`.`shift_to` AS `shift_to`,`tfd`.`credit` AS `credit`,`tfd`.`credit_back` AS `credit_back`,`tfd`.`approved_comment` AS `approved_comment`,`tfd`.`declined_comment` AS `declined_comment`,`tfd`.`cancelled_comment` AS `cancelled_comment`,`tfd`.`deleted` AS `deleted` from (`ww_time_forms_date` `tfd` join `ww_time_forms` `tf`) where ((`tfd`.`forms_id` = `tf`.`forms_id`) and (`tfd`.`deleted` = 0) and (`tf`.`deleted` = 0))) */;

/*View structure for view time_forms_leave_monitoring */

/*!50001 DROP TABLE IF EXISTS `time_forms_leave_monitoring` */;
/*!50001 DROP VIEW IF EXISTS `time_forms_leave_monitoring` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_forms_leave_monitoring` AS (select `u`.`full_name` AS `full_name`,`u`.`user_id` AS `user_id`,`upos`.`position` AS `position`,`up`.`company_id` AS `company_id`,`up`.`company` AS `company`,`up`.`project_id` AS `project_id`,`uproj`.`project` AS `project`,`up`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`p`.`effectivity_date` AS `effectivity_date`,`p`.`regularization_date` AS `date_hired`,`up`.`end_date` AS `end_date`,`p`.`id_number` AS `id_number`,`tfb`.`form_code` AS `form_code`,`tfb`.`form_id` AS `form_id`,`tfb`.`year` AS `year`,`tfd`.`date` AS `date_used`,`tfd`.`credit` AS `credit`,`tfd`.`day` AS `day`,`tfb`.`current` AS `current`,`tf`.`reason` AS `reason`,(`tfb`.`current` - `tfd`.`day`) AS `running_balance`,((`tfb`.`current` - `tfd`.`day`) - `tfd`.`day`) AS `total_bal` from ((((((((`ww_users` `u` left join `ww_users_profile` `up` on((`u`.`user_id` = `up`.`user_id`))) left join `ww_users_position` `upos` on((`up`.`position_id` = `upos`.`position_id`))) left join `ww_partners` `p` on((`p`.`user_id` = `u`.`user_id`))) left join `ww_users_department` `ud` on((`ud`.`department_id` = `up`.`department_id`))) left join `ww_users_project` `uproj` on((`uproj`.`project_id` = `up`.`project_id`))) left join `ww_time_form_balance` `tfb` on((`u`.`user_id` = `tfb`.`user_id`))) left join `ww_time_forms_date` `tfd` on((`tfd`.`leave_balance_id` = `tfb`.`id`))) left join `ww_time_forms` `tf` on((`tf`.`forms_id` = `tfd`.`forms_id`))) where ((`u`.`active` = 1) and (`tfb`.`form_code` in ('VL','SL','SIL')) and (`tf`.`form_status_id` = 6)) group by `tfb`.`user_id`,`tfb`.`form_code`,`tfb`.`year`,`tfd`.`date` order by `u`.`full_name`,`tfb`.`year`,`tfb`.`form_code`,`tfd`.`date`) */;

/*View structure for view time_forms_leave_type_filter */

/*!50001 DROP TABLE IF EXISTS `time_forms_leave_type_filter` */;
/*!50001 DROP VIEW IF EXISTS `time_forms_leave_type_filter` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_forms_leave_type_filter` AS (select `ww_time_form`.`form_id` AS `form_id`,`ww_time_form`.`form_code` AS `form_code`,`ww_time_form`.`form` AS `form` from `ww_time_form` where ((`ww_time_form`.`form_code` in ('SL','VL','SIL')) and (`ww_time_form`.`deleted` = 0))) */;

/*View structure for view time_forms_logs_monitoring */

/*!50001 DROP TABLE IF EXISTS `time_forms_logs_monitoring` */;
/*!50001 DROP VIEW IF EXISTS `time_forms_logs_monitoring` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_forms_logs_monitoring` AS (select `s`.`date` AS `date`,if((`t`.`aux_shift_id` = 0),`t`.`shift`,`t`.`aux_shift`) AS `shift`,time_format(ifnull(cast(ifnull(`t`.`time_in`,`t`.`aux_time_in`) as time),0),'%h:%i %p') AS `time_in`,time_format(ifnull(cast(ifnull(`t`.`time_out`,`t`.`aux_time_out`) as time),0),'%h:%i %p') AS `time_out`,`s`.`hrs_actual` AS `hrs_work`,(`s`.`ot` - `s`.`ot_break`) AS `total_ot`,ifnull(`s`.`late`,0) AS `late`,`s`.`absent` AS `absent`,ifnull(`tf`.`form_code`,0) AS `form_code`,ifnull(`tff`.`is_leave`,0) AS `is_leave`,`u`.`company_id` AS `company_id`,`u`.`company` AS `company`,`d`.`department_id` AS `department_id`,`d`.`department` AS `department`,`pa`.`alias` AS `full_name`,`pa`.`id_number` AS `employee_code`,`u`.`user_id` AS `user_id`,`u`.`project_id` AS `project_id`,`uproj`.`project` AS `project`,`pp`.`payroll_rate_type_id` AS `payroll_rate_type_id`,`prt`.`payroll_rate_type` AS `payroll_rate_type`,`s`.`payroll_date` AS `payroll_date`,`tp`.`date_from` AS `payroll_date_from`,`tp`.`date_to` AS `payroll_date_to` from (((((((((((`ww_time_record` `t` left join `ww_time_record_summary` `s` on((`s`.`record_id` = `t`.`record_id`))) left join `night_differential` `p` on((`p`.`DATE` = `s`.`date`))) join `ww_users_profile` `u` on((`u`.`user_id` = `t`.`user_id`))) join `ww_partners` `pa` on((`pa`.`user_id` = `u`.`user_id`))) join `ww_users_department` `d` on((`d`.`department_id` = `u`.`department_id`))) left join `time_form_code_with_blanket` `tf` on(((`tf`.`date` = `s`.`date`) and (`tf`.`user_id` = `s`.`user_id`)))) left join `ww_time_form` `tff` on((`tff`.`form_code` = `tf`.`form_code`))) left join `ww_users_project` `uproj` on((`uproj`.`project_id` = `u`.`project_id`))) left join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `u`.`user_id`))) left join `ww_payroll_rate_type` `prt` on((`prt`.`payroll_rate_type_id` = `pp`.`payroll_rate_type_id`))) left join `ww_time_period` `tp` on(((`tp`.`payroll_date` = `s`.`payroll_date`) and (`tp`.`company_id` = `u`.`company_id`)))) order by `s`.`date`) */;

/*View structure for view time_forms_manage */

/*!50001 DROP TABLE IF EXISTS `time_forms_manage` */;
/*!50001 DROP VIEW IF EXISTS `time_forms_manage` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_forms_manage` AS (select `tf`.`forms_id` AS `forms_id`,`tf`.`form_status_id` AS `form_status_id`,`status`.`form_status` AS `form_status`,`tf`.`form_id` AS `form_id`,`tf`.`form_code` AS `form_code`,`form`.`form` AS `form`,`tf`.`reason` AS `reason`,`tf`.`user_id` AS `user_id`,`tf`.`display_name` AS `display_name`,`tf`.`day` AS `day`,`tf`.`hrs` AS `hrs`,concat(date_format(`tf`.`date_from`,'%b-%e %a'),if((`tf`.`date_from` = `tf`.`date_to`),'',concat(' To ',date_format(`tf`.`date_to`,'%b-%e %a')))) AS `date_range`,`tf`.`date_from` AS `date_from`,`tf`.`date_to` AS `date_to`,`gettimeline`(`tf`.`created_on`) AS `createdon`,`tf`.`created_on` AS `created_on`,`approver`.`form_status_id` AS `approver_status_id`,`approver_status`.`form_status` AS `approver_status`,`approver`.`user_id` AS `approver_id`,`approver`.`display_name` AS `approver_name`,`up`.`company_id` AS `company_id`,`tf`.`focus_date` AS `focus_date` from (((((`time_forms` `tf` join `ww_time_forms_approver` `approver` on((`approver`.`forms_id` = `tf`.`forms_id`))) join `ww_time_form_status` `status` on((`status`.`form_status_id` = `tf`.`form_status_id`))) join `ww_time_form` `form` on((`form`.`form_id` = `tf`.`form_id`))) join `ww_users_profile` `up` on((`up`.`user_id` = `tf`.`user_id`))) join `ww_time_form_status` `approver_status` on((`approver_status`.`form_status_id` = `approver`.`form_status_id`))) where ((`tf`.`form_status_id` > 1) and (`tf`.`deleted` = 0))) */;

/*View structure for view time_forms_sl_vl */

/*!50001 DROP TABLE IF EXISTS `time_forms_sl_vl` */;
/*!50001 DROP VIEW IF EXISTS `time_forms_sl_vl` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_forms_sl_vl` AS select `u`.`full_name` AS `full_name`,`u`.`user_id` AS `user_id`,`upos`.`position` AS `position`,`up`.`company_id` AS `company_id`,`up`.`company` AS `company`,`up`.`project_id` AS `project_id`,`uproj`.`project` AS `project`,`up`.`department_id` AS `department_id`,`ud`.`department` AS `department`,`p`.`effectivity_date` AS `effectivity_date`,`p`.`regularization_date` AS `date_hired`,`p`.`id_number` AS `id_number`,`tfb`.`current` AS `current`,`tfb`.`form_code` AS `form_code`,`tfb`.`year` AS `year`,month(`tfd`.`date`) AS `month`,`tfd`.`credit` AS `credit`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 1) then `tfd`.`credit` end)),'') AS `1`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 2) then `tfd`.`credit` end)),'') AS `2`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 3) then `tfd`.`credit` end)),'') AS `3`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 4) then `tfd`.`credit` end)),'') AS `4`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 5) then `tfd`.`credit` end)),'') AS `5`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 6) then `tfd`.`credit` end)),'') AS `6`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 7) then `tfd`.`credit` end)),'') AS `7`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 8) then `tfd`.`credit` end)),'') AS `8`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 9) then `tfd`.`credit` end)),'') AS `9`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 10) then `tfd`.`credit` end)),'') AS `10`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 11) then `tfd`.`credit` end)),'') AS `11`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 12) then `tfd`.`credit` end)),'') AS `12`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 13) then `tfd`.`credit` end)),'') AS `13`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 14) then `tfd`.`credit` end)),'') AS `14`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 15) then `tfd`.`credit` end)),'') AS `15`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 16) then `tfd`.`credit` end)),'') AS `16`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 17) then `tfd`.`credit` end)),'') AS `17`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 18) then `tfd`.`credit` end)),'') AS `18`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 19) then `tfd`.`credit` end)),'') AS `19`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 20) then `tfd`.`credit` end)),'') AS `20`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 21) then `tfd`.`credit` end)),'') AS `21`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 22) then `tfd`.`credit` end)),'') AS `22`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 23) then `tfd`.`credit` end)),'') AS `23`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 24) then `tfd`.`credit` end)),'') AS `24`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 25) then `tfd`.`credit` end)),'') AS `25`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 26) then `tfd`.`credit` end)),'') AS `26`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 27) then `tfd`.`credit` end)),'') AS `27`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 28) then `tfd`.`credit` end)),'') AS `28`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 29) then `tfd`.`credit` end)),'') AS `29`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 30) then `tfd`.`credit` end)),'') AS `30`,ifnull(sum((case when (dayofmonth(`tfd`.`date`) = 31) then `tfd`.`credit` end)),'') AS `31`,(`tfb`.`current` - `get_balance`(`u`.`user_id`,`tfb`.`form_code`,month(`tfd`.`date`),`tfb`.`year`)) AS `running_balance`,1.25 AS `monthly_earning`,sum(if((`tfd`.`credit` = 8.000),1,if((`tfd`.`credit` = 4.000),0.5,0))) AS `used`,((`tfb`.`current` - `get_balance`(`u`.`user_id`,`tfb`.`form_code`,month(`tfd`.`date`),`tfb`.`year`)) - sum(if((`tfd`.`credit` = 8.000),1,if((`tfd`.`credit` = 4.000),0.5,0)))) AS `total_bal` from ((((((((`ww_users` `u` left join `ww_users_profile` `up` on((`u`.`user_id` = `up`.`user_id`))) left join `ww_users_position` `upos` on((`up`.`position_id` = `upos`.`position_id`))) left join `ww_partners` `p` on((`p`.`user_id` = `u`.`user_id`))) left join `ww_users_department` `ud` on((`ud`.`department_id` = `up`.`department_id`))) left join `ww_users_project` `uproj` on((`uproj`.`project_id` = `up`.`project_id`))) left join `ww_time_form_balance` `tfb` on((`u`.`user_id` = `tfb`.`user_id`))) left join `ww_time_forms_date` `tfd` on((`tfd`.`leave_balance_id` = `tfb`.`id`))) left join `ww_time_forms` `tf` on((`tf`.`forms_id` = `tfd`.`forms_id`))) where ((`u`.`active` = 1) and (`tfb`.`form_code` in ('VL','SL')) and (`tf`.`form_status_id` = 6)) group by `tfb`.`user_id`,`tfb`.`form_code`,`tfb`.`year`,month(`tfd`.`date`) order by `u`.`full_name`,`tfb`.`year`,month(`tfd`.`date`),`tfb`.`form_code` */;

/*View structure for view time_forms_sl_vl_detail */

/*!50001 DROP TABLE IF EXISTS `time_forms_sl_vl_detail` */;
/*!50001 DROP VIEW IF EXISTS `time_forms_sl_vl_detail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_forms_sl_vl_detail` AS select `a`.`user_id` AS `user_id`,`a`.`full_name` AS `full_name`,`a`.`form_code` AS `form_code`,`b`.`month_id` AS `month`,`a`.`position` AS `position`,`a`.`company_id` AS `company_id`,`a`.`company` AS `company`,`a`.`project_id` AS `project_id`,`a`.`project` AS `project`,`a`.`department_id` AS `department_id`,`a`.`department` AS `department`,`a`.`effectivity_date` AS `effectivity_date`,`a`.`date_hired` AS `date_hired`,`a`.`id_number` AS `id_number`,(case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then `a`.`used` else 0 end) AS `credit`,`get_current_balance`(`a`.`user_id`,`a`.`form_code`,`a`.`year`) AS `current`,`a`.`year` AS `year`,`a`.`monthly_earning` AS `monthly_earning`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`1`)) AS `1`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`2`)) AS `2`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`3`)) AS `3`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`4`)) AS `4`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`5`)) AS `5`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`6`)) AS `6`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`7`)) AS `7`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`8`)) AS `8`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`9`)) AS `9`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`10`)) AS `10`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`11`)) AS `11`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`12`)) AS `12`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`13`)) AS `13`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`14`)) AS `14`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`15`)) AS `15`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`16`)) AS `16`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`17`)) AS `17`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`18`)) AS `18`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`19`)) AS `19`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`20`)) AS `20`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`21`)) AS `21`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`22`)) AS `22`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`23`)) AS `23`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`24`)) AS `24`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`25`)) AS `25`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`26`)) AS `26`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`27`)) AS `27`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`28`)) AS `28`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`29`)) AS `29`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`30`)) AS `30`,sum(((case when ((`a`.`month` = `b`.`month_id`) and (`a`.`form_code` = `b`.`form_code`)) then 1 else 0 end) * `a`.`31`)) AS `31`,((`get_current_balance`(`a`.`user_id`,`a`.`form_code`,`a`.`year`) + round(('1.25' * `b`.`month_id`),2)) - `get_used_leave`(`a`.`user_id`,`a`.`form_code`,`a`.`year`,`b`.`month_id`)) AS `running_balance`,sum((case when ((`a`.`month` = `b`.`month_id`) and (`b`.`form_code` = `a`.`form_code`)) then `a`.`used` else 0 end)) AS `used`,((`get_current_balance`(`a`.`user_id`,`a`.`form_code`,`a`.`year`) + round(('1.25' * `b`.`month_id`),2)) - `get_used_leave`(`a`.`user_id`,`a`.`form_code`,`a`.`year`,`b`.`month_id`)) AS `total_bal` from (`time_forms_sl_vl` `a` join `time_forms_sl_vl_month` `b` on((`a`.`user_id` = `b`.`user_id`))) where (`a`.`form_code` = `b`.`form_code`) group by `b`.`month_id`,`b`.`form_code`,`a`.`user_id` order by `a`.`full_name`,`b`.`month_id` */;

/*View structure for view time_forms_sl_vl_month */

/*!50001 DROP TABLE IF EXISTS `time_forms_sl_vl_month` */;
/*!50001 DROP VIEW IF EXISTS `time_forms_sl_vl_month` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_forms_sl_vl_month` AS (select `u`.`user_id` AS `user_id`,`m`.`month_id` AS `month_id`,`t`.`form_code` AS `form_code` from ((`ww_users` `u` join `ww_month` `m`) join `ww_time_form` `t`) where (`t`.`form_code` in ('SL','VL'))) */;

/*View structure for view time_forms_validate_if_exist */

/*!50001 DROP TABLE IF EXISTS `time_forms_validate_if_exist` */;
/*!50001 DROP VIEW IF EXISTS `time_forms_validate_if_exist` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_forms_validate_if_exist` AS (select `tf`.`forms_id` AS `forms_id`,`tf`.`user_id` AS `user_id`,`tfs`.`form_status` AS `form_status`,`tf`.`form_id` AS `form_id`,`tfd`.`day` AS `day`,`tfd`.`hrs` AS `hrs`,`tfd`.`date` AS `date`,`tfd`.`time_from` AS `time_from`,`tfd`.`time_to` AS `time_to`,`tfd`.`duration_id` AS `duration_id`,`td`.`duration` AS `duration`,`td`.`credit` AS `credit` from (((`time_forms` `tf` join `time_forms_date` `tfd`) join `ww_time_form_status` `tfs`) join `ww_time_duration` `td`) where ((`tf`.`form_status_id` = `tfs`.`form_status_id`) and (`tfs`.`form_status` in ('For Approval','Pending','For Validation','Fit to Work')) and (`tf`.`forms_id` = `tfd`.`forms_id`) and (`tfd`.`duration_id` = `td`.`duration_id`)) order by `tfd`.`date` desc) */;

/*View structure for view time_forms_validation */

/*!50001 DROP TABLE IF EXISTS `time_forms_validation` */;
/*!50001 DROP VIEW IF EXISTS `time_forms_validation` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_forms_validation` AS (select `tf`.`forms_id` AS `forms_id`,`tf`.`user_id` AS `user_id`,`tfs`.`form_status` AS `form_status`,`tf`.`form_id` AS `form_id`,`tfd`.`day` AS `day`,`tfd`.`hrs` AS `hrs`,`tfd`.`date` AS `date`,`tfd`.`time_from` AS `time_from`,`tfd`.`time_to` AS `time_to`,`tfd`.`duration_id` AS `duration_id`,`td`.`duration` AS `duration`,`td`.`credit` AS `credit` from (((`time_forms` `tf` join `time_forms_date` `tfd`) join `ww_time_form_status` `tfs`) join `ww_time_duration` `td`) where ((`tf`.`form_status_id` = `tfs`.`form_status_id`) and (`tfs`.`form_status` = 'Approved') and (`tf`.`forms_id` = `tfd`.`forms_id`) and (`tfd`.`duration_id` = `td`.`duration_id`)) order by `tfd`.`date` desc) */;

/*View structure for view time_holiday */

/*!50001 DROP TABLE IF EXISTS `time_holiday` */;
/*!50001 DROP VIEW IF EXISTS `time_holiday` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_holiday` AS (select `ww_time_holiday`.`holiday_id` AS `holiday_id`,`ww_time_holiday`.`holiday` AS `holiday`,`ww_time_holiday`.`holiday_date` AS `holiday_date`,`ww_time_holiday`.`status_id` AS `status_id`,`ww_time_holiday`.`legal` AS `legal`,`ww_time_holiday`.`location_count` AS `location_count`,`ww_time_holiday`.`user_count` AS `user_count`,`ww_time_holiday`.`deleted` AS `deleted` from `ww_time_holiday` where (`ww_time_holiday`.`deleted` = 0)) */;

/*View structure for view time_period_list */

/*!50001 DROP TABLE IF EXISTS `time_period_list` */;
/*!50001 DROP VIEW IF EXISTS `time_period_list` */;

/*!50001 CREATE ALGORITHM=TEMPTABLE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_period_list` AS (select `ww_time_period`.`period_id` AS `record_id`,`ww_time_period`.`period_id` AS `period_id`,`ww_time_period`.`period_year` AS `period_year`,date_format(`ww_time_period`.`payroll_date`,'%b') AS `period_month`,`ww_time_period`.`processed` AS `process_count`,if((`ww_time_period`.`deleted` = 1),'Deleted',if((`ww_time_period`.`closed` = 0),'Still Open','Closed')) AS `proces_status`,date_format(`ww_time_period`.`payroll_date`,'%M %e') AS `payroll_date`,`ww_users_company`.`company` AS `company`,date_format(`ww_time_period`.`date_from`,'%b-%e') AS `date_from`,date_format(`ww_time_period`.`date_from`,'%a') AS `date_from_day`,year(`ww_time_period`.`date_from`) AS `date_from_year`,date_format(`ww_time_period`.`date_to`,'%b-%e') AS `date_to`,date_format(`ww_time_period`.`date_to`,'%a') AS `date_to_day`,year(`ww_time_period`.`date_to`) AS `date_to_year`,`ww_time_period`.`company_id` AS `company_id`,`ww_time_period`.`date_from` AS `from`,`ww_time_period`.`date_to` AS `to`,`ww_time_period`.`created_on` AS `created_on`,`ww_time_period`.`created_by` AS `created_by`,`ww_time_period`.`modified_by` AS `modified_by`,`ww_time_period`.`modified_on` AS `modified_on`,`ww_time_period`.`deleted` AS `ww_time_period.deleted` from (`ww_time_period` join `ww_users_company` on((`ww_users_company`.`company_id` = `ww_time_period`.`company_id`))) where ((`ww_time_period`.`deleted` = `is_trash`()) and ((`ww_time_period`.`period_year` like concat('%',`get_search`(),'%')) or (monthname(`ww_time_period`.`payroll_date`) like concat('%',`get_search`(),'%')))) order by `ww_time_period`.`payroll_date` desc,`ww_users_company`.`company`) */;

/*View structure for view time_record */

/*!50001 DROP TABLE IF EXISTS `time_record` */;
/*!50001 DROP VIEW IF EXISTS `time_record` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_record` AS (select `ww_time_record`.`record_id` AS `record_id`,`ww_time_record`.`user_id` AS `user_id`,`ww_time_record`.`biometric` AS `biometric`,`ww_time_record`.`shift_id` AS `shift_id`,`ww_time_record`.`shift` AS `shift`,`ww_time_record`.`date` AS `date`,`ww_time_record`.`processed` AS `processed`,`ww_time_record`.`override` AS `override`,`ww_time_record`.`aux_shift_id` AS `aux_shift_id`,`ww_time_record`.`aux_shift` AS `aux_shift`,`ww_time_record`.`aux_time_in` AS `aux_time_in`,`ww_time_record`.`aux_time_out` AS `aux_time_out`,`ww_time_record`.`time_in` AS `time_in`,`ww_time_record`.`time_out` AS `time_out`,`ww_time_record`.`breaka_in` AS `breaka_in`,`ww_time_record`.`breaka_out` AS `breaka_out`,`ww_time_record`.`breakb_in` AS `breakb_in`,`ww_time_record`.`breakb_out` AS `breakb_out`,`ww_time_record`.`ot_in` AS `ot_in`,`ww_time_record`.`ot_out` AS `ot_out`,`ww_time_record`.`created_on` AS `created_on`,`ww_time_record`.`created_by` AS `created_by`,`ww_time_record`.`modified_on` AS `modified_on`,`ww_time_record`.`modified_by` AS `modified_by` from `ww_time_record`) */;

/*View structure for view time_record_holiday */

/*!50001 DROP TABLE IF EXISTS `time_record_holiday` */;
/*!50001 DROP VIEW IF EXISTS `time_record_holiday` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_record_holiday` AS (select `th`.`holiday_id` AS `holiday_id`,`th`.`holiday` AS `holiday`,`th`.`holiday_date` AS `holiday_date`,`th`.`legal` AS `legal`,if((`th`.`legal` = 1),'Legal Holiday','Special Holiday') AS `holiday_type`,'fa-calendar' AS `holiday_icon`,`thl`.`user_id` AS `user_id` from ((`ww_time_holiday` `th` left join `ww_time_holiday_location` `thl` on((`th`.`holiday_id` = `thl`.`holiday_id`))) left join `users` `u` on((`u`.`user_id` = `thl`.`user_id`))) where (`th`.`deleted` = 0)) */;

/*View structure for view time_record_list */

/*!50001 DROP TABLE IF EXISTS `time_record_list` */;
/*!50001 DROP VIEW IF EXISTS `time_record_list` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_record_list` AS (select `tr`.`record_id` AS `record_id`,`tr`.`user_id` AS `user_id`,`tr`.`date` AS `date`,date_format(`tr`.`date`,'%b-%e') AS `date_tag`,date_format(`tr`.`date`,'%a') AS `day_tag`,if(isnull(`trh`.`holiday_id`),`tr`.`shift`,`trh`.`holiday_type`) AS `shift`,if((`tr`.`shift` = 'Restday'),'fa-coffee',if(isnull(`trh`.`holiday_id`),if(isnull(`tfb`.`forms_id`),'','fa-bullhorn'),`trh`.`holiday_icon`)) AS `notes_icon`,if(isnull(`trh`.`holiday_id`),`tr`.`shift`,`trh`.`holiday_type`) AS `notes_title`,if(isnull(`trh`.`holiday_id`),`tr`.`shift`,`trh`.`holiday`) AS `notes`,'fa ' AS `remind_icon`,'Logs ' AS `remind_title`,'Notes ' AS `remind`,date_format(`tr`.`time_in`,'%l:%i') AS `timein`,lcase(date_format(`tr`.`time_in`,'%p')) AS `timein_ampm`,date_format(`tr`.`time_out`,'%l:%i') AS `timeout`,lcase(date_format(`tr`.`time_out`,'%p')) AS `timeout_ampm`,if((cast(`tr`.`time_in` as date) = cast(`tr`.`time_out` as date)),'',date_format(`tr`.`time_out`,'%b-%e')) AS `timeout_date`,ifnull(`trs`.`late`,0) AS `late`,'min' AS `late_tag`,ifnull(`trs`.`undertime`,0) AS `undertime`,'min' AS `undertime_tag`,ifnull(`trs`.`ot`,0) AS `ot`,ifnull(`trs`.`ot_break`,0) AS `ot_break`,'hr' AS `ot_tag`,ifnull(`trs`.`hrs_actual`,0) AS `hrs_worked`,`trs`.`awol` AS `awol`,`tr`.`biometric` AS `biometric`,`tr`.`shift_id` AS `shift_id`,`tr`.`processed` AS `processed`,`tr`.`override` AS `override`,`tr`.`aux_shift_id` AS `aux_shift_id`,`tr`.`aux_shift` AS `aux_shift`,`tr`.`aux_time_in` AS `aux_time_in`,`tr`.`aux_time_out` AS `aux_time_out`,`tr`.`time_in` AS `time_in`,`tr`.`time_out` AS `time_out`,`tr`.`breaka_in` AS `breaka_in`,`tr`.`breaka_out` AS `breaka_out`,`tr`.`breakb_in` AS `breakb_in`,`tr`.`breakb_out` AS `breakb_out`,`tr`.`ot_in` AS `ot_in`,`tr`.`ot_out` AS `ot_out`,`tr`.`created_on` AS `created_on`,`tr`.`created_by` AS `created_by`,`tr`.`modified_on` AS `modified_on`,`tr`.`modified_by` AS `modified_by`,0 AS `form_id`,0 AS `forms_id`,'' AS `form_code`,`tfb`.`form_id` AS `blanket_form_id`,`tfb`.`forms_id` AS `blanket_forms_id`,`tfb`.`date_start` AS `blanket_date_from`,`tfb`.`date_end` AS `blanket_date_to`,`tfb`.`date_time_start` AS `blanket_date_time_from`,`tfb`.`date_time_end` AS `blanket_date_time_to`,`tfb`.`blanket_name` AS `blanket_name`,`tfb`.`detail` AS `blanket_detail`,`tfb`.`reason` AS `blanket_reason`,`pp`.`non_swipe` AS `non_swipe` from ((((`time_record` `tr` left join `time_record_summary` `trs` on((`trs`.`record_id` = `tr`.`record_id`))) left join `time_record_holiday` `trh` on(((`trh`.`holiday_date` = `tr`.`date`) and (`trh`.`user_id` = `tr`.`user_id`) and if(isnull(`trh`.`user_id`),(1 = 1),(`trh`.`user_id` = `tr`.`user_id`))))) left join `time_forms_blanket` `tfb` on(((`tr`.`date` between `tfb`.`date_from` and `tfb`.`date_to`) and (`tfb`.`user_id` = `tr`.`user_id`)))) left join `ww_payroll_partners` `pp` on((`pp`.`user_id` = `tr`.`user_id`))) order by `tr`.`date` desc) */;

/*View structure for view time_record_list_forms */

/*!50001 DROP TABLE IF EXISTS `time_record_list_forms` */;
/*!50001 DROP VIEW IF EXISTS `time_record_list_forms` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_record_list_forms` AS (select `time_forms`.`forms_id` AS `forms_id`,`time_forms`.`form_status_id` AS `form_status_id`,`time_forms`.`form_id` AS `form_id`,if((`time_forms`.`form_code` = 'ADDL'),'CL',`time_forms`.`form_code`) AS `form_code`,`time_forms`.`user_id` AS `user_id`,`time_forms`.`display_name` AS `display_name`,`time_forms_date`.`day` AS `day`,`time_forms`.`hrs` AS `hrs`,`time_forms`.`date_from` AS `date_from`,`time_forms`.`date_to` AS `date_to`,`time_forms`.`date_approved` AS `date_approved`,`time_forms`.`date_declined` AS `date_declined`,`time_forms`.`date_cancelled` AS `date_cancelled`,`time_forms`.`date_sent` AS `date_sent`,`time_forms`.`reason` AS `reason`,`time_forms`.`scheduled` AS `scheduled`,`time_forms`.`created_on` AS `created_on`,`time_forms`.`created_by` AS `created_by`,`time_forms`.`modified_on` AS `modified_on`,`time_forms`.`modified_by` AS `modified_by`,`time_forms`.`deleted` AS `deleted`,`time_form_status`.`color` AS `color`,`time_form`.`form` AS `form`,`approver`.`user_id` AS `approver_id`,`approver`.`display_name` AS `approver_name`,`approver`.`form_status` AS `form_status`,`time_forms_date`.`date` AS `date`,`time_forms_date`.`time_from` AS `time_from`,`time_forms_date`.`time_to` AS `time_to`,`time_shift`.`shift` AS `curr_shift`,`time_shift_to`.`shift` AS `to_shift`,`time_forms_obt`.`contact_no` AS `contact_no`,`time_forms_obt`.`name` AS `name`,`time_forms_obt`.`position` AS `position`,`time_forms_obt`.`company_to_visit` AS `company_to_visit`,`time_forms_obt`.`location` AS `location` from (((((((`time_forms` join `ww_time_form` `time_form` on((`time_forms`.`form_id` = `time_form`.`form_id`))) join `ww_time_form_status` `time_form_status` on((`time_form_status`.`form_status_id` = `time_forms`.`form_status_id`))) left join `time_forms_date` on((`time_forms`.`forms_id` = `time_forms_date`.`forms_id`))) left join `ww_time_forms_approver` `approver` on((`time_forms`.`forms_id` = `approver`.`forms_id`))) left join `ww_time_shift` `time_shift` on((`time_shift`.`shift_id` = `time_forms_date`.`shift_id`))) left join `ww_time_shift` `time_shift_to` on((`time_shift_to`.`shift_id` = `time_forms_date`.`shift_to`))) left join `ww_time_forms_obt` `time_forms_obt` on((`time_forms_obt`.`forms_id` = `time_forms`.`forms_id`)))) */;

/*View structure for view time_record_raw */

/*!50001 DROP TABLE IF EXISTS `time_record_raw` */;
/*!50001 DROP VIEW IF EXISTS `time_record_raw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_record_raw` AS (select `ww_time_record_raw`.`raw_id` AS `raw_id`,`ww_time_record_raw`.`user_id` AS `user_id`,`ww_time_record_raw`.`biometric` AS `biometric`,`ww_time_record_raw`.`date` AS `date`,`ww_time_record_raw`.`location_id` AS `location_id`,`ww_time_record_raw`.`device_id` AS `device_id`,`ww_time_record_raw`.`checktime` AS `checktime`,`ww_time_record_raw`.`checktype` AS `checktype`,`ww_time_record_raw`.`processed` AS `processed` from `ww_time_record_raw`) */;

/*View structure for view time_record_schedule_history */

/*!50001 DROP TABLE IF EXISTS `time_record_schedule_history` */;
/*!50001 DROP VIEW IF EXISTS `time_record_schedule_history` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_record_schedule_history` AS (select `ub`.`branch_id` AS `branch_id`,`ud`.`department_id` AS `department_id`,`ub`.`branch` AS `branch`,`ud`.`department` AS `department`,`m`.`user_id` AS `user_id`,`m`.`created_by` AS `created_by_user_id`,`p`.`id_number` AS `id_number`,`c`.`full_name` AS `name`,(case when (`ts`.`shift` is not null) then 'Shift' when (`tsw`.`calendar` is not null) then 'Weekly Sched' else '' end) AS `type`,(case when (`ts`.`shift` is not null) then `ts`.`shift` when (`tsw`.`calendar` is not null) then `tsw`.`calendar` else '' end) AS `new_schedule`,date_format(`m`.`from_date`,'%M %d, %Y') AS `date_from`,date_format(`m`.`to_date`,'%M %d, %Y') AS `date_to`,`d`.`full_name` AS `change_by`,`m`.`created_on` AS `created_on`,date_format(`m`.`created_on`,'%M %d, %Y %h:%i %p') AS `date_and_time` from ((((((((`ww_time_record_schedule_history` `m` left join `ww_users` `c` on((`c`.`user_id` = `m`.`user_id`))) left join `ww_users_profile` `up` on((`c`.`user_id` = `up`.`user_id`))) left join `ww_users_branch` `ub` on((`up`.`branch_id` = `ub`.`branch_id`))) left join `ww_users_department` `ud` on((`up`.`department_id` = `ud`.`department_id`))) left join `ww_partners` `p` on((`c`.`user_id` = `p`.`user_id`))) left join `ww_users` `d` on((`d`.`user_id` = `m`.`created_by`))) left join `ww_time_shift` `ts` on((`ts`.`shift_id` = `m`.`shift_id`))) left join `ww_time_shift_weekly` `tsw` on((`tsw`.`calendar_id` = `m`.`calendar_id`)))) */;

/*View structure for view time_record_summary */

/*!50001 DROP TABLE IF EXISTS `time_record_summary` */;
/*!50001 DROP VIEW IF EXISTS `time_record_summary` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_record_summary` AS (select `ww_time_record_summary`.`record_id` AS `record_id`,`ww_time_record_summary`.`user_id` AS `user_id`,`ww_time_record_summary`.`id_number` AS `id_number`,`ww_time_record_summary`.`date` AS `date`,`ww_time_record_summary`.`payroll_date` AS `payroll_date`,`ww_time_record_summary`.`day_type` AS `day_type`,`ww_time_record_summary`.`hrs_rendered` AS `hrs_rendered`,`ww_time_record_summary`.`hrs_actual` AS `hrs_actual`,`ww_time_record_summary`.`hrs_break` AS `hrs_break`,`ww_time_record_summary`.`absent` AS `absent`,`ww_time_record_summary`.`lwp` AS `lwp`,`ww_time_record_summary`.`lwop` AS `lwop`,`ww_time_record_summary`.`late` AS `late`,`ww_time_record_summary`.`undertime` AS `undertime`,`ww_time_record_summary`.`ot` AS `ot`,`ww_time_record_summary`.`ot_break` AS `ot_break`,`ww_time_record_summary`.`resigned` AS `resigned`,`ww_time_record_summary`.`awol` AS `awol` from `ww_time_record_summary`) */;

/*View structure for view time_record_tardiness */

/*!50001 DROP TABLE IF EXISTS `time_record_tardiness` */;
/*!50001 DROP VIEW IF EXISTS `time_record_tardiness` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_record_tardiness` AS (select `t1`.`period_year` AS `period_year`,`t1`.`period_month` AS `period_month`,`t1`.`user_id` AS `user_id`,`t1`.`id_number` AS `id_number`,`t1`.`instances` AS `instances`,`t1`.`total_minutes` AS `total_minutes`,`t2`.`date` AS `date`,`t2`.`late` AS `late` from (`ww_time_record_tardiness` `t1` join `ww_time_record_tardiness_detail` `t2` on(((`t1`.`period_year` = `t2`.`period_year`) and (`t1`.`period_month` = `t2`.`period_month`) and (`t1`.`user_id` = `t2`.`user_id`))))) */;

/*View structure for view time_shift */

/*!50001 DROP TABLE IF EXISTS `time_shift` */;
/*!50001 DROP VIEW IF EXISTS `time_shift` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_shift` AS (select `ww_time_shift`.`shift_id` AS `shift_id`,`ww_time_shift`.`shift` AS `shift`,`ww_time_shift`.`status_id` AS `status_id`,`ww_time_shift`.`time_start` AS `time_start`,`ww_time_shift`.`time_end` AS `time_end`,`ww_time_shift`.`created_on` AS `created_on`,`ww_time_shift`.`created_by` AS `created_by`,`ww_time_shift`.`modified_on` AS `modified_on`,`ww_time_shift`.`modified_by` AS `modified_by`,`ww_time_shift`.`deleted` AS `deleted` from `ww_time_shift` where (`ww_time_shift`.`deleted` = 0)) */;

/*View structure for view time_shift_class */

/*!50001 DROP TABLE IF EXISTS `time_shift_class` */;
/*!50001 DROP VIEW IF EXISTS `time_shift_class` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_shift_class` AS (select `a`.`id` AS `id`,`a`.`shift_id` AS `shift_id`,`d`.`shift` AS `shift`,`a`.`company_id` AS `company_id`,`b`.`company` AS `company`,`a`.`class_id` AS `class_id`,`c`.`class_code` AS `class_code`,`a`.`class_value` AS `class_value` from (((`ww_time_shift_class_company` `a` join `ww_users_company` `b` on((`b`.`company_id` = `a`.`company_id`))) join `ww_time_shift_class` `c` on((`c`.`class_id` = `a`.`class_id`))) join `ww_time_shift` `d` on((`d`.`shift_id` = `a`.`shift_id`)))) */;

/*View structure for view time_shift_class_company */

/*!50001 DROP TABLE IF EXISTS `time_shift_class_company` */;
/*!50001 DROP VIEW IF EXISTS `time_shift_class_company` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_shift_class_company` AS (select `ts`.`shift_id` AS `shift_id`,`ts`.`shift` AS `shift`,`tscc`.`company_id` AS `company_id`,`ts`.`time_start` AS `time_start`,`ts`.`time_end` AS `time_end`,`tsc`.`class_id` AS `class_id`,`tsc`.`class_code` AS `class_code`,`tsc`.`class` AS `class`,`tscc`.`class_value` AS `class_value`,`tscc`.`employment_status_id` AS `employment_status_id`,`tscc`.`employment_type_id` AS `employment_type_id`,`tscc`.`partners_id` AS `partners_id` from ((`ww_time_shift` `ts` left join `ww_time_shift_class_company` `tscc` on((`tscc`.`shift_id` = `ts`.`shift_id`))) left join `ww_time_shift_class` `tsc` on((`tsc`.`class_id` = `tscc`.`class_id`))) where ((`ts`.`deleted` = 0) and (`ts`.`deleted` = 0))) */;

/*View structure for view time_shift_logs */

/*!50001 DROP TABLE IF EXISTS `time_shift_logs` */;
/*!50001 DROP VIEW IF EXISTS `time_shift_logs` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_shift_logs` AS (select `partners`.`user_id` AS `user_id`,`time_record`.`date` AS `date`,if((`time_forms_date`.`shift_to` > 0),`cws_shift`.`shift_id`,`prt_shift`.`shift_id`) AS `shift_id`,if((`time_forms_date`.`shift_to` > 0),`cws_shift`.`time_start`,`prt_shift`.`time_start`) AS `shift_time_start`,if((`time_forms_date`.`shift_to` > 0),`cws_shift`.`time_end`,`prt_shift`.`time_end`) AS `shift_time_end`,if(((`time_record`.`record_id` > 0) and (`time_record`.`time_in` <> '0000-00-00 00:00:00')),`time_record`.`time_in`,'-') AS `logs_time_in`,if(((`time_record`.`record_id` > 0) and (`time_record`.`time_out` <> '0000-00-00 00:00:00')),`time_record`.`time_out`,'-') AS `logs_time_out` from (((((`partners` left join `time_forms` on(((`partners`.`user_id` = `time_forms`.`user_id`) and (`time_forms`.`form_id` = 12) and (`time_forms`.`form_status_id` = 6)))) left join `time_record` on((`partners`.`user_id` = `time_record`.`user_id`))) left join `time_forms_date` on(((`time_forms`.`forms_id` = `time_forms_date`.`forms_id`) and (`time_forms_date`.`deleted` = 0)))) left join `time_shift` `prt_shift` on((`partners`.`shift_id` = `prt_shift`.`shift_id`))) left join `time_shift` `cws_shift` on((`time_forms_date`.`shift_to` = `cws_shift`.`shift_id`)))) */;

/*View structure for view time_shift_rest_days */

/*!50001 DROP TABLE IF EXISTS `time_shift_rest_days` */;
/*!50001 DROP VIEW IF EXISTS `time_shift_rest_days` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_shift_rest_days` AS (select `partners`.`user_id` AS `user_id`,if((`time_forms_date`.`shift_to` > 0),`cws_shift_rest`.`shift_id`,`prt_shift_rest`.`shift_id`) AS `shift_id`,if((`time_forms_date`.`shift_to` > 0),`cws_shift_rest`.`day`,`prt_shift_rest`.`day`) AS `rest_day` from (((((`partners` left join `users_profile` on((`partners`.`user_id` = `users_profile`.`user_id`))) left join `time_forms` on(((`partners`.`user_id` = `time_forms`.`user_id`) and (`time_forms`.`form_id` = 12) and (`time_forms`.`form_status_id` = 6)))) left join `time_forms_date` on(((`time_forms`.`forms_id` = `time_forms_date`.`forms_id`) and (`time_forms_date`.`deleted` = 0)))) left join `ww_time_shift_restday` `prt_shift_rest` on(((`partners`.`shift_id` = `prt_shift_rest`.`shift_id`) and (`users_profile`.`company_id` = `prt_shift_rest`.`company_id`) and (`prt_shift_rest`.`deleted` = 0)))) left join `ww_time_shift_restday` `cws_shift_rest` on(((`time_forms_date`.`shift_id` = `cws_shift_rest`.`shift_id`) and (`users_profile`.`company_id` = `cws_shift_rest`.`company_id`) and (`cws_shift_rest`.`deleted` = 0))))) */;

/*View structure for view time_stats */

/*!50001 DROP TABLE IF EXISTS `time_stats` */;
/*!50001 DROP VIEW IF EXISTS `time_stats` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `time_stats` AS (select `trs`.`user_id` AS `user_id`,sum(if((`trs`.`day_type` <> 'RESTDAY'),1,0)) AS `mandays`,sum(if((`trs`.`day_type` <> 'RESTDAY'),((`trs`.`hrs_actual` + `trs`.`late`) + `trs`.`undertime`),0)) AS `manhours`,sum((`trs`.`late` + `trs`.`undertime`)) AS `late_undertime`,sum((`trs`.`absent` + `trs`.`lwop`)) AS `abs_lwop`,round((((sum(if((`trs`.`day_type` <> 'RESTDAY'),1,0)) - sum((`trs`.`absent` + `trs`.`lwop`))) / sum(if((`trs`.`day_type` <> 'RESTDAY'),1,0))) * 100),0) AS `attendance`,round(((sum(if((`trs`.`day_type` <> 'RESTDAY'),(`trs`.`late` + `trs`.`undertime`),0)) / sum(if((`trs`.`day_type` <> 'RESTDAY'),((`trs`.`hrs_actual` + `trs`.`late`) + `trs`.`undertime`),0))) * 100),1) AS `dispute`,sum(`trs`.`ot`) AS `overtime` from `ww_time_record_summary` `trs` where ((`trs`.`payroll_date` > curdate()) and (`trs`.`date` < curdate())) group by 1 order by 1) */;

/*View structure for view users */

/*!50001 DROP TABLE IF EXISTS `users` */;
/*!50001 DROP VIEW IF EXISTS `users` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `users` AS (select `ww_users`.`user_id` AS `user_id`,`ww_users`.`role_id` AS `role_id`,`ww_users`.`company_id` AS `company_id`,`ww_users`.`can_view` AS `can_view`,`ww_users`.`can_delete` AS `can_delete`,`ww_users`.`email` AS `email`,`ww_users`.`full_name` AS `full_name`,`ww_users`.`login` AS `login`,`ww_users`.`hash` AS `hash`,`ww_users`.`last_login` AS `last_login`,`ww_users`.`display_name` AS `display_name`,`ww_users`.`timezone` AS `timezone`,`ww_users`.`language` AS `language`,`ww_users`.`active` AS `active`,`ww_users`.`lastactivity` AS `lastactivity`,`ww_users`.`created_on` AS `created_on`,`ww_users`.`created_by` AS `created_by`,`ww_users`.`modified_on` AS `modified_on`,`ww_users`.`modified_by` AS `modified_by`,`ww_users`.`deleted` AS `deleted` from `ww_users` where (`ww_users`.`deleted` = 0) order by `ww_users`.`display_name`) */;

/*View structure for view users_position */

/*!50001 DROP TABLE IF EXISTS `users_position` */;
/*!50001 DROP VIEW IF EXISTS `users_position` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `users_position` AS (select `ww_users_position`.`position_id` AS `position_id`,`ww_users_position`.`position_code` AS `position_code`,`ww_users_position`.`position` AS `position`,`ww_users_position`.`status_id` AS `status_id`,`ww_users_position`.`can_delete` AS `can_delete`,`ww_users_position`.`employee_type_id` AS `employee_type_id`,`ww_users_position`.`employee_type` AS `employee_type`,`ww_users_position`.`immediate_id` AS `immediate_id`,`ww_users_position`.`immediate` AS `immediate`,`ww_users_position`.`created_on` AS `created_on`,`ww_users_position`.`created_by` AS `created_by`,`ww_users_position`.`modified_on` AS `modified_on`,`ww_users_position`.`modified_by` AS `modified_by`,`ww_users_position`.`deleted` AS `deleted` from `ww_users_position` where (`ww_users_position`.`deleted` = 0)) */;

/*View structure for view users_profile */

/*!50001 DROP TABLE IF EXISTS `users_profile` */;
/*!50001 DROP VIEW IF EXISTS `users_profile` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `users_profile` AS (select `u`.`user_id` AS `user_id`,`up`.`partner_id` AS `partner_id`,`up`.`coordinator_id` AS `coordinator_id`,`up`.`recruit_id` AS `recruit_id`,`u`.`display_name` AS `display_name`,`up`.`title` AS `title`,`up`.`suffix` AS `suffix`,`up`.`lastname` AS `lastname`,`up`.`firstname` AS `firstname`,`up`.`middlename` AS `middlename`,`up`.`maidenname` AS `maidenname`,`up`.`nickname` AS `nickname`,`up`.`project_id` AS `project_id`,`up`.`company` AS `company`,`up`.`company_id` AS `company_id`,`up`.`group_id` AS `group_id`,`up`.`division_id` AS `division_id`,`up`.`department_id` AS `department_id`,`up`.`branch_id` AS `branch_id`,`up`.`position_id` AS `position_id`,`up`.`reports_to_id` AS `reports_to_id`,`up`.`project_hr_id` AS `project_hr_id`,`up`.`job_title_id` AS `job_title_id`,`up`.`location_id` AS `location_id`,`up`.`photo` AS `photo`,`up`.`birth_date` AS `birth_date`,`getage`(`up`.`birth_date`) AS `age`,ifnull(trim(`pp`.`key_value`),'') AS `gender`,`u`.`active` AS `active` from ((`ww_users_profile` `up` join `ww_users` `u` on(((`u`.`user_id` = `up`.`user_id`) and (`u`.`deleted` = 0)))) left join `ww_partners_personal` `pp` on(((`pp`.`deleted` = 0) and (`pp`.`partner_id` = `up`.`partner_id`) and (`pp`.`key` = 'gender'))))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
