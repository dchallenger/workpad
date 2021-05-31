<div class="form-actions fluid">
  <div class="row" align="center">
    <div class="col-md-11">
    	@if($record['status'] < 3 && $can_approve)
      		<a type="button" class="btn green btn-sm" href="javascript:change_status({{ $record['personal_request_header_id'] }},3)"><i class="fa fa-check"></i> {{ lang('common.approve') }}</a>
      	@endif
      	@if($record['status'] == 2 && $can_approve)
      		<a type="button" class="btn red btn-sm" href="javascript:change_status({{ $record['personal_request_header_id'] }},4)"><i class="fa fa-times"></i> {{ lang('common.decline') }}</a>
      	@endif
      	<a class="btn default btn-sm" href="{{ $mod->url }}">{{ lang('common.back') }}</a>
    </div>
  </div>
</div>