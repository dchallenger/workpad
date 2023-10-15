<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Import201 extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('import201_model', 'mod');
		parent::__construct();
		//$this->filename = 'D:\oclp new version\employee 201 master file from oclp.xls';
		$this->filename = 'D:\oclp new version\employee 201 record 10052020_updated.xls';
	}

	function import_payroll_summary(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'ID':
								$valid_cells[] = 'login';
								break;
							case 'Name':
								$valid_cells[] = 'full_name';
								break;	
							case 'summary_code':
								$valid_cells[] = 'summary_code';
								break;	
							case 'Jan':
								$valid_cells[] = 'jan';
								break;																															
							case 'Feb':
								$valid_cells[] = 'feb';
								break;	
							case 'Mar':
								$valid_cells[] = 'mar';
								break;								
							case 'Apr':
								$valid_cells[] = 'apr';
								break;
							case 'May':
								$valid_cells[] = 'may';
								break;		
							case 'June':
								$valid_cells[] = 'june';
								break;
							case 'July':
								$valid_cells[] = 'july';
								break;								
						}
					}
				}
				unset($import_data[$ctr]);
			}

			$ctr++;
		}

		$ctr = 0;
		$employee_id = array();	
		$negative_val = array('ABSENCES','LWOP','DEDUCTION_LATE','DEDUCTION_UNDERTIME');
		foreach ($import_data as $row) {	
			$this->load->library('aes', array('key' => $this->config->item('encryption_key')));	
			$arr_field_val = array();
			$transaction_id = '';
			foreach ($valid_cells as $key => $value) {
				$payroll_date = '';
				$period_id = '';
				switch ($value) {
					case 'login':
						if ($row[$key] != ''){
							$this->db->select('payroll_partners.company_id as company_id,users.user_id as employee_id,payroll_partners.location_id as location_id,users_profile.department_id as department_id,users_profile.position_id as position_id,users_profile.branch_id as branch_id,payroll_partners.payment_type_id as payment_type_id');
							$this->db->join('users','payroll_partners.user_id = users.user_id');
							$this->db->join('users_profile','users.user_id = users_profile.user_id');
							$result = $this->db->get_where('payroll_partners',array('login' => $row[$key]));
							if ($result && $result->num_rows() > 0){
								$partners_info = $result->row();
							}
						}
						break;
					case 'summary_code':
						if ($row[$key] != ''){
							$transaction_code = '';
							switch ($row[$key]) {
								case 'ABSENT':
									$transaction_code = 'ABSENCES';
									break;
								case 'BASIC PAY':
									$transaction_code = 'SALARY';
									break;									
								case 'COLA':
									$transaction_code = 'E-COLA';
									break;
								case 'LA':
									$transaction_code = 'LAUNDRYALLOW';
									break;	
								case 'LA1':
									$transaction_code = 'LAUNDRYALLOWRETRO';
									break;
								case 'MA':
									$transaction_code = 'MEDICINEALLOW';
									break;	
								case 'MA1':
									$transaction_code = 'MEDALLOWRETRO';
									break;										
								case 'SA2':
									$transaction_code = 'SERVICEALLOW';
									break;	
								case 'TRANS':
									$transaction_code = 'TRANSPO';
									break;										
								case 'OTHA':
									$transaction_code = 'OTHALLOW';
									break;	
								case 'TE_01':
									$transaction_code = 'GLOBE CHARGES';
									break;																			
								case 'MP_01':
									$transaction_code = 'MPCCMPC';
									break;
								case 'TX_01':
									$transaction_code = 'TAX COLLECTIBLE';
									break;	
								case 'UWP':
								case 'UWOP':
									$transaction_code = 'DEDUCTION_UNDERTIME';
									break;
								case 'LWP':
									$transaction_code = 'DEDUCTION_LATE';
									break;	
								case 'BW':
									$transaction_code = 'SALADJ';
									break;																		
								case 'MEDICARE':
									$transaction_code = 'PHIC_EMP';
									break;	
								case 'MEDER':
									$transaction_code = 'PHIC_COM';
									break;	
								case 'BTBON_TAX':
									$transaction_code = 'BONUS_TAXABLE';
									break;
								case 'BON13THNT':
								case 'PBON_NTAX':
								case 'PBON_TAX':
								case 'BT_BON_NTAX':
								case 'BTBON_NTAX':
									$transaction_code = 'BONUS';
									break;									
								case 'LWOP':
									$transaction_code = 'LWOP';
									break;
								case 'RA':
									$transaction_code = 'RICEALLOW';
									break;	
								case 'RA1':
									$transaction_code = 'RICEALLOWRETRO';
									break;	
								case 'SA':
									$transaction_code = 'SERVICEALLOW';
									break;
								case 'TA':
									$transaction_code = 'Tempo';
									break;	
								case 'TA1':
									$transaction_code = 'TEMPOALLOWRETRO';
									break;									
								case 'ECOLA':
									$transaction_code = 'E-COLA';
									break;
								case 'COLA_R':
									$transaction_code = 'ECOLA_ADJ';
									break;												
								case 'SI':
									$transaction_code = 'COMMISSION';
									break;																		
								case 'PAGIBIG1':
									$transaction_code = 'HDMF_EMP';
									break;
								case 'PAGIBIG1ER':
									$transaction_code = 'HDMF_COM';
									break;									
								case 'PAGIBIG2':
									$transaction_code = 'PagIbigAdd';
									break;	
								case 'LOAN_REF':
									$transaction_code = 'HDMFLN_MULTI';
									break;								
								case 'SSS_PREM':
									$transaction_code = 'SSS_EMP';
									break;		
								case 'SSSER':
									$transaction_code = 'SSS_COM';
									break;
								case 'ECC':
									$transaction_code = 'SSS_ECC';
									break;									
								case 'TAXWHELD':
									$transaction_code = 'WHTAX';
									break;
								case 'OTREGF8':
								case 'OTREGN8':
								case 'OTCODOF8':
								case 'OTCODON8':
									$transaction_code = 'REGOT';
									break;	
								case 'NDOTF8':
									$transaction_code = 'REGOT_ND';
									break;																		
								case 'OTRGRSF8':
								case 'OTRGDOF8':
								case 'OTRGDOS8':
									$transaction_code = 'RDOT';
									break;
								case 'NDRGRSF8':
								case 'NDRGDOF8':
									$transaction_code = 'RDOT_ND';
									break;									
								case 'OTRGRSN8':
								case 'OTRGDON8':
								case 'OTRGRSS8':
									$transaction_code = 'RDOT_EXCESS';
									break;
								case 'OTLGRGF8':
								case 'HOLLG':
									$transaction_code = 'LEGOT';
									break;
								case 'OTLGRSF8':
								case 'OTLGDOF8':
									$transaction_code = 'LEGRDOT';
									break;									
								case 'NDLGRGF8':
									$transaction_code = 'LEGOT_ND';
									break;									
								case 'OTLGRGN8':
								case 'OTLGRGS8';
									$transaction_code = 'LEGOT_EXCESS';
									break;
								case 'OTLGRSN8':
								case 'OTLGDON8':
									$transaction_code = 'LEGRDOT_EXCESS';
									break;
								case 'NDLGRSF8':
								case 'NDLGDOF8':
									$transaction_code = 'LEGRDOT_ND';
									break;

								case 'OTSPRGF8':
								case 'HOLSP':
									$transaction_code = 'SPEOT';
									break;
								case 'NDSPRGF8':
									$transaction_code = 'SPEOT_ND';
									break;
								case 'NDSPDOF8':
								case 'NDSPRSF8':
									$transaction_code = 'SPERDOT_ND';
									break;
								case 'OTSPRGN8':
								case 'OTSPRGS8':
									$transaction_code = 'SPEOT_EXCESS';
									break;		
								case 'OTSPRSF8':
								case 'OTSPDOF8':
									$transaction_code = 'SPERDOT';
									break;
								case 'OTSPRSN8':
								case 'OTSPDON8':
									$transaction_code = 'SPERDOT_EXCESS';
									break;											
								case 'TR':
									$transaction_code = 'TAXREF';
									break;	
								case 'NDREGF8':
									$transaction_code = 'REGND';
									break;	
								case 'CO_05':
									$transaction_code = 'COMPLNA';
									break;	
								case 'CA_02':
									$transaction_code = 'CASHADVLNA';
									break;
								case 'EL_03':
									$transaction_code = 'EMPLOYEE LEDGER';
									break;									
								case 'OT_01':
								case 'OTHERS':
									$transaction_code = 'OTHER DEDUCTION';
									break;	
								case 'TI_01':
									$transaction_code = 'TITHES';
								case 'NETPAY':
									$transaction_code = 'NETPAY';
									break;									
							}
							$with_value = false;
							if ($transaction_code != ''){
								$transaction_result = $this->db->get_where('payroll_transaction',array('transaction_code' => $transaction_code));
								if ($transaction_result && $transaction_result->num_rows() > 0){
									$transaction_row = $transaction_result->row();
									$transaction_id = $transaction_row->transaction_id;
									$with_value = true;
								}
							}
						}
						break;
					case 'jan':
						if (($row[$key] != '' && $row[$key] != 0) && $with_value){
							$amount = abs($row[$key]);
							if (in_array($transaction_row->transaction_code, $negative_val)){
								if ($row[$key] > 0){
									$amount = $row[$key] * -1;
								}
							}
							$this->db->set('period_id', 4);
							$this->db->set('payroll_date', '2017-01-15');
							$this->db->set('quantity', "AES_ENCRYPT(1, encryption_key())", FALSE);
							$this->db->set('unit_rate', "AES_ENCRYPT({$amount}, encryption_key())", FALSE);
							$this->db->set('amount', "AES_ENCRYPT({$amount}, encryption_key())", FALSE);
							$this->db->set('record_from', 'uploaded');

							$this->db->set('company_id', $partners_info->company_id);
							$this->db->set('processing_type_id', 1);
							$this->db->set('employee_id', $partners_info->employee_id);
							$this->db->set('department_id', $partners_info->department_id);
							$this->db->set('position_id', $partners_info->position_id);
							$this->db->set('location_id', $partners_info->location_id);
							$this->db->set('branch_id', $partners_info->branch_id);
							$this->db->set('payment_type_id', $partners_info->payment_type_id);

							$this->db->set('transaction_id', $transaction_row->transaction_id);
							$this->db->set('transaction_class_id', $transaction_row->transaction_class_id);
							$this->db->set('transaction_code', $transaction_row->transaction_code);
							$this->db->set('transaction_type_id', $transaction_row->transaction_type_id);

							$period_id = 4;
							$payroll_date = '2017-01-15';
						}
						break;	
					case 'feb':
						if (($row[$key] != '' && $row[$key] != 0) && $with_value){
							$amount = abs($row[$key]);
							if (in_array($transaction_row->transaction_code, $negative_val)){
								if ($row[$key] > 0){
									$amount = $row[$key] * -1;
								}
							}
							$this->db->set('period_id', 5);
							$this->db->set('payroll_date', '2017-02-15');
							$this->db->set('quantity', "AES_ENCRYPT(1, encryption_key())", FALSE);
							$this->db->set('unit_rate', "AES_ENCRYPT({$amount}, encryption_key())", FALSE);
							$this->db->set('amount', "AES_ENCRYPT({$amount}, encryption_key())", FALSE);
							$this->db->set('record_from', 'uploaded');

							$this->db->set('company_id', $partners_info->company_id);
							$this->db->set('processing_type_id', 1);
							$this->db->set('employee_id', $partners_info->employee_id);
							$this->db->set('department_id', $partners_info->department_id);
							$this->db->set('position_id', $partners_info->position_id);
							$this->db->set('location_id', $partners_info->location_id);
							$this->db->set('branch_id', $partners_info->branch_id);
							$this->db->set('payment_type_id', $partners_info->payment_type_id);

							$this->db->set('transaction_id', $transaction_row->transaction_id);
							$this->db->set('transaction_class_id', $transaction_row->transaction_class_id);
							$this->db->set('transaction_code', $transaction_row->transaction_code);
							$this->db->set('transaction_type_id', $transaction_row->transaction_type_id);

							$period_id = 5;
							$payroll_date = '2017-02-15';
						}
						break;	
					case 'mar':
						if (($row[$key] != '' && $row[$key] != 0) && $with_value){
							$amount = abs($row[$key]);
							if (in_array($transaction_row->transaction_code, $negative_val)){
								if ($row[$key] > 0){
									$amount = $row[$key] * -1;
								}
							}
							$this->db->set('period_id', 6);
							$this->db->set('payroll_date', '2017-03-15');
							$this->db->set('quantity', "AES_ENCRYPT(1, encryption_key())", FALSE);
							$this->db->set('unit_rate', "AES_ENCRYPT({$amount}, encryption_key())", FALSE);
							$this->db->set('amount', "AES_ENCRYPT({$amount}, encryption_key())", FALSE);
							$this->db->set('record_from', 'uploaded');

							$this->db->set('company_id', $partners_info->company_id);
							$this->db->set('processing_type_id', 1);
							$this->db->set('employee_id', $partners_info->employee_id);
							$this->db->set('department_id', $partners_info->department_id);
							$this->db->set('position_id', $partners_info->position_id);
							$this->db->set('location_id', $partners_info->location_id);
							$this->db->set('branch_id', $partners_info->branch_id);
							$this->db->set('payment_type_id', $partners_info->payment_type_id);

							$this->db->set('transaction_id', $transaction_row->transaction_id);
							$this->db->set('transaction_class_id', $transaction_row->transaction_class_id);
							$this->db->set('transaction_code', $transaction_row->transaction_code);
							$this->db->set('transaction_type_id', $transaction_row->transaction_type_id);

							$period_id = 6;
							$payroll_date = '2017-03-15';
						}
						break;	
					case 'apr':
						if (($row[$key] != '' && $row[$key] != 0) && $with_value){
							$amount = abs($row[$key]);
							if (in_array($transaction_row->transaction_code, $negative_val)){
								if ($row[$key] > 0){
									$amount = $row[$key] * -1;
								}
							}
							$this->db->set('period_id', 7);
							$this->db->set('payroll_date', '2017-04-15');
							$this->db->set('quantity', "AES_ENCRYPT(1, encryption_key())", FALSE);
							$this->db->set('unit_rate', "AES_ENCRYPT({$amount}, encryption_key())", FALSE);
							$this->db->set('amount', "AES_ENCRYPT({$amount}, encryption_key())", FALSE);
							$this->db->set('record_from', 'uploaded');

							$this->db->set('company_id', $partners_info->company_id);
							$this->db->set('processing_type_id', 1);
							$this->db->set('employee_id', $partners_info->employee_id);
							$this->db->set('department_id', $partners_info->department_id);
							$this->db->set('position_id', $partners_info->position_id);
							$this->db->set('location_id', $partners_info->location_id);
							$this->db->set('branch_id', $partners_info->branch_id);
							$this->db->set('payment_type_id', $partners_info->payment_type_id);

							$this->db->set('transaction_id', $transaction_row->transaction_id);
							$this->db->set('transaction_class_id', $transaction_row->transaction_class_id);
							$this->db->set('transaction_code', $transaction_row->transaction_code);
							$this->db->set('transaction_type_id', $transaction_row->transaction_type_id);

							$period_id = 7;
							$payroll_date = '2017-04-15';
						}
						break;		
					case 'may':
						if (($row[$key] != '' && $row[$key] != 0) && $with_value){
							$amount = abs($row[$key]);
							if (in_array($transaction_row->transaction_code, $negative_val)){
								if ($row[$key] > 0){
									$amount = $row[$key] * -1;
								}
							}
							$this->db->set('period_id', 8);
							$this->db->set('payroll_date', '2017-05-15');
							$this->db->set('quantity', "AES_ENCRYPT(1, encryption_key())", FALSE);
							$this->db->set('unit_rate', "AES_ENCRYPT({$amount}, encryption_key())", FALSE);
							$this->db->set('amount', "AES_ENCRYPT({$amount}, encryption_key())", FALSE);
							$this->db->set('record_from', 'uploaded');

							$this->db->set('company_id', $partners_info->company_id);
							$this->db->set('processing_type_id', 1);
							$this->db->set('employee_id', $partners_info->employee_id);
							$this->db->set('department_id', $partners_info->department_id);
							$this->db->set('position_id', $partners_info->position_id);
							$this->db->set('location_id', $partners_info->location_id);
							$this->db->set('branch_id', $partners_info->branch_id);
							$this->db->set('payment_type_id', $partners_info->payment_type_id);

							$this->db->set('transaction_id', $transaction_row->transaction_id);
							$this->db->set('transaction_class_id', $transaction_row->transaction_class_id);
							$this->db->set('transaction_code', $transaction_row->transaction_code);
							$this->db->set('transaction_type_id', $transaction_row->transaction_type_id);

							$period_id = 8;
							$payroll_date = '2017-05-15';
						}
						break;	
					case 'june':
						if (($row[$key] != '' && $row[$key] != 0) && $with_value){
							$amount = abs($row[$key]);
							if (in_array($transaction_row->transaction_code, $negative_val)){
								if ($row[$key] > 0){
									$amount = $row[$key] * -1;
								}
							}
							$this->db->set('period_id', 9);
							$this->db->set('payroll_date', '2017-06-15');
							$this->db->set('quantity', "AES_ENCRYPT(1, encryption_key())", FALSE);
							$this->db->set('unit_rate', "AES_ENCRYPT({$amount}, encryption_key())", FALSE);
							$this->db->set('amount', "AES_ENCRYPT({$amount}, encryption_key())", FALSE);
							$this->db->set('record_from', 'uploaded');

							$this->db->set('company_id', $partners_info->company_id);
							$this->db->set('processing_type_id', 1);
							$this->db->set('employee_id', $partners_info->employee_id);
							$this->db->set('department_id', $partners_info->department_id);
							$this->db->set('position_id', $partners_info->position_id);
							$this->db->set('location_id', $partners_info->location_id);
							$this->db->set('branch_id', $partners_info->branch_id);
							$this->db->set('payment_type_id', $partners_info->payment_type_id);

							$this->db->set('transaction_id', $transaction_row->transaction_id);
							$this->db->set('transaction_class_id', $transaction_row->transaction_class_id);
							$this->db->set('transaction_code', $transaction_row->transaction_code);
							$this->db->set('transaction_type_id', $transaction_row->transaction_type_id);

							$period_id = 9;
							$payroll_date = '2017-06-15';
						}
						break;	
					case 'july':
						if (($row[$key] != '' && $row[$key] != 0) && $with_value){
							$amount = abs($row[$key]);
							if (in_array($transaction_row->transaction_code, $negative_val)){
								if ($row[$key] > 0){
									$amount = $row[$key] * -1;
								}
							}
							$this->db->set('period_id', 10);
							$this->db->set('payroll_date', '2017-07-15');
							$this->db->set('quantity', "AES_ENCRYPT(1, encryption_key())", FALSE);
							$this->db->set('unit_rate', "AES_ENCRYPT({$amount}, encryption_key())", FALSE);
							$this->db->set('amount', "AES_ENCRYPT({$amount}, encryption_key())", FALSE);
							$this->db->set('record_from', 'uploaded');

							$this->db->set('company_id', $partners_info->company_id);
							$this->db->set('processing_type_id', 1);
							$this->db->set('employee_id', $partners_info->employee_id);
							$this->db->set('department_id', $partners_info->department_id);
							$this->db->set('position_id', $partners_info->position_id);
							$this->db->set('location_id', $partners_info->location_id);
							$this->db->set('branch_id', $partners_info->branch_id);
							$this->db->set('payment_type_id', $partners_info->payment_type_id);

							$this->db->set('transaction_id', $transaction_row->transaction_id);
							$this->db->set('transaction_class_id', $transaction_row->transaction_class_id);
							$this->db->set('transaction_code', $transaction_row->transaction_code);
							$this->db->set('transaction_type_id', $transaction_row->transaction_type_id);

							$period_id = 10;
							$payroll_date = '2017-07-15';
						}
						break;	
				}

				if ($payroll_date != '' && $transaction_id != ''){
/*					$this->db->where('employee_id', $partners_info->employee_id);
					$this->db->where('period_id',$period_id);
					$this->db->where('transaction_id',$transaction_id);
					$this->db->delete('payroll_closed_transaction');*/

					$this->db->insert('payroll_closed_transaction');
				}			
			}
			if (!in_array($partners_info->employee_id, $employee_id)){
				array_push($employee_id, $partners_info->employee_id);
				$this->db->insert('uploaded_data',array('company_id' => $partners_info->company_id, 'employee_id' => $partners_info->employee_id));
			}			
		}

		echo "Done.";	
	}	

	function import_company(){
		$this->db->truncate('users_company');
		$this->db->truncate('users_company_contact');

		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'Company Name':
								$valid_cells[] = 'company';
								break;
							case 'Company INITIALS':
								$valid_cells[] = 'company_initial';
								break;								
							case 'Company Code':
								$valid_cells[] = 'company_code';
								break;
							case 'Address':
								$valid_cells[] = 'address';
								break;
							case 'City':
								$valid_cells[] = 'city_id';								
								break;
							case 'Country':
								$valid_cells[] = 'country_id';								
								break;																
							case 'Zipcode':
								$valid_cells[] = 'zipcode';
								break;			
							case 'VAT Registration':
								$valid_cells[] = 'vat';
								break;
							case 'RDO Code':
								$valid_cells[] = 'rdo';								
								break;
							case 'SSS Number':
								$valid_cells[] = 'sss';
								break;
							case 'SSS Branch Code':
								$valid_cells[] = 'sss_branch_code';
								break;		
							case 'SSS Branch Code Locator':
								$valid_cells[] = 'sss_branch_code_locator';
								break;
							case 'PAG-IBIG Number':
								$valid_cells[] = 'hdmf';
								break;
							case 'PAG-IBIG Branch Code':
								$valid_cells[] = 'hdmf_branch_code';
								break;
							case 'PhilHealth Number':
								$valid_cells[] = 'phic';
								break;
							case 'Contact Numbers':
								$valid_cells_contact[14] = 'telephone';
								break;
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}


		$ctr = 0;

		// Remove non-matching cells.
		foreach ($import_data as $row) {		
			$arr_field_val = array();
			foreach ($valid_cells as $key => $value) {
				switch ($value) {
					case 'city_id':
						$result = $this->db->get_where('cities',array('city' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$city = $result->row();
							$row[$key] = $city->city_id;						
						}
						else{
							$row[$key] = '';
						}						
						break;	
					case 'country_id':
						$result = $this->db->get_where('countries',array('short_name' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$country = $result->row();
							$row[$key] = $country->country_id;						
						}
						else{
							$row[$key] = '';
						}
						break;
				}	
				
				$arr_field_val[$value] = $row[$key];
			}

			// fixed column to be inserted
			$arr_field_val['status_id'] = 1;

			$this->db->insert('users_company',$arr_field_val);
			$company_id = $this->db->insert_id();	

			foreach ($valid_cells_contact as $key => $value) {
				switch ($value) {
					case 'telephone':
						$contact_type = 'Phone';
						break;	
					case 'mobile':
						$contact_type = 'Mobile';
						break;																
					case 'fax_no':
						$contact_type = 'Fax';
						break;						
				}	
				if ($row[$key] != ''){
					$arr_field_val_contact['company_id'] = $company_id;						
					$arr_field_val_contact['contact_no'] = $row[$key];			
					$arr_field_val_contact['contact_type'] = $contact_type;
					$this->db->insert('users_company_contact',$arr_field_val_contact);
				}
			}
		}

		echo "Done.";	
	}


	function import_division(){
		$this->db->truncate('users_division');

		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'Division':
								$valid_cells[] = 'division';
								break;
							case 'Division Code':
								$valid_cells[] = 'division_code';
								break;
							case 'COST CENTER CODE':
								$valid_cells[] = 'cost_center_code';
								break;								
							case 'Immediate Head ID Number':
								$valid_cells[] = 'immediate_id';
								break;
							case 'COMPANY':
								$valid_cells[] = 'company_id';
								break;								
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}


		$ctr = 0;

		// Remove non-matching cells.
		foreach ($import_data as $row) {		
			$arr_field_val = array();
			foreach ($valid_cells as $key => $value) {
				switch ($value) {
					case 'immediate_id':
						$result = $this->db->get_where('partners',array('id_number' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$partners = $result->row();
							$row[$key] = $partners->user_id;						
						}
						else{
							$row[$key] = '';
						}						
						break;
					case 'company_id':
						$result = $this->db->get_where('users_company',array('company_initial' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$partners = $result->row();
							$row[$key] = $partners->company_id;
						}
						else{
							$row[$key] = '';
						}						
						break;							
				}	
				
				$arr_field_val[$value] = $row[$key];
			}

			// fixed column to be inserted
			$arr_field_val['status_id'] = 1;

			$this->db->insert('users_division',$arr_field_val);
		}

		echo "Done.";	
	}

	function import_employment_type(){
		$this->db->truncate('partners_employment_type');

		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {														
							case 'Employment Type':
								$valid_cells[] = 'employment_type';
								break;																						
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}


		$ctr = 0;

		// Remove non-matching cells.
		foreach ($import_data as $row) {		
			$arr_field_val = array();
			foreach ($valid_cells as $key => $value) {		
				$arr_field_val[$value] = $row[$key];
			}

			// fixed column to be inserted
			$arr_field_val['active'] = 1;
			
			$this->db->insert('partners_employment_type',$arr_field_val);
		}

		echo "Done.";	
	}

	function import_employment_status(){
		$this->db->truncate('partners_employment_status');

		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {														
							case 'Employment Status':
								$valid_cells[] = 'employment_status';
								break;																						
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}


		$ctr = 0;

		// Remove non-matching cells.
		foreach ($import_data as $row) {		
			$arr_field_val = array();
			foreach ($valid_cells as $key => $value) {		
				$arr_field_val[$value] = $row[$key];
			}

			// fixed column to be inserted
			$arr_field_val['active'] = 1;
			
			$this->db->insert('partners_employment_status',$arr_field_val);
		}

		echo "Done.";	
	}

	function import_position(){
		$this->db->truncate('users_position');

		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {														
							case 'Position':
								$valid_cells[] = 'position';
								break;
							case 'Position Code':
								$valid_cells[] = 'position_code';
								break;
							case 'Employee Type':
								$valid_cells[] = 'employee_type_id';
								break;
							case 'Immediate Head ID Number':
								$valid_cells[] = 'immediate_id';
								break;																							
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}


		$ctr = 0;

		// Remove non-matching cells.
		foreach ($import_data as $row) {		
			$arr_field_val = array();
			foreach ($valid_cells as $key => $value) {
				switch ($value) {
					case 'employee_type_id':
						$result = $this->db->get_where('partners_employment_type',array('employment_type' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_employment_type = $result->row();
							$row[$key] = $row_employment_type->employment_type_id;						
						}
						else{
							$row[$key] = '';
						}
						break;
					case 'immediate_id':
						$result = $this->db->get_where('partners',array('id_number' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_partners = $result->row();
							$row[$key] = $row_partners->user_id;						
						}
						else{
							$row[$key] = '';
						}
						break;	
					case 'position_code':
						if ($row[$key] == '')
							$row[$key] = '';
						break;
				}			
				$arr_field_val[$value] = $row[$key];
			}

			// fixed column to be inserted
			$arr_field_val['status_id'] = 1;

			$this->db->insert('users_position',$arr_field_val);
		}

		echo "Done.";	
	}

	function import_location(){
		$this->db->truncate('users_location');

		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'Location':
								$valid_cells[] = 'location';
								break;
							case 'Location Code':
								$valid_cells[] = 'location_code';
								break;
							case 'Minimum Wage':
								$valid_cells[] = 'min_wage_amt';
								break;
							case 'Ecola Per Day':
								$valid_cells[] = 'ecola_amt';
								break;
							case 'Ecola Per Month':
								$valid_cells[] = 'ecola_amt_month';
								break;								
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}


		$ctr = 0;

		// Remove non-matching cells.
		foreach ($import_data as $row) {		
			$arr_field_val = array();
			foreach ($valid_cells as $key => $value) {	
				switch ($value) {
					case 'location_code':
						if ($row[$key] == '')
							$row[$key] = '';
						break;
				}	

				$arr_field_val[$value] = $row[$key];
			}

			// fixed column to be inserted
			$arr_field_val['status_id'] = 1;

			$this->db->insert('users_location',$arr_field_val);

		}

		echo "Done.";	
	}	

	function import_department(){
		$this->db->truncate('users_department');

		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {							
							case 'Department':
								$valid_cells[] = 'department';
								break;							
							case 'Department Code':
								$valid_cells[] = 'department_code';
								break;
							case 'Division':
								$valid_cells[] = 'division_id';
								break;								
							case 'Immediate Head ID Number':
								$valid_cells[] = 'immediate_id';
								break;																
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}


		$ctr = 0;

		// Remove non-matching cells.
		foreach ($import_data as $row) {		
			$arr_field_val = array();
			foreach ($valid_cells as $key => $value) {	
				switch ($value) {	
					case 'division_id':
						$result = $this->db->get_where('users_division',array('division' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$division = $result->row();
							$row[$key] = $division->division_id;						
						}
						else{
							$row[$key] = '';
						}
						break;							
					case 'immediate_id':
						$result = $this->db->get_where('partners',array('id_number' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_partners = $result->row();
							$row[$key] = $row_partners->user_id;						
						}
						else{
							$row[$key] = '';
						}
						break;														
				}								
				$arr_field_val[$value] = $row[$key];
			}

			// fixed column to be inserted
			$arr_field_val['status_id'] = 1;

			$this->db->insert('users_department',$arr_field_val);

		}

		echo "Done.";	
	}		

	function import_section(){
		$this->db->truncate('users_section');

		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'Section':
								$valid_cells[] = 'section';
								break;							
							case 'Section Code':
								$valid_cells[] = 'section_code';
								break;							
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}


		$ctr = 0;

		// Remove non-matching cells.
		foreach ($import_data as $row) {		
			$arr_field_val = array();
			foreach ($valid_cells as $key => $value) {					
				$arr_field_val[$value] = $row[$key];
			}

			// fixed column to be inserted
			$arr_field_val['status_id'] = 1;

			$this->db->insert('users_section',$arr_field_val);
		}

		echo "Done.";	
	}	

	function import_branch(){
		$this->db->truncate('users_branch');

		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'Branch':
								$valid_cells[] = 'branch';
								break;							
							case 'Branch Code':
								$valid_cells[] = 'branch_code';
								break;		
							case 'SSS Branch Code':
								$valid_cells[] = 'sss_branch_code';
								break;
							case 'SSS Branch Code Locator':
								$valid_cells[] = 'sss_branch_code_locator';
								break;
							case 'PAG-IBIG Branch Code':
								$valid_cells[] = 'hdmf_branch_code';
								break;
							case 'Company Name to Appear on COE':
								$valid_cells[] = 'company_coe';
								break;								
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}


		$ctr = 0;

		// Remove non-matching cells.
		foreach ($import_data as $row) {		
			$arr_field_val = array();
			foreach ($valid_cells as $key => $value) {					
				$arr_field_val[$value] = $row[$key];
			}

			$this->db->insert('users_branch',$arr_field_val);
		}

		echo "Done.";	
	}

	function import_job_level(){
		$this->db->truncate('users_job_grade_level');

		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'Job Level':
								$valid_cells[] = 'job_level';
								break;							
							case 'Job Level Code':
								$valid_cells[] = 'job_grade_code';
								break;							
							case 'Payroll Class':
								$valid_cells[] = 'payroll_class';
								break;															
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}


		$ctr = 0;

		// Remove non-matching cells.
		foreach ($import_data as $row) {		
			$arr_field_val = array();
			foreach ($valid_cells as $key => $value) {					
				$arr_field_val[$value] = $row[$key];
			}

			// fixed column to be inserted
			$arr_field_val['status_id'] = 1;

			$this->db->insert('users_job_grade_level',$arr_field_val);
		}

		echo "Done.";	
	}

	function import_shift(){
		$this->db->where('shift_id >',1);
		$this->db->delete('time_shift');
		$this->db->query("ALTER TABLE time_shift AUTO_INCREMENT = 2");
		// $this->db->truncate('timekeeping_shift');

		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'Company':
								$valid_cells[] = 'company_id';
								break;								
							case 'Shift Name':
								$valid_cells[] = 'shift';
								break;	
							case 'From':
								$valid_cells[] = 'time_start';
								break;
							case 'To':
								$valid_cells[] = 'time_end';
								break;													
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}


		$ctr = 0;

		// Remove non-matching cells.
		foreach ($import_data as $row) {		
			$arr_field_val = array();
			foreach ($valid_cells as $key => $value) {
				if ($value == 'time_start' || $value == 'time_end'){
					$row[$key] = PHPExcel_Style_NumberFormat::toFormattedString($row[$key], 'H:i');
					if ($row[$key] == NULL){
						$row[$key] = '';
					}
				}
				elseif ($value == 'company_id'){
					$result = $this->db->get_where('users_company',array('company' => $row[$key]));
					if ($result && $result->num_rows() > 0){
						$row_company = $result->row();
						$row[$key] = $row_company->company_id;						
					}
					else{
						$row[$key] = '';
					}
				}

				$arr_field_val[$value] = $row[$key];
			}

			$this->db->insert('time_shift',$arr_field_val);
		}

		echo "Done.";	
	}	

	function import_education_master(){
		$this->db->truncate('users_education_school');
		$this->db->truncate('users_educational_attainment');
		$this->db->truncate('users_education_degree_obtained');

		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'Educational Attainment':
								$valid_cells[] = 'educational_attainment';
								break;
							case 'School':
								$valid_cells[] = 'education_school';
								break;
							case 'Degree Obtained':
								$valid_cells[] = 'education_degree_obtained';
								break;
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}


		$ctr = 0;

		// Remove non-matching cells.
		foreach ($import_data as $row) {		
			foreach ($valid_cells as $key => $value) {
				switch ($value) {
					case 'educational_attainment':
						if ($row[$key] != '') {
							$arr_field_val = array('status_id' => 1);
							$arr_field_val[$value] = $row[$key];
							$this->db->insert('users_educational_attainment',$arr_field_val);
						}
						break;
					case 'education_school':
						if ($row[$key] != '') {
							$arr_field_val = array('status_id' => 1);
							$arr_field_val[$value] = $row[$key];
							$this->db->insert('users_education_school',$arr_field_val);
						}
						break;		
					case 'education_degree_obtained':
						if ($row[$key] != '') {
							$arr_field_val = array('status_id' => 1);
							$arr_field_val[$value] = $row[$key];
							$this->db->insert('users_education_degree_obtained',$arr_field_val);
						}
						break;
				}	
				
			}
		}

		echo "Done.";	
	}

	function import_employment(){
		$this->db->where('user_id >',1);
		$this->db->delete('users');
		$this->db->query("ALTER TABLE ww_users AUTO_INCREMENT = 2");

		$this->db->where('user_id >',1);
		$this->db->delete('users_profile');
		$this->db->query("ALTER TABLE ww_users_profile AUTO_INCREMENT = 2");	

		$this->db->where('partner_id >',1);
		$this->db->delete('partners');
		$this->db->query("ALTER TABLE ww_partners AUTO_INCREMENT = 2");	
		
		//$this->db->truncate('partners');

		//$this->db->truncate('employee_dtr_setup');

		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'ID Number':
								$valid_cells_users[] = 'login';
								break;		
							case 'Company':
								$valid_cells_users[1] = 'company_id';
								break;	
							case 'Salutation':
								$valid_cells_users_profile[2] = 'title';
								break;
							case 'Last Name':
								$valid_cells_users_profile[3] = 'lastname';
								break;								
							case 'First Name':
								$valid_cells_users_profile[4] = 'firstname';
								break;	
							case 'Middle Name':
								$valid_cells_users_profile[5] = 'middlename';
								break;
							case 'Middle Initial':
								$valid_cells_users_profile[6] = 'middleinitial';
								break;
							case 'Suffix':
								$valid_cells_users_profile[7] = 'suffix';
								break;
							case 'Maiden Name':
								$valid_cells_users_profile[8] = 'maidenname';
								break;
							case 'Nick Name':
								$valid_cells_users_profile[9] = 'nickname';
								break;
							case 'Specialization':
								$valid_cells_users_profile[10] = 'specialization_id';
								break;		
							case 'Location':
								$valid_cells_users_profile[11] = 'location_id';
								break;	
							case 'Position Title':
								$valid_cells_users_profile[12] = 'position_id';
								break;	
							case 'Role':
								$valid_cells_users[13] = 'role_id';
								break;
							case 'Work Schedule':
								$valid_cells_partners[14] = 'calendar_id';
								break;
							case 'Status':
								$valid_cells_partners[15] = 'status_id';
								break;	
							case 'Level':
								$valid_cells_partners[16] = 'employment_type_id';
								break;	
							case 'Rank':
								$valid_cells_partners[17] = 'job_grade_id';
								break;	
							case 'Classification':
								$valid_cells_partners[18] = 'classification_id';
								break;	
							case 'Hired Date':
								$valid_cells_partners[19] = 'effectivity_date';
								break;	
							case 'Employment End Date':
								$valid_cells_partners[20] = 'employment_end_date';
								break;
							case 'Regularization Date':
								$valid_cells_partners[21] = 'regularization_date';
								break;																
							case 'Original Hired Date':
								$valid_cells_partners[22] = 'original_hired_date';
								break;
							case 'Immediate Superior ID Number':
								$valid_cells_users_profile[23] = 'reports_to_id';
								break;	
							case 'Division':
								$valid_cells_users_profile[24] = 'division_id';
								break;	
							case 'Department':
								$valid_cells_users_profile[25] = 'department_id';
								break;
							case 'SBU Unit':
								$valid_cells_users_profile[26] = 'sbu_unit_id';
								break;		
							case 'Section':
								$valid_cells_users_profile[27] = 'section_id';
								break;								
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}


