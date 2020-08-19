<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function process_time_biometrics($location_id, $user_id,$manual = false)
{
	$ci =& get_instance();

	// variable declaration
	$dtr_raw = array();
	$raw_id = array();

	// Get raw dtr data
	$qry = "SELECT *
			FROM {$ci->db->dbprefix}time_record_raw
			WHERE processed = 0
/*				AND location_id = {$location_id}*/
			    AND user_id <> 0
			    AND DATE(`checktime`) >= (SELECT
			                     DATE_SUB(MIN(DATE(`checktime`)), INTERVAL 1 DAY)
			                   FROM {$ci->db->dbprefix}time_record_raw
			                   WHERE processed = 0)			
			    /*AND user_id = 168*/
			    /*AND `date` = '2015-09-14'*/
			ORDER BY user_id, `date`, checktime ASC
			";
	$result = $ci->db->query($qry);	
	if($result && $result->num_rows() == 0) {
		return;
	}
	foreach ($result->result() as $dtr_raw_entry) {
		
		$ci->db->where('user_id', $dtr_raw_entry->user_id);
		$ci->db->where('deleted', 0);
		$ci->db->limit(1);

		$employee = $ci->db->get('users');

		if ($employee && $employee->num_rows() > 0){
			$user_id = $employee->row()->user_id;

			$dtr_raw_id 	= $dtr_raw_entry->raw_id;
			$cdate 			= date('Y-m-d',strtotime($dtr_raw_entry->checktime));
			$prevdate 		= date("Y-m-d",strtotime("-1days",strtotime($cdate)));	
			$date_entry 	= $dtr_raw_entry->checktime;
			$work_sched 	= get_shift_details($cdate,$user_id);
			if(!empty($work_sched)) {
				$day = strtolower(date('l', $cdate));
				$shift_start 	= $work_sched->shift_time_start;
				$shift_end 		= $work_sched->shift_time_end;
				$noon_start 	= '00:00:00';
				$noon_end 		= '00:00:00';

				$shift_datetime_start_b	= date('Y-m-d H:i:s', strtotime('-8 hour',strtotime($cdate . ' ' . $shift_start)));
				$shift_datetime_start 	= date('Y-m-d H:i:s', strtotime($cdate . ' ' . $shift_start));
				$noon_datetime_start_bl	= date('Y-m-d H:i:s', strtotime('-30 min', strtotime($cdate . ' ' . $noon_start))); // buffer 30 min
				$noon_datetime_start 	= date('Y-m-d H:i:s', strtotime($cdate . ' ' . $noon_start));
				$noon_datetime_start_b 	= date('Y-m-d H:i:s', strtotime('+30 min', strtotime($cdate . ' ' . $noon_start))); // buffer 30 min
				$noon_datetime_end_bl	= date('Y-m-d H:i:s', strtotime('-30 min', strtotime($cdate . ' ' . $noon_end)));
				$noon_datetime_end 		= date('Y-m-d H:i:s', strtotime($cdate . ' ' . $noon_end));
				$noon_datetime_end_b	= date('Y-m-d H:i:s', strtotime('+30 min', strtotime($cdate . ' ' . $noon_end)));
				$shift_datetime_end 	= date('Y-m-d H:i:s', strtotime($cdate . ' ' . $shift_end));
				$shift_datetime_end_b 	= date('Y-m-d H:i:s', strtotime('+8 hour',strtotime($cdate . ' ' . $shift_end)));
				if (strtotime($shift_start) > strtotime($shift_end)) {
					$prev_shift_datetime_end_b 	= date('Y-m-d H:i:s', strtotime('+8 hour',strtotime($cdate . ' ' . $shift_end)));
				}
				else{
					$prev_shift_datetime_end_b 	= date('Y-m-d H:i:s', strtotime('+8 hour',strtotime($prevdate . ' ' . $shift_end)));
				}
				$cdate_in 	= $cdate;
				$cdate_bout = $cdate;
				$cdate_bin 	= $cdate;
				$cdate_out 	= $cdate; 

				if($focus_date == 1) { //focus date startdate					
					if($shift_start >= '06:00:00' && $shift_start <= '16:00:00') {				
						if(date('H:i:s', strtotime($date_entry)) >= '00:00:00' && date('H:i:s', strtotime($date_entry)) <= '06:00:00') {
							if (strtotime($shift_start) > strtotime($shift_end)) {
								$cdate = date('Y-m-d', strtotime('-1 day', strtotime($cdate)));
								$cdate_in 	= $cdate;
								$cdate_bout = $cdate;
								$cdate_bin 	= $cdate;
								$cdate_out 	= $cdate;
							}
						} else {
							if (strtotime($shift_start) > strtotime($shift_end)) {
								$shift_datetime_end = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($cdate . ' ' . $shift_end)));
								if ($noon_start >= '00:00:00' && $noon_start <= '06:00:00') {
									$noon_datetime_start = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($cdate . ' ' . $noon_start)));
								}
								if ($noon_end >= '00:00:00' && $noon_end <= '06:00:00') {
									$noon_datetime_end = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($cdate . ' ' . $noon_end)));		
								}
								$night_shift = true;
								$cdate = date('Y-m-d', strtotime('-1 day', strtotime($shift_datetime_end)));
								$cdate_in 	= $cdate;
								$cdate_bout = $cdate;
								$cdate_bin 	= $cdate;
								$cdate_out 	= $cdate;
							}
						}
					} else {
						if(date('H:i:s', strtotime($date_entry)) >= '00:00:00' && date('H:i:s', strtotime($date_entry)) <= '08:00:00') {
							$cdate = date('Y-m-d', strtotime('-1 day', strtotime($cdate)));
							$cdate_in 	= $cdate;
							$cdate_bout = $cdate;
							$cdate_bin 	= $cdate;
							$cdate_out 	= $cdate;
						} else {
							if (strtotime($shift_start) > strtotime($shift_end)) {
								$shift_datetime_end = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($cdate . ' ' . $shift_end)));
								if ($noon_start >= '00:00:00' && $noon_start <= '06:00:00') {
									$noon_datetime_start = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($cdate . ' ' . $noon_start)));
									$noon_datetime_start_bl	= date('Y-m-d H:i:s', strtotime('-121 min', strtotime($noon_datetime_start))); // buffer 30 min
								}
								if ($noon_end >= '00:00:00' && $noon_end <= '06:00:00') {
									$noon_datetime_end = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($cdate . ' ' . $noon_end)));		
								}
								$night_shift = true;
								$cdate = date('Y-m-d', strtotime('-1 day', strtotime($shift_datetime_end)));
								$cdate_in 	= $cdate;
								$cdate_bout = $cdate;
								$cdate_bin 	= $cdate;
								$cdate_out 	= $cdate;
							}
						}
					}

					// to check previous date if with out or not
					$ci->db->where('user_id', $user_id);
					$ci->db->where(array('date' => $prevdate, 'deleted' => 0));
					$prev_edtr = $ci->db->get('time_record');
					if ($prev_edtr && $prev_edtr->num_rows() > 0) { // if date line is not availble
						$prev_exist_date = $prev_edtr->row();
						if (!$prev_exist_date->time_out1 || $prev_exist_date->time_out1 == '' || (strtotime($prev_exist_date->time_out1) < strtotime($date_entry))){
							if ($date_entry <= $prev_shift_datetime_end_b){
								time_out1($prevdate,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
								//update_dtr_raw($dtr_raw_entry->raw_id);
								continue;								
							}
						}
					}

					$ci->db->where('user_id', $user_id);
					$ci->db->where(array('date' => $cdate, 'deleted' => 0));
					$edtr = $ci->db->get('time_record');
					if ($edtr && $edtr->num_rows() == 0) { // if date line is not availble
						$ci->db->insert('time_record', array('time_in1' => $date_entry,'user_id'=>$user_id,'date'=>$cdate));
						update_dtr_raw($dtr_raw_entry->raw_id);
					} else { // if date line is availble
						$exist_date = $edtr->row();
						
						if (($exist_date->time_in1 == null || $exist_date->time_in1 == '') && ($exist_date->time_in1 == null || $exist_date->time_in1 == '')){
							time_in1($cdate_in,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
						}
						else{
							if (!$exist_date->time_in1){
								if ($date_entry >= $shift_datetime_start_b && $date_entry <= $shift_datetime_end_b){
									time_in1($cdate_in,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
									//update_dtr_raw($dtr_raw_entry->raw_id);
									continue;
								}
							}

							if($date_entry != $exist_date->time_in1 && $date_entry != $exist_date->time_out1 && $date_entry != $exist_date->time_in2 && $date_entry != $exist_date->time_out2) {						
								if($exist_date->time_in1 > $date_entry) {
									if ($date_entry >= $shift_datetime_start_b && $date_entry <= $shift_datetime_end_b){
										time_in1($cdate_in,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
										//update_dtr_raw($dtr_raw_entry->raw_id);
										continue;
									}							
									time_in1($cdate_in,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
								}
								elseif($exist_date->time_in1 < $date_entry && $exist_date->time_in1 < $shift_datetime_start_b) {
									if ($date_entry < $noon_datetime_start_bl && $date_entry > $shift_datetime_start_b){
										time_in1($cdate_in,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
										//update_dtr_raw($dtr_raw_entry->raw_id);
										continue;
									}							
								}								

								if(empty($exist_date->time_out1)) {
									if ($date_entry < $shift_datetime_end_b){
										time_out1($cdate_bout,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
									}
								}
								else{
									if ($exist_date->time_out1 < $date_entry){
										time_out1($cdate_bout,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
									}
								}

								if ($date_entry >= $noon_datetime_start && $date_entry <= $noon_datetime_end){
									if (empty($exist_date->time_out2)){
										time_out2($cdate_bout,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
										//update_dtr_raw($dtr_raw_entry->raw_id);
										continue;	
									}
									else{
										if ($exist_date->time_out2 > $date_entry){
											time_out2($cdate_bout,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
											//update_dtr_raw($dtr_raw_entry->raw_id);
											continue;	
										}
									}
								}

								if ($date_entry >= $noon_datetime_start && $date_entry <= $noon_datetime_end_b){
									if (!empty($exist_date->time_out2)){
										if (empty($exist_date->time_in2)){
											time_in2($cdate_bout,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
											//update_dtr_raw($dtr_raw_entry->raw_id);
											continue;	
										}
										else{
											if ($date_entry < $noon_datetime_end){
												time_in2($cdate_bout,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
												//update_dtr_raw($dtr_raw_entry->raw_id);
												continue;	
											}
											else{
												if ($exist_date->time_in2 < $noon_datetime_start || $exist_date->time_in2 > $noon_datetime_end){
													time_in2($cdate_bout,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
													//update_dtr_raw($dtr_raw_entry->raw_id);
													continue;
												}
											}
										}
									}
								}
							}
						}
					}
				} else { //focus date enddate				
					if($shift_start >= '06:00:00' && $shift_start <= '16:00:00') {
						if(date('H:i:s', strtotime($date_entry)) >= '00:00:00' && date('H:i:s', strtotime($date_entry)) <= '06:00:00') {
							$cdate = $cdate;
							$cdate_in 	= $cdate;
							$cdate_bout = $cdate;
							$cdate_bin 	= $cdate;
							$cdate_out 	= $cdate;
						} else {
							if (strtotime($shift_start) > strtotime($shift_end)) {
								$shift_datetime_end = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($cdate . ' ' . $shift_end)));
								if ($noon_start >= '00:00:00' && $noon_start <= '06:00:00') {
									$noon_datetime_start = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($cdate . ' ' . $noon_start)));
								}
								if ($noon_end >= '00:00:00' && $noon_end <= '06:00:00') {
									$noon_datetime_end = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($cdate . ' ' . $noon_end)));		
								}
								$night_shift = true;
								$cdate = date('Y-m-d', strtotime($shift_datetime_end));
								$cdate_in 	= $cdate;
								$cdate_bout = $cdate;
								$cdate_bin 	= $cdate;
								$cdate_out 	= $cdate;
							}
						}
					} else {
						if(date('H:i:s', strtotime($date_entry)) >= '00:00:00' && date('H:i:s', strtotime($date_entry)) <= '08:00:00') {
							$cdate = $cdate;
							$cdate_in 	= $cdate;
							$cdate_bout = $cdate;
							$cdate_bin 	= $cdate;
							$cdate_out 	= $cdate;
						} else {
							if (strtotime($shift_start) > strtotime($shift_end)) {
								$shift_datetime_end = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($cdate . ' ' . $shift_end)));
								if ($noon_start >= '00:00:00' && $noon_start <= '06:00:00') {
									$noon_datetime_start = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($cdate . ' ' . $noon_start)));
								}
								if ($noon_end >= '00:00:00' && $noon_end <= '06:00:00') {
									$noon_datetime_end = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($cdate . ' ' . $noon_end)));		
								}
								$night_shift = true;
								$cdate = date('Y-m-d', strtotime($shift_datetime_end));
								$cdate_in 	= $cdate;
								$cdate_bout = $cdate;
								$cdate_bin 	= $cdate;
								$cdate_out 	= $cdate;
							}
						}
					}
					$ci->db->where('user_id', $user_id);
					$ci->db->where(array('date' => $cdate, 'deleted' => 0));
					$edtr = $ci->db->get('time_record');
					if ($edtr && $edtr->num_rows() == 0) { // if date line is not availble
							$ci->db->insert('time_record', array('time_in1' => $date_entry,'user_id'=>$user_id,'date'=>$cdate));
					} else { // if date line is availble

						$exist_date = $edtr->row();

						if (($exist_date->time_in1 == null || $exist_date->time_in1 == '') && ($exist_date->time_in1 == null || $exist_date->time_in1 == '')){
							time_in1($cdate_in,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
						}
						else{
							if($date_entry != $exist_date->time_in1 && $date_entry != $exist_date->time_out1 && $date_entry != $exist_date->time_in2 && $date_entry != $exist_date->time_out2) {						
								if($exist_date->time_in1 > $date_entry) {
									time_in1($cdate_in,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
									$date_entry = $exist_date->time_in1;
								}
								// dbug($cdate);							
								if(empty($exist_date->time_out1)) {	
									time_out1($cdate_out,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
								} else {
									if($exist_date->time_out1 < $date_entry) {
										time_out1($cdate_out,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
										$date_entry = $exist_date->time_out1;
									}
									if(empty($exist_date->time_in2)) {	
										time_in2($cdate_bin,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
									} else {
										// dbug($noon_datetime_start.' '.$date_entry.' '.date('Y-m-d H:i:s', strtotime('-1 hour', strtotime($noon_datetime_start))));
										if($date_entry < $noon_datetime_start) {
											if($date_entry > date('Y-m-d H:i:s', strtotime('-1 hour', strtotime($noon_datetime_start)))) {
												// dbug($noon_datetime_start.' '.$exist_date->time_in2.' '.date('Y-m-d H:i:s', strtotime('-1 hour', strtotime($noon_datetime_start))));
												if($exist_date->time_in2 < $noon_datetime_start && $exist_date->time_in2 > date('Y-m-d H:i:s', strtotime('-1 hour', strtotime($noon_datetime_start)))) {										
													if($exist_date->time_in2 > $date_entry) {
														time_in2($cdate_bin,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
														$date_entry = $exist_date->time_in2;
													}
												} else {
													if($exist_date->time_in2 < $date_entry) {
														time_in2($cdate_bin,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
														$date_entry = $exist_date->time_in2;
													}
												}
											}
										} else {
											if($exist_date->time_in2 < $noon_datetime_start && $exist_date->time_in2 > date('Y-m-d H:i:s', strtotime('-1 hour', strtotime($noon_datetime_start)))) {
												if($exist_date->time_in2 > $date_entry) {
													$shift_time = array(1=>$exist_date->time_in2,2=>$date_entry);
													$focus_date_time = $noon_datetime_start;
													$close = get_close_date($shift_time, $focus_date_time);
													switch ($close['best']) {
														case 2:
															time_in2($cdate_bin,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
															$date_entry = $exist_date->time_in2;
															break;
													}
												}
											} else {
												if($exist_date->time_in2 < $date_entry) {
													$shift_time = array(1=>$exist_date->time_in2,2=>$date_entry);
													$focus_date_time = $noon_datetime_start;
													$close = get_close_date($shift_time, $focus_date_time);
													switch ($close['best']) {
														case 2:
															time_in2($cdate_bin,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
															$date_entry = $exist_date->time_in2;
															break;
													}
												}
											}
										}
										if(empty($exist_date->time_out2)) {	
											time_out2($cdate_bout,$date_entry,$user_id,$exist_date);
										} else {
											if($date_entry > $noon_datetime_end) {
												if($date_entry < date('Y-m-d H:i:s', strtotime('+2 hour', strtotime($noon_datetime_end)))) {											
													if($exist_date->time_out2 > $noon_datetime_end && $exist_date->time_out2 < date('Y-m-d H:i:s', strtotime('+2 hour', strtotime($noon_datetime_end)))) {									
														
														if($exist_date->time_out2 < $date_entry) {
															time_out2($cdate_bout,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
														}
													} else {												
														if($exist_date->time_out2 < $date_entry) {													
															time_out2($cdate_bout,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
														}
													}
												}
											} else {
												if($exist_date->time_out2 > $noon_datetime_end && $exist_date->time_out2 < date('Y-m-d H:i:s', strtotime('+2 hour', strtotime($noon_datetime_end)))) {
													if($exist_date->time_out2 < $date_entry) {
														$shift_time = array(1=>$exist_date->time_out2,2=>$date_entry);
														$focus_date_time = $noon_datetime_end;
														$close = get_close_date($shift_time, $focus_date_time);
														switch ($close['best']) {
															case 2:
																time_out2($cdate_bout,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
																break;
														}
													}
												} else {
													if($exist_date->time_out2 < $date_entry) {
														$shift_time = array(1=>$exist_date->time_out2,2=>$date_entry);
														$focus_date_time = $noon_datetime_end;
														$close = get_close_date($shift_time, $focus_date_time);
														switch ($close['best']) {
															case 2:
																time_out2($cdate_bout,$date_entry,$user_id,$exist_date,$dtr_raw_entry->raw_id);
																break;
														}
													}
												}
											}
										}
									}
								}
							}							
						}
					}
				}

				$cdate_2 = date("Y-m-d",strtotime("-1days",strtotime($cdate)));		
				$cdate_2 = $cdate;		
				$ci->db->update('time_record_raw', array('processed' => 4),array('raw_id'=>$dtr_raw_entry->raw_id));
			} else {
				$cdate_2 = date("Y-m-d",strtotime("-1days",strtotime($cdate)));
				$cdate_2 = $cdate;		
				$ci->db->update('time_record_raw', array('processed' => 2),array('raw_id'=>$dtr_raw_entry->raw_id));
			}			
		}
		else{
			$ci->db->update('time_record_raw', array('processed' => 3),array('raw_id'=>$dtr_raw_entry->raw_id));
		}
	}
	return;
}


function update_dtr_raw($raw_id){
	$ci =& get_instance();
	$ci->db->update('time_record_raw', array('processed' => 1),array('raw_id'=>$raw_id));
}

function time_in1($cdate,$date_entry,$user_id,$exist_date,$raw_id) {
	$ci =& get_instance();
	$ci->db->update('time_record', array('time_in1' => $date_entry),array('date' => $cdate, 'user_id'=>$user_id, 'deleted' => 0));
	
	if ($ci->db->affected_rows() > 0){
		$ci->db->update('time_record_raw', array('processed' => 1),array('raw_id'=>$raw_id));
	}
}

function time_out1($cdate,$date_entry,$user_id,$exist_date,$raw_id) {
	$ci =& get_instance();
	$ci->db->update('time_record', array('time_out1' => $date_entry),array('date' => $cdate, 'user_id'=>$user_id, 'deleted' => 0));
	
	if ($ci->db->affected_rows() > 0){
		$ci->db->update('time_record_raw', array('processed' => 1),array('raw_id'=>$raw_id));
	}
}

function time_in2($cdate,$date_entry,$user_id,$exist_date,$raw_id) {
	$ci =& get_instance();
	$ci->db->update('time_record', array('time_in2' => $date_entry),array('date' => $cdate, 'user_id'=>$user_id, 'deleted' => 0));

	if ($ci->db->affected_rows() > 0){
		$ci->db->update('time_record_raw', array('processed' => 1),array('raw_id'=>$raw_id));
	}
}

function time_out2($cdate,$date_entry,$user_id,$exist_date,$raw_id) {
	$ci =& get_instance();
	$ci->db->update('time_record', array('time_out2' => $date_entry),array('date' => $cdate, 'user_id'=>$user_id, 'deleted' => 0));

	if ($ci->db->affected_rows() > 0){
		$ci->db->update('time_record_raw', array('processed' => 1),array('raw_id'=>$raw_id));
	}
}

function get_close_date($shift_time, $focus_date_time) {
	$best = false;
	$diff = '';
	$bestDiff = 'X';
	for ($index = 1; $index <= count($shift_time); $index++) {
	    $diff = abs(strtotime($focus_date_time) - strtotime($shift_time[$index]));
	    if ($best === false || $diff < $bestDiff) {
	        $best = $index;
	        $alldaway = $shift_time[$index];
	        $bestDiff = $diff;
	    }
	}
	return array('best'=>$best,'alldaway'=>$alldaway,'bestDiff'=>$bestDiff);
}

public function get_shift_details($date='', $user_id=0){
    $shift_details_qry = "SELECT * FROM time_shift_logs WHERE date='$date' AND user_id = $user_id";
    $shift_details = $this->db->query($shift_details_qry);

    if($shift_details->num_rows() == 0){
        $shift_details_qry = "SELECT partners.user_id AS user_id,'$date' AS DATE, partners.shift_id AS shift_id,
                                time_shift.time_start AS shift_time_start, time_shift.time_end AS shift_time_end,
                                 '-' AS logs_time_in,  '-' AS logs_time_out
                             FROM partners LEFT JOIN time_shift ON partners.shift_id = time_shift.shift_id
                             WHERE partners.user_id = $user_id";
        $shift_details = $this->db->query($shift_details_qry);
    }

    return $shift_details->row();
}