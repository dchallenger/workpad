<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query"] = 'SELECT *
FROM (`ww_performance_manpower_allocation_fix_column`)
WHERE (
	ww_performance_manpower_allocation_fix_column.full_name like "%{$search}%"
)
AND full_name IS NOT NULL ';