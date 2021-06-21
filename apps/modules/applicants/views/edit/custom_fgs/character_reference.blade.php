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
?>
<div class="portlet">
	<div class="portlet-title">
		<div class="caption" id="education-category">{{ lang('applicants.character_ref') }}</div>
		<div class="actions">
            <a class="btn btn-default" onclick="add_form('character_references', 'reference')">
                <i class="fa fa-plus"></i>
            </a>
		</div>
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
	<div class="portlet-title">
		<!-- <div class="caption" id="education-category">Company Name</div> -->
		<div class="tools">
			<a class="text-muted" id="delete_reference-<?php echo $count_reference;?>" onclick="remove_form(this.id, 'reference', 'history')" href="#" style="margin-botom:-15px;"><i class="fa fa-trash-o"></i> {{ lang('common.delete') }}</a>
			<!-- <a class="collapse pull-right" href="javascript:;"></a> -->
		</div>
	</div>
	<div class="portlet-body form">
        <div class="form-horizontal">
            <div class="form-body">
		<!-- START FORM -->	
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('applicants.name') }}<span class="required">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="recruitment_personal_history[reference-name][]" id="recruitment_personal_history-reference-name" 
                        value="<?php echo (isset($reference['reference-name']) ? $reference['reference-name'] : ""); ?>" placeholder="Enter Name"/>
                    </div>
                </div>
<!--                 <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('applicants.relationship') }}</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="recruitment_personal_history[reference-relationship][]" id="recruitment_personal_history-reference-relationship" 
                        value="<?php echo (isset($reference['reference-relationship']) ? $reference['reference-relationship'] : ""); ?>" placeholder="Enter Relationship"/>
                    </div>
                </div> -->
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('applicants.occupation') }}</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="recruitment_personal_history[reference-occupation][]" id="recruitment_personal_history-reference-occupation" 
                        value="<?php echo (isset($reference['reference-occupation']) ? $reference['reference-occupation'] : ""); ?>" placeholder="Enter Occupation"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('applicants.org') }}</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="recruitment_personal_history[reference-organization][]" id="recruitment_personal_history-reference-organization" 
                        value="<?php echo (isset($reference['reference-organization']) ? $reference['reference-organization'] : ""); ?>" placeholder="Enter Organization"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('applicants.years_known') }}<span class="required">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="recruitment_personal_history[reference-years-known][]" id="recruitment_personal_history-reference-years-known" 
                        value="<?php echo (isset($reference['reference-years-known']) ? $reference['reference-years-known'] : ""); ?>" placeholder="Enter Years Known" data-inputmask="'mask': '9', 'repeat': 2, 'greedy' : false"/>
                    </div>
                </div>
                <div class="form-group hidden-sm hidden-xs">
                    <label class="control-label col-md-3">{{ lang('applicants.phone') }}</label>
                    <div class="col-md-6">
                         <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input type="text" class="form-control" name="recruitment_personal_history[reference-phone][]" id="recruitment_personal_history-reference-phone" 
                        value="<?php echo (isset($reference['reference-phone']) ? $reference['reference-phone'] : ""); ?>" placeholder="Enter Telephone Number" data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false"/>
                         </div>
                    </div>
                </div>
                <div class="form-group hidden-sm hidden-xs">
                    <label class="control-label col-md-3">{{ lang('applicants.mobile') }}</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                        <input type="text" class="form-control" name="recruitment_personal_history[reference-mobile][]" id="recruitment_personal_history-reference-mobile" 
                        value="<?php echo (isset($reference['reference-mobile']) ? $reference['reference-mobile'] : ""); ?>" placeholder="Enter Mobile Number" data-inputmask="'mask': '9', 'repeat': 12, 'greedy' : false"/>
                         </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('applicants.address') }}</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-map-marker"></i>
                             </span>
                        <input type="text" class="form-control" name="recruitment_personal_history[reference-address][]" id="recruitment_personal_history-reference-address" 
                        value="<?php echo (isset($reference['reference-address']) ? $reference['reference-address'] : ""); ?>" placeholder="Enter Address"/>
                         </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('applicants.city') }}</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                            {{ form_dropdown('recruitment_personal_history[reference-city][]',$partners_city_options, $reference['reference-city'], 'class="form-control select2me" data-placeholder="Select..."') }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('applicants.country') }}</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                            {{ form_dropdown('recruitment_personal_history[reference-country][]',$partners_country_options, $reference['reference-country'], 'class="form-control select2me" data-placeholder="Select..."') }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('applicants.zip') }}</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="recruitment_personal_history[reference-zipcode][]" id="recruitment_personal_history-reference-zipcode" 
                        value="<?php echo (isset($reference['reference-zipcode']) ? $reference['reference-zipcode'] : ""); ?>" placeholder="Enter Zipcode"/>
                    </div>
                </div>

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
                <button class="btn green btn-sm" type="button" onclick="save_partner( $(this).parents('form') )" ><i class="fa fa-check"></i> Save</button>
                <button class="btn blue btn-sm" type="submit"><i class="fa fa-undo"></i> Reset</button>
                <a class="btn default btn-sm" href="{{ $mod->url }}" type="button" >Back to List</a>                               
            </div>
        </div>
    </div>
</div>
