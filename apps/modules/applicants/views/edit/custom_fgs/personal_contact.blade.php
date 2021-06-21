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
		<div class="caption">{{ lang('applicants.personal_contact') }}</div>
		<div class="tools">
			<a class="collapse" href="javascript:;"></a>
		</div>
	</div>
	<div class="portlet-body form">
        <!-- START FORM -->
        <div class="form-horizontal">
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('applicants.phone') }}</label>
                    <div class="col-md-5">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input type="text" class="form-control" name="recruitment_personal[phone]" id="recruitment_personal-phone" value="{{ $record['phone'] }}" placeholder="Enter Telephone Number" data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false"/>
                        </div>                            
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('applicants.mobile') }}</label>
                    <div class="col-md-5">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-mobile"></i></span>                            
                            <input type="text" class="form-control" name="recruitment_personal[mobile]" id="recruitment_personal-mobile" value="{{ $record['mobile'] }}" placeholder="Enter Mobile Number" data-inputmask="'mask': '9', 'repeat': 12, 'greedy' : false"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('applicants.email') }}<span class="required">*</span></label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="recruitment[email]" id="recruitment-email" value="{{ $record['email'] }}" placeholder="Enter Email Address"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('applicants.address') }}</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-map-marker"></i>
                            </span>
                            <input type="text" class="form-control" name="recruitment_personal[address_1]" id="recruitment_personal-address_1" value="{{ $record['address_1'] }}" placeholder="Enter Street"/>
                         </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('applicants.city') }}</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                            {{ form_dropdown('recruitment_personal[city_town]',$partners_city_options, $city, 'class="form-control select2me" data-placeholder="Select..." id="recruitment_personal-city_town"') }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('applicants.country') }}</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                            {{ form_dropdown('recruitment_personal[country]',$partners_country_options, $country, 'class="form-control select2me" data-placeholder="Select..." id="recruitment_personal-country"') }}
                        </div>
                    </div>
                </div>
                <div class="form-group hidden">
                    <label class="control-label col-md-3">{{ lang('applicants.province') }}</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-map-marker"></i>
                             </span>
                        <input type="text" class="form-control" name="recruitment_personal[province]" id="recruitment_personal-province" value="{{ $record['province'] }}" placeholder="Enter Province"/>
                         </div>
                    </div>
                </div>                
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('applicants.zip') }}</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="recruitment_personal[zip_code]" id="recruitment_personal-zip_code" value="{{ $record['zip_code'] }}" placeholder="Enter Zipcode"/>
                    </div>
                </div>              
            </div>
        </div>
    </div>
</div>