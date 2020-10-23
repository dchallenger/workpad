<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Coe extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('coe_model', 'mod');
		parent::__construct();
	}

	function _list_options_active( $record, &$rec )
	{
		//temp remove until view functionality added
		$rec['detail_url'] = $this->mod->url . '/download_file/' . $record['record_id'];

		if( $this->permission['detail'] )
		{
			$rec['detail_url'] = $this->mod->url . '/detail/' . $record['record_id'];
			$rec['options'] .= '<li><a href="'.$rec['detail_url'].'"><i class="fa fa-info"></i> View</a></li>';
		}

		if( isset( $this->permission['edit'] ) && $this->permission['edit'] )
		{
			$rec['edit_url'] = $this->mod->url . '/edit/' . $record['record_id'];
			$rec['quickedit_url'] = 'javascript:quick_edit( '. $record['record_id'] .' )';
		}	
		
		if( isset($this->permission['delete']) && $this->permission['delete'] )
		{	
			if(isset($record['can_delete']) && $record['can_delete'] == 1){
				$rec['delete_url'] = $this->mod->url . '/delete/' . $record['record_id'];
				$rec['options'] .= '<li><a href="javascript: delete_record('.$record['record_id'].')"><i class="fa fa-trash-o"></i> '.lang('common.delete').'</a></li>';
			}elseif(isset($record['can_delete']) && $record['can_delete'] == 0){
				$rec['delete_url'] = $this->mod->url . '/delete/' . $record['record_id'];
				$rec['options'] .= '<li><a disabled="disabled" style="color:#B6B6B4" onclick="return false" href="javascript: delete_record('.$record['record_id'].')"><i class="fa fa-trash-o"></i> '.lang('common.delete').'</a></li>';
			}else{
				$rec['delete_url'] = $this->mod->url . '/delete/' . $record['record_id'];
				$rec['options'] .= '<li><a href="javascript: delete_record('.$record['record_id'].')"><i class="fa fa-trash-o"></i> '.lang('common.delete').'</a></li>';
			}
		}
	}

    function download_file($upload_id){   
        $this->db->select("filename")
        ->from("certificate_of_employment")
        ->where("coe_id = {$upload_id}");
        
        $image_details = $this->db->get()->row_array();   
        $path = base_url() . $image_details['filename'];
        
        header('Content-disposition: attachment; filename='.substr( $image_details['filename'], strrpos( $image_details['filename'], '/' )+1 ).'');
        header('Content-type: txt/pdf');
        readfile($path);
    }   	
}