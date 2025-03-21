<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Process requests from cron.php
 *
 * Usage:
 * (Windows)
 * C:\xampp\php\php.exe <HRIS_DIR>cron.php -u <USERNAME> -p <PASSWORD> -m <METHOD>
 *
 * Note:
 * Methods called by cron.php should be declared as private and must begin with an underscore.
 *
 */

class Uploader_portal_new extends MX_Controller
{

	// ------------------------------------------------------------------------
	
	public function __construct()
	{
		parent::__construct();		

		$this->load->add_package_path(MODPATH . CLIENT_DIR);
	}

	// ------------------------------------------------------------------------

	/**
	 * Checks user credentials and routes method to use.
	 * 
	 * @return void
	 */
	public function index()
	{		
		ini_set('memory_limit', '256M');
		$this->load->helper('file');
		$this->load->helper('time_upload');


		$server = '10.0.0.92';
		$link = mssql_connect($server, 'user', 'pass');

		if (!$link) {
		    die('Something went wrong while connecting to MSSQL');
		}


		// create log
		$folder = 'logs/biometric_logs_portal';
		$log_file = $folder.'/'.date('Y-m-d').'.txt';
		if(!file_exists($folder)) 
			mkdir($folder, 0777, true);

		
		// log message
		$log_msg = date('Ymd H:i:s')." START UPLOADING \r\n";
		write_file($log_file, $log_msg, 'a');

		debug("test");

		$db2 = $this->load->database('ms_sql_portal_new', TRUE);

		debug($db2->error());
		die();

		$qry = $db2->query('SELECT * FROM VW_OTP_Attendances a WHERE CONVERT(VARCHAR,Date_Stamp,112) BETWEEN CONVERT(VARCHAR,GETDATE()-7,112) AND CONVERT(VARCHAR,GETDATE()+1,112)');

		if( $qry->num_rows > 0 ){
			$msdata = $qry->result();
		}

		$not_exist_biometrics = array();
		$records_read = 0;
		
		// log message
		$log_msg = date('Ymd H:i:s').' '.$qry->num_rows()." record(s) read. \r\n";
		write_file($log_file, $log_msg, 'a');

		$qry->free_result();

		$ctr = 1;
		foreach ($msdata as $row) {
			$this->db->where('biometric', $row->Employee_Number);
			$this->db->where_not_in('status', array(8,9));
			$this->db->where('deleted', 0);
	
			$employee = $this->db->get('partners');

			if ($employee->num_rows() > 0) {

				$user_id = $employee->row()->user_id;

				//if (in_array($user_id, array(369,536))) {

					$info = "Employee No - " . $row->Employee_Number ." Tiem In - ". $row->Time_In ." Time Out - ". $row->Time_Out ." Time In Location - ".$row->time_in_location." Time Out Location - ".$row->Time_Out_Work_Location." \r\n";
					write_file($log_file, $info, 'a');

					$time_in1 = '';
					$time_out1 = '';

					$date = $row->Date_Stamp;
					if (trim($row->Time_In) !== '' && trim($row->Time_In) != '0000-00-00 00:00:00')
						$time_in1 = date('Y-m-d H:i:s',strtotime($row->Time_In));

					if (trim($row->Time_Out) !== '' && trim($row->Time_Out) != '0000-00-00 00:00:00')
						$time_out1 = date('Y-m-d H:i:s',strtotime($row->Time_Out));

					$where = array(
						'user_id' => $user_id,
						'date' => $date
					);

					$to_insert = array(
						'user_id' => $user_id,
						'date' => $date,
						'time_in' => $time_in1,
						'time_out' => $time_out1,
						'entry_mode' => 'oclp_portal',
						'time_in_location' => $row->time_in_location,
						'time_out_location' => $row->Time_Out_Work_Location
					);						

					$to_update = array(
						'time_in' => $time_in1,
						'time_out' => $time_out1,
						'entry_mode' => 'oclp_portal',
						'time_in_location' => $row->time_in_location,
						'time_out_location' => $row->Time_Out_Work_Location						
					);	

					$exist_data = $this->db->get_where('time_record_new', $where);

					if ($exist_data->num_rows() == 0) {
						$this->db->insert('time_record_new', $to_insert);				
					}
					else {
						$this->db->where($where);
						$this->db->update('time_record_new', $to_update);				
					}	

					$ctr++;
				//}

			} else {
				// log message
				$log_msg = date('Ymd H:i:s').' '.$row->Employee_Number." does not exist. \r\n";
				write_file($log_file, $log_msg, 'a');

			}		
		}

		// log message
		$log_msg = date('Ymd H:i:s').' '.$ctr." total record(s) updated. \r\n";
		write_file($log_file, $log_msg, 'a');

		// log message
		$log_msg = date('Ymd H:i:s')." END UPLOADING \r\n";
		write_file($log_file, $log_msg, 'a');	
	} 
}