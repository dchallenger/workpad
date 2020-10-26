	<?php
		$disable = '';
		if ($record['partners_movement_action.created_by'] && $record['partners_movement_action.created_by'] != $user_id){
			$disable = 'disabled';
		} else {
			if ($record['partners_movement.status_id'] >= 3)
				$disable = 'disabled';
		}

		$db->select('users.user_id, users.display_name');
		$db->from('users');
		$db->join('partners', 'users.user_id = partners.user_id');
		$db->join('users_profile', 'users_profile.user_id = partners.user_id');

	    if ($qry_category != ''){
	        $this->db->where($qry_category, '', false);
	    }	
	    										
		$db->where('users.active', '1');
		$db->where('users.deleted', '0');
		$db->where('users.role_id <>', '1');
		$db->order_by('users.display_name', '0');
		$user_options = $db->get(); 		
	?>	
	<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Employee Movement</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">
		<div class="form-group">
			<label class="control-label col-md-3">
				Employee<span class="required"> *</span>
			</label>
			<div class="col-md-7">
				<div class="input-group">
					<input type="hidden" name="partners_movement[movement_from]" id="" value="{{$movement_from}}" />
					<input type="hidden" name="partners_movement_action[action_id]" id="partners_movement_action-action_id" value="<?php echo $record['partners_movement_action.action_id']; ?>" />
					<?php if ($disable != '') { ?>
						<input type="hidden" name="partners_movement_action[user_id]" value="<?php echo $record['partners_movement_action.user_id'] ?>" />
					<?php } ?>						
					<span class="input-group-addon">
						<i class="fa fa-list-ul"></i>
					</span>
					<select name="partners_movement_action[user_id]" id="partners_movement_action-user_id"  class="form-control partner_id select2me" data-placeholder="Select..." <?php echo $disable ?>>
					<option value=""></option>
						<?php 
							foreach($user_options->result() as $option)
							{
							$selected = ($option->user_id == $record['partners_movement_action.user_id']) ? "selected" : "";
						?>
							<option <?php echo $selected; ?> value="<?php echo $option->user_id ?>"><?php echo $option->display_name; ?> </option>
						<?php
							} 
						?>
					</select>
				</div> 				
			</div>	
		</div>		
		<div class="form-group">
			<?php if ($disable != '') { ?>
				<input type="hidden" name="partners_movement[due_to_id]" value="<?php echo $record['partners_movement.due_to_id'] ?>" />
			<?php } ?>				
			<label class="control-label col-md-3">
				Due To<span class="required"> *</span>
			</label>
			<div class="col-md-7">
				<?php									                            		
				$db->select('cause_id,cause');
				$db->order_by('cause', '0');
				$db->where('deleted', '0');
				$options = $db->get('partners_movement_cause'); 	                            
				$partners_movement_due_to_id_options = array('' => 'Select...');
				?>
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-list-ul"></i>
					</span>
					<select <?php echo $disable ?> name="partners_movement[due_to_id]" id="partners_movement-due_to_id"
					 class="form-control select2me" data-placeholder="Select...">
					 <option value=""></option>
						<?php 
							foreach($options->result() as $option)
							{
							$selected = ($option->cause_id == $record['partners_movement.due_to_id']) ? "selected" : "";
						?>
							<option <?php echo $selected; ?> value="<?php echo $option->cause_id ?>"><?php echo $option->cause; ?> </option>
						<?php
							} 
						?>
					</select>
				</div> 				
			</div>	
		</div>
		<div class="form-group">
			<?php if ($disable != '') { ?>
				<input type="hidden" name="partners_movement_action[type_id]" value="<?php echo $record['partners_movement_action.type_id'] ?>" />
			<?php } ?>			
			<label class="control-label col-md-3">
				Type<span class="required"> *</span>
			</label>
			<div class="col-md-7">
				<?php									                            		
				$db->select('type_id,type');
				$db->order_by('type', '0');
				$db->where('deleted', '0');
				$options = $db->get('partners_movement_type'); 	                            
				$partners_movement_action_type_id_options = array('' => '');
				foreach($options->result() as $option)
				{
					$partners_movement_action_type_id_options[$option->type_id] = $option->type;
				} 

				$others = 'class="form-control select2me" data-placeholder="Select..." id="type_id" '.$disable.'';
				?>							
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-list-ul"></i>
					</span>
					{{ form_dropdown('partners_movement_action[type_id]',$partners_movement_action_type_id_options, $record['partners_movement_action.type_id'], $others) }}
				</div> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">
				Effective Date<span class="required"> *</span>
			</label>
			<div class="col-md-7">			
				<div class="input-group input-large date date-picker" data-date-format="MM dd, yyyy">
					<input type="text" class="form-control" name="partners_movement_action[effectivity_date]" value="{{$record['partners_movement_action.effectivity_date']}}"
					id="partners_movement_action-effectivity_date" placeholder="Enter Effective">
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div> 				
			</div>	
		</div>					
		<div class="form-group">
			<label class="control-label col-md-3">Remarks</label>
			<div class="col-md-7">							
				<textarea <?php echo $disable ?> class="form-control" name="partners_movement[remarks]" id="partners_movement-remarks" placeholder="Enter Remarks" rows="4"><?php echo $record['partners_movement.remarks'] ?></textarea> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Attachments</label>
			<div class="col-md-7">
				<span class="btn green fileinput-button">
					<i class="fa fa-plus"></i>
					<span>
						Add files...
					</span>
					<input type="file" id="partners_movement-photo-fileupload" name="files[]" multiple>
				</span>										
				<!-- The table listing the files available for upload/download -->
				<br /><br />
				<table role="presentation" class="table table-striped clearfix">
				<tbody class="files">
					<?php
					if (!empty($record['attachement'])){
						foreach ($record['attachement'] as $key => $value) {
                        	$filename = urldecode(basename($value->photo)); 
                        	if(strtolower($filename) == 'avatar.png'){
                        		$record['partners_movement_action.photo'] = '';
                        		$filename = '';
                        	}													
					?>
						    <tr class="template-download">
						    	<input type="hidden" name="partners_movement_action[photo][]" value="<?php echo $value->photo ?>"/>
						    	<input type="hidden" name="partners_movement_action[type][]" value="<?php echo $value->type ?>"/>
						    	<input type="hidden" name="partners_movement_action[filename][]" value="<?php echo $value->filename ?>"/>
						    	<input type="hidden" name="partners_movement_action[size][]" value="<?php echo $value->size ?>"/>
						        <td>
						            <p class="name">
						            	<?php echo $filename ?>
						            </p>
						        </td>
						        <td>
						            <span class="size"><?php echo $value->size ?></span>
						        </td>
						        <td>
						        	<a data-dismiss="fileupload" class="btn red delete_attachment">
					                    <i class="glyphicon glyphicon-trash"></i>
					                    <span>Delete</span>
						        	</a>
						        </td>
						    </tr>
					<?php
						}
					}
					?>										
				</tbody>
				</table>										
			</div>
		</div>			
		<div class="form-group cat_type hidden" style="<?php echo ($record['partners_movement_action.type_id'] != 8) ? 'display:none' : '' ?>">
			<label class="control-label col-md-3">
				Category <span class="required">* </span>
			</label>
			<div class="col-md-7">
				<?php									                            		
				$db->select('type_category_id,type_category');
				$db->order_by('type_category', '0');
				$db->where('deleted', '0');
				$options = $db->get('partners_movement_type_category'); 	                            
				$partners_movement_action_type_id_options = array('' => 'Select...');
				foreach($options->result() as $option)
				{
					$partners_movement_action_type_id_options[$option->type_category_id] = $option->type_category;
				} 
				?>							
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-list-ul"></i>
					</span>
					{{ form_dropdown('type_category_id',$partners_movement_action_type_id_options, $record['partners_movement_action.type_category_id'], 'class="form-control select2me" data-placeholder="Select..." id="type_category_id"') }}
				</div> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">
				Reviewed By <span class="required"> *</span>
			</label>
			<div class="col-md-7">
				<?php								                            		
