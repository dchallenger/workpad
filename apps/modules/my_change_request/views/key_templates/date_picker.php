<div class="form-group">
    <label class="control-label col-md-3"><?php echo $key->key_label?></label>
    <div class="col-md-5">
    	<div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
            <input type="text" class="form-control bday" name="key[<?php echo $key->key_class_id?>][<?php echo $key->key_id?>]" value="" placeholder="Enter Birthday" >
            <span class="input-group-btn">
            <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
            </span>
        </div>
    </div>
</div>