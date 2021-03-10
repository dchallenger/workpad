<?php
    $city = '';
    $country = '';

    $db->select('city_id,city');
    $db->where('deleted', '0');
    $db->order_by('city');
    $options = $db->get('cities');
    $partners_city_options = array('' => '');
    foreach($options->result() as $option) {
        $partners_city_options[$option->city_id] = $option->city;
        if ($record['emergency_city'] == $option->city_id)
            $city = $option->city;
    }

    $db->select('country_id,short_name');
    $db->where('deleted', '0');
    $db->order_by('short_name');
    $options = $db->get('countries');

    $partners_country_options = array('' => '');
    foreach($options->result() as $option) {
        $partners_country_options[$option->country_id] = $option->short_name;
        if ($record['emergency_country'] == $option->country_id)
            $country = $option->short_name;
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
<div class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('applicants.emergency_contact') }}</div>
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
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.name') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['emergency_name'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">            
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.relationship') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['emergency_relationship'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group hidden-sm hidden-xs">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.phone') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['emergency_phone'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group hidden-sm hidden-xs">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.mobile') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['emergency_mobile'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.address') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['emergency_address'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.city') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $city }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.country') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $country }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.zip') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['emergency_zip_code'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions fluid">
            <div class="row">
                <div class="col-md-12">
                    <div align="center">
                        <a class="btn default btn-sm" href="{{ $mod->url }}" type="button" >{{ lang('common.back_to_list') }}</a>                              
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>