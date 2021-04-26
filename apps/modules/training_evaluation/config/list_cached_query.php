<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query"] = 'SELECT 
`ww_training_calendar`.`training_calendar_id` as record_id,
`ww_training_calendar`.`topic` as training_calendar_topic, 
`T3`.`training_course` as "training_course",
CONCAT( `T1`.`course` ) AS training_subject, 
`ww_training_calendar`.`training_calendar_id`, 
`ww_training_feedback`.`feedback_id`,
`T3`.`start_date` as `start_date`,
`T3`.`end_date` as `end_date`,
`T2`.`sessiontime_from` as `sessiontime_from`,
`T2`.`sessiontime_to` as `sessiontime_to`,
`T2`.`instructor` as `instructor`
FROM (`ww_training_calendar`)
LEFT JOIN `ww_training_calendar_session` T2 ON `T2`.`training_calendar_id`=`ww_training_calendar`.`training_calendar_id`
LEFT JOIN `ww_training_employee_database` T3 ON `T3`.`training_calendar_id`=`ww_training_calendar`.`training_calendar_id`
LEFT JOIN `ww_training_course` T1 ON `T1`.`course_id`=`ww_training_calendar`.`course_id`
LEFT JOIN `ww_training_feedback` ON `ww_training_feedback`.`training_calendar_id` = `ww_training_calendar`.`training_calendar_id`
LEFT JOIN `ww_training_calendar_participant` T4 ON `T4`.`training_calendar_id`=`ww_training_calendar`.`training_calendar_id`
WHERE (`ww_training_calendar`.`closed` =  1)
';