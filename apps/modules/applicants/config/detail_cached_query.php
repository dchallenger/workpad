<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["detail_cached_query"] = 'SELECT `ww_recruitment`.`recruit_id` as record_id, `ww_recruitment`.`created_on` as "recruitment_created_on", `ww_recruitment`.`created_by` as "recruitment_created_by", `ww_recruitment`.`modified_on` as "recruitment_modified_on", `ww_recruitment`.`modified_by` as "recruitment_modified_by"
FROM (`ww_recruitment`)
WHERE `ww_recruitment`.`recruit_id` = "{$record_id}"';