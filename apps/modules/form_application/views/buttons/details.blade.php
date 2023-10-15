<div class="form-actions fluid" align="center">
    <div class="row">
        <div class="col-md-12">
            <div class="">
            	@if (in_array($form_status_id['val'],[2,3,4]))
            		<a href="javascript:void(null)" data-record-id="{{ $record_id }}" class="cancelled btn btn-sm btn-danger">Cancel</a>
            	@endif
            	<a href="{{ $mod->url }}" class="btn btn-default btn-sm">{{ lang('form_application.back_tolist') }}</a>
            </div>
        </div>
    </div>
</div>