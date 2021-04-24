<div class="form-group">
    <label class="control-label col-md-3"><?php echo $key->key_label?></label>
    <div class="col-md-7">
        <?php   
    		$db->select('family_relationship_id,family_relationship');
            $db->where('deleted', '0');
            $options = $db->get('partners_family_relationship');

            $family_relationship_options = array();
            foreach($options->result() as $option)
            {
                $family_relationship_options[$option->family_relationship] = $option->family_relationship;
            } 
        ?>

        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-list-ul"></i>
            </span>
        	<?php echo form_dropdown('key['.$key->key_class_id.']['.$key->key_id.']',$family_relationship_options, '', 'class="form-control select2me" id="family_category"') ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('select.select2me').select2({
        placeholder: "Select an option",
        allowClear: true
    });
</script>