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
<!-- Previous Character reference : start doing the loop-->
<div id="personal_reference">
    <?php $reference_count = count($reference_tab); ?>
    <input type="hidden" name="reference_count" id="reference_count" value="{{ $reference_count }}" />
    <?php 
    $count_reference = 0;
    foreach($reference_tab as $index => $reference){ 
        $count_reference++;

        $city_val = '';
        $country_val = '';

        if (isset($reference['reference-city']))
            $city_val = (isset($partners_city_options[$reference['reference-city']]) ? $partners_city_options[$reference['reference-city']] : "");

        if (isset($reference['reference-country']))
            $country_val = (isset($partners_country_options[$reference['reference-country']]) ? $partners_country_options[$reference['reference-country']] : "");        

?>
<div class="portlet">
	<div class="portlet-body form">
        <div class="form-body">
	        <!-- START FORM -->
            <div class="row">
                <div class="col-md-12">        
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.name') }} :</label>
                        <div class="col-md-6">
                            <span>@if (isset($reference['reference-name'])) {{ $reference['reference-name'] }} @endif</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.occupation') }} :</label>
                        <div class="col-md-6">
                            <span>@if (isset($reference['reference-occupation'])) {{ $reference['reference-occupation'] }} @endif</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.org') }} :</label>
                        <div class="col-md-6">
                            <span>@if (isset($reference['reference-organization'])) {{ $reference['reference-organization'] }} @endif</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.years_known') }} :</label>
                        <div class="col-md-6">
                            <span>@if (isset($reference['reference-years-known'])) {{ $reference['reference-years-known'] }} @endif</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group hidden-sm hidden-xs">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.phone') }} :</label>
                        <div class="col-md-6">
                            <span>@if (isset($reference['reference-phone'])) {{ $reference['reference-phone'] }} @endif</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group hidden-sm hidden-xs">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.mobile') }} :</label>
                        <div class="col-md-6">
                            <span>@if (isset($reference['reference-mobile'])) {{ $reference['reference-mobile'] }} @endif</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.address') }} :</label>
                        <div class="col-md-6">
                            <span>@if (isset($reference['reference-address'])) {{ $reference['reference-address'] }} @endif</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.city') }} :</label>
                        <div class="col-md-6">
                            <span>{{  $city_val  }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.country') }} :</label>
                        <div class="col-md-6">
                            <span>{{  $country_val  }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.zip') }} :</label>
                        <div class="col-md-6">
                            <span>@if (isset($reference['reference-zipcode'])) {{ $reference['reference-zipcode'] }} @endif</span>
                        </div>
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
            <div align="center">
                <a class="btn default btn-sm" href="{{ $mod->url }}" type="button" >Back to List</a>                               
            </div>
        </div>
    </div>
</div>
