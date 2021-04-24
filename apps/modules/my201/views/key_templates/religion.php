
<?php
    $db->select('religion_id,religion');
    $db->where('deleted', '0');
    $db->order_by('religion');
    $options = $db->get('religion');
    $partners_religion_options = array('' => '');
    foreach($options->result() as $option) {
        $partners_religion_options[$option->religion_id] = $option->religion;
    }   
?>

<div class="form-group">
    <label class="control-label col-md-3"><?php echo $key->key_label?></label>
    <div class="col-md-7">
       <div class="input-group">
            <span class="input-group-addon">
               <i class="fa fa-user"></i>
             </span>
            <?php echo form_dropdown('key['.$key->key_class_id .']['.$key->key_id .']',$partners_religion_options, $value, 'class="form-control select2me" data-placeholder="Select..." id="partners_personal-religion"') ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('select.select2me').select2({
        placeholder: "Select an option",
        allowClear: true
    });
</script>