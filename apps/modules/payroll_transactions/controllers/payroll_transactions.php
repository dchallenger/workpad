<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Payroll_transactions extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('payroll_transactions_model', 'mod');
		parent::__construct();
		$this->lang->load('payroll_transactions');
	}

	function index()
	{
		if( !$this->permission['list'] )
		{
			echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
			die();
		}

		$this->db->order_by('transaction_class', 'asc');
		$transaction_class = $this->db->get_where('payroll_transaction_class', array('deleted' => 0));
		$data['transaction_class'] = $transaction_class->result();
		$this->load->vars( $data );
		echo $this->load->blade('pages.listing')->with( $this->load->get_cached_vars() );
	}	
}