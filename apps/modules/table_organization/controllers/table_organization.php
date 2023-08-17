<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Table_organization extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('table_organization_model', 'mod');
		$this->load->model('division_model', 'div_mod');
		$this->load->model('department_model', 'dept_mod');
		parent::__construct();
	}

	public function index()
	{
		if( !$this->permission['list'] )
		{
			echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
			die();
		}

		$permission = $this->config->item('permission');

		$data['all_permission'] = $permission;

        $this->load->helper('form');
        $this->load->helper('file');
		
		$data['division'] = $this->div_mod->get_division();
		$data['department'] = $this->dept_mod->get_department();

		$this->load->vars($data); 

		echo $this->load->blade('pages.listing')->with( $this->load->get_cached_vars() );
	}

	public function generate_organization() {
		$this->_ajax_only();

		$filter = $this->input->post('filter');
		$division = $this->input->post('division');
		$department = $this->input->post('department');

		switch ($filter) {
			case 1:
				$parent_info = $this->mod->get_user_by_position('President and Chief Executive Officer');
				$child_org = $this->mod->get_reports_to($parent_info,[12,11,10]);
				break;
			case 2:
				$parent_info = $this->mod->get_user_by_position('President and Chief Executive Officer');
				$child_org = $this->mod->get_reports_to($parent_info,[12,11,10,9,8]);
				break;
			case 3:
				$parent_info = $this->mod->get_user_by_division($division);
				$child_org = $this->mod->get_reports_to($parent_info,[10,9,8]);
				break;				
			case 4:
				$parent_info = $this->mod->get_user_by_division($division);
				$child_org = $this->mod->get_reports_to($parent_info,[10,9,8,7,6,5,4,3]);
				break;
			case 5:
				$parent_info = $this->mod->get_user_by_department($department);
				$child_org = $this->mod->get_reports_to($parent_info,[10,9,8,7,6,5,4,3]);
				break;
			default:
				$parent_info = array();
				break;
		}

		$data['parent_info'] = $parent_info;

		$data['child_org'] = $child_org;

		$data['record'] = array();

		$this->response->html = $this->load->view('template/org_chart', $data, true);
		
		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
			);

		$this->_ajax_return();		
	}
}