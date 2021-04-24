<div class="form-group">
    <label class="control-label col-md-3"><?php echo $key->key_label?></label>
    <div class="col-md-5">
        <div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
            <input type="checkbox" value="0" name="partners_personal_history[family-dependent-hmo][temp][]" class="dontserializeme toggle dependent"/>
            <input type="hidden" name="key[<?php echo $key->key_class_id?>][<?php echo $key->key_id?>]" class="yes_no" value="0"/>
        </div> 
    </div>
</div> 