<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query"] = 'SELECT `ww_training_calendar_participant`.`calendar_participant_id` as record_id, 
	`t0`.`full_name` AS training_feedback_participants_name,
	ww_training_feedback.average_score as "training_feedback_average_score", 
	ww_training_feedback.total_score as "training_feedback_total_score", 
	ww_training_feedback.feedback_status_id as "training_feedback_status_id", 
	`ww_training_feedback`.`created_on` as "training_feedback_created_on", 
	`ww_training_feedback`.`created_by` as "training_feedback_created_by", 
	`ww_training_feedback`.`modified_on` as "training_feedback_modified_on", 
	`ww_training_feedback`.`modified_by` as "training_feedback_modified_by"
FROM (`ww_training_calendar_participant`) 
  LEFT JOIN `ww_users` t0 
    ON `t0`.`user_id` = `ww_training_calendar_participant`.`user_id` 
  LEFT JOIN `ww_partners` 
    ON `ww_partners`.`user_id` = `ww_training_calendar_participant`.`user_id`
  LEFT JOIN `ww_training_feedback` 
    ON `ww_training_feedback`.`training_calendar_id` = `ww_training_calendar_participant`.`training_calendar_id`
    	AND `ww_training_feedback`.`user_id` = `ww_training_calendar_participant`.`user_id`
WHERE (
	ww_training_calendar_participant.user_id like "%{$search}%"
)';





