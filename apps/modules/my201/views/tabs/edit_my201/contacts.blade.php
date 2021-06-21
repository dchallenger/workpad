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

    $db->select('relationship_id,relationship');
    $db->where('deleted', '0');
    $db->order_by('relationship');
    $options = $db->get('relationship');
    $relationship_options = array('' => '');
    foreach($options->result() as $option) {
        $relationship_options[$option->relationship] = $option->relationship;
    }        
?>

<!-- put this line if need editable or not -->
<!-- {{ $is_editable['address_1'] == 1 ? '' : 'readonly="readonly"' }} -->

<!-- Contact Information -->
<div class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('my201.personal_contact') }}</div>
		<div class="tools">
			<a class="collapse" href="javascript:;"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- START FORM -->
		<div class="form-horizontal">
			<div class="form-body">
                <div>Present Address:</div>
                <br>
                @if(in_array('address_1', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.address') }}</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-map-marker"></i>
                            </span>
                        	<input type="text" class="form-control" name="partners_personal[address_1]" id="partners_personal-address_1" value="{{ $address_1 }}" placeholder="Enter Address"/>
                        </div>
                    </div>
                </div>
                @endif
                @if(in_array('city_town', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.city') }}</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                            {{ form_dropdown('partners_personal[city_town]',$partners_city_options, $city, 'class="form-control select2me" data-placeholder="Select..." id="partners_personal-present_city"') }}
                        </div>
                    </div>
                </div>
                @endif
                @if(in_array('country', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.country') }}</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                            {{ form_dropdown('partners_personal[country]',$partners_country_options, $country, 'class="form-control select2me" data-placeholder="Select..." id="partners_personal-present_country"') }}
                        </div>
                    </div>
                </div>
                @endif
                @if(in_array('zip_code', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.zip') }}</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="partners_personal[zip_code]" id="partners_personal-zip_code" value="{{ $zip_code }}" placeholder="Enter Zipcode"/>
                    </div>
                </div>
                @endif

                <div>Permanent Address: <span>&nbsp;&nbsp;<input type="checkbox" id="same_present" value="1">Same as Present Address</span></div>
                <br>
                @if(in_array('permanent_address', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.address') }}</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-map-marker"></i>
                            </span>
                        <input type="text" class="form-control" name="partners_personal[permanent_address]" id="partners_personal-permanent_address" value="{{ $permanent_address }}" placeholder="Enter Address"/>
                         </div>
                    </div>
                </div>
                @endif
                @if(in_array('permanent_city_town', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.city') }}</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                            {{ form_dropdown('partners_personal[permanent_city_town]',$partners_city_options, $permanent_city_town, 'class="form-control select2me" data-placeholder="Select..." id="partners_personal-permanent_city"') }}
                        </div>
                    </div>
                </div>
                @endif
                @if(in_array('permanent_country', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.country') }}</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                            {{ form_dropdown('partners_personal[permanent_country]',$partners_country_options, $permanent_country, 'class="form-control select2me" data-placeholder="Select..." id="partners_personal-permanent_country"') }}
                        </div>
                    </div>
                </div>
                @endif
                @if(in_array('permanent_zipcode', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.zip') }}</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="partners_personal[permanent_zipcode]" id="partners_personal-permanent_zipcode" value="{{ $permanent_zipcode }}" placeholder="Enter Zipcode"/>
                    </div>
                </div>
                @endif 

                <div>Office:</div>
                <br>                            
                @if(in_array('phone', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.phone') }}</label>
                    <div class="col-md-5">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input type="text" class="form-control" name="partners_personal[phone]" id="partners_personal-profile_telephones" value="{{ $office_telephones }}" placeholder="Enter Telephone Number" data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false"/>
                        </div>                            
                    </div>
                </div>
                @endif
                @if(in_array('mobile', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.mobile') }}</label>
                    <div class="col-md-5">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-mobile"></i></span>                            
                            <input type="text" class="form-control" name="partners_personal[mobile]" id="partners_personal-profile_mobiles" value="{{ $office_mobiles }}" placeholder="Enter Mobile Number" data-inputmask="'mask': '9', 'repeat': 12, 'greedy' : false"/>
                        </div>
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.email') }}</label>
                    <div class="col-md-5">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>                            
                            <input type="text" class="form-control" name="users[email]" id="users-email" value="{{ $profile_email }}" placeholder="Enter Email Address"/>
                        </div>
                    </div>
                </div>

                <div>Personal:</div>
                <br>
                @if(in_array('personal_phone', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.phone') }}</label>
                    <div class="col-md-5">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input type="text" class="form-control" name="partners_personal[personal_phone]" id="partners_personal-personal_telephone" value="{{ $personal_telephone }}" placeholder="Enter Telephone Number" data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false"/>
                        </div>
                    </div>
                </div>
                @endif
                @if(in_array('personal_mobile', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.mobile') }}</label>
                    <div class="col-md-5">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-mobile"></i></span>                            
                            <input type="text" class="form-control" name="partners_personal[personal_mobile]" id="partners_personal-personal_mobile" value="{{ $personal_mobile }}" placeholder="Enter Mobile Number" data-inputmask="'mask': '9', 'repeat': 12, 'greedy' : false"/>
                        </div>
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.email') }}</label>
                    <div class="col-md-5">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>                            
                            <input type="text" class="form-control" name="partners_personal[personal_email]" id="users-personal_email" value="{{ $personal_email }}" placeholder="Enter Email Address"/>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
	</div>
</div>

<!-- Emergency Contact -->
<div class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('my201.emergency_contact') }}</div>
		<div class="tools">
			<a class="collapse" href="javascript:;"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- START FORM -->
		<div class="form-horizontal" >
			<div class="form-body">
			@if(in_array('emergency_name', $partners_keys))
				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3">{{ lang('my201.name') }} :</label>
						<div class="col-md-5">
                            <input type="text" class="form-control" {{ $is_editable['emergency_name'] == 1 ? '' : 'readonly="readonly"' }} name="partners_personal[emergency_name]" id="partners_personal-emergency_name" value="{{ $emergency_name }}" placeholder="{{ lang('common.enter') }} {{ lang('my201.name') }}"/>
                        </div>
					</div>
				</div>
			@endif
			@if(in_array('emergency_relationship', $partners_keys))
				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3">{{ lang('my201.relationship') }} :</label>
						<div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-list-ul"></i>
                                </span>
                                {{ form_dropdown('partners_personal[emergency_relationship]',$relationship_options, $emergency_relationship, 'class="form-control select2me" data-placeholder="Select..."') }}
                            </div>
                        </div>
					</div>
				</div>
			@endif
			@if(in_array('emergency_phone', $partners_keys))
				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 text-right">{{ lang('my201.phone') }} :</label>
						<div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            	<input type="text" class="form-control"  {{ $is_editable['emergency_phone'] == 1 ? '' : 'readonly="readonly"' }} name="partners_personal[emergency_phone]" id="partners_personal-emergency_phone" value="{{ $emergency_phone }}" placeholder="{{ lang('common.enter') }} {{ lang('my201.phone') }} {{ lang('my201.number') }}"/>
                            </div>
                        </div>
					</div>
				</div>
			@endif
			@if(in_array('emergency_mobile', $partners_keys))
				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 text-right">{{ lang('my201.mobile') }} :</label>
						<div class="col-md-5">
	                        <div class="input-group">
	                            <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
	                        <input type="text" class="form-control" {{ $is_editable['emergency_mobile'] == 1 ? '' : 'readonly="readonly"' }} name="partners_personal[emergency_mobile]" id="partners_personal-emergency_mobile" value="{{ $emergency_mobile }}" placeholder="{{ lang('common.enter') }} {{ lang('my201.mobile') }} {{ lang('my201.number') }}"/>
	                         </div>
	                    </div>
					</div>
				</div>
			@endif
			@if(in_array('emergency_address', $partners_keys))
				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 text-right">{{ lang('my201.address') }} :</label>
						<div class="col-md-5">
	                        <div class="input-group">
	                            <span class="input-group-addon">
	                               <i class="fa fa-map-marker"></i>
	                             </span>
	                             <input type="text" {{ $is_editable['emergency_address'] == 1 ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal[emergency_address]" id="partners_personal-emergency_address" value="{{ $emergency_address }}" placeholder="{{ lang('common.enter') }} {{ lang('my201.address') }}"/>
	                         </div>
	                    </div>
					</div>
				</div>
			@endif
            @if(in_array('emergency_city', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('my201.city') }}</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                            {{ form_dropdown('partners_personal[emergency_city]',$partners_city_options, $emergency_city, 'class="form-control select2me" data-placeholder="Select..."') }}
                        </div>
                    </div>
                </div>
            @endif
            @if(in_array('emergency_country', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('my201.country') }}</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                            {{ form_dropdown('partners_personal[emergency_country]',$partners_country_options, $emergency_country, 'class="form-control select2me" data-placeholder="Select..."') }}
                        </div>
                    </div>
                </div>
            @endif
			@if(in_array('emergency_zip_code', $partners_keys))
				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 text-right">{{ lang('my201.zip') }} :</label>
						 <div class="col-md-5">
	                        <input type="text" class="form-control" {{ $is_editable['emergency_country'] == 1 ? '' : 'readonly="readonly"' }} name="partners_personal[emergency_zip_code]" id="partners_personal-emergency_zip_code" value="{{ $emergency_zip_code }}" placeholder="{{ lang('common.enter') }} {{ lang('my201.zip') }}"/>
	                    </div>
					</div>
				</div>
			@endif
			</div>
		    <div class="form-actions fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-offset-3 col-md-8">
                            <button class="btn green btn-sm" type="button" onclick="save_partner( $(this).parents('form') )"><i class="fa fa-check"></i> {{ lang('common.save') }}</button>
                            <button class="btn blue btn-sm" type="submit"><i class="fa fa-undo"></i> {{ lang('common.reset') }}</button>                               
                        </div>
                    </div>
                </div>
            </div>			
		</div>

	</div>
</div>