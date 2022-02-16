<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class loan_application_model extends Record
{
	var $mod_id;
	var $mod_code;
	var $route;
	var $url;
	var $primary_key;
	var $table;
	var $icon;
	var $short_name;
	var $long_name;
	var $description;
	var $path;

	public function __construct()
	{
		$this->mod_id = 264;
		$this->mod_code = 'loan_application';
		$this->route = 'partners/loan_application';
		$this->url = site_url('partners/loan_application');
		$this->primary_key = 'loan_application_id';
		$this->table = 'partners_loan_application';
		$this->icon = '';
		$this->short_name = 'HR Online Services';
		$this->long_name  = 'HR Online Services';
		$this->description = '';
		$this->path = APPPATH . 'modules/loan_application/';

		parent::__construct();
	}

	public function get_loan_statuses()
	{
		$this->db->where('deleted',0);
		$result = $this->db->get('partners_loan_application_status');
		return $result;	
	}

	function _get_list($start, $limit, $search, $filters, $trash = false)
    {
        $data = array();                
        
        $qry = $this->_get_list_cached_query();
        
        if( $trash )
        {
            $qry .= " AND {$this->db->dbprefix}{$this->table}.deleted = 1";
        }
        else{
            $qry .= " AND {$this->db->dbprefix}{$this->table}.deleted = 0"; 
        }

        if($filters != "" & $filters != "loan_type_id=0")
			$qry .= $filters;
			     

        $qry .= " AND {$this->db->dbprefix}{$this->table}.user_id = ".$this->user->user_id;
        //$qry .= " AND {$this->db->dbprefix}{$this->table}.form_code <> 'DTRU'"; // exclude DTRU
        $qry .= " GROUP BY record_id";
        $qry .= " ORDER BY {$this->db->dbprefix}{$this->table}.created_on DESC ";
        $qry .= " LIMIT $limit OFFSET $start";

        $this->load->library('parser');
        $this->parser->set_delimiters('{$', '}');
        $qry = $this->parser->parse_string($qry, array('search' => $search), TRUE);

        $result = $this->db->query( $qry );
        // echo $qry;
        if($result->num_rows() > 0)
        {           
            foreach($result->result_array() as $row){
                $data[] = $row;
            }
        }
        return $data;
    }

	public function get_loan_type($loan_type_code='')
	{		
		$where = array('deleted' => 0);
		if($loan_type_code != '') {$where= array('deleted' => 0, 'loan_type_code' => $loan_type_code);}
		$loan_type_details = $this->db->get_where('partners_loan_type', $where);

		return ($loan_type_code != '') ? $loan_type_details->row_array() : $loan_type_details->result_array();		 
	}

	public function call_sp_approvers($class_code, $user_id){		
		$sp_partners_loan = $this->db->query("CALL sp_time_forms_get_approvers('$class_code', ".$user_id.")");

		mysqli_next_result($this->db->conn_id);
		return $sp_partners_loan->result_array();
	}

	public function get_time_forms_approvers($loan_application_id=0){		
		$partners_loan_approvers = $this->db->query("SELECT plaa.user_id AS approver_id, `condition`,  sequence, up.lastname, up.firstname, 
							`position`, plaa.loan_application_status, plaa.loan_application_status_id 
							FROM ww_partners_loan_application_approver plaa
							JOIN ww_users_profile up ON plaa.user_id = up.user_id 
							LEFT JOIN ww_users_position upos ON up.position_id = upos.position_id
							LEFT JOIN ww_users u ON u.user_id = up.user_id
							WHERE plaa.loan_application_id = {$loan_application_id}"
							AND u.active = 1);

		if ($partners_loan_approvers && $partners_loan_approvers->num_rows() > 0)
			return $partners_loan_approvers->result_array();
		else
			return array();
	}	

	public function get_enroll_ment_type()
	{		
		$where = array('deleted' => 0);
		$enrollment_type_details = $this->db->get_where('partners_loan_application_mobile_enrollment_type', $where);

		return $enrollment_type_details->result_array();		 
	}

	public function get_plan_limit()
	{		
		$where = array('deleted' => 0);
		$enrollment_type_details = $this->db->get_where('partners_loan_application_mobile_plan_limit', $where);

		return $enrollment_type_details->result_array();		 
	}

	public function get_special_features()
	{		
		$where = array('deleted' => 0);
		$enrollment_type_details = $this->db->get_where('partners_loan_application_mobile_special_feature', $where);

		return $enrollment_type_details->result_array();		 
	}		

	public function get_loan_application_details($loan_application_id=0){		
		$where = array('deleted' => 0);
		if($loan_application_id != 0) {$where= array('deleted' => 0, 'loan_application_id' => $loan_application_id);}
		$loan_application_details = $this->db->get_where('partners_loan_application', $where);
		
		return $loan_application_details->row_array();
	}	

	public function get_display_name($user_id=0){		
		$sql_display_name = $this->db->get_where('users', array('user_id' => $user_id));
		$display_name = $sql_display_name->row_array();
		return $display_name['display_name'];
	}	

	function notify_approvers( $loan_application_id=0, $loan_application=array())
	{
		$notified = array();

		$this->db->order_by('sequence', 'asc');
		$approvers = $this->db->get_where('partners_loan_application_approver', array('loan_application_id' => $loan_application['loan_application_id'], 'deleted' => 0));
	
		$first = true;
		foreach( $approvers->result() as $approver )
		{
			switch( $approver->condition )
			{
				case 'All':
				case 'Either Of';
					break;
				case 'By Level':
					if( !$first )
					break;
			}

			$loan_application_status = $loan_application['loan_application_status_id'] == 2 ? "Filed" : "Cancelled";
			
			$this->db->where('loan_type_code',$loan_application['loan_type_code']);
			$this->db->where('deleted',0);
			$form_type = $this->db->get('partners_loan_type');
			$form_type = $form_type->row_array();

			$this->load->model('loan_application_manage_model', 'loanApplicationManage');

			//insert notification
			
			$insert = array(
				'status' => 'info',
				'message_type' => 'Loan Application Record',
				'user_id' => $loan_application['user_id'],
				'display_name' => $this->get_display_name($loan_application['user_id']),
				'feed_content' => $loan_application_status.': '.$form_type['loan_type'].' for Approval',//.'.<br><br>Reason: '.$form['reason'],
				'recipient_id' => $approver->user_id,
				'uri' => str_replace(base_url(), '', $this->loanApplicationManage->url).'/detail/'.$loan_application['loan_application_id']
			);
			$this->db->insert('system_feeds', $insert);
			$id = $this->db->insert_id();
			$this->db->insert('system_feeds_recipient', array('id' => $id, 'user_id' => $approver->user_id));
			
			$notified[] = $approver->user_id;

			$first = false;

		}

		return $notified;
	}

	function notify_filer( $loan_application_id=0, $loan_application=array())
	{
		$notified = array();

        $this->lang->load( 'loan_application' );
		$loan_application_status = $loan_application['loan_application_status_id'] == 2 ? $this->lang->line('loan_application.applied_for') : "Cancelled";

		$this->db->where('loan_type_code',$loan_application['loan_type_code']);
		$this->db->where('deleted',0);
		$form_type = $this->db->get('partners_loan_type');
		$form_type = $form_type->row_array();

		//insert notification
		$insert = array(
			'status' => 'info',
			'message_type' => 'Loan Application Record',
			'user_id' => $loan_application['user_id'],
			'feed_content' => $loan_application_status.' '.$loan_application['loan_type_code'],
			'recipient_id' => $loan_application['user_id'],
			'uri' => str_replace(base_url(), '', $this->url).'/detail/'.$loan_application['loan_application_id']
		);

		$this->db->insert('system_feeds', $insert);
		$id = $this->db->insert_id();
		$this->db->insert('system_feeds_recipient', array('id' => $id, 'user_id' => $loan_application['user_id']));
		$notified[] = $loan_application['user_id'];

		return $notified;
	}

	function notify_hr( $loan_application_id=0, $loan_application=array())
	{	
		$this->load->model('loan_application_admin_model', 'loanApplicationAdmin');

		$qry = "SELECT  *
				FROM {$this->db->dbprefix}roles r 
				WHERE FIND_IN_SET(2,profile_id)";

		$roles_result = $this->db->query($qry);

		if ($roles_result && $roles_result->num_rows() > 0) {
			$role_id = $roles_result->row()->role_id;

			$this->db->where('role_id',$role_id);
			$users = $this->db->get('users');

			if ($users && $users->num_rows() > 0) {
				$notified = array();		
		        $this->lang->load( 'loan_application' );
				$loan_application_status = $loan_application['loan_application_status_id'] == 4 ? 'Filed' : "";

				$this->db->where('loan_type_code',$loan_application['loan_type_code']);
				$this->db->where('deleted',0);
				$form_type = $this->db->get('partners_loan_type');
				$form_type = $form_type->row_array();

				foreach ($users->result() as $row) {
					//insert notification
					$insert = array(
						'status' => 'info',
						'message_type' => 'Loan Application Record',
						'user_id' => $loan_application['user_id'],
						'feed_content' => $loan_application_status.': '.$form_type['loan_type'].' for Validation',//.'.<br><br>Reason: '.$form['reason'],
						'recipient_id' => $row->user_id,
						'uri' => str_replace(base_url(), '', $this->loanApplicationAdmin->url).'/edit/'.$loan_application['loan_application_id']
					);

					$this->db->insert('system_feeds', $insert);
					$id = $this->db->insert_id();
					$this->db->insert('system_feeds_recipient', array('id' => $id, 'user_id' => $row->user_id));
					$notified[] = $row->user_id;

					$qry = "CALL sp_partners_loan_application_email_to_hr('".$loan_application_id."', '".$row->user_id."')";
					$result = $this->db->query( $qry );
				}
			}
		}

		return $notified;
	}

	public function edit_cached_query( $record_id )
	{
		//check for cached query
		if( !$this->load->config('edit_cached_query', false, true) )
		{
			//mandatory fields
			$this->db->select( $this->table . '.' . $this->primary_key . ' as record_id' );

			//create query for all tables
			$this->load->config('fields');
			$tables = array();
			foreach( $this->config->item('fields') as $fg_id => $fields )
			{
				foreach( $fields as $f_name => $field )
				{
					if( $field['display_id'] == 2 || $field['display_id'] == 3)
					{
						switch( $field['uitype_id'] )
						{ 
							case 6:
								$columns[] = 'DATE_FORMAT('.$this->db->dbprefix.$f_name . ', \\\'%M %d, %Y\\\') as "'. $field['table'] .'.'. $field['column'] .'"';
								break;
							case 12:
								$columns[] = 'DATE_FORMAT('.$this->db->dbprefix.$f_name . '_from, \\\'%M %d, %Y\\\') as "'. $field['table'] .'.'. $field['column'] .'_from"';
								$columns[] = 'DATE_FORMAT('.$this->db->dbprefix.$f_name . '_to,\\\'%M %d, %Y\\\') as "'. $field['table'] .'.'. $field['column'] .'_to"';
								break;	
							default:
								$columns[] = $f_name . ' as "'. $field['table'] .'.'. $field['column'] .'"';
						}
					}
					
					
					if( !in_array( $field['table'], $tables ) && $field['table'] != $this->table ){
						$this->db->join( $field['table'], $field['table'].'.'.$this->primary_key . ' = ' . $this->table.'.'.$this->primary_key, 'left');
						$tables[] = $field['table'];
					}
				}
			}

			$db_debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;

			if( isset( $columns ) ) $this->db->select( $columns, false );
			$this->db->from( $this->table );
			$this->db->where( $this->table.'.'.$this->primary_key. ' = "{$record_id}"' );
			$record = $this->db->get();
			$cached_query = $this->db->last_query();

			$this->db->db_debug = $db_debug;

			$cached_query = '$config["edit_cached_query"] = \''. $cached_query .'\';';
			$cached_query = $this->load->blade('templates/save2file', array( 'string' => $cached_query), true);
			
			$this->load->helper('file');
			$save_to = $this->path . 'config/edit_cached_query.php';
			$this->load->helper('file');
			write_file($save_to, $cached_query);
		}

		$this->load->config('edit_cached_query');
		$cached_query = $this->config->item('edit_cached_query');

		$this->load->library('parser');
		$this->parser->set_delimiters('{$', '}');
		$qry = $this->parser->parse_string($cached_query, array('record_id' => $record_id), TRUE);

		return $this->db->query( $qry )->row_array();
	}	

	public function get_entitlement()
	{		
		$where = array('deleted' => 0);
		$entitlement_details = $this->db->get_where('partners_loan_application_car_entitlement', $where);

		return $entitlement_details->result_array();		 
	}

	public function get_loan_application_attachment($loan_application_id=0){ 
		
		// should this display all employee's birthday? 
		// or should birthday feeds be filtered via company, division, etc?

		$data = array();

		$qry = "SELECT * FROM {$this->db->dbprefix}partners_loan_application_attachment plaa
				WHERE plaa.loan_application_id = {$loan_application_id} AND deleted = 0";
		$result = $this->db->query($qry);
		
		if($result && $result->num_rows() > 0){
			$data = $result->result();		

			$result->free_result();			
		}
			
		return $data;	
	}	
}