/*				$db->select('user_id,full_name');
				$db->order_by('full_name', '0');
				$db->where('deleted', '0');
				$options = $db->get('users'); */
				$partners_movement_action_type_id_options = array('' => '');
				if ($hr_admin_movement_profile && $hr_admin_movement_profile->num_rows() > 0) {
					foreach($hr_admin_movement_profile->result() as $option)
					{
						$partners_movement_action_type_id_options[$option->user_id] = $option->full_name;
					} 
				}

				$others = 'class="form-control select2me" data-placeholder="Select..." id="reviewed_by"';
				if ($record['partners_movement.status_id'] >= 9){
					$others = 'class="form-control select2me" ' . $disable . ' data-placeholder="Select..." id="reviewed_by"';
				}

				$reviewed_by = '';
				if (isset($movement_approver_hr[0]['user_id'])){
					$reviewed_by = $movement_approver_hr[0]['user_id'];
				}

				?>							
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-list-ul"></i>
					</span>
					{{ form_dropdown('hr_approver[]',$partners_movement_action_type_id_options, $reviewed_by, $others) }}
				</div> 				
			</div>	
		</div>	
		<div class="form-group hidden">
			<label class="control-label col-md-3">
				Approver 1 <span class="required"> *</span>
			</label>
			<div class="col-md-7">
				<?php									                            		
