<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Training_calendar_admin extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('training_calendar_admin_model', 'mod');
		$this->load->model('training_calendar_manage_model', 'tcmm');
		$this->load->model('training_calendar_model', 'tcm');

		parent::__construct();
	}

	function index()
	{
		if( !$this->permission['list'] )
		{
			echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
			die();
		}

        $user_setting = APPPATH . 'config/users/'. $this->user->user_id .'.php';
        $user_id = $this->user->user_id;
        $this->load->config( "users/{$user_id}.php", false, true );
        $user = $this->config->item('user');

        $this->load->config( 'roles/'. $user['role_id'] .'/permission.php', false, true );
        $permission = $this->config->item('permission');

/*		$this->db->order_by('type', 'asc');
		$partners_movement_type = $this->db->get_where('partners_movement_type', array('deleted' => 0));
		$data['partners_movement_type'] = $partners_movement_type->result();

		$this->db->order_by('cause', 'asc');
		$partners_movement_cause = $this->db->get_where('partners_movement_cause', array('deleted' => 0));
		$data['partners_movement_cause'] = $partners_movement_cause->result();
*/
        $data['training_calendar'] = isset($permission[$this->tcm->mod_code]['list']) ? $permission[$this->tcm->mod_code]['list'] : 0;
        $data['training_calendar_manage'] = isset($permission[$this->tcmm->mod_code]['list']) ? $permission[$this->tcmm->mod_code]['list'] : 0;
        $data['training_calendar_admin'] = isset($this->permission['list']) ? $this->permission['list'] : 0;

		$this->load->vars( $data );
		echo $this->load->blade('pages.listing')->with( $this->load->get_cached_vars() );
	}		
}