<?php
    $db->select('city_id,city');
    $db->where('deleted', '0');
    $db->order_by('city');
    $options = $db->get('cities');
    $partners_city_options = array('' => '');
    foreach($options->result() as $option) {
        $partners_city_options[$option->city_id] = $option->city;
    }
?>
<div class="form-group">
    <label class="control-label col-md-3"><?php echo $key->key_label?></label>
    <div class="col-md-7">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-list-ul"></i>
            </span>
            <?php echo form_dropdown('key['.$key->key_class_id .']['.$key->key_id .']',$partners_city_options, $value, 'class="form-control select2me" data-placeholder="Select..." id="partners_personal-present_country"') ?>
        </div>
    </div>
<!--     <div class="col-md-7">
        <div class="input-group" id="citiesTags">
            <span class="input-group-addon">
                <i class="fa fa-map-marker"></i>
            </span>
            <input type="text" class="form-control tags" name="key[<?php echo $key->key_class_id ?>][<?php echo $key->key_id ?>]" id="cities-tags" value="<?php echo $value ?>"/>
        </div>
    </div> -->    
</div>
<script>
	init_city();
</script>