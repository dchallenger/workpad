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
/* Trigger structure for table `ww_approver_class_company` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `approver_class_company_insert_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `approver_class_company_insert_before` BEFORE INSERT ON `ww_approver_class_company` FOR EACH ROW BEGIN
        
        /* This will insert-update display names accross all modules 
           last change: 2014-07-18 initial
                        2014-07-18 
        */ 
        SET NEW.`alias` = (SELECT IFNULL(`display_name`,'*') FROM `users` WHERE `user_id`=NEW.`approver_id` LIMIT 1);
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_approver_class_company` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `approver_class_company_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `approver_class_company_update_before` BEFORE UPDATE ON `ww_approver_class_company` FOR EACH ROW BEGIN
        
        /* This will insert-update display names accross all modules 
           last change: 2014-07-18 initial
                        2014-07-18 
        */ 
        SET NEW.`alias` = (SELECT IFNULL(`display_name`,'*') FROM `users` WHERE `user_id`=NEW.`approver_id` LIMIT 1);
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_approver_class_department` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `approver_class_depatment_insert_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `approver_class_depatment_insert_before` BEFORE INSERT ON `ww_approver_class_department` FOR EACH ROW BEGIN
        
        /* This will insert-update display names accross all modules 
           last change: 2014-07-18 initial
                        2014-07-18 
        */ 
        SET NEW.`alias` = (SELECT IFNULL(`display_name`,'*') FROM `users` WHERE `user_id`=NEW.`approver_id` LIMIT 1);
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_approver_class_department` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `approver_class_department_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `approver_class_department_update_before` BEFORE UPDATE ON `ww_approver_class_department` FOR EACH ROW BEGIN
        
        /* This will insert-update display names accross all modules 
           last change: 2014-07-18 initial
                        2014-07-18 
        */ 
        SET NEW.`alias` = (SELECT IFNULL(`display_name`,'*') FROM `users` WHERE `user_id`=NEW.`approver_id` LIMIT 1);
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_approver_class_position` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `approver_class_position_insert_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `approver_class_position_insert_before` BEFORE INSERT ON `ww_approver_class_position` FOR EACH ROW BEGIN
        
        /* This will insert-update display names accross all modules 
           last change: 2014-07-18 initial
                        2014-07-18 
        */
         
        SET NEW.`alias` = (SELECT IFNULL(`display_name`,'*') FROM `users` WHERE `user_id`=NEW.`approver_id` LIMIT 1);
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_approver_class_position` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `approver_class_position_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `approver_class_position_update_before` BEFORE UPDATE ON `ww_approver_class_position` FOR EACH ROW BEGIN
        
        /* This will insert-update display names accross all modules 
           last change: 2014-07-18 initial
                        2014-07-18 
        */ 
        SET NEW.`alias` = (SELECT IFNULL(`display_name`,'*') FROM `users` WHERE `user_id`=NEW.`approver_id` LIMIT 1);
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_approver_class_user` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `approver_class_user_before_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `approver_class_user_before_insert` BEFORE INSERT ON `ww_approver_class_user` FOR EACH ROW BEGIN
	SET NEW.`alias` = (SELECT IFNULL(`display_name`,'*') FROM `users` WHERE `user_id`=NEW.`approver_id` LIMIT 1);
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_approver_class_user` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `approver_class_user_before_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `approver_class_user_before_update` BEFORE UPDATE ON `ww_approver_class_user` FOR EACH ROW BEGIN
	SET NEW.`alias` = (SELECT IFNULL(`display_name`,'*') FROM `users` WHERE `user_id`=NEW.`approver_id` LIMIT 1);
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_audit_log_trail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `audit_log_insert_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `audit_log_insert_before` BEFORE INSERT ON `ww_audit_log_trail` FOR EACH ROW 
      BEGIN
	
	/* for signatories */
	if NEW.item_name = 'class_id' then
		if NEW.original_value != '' then
			SET NEW.`original_value` = (SELECT IFNULL(class,'*') FROM ww_approver_class WHERE class_id=NEW.`original_value` LIMIT 1);
		end if;
		IF NEW.new_value != '' THEN
			SET NEW.`new_value` = (SELECT IFNULL(class,'*') FROM ww_approver_class WHERE class_id=NEW.`new_value` LIMIT 1);
		END IF;		
		set NEW.item_name = 'module';
	end if;
	IF NEW.item_name = 'approver' AND NEW.modules = 'signatories' THEN
		set NEW.item_name = 'signatory';
		
		if NEW.original_value != '' then
			if NEW.original_value = 1 then
				set NEW.original_value = 'Yes';
			else
				SET NEW.original_value = 'No';
			end if;
		end if;
		
		IF NEW.new_value !=  '' then
			if NEW.new_value = 1 then
				SET NEW.new_value = 'Yes';
			ELSE
				SET NEW.new_value = 'No';
			END if;
		END IF;		
	END IF;
		
	if NEW.item_name = 'alias' and NEW.modules = 'signatories' then
		SET NEW.item_name = 'approver';
	end if;
	IF NEW.item_name = 'email' AND NEW.modules = 'signatories' THEN
		IF NEW.original_value != '' THEN
			IF NEW.original_value = 1 THEN
				SET NEW.original_value = 'Yes';
			ELSE
				SET NEW.original_value = 'No';
			END IF;
		END IF;
		
		IF NEW.new_value !=  '' THEN
			IF NEW.new_value = 1 THEN
				SET NEW.new_value = 'Yes';
			ELSE
				SET NEW.new_value = 'No';
			END IF;
		END IF;	
	END IF;	
	IF NEW.item_name = 'employee' AND NEW.modules = 'signatories' THEN
		IF NEW.original_value != '' THEN
			SET NEW.`original_value` = (SELECT IFNULL(display_name,'*') FROM users WHERE user_id=NEW.`original_value` LIMIT 1);
		end if;
		IF NEW.new_value != '' THEN
			SET NEW.`new_value` = (SELECT IFNULL(display_name,'*') FROM users WHERE user_id=NEW.`new_value` LIMIT 1);
		END IF;		
	end if;
	
	/* for memo */
	IF NEW.item_name = 'email' AND (NEW.modules = 'memo' OR NEW.modules = 'memo_manage') THEN
		IF NEW.original_value != '' THEN
			IF NEW.original_value = 1 THEN
				SET NEW.original_value = 'Yes';
			ELSE
				SET NEW.original_value = 'No';
			END IF;
		END IF;
		
		IF NEW.new_value !=  '' THEN
			IF NEW.new_value = 1 THEN
				SET NEW.new_value = 'Yes';
			ELSE
				SET NEW.new_value = 'No';
			END IF;
		END IF;	
	END IF;	
				
	IF NEW.item_name = 'publish' AND (NEW.modules = 'memo' or NEW.modules = 'memo_manage') THEN
		IF NEW.original_value != '' THEN
			IF NEW.original_value = 1 THEN
				SET NEW.original_value = 'Yes';
			ELSE
				SET NEW.original_value = 'No';
			END IF;
		END IF;
		
		IF NEW.new_value !=  '' THEN
			IF NEW.new_value = 1 THEN
				SET NEW.new_value = 'Yes';
			ELSE
				SET NEW.new_value = 'No';
			END IF;
		END IF;	
	END IF;	
	IF NEW.item_name = 'comments' AND (NEW.modules = 'memo' OR NEW.modules = 'memo_manage') THEN
		IF NEW.original_value != '' THEN
			IF NEW.original_value = 1 THEN
				SET NEW.original_value = 'Yes';
			ELSE
				SET NEW.original_value = 'No';
			END IF;
		END IF;
		
		IF NEW.new_value !=  '' THEN
			IF NEW.new_value = 1 THEN
				SET NEW.new_value = 'Yes';
			ELSE
				SET NEW.new_value = 'No';
			END IF;
		END IF;	
	END IF;
						
      END */$$


DELIMITER ;

/* Trigger structure for table `ww_memo` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `memo_update_after` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `memo_update_after` AFTER UPDATE ON `ww_memo` FOR EACH ROW BEGIN
        
        /* This will update system feeds on unpublish/deleted content
           last change: 2016-04-01 initial
                        2016-04-01 
        */ 
        IF NEW.`deleted` = 1 THEN
           UPDATE `ww_system_feeds` SET `deleted`=1 WHERE `record_id`=NEW.`memo_id`;
        END IF;
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_menu` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `menu_to_insert_on_profile_menu` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `menu_to_insert_on_profile_menu` BEFORE INSERT ON `ww_menu` FOR EACH ROW BEGIN
        /* 
           - to insert this so that admin profile always has the rights on newly created menu
           - to update/delete on profile to sync records
           
           INSERT INTO www_profile_menu 
           profile_id = 1
        */
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_partners` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `partners_insert_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `partners_insert_before` BEFORE INSERT ON `ww_partners` FOR EACH ROW 
BEGIN
        
        /* This will insert-update display names accross all modules 
           last change: 2014-04-16 initial
                        2014-04-16 
        */ 
        
        IF NEW.`deleted` = 0 THEN
           SET @coid = (SELECT company_id FROM users_profile WHERE user_id=NEW.`user_id` LIMIT 1);
           INSERT INTO `ww_payroll_partners` (`user_id`,`company_id`,`salary`) VALUES (NEW.`user_id`,@coid,NEW.`salary`)
           ON DUPLICATE KEY UPDATE company_id=IFNULL(company_id,@coid),`modified_on`=NOW(),`deleted`=0;
        END IF;
                
        SET NEW.`alias` = (SELECT IFNULL(display_name,'*') FROM users WHERE user_id=NEW.`user_id` LIMIT 1);
        SET NEW.`shift` = (SELECT IFNULL(`shift`,'*') FROM `ww_time_shift` WHERE `shift_id`=NEW.shift_id LIMIT 1);
        SET NEW.`calendar` = (SELECT IFNULL(`calendar`,'*') FROM `ww_time_shift_weekly` WHERE `calendar_id`=NEW.calendar_id LIMIT 1);
        SET NEW.`status` = (SELECT IFNULL(`employment_status`,'*') FROM `ww_partners_employment_status` WHERE `employment_status_id`=NEW.status_id LIMIT 1);
        SET NEW.`employment_type` = (SELECT IFNULL(`employment_type`,'*') FROM `ww_partners_employment_type` WHERE `employment_type_id`=NEW.employment_type_id LIMIT 1);        
        SET NEW.`v_job_grade` = (SELECT IFNULL(`job_level`,'*') FROM `ww_users_job_grade_level` WHERE `job_grade_id`=NEW.job_grade_id LIMIT 1);
        SET NEW.`classification` = (SELECT IFNULL(`classification`,'*') FROM `ww_partners_classification` WHERE `classification_id`=NEW.classification_id LIMIT 1);
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_partners` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `partners_insert_after` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `partners_insert_after` AFTER INSERT ON `ww_partners` FOR EACH ROW 
BEGIN
        
        /* This will insert-update display names accross all modules 
           last change: 2015-09-15 initial
                        0000-00-00 
        */ 
        
       IF NEW.`deleted` <> 1 THEN
           SET @p1 = NEW.`effectivity_date`;
           SET @p2 = @p1 + INTERVAL 30 DAY;
           SET @p3 = NEW.`user_id`;
           -- CALL sp_time_period_populate_user(@p1, @p2, @p3);
        END IF;
              
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_partners` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `partners_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `partners_update_before` BEFORE UPDATE ON `ww_partners` FOR EACH ROW 
BEGIN
       
       /* This will insert-update display names accross all modules 
          last change: 2014-04-16 initial
                       2015-09-14 company for payroll 
       */ 
       IF NEW.`deleted` = 0 THEN
          SET @coid = (SELECT company_id FROM ww_users_profile WHERE user_id=NEW.`user_id` LIMIT 1);
          INSERT INTO `ww_payroll_partners` (`user_id`,`company_id`,`salary`) VALUES (NEW.`user_id`,@coid,NEW.`salary`)
          ON DUPLICATE KEY UPDATE company_id=IFNULL(company_id,@coid),`modified_on`=NOW(),`deleted`=0;
       END IF;
       
       SET NEW.`alias` = (SELECT IFNULL(display_name,'*') FROM ww_users WHERE user_id=NEW.`user_id` LIMIT 1);
       SET NEW.`shift` = (SELECT IFNULL(`shift`,'*') FROM `ww_time_shift` WHERE `shift_id`=NEW.shift_id LIMIT 1);
       SET NEW.`calendar` = (SELECT IFNULL(`calendar`,'*') FROM `ww_time_shift_weekly` WHERE `calendar_id`=NEW.calendar_id LIMIT 1);
       SET NEW.`status` = (SELECT IFNULL(`employment_status`,'*') FROM `ww_partners_employment_status` WHERE `employment_status_id`=NEW.status_id LIMIT 1);
       SET NEW.`employment_type` = (SELECT IFNULL(`employment_type`,'*') FROM `ww_partners_employment_type` WHERE `employment_type_id`=NEW.employment_type_id LIMIT 1);        
       SET NEW.`v_job_grade` = (SELECT IFNULL(`job_level`,'*') FROM `ww_users_job_grade_level` WHERE `job_grade_id`=NEW.job_grade_id LIMIT 1);
       SET NEW.`classification` = (SELECT IFNULL(`classification`,'*') FROM `ww_partners_classification` WHERE `classification_id`=NEW.classification_id LIMIT 1);       
       
       SET NEW.`modified_on` = NOW();
       
   END */$$


DELIMITER ;

/* Trigger structure for table `ww_partners` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `partners_update_after` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `partners_update_after` AFTER UPDATE ON `ww_partners` FOR EACH ROW 
BEGIN
        
        /* This will update partner schedule from this date onwards
           last change: 2015-07-16 initial
                        2015-09-09 update users 
                        2017-03-18 change shift_id to calendar_id
        */ 
        
        IF NEW.`calendar_id` <> OLD.`calendar_id` AND IFNULL(NEW.`resigned_date`,'0000-00-00')='0000-00-00' THEN
           SET @p1 = CURDATE();
           SET @p2 = CONCAT(YEAR(CURDATE()),'-12-31');
           SET @p3 = NEW.`user_id`;
           CALL sp_time_period_populate_user(@p1, @p2, @p3);
        END IF;
        
        IF IFNULL(NEW.`resigned_date`,'0000-00-00') <> '0000-00-00' THEN
           IF NEW.`resigned_date` <= CURDATE() THEN
              UPDATE `ww_users` SET active=0 WHERE `user_id`=NEW.`user_id` LIMIT 1;
           END IF;
        END IF;
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_partners_loan_application` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `partners_loan_application_insert_after` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `partners_loan_application_insert_after` AFTER INSERT ON `ww_partners_loan_application` FOR EACH ROW BEGIN
    
       /* This will update necessary master table
          last change: 2014-04-25: initial
                       2014-04-26: populate approver/s
       */
       IF NEW.`loan_application_status_id`=2 THEN
          INSERT INTO `logtable` (`log`) VALUES (CONCAT(NEW.`loan_application_id`,' ',NEW.`user_id`)); 
          CALL sp_partners_loan_application_populate_approvers(NEW.`loan_application_id`, NEW.`user_id`);   
       END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_partners_loan_application` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `partners_loan_application_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `partners_loan_application_update_before` BEFORE UPDATE ON `ww_partners_loan_application` FOR EACH ROW BEGIN
    
       /* This will insert-update approver/s on application
          last change: 2014-04-26: initial
                       2014-04-26: populate approver/s if set to for approval
       */
       -- 
       SET NEW.`modified_on` = NOW();
       -- 
    
       IF NEW.`loan_application_status_id`=2 THEN
          -- 
          CALL sp_partners_loan_application_populate_approvers(NEW.`loan_application_id`, NEW.`user_id`);  
          --                   
       END IF;
       IF NEW.`loan_application_status_id`=8 THEN
          -- 
          UPDATE `ww_partners_loan_application_approver` SET `loan_application_status_id`=8,`loan_application_status`='Cancelled' WHERE `loan_application_id`=NEW.`loan_application_id`;  
          --                   
       END IF;          
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_partners_loan_application_approver` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `partners_loan_application_approver_insert_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `partners_loan_application_approver_insert_before` BEFORE INSERT ON `ww_partners_loan_application_approver` FOR EACH ROW BEGIN
        
        /* This will insert-update display names accross all modules 
           last change: 2014-07-17 initial
                        2014-07-17 
        */ 
        SET NEW.`display_name` = (SELECT IFNULL(`display_name`,'*') FROM `users` WHERE `user_id`=NEW.`user_id` LIMIT 1);
        SET NEW.`loan_application_status` = (SELECT IFNULL(`loan_application_status`,'*') FROM `ww_partners_loan_application_status` WHERE `loan_application_status_id`=NEW.`loan_application_status_id` LIMIT 1);
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_partners_loan_application_approver` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `partners_loan_application_approver_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `partners_loan_application_approver_update_before` BEFORE UPDATE ON `ww_partners_loan_application_approver` FOR EACH ROW BEGIN
        
        /* This will insert-update display names accross all modules 
           last change: 2014-07-17 initial
                        2015-05-05 change display name  
        */ 
	SET NEW.`display_name` = (SELECT IFNULL(`display_name`,'*') FROM `users` WHERE `user_id`=NEW.`user_id` LIMIT 1);
        SET NEW.`loan_application_status` = (SELECT IFNULL(`loan_application_status`,'*') FROM `ww_partners_loan_application_status` WHERE `loan_application_status_id`=NEW.`loan_application_status_id` LIMIT 1);
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_partners_loan_application_approver` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `partners_loan_application_approver_update_after` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `partners_loan_application_approver_update_after` AFTER UPDATE ON `ww_partners_loan_application_approver` FOR EACH ROW BEGIN
	   SET @appCount    = 0;
	   SET @appApproved = 0;
	   SET @appDeclined = 0;
	   
	   SELECT COUNT(*), SUM(IF(`loan_application_status_id`=6,1,0)), SUM(IF(`loan_application_status_id`=7,1,0)) 
	   INTO @appCount, @appApproved, @appDeclined
	   FROM `ww_partners_loan_application_approver`
	   WHERE `loan_application_id`=NEW.`loan_application_id`;
	   
	   IF NEW.`loan_application_status_id` != 8 THEN
		   UPDATE `ww_partners_loan_application`
		   SET
		      `loan_application_status_id` = IF(@appCount=@appApproved, 6, IF(@appCount=@appDeclined, 7, IF(@appDeclined > 0, 7, IF(@appApproved > 0, 3, `loan_application_status_id`)))),
		      `date_approved` = IF(@appCount=@appApproved, NOW(), `date_approved`),
		      `date_declined` = IF(@appDeclined > 0, NOW(), `date_declined`)
		   WHERE 
		      `loan_application_id` = NEW.`loan_application_id`;
	   END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_partners_movement_action` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `partners_movement_action_insert_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `partners_movement_action_insert_before` BEFORE INSERT ON `ww_partners_movement_action` FOR EACH ROW BEGIN
        
        /* This will insert-update display names accross all modules 
           last change: 2014-04-16 initial
                        2014-04-18 
        */ 
        SET NEW.`display_name` = (SELECT IFNULL(display_name,'*') FROM users WHERE user_id=NEW.`user_id` LIMIT 1);
        SET NEW.`type` = (SELECT IFNULL(`type`,'*') FROM `ww_partners_movement_type` WHERE `type_id`=NEW.type_id LIMIT 1);
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_partners_movement_action` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `partners_movement_action_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `partners_movement_action_update_before` BEFORE UPDATE ON `ww_partners_movement_action` FOR EACH ROW BEGIN
        
        /* This will insert-update display names accross all modules 
           last change: 2014-04-16 initial
                        2014-04-18 
        */ 
        SET NEW.`display_name` = (SELECT IFNULL(display_name,'*') FROM users WHERE user_id=NEW.`user_id` LIMIT 1);
        SET NEW.`type` = (SELECT IFNULL(`type`,'*') FROM `ww_partners_movement_type` WHERE `type_id`=NEW.type_id LIMIT 1);
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_payroll_bonus` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `payroll_bonus_before_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `payroll_bonus_before_insert` BEFORE INSERT ON `ww_payroll_bonus` FOR EACH ROW BEGIN
	IF NEW.bonus_transaction_code IS NOT NULL THEN
		SET NEW.bonus_transaction_id = (SELECT transaction_id FROM ww_payroll_transaction WHERE transaction_code = NEW.bonus_transaction_code LIMIT 1);
	END IF;
	
	IF NEW.taxable_bonus_transaction_code IS NOT NULL THEN
		SET NEW.taxable_bonus_transaction_id = (SELECT transaction_id FROM ww_payroll_transaction WHERE transaction_code = NEW.taxable_bonus_transaction_code LIMIT 1);
	END IF;
	
	IF NEW.method IS NOT NULL THEN
		SET NEW.transaction_method_id = (SELECT payroll_transaction_method_id FROM ww_payroll_transaction_method WHERE payroll_transaction_method = NEW.method  LIMIT 1);
	END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_payroll_bonus_employee` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `payroll_bonus_employee_before_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `payroll_bonus_employee_before_insert` BEFORE INSERT ON `ww_payroll_bonus_employee` FOR EACH ROW BEGIN
    
	IF IFNULL(NEW.`document_no`,'') <> '' THEN
		SET NEW.`bonus_id` = (SELECT `bonus_id` FROM `ww_payroll_bonus` WHERE `document_no` = NEW.`document_no` LIMIT 1);
	END IF;
    
	IF IFNULL(NEW.`id_number`,'') <> '' THEN
		SET NEW.`employee_id` = (SELECT `user_id` FROM `ww_partners` WHERE `id_number` = NEW.`id_number` LIMIT 1);
	END IF;
    
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_payroll_entry_batch` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `payroll_entry_batch_before_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `payroll_entry_batch_before_insert` BEFORE INSERT ON `ww_payroll_entry_batch` FOR EACH ROW BEGIN
	IF NEW.transaction_code IS NOT NULL THEN
		SET NEW.transaction_id = (SELECT transaction_id FROM ww_payroll_transaction where transaction_code = NEW.transaction_code LIMIT 1);
	END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_payroll_entry_batch_employee` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `payroll_entry_batch_employee` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `payroll_entry_batch_employee` BEFORE INSERT ON `ww_payroll_entry_batch_employee` FOR EACH ROW BEGIN
    
	if NEW.`document_no` is NOT NULL THEN
		SET NEW.`batch_entry_id` = (SELECT `batch_entry_id` FROM `ww_payroll_entry_batch` WHERE `document_no`=NEW.`document_no` LIMIT 1);		
	END IF;
    
	IF IFNULL(NEW.`id_number`,'') <> '' THEN
		SET NEW.`employee_id` = (SELECT `user_id` FROM `ww_partners` WHERE `id_number` = NEW.`id_number` AND deleted = 0 LIMIT 1);	
	END IF;
    
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_payroll_entry_recurring` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `payroll_entry_recurring_before_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `payroll_entry_recurring_before_insert` BEFORE INSERT ON `ww_payroll_entry_recurring` FOR EACH ROW BEGIN
	if NEW.transaction_code is not null then
		set NEW.transaction_id = (Select transaction_id from ww_payroll_transaction where transaction_code = NEW.transaction_code LIMIT 1);
	end if;
	
	IF NEW.transaction_method IS NOT NULL THEN
		SET NEW.transaction_method_id = (SELECT payroll_transaction_method_id FROM ww_payroll_transaction_method WHERE payroll_transaction_method = NEW.transaction_method LIMIT 1);
	END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_payroll_entry_recurring_employee` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `payroll_entry_recurring_employee_before_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `payroll_entry_recurring_employee_before_insert` BEFORE INSERT ON `ww_payroll_entry_recurring_employee` FOR EACH ROW BEGIN
    
	IF IFNULL(NEW.`document_no`,'') <> '' THEN
		SET NEW.`recurring_id` = (select `recurring_id` from `ww_payroll_entry_recurring` where `document_no` = NEW.`document_no` LIMIT 1);
	END IF;
    
	IF IFNULL(NEW.`id_number`,'') <> '' THEN
		SET NEW.`employee_id` = (SELECT `user_id` FROM `ww_partners` WHERE `id_number` = NEW.`id_number` AND deleted = 0 LIMIT 1);
	END IF;
    
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_payroll_partners_loan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `payroll_partners_loan_before_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `payroll_partners_loan_before_insert` BEFORE INSERT ON `ww_payroll_partners_loan` FOR EACH ROW BEGIN
	if NEW.id_number is not null then
		SET NEW.user_id = (select user_id from ww_partners where id_number = NEW.id_number limit 1);
	end if;
	
	IF NEW.loan_code IS NOT NULL THEN
		SET NEW.loan_id = (SELECT loan_id FROM ww_payroll_loan where loan_code = NEW.loan_code LIMIT 1);
	END IF;
	
	IF NEW.loan_status IS NOT NULL THEN
		SET NEW.loan_status_id = (SELECT loan_status_id FROM ww_payroll_loan_status WHERE loan_status = NEW.loan_status LIMIT 1);
	END IF;
	
	IF NEW.payment_mode IS NOT NULL THEN
		SET NEW.payment_mode_id = (SELECT payment_mode_id FROM ww_payroll_payment_mode WHERE payment_mode = NEW.payment_mode LIMIT 1);
	END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_payroll_period` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `payroll_period_insert_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `payroll_period_insert_before` BEFORE INSERT ON `ww_payroll_period` FOR EACH ROW BEGIN
    
        if NEW.period_processing_type_id = 4 then
		set NEW.bonus_tag = 1;
        end if;
         
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_payroll_period` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `payroll_period_insert_after` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `payroll_period_insert_after` AFTER INSERT ON `ww_payroll_period` FOR EACH ROW BEGIN
        
        /* This will insert Year on ww_payroll_year */
        set @payYear = year(NEW.payroll_date);
        set @nCount = 0;
        select count(*) into @nCount from ww_payroll_year where payroll_year = @payYear;
        if @nCount = 0 then
		insert into ww_payroll_year(payroll_year) values (@payYear);
        end if;
                
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_performance_appraisal_applicable` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `performance_appraisal_logs_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `performance_appraisal_logs_insert` BEFORE INSERT ON `ww_performance_appraisal_applicable` FOR EACH ROW BEGIN
    
       SET @touser = '';
       
       SELECT IFNULL(`display_name`,'') INTO @touser FROM `users` WHERE `user_id`=NEW.`to_user_id` LIMIT 1;
       
       INSERT INTO `ww_performance_appraisal_logs` 
          (appraisal_id, user_id, status_id, to_user_id, to_user)
       SELECT NEW.`appraisal_id`, NEW.`user_id`, NEW.`status_id`, NEW.`to_user_id`, @touser;
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_performance_appraisal_applicable` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `performance_appraisal_applicable_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `performance_appraisal_applicable_update_before` BEFORE UPDATE ON `ww_performance_appraisal_applicable` FOR EACH ROW BEGIN
        
        SET NEW.`modified_date` = NOW();
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_performance_appraisal_applicable` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `performance_appraisal_logs_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `performance_appraisal_logs_update` AFTER UPDATE ON `ww_performance_appraisal_applicable` FOR EACH ROW BEGIN
    
       SET @touser = '';
       
       SELECT IFNULL(`display_name`,'') INTO @touser FROM `users` WHERE `user_id`=NEW.`to_user_id` LIMIT 1;
       
       INSERT INTO `ww_performance_appraisal_logs` 
          (appraisal_id, user_id, status_id, to_user_id, to_user)
       SELECT NEW.`appraisal_id`, NEW.`user_id`, NEW.`status_id`, NEW.`to_user_id`, @touser;
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_performance_appraisal_applicable_user` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `performance_appraisal_applicable_user_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `performance_appraisal_applicable_user_update_before` BEFORE UPDATE ON `ww_performance_appraisal_applicable_user` FOR EACH ROW BEGIN
        
        SET NEW.`modified_date` = NOW();
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_performance_appraisal_approver` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `performance_appraisal_approver_insert_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `performance_appraisal_approver_insert_before` BEFORE INSERT ON `ww_performance_appraisal_approver` FOR EACH ROW BEGIN
        
        /* This will insert-update display names accross all modules 
           last change: 2014-07-17 initial
                        2014-07-17 
        */ 
        SET NEW.`display_name` = (SELECT IFNULL(`display_name`,'*') FROM `users` WHERE `user_id`=NEW.`approver_id` LIMIT 1);
        SET NEW.`performance_status` = (SELECT IFNULL(`performance_status`,'*') FROM `ww_performance_status` WHERE `performance_status_id`=NEW.`performance_status_id` LIMIT 1);
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_performance_appraisal_approver` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `performance_appraisal_approver_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `performance_appraisal_approver_update_before` BEFORE UPDATE ON `ww_performance_appraisal_approver` FOR EACH ROW BEGIN
        
        /* This will insert-update display names accross all modules 
           last change: 2014-07-17 initial
                        2014-07-17 
        */ 
        SET NEW.`performance_status` = (SELECT IFNULL(`performance_status`,'*') FROM `ww_performance_status` WHERE `performance_status_id`=NEW.`performance_status_id` LIMIT 1);
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_performance_appraisal_contributor` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `performance_appraisal_contributor_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `performance_appraisal_contributor_update_before` BEFORE UPDATE ON `ww_performance_appraisal_contributor` FOR EACH ROW BEGIN
        
        SET NEW.`modified_date` = NOW();
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_performance_planning_applicable` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `performance_planning_logs_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `performance_planning_logs_insert` BEFORE INSERT ON `ww_performance_planning_applicable` FOR EACH ROW BEGIN
    
       SET @touser = '';
       
       SELECT IFNULL(`display_name`,'') INTO @touser FROM `users` WHERE `user_id`=NEW.`to_user_id` LIMIT 1;
       
       INSERT INTO `ww_performance_planning_logs` 
          (planning_id, user_id, status_id, to_user_id, to_user)
       SELECT NEW.`planning_id`, NEW.`user_id`, NEW.`status_id`, NEW.`to_user_id`, @touser;
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_performance_planning_applicable` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `performance_planning_logs_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `performance_planning_logs_update` AFTER UPDATE ON `ww_performance_planning_applicable` FOR EACH ROW BEGIN
    
       SET @touser = '';
       
       SELECT IFNULL(`display_name`,'') INTO @touser FROM `users` WHERE `user_id`=NEW.`to_user_id` LIMIT 1;
       
       INSERT INTO `ww_performance_planning_logs` 
          (planning_id, user_id, status_id, to_user_id, to_user)
       SELECT NEW.`planning_id`, NEW.`user_id`, NEW.`status_id`, NEW.`to_user_id`, @touser;
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_performance_planning_approver` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `performance_planning_approver_insert_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `performance_planning_approver_insert_before` BEFORE INSERT ON `ww_performance_planning_approver` FOR EACH ROW BEGIN
        
        /* This will insert-update display names accross all modules 
           last change: 2014-07-17 initial
                        2014-07-17 
        */ 
        SET NEW.`display_name` = (SELECT IFNULL(`display_name`,'*') FROM `users` WHERE `user_id`=NEW.`approver_id` LIMIT 1);
        SET NEW.`performance_status` = (SELECT IFNULL(`performance_status`,'*') FROM `ww_performance_status` WHERE `performance_status_id`=NEW.`performance_status_id` LIMIT 1);
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_performance_planning_approver` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `performance_planning_approver_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `performance_planning_approver_update_before` BEFORE UPDATE ON `ww_performance_planning_approver` FOR EACH ROW BEGIN
        
        /* This will insert-update display names accross all modules 
           last change: 2014-07-17 initial
                        2014-07-17 
        */ 
        SET NEW.`performance_status` = (SELECT IFNULL(`performance_status`,'*') FROM `ww_performance_status` WHERE `performance_status_id`=NEW.`performance_status_id` LIMIT 1);
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_recruitment_manpower_plan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `recruitment_manpower_plan_insert_after` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `recruitment_manpower_plan_insert_after` AFTER INSERT ON `ww_recruitment_manpower_plan` FOR EACH ROW BEGIN
	IF NEW.`manpower_plan_status_id`=2 THEN
          -- 
          CALL sp_recruitment_manpower_plan_populate_approvers(NEW.`plan_id`, NEW.`user_id`);  
          --                   
       END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_recruitment_manpower_plan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `recruitment_manpower_plan_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `recruitment_manpower_plan_update_before` BEFORE UPDATE ON `ww_recruitment_manpower_plan` FOR EACH ROW BEGIN
	IF NEW.`manpower_plan_status_id`=2 THEN
          -- 
          CALL sp_recruitment_manpower_plan_populate_approvers(NEW.`plan_id`, NEW.`user_id`);  
          --                   
       END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_recruitment_manpower_plan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `recruitment_manpower_plan_update_after` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `recruitment_manpower_plan_update_after` AFTER UPDATE ON `ww_recruitment_manpower_plan` FOR EACH ROW BEGIN
	IF NEW.`manpower_plan_status_id`=2 THEN
          -- 
          CALL sp_recruitment_manpower_plan_populate_approvers(NEW.`plan_id`, NEW.`user_id`);  
          --                   
       END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_recruitment_manpower_plan_position_new` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `users_position_insert_after` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `users_position_insert_after` AFTER INSERT ON `ww_recruitment_manpower_plan_position_new` FOR EACH ROW BEGIN
        
        /* This will insert Year on ww_payroll_year */
        set @sPosition = '';
        set @iID = '';
        SET @sPosition = NEW.position;
        SET @iID = NEW.id;
        SET @nCount = 0;
        set @sPositionCode = '';
        SELECT COUNT(*) INTO @nCount FROM ww_users_position WHERE `amp_position_id` = @iID;        
        IF @sPosition IS NOT NULL AND @nCount = 0 THEN
		INSERT INTO ww_users_position (position_code,`position`,amp_position_id,status_id) VALUES (@sPositionCode,@sPosition,@iID,1);
        END IF;
                
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_recruitment_request` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `recruitment_request_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `recruitment_request_insert` BEFORE INSERT ON `ww_recruitment_request` FOR EACH ROW BEGIN
	IF NEW.`status_id`=2 THEN
          -- 
          CALL sp_recruitment_request_populate_approvers(NEW.`request_id`, NEW.`user_id`);  
          --                   
       END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_recruitment_request` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `recruitment_request_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `recruitment_request_update` BEFORE UPDATE ON `ww_recruitment_request` FOR EACH ROW BEGIN
	IF NEW.`status_id`=2 THEN
          -- 
          CALL sp_recruitment_request_populate_approvers(NEW.`request_id`, NEW.`user_id`);  
          --                   
       END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_system_chat` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `system_chat_before_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `system_chat_before_insert` BEFORE INSERT ON `ww_system_chat` FOR EACH ROW BEGIN
	SET NEW.`from_name` = (SELECT CONCAT(ww_users_profile.`lastname`,', ',ww_users_profile.`firstname`) FROM `ww_users_profile` WHERE `user_id`=NEW.from LIMIT 1);
	SET NEW.`to_name` = (SELECT CONCAT(ww_users_profile.`lastname`,', ',ww_users_profile.`firstname`) FROM `ww_users_profile` WHERE `user_id`=NEW.to LIMIT 1);        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_system_feeds` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `system_feeds_insert_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `system_feeds_insert_before` BEFORE INSERT ON `ww_system_feeds` FOR EACH ROW BEGIN
        
        /* This will update header feeds table
           last change: 2015-08-10 initial, just update modification date
                        2015-08-10 
        */ 
        
        SET NEW.`display_name` = (SELECT IFNULL(`display_name`,'*') FROM `users_profile` WHERE `user_id`=NEW.`user_id` LIMIT 1);
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_system_feeds` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `system_feeds_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `system_feeds_update_before` BEFORE UPDATE ON `ww_system_feeds` FOR EACH ROW BEGIN
        
        /* This will update header feeds table
           last change: 2015-08-10 initial, just update modification date
                        2015-08-10 
        */ 
        
        SET NEW.`display_name` = (SELECT IFNULL(`display_name`,'*') FROM `users_profile` WHERE `user_id`=NEW.`user_id` LIMIT 1);
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_system_feeds_comments` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `system_feeds_comments_insert_after` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `system_feeds_comments_insert_after` AFTER INSERT ON `ww_system_feeds_comments` FOR EACH ROW BEGIN
        
        /* This will update header feeds table
           last change: 2014-08-15 initial, just update modification date
                        2014-08-15 
        */ 
        UPDATE `ww_system_feeds` SET `modifiedon` = NOW()
        WHERE `id` = NEW.`id` LIMIT 1;
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_system_feeds_comments` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `system_feeds_comments_update_after` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `system_feeds_comments_update_after` AFTER UPDATE ON `ww_system_feeds_comments` FOR EACH ROW BEGIN
        
        /* This will update header feeds table
           last change: 2014-08-15 initial, just update modification date
                        2014-08-15 
        */ 
        UPDATE `ww_system_feeds` SET `modifiedon` = NOW()
        WHERE `id` = NEW.`id` LIMIT 1;
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_system_password_request` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `system_password_request_insert_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `system_password_request_insert_before` BEFORE INSERT ON `ww_system_password_request` FOR EACH ROW BEGIN
    
       /* This will insert-update password request and email queue
          last change: 2014-04-25: initial
                       2014-04-25: 
       */ 
          
       SET NEW.`expiration` = DATE_ADD(NOW(), INTERVAL 24 HOUR);
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_system_password_request` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `system_password_request_insert_after` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `system_password_request_insert_after` AFTER INSERT ON `ww_system_password_request` FOR EACH ROW BEGIN
    
       /* This will insert-update password request and email queue
          last change: 2014-04-25: initial
                       2015-09-13: system logo 
       */ 
                 
       SET @email_to = '';
       SET @email_subject = '';
       SET @email_body = '';
       
       -- get template format
       SELECT `subject`,`body` INTO @email_subject, @email_body
       FROM `ww_system_template`
       WHERE `template_id`=1 LIMIT 1;
       
       -- get profile nickname
       SELECT IFNULL(`nickname`,`firstname`) INTO @email_to
       FROM `users_profile`
       WHERE `user_id`=NEW.`user_id` LIMIT 1;
       
       -- {{link}}
       SET @url = get_config('System','URL');
	   IF RIGHT(TRIM(@url),1) <> '/' THEN
	      SET @url = CONCAT(TRIM(@url),'/');
	   END IF;
	   
       -- {{header/email logo}}
       SET @logo = get_config('System','print_logo'); 
	   IF TRIM(@logo) <> '' THEN
	      SET @logo = CONCAT(@url,@logo);
	   ELSE
	      SET @logo = CONCAT(@url,get_config('System','logo'));
	   END IF;
	   
       -- assign variables
       SET @email_body = REPLACE(@email_body, '{{system_url}}', @url);
       SET @email_body = REPLACE(@email_body, '{{system_logo}}', @logo);
       SET @email_body = REPLACE(@email_body, '{{nickname}}', @email_to);
       SET @email_body = REPLACE(@email_body, '{{expiration}}', NEW.`expiration`);
       SET @email_body = REPLACE(@email_body, '{{link}}', CONCAT(NEW.`link`,'&id=',NEW.`id`));
       
       -- insert final format
       INSERT INTO `ww_system_email_queue` (`to`,`subject`,`body`)
       SELECT NEW.`email`, @email_subject, @email_body;
       
       -- remove link for security
       -- UPDATE `ww_system_password_request` SET `link`='forwarded' WHERE `id`=NEW.`id` LIMIT 1;
       
       -- done
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_system_password_request` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `system_password_request_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `system_password_request_update_before` BEFORE UPDATE ON `ww_system_password_request` FOR EACH ROW BEGIN
    
       /* This will insert-update password request and user hash
          last change: 2014-04-25: initial
                       2015-09-13: system logo 
       */ 
       
       IF NEW.`confirmed` = 1 THEN
          
          -- INSERT INTO `ww_system_email_queue`
          SET @email_to = '';
          SET @email_subject = '';
          SET @email_body = '';
       
          -- get template format
          SELECT `subject`,`body` INTO @email_subject, @email_body
          FROM `ww_system_template`
          WHERE `template_id`=2 LIMIT 1;
       
          -- get profile nickname
          SELECT IFNULL(`nickname`,`firstname`) INTO @email_to
          FROM `users_profile`
          WHERE `user_id`=NEW.`user_id` LIMIT 1;
       
          -- {{link}}
          SET @url = get_config('System','URL');
	      IF RIGHT(TRIM(@url),1) <> '/' THEN
	         SET @url = CONCAT(TRIM(@url),'/');
	      END IF;
	      
          -- {{header/email logo}}
          SET @logo = get_config('System','print_logo'); 
	      IF TRIM(@logo) <> '' THEN
	         SET @logo = CONCAT(@url,@logo);
	      ELSE
	         SET @logo = CONCAT(@url,get_config('System','logo'));
	      END IF;
	   
          -- assign variables
          SET @email_body = REPLACE(@email_body, '{{system_url}}', @url);
          SET @email_body = REPLACE(@email_body, '{{system_logo}}', @logo);
          SET @email_body = REPLACE(@email_body, '{{nickname}}', @email_to);
          SET @email_body = REPLACE(@email_body, '{{randomize}}', NEW.`randomized`);
          SET @email_body = REPLACE(@email_body, '{{link}}', @url);
          -- insert final format
          INSERT INTO `ww_system_email_queue` (`to`,`subject`,`body`)
          SELECT NEW.`email`, @email_subject, @email_body;
       
       
       
          -- initialize values for security  
          SET NEW.`hash` = '';
          SET NEW.`link` = 'forwarded';        
          SET NEW.`confirmed` = 0;
          SET NEW.`randomized` = '';
          
       END IF;
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_system_support` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `system_support_insert_after` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `system_support_insert_after` AFTER INSERT ON `ww_system_support` FOR EACH ROW BEGIN
    
       /* This will insert-update time_record
          last change: 2016-02-10 initial
                       2014-02-10 
       */
          
       CALL `sp_system_support_email`(NEW.msg_id);
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_form_balance` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_form_balance_before_ins` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_form_balance_before_ins` BEFORE INSERT ON `ww_time_form_balance` FOR EACH ROW BEGIN
       
       
       -- [1] Compute available credit using accrual table
       SET NEW.`current` = ( SELECT IFNULL(SUM(tfba.`accrual`),0)
                             FROM `ww_time_form_balance_accrual` tfba
                             WHERE tfba.`leave_balance_id` = NEW.`id` AND tfba.`user_id` = NEW.`user_id` AND tfba.`deleted` = 0);
       
       -- SET NEW.`used` = (SELECT IFNULL(SUM(`day`),0) FROM `time_forms` WHERE `form_status_id`=6 AND `form_id`=NEW.`form_id` AND YEAR(`date_from`)=NEW.`year` AND `user_id`=NEW.`user_id`);       
       
       
       -- [2] Compute for the usage
       /*
       SET NEW.`used` = ( SELECT IFNULL(SUM(tfd.`day`),0)
                          FROM `time_forms` AS tf
                          JOIN ww_time_forms_date AS tfd ON tfd.forms_id = tf.forms_id
                          WHERE tf.`form_status_id` = 6 AND
                                tf.`form_id` = NEW.`form_id` AND
                                tf.`user_id`=NEW.`user_id` AND
                                tfd.leave_balance_id = NEW.id ) + 
                        ( SELECT IFNULL(SUM(tfd.`day`),0)
                          FROM `ww_time_forms` AS tf
                          LEFT JOIN ww_time_forms_date AS tfd ON tfd.forms_id = tf.forms_id
                          JOIN ww_time_forms_blanket tfb ON tfb.forms_id = tfd.`forms_id`
                          WHERE tf.`form_status_id` = 6 AND
                                tf.`form_id` = NEW.`form_id` AND
                                tfd.leave_balance_id = NEW.`id` );
       */
       SET NEW.`used` = ( SELECT IFNULL(SUM(tf.`day`),0)
                          FROM `time_forms` AS tf
                          WHERE tf.`form_status_id` = 6 AND
                                tf.`form_id` = NEW.`form_id` AND
                                tf.`user_id`=NEW.`user_id` AND 
                                YEAR(tf.`date_from`) = NEW.`year` ) +
                        ( SELECT IFNULL(SUM(tfd.`day`),0)
                          FROM `ww_time_forms` AS tf
                          LEFT JOIN ww_time_forms_date AS tfd ON tfd.forms_id = tf.forms_id
                          JOIN ww_time_forms_blanket tfb ON tfb.forms_id = tfd.`forms_id`
                          WHERE tf.`form_status_id` = 6 AND
                                tf.`form_id` = NEW.`form_id` AND
                                tfd.leave_balance_id = NEW.`id` );
       
       
        -- [3] Compute for the remaining credits
        SET NEW.`balance` = IF(IFNULL(NEW.`previous`,0) + 
                            IFNULL(NEW.`current`,0) - 
                            IFNULL(NEW.`used`,0) - 
                            IFNULL(NEW.`used_insert`,0) - 
                            IFNULL(NEW.`forfeited`,0) - 
                            IFNULL(NEW.`paid_unit`,0) > 0,IFNULL(NEW.`previous`,0) + 
                            IFNULL(NEW.`current`,0) - 
                            IFNULL(NEW.`used`,0) - 
                            IFNULL(NEW.`used_insert`,0) - 
                            IFNULL(NEW.`forfeited`,0) - 
                            IFNULL(NEW.`paid_unit`,0),0);
        
        
        -- [4] Just checking for the codes
        IF IFNULL(NEW.`form_code`,'') = '' THEN
           SET NEW.`form_code` = (SELECT IFNULL(`form_code`,'*') FROM `ww_time_form` WHERE `form_id`=NEW.`form_id` LIMIT 1);
        END IF;
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_form_balance` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_form_balance_before_upd` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_form_balance_before_upd` BEFORE UPDATE ON `ww_time_form_balance` FOR EACH ROW BEGIN
    
    
       -- [1] Compute available credit using accrual table
       SET NEW.`current` = ( SELECT IFNULL(SUM(tfba.`accrual`),0)
                             FROM `ww_time_form_balance_accrual` tfba
                             WHERE tfba.`leave_balance_id` = NEW.`id` AND tfba.`user_id` = NEW.`user_id` AND tfba.`deleted` = 0);
       
       -- SET NEW.`used` = (SELECT IFNULL(SUM(`day`),0) FROM `time_forms` 
       --                   WHERE `form_status_id`=6 AND `form_id`=NEW.`form_id` AND YEAR(`date_from`)=NEW.`year` AND `user_id`=NEW.`user_id`);       
       
       
       -- [2] Compute for the usage
       SET NEW.`used` = ( SELECT IFNULL(SUM(tf.`day`),0)
                          FROM `time_forms` AS tf
                          WHERE tf.`form_status_id` = 6 AND
                                tf.`form_id` = NEW.`form_id` AND
                                tf.`user_id`=NEW.`user_id` AND 
                                YEAR(tf.`date_from`) = NEW.`year` ) +
                        ( SELECT IFNULL(SUM(tfd.`day`),0)
                          FROM `ww_time_forms` AS tf
                          left JOIN ww_time_forms_date AS tfd ON tfd.forms_id = tf.forms_id
                          JOIN ww_time_forms_blanket tfb ON tfb.forms_id = tfd.`forms_id`
                          WHERE tf.`form_status_id` = 6 AND
                                tf.`form_id` = NEW.`form_id` AND
                                tfd.leave_balance_id = NEW.`id` );
       
              
       /*
       IF NEW.`form_code` = 'ADDL' THEN
          SET NEW.`used` = IFNULL(
              (
              SELECT IF( SUM(used)=0,NULL,SUM(used) ) 
              FROM ww_time_forms_ot_leave_used otleave 
              LEFT JOIN ww_time_forms tfs ON otleave.used_by_form = tfs.forms_id 
              WHERE `user_id`=NEW.`user_id` AND NEW.`form_code` = 'ADDL' AND tfs.form_status_id = 6 OR otleave.used_by_form = -1
              ) + NEW.used_insert  
              , 0);
          SET NEW.`current` = IFNULL(
	      (
              SELECT IF( SUM(otleave.credit)=0,NULL,SUM(otleave.credit) ) 
              FROM ww_time_forms_ot_leave otleave 
              LEFT JOIN ww_time_forms tfs ON otleave.forms_id = tfs.forms_id 
              WHERE `user_id`=NEW.`user_id` AND NEW.`form_code` = 'ADDL' AND tfs.form_status_id = 6
              ), 0);
        END IF;
        */
        
        
        -- [3] Compute for the remaining credits
        SET NEW.`balance` = IF(IFNULL(NEW.`previous`,0) + 
                            IFNULL(NEW.`current`,0) - 
                            IFNULL(NEW.`used`,0) - 
                            IFNULL(NEW.`used_insert`,0) - 
                            IFNULL(NEW.`forfeited`,0) - 
                            IFNULL(NEW.`paid_unit`,0) > 0,IFNULL(NEW.`previous`,0) + 
                            IFNULL(NEW.`current`,0) - 
                            IFNULL(NEW.`used`,0) - 
                            IFNULL(NEW.`used_insert`,0) - 
                            IFNULL(NEW.`forfeited`,0) - 
                            IFNULL(NEW.`paid_unit`,0),0);
        
        
        -- [4] Just checking for the codes
        IF IFNULL(NEW.`form_code`,'') = '' THEN
           SET NEW.`form_code` = (SELECT IFNULL(`form_code`,'*') FROM `ww_time_form` WHERE `form_id`=NEW.`form_id` LIMIT 1);
        END IF;
        
        
        -- [5] Time posting
        SET NEW.`modified_on` = NOW();
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_forms` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_forms_insert_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_forms_insert_before` BEFORE INSERT ON `ww_time_forms` FOR EACH ROW BEGIN
    
       /* This will update necessary master table
          last change: 2014-04-25: initial
                       2014-04-26: populate approver/s
       */
       set NEW.form_code = (select form_code from ww_time_form where form_id = NEW.form_id);
       IF NEW.`form_status_id`=2 THEN
          -- 
          CALL sp_time_forms_populate_approvers(NEW.`forms_id`, NEW.`user_id`);   
          -- 
       END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_forms` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_forms_approval_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_forms_approval_insert` AFTER INSERT ON `ww_time_forms` FOR EACH ROW BEGIN
    
       /* This will insert-update time_forms & time_record_summary
          last change: 2014-02-22: initial
                       2014-02-22: prepare data after approval of application
                       2014-02-22: update leave balance
                       2014-02-22: update record summary
       */
       -- just to push the table's form_balance trigger to update balance field
       if NEW.form_status_id = 6 and NEW.display_name = 'Blanket' then
	update ww_time_form_balance tfb, ww_time_forms tf, ww_time_forms_date tfd
	set tfb.modified_on = now()
	where 	tfb.`year` = year(NEW.date_from) and 
		tfd.forms_id = tf.forms_id and 
		tfd.leave_balance_id = tfb.id and
		tfb.form_id = NEW.form_id;
       end if;
       
  --     UPDATE `ww_time_form_balance` SET modified_on = NOw()
   --    WHERE `year` = YEAR(NEW.`date_from`) AND `user_id`=NEW.`user_id`;
    
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_forms` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_forms_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_forms_update_before` BEFORE UPDATE ON `ww_time_forms` FOR EACH ROW BEGIN
    
       /* This will insert-update approver/s on application
          last change: 2014-04-26: initial
                       2014-04-26: populate approver/s if set to for approval
       */
       -- 
       SET NEW.`modified_on` = NOW();
       set NEw.form_code = (select form_code from ww_time_form where form_id = NEW.form_id);
       -- 
    
       IF NEW.`form_status_id`=2 THEN
          -- 
          CALL sp_time_forms_populate_approvers(NEW.`forms_id`, NEW.`user_id`);  
          --                   
       END IF;
       IF NEW.`form_status_id`=8 THEN
          -- 
          UPDATE `ww_time_forms_approver` SET `form_status_id`=8,`form_status`='Cancelled' WHERE `forms_id`=NEW.`forms_id`;  
          --                   
       END IF;          
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_forms` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_forms_approval` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_forms_approval` AFTER UPDATE ON `ww_time_forms` FOR EACH ROW BEGIN
    
       /* This will insert-update time_forms & time_record_summary
          last change: 2014-02-22: initial
                       2014-02-22: prepare data after approval of application
                       2014-02-22: update leave balance
                       2014-02-22: update record summary
                       2014-07-17: update aux shift and aux in/out
       */
       SET @approved = '';
       SELECT `form_status_id` INTO @approved
       FROM `ww_time_form_status` 
       WHERE `form_status`='Approved' AND `deleted`=0 LIMIT 1;
       
      INSERT INTO `logtable` (`log`) VALUES (CONCAT(NEW.`forms_id`,' ',NEW.`user_id`));
       
       -- [1] Update time record only on approved application
       IF NEW.form_status_id = @approved THEN
          CALL sp_time_forms_aux_shift(NEW.`form_code`, NEW.`user_id`, NEW.`forms_id`);
       END IF;
       
       
       -- [2] Update Leave Balance
       -- just to push the table's form_balance trigger to update balance field
       UPDATE `ww_time_form_balance` tfb, `ww_time_forms_date` tfd 
       SET tfb.modified_on = NOW()
       WHERE tfb.`id` = tfd.leave_balance_id AND tfd.forms_id = NEW.`forms_id` AND tfb.form_code = NEW.form_code AND `user_id`=NEW.`user_id`;
       
       -- YEAR(NEW.`date_from`) AND `user_id`=NEW.`user_id`;
       
       
       -- [3] Insert to Email Queue
       -- IF NEW.form_status_id = @approved THEN
       --    CALL sp_time_forms_email(NEW.`forms_id`);
       -- END IF;
       
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_forms_approver` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_forms_approver_insert_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_forms_approver_insert_before` BEFORE INSERT ON `ww_time_forms_approver` FOR EACH ROW BEGIN
        
        /* This will insert-update display names accross all modules 
           last change: 2014-07-17 initial
                        2014-07-17 
        */ 
        SET NEW.`display_name` = (SELECT IFNULL(`display_name`,'*') FROM `users` WHERE `user_id`=NEW.`user_id` LIMIT 1);
        SET NEW.`form_status` = (SELECT IFNULL(`form_status`,'*') FROM `ww_time_form_status` WHERE `form_status_id`=NEW.`form_status_id` LIMIT 1);
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_forms_approver` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_forms_approver_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_forms_approver_update_before` BEFORE UPDATE ON `ww_time_forms_approver` FOR EACH ROW BEGIN
        
        /* This will insert-update display names accross all modules 
           last change: 2014-07-17 initial
                        2015-05-05 change display name  
        */ 
		SET NEW.`display_name` = (SELECT IFNULL(`display_name`,'*') FROM `users` WHERE `user_id`=NEW.`user_id` LIMIT 1);
        SET NEW.`form_status` = (SELECT IFNULL(`form_status`,'*') FROM `ww_time_form_status` WHERE `form_status_id`=NEW.`form_status_id` LIMIT 1);
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_forms_approver` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_forms_approver_update_after` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_forms_approver_update_after` AFTER UPDATE ON `ww_time_forms_approver` FOR EACH ROW BEGIN
	   SET @appCount    = 0;
	   SET @appApproved = 0;
	   SET @appDeclined = 0;
	   
	   SELECT COUNT(*), SUM(IF(`form_status_id`=6,1,0)), SUM(IF(`form_status_id`=7,1,0)) 
	   INTO @appCount, @appApproved, @appDeclined
	   FROM `ww_time_forms_approver`
	   WHERE `forms_id`=NEW.`forms_id`;
	   
	   IF NEW.`form_status_id` != 8 THEN
		   UPDATE `time_forms`
		   SET
		      `form_status_id` = IF(@appCount=@appApproved, 6, IF(@appCount=@appDeclined, 7, IF(@appDeclined > 0, 7, IF(@appApproved > 0, 3, `form_status_id`)))),
		      `date_approved` = IF(@appCount=@appApproved, NOW(), `date_approved`),
		      `date_declined` = IF(@appDeclined > 0, NOW(), `date_declined`)
		   WHERE 
		      `forms_id` = NEW.`forms_id`;
	   END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_forms_blanket` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_forms_blanket_insert_after` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_forms_blanket_insert_after` AFTER INSERT ON `ww_time_forms_blanket` FOR EACH ROW BEGIN
	declare formcode varchar(10);
	set formcode = (select form_code from ww_time_forms where forms_id = NEW.forms_id);
	
	if NEW.forms_id <> 0 then
		call sp_time_forms_aux_shift(formcode, NEW.user_id, NEW.forms_id);
	end if;
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_period` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_period_insert_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_period_insert_before` BEFORE INSERT ON `ww_time_period` FOR EACH ROW BEGIN
    
       SET NEW.`period_year` = YEAR(NEW.`payroll_date`);
       SET NEW.`period_month` = MONTH(NEW.`payroll_date`);
       
       /*
       INSERT INTO `ww_time_period_log`
       (`period_id`, `partner_type_id`, `partner_type`, `proc_log`)
       SELECT a.`period_id`, a.`status_id`, a.`employment_status`, a.`proc_log`
       FROM
       (SELECT NEW.`period_id` `period_id`, p.status_id, pes.`employment_status`, COUNT(*) proc_log
       FROM `partners` p, `users_profile` up, `ww_partners_employment_status` pes
       WHERE 
          p.`user_id`=up.`user_id` AND 
          p.`status_id`=pes.`employment_status_id` AND
          up.`company_id`=NEW.`company_id`
       GROUP BY 1,2) a
       ON DUPLICATE KEY UPDATE `partner_type`=a.`employment_status`, `proc_log`=a.`proc_log`;
       */
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_period` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_period_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_period_update_before` BEFORE UPDATE ON `ww_time_period` FOR EACH ROW BEGIN
    
       SET NEW.`period_year` = YEAR(NEW.`payroll_date`);
       SET NEW.`period_month` = MONTH(NEW.`payroll_date`);
    
       IF IFNULL(NEW.`pop_dates`,0) = 1 THEN
          -- IF NEW.`cutoff` <= CURDATE() THEN
             CALL sp_time_period_populate(NEW.`date_from`,NEW.`date_to`,NEW.`company_id`); 
          -- END IF;
       END IF;
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_record` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_record_insert_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_record_insert_before` BEFORE INSERT ON `ww_time_record` FOR EACH ROW BEGIN
    
       /* This will insert-update time_record textual
          last change: 2014-02-20 initial
                       2014-02-21 shift name and biometrics
       */
       
       DECLARE shiftname VARCHAR(32) DEFAULT '';
       DECLARE shiftid INT(11) DEFAULT 0;
       DECLARE bio VARCHAR(8) DEFAULT '';
       
       -- [1] Get references
       SELECT `biometric`,`shift_id` INTO bio,shiftid 
       FROM `ww_partners` WHERE `user_id` = NEW.user_id LIMIT 1;
       
       -- [2] Assign values
       IF IFNULL(NEW.shift_id,0) = 0 THEN  -- override assignment if not passed correctly
          SET NEW.shift_id = shiftid;
       END IF;
       
       if NEW.aux_shift_id <> 0 then
	  set NEW.aux_shift = (select shift from ww_time_shift where shift_id = NEW.aux_shift_id);
       end if;
       
       SELECT `shift` INTO shiftname 
       FROM `ww_time_shift` WHERE `shift_id` = NEW.`shift_id` LIMIT 1;
       
       -- [3] Assign values
       SET NEW.shift = shiftname;
       SET NEW.biometric = bio;
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_record` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_record_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_record_update_before` BEFORE UPDATE ON `ww_time_record` FOR EACH ROW BEGIN
    
       /* This will insert-update time_record textual
          last change: 2014-02-20 initial
                       2014-02-20 shift name and biometrics
                       2014-07-19 aux shift name
       */       
        
       SET NEW.shift = (SELECT IFNULL(`shift`,'') FROM `ww_time_shift` WHERE `shift_id` = NEW.shift_id LIMIT 1);
       SET NEW.biometric = (SELECT IFNULL(`biometric`,'') FROM `ww_partners` WHERE `user_id` = NEW.user_id LIMIT 1);
       
       IF NEW.aux_shift_id <> 0 THEN
          SET NEW.aux_shift = (SELECT IFNULL(`shift`,'') FROM `ww_time_shift` WHERE `shift_id` = NEW.aux_shift_id LIMIT 1);
       END IF;
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_record_raw` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_record_raw_insert_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_record_raw_insert_before` BEFORE INSERT ON `ww_time_record_raw` FOR EACH ROW BEGIN
    
       /* This will insert-update time_record_raw
          last change: 2014-02-21 initial
                       2014-02-22 prepare date if blank, to attend uploading even if with checktime only 
       */
       DECLARE userid INT(11) DEFAULT 0;
       SELECT `user_id` INTO userid FROM `ww_partners` WHERE `biometric`=NEW.`biometric` AND `deleted`=0 LIMIT 1;
       
       IF IFNULL(userid,0) <> 0 THEN
          SET NEW.`user_id` = userid;
          -- SET NEW.`processed` = 1;
       END IF;
       
       IF IFNULL(NEW.`date`,'0000-00-00') = '0000-00-00' THEN
          SET NEW.`date` = DATE(NEW.`checktime`);
       END IF;
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_record_raw` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_record_raw_insert_after` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_record_raw_insert_after` AFTER INSERT ON `ww_time_record_raw` FOR EACH ROW BEGIN
    
       /* This will insert-update time_record
          last change: 2014-02-21 initial
                       2014-05-07 move codes to sp_time_record_raw_process
       */
          
       IF IFNULL(NEW.`processed`,0) = 0 THEN
          IF IFNULL(NEW.`user_id`,0) <> 0 THEN
             SET @news = 1;
             CALL sp_time_record_raw_process(NEW.`user_id`, NEW.`date`, NEW.`checktime`);
          END IF;
       END IF;
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_record_raw` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_record_raw_update_after` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_record_raw_update_after` AFTER UPDATE ON `ww_time_record_raw` FOR EACH ROW BEGIN
    
       /* This will insert-update time_record
          last change: 2015-09-16 run sp_time_record_raw_process
       */
          
       IF IFNULL(NEW.`processed`,0) = 0 THEN
          IF IFNULL(NEW.`user_id`,0) <> 0 THEN
             SET @news = 1;
             CALL sp_time_record_raw_process(NEW.`user_id`, NEW.`date`, NEW.`checktime`);
          END IF;
       END IF;
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_record_summary` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_record_summary_insert_after` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_record_summary_insert_after` AFTER INSERT ON `ww_time_record_summary` FOR EACH ROW BEGIN
    
	UPDATE `ww_time_record` SET `processed`=1 WHERE `user_id`=NEW.`user_id` AND `date`=NEW.`date`;
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_shift` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_shift_class_insert_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_shift_class_insert_before` BEFORE INSERT ON `ww_time_shift` FOR EACH ROW BEGIN
        
	   
          CALL sp_time_shift_class_company(NEW.`shift_id`);
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_shift` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_shift_class_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_shift_class_update_before` BEFORE UPDATE ON `ww_time_shift` FOR EACH ROW BEGIN
        
        /* This will update-update display names accross all modules 
           last change: 2014-07-18 initial
                        2014-07-18 
        */ 
          CALL sp_time_shift_class_company(NEW.`shift_id`);
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_shift_apply_to_id` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_shift_apply_to_id_insert_after` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_shift_apply_to_id_insert_after` AFTER INSERT ON `ww_time_shift_apply_to_id` FOR EACH ROW BEGIN
    
       /* This will insert-update time_record
          last change: 2016-04-21 initial
                       2014-04-21 automatic saving to time-shift-class
       */
      
         IF (NEW.shift_id != '') THEN
           CALL sp_time_shift_process(NEW.`shift_id`);
         END IF;
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_shift_class_company_department` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_shift_class_company_department_upd_aft` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_shift_class_company_department_upd_aft` BEFORE UPDATE ON `ww_time_shift_class_company_department` FOR EACH ROW BEGIN
	
	SET NEW.class_code = (SELECT class_code FROM ww_time_shift_class WHERE class_id = NEW.class_id);
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_shift_weekly_calendar` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_shift_weekly_calendar_insert_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_shift_weekly_calendar_insert_before` BEFORE INSERT ON `ww_time_shift_weekly_calendar` FOR EACH ROW BEGIN
    
       SET NEW.`shift` = (SELECT IFNULL(`shift`,'*') FROM `ww_time_shift` WHERE `shift_id`=NEW.shift_id LIMIT 1);
       SET NEW.`week_name` = IF(NEW.`week_no`=1,'Sunday',
                             IF(NEW.`week_no`=2,'Monday',
                             IF(NEW.`week_no`=3,'Tuesday',
                             IF(NEW.`week_no`=4,'Wednesday',
                             IF(NEW.`week_no`=5,'Thursday',
                             IF(NEW.`week_no`=6,'Friday',
                             IF(NEW.`week_no`=7,'Saturday','')))))));
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_time_shift_weekly_calendar` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `time_shift_weekly_calendar_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `time_shift_weekly_calendar_update_before` BEFORE UPDATE ON `ww_time_shift_weekly_calendar` FOR EACH ROW BEGIN
    
       SET NEW.`shift` = (SELECT IFNULL(`shift`,'*') FROM `ww_time_shift` WHERE `shift_id`=NEW.shift_id LIMIT 1);
       SET NEW.`week_name` = IF(NEW.`week_no`=1,'Sunday',
                             IF(NEW.`week_no`=2,'Monday',
                             IF(NEW.`week_no`=3,'Tuesday',
                             IF(NEW.`week_no`=4,'Wednesday',
                             IF(NEW.`week_no`=5,'Thursday',
                             IF(NEW.`week_no`=6,'Friday',
                             IF(NEW.`week_no`=7,'Saturday','')))))));
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_users_company` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `users_company_insert_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `users_company_insert_before` BEFORE INSERT ON `ww_users_company` FOR EACH ROW BEGIN
        
        SET NEW.`city` = (SELECT IFNULL(city,'*') FROM `ww_cities` WHERE city_id=NEW.`city_id` LIMIT 1);
        SET NEW.`country` = (SELECT IFNULL(`short_name`,'*') FROM `ww_countries` WHERE `country_id`=NEW.country_id LIMIT 1);
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_users_company` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `users_company_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `users_company_update_before` BEFORE UPDATE ON `ww_users_company` FOR EACH ROW BEGIN
        
        SET NEW.`city` = (SELECT IFNULL(city,'*') FROM `ww_cities` WHERE city_id=NEW.`city_id` LIMIT 1);
        SET NEW.`country` = (SELECT IFNULL(`short_name`,'*') FROM `ww_countries` WHERE `country_id`=NEW.country_id LIMIT 1);
        
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_users_department` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `users_department_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `users_department_insert` BEFORE INSERT ON `ww_users_department` FOR EACH ROW BEGIN
    
       SET @immediate = '';
       SET @immediate_position_id = '';
       SET @immediate_position = '';
       SET @division = '';
       
       SELECT IFNULL(`display_name`,'') INTO @immediate FROM `users` WHERE `user_id`=NEW.`immediate_id` LIMIT 1;
       SELECT IFNULL(`position_id`,'') INTO @immediate_position_id FROM `users_profile` WHERE `user_id`=NEW.`immediate_id` LIMIT 1;
       SELECT IFNULL(`position`,'') INTO @immediate_position FROM `users_position` WHERE `position_id`=@immediate_position_id LIMIT 1;
       SELECT IFNULL(`division`,'') INTO @division FROM `ww_users_division` WHERE `division_id`=NEW.`division_id` LIMIT 1;
       
       
       SET NEW.`immediate` = @immediate;
       SET NEW.`immediate_position_id` = @immediate_position_id;
       SET NEW.`immediate_position` = @immediate_position;
       SET NEW.`division` = @division;
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_users_department` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `users_department_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `users_department_update` BEFORE UPDATE ON `ww_users_department` FOR EACH ROW BEGIN
    
       SET @immediate = '';
       SET @immediate_position_id = '';
       SET @immediate_position = '';
       SET @division = '';
       
       SELECT IFNULL(`display_name`,'') INTO @immediate FROM `users` WHERE `user_id`=NEW.`immediate_id` LIMIT 1;
       SELECT IFNULL(`position_id`,'') INTO @immediate_position_id FROM `users_profile` WHERE `user_id`=NEW.`immediate_id` LIMIT 1;
       SELECT IFNULL(`position`,'') INTO @immediate_position FROM `users_position` WHERE `position_id`=@immediate_position_id LIMIT 1;
       SELECT IFNULL(`division`,'') INTO @division FROM `ww_users_division` WHERE `division_id`=NEW.`division_id` LIMIT 1;
       
       
       SET NEW.`immediate` = @immediate;
       SET NEW.`immediate_position_id` = @immediate_position_id;
       SET NEW.`immediate_position` = @immediate_position;
       SET NEW.`division` = @division;
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_users_division` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `users_division_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `users_division_insert` BEFORE INSERT ON `ww_users_division` FOR EACH ROW BEGIN
    
       SET @immediate = '';
       SET @immediate_position_id = '';
       SET @immediate_position = '';
       SET @division = '';
       
       SELECT IFNULL(`display_name`,'') INTO @immediate FROM `users` WHERE `user_id`=NEW.`immediate_id` LIMIT 1;
       SELECT IFNULL(`position_id`,'') INTO @immediate_position_id FROM `users_profile` WHERE `user_id`=NEW.`immediate_id` LIMIT 1;
       SELECT IFNULL(`position`,'') INTO @immediate_position FROM `users_position` WHERE `position_id`=@immediate_position_id LIMIT 1;
       
       
       SET NEW.`immediate` = @immediate;
       SET NEW.`position_id` = @immediate_position_id;
       SET NEW.`position` = @immediate_position;
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_users_division` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `users_division_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `users_division_update` BEFORE UPDATE ON `ww_users_division` FOR EACH ROW BEGIN
    
       SET @immediate = '';
       SET @immediate_position_id = '';
       SET @immediate_position = '';
       SET @division = '';
       
       SELECT IFNULL(`display_name`,'') INTO @immediate FROM `users` WHERE `user_id`=NEW.`immediate_id` LIMIT 1;
       SELECT IFNULL(`position_id`,'') INTO @immediate_position_id FROM `users_profile` WHERE `user_id`=NEW.`immediate_id` LIMIT 1;
       SELECT IFNULL(`position`,'') INTO @immediate_position FROM `users_position` WHERE `position_id`=@immediate_position_id LIMIT 1;
       
       
       SET NEW.`immediate` = @immediate;
       SET NEW.`position_id` = @immediate_position_id;
       SET NEW.`position` = @immediate_position;
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_users_position` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `users_position_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `users_position_insert` BEFORE INSERT ON `ww_users_position` FOR EACH ROW BEGIN
    
       SET @immediate = '';
       SET @immediate_position_id = '';
       SET @immediate_position = '';
       
       SELECT IFNULL(`display_name`,'') INTO @immediate FROM `users` WHERE `user_id`=NEW.`immediate_id` LIMIT 1;
       SELECT IFNULL(`position_id`,'') INTO @immediate_position_id FROM `users_profile` WHERE `user_id`=NEW.`immediate_id` LIMIT 1;
       SELECT IFNULL(`position`,'') INTO @immediate_position FROM `users_position` WHERE `position_id`=@immediate_position_id LIMIT 1;
       
       
       SET NEW.`immediate` = @immediate;
       SET NEW.`immediate_position_id` = @immediate_position_id;
       SET NEW.`immediate_position` = @immediate_position;
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_users_position` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `users_position_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `users_position_update` BEFORE UPDATE ON `ww_users_position` FOR EACH ROW BEGIN
    
       SET @immediate = '';
       SET @immediate_position_id = '';
       SET @immediate_position = '';
       
       SELECT IFNULL(`display_name`,'') INTO @immediate FROM `users` WHERE `user_id`=NEW.`immediate_id` LIMIT 1;
       SELECT IFNULL(`position_id`,'') INTO @immediate_position_id FROM `users_profile` WHERE `user_id`=NEW.`immediate_id` LIMIT 1;
       SELECT IFNULL(`position`,'') INTO @immediate_position FROM `users_position` WHERE `position_id`=@immediate_position_id LIMIT 1;
       
       
       SET NEW.`immediate` = @immediate;
       SET NEW.`immediate_position_id` = @immediate_position_id;
       SET NEW.`immediate_position` = @immediate_position;
       
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_users_profile` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `users_profile_insert_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `users_profile_insert_before` BEFORE INSERT ON `ww_users_profile` FOR EACH ROW BEGIN
        
         
        SET NEW.`company` = (SELECT IFNULL(`company`,'') FROM `ww_users_company` WHERE `company_id`=NEW.company_id LIMIT 1);
        SET NEW.`v_group` = (SELECT IFNULL(`group`,'') FROM `ww_users_group` WHERE `group_id`=NEW.group_id LIMIT 1);
        SET NEW.`v_division` = (SELECT IFNULL(`division`,'') FROM `ww_users_division` WHERE `division_id`=NEW.division_id LIMIT 1);
        SET NEW.`v_department` = (SELECT IFNULL(`department`,'') FROM `ww_users_department` WHERE `department_id`=NEW.department_id LIMIT 1);
        SET NEW.`v_position` = (SELECT IFNULL(`position`,'') FROM `ww_users_position` WHERE `position_id`=NEW.position_id LIMIT 1);
        SET NEW.`v_reports_to` = (SELECT IFNULL(CONCAT(NEW.`lastname`,', ',NEW.`firstname`,' ',IFNULL(NEW.`suffix`,'')),'') FROM `ww_users` WHERE `user_id`=NEW.reports_to_id LIMIT 1);
        SET NEW.`v_project_hr` = (SELECT IFNULL(CONCAT(NEW.`lastname`,', ',NEW.`firstname`,' ',IFNULL(NEW.`suffix`,'')),'') FROM `ww_users` WHERE `user_id`=NEW.project_hr_id LIMIT 1);
	SET NEW.`v_specialization` = (SELECT IFNULL(`specialization`,'') FROM `ww_users_specialization` WHERE `specialization_id`=NEW.specialization_id LIMIT 1);
	SET NEW.`v_location` = (SELECT IFNULL(`location`,'') FROM `ww_users_location` WHERE `location_id`=NEW.location_id LIMIT 1);
	SET NEW.`v_project` = (SELECT IFNULL(`project`,'') FROM `ww_users_project` WHERE `project_id`=NEW.project_id LIMIT 1);
        SET NEW.`v_section` = (SELECT IFNULL(`section`,'') FROM `ww_users_section` WHERE `section_id`=NEW.section_id LIMIT 1);
        SET NEW.`v_branch` = (SELECT IFNULL(`branch`,'') FROM `ww_users_branch` WHERE `branch_id`=NEW.branch_id LIMIT 1);
        SET NEW.`v_credit_setup` = (SELECT IFNULL(`class`,'') FROM `ww_time_form_balance_credit_class` WHERE `class_id`=NEW.credit_setup_id LIMIT 1);
        
        UPDATE `ww_users` 
        SET 
           `company_id` = NEW.company_id,
           `full_name` = CONCAT(NEW.`lastname`,', ',NEW.`firstname`,' ',IFNULL(NEW.`suffix`,'')),
           `display_name` = CONCAT(NEW.`lastname`,', ',NEW.`firstname`)
        WHERE `user_id` = NEW.`user_id`;
        
        UPDATE `ww_partners`
        SET 
           `alias` = CONCAT(NEW.`lastname`,', ',NEW.`firstname`,' ',IFNULL(NEW.`suffix`,''))
        WHERE `user_id` = NEW.`user_id`;
                                                                
    END */$$


