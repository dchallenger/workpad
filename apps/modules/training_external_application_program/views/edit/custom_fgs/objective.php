<div class="portlet">
	<div class="portlet-title">
		<div class="caption">&nbsp;</div>
		<div class="tools"><a class="text-muted delete_objective" href="javascript:void(0)" style="margin-botom:-15px;"><i class="fa fa-trash-o"></i> Delete</a></div>
	</div>
	<div class="portlet-body form">				
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Objective</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="training_application_objective[objective][]" id="training_application-venue" value="" placeholder="Enter Objective" />
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Rating (Please do self-rate)</label>
			<div class="col-md-7">
				<?php
					$db->select('training_rating_scale_id,CONCAT(training_rating_scale," - ",description) AS training_rating_scale',false);
	                $db->order_by('training_rating_scale', '0');
	                $db->where('deleted', '0');
	                $options = $db->get('training_rating_scale');
	                $training_application_training_rating_scale_options = array('' => '');
	                foreach($options->result() as $option) {
	                	$training_application_training_rating_scale_options[$option->training_rating_scale_id] = $option->training_rating_scale;
	                } 
	            ?>
	            <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
	                <?php echo form_dropdown('training_application_objective[training_rating_scale_id][]',$training_application_training_rating_scale_options, '', 'class="form-control select2me" data-placeholder="Select..." id="training_application-training_objective"') ?>
	            </div> 				
	        </div>	
		</div>						
	</div>
</div>