/*				$db->select('user_id,full_name');
				$db->order_by('full_name', '0');
				$db->where('deleted', '0');
				$options = $db->get('users'); */	                            
				$partners_movement_action_type_id_options = array('' => '');
				if ($hr_admin_movement_profile && $hr_admin_movement_profile->num_rows() > 0) {
					foreach($hr_admin_movement_profile->result() as $option) {
						$partners_movement_action_type_id_options[$option->user_id] = $option->full_name;
					}
				}

				$others = 'class="form-control select2me" data-placeholder="Select..." id="approver_hr_1"';
				if ($record['partners_movement.status_id'] >= 9){
					$others = 'class="form-control select2me" ' . $disable . ' data-placeholder="Select..." id="approver_hr_1"';
				}

				$approver_hr_1 = '';
				if (isset($movement_approver_hr[1]['user_id'])){
					$approver_hr_1 = $movement_approver_hr[1]['user_id'];
				}

				?>							
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-list-ul"></i>
					</span>
					{{ form_dropdown('hr_approver[]',$partners_movement_action_type_id_options, $approver_hr_1, $others) }}
				</div> 				
			</div>	
		</div>	
		<div class="form-group hidden">
			<label class="control-label col-md-3">
				Approver 2:
			</label>
			<div class="col-md-7">
				<?php									                            		
/*				$db->select('user_id,full_name');
				$db->order_by('full_name', '0');
				$db->where('deleted', '0');
				$options = $db->get('users'); */	                            
				$partners_movement_action_type_id_options = array('' => '');
				if ($hr_admin_movement_profile && $hr_admin_movement_profile->num_rows() > 0) {
					foreach($hr_admin_movement_profile->result() as $option) {
						$partners_movement_action_type_id_options[$option->user_id] = $option->full_name;
					}
				}

				$others = 'class="form-control select2me" data-placeholder="Select..." id="approver_hr_2"';
				if ($record['partners_movement.status_id'] >= 9){
					$others = 'class="form-control select2me" ' . $disable . ' data-placeholder="Select..." id="approver_hr_2"';
				}

				$approver_hr_2 = '';
				if (isset($movement_approver_hr[2]['user_id'])){
					$approver_hr_2 = $movement_approver_hr[2]['user_id'];
				}

				?>							
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-list-ul"></i>
					</span>
					{{ form_dropdown('hr_approver[]',$partners_movement_action_type_id_options, $approver_hr_2, $others) }}
				</div> 				
			</div>	
		</div>
		@if (in_array($record['partners_movement.status_id'],array(9,10)))
		<div class="form-group">
			<label class="control-label col-md-3">Remarks</label>
			<div class="col-md-7">							
				<textarea class="form-control" name="partners_movement_approver_hr[remarks]" id="partners_movement-hrd-remarks" placeholder="Enter Remarks" rows="4"><?php echo $hr_approver_remarks ?></textarea> 				
			</div>	
		</div>
		@endif
		<div style="border-bottom:1px solid #eee;padding-bottom:8px;">Employee Movement Details</div>

		<div style="padding-top:10px" id="movement_type_container">
		</div>												
	</div>
