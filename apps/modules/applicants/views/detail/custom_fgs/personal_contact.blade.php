<?php
    $city_val = '';
    $country_val = '';

    $db->select('city_id,city');
    $db->where('deleted', '0');
    $db->order_by('city');
    $options = $db->get('cities');
    $partners_city_options = array('' => '');
    foreach($options->result() as $option) {
        $partners_city_options[$option->city_id] = $option->city;
        if ($option->city_id == $city)
            $city_val = $option->city;
    }

    $db->select('country_id,short_name');
    $db->where('deleted', '0');
    $db->order_by('short_name');
    $options = $db->get('countries');

    $partners_country_options = array('' => '');
    foreach($options->result() as $option) {
        $partners_country_options[$option->country_id] = $option->short_name;
        if ($option->country_id == $country)
            $country_val = $option->short_name;
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
        <div class="form-body">
            <div class="row">
                <div class="col-md-12">                
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.phone') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['phone'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.mobile') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['mobile'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">            
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.email') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['email'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.address') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['address_1'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.city') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $city_val }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.country') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $country_val }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                       
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.zip') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['zip_code'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>