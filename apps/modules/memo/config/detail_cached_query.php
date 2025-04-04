<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["detail_cached_query"] = 'SELECT `ww_memo`.`memo_id` as record_id, 
ww_memo_type.memo_type_id as "memo_memo_type_id", 
ww_memo_apply_to.apply_to_id as "memo_apply_to_id", 
ww_memo.memo_title as "memo_memo_title", 
DATE_FORMAT(ww_memo.publish_from, \'%M %d, %Y\') as "memo_publish_from", 
DATE_FORMAT(ww_memo.publish_to, \'%M %d, %Y\') as "memo_publish_to", 
IF(ww_memo.publish = 1, "Yes", "No") as "memo_publish", 
IF(ww_memo.comments = 1, "Yes", "No") as "memo_comments", 
IF(ww_memo.email = 1, "Yes", "No") as "memo_email", 
ww_memo.memo_body as "memo_memo_body", 
`ww_memo`.`created_on` as "memo_created_on", 
`ww_memo`.`created_by` as "memo_created_by", 
`ww_memo`.`modified_on` as "memo_modified_on", 
`ww_memo`.`modified_by` as "memo_modified_by", 
ww_memo.memo_body as "memo_memo_body",
ww_memo.attachment as "memo_attachment"
FROM (`ww_memo`)
LEFT JOIN `ww_memo_type` ON `ww_memo_type`.`memo_type_id` = `ww_memo`.`memo_type_id`
LEFT JOIN `ww_memo_apply_to` ON `ww_memo_apply_to`.`apply_to_id` = `ww_memo`.`apply_to_id`
WHERE `ww_memo`.`memo_id` = "{$record_id}"';