<div class="portlet" style="margin-bottom:60px;">
	<div class="portlet-body form">

		<div class="form-group">
			<label class="control-label col-md-3">Partner:</label>
			<div class="col-md-8">
				<?php
					$db->select('user_id, alias');
					$db->where('deleted', '0');
					$options = $db->get('partners');
					$users_id_options = array();
					foreach($options->result() as $option)
					{
						$users_id_options[$option->user_id] = $option->alias;
					} 
				?>
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-list-ul"></i>
					</span>
					{{ form_dropdown('users[]',$users_id_options, '', 'class="form-control select2me" multiple="multiple" data-placeholder="Select..." id="full_name"') }}
				</div>
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Reason:</label>
			<div class="col-md-8">
				<textarea class="form-control" name="reason" id="reason" placeholder="" rows="2"></textarea>
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Signatory:</label>
			<div class="col-md-8">
				<?php
					$db->select('user_id, alias');
					$db->where('deleted', '0');
					$options = $db->get('partners');
					$users_id_options = array('' => 'Select...');
					foreach($options->result() as $option)
					{
						$users_id_options[$option->user_id] = $option->alias;
					}
				?>
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-list-ul"></i>
					</span>
					{{ form_dropdown('signatory',$users_id_options, '', 'class="form-control select2me" data-placeholder="Select..." id="signatory"') }}
				</div>
			</div>	
		</div>

	</div>
</div>