DELIMITER ;

/* Trigger structure for table `ww_users_profile` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `users_profile_insert_after` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `users_profile_insert_after` AFTER INSERT ON `ww_users_profile` FOR EACH ROW BEGIN 
        
        SET @coid = NEW.`company_id`;
        INSERT INTO ww_payroll_partners (user_id, company_id) VALUES (NEW.user_id, NEW.company_id)
        ON DUPLICATE KEY UPDATE company_id=IFNULL(company_id,@coid),`modified_on`=NOW(),`deleted`=0;
        
   END */$$


DELIMITER ;

/* Trigger structure for table `ww_users_profile` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `users_profile_update_before` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `users_profile_update_before` BEFORE UPDATE ON `ww_users_profile` FOR EACH ROW BEGIN
        
        /* This will insert-update display names accross all modules 
           last change: 2014-02-01 initial
                        2014-02-14 based on existing client (Surname, Given Name Suffix)
        */ 
        SET NEW.`company` = (SELECT IFNULL(`company`,'') FROM `ww_users_company` WHERE `company_id`=NEW.company_id LIMIT 1);
        SET NEW.`v_group` = (SELECT IFNULL(`group`,'') FROM `ww_users_group` WHERE `group_id`=NEW.group_id LIMIT 1);
        SET NEW.`v_division` = (SELECT IFNULL(`division`,'') FROM `ww_users_division` WHERE `division_id`=NEW.division_id LIMIT 1);
        SET NEW.`v_department` = (SELECT IFNULL(`department`,'') FROM `ww_users_department` WHERE `department_id`=NEW.department_id LIMIT 1);
        SET NEW.`v_position` = (SELECT IFNULL(`position`,'') FROM `ww_users_position` WHERE `position_id`=NEW.position_id LIMIT 1);
        SET NEW.`v_reports_to` = (SELECT IFNULL(CONCAT(NEW.`lastname`,', ',NEW.`firstname`,' ',IFNULL(NEW.`suffix`,'')),'') FROM `ww_users` WHERE `user_id`=NEW.reports_to_id LIMIT 1);
        SET NEW.`v_project_hr` = (SELECT IFNULL(CONCAT(NEW.`lastname`,', ',NEW.`firstname`,' ',IFNULL(NEW.`suffix`,'')),'') FROM `ww_users` WHERE `user_id`=NEW.project_hr_id LIMIT 1);
	SET NEW.`v_specialization` = (SELECT IFNULL(`specialization`,'') FROM `ww_users_specialization` WHERE `specialization_id`=NEW.specialization_id LIMIT 1);
	SET NEW.`v_location` = (SELECT IFNULL(`location`,'') FROM `ww_users_location` WHERE `location_id`=NEW.location_id LIMIT 1);
	SET NEW.`v_project` = (SELECT IFNULL(`project`,'') FROM `ww_users_project` WHERE `project_id`=NEW.project_id LIMIT 1);
        SET NEW.`v_section` = (SELECT IFNULL(`section`,'') FROM `ww_users_section` WHERE `section_id`=NEW.section_id LIMIT 1);
        SET NEW.`v_branch` = (SELECT IFNULL(`branch`,'') FROM `ww_users_branch` WHERE `branch_id`=NEW.branch_id LIMIT 1);
        SET NEW.`v_credit_setup` = (SELECT IFNULL(`class`,'') FROM `ww_time_form_balance_credit_class` WHERE `class_id`=NEW.credit_setup_id LIMIT 1);
                
        UPDATE `ww_users` 
        SET 
           `company_id` = NEW.company_id,
           `full_name` = CONCAT(NEW.`lastname`,', ',NEW.`firstname`,' ',IFNULL(NEW.`suffix`,'')),
           `display_name` = CONCAT(NEW.`lastname`,', ',NEW.`firstname`)
        WHERE `user_id` = NEW.`user_id`;
        
        /*UPDATE `ww_partners`
        SET 
           `alias` = CONCAT(NEW.`lastname`,', ',NEW.`firstname`,' ',IFNULL(NEW.`suffix`,''))
        WHERE `user_id` = NEW.`user_id`;*/
        
        -- LATER!!!!
        -- UPDATE `ww_partners`
        -- UPDATE `ww_users_division`
        -- UPDATE `ww_users_department`
        -- UPDATE `ww_users_group`
        -- UPDATE `ww_users_position`
        -- UPDATE `ww_time_forms`
        
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
