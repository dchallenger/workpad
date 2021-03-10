   
<div class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('applicants.id_no') }}</div>
		<div class="tools">
			<a class="collapse" href="javascript:;"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- START FORM -->
        <div class="form-horizontal">
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-4">{{ lang('applicants.tin') }}</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="recruitment_personal[tin_number]" id="recruitment_personal-tin_number" value="{{ $record['tin_number'] }}" placeholder="Enter TIN"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">{{ lang('applicants.sss_no') }}</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="recruitment_personal[sss_number]" id="recruitment_personal-sss_number" value="{{ $record['sss_number'] }}" placeholder="Enter SSS Number"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">{{ lang('applicants.pagibig_no') }}</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="recruitment_personal[pagibig_number]" id="recruitment_personal-pagibig_number" value="{{ $record['pagibig_number'] }}" placeholder="Enter Pagibig Number"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">{{ lang('applicants.philhealth_no') }}</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="recruitment_personal[philhealth_number]" id="recruitment_personal-philhealth_number" value="{{ $record['philhealth_number'] }}" placeholder="Enter Philhealth Number"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">{{ lang('applicants.driver_license_no') }}</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="recruitment_personal[drivers_license_no]" id="recruitment_personal-bank_account_number_savings" value="{{ $record['drivers_license_no'] }}" placeholder="Enter {{ lang('applicants.driver_license_no') }}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">{{ lang('applicants.passport_no') }}</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="recruitment_personal[passport_no]" id="recruitment_personal-bank_account_number_savings" value="{{ $record['passport_no'] }}" placeholder="Enter {{ lang('applicants.passport_no') }}"/>
                    </div>
                </div>
            </div>                            
            <div class="form-actions fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-offset-4 col-md-8">
                            <button class="btn green btn-sm" type="button" onclick="save_partner( $(this).parents('form') )"><i class="fa fa-check"></i> {{ lang('common.save') }} @if (empty($record['record_id'])) and {{ lang('common.next') }} @endif</button>
                            <button class="btn blue btn-sm" type="submit"><i class="fa fa-undo"></i> {{ lang('common.reset') }}</button>
                            <a class="btn default btn-sm" href="{{ $mod->url }}" type="button" >{{ lang('common.back_to_list') }}</a>                               
                        </div>
                    </div>
                </div>
            </div>            
        </div>
	</div>
</div>