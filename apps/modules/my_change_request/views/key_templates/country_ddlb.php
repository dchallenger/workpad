<?php
    $db->select('country_id,short_name');
    $db->where('deleted', '0');
    $db->order_by('short_name');
    $options = $db->get('countries');

    $partners_country_options = array('' => '');
    foreach($options->result() as $option) {
        $partners_country_options[$option->country_id] = $option->short_name;
    }    
?>
<div class="form-group">
    <label class="control-label col-md-3"><?php echo $key->key_label?></label>
    <div class="col-md-7">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-list-ul"></i>
            </span>
            <?php echo form_dropdown('key['.$key->key_class_id .']['.$key->key_id .']',$partners_country_options, $value, 'class="form-control select2me" data-placeholder="Select..." id="partners_personal-present_city"') ?>
        </div>
    </div>
<!--     <div class="col-md-7">
        <div class="input-group" id="countryTags">
            <span class="input-group-addon">
                <i class="fa fa-map-marker"></i>
            </span>
            <input type="text" class="form-control tags" name="key[<?php echo $key->key_class_id ?>][<?php echo $key->key_id ?>]" id="country-tags" value="<?php echo $value ?>"/>
        </div>
    </div> -->    
</div>
<script>
	init_country()
</script>