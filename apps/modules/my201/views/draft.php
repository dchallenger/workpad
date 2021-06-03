<div id="class-<?php echo $key_class_id?>">
    <div class="clearfix" style="margin-bottom: -15px;">
        <a class="text-muted pull-right" href="javascript:remove_class(<?php echo $key_class_id?>)" style="margin-botom:-15px;"><i class="fa fa-trash-o"></i> Delete</a>
    </div>
    <hr>
    <?php echo $keys?>
	<div class="form-group">
	    <label class="control-label col-md-3">Remarks</label>
	    <div class="col-md-7">
	        <textarea class="form-control" name="remarks[<?php echo $key->key_class_id?>]" placeholder="Enter Remarks"></textarea>
       </div>
	</div>
	<?php if ($key_class_id == 58) { ?>    
	<div class="form-group">
	    <label class="control-label col-md-3">&nbsp;</label>
	    <div class="col-md-7">
	    	<div class="help-block text-muted small">
	    		Note : Subject for approval to take effect with the employee 201 record
	    	</div>
		</div>	        
	</div>
	<?php } ?>		
</div>