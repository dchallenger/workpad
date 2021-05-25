<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class loan_application_admin_model extends Record
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
		$this->mod_id = 268;
		$this->mod_code = 'loan_application_admin';
		$this->route = 'partners/loan_application_admin';
		$this->url = site_url('partners/loan_application_admin');
		$this->primary_key = 'loan_application_id';
		$this->table = 'partners_loan_application';
		$this->icon = '';
		$this->short_name = 'HR Online Services Admin';
		$this->long_name  = 'HR Online Services Admin';
		$this->description = '';
		$this->path = APPPATH . 'modules/loan_application_admin/';

		parent::__construct();
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

        $qry .= " AND {$this->db->dbprefix}partners_loan_application.loan_application_status_id > 1";

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

	public function get_loan_application_approver_info( $loan_application_id = 0, $user_id = 0 )
	{
		$loan_application = $this->db->query("SELECT * FROM loan_application_manage WHERE loan_application_id=".$loan_application_id." AND approver_id=".$user_id);
		return $loan_application->row_array();
	}   

	function notify_filer( $loan_application_id=0, $loan_application=array())
	{
		$notified = array();

        $this->lang->load( 'loan_application' );
		$loan_application_status = $loan_application['loan_application_status_id'] == 2 ? "Filed" : "Cancelled";

		$this->db->where('loan_type_code',$loan_application['loan_type_code']);
		$this->db->where('deleted',0);
		$form_type = $this->db->get('partners_loan_type');
		$form_type = $form_type->row_array();

		$this->load->model('loan_application_model', 'loanApplicationPersonal');

		//insert notification
		$insert = array(
			'status' => 'info',
			'message_type' => 'Loan Application Record',
			'user_id' => $loan_application['user_id'],
			'feed_content' => $loan_application_status.': '.$form_type['loan_type'].' for Approval',//.'.<br><br>Reason: '.$form['reason'],
			'recipient_id' => $loan_application['user_id'],
			'uri' => str_replace(base_url(), '', $this->loanApplicationPersonal->url).'/detail/'.$loan_application['loan_application_id']
		);

		$this->db->insert('system_feeds', $insert);
		$id = $this->db->insert_id();
		$this->db->insert('system_feeds_recipient', array('id' => $id, 'user_id' => $loan_application['user_id']));
		$notified[] = $loan_application['user_id'];

		return $notified;
	}

	function newPostData($data)
	{
		$this->load->model('loan_application_model', 'loanApp');
		$qry = "INSERT INTO ww_system_feeds 
				(
					status
					, message_type
					, user_id
					, display_name
					, feed_content
					, recipient_id
					, uri
				) 
				VALUES
				(
					'" . $data['status'] . "',
					'" . $data['message_type'] . "',
					'" . $data['user_id'] . "',
					'" . $data['display_name'] . "',
					'" . $data['feed_content'] . "',
					'" . $data['recipient_id'] . "',
					'" . str_replace(base_url(), '', $this->loanApp->url).'/detail/'.$data['loan_application_id'] . "'					
				)";
		
		$this->db->query($qry);                                  
		
		return $this->db->insert_id();
	}

	function get_loan_application_details($loan_application_id)
	{
		$loan_application_details = $this->db->query("SELECT * FROM loan_application_manage WHERE loan_application_id=".$loan_application_id);

		return $loan_application_details->row_array();
	}	

	function setDecission($decission)
	{
		$data = array();
		
		$qry = "CALL sp_partners_loan_application_approval('".$decission['loan_application_id']."', '".$decission['user_id']."', '".$decission['decission']."', '".(isset($decission['comment']) ? $decission['comment'] : '')."')";
		$result = $this->db->query( $qry );

		if($result && $result->num_rows() > 0)
		{			
			foreach($result->result_array() as $row){
				$data[] = $row;
			}
		}

		mysqli_next_result($this->db->conn_id);
		return $data;	
	}	

	function get_cpla_details($loan_application_id = 0,$approver_user_id = 0)
	{
		$this->db->select('
							pla.user_id AS user_id,plaa.user_id AS approver_id,
							pla.loan_application_id,pla.created_on,place.loan_application_car_entitlement,
							plac.year_model,CAST( AES_DECRYPT( plac.loan_amount, encryption_key()) AS CHAR) AS loan_amount,plac.car_type,plac.amortization
						');
		$this->db->from('partners_loan_application pla');
		$this->db->join('partners_loan_application_car plac','pla.loan_application_id = plac.loan_application_id');
		$this->db->join('partners_loan_application_approver plaa','pla.loan_application_id = plaa.loan_application_id');
		//$this->db->join('ww_partners_loan_application_car_amortization plac','pla.loan_application_car_amortization_id = plac.loan_application_car_amortization_id');
		$this->db->join('ww_partners_loan_application_car_entitlement place','plac.loan_application_car_entitlement_id = place.loan_application_car_entitlement_id');
		
		if ($loan_application_id)
			$this->db->where('pla.loan_application_id',$loan_application_id);

		if ($approver_user_id)
			$this->db->where('plaa.user_id',$approver_user_id);

		$this->db->where('pla.deleted',0);

		$result = $this->db->get();

		return $result->row_array();
	}

	function get_ola_details($loan_application_id = 0,$approver_user_id = 0)
	{
		$this->db->select('
							pla.user_id AS user_id,plaa.user_id AS approver_id,
							pla.loan_application_id,pla.created_on,CAST( AES_DECRYPT( plao.loan_amount, encryption_key()) AS CHAR) AS loan_amount,
							plao.loan_purposes,plao.loan_terms
						');
		$this->db->from('partners_loan_application pla');
		$this->db->join('ww_partners_loan_application_omnibus plao','pla.loan_application_id = plao.loan_application_id');
		$this->db->join('partners_loan_application_approver plaa','pla.loan_application_id = plaa.loan_application_id');
		
		if ($loan_application_id)
			$this->db->where('pla.loan_application_id',$loan_application_id);

		if ($approver_user_id)
			$this->db->where('plaa.user_id',$approver_user_id);

		$this->db->where('pla.deleted',0);

		$result = $this->db->get();

		return $result->row_array();
	}

	function get_map_details($loan_application_id = 0,$approver_user_id = 0)
	{
		$this->db->select('
							pla.user_id AS user_id,plaa.user_id AS approver_id,
							pla.loan_application_id,pla.created_on,plame.loan_application_mobile_enrollment_type,
							plampl.loan_application_mobile_plan_limit,plamsf.loan_application_mobile_special_feature
						');
		$this->db->from('partners_loan_application pla');
		$this->db->join('partners_loan_application_mobile plam','pla.loan_application_id = plam.loan_application_id');
		$this->db->join('partners_loan_application_approver plaa','pla.loan_application_id = plaa.loan_application_id');
		$this->db->join('ww_partners_loan_application_mobile_enrollment_type plame','plam.loan_application_mobile_enrollment_type_id = plame.loan_application_mobile_enrollment_type_id');
		$this->db->join('ww_partners_loan_application_mobile_plan_limit plampl','plam.loan_application_mobile_plan_limit_id = plampl.loan_application_mobile_plan_limit_id');
		$this->db->join('ww_partners_loan_application_mobile_special_feature plamsf','plam.loan_application_mobile_special_feature_id = plamsf.loan_application_mobile_special_feature_id');
		
		if ($loan_application_id)
			$this->db->where('pla.loan_application_id',$loan_application_id);

		if ($approver_user_id)
			$this->db->where('plaa.user_id',$approver_user_id);

		$this->db->where('pla.deleted',0);

		$result = $this->db->get();

		return $result->row_array();
	}	

	function get_approver_remarks($loan_application_id=0){			
		$comments_query = "SELECT CONCAT( firstname , ' ', lastname ) AS display_name, comment, 
							loan_application_status_id, plaa.user_id AS approver_id,
							plaa.comment_date,loan_application_status
	    					FROM {$this->db->dbprefix}partners_loan_application_approver plaa 
							LEFT JOIN {$this->db->dbprefix}users_profile up 
							ON plaa.user_id = up.user_id
					        WHERE loan_application_id= $loan_application_id
        					AND (loan_application_status_id = 6 OR loan_application_status_id = 7)
        					AND deleted = 0
        					ORDER BY plaa.id ";
		$comments = $this->db->query($comments_query);

        $comments = $comments->result_array();
		return $comments;
	}	

	public function get_disapproved_cancelled_remarks($loan_application_id=0, $user_id=0){
		$disapproved_cancelled_remarks_qry = "SELECT CONCAT(firstname, ' ', lastname) as approver_name, pla.display_name AS employee_name, plaa.comment, plas.loan_application_status, plaa.comment_date as `date`
									FROM {$this->db->dbprefix}partners_loan_application pla
									LEFT JOIN {$this->db->dbprefix}partners_loan_application_approver plaa ON pla.`loan_application_id` = plaa.`loan_application_id`
									LEFT JOIN {$this->db->dbprefix}users_profile up ON plaa.`user_id` = up.`user_id`
									LEFT JOIN {$this->db->dbprefix}partners_loan_application_status plas ON pla.`loan_application_status_id` = plas.`loan_application_status_id`									
									WHERE pla.loan_application_status_id IN (7,8) AND pla.deleted = 0
									AND pla.`loan_application_id` = $loan_application_id AND plaa.`loan_application_status_id` IN (7,8)";

		$disapproved_cancelled_remarks = $this->db->query($disapproved_cancelled_remarks_qry);
		if($disapproved_cancelled_remarks->num_rows() > 0){
			return $disapproved_cancelled_remarks->result_array();
		}
		return false;
	}		
}