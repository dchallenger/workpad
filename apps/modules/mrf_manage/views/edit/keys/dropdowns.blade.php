<div class="form-group">
	<label class="control-label col-md-3">{{ $key->key_label }}</label>
	<div class="col-md-5">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
			<?php
				$table_details = $db->get_where($key->key_table, array('deleted' => 0));
				$option = array();
				foreach( $table_details->result_array() as $tbl )
				{
					$option[ $tbl[$key->key_field_id] ] = $tbl[$key->key_field];
				}

				if ($key->key_id == 9)
					$option[99999] = 'Others';

				$value = isset( $key->key_value ) ? $key->key_value : '';
				if($key->key_code == 'sourcing_tools'){
					$value = ($value != '') ? unserialize($value) : $value;
					
					echo form_dropdown('key['.$key->key_id.'][]', $option, $value, 'class="form-control select2me '.$key->key_code.'" multiple data-placeholder="Select..." '.$record['disabled']);
				}else{
					echo form_dropdown('key['.$key->key_id.']', $option, $value, 'class="form-control select2me '.$key->key_code.'" data-placeholder="Select..." '.$record['disabled']);
				}
			?>
		</div>	
	</div>
</div>
@if ($key->key_id == 9)
	<div class="form-group others_course" style="display:none">
	    <label class="control-label col-md-3">Others</label>
	    <div class="col-md-5">
	    	<input type="text" {{ $record['disabled'] }} value="{{ $record['recruitment_request.other_course'] }}" name="recruitment_request[other_course]" class="form-control">
		</div>
	</div>
@endif