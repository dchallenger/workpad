<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Training_request_confirmation extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('training_request_confirmation_model', 'mod');
		parent::__construct();
	}

    public function index()
    {
        if( !$this->permission['list'] )
        {
            echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
            die();
        }
        
        $permission = parent::_check_permission('training_request_manage');
        $data['allow_manage'] = ($permission != 0 ? $permission['list'] : $permission);
        $permission = parent::_check_permission('training_request_admin');
        $data['allow_admin'] = ($permission != 0 ? $permission['list'] : $permission);
        $permission = parent::_check_permission('training_request_confirmation');
        $data['allow_training_confirmation'] = ($permission != 0 ? $permission['list'] : $permission);

        $this->load->vars($data);
        echo $this->load->blade('pages.listing')->with( $this->load->get_cached_vars() );
    }	

    public function save( $child_call = false )
    {
        $this->_ajax_only();

        $calendar_id = $this->input->post('record_id');
        $status_id = $this->input->post('status_id');

        //get total confirm on training calendar to validate
        if ($calendar_id != '') {
            $query = "SELECT COUNT(*) total_confirm FROM ww_training_calendar_participant c 
                WHERE c.training_calendar_id  = " . $calendar_id . " AND participant_status_id = 2";

            $total_confirm_result = $this->db->query($query);

            if ($total_confirm_result && $total_confirm_result->num_rows() > 0) {
                $total_confirm = $total_confirm_result->row();

                if ((int)$total_confirm->total_confirm >= (int)$_POST['training_calendar']['min_training_capacity']){
                    $this->response->message[] = array(
                        'message' => 'Maximum training capacity has been filled already.',
                        'type' => 'error'
                    );
                    $this->_ajax_return();  
                }
            }
        }

        if ($calendar_id != '')
            $this->save_calendar_participant($calendar_id,$this->user->user_id,$status_id);

        $this->response->message[] = array(
            'message' => lang('common.save_success'),
            'type' => 'success'
        );

        if( !$child_call )
        {
            $this->_ajax_return();
        }

    }

    public function save_calendar_participant($calendar_id=0,$participant_user_id=0,$status_id = 0)
    {
        $this->db->where('training_calendar_id',$calendar_id);
        $this->db->where('user_id',$participant_user_id);
        $this->db->update('training_calendar_participant',array('participant_status_id' => $status_id));

        $qry = "UPDATE ww_training_calendar SET confirmed = confirmed + 1 WHERE training_calendar_id = {$calendar_id}";
        $this->db->query($qry);

        $this->mod->notify_hr($calendar_id,$participant_user_id,$status_id);        
    }


	function detail($record_id, $child_call = false){
		parent::detail( '', true );

		//get sections if there are any
		$training_cost_tab = array();

		$this->db->order_by('calendar_budget_id');
		$training_costs = $this->db->get_where('training_calendar_budget', array('training_calendar_id' => $this->record_id));

		if($training_costs->num_rows() > 0){
			$training_cost_tab = $training_costs->result_array();
		}

		$data['training_cost_tab'] = $training_cost_tab;
		$data['calendar_id'] = $this->record_id;

		$session_tab = array();

		$this->db->order_by('calendar_session_id');
		$sessions = $this->db->get_where('training_calendar_session', array('training_calendar_id' => $this->record_id));

		if($sessions->num_rows() > 0){
			$session_tab = $sessions->result_array();
		}

		$data['session_tab'] = $session_tab;
		$data['training_calendar_id'] = $this->record_id;
		$data['session_count'] = $this->input->post('session_count');

        $this->db->where('training_calendar_id',$this->record_id);
        $this->db->where('user_id',$this->user->user_id);
        $participant_result = $this->db->get('training_calendar_participant');
        if ($participant_result && $participant_result->num_rows() > 0) {
            $data['participant_info'] = $participant_result->row_array();
        }

		$this->load->vars($data);
		$this->load->helper('form');
		$this->load->helper('file');
		echo $this->load->blade('pages.detail')->with( $this->load->get_cached_vars() );
	}

	function _list_options_active( $record, &$rec )
	{
		//temp remove until view functionality added
		if( $this->permission['detail'] )
		{
			$rec['detail_url'] = $this->mod->url . '/detail/' . $record['record_id'];
			$rec['options'] .= '<li><a href="'.$rec['detail_url'].'"><i class="fa fa-info"></i> View</a></li>';
		}
	}    
}