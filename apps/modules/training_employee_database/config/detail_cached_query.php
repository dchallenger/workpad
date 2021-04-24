<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["detail_cached_query"] = 'SELECT 
			ted.`employee_database_id` AS `record_id`,
			u.`full_name` AS `employee`,
			up.v_position AS `position`,
			up.v_division AS `division`,
			up.v_department AS `department`,
			p.v_job_grade AS `rank`, 
			p.status AS `employment_status`,
			tcal.cost_per_pax AS `cost_per_pax`
			FROM ww_training_employee_database ted 
			LEFT JOIN ww_users u ON u.`user_id` = ted.`user_id`	
			LEFT JOIN ww_partners p ON p.`user_id` = ted.`user_id`
			LEFT JOIN ww_users_profile up ON up.`user_id` = ted.`user_id`
			LEFT JOIN ww_training_calendar tcal ON tcal.training_calendar_id = ted.training_calendar_id
			LEFT JOIN ww_training_course tc ON tc.course_id = tcal.course_id
			LEFT JOIN ww_training_provider tp ON tp.provider_id = tc.provider_id
			WHERE ted.`employee_database_id` = "{$record_id}"';