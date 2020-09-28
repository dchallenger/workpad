<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["detail_cached_query"] = 'SELECT `ww_partners_clearance`.`clearance_id` as record_id, `ww_partners_clearance`.`created_on` as "partners_clearance_created_on", `ww_partners_clearance`.`created_by` as "partners_clearance_created_by", `ww_partners_clearance`.`modified_on` as "partners_clearance_modified_on", `ww_partners_clearance`.`modified_by` as "partners_clearance_modified_by"
FROM (`ww_partners_clearance`)
WHERE `ww_partners_clearance`.`clearance_id` = "{$record_id}"';