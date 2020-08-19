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
/*Table structure for table `logtable` */

DROP TABLE IF EXISTS `logtable`;

CREATE TABLE `logtable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `logtable_leave_balance_accrual` */

DROP TABLE IF EXISTS `logtable_leave_balance_accrual`;

CREATE TABLE `logtable_leave_balance_accrual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21865 DEFAULT CHARSET=utf8;

/*Table structure for table `logtable_movement` */

DROP TABLE IF EXISTS `logtable_movement`;

CREATE TABLE `logtable_movement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movement_id` text,
  `date_executed` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `logtable_movement_action` */

DROP TABLE IF EXISTS `logtable_movement_action`;

CREATE TABLE `logtable_movement_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action_id` int(11) DEFAULT NULL,
  `recurring_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `amount` varbinary(255) DEFAULT NULL,
  `date_executed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `logtablecheck` */

DROP TABLE IF EXISTS `logtablecheck`;

CREATE TABLE `logtablecheck` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_approver_class` */

DROP TABLE IF EXISTS `ww_approver_class`;

CREATE TABLE `ww_approver_class` (
  `class_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `class_code` varchar(16) DEFAULT NULL,
  `class` varchar(32) DEFAULT NULL,
  `category` enum('Partners','Time Records','Recruitment','Performance','Training') DEFAULT 'Partners',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_approver_class_company` */

DROP TABLE IF EXISTS `ww_approver_class_company`;

CREATE TABLE `ww_approver_class_company` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(1) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0',
  `approver_id` int(11) NOT NULL DEFAULT '0',
  `alias` varchar(64) DEFAULT '',
  `condition` enum('ALL','By Level','Either Of') DEFAULT 'By Level',
  `sequence` tinyint(1) DEFAULT '0',
  `approver` int(1) DEFAULT '0',
  `email` tinyint(1) DEFAULT '0',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`),
  KEY `company_id` (`company_id`),
  KEY `approver_id` (`approver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_approver_class_department` */

DROP TABLE IF EXISTS `ww_approver_class_department`;

CREATE TABLE `ww_approver_class_department` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(1) NOT NULL,
  `department_id` int(11) NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL DEFAULT '0',
  `approver_id` int(11) NOT NULL DEFAULT '0',
  `alias` varchar(64) DEFAULT '',
  `condition` enum('ALL','By Level','Either Of') DEFAULT 'By Level',
  `sequence` tinyint(1) DEFAULT '1',
  `approver` int(1) DEFAULT '0',
  `email` tinyint(1) DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`),
  KEY `department_id` (`department_id`),
  KEY `company_id` (`company_id`),
  KEY `approver_id` (`approver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_approver_class_position` */

DROP TABLE IF EXISTS `ww_approver_class_position`;

CREATE TABLE `ww_approver_class_position` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(1) NOT NULL,
  `position_id` int(11) NOT NULL DEFAULT '0',
  `department_id` int(11) DEFAULT '0',
  `company_id` int(11) DEFAULT '0',
  `approver_id` int(11) NOT NULL DEFAULT '0',
  `alias` varchar(64) DEFAULT '',
  `condition` enum('ALL','By Level','Either Of') DEFAULT 'By Level',
  `sequence` tinyint(1) DEFAULT '0',
  `approver` int(1) DEFAULT '0',
  `email` tinyint(1) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`),
  KEY `position_id` (`position_id`),
  KEY `department_id` (`department_id`),
  KEY `company_id` (`company_id`),
  KEY `approver_id` (`approver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_approver_class_user` */

DROP TABLE IF EXISTS `ww_approver_class_user`;

CREATE TABLE `ww_approver_class_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(1) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `position_id` int(11) NOT NULL DEFAULT '0',
  `department_id` int(11) DEFAULT '0',
  `company_id` int(11) DEFAULT '0',
  `approver_id` int(11) NOT NULL DEFAULT '0',
  `alias` varchar(64) DEFAULT '',
  `condition` enum('ALL','By Level','Either Of') DEFAULT 'By Level',
  `sequence` tinyint(1) DEFAULT '0',
  `approver` int(1) DEFAULT '0',
  `email` tinyint(1) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_approver_class_users` */

DROP TABLE IF EXISTS `ww_approver_class_users`;

CREATE TABLE `ww_approver_class_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(1) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `position_id` int(11) NOT NULL DEFAULT '0',
  `department_id` int(11) DEFAULT '0',
  `company_id` int(11) DEFAULT '0',
  `approver_id` int(11) NOT NULL DEFAULT '0',
  `alias` varchar(64) DEFAULT '',
  `condition` enum('ALL','By Level','Either Of') DEFAULT 'By Level',
  `sequence` tinyint(1) DEFAULT '0',
  `approver` int(1) DEFAULT '0',
  `email` tinyint(1) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_audit_log_trail` */

DROP TABLE IF EXISTS `ww_audit_log_trail`;

CREATE TABLE `ww_audit_log_trail` (
  `audit_log_trail_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_time` datetime NOT NULL,
  `modules` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `item_name` text CHARACTER SET latin1,
  `original_value` text CHARACTER SET latin1,
  `new_value` text CHARACTER SET latin1,
  `transaction` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `user` varchar(250) CHARACTER SET latin1 NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `computer_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`audit_log_trail_id`,`date_time`,`user`,`user_id`,`computer_name`)
) ENGINE=MyISAM AUTO_INCREMENT=17269 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_business_group` */

DROP TABLE IF EXISTS `ww_business_group`;

CREATE TABLE `ww_business_group` (
  `group_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(32) DEFAULT NULL,
  `group_code` varchar(16) DEFAULT NULL,
  `region_id` int(1) DEFAULT NULL,
  `description` text,
  `db` varchar(32) DEFAULT NULL,
  `icon` varchar(125) DEFAULT NULL,
  `logo` varchar(125) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_business_level` */

DROP TABLE IF EXISTS `ww_business_level`;

CREATE TABLE `ww_business_level` (
  `level_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `level` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_business_region` */

DROP TABLE IF EXISTS `ww_business_region`;

CREATE TABLE `ww_business_region` (
  `region_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `region` varchar(32) DEFAULT NULL,
  `region_code` varchar(16) DEFAULT NULL,
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`region_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_category` */

DROP TABLE IF EXISTS `ww_category`;

CREATE TABLE `ww_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) DEFAULT NULL,
  `table_name` varchar(100) DEFAULT NULL,
  `field_label` varchar(150) DEFAULT NULL,
  `primary_key` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `ww_certificate_of_employment` */

DROP TABLE IF EXISTS `ww_certificate_of_employment`;

CREATE TABLE `ww_certificate_of_employment` (
  `coe_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(128) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`coe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_cities` */

DROP TABLE IF EXISTS `ww_cities`;

CREATE TABLE `ww_cities` (
  `city_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `city` varchar(64) NOT NULL,
  `province_id` int(1) DEFAULT NULL,
  `minimum_wage` decimal(6,2) DEFAULT NULL,
  `ecola` decimal(6,2) DEFAULT NULL,
  `minimum_wage_effectivity` date DEFAULT '0000-00-00',
  `created_on` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1716 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_config` */

DROP TABLE IF EXISTS `ww_config`;

CREATE TABLE `ww_config` (
  `config_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `config_group_id` int(1) NOT NULL DEFAULT '0',
  `key` varchar(32) NOT NULL DEFAULT '',
  `description` mediumtext,
  `value` varchar(255) NOT NULL DEFAULT '',
  `encrypted` tinyint(1) DEFAULT '0',
  `add_qoutes` tinyint(1) DEFAULT '1',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`config_id`),
  KEY `config_group_id` (`config_group_id`),
  KEY `key` (`key`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_config_group` */

DROP TABLE IF EXISTS `ww_config_group`;

CREATE TABLE `ww_config_group` (
  `config_group_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `module_group` enum('Employee','Time Records','Employee Relation','Personnel','Payroll','Appraisal','Training','Analytics','Dashboard','System') DEFAULT 'System',
  `group_key` varchar(32) NOT NULL DEFAULT '',
  `group_name` varchar(64) NOT NULL DEFAULT '',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`config_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_countries` */

DROP TABLE IF EXISTS `ww_countries`;

CREATE TABLE `ww_countries` (
  `country_id` int(5) NOT NULL AUTO_INCREMENT,
  `iso2` char(2) DEFAULT NULL,
  `short_name` varchar(80) NOT NULL DEFAULT '',
  `long_name` varchar(80) NOT NULL DEFAULT '',
  `iso3` char(3) DEFAULT NULL,
  `numcode` varchar(6) DEFAULT NULL,
  `un_member` varchar(12) DEFAULT NULL,
  `calling_code` varchar(8) DEFAULT NULL,
  `cctld` varchar(5) DEFAULT NULL,
  `mobile_count` int(11) DEFAULT '10',
  `phone_count` int(11) DEFAULT '8',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` tinyint(1) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` tinyint(1) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_db_backup` */

DROP TABLE IF EXISTS `ww_db_backup`;

CREATE TABLE `ww_db_backup` (
  `backup_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `backup_type_id` int(1) DEFAULT NULL,
  `file` varchar(128) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`backup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_db_backup_type` */

DROP TABLE IF EXISTS `ww_db_backup_type`;

CREATE TABLE `ww_db_backup_type` (
  `backup_type_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `backup_type` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`backup_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_displays` */

DROP TABLE IF EXISTS `ww_displays`;

CREATE TABLE `ww_displays` (
  `display_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `display` varchar(16) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`display_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_fieldgroups` */

DROP TABLE IF EXISTS `ww_fieldgroups`;

CREATE TABLE `ww_fieldgroups` (
  `fg_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `mod_id` int(1) NOT NULL,
  `label` varchar(32) DEFAULT NULL,
  `description` text,
  `display_id` int(1) DEFAULT '0',
  `sequence` int(1) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`fg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_groups` */

DROP TABLE IF EXISTS `ww_groups`;

CREATE TABLE `ww_groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) DEFAULT NULL,
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_groups_members` */

DROP TABLE IF EXISTS `ww_groups_members`;

CREATE TABLE `ww_groups_members` (
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `full_name` varchar(128) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `date_joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_approved` datetime DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT '0',
  `active` tinyint(1) DEFAULT '0',
  `left_group` tinyint(1) DEFAULT '0',
  `leave_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_groups_notif` */

DROP TABLE IF EXISTS `ww_groups_notif`;

CREATE TABLE `ww_groups_notif` (
  `notif_id` int(11) NOT NULL AUTO_INCREMENT,
  `notif` text,
  `type_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`notif_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_groups_notif_recipient` */

DROP TABLE IF EXISTS `ww_groups_notif_recipient`;

CREATE TABLE `ww_groups_notif_recipient` (
  `notif_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `read` tinyint(1) DEFAULT '0',
  `read_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_groups_notif_type` */

DROP TABLE IF EXISTS `ww_groups_notif_type`;

CREATE TABLE `ww_groups_notif_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(64) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_groups_post` */

DROP TABLE IF EXISTS `ww_groups_post`;

CREATE TABLE `ww_groups_post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `post` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_groups_post_comments` */

DROP TABLE IF EXISTS `ww_groups_post_comments`;

CREATE TABLE `ww_groups_post_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_groups_post_likes` */

DROP TABLE IF EXISTS `ww_groups_post_likes`;

CREATE TABLE `ww_groups_post_likes` (
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_groups_post_upload` */

DROP TABLE IF EXISTS `ww_groups_post_upload`;

CREATE TABLE `ww_groups_post_upload` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) unsigned NOT NULL,
  `upload_id` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `upload_id` (`upload_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_memo` */

DROP TABLE IF EXISTS `ww_memo`;

CREATE TABLE `ww_memo` (
  `memo_id` int(11) NOT NULL AUTO_INCREMENT,
  `memo_type_id` int(1) DEFAULT NULL,
  `memo_title` varchar(128) DEFAULT NULL,
  `comments` tinyint(1) DEFAULT '0',
  `publish` tinyint(1) DEFAULT '0',
  `publish_from` date DEFAULT NULL,
  `publish_to` date DEFAULT NULL,
  `apply_to_id` int(11) DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `memo_body` text,
  `attachment` varchar(128) DEFAULT NULL,
  `feed_id` int(11) DEFAULT '0',
  `email` tinyint(1) DEFAULT '0',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`memo_id`),
  KEY `memo_type_id` (`memo_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_memo_apply_to` */

DROP TABLE IF EXISTS `ww_memo_apply_to`;

CREATE TABLE `ww_memo_apply_to` (
  `apply_to_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `apply_to` varchar(64) NOT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`apply_to_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_memo_recipient` */

DROP TABLE IF EXISTS `ww_memo_recipient`;

CREATE TABLE `ww_memo_recipient` (
  `memo_id` int(11) DEFAULT NULL,
  `apply_to` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  KEY `memo_id` (`memo_id`,`user_id`,`apply_to`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_memo_type` */

DROP TABLE IF EXISTS `ww_memo_type`;

CREATE TABLE `ww_memo_type` (
  `memo_type_id` int(1) NOT NULL AUTO_INCREMENT,
  `memo_type` varchar(32) NOT NULL,
  `default_template` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`memo_type_id`),
  KEY `memo_type` (`memo_type`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_menu` */

DROP TABLE IF EXISTS `ww_menu`;

CREATE TABLE `ww_menu` (
  `menu_item_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `parent_menu_item_id` int(1) NOT NULL DEFAULT '0',
  `sequence` tinyint(1) DEFAULT '1',
  `label` varchar(64) NOT NULL,
  `icon` varchar(64) DEFAULT 'fa-list',
  `description` text,
  `menu_item_type_id` int(1) DEFAULT '3',
  `mod_id` int(1) DEFAULT '0',
  `uri` text,
  `method` text,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`menu_item_id`),
  KEY `parent_menu_item_id` (`parent_menu_item_id`),
  KEY `label` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_menu_item_type` */

DROP TABLE IF EXISTS `ww_menu_item_type`;

CREATE TABLE `ww_menu_item_type` (
  `menu_item_type_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `menu_item_type` varchar(16) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`menu_item_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_modules` */

DROP TABLE IF EXISTS `ww_modules`;

CREATE TABLE `ww_modules` (
  `mod_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `mod_code` varchar(64) NOT NULL,
  `route` varchar(64) DEFAULT NULL,
  `table` varchar(64) DEFAULT NULL,
  `primary_key` varchar(32) DEFAULT NULL,
  `enable_mass_action` tinyint(1) DEFAULT '1',
  `short_name` varchar(32) NOT NULL,
  `long_name` varchar(64) DEFAULT NULL,
  `icon` varchar(64) DEFAULT NULL,
  `disabled` tinyint(1) DEFAULT '0',
  `wizard_on_new` tinyint(1) DEFAULT '0',
  `description` text,
  `list_template_header` text,
  `list_template` text,
  `sensitivity_filter` tinyint(1) DEFAULT '0',
  `fg_id` int(1) DEFAULT '0',
  `f_id` int(1) DEFAULT '0',
  `parent_group` varchar(64) NOT NULL DEFAULT '',
  `sub_group` varchar(64) NOT NULL DEFAULT '',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`mod_id`),
  KEY `mod_code` (`mod_code`),
  KEY `short_name` (`short_name`),
  KEY `long_name` (`long_name`)
) ENGINE=InnoDB AUTO_INCREMENT=266 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_modules_actions` */

DROP TABLE IF EXISTS `ww_modules_actions`;

CREATE TABLE `ww_modules_actions` (
  `action_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `action` varchar(16) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`action_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_month` */

DROP TABLE IF EXISTS `ww_month`;

CREATE TABLE `ww_month` (
  `month_id` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(16) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`month_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners` */

DROP TABLE IF EXISTS `ww_partners`;

CREATE TABLE `ww_partners` (
  `partner_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `id_number` varchar(16) DEFAULT '',
  `biometric` varchar(16) DEFAULT '',
  `alias` varchar(32) DEFAULT '',
  `status_id` int(1) NOT NULL DEFAULT '2',
  `status` varchar(32) DEFAULT '',
  `job_grade_id` int(11) DEFAULT NULL,
  `v_job_grade` varchar(64) DEFAULT '',
  `employment_type_id` int(1) DEFAULT '6',
  `employment_type` varchar(16) DEFAULT '',
  `classification_id` int(1) DEFAULT NULL,
  `classification` varchar(32) DEFAULT NULL,
  `position_classification_id` int(11) DEFAULT NULL,
  `position_classification` varchar(32) DEFAULT NULL,
  `shift_id` int(1) DEFAULT '0',
  `shift` varchar(32) DEFAULT '',
  `calendar_id` int(11) DEFAULT NULL,
  `calendar` varchar(32) DEFAULT '',
  `credit_setup_id` int(11) DEFAULT '0',
  `original_hired_date` date DEFAULT NULL,
  `effectivity_date` date DEFAULT '0000-00-00',
  `regularization_date` date DEFAULT NULL,
  `resigned_date` date DEFAULT '0000-00-00',
  `employment_end_date` date DEFAULT NULL COMMENT 'end of probationary period or service',
  `blacklisted` int(1) DEFAULT '0',
  `salary` varbinary(255) DEFAULT NULL COMMENT 'this will be use for create 201 from crecuitment only',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`partner_id`),
  KEY `biometric` (`biometric`),
  KEY `id_number` (`id_number`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_accountability` */

DROP TABLE IF EXISTS `ww_partners_accountability`;

CREATE TABLE `ww_partners_accountability` (
  `accountability_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) NOT NULL,
  `item_code` varchar(16) DEFAULT '',
  `item` varchar(128) NOT NULL,
  `tag_no` varchar(16) DEFAULT NULL,
  `status` varchar(32) DEFAULT NULL,
  `issued` date DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `quantity` int(1) DEFAULT NULL,
  `remarks` varchar(128) DEFAULT NULL,
  `returned` date DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`accountability_id`),
  KEY `partner_id` (`partner_id`),
  KEY `item` (`item`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_age_gender` */

DROP TABLE IF EXISTS `ww_partners_age_gender`;

CREATE TABLE `ww_partners_age_gender` (
  `age_gender` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_age_group` */

DROP TABLE IF EXISTS `ww_partners_age_group`;

CREATE TABLE `ww_partners_age_group` (
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `age_group` varchar(16) DEFAULT NULL,
  `age_fr` int(1) DEFAULT '0',
  `age_to` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_civil_status` */

DROP TABLE IF EXISTS `ww_partners_civil_status`;

CREATE TABLE `ww_partners_civil_status` (
  `civil_status_id` int(1) NOT NULL AUTO_INCREMENT,
  `civil_status` varchar(32) NOT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `active` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`civil_status_id`),
  KEY `employment_status` (`civil_status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_classification` */

DROP TABLE IF EXISTS `ww_partners_classification`;

CREATE TABLE `ww_partners_classification` (
  `classification_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `classification` varchar(32) NOT NULL DEFAULT '',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`classification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_clearance` */

DROP TABLE IF EXISTS `ww_partners_clearance`;

CREATE TABLE `ww_partners_clearance` (
  `clearance_id` int(11) NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) NOT NULL,
  `alternate_email` varchar(128) DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT '1',
  `action_id` int(1) DEFAULT NULL COMMENT 'movement action id',
  `effectivity_date` date DEFAULT '0000-00-00',
  `quitclaim_received` tinyint(1) DEFAULT '0',
  `date_approved` datetime DEFAULT NULL,
  `date_cleared` date DEFAULT '0000-00-00',
  `turn_around_time` date DEFAULT '0000-00-00',
  `clearance_layout_id` int(1) DEFAULT NULL,
  `exit_interview_layout_id` int(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`clearance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_clearance_exit_interview_answers` */

DROP TABLE IF EXISTS `ww_partners_clearance_exit_interview_answers`;

CREATE TABLE `ww_partners_clearance_exit_interview_answers` (
  `exit_interview_answers_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `clearance_id` int(11) DEFAULT NULL,
  `exit_interview_layout_item_id` int(11) DEFAULT NULL,
  `item` text,
  `category_id` int(1) DEFAULT NULL,
  `remarks` text,
  `yes_no` tinyint(1) DEFAULT '5',
  `status_id` int(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`exit_interview_answers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_clearance_exit_interview_layout` */

DROP TABLE IF EXISTS `ww_partners_clearance_exit_interview_layout`;

CREATE TABLE `ww_partners_clearance_exit_interview_layout` (
  `exit_interview_layout_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `layout_name` varchar(128) DEFAULT NULL,
  `department_id` varchar(128) DEFAULT '0',
  `company_id` int(11) DEFAULT '0',
  `default` tinyint(1) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`exit_interview_layout_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_clearance_exit_interview_layout_item` */

DROP TABLE IF EXISTS `ww_partners_clearance_exit_interview_layout_item`;

CREATE TABLE `ww_partners_clearance_exit_interview_layout_item` (
  `exit_interview_layout_item_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `exit_interview_layout_id` int(11) DEFAULT NULL,
  `item` varchar(128) DEFAULT NULL,
  `wiht_yes_no` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`exit_interview_layout_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_clearance_exit_interview_layout_item_sub` */

DROP TABLE IF EXISTS `ww_partners_clearance_exit_interview_layout_item_sub`;

CREATE TABLE `ww_partners_clearance_exit_interview_layout_item_sub` (
  `exit_interview_layout_item_sub_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `exit_interview_layout_item_id` int(11) DEFAULT NULL,
  `question` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`exit_interview_layout_item_sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_clearance_exit_interview_layout_item_sub_answer` */

DROP TABLE IF EXISTS `ww_partners_clearance_exit_interview_layout_item_sub_answer`;

CREATE TABLE `ww_partners_clearance_exit_interview_layout_item_sub_answer` (
  `exit_interview_layout_item_sub_answer_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `exit_interview_layout_item_sub_id` int(11) DEFAULT NULL,
  `exit_interview_layout_item_id` int(11) DEFAULT NULL,
  `answer` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`exit_interview_layout_item_sub_answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_clearance_layout` */

DROP TABLE IF EXISTS `ww_partners_clearance_layout`;

CREATE TABLE `ww_partners_clearance_layout` (
  `clearance_layout_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `layout_name` varchar(128) DEFAULT NULL,
  `department_id` varchar(128) NOT NULL DEFAULT '0',
  `company_id` int(11) DEFAULT '0',
  `default` tinyint(1) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`clearance_layout_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_clearance_layout_sign` */

DROP TABLE IF EXISTS `ww_partners_clearance_layout_sign`;

CREATE TABLE `ww_partners_clearance_layout_sign` (
  `clearance_layout_sign_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `clearance_layout_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `panel_title` varchar(128) DEFAULT NULL,
  `is_immediate` tinyint(1) DEFAULT '0',
  `item_description` varchar(128) DEFAULT NULL,
  `properties_tagging` tinyint(1) DEFAULT '0' COMMENT '1 = head office, 0 = other properties',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`clearance_layout_sign_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_clearance_signatories` */

DROP TABLE IF EXISTS `ww_partners_clearance_signatories`;

CREATE TABLE `ww_partners_clearance_signatories` (
  `clearance_signatories_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `clearance_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `panel_title` varchar(128) DEFAULT NULL,
  `clearance_layout_sign_id` int(11) DEFAULT NULL,
  `category_id` int(1) DEFAULT NULL,
  `remarks` text,
  `attachments` varchar(128) DEFAULT NULL,
  `date_cleared` date DEFAULT NULL,
  `status_id` int(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`clearance_signatories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_clearance_signatories_accountabilities` */

DROP TABLE IF EXISTS `ww_partners_clearance_signatories_accountabilities`;

CREATE TABLE `ww_partners_clearance_signatories_accountabilities` (
  `clearance_accountability_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `clearance_signatories_id` int(11) DEFAULT NULL,
  `accountability` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`clearance_accountability_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_clearance_signatories_attachment` */

DROP TABLE IF EXISTS `ww_partners_clearance_signatories_attachment`;

CREATE TABLE `ww_partners_clearance_signatories_attachment` (
  `clearance_signatories_attachement_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `clearance_signatories_id` int(11) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '0' COMMENT '0 = admin, 1 for signatories',
  `attachments` varchar(128) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`clearance_signatories_attachement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_clearance_signatory` */

DROP TABLE IF EXISTS `ww_partners_clearance_signatory`;

CREATE TABLE `ww_partners_clearance_signatory` (
  `signatory_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `accountability_id` int(11) NOT NULL DEFAULT '0',
  `partner_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  `signatory` varchar(64) DEFAULT NULL,
  `status_id` int(1) DEFAULT '0',
  `status` varchar(16) DEFAULT NULL,
  `remarks` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`signatory_id`),
  KEY `accountability_id` (`accountability_id`),
  KEY `partner_id` (`partner_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_clearance_status` */

DROP TABLE IF EXISTS `ww_partners_clearance_status`;

CREATE TABLE `ww_partners_clearance_status` (
  `status_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(16) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_clinic_records` */

DROP TABLE IF EXISTS `ww_partners_clinic_records`;

CREATE TABLE `ww_partners_clinic_records` (
  `clinic_records_id` int(11) NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) NOT NULL,
  `medication` varchar(255) DEFAULT NULL,
  `medication_qty` varchar(255) DEFAULT NULL,
  `complaint` varchar(255) DEFAULT NULL,
  `diagnosis` varchar(255) DEFAULT NULL,
  `other_med_cost` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `attachments` varchar(128) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  PRIMARY KEY (`clinic_records_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_disciplinary_action` */

DROP TABLE IF EXISTS `ww_partners_disciplinary_action`;

CREATE TABLE `ww_partners_disciplinary_action` (
  `disciplinary_action_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `incident_id` int(11) NOT NULL,
  `sanction_id` int(11) DEFAULT NULL,
  `date_from` date NOT NULL DEFAULT '0000-00-00',
  `date_to` date DEFAULT '0000-00-00',
  `suspension_days` int(11) DEFAULT NULL,
  `damages_payment` varchar(128) DEFAULT NULL,
  `remarks` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`disciplinary_action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_employment_status` */

DROP TABLE IF EXISTS `ww_partners_employment_status`;

CREATE TABLE `ww_partners_employment_status` (
  `employment_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `employment_status` varchar(32) NOT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `active` tinyint(1) DEFAULT '1',
  `movement` tinyint(1) DEFAULT '0',
  `application` tinyint(1) DEFAULT '1',
  `color` varchar(6) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`employment_status_id`),
  KEY `employment_status` (`employment_status`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_employment_type` */

DROP TABLE IF EXISTS `ww_partners_employment_type`;

CREATE TABLE `ww_partners_employment_type` (
  `employment_type_id` int(1) NOT NULL AUTO_INCREMENT,
  `employment_type` varchar(32) NOT NULL DEFAULT '',
  `active` tinyint(1) DEFAULT '1',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`employment_type_id`),
  KEY `employment_type` (`employment_type`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_family_relationship` */

DROP TABLE IF EXISTS `ww_partners_family_relationship`;

CREATE TABLE `ww_partners_family_relationship` (
  `family_relationship_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `family_relationship` varchar(32) DEFAULT NULL,
  `child` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`family_relationship_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_grade` */

DROP TABLE IF EXISTS `ww_partners_grade`;

CREATE TABLE `ww_partners_grade` (
  `grade_id` int(11) NOT NULL AUTO_INCREMENT,
  `grade` varchar(12) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  KEY `grade_id` (`grade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_health_records` */

DROP TABLE IF EXISTS `ww_partners_health_records`;

CREATE TABLE `ww_partners_health_records` (
  `health_id` int(11) NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) NOT NULL,
  `health_type_id` int(1) NOT NULL,
  `health_provider` varchar(64) NOT NULL,
  `date_of_completion` date NOT NULL,
  `health_type_status_id` int(1) NOT NULL,
  `attachments` varchar(64) DEFAULT NULL,
  `findings` text,
  `diagnosis` text,
  `recommendation` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`health_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_health_type` */

DROP TABLE IF EXISTS `ww_partners_health_type`;

CREATE TABLE `ww_partners_health_type` (
  `health_type_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `health_type` varchar(64) CHARACTER SET latin1 NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`health_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_health_type_status` */

DROP TABLE IF EXISTS `ww_partners_health_type_status`;

CREATE TABLE `ww_partners_health_type_status` (
  `health_type_status_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `health_type_status` varchar(64) CHARACTER SET latin1 NOT NULL,
  `ape` tinyint(1) DEFAULT '0',
  `preemp` tinyint(1) DEFAULT '0',
  `others` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`health_type_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_id_config` */

DROP TABLE IF EXISTS `ww_partners_id_config`;

CREATE TABLE `ww_partners_id_config` (
  `config_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `config` enum('Custom','Year','Month','Day','Series') NOT NULL,
  `sequence` tinyint(1) DEFAULT '1',
  `variable` varchar(32) DEFAULT NULL,
  `length` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_incident` */

DROP TABLE IF EXISTS `ww_partners_incident`;

CREATE TABLE `ww_partners_incident` (
  `incident_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `involved_partners` varchar(128) DEFAULT NULL,
  `offense_id` int(11) DEFAULT NULL,
  `complainants` varchar(128) DEFAULT NULL,
  `date_time_of_offense` datetime DEFAULT '0000-00-00 00:00:00',
  `attachments` varchar(128) DEFAULT NULL,
  `witnesses` varchar(128) DEFAULT NULL,
  `location` varchar(128) DEFAULT NULL,
  `violation_details` text,
  `damages` text,
  `incident_status_id` int(11) DEFAULT NULL,
  `status` enum('Open','Close') DEFAULT 'Open',
  `date_sent` datetime DEFAULT '0000-00-00 00:00:00',
  `hr_remarks` text,
  `nte_partner` tinyint(1) DEFAULT '1',
  `nte_immediate` tinyint(1) DEFAULT '0',
  `nte_witnesses` tinyint(1) DEFAULT '0',
  `nte_complainants` tinyint(1) DEFAULT '0',
  `nte_others` tinyint(1) DEFAULT '0',
  `hearing_partner` tinyint(1) DEFAULT NULL,
  `hearing_immediate` tinyint(1) DEFAULT NULL,
  `hearing_witnesses` tinyint(1) DEFAULT NULL,
  `hearing_complainants` tinyint(1) DEFAULT NULL,
  `hearing_others` tinyint(1) DEFAULT NULL,
  `cancel_remarks` tinytext,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`incident_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_incident_approver` */

DROP TABLE IF EXISTS `ww_partners_incident_approver`;

CREATE TABLE `ww_partners_incident_approver` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `incident_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(64) CHARACTER SET latin1 DEFAULT '',
  `condition` enum('ALL','By Level','Either Of') DEFAULT 'By Level',
  `sequence` tinyint(1) DEFAULT '1',
  `incident_status_id` int(1) DEFAULT '0',
  `incident_status` varchar(16) DEFAULT '',
  `comment_date` datetime DEFAULT '0000-00-00 00:00:00',
  `comment` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `incident_user` (`incident_id`,`user_id`,`sequence`),
  KEY `incident_id` (`incident_id`),
  KEY `user_id` (`user_id`),
  KEY `sequence` (`sequence`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_incident_hearing` */

DROP TABLE IF EXISTS `ww_partners_incident_hearing`;

CREATE TABLE `ww_partners_incident_hearing` (
  `incident_nte_id` int(11) NOT NULL AUTO_INCREMENT,
  `incident_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category` enum('partner','immediate','witness','complainants','others') NOT NULL,
  `explanation` text,
  `attachments` varchar(128) DEFAULT NULL,
  `nte_status_id` int(1) DEFAULT '0',
  `hearing_date` datetime DEFAULT '0000-00-00 00:00:00',
  `hr_remarks` text,
  PRIMARY KEY (`incident_nte_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_incident_immediate` */

DROP TABLE IF EXISTS `ww_partners_incident_immediate`;

CREATE TABLE `ww_partners_incident_immediate` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `incident_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(64) CHARACTER SET latin1 DEFAULT '',
  `condition` enum('ALL','By Level','Either Of') DEFAULT 'By Level',
  `sequence` tinyint(1) DEFAULT '1',
  `incident_status_id` int(1) DEFAULT '0',
  `incident_status` varchar(16) DEFAULT '',
  `comment_date` datetime DEFAULT '0000-00-00 00:00:00',
  `comment` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `incident_user` (`incident_id`,`user_id`,`sequence`),
  KEY `incident_id` (`incident_id`),
  KEY `user_id` (`user_id`),
  KEY `sequence` (`sequence`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_incident_nte` */

DROP TABLE IF EXISTS `ww_partners_incident_nte`;

CREATE TABLE `ww_partners_incident_nte` (
  `incident_nte_id` int(11) NOT NULL AUTO_INCREMENT,
  `incident_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category` enum('partner','immediate','witness','complainants','others') NOT NULL,
  `explanation` text,
  `attachments` varchar(128) DEFAULT NULL,
  `nte_status_id` int(1) DEFAULT '0',
  `hearing_date` datetime DEFAULT '0000-00-00 00:00:00',
  `hr_remarks` text,
  PRIMARY KEY (`incident_nte_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_incident_status` */

DROP TABLE IF EXISTS `ww_partners_incident_status`;

CREATE TABLE `ww_partners_incident_status` (
  `incident_status_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `incident_status` varchar(64) NOT NULL DEFAULT '',
  `color` varchar(8) DEFAULT '#ffffff',
  `description` tinytext,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`incident_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_key` */

DROP TABLE IF EXISTS `ww_partners_key`;

CREATE TABLE `ww_partners_key` (
  `key_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `key_code` varchar(32) NOT NULL,
  `key_label` varchar(128) DEFAULT NULL,
  `key_class_id` int(1) DEFAULT '0',
  `key_type_id` int(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`key_id`),
  KEY `transaction_code` (`key_code`),
  KEY `transaction_class_id` (`key_class_id`),
  KEY `transaction_type_id` (`key_type_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=214 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_key_class` */

DROP TABLE IF EXISTS `ww_partners_key_class`;

CREATE TABLE `ww_partners_key_class` (
  `key_class_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `key_class_code` varchar(32) NOT NULL,
  `key_class` varchar(128) NOT NULL,
  `user_view` tinyint(1) DEFAULT '1',
  `user_edit` tinyint(1) DEFAULT '0',
  `for_approval` tinyint(1) DEFAULT '0',
  `sort_order` int(1) unsigned DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`key_class_id`),
  KEY `transaction_class_code` (`key_class_code`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_loan_application` */

DROP TABLE IF EXISTS `ww_partners_loan_application`;

CREATE TABLE `ww_partners_loan_application` (
  `loan_application_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `loan_application_status_id` tinyint(1) NOT NULL DEFAULT '0',
  `loan_type_id` int(1) NOT NULL DEFAULT '0',
  `loan_type_code` varchar(8) DEFAULT '',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(64) DEFAULT '',
  `date_approved` datetime DEFAULT '0000-00-00 00:00:00',
  `date_declined` datetime DEFAULT '0000-00-00 00:00:00',
  `date_cancelled` datetime DEFAULT '0000-00-00 00:00:00',
  `date_sent` datetime DEFAULT '0000-00-00 00:00:00',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`loan_application_id`),
  KEY `form_id` (`loan_type_id`),
  KEY `user_id` (`user_id`),
  KEY `deleted` (`deleted`),
  KEY `created_on` (`created_on`),
  KEY `forms_status_id` (`loan_application_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_loan_application_approver` */

DROP TABLE IF EXISTS `ww_partners_loan_application_approver`;

CREATE TABLE `ww_partners_loan_application_approver` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `loan_application_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(64) CHARACTER SET latin1 DEFAULT '',
  `condition` enum('ALL','By Level','Either Of') DEFAULT 'By Level',
  `sequence` tinyint(1) DEFAULT '1',
  `loan_application_status_id` int(1) DEFAULT '0',
  `loan_application_status` varchar(16) DEFAULT '',
  `comment_date` datetime DEFAULT '0000-00-00 00:00:00',
  `comment` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `forms_user` (`loan_application_id`,`user_id`,`sequence`),
  KEY `forms_id` (`loan_application_id`),
  KEY `user_id` (`user_id`),
  KEY `sequence` (`sequence`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_loan_application_car` */

DROP TABLE IF EXISTS `ww_partners_loan_application_car`;

CREATE TABLE `ww_partners_loan_application_car` (
  `loan_application_mobile_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `loan_application_id` tinyint(1) NOT NULL DEFAULT '0',
  `loan_application_car_entitlement_id` int(11) DEFAULT NULL,
  `year_model` decimal(10,0) DEFAULT NULL,
  `loan_amount` varbinary(255) DEFAULT NULL,
  `car_type` varchar(255) DEFAULT NULL,
  `amortization` enum('Monthly','Semi-monthly') DEFAULT NULL,
  `pay_period_from` date DEFAULT NULL,
  `pay_period_to` date DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`loan_application_mobile_id`),
  KEY `deleted` (`deleted`),
  KEY `created_on` (`created_on`),
  KEY `forms_status_id` (`loan_application_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_loan_application_car_amortization` */

DROP TABLE IF EXISTS `ww_partners_loan_application_car_amortization`;

CREATE TABLE `ww_partners_loan_application_car_amortization` (
  `loan_application_car_amortization_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `loan_application_car_amortization` varchar(100) NOT NULL DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`loan_application_car_amortization_id`),
  KEY `deleted` (`deleted`),
  KEY `created_on` (`created_on`),
  KEY `forms_status_id` (`loan_application_car_amortization`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_loan_application_car_entitlement` */

DROP TABLE IF EXISTS `ww_partners_loan_application_car_entitlement`;

CREATE TABLE `ww_partners_loan_application_car_entitlement` (
  `loan_application_car_entitlement_id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_application_car_entitlement` varchar(100) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`loan_application_car_entitlement_id`),
  KEY `deleted` (`deleted`),
  KEY `created_on` (`created_on`),
  KEY `forms_status_id` (`loan_application_car_entitlement`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_loan_application_mobile` */

DROP TABLE IF EXISTS `ww_partners_loan_application_mobile`;

CREATE TABLE `ww_partners_loan_application_mobile` (
  `loan_application_mobile_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `loan_application_id` tinyint(1) NOT NULL DEFAULT '0',
  `loan_application_mobile_enrollment_type_id` int(11) DEFAULT NULL,
  `loan_application_mobile_plan_limit_id` int(11) DEFAULT NULL,
  `loan_application_mobile_special_feature_id` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`loan_application_mobile_id`),
  KEY `deleted` (`deleted`),
  KEY `created_on` (`created_on`),
  KEY `forms_status_id` (`loan_application_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_loan_application_mobile_enrollment_type` */

DROP TABLE IF EXISTS `ww_partners_loan_application_mobile_enrollment_type`;

CREATE TABLE `ww_partners_loan_application_mobile_enrollment_type` (
  `loan_application_mobile_enrollment_type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `loan_application_mobile_enrollment_type` varchar(255) NOT NULL DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`loan_application_mobile_enrollment_type_id`),
  KEY `deleted` (`deleted`),
  KEY `created_on` (`created_on`),
  KEY `forms_status_id` (`loan_application_mobile_enrollment_type`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_loan_application_mobile_plan_limit` */

DROP TABLE IF EXISTS `ww_partners_loan_application_mobile_plan_limit`;

CREATE TABLE `ww_partners_loan_application_mobile_plan_limit` (
  `loan_application_mobile_plan_limit_id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_application_mobile_plan_limit` varchar(255) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`loan_application_mobile_plan_limit_id`),
  KEY `deleted` (`deleted`),
  KEY `created_on` (`created_on`),
  KEY `forms_status_id` (`loan_application_mobile_plan_limit`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_loan_application_mobile_special_feature` */

DROP TABLE IF EXISTS `ww_partners_loan_application_mobile_special_feature`;

CREATE TABLE `ww_partners_loan_application_mobile_special_feature` (
  `loan_application_mobile_special_feature_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `loan_application_mobile_special_feature` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`loan_application_mobile_special_feature_id`),
  KEY `deleted` (`deleted`),
  KEY `created_on` (`created_on`),
  KEY `forms_status_id` (`loan_application_mobile_special_feature`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_loan_application_omnibus` */

DROP TABLE IF EXISTS `ww_partners_loan_application_omnibus`;

CREATE TABLE `ww_partners_loan_application_omnibus` (
  `loan_application_omnibus_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `loan_application_id` tinyint(1) NOT NULL DEFAULT '0',
  `loan_amount` varbinary(255) DEFAULT NULL,
  `loan_purposes` text,
  `loan_terms` int(11) DEFAULT NULL,
  `loan_start_amortization` varbinary(255) DEFAULT NULL,
  `loan_deduction_start` date DEFAULT NULL,
  `loan_deduction_end` date DEFAULT NULL,
  `loan_amount_to_deduct` varbinary(255) DEFAULT NULL,
  `loan_amount_to_deduct_per_day` varbinary(255) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`loan_application_omnibus_id`),
  KEY `deleted` (`deleted`),
  KEY `created_on` (`created_on`),
  KEY `forms_status_id` (`loan_application_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_loan_application_status` */

DROP TABLE IF EXISTS `ww_partners_loan_application_status`;

CREATE TABLE `ww_partners_loan_application_status` (
  `loan_application_status_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `loan_application_status` varchar(16) NOT NULL DEFAULT '',
  `color` varchar(8) DEFAULT '#ffffff',
  `description` tinytext,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`loan_application_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18446744073709551615 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_loan_type` */

DROP TABLE IF EXISTS `ww_partners_loan_type`;

CREATE TABLE `ww_partners_loan_type` (
  `loan_type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `loan_type_code` varchar(8) NOT NULL,
  `loan_type` varchar(32) NOT NULL,
  `class` varchar(32) DEFAULT 'fa fa-square-o',
  `description` text,
  `order_by` int(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`loan_type_id`),
  KEY `form_code` (`loan_type_code`),
  KEY `form` (`loan_type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_movement` */

DROP TABLE IF EXISTS `ww_partners_movement`;

CREATE TABLE `ww_partners_movement` (
  `movement_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status_id` int(1) NOT NULL DEFAULT '1',
  `due_to_id` int(1) NOT NULL DEFAULT '0',
  `photo` varchar(150) DEFAULT NULL,
  `remarks` text,
  `remarks_print_report_id` int(11) DEFAULT NULL,
  `date_approved` date DEFAULT NULL,
  `date_declined` date DEFAULT NULL,
  `hr_reviewed_by` int(11) DEFAULT NULL,
  `hrd_remarks` text,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`movement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_movement_action` */

DROP TABLE IF EXISTS `ww_partners_movement_action`;

CREATE TABLE `ww_partners_movement_action` (
  `action_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `movement_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT '0',
  `display_name` varchar(64) DEFAULT NULL,
  `effectivity_date` date NOT NULL,
  `type_id` int(1) NOT NULL DEFAULT '0',
  `type` varchar(64) DEFAULT NULL,
  `type_category_id` int(11) DEFAULT NULL,
  `type_category` varchar(64) DEFAULT NULL,
  `remarks` text,
  `remarks_print_report_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status_id` int(1) DEFAULT '7',
  `grade` decimal(5,3) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`action_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_movement_action_additional_allowance` */

DROP TABLE IF EXISTS `ww_partners_movement_action_additional_allowance`;

CREATE TABLE `ww_partners_movement_action_additional_allowance` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `action_id` int(11) NOT NULL DEFAULT '0',
  `movement_id` int(1) NOT NULL DEFAULT '0',
  `transaction_id` int(1) DEFAULT '0',
  `transaction_label` varchar(64) DEFAULT NULL,
  `from_allowance` float(12,2) DEFAULT NULL,
  `to_allowance` float(12,2) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_movement_action_attachment` */

DROP TABLE IF EXISTS `ww_partners_movement_action_attachment`;

CREATE TABLE `ww_partners_movement_action_attachment` (
  `movement_attachment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `action_id` int(11) NOT NULL DEFAULT '0',
  `movement_id` int(1) NOT NULL DEFAULT '0',
  `type` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `size` varchar(30) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`movement_attachment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_movement_action_compensation` */

DROP TABLE IF EXISTS `ww_partners_movement_action_compensation`;

CREATE TABLE `ww_partners_movement_action_compensation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `action_id` int(11) NOT NULL DEFAULT '0',
  `movement_id` int(1) NOT NULL DEFAULT '0',
  `type_name` varchar(64) DEFAULT NULL,
  `current_salary` float(12,2) DEFAULT NULL,
  `to_salary` float(12,2) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_movement_action_extension` */

DROP TABLE IF EXISTS `ww_partners_movement_action_extension`;

CREATE TABLE `ww_partners_movement_action_extension` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `action_id` int(11) NOT NULL DEFAULT '0',
  `movement_id` int(1) NOT NULL DEFAULT '0',
  `no_of_months` int(1) NOT NULL DEFAULT '0',
  `end_date` date DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_movement_action_leave_credits` */

DROP TABLE IF EXISTS `ww_partners_movement_action_leave_credits`;

CREATE TABLE `ww_partners_movement_action_leave_credits` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `action_id` int(11) NOT NULL DEFAULT '0',
  `movement_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(1) NOT NULL DEFAULT '0',
  `year` int(1) DEFAULT '0',
  `pro_rated` tinyint(1) DEFAULT '0',
  `credit` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_movement_action_moving` */

DROP TABLE IF EXISTS `ww_partners_movement_action_moving`;

CREATE TABLE `ww_partners_movement_action_moving` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `action_id` int(11) NOT NULL DEFAULT '0',
  `movement_id` int(1) NOT NULL DEFAULT '0',
  `blacklisted` tinyint(1) DEFAULT '0',
  `end_date` date DEFAULT NULL,
  `reason_id` int(1) DEFAULT '0',
  `further_reason` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_movement_action_transfer` */

DROP TABLE IF EXISTS `ww_partners_movement_action_transfer`;

CREATE TABLE `ww_partners_movement_action_transfer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `action_id` int(11) NOT NULL DEFAULT '0',
  `movement_id` int(1) NOT NULL DEFAULT '0',
  `field_id` int(1) DEFAULT '0',
  `field_name` varchar(64) DEFAULT NULL,
  `from_id` int(11) DEFAULT '0',
  `to_id` int(11) DEFAULT '0',
  `from_name` varchar(128) DEFAULT NULL,
  `to_name` varchar(128) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_movement_approver` */

DROP TABLE IF EXISTS `ww_partners_movement_approver`;

CREATE TABLE `ww_partners_movement_approver` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `movement_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(64) CHARACTER SET latin1 DEFAULT '',
  `condition` enum('ALL','By Level','Either Of') DEFAULT 'By Level',
  `sequence` tinyint(1) DEFAULT '1',
  `movement_status_id` int(1) DEFAULT '0',
  `movement_status` varchar(16) DEFAULT '',
  `comment_date` datetime DEFAULT '0000-00-00 00:00:00',
  `comment` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `forms_user` (`movement_id`,`user_id`,`sequence`),
  KEY `forms_id` (`movement_id`),
  KEY `user_id` (`user_id`),
  KEY `sequence` (`sequence`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_movement_approver_hr` */

DROP TABLE IF EXISTS `ww_partners_movement_approver_hr`;

CREATE TABLE `ww_partners_movement_approver_hr` (
  `approver_hr_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `movement_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(64) CHARACTER SET latin1 DEFAULT '',
  `sequence` tinyint(1) DEFAULT '1',
  `movement_status_id` int(1) DEFAULT '0',
  `movement_status` varchar(16) DEFAULT '',
  `comment_date` datetime DEFAULT NULL,
  `comment` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`approver_hr_id`),
  UNIQUE KEY `forms_user` (`movement_id`,`user_id`,`sequence`),
  KEY `forms_id` (`movement_id`),
  KEY `user_id` (`user_id`),
  KEY `sequence` (`sequence`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_movement_cause` */

DROP TABLE IF EXISTS `ww_partners_movement_cause`;

CREATE TABLE `ww_partners_movement_cause` (
  `cause_id` int(11) NOT NULL AUTO_INCREMENT,
  `cause` varchar(32) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`cause_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_movement_fields` */

DROP TABLE IF EXISTS `ww_partners_movement_fields`;

CREATE TABLE `ww_partners_movement_fields` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(32) NOT NULL,
  `field_label` varchar(32) DEFAULT NULL,
  `table_name` varchar(64) DEFAULT NULL,
  `from_to` tinyint(1) DEFAULT '1',
  `orderby` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`field_id`,`field_name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_movement_reason` */

DROP TABLE IF EXISTS `ww_partners_movement_reason`;

CREATE TABLE `ww_partners_movement_reason` (
  `reason_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `reason` varchar(128) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`reason_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_movement_remarks` */

DROP TABLE IF EXISTS `ww_partners_movement_remarks`;

CREATE TABLE `ww_partners_movement_remarks` (
  `remarks_print_report_id` int(11) NOT NULL AUTO_INCREMENT,
  `remarks_print_report` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`remarks_print_report_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_movement_status` */

DROP TABLE IF EXISTS `ww_partners_movement_status`;

CREATE TABLE `ww_partners_movement_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(20) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_movement_type` */

DROP TABLE IF EXISTS `ww_partners_movement_type`;

CREATE TABLE `ww_partners_movement_type` (
  `type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_code` varchar(64) NOT NULL,
  `type` varchar(128) CHARACTER SET latin1 NOT NULL,
  `can_view` tinyint(1) DEFAULT '1',
  `can_delete` tinyint(1) DEFAULT '1',
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`type_id`),
  KEY `deleted` (`deleted`),
  KEY `movement_type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_movement_type_category` */

DROP TABLE IF EXISTS `ww_partners_movement_type_category`;

CREATE TABLE `ww_partners_movement_type_category` (
  `type_category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_category` varchar(128) CHARACTER SET latin1 NOT NULL,
  `can_view` tinyint(1) DEFAULT '1',
  `can_delete` tinyint(1) DEFAULT '1',
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`type_category_id`),
  KEY `deleted` (`deleted`),
  KEY `movement_type` (`type_category`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_offense` */

DROP TABLE IF EXISTS `ww_partners_offense`;

CREATE TABLE `ww_partners_offense` (
  `offense_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `offense_category_id` int(1) DEFAULT '0',
  `offense_level_id` int(1) DEFAULT '0',
  `offense` text,
  `sanction_id` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`offense_id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_offense_category` */

DROP TABLE IF EXISTS `ww_partners_offense_category`;

CREATE TABLE `ww_partners_offense_category` (
  `offense_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `offense_category` varchar(128) DEFAULT NULL,
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '0',
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`offense_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_offense_level` */

DROP TABLE IF EXISTS `ww_partners_offense_level`;

CREATE TABLE `ww_partners_offense_level` (
  `offense_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `offense_level` varchar(32) DEFAULT NULL,
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '0',
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`offense_level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_offense_sanction` */

DROP TABLE IF EXISTS `ww_partners_offense_sanction`;

CREATE TABLE `ww_partners_offense_sanction` (
  `sanction_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sanction_category_id` int(11) DEFAULT '0',
  `offense_level_id` int(1) DEFAULT '0',
  `sanction` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`sanction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_offense_sanction_category` */

DROP TABLE IF EXISTS `ww_partners_offense_sanction_category`;

CREATE TABLE `ww_partners_offense_sanction_category` (
  `offense_sanction_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `offense_sanction_category` varchar(255) DEFAULT NULL,
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`offense_sanction_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_personal` */

DROP TABLE IF EXISTS `ww_partners_personal`;

CREATE TABLE `ww_partners_personal` (
  `personal_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) NOT NULL DEFAULT '0',
  `key_id` int(1) DEFAULT '0',
  `key` varchar(32) NOT NULL,
  `sequence` tinyint(1) DEFAULT '1',
  `key_name` varchar(64) NOT NULL,
  `key_value` text,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`personal_id`),
  UNIQUE KEY `partner_key` (`partner_id`,`sequence`,`key`),
  KEY `partner_id` (`partner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_personal_approver` */

DROP TABLE IF EXISTS `ww_partners_personal_approver`;

CREATE TABLE `ww_partners_personal_approver` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `personal_request_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(64) CHARACTER SET latin1 DEFAULT '',
  `condition` enum('ALL','By Level','Either Of') DEFAULT 'By Level',
  `sequence` tinyint(1) DEFAULT '1',
  `personal_request_status_id` int(1) DEFAULT '0',
  `personal_request_status` varchar(16) DEFAULT '',
  `comment_date` datetime DEFAULT '0000-00-00 00:00:00',
  `comment` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `forms_user` (`personal_request_id`,`user_id`,`sequence`),
  KEY `forms_id` (`personal_request_id`),
  KEY `user_id` (`user_id`),
  KEY `sequence` (`sequence`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_personal_history` */

DROP TABLE IF EXISTS `ww_partners_personal_history`;

CREATE TABLE `ww_partners_personal_history` (
  `personal_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) NOT NULL DEFAULT '0',
  `key` varchar(32) NOT NULL,
  `sequence` int(1) DEFAULT '1',
  `key_id` int(1) NOT NULL DEFAULT '0',
  `key_name` varchar(64) NOT NULL,
  `key_value` text,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  PRIMARY KEY (`personal_id`),
  UNIQUE KEY `partner_key` (`partner_id`,`sequence`,`key`),
  KEY `partner_id` (`partner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=734 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_personal_request` */

DROP TABLE IF EXISTS `ww_partners_personal_request`;

CREATE TABLE `ww_partners_personal_request` (
  `personal_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) NOT NULL DEFAULT '0',
  `key_id` int(1) DEFAULT '0',
  `key` varchar(32) NOT NULL,
  `sequence` tinyint(1) DEFAULT '1',
  `key_name` varchar(64) NOT NULL,
  `key_value` text,
  `status` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`personal_id`),
  KEY `partner_id` (`partner_id`),
  KEY `partner_key` (`partner_id`,`key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_personal_request_status` */

DROP TABLE IF EXISTS `ww_partners_personal_request_status`;

CREATE TABLE `ww_partners_personal_request_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(16) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_safe_manhour` */

DROP TABLE IF EXISTS `ww_partners_safe_manhour`;

CREATE TABLE `ww_partners_safe_manhour` (
  `safe_manhour_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) NOT NULL,
  `nature_id` int(1) DEFAULT NULL,
  `health_provider` varchar(64) CHARACTER SET latin1 DEFAULT NULL,
  `total_manhour` decimal(10,2) DEFAULT '0.00',
  `date_incident` date DEFAULT NULL,
  `date_return_to_work` date DEFAULT NULL,
  `status_id` int(1) DEFAULT NULL,
  `medication` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `medication_qty` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `details` text CHARACTER SET latin1,
  `attachment` varchar(128) CHARACTER SET latin1 DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`safe_manhour_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_safe_manhour_nature` */

DROP TABLE IF EXISTS `ww_partners_safe_manhour_nature`;

CREATE TABLE `ww_partners_safe_manhour_nature` (
  `nature_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `nature` varchar(32) CHARACTER SET latin1 DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`nature_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_partners_safe_manhour_status` */

DROP TABLE IF EXISTS `ww_partners_safe_manhour_status`;

CREATE TABLE `ww_partners_safe_manhour_status` (
  `status_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(32) CHARACTER SET latin1 NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_account` */

DROP TABLE IF EXISTS `ww_payroll_account`;

CREATE TABLE `ww_payroll_account` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_code` varchar(32) CHARACTER SET latin1 NOT NULL,
  `account_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `account_type_id` int(11) NOT NULL DEFAULT '2',
  `arrangement` varchar(3) DEFAULT NULL,
  `description` text,
  `cond` varchar(32) DEFAULT NULL,
  `department_breakdown` tinyint(1) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`account_id`),
  KEY `account_code` (`account_code`,`arrangement`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_account_category` */

DROP TABLE IF EXISTS `ww_payroll_account_category`;

CREATE TABLE `ww_payroll_account_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(32) NOT NULL,
  `description` text,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_account_sub` */

DROP TABLE IF EXISTS `ww_payroll_account_sub`;

CREATE TABLE `ww_payroll_account_sub` (
  `account_sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_code` varchar(32) DEFAULT NULL,
  `account_sub_code` varchar(32) NOT NULL,
  `account_sub` varchar(128) NOT NULL,
  `account_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `category_val_id` int(11) DEFAULT NULL,
  `category_value` varchar(64) DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT '0',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`account_sub_id`),
  KEY `account_category` (`account_id`,`category_val_id`,`sub_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=842 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_account_subaccount` */

DROP TABLE IF EXISTS `ww_payroll_account_subaccount`;

CREATE TABLE `ww_payroll_account_subaccount` (
  `subaccount_id` int(11) NOT NULL AUTO_INCREMENT,
  `subaccount_code` varchar(32) NOT NULL,
  `subaccount` varchar(128) NOT NULL,
  `account_id` int(11) NOT NULL,
  `account_code` varchar(32) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `category_val_id` int(11) DEFAULT NULL,
  `category_value` varchar(64) DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT '0',
  `sub_group_id` int(11) DEFAULT '0',
  `remarks` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`subaccount_id`),
  KEY `account_category` (`account_id`,`category_val_id`,`sub_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1543 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_account_type` */

DROP TABLE IF EXISTS `ww_payroll_account_type`;

CREATE TABLE `ww_payroll_account_type` (
  `account_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_type` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`account_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_annual_tax` */

DROP TABLE IF EXISTS `ww_payroll_annual_tax`;

CREATE TABLE `ww_payroll_annual_tax` (
  `annual_tax_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `salary_from` decimal(10,2) NOT NULL,
  `salary_to` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `rate` decimal(6,2) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`annual_tax_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_annual_tax_new` */

DROP TABLE IF EXISTS `ww_payroll_annual_tax_new`;

CREATE TABLE `ww_payroll_annual_tax_new` (
  `annual_tax_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `salary_from` decimal(10,2) NOT NULL,
  `salary_to` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `rate` decimal(6,2) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`annual_tax_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_annual_tax_old` */

DROP TABLE IF EXISTS `ww_payroll_annual_tax_old`;

CREATE TABLE `ww_payroll_annual_tax_old` (
  `annual_tax_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `salary_from` decimal(10,2) NOT NULL,
  `salary_to` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `rate` decimal(6,2) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`annual_tax_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_apply_to` */

DROP TABLE IF EXISTS `ww_payroll_apply_to`;

CREATE TABLE `ww_payroll_apply_to` (
  `apply_to_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `apply_to` varchar(64) NOT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`apply_to_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_bank` */

DROP TABLE IF EXISTS `ww_payroll_bank`;

CREATE TABLE `ww_payroll_bank` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_type` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `bank_code_numeric` varchar(20) CHARACTER SET latin1 NOT NULL,
  `bank_code_alpha` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `bank` varchar(50) CHARACTER SET latin1 NOT NULL,
  `account_name` varchar(128) CHARACTER SET latin1 DEFAULT NULL,
  `account_no` varchar(128) CHARACTER SET latin1 DEFAULT NULL,
  `batch_no` int(5) DEFAULT '0',
  `ceiling_amount` decimal(12,2) DEFAULT '0.00',
  `branch_code` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `description` text CHARACTER SET latin1,
  `address` text,
  `address_2` text,
  `branch_officer` varchar(64) DEFAULT NULL,
  `branch_position` varchar(64) DEFAULT NULL,
  `signatory_1` varchar(64) DEFAULT NULL,
  `signatory_2` varchar(64) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_bir` */

DROP TABLE IF EXISTS `ww_payroll_bir`;

CREATE TABLE `ww_payroll_bir` (
  `user_id` int(11) DEFAULT NULL,
  `id_number` varchar(16) DEFAULT NULL,
  `pay_year` int(1) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `middlename` varchar(30) DEFAULT NULL,
  `suffix` varchar(4) DEFAULT NULL,
  `tin` varchar(255) DEFAULT NULL,
  `location` varchar(30) NOT NULL DEFAULT '',
  `employed_date` date DEFAULT NULL,
  `resigned_date` date DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `civil_status_id` int(11) DEFAULT NULL,
  `depend` int(11) DEFAULT NULL,
  `exempt` decimal(12,2) DEFAULT '0.00',
  `exempt_code` varchar(3) DEFAULT NULL,
  `company` varchar(60) DEFAULT NULL,
  `prev_employer` varchar(64) DEFAULT NULL,
  `prev_tin` varchar(32) DEFAULT NULL,
  `prev_address` varchar(128) DEFAULT NULL,
  `prev_zip` varchar(4) DEFAULT NULL,
  `prev_wtax` decimal(12,2) DEFAULT '0.00',
  `prev_gross_tax` decimal(12,2) DEFAULT '0.00',
  `prev_benefits_mwe` decimal(12,2) DEFAULT '0.00',
  `prev_benefits` decimal(12,2) DEFAULT '0.00',
  `prev_bonus_nontax` decimal(12,2) DEFAULT '0.00',
  `prev_bonus_tax` decimal(12,2) DEFAULT '0.00',
  `prev_govt_contri` decimal(12,2) DEFAULT '0.00',
  `dep_name1` varchar(128) DEFAULT NULL,
  `dep_bday1` date DEFAULT NULL,
  `dep_name2` varchar(128) DEFAULT NULL,
  `dep_bday2` date DEFAULT NULL,
  `dep_name3` varchar(128) DEFAULT NULL,
  `dep_bday3` date DEFAULT NULL,
  `dep_name4` varchar(128) DEFAULT NULL,
  `dep_bday4` date DEFAULT NULL,
  `min_basic` decimal(12,2) DEFAULT '0.00',
  `min_holpay` decimal(12,2) DEFAULT '0.00',
  `min_overtime` decimal(12,2) DEFAULT '0.00',
  `min_ndiff` decimal(12,2) DEFAULT '0.00',
  `min_deminimis` decimal(12,2) DEFAULT '0.00',
  `min_hazardpay` decimal(12,2) DEFAULT '0.00',
  `govt_contri` decimal(12,2) DEFAULT '0.00',
  `bonus_nontax` decimal(12,2) DEFAULT '0.00',
  `bonus_tax` decimal(12,2) DEFAULT '0.00',
  `benefit` decimal(12,2) DEFAULT '0.00',
  `allow` decimal(12,2) DEFAULT '0.00',
  `tax_basic` decimal(12,2) DEFAULT '0.00',
  `representation` decimal(12,2) NOT NULL DEFAULT '0.00',
  `transportation` decimal(12,2) NOT NULL DEFAULT '0.00',
  `cost_living` decimal(12,2) NOT NULL DEFAULT '0.00',
  `fixed_housing` decimal(12,2) NOT NULL DEFAULT '0.00',
  `tempo_allowance` decimal(12,2) NOT NULL DEFAULT '0.00',
  `service_allowance` decimal(12,2) NOT NULL DEFAULT '0.00',
  `commission` decimal(12,2) NOT NULL DEFAULT '0.00',
  `profit_sharing` decimal(12,2) NOT NULL DEFAULT '0.00',
  `fees` decimal(12,2) NOT NULL DEFAULT '0.00',
  `tax_hazardpay` decimal(12,2) NOT NULL DEFAULT '0.00',
  `attnd_ded` decimal(12,2) DEFAULT '0.00',
  `tax_overtime` decimal(12,2) DEFAULT '0.00',
  `gross_compensation` decimal(12,2) NOT NULL DEFAULT '0.00',
  `total_non_tax` decimal(12,2) NOT NULL DEFAULT '0.00',
  `total_taxable` decimal(12,2) NOT NULL DEFAULT '0.00',
  `net_taxable` decimal(12,2) NOT NULL DEFAULT '0.00',
  `wtax` decimal(12,2) DEFAULT '0.00',
  `taxdue` decimal(12,2) DEFAULT '0.00',
  `minwageflag` tinyint(1) DEFAULT '0' COMMENT '1 = minimum wage earner ;',
  `minwage_amt` decimal(12,2) DEFAULT '0.00',
  `minwage_day` decimal(12,2) DEFAULT '0.00',
  `minwage_month` decimal(12,2) DEFAULT '0.00',
  `total_year_days` decimal(12,2) DEFAULT '0.00',
  `sub_filing` varchar(3) DEFAULT NULL,
  `if_lastpay` tinyint(1) DEFAULT '0' COMMENT '1 = Last Pay ; 0 = for alpha',
  `deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_bir_item` */

DROP TABLE IF EXISTS `ww_payroll_bir_item`;

CREATE TABLE `ww_payroll_bir_item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_code` varchar(30) DEFAULT NULL,
  `item` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_bonus` */

DROP TABLE IF EXISTS `ww_payroll_bonus`;

CREATE TABLE `ww_payroll_bonus` (
  `bonus_id` int(11) NOT NULL AUTO_INCREMENT,
  `document_no` varchar(64) DEFAULT NULL,
  `bonus_transaction_code` varchar(64) DEFAULT NULL,
  `taxable_bonus_transaction_code` varchar(64) DEFAULT NULL,
  `bonus_transaction_id` int(11) DEFAULT NULL,
  `accrual_transaction_id` int(11) DEFAULT NULL,
  `adjustment_transaction_id` int(11) DEFAULT NULL,
  `taxable_bonus_transaction_id` int(11) DEFAULT NULL,
  `taxable_acrrual_transaction_id` int(11) DEFAULT NULL,
  `taxable_adjustment_transaction_id` int(11) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `payroll_date` date DEFAULT NULL,
  `transaction_method_id` int(11) DEFAULT NULL,
  `method` varchar(64) DEFAULT NULL,
  `period` int(11) DEFAULT NULL,
  `mainamount` decimal(15,2) DEFAULT NULL,
  `apply_maxbonus_rule` int(1) DEFAULT '0',
  `week` varchar(16) DEFAULT NULL,
  `employee_id` text,
  `account_id` int(11) DEFAULT NULL,
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`bonus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_bonus_accrual` */

DROP TABLE IF EXISTS `ww_payroll_bonus_accrual`;

CREATE TABLE `ww_payroll_bonus_accrual` (
  `accrual_id` int(11) DEFAULT NULL,
  `period_id` int(11) DEFAULT NULL,
  `bonus_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  KEY `accrual_id` (`accrual_id`),
  KEY `period_id` (`period_id`),
  KEY `employee_id` (`employee_id`),
  KEY `bonus_id` (`bonus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_bonus_employee` */

DROP TABLE IF EXISTS `ww_payroll_bonus_employee`;

CREATE TABLE `ww_payroll_bonus_employee` (
  `bonus_id` int(11) DEFAULT NULL,
  `id_number` varchar(11) DEFAULT NULL,
  `document_no` varchar(64) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `amount` varbinary(255) DEFAULT NULL,
  KEY `bonus_id` (`bonus_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_closed_summary` */

DROP TABLE IF EXISTS `ww_payroll_closed_summary`;

CREATE TABLE `ww_payroll_closed_summary` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `type` varchar(1) DEFAULT NULL,
  `year` int(1) NOT NULL,
  `summary_id` int(1) NOT NULL,
  `summary_code` varchar(32) NOT NULL,
  `ytd` varbinary(255) DEFAULT NULL,
  `january` varbinary(255) DEFAULT NULL,
  `february` varbinary(255) DEFAULT NULL,
  `march` varbinary(255) DEFAULT NULL,
  `april` varbinary(255) DEFAULT NULL,
  `may` varbinary(255) DEFAULT NULL,
  `june` varbinary(255) DEFAULT NULL,
  `july` varbinary(255) DEFAULT NULL,
  `august` varbinary(255) DEFAULT NULL,
  `september` varbinary(255) DEFAULT NULL,
  `october` varbinary(255) DEFAULT NULL,
  `november` varbinary(255) DEFAULT NULL,
  `december` varbinary(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_closed_summary_id` */

DROP TABLE IF EXISTS `ww_payroll_closed_summary_id`;

CREATE TABLE `ww_payroll_closed_summary_id` (
  `summary_id` int(11) NOT NULL AUTO_INCREMENT,
  `summary_code` varchar(32) NOT NULL,
  `description` text,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`summary_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_closed_transaction` */

DROP TABLE IF EXISTS `ww_payroll_closed_transaction`;

CREATE TABLE `ww_payroll_closed_transaction` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `period_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT '0',
  `processing_type_id` int(1) DEFAULT NULL,
  `payroll_date` date DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `transaction_id` int(1) DEFAULT NULL,
  `transaction_class_id` int(11) DEFAULT NULL,
  `transaction_code` varchar(32) DEFAULT NULL,
  `quantity` varbinary(255) DEFAULT NULL,
  `unit_rate` varbinary(255) DEFAULT NULL,
  `amount` varbinary(255) DEFAULT NULL,
  `transaction_type_id` int(1) DEFAULT NULL,
  `inserted_from_id` int(1) DEFAULT NULL,
  `record_from` varchar(64) DEFAULT NULL,
  `record_id` int(11) DEFAULT NULL,
  `on_hold` tinyint(1) DEFAULT '0',
  `remarks` text,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `department_id` int(11) NOT NULL DEFAULT '0',
  `section_id` int(11) DEFAULT NULL,
  `division_id` int(11) NOT NULL DEFAULT '0',
  `position_id` int(11) NOT NULL DEFAULT '0',
  `location_id` int(11) NOT NULL DEFAULT '0',
  `project_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT '0',
  `payment_type_id` tinyint(1) NOT NULL DEFAULT '0',
  `minwageflag` tinyint(1) NOT NULL DEFAULT '0',
  `payroll_rate_type_id` int(11) DEFAULT NULL,
  `sbr_no` varchar(16) DEFAULT NULL,
  `sbr_date` date DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `period_id` (`period_id`),
  KEY `processing_type_id` (`processing_type_id`),
  KEY `payroll_date` (`payroll_date`),
  KEY `transaction_id` (`transaction_id`),
  KEY `transaction_type_id` (`transaction_type_id`),
  KEY `deleted` (`deleted`),
  KEY `company_id` (`company_id`),
  KEY `employee_id` (`employee_id`),
  KEY `minwageflag` (`minwageflag`),
  KEY `transaction_code` (`transaction_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_closed_transaction_copy` */

DROP TABLE IF EXISTS `ww_payroll_closed_transaction_copy`;

CREATE TABLE `ww_payroll_closed_transaction_copy` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `period_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT '0',
  `processing_type_id` int(1) DEFAULT NULL,
  `payroll_date` date DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `transaction_id` int(1) DEFAULT NULL,
  `transaction_class_id` int(11) DEFAULT NULL,
  `transaction_code` varchar(32) DEFAULT NULL,
  `quantity` varbinary(255) DEFAULT NULL,
  `unit_rate` varbinary(255) DEFAULT NULL,
  `amount` varbinary(255) DEFAULT NULL,
  `transaction_type_id` int(1) DEFAULT NULL,
  `inserted_from_id` int(1) DEFAULT NULL,
  `record_from` varchar(64) DEFAULT NULL,
  `record_id` int(11) DEFAULT NULL,
  `on_hold` tinyint(1) DEFAULT '0',
  `remarks` text,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `department_id` int(11) NOT NULL DEFAULT '0',
  `section_id` int(11) DEFAULT NULL,
  `division_id` int(11) NOT NULL DEFAULT '0',
  `position_id` int(11) NOT NULL DEFAULT '0',
  `location_id` int(11) NOT NULL DEFAULT '0',
  `project_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT '0',
  `payment_type_id` tinyint(1) NOT NULL DEFAULT '0',
  `minwageflag` tinyint(1) NOT NULL DEFAULT '0',
  `payroll_rate_type_id` int(11) DEFAULT NULL,
  `sbr_no` varchar(16) DEFAULT NULL,
  `sbr_date` date DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `period_id` (`period_id`),
  KEY `processing_type_id` (`processing_type_id`),
  KEY `payroll_date` (`payroll_date`),
  KEY `transaction_id` (`transaction_id`),
  KEY `transaction_type_id` (`transaction_type_id`),
  KEY `deleted` (`deleted`),
  KEY `company_id` (`company_id`),
  KEY `employee_id` (`employee_id`),
  KEY `minwageflag` (`minwageflag`),
  KEY `transaction_code` (`transaction_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_current_transaction` */

DROP TABLE IF EXISTS `ww_payroll_current_transaction`;

CREATE TABLE `ww_payroll_current_transaction` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `period_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT '0',
  `processing_type_id` int(1) DEFAULT NULL,
  `payroll_date` date DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `transaction_id` int(1) DEFAULT NULL,
  `transaction_class_id` int(11) DEFAULT NULL,
  `transaction_code` varchar(32) DEFAULT NULL,
  `quantity` varbinary(255) DEFAULT NULL,
  `unit_rate` varbinary(255) DEFAULT NULL,
  `amount` varbinary(255) DEFAULT NULL,
  `transaction_type_id` int(1) DEFAULT NULL,
  `inserted_from_id` int(1) DEFAULT NULL,
  `record_from` varchar(64) DEFAULT NULL,
  `record_id` int(11) DEFAULT NULL,
  `on_hold` tinyint(1) DEFAULT '0',
  `remarks` text,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `department_id` int(11) NOT NULL DEFAULT '0',
  `section_id` int(11) DEFAULT NULL,
  `division_id` int(11) NOT NULL DEFAULT '0',
  `position_id` int(11) NOT NULL DEFAULT '0',
  `location_id` int(11) NOT NULL DEFAULT '0',
  `project_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT '0',
  `payment_type_id` tinyint(1) NOT NULL DEFAULT '0',
  `minwageflag` tinyint(1) NOT NULL DEFAULT '0',
  `payroll_rate_type_id` int(11) DEFAULT NULL,
  `sbr_no` varchar(16) DEFAULT NULL,
  `sbr_date` date DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `period_id` (`period_id`),
  KEY `processing_type_id` (`processing_type_id`),
  KEY `payroll_date` (`payroll_date`),
  KEY `transaction_id` (`transaction_id`),
  KEY `transaction_type_id` (`transaction_type_id`),
  KEY `deleted` (`deleted`),
  KEY `current` (`employee_id`,`transaction_code`,`on_hold`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_entry_batch` */

DROP TABLE IF EXISTS `ww_payroll_entry_batch`;

CREATE TABLE `ww_payroll_entry_batch` (
  `batch_entry_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `payroll_date` date NOT NULL,
  `transaction_code` varchar(64) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `document_no` varchar(64) DEFAULT NULL,
  `unit_rate_main` varbinary(255) DEFAULT NULL,
  `remarks` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`batch_entry_id`),
  KEY `payroll_date` (`payroll_date`),
  KEY `document_no` (`document_no`),
  KEY `deleted` (`deleted`),
  KEY `transaction_id` (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_entry_batch_employee` */

DROP TABLE IF EXISTS `ww_payroll_entry_batch_employee`;

CREATE TABLE `ww_payroll_entry_batch_employee` (
  `batch_entry_id` int(11) NOT NULL,
  `document_no` varchar(64) DEFAULT NULL,
  `id_number` varchar(16) DEFAULT '',
  `employee_id` int(11) NOT NULL,
  `quantity` varbinary(255) DEFAULT NULL,
  `unit_rate` varbinary(255) DEFAULT NULL,
  `amount` varbinary(255) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) DEFAULT '0',
  KEY `batch_entry_id` (`batch_entry_id`),
  KEY `employee_id` (`employee_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_entry_recurring` */

DROP TABLE IF EXISTS `ww_payroll_entry_recurring`;

CREATE TABLE `ww_payroll_entry_recurring` (
  `recurring_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_code` varchar(64) DEFAULT NULL,
  `transaction_id` int(11) NOT NULL,
  `document_no` varchar(32) CHARACTER SET latin1 DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `week` varchar(16) CHARACTER SET latin1 DEFAULT NULL,
  `amount` varbinary(255) DEFAULT NULL,
  `transaction_type_id` int(1) NOT NULL,
  `transaction_method` varchar(64) DEFAULT NULL,
  `transaction_method_id` int(1) NOT NULL,
  `remarks` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `account_code` varchar(32) CHARACTER SET latin1 DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`recurring_id`),
  KEY `transaction_id` (`transaction_id`),
  KEY `document_no` (`document_no`),
  KEY `date_from` (`date_from`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_entry_recurring_employee` */

DROP TABLE IF EXISTS `ww_payroll_entry_recurring_employee`;

CREATE TABLE `ww_payroll_entry_recurring_employee` (
  `recurring_id` int(11) unsigned NOT NULL,
  `document_no` varchar(64) NOT NULL,
  `id_number` varchar(16) DEFAULT '',
  `employee_id` int(11) NOT NULL,
  `quantity` varbinary(255) DEFAULT NULL,
  `amount` varbinary(255) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) DEFAULT '0',
  KEY `recurring_id` (`recurring_id`),
  KEY `employee_id` (`employee_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_govt_contribution` */

DROP TABLE IF EXISTS `ww_payroll_govt_contribution`;

CREATE TABLE `ww_payroll_govt_contribution` (
  `govt_contribution_id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `from` double(15,2) NOT NULL DEFAULT '0.00',
  `to` double(15,2) NOT NULL DEFAULT '0.00',
  `eeshare` double(15,2) NOT NULL DEFAULT '0.00' COMMENT 'employee share',
  `ershare` double(15,2) NOT NULL DEFAULT '0.00' COMMENT 'employer share',
  `ec` double(15,2) NOT NULL DEFAULT '0.00',
  `msb_id` int(2) NOT NULL DEFAULT '0',
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`govt_contribution_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `ww_payroll_inserted_from` */

DROP TABLE IF EXISTS `ww_payroll_inserted_from`;

CREATE TABLE `ww_payroll_inserted_from` (
  `inserted_from_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `inserted_from` varchar(64) CHARACTER SET latin1 NOT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`inserted_from_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_interest_type` */

DROP TABLE IF EXISTS `ww_payroll_interest_type`;

CREATE TABLE `ww_payroll_interest_type` (
  `interest_type_id` int(1) NOT NULL AUTO_INCREMENT,
  `interest_type` varchar(64) CHARACTER SET latin1 NOT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`interest_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_late_exemption` */

DROP TABLE IF EXISTS `ww_payroll_late_exemption`;

CREATE TABLE `ww_payroll_late_exemption` (
  `payroll_late_exemption_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `employment_type_id` int(11) DEFAULT NULL,
  `lates_exemption` decimal(5,2) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`payroll_late_exemption_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `ww_payroll_leave_conversion` */

DROP TABLE IF EXISTS `ww_payroll_leave_conversion`;

CREATE TABLE `ww_payroll_leave_conversion` (
  `leave_conversion_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `job_rank_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `convertible` decimal(5,2) NOT NULL DEFAULT '0.00',
  `employment_status_id` varchar(255) DEFAULT NULL,
  `employment_type_id` text NOT NULL,
  `carry_over` decimal(5,2) DEFAULT '0.00',
  `nontax` decimal(5,2) NOT NULL DEFAULT '0.00',
  `taxable` decimal(5,2) NOT NULL DEFAULT '0.00',
  `forfeited` decimal(5,2) NOT NULL DEFAULT '0.00',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`leave_conversion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_leave_conversion_period` */

DROP TABLE IF EXISTS `ww_payroll_leave_conversion_period`;

CREATE TABLE `ww_payroll_leave_conversion_period` (
  `leave_conversion_period_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_date` date NOT NULL,
  `year` int(4) NOT NULL,
  `apply_to_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `form_id` int(11) DEFAULT NULL,
  `nontax_leave_id` int(11) DEFAULT NULL,
  `taxable_leave_id` int(11) DEFAULT NULL,
  `remarks` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`leave_conversion_period_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_leave_conversion_period_apply_to` */

DROP TABLE IF EXISTS `ww_payroll_leave_conversion_period_apply_to`;

CREATE TABLE `ww_payroll_leave_conversion_period_apply_to` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_conversion_id` int(11) NOT NULL,
  `apply_to` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_loan` */

DROP TABLE IF EXISTS `ww_payroll_loan`;

CREATE TABLE `ww_payroll_loan` (
  `loan_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `loan_code` varchar(64) DEFAULT NULL,
  `loan` varchar(128) NOT NULL,
  `principal_transid` int(1) DEFAULT NULL,
  `amortization_transid` int(1) DEFAULT NULL,
  `interest_transid` int(1) DEFAULT NULL,
  `loan_type_id` int(1) DEFAULT NULL,
  `loan_mode_id` int(1) DEFAULT NULL,
  `amount_limit` decimal(9,2) DEFAULT '0.00',
  `interest` decimal(9,2) DEFAULT '0.00',
  `interest_type_id` int(1) DEFAULT NULL,
  `debit` int(1) DEFAULT NULL,
  `credit` int(1) DEFAULT NULL,
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` datetime DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`loan_id`),
  UNIQUE KEY `loan_code_loan_deleted` (`loan_code`,`loan`,`deleted`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_loan_interest_type` */

DROP TABLE IF EXISTS `ww_payroll_loan_interest_type`;

CREATE TABLE `ww_payroll_loan_interest_type` (
  `interest_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `interest_type` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `description` text,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`interest_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_loan_mode` */

DROP TABLE IF EXISTS `ww_payroll_loan_mode`;

CREATE TABLE `ww_payroll_loan_mode` (
  `loan_mode_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `loan_mode` varchar(128) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`loan_mode_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_loan_status` */

DROP TABLE IF EXISTS `ww_payroll_loan_status`;

CREATE TABLE `ww_payroll_loan_status` (
  `loan_status_id` int(1) NOT NULL AUTO_INCREMENT,
  `loan_status` varchar(32) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`loan_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_loan_type` */

DROP TABLE IF EXISTS `ww_payroll_loan_type`;

CREATE TABLE `ww_payroll_loan_type` (
  `loan_type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `loan_type` varchar(128) DEFAULT NULL,
  `loan_code` varchar(3) DEFAULT NULL,
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`loan_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_location` */

DROP TABLE IF EXISTS `ww_payroll_location`;

CREATE TABLE `ww_payroll_location` (
  `payroll_location_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_location_code` varchar(32) DEFAULT NULL,
  `payroll_location_label` varchar(100) DEFAULT NULL,
  `min_wage_amt` decimal(12,2) DEFAULT '0.00',
  `ecola_amt` decimal(12,2) DEFAULT '0.00',
  `ecola_amt_month` decimal(12,2) DEFAULT '0.00',
  `description` text,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`payroll_location_id`),
  UNIQUE KEY `payroll_location_code` (`payroll_location_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_overtime` */

DROP TABLE IF EXISTS `ww_payroll_overtime`;

CREATE TABLE `ww_payroll_overtime` (
  `overtime_id` int(11) NOT NULL AUTO_INCREMENT,
  `overtime_code` varchar(32) NOT NULL DEFAULT '',
  `overtime` varchar(64) DEFAULT NULL,
  `overtime_rate` decimal(5,2) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`overtime_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_overtime_rates` */

DROP TABLE IF EXISTS `ww_payroll_overtime_rates`;

CREATE TABLE `ww_payroll_overtime_rates` (
  `overtime_rate_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(1) NOT NULL DEFAULT '0',
  `partner_status_id` int(1) NOT NULL DEFAULT '0',
  `overtime_id` int(11) NOT NULL,
  `overtime_code` varchar(32) NOT NULL DEFAULT '',
  `overtime` varchar(64) DEFAULT NULL,
  `overtime_rate` decimal(5,3) DEFAULT NULL,
  `sequence` tinyint(1) DEFAULT NULL,
  `class` varchar(32) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` datetime DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`overtime_rate_id`),
  UNIQUE KEY `company_partner_overtime` (`company_id`,`partner_status_id`,`overtime_code`),
  KEY `company_id` (`company_id`),
  KEY `partner_status_id` (`partner_status_id`),
  KEY `overtime_code` (`overtime_code`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=910 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_overtime_rates_amount` */

DROP TABLE IF EXISTS `ww_payroll_overtime_rates_amount`;

CREATE TABLE `ww_payroll_overtime_rates_amount` (
  `overtime_rate_amount_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(1) NOT NULL DEFAULT '0',
  `partner_status_id` int(1) NOT NULL DEFAULT '0',
  `employment_type_id` int(11) DEFAULT NULL,
  `overtime_location_id` int(11) DEFAULT NULL,
  `overtime_id` int(11) NOT NULL,
  `overtime_code` varchar(32) NOT NULL DEFAULT '',
  `overtime` varchar(64) DEFAULT NULL,
  `overtime_amount` decimal(9,3) DEFAULT NULL,
  `sequence` tinyint(1) DEFAULT NULL,
  `class` varchar(32) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` datetime DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`overtime_rate_amount_id`),
  KEY `company_id` (`company_id`),
  KEY `partner_status_id` (`partner_status_id`),
  KEY `overtime_code` (`overtime_code`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=427 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_overtime_rates_default` */

DROP TABLE IF EXISTS `ww_payroll_overtime_rates_default`;

CREATE TABLE `ww_payroll_overtime_rates_default` (
  `overtime_rate_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(1) NOT NULL DEFAULT '0',
  `partner_status_id` int(1) NOT NULL DEFAULT '0',
  `overtime_id` int(11) NOT NULL,
  `overtime_code` varchar(32) NOT NULL DEFAULT '',
  `overtime` varchar(64) DEFAULT NULL,
  `overtime_rate` decimal(5,3) DEFAULT NULL,
  `sequence` tinyint(1) DEFAULT NULL,
  `class` varchar(32) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` datetime DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`overtime_rate_id`),
  UNIQUE KEY `company_partner_overtime` (`company_id`,`partner_status_id`,`overtime_code`),
  KEY `company_id` (`company_id`),
  KEY `partner_status_id` (`partner_status_id`),
  KEY `overtime_code` (`overtime_code`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_partners` */

DROP TABLE IF EXISTS `ww_payroll_partners`;

CREATE TABLE `ww_payroll_partners` (
  `user_id` int(11) unsigned NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `taxcode_id` int(1) DEFAULT NULL,
  `taxcode_id_org` int(11) DEFAULT NULL,
  `payroll_rate_type_id` int(1) DEFAULT NULL,
  `payroll_schedule_id` int(1) DEFAULT NULL,
  `total_year_days` decimal(5,2) DEFAULT NULL,
  `whole_half` tinyint(1) DEFAULT '0' COMMENT 'if 0 whole salary',
  `payout_schedule` tinyint(1) DEFAULT '0' COMMENT 'if 0 payout schedule on 15 or else end of the month',
  `salary` varbinary(255) DEFAULT NULL,
  `minimum_takehome` varbinary(255) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `bank_account` varchar(32) DEFAULT NULL,
  `quitclaim` tinyint(1) DEFAULT '0',
  `location_id` int(11) DEFAULT NULL,
  `sss_no` varchar(16) DEFAULT NULL,
  `sss_mode` int(1) DEFAULT NULL,
  `sss_week` varchar(32) DEFAULT NULL,
  `sss_amount` varbinary(255) DEFAULT NULL,
  `hdmf_no` varchar(16) DEFAULT NULL,
  `hdmf_mode` int(1) DEFAULT NULL,
  `hdmf_week` varchar(32) DEFAULT NULL,
  `hdmf_amount` varbinary(255) DEFAULT NULL,
  `phic_no` varchar(16) DEFAULT NULL,
  `phic_mode` int(11) DEFAULT NULL,
  `phic_week` varchar(32) DEFAULT NULL,
  `phic_amount` varbinary(255) DEFAULT NULL,
  `ecola_week` varchar(32) DEFAULT NULL,
  `tin` varchar(16) DEFAULT NULL,
  `tax_mode` int(1) DEFAULT NULL,
  `tax_amount` varbinary(255) DEFAULT NULL,
  `tax_week` varchar(32) DEFAULT NULL,
  `account_type_id` int(11) DEFAULT '2',
  `payment_type_id` int(11) DEFAULT '2',
  `fixed_rate` tinyint(1) DEFAULT '0',
  `sensitivity` tinyint(1) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `remain` int(11) DEFAULT NULL,
  `attendance_base` tinyint(1) DEFAULT '1',
  `on_hold` tinyint(1) DEFAULT '0',
  `hold_payroll` tinyint(1) DEFAULT '0',
  `non_swipe` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_partners_contribution` */

DROP TABLE IF EXISTS `ww_payroll_partners_contribution`;

CREATE TABLE `ww_payroll_partners_contribution` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `period_id` int(11) NOT NULL,
  `payroll_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `employee` decimal(10,2) DEFAULT '0.00',
  `company` decimal(10,2) DEFAULT '0.00',
  `ec` decimal(10,2) DEFAULT '0.00',
  `msb_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `create_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_partners_loan` */

DROP TABLE IF EXISTS `ww_payroll_partners_loan`;

CREATE TABLE `ww_payroll_partners_loan` (
  `partner_loan_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_number` varchar(64) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `loan_code` varchar(64) DEFAULT NULL,
  `loan_id` int(11) DEFAULT NULL,
  `loan_status` varchar(64) DEFAULT NULL,
  `loan_status_id` int(1) DEFAULT NULL,
  `description` text,
  `entry_date` date DEFAULT NULL,
  `remarks` text,
  `loan_principal` varbinary(255) DEFAULT NULL,
  `amount` varbinary(255) DEFAULT NULL,
  `interest` varbinary(255) DEFAULT NULL,
  `interest_type_id` int(1) DEFAULT NULL,
  `no_payments` int(1) DEFAULT NULL,
  `no_payments_paid` int(1) DEFAULT NULL,
  `no_payments_remaining` int(1) DEFAULT NULL,
  `beginning_balance` varbinary(255) DEFAULT NULL,
  `running_balance` varbinary(255) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `payment_mode` varchar(64) DEFAULT NULL,
  `payment_mode_id` int(1) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `releasing_debit_account_id` int(11) DEFAULT NULL,
  `releasing_credit_account_id` int(11) DEFAULT NULL,
  `system_amortization` varbinary(255) DEFAULT NULL,
  `user_amortization` varbinary(255) DEFAULT NULL,
  `system_interest` varbinary(255) DEFAULT NULL,
  `user_interest` varbinary(255) DEFAULT NULL,
  `total_arrears` varbinary(255) DEFAULT NULL,
  `total_amount_paid` varbinary(255) DEFAULT NULL,
  `last_payment_date` date DEFAULT NULL,
  `amortization_credit_account_id` int(11) DEFAULT NULL,
  `interest_credit_account_id` int(11) DEFAULT NULL,
  `interest_amortization_credit_account_id` int(11) DEFAULT NULL,
  `week` varchar(64) DEFAULT NULL,
  `previous_employee_loan_id` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`partner_loan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_partners_loan_payment` */

DROP TABLE IF EXISTS `ww_payroll_partners_loan_payment`;

CREATE TABLE `ww_payroll_partners_loan_payment` (
  `loan_payment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `partner_loan_id` int(11) NOT NULL,
  `payroll_date` date DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `amount` varbinary(255) DEFAULT NULL,
  `paid` tinyint(1) DEFAULT '0',
  `date_paid` date DEFAULT NULL,
  `balance` decimal(12,2) DEFAULT '0.00',
  `sbr_no` varchar(16) DEFAULT NULL,
  `sbr_date` date DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`loan_payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_partners_previous_employer` */

DROP TABLE IF EXISTS `ww_payroll_partners_previous_employer`;

CREATE TABLE `ww_payroll_partners_previous_employer` (
  `payroll_partners_previous_employer_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `prev_nontax_thirten_month` varbinary(255) DEFAULT NULL,
  `prev_nontax_deminimis` varbinary(255) DEFAULT NULL,
  `prev_nontax_sss_etc` varchar(255) DEFAULT NULL,
  `prev_nontax_salaries` varbinary(255) DEFAULT NULL,
  `prev_nontax_comp_income` varbinary(255) DEFAULT NULL,
  `prev_taxable_basic_salary` varbinary(255) DEFAULT NULL,
  `prev_taxable_thirten_month` varbinary(255) DEFAULT NULL,
  `prev_taxable_salaries` varbinary(255) DEFAULT NULL,
  `prev_total_taxable` varbinary(255) DEFAULT NULL,
  `prev_tax_w_held` varbinary(255) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`payroll_partners_previous_employer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_paycode` */

DROP TABLE IF EXISTS `ww_payroll_paycode`;

CREATE TABLE `ww_payroll_paycode` (
  `paycode_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `paycode` varchar(64) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`paycode_id`),
  KEY `paycode` (`paycode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_payment_mode` */

DROP TABLE IF EXISTS `ww_payroll_payment_mode`;

CREATE TABLE `ww_payroll_payment_mode` (
  `payment_mode_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `payment_mode` varchar(64) CHARACTER SET latin1 NOT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`payment_mode_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_payment_type` */

DROP TABLE IF EXISTS `ww_payroll_payment_type`;

CREATE TABLE `ww_payroll_payment_type` (
  `payment_type_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `payment_type` varchar(64) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`payment_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_payout_schedule` */

DROP TABLE IF EXISTS `ww_payroll_payout_schedule`;

CREATE TABLE `ww_payroll_payout_schedule` (
  `pay_out_schedule_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `schedule` varchar(64) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`pay_out_schedule_id`),
  KEY `paycode` (`schedule`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_period` */

DROP TABLE IF EXISTS `ww_payroll_period`;

CREATE TABLE `ww_payroll_period` (
  `payroll_period_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `period_status_id` tinyint(1) DEFAULT '1',
  `payroll_date` date DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `date_closing` date DEFAULT NULL,
  `week` int(1) DEFAULT NULL,
  `annualized` tinyint(1) DEFAULT '0',
  `payroll_schedule_id` int(11) DEFAULT NULL,
  `period_processing_type_id` int(11) DEFAULT '1',
  `include_basic_and_allowances` tinyint(1) DEFAULT '0',
  `include_13th_month_pay` tinyint(1) DEFAULT '0',
  `apply_to_id` int(11) DEFAULT NULL,
  `posting_date` date DEFAULT NULL,
  `remarks` text,
  `last_processed` datetime DEFAULT NULL,
  `bonus_tag` tinyint(1) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`payroll_period_id`),
  KEY `payroll_date` (`payroll_date`),
  KEY `date_from` (`date_from`),
  KEY `date_to` (`date_to`),
  KEY `period_status_id` (`period_status_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_period_apply_to` */

DROP TABLE IF EXISTS `ww_payroll_period_apply_to`;

CREATE TABLE `ww_payroll_period_apply_to` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `payroll_period_id` int(11) NOT NULL,
  `apply_to` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_processed` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_period_processing_type` */

DROP TABLE IF EXISTS `ww_payroll_period_processing_type`;

CREATE TABLE `ww_payroll_period_processing_type` (
  `period_processing_type_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `period_processing_type` varchar(64) CHARACTER SET latin1 NOT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`period_processing_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_period_status` */

DROP TABLE IF EXISTS `ww_payroll_period_status`;

CREATE TABLE `ww_payroll_period_status` (
  `period_status_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `period_status` varchar(64) NOT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`period_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_phic_table` */

DROP TABLE IF EXISTS `ww_payroll_phic_table`;

CREATE TABLE `ww_payroll_phic_table` (
  `phic_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `from` decimal(10,2) NOT NULL DEFAULT '0.00',
  `to` decimal(10,2) NOT NULL DEFAULT '0.00',
  `eeshare` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT 'employee share',
  `ershare` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT 'employer share',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`phic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `ww_payroll_phic_table_org` */

DROP TABLE IF EXISTS `ww_payroll_phic_table_org`;

CREATE TABLE `ww_payroll_phic_table_org` (
  `phic_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `from` decimal(10,2) NOT NULL DEFAULT '0.00',
  `to` decimal(10,2) NOT NULL DEFAULT '0.00',
  `eeshare` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT 'employee share',
  `ershare` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT 'employer share',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`phic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `ww_payroll_phic_table_updated` */

DROP TABLE IF EXISTS `ww_payroll_phic_table_updated`;

CREATE TABLE `ww_payroll_phic_table_updated` (
  `phic_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `from` decimal(10,2) NOT NULL DEFAULT '0.00',
  `to` decimal(10,2) NOT NULL DEFAULT '0.00',
  `eeshare` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT 'employee share',
  `ershare` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT 'employer share',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`phic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `ww_payroll_rate_type` */

DROP TABLE IF EXISTS `ww_payroll_rate_type`;

CREATE TABLE `ww_payroll_rate_type` (
  `payroll_rate_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_rate_type` varchar(64) CHARACTER SET latin1 DEFAULT NULL,
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`payroll_rate_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_schedule` */

DROP TABLE IF EXISTS `ww_payroll_schedule`;

CREATE TABLE `ww_payroll_schedule` (
  `payroll_schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_schedule` varchar(64) CHARACTER SET latin1 DEFAULT NULL,
  `yearly` int(1) DEFAULT '0',
  `monthly` int(1) DEFAULT '0',
  `daily` int(1) DEFAULT '0',
  `piece_rate` int(1) DEFAULT '0',
  `commision` int(1) DEFAULT '0',
  `total_period_per_annum` int(1) DEFAULT '24',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`payroll_schedule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_schedule_rate_divisor` */

DROP TABLE IF EXISTS `ww_payroll_schedule_rate_divisor`;

CREATE TABLE `ww_payroll_schedule_rate_divisor` (
  `payroll_rate_type_id` int(11) DEFAULT NULL,
  `payroll_schedule_id` int(11) DEFAULT NULL,
  `divisor` float DEFAULT NULL,
  `deleted` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_sss_table` */

DROP TABLE IF EXISTS `ww_payroll_sss_table`;

CREATE TABLE `ww_payroll_sss_table` (
  `sss_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `from` decimal(10,2) NOT NULL DEFAULT '0.00',
  `to` decimal(10,2) NOT NULL DEFAULT '0.00',
  `eeshare` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT 'employee share',
  `ershare` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT 'employer share',
  `ec` decimal(6,2) NOT NULL DEFAULT '0.00',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`sss_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_sss_table_org` */

DROP TABLE IF EXISTS `ww_payroll_sss_table_org`;

CREATE TABLE `ww_payroll_sss_table_org` (
  `sss_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `from` decimal(10,2) NOT NULL DEFAULT '0.00',
  `to` decimal(10,2) NOT NULL DEFAULT '0.00',
  `eeshare` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT 'employee share',
  `ershare` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT 'employer share',
  `ec` decimal(6,2) NOT NULL DEFAULT '0.00',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`sss_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_tax_shield` */

DROP TABLE IF EXISTS `ww_payroll_tax_shield`;

CREATE TABLE `ww_payroll_tax_shield` (
  `tax_shield_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `job_class_id` int(11) NOT NULL DEFAULT '0',
  `max_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `description` text,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tax_shield_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_transaction` */

DROP TABLE IF EXISTS `ww_payroll_transaction`;

CREATE TABLE `ww_payroll_transaction` (
  `transaction_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_code` varchar(32) NOT NULL,
  `transaction_label` varchar(128) DEFAULT NULL,
  `transaction_class_id` int(1) DEFAULT '0',
  `transaction_type_id` int(1) DEFAULT '0',
  `debit_account_id` int(1) DEFAULT '0',
  `credit_account_id` int(1) DEFAULT '0',
  `debit_account` varchar(255) DEFAULT NULL,
  `credit_account` varchar(255) DEFAULT NULL,
  `per_annum_cap` decimal(15,2) DEFAULT '0.00',
  `priority_id` tinyint(1) DEFAULT '3',
  `is_bonus` tinyint(1) NOT NULL DEFAULT '0',
  `is_sss` tinyint(1) NOT NULL DEFAULT '0',
  `is_pagibig` tinyint(1) NOT NULL DEFAULT '0',
  `is_philhealth` tinyint(1) NOT NULL DEFAULT '0',
  `is_hazardpay` tinyint(1) NOT NULL DEFAULT '0',
  `is_holidaypay` tinyint(1) NOT NULL DEFAULT '0',
  `is_deminimis` tinyint(1) NOT NULL DEFAULT '0',
  `is_representation` tinyint(1) NOT NULL DEFAULT '0',
  `is_transportation` tinyint(1) NOT NULL DEFAULT '0',
  `is_cost_living` tinyint(1) NOT NULL DEFAULT '0',
  `is_fixed_housing` tinyint(1) NOT NULL DEFAULT '0',
  `is_commission` tinyint(1) NOT NULL DEFAULT '0',
  `is_profit_sharing` tinyint(1) NOT NULL DEFAULT '0',
  `is_fees` tinyint(1) NOT NULL DEFAULT '0',
  `show_in_movement` tinyint(1) DEFAULT NULL,
  `show_in_recruitment` tinyint(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`transaction_id`),
  KEY `transaction_code` (`transaction_code`),
  KEY `transaction_class_id` (`transaction_class_id`),
  KEY `transaction_type_id` (`transaction_type_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=292 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_transaction_class` */

DROP TABLE IF EXISTS `ww_payroll_transaction_class`;

CREATE TABLE `ww_payroll_transaction_class` (
  `transaction_class_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_class_code` varchar(32) NOT NULL,
  `transaction_class` varchar(128) NOT NULL,
  `regular_processing` tinyint(1) DEFAULT '0',
  `special_processing` tinyint(1) DEFAULT '0',
  `final_pay_processing` tinyint(1) DEFAULT '0',
  `is_recurring` tinyint(1) DEFAULT '0',
  `is_irregular` tinyint(1) DEFAULT '0',
  `is_loan` tinyint(1) DEFAULT '0',
  `is_bonus` tinyint(1) DEFAULT '0',
  `government_mandated` tinyint(1) DEFAULT '0',
  `filter_by` tinyint(1) NOT NULL DEFAULT '0',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`transaction_class_id`),
  KEY `transaction_class_code` (`transaction_class_code`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_transaction_method` */

DROP TABLE IF EXISTS `ww_payroll_transaction_method`;

CREATE TABLE `ww_payroll_transaction_method` (
  `payroll_transaction_method_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `payroll_transaction_method` varchar(32) NOT NULL,
  `sequence` tinyint(1) DEFAULT '1',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`payroll_transaction_method_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_transaction_method_bonus` */

DROP TABLE IF EXISTS `ww_payroll_transaction_method_bonus`;

CREATE TABLE `ww_payroll_transaction_method_bonus` (
  `payroll_transaction_method_bonus_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `payroll_transaction_method_bonus` varchar(32) NOT NULL,
  `sequence` tinyint(1) DEFAULT '1',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`payroll_transaction_method_bonus_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_transaction_mode` */

DROP TABLE IF EXISTS `ww_payroll_transaction_mode`;

CREATE TABLE `ww_payroll_transaction_mode` (
  `payroll_transaction_mode_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `payroll_transaction_mode` varchar(32) NOT NULL,
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`payroll_transaction_mode_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_transaction_mode_tax` */

DROP TABLE IF EXISTS `ww_payroll_transaction_mode_tax`;

CREATE TABLE `ww_payroll_transaction_mode_tax` (
  `payroll_transaction_mode_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `payroll_transaction_mode` varchar(32) NOT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`payroll_transaction_mode_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_transaction_priority` */

DROP TABLE IF EXISTS `ww_payroll_transaction_priority`;

CREATE TABLE `ww_payroll_transaction_priority` (
  `priority_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `priority` varchar(32) NOT NULL,
  `priority_index` tinyint(1) DEFAULT '1',
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`priority_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_transaction_type` */

DROP TABLE IF EXISTS `ww_payroll_transaction_type`;

CREATE TABLE `ww_payroll_transaction_type` (
  `transaction_type_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_type` varchar(32) NOT NULL,
  `operation` varchar(1) NOT NULL DEFAULT '+',
  `description` text,
  `sort_order` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`transaction_type_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_upload_results` */

DROP TABLE IF EXISTS `ww_payroll_upload_results`;

CREATE TABLE `ww_payroll_upload_results` (
  `result_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `filepath` varchar(128) DEFAULT NULL,
  `filetype` varchar(16) DEFAULT NULL,
  `remarks` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`result_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_week` */

DROP TABLE IF EXISTS `ww_payroll_week`;

CREATE TABLE `ww_payroll_week` (
  `week_id` int(1) NOT NULL AUTO_INCREMENT,
  `week` varchar(8) NOT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`week_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_payroll_whtax_table` */

DROP TABLE IF EXISTS `ww_payroll_whtax_table`;

CREATE TABLE `ww_payroll_whtax_table` (
  `whtax_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `payroll_schedule_id` int(1) NOT NULL,
  `taxcode_id` int(1) NOT NULL,
  `salary_from` decimal(10,2) NOT NULL DEFAULT '0.00',
  `salary_to` decimal(10,2) NOT NULL DEFAULT '0.00',
  `fixed_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `excess_percentage` decimal(6,2) NOT NULL DEFAULT '0.00',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`whtax_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

/*Table structure for table `ww_payroll_whtax_table_org` */

DROP TABLE IF EXISTS `ww_payroll_whtax_table_org`;

CREATE TABLE `ww_payroll_whtax_table_org` (
  `whtax_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `payroll_schedule_id` int(1) NOT NULL,
  `taxcode_id` int(1) NOT NULL,
  `salary_from` decimal(10,2) NOT NULL DEFAULT '0.00',
  `salary_to` decimal(10,2) NOT NULL DEFAULT '0.00',
  `fixed_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `excess_percentage` decimal(6,2) NOT NULL DEFAULT '0.00',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`whtax_id`)
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

/*Table structure for table `ww_payroll_whtax_table_updated` */

DROP TABLE IF EXISTS `ww_payroll_whtax_table_updated`;

CREATE TABLE `ww_payroll_whtax_table_updated` (
  `whtax_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `payroll_schedule_id` int(1) NOT NULL,
  `taxcode_id` int(1) NOT NULL,
  `salary_from` decimal(10,2) NOT NULL DEFAULT '0.00',
  `salary_to` decimal(10,2) NOT NULL DEFAULT '0.00',
  `fixed_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `excess_percentage` decimal(6,2) NOT NULL DEFAULT '0.00',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`whtax_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

/*Table structure for table `ww_payroll_year` */

DROP TABLE IF EXISTS `ww_payroll_year`;

CREATE TABLE `ww_payroll_year` (
  `payroll_year_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_year` varchar(4) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`payroll_year_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_appraisal` */

DROP TABLE IF EXISTS `ww_performance_appraisal`;

CREATE TABLE `ww_performance_appraisal` (
  `appraisal_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `planning_id` int(1) NOT NULL,
  `year` int(1) NOT NULL DEFAULT '1900',
  `date_from` date NOT NULL DEFAULT '0000-00-00',
  `date_to` date NOT NULL DEFAULT '0000-00-00',
  `performance_type_id` int(1) NOT NULL DEFAULT '0',
  `template_id` varchar(64) DEFAULT NULL,
  `employment_status_id` varchar(64) DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT '0',
  `notes` text,
  `filter_by` int(1) DEFAULT '0',
  `filter_id` text,
  `planning_created_by` int(11) DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`appraisal_id`),
  KEY `location` (`year`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_appraisal_applicable` */

DROP TABLE IF EXISTS `ww_performance_appraisal_applicable`;

CREATE TABLE `ww_performance_appraisal_applicable` (
  `appraisal_id` int(11) unsigned NOT NULL,
  `template_id` int(1) unsigned NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `fullname` varchar(64) DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT '0',
  `cs_status` tinyint(1) DEFAULT '0',
  `to_user_id` int(11) DEFAULT '0',
  `appraisee_acceptance` tinyint(1) DEFAULT '0',
  `appraisee_remarks` varchar(255) DEFAULT NULL,
  `self_rating` float(5,2) DEFAULT NULL,
  `coach_rating` float(5,2) DEFAULT NULL,
  `committee_rating` float(5,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `supervisor_summary` text,
  `partner_summary` text,
  `approved_date` date DEFAULT NULL,
  `email_sent` tinyint(1) DEFAULT '0',
  `notification_sent` tinyint(1) DEFAULT '0',
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`appraisal_id`,`template_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_appraisal_applicable_fields` */

DROP TABLE IF EXISTS `ww_performance_appraisal_applicable_fields`;

CREATE TABLE `ww_performance_appraisal_applicable_fields` (
  `appraisal_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rate_user_id` int(11) DEFAULT NULL COMMENT 'user id of user or approver who made the ratings',
  `template_section_id` int(11) DEFAULT NULL,
  `criteria_id` int(11) DEFAULT NULL COMMENT 'either scorecard_id or library_id',
  `item_id` int(11) DEFAULT NULL COMMENT 'either template section column id or library value id',
  `value` text,
  `sequence` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_appraisal_applicable_score_library_ratings` */

DROP TABLE IF EXISTS `ww_performance_appraisal_applicable_score_library_ratings`;

CREATE TABLE `ww_performance_appraisal_applicable_score_library_ratings` (
  `appraisal_id` int(11) DEFAULT NULL,
  `template_section_id` int(11) DEFAULT NULL,
  `score_library_id` int(11) DEFAULT NULL COMMENT 'score or library value id',
  `user_id` int(11) DEFAULT NULL,
  `key_weight` float(5,2) DEFAULT NULL COMMENT 'user id of user or approver who made the ratings',
  `self_rating` float(5,2) DEFAULT NULL,
  `coach_rating` float(5,2) DEFAULT NULL COMMENT 'either scorecard_id or library_id',
  `total_weight_average` float(5,2) DEFAULT NULL COMMENT 'either template section column id or library value id',
  `coach_section_rating` float(5,2) DEFAULT NULL,
  `weight` float(5,2) DEFAULT NULL,
  `total_weighted_score` float(5,2) DEFAULT NULL,
  `coach_total_weighted_score` float(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_appraisal_applicable_section_ratings` */

DROP TABLE IF EXISTS `ww_performance_appraisal_applicable_section_ratings`;

CREATE TABLE `ww_performance_appraisal_applicable_section_ratings` (
  `appraisal_id` int(11) DEFAULT NULL,
  `template_section_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `key_weight` float(5,2) DEFAULT NULL COMMENT 'user id of user or approver who made the ratings',
  `self_rating` float(5,2) DEFAULT NULL,
  `coach_rating` float(5,2) DEFAULT NULL COMMENT 'either scorecard_id or library_id',
  `total_weight_average` float(5,2) DEFAULT NULL COMMENT 'either template section column id or library value id',
  `coach_section_rating` float(5,2) DEFAULT NULL,
  `weight` float(5,2) DEFAULT NULL,
  `total_weighted_score` float(5,2) DEFAULT NULL,
  `coach_total_weighted_score` float(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_appraisal_applicable_user` */

DROP TABLE IF EXISTS `ww_performance_appraisal_applicable_user`;

CREATE TABLE `ww_performance_appraisal_applicable_user` (
  `appraisal_id` int(11) unsigned NOT NULL,
  `template_id` int(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `fullname` varchar(64) DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT '0',
  `to_user_id` int(11) DEFAULT '0',
  `date` date DEFAULT NULL,
  `selfrate_date` date DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`appraisal_id`,`template_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_appraisal_approver` */

DROP TABLE IF EXISTS `ww_performance_appraisal_approver`;

CREATE TABLE `ww_performance_appraisal_approver` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `appraisal_id` int(11) unsigned NOT NULL DEFAULT '0',
  `appraisee_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `approver_id` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(64) CHARACTER SET latin1 DEFAULT '',
  `condition` enum('ALL','By Level','Either Of') DEFAULT 'By Level',
  `sequence` tinyint(1) DEFAULT '1',
  `performance_status_id` int(1) DEFAULT '0',
  `performance_status` varchar(16) DEFAULT '',
  `remarks` varchar(255) DEFAULT NULL,
  `approved_date` datetime DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `forms_user` (`appraisal_id`,`user_id`,`sequence`,`appraisee_id`),
  KEY `forms_id` (`appraisal_id`),
  KEY `user_id` (`user_id`),
  KEY `sequence` (`sequence`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_appraisal_contributor` */

DROP TABLE IF EXISTS `ww_performance_appraisal_contributor`;

CREATE TABLE `ww_performance_appraisal_contributor` (
  `appraisal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `template_section_id` int(1) NOT NULL,
  `contributor_id` int(11) NOT NULL,
  `status_id` tinyint(1) DEFAULT '0',
  `finalized` tinyint(1) DEFAULT '0',
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`appraisal_id`,`user_id`,`template_section_id`,`contributor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_appraisal_contributor_fields` */

DROP TABLE IF EXISTS `ww_performance_appraisal_contributor_fields`;

CREATE TABLE `ww_performance_appraisal_contributor_fields` (
  `appraisal_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `contributor_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `section_column_id` int(11) DEFAULT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_appraisal_contributor_notes` */

DROP TABLE IF EXISTS `ww_performance_appraisal_contributor_notes`;

CREATE TABLE `ww_performance_appraisal_contributor_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appraisal_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `note_to` int(11) DEFAULT NULL,
  `note` text,
  `section_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_appraisal_fields` */

DROP TABLE IF EXISTS `ww_performance_appraisal_fields`;

CREATE TABLE `ww_performance_appraisal_fields` (
  `appraisal_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `section_column_id` int(11) DEFAULT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_appraisal_logs` */

DROP TABLE IF EXISTS `ww_performance_appraisal_logs`;

CREATE TABLE `ww_performance_appraisal_logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `appraisal_id` int(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `status_id` int(1) DEFAULT '0',
  `cs_status_id` int(1) DEFAULT '0',
  `to_user_id` int(11) DEFAULT NULL,
  `to_user` varchar(64) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_appraisal_pdp` */

DROP TABLE IF EXISTS `ww_performance_appraisal_pdp`;

CREATE TABLE `ww_performance_appraisal_pdp` (
  `appraisal_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `column_id` int(11) DEFAULT NULL,
  `library_id` int(11) DEFAULT NULL,
  `date` text,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_appraisal_personnel_action` */

DROP TABLE IF EXISTS `ww_performance_appraisal_personnel_action`;

CREATE TABLE `ww_performance_appraisal_personnel_action` (
  `appraisal_id` int(11) unsigned NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `recommendation_id` int(1) DEFAULT '0',
  `date` date DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `others` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_appraisal_recommendation` */

DROP TABLE IF EXISTS `ww_performance_appraisal_recommendation`;

CREATE TABLE `ww_performance_appraisal_recommendation` (
  `recommendation_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `recommendation` varchar(64) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`recommendation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_appraisal_reminder` */

DROP TABLE IF EXISTS `ww_performance_appraisal_reminder`;

CREATE TABLE `ww_performance_appraisal_reminder` (
  `reminder_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `appraisal_id` int(11) NOT NULL,
  `notification_id` int(1) NOT NULL DEFAULT '0',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `status_id` tinyint(1) DEFAULT '1',
  `file` varchar(256) DEFAULT '',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`reminder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_appraisal_self_review` */

DROP TABLE IF EXISTS `ww_performance_appraisal_self_review`;

CREATE TABLE `ww_performance_appraisal_self_review` (
  `appraisal_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `accomplishments` text,
  `evidences` text,
  `areas_to_improve` text,
  `items_to_address` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_appraisal_user_fields` */

DROP TABLE IF EXISTS `ww_performance_appraisal_user_fields`;

CREATE TABLE `ww_performance_appraisal_user_fields` (
  `appraisal_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `section_column_id` int(11) DEFAULT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_contributor_status` */

DROP TABLE IF EXISTS `ww_performance_contributor_status`;

CREATE TABLE `ww_performance_contributor_status` (
  `cs_stat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cs_stat` varchar(64) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`cs_stat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_planning` */

DROP TABLE IF EXISTS `ww_performance_planning`;

CREATE TABLE `ww_performance_planning` (
  `planning_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `year` int(1) NOT NULL DEFAULT '1900',
  `date_from` date NOT NULL DEFAULT '0000-00-00',
  `date_to` date NOT NULL DEFAULT '0000-00-00',
  `performance_type_id` int(1) NOT NULL DEFAULT '0',
  `template_id` int(1) DEFAULT NULL,
  `employment_status_id` varchar(64) NOT NULL,
  `status_id` tinyint(1) DEFAULT '0',
  `notes` text,
  `immediate_remarks` text,
  `filter_by` int(1) DEFAULT '0',
  `filter_id` text,
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`planning_id`),
  KEY `location` (`year`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_planning_applicable` */

DROP TABLE IF EXISTS `ww_performance_planning_applicable`;

CREATE TABLE `ww_performance_planning_applicable` (
  `planning_id` int(11) unsigned NOT NULL,
  `template_id` int(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `fullname` varchar(64) DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT '0',
  `to_user_id` int(11) DEFAULT '0',
  `appraisee_acceptance` tinyint(1) DEFAULT '0',
  `appraisee_remarks` text,
  `approved_date` date DEFAULT NULL,
  `email_sent` tinyint(1) DEFAULT '0',
  `notification_sent` tinyint(1) DEFAULT '0',
  `date` date DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`planning_id`,`template_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_planning_applicable_fields` */

DROP TABLE IF EXISTS `ww_performance_planning_applicable_fields`;

CREATE TABLE `ww_performance_planning_applicable_fields` (
  `planning_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `scorecard_id` int(11) DEFAULT NULL,
  `section_column_id` int(11) DEFAULT NULL,
  `value` text,
  `sequence` int(11) DEFAULT NULL,
  KEY `item_id` (`scorecard_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_planning_applicable_fields_header` */

DROP TABLE IF EXISTS `ww_performance_planning_applicable_fields_header`;

CREATE TABLE `ww_performance_planning_applicable_fields_header` (
  `planning_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `section_column_id` int(11) DEFAULT NULL,
  `value` text,
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_planning_applicable_items` */

DROP TABLE IF EXISTS `ww_performance_planning_applicable_items`;

CREATE TABLE `ww_performance_planning_applicable_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `planning_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `section_column_id` int(11) DEFAULT NULL,
  `item` varchar(256) DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_planning_applicable_items_header` */

DROP TABLE IF EXISTS `ww_performance_planning_applicable_items_header`;

CREATE TABLE `ww_performance_planning_applicable_items_header` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `planning_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `section_column_id` int(11) DEFAULT NULL,
  `item` varchar(256) DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_planning_applicable_status` */

DROP TABLE IF EXISTS `ww_performance_planning_applicable_status`;

CREATE TABLE `ww_performance_planning_applicable_status` (
  `applicable_status_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) NOT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`applicable_status_id`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_planning_applicable_user_info` */

DROP TABLE IF EXISTS `ww_performance_planning_applicable_user_info`;

CREATE TABLE `ww_performance_planning_applicable_user_info` (
  `planning_id` int(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `position_id` int(11) DEFAULT NULL,
  `job_grade_id` int(11) DEFAULT NULL COMMENT 'equivalent to rank',
  `company_id` int(11) DEFAULT NULL,
  `division_id` int(64) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `reports_to_id` varchar(64) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`planning_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_planning_approver` */

DROP TABLE IF EXISTS `ww_performance_planning_approver`;

CREATE TABLE `ww_performance_planning_approver` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `planning_id` int(11) unsigned NOT NULL DEFAULT '0',
  `appraisee_id` int(11) DEFAULT NULL COMMENT 'no user for oclp',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `approver_id` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(64) CHARACTER SET latin1 DEFAULT '',
  `condition` enum('ALL','By Level','Either Of') DEFAULT 'By Level',
  `sequence` tinyint(1) DEFAULT '1',
  `performance_status_id` int(1) DEFAULT '0',
  `performance_status` varchar(16) DEFAULT '',
  `approved_date` datetime DEFAULT NULL,
  `disapproved_date` datetime DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `forms_user` (`planning_id`,`user_id`,`sequence`,`appraisee_id`),
  KEY `forms_id` (`planning_id`),
  KEY `user_id` (`user_id`),
  KEY `sequence` (`sequence`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_planning_crowdsource` */

DROP TABLE IF EXISTS `ww_performance_planning_crowdsource`;

CREATE TABLE `ww_performance_planning_crowdsource` (
  `planning_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `crowdsource_user_id` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_planning_filter` */

DROP TABLE IF EXISTS `ww_performance_planning_filter`;

CREATE TABLE `ww_performance_planning_filter` (
  `filter_id` int(1) NOT NULL AUTO_INCREMENT,
  `filter_by` varchar(64) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`filter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_planning_layout` */

DROP TABLE IF EXISTS `ww_performance_planning_layout`;

CREATE TABLE `ww_performance_planning_layout` (
  `planning_layout_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `planning_id` int(1) DEFAULT NULL,
  `immediate_id` int(11) DEFAULT NULL,
  `kpi` text,
  `below_standard` text,
  `meet_standard_low` text,
  `meet_standard_high` text,
  `exceed_standard` text,
  `weight` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `rating` decimal(10,2) DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`planning_layout_id`),
  KEY `location` (`planning_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_planning_logs` */

DROP TABLE IF EXISTS `ww_performance_planning_logs`;

CREATE TABLE `ww_performance_planning_logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `planning_id` int(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `status_id` int(1) DEFAULT '0',
  `to_user_id` int(11) DEFAULT NULL,
  `to_user` varchar(64) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_planning_notes` */

DROP TABLE IF EXISTS `ww_performance_planning_notes`;

CREATE TABLE `ww_performance_planning_notes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `planning_id` int(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `notes` text,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_planning_reminder` */

DROP TABLE IF EXISTS `ww_performance_planning_reminder`;

CREATE TABLE `ww_performance_planning_reminder` (
  `reminder_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `planning_id` int(11) NOT NULL,
  `notification_id` int(1) NOT NULL DEFAULT '0',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `status_id` tinyint(1) DEFAULT '1',
  `file` varchar(256) DEFAULT '',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`reminder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_rating_classification` */

DROP TABLE IF EXISTS `ww_performance_rating_classification`;

CREATE TABLE `ww_performance_rating_classification` (
  `rating_classification_id` int(11) NOT NULL AUTO_INCREMENT,
  `rating_classification` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rating_classification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_rating_classification_items` */

DROP TABLE IF EXISTS `ww_performance_rating_classification_items`;

CREATE TABLE `ww_performance_rating_classification_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `rc_id` int(11) DEFAULT NULL,
  `min_score` decimal(4,2) DEFAULT NULL,
  `max_score` decimal(4,2) DEFAULT NULL,
  `item_code` varchar(3) DEFAULT NULL,
  `item_label` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_selfreview_status` */

DROP TABLE IF EXISTS `ww_performance_selfreview_status`;

CREATE TABLE `ww_performance_selfreview_status` (
  `sr_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `sr_status` varchar(64) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`sr_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_setup_library` */

DROP TABLE IF EXISTS `ww_performance_setup_library`;

CREATE TABLE `ww_performance_setup_library` (
  `library_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `library` varchar(64) NOT NULL DEFAULT '',
  `description` text,
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`library_id`),
  KEY `location` (`library`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_setup_library_value` */

DROP TABLE IF EXISTS `ww_performance_setup_library_value`;

CREATE TABLE `ww_performance_setup_library_value` (
  `library_value_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `library_id` varchar(64) NOT NULL DEFAULT '',
  `library_value` varchar(64) DEFAULT NULL,
  `library_value_description` text,
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`library_value_id`),
  KEY `location` (`library_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_setup_notification` */

DROP TABLE IF EXISTS `ww_performance_setup_notification`;

CREATE TABLE `ww_performance_setup_notification` (
  `notification_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `notification` varchar(64) NOT NULL DEFAULT '',
  `description` text,
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`notification_id`),
  KEY `location` (`notification`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_setup_performance` */

DROP TABLE IF EXISTS `ww_performance_setup_performance`;

CREATE TABLE `ww_performance_setup_performance` (
  `performance_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `performance` varchar(64) NOT NULL DEFAULT '',
  `performance_group` int(1) NOT NULL DEFAULT '0',
  `description` text,
  `status_id` tinyint(1) DEFAULT '0',
  `send_feeds` tinyint(1) NOT NULL DEFAULT '1',
  `send_email` tinyint(1) NOT NULL DEFAULT '1',
  `send_sms` tinyint(1) NOT NULL DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`performance_id`),
  KEY `location` (`performance`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_setup_rating_group` */

DROP TABLE IF EXISTS `ww_performance_setup_rating_group`;

CREATE TABLE `ww_performance_setup_rating_group` (
  `rating_group_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `rating_group` varchar(64) NOT NULL DEFAULT '',
  `description` text,
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rating_group_id`),
  KEY `location` (`rating_group`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_setup_rating_score` */

DROP TABLE IF EXISTS `ww_performance_setup_rating_score`;

CREATE TABLE `ww_performance_setup_rating_score` (
  `rating_score_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `rating_group_id` int(1) NOT NULL,
  `rating_score` varchar(64) NOT NULL DEFAULT '',
  `score` int(11) NOT NULL,
  `description` text,
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rating_score_id`),
  KEY `location` (`rating_score`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_setup_scorecard` */

DROP TABLE IF EXISTS `ww_performance_setup_scorecard`;

CREATE TABLE `ww_performance_setup_scorecard` (
  `scorecard_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `template_section_id` int(11) DEFAULT NULL,
  `scorecard` varchar(64) NOT NULL DEFAULT '',
  `description` text,
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`scorecard_id`),
  KEY `location` (`scorecard`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_status` */

DROP TABLE IF EXISTS `ww_performance_status`;

CREATE TABLE `ww_performance_status` (
  `performance_status_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `performance_status` varchar(32) NOT NULL DEFAULT '',
  `class` varchar(32) DEFAULT 'badge badge-default',
  `description` tinytext,
  `planning` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`performance_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_template` */

DROP TABLE IF EXISTS `ww_performance_template`;

CREATE TABLE `ww_performance_template` (
  `template_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `template` varchar(64) NOT NULL DEFAULT '',
  `template_code` varchar(64) DEFAULT NULL,
  `applicable_to_id` int(11) DEFAULT NULL COMMENT 'not use for oclp',
  `applicable_to` varchar(255) DEFAULT NULL COMMENT 'not use for oclp',
  `company_id` int(11) DEFAULT NULL,
  `position_classification_id` int(11) DEFAULT NULL,
  `job_grade_id` int(11) DEFAULT NULL COMMENT 'equivalent to rank',
  `employment_type_id` int(11) DEFAULT NULL COMMENT 'equivalent to level',
  `employment_status_id` varchar(64) DEFAULT NULL,
  `description` text,
  `set_crowdsource_by` enum('Appraiser','Appraisee','Both') DEFAULT 'Appraiser',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `max_crowdsource` int(1) DEFAULT '2',
  PRIMARY KEY (`template_id`),
  KEY `location` (`template`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_template_applicable` */

DROP TABLE IF EXISTS `ww_performance_template_applicable`;

CREATE TABLE `ww_performance_template_applicable` (
  `applicable_to_id` int(11) NOT NULL AUTO_INCREMENT,
  `applicable_to` varchar(64) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`applicable_to_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_template_section` */

DROP TABLE IF EXISTS `ww_performance_template_section`;

CREATE TABLE `ww_performance_template_section` (
  `template_section_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `template_id` int(1) NOT NULL DEFAULT '0',
  `parent_id` int(1) NOT NULL DEFAULT '0',
  `template_section` varchar(128) NOT NULL DEFAULT '',
  `sequence` int(1) DEFAULT '0',
  `weight` float(5,2) DEFAULT '0.00',
  `section_type_id` int(1) DEFAULT NULL,
  `library_id` int(11) DEFAULT NULL,
  `is_core` tinyint(1) DEFAULT '0',
  `header` text,
  `footer` text,
  `description` text,
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `min_crowdsource` int(11) DEFAULT NULL,
  `rc_id` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`template_section_id`),
  KEY `location` (`template_section`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_template_section_column` */

DROP TABLE IF EXISTS `ww_performance_template_section_column`;

CREATE TABLE `ww_performance_template_section_column` (
  `section_column_id` int(11) NOT NULL AUTO_INCREMENT,
  `template_section_id` int(11) DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `sequence` int(1) DEFAULT NULL,
  `uitype_id` int(1) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `rating_group_id` int(1) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `min_items` int(11) DEFAULT NULL,
  `max_items` int(11) DEFAULT NULL,
  `min_weight` int(11) DEFAULT NULL,
  `class` varchar(64) DEFAULT NULL,
  `required` tinyint(1) DEFAULT '0',
  `readonly` tinyint(1) DEFAULT '0',
  `can_add_row` tinyint(1) DEFAULT '0',
  `data_type` varchar(64) DEFAULT NULL,
  `stage_of_appraisal` tinyint(1) DEFAULT NULL COMMENT '1 = planning stage, 2 = appraisal stage',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`section_column_id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_template_section_column_fields` */

DROP TABLE IF EXISTS `ww_performance_template_section_column_fields`;

CREATE TABLE `ww_performance_template_section_column_fields` (
  `item_id` int(11) DEFAULT NULL,
  `section_column_id` int(11) DEFAULT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_template_section_column_item` */

DROP TABLE IF EXISTS `ww_performance_template_section_column_item`;

CREATE TABLE `ww_performance_template_section_column_item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `section_column_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `item` varchar(256) DEFAULT NULL,
  `tripart` tinyint(1) DEFAULT '0',
  `sequence` int(1) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_template_section_column_uitype` */

DROP TABLE IF EXISTS `ww_performance_template_section_column_uitype`;

CREATE TABLE `ww_performance_template_section_column_uitype` (
  `uitype_id` int(1) NOT NULL AUTO_INCREMENT,
  `uitype` varchar(64) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`uitype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_template_section_column_uitype_oclp` */

DROP TABLE IF EXISTS `ww_performance_template_section_column_uitype_oclp`;

CREATE TABLE `ww_performance_template_section_column_uitype_oclp` (
  `uitype_id` int(1) NOT NULL AUTO_INCREMENT,
  `uidescription` varchar(64) DEFAULT NULL,
  `uitype` varchar(64) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`uitype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_performance_template_section_type` */

DROP TABLE IF EXISTS `ww_performance_template_section_type`;

CREATE TABLE `ww_performance_template_section_type` (
  `section_type_id` int(1) NOT NULL AUTO_INCREMENT,
  `section_type` varchar(64) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`section_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_play_badges` */

DROP TABLE IF EXISTS `ww_play_badges`;

CREATE TABLE `ww_play_badges` (
  `badge_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `badge_code` varchar(16) NOT NULL,
  `badge` varchar(32) NOT NULL,
  `points` int(3) DEFAULT '0',
  `description` text,
  `image_path` varchar(128) DEFAULT NULL,
  `modified_by` int(1) DEFAULT NULL,
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(1) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`badge_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_play_league` */

DROP TABLE IF EXISTS `ww_play_league`;

CREATE TABLE `ww_play_league` (
  `league_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `league_code` varchar(50) DEFAULT NULL,
  `league` varchar(64) NOT NULL,
  `description` text,
  `modified_by` int(1) DEFAULT NULL,
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(1) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`league_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_play_level` */

DROP TABLE IF EXISTS `ww_play_level`;

CREATE TABLE `ww_play_level` (
  `level_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `level` varchar(64) NOT NULL,
  `league_id` int(11) NOT NULL,
  `league` varchar(64) NOT NULL,
  `points_fr` int(1) DEFAULT '1',
  `points_to` int(1) DEFAULT '100',
  `description` text,
  `modified_by` int(1) DEFAULT NULL,
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(1) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_play_partner_badge` */

DROP TABLE IF EXISTS `ww_play_partner_badge`;

CREATE TABLE `ww_play_partner_badge` (
  `user_id` int(11) unsigned NOT NULL,
  `badge_id` int(11) NOT NULL,
  `badge_points` int(11) NOT NULL DEFAULT '0',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`,`badge_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_play_partner_points` */

DROP TABLE IF EXISTS `ww_play_partner_points`;

CREATE TABLE `ww_play_partner_points` (
  `user_id` int(11) unsigned NOT NULL,
  `league_id` int(11) NOT NULL DEFAULT '1',
  `level_no` int(11) NOT NULL DEFAULT '1',
  `points` int(11) NOT NULL DEFAULT '0',
  `total_points` int(11) NOT NULL DEFAULT '0',
  `jars` int(11) NOT NULL DEFAULT '0',
  `used_points` int(11) NOT NULL DEFAULT '0',
  `redeemed` int(11) NOT NULL DEFAULT '0',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime DEFAULT NULL,
  KEY `user` (`user_id`,`league_id`,`level_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_play_partner_redeemed` */

DROP TABLE IF EXISTS `ww_play_partner_redeemed`;

CREATE TABLE `ww_play_partner_redeemed` (
  `user_id` int(11) unsigned NOT NULL,
  `item_id` int(11) NOT NULL,
  `points` int(11) NOT NULL DEFAULT '0',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_play_redeemable` */

DROP TABLE IF EXISTS `ww_play_redeemable`;

CREATE TABLE `ww_play_redeemable` (
  `item_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(64) NOT NULL,
  `level_id` int(11) NOT NULL DEFAULT '0',
  `points` int(3) NOT NULL,
  `image_path` varchar(128) NOT NULL,
  `description` text,
  `modified_by` int(1) DEFAULT NULL,
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(1) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_profile_menu` */

DROP TABLE IF EXISTS `ww_profile_menu`;

CREATE TABLE `ww_profile_menu` (
  `menu_item_id` int(1) unsigned NOT NULL,
  `profile_id` int(1) NOT NULL,
  UNIQUE KEY `profile_id` (`profile_id`,`menu_item_id`),
  KEY `menu_item_id` (`menu_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_profiles` */

DROP TABLE IF EXISTS `ww_profiles`;

CREATE TABLE `ww_profiles` (
  `profile_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `profile` varchar(32) NOT NULL,
  `status_id` tinyint(1) DEFAULT '0',
  `can_view` tinyint(1) DEFAULT '1',
  `can_delete` tinyint(1) DEFAULT '1',
  `description` text,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`profile_id`),
  KEY `profile` (`profile`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_profiles_permission` */

DROP TABLE IF EXISTS `ww_profiles_permission`;

CREATE TABLE `ww_profiles_permission` (
  `profile_id` int(1) NOT NULL DEFAULT '0',
  `mod_id` int(1) NOT NULL DEFAULT '0',
  `action_id` int(1) NOT NULL DEFAULT '0',
  `grant` tinyint(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `mod_profile_action` (`profile_id`,`mod_id`,`action_id`),
  KEY `mod_id` (`mod_id`),
  KEY `profile_id` (`profile_id`),
  KEY `action_id` (`action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_profiles_sensitivity` */

DROP TABLE IF EXISTS `ww_profiles_sensitivity`;

CREATE TABLE `ww_profiles_sensitivity` (
  `profile_id` tinyint(11) DEFAULT NULL,
  `mod_id` tinyint(11) DEFAULT NULL,
  `sensitivity_id` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_quarters` */

DROP TABLE IF EXISTS `ww_quarters`;

CREATE TABLE `ww_quarters` (
  `quarters_id` int(11) NOT NULL AUTO_INCREMENT,
  `quarters` varchar(32) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`quarters_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment` */

DROP TABLE IF EXISTS `ww_recruitment`;

CREATE TABLE `ww_recruitment` (
  `recruit_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `recruitment_date` date NOT NULL DEFAULT '0000-00-00',
  `status_id` int(1) DEFAULT '1',
  `title` enum('Mr.','Miss','Mrs.') DEFAULT 'Mr.',
  `suffix` varchar(16) DEFAULT NULL,
  `lastname` varchar(32) NOT NULL,
  `firstname` varchar(32) DEFAULT NULL,
  `middlename` varchar(32) DEFAULT NULL,
  `maidenname` varchar(32) DEFAULT NULL,
  `nickname` varchar(32) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `birth_date` date DEFAULT '0000-00-00',
  `gender` enum('Male','Female') NOT NULL DEFAULT 'Male',
  `request_id` int(11) DEFAULT '0',
  `hired` tinyint(1) DEFAULT '0',
  `partner_id` int(11) DEFAULT NULL,
  `source_id` int(1) DEFAULT '0',
  `blacklisted` tinyint(1) DEFAULT '0',
  `oth_position` varchar(255) DEFAULT NULL,
  `from_seting_final_interview` tinyint(1) DEFAULT '0',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`recruit_id`),
  KEY `recruitment_date` (`recruitment_date`),
  KEY `status_id` (`status_id`),
  KEY `lastname` (`lastname`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_age_gender` */

DROP TABLE IF EXISTS `ww_recruitment_age_gender`;

CREATE TABLE `ww_recruitment_age_gender` (
  `age_gender` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_background_item` */

DROP TABLE IF EXISTS `ww_recruitment_background_item`;

CREATE TABLE `ww_recruitment_background_item` (
  `background_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `background_code` varchar(32) DEFAULT NULL,
  `background` varchar(64) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`background_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_background_status` */

DROP TABLE IF EXISTS `ww_recruitment_background_status`;

CREATE TABLE `ww_recruitment_background_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_code` varchar(32) DEFAULT NULL,
  `status` varchar(64) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_benefit` */

DROP TABLE IF EXISTS `ww_recruitment_benefit`;

CREATE TABLE `ww_recruitment_benefit` (
  `benefit_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `package_id` int(11) NOT NULL,
  `benefit` varchar(64) DEFAULT NULL,
  `amount` decimal(9,2) DEFAULT '0.00',
  `is_basic` tinyint(1) DEFAULT '0',
  `status_id` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`benefit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_benefit_package` */

DROP TABLE IF EXISTS `ww_recruitment_benefit_package`;

CREATE TABLE `ww_recruitment_benefit_package` (
  `package_id` int(11) NOT NULL AUTO_INCREMENT,
  `benefit` varchar(64) NOT NULL,
  `rank_id` int(1) DEFAULT '0',
  `description` text,
  `status_id` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_educational_background` */

DROP TABLE IF EXISTS `ww_recruitment_educational_background`;

CREATE TABLE `ww_recruitment_educational_background` (
  `educational_background_id` int(11) NOT NULL AUTO_INCREMENT,
  `educational_background_code` varchar(32) DEFAULT NULL,
  `educational_background` varchar(64) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`educational_background_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_employment_checklist` */

DROP TABLE IF EXISTS `ww_recruitment_employment_checklist`;

CREATE TABLE `ww_recruitment_employment_checklist` (
  `checklist_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `checklist` varchar(128) DEFAULT NULL,
  `description` text,
  `for_submission` tinyint(1) DEFAULT '1',
  `print_function` varchar(128) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`checklist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_interview_attachment` */

DROP TABLE IF EXISTS `ww_recruitment_interview_attachment`;

CREATE TABLE `ww_recruitment_interview_attachment` (
  `recruitment_interview_attachment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `schedule_id` int(11) NOT NULL DEFAULT '0',
  `process_id` int(11) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `size` varchar(30) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`recruitment_interview_attachment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_interview_details` */

DROP TABLE IF EXISTS `ww_recruitment_interview_details`;

CREATE TABLE `ww_recruitment_interview_details` (
  `detail_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `interview_id` int(11) NOT NULL DEFAULT '0',
  `key_id` int(1) DEFAULT '0',
  `key` varchar(32) NOT NULL,
  `sequence` tinyint(1) DEFAULT '1',
  `key_name` varchar(64) NOT NULL,
  `key_value` text,
  `other_remarks` text,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`detail_id`),
  UNIQUE KEY `interview_key` (`interview_id`,`sequence`,`key`),
  KEY `interview_id` (`interview_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_interview_key` */

DROP TABLE IF EXISTS `ww_recruitment_interview_key`;

CREATE TABLE `ww_recruitment_interview_key` (
  `key_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `key_code` varchar(32) NOT NULL,
  `key_label` varchar(128) NOT NULL,
  `key_class_id` int(1) DEFAULT '0',
  `uitype_id` int(1) DEFAULT '0',
  `show_key_label` tinyint(1) DEFAULT '1',
  `key_type_id` int(1) DEFAULT '0',
  `sort_order` int(11) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`key_id`),
  KEY `transaction_code` (`key_code`),
  KEY `transaction_class_id` (`key_class_id`),
  KEY `transaction_type_id` (`key_type_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_interview_key_class` */

DROP TABLE IF EXISTS `ww_recruitment_interview_key_class`;

CREATE TABLE `ww_recruitment_interview_key_class` (
  `key_class_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `key_class_code` varchar(32) NOT NULL,
  `key_class` varchar(128) NOT NULL,
  `header_text` varchar(128) DEFAULT NULL,
  `user_edit` tinyint(1) DEFAULT '0',
  `for_approval` tinyint(1) DEFAULT '0',
  `layout` enum('Tabular','By Field','Customize') DEFAULT NULL,
  `layout_custom_file` text,
  `other_remarks` tinyint(1) DEFAULT '0',
  `sort_order` int(1) unsigned DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`key_class_id`),
  KEY `transaction_class_code` (`key_class_code`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_interview_location` */

DROP TABLE IF EXISTS `ww_recruitment_interview_location`;

CREATE TABLE `ww_recruitment_interview_location` (
  `interview_location_id` int(11) NOT NULL AUTO_INCREMENT,
  `interview_location_code` varchar(32) DEFAULT NULL,
  `interview_location` varchar(150) DEFAULT NULL,
  `company_id` int(1) DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`interview_location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_interview_remarks` */

DROP TABLE IF EXISTS `ww_recruitment_interview_remarks`;

CREATE TABLE `ww_recruitment_interview_remarks` (
  `remarks_id` int(11) NOT NULL AUTO_INCREMENT,
  `remarks_code` varchar(32) DEFAULT NULL,
  `remarks` varchar(64) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`remarks_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_interview_uitype` */

DROP TABLE IF EXISTS `ww_recruitment_interview_uitype`;

CREATE TABLE `ww_recruitment_interview_uitype` (
  `uitype_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `uitype` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`uitype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_key` */

DROP TABLE IF EXISTS `ww_recruitment_key`;

CREATE TABLE `ww_recruitment_key` (
  `key_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `key_code` varchar(32) NOT NULL,
  `key_label` varchar(128) DEFAULT NULL,
  `key_class_id` int(1) DEFAULT '0',
  `key_type_id` int(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`key_id`),
  KEY `transaction_code` (`key_code`),
  KEY `transaction_class_id` (`key_class_id`),
  KEY `transaction_type_id` (`key_type_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=217 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_key_class` */

DROP TABLE IF EXISTS `ww_recruitment_key_class`;

CREATE TABLE `ww_recruitment_key_class` (
  `key_class_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `key_class_code` varchar(32) NOT NULL,
  `key_class` varchar(128) NOT NULL,
  `user_edit` tinyint(1) DEFAULT '0',
  `for_approval` tinyint(1) DEFAULT '0',
  `sort_order` int(1) unsigned DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`key_class_id`),
  KEY `transaction_class_code` (`key_class_code`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_manpower_plan` */

DROP TABLE IF EXISTS `ww_recruitment_manpower_plan`;

CREATE TABLE `ww_recruitment_manpower_plan` (
  `plan_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `display_name` varchar(155) DEFAULT NULL,
  `alias` varchar(64) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `status_id` int(1) DEFAULT '1',
  `manpower_plan_status_id` int(11) DEFAULT '1',
  `attachment` text,
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `date_approved` date DEFAULT NULL,
  `date_declined` date DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`plan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_manpower_plan_action` */

DROP TABLE IF EXISTS `ww_recruitment_manpower_plan_action`;

CREATE TABLE `ww_recruitment_manpower_plan_action` (
  `action_id` int(1) NOT NULL AUTO_INCREMENT,
  `action` varchar(32) DEFAULT NULL,
  `class` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_manpower_plan_approver` */

DROP TABLE IF EXISTS `ww_recruitment_manpower_plan_approver`;

CREATE TABLE `ww_recruitment_manpower_plan_approver` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `approver_id` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(64) CHARACTER SET latin1 DEFAULT '',
  `condition` enum('ALL','By Level','Either Of') DEFAULT 'By Level',
  `sequence` tinyint(1) DEFAULT '1',
  `plan_status_id` int(1) DEFAULT '0',
  `plan_status` varchar(16) DEFAULT '',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `forms_user` (`plan_id`,`user_id`,`sequence`),
  KEY `forms_id` (`plan_id`),
  KEY `user_id` (`user_id`),
  KEY `sequence` (`sequence`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_manpower_plan_incumbent` */

DROP TABLE IF EXISTS `ww_recruitment_manpower_plan_incumbent`;

CREATE TABLE `ww_recruitment_manpower_plan_incumbent` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL,
  `position_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `alias` varchar(64) DEFAULT NULL,
  `action_id` int(1) DEFAULT '0',
  `action` varchar(32) DEFAULT NULL,
  `year` int(1) DEFAULT '0',
  `month` int(1) DEFAULT '0',
  `budget` decimal(9,2) DEFAULT '0.00',
  `company_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_manpower_plan_position` */

DROP TABLE IF EXISTS `ww_recruitment_manpower_plan_position`;

CREATE TABLE `ww_recruitment_manpower_plan_position` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL,
  `position_id` int(11) DEFAULT NULL,
  `job_rank_id` int(11) DEFAULT NULL,
  `employment_status_id` int(11) DEFAULT NULL,
  `job_class_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `incumbent` int(1) NOT NULL DEFAULT '0',
  `year` int(1) DEFAULT '0',
  `month` int(1) DEFAULT '0',
  `needed` int(1) DEFAULT '0',
  `budget` decimal(9,2) DEFAULT '0.00',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_manpower_plan_position_new` */

DROP TABLE IF EXISTS `ww_recruitment_manpower_plan_position_new`;

CREATE TABLE `ww_recruitment_manpower_plan_position_new` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL,
  `position` varchar(128) DEFAULT NULL,
  `position_code` varchar(16) DEFAULT NULL,
  `job_rank_id` int(1) DEFAULT '0',
  `employment_status_id` int(11) DEFAULT NULL,
  `job_class_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `budget` decimal(8,2) DEFAULT '0.00',
  `month` int(11) DEFAULT NULL,
  `notes` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_manpower_plan_status` */

DROP TABLE IF EXISTS `ww_recruitment_manpower_plan_status`;

CREATE TABLE `ww_recruitment_manpower_plan_status` (
  `manpower_plan_status_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(16) NOT NULL DEFAULT '',
  `color` varchar(8) DEFAULT '#ffffff',
  `description` tinytext,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`manpower_plan_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_mrf_pointperson` */

DROP TABLE IF EXISTS `ww_recruitment_mrf_pointperson`;

CREATE TABLE `ww_recruitment_mrf_pointperson` (
  `pointperson_id` int(11) NOT NULL AUTO_INCREMENT,
  `pointperson` varchar(256) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `type_id` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`pointperson_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_personal` */

DROP TABLE IF EXISTS `ww_recruitment_personal`;

CREATE TABLE `ww_recruitment_personal` (
  `personal_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `recruit_id` int(11) NOT NULL DEFAULT '0',
  `key_id` int(1) DEFAULT '0',
  `key` varchar(32) NOT NULL,
  `sequence` tinyint(1) DEFAULT '1',
  `key_name` varchar(64) NOT NULL,
  `key_value` text,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`personal_id`),
  UNIQUE KEY `partner_key` (`recruit_id`,`sequence`,`key`),
  KEY `partner_id` (`recruit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_personal_history` */

DROP TABLE IF EXISTS `ww_recruitment_personal_history`;

CREATE TABLE `ww_recruitment_personal_history` (
  `personal_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `recruit_id` int(11) NOT NULL DEFAULT '0',
  `key` varchar(32) NOT NULL,
  `sequence` int(1) DEFAULT '1',
  `key_id` int(1) NOT NULL DEFAULT '0',
  `key_name` varchar(64) NOT NULL,
  `key_value` text,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  PRIMARY KEY (`personal_id`),
  UNIQUE KEY `partner_key` (`recruit_id`,`sequence`,`key`),
  KEY `partner_id` (`recruit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_process` */

DROP TABLE IF EXISTS `ww_recruitment_process`;

CREATE TABLE `ww_recruitment_process` (
  `process_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `status_id` int(1) NOT NULL,
  `status` varchar(32) DEFAULT NULL,
  `recruit_id` int(11) NOT NULL,
  `recruit_name` varchar(64) DEFAULT NULL,
  `hired` tinyint(1) DEFAULT '0',
  `hired_when` datetime DEFAULT '0000-00-00 00:00:00',
  `blacklisted` tinyint(1) DEFAULT '0',
  `blacklisted_until` date DEFAULT '0000-00-00',
  `from_seting_final_interview` tinyint(1) DEFAULT '0' COMMENT '1 = from initial interview, 2 = from final interview',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`process_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_process_background` */

DROP TABLE IF EXISTS `ww_recruitment_process_background`;

CREATE TABLE `ww_recruitment_process_background` (
  `rpb_id` int(11) NOT NULL AUTO_INCREMENT,
  `process_id` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rpb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_process_background_items` */

DROP TABLE IF EXISTS `ww_recruitment_process_background_items`;

CREATE TABLE `ww_recruitment_process_background_items` (
  `rpbi_id` int(11) NOT NULL AUTO_INCREMENT,
  `rpb_id` int(11) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `reference_person` varchar(100) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `employment_status` varchar(255) DEFAULT '0',
  `date_hired` date DEFAULT NULL,
  `date_resigned` date DEFAULT NULL,
  `reason_for_leaving` varchar(255) DEFAULT NULL,
  `q1` tinyint(1) DEFAULT '0',
  `q1_ans` text,
  `q2` tinyint(1) DEFAULT '0',
  `q3` tinyint(1) DEFAULT '0',
  `q4_ans` text,
  `q5` varchar(10) DEFAULT NULL,
  `q5_ans` text,
  `q6_ans` text,
  `q7_ans` text,
  `q8` tinyint(1) DEFAULT '0',
  `q9_ans` text,
  `q10` tinyint(1) DEFAULT '0',
  `q11` tinyint(1) DEFAULT '0',
  `q12` tinyint(1) DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rpbi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_process_employment` */

DROP TABLE IF EXISTS `ww_recruitment_process_employment`;

CREATE TABLE `ww_recruitment_process_employment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `process_id` int(11) NOT NULL,
  `status_id` int(1) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_process_employment_checklist` */

DROP TABLE IF EXISTS `ww_recruitment_process_employment_checklist`;

CREATE TABLE `ww_recruitment_process_employment_checklist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `process_id` int(11) DEFAULT NULL,
  `checklist_id` int(11) NOT NULL,
  `submitted` tinyint(1) DEFAULT '0',
  `date_submitted` date DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_process_exam` */

DROP TABLE IF EXISTS `ww_recruitment_process_exam`;

CREATE TABLE `ww_recruitment_process_exam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `process_id` varchar(150) DEFAULT NULL,
  `exam_name` varchar(150) DEFAULT NULL,
  `date_taken` date DEFAULT '0000-00-00',
  `score` decimal(5,2) NOT NULL DEFAULT '0.00',
  `status_id` tinyint(1) NOT NULL DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_process_interview` */

DROP TABLE IF EXISTS `ww_recruitment_process_interview`;

CREATE TABLE `ww_recruitment_process_interview` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `process_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `final_schedule_id` int(11) DEFAULT NULL,
  `result_id` int(1) NOT NULL,
  `result` varchar(16) DEFAULT NULL,
  `strength` text,
  `jobfit` text,
  `area_improvement` text,
  `recommendation_id` int(1) DEFAULT NULL,
  `recommendation` varchar(64) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_process_interview_result` */

DROP TABLE IF EXISTS `ww_recruitment_process_interview_result`;

CREATE TABLE `ww_recruitment_process_interview_result` (
  `result_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `result` varchar(250) DEFAULT NULL,
  `class` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`result_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_process_offer` */

DROP TABLE IF EXISTS `ww_recruitment_process_offer`;

CREATE TABLE `ww_recruitment_process_offer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `process_id` int(11) NOT NULL,
  `employment_status_id` int(1) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `no_months` int(1) DEFAULT NULL,
  `reports_to` int(1) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `template_value` text,
  `work_schedule` int(1) DEFAULT NULL,
  `shift_id` int(1) DEFAULT NULL,
  `lunch_break` int(1) DEFAULT NULL,
  `accept_offer` tinyint(1) DEFAULT '0',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_process_offer_compben` */

DROP TABLE IF EXISTS `ww_recruitment_process_offer_compben`;

CREATE TABLE `ww_recruitment_process_offer_compben` (
  `process_id` int(11) NOT NULL,
  `benefit_id` int(11) NOT NULL,
  `permanent` tinyint(1) DEFAULT '0',
  `amount` decimal(9,2) DEFAULT '0.00',
  `rate_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_process_offer_template` */

DROP TABLE IF EXISTS `ww_recruitment_process_offer_template`;

CREATE TABLE `ww_recruitment_process_offer_template` (
  `template_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `template_name` varchar(100) NOT NULL,
  `template` text,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`template_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_process_schedule` */

DROP TABLE IF EXISTS `ww_recruitment_process_schedule`;

CREATE TABLE `ww_recruitment_process_schedule` (
  `schedule_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `process_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `display_name` varchar(64) DEFAULT NULL,
  `date` datetime DEFAULT '0000-00-00 00:00:00',
  `location_id` int(1) NOT NULL DEFAULT '0',
  `location` varchar(128) DEFAULT NULL,
  `status_id` int(1) NOT NULL,
  `status` varchar(32) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '1' COMMENT '1 = initial interview, 2 = final interview',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`schedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_process_signing` */

DROP TABLE IF EXISTS `ww_recruitment_process_signing`;

CREATE TABLE `ww_recruitment_process_signing` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `process_id` int(11) NOT NULL,
  `template_id` int(11) DEFAULT NULL,
  `accepted` int(1) DEFAULT '0',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_process_status` */

DROP TABLE IF EXISTS `ww_recruitment_process_status`;

CREATE TABLE `ww_recruitment_process_status` (
  `status_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `status_code` varchar(16) NOT NULL,
  `status` varchar(64) NOT NULL,
  `label` varchar(125) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `can_view` tinyint(1) DEFAULT '1',
  `can_delete` tinyint(1) DEFAULT '0',
  `user_edit` tinyint(1) DEFAULT '0',
  `for_approval` tinyint(1) DEFAULT '0',
  `sort_order` int(1) DEFAULT '1',
  `active` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_process_timeline` */

DROP TABLE IF EXISTS `ww_recruitment_process_timeline`;

CREATE TABLE `ww_recruitment_process_timeline` (
  `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `process_id` int(11) NOT NULL,
  `status_id` int(1) NOT NULL,
  `status` varchar(32) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_request` */

DROP TABLE IF EXISTS `ww_recruitment_request`;

CREATE TABLE `ww_recruitment_request` (
  `request_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `document_no` varchar(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `alias` varchar(64) DEFAULT NULL,
  `status_id` int(11) DEFAULT '0',
  `position_id` int(11) NOT NULL,
  `position` varchar(128) DEFAULT NULL,
  `nature_id` int(11) DEFAULT NULL,
  `job_class_id` int(11) DEFAULT NULL,
  `budgeted` int(11) DEFAULT NULL,
  `replacement_of` int(11) NOT NULL,
  `due_to_id` int(11) DEFAULT NULL,
  `replacement_transfer_location` varchar(100) DEFAULT NULL,
  `replacement_transfer_leave_date_from` date DEFAULT NULL,
  `replacement_transfer_leave_date_to` date DEFAULT NULL,
  `employment_status_id` int(11) NOT NULL,
  `contract_duration` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `age_range_from` int(11) DEFAULT NULL,
  `age_range_to` int(11) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `civil_status_id` int(11) DEFAULT NULL,
  `date_needed` date NOT NULL,
  `max_no_personel` int(11) DEFAULT NULL,
  `total_no_incumbent` int(11) DEFAULT NULL,
  `salary_from` varchar(250) NOT NULL,
  `salary_to` varchar(250) NOT NULL,
  `description` text,
  `date_approved` datetime DEFAULT NULL,
  `date_cancelled` datetime DEFAULT NULL,
  `date_disapproved` datetime DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT '0',
  `department_id` int(11) DEFAULT '0',
  `rank_id` int(11) DEFAULT '0',
  `hiring_type` int(11) DEFAULT NULL COMMENT 'internal,external,both',
  `internal` tinyint(1) NOT NULL DEFAULT '0',
  `tat_days` int(11) DEFAULT '0',
  `role_id` varchar(32) DEFAULT NULL,
  `attachment` text,
  `delivery_date` date NOT NULL DEFAULT '0000-00-00',
  `hr_remarks` text,
  `educational_attainment` varchar(255) DEFAULT NULL,
  `budget_from` varchar(50) DEFAULT NULL,
  `budget_to` varchar(50) DEFAULT NULL,
  `hr_remarks_by` int(11) DEFAULT '0',
  `hr_remarks_on` datetime DEFAULT NULL,
  `hr_assigned` int(11) DEFAULT '0',
  `closing_remarks` text,
  `closed_on` datetime DEFAULT '0000-00-00 00:00:00',
  `closed_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`request_id`,`document_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_request_approver` */

DROP TABLE IF EXISTS `ww_recruitment_request_approver`;

CREATE TABLE `ww_recruitment_request_approver` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `approver_id` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(64) CHARACTER SET latin1 DEFAULT '',
  `condition` enum('ALL','By Level','Either Of') DEFAULT 'By Level',
  `sequence` tinyint(1) DEFAULT '1',
  `status_id` int(1) DEFAULT NULL,
  `status` varchar(16) DEFAULT '',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime DEFAULT NULL,
  `comment` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `forms_user` (`request_id`,`user_id`,`sequence`),
  KEY `forms_id` (`request_id`),
  KEY `user_id` (`user_id`),
  KEY `sequence` (`sequence`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_request_details` */

DROP TABLE IF EXISTS `ww_recruitment_request_details`;

CREATE TABLE `ww_recruitment_request_details` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL DEFAULT '0',
  `key` varchar(32) NOT NULL,
  `sequence` int(1) DEFAULT '1',
  `key_id` int(1) NOT NULL DEFAULT '0',
  `key_name` varchar(64) NOT NULL,
  `key_value` text,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_request_due_to` */

DROP TABLE IF EXISTS `ww_recruitment_request_due_to`;

CREATE TABLE `ww_recruitment_request_due_to` (
  `due_to_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `due_to` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`due_to_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_request_key` */

DROP TABLE IF EXISTS `ww_recruitment_request_key`;

CREATE TABLE `ww_recruitment_request_key` (
  `key_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key_code` varchar(32) NOT NULL,
  `key_label` varchar(128) NOT NULL,
  `help_block` text,
  `key_class_id` int(11) DEFAULT NULL,
  `sequence` int(1) unsigned DEFAULT '1',
  `uitype_id` int(11) DEFAULT NULL,
  `length` int(1) NOT NULL DEFAULT '1',
  `key_table` varchar(250) DEFAULT NULL,
  `key_field_id` varchar(250) DEFAULT NULL,
  `key_field` varchar(250) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_request_key_class` */

DROP TABLE IF EXISTS `ww_recruitment_request_key_class`;

CREATE TABLE `ww_recruitment_request_key_class` (
  `key_class_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `key_class_code` varchar(32) NOT NULL,
  `key_class` varchar(128) NOT NULL,
  `description` text,
  `user_edit` tinyint(1) DEFAULT '0',
  `for_approval` tinyint(1) DEFAULT '0',
  `sequence` int(1) unsigned DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`key_class_id`),
  KEY `transaction_class_code` (`key_class_code`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_request_nature` */

DROP TABLE IF EXISTS `ww_recruitment_request_nature`;

CREATE TABLE `ww_recruitment_request_nature` (
  `nature_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `nature` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`nature_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_request_option_education` */

DROP TABLE IF EXISTS `ww_recruitment_request_option_education`;

CREATE TABLE `ww_recruitment_request_option_education` (
  `request_option_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `request_option` varchar(32) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`request_option_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_request_option_gender` */

DROP TABLE IF EXISTS `ww_recruitment_request_option_gender`;

CREATE TABLE `ww_recruitment_request_option_gender` (
  `request_option_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `request_option` varchar(16) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`request_option_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_request_status` */

DROP TABLE IF EXISTS `ww_recruitment_request_status`;

CREATE TABLE `ww_recruitment_request_status` (
  `recruit_status_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `recruit_status` varchar(16) NOT NULL DEFAULT '',
  `color` varchar(8) DEFAULT '#ffffff',
  `sequence` int(1) DEFAULT '1',
  `description` tinytext,
  `css_class` varchar(16) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`recruit_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_source` */

DROP TABLE IF EXISTS `ww_recruitment_source`;

CREATE TABLE `ww_recruitment_source` (
  `source_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `source` varchar(64) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`source_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_sourcing_free_sites` */

DROP TABLE IF EXISTS `ww_recruitment_sourcing_free_sites`;

CREATE TABLE `ww_recruitment_sourcing_free_sites` (
  `sourcing_free_sites_id` int(11) NOT NULL AUTO_INCREMENT,
  `sourcing_free_sites` varchar(150) DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`sourcing_free_sites_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_sourcing_tools` */

DROP TABLE IF EXISTS `ww_recruitment_sourcing_tools`;

CREATE TABLE `ww_recruitment_sourcing_tools` (
  `sourcing_tool_id` int(11) NOT NULL AUTO_INCREMENT,
  `sourcing_tool_code` varchar(32) DEFAULT NULL,
  `sourcing_tool` varchar(150) DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`sourcing_tool_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_status` */

DROP TABLE IF EXISTS `ww_recruitment_status`;

CREATE TABLE `ww_recruitment_status` (
  `recruit_status_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `recruit_status` varchar(64) NOT NULL DEFAULT '',
  `color` varchar(8) DEFAULT '#ffffff',
  `sequence` int(1) DEFAULT '1',
  `description` tinytext,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`recruit_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_recruitment_type_license` */

DROP TABLE IF EXISTS `ww_recruitment_type_license`;

CREATE TABLE `ww_recruitment_type_license` (
  `type_license_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_license` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`type_license_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `ww_report_generator` */

DROP TABLE IF EXISTS `ww_report_generator`;

CREATE TABLE `ww_report_generator` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_code` varchar(128) DEFAULT NULL,
  `report_name` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `description` text,
  `main_query` text,
  `roles` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_report_generator_category` */

DROP TABLE IF EXISTS `ww_report_generator_category`;

CREATE TABLE `ww_report_generator_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(128) DEFAULT NULL,
  `caption` text,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_report_generator_column_format` */

DROP TABLE IF EXISTS `ww_report_generator_column_format`;

CREATE TABLE `ww_report_generator_column_format` (
  `format_id` int(11) NOT NULL AUTO_INCREMENT,
  `format` varchar(64) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`format_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_report_generator_columns` */

DROP TABLE IF EXISTS `ww_report_generator_columns`;

CREATE TABLE `ww_report_generator_columns` (
  `report_id` int(11) DEFAULT NULL,
  `column` varchar(128) CHARACTER SET latin1 DEFAULT NULL,
  `alias` varchar(128) CHARACTER SET latin1 DEFAULT NULL,
  `format_id` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_report_generator_filter_operators` */

DROP TABLE IF EXISTS `ww_report_generator_filter_operators`;

CREATE TABLE `ww_report_generator_filter_operators` (
  `operator_id` int(11) NOT NULL AUTO_INCREMENT,
  `operator` varchar(16) DEFAULT NULL,
  `label` varchar(64) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`operator_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_report_generator_filter_uitype` */

DROP TABLE IF EXISTS `ww_report_generator_filter_uitype`;

CREATE TABLE `ww_report_generator_filter_uitype` (
  `uitype_id` int(11) NOT NULL AUTO_INCREMENT,
  `uitype` varchar(128) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`uitype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_report_generator_filters` */

DROP TABLE IF EXISTS `ww_report_generator_filters`;

CREATE TABLE `ww_report_generator_filters` (
  `filter_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) DEFAULT NULL,
  `column` varchar(128) CHARACTER SET latin1 DEFAULT NULL,
  `operator` varchar(2) CHARACTER SET latin1 DEFAULT NULL,
  `filter` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `type` tinyint(1) DEFAULT '1',
  `logical_operator` varchar(3) DEFAULT 'AND',
  `bracket` int(11) DEFAULT NULL,
  `required` tinyint(1) DEFAULT '0',
  `uitype_id` tinyint(4) DEFAULT NULL,
  `table` varchar(128) CHARACTER SET latin1 DEFAULT NULL,
  `value_column` varchar(128) DEFAULT NULL,
  `label_column` varchar(128) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `filtering_only` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`filter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4456 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_report_generator_grouping` */

DROP TABLE IF EXISTS `ww_report_generator_grouping`;

CREATE TABLE `ww_report_generator_grouping` (
  `report_id` int(11) DEFAULT NULL,
  `column` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_report_generator_letterhead` */

DROP TABLE IF EXISTS `ww_report_generator_letterhead`;

CREATE TABLE `ww_report_generator_letterhead` (
  `report_id` int(11) DEFAULT NULL,
  `template` varchar(255) DEFAULT NULL,
  `place_in` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_report_generator_role` */

DROP TABLE IF EXISTS `ww_report_generator_role`;

CREATE TABLE `ww_report_generator_role` (
  `report_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_report_generator_sorting` */

DROP TABLE IF EXISTS `ww_report_generator_sorting`;

CREATE TABLE `ww_report_generator_sorting` (
  `report_id` int(11) DEFAULT NULL,
  `column` varchar(128) DEFAULT NULL,
  `sorting` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_report_generator_tables` */

DROP TABLE IF EXISTS `ww_report_generator_tables`;

CREATE TABLE `ww_report_generator_tables` (
  `report_table_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) DEFAULT NULL,
  `table` varchar(128) CHARACTER SET eucjpms DEFAULT NULL,
  `primary` tinyint(1) DEFAULT '0',
  `alias` varchar(3) CHARACTER SET eucjpms DEFAULT NULL,
  `join_type` varchar(10) CHARACTER SET eucjpms DEFAULT NULL,
  `join_from_column` varchar(128) CHARACTER SET eucjpms DEFAULT NULL,
  `on_operator` varchar(2) CHARACTER SET eucjpms DEFAULT NULL,
  `join_to_column` varchar(128) CHARACTER SET eucjpms DEFAULT NULL,
  PRIMARY KEY (`report_table_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1511 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_report_result_filters` */

DROP TABLE IF EXISTS `ww_report_result_filters`;

CREATE TABLE `ww_report_result_filters` (
  `result_id` int(11) DEFAULT NULL,
  `column` varchar(128) DEFAULT NULL,
  `operator` varchar(2) DEFAULT NULL,
  `filter` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_report_results` */

DROP TABLE IF EXISTS `ww_report_results`;

CREATE TABLE `ww_report_results` (
  `result_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  `file_type` varchar(16) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`result_id`),
  KEY `createdon` (`created_on`)
) ENGINE=InnoDB AUTO_INCREMENT=43746 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_requisition` */

DROP TABLE IF EXISTS `ww_requisition`;

CREATE TABLE `ww_requisition` (
  `requisition_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) DEFAULT NULL,
  `priority_id` tinyint(4) DEFAULT NULL,
  `status_id` tinyint(4) DEFAULT '1',
  `mc_approval` tinyint(1) DEFAULT '0',
  `approver` int(11) DEFAULT NULL,
  `no_of_items` int(11) DEFAULT '0',
  `total_price` decimal(8,2) DEFAULT '0.00',
  `actual_total_price` decimal(8,2) DEFAULT '0.00',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`requisition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_requisition_items` */

DROP TABLE IF EXISTS `ww_requisition_items`;

CREATE TABLE `ww_requisition_items` (
  `requisition_id` int(11) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `reason` text,
  `date` date DEFAULT NULL,
  `quantity` decimal(8,2) DEFAULT NULL,
  `unit_price` decimal(8,2) DEFAULT NULL,
  `actual_price` decimal(8,2) DEFAULT NULL,
  `po_number` varchar(32) DEFAULT NULL,
  `po_note` text,
  `po_quantity` decimal(8,2) DEFAULT NULL,
  `po_price` decimal(8,2) DEFAULT NULL,
  `received_quantity` decimal(8,2) DEFAULT NULL,
  `date_received` date DEFAULT NULL,
  `accounting_remarks` text,
  `proceed` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_requisition_mc_signatories` */

DROP TABLE IF EXISTS `ww_requisition_mc_signatories`;

CREATE TABLE `ww_requisition_mc_signatories` (
  `requisition_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `status_id` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_requisition_priority` */

DROP TABLE IF EXISTS `ww_requisition_priority`;

CREATE TABLE `ww_requisition_priority` (
  `priority_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `priority` varchar(64) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`priority_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_requisition_remarks` */

DROP TABLE IF EXISTS `ww_requisition_remarks`;

CREATE TABLE `ww_requisition_remarks` (
  `requisition_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `remarks` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_requisition_status` */

DROP TABLE IF EXISTS `ww_requisition_status`;

CREATE TABLE `ww_requisition_status` (
  `status_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `status` varchar(64) DEFAULT NULL,
  `description` text,
  `class` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_resources_category` */

DROP TABLE IF EXISTS `ww_resources_category`;

CREATE TABLE `ww_resources_category` (
  `category_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(32) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_resources_downloadable` */

DROP TABLE IF EXISTS `ww_resources_downloadable`;

CREATE TABLE `ww_resources_downloadable` (
  `resource_download_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `category` enum('Internal','External') NOT NULL DEFAULT 'Internal',
  `description` text,
  `attachments` varchar(128) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`resource_download_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_resources_policies` */

DROP TABLE IF EXISTS `ww_resources_policies`;

CREATE TABLE `ww_resources_policies` (
  `resource_policy_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `category` enum('Internal','External') NOT NULL DEFAULT 'Internal',
  `description` text,
  `attachments` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`resource_policy_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_resources_request` */

DROP TABLE IF EXISTS `ww_resources_request`;

CREATE TABLE `ww_resources_request` (
  `request_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `request` varchar(128) DEFAULT NULL,
  `request_status_id` int(11) NOT NULL,
  `status` enum('Open','Pending','Close') NOT NULL DEFAULT 'Open',
  `date_needed` date DEFAULT NULL,
  `reason` text,
  `date_sent` timestamp NULL DEFAULT NULL,
  `remarks` text,
  `notify_immediate` int(1) DEFAULT '0',
  `notify_others` varchar(128) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_resources_request_approver` */

DROP TABLE IF EXISTS `ww_resources_request_approver`;

CREATE TABLE `ww_resources_request_approver` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(64) CHARACTER SET latin1 DEFAULT '',
  `condition` enum('ALL','By Level','Either Of') DEFAULT 'By Level',
  `sequence` tinyint(1) DEFAULT '1',
  `request_status_id` int(1) DEFAULT '0',
  `request_status` varchar(16) DEFAULT '',
  `comment_date` datetime DEFAULT '0000-00-00 00:00:00',
  `comment` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `request_user` (`request_id`,`user_id`,`sequence`),
  KEY `request_id` (`request_id`),
  KEY `user_id` (`user_id`),
  KEY `sequence` (`sequence`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_resources_request_notes` */

DROP TABLE IF EXISTS `ww_resources_request_notes`;

CREATE TABLE `ww_resources_request_notes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` int(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `notes` text,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_resources_request_status` */

DROP TABLE IF EXISTS `ww_resources_request_status`;

CREATE TABLE `ww_resources_request_status` (
  `request_status_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `request_status` varchar(16) NOT NULL DEFAULT '',
  `color` varchar(8) DEFAULT '#ffffff',
  `description` tinytext,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`request_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_resources_request_upload` */

DROP TABLE IF EXISTS `ww_resources_request_upload`;

CREATE TABLE `ww_resources_request_upload` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` int(11) unsigned NOT NULL,
  `upload_id` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `request_id` (`request_id`),
  KEY `upload_id` (`upload_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_resources_request_upload_hr` */

DROP TABLE IF EXISTS `ww_resources_request_upload_hr`;

CREATE TABLE `ww_resources_request_upload_hr` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` int(11) unsigned NOT NULL,
  `upload_id` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `request_id` (`request_id`),
  KEY `upload_id` (`upload_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_roles` */

DROP TABLE IF EXISTS `ww_roles`;

CREATE TABLE `ww_roles` (
  `role_id` int(1) NOT NULL AUTO_INCREMENT,
  `role` varchar(64) NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `description` varchar(255) DEFAULT NULL,
  `profile_id` varchar(255) DEFAULT NULL,
  `category_id` varchar(255) DEFAULT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`role_id`),
  KEY `role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_roles_category` */

DROP TABLE IF EXISTS `ww_roles_category`;

CREATE TABLE `ww_roles_category` (
  `role_category_id` int(1) NOT NULL AUTO_INCREMENT,
  `role_id` varchar(64) NOT NULL,
  `category_field` varchar(255) NOT NULL DEFAULT '0',
  `category_val` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`role_category_id`),
  KEY `role` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_roles_menu` */

DROP TABLE IF EXISTS `ww_roles_menu`;

CREATE TABLE `ww_roles_menu` (
  `menu_item_id` int(1) unsigned NOT NULL,
  `role_id` int(1) NOT NULL,
  UNIQUE KEY `profile_id` (`role_id`,`menu_item_id`),
  KEY `menu_item_id` (`menu_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_roles_profile` */

DROP TABLE IF EXISTS `ww_roles_profile`;

CREATE TABLE `ww_roles_profile` (
  `role_id` int(1) NOT NULL DEFAULT '0',
  `profile_id` int(1) NOT NULL DEFAULT '0',
  KEY `role_id` (`role_id`),
  KEY `profile_id` (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_scheduler` */

DROP TABLE IF EXISTS `ww_scheduler`;

CREATE TABLE `ww_scheduler` (
  `scheduler_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) DEFAULT NULL,
  `sp_function` varchar(150) DEFAULT NULL,
  `arguments` varchar(255) DEFAULT NULL,
  `description` text,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`scheduler_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `ww_searchable_type` */

DROP TABLE IF EXISTS `ww_searchable_type`;

CREATE TABLE `ww_searchable_type` (
  `searchable_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `searchable_type` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`searchable_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_sensitivity` */

DROP TABLE IF EXISTS `ww_sensitivity`;

CREATE TABLE `ww_sensitivity` (
  `sensitivity_id` int(11) NOT NULL AUTO_INCREMENT,
  `sensitivity` varchar(32) DEFAULT NULL,
  `description` text,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`sensitivity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_sessions` */

DROP TABLE IF EXISTS `ww_sessions`;

CREATE TABLE `ww_sessions` (
  `session_id` varchar(40) NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `user_agent` text NOT NULL,
  `last_activity` int(11) NOT NULL,
  `user_data` longtext NOT NULL,
  `delete_counter` int(1) DEFAULT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_system_birthday` */

DROP TABLE IF EXISTS `ww_system_birthday`;

CREATE TABLE `ww_system_birthday` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('info','success','warning','danger') DEFAULT 'info',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(64) DEFAULT '',
  `content` text,
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `recipient_id` int(11) NOT NULL DEFAULT '0' COMMENT 'thankyou: array of user ids',
  `readon` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'whoread: array of user ids',
  `createdon` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `reactedon` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `createdon` (`createdon`),
  KEY `readon` (`readon`),
  KEY `deleted` (`deleted`),
  KEY `recipient_id` (`birthday`,`recipient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_system_chat` */

DROP TABLE IF EXISTS `ww_system_chat`;

CREATE TABLE `ww_system_chat` (
  `from` int(11) DEFAULT NULL,
  `from_name` varchar(64) DEFAULT NULL,
  `to` int(11) DEFAULT NULL,
  `to_name` varchar(64) DEFAULT NULL,
  `message` text,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seen` tinyint(1) DEFAULT '0',
  KEY `from` (`from`),
  KEY `to` (`to`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_system_email_queue` */

DROP TABLE IF EXISTS `ww_system_email_queue`;

CREATE TABLE `ww_system_email_queue` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `timein` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('queued','sending','sent') DEFAULT 'queued',
  `to` text,
  `cc` text,
  `bcc` text,
  `subject` varchar(128) DEFAULT NULL,
  `body` text,
  `attachment` text,
  `attempts` tinyint(1) DEFAULT '0',
  `sent_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_system_feeds` */

DROP TABLE IF EXISTS `ww_system_feeds`;

CREATE TABLE `ww_system_feeds` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('info','success','warning','danger') DEFAULT 'info',
  `message_type` enum('Admin','Announcement','Birthday','Comment','Company News','Feedback','Partners','Personnel','System','Time Record','Code of Conduct','Movement','Signatories','Clearance','Recruitment','Performance Appraisal') DEFAULT 'Comment',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(64) DEFAULT '',
  `feed_content` text,
  `uri` varchar(128) DEFAULT NULL,
  `record_id` int(11) DEFAULT '0',
  `recipient_id` int(11) DEFAULT '0' COMMENT 'thankyou: array of user ids',
  `readon` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'whoread: array of user ids',
  `createdon` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedon` datetime DEFAULT NULL,
  `reactedon` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `createdon` (`createdon`),
  KEY `readon` (`readon`),
  KEY `deleted` (`deleted`),
  KEY `recipient_id` (`recipient_id`,`createdon`,`deleted`),
  KEY `recipient` (`recipient_id`),
  KEY `record_id` (`record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_system_feeds_comments` */

DROP TABLE IF EXISTS `ww_system_feeds_comments`;

CREATE TABLE `ww_system_feeds_comments` (
  `feeds_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `comment` text,
  `createdon` timestamp NULL DEFAULT NULL,
  `modifiedon` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`feeds_comment_id`),
  KEY `id_user` (`id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_system_feeds_recipient` */

DROP TABLE IF EXISTS `ww_system_feeds_recipient`;

CREATE TABLE `ww_system_feeds_recipient` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `department_id` int(11) DEFAULT '0',
  `like` tinyint(1) DEFAULT '0',
  `view` tinyint(1) DEFAULT '0',
  `like_date` datetime DEFAULT NULL,
  `view_date` datetime DEFAULT NULL,
  UNIQUE KEY `id_user` (`id`,`user_id`),
  KEY `id_department` (`id`,`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_system_inbox` */

DROP TABLE IF EXISTS `ww_system_inbox`;

CREATE TABLE `ww_system_inbox` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('info','success','warning','danger') DEFAULT 'info',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(64) DEFAULT '',
  `content` text,
  `recipient_id` int(11) DEFAULT '0' COMMENT 'thankyou: array of user ids',
  `readon` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'whoread: array of user ids',
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reactedon` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `recipient_id` (`recipient_id`),
  KEY `createdon` (`createdon`),
  KEY `readon` (`readon`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_system_inbox_recipient` */

DROP TABLE IF EXISTS `ww_system_inbox_recipient`;

CREATE TABLE `ww_system_inbox_recipient` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  KEY `id_user` (`id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_system_messages` */

DROP TABLE IF EXISTS `ww_system_messages`;

CREATE TABLE `ww_system_messages` (
  `msg_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `msg_type` enum('success','error','attention','warning') NOT NULL,
  `msg_code` varchar(64) DEFAULT NULL,
  `msg` text,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`msg_id`),
  KEY `msg_code` (`msg_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_system_messages_template` */

DROP TABLE IF EXISTS `ww_system_messages_template`;

CREATE TABLE `ww_system_messages_template` (
  `msg_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `msg_type` enum('success','error','attention','warning') NOT NULL,
  `module` enum('Dashboard','My Account','Partners','Time Record','Personnel','Appraisal','Training','Analytics') DEFAULT NULL,
  `ext_code` varchar(8) DEFAULT '',
  `msg_code` varchar(64) DEFAULT NULL,
  `msg` text,
  `variable` text,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`msg_id`),
  KEY `msg_code` (`msg_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_system_password_request` */

DROP TABLE IF EXISTS `ww_system_password_request`;

CREATE TABLE `ww_system_password_request` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `email` varchar(128) NOT NULL,
  `hash` varchar(128) DEFAULT '',
  `datetime_of_request` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiration` datetime DEFAULT NULL,
  `link` varchar(128) NOT NULL,
  `confirmed` tinyint(1) DEFAULT '0',
  `randomized` varchar(8) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_system_series` */

DROP TABLE IF EXISTS `ww_system_series`;

CREATE TABLE `ww_system_series` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `series_code` varchar(32) NOT NULL,
  `series_format` varchar(64) NOT NULL,
  `sequence` int(3) NOT NULL DEFAULT '1',
  `last_sequence` varchar(64) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_system_series_variable` */

DROP TABLE IF EXISTS `ww_system_series_variable`;

CREATE TABLE `ww_system_series_variable` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_code` varchar(32) NOT NULL,
  `id_format` varchar(32) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_system_sms_queue` */

DROP TABLE IF EXISTS `ww_system_sms_queue`;

CREATE TABLE `ww_system_sms_queue` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `timein` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('queued','sending','sent') DEFAULT 'queued',
  `to` tinytext,
  `cc` text,
  `bcc` text,
  `subject` varchar(128) DEFAULT NULL,
  `body` text,
  `attachment` text,
  `attempts` tinyint(1) DEFAULT '0',
  `sent_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_system_support` */

DROP TABLE IF EXISTS `ww_system_support`;

CREATE TABLE `ww_system_support` (
  `msg_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `msg_code` varchar(64) DEFAULT NULL,
  `msg` text,
  `user_id` int(11) DEFAULT NULL,
  `attachment` varchar(128) DEFAULT NULL,
  `upload` varchar(128) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`msg_id`),
  KEY `msg_code` (`msg_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_system_template` */

DROP TABLE IF EXISTS `ww_system_template`;

CREATE TABLE `ww_system_template` (
  `template_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `mod_id` int(1) NOT NULL,
  `code` varchar(64) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `subject` varchar(64) DEFAULT NULL,
  `body` text,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`template_id`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_system_upload_log` */

DROP TABLE IF EXISTS `ww_system_upload_log`;

CREATE TABLE `ww_system_upload_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(11) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `filesize` int(11) DEFAULT NULL,
  `rows` int(11) DEFAULT NULL,
  `valid_count` int(11) DEFAULT NULL,
  `error_count` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_system_upload_template` */

DROP TABLE IF EXISTS `ww_system_upload_template`;

CREATE TABLE `ww_system_upload_template` (
  `template_id` int(11) NOT NULL AUTO_INCREMENT,
  `template_code` varchar(16) DEFAULT NULL,
  `template_name` varchar(255) DEFAULT NULL,
  `delimiter` varchar(6) DEFAULT NULL,
  `sample_name` varchar(128) DEFAULT NULL,
  `sample_path` varchar(128) DEFAULT NULL,
  `accepted_file_types` varchar(128) DEFAULT NULL,
  `skip_headers` varchar(1) DEFAULT '0',
  `module_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`template_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_system_upload_template_column` */

DROP TABLE IF EXISTS `ww_system_upload_template_column`;

CREATE TABLE `ww_system_upload_template_column` (
  `template_id` int(11) DEFAULT NULL,
  `table` varchar(64) DEFAULT NULL,
  `column` varchar(64) DEFAULT NULL,
  `data_type` varchar(32) DEFAULT NULL,
  `length` tinyint(4) DEFAULT NULL,
  `required` tinyint(1) DEFAULT '0',
  `sequence` tinyint(4) DEFAULT NULL,
  `encrypt` tinyint(1) DEFAULT '0',
  `allow_blank` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_system_uploads` */

DROP TABLE IF EXISTS `ww_system_uploads`;

CREATE TABLE `ww_system_uploads` (
  `upload_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mod_id` int(1) NOT NULL DEFAULT '0',
  `field_id` int(1) NOT NULL DEFAULT '0',
  `tag` varchar(64) DEFAULT '',
  `upload_path` varchar(255) DEFAULT '',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`upload_id`),
  KEY `tag` (`tag`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_taxcode` */

DROP TABLE IF EXISTS `ww_taxcode`;

CREATE TABLE `ww_taxcode` (
  `taxcode_id` int(11) NOT NULL AUTO_INCREMENT,
  `taxcode` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `amount` double(15,2) NOT NULL,
  `dependent` varchar(1) DEFAULT NULL,
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`taxcode_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `ww_time_coordinator` */

DROP TABLE IF EXISTS `ww_time_coordinator`;

CREATE TABLE `ww_time_coordinator` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `alias` varchar(64) NOT NULL DEFAULT '',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_coordinator_partners` */

DROP TABLE IF EXISTS `ww_time_coordinator_partners`;

CREATE TABLE `ww_time_coordinator_partners` (
  `coordinator_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_day_allowance` */

DROP TABLE IF EXISTS `ww_time_day_allowance`;

CREATE TABLE `ww_time_day_allowance` (
  `allowance_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employment_type_id` int(1) NOT NULL,
  `meal` decimal(5,2) DEFAULT '0.00',
  `transpo` decimal(5,2) DEFAULT '0.00',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`allowance_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_day_break` */

DROP TABLE IF EXISTS `ww_time_day_break`;

CREATE TABLE `ww_time_day_break` (
  `break_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `break_name` varchar(64) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`break_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_day_break_range` */

DROP TABLE IF EXISTS `ww_time_day_break_range`;

CREATE TABLE `ww_time_day_break_range` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `break_id` int(1) NOT NULL,
  `hour_from` decimal(5,2) DEFAULT '0.00',
  `hour_to` decimal(5,2) DEFAULT '0.00',
  `deduction` decimal(5,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `company_id` (`break_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_day_meal` */

DROP TABLE IF EXISTS `ww_time_day_meal`;

CREATE TABLE `ww_time_day_meal` (
  `meal_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `meal_name` varchar(64) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`meal_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_day_meal_range` */

DROP TABLE IF EXISTS `ww_time_day_meal_range`;

CREATE TABLE `ww_time_day_meal_range` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `meal_id` int(1) NOT NULL,
  `hour_from` decimal(5,2) DEFAULT '0.00',
  `hour_to` decimal(5,2) DEFAULT '0.00',
  `multiplier` decimal(5,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `company_id` (`meal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_day_transpo` */

DROP TABLE IF EXISTS `ww_time_day_transpo`;

CREATE TABLE `ww_time_day_transpo` (
  `transpo_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `transpo_name` varchar(64) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`transpo_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_day_transpo_range` */

DROP TABLE IF EXISTS `ww_time_day_transpo_range`;

CREATE TABLE `ww_time_day_transpo_range` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `transpo_id` int(1) NOT NULL,
  `hour_from` decimal(5,2) DEFAULT '0.00',
  `hour_to` decimal(5,2) DEFAULT '0.00',
  `multiplier` decimal(5,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `company_id` (`transpo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_day_type` */

DROP TABLE IF EXISTS `ww_time_day_type`;

CREATE TABLE `ww_time_day_type` (
  `day_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `day_type` varchar(64) DEFAULT NULL,
  `day_type_code` varchar(63) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`day_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_day_type_allowance` */

DROP TABLE IF EXISTS `ww_time_day_type_allowance`;

CREATE TABLE `ww_time_day_type_allowance` (
  `type_allowance_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `day_type_id` int(1) NOT NULL,
  `meal_id` int(1) NOT NULL,
  `transpo_id` int(1) NOT NULL,
  PRIMARY KEY (`type_allowance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_day_type_break` */

DROP TABLE IF EXISTS `ww_time_day_type_break`;

CREATE TABLE `ww_time_day_type_break` (
  `type_break_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `day_type_id` int(1) NOT NULL,
  `break_id` int(1) NOT NULL,
  PRIMARY KEY (`type_break_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_delivery` */

DROP TABLE IF EXISTS `ww_time_delivery`;

CREATE TABLE `ww_time_delivery` (
  `delivery_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `delivery` varchar(32) NOT NULL,
  `leave_days` int(2) NOT NULL DEFAULT '0',
  `paternity_leave_days` int(2) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`delivery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_device` */

DROP TABLE IF EXISTS `ww_time_device`;

CREATE TABLE `ww_time_device` (
  `device_id` int(1) NOT NULL AUTO_INCREMENT,
  `device` varchar(32) NOT NULL DEFAULT '',
  `with_col_headers` tinyint(1) DEFAULT '0',
  `delimeter` enum('comma','tab','none') DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `description` text,
  `file_format` enum('Fixed-Length','Comma-Delimited','Tab-Delimited') DEFAULT 'Fixed-Length',
  `column_headers` int(1) DEFAULT '1',
  `folder_location` varchar(64) DEFAULT NULL,
  `file_extension` varchar(16) DEFAULT 'dat',
  `query` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`device_id`),
  KEY `name` (`device`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_device_column` */

DROP TABLE IF EXISTS `ww_time_device_column`;

CREATE TABLE `ww_time_device_column` (
  `column_id` int(1) NOT NULL AUTO_INCREMENT,
  `device_id` int(1) NOT NULL DEFAULT '0',
  `sequence` tinyint(1) DEFAULT '0',
  `field` varchar(16) DEFAULT '',
  `table` varchar(32) DEFAULT '',
  `datatype` enum('numeric','character','datetime') DEFAULT 'numeric',
  `length` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`column_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_duration` */

DROP TABLE IF EXISTS `ww_time_duration`;

CREATE TABLE `ww_time_duration` (
  `duration_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `duration` varchar(32) NOT NULL,
  `credit` decimal(5,2) NOT NULL DEFAULT '0.00',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`duration_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_form` */

DROP TABLE IF EXISTS `ww_time_form`;

CREATE TABLE `ww_time_form` (
  `form_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `form_code` varchar(8) NOT NULL,
  `form` varchar(32) NOT NULL,
  `status_id` tinyint(1) DEFAULT '0',
  `can_view` tinyint(1) DEFAULT '1',
  `can_delete` tinyint(1) DEFAULT '1',
  `is_leave` tinyint(1) DEFAULT '1',
  `special_leave` tinyint(1) DEFAULT '0',
  `with_credits` tinyint(1) DEFAULT '0',
  `is_blanket` tinyint(1) DEFAULT '0',
  `only_male` tinyint(1) DEFAULT '0',
  `only_female` tinyint(1) DEFAULT '0',
  `hr_validation` tinyint(1) DEFAULT '0',
  `class` varchar(32) DEFAULT 'fa fa-square-o',
  `description` text,
  `order_by` int(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`form_id`),
  KEY `form_code` (`form_code`),
  KEY `form` (`form`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_form_balance` */

DROP TABLE IF EXISTS `ww_time_form_balance`;

CREATE TABLE `ww_time_form_balance` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `year` int(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `form_id` int(1) NOT NULL DEFAULT '0',
  `form_code` varchar(8) DEFAULT '',
  `previous` decimal(7,4) DEFAULT '0.0000',
  `current` decimal(7,4) DEFAULT '0.0000',
  `used` decimal(7,4) DEFAULT '0.0000',
  `used_insert` decimal(7,4) DEFAULT '0.0000',
  `forfeited` decimal(7,4) DEFAULT '0.0000',
  `balance` decimal(7,4) DEFAULT '0.0000',
  `paid_unit` decimal(7,4) DEFAULT '0.0000',
  `period_from` date DEFAULT '0000-00-00',
  `period_to` date DEFAULT '0000-00-00',
  `period_extension` date DEFAULT '0000-00-00',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `year` (`year`),
  KEY `user_id` (`user_id`),
  KEY `form_id` (`form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_form_balance_accrual` */

DROP TABLE IF EXISTS `ww_time_form_balance_accrual`;

CREATE TABLE `ww_time_form_balance_accrual` (
  `user_id` int(11) unsigned NOT NULL,
  `leave_balance_id` int(11) unsigned NOT NULL DEFAULT '0',
  `form_id` int(11) NOT NULL DEFAULT '0',
  `form_code` varchar(10) NOT NULL,
  `date_accrued` date NOT NULL DEFAULT '0000-00-00',
  `accrual` decimal(7,4) NOT NULL DEFAULT '0.0000',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`,`leave_balance_id`,`form_id`,`date_accrued`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_form_balance_credit_class` */

DROP TABLE IF EXISTS `ww_time_form_balance_credit_class`;

CREATE TABLE `ww_time_form_balance_credit_class` (
  `class_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `class_code` varchar(32) DEFAULT NULL,
  `class` varchar(64) DEFAULT NULL,
  `form_id` int(1) NOT NULL,
  `form_code` varchar(16) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`class_id`),
  KEY `class_code` (`class_code`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_form_balance_setup` */

DROP TABLE IF EXISTS `ww_time_form_balance_setup`;

CREATE TABLE `ww_time_form_balance_setup` (
  `balance_setup_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `policy_id` int(1) DEFAULT '0',
  `employment_status_id` int(1) NOT NULL,
  `employment_type_id` int(1) NOT NULL,
  `user_id` int(11) DEFAULT '0',
  `effective_date` date NOT NULL DEFAULT '0000-00-00',
  `employment_status` varchar(32) DEFAULT NULL,
  `employment_type` varchar(32) DEFAULT NULL,
  `from` date NOT NULL DEFAULT '0000-00-00',
  `to` date NOT NULL DEFAULT '0000-00-00',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`balance_setup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_form_balance_setup_increment` */

DROP TABLE IF EXISTS `ww_time_form_balance_setup_increment`;

CREATE TABLE `ww_time_form_balance_setup_increment` (
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `policy_id` int(1) unsigned NOT NULL DEFAULT '0',
  `tenure` int(1) NOT NULL DEFAULT '0',
  `from` decimal(4,2) DEFAULT '0.00',
  `to` decimal(4,2) DEFAULT '0.00',
  `unit` enum('MONTH','YEAR') NOT NULL DEFAULT 'YEAR',
  `credits` decimal(7,4) NOT NULL DEFAULT '0.0000',
  `balance_setup_id` int(11) DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tenure` (`tenure`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_form_balance_setup_policy` */

DROP TABLE IF EXISTS `ww_time_form_balance_setup_policy`;

CREATE TABLE `ww_time_form_balance_setup_policy` (
  `policy_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(1) DEFAULT '0',
  `form_id` int(1) NOT NULL DEFAULT '0',
  `form_code` varchar(16) DEFAULT NULL,
  `starting_credit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `max_credit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `effectivity` date DEFAULT '0000-00-00',
  `company_ids` varchar(64) DEFAULT NULL,
  `employment_status_ids` varchar(64) DEFAULT NULL,
  `employment_type_ids` varchar(64) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `balance_setup_id` int(1) unsigned NOT NULL DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`policy_id`),
  KEY `balance_setup_id` (`balance_setup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_form_class` */

DROP TABLE IF EXISTS `ww_time_form_class`;

CREATE TABLE `ww_time_form_class` (
  `class_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(1) NOT NULL,
  `form_code` varchar(8) DEFAULT NULL,
  `class_code` varchar(85) DEFAULT NULL,
  `class` varchar(150) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`class_id`),
  KEY `class_code` (`class_code`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=732 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_form_class_policy` */

DROP TABLE IF EXISTS `ww_time_form_class_policy`;

CREATE TABLE `ww_time_form_class_policy` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(1) NOT NULL DEFAULT '0',
  `class_value` text,
  `description` varchar(128) DEFAULT NULL,
  `severity` enum('Warning','Strict Compliance') DEFAULT 'Warning',
  `company_id` varchar(255) DEFAULT 'ALL',
  `employment_status_id` varchar(32) DEFAULT 'ALL',
  `employment_type_id` varchar(32) DEFAULT 'ALL',
  `role_id` varchar(32) DEFAULT 'ALL',
  `division_id` varchar(128) DEFAULT 'ALL',
  `department_id` text,
  `group_id` text,
  `project_id` text,
  `created_by` int(11) DEFAULT '0',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `shift_company_class` (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_form_class_policy_setup` */

DROP TABLE IF EXISTS `ww_time_form_class_policy_setup`;

CREATE TABLE `ww_time_form_class_policy_setup` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(1) NOT NULL DEFAULT '0',
  `class_value` text,
  `field_id` varchar(32) DEFAULT NULL,
  `field_value` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shift_company_class` (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_form_employment` */

DROP TABLE IF EXISTS `ww_time_form_employment`;

CREATE TABLE `ww_time_form_employment` (
  `employment_type` int(11) NOT NULL DEFAULT '0',
  `no_late` tinyint(1) DEFAULT '0',
  `no_undertime` tinyint(1) DEFAULT '0',
  `no_absent` tinyint(1) DEFAULT '0',
  `no_awol` tinyint(1) DEFAULT '0',
  `days_awol` tinyint(1) DEFAULT '5',
  `send_notification` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_form_status` */

DROP TABLE IF EXISTS `ww_time_form_status`;

CREATE TABLE `ww_time_form_status` (
  `form_status_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `form_status` varchar(16) NOT NULL DEFAULT '',
  `color` varchar(8) DEFAULT '#ffffff',
  `description` tinytext,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`form_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_forms` */

DROP TABLE IF EXISTS `ww_time_forms`;

CREATE TABLE `ww_time_forms` (
  `forms_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `form_status_id` tinyint(1) NOT NULL DEFAULT '0',
  `form_id` int(1) NOT NULL DEFAULT '0',
  `form_code` varchar(8) DEFAULT '',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(64) DEFAULT '',
  `day` decimal(5,2) DEFAULT '0.00',
  `hrs` decimal(5,2) DEFAULT '0.00',
  `ot_break` decimal(5,2) DEFAULT '0.00',
  `focus_date` date DEFAULT '0000-00-00',
  `date_from` date DEFAULT '0000-00-00',
  `date_to` date DEFAULT '0000-00-00',
  `date_approved` datetime DEFAULT '0000-00-00 00:00:00',
  `date_declined` datetime DEFAULT '0000-00-00 00:00:00',
  `date_cancelled` datetime DEFAULT '0000-00-00 00:00:00',
  `date_sent` datetime DEFAULT '0000-00-00 00:00:00',
  `reason` text,
  `scheduled` enum('YES','NO') DEFAULT 'YES',
  `type` enum('File','Use') DEFAULT 'File',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`forms_id`),
  KEY `form_id` (`form_id`),
  KEY `user_id` (`user_id`),
  KEY `deleted` (`deleted`),
  KEY `created_on` (`created_on`),
  KEY `date_from` (`date_from`),
  KEY `forms_status_id` (`form_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_forms_approver` */

DROP TABLE IF EXISTS `ww_time_forms_approver`;

CREATE TABLE `ww_time_forms_approver` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `forms_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(64) CHARACTER SET latin1 DEFAULT '',
  `condition` enum('ALL','By Level','Either Of') DEFAULT 'By Level',
  `sequence` tinyint(1) DEFAULT '1',
  `form_status_id` int(1) DEFAULT '0',
  `form_status` varchar(16) DEFAULT '',
  `comment_date` datetime DEFAULT '0000-00-00 00:00:00',
  `comment` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `forms_user` (`forms_id`,`user_id`,`sequence`),
  KEY `forms_id` (`forms_id`),
  KEY `user_id` (`user_id`),
  KEY `sequence` (`sequence`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_forms_blanket` */

DROP TABLE IF EXISTS `ww_time_forms_blanket`;

CREATE TABLE `ww_time_forms_blanket` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `forms_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(64) DEFAULT '',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_forms_date` */

DROP TABLE IF EXISTS `ww_time_forms_date`;

CREATE TABLE `ww_time_forms_date` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `forms_id` int(11) unsigned NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `day` decimal(3,2) DEFAULT '0.00',
  `hrs` decimal(5,2) DEFAULT '0.00',
  `duration_id` tinyint(1) DEFAULT '1',
  `time_from` datetime DEFAULT '0000-00-00 00:00:00',
  `time_to` datetime DEFAULT '0000-00-00 00:00:00',
  `shift_id` int(1) DEFAULT '0',
  `shift_to` int(1) DEFAULT '0',
  `credit` decimal(5,2) DEFAULT NULL,
  `credit_back` decimal(5,2) DEFAULT NULL,
  `leave_balance_id` int(11) DEFAULT '0',
  `approved_comment` text,
  `declined_comment` text,
  `cancelled_comment` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `forms_id` (`forms_id`),
  KEY `forms_date` (`date`,`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_forms_maternity` */

DROP TABLE IF EXISTS `ww_time_forms_maternity`;

CREATE TABLE `ww_time_forms_maternity` (
  `forms_id` int(11) unsigned NOT NULL DEFAULT '0',
  `delivery_id` int(1) DEFAULT '0',
  `expected_date` date DEFAULT '0000-00-00',
  `actual_date` date DEFAULT '0000-00-00',
  `return_date` date DEFAULT '0000-00-00',
  `pregnancy_no` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_forms_obt` */

DROP TABLE IF EXISTS `ww_time_forms_obt`;

CREATE TABLE `ww_time_forms_obt` (
  `forms_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contact_no` varchar(32) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `position` varchar(64) DEFAULT NULL,
  `company_to_visit` varchar(64) DEFAULT NULL,
  `location` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`forms_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_forms_obt_purpose` */

DROP TABLE IF EXISTS `ww_time_forms_obt_purpose`;

CREATE TABLE `ww_time_forms_obt_purpose` (
  `purpose_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `purpose` varchar(250) NOT NULL,
  `description` text,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(1) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(1) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`purpose_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_forms_obt_transpo` */

DROP TABLE IF EXISTS `ww_time_forms_obt_transpo`;

CREATE TABLE `ww_time_forms_obt_transpo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `forms_id` int(11) unsigned NOT NULL DEFAULT '0',
  `purpose_id` int(11) DEFAULT NULL,
  `transpo_mode` enum('Airplane','Bus','Jeep','Taxi','Train','Tricycle','Van','Others') DEFAULT 'Others',
  `remarks` text,
  `amount` decimal(10,2) DEFAULT '0.00',
  `status_id` int(1) DEFAULT '3',
  `request_remarks` text,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_forms_ot_leave` */

DROP TABLE IF EXISTS `ww_time_forms_ot_leave`;

CREATE TABLE `ww_time_forms_ot_leave` (
  `forms_id` int(11) NOT NULL,
  `credit` decimal(5,2) DEFAULT NULL,
  `remarks` text,
  `validated_by` int(11) DEFAULT NULL,
  `status_id` int(1) DEFAULT NULL,
  `expiration_date` date NOT NULL DEFAULT '0000-00-00',
  `used_by_form` int(11) NOT NULL DEFAULT '0',
  `used` decimal(5,2) NOT NULL DEFAULT '0.00',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`forms_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_forms_ot_leave_used` */

DROP TABLE IF EXISTS `ww_time_forms_ot_leave_used`;

CREATE TABLE `ww_time_forms_ot_leave_used` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forms_id` int(11) NOT NULL DEFAULT '0',
  `used_by_form` int(11) NOT NULL DEFAULT '0',
  `used` double(5,2) NOT NULL DEFAULT '0.00',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_forms_upload` */

DROP TABLE IF EXISTS `ww_time_forms_upload`;

CREATE TABLE `ww_time_forms_upload` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `forms_id` int(11) NOT NULL,
  `upload_id` int(11) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `forms_id` (`forms_id`),
  KEY `upload_id` (`upload_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_grace_period` */

DROP TABLE IF EXISTS `ww_time_grace_period`;

CREATE TABLE `ww_time_grace_period` (
  `grace_period_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL DEFAULT '0',
  `employment_type` int(1) DEFAULT '0',
  `employee_type` int(1) DEFAULT '0',
  `grace_period` time DEFAULT '00:00:00',
  `grace_period_minutes` decimal(5,2) DEFAULT '0.00',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`grace_period_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_holiday` */

DROP TABLE IF EXISTS `ww_time_holiday`;

CREATE TABLE `ww_time_holiday` (
  `holiday_id` int(11) NOT NULL AUTO_INCREMENT,
  `holiday` varchar(64) NOT NULL DEFAULT '',
  `holiday_date` date NOT NULL,
  `status_id` tinyint(1) DEFAULT '0',
  `legal` tinyint(1) DEFAULT '1',
  `locations` varchar(128) DEFAULT NULL,
  `location_count` int(1) DEFAULT '0',
  `user_count` int(1) DEFAULT '0',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`holiday_id`),
  KEY `holiday_date` (`holiday_date`),
  KEY `deleted` (`deleted`),
  KEY `legal` (`legal`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_holiday_event` */

DROP TABLE IF EXISTS `ww_time_holiday_event`;

CREATE TABLE `ww_time_holiday_event` (
  `event_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event` varchar(64) NOT NULL DEFAULT '',
  `event_month` int(1) NOT NULL DEFAULT '1',
  `event_day` int(1) NOT NULL DEFAULT '1',
  `status_id` tinyint(1) DEFAULT '0',
  `days_before` int(1) DEFAULT '0',
  `days_after` int(1) DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_holiday_location` */

DROP TABLE IF EXISTS `ww_time_holiday_location`;

CREATE TABLE `ww_time_holiday_location` (
  `holiday_id` int(11) NOT NULL DEFAULT '0',
  `location_id` int(1) DEFAULT '0',
  `location` varchar(64) DEFAULT '',
  `user_id` int(11) DEFAULT '0',
  `user` varchar(64) DEFAULT '',
  `deleted` tinyint(1) DEFAULT '0',
  KEY `location_id` (`location_id`),
  KEY `user_id` (`user_id`),
  KEY `deleted` (`deleted`),
  KEY `holiday_id` (`holiday_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_leave_duration` */

DROP TABLE IF EXISTS `ww_time_leave_duration`;

CREATE TABLE `ww_time_leave_duration` (
  `leave_duration_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `leave_duration` varchar(32) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`leave_duration_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_period` */

DROP TABLE IF EXISTS `ww_time_period`;

CREATE TABLE `ww_time_period` (
  `period_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `period_year` varchar(4) NOT NULL DEFAULT '',
  `period_month` enum('01','02','03','04','05','06','07','08','09','10','11','12') NOT NULL,
  `project_id` int(1) NOT NULL DEFAULT '0',
  `company_id` int(11) DEFAULT NULL,
  `apply_to_id` int(1) DEFAULT '0',
  `cutoff_monthly` varchar(20) DEFAULT NULL,
  `payroll_date` date NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `cutoff` date NOT NULL,
  `previous_cutoff` date NOT NULL,
  `pop_dates` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `last_processed` datetime DEFAULT NULL,
  `processed` int(1) DEFAULT '0',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`period_id`),
  UNIQUE KEY `period_coverage` (`period_year`,`period_month`,`payroll_date`,`date_from`,`date_to`,`company_id`),
  KEY `period_year` (`period_year`,`period_month`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_period_apply_to` */

DROP TABLE IF EXISTS `ww_time_period_apply_to`;

CREATE TABLE `ww_time_period_apply_to` (
  `apply_to_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `apply_to` varchar(64) NOT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`apply_to_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_period_apply_to_id` */

DROP TABLE IF EXISTS `ww_time_period_apply_to_id`;

CREATE TABLE `ww_time_period_apply_to_id` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `period_id` int(11) NOT NULL,
  `apply_to_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_processed` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_period_extension` */

DROP TABLE IF EXISTS `ww_time_period_extension`;

CREATE TABLE `ww_time_period_extension` (
  `extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `period_id` int(11) NOT NULL,
  `process_until` date DEFAULT NULL,
  `allow_pending_until` date DEFAULT NULL,
  `apply_lates` tinyint(1) DEFAULT '0',
  `apply_late_from` date DEFAULT NULL,
  `apply_late_to` date DEFAULT NULL,
  `apply_overtime_from` date DEFAULT NULL,
  `apply_overtime_to` date DEFAULT NULL,
  PRIMARY KEY (`extension_id`),
  KEY `period_id` (`period_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_period_log` */

DROP TABLE IF EXISTS `ww_time_period_log`;

CREATE TABLE `ww_time_period_log` (
  `proc_log_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `period_id` int(11) NOT NULL DEFAULT '0',
  `partner_type_id` int(1) DEFAULT '0',
  `partner_type` varchar(16) DEFAULT '',
  `proc_log` int(1) DEFAULT '0',
  `processed` int(1) DEFAULT '0',
  PRIMARY KEY (`proc_log_id`),
  UNIQUE KEY `period_partner_type` (`period_id`,`partner_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_record` */

DROP TABLE IF EXISTS `ww_time_record`;

CREATE TABLE `ww_time_record` (
  `record_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `biometric` varchar(8) NOT NULL DEFAULT '',
  `shift_id` int(1) DEFAULT '0',
  `shift` varchar(32) DEFAULT NULL,
  `date` date NOT NULL,
  `processed` tinyint(1) DEFAULT '0',
  `override` tinyint(1) DEFAULT '0',
  `aux_shift_id` int(1) DEFAULT '0',
  `aux_shift` varchar(32) DEFAULT '',
  `aux_time_in` datetime DEFAULT NULL,
  `aux_time_out` datetime DEFAULT NULL,
  `time_in` datetime DEFAULT NULL,
  `time_out` datetime DEFAULT NULL,
  `flexible_min` int(1) DEFAULT '0',
  `flexible_time` time DEFAULT '00:00:00',
  `breaka_in` datetime DEFAULT NULL,
  `breaka_out` datetime DEFAULT NULL,
  `breakb_in` datetime DEFAULT NULL,
  `breakb_out` datetime DEFAULT NULL,
  `ot_in` datetime DEFAULT NULL,
  `ot_out` datetime DEFAULT NULL,
  `ot_in2` datetime DEFAULT NULL,
  `ot_out2` datetime DEFAULT NULL,
  `suspended` tinyint(1) DEFAULT '0',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`record_id`),
  UNIQUE KEY `user_date` (`user_id`,`date`),
  KEY `user_id` (`user_id`),
  KEY `date` (`date`)
) ENGINE=InnoDB AUTO_INCREMENT=459 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_record_allowance` */

DROP TABLE IF EXISTS `ww_time_record_allowance`;

CREATE TABLE `ww_time_record_allowance` (
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(1) NOT NULL,
  `employment_type_id` int(1) NOT NULL,
  `from` int(1) DEFAULT '0',
  `to` int(1) DEFAULT '0',
  `cost` decimal(10,0) DEFAULT '2',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_record_process` */

DROP TABLE IF EXISTS `ww_time_record_process`;

CREATE TABLE `ww_time_record_process` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `time_period_id` int(11) DEFAULT '0',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `payroll_date` date NOT NULL DEFAULT '0000-00-00',
  `original_payroll_date` date DEFAULT '0000-00-00',
  `latefile` tinyint(1) DEFAULT '0',
  `transaction_id` int(1) DEFAULT '0',
  `transaction_code` varchar(32) DEFAULT NULL,
  `transaction_type_id` int(1) DEFAULT '1',
  `quantity` decimal(12,3) DEFAULT '0.000',
  `unit_rate` decimal(12,3) DEFAULT '0.000',
  `remarks` text,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `payroll_date` (`payroll_date`,`date`,`deleted`),
  KEY `user_id_date_payroll_date` (`user_id`,`date`,`payroll_date`,`latefile`,`transaction_code`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_record_process_type` */

DROP TABLE IF EXISTS `ww_time_record_process_type`;

CREATE TABLE `ww_time_record_process_type` (
  `time_record_process_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `time_record_process_type` varchar(30) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`time_record_process_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_record_raw` */

DROP TABLE IF EXISTS `ww_time_record_raw`;

CREATE TABLE `ww_time_record_raw` (
  `raw_id` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT '0',
  `biometric` varchar(8) NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `location` varchar(128) DEFAULT NULL,
  `location_id` int(1) DEFAULT NULL,
  `device_id` int(1) DEFAULT NULL,
  `checktime` datetime NOT NULL,
  `checktype` varchar(8) DEFAULT NULL,
  `processed` tinyint(1) DEFAULT '0',
  `last_processed` datetime DEFAULT NULL,
  UNIQUE KEY `biometric_date_checktime` (`biometric`,`date`,`checktime`),
  KEY `raw_id` (`raw_id`),
  KEY `user_id` (`user_id`),
  KEY `date` (`date`),
  KEY `biometric` (`biometric`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_record_schedule_history` */

DROP TABLE IF EXISTS `ww_time_record_schedule_history`;

CREATE TABLE `ww_time_record_schedule_history` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `coordinator_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `schedule` date DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `calendar_id` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_record_summary` */

DROP TABLE IF EXISTS `ww_time_record_summary`;

CREATE TABLE `ww_time_record_summary` (
  `record_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `id_number` varchar(8) NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `period_id` int(11) DEFAULT '0',
  `payroll_date` date NOT NULL DEFAULT '0000-00-00',
  `day_type` varchar(16) DEFAULT 'REGULAR',
  `hrs_rendered` decimal(5,2) DEFAULT '0.00',
  `hrs_actual` decimal(5,2) DEFAULT '0.00',
  `hrs_break` decimal(5,2) DEFAULT '0.00',
  `absent` tinyint(1) DEFAULT '0',
  `lwp` decimal(5,2) DEFAULT '0.00',
  `lwop` decimal(5,2) DEFAULT '0.00',
  `late` decimal(5,2) DEFAULT '0.00',
  `undertime` decimal(5,2) DEFAULT '0.00',
  `nd` decimal(5,2) DEFAULT '0.00',
  `ot` decimal(5,2) DEFAULT '0.00',
  `ot_break` decimal(5,2) DEFAULT '0.00',
  `meal` decimal(5,2) DEFAULT '0.00',
  `transpo` decimal(5,2) DEFAULT '0.00',
  `resigned` tinyint(1) DEFAULT '0',
  `awol` tinyint(1) DEFAULT '0',
  `project_id` int(11) DEFAULT '0',
  `date_cron_run` datetime DEFAULT NULL,
  `lip_approved_below_13_days` tinyint(1) DEFAULT '0',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`record_id`,`user_id`,`date`,`payroll_date`),
  KEY `user_id` (`user_id`),
  KEY `date` (`date`),
  KEY `payroll_date` (`payroll_date`),
  KEY `user_id_date_payroll_date` (`user_id`,`date`,`payroll_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_record_tardiness` */

DROP TABLE IF EXISTS `ww_time_record_tardiness`;

CREATE TABLE `ww_time_record_tardiness` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `period_year` int(1) NOT NULL,
  `period_month` int(1) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `id_number` varchar(8) NOT NULL DEFAULT '',
  `instances` decimal(5,2) DEFAULT '0.00',
  `total_minutes` decimal(5,2) DEFAULT '0.00',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`period_year`,`period_month`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_record_tardiness_detail` */

DROP TABLE IF EXISTS `ww_time_record_tardiness_detail`;

CREATE TABLE `ww_time_record_tardiness_detail` (
  `period_year` int(1) NOT NULL,
  `period_month` int(1) NOT NULL,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `late` decimal(5,2) DEFAULT '0.00',
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`period_year`,`period_month`,`user_id`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_record_tardiness_settings` */

DROP TABLE IF EXISTS `ww_time_record_tardiness_settings`;

CREATE TABLE `ww_time_record_tardiness_settings` (
  `habitual_tardiness_id` int(11) NOT NULL AUTO_INCREMENT,
  `instances` int(11) DEFAULT NULL,
  `minutes_tardy` int(11) DEFAULT NULL,
  `month_within` int(11) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`habitual_tardiness_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_record_work_schedule_history` */

DROP TABLE IF EXISTS `ww_time_record_work_schedule_history`;

CREATE TABLE `ww_time_record_work_schedule_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `shift` varchar(64) DEFAULT NULL,
  `calendar_id` int(11) DEFAULT NULL,
  `calendar` varchar(64) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `ww_time_shift` */

DROP TABLE IF EXISTS `ww_time_shift`;

CREATE TABLE `ww_time_shift` (
  `shift_id` int(1) NOT NULL AUTO_INCREMENT,
  `shift` varchar(32) NOT NULL,
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `default_calendar` int(1) DEFAULT '0',
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `use_tag` tinyint(1) DEFAULT '0',
  `color` varchar(7) DEFAULT '#FFFFFF',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`shift_id`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_shift_apply_to` */

DROP TABLE IF EXISTS `ww_time_shift_apply_to`;

CREATE TABLE `ww_time_shift_apply_to` (
  `apply_to_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `apply_to` varchar(64) NOT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`apply_to_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_shift_apply_to_id` */

DROP TABLE IF EXISTS `ww_time_shift_apply_to_id`;

CREATE TABLE `ww_time_shift_apply_to_id` (
  `shift_id` int(11) DEFAULT NULL,
  `apply_to` int(11) DEFAULT NULL,
  `apply_to_id` int(11) DEFAULT NULL,
  KEY `memo_id` (`shift_id`,`apply_to_id`,`apply_to`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_shift_apply_to_value` */

DROP TABLE IF EXISTS `ww_time_shift_apply_to_value`;

CREATE TABLE `ww_time_shift_apply_to_value` (
  `shift_id` int(1) NOT NULL AUTO_INCREMENT,
  `shift` text NOT NULL,
  PRIMARY KEY (`shift_id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_shift_class` */

DROP TABLE IF EXISTS `ww_time_shift_class`;

CREATE TABLE `ww_time_shift_class` (
  `class_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `class_code` varchar(32) DEFAULT NULL,
  `class` varchar(64) DEFAULT NULL,
  `default_value` varchar(64) DEFAULT NULL,
  `data_type` varchar(32) DEFAULT 'text',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`class_id`),
  KEY `class_code` (`class_code`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_shift_class_company` */

DROP TABLE IF EXISTS `ww_time_shift_class_company`;

CREATE TABLE `ww_time_shift_class_company` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `shift_id` int(1) NOT NULL DEFAULT '0',
  `company_id` int(1) NOT NULL DEFAULT '0',
  `class_id` int(1) NOT NULL DEFAULT '0',
  `class_value` varchar(64) DEFAULT NULL,
  `employment_status_id` varchar(32) DEFAULT 'ALL',
  `employment_type_id` varchar(32) DEFAULT 'ALL',
  `partners_id` varchar(32) DEFAULT 'NONE',
  `modified_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `shift_company_class` (`shift_id`,`company_id`,`class_id`,`class_value`)
) ENGINE=InnoDB AUTO_INCREMENT=498880 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_shift_class_company_department` */

DROP TABLE IF EXISTS `ww_time_shift_class_company_department`;

CREATE TABLE `ww_time_shift_class_company_department` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `shift_id` int(11) NOT NULL,
  `company_id` int(1) NOT NULL DEFAULT '0',
  `department_id` varchar(64) NOT NULL DEFAULT '0',
  `employment_type_id` varchar(32) NOT NULL DEFAULT '0',
  `partners_id` varchar(64) NOT NULL DEFAULT '0',
  `class_id` int(1) NOT NULL DEFAULT '0',
  `class_code` varchar(32) NOT NULL DEFAULT '0',
  `class_value` varchar(64) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_shift_company` */

DROP TABLE IF EXISTS `ww_time_shift_company`;

CREATE TABLE `ww_time_shift_company` (
  `shift_id` int(1) NOT NULL DEFAULT '0',
  `shift` varchar(32) DEFAULT NULL,
  `company_id` int(1) NOT NULL DEFAULT '0',
  `working_hrs` tinyint(1) DEFAULT '8',
  `grace_period` time DEFAULT '00:00:00',
  `grace_minutes` tinyint(2) DEFAULT '0',
  `halfday` time DEFAULT '00:00:00',
  `halfday_minutes` int(1) DEFAULT '0',
  `firsthalf_start` time DEFAULT '00:00:00',
  `firsthalf_end` time DEFAULT '00:00:00',
  `firsthalf_minutes` tinyint(2) DEFAULT '0',
  `secondhalf_grace_period` time DEFAULT '00:00:00',
  `secondhalf_grace_minutes` tinyint(2) DEFAULT '0',
  `max_preshift` time DEFAULT '00:00:00',
  `max_preshift_minutes` int(1) DEFAULT '0',
  `mid_postshift` time DEFAULT '23:59:59',
  `max_postshift` time DEFAULT '00:00:00',
  `max_postshift_minutes` int(1) DEFAULT '0',
  `breaka_start` time DEFAULT '00:00:00',
  `breaka_end` time DEFAULT '00:00:00',
  `breaka_minutes` tinyint(2) DEFAULT '0',
  `breaka_grace_minutes` tinyint(2) DEFAULT '0',
  `breakb_start` time DEFAULT '00:00:00',
  `breakb_end` time DEFAULT '00:00:00',
  `breakb_minutes` tinyint(2) DEFAULT '0',
  `breakb_grace_minutes` tinyint(2) DEFAULT '0',
  UNIQUE KEY `shift_id` (`shift_id`,`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_shift_restday` */

DROP TABLE IF EXISTS `ww_time_shift_restday`;

CREATE TABLE `ww_time_shift_restday` (
  `shift_id` int(1) NOT NULL DEFAULT '0',
  `shift` varchar(32) DEFAULT NULL,
  `company_id` int(1) NOT NULL DEFAULT '0',
  `day` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') DEFAULT 'Sunday',
  `deleted` tinyint(1) DEFAULT '0',
  UNIQUE KEY `shift_company_day` (`shift_id`,`company_id`,`day`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_shift_weekly` */

DROP TABLE IF EXISTS `ww_time_shift_weekly`;

CREATE TABLE `ww_time_shift_weekly` (
  `calendar_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `calendar` varchar(64) NOT NULL DEFAULT '',
  `default` tinyint(1) DEFAULT '0',
  `workingdays` varchar(32) DEFAULT '',
  `restdays` varchar(32) DEFAULT '',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`calendar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=269 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_shift_weekly_calendar` */

DROP TABLE IF EXISTS `ww_time_shift_weekly_calendar`;

CREATE TABLE `ww_time_shift_weekly_calendar` (
  `calendar_id` int(1) unsigned NOT NULL,
  `week_no` enum('1','2','3','4','5','6','7') NOT NULL DEFAULT '1',
  `week_name` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') NOT NULL DEFAULT 'Sunday',
  `shift_id` int(1) NOT NULL DEFAULT '0',
  `shift` varchar(32) DEFAULT '',
  UNIQUE KEY `calendar_week` (`calendar_id`,`week_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_time_work_schedule_history` */

DROP TABLE IF EXISTS `ww_time_work_schedule_history`;

CREATE TABLE `ww_time_work_schedule_history` (
  `work_schedule_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` text,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `calendar_id` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`work_schedule_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `ww_training_applicable_for` */

DROP TABLE IF EXISTS `ww_training_applicable_for`;

CREATE TABLE `ww_training_applicable_for` (
  `applicable_for_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `applicable_for` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`applicable_for_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_bond` */

DROP TABLE IF EXISTS `ww_training_bond`;

CREATE TABLE `ww_training_bond` (
  `bond_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cost_from` decimal(12,2) DEFAULT '0.00',
  `cost_to` decimal(12,2) DEFAULT '0.00',
  `rls_months` int(11) DEFAULT NULL,
  `rls_days` int(11) DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`bond_id`),
  KEY `job_class_code` (`cost_from`),
  KEY `job_class` (`cost_to`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_calendar` */

DROP TABLE IF EXISTS `ww_training_calendar`;

CREATE TABLE `ww_training_calendar` (
  `training_calendar_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `training_revalida_master_id` int(11) NOT NULL,
  `feedback_category_id` text,
  `training_category_id` int(11) DEFAULT NULL,
  `topic` varchar(128) NOT NULL,
  `calendar_type_id` int(11) DEFAULT NULL,
  `partner_id` text,
  `venue` text,
  `room` varchar(32) DEFAULT NULL,
  `equipment` text,
  `min_training_capacity` int(11) DEFAULT NULL,
  `training_capacity` int(11) DEFAULT NULL,
  `with_certification` tinyint(1) DEFAULT '0',
  `with_budget` tinyint(1) DEFAULT '0',
  `with_session` tinyint(1) DEFAULT '0',
  `registration_date` date DEFAULT NULL,
  `last_registration_date` date DEFAULT NULL,
  `total_session_hours` varchar(255) DEFAULT '0:00',
  `total_session_breaks` varchar(255) DEFAULT '0:00',
  `total_cost` decimal(12,2) DEFAULT '0.00',
  `total_pax` int(4) DEFAULT '0',
  `tba` int(1) DEFAULT '0',
  `publish_date` date DEFAULT NULL,
  `published` tinyint(1) DEFAULT '0',
  `confirmed` tinyint(1) DEFAULT '0',
  `closed_date` date DEFAULT NULL,
  `closed` tinyint(1) DEFAULT '0',
  `cancelled` tinyint(1) DEFAULT '2',
  `cancelled_date` date DEFAULT NULL,
  `cost_per_pax` decimal(12,2) DEFAULT '0.00',
  `revalida_date` date DEFAULT NULL,
  `planned` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `assignment_id` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`training_calendar_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_calendar_budget` */

DROP TABLE IF EXISTS `ww_training_calendar_budget`;

CREATE TABLE `ww_training_calendar_budget` (
  `calendar_budget_id` int(11) NOT NULL AUTO_INCREMENT,
  `training_calendar_id` int(11) NOT NULL,
  `source_id` int(11) DEFAULT NULL,
  `pax` int(3) DEFAULT '0',
  `cost` decimal(12,2) DEFAULT '0.00',
  `total` decimal(12,2) DEFAULT '0.00',
  `remarks` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`calendar_budget_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_calendar_participant` */

DROP TABLE IF EXISTS `ww_training_calendar_participant`;

CREATE TABLE `ww_training_calendar_participant` (
  `calendar_participant_id` int(11) NOT NULL AUTO_INCREMENT,
  `training_calendar_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `participant_status_id` int(11) DEFAULT '0',
  `no_show` tinyint(1) DEFAULT '0',
  `bond` tinyint(1) DEFAULT '0',
  `nominate` tinyint(1) DEFAULT '0',
  `send_nominate_status` tinyint(1) DEFAULT '0',
  `send_reject_status` tinyint(1) DEFAULT '0',
  `send_confirm_status` tinyint(1) DEFAULT '0',
  `send_reg_notification` tinyint(1) DEFAULT '0',
  `send_no_show_notification` tinyint(1) DEFAULT '0',
  `previous_participant_status_id` int(11) DEFAULT '0',
  `send_revalida_notification` tinyint(1) DEFAULT '0',
  `remarks` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`calendar_participant_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_calendar_participant_status` */

DROP TABLE IF EXISTS `ww_training_calendar_participant_status`;

CREATE TABLE `ww_training_calendar_participant_status` (
  `participant_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `participant_status` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`participant_status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_calendar_session` */

DROP TABLE IF EXISTS `ww_training_calendar_session`;

CREATE TABLE `ww_training_calendar_session` (
  `calendar_session_id` int(11) NOT NULL AUTO_INCREMENT,
  `training_calendar_id` int(11) NOT NULL,
  `session_no` int(2) DEFAULT NULL,
  `session_date` date DEFAULT NULL,
  `sessiontime_from` time DEFAULT NULL,
  `sessiontime_to` time DEFAULT NULL,
  `breaktime_from` time DEFAULT NULL,
  `breaktime_to` time DEFAULT NULL,
  `instructor` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`calendar_session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_calendar_type` */

DROP TABLE IF EXISTS `ww_training_calendar_type`;

CREATE TABLE `ww_training_calendar_type` (
  `calendar_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `calendar_type` varchar(16) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`calendar_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_category` */

DROP TABLE IF EXISTS `ww_training_category`;

CREATE TABLE `ww_training_category` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(150) DEFAULT NULL,
  `category_code` varchar(150) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`category_id`),
  KEY `job_class_code` (`category`),
  KEY `job_class` (`category_code`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_cost` */

DROP TABLE IF EXISTS `ww_training_cost`;

CREATE TABLE `ww_training_cost` (
  `cost_id` int(11) NOT NULL AUTO_INCREMENT,
  `cost` varchar(32) NOT NULL,
  `description` varchar(64) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`cost_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_course` */

DROP TABLE IF EXISTS `ww_training_course`;

CREATE TABLE `ww_training_course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course` varchar(128) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `facilitator` varchar(128) DEFAULT NULL,
  `planned` tinyint(1) DEFAULT NULL,
  `position_id` text,
  `with_bond` tinyint(1) DEFAULT NULL,
  `cost` float(11,2) DEFAULT '0.00',
  `length_of_service` varchar(128) DEFAULT NULL,
  `remarks` varchar(128) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`course_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_employee_database` */

DROP TABLE IF EXISTS `ww_training_employee_database`;

CREATE TABLE `ww_training_employee_database` (
  `employee_database_id` int(11) NOT NULL AUTO_INCREMENT,
  `calendar_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `group_name_id` int(11) DEFAULT NULL,
  `project_name_id` int(11) DEFAULT NULL,
  `rank_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `bond_start_date` date DEFAULT NULL,
  `bond_end_date` date DEFAULT NULL,
  `no_bond_days` int(11) DEFAULT NULL,
  `training_balance` decimal(14,0) DEFAULT NULL,
  `daily_training_cost` decimal(14,0) DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`employee_database_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_evaluation_template` */

DROP TABLE IF EXISTS `ww_training_evaluation_template`;

CREATE TABLE `ww_training_evaluation_template` (
  `evaluation_template_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `applicable_for` int(11) unsigned DEFAULT NULL,
  `status_id` tinyint(1) unsigned DEFAULT '0',
  `can_delete` tinyint(1) unsigned DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) unsigned DEFAULT NULL,
  `deleted` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`evaluation_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_evaluation_template_section` */

DROP TABLE IF EXISTS `ww_training_evaluation_template_section`;

CREATE TABLE `ww_training_evaluation_template_section` (
  `template_section_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `template_id` int(11) unsigned NOT NULL,
  `template_section` varchar(255) DEFAULT NULL,
  `parent_id` int(11) unsigned NOT NULL,
  `weight` int(11) NOT NULL,
  `section_type_id` int(11) unsigned NOT NULL,
  `sequence` int(11) NOT NULL,
  `header` text,
  `footer` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`template_section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_evaluation_template_section_type` */

DROP TABLE IF EXISTS `ww_training_evaluation_template_section_type`;

CREATE TABLE `ww_training_evaluation_template_section_type` (
  `section_type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `section_type` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`section_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_facilitator` */

DROP TABLE IF EXISTS `ww_training_facilitator`;

CREATE TABLE `ww_training_facilitator` (
  `facilitator_id` int(11) NOT NULL AUTO_INCREMENT,
  `facilitator` varchar(64) NOT NULL,
  `is_internal` tinyint(1) DEFAULT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `course_id` text,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`facilitator_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_feedback` */

DROP TABLE IF EXISTS `ww_training_feedback`;

CREATE TABLE `ww_training_feedback` (
  `feedback_id` int(11) DEFAULT NULL,
  `training_calendar_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `feedback_status_id` int(11) DEFAULT NULL,
  `total_score` int(11) DEFAULT NULL,
  `average_score` decimal(8,2) DEFAULT '0.00',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_feedback_category` */

DROP TABLE IF EXISTS `ww_training_feedback_category`;

CREATE TABLE `ww_training_feedback_category` (
  `feedback_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback_category` varchar(32) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`feedback_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_feedback_item` */

DROP TABLE IF EXISTS `ww_training_feedback_item`;

CREATE TABLE `ww_training_feedback_item` (
  `feedback_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback_category_id` int(11) DEFAULT NULL,
  `feedback_item_no` int(2) NOT NULL,
  `feedback_item` varchar(384) NOT NULL,
  `score_type` int(11) DEFAULT '0',
  `inactive` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`feedback_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_feedback_score` */

DROP TABLE IF EXISTS `ww_training_feedback_score`;

CREATE TABLE `ww_training_feedback_score` (
  `feedback_score_id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback_id` int(11) NOT NULL,
  `feedback_item_id` int(11) NOT NULL,
  `score` decimal(6,2) DEFAULT '0.00',
  `remarks` text,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`feedback_score_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_feedback_score_type` */

DROP TABLE IF EXISTS `ww_training_feedback_score_type`;

CREATE TABLE `ww_training_feedback_score_type` (
  `score_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `score_type` varchar(48) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`score_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_feedback_status` */

DROP TABLE IF EXISTS `ww_training_feedback_status`;

CREATE TABLE `ww_training_feedback_status` (
  `feedback_status_id` int(8) NOT NULL AUTO_INCREMENT,
  `feedback_status` varchar(255) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`feedback_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_library` */

DROP TABLE IF EXISTS `ww_training_library`;

CREATE TABLE `ww_training_library` (
  `library_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `library` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `published_date` date DEFAULT NULL,
  `description` text,
  `upload` varchar(255) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`library_id`),
  KEY `job_class_code` (`library`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_provider` */

DROP TABLE IF EXISTS `ww_training_provider`;

CREATE TABLE `ww_training_provider` (
  `provider_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `provider_code` varchar(20) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`provider_id`),
  KEY `job_class_code` (`provider_code`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_revalida` */

DROP TABLE IF EXISTS `ww_training_revalida`;

CREATE TABLE `ww_training_revalida` (
  `training_revalida_id` int(11) NOT NULL AUTO_INCREMENT,
  `training_calendar_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `revalida_status_id` int(11) DEFAULT NULL,
  `total_score` int(11) NOT NULL DEFAULT '0',
  `average_score` decimal(6,2) DEFAULT '0.00',
  `created_by` int(11) DEFAULT '0',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT '0',
  `updated_date` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`training_revalida_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_revalida_category` */

DROP TABLE IF EXISTS `ww_training_revalida_category`;

CREATE TABLE `ww_training_revalida_category` (
  `training_revalida_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `training_revalida_master_id` int(11) DEFAULT NULL,
  `revalida_category` varchar(255) DEFAULT NULL,
  `revalida_category_weight` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`training_revalida_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_revalida_item` */

DROP TABLE IF EXISTS `ww_training_revalida_item`;

CREATE TABLE `ww_training_revalida_item` (
  `training_revalida_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `training_revalida_category_id` int(11) DEFAULT NULL,
  `training_revalida_item_no` int(2) NOT NULL,
  `description` varchar(128) NOT NULL,
  `score_type` int(11) DEFAULT '0',
  `item_weight` int(11) DEFAULT NULL,
  `inactive` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`training_revalida_item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_revalida_master` */

DROP TABLE IF EXISTS `ww_training_revalida_master`;

CREATE TABLE `ww_training_revalida_master` (
  `training_revalida_master_id` int(11) NOT NULL AUTO_INCREMENT,
  `revalida_type` varchar(255) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `draft` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`training_revalida_master_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_revalida_score` */

DROP TABLE IF EXISTS `ww_training_revalida_score`;

CREATE TABLE `ww_training_revalida_score` (
  `training_revalida_score_id` int(11) NOT NULL AUTO_INCREMENT,
  `training_revalida_id` int(11) NOT NULL,
  `training_revalida_item_id` int(11) NOT NULL,
  `score` decimal(6,2) DEFAULT '0.00',
  `remarks` text,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`training_revalida_score_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_revalida_score_type` */

DROP TABLE IF EXISTS `ww_training_revalida_score_type`;

CREATE TABLE `ww_training_revalida_score_type` (
  `score_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `score_type` varchar(16) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`score_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_source` */

DROP TABLE IF EXISTS `ww_training_source`;

CREATE TABLE `ww_training_source` (
  `source_id` int(11) NOT NULL AUTO_INCREMENT,
  `source_code` varchar(16) NOT NULL,
  `source` varchar(32) NOT NULL,
  `description` varchar(64) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`source_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_subject` */

DROP TABLE IF EXISTS `ww_training_subject`;

CREATE TABLE `ww_training_subject` (
  `training_subject_id` int(11) DEFAULT NULL,
  `training_subject` varchar(384) DEFAULT NULL,
  `training_type_id` int(11) DEFAULT NULL,
  `position_id` text,
  `training_provider_id` text,
  `training_category_id` int(11) DEFAULT NULL,
  `cost` decimal(14,0) DEFAULT NULL,
  `remarks` text,
  `training_bond` int(1) DEFAULT NULL,
  `rls` int(11) DEFAULT NULL,
  `training_subject_schedule_id` int(11) DEFAULT NULL,
  `trainor` varchar(765) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_training_type` */

DROP TABLE IF EXISTS `ww_training_type`;

CREATE TABLE `ww_training_type` (
  `type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `training_type_code` varchar(16) DEFAULT NULL,
  `training_type` varchar(255) DEFAULT NULL,
  `description` text,
  `status_id` tinyint(1) unsigned DEFAULT '0',
  `can_delete` tinyint(1) unsigned DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) unsigned DEFAULT NULL,
  `deleted` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_uitypes` */

DROP TABLE IF EXISTS `ww_uitypes`;

CREATE TABLE `ww_uitypes` (
  `uitype_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `uitype` varchar(32) NOT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`uitype_id`),
  KEY `uitype` (`uitype`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_uploaded_data` */

DROP TABLE IF EXISTS `ww_uploaded_data`;

CREATE TABLE `ww_uploaded_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=194 DEFAULT CHARSET=latin1;

/*Table structure for table `ww_users` */

DROP TABLE IF EXISTS `ww_users`;

CREATE TABLE `ww_users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(1) unsigned NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL DEFAULT '0',
  `can_view` tinyint(1) DEFAULT '1',
  `can_delete` tinyint(1) DEFAULT '1',
  `email` varchar(128) DEFAULT NULL,
  `full_name` varchar(64) NOT NULL DEFAULT '',
  `login` varchar(64) NOT NULL DEFAULT '',
  `hash` varchar(128) DEFAULT '$2a$08$hRV4eko18h6qPQ0gn7.f.eKk9O9Dv7nPKfZbN1mhregMrBYi3sR6i',
  `last_login` datetime DEFAULT '0000-00-00 00:00:00',
  `display_name` varchar(64) DEFAULT '',
  `timezone` char(64) DEFAULT 'Asia/Manila',
  `language` enum('en','id') DEFAULT 'en',
  `active` tinyint(1) DEFAULT '1',
  `lastactivity` int(11) DEFAULT NULL,
  `login_old` varchar(64) DEFAULT '',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`),
  KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  KEY `login` (`login`),
  KEY `deleted` (`deleted`),
  KEY `full_name` (`full_name`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_assignment` */

DROP TABLE IF EXISTS `ww_users_assignment`;

CREATE TABLE `ww_users_assignment` (
  `assignment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `assignment_code` varchar(16) NOT NULL DEFAULT '',
  `assignment` varchar(64) NOT NULL DEFAULT '',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`assignment_id`),
  KEY `job_class_code` (`assignment_code`),
  KEY `job_class` (`assignment`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_branch` */

DROP TABLE IF EXISTS `ww_users_branch`;

CREATE TABLE `ww_users_branch` (
  `branch_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `branch_code` varchar(16) NOT NULL DEFAULT '',
  `branch` varchar(64) NOT NULL DEFAULT '',
  `status_id` tinyint(1) DEFAULT '0',
  `payroll_branch_code` varchar(16) DEFAULT '',
  `sss_branch_code` varchar(32) DEFAULT '00',
  `sss_branch_code_locator` varchar(32) DEFAULT NULL,
  `hdmf_branch_code` varchar(32) DEFAULT '00',
  `company_coe` varchar(128) DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`branch_id`),
  KEY `job_class_code` (`branch_code`),
  KEY `job_class` (`branch`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_company` */

DROP TABLE IF EXISTS `ww_users_company`;

CREATE TABLE `ww_users_company` (
  `company_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `company_code` varchar(16) NOT NULL DEFAULT '',
  `company` varchar(64) NOT NULL DEFAULT '',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `address` varchar(128) DEFAULT NULL,
  `city_id` int(1) DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `country_id` int(1) DEFAULT NULL,
  `country` varchar(32) DEFAULT NULL,
  `zipcode` varchar(16) DEFAULT NULL,
  `vat` varchar(32) DEFAULT NULL,
  `logo` varchar(128) DEFAULT NULL,
  `print_logo` varchar(128) DEFAULT NULL,
  `bank_id` varchar(32) DEFAULT NULL,
  `sss` varchar(32) DEFAULT NULL,
  `sss_branch_code` varchar(32) DEFAULT '00',
  `sss_branch_code_locator` varchar(32) DEFAULT NULL,
  `hdmf` varchar(32) DEFAULT NULL,
  `hdmf_branch_code` varchar(32) DEFAULT '00',
  `phic` varchar(32) DEFAULT NULL,
  `tin` varchar(32) DEFAULT NULL,
  `rdo` varchar(4) DEFAULT NULL,
  `business_group_id` int(1) DEFAULT '1',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`company_id`),
  UNIQUE KEY `company_code` (`company_code`),
  KEY `company` (`company`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_company_contact` */

DROP TABLE IF EXISTS `ww_users_company_contact`;

CREATE TABLE `ww_users_company_contact` (
  `contacts_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(1) NOT NULL DEFAULT '0',
  `contact_type` enum('Phone','Mobile','Fax') NOT NULL DEFAULT 'Phone',
  `contact_no` varchar(16) DEFAULT '',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`contacts_id`),
  KEY `company_id` (`company_id`),
  KEY `contact_type` (`contact_type`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_competency_level` */

DROP TABLE IF EXISTS `ww_users_competency_level`;

CREATE TABLE `ww_users_competency_level` (
  `competency_level_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `competency_level_code` varchar(16) NOT NULL DEFAULT '',
  `competency_level` varchar(64) NOT NULL DEFAULT '',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`competency_level_id`),
  KEY `job_class_code` (`competency_level_code`),
  KEY `job_class` (`competency_level`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_contact_type` */

DROP TABLE IF EXISTS `ww_users_contact_type`;

CREATE TABLE `ww_users_contact_type` (
  `contact_type_id` int(1) NOT NULL AUTO_INCREMENT,
  `contact_type` varchar(32) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`contact_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_coordinator` */

DROP TABLE IF EXISTS `ww_users_coordinator`;

CREATE TABLE `ww_users_coordinator` (
  `coordinator_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` varchar(16) NOT NULL DEFAULT '',
  `branch_id` varchar(64) NOT NULL DEFAULT '',
  `coordinator_user_id` text,
  `user_id` text,
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`coordinator_id`),
  KEY `job_class_code` (`company_id`),
  KEY `job_class` (`branch_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_cost_center` */

DROP TABLE IF EXISTS `ww_users_cost_center`;

CREATE TABLE `ww_users_cost_center` (
  `cost_center_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cost_center_code` varchar(16) NOT NULL DEFAULT '',
  `cost_center` varchar(64) NOT NULL DEFAULT '',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`cost_center_id`),
  KEY `job_class_code` (`cost_center_code`),
  KEY `job_class` (`cost_center`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_department` */

DROP TABLE IF EXISTS `ww_users_department`;

CREATE TABLE `ww_users_department` (
  `department_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `division_id` int(11) NOT NULL DEFAULT '0',
  `division` varchar(64) DEFAULT '',
  `department_code` varchar(16) NOT NULL DEFAULT '',
  `department_old` varchar(16) DEFAULT NULL,
  `user_count` int(11) DEFAULT '0',
  `department` varchar(64) NOT NULL DEFAULT '',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `immediate_id` int(11) DEFAULT '0',
  `immediate` varchar(64) DEFAULT '',
  `immediate_position_id` int(11) DEFAULT '0',
  `immediate_position` varchar(64) DEFAULT '',
  `category_id` int(11) DEFAULT '1',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`department_id`),
  KEY `department_code` (`department_code`),
  KEY `department` (`department`),
  KEY `deleted` (`deleted`),
  KEY `division_id` (`division_id`),
  KEY `division` (`division`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_department_category` */

DROP TABLE IF EXISTS `ww_users_department_category`;

CREATE TABLE `ww_users_department_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_code` varchar(16) NOT NULL,
  `category` varchar(64) NOT NULL DEFAULT '',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_department_position` */

DROP TABLE IF EXISTS `ww_users_department_position`;

CREATE TABLE `ww_users_department_position` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL DEFAULT '0',
  `position` varchar(64) DEFAULT '',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `deleted` (`deleted`),
  KEY `division_id` (`position_id`),
  KEY `division` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_division` */

DROP TABLE IF EXISTS `ww_users_division`;

CREATE TABLE `ww_users_division` (
  `division_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `division_code` varchar(16) NOT NULL DEFAULT '',
  `division` varchar(64) NOT NULL DEFAULT '',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `immediate_id` int(11) DEFAULT '0',
  `immediate` varchar(64) DEFAULT '',
  `position_id` int(11) DEFAULT '0',
  `position` varchar(64) DEFAULT '',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`division_id`),
  UNIQUE KEY `division_code` (`division_code`),
  KEY `division` (`division`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_group` */

DROP TABLE IF EXISTS `ww_users_group`;

CREATE TABLE `ww_users_group` (
  `group_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_code` varchar(16) NOT NULL DEFAULT '',
  `group` varchar(64) NOT NULL DEFAULT '',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `immediate_id` int(11) DEFAULT '0',
  `immediate` varchar(64) DEFAULT '',
  `position_id` int(11) DEFAULT '0',
  `position` varchar(64) DEFAULT '',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`group_id`),
  KEY `group_code` (`group_code`),
  KEY `group` (`group`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_job_class` */

DROP TABLE IF EXISTS `ww_users_job_class`;

CREATE TABLE `ww_users_job_class` (
  `job_class_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `job_class_code` varchar(16) NOT NULL DEFAULT '',
  `job_class` varchar(64) NOT NULL DEFAULT '',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`job_class_id`),
  KEY `job_class_code` (`job_class_code`),
  KEY `job_class` (`job_class`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_job_family` */

DROP TABLE IF EXISTS `ww_users_job_family`;

CREATE TABLE `ww_users_job_family` (
  `job_family_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `job_family_code` varchar(16) NOT NULL DEFAULT '',
  `job_family` varchar(64) NOT NULL DEFAULT '',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `competency_profile_id` int(11) DEFAULT '0',
  `competency_profile` varchar(64) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`job_family_id`),
  KEY `job_title_code` (`job_family_code`),
  KEY `job_title` (`job_family`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_job_family_department` */

DROP TABLE IF EXISTS `ww_users_job_family_department`;

CREATE TABLE `ww_users_job_family_department` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `job_family_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `department` varchar(64) DEFAULT NULL,
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `job_title_code` (`job_family_id`),
  KEY `job_title` (`department_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_job_grade_level` */

DROP TABLE IF EXISTS `ww_users_job_grade_level`;

CREATE TABLE `ww_users_job_grade_level` (
  `job_grade_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `job_grade_code` varchar(16) NOT NULL,
  `job_level` varchar(64) NOT NULL DEFAULT '',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `min_salary` decimal(10,2) DEFAULT '0.00',
  `max_salary` decimal(10,2) DEFAULT '0.00',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`job_grade_id`),
  KEY `job_title_code` (`job_level`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_job_pay_level` */

DROP TABLE IF EXISTS `ww_users_job_pay_level`;

CREATE TABLE `ww_users_job_pay_level` (
  `pay_level_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pay_level_code` varchar(16) NOT NULL,
  `pay_level` varchar(64) NOT NULL DEFAULT '',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `min_salary` decimal(10,2) DEFAULT '0.00',
  `max_salary` decimal(10,2) DEFAULT '0.00',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`pay_level_id`),
  KEY `job_title_code` (`pay_level`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_job_rank` */

DROP TABLE IF EXISTS `ww_users_job_rank`;

CREATE TABLE `ww_users_job_rank` (
  `job_rank_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `job_rank_code` varchar(16) NOT NULL DEFAULT '',
  `job_rank` varchar(64) NOT NULL DEFAULT '',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`job_rank_id`),
  KEY `job_title_code` (`job_rank_code`),
  KEY `job_title` (`job_rank`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_job_rank_code` */

DROP TABLE IF EXISTS `ww_users_job_rank_code`;

CREATE TABLE `ww_users_job_rank_code` (
  `job_rank_code_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `job_rank_code_code` varchar(16) NOT NULL DEFAULT '',
  `job_rank_code` varchar(64) NOT NULL DEFAULT '',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`job_rank_code_id`),
  KEY `job_title_code` (`job_rank_code_code`),
  KEY `job_title` (`job_rank_code`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_job_rank_level` */

DROP TABLE IF EXISTS `ww_users_job_rank_level`;

CREATE TABLE `ww_users_job_rank_level` (
  `job_rank_level_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `job_rank_level_code` varchar(16) NOT NULL DEFAULT '',
  `job_rank_level` varchar(64) NOT NULL DEFAULT '',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`job_rank_level_id`),
  KEY `job_title_code` (`job_rank_level_code`),
  KEY `job_title` (`job_rank_level`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_job_title` */

DROP TABLE IF EXISTS `ww_users_job_title`;

CREATE TABLE `ww_users_job_title` (
  `job_title_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `job_title_code` varchar(16) NOT NULL DEFAULT '',
  `job_title` varchar(64) NOT NULL DEFAULT '',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `job_family_id` int(11) DEFAULT '0',
  `job_family` varchar(64) DEFAULT NULL,
  `job_rank_id` int(11) DEFAULT '0',
  `job_rank` varchar(64) DEFAULT NULL,
  `pay_level_id` int(11) DEFAULT '0',
  `pay_level` varchar(64) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`job_title_id`),
  KEY `job_title_code` (`job_title_code`),
  KEY `job_title` (`job_title`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_location` */

DROP TABLE IF EXISTS `ww_users_location`;

CREATE TABLE `ww_users_location` (
  `location_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `location_code` varchar(16) NOT NULL DEFAULT '',
  `location` varchar(64) NOT NULL DEFAULT '',
  `min_wage_amt` decimal(12,2) DEFAULT '0.00',
  `ecola_amt` decimal(12,2) DEFAULT '0.00',
  `ecola_amt_month` decimal(12,2) DEFAULT '0.00',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`location_id`),
  KEY `location_code` (`location_code`),
  KEY `location` (`location`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_pay_set_rates` */

DROP TABLE IF EXISTS `ww_users_pay_set_rates`;

CREATE TABLE `ww_users_pay_set_rates` (
  `pay_set_rates_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pay_set_rates_code` varchar(16) NOT NULL DEFAULT '',
  `pay_set_rates` varchar(64) NOT NULL DEFAULT '',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`pay_set_rates_id`),
  KEY `job_class_code` (`pay_set_rates_code`),
  KEY `job_class` (`pay_set_rates`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_position` */

DROP TABLE IF EXISTS `ww_users_position`;

CREATE TABLE `ww_users_position` (
  `position_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `position_code` varchar(16) NOT NULL DEFAULT '',
  `position` varchar(64) NOT NULL DEFAULT '',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `job_title_id` int(11) DEFAULT '0',
  `job_title` varchar(64) DEFAULT NULL,
  `job_rank_id` int(11) DEFAULT '0',
  `job_rank` varchar(64) DEFAULT NULL,
  `employee_type_id` int(1) DEFAULT '0',
  `employee_type` varchar(32) DEFAULT '',
  `immediate_id` int(11) DEFAULT '0',
  `immediate` varchar(64) DEFAULT '',
  `immediate_position_id` int(11) DEFAULT '0',
  `immediate_position` varchar(64) DEFAULT '',
  `job_description` varchar(255) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `amp_position_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`position_id`),
  KEY `position_code` (`position_code`),
  KEY `position` (`position`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=461 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_position_classification` */

DROP TABLE IF EXISTS `ww_users_position_classification`;

CREATE TABLE `ww_users_position_classification` (
  `position_classification_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `position_classification` varchar(16) NOT NULL DEFAULT '',
  `description` varchar(64) NOT NULL DEFAULT '',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `amp_position_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`position_classification_id`),
  KEY `position_code` (`position_classification`),
  KEY `position` (`description`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_profile` */

DROP TABLE IF EXISTS `ww_users_profile`;

CREATE TABLE `ww_users_profile` (
  `user_id` int(11) unsigned NOT NULL,
  `partner_id` int(11) NOT NULL DEFAULT '0',
  `recruit_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(16) DEFAULT '',
  `suffix` varchar(16) DEFAULT '',
  `lastname` varchar(64) NOT NULL DEFAULT '',
  `firstname` varchar(64) NOT NULL DEFAULT '',
  `middlename` varchar(64) DEFAULT '',
  `maidenname` varchar(64) DEFAULT '',
  `nickname` varchar(32) DEFAULT '',
  `company_id` int(1) NOT NULL DEFAULT '0',
  `company` varchar(64) DEFAULT '',
  `coordinator_id` varchar(64) DEFAULT '0',
  `v_coordinator` text,
  `group_id` int(1) NOT NULL DEFAULT '0',
  `v_group` varchar(64) DEFAULT '',
  `division_id` int(1) NOT NULL DEFAULT '0',
  `v_division` varchar(64) DEFAULT '',
  `department_id` int(1) NOT NULL DEFAULT '0',
  `v_department` varchar(64) DEFAULT '',
  `position_id` int(1) NOT NULL DEFAULT '0',
  `v_position` varbinary(64) DEFAULT '',
  `reports_to_id` int(11) DEFAULT '0',
  `v_reports_to` varchar(64) DEFAULT '',
  `project_hr_id` int(11) DEFAULT '0',
  `v_project_hr` varchar(64) DEFAULT '',
  `job_title_id` int(1) NOT NULL DEFAULT '0',
  `v_job_title` varchar(64) DEFAULT '',
  `specialization_id` int(11) DEFAULT '0',
  `v_specialization` varchar(64) DEFAULT '',
  `location_id` int(1) NOT NULL DEFAULT '0',
  `v_location` varchar(64) DEFAULT '',
  `project_id` int(11) DEFAULT NULL,
  `v_project` varchar(64) DEFAULT '',
  `section_id` int(11) DEFAULT NULL,
  `v_section` varchar(64) DEFAULT '',
  `branch_id` int(11) NOT NULL DEFAULT '0',
  `v_branch` varchar(64) DEFAULT '',
  `photo` varchar(128) DEFAULT NULL,
  `birth_date` date DEFAULT '0000-00-00',
  `business_level_id` int(1) DEFAULT '1',
  `start_date` date DEFAULT '0000-00-00',
  `end_date` date DEFAULT '0000-00-00',
  `credit_setup_id` int(11) DEFAULT NULL,
  `v_credit_setup` varchar(66) DEFAULT '',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `employee_id` (`partner_id`),
  KEY `lastname` (`lastname`),
  KEY `firstname` (`firstname`),
  KEY `company_id` (`company_id`),
  KEY `group_id` (`group_id`),
  KEY `division_id` (`division_id`),
  KEY `department_id` (`department_id`),
  KEY `position_id` (`position_id`),
  KEY `job_title_id` (`job_title_id`),
  KEY `location_id` (`location_id`),
  KEY `middlename` (`middlename`),
  KEY `applicant_id` (`recruit_id`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_profile_public` */

DROP TABLE IF EXISTS `ww_users_profile_public`;

CREATE TABLE `ww_users_profile_public` (
  `user_id` int(11) unsigned NOT NULL,
  `summary` text,
  `interest` text,
  `language_spoken` text,
  `social` text,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_profile_public_data` */

DROP TABLE IF EXISTS `ww_users_profile_public_data`;

CREATE TABLE `ww_users_profile_public_data` (
  `interest` varchar(128) DEFAULT 'null'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_project` */

DROP TABLE IF EXISTS `ww_users_project`;

CREATE TABLE `ww_users_project` (
  `project_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project_code` varchar(16) NOT NULL DEFAULT '',
  `project` varchar(64) NOT NULL DEFAULT '',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `immediate_id` int(11) DEFAULT '0',
  `immediate` varchar(64) DEFAULT '',
  `position_id` int(11) DEFAULT '0',
  `position` varchar(64) DEFAULT '',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`project_id`),
  KEY `section_code` (`project_code`),
  KEY `section` (`project`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_section` */

DROP TABLE IF EXISTS `ww_users_section`;

CREATE TABLE `ww_users_section` (
  `section_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `section_code` varchar(16) NOT NULL DEFAULT '',
  `section` varchar(64) NOT NULL DEFAULT '',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `immediate_id` int(11) DEFAULT '0',
  `immediate` varchar(64) DEFAULT '',
  `position_id` int(11) DEFAULT '0',
  `position` varchar(64) DEFAULT '',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`section_id`),
  KEY `section_code` (`section_code`),
  KEY `section` (`section`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_specialization` */

DROP TABLE IF EXISTS `ww_users_specialization`;

CREATE TABLE `ww_users_specialization` (
  `specialization_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `specialization_code` varchar(16) NOT NULL DEFAULT '',
  `specialization` varchar(64) NOT NULL DEFAULT '',
  `status_id` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`specialization_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `ww_users_status` */

DROP TABLE IF EXISTS `ww_users_status`;

CREATE TABLE `ww_users_status` (
  `users_status_id` int(11) DEFAULT NULL,
  `users_status` varchar(16) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `ww_utility_task` */

DROP TABLE IF EXISTS `ww_utility_task`;

CREATE TABLE `ww_utility_task` (
  `task_id` int(1) NOT NULL AUTO_INCREMENT,
  `task` varchar(64) NOT NULL,
  `task_status` enum('Idle','Running','Suspended') DEFAULT 'Idle',
  `minute` varchar(180) DEFAULT NULL,
  `hour` varchar(96) DEFAULT NULL,
  `day_of_month` varchar(96) DEFAULT NULL,
  `month` varchar(48) DEFAULT NULL,
  `day_of_week` varchar(16) DEFAULT NULL,
  `variable` text,
  `template_id` int(1) DEFAULT NULL,
  `email_to` text,
  `email_cc` text,
  `email_bcc` text,
  `last_run` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_ww_system_email_queue` */

DROP TABLE IF EXISTS `ww_ww_system_email_queue`;

CREATE TABLE `ww_ww_system_email_queue` (
  `id` int(11) unsigned NOT NULL,
  `timein` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('queued','sending','sent') DEFAULT 'queued',
  `to` text,
  `cc` text,
  `bcc` text,
  `subject` varchar(128) DEFAULT NULL,
  `body` text,
  `attachment` text,
  `attempts` tinyint(1) DEFAULT '0',
  `sent_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_ww_system_feeds` */

DROP TABLE IF EXISTS `ww_ww_system_feeds`;

CREATE TABLE `ww_ww_system_feeds` (
  `id` int(11) unsigned NOT NULL DEFAULT '0',
  `status` enum('info','success','warning','danger') DEFAULT 'info',
  `message_type` enum('Comment','Partners','Time Record','Personnel','Admin','System','Announcement','Company News') DEFAULT 'Comment',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(64) DEFAULT '',
  `feed_content` text,
  `uri` varchar(128) DEFAULT NULL,
  `record_id` int(11) DEFAULT '0',
  `recipient_id` int(11) DEFAULT '0' COMMENT 'thankyou: array of user ids',
  `readon` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'whoread: array of user ids',
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedon` datetime DEFAULT NULL,
  `reactedon` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_ww_time_form_balance` */

DROP TABLE IF EXISTS `ww_ww_time_form_balance`;

CREATE TABLE `ww_ww_time_form_balance` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `year` int(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `form_id` int(11) NOT NULL DEFAULT '0',
  `form_code` varchar(8) DEFAULT '',
  `credit` decimal(6,3) DEFAULT '0.000',
  `used` decimal(6,3) DEFAULT '0.000',
  `balance` decimal(6,3) DEFAULT '0.000',
  `paid_unit` decimal(6,3) DEFAULT '0.000',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `year` (`year`),
  KEY `user_id` (`user_id`),
  KEY `form_id` (`form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_ww_time_forms` */

DROP TABLE IF EXISTS `ww_ww_time_forms`;

CREATE TABLE `ww_ww_time_forms` (
  `forms_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `form_status_id` tinyint(1) NOT NULL DEFAULT '0',
  `form_id` int(1) NOT NULL DEFAULT '0',
  `form_code` varchar(8) DEFAULT '',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(64) DEFAULT '',
  `day` decimal(5,2) DEFAULT '0.00',
  `hrs` decimal(5,2) DEFAULT '0.00',
  `ot_break` decimal(5,2) DEFAULT '0.00',
  `date_from` date DEFAULT '0000-00-00',
  `date_to` date DEFAULT '0000-00-00',
  `date_approved` datetime DEFAULT '0000-00-00 00:00:00',
  `date_declined` datetime DEFAULT '0000-00-00 00:00:00',
  `date_cancelled` datetime DEFAULT '0000-00-00 00:00:00',
  `date_sent` datetime DEFAULT '0000-00-00 00:00:00',
  `reason` text,
  `scheduled` enum('YES','NO') DEFAULT 'YES',
  `type` enum('File','Use') DEFAULT 'File',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`forms_id`),
  KEY `form_id` (`form_id`),
  KEY `user_id` (`user_id`),
  KEY `deleted` (`deleted`),
  KEY `created_on` (`created_on`),
  KEY `date_from` (`date_from`),
  KEY `forms_status_id` (`form_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_ww_time_forms_approver` */

DROP TABLE IF EXISTS `ww_ww_time_forms_approver`;

CREATE TABLE `ww_ww_time_forms_approver` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `forms_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  `display_name` varchar(64) CHARACTER SET latin1 DEFAULT '',
  `condition` tinyint(1) DEFAULT '1',
  `sequence` tinyint(1) DEFAULT '1',
  `approved` datetime DEFAULT '0000-00-00 00:00:00',
  `cancelled` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `forms_id` (`forms_id`),
  KEY `user_id` (`user_id`),
  KEY `sequence` (`sequence`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_ww_time_record` */

DROP TABLE IF EXISTS `ww_ww_time_record`;

CREATE TABLE `ww_ww_time_record` (
  `record_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `biometric` varchar(8) NOT NULL DEFAULT '',
  `shift_id` int(1) DEFAULT '0',
  `shift` varchar(32) DEFAULT NULL,
  `date` date NOT NULL,
  `processed` tinyint(1) DEFAULT '0',
  `override` tinyint(1) DEFAULT '0',
  `aux_shift_id` int(1) DEFAULT '0',
  `aux_shift` varchar(16) DEFAULT '',
  `aux_time_in` datetime DEFAULT NULL,
  `aux_time_out` datetime DEFAULT NULL,
  `time_in` datetime DEFAULT NULL,
  `time_out` datetime DEFAULT NULL,
  `flexible_min` int(1) DEFAULT '0',
  `flexible_time` time DEFAULT '00:00:00',
  `breaka_in` datetime DEFAULT NULL,
  `breaka_out` datetime DEFAULT NULL,
  `breakb_in` datetime DEFAULT NULL,
  `breakb_out` datetime DEFAULT NULL,
  `ot_in` datetime DEFAULT NULL,
  `ot_out` datetime DEFAULT NULL,
  `ot_in2` datetime DEFAULT NULL,
  `ot_out2` datetime DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`record_id`),
  UNIQUE KEY `user_date` (`user_id`,`date`),
  KEY `user_id` (`user_id`),
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ww_ww_time_record_raw` */

DROP TABLE IF EXISTS `ww_ww_time_record_raw`;

CREATE TABLE `ww_ww_time_record_raw` (
  `raw_id` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT '0',
  `biometric` varchar(8) NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `location_id` int(1) DEFAULT NULL,
  `device_id` int(1) DEFAULT NULL,
  `checktime` datetime NOT NULL,
  `checktype` varchar(8) DEFAULT NULL,
  `processed` tinyint(1) DEFAULT '0',
  `last_processed` datetime DEFAULT NULL,
  `archive` datetime DEFAULT NULL,
  UNIQUE KEY `biometric_date_checktime` (`biometric`,`date`,`checktime`),
  KEY `raw_id` (`raw_id`),
  KEY `user_id` (`user_id`),
  KEY `date` (`date`),
  KEY `biometric` (`biometric`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
