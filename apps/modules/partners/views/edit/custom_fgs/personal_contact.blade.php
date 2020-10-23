<?php
    $db->select('city_id,city');
    $db->where('deleted', '0');
    $db->order_by('city');
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
		<div class="caption">{{ lang('partners.personal_contact') }}</div>
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
                            <input type="text" class="form-control" name="partners_personal[phone]" id="partners_personal-profile_telephones" value="{{ $profile_telephones }}" placeholder="Enter Telephone Number" data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false"/>
                        </div>                            
                    </div>
                </div>
                @endif
                @if(in_array('mobile', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.mobile') }}</label>
                    <div class="col-md-5">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-mobile"></i></span>                            
                            <input type="text" class="form-control" name="partners_personal[mobile]" id="partners_personal-profile_mobiles" value="{{ $profile_mobiles }}" placeholder="Enter Mobile Number" data-inputmask="'mask': '9', 'repeat': 12, 'greedy' : false"/>
                        </div>
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.email') }}</label>
                    <div class="col-md-5">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>                            
                            <input type="text" class="form-control" name="users[email]" id="users-email" value="{{ $record['users.email'] }}" placeholder="Enter Email Address"/>
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