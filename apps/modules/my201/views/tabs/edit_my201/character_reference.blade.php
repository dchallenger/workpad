<?php
    $db->select('city_id,CONCAT (city,", ",province) as city',false);
    $db->where('cities.deleted', '0');
    $db->order_by('city');
    $db->join('province','province.province_id = cities.province_id');
    $options = $db->get('cities');
    $partners_city_options = array('' => '');
    foreach($options->result() as $option) {
        $partners_city_options[$option->city_id] = $option->city;
    }

    $db->select('country_id,short_name');
    $db->where('deleted', '0');
    $db->order_by('short_name');
    $options = $db->get('countries');

    $partners_country_options = array('' => '');
    foreach($options->result() as $option) {
        $partners_country_options[$option->country_id] = $option->short_name;
    }

    $editable = false    
?>

<div class="portlet">
	<div class="portlet-title">
		<div class="caption" id="education-category">{{ lang('my201.character_ref') }}</div>
		@if(in_array('reference-name', $partners_keys))
            @if($is_editable['reference-name'])
                <div class="actions">
    	            <a class="btn btn-default" onclick="add_form('character_references', 'reference')">
    	                <i class="fa fa-plus"></i>
    	            </a>
    			</div>
            @endif
        @endif
    </div>
</div>

<!-- Previous Character reference : start doing the loop-->
<div id="personal_reference">
    <?php $reference_count = count($reference_tab); ?>
    <input type="hidden" name="reference_count" id="reference_count" value="{{ $reference_count }}" />
    <?php 
    $count_reference = 0;
    foreach($reference_tab as $index => $reference){ 
        $count_reference++;
?>
<div class="portlet">
    @if($editable)
	<div class="portlet-title">
	   <div class="tools">
				<a class="text-muted" id="delete_reference-<?php echo $count_reference;?>" onclick="remove_form(this.id, 'reference', 'history')" href="#" style="margin-botom:-15px;"><i class="fa fa-trash-o"></i> {{ lang('common.delete') }}</a>
				<!-- <a class="collapse pull-right" href="javascript:;"></a> -->
			</div>
	
	</div> 
    @endif
	<div class="portlet-body form">
        <div class="form-horizontal">
            <div class="form-body">
		<!-- START FORM -->	
			@if(in_array('reference-name', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('my201.name') }}<span class="required">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" {{ ($is_editable['reference-name'] == 1) ? '' : 'readonly="readonly"' }} name="partners_personal_history[reference-name][]" id="partners_personal_history-reference-name" 
                        value="<?php echo (isset($reference['reference-name']) ? $reference['reference-name'] : ""); ?>" placeholder="{{ lang('common.enter') }} {{ lang('my201.name') }}"/>
                    </div>
                </div>
            @endif
            @if(in_array('reference-occupation', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('my201.occupation') }}</label>
                    <div class="col-md-6">
                        <input type="text" {{ ($is_editable['reference-occupation'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal_history[reference-occupation][]" id="partners_personal_history-reference-occupation" 
                        value="<?php echo (isset($reference['reference-occupation']) ? $reference['reference-occupation'] : ""); ?>" placeholder="{{ lang('common.enter') }} {{ lang('my201.occupation') }}"/>
                    </div>
                </div>
            @endif
            @if(in_array('reference-years-known', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('my201.years_known') }}<span class="required">*</span></label>
                    <div class="col-md-6">
                        <input type="text" {{ ($is_editable['reference-years-known'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal_history[reference-years-known][]" id="partners_personal_history-reference-years-known" 
                        value="<?php echo (isset($reference['reference-years-known']) ? $reference['reference-years-known'] : ""); ?>" placeholder="{{ lang('common.enter') }} {{ lang('my201.years_known') }}"/>
                    </div>
                </div>
            @endif
            @if(in_array('reference-phone', $partners_keys))
                <div class="form-group hidden-sm hidden-xs">
                    <label class="control-label col-md-3">{{ lang('my201.phone') }}</label>
                    <div class="col-md-6">
                         <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input type="text" {{ ($is_editable['reference-phone'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal_history[reference-phone][]" id="partners_personal_history-reference-phone" 
                        value="<?php echo (isset($reference['reference-phone']) ? $reference['reference-phone'] : ""); ?>" placeholder="{{ lang('common.enter') }} {{ lang('my201.phone') }} {{ lang('my201.number') }}"/>
                         </div>
                    </div>
                </div>
            @endif
            @if(in_array('reference-mobile', $partners_keys))
                <div class="form-group hidden-sm hidden-xs">
                    <label class="control-label col-md-3">{{ lang('my201.mobile') }}</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                        <input type="text" {{ ($is_editable['reference-mobile'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal_history[reference-mobile][]" id="partners_personal_history-reference-mobile" 
                        value="<?php echo (isset($reference['reference-mobile']) ? $reference['reference-mobile'] : ""); ?>" placeholder="{{ lang('common.enter') }} {{ lang('my201.mobile') }} {{ lang('my201.number') }}"/>
                         </div>
                    </div>
                </div>
            @endif
            @if(in_array('reference-address', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('my201.address') }}</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-map-marker"></i>
                             </span>
                        <input type="text" {{ ($is_editable['reference-address'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal_history[reference-address][]" id="partners_personal_history-reference-address" 
                        value="<?php echo (isset($reference['reference-address']) ? $reference['reference-address'] : ""); ?>" placeholder="{{ lang('common.enter') }} {{ lang('my201.address') }}"/>
                         </div>
                    </div>
                </div>
            @endif
            <div class="form-group">
                <label class="control-label col-md-3">{{ lang('partners.city') }}</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-list-ul"></i>
                        </span>
                        {{ form_dropdown('partners_personal_history[reference-city][]',$partners_city_options, $reference['reference-city'], 'class="form-control select2me" data-placeholder="Select..." ($is_editable["reference-address"] == 1) ? "" : disabled') }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">{{ lang('partners.country') }}</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-list-ul"></i>
                        </span>
                        {{ form_dropdown('partners_personal_history[reference-country]',$partners_country_options, $reference['reference-country'], 'class="form-control select2me" data-placeholder="Select..." ($is_editable["reference-address"] == 1) ? "" : disabled') }}
                    </div>
                </div>
            </div>            
            @if(in_array('reference-zipcode', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('my201.zip') }}</label>
                    <div class="col-md-6">
                        <input type="text" {{ ($is_editable['reference-zipcode'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal_history[reference-zipcode][]" id="partners_personal_history-reference-zipcode" 
                        value="<?php echo (isset($reference['reference-zipcode']) ? $reference['reference-zipcode'] : ""); ?>" placeholder="{{ lang('common.enter') }} {{ lang('my201.zip') }}"/>
                    </div>
                </div>
            @endif
			</div>
		</div>
	</div>
</div>
<?php } ?>
</div>
<div class="form-actions fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-offset-3 col-md-8">
                @if($editable)
                    <button class="btn green btn-sm" type="button" onclick="save_partner( $(this).parents('form') )" ><i class="fa fa-check"></i> {{ lang('common.save') }}</button>
                    <button class="btn blue btn-sm form-undo" type="submit"><i class="fa fa-undo"></i> {{ lang('common.reset') }}</button>                               
                @endif
            </div>
        </div>
    </div>
</div>
