<div class="portlet">
	<div class="portlet-title">
		<div class="caption">&nbsp;</div>
		<div class="tools"><a class="text-muted delete_knowledge_transfer" href="javascript:void(0)" style="margin-botom:-15px;"><i class="fa fa-trash-o"></i> Delete</a></div>
	</div>
	<div class="portlet-body form">	
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Knowledge Transfer</label>
			<div class="col-md-7">
				<?php
					$db->select('training_knowledge_transfer_id,training_knowledge_transfer');
                    $db->order_by('training_knowledge_transfer', '0');
                    $db->where('deleted', '0');
                    $options = $db->get('training_knowledge_transfer');
                    $training_application_training_knowledge_transfer_options = array('' => 'Select...');
                    foreach($options->result() as $option) {
                    	$training_application_training_knowledge_transfer_options[$option->training_knowledge_transfer_id] = $option->training_knowledge_transfer;
                    } 
                ?>
                <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                    <?php echo form_dropdown('training_application_knowledge_transfer[training_knowledge_transfer_id][]',$training_application_training_knowledge_transfer_options, '', 'class="form-control select2me" data-placeholder="Select..." id="training_application-knowledge_transfer"') ?>
                </div> 				
            </div>	
		</div>								
		<div class="form-group">
			<label class="control-label col-md-3">Remarks</label>
			<div class="col-md-7">
				<textarea class="form-control" name="training_application_knowledge_transfer[remarks][]" id="training_application-note" placeholder="Enter Remarks" rows="4"></textarea>
			</div>	
		</div>					
	</div>
</div>