/*		dbug($import_data[1]);
		dbug($valid_cells_user);
		dbug($valid_cells_dtr_setup);
		dbug($valid_cells_employee);
		die();*/

		$ctr = 0;
		foreach ($import_data as $row) {		
			$arr_field_val = array();
			$company_id_gen = 0;
			foreach ($valid_cells_users as $key => $value) {
				switch ($value) {				
					case 'company_id':
						$result = $this->db->get_where('users_company',array('company' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$company = $result->row();
							$row[$key] = $company->company_id;						
							$company_id_gen = $company->company_id;
						}
						else{
							$this->db->insert('users_company',array('company' => $row[$key]));
							$row[$key] = $this->db->insert_id();
						}
						break;					
					case 'role_id':
						$result = $this->db->get_where('roles',array('role' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_role = $result->row();
							$row[$key] = $row_role->role_id;						
						}
						else{
							$row[$key] = '';
						}
						break;
					default:
						if ($row[$key] == ''){
							$row[$key] = '';
						}
						break;												
				}
				$arr_field_val[$value] = $row[$key];
			}

			// fix column
			$arr_field_val['active'] = 1;

			$this->db->insert('users',$arr_field_val);
			$user_id = $this->db->insert_id();	

			/********************************************************************/
			$arr_field_val = array();
			foreach ($valid_cells_partners as $key => $value) {
				switch ($value) {
					case 'calendar_id':
						$result = $this->db->get_where('time_shift_weekly',array('calendar' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_shift = $result->row();
							$row[$key] = $row_shift->calendar_id;						
						}
						else{
							$row[$key] = '';
						}
						break;
					case 'status_id':
						$result = $this->db->get_where('partners_employment_status',array('employment_status' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_employment_status = $result->row();
							$row[$key] = $row_employment_status->employment_status_id;						
						}
						else{
							$row[$key] = '';
						}
						break;												
					case 'employment_type_id':
						$result = $this->db->get_where('partners_employment_type',array('employment_type' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_employment_type = $result->row();
							$row[$key] = $row_employment_type->employment_type_id;						
						}
						else{
							$this->db->insert('partners_employment_type',array('employment_type' => $row[$key]));
							$row[$key] = $this->db->insert_id();
						}
						break;
					case 'job_grade_id':
						$result = $this->db->get_where('users_job_grade_level',array('job_level' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_job_level = $result->row();
							$row[$key] = $row_job_level->job_grade_id;						
						}
						else{
							$row[$key] = '';
						}
						break;
					case 'classification_id':
						$result = $this->db->get_where('partners_classification',array('classification' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_classification = $result->row();
							$row[$key] = $row_classification->classification_id;						
						}
						else{
							$row[$key] = '';
						}
						break;							
					case 'effectivity_date':
					case 'employment_end_date':
					case 'original_hired_date':
					case 'regularization_date':
						if ($row[$key] != ''){
							//$row[$key] = date ( 'Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($row[$key]));
							$row[$key] = date ( 'Y-m-d', strtotime($row[$key]));
						}
						else{
							$row[$key] = '';
						}
						break;																	
				}
				$arr_field_val[$value] = $row[$key];
			}	

			// fix column
			$arr_field_val['user_id'] = $user_id;
			$arr_field_val['id_number'] = $row[0];
			$arr_field_val['biometric'] = $row[0];

			$this->db->insert('partners',$arr_field_val);	
			$partners_id = $this->db->insert_id();

			/********************************************************************/
			$arr_field_val = array();
			foreach ($valid_cells_users_profile as $key => $value) {
				switch ($value) {
					case 'specialization_id':
						$result = $this->db->get_where('users_specialization',array('specialization' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$specialization = $result->row();
							$row[$key] = $specialization->specialization_id;						
						}
						else{
							$row[$key] = '';
						}
						break;	
					case 'location_id':
						$result = $this->db->get_where('users_location',array('location' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_location = $result->row();
							$row[$key] = $row_location->location_id;						
						}
						else{
							$this->db->insert('users_location',array('location' => $row[$key]));
							$row[$key] = $this->db->insert_id();
						}
						break;
					case 'position_id':
						$result = $this->db->get_where('users_position',array('position' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_position = $result->row();
							$row[$key] = $row_position->position_id;						
						}
						else{
							$this->db->insert('users_position',array('position' => $row[$key]));
							$row[$key] = $this->db->insert_id();
						}
						break;	
					case 'reports_to_id':
						$result = $this->db->get_where('partners',array('id_number' => trim($row[$key])));
						if ($result && $result->num_rows() > 0){
							$row_partners = $result->row();
							$row[$key] = $row_partners->user_id;						
						}
						else{
							$row[$key] = '';
						}
						break;	
					case 'division_id':
						$result = $this->db->get_where('users_division',array('division' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_division = $result->row();
							$row[$key] = $row_division->division_id;						
						}
						else{
							$this->db->insert('users_division',array('division' => $row[$key]));
							$row[$key] = $this->db->insert_id();
						}
						break;	
					case 'department_id':
						$result = $this->db->get_where('users_department',array('department' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_department = $result->row();
							$row[$key] = $row_department->department_id;						
						}
						else{
							$this->db->insert('users_department',array('department' => $row[$key]));
							$row[$key] = $this->db->insert_id();
						}
						break;		
					case 'sbu_unit_id':
						$result = $this->db->get_where('sbu_unit',array('sbu_unit' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_sbu_unit = $result->row();
							$row[$key] = $row_sbu_unit->sbu_unit_id;						
						}
						else{
							$row[$key] = '';
						}
						break;
					case 'section_id':
						$result = $this->db->get_where('users_section',array('section' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_section = $result->row();
							$row[$key] = $row_section->section_id;						
						}
						else{
							$row[$key] = '';
						}
						break;				
				}

				$arr_field_val[$value] = $row[$key];
			}

			// fix column
			$arr_field_val['user_id'] = $user_id;
			$arr_field_val['company_id'] = $company_id_gen;
			$arr_field_val['partner_id'] = $partners_id;

			$this->db->insert('users_profile',$arr_field_val);		
		}

		echo "Done.";	
	}

	function import_reports_to(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'ID Number':
								$valid_cells[] = 'id_number';
								break;
							case 'Immediate Superior ID Number':
								$valid_cells[] = 'reports_to_id';
								break;									
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}

		$ctr = 0;
		foreach ($import_data as $row) {	
			$partner_result = $this->db->get_where('partners',array('id_number' => $row[0]));
			if ($partner_result && $partner_result->num_rows() > 0){
				$partner = $partner_result->row();
				$partner_id = $partner->partner_id;
				$user_id = $partner->user_id;
			}

			$arr_field_val = array();
			foreach ($valid_cells as $key => $value) {
					if ($row[$key] != '' && $value != 'id_number'){
						$result = $this->db->get_where('partners',array('id_number' => trim($row[$key])));
						if ($result && $result->num_rows() > 0){
							$row_partners = $result->row();
							$row[$key] = $row_partners->user_id;						
						}
						else{
							$row[$key] = '';
						}

						$arr_field_val[$value] = $row[$key];			
					}
			}

			$this->db->where('user_id',$user_id);
			$this->db->update('users_profile',$arr_field_val);

		}

		echo "Done.";	
	}	

	function import_sbu_unit(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'ID Number':
								$valid_cells[] = 'id_number';
								break;
							case 'SBU Unit':
								$valid_cells[] = 'sbu_unit_id';
								break;									
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}

		$ctr = 0;
		foreach ($import_data as $row) {	
			$partner_result = $this->db->get_where('partners',array('id_number' => $row[0]));
			if ($partner_result && $partner_result->num_rows() > 0){
				$partner = $partner_result->row();
				$partner_id = $partner->partner_id;
				$user_id = $partner->user_id;
			}

			$arr_field_val = array();
			foreach ($valid_cells as $key => $value) {
				if ($row[$key] != '' && $value != 'id_number'){
					$result = $this->db->get_where('users_sbu_unit',array('sbu_unit' => $row[$key]));
					if ($result && $result->num_rows() > 0){
						$row_sbu_unit = $result->row();
						$row[$key] = $row_sbu_unit->sbu_unit_id;						
					}
					else{
						$this->db->insert('users_sbu_unit',array('sbu_unit' => $row[$key]));
						$row[$key] = $this->db->insert_id();
					}

					$arr_field_val[$value] = $row[$key];				
				}
			}

			$this->db->where('user_id',$user_id);
			$this->db->update('users_profile',$arr_field_val);
		}

		echo "Done.";	
	}

	function import_contact_no(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'ID Number':
								$valid_cells[] = 'id_number';
								break;
							case 'Present Address':
								$valid_cells[] = 'address_1';
								break;
							case 'Present City/Town':
								$valid_cells[] = 'city_town';
								break;
							case 'Present Country':
								$valid_cells[] = 'country';
								break;
							case 'Present Zip Code':
								$valid_cells[] = 'zip_code';
								break;
							case 'Permanent Address':
								$valid_cells[] = 'permanent_address';
								break;
							case 'Permanent City/Town':
								$valid_cells[] = 'permanent_city_town';
								break;
							case 'Permanent Country':
								$valid_cells[] = 'permanent_country';
								break;
							case 'Permanent Zip Code':
								$valid_cells[] = 'permanent_zipcode';
								break;								
							case 'Office Phone':
								$valid_cells[] = 'phone';
								break;								
							case 'Office Mobile':
								$valid_cells[] = 'mobile';
								break;	
							case 'Office E-mail':
								$valid_cells[] = 'email';
								break;
							case 'Personal Phone':
								$valid_cells[] = 'personal_phone';
								break;								
							case 'Personal Mobile':
								$valid_cells[] = 'personal_mobile';
								break;	
							case 'Personal E-mail':
								$valid_cells[] = 'personal_email';
								break;									
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}

		$ctr = 0;
		foreach ($import_data as $row) {		
			$partner_result = $this->db->get_where('partners',array('id_number' => $row[0]));
			if ($partner_result && $partner_result->num_rows() > 0){
				$partner = $partner_result->row();
				$partner_id = $partner->partner_id;
				$user_id = $partner->user_id;
			}

			$arr_field_val = array();
			foreach ($valid_cells as $key => $value) {
				if ($row[$key] != '' && $value != 'id_number' && $value != 'email'){
					switch ($value) {
						case 'city_town':
						case 'permanent_city_town':
							$result = $this->db->get_where('cities',array('city' => $row[$key]));
							if ($result && $result->num_rows() > 0){
								$cities = $result->row();
								$row[$key] = $cities->city_id;						
							}
							else{
								$this->db->insert('cities',array('city' => $row[$key]));
								$row[$key] = $this->db->insert_id();
							}
							break;	
						case 'country':
						case 'permanent_country':
							$result = $this->db->get_where('countries',array('short_name' => $row[$key]));
							if ($result && $result->num_rows() > 0){
								$row_countries = $result->row();
								$row[$key] = $row_countries->country_id;						
							}
							else{
								$this->db->insert('countries',array('short_name' => $row[$key]));
								$row[$key] = $this->db->insert_id();
							}
							break;
					}

					$result = $this->db->get_where('partners_key',array('key_code' => $value));
					if ($result && $result->num_rows() > 0){
						$row_key = $result->row();
						$arr_field_val['partner_id'] = $partner_id;
						$arr_field_val['key_id'] = $row_key->key_id;
						$arr_field_val['key'] = $row_key->key_code;
						$arr_field_val['key_name'] = $row_key->key_label;
						$arr_field_val['key_value'] = $row[$key];
					}

					$this->db->where('partner_id',$partner_id);
					$this->db->where('key_id',$row_key->key_id);
					$this->db->delete('partners_personal');

					$this->db->insert('partners_personal',$arr_field_val);					
				}



				if ($row[$key] != '' && $value == 'email'){
					$this->db->where('user_id',$user_id);
					$this->db->update('users',array('email' => $row[$key]));
				}
			}		
		}

		echo "Done.";	
	}	

	function import_emergency_contact(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {
				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'ID Number':
								$valid_cells[] = 'id_number';
								break;
							case 'Name':
								$valid_cells[] = 'emergency_name';
								break;	
							case 'Relationship':
								$valid_cells[] = 'emergency_relationship';
								break;	
							case 'Phone':
								$valid_cells[] = 'emergency_phone';
								break;	
							case 'Mobile':
								$valid_cells[] = 'emergency_mobile';
								break;	
							case 'Address':
								$valid_cells[] = 'emergency_address';
								break;	
							case 'City/Town':
								$valid_cells[] = 'emergency_city';
								break;	
							case 'Country':
								$valid_cells[] = 'emergency_country';
								break;
							case 'Zipcode':
								$valid_cells[] = 'emergency_zip_code';
								break;								
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}

		$ctr = 0;
		foreach ($import_data as $row) {	
			$partner_result = $this->db->get_where('partners',array('id_number' => $row[0]));
			if ($partner_result && $partner_result->num_rows() > 0){
				$partner = $partner_result->row();
				$partner_id = $partner->partner_id;
				$user_id = $partner->user_id;
			}

			$arr_field_val = array();
			foreach ($valid_cells as $key => $value) {
				if ($row[$key] != '' && $value != 'id_number'){
					switch ($value) {
						case 'emergency_city':
							$result = $this->db->get_where('cities',array('city' => $row[$key]));
							if ($result && $result->num_rows() > 0){
								$cities = $result->row();
								$row[$key] = $cities->city_id;						
							}
							else{
								$this->db->insert('cities',array('city' => $row[$key]));
								$row[$key] = $this->db->insert_id();
							}
							break;	
						case 'emergency_country':
							$result = $this->db->get_where('countries',array('short_name' => $row[$key]));
							if ($result && $result->num_rows() > 0){
								$row_countries = $result->row();
								$row[$key] = $row_countries->country_id;						
							}
							else{
								$this->db->insert('countries',array('short_name' => $row[$key]));
								$row[$key] = $this->db->insert_id();
							}
							break;
					}

					$result = $this->db->get_where('partners_key',array('key_code' => $value));
					if ($result && $result->num_rows() > 0){
						$row_key = $result->row();
						$arr_field_val['partner_id'] = $partner_id;
						$arr_field_val['key_id'] = $row_key->key_id;
						$arr_field_val['key'] = $row_key->key_code;
						$arr_field_val['key_name'] = $row_key->key_label;
						$arr_field_val['key_value'] = $row[$key];
					}

					$this->db->where('partner_id',$partner_id);
					$this->db->where('key_id',$row_key->key_id);
					$this->db->delete('partners_personal');

					$this->db->insert('partners_personal',$arr_field_val);					
				}	
			}
		}

		echo "Done.";	
	}	

	function import_personal_info(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'ID Number':
								$valid_cells[] = 'id_number';
								break;
							case 'Gender':
								$valid_cells[] = 'gender';
								break;									
							case 'Date of Birth':
								$valid_cells[] = 'birth_date';
								break;	
							case 'Birth Place':
								$valid_cells[] = 'birth_place';
								break;	
							case 'Religion':
								$valid_cells[] = 'religion';
								break;
							case 'Nationality':
								$valid_cells[] = 'nationality';
								break;								
							case 'Civil Status':
								$valid_cells[] = 'civil_status';
								break;
							case 'Solo Parent':
								$valid_cells[] = 'solo_parent';
								break;								
							case 'Height':
								$valid_cells[] = 'height';
								break;
							case 'Weight':
								$valid_cells[] = 'weight';
								break;
							case 'Interests/Hobbies':
								$valid_cells[] = 'interests_hobbies';
								break;
							case 'Language Known':
								$valid_cells[] = 'language';
								break;
							case 'Dialect Known':
								$valid_cells[] = 'dialect';
								break;
							case 'Number of Dependents':
								$valid_cells[] = 'dependents_count';
								break;
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}

		$ctr = 0;
		foreach ($import_data as $row) {	
			$partner_result = $this->db->get_where('partners',array('id_number' => $row[0]));
			if ($partner_result && $partner_result->num_rows() > 0){
				$partner = $partner_result->row();
				$partner_id = $partner->partner_id;
				$user_id = $partner->user_id;
			}

			$arr_field_val = array();
			$arr_field_val_user = array();
			foreach ($valid_cells as $key => $value) {
				if ($value == 'birth_date') {
					//$arr_field_val_user[$value] = date ( 'Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($row[$key]));
					$arr_field_val_user[$value] = date ( 'Y-m-d', strtotime($row[$key]));
				}
				else{
					if ($row[$key] != '' && $value != 'id_number'){
						switch ($value) {
							case 'solo_parent':
								$row[$key] = (strtolower($row[$key]) == 'yes' ? 1 : 0);
								break;
							case 'religion':
								$result = $this->db->get_where('religion',array('religion' => $row[$key]));
								if ($result && $result->num_rows() > 0){
									$row_religion = $result->row();
									$row[$key] = $row_religion->religion_id;						
								}
								else{
									$this->db->insert('religion',array('religion' => $row[$key]));
									$row[$key] = $this->db->insert_id();
								}
								break;									
						}

						$result = $this->db->get_where('partners_key',array('key_code' => $value));
						if ($result && $result->num_rows() > 0){
							$row_key = $result->row();
							$arr_field_val['partner_id'] = $partner_id;
							$arr_field_val['key_id'] = $row_key->key_id;
							$arr_field_val['key'] = $row_key->key_code;
							$arr_field_val['key_name'] = $row_key->key_label;
							$arr_field_val['key_value'] = $row[$key];
						}

						$this->db->where('partner_id',$partner_id);
						$this->db->where('key_id',$row_key->key_id);
						$this->db->delete('partners_personal');

						$this->db->insert('partners_personal',$arr_field_val);					
					}					
				}
			}

			$this->db->where('user_id',$user_id);
			$this->db->update('users_profile',$arr_field_val_user);

		}

		echo "Done.";	
	}	

	function import_id_no(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'ID Number':
								$valid_cells[] = 'id_number';
								break;
							case 'Tax Code':
								$valid_cells[] = 'taxcode';
								break;								
							case 'SSS Number':
								$valid_cells[] = 'sss_number';
								break;	
							case 'Pag-Ibig Number':
								$valid_cells[] = 'pagibig_number';
								break;	
							case 'Philhealth Number':
								$valid_cells[] = 'philhealth_number';
								break;								
							case 'TIN':
								$valid_cells[] = 'tin_number';
								break;														
							case 'Payroll Bank Account Number':
								$valid_cells[] = 'payroll_bank_account_number';
								break;		
							case 'Payroll Bank Name':
								$valid_cells[] = 'payroll_bank_name';
								break;
							case 'Payroll Bank Account Name':
								$valid_cells[] = 'bank_account_name';
								break;								
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}

		$ctr = 0;
		foreach ($import_data as $row) {
			$partner_result = $this->db->get_where('partners',array('id_number' => $row[0]));
			if ($partner_result && $partner_result->num_rows() > 0){
				$partner = $partner_result->row();
				$partner_id = $partner->partner_id;
				$user_id = $partner->user_id;
			}

			$arr_field_val = array();
			foreach ($valid_cells as $key => $value) {
				if ($row[$key] != '' && $value != 'id_number'){
					switch ($value) {
						case 'taxcode':
							$result = $this->db->get_where('taxcode',array('taxcode' => $row[$key]));
							if ($result && $result->num_rows() > 0){
								$taxcode = $result->row();
								$row[$key] = $taxcode->taxcode_id;						
							}
							else{
								$row[$key] = '';
							}
							break;	
					}

					$result = $this->db->get_where('partners_key',array('key_code' => $value));
					if ($result && $result->num_rows() > 0){
						$row_key = $result->row();
						$arr_field_val['partner_id'] = $partner_id;
						$arr_field_val['key_id'] = $row_key->key_id;
						$arr_field_val['key'] = $row_key->key_code;
						$arr_field_val['key_name'] = $row_key->key_label;
						$arr_field_val['key_value'] = $row[$key];
					}

					$this->db->where('partner_id',$partner_id);
					$this->db->where('key_id',$row_key->key_id);
					$this->db->delete('partners_personal');

					$this->db->insert('partners_personal',$arr_field_val);					
				}
			}
		}

		echo "Done.";	
	}

	function import_family(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'ID Number':
								$valid_cells[] = 'id_number';
								break;
							case 'Relationship':
								$valid_cells[] = 'family-relationship';
								break;									
							case 'Name':
								$valid_cells[] = 'family-name';
								break;	
							case 'Birthday':
								$valid_cells[] = 'family-birthdate';
								break;	
							case 'Dependent on HMO':
								$valid_cells[] = 'family-dependent-hmo';
								break;
							case 'Dependent on Life Insurance':
								$valid_cells[] = 'family-dependent-insurance';
								break;
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}

		$ctr = 0;
		$seq = 0;		
		foreach ($import_data as $row) {	
			if (!isset($seq_arr['id_number'])) {
				$seq_arr['id_number'] = $row[0];	
				$seq++;			
			} 
			else {
				if ($seq_arr['id_number'] == $row[0])
					$seq++;
				else {
					$seq_arr['id_number'] = $row[0];
					$seq = 1;
				}
			}

			$partner_result = $this->db->get_where('partners',array('id_number' => $row[0]));
			if ($partner_result && $partner_result->num_rows() > 0){
				$partner = $partner_result->row();
				$partner_id = $partner->partner_id;
				$user_id = $partner->user_id;
			}

			$arr_field_val = array();
			$arr_field_val_user = array();
			foreach ($valid_cells as $key => $value) {
				if ($row[$key] != '' && $value != 'id_number'){
					switch ($value) {
						case 'family-dependent':
							$row[$key] = (strtolower($row[$key]) == 'yes' ? 1 : 0);
							break;
						case 'family-birthdate':
							//$row[$key] = date ( 'Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($row[$key]));
							$row[$key] = date ('F d, Y', strtotime($row[$key]));
							break;									
					}

					$result = $this->db->get_where('partners_key',array('key_code' => $value));
					if ($result && $result->num_rows() > 0){
						$row_key = $result->row();
						$arr_field_val['partner_id'] = $partner_id;
						$arr_field_val['key_id'] = $row_key->key_id;
						$arr_field_val['key'] = $row_key->key_code;
						$arr_field_val['sequence'] = $seq;
						$arr_field_val['key_name'] = $row_key->key_label;
						$arr_field_val['key_value'] = $row[$key];

						$this->db->where('partner_id',$partner_id);
						$this->db->where('key',$row_key->key_code);
						$this->db->where('sequence',$seq);
						$this->db->where('key_value',$row[$key]);
						$this->db->delete('partners_personal_history');							
					}

					$this->db->insert('partners_personal_history',$arr_field_val);					
				}					
			}
		}

		echo "Done.";	
	}	

	function import_education(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'ID Number':
								$valid_cells[] = 'id_number';
								break;
							case 'Category':
								$valid_cells[] = 'education-type';
								break;									
							case 'School':
								$valid_cells[] = 'education-school';
								break;	
							case 'Start Year':
								$valid_cells[] = 'education-year-from';
								break;	
							case 'End Year':
								$valid_cells[] = 'education-year-to';
								break;	
							case 'Degree':
								$valid_cells[] = 'education-degree';
								break;
							case 'Honors Receive':
								$valid_cells[] = 'education-honors_awards';
								break;								
							case 'Status':
								$valid_cells[] = 'education-status';
								break;
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}

		$ctr = 0;
		$seq = 0;		
		foreach ($import_data as $row) {	
			if (!isset($seq_arr['id_number'])) {
				$seq_arr['id_number'] = $row[0];	
				$seq++;			
			} 
			else {
				if ($seq_arr['id_number'] == $row[0])
					$seq++;
				else {
					$seq_arr['id_number'] = $row[0];
					$seq = 1;
				}
			}

			$partner_result = $this->db->get_where('partners',array('id_number' => $row[0]));
			if ($partner_result && $partner_result->num_rows() > 0){
				$partner = $partner_result->row();
				$partner_id = $partner->partner_id;
				$user_id = $partner->user_id;
			}

			$arr_field_val = array();
			$arr_field_val_user = array();
			foreach ($valid_cells as $key => $value) {
				if ($row[$key] != '' && $value != 'id_number'){
					switch ($value) {
						case 'education-status':
							if (strtolower($row[$key]) == 'graduate')
								$row[$key] = 'Graduated';
							elseif (strtolower($row[$key]) == 'undergraduate')
								$row[$key] = 'Undergrad';
							break;								
						case 'education-degree':
							$result = $this->db->get_where('users_education_degree_obtained',array('education_degree_obtained' => $row[$key]));
							if ($result && $result->num_rows() > 0){
								$education_degree_obtained = $result->row();
								$row[$key] = $education_degree_obtained->education_degree_obtained_id;						
							}
							else{
								$row[$key] = '';
							}
							break;
						case 'education-school':
							$result = $this->db->get_where('users_education_school',array('education_school' => $row[$key]));
							if ($result && $result->num_rows() > 0){
								$education_school = $result->row();
								$row[$key] = $education_school->education_school_id;						
							}
							else{
								$row[$key] = '';
							}
							break;							
					}
					$result = $this->db->get_where('partners_key',array('key_code' => $value));
					if ($result && $result->num_rows() > 0){
						$row_key = $result->row();
						$arr_field_val['partner_id'] = $partner_id;
						$arr_field_val['key_id'] = $row_key->key_id;
						$arr_field_val['key'] = $row_key->key_code;
						$arr_field_val['sequence'] = $seq;
						$arr_field_val['key_name'] = $row_key->key_label;
						$arr_field_val['key_value'] = $row[$key];

						$this->db->where('partner_id',$partner_id);
						$this->db->where('key',$row_key->key_code);
						$this->db->where('sequence',$seq);
						$this->db->where('key_value',$row[$key]);
						$this->db->delete('partners_personal_history');							
					}

					$this->db->insert('partners_personal_history',$arr_field_val);					
				}					
			}
		}

		echo "Done.";	
	}

	function import_employment_history(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'ID Number':
								$valid_cells[] = 'id_number';
								break;
							case 'Company Name':
								$valid_cells[] = 'employment-company';
								break;									
							case 'Position Title':
								$valid_cells[] = 'employment-position-title';
								break;	
							case 'Location':
								$valid_cells[] = 'employment-location';
								break;
							case 'Reason for Leaving':
								$valid_cells[] = 'employment-reason-for-leaving';
								break;
							case 'Latest Salary':
								$valid_cells[] = 'employment-latest-salary';
								break;
							case 'Name of Immediate Superior':
								$valid_cells[] = 'employment-supervisor';
								break;
							case 'Hired Date':
								$valid_cells[] = 'employment-month-hired';
								break;	
							case 'End Date':
								$valid_cells[] = 'employment-month-end';
								break;
							case 'Duties and Responsibilities':
								$valid_cells[] = 'employment-duties';
								break;
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}

		$ctr = 0;
		$seq = 0;		
		foreach ($import_data as $row) {	
			if (!isset($seq_arr['id_number'])) {
				$seq_arr['id_number'] = $row[0];	
				$seq++;			
			} 
			else {
				if ($seq_arr['id_number'] == $row[0])
					$seq++;
				else {
					$seq_arr['id_number'] = $row[0];
					$seq = 1;
				}
			}

			$partner_result = $this->db->get_where('partners',array('id_number' => $row[0]));
			if ($partner_result && $partner_result->num_rows() > 0){
				$partner = $partner_result->row();
				$partner_id = $partner->partner_id;
				$user_id = $partner->user_id;
			}

			$arr_field_val = array();
			$arr_field_val_user = array();
			foreach ($valid_cells as $key => $value) {
				if ($row[$key] != '' && $value != 'id_number'){
					switch ($value) {
						case 'employment-month-hired':
							$year_month_arr = explode('-', $row[$key]);
							if (count($year_month_arr) > 1) {
								$month = trim($year_month_arr[0]);
								$year = trim($year_month_arr[1]);
							} else {
								$month = date('F',strtotime($row[$key]));
								$year = date('Y',strtotime($row[$key]));
							}
							$row[$key] = $month;
							break;
						case 'employment-month-end':
							$year_month_arr = explode('-', $row[$key]);
							if (count($year_month_arr) > 1) {
								$month = trim($year_month_arr[0]);
								$year = trim($year_month_arr[1]);
							} else {
								$month = date('F',strtotime($row[$key]));								
								$year = date('Y',strtotime($row[$key]));
							}
							$row[$key] = $month;
							break;															
					}

					$result = $this->db->get_where('partners_key',array('key_code' => $value));
					if ($result && $result->num_rows() > 0){
						$row_key = $result->row();
						$arr_field_val['partner_id'] = $partner_id;
						$arr_field_val['key_id'] = $row_key->key_id;
						$arr_field_val['key'] = $row_key->key_code;
						$arr_field_val['sequence'] = $seq;
						$arr_field_val['key_name'] = $row_key->key_label;
						$arr_field_val['key_value'] = $row[$key];

						$this->db->where('partner_id',$partner_id);
						$this->db->where('key',$row_key->key_code);
						$this->db->where('sequence',$seq);
						$this->db->where('key_value',$row[$key]);
						$this->db->delete('partners_personal_history');							
					}

					$this->db->insert('partners_personal_history',$arr_field_val);	

					switch ($value) {
						case 'employment-month-hired':
							$result = $this->db->get_where('partners_key',array('key_code' => 'employment-year-hired'));
							if ($result && $result->num_rows() > 0){
								$row_key = $result->row();
								$arr_field_val['partner_id'] = $partner_id;
								$arr_field_val['key_id'] = $row_key->key_id;
								$arr_field_val['key'] = $row_key->key_code;
								$arr_field_val['sequence'] = $seq;
								$arr_field_val['key_name'] = $row_key->key_label;
								$arr_field_val['key_value'] = $year;

								$this->db->where('partner_id',$partner_id);
								$this->db->where('key',$row_key->key_code);
								$this->db->where('sequence',$seq);
								$this->db->where('key_value',$year);
								$this->db->delete('partners_personal_history');		

								$this->db->insert('partners_personal_history',$arr_field_val);						
							}
							break;
						case 'employment-month-end':
							$result = $this->db->get_where('partners_key',array('key_code' => 'employment-year-end'));
							if ($result && $result->num_rows() > 0){
								$row_key = $result->row();
								$arr_field_val['partner_id'] = $partner_id;
								$arr_field_val['key_id'] = $row_key->key_id;
								$arr_field_val['key'] = $row_key->key_code;
								$arr_field_val['sequence'] = $seq;
								$arr_field_val['key_name'] = $row_key->key_label;
								$arr_field_val['key_value'] = $year;

								$this->db->where('partner_id',$partner_id);
								$this->db->where('key',$row_key->key_code);
								$this->db->where('sequence',$seq);
								$this->db->where('key_value',$year);
								$this->db->delete('partners_personal_history');		

								$this->db->insert('partners_personal_history',$arr_field_val);						
							}
							break;															
					}			
				}					
			}
		}

		echo "Done.";	
	}

	function import_character_reference(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'ID Number':
								$valid_cells[] = 'id_number';
								break;
							case 'Name':
								$valid_cells[] = 'reference-name';
								break;									
							case 'Occupation':
								$valid_cells[] = 'reference-occupation';
								break;	
							case 'Years Known':
								$valid_cells[] = 'reference-years-known';
								break;	
							case 'Phone':
								$valid_cells[] = 'reference-phone';
								break;	
							case 'Mobile':
								$valid_cells[] = 'reference-mobile';
								break;
							case 'Address':
								$valid_cells[] = 'reference-address';
								break;
							case 'City/Town':
								$valid_cells[] = 'reference-city';
								break;		
							case 'Country':
								$valid_cells[] = 'reference-country';
								break;
							case 'Zipcode':
								$valid_cells[] = 'reference-zipcode';
								break;								
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}

		$ctr = 0;
		$seq = 0;		
		foreach ($import_data as $row) {	
			if (!isset($seq_arr['id_number'])) {
				$seq_arr['id_number'] = $row[0];	
				$seq++;			
			} 
			else {
				if ($seq_arr['id_number'] == $row[0])
					$seq++;
				else {
					$seq_arr['id_number'] = $row[0];
					$seq = 1;
				}
			}

			$partner_result = $this->db->get_where('partners',array('id_number' => $row[0]));
			if ($partner_result && $partner_result->num_rows() > 0){
				$partner = $partner_result->row();
				$partner_id = $partner->partner_id;
				$user_id = $partner->user_id;
			}

			$arr_field_val = array();
			$arr_field_val_user = array();
			foreach ($valid_cells as $key => $value) {
				if ($row[$key] != '' && $value != 'id_number'){
					$result = $this->db->get_where('partners_key',array('key_code' => $value));
					if ($result && $result->num_rows() > 0){
						$row_key = $result->row();
						$arr_field_val['partner_id'] = $partner_id;
						$arr_field_val['key_id'] = $row_key->key_id;
						$arr_field_val['key'] = $row_key->key_code;
						$arr_field_val['sequence'] = $seq;
						$arr_field_val['key_name'] = $row_key->key_label;
						$arr_field_val['key_value'] = $row[$key];

						$this->db->where('partner_id',$partner_id);
						$this->db->where('key',$row_key->key_code);
						$this->db->where('sequence',$seq);
						$this->db->where('key_value',$row[$key]);
						$this->db->delete('partners_personal_history');							
					}

					$this->db->insert('partners_personal_history',$arr_field_val);					
				}					
			}
		}

		echo "Done.";	
	}	

	function import_licensure(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'ID Number':
								$valid_cells[] = 'id_number';
								break;
							case 'Title':
								$valid_cells[] = 'licensure-title';
								break;									
							case 'License Registration Number':
								$valid_cells[] = 'licensure-number';
								break;	
							case 'Registration Date':
								$valid_cells[] = 'licensure-month-taken';
								break;
							case 'Validity Until':
								$valid_cells[] = 'licensure-month-validity-until';
								break;
							case 'Remarks':
								$valid_cells[] = 'licensure-remarks';
								break;		
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}

		$ctr = 0;
		$seq = 0;		
		foreach ($import_data as $row) {	
			if (!isset($seq_arr['id_number'])) {
				$seq_arr['id_number'] = $row[0];	
				$seq++;			
			} 
			else {
				if ($seq_arr['id_number'] == $row[0])
					$seq++;
				else {
					$seq_arr['id_number'] = $row[0];
					$seq = 1;
				}
			}

			$partner_result = $this->db->get_where('partners',array('id_number' => $row[0]));
			if ($partner_result && $partner_result->num_rows() > 0){
				$partner = $partner_result->row();
				$partner_id = $partner->partner_id;
				$user_id = $partner->user_id;
			}

			$arr_field_val = array();
			$arr_field_val_user = array();
			foreach ($valid_cells as $key => $value) {
				if ($row[$key] != '' && $value != 'id_number'){
					switch ($value) {
						case 'licensure-month-taken':
							$year_month_arr = explode('-', $row[$key]);
							$month = trim($year_month_arr[0]);
							$year = trim($year_month_arr[1]);
							$row[$key] = $month;
							break;
						case 'licensure-month-validity-until':
							$year_month_arr = explode('-', $row[$key]);
							$month = trim($year_month_arr[0]);
							$year = trim($year_month_arr[1]);
							$row[$key] = $month;
							break;								
					}

					$result = $this->db->get_where('partners_key',array('key_code' => $value));
					if ($result && $result->num_rows() > 0){
						$row_key = $result->row();
						$arr_field_val['partner_id'] = $partner_id;
						$arr_field_val['key_id'] = $row_key->key_id;
						$arr_field_val['key'] = $row_key->key_code;
						$arr_field_val['sequence'] = $seq;
						$arr_field_val['key_name'] = $row_key->key_label;
						$arr_field_val['key_value'] = $row[$key];

						$this->db->where('partner_id',$partner_id);
						$this->db->where('key',$row_key->key_code);
						$this->db->where('sequence',$seq);
						$this->db->where('key_value',$row[$key]);
						$this->db->delete('partners_personal_history');							
					}

					$this->db->insert('partners_personal_history',$arr_field_val);	

					switch ($value) {
						case 'licensure-month-taken':
							$result = $this->db->get_where('partners_key',array('key_code' => 'licensure-year-taken'));
							if ($result && $result->num_rows() > 0){
								$row_key = $result->row();
								$arr_field_val['partner_id'] = $partner_id;
								$arr_field_val['key_id'] = $row_key->key_id;
								$arr_field_val['key'] = $row_key->key_code;
								$arr_field_val['sequence'] = $seq;
								$arr_field_val['key_name'] = $row_key->key_label;
								$arr_field_val['key_value'] = $year;

								$this->db->where('partner_id',$partner_id);
								$this->db->where('key',$row_key->key_code);
								$this->db->where('sequence',$seq);
								$this->db->where('key_value',$year);
								$this->db->delete('partners_personal_history');		

								$this->db->insert('partners_personal_history',$arr_field_val);						
							}
							break;
						case 'licensure-month-validity-until':
							$result = $this->db->get_where('partners_key',array('key_code' => 'licensure-year-validity-until'));
							if ($result && $result->num_rows() > 0){
								$row_key = $result->row();
								$arr_field_val['partner_id'] = $partner_id;
								$arr_field_val['key_id'] = $row_key->key_id;
								$arr_field_val['key'] = $row_key->key_code;
								$arr_field_val['sequence'] = $seq;
								$arr_field_val['key_name'] = $row_key->key_label;
								$arr_field_val['key_value'] = $year;

								$this->db->where('partner_id',$partner_id);
								$this->db->where('key',$row_key->key_code);
								$this->db->where('sequence',$seq);
								$this->db->where('key_value',$year);
								$this->db->delete('partners_personal_history');		

								$this->db->insert('partners_personal_history',$arr_field_val);						
							}
							break;																					
					}			
				}					
			}
		}

		echo "Done.";	
	}

	function import_training_seminar(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		//$objPHPExcel = $objReader->load($this->filename);
		$objPHPExcel = $objReader->load('D:\oclp new version\New HRIS Training Records Upload 06042021.xls');
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'ID Number':
								$valid_cells[] = 'id_number';
								break;
							case 'Category':
								$valid_cells[] = 'training-category';
								break;									
							case 'Title':
								$valid_cells[] = 'training-title';
								break;	
							case 'Venue':
								$valid_cells[] = 'training-venue';
								break;
							case 'Training Provider':
								$valid_cells[] = 'training-provider';
								break;	
							case 'Training Cost':
								$valid_cells[] = 'training-cost';
								break;
							case 'Budgeted':
								$valid_cells[] = 'training-budgeted';
								break;
							case 'Start Date':
								$valid_cells[] = 'training-start-month';
								break;	
							case 'End Date':
								$valid_cells[] = 'training-end-month';
								break;
							case 'Remarks':
								$valid_cells[] = 'training-remarks';
								break;
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}

		$ctr = 0;
		$seq = 0;		
		foreach ($import_data as $row) {	
			if (!isset($seq_arr['id_number'])) {
				$seq_arr['id_number'] = $row[0];	
				$seq++;			
			} 
			else {
				if ($seq_arr['id_number'] == $row[0])
					$seq++;
				else {
					$seq_arr['id_number'] = $row[0];
					$seq = 1;
				}
			}

			$partner_result = $this->db->get_where('partners',array('id_number' => $row[0]));
			if ($partner_result && $partner_result->num_rows() > 0){
				$partner = $partner_result->row();
				$partner_id = $partner->partner_id;
				$user_id = $partner->user_id;
			}

			$arr_field_val = array();
			$arr_field_val_user = array();
			foreach ($valid_cells as $key => $value) {
				if ($row[$key] != '' && $value != 'id_number'){
					switch ($value) {
						case 'training-start-month':
							//$row[$key] = date ( 'Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($row[$key]));
							$year_month = date ( 'F-Y', strtotime($row[$key]));

							$year_month_arr = explode('-', $year_month);
							$month = trim($year_month_arr[0]);
							$year = trim($year_month_arr[1]);
							$row[$key] = $month;
							break;
						case 'training-end-month':
							$year_month = date ( 'F-Y', strtotime($row[$key]));

							$year_month_arr = explode('-', $year_month);
							$month = trim($year_month_arr[0]);
							$year = trim($year_month_arr[1]);
							$row[$key] = $month;
							break;															
					}

					$result = $this->db->get_where('partners_key',array('key_code' => $value));
					if ($result && $result->num_rows() > 0){
						$row_key = $result->row();
						$arr_field_val['partner_id'] = $partner_id;
						$arr_field_val['key_id'] = $row_key->key_id;
						$arr_field_val['key'] = $row_key->key_code;
						$arr_field_val['sequence'] = $seq;
						$arr_field_val['key_name'] = $row_key->key_label;
						$arr_field_val['key_value'] = $row[$key];

						$this->db->where('partner_id',$partner_id);
						$this->db->where('key',$row_key->key_code);
						$this->db->where('sequence',$seq);
						$this->db->where('key_value',$row[$key]);
						$this->db->delete('partners_personal_history');							
					}

					$this->db->insert('partners_personal_history',$arr_field_val);	

					switch ($value) {
						case 'training-start-month':
							$result = $this->db->get_where('partners_key',array('key_code' => 'training-start-year'));
							if ($result && $result->num_rows() > 0){
								$row_key = $result->row();
								$arr_field_val['partner_id'] = $partner_id;
								$arr_field_val['key_id'] = $row_key->key_id;
								$arr_field_val['key'] = $row_key->key_code;
								$arr_field_val['sequence'] = $seq;
								$arr_field_val['key_name'] = $row_key->key_label;
								$arr_field_val['key_value'] = $year;

								$this->db->where('partner_id',$partner_id);
								$this->db->where('key',$row_key->key_code);
								$this->db->where('sequence',$seq);
								$this->db->where('key_value',$year);
								$this->db->delete('partners_personal_history');		

								$this->db->insert('partners_personal_history',$arr_field_val);						
							}
							break;
						case 'training-end-month':
							$result = $this->db->get_where('partners_key',array('key_code' => 'training-end-year'));
							if ($result && $result->num_rows() > 0){
								$row_key = $result->row();
								$arr_field_val['partner_id'] = $partner_id;
								$arr_field_val['key_id'] = $row_key->key_id;
								$arr_field_val['key'] = $row_key->key_code;
								$arr_field_val['sequence'] = $seq;
								$arr_field_val['key_name'] = $row_key->key_label;
								$arr_field_val['key_value'] = $year;

								$this->db->where('partner_id',$partner_id);
								$this->db->where('key',$row_key->key_code);
								$this->db->where('sequence',$seq);
								$this->db->where('key_value',$year);
								$this->db->delete('partners_personal_history');		

								$this->db->insert('partners_personal_history',$arr_field_val);						
							}
							break;															
					}			
				}					
			}
		}

		echo "Done.";	
	}

	function import_test_profile(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'ID Number':
								$valid_cells[] = 'id_number';
								break;
							case 'Exam Type':
								$valid_cells[] = 'test-category';
								break;									
							case 'Title':
								$valid_cells[] = 'test-title';
								break;	
							case 'Date Taken':
								$valid_cells[] = 'test-date-taken';
								break;	
							case 'Location':
								$valid_cells[] = 'test-location';
								break;	
							case 'Score/Rating':
								$valid_cells[] = 'test-score';
								break;
							case 'Result':
								$valid_cells[] = 'test-result';
								break;
							case 'Remarks':
								$valid_cells[] = 'test-remarks';
								break;
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}

		$ctr = 0;
		$seq = 0;		
		foreach ($import_data as $row) {	
			if (!isset($seq_arr['id_number'])) {
				$seq_arr['id_number'] = $row[0];	
				$seq++;			
			} 
			else {
				if ($seq_arr['id_number'] == $row[0])
					$seq++;
				else {
					$seq_arr['id_number'] = $row[0];
					$seq = 1;
				}
			}

			$partner_result = $this->db->get_where('partners',array('id_number' => $row[0]));
			if ($partner_result && $partner_result->num_rows() > 0){
				$partner = $partner_result->row();
				$partner_id = $partner->partner_id;
				$user_id = $partner->user_id;
			}

			$arr_field_val = array();
			$arr_field_val_user = array();
			foreach ($valid_cells as $key => $value) {
				if ($row[$key] != '' && $value != 'id_number'){
					$result = $this->db->get_where('partners_key',array('key_code' => $value));
					if ($result && $result->num_rows() > 0){
						$row_key = $result->row();
						$arr_field_val['partner_id'] = $partner_id;
						$arr_field_val['key_id'] = $row_key->key_id;
						$arr_field_val['key'] = $row_key->key_code;
						$arr_field_val['sequence'] = $seq;
						$arr_field_val['key_name'] = $row_key->key_label;
						$arr_field_val['key_value'] = $row[$key];

						$this->db->where('partner_id',$partner_id);
						$this->db->where('key',$row_key->key_code);
						$this->db->where('sequence',$seq);
						$this->db->where('key_value',$row[$key]);
						$this->db->delete('partners_personal_history');							
					}

					$this->db->insert('partners_personal_history',$arr_field_val);					
				}					
			}
		}

		echo "Done.";	
	}		

	function import_skills(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'ID Number':
								$valid_cells[] = 'id_number';
								break;
							case 'Skill Type':
								$valid_cells[] = 'skill-type';
								break;									
							case 'Skill Name':
								$valid_cells[] = 'skill-name';
								break;	
							case 'Proficiency Level':
								$valid_cells[] = 'skill-level';
								break;	
							case 'Remarks':
								$valid_cells[] = 'skill-remarks';
								break;
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}

		$ctr = 0;
		$seq = 0;		
		foreach ($import_data as $row) {	
			if (!isset($seq_arr['id_number'])) {
				$seq_arr['id_number'] = $row[0];	
				$seq++;			
			} 
			else {
				if ($seq_arr['id_number'] == $row[0])
					$seq++;
				else {
					$seq_arr['id_number'] = $row[0];
					$seq = 1;
				}
			}

			$partner_result = $this->db->get_where('partners',array('id_number' => $row[0]));
			if ($partner_result && $partner_result->num_rows() > 0){
				$partner = $partner_result->row();
				$partner_id = $partner->partner_id;
				$user_id = $partner->user_id;
			}

			$arr_field_val = array();
			$arr_field_val_user = array();
			foreach ($valid_cells as $key => $value) {
				if ($row[$key] != '' && $value != 'id_number'){
					$result = $this->db->get_where('partners_key',array('key_code' => $value));
					if ($result && $result->num_rows() > 0){
						$row_key = $result->row();
						$arr_field_val['partner_id'] = $partner_id;
						$arr_field_val['key_id'] = $row_key->key_id;
						$arr_field_val['key'] = $row_key->key_code;
						$arr_field_val['sequence'] = $seq;
						$arr_field_val['key_name'] = $row_key->key_label;
						$arr_field_val['key_value'] = $row[$key];

						$this->db->where('partner_id',$partner_id);
						$this->db->where('key',$row_key->key_code);
						$this->db->where('sequence',$seq);
						$this->db->where('key_value',$row[$key]);
						$this->db->delete('partners_personal_history');							
					}

					$this->db->insert('partners_personal_history',$arr_field_val);					
				}					
			}
		}

		echo "Done.";	
	}	

	function import_affiliation(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'ID Number':
								$valid_cells[] = 'id_number';
								break;
							case 'Affiliation Name':
								$valid_cells[] = 'affiliation-name';
								break;									
							case 'Position':
								$valid_cells[] = 'affiliation-position';
								break;	
							case 'Start Date':
								$valid_cells[] = 'affiliation-month-start';
								break;	
							case 'End Date':
								$valid_cells[] = 'affiliation-month-end';
								break;
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}

		$ctr = 0;
		$seq = 0;		
		foreach ($import_data as $row) {	
			if (!isset($seq_arr['id_number'])) {
				$seq_arr['id_number'] = $row[0];	
				$seq++;			
			} 
			else {
				if ($seq_arr['id_number'] == $row[0])
					$seq++;
				else {
					$seq_arr['id_number'] = $row[0];
					$seq = 1;
				}
			}

			$partner_result = $this->db->get_where('partners',array('id_number' => $row[0]));
			if ($partner_result && $partner_result->num_rows() > 0){
				$partner = $partner_result->row();
				$partner_id = $partner->partner_id;
				$user_id = $partner->user_id;
			}

			$arr_field_val = array();
			$arr_field_val_user = array();
			foreach ($valid_cells as $key => $value) {
				if ($row[$key] != '' && $value != 'id_number'){
					switch ($value) {
						case 'affiliation-month-start':
							$year_month_arr = explode('-', $row[$key]);
							$month = trim($year_month_arr[0]);
							$year = trim($year_month_arr[1]);
							$row[$key] = $month;
							break;
						case 'affiliation-month-end':
							$year_month_arr = explode('-', $row[$key]);
							$month = trim($year_month_arr[0]);
							$year = trim($year_month_arr[1]);
							$row[$key] = $month;
							break;															
					}

					$result = $this->db->get_where('partners_key',array('key_code' => $value));
					if ($result && $result->num_rows() > 0){
						$row_key = $result->row();
						$arr_field_val['partner_id'] = $partner_id;
						$arr_field_val['key_id'] = $row_key->key_id;
						$arr_field_val['key'] = $row_key->key_code;
						$arr_field_val['sequence'] = $seq;
						$arr_field_val['key_name'] = $row_key->key_label;
						$arr_field_val['key_value'] = $row[$key];

						$this->db->where('partner_id',$partner_id);
						$this->db->where('key',$row_key->key_code);
						$this->db->where('sequence',$seq);
						$this->db->where('key_value',$row[$key]);
						$this->db->delete('partners_personal_history');							
					}

					$this->db->insert('partners_personal_history',$arr_field_val);	

					switch ($value) {
						case 'affiliation-month-start':
							$result = $this->db->get_where('partners_key',array('key_code' => 'affiliation-year-start'));
							if ($result && $result->num_rows() > 0){
								$row_key = $result->row();
								$arr_field_val['partner_id'] = $partner_id;
								$arr_field_val['key_id'] = $row_key->key_id;
								$arr_field_val['key'] = $row_key->key_code;
								$arr_field_val['sequence'] = $seq;
								$arr_field_val['key_name'] = $row_key->key_label;
								$arr_field_val['key_value'] = $year;

								$this->db->where('partner_id',$partner_id);
								$this->db->where('key',$row_key->key_code);
								$this->db->where('sequence',$seq);
								$this->db->where('key_value',$year);
								$this->db->delete('partners_personal_history');		

								$this->db->insert('partners_personal_history',$arr_field_val);						
							}
							break;
						case 'affiliation-month-end':
							$result = $this->db->get_where('partners_key',array('key_code' => 'affiliation-year-end'));
							if ($result && $result->num_rows() > 0){
								$row_key = $result->row();
								$arr_field_val['partner_id'] = $partner_id;
								$arr_field_val['key_id'] = $row_key->key_id;
								$arr_field_val['key'] = $row_key->key_code;
								$arr_field_val['sequence'] = $seq;
								$arr_field_val['key_name'] = $row_key->key_label;
								$arr_field_val['key_value'] = $year;

								$this->db->where('partner_id',$partner_id);
								$this->db->where('key',$row_key->key_code);
								$this->db->where('sequence',$seq);
								$this->db->where('key_value',$year);
								$this->db->delete('partners_personal_history');		

								$this->db->insert('partners_personal_history',$arr_field_val);						
							}
							break;															
					}			
				}					
			}
		}

		echo "Done.";	
	}	

	function import_accountabilities(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'ID Number':
								$valid_cells[] = 'id_number';
								break;
							case 'Asset Type':
								$valid_cells[] = 'accountabilities-asset-type';
								break;
							case 'Item Name':
								$valid_cells[] = 'accountabilities-name';
								break;									
							case 'Item Code':
								$valid_cells[] = 'accountabilities-code';
								break;
							case 'Asset Number':
								$valid_cells[] = 'accountabilities-asset-number';
								break;
							case 'Serial Number':
								$valid_cells[] = 'accountabilities-serial-number';
								break;
							case 'Quantity':
								$valid_cells[] = 'accountabilities-quantity';
								break;	
							case 'Date Issued':
								$valid_cells[] = 'accountabilities-date-issued';
								break;
							case 'Date Returned':
								$valid_cells[] = 'accountabilities-date-returned';
								break;
							case 'Remarks':
								$valid_cells[] = 'accountabilities-remarks';
								break;
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}

		$ctr = 0;
		$seq = 0;		
		foreach ($import_data as $row) {	
			if (!isset($seq_arr['id_number'])) {
				$seq_arr['id_number'] = $row[0];	
				$seq++;			
			} 
			else {
				if ($seq_arr['id_number'] == $row[0])
					$seq++;
				else {
					$seq_arr['id_number'] = $row[0];
					$seq = 1;
				}
			}

			$partner_result = $this->db->get_where('partners',array('id_number' => $row[0]));
			if ($partner_result && $partner_result->num_rows() > 0){
				$partner = $partner_result->row();
				$partner_id = $partner->partner_id;
				$user_id = $partner->user_id;
			}

			$arr_field_val = array();
			$arr_field_val_user = array();
			foreach ($valid_cells as $key => $value) {
				switch ($value) {
					case 'accountabilities-date-issued':
					case 'accountabilities-date-returned':
						$row[$key] = date ( 'Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($row[$key]));
						break;									
				}				
				if ($row[$key] != '' && $value != 'id_number'){
					$result = $this->db->get_where('partners_key',array('key_code' => $value));
					if ($result && $result->num_rows() > 0){
						$row_key = $result->row();
						$arr_field_val['partner_id'] = $partner_id;
						$arr_field_val['key_id'] = $row_key->key_id;
						$arr_field_val['key'] = $row_key->key_code;
						$arr_field_val['sequence'] = $seq;
						$arr_field_val['key_name'] = $row_key->key_label;
						$arr_field_val['key_value'] = $row[$key];

						$this->db->where('partner_id',$partner_id);
						$this->db->where('key',$row_key->key_code);
						$this->db->where('sequence',$seq);
						$this->db->where('key_value',$row[$key]);
						$this->db->delete('partners_personal_history');							
					}

					$this->db->insert('partners_personal_history',$arr_field_val);					
				}					
			}
		}

		echo "Done.";	
	}		

	function import_approver(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load('D:\oclp new version\new HRIS Approver Set up.xls');
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {														
							case 'ID Number':
								$valid_cells[] = 'user_id';
								break;
							case 'Approver Id Number':
								$valid_cells[] = 'approver_id';
								break;
							case 'Condition':
								$valid_cells[] = 'condition';
								break;
							case 'Sequence':
								$valid_cells[] = 'sequence';
								break;																							
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}


		$ctr = 0;

		// Remove non-matching cells.
		foreach ($import_data as $row) {
			$user_id = '';
			$arr_field_val = array();
			foreach ($valid_cells as $key => $value) {
				switch ($value) {
					case 'user_id':
						$result = $this->db->get_where('partners',array('id_number' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_partners = $result->row();
							$row[$key] = $row_partners->user_id;
							$user_id = $row_partners->user_id;
						}
						else{
							$row[$key] = '';
						}
						break;
					case 'approver_id':
						$result = $this->db->get_where('partners',array('id_number' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_partners = $result->row();
							$row[$key] = $row_partners->user_id;						
						}
						else{
							$row[$key] = '';
						}
						break;	
					case 'position_code':
						if ($row[$key] == '')
							$row[$key] = '';
						break;
				}			
				$arr_field_val[$value] = $row[$key];
			}

			// fixed column to be inserted
			$arr_field_val['email'] = 1;

			$this->db->insert('approver_class_users',$arr_field_val);

			$update = "CALL `sp_approver_assign_all`($user_id)";

			$result_update = $this->db->query( $update );
			mysqli_next_result($this->db->conn_id);			
		}

		echo "Done.";	
	}

	function update_approver(){
		$result = $this->db->get('approver_class_users');
		foreach ($result->result() as $row) {
			$result_user = $this->db->get_where('users_profile',array('user_id' => $row->user_id));
			if ($result_user && $result_user->num_rows() > 0){
				$row_users = $result_user->row();

				$info['company_id'] = $row_users->company_id;
				$info['department_id'] = $row_users->department_id;
				$info['position_id'] = $row_users->position_id;

				$this->db->where('user_id',$row->user_id);
				$this->db->update('approver_class_users',$info);				
			}
		}

		echo "Done.";	
	}

	function update_level_shift(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load('D:\oclp new version\oclp requirements\level and shift template.xls');
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {														
							case 'ID Number':
								$valid_cells[] = 'id_number';
								break;
							case 'Level Id':
								$valid_cells[] = 'employment_type_id';
								break;
							case 'Weekly Shift Id':
								$valid_cells[] = 'calendar_id';
								break;																
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}


		$ctr = 0;

		// Remove non-matching cells.
		foreach ($import_data as $row) {		
			$arr_field_val = array();
			$id_number = '';
			foreach ($valid_cells as $key => $value) {
				if (in_array($value, ['employment_type_id','calendar_id'])) {
					$arr_field_val[$value] = $row[$key];
				} else {
					$id_number = $row[$key];
				}
			}

			$this->db->where('id_number',$id_number);
			$this->db->update('partners',$arr_field_val);
		}

		echo "Done.";	
	}

	function update_role(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load('D:\oclp new version\role for import template(1).xls');
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {														
							case 'ID Number':
								$valid_cells[] = 'id_number';
								break;
							case 'Role':
								$valid_cells[] = 'role_id';
								break;																
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}


		$ctr = 0;

		// Remove non-matching cells.
		foreach ($import_data as $row) {		
			$arr_field_val = array();
			$user_id = '';
			$role_id = '';
			foreach ($valid_cells as $key => $value) {
				switch ($value) {
					case 'id_number':
						$result_partner = $this->db->get_where('partners',array('id_number' => $row[$key]));
						if ($result_partner && $result_partner->num_rows() > 0)
							$user_id = $result_partner->row()->user_id;
						break;
					case 'role_id':
						$result_role = $this->db->get_where('roles',array('role' => $row[$key]));
						if ($result_role && $result_role->num_rows() > 0)
							$role_id = $result_role->row()->role_id;
						break;
				}
			}

			$this->db->where('user_id',$user_id);
			$this->db->update('users',array('role_id' => $role_id));
		}

		echo "Done.";	
	}

	function import_movement(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load('D:\oclp new version\employee movement import template.xls');
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'ID Number':
								$valid_cells_movement[] = 'id_number';
								break;
							case 'Due To':
								$valid_cells_movement[] = 'due_to_id';
								break;
							case 'Type':
								$valid_cells_movement_action[] = 'type_id';
								break;								
							case 'Effective Date':
								$valid_cells_movement_action[] = 'effectivity_date';
								break;
							case 'Remarks':
								$valid_cells_movement[] = 'remarks';
								break;
							case 'Field Name':
								$valid_cells_movement_action_transfer[] = 'field_id';
								break;
							case 'From':
								$valid_cells_movement_action_transfer[] = 'from_id';
								break;
							case 'To':
								$valid_cells_movement_action_transfer[] = 'to_id';
								break;
							case 'Black Listed (Yes / No)':
								$valid_cells_movement_action_moving[] = 'blacklisted';
								break;
							case 'Eligible For Rehire (Yes / No)':
								$valid_cells_movement_action_moving[] = 'eligible_for_rehire';
								break;
							case 'Reviewed By (Id Number)':
								$valid_cells_movement_approver_hr[] = 'user_id';
								break;
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}


		$ctr = 0;

		// Remove non-matching cells.
		foreach ($import_data as $row) {		
			$arr_field_val = array();
			$user_id = 0;
			foreach ($valid_cells_movement as $key => $value) {
				switch ($value) {
					case 'id_number':
						$result = $this->db->get_where('partners',array('id_number' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$partners = $result->row();
							$row[$key] = $partners->user_id;
							$user_id = $partners->user_id;
						}
						else{
							$row[$key] = '';
						}						
						break;
					case 'due_to_id':
						$result = $this->db->get_where('partners_movement_cause',array('cause' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$movement_cause = $result->row();
							$row[$key] = $movement_cause->cause_id;
						}
						else{
							$row[$key] = '';
						}						
						break;							
				}	
				
				$arr_field_val[$value] = $row[$key];
			}

			$this->db->insert('partners_movement',$arr_field_val);
			$movement_id = $this->db->insert_id();

			$arr_field_val_action = array();
			foreach ($valid_cells_movement_action as $key => $value) {
				switch ($value) {
					case 'type_id':
						$result = $this->db->get_where('partners_movement_type',array('type' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$movement_type = $result->row();
							$row[$key] = $movement_type->type_id;						
						}
						else{
							$row[$key] = '';
						}						
						break;						
				}	
				
				$arr_field_val_action[$value] = $row[$key];
			}

			$arr_field_val_action['user_id'] = $user_id;
			$arr_field_val_action['movement_id'] = $movement_id;

			$this->db->insert('partners_movement_action',$arr_field_val_action);
			$action_id = $this->db->insert_id();

			$arr_field_val_action_transfer = array();
			foreach ($valid_cells_movement_action_transfer as $key => $value) {
				$field_name = '';
				switch ($value) {
					case 'field_id':
						$field_name = $row[$key];					
						$result = $this->db->get_where('partners_movement_fields',array('field_name' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$movement_fields = $result->row();
							$row[$key] = $movement_fields->field_id;						
						}
						else{
							$row[$key] = '';
						}

						$arr_field_val_action_transfer['field_name'] = $row[$key];
						break;
					case 'from_id':
						$from_val = $this->get_movement_field_from_to($field_name,$row[$key]);
						$row[$key] = $from_val['id'];
						$arr_field_val_action_transfer['from_name'] = $from_val['val'];					
						break;
					case 'to_id':
						$to_val = $this->get_movement_field_from_to($field_name,$row[$key]);
						$row[$key] = $to_val['id'];
						$arr_field_val_action_transfer['to_name'] = $to_val['val'];					
						break;						
				}	
				
				$arr_field_val_action_transfer[$value] = $row[$key];
			}

			$arr_field_val_action_transfer['action_id'] = $action_id;
			$arr_field_val_action_transfer['movement_id'] = $movement_id;

			$this->db->insert('partners_movement_action_transfer',$arr_field_val_action_transfer);

			$arr_field_val_action_moving = array();
			foreach ($valid_cells_movement_action_moving as $key => $value) {
				switch ($value) {
					case 'blacklisted':
						$row[$key] = (strtolower($row[$key]) == 'yes' ? 1 : 0);
						break;
					case 'eligible_for_rehire':
						$row[$key] = (strtolower($row[$key]) == 'yes' ? 1 : 0);					
						break;							
				}	
				
				$arr_field_val_action_moving[$value] = $row[$key];
			}

			$arr_field_val_action_moving['action_id'] = $action_id;
			$arr_field_val_action_moving['movement_id'] = $movement_id;

			$this->db->insert('partners_movement_action_transfer',$arr_field_val_action_moving);			

			$arr_field_val_approver_hr['movement_id'] = $movement_id;
			$arr_field_val_approver_hr['user_id'] = 234; //fixed to naisa
			$this->db->insert('partners_movement_action_transfer',$arr_field_val_action_moving);
		}

		echo "Done.";	
	}

	function import_leave_credits_migration(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load('C:\Drive_d\oclp new version\oclp requirements\HR & IT Headcount vl sl 06302021 .xls');
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {														
							case 'Employee Number':
								$valid_cells[] = 'user_id';
								break;
							case 'Leave Type':
								$valid_cells[] = 'form_code';
								break;
							case 'Previous':
								$valid_cells[] = 'previous';
								break;
							case 'Credits':
								$valid_cells[] = 'current';
								break;
							case 'Used':
								$valid_cells[] = 'used';
								break;								
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}


		$ctr = 0;

		// Remove non-matching cells.
		foreach ($import_data as $row) {
			$form_id = '';
			$user_id = '';
			$arr_field_val = array('year' => 2021);
			foreach ($valid_cells as $key => $value) {
				switch ($value) {
					case 'user_id':
						$result = $this->db->get_where('partners',array('id_number' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_partners = $result->row();
							$row[$key] = $row_partners->user_id;
							$user_id = $row_partners->user_id;
						}
						else{
							$row[$key] = '';
						}
						break;
					case 'form_code':
						$result = $this->db->get_where('time_form',array('form_code' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_form = $result->row();
							$row[$key] = $row_form->form_code;
							$arr_field_val['form_id'] = $row_form->form_id;
							$form_id = $row_form->form_id;
						}
						else{
							$row[$key] = '';
						}
						break;
					case 'previous':
						if ($row[4] > $row[3])
							$row[$key] = ($row[$key] + $row[3]) - $row[4];
						break;							
					case 'current':
						if ($row[4] > $row[$key])
							$row[$key] = 0;//($row[2] + $row[$key]) - $row[4];
						else
							$row[$key] = $row[$key] - $row[4];

						break;
				}			
				$arr_field_val[$value] = $row[$key];
			}

			$arr_field_val['modified_by'] = 99999;

			unset($arr_field_val['used']);

			$this->db->where('user_id',$user_id);
			$this->db->where('year',2021);
			$this->db->where('form_id',$form_id);
			$result = $this->db->get('time_form_balance');

			if ($result && $result->num_rows() > 0) {
				$row_bal = $result->row();
				$leave_balance_id = $row_bal->id;
				$this->db->where('id',$row_bal->id);
				$this->db->update('time_form_balance',$arr_field_val);
			} else {
				$this->db->insert('time_form_balance',$arr_field_val);
				$leave_balance_id = $this->db->insert_id();
			}

			$this->db->where('user_id',$user_id);
			$this->db->where('leave_balance_id',$leave_balance_id);
			$this->db->where('form_id',$form_id);
			$result = $this->db->get('time_form_balance_accrual');

			$arr_field_val['leave_balance_id'] = $leave_balance_id;
			$arr_field_val['accrual'] = $arr_field_val['current'];

			unset($arr_field_val['current']);
			unset($arr_field_val['year']);
			unset($arr_field_val['previous']);
			//unset($arr_field_val['modified_by']);

			if ($result && $result->num_rows() > 0) {
				$this->db->where('user_id',$user_id);
				$this->db->where('leave_balance_id',$leave_balance_id);
				$this->db->where('form_id',$form_id);
				$this->db->update('time_form_balance_accrual',$arr_field_val);
			} else {
				$this->db->insert('time_form_balance_accrual',$arr_field_val);
				//debug($this->db->last_query());die();
			}

		}

		echo "Done.";	
	}
	/************************************************************************************************/	

	function import_leave_credits(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load('D:\oclp new version\carry over template for import.xls');
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {														
							case 'ID Number':
								$valid_cells[] = 'user_id';
								break;
							case 'Form Type':
								$valid_cells[] = 'form_code';
								break;
							case 'Previous Credit':
								$valid_cells[] = 'previous';
								break;																					
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}


		$ctr = 0;

		// Remove non-matching cells.
		foreach ($import_data as $row) {
			$form_id = '';
			$user_id = '';
			$arr_field_val = array('year' => 2021);
			foreach ($valid_cells as $key => $value) {
				switch ($value) {
					case 'user_id':
						$result = $this->db->get_where('partners',array('id_number' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_partners = $result->row();
							$row[$key] = $row_partners->user_id;
							$user_id = $row_partners->user_id;
						}
						else{
							$row[$key] = '';
						}
						break;
					case 'form_code':
						$result = $this->db->get_where('time_form',array('form_code' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_form = $result->row();
							$row[$key] = $row_form->form_code;
							$arr_field_val['form_id'] = $row_form->form_id;
							$form_id = $row_form->form_id;
						}
						else{
							$row[$key] = '';
						}
						break;	
				}			
				$arr_field_val[$value] = $row[$key];
			}

			$this->db->where('user_id',$user_id);
			$this->db->where('year',2021);
			$this->db->where('form_id',$form_id);
			$result = $this->db->get('time_form_balance');

			if ($result && $result->num_rows() > 0) {
				$row = $result->row();
				$this->db->where('id',$row->id);
				$this->db->update('time_form_balance',$arr_field_val);
			} else {
				$this->db->insert('time_form_balance',$arr_field_val);
			}
		}

		echo "Done.";	
	}
	/************************************************************************************************/	

	public function get_movement_field_from_to($field_name = '',$val = '')
	{
		switch ($field_name) {
			case 'department':
				$result = $this->db->get_where('users_department',array('department' => $val));
				if ($result && $result->num_rows() > 0){
					$department_result = $result->row();
					$value['id'] = $department_result->department_id;
					$value['val'] = $department_result->department;
				}
				break;
			case 'division':
				# code...
				break;
			case 'location':
				# code...
				break;
			case 'position':
				# code...
				break;
			case 'rank':
				# code...
				break;
			case 'project':
				# code...
				break;
			case 'reports_to':
				# code...
				break;
			case 'role':
				# code...
				break;
			case 'employment_status':
				# code...
				break;
			case 'employment_type':
				# code...
				break;
			case 'temp_assign_end_date':
				# code...
				break;
			case 'company':
				# code...
				break;
			case 'job_level':
				# code...
				break;
			case 'branch':
				# code...
				break;
			case 'sbu_unit':
				# code...
				break;
			case 'section':
				# code...
				break;				
			default:
				$value['id'] = '';
				$value['val'] = '';
				break;
		}
		return $value;
	}

	function import_chart_of_account(){
		$this->db->truncate('payroll_account');

		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($this->filename);
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {
							case 'Account Code':
								$valid_cells[] = 'account_code';
								break;
							case 'Account Name':
								$valid_cells[] = 'account_name';
								break;
							case 'Account Type':
								$valid_cells[] = 'account_type_id';
								break;								
							case 'Description':
								$valid_cells[] = 'description';
								break;
							case 'Order':
								$valid_cells[] = 'arrangement';
								break;								
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}


		$ctr = 0;

		// Remove non-matching cells.
		foreach ($import_data as $row) {		
			$arr_field_val = array();
			foreach ($valid_cells as $key => $value) {
				switch ($value) {
					case 'account_type_id':
						$result = $this->db->get_where('payroll_account_type',array('account_type' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$account_type = $result->row();
							$row[$key] = $account_type->account_type_id;						
						}
						else{
							$row[$key] = '';
						}						
						break;				
				}	
				
				$arr_field_val[$value] = $row[$key];
			}

			$this->db->insert('payroll_account',$arr_field_val);
		}

		echo "Done.";	
	}

	/************************************************************************************************/	

	function import_payroll_transaction(){
		$this->load->library('excel');

		$objReader = new PHPExcel_Reader_Excel5;

		if (!$objReader) {
			show_error('Could not get reader.');
		}

		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load('D:\oclp new version\carry over template for import.xls');
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	
		$ctr = 0;	
		$import_data = array();

		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$rowIndex = $row->getRowIndex();
			
			// Build the array to insert and check for validation errors as well.
			foreach ($cellIterator as $cell) {
				$import_data[$ctr][] = $cell->getCalculatedValue();
			}

			if ($rowIndex == 1) {

				foreach ($import_data as $row) {
					foreach ($row as $cell => $value) {
						switch ($value) {														
							case 'Transaction Code':
								$valid_cells[] = 'transaction_code';
								break;
							case 'Transaction Label':
								$valid_cells[] = 'transaction_label';
								break;
							case 'Transaction Class':
								$valid_cells[] = 'transaction_class_id';
								break;
							case 'Transaction Type':
								$valid_cells[] = 'transaction_type_id';
								break;
							case 'Debit Account':
								$valid_cells[] = 'debit_account_id';
								break;
							case 'Credit Account':
								$valid_cells[] = 'credit_account_id';
								break;
							case 'Is Bonus':
								$valid_cells[] = 'is_bonus';
								break;																	
						}
					}
				}

				unset($import_data[$ctr]);
			}

			$ctr++;
		}


		$ctr = 0;

		// Remove non-matching cells.
		foreach ($import_data as $row) {
			$form_id = '';
			$user_id = '';
			$arr_field_val = array('year' => 2021);
			foreach ($valid_cells as $key => $value) {
				switch ($value) {
					case 'transaction_class_id':
						$result = $this->db->get_where('payroll_transaction_class',array('transaction_class' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_form = $result->row();
							$row[$key] = $row_form->transaction_class_id;
						}
						else{
							$this->db->insert('payroll_transaction_class',array('transaction_class' => $row[$key]));
							$row[$key] = $this->db->insert_id();
						}
						break;
					case 'transaction_type_id':
						$result = $this->db->get_where('payroll_transaction_type',array('transaction_type' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_form = $result->row();
							$row[$key] = $row_form->transaction_type_id;
						}
						else{
							$this->db->insert('payroll_transaction_type',array('transaction_type' => $row[$key]));
							$row[$key] = $this->db->insert_id();
						}
						break;
					case 'debit_account_id':
						$result = $this->db->get_where('payroll_account',array('account_name' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_form = $result->row();
							$row[$key] = $row_form->account_id;
						}
						else{
							$this->db->insert('payroll_transaction_type',array('account_name' => $row[$key]));
							$row[$key] = $this->db->insert_id();
						}
						break;
					case 'credit_account_id':
						$result = $this->db->get_where('payroll_account',array('account_name' => $row[$key]));
						if ($result && $result->num_rows() > 0){
							$row_form = $result->row();
							$row[$key] = $row_form->account_id;
						}
						else{
							$this->db->insert('payroll_transaction_type',array('account_name' => $row[$key]));
							$row[$key] = $this->db->insert_id();
						}
						break;
					case 'is_bonus':
						$row[$key] = (strtolower($row[$key]) == 'YES' ? 1 : 0);
				}			
				$arr_field_val[$value] = $row[$key];
			}

			$this->db->insert('payroll_transaction',$arr_field_val);

		}

		echo "Done.";	
	}
	/************************************************************************************************/	

	public function get_import_form()
	{
		$this->_ajax_only();

		if( !$this->permission['list'] )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_permission'),
				'type' => 'warning'
			);
			$this->_ajax_return();
		}

		$data['title'] = $this->mod->short_name .' - Import';
		$data['content'] = $this->load->blade('common.import-form')->with( $this->load->get_cached_vars() );

		$this->response->import_form = $this->load->view('templates/modal', $data, true);

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
		);
		
		$this->_ajax_return();
	}	

	public function validate_import($validation=0) {

		$this->lang->load('upload_utility');
		$this->_ajax_only();

		if( !$this->permission['list'] )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_permission'),
				'type' => 'warning'
			);
			$this->_ajax_return();
		}
		
		$template_id = $this->input->post('template_id');
		$file = $this->input->post('template');

		if( !file_exists( urldecode($file) ) )
		{
			$this->response->message[] = array(
				'message' => lang('upload_utility.file_missing'),
				'type' => 'warning'
			);
			$this->_ajax_return();
		}

		$ext = pathinfo($file, PATHINFO_EXTENSION);

		$accepted_file_types = array('xls');

		if (!in_array($ext, $accepted_file_types)) {
            $this->response->message[] = array(
				'message' => lang('upload_utility.file_type_not_accepted'),
				'type' => 'warning'
			);
			$this->_ajax_return();
        }

        $this->load->model('upload_utility_model', 'import');

        $csv_convert = false;

        if( in_array($ext, array('xls', 'xlsx')) )
        {
        	$csv_convert = time().'.csv';
        	$this->load->library('excel');
        	$inputFileType = PHPExcel_IOFactory::identify(urldecode($file));
        	$reader = PHPExcel_IOFactory::createReader($inputFileType);
			//$reader->setReadDataOnly(true);
			$excel = $reader->load(urldecode($file)); 
			$writer = PHPExcel_IOFactory::createWriter($excel, 'CSV');
			$writer->setDelimiter("\t");
			$writer->save($csv_convert);

			$fdata = file($csv_convert);
			$cnt = 0;
			$file_record = array();
			foreach($fdata as $row){
				$cnt++;
		    	if($template->skip_headers == 1 && $cnt == 1){
		    		continue;
		    	}

		    	$process = $this->import->process_row($row,$delimiter);

				foreach ($process as $k => $val) {
					if (isset($col[$k])) {
		   				$file_record[$col[$k]] = $val;
					}
		   		}
		        $result[] = $file_record ;			    	
			}
        }
	   	//validation of record
	   	$error_msg = "";
	   	$error_cnt = 0;
	   	$valid_cnt = 0;
	   	$row_cnt = count($result);
	   	foreach ($result as $line => $_record) {
	   		$err = 0;
	   		foreach ($_record as $k_col => $_rec) {
	   			$_rec = trim($_rec, '"');
	   			// check if biometric id is valid
	   			if($k_col == 'biometric') {
	   				$this->db->where('biometric',$_rec,FALSE);
	   				$chk_bio = $this->db->get('partners');
					if( $chk_bio && $chk_bio->num_rows() > 0 ){
	   					$res[$line][$k_col] = $_rec;
	   					$res[$line]['user_id'] = $chk_bio->row()->user_id;
	   				} else {
	   					$error_msg .= "Invalid biometric id number in line ".($line+2)." | ". $_rec .".<br />";
	   					$err = 1; 
	   				}
	   			}
	   			if($k_col == 'checktime') {
	   				$res[$line][$k_col] = date("Y-m-d H:i:s",strtotime($_rec));;
	   				$res[$line]['date'] = date("Y-m-d",strtotime($_rec));
	   			}

	   			if($k_col == 'trans_type'){
	   				$chk_type = '';
	   				switch ($_rec) {
	   					case '0':
	   						$chk_type = 'C/In';
	   						break;
	   					case '1':
	   						$chk_type = 'C/Out';
	   						break;
	   					case '2':
	   						$chk_type = 'B/In';
	   						break;
	   					case '3':
	   						$chk_type = 'B/Out';
	   						break;
	   					case '4':
	   						$chk_type = 'OT/In';
	   						break;
	   					case '5':
	   						$chk_type = 'OT/Out';
	   						break;
	   				}
	   				$res[$line]['checktype'] = $chk_type;
	   			}
	   		}

	   		if($err == 1)  
	   			$error_cnt++ ;
	   		else 
	   			$valid_cnt++;
	   	}

	   	// validation of records
	   	if($validation == 1){
        	$this->response->valid_count = $valid_cnt;
        	$this->response->error_count = $error_cnt;
		    $this->response->error_details = $error_msg;
        	$this->response->rows = $row_cnt;

        	$this->response->message[] = array(
				'message' => 'Validation compler,te. Ready for upload!',
				'type' => 'success'
			);
        }
        else { //loading to database
        	//insert the upload log
        	$log = array(
				'template_id' => $template->template_id,
				'file_path' => urldecode($file),
				'filesize' => filesize(urldecode($file)),
				'rows' => $row_cnt,
				'valid_count' => $valid_cnt,
				'error_count' => $error_cnt,
				'created_by' => $this->user->user_id
			);

			$this->db->insert('system_upload_log', $log);
        	$this->db->trans_start();
        	foreach ($res as $key => $value) {
        		if (isset($value['user_id'])){
        			$this->db->where('user_id',$value['user_id']);
        		}
        		$this->db->where('date',$value['date']);
        		$this->db->where('checktime',$value['checktime']);
        		$dtr = $this->db->get('time_record_raw');

        		if (!$dtr || $dtr->num_rows() < 1){
        			$insert = $this->db->insert('time_record_raw', $value);
        		}
        	}

        	if ($this->db->trans_status() === FALSE) {# Something went wrong.
			    $this->db->trans_rollback();
			    $this->response->message[] = array(
						'message' => "Duplicate Record",
						'type' => 'error'
					);
			} 
			else {
			    $this->db->trans_commit();
			    $this->response->message[] = array(
					'message' => "Records successfully uploaded",
					'type' => 'success'
				);
			}
        	$this->db->trans_complete();
        }	        

		$this->_ajax_return();
	}		

	public function truncate_transaction() {
/*		TRUNCATE `ww_partners_clearance`;
		TRUNCATE `ww_partners_clearance_exit_interview_answers`;
		TRUNCATE `ww_partners_clearance_signatories`;
		TRUNCATE `ww_partners_clearance_signatories_accountabilities`;

		TRUNCATE `ww_partners_movement`;
		TRUNCATE `ww_partners_movement_action`;
		TRUNCATE `ww_partners_movement_action_attachment`;
		TRUNCATE `ww_partners_movement_action_compensation`;
		TRUNCATE `ww_partners_movement_action_extension`;
		TRUNCATE `ww_partners_movement_action_moving`;
		TRUNCATE `ww_partners_movement_action_transfer`;
		TRUNCATE `ww_partners_movement_approver`;
		TRUNCATE `ww_partners_movement_approver_hr`;		

		TRUNCATE `ww_system_email_queue`;
		TRUNCATE `ww_system_feeds`;
		TRUNCATE `ww_system_feeds_recipient`;		*/
	}
}