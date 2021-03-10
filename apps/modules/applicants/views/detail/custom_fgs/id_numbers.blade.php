   
<div class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('applicants.id_no') }}</div>
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
                        <label class="control-label text-right text-muted col-md-4">{{ lang('applicants.tin') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['tin_number'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-4">{{ lang('applicants.sss_no') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['sss_number'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-4">{{ lang('applicants.pagibig_no') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['pagibig_number'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-4">{{ lang('applicants.philhealth_no') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['philhealth_number'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-4">{{ lang('applicants.driver_license_no') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['drivers_license_no'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-4">{{ lang('applicants.passport_no') }} :</label>
                        <div class="col-md-5">
                            <span>{{ $record['passport_no'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>                            
        <div class="form-actions fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-offset-4 col-md-8">
                        <a class="btn default btn-sm" href="{{ $mod->url }}" type="button" >{{ lang('common.back_to_list') }}</a>                               
                    </div>
                </div>
            </div>
        </div>            
	</div>
</div>