</div>
<br>
<div id="nature_movement" class="portlet-body form hidden">
    <input type="hidden" name="movement_count" id="movement_count" value="{{ $record['movement_count'] }}" />
    <div class="form-horizontal">
        <div class="form-body">
			<table class="table table-condensed table-striped table-hover">
				<thead>
					<tr>
						<th width="15%">Movement Type</th>
						<th width="15%" class="hidden-xs">Effective</th>
						<th width="15%" class="hidden-xs">Reason</th>					
						<th width="15%">Actions</th>
					</tr>
				</thead>
				<tbody id="movement_details-list">
					<?php 
					if(count($movement_details) > 0){
						foreach($movement_details as $index => $movement_detail){
					?>
					<tr class="record">
						<td>
							<a id="type" href="#" class="text-success">
								<?php echo $movement_detail['type']; ?>	
							</a>
							<br />
							<span id="date_set" class="small">
								<?php echo $movement_detail['display_name']; ?>	
						</span>
						</td>
						<td class="hidden-xs">
							<?php echo ($movement_detail['effectivity_date'] && $movement_detail['effectivity_date'] != '0000-00-00' && $movement_detail['effectivity_date'] != 'November 30, -0001' && $movement_detail['effectivity_date'] != '1970-01-01') ? date('F d, Y', strtotime($movement_detail['effectivity_date'])) : ''; ?>	
						</td>
						<td class="hidden-xs">
								<?php echo $movement_detail['action_remarks']; ?>	
						</td>		
						<td>
							@if ($record['partners_movement.status_id'] != 3)
							<div class="btn-group">
								<input type="hidden" id="action_id" name="action_id" value="<?=$movement_detail['action_id']?>" />
								<a  href="javascript:edit_movement_details(<?=$movement_detail['type_id']?>, <?=$movement_detail['action_id']?>);" class="btn btn-xs text-muted"  ><i class="fa fa-pencil"></i> Edit</a>
							</div>
							<div class="btn-group">
								<a href="javascript:delete_movement_type(<?=$movement_detail['action_id']?>)" class="btn btn-xs text-muted"><i class="fa fa-trash-o"></i> Delete</a>
							</div>
							@endif
						</td>
					</tr>
					<?php }
					} 
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade modal-container-action" aria-hidden="true" data-width="800" ></div>
<div class="form-actions fluid">
    <div class="row"  align="center">
        <div class="col-md-12">
            <div>
            	<?php 
            		$status = 3;
            		if ($record['partners_movement.status_id'] >= 9 && $record['partners_movement.status_id'] != 12){
            			$status = 11;
            		}
            		if ( (in_array($record['partners_movement.status_id'], array(6,9,10)) || empty($record_id)) || $record['partners_movement_action.created_by'] == $user_id){
				?>
						@if (!in_array($record['partners_movement.status_id'],array(9,10)))
                			<button class="btn blue btn-sm" type="button" onclick="save_movement( $(this).closest('form'), '')" >Save as draft</button>
                		@endif
                <?php
                		if (in_array($record['partners_movement.status_id'], array(9,10))){
                ?>
                			<button class="btn blue btn-sm" type="button" onclick="save_movement( $(this).closest('form'), 11)"> Approve</button>
                			<button class="btn red btn-sm" type="button" onclick="save_movement( $(this).closest('form'), 12)"> Decline</button>
                <?php
                		}
                		else{
				?>
							<button class="btn green btn-sm" type="button" onclick="save_movement( $(this).closest('form'), <?php echo $status ?>)"></i> Submit</button>
				<?php                			
                		}
					}
				?>                           
            	<a class="btn default btn-sm" href="{{ $mod->url }}">Back to list</a>
            </div>
        </div>
    </div>
</div>
