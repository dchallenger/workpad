<div class="form-actions fluid">
  <div class="row" align="center">
      <div>
      		@if (in_array($participant_info['participant_status_id'],array(1)))
	   			<button type="button" class="btn green btn-sm" onclick="save_record( $(this).closest('form'), '2', 'Confirm')"><i class="fa fa-check"></i> Confirm</button>
	   			<button type="button" class="btn red btn-sm" onclick="save_record( $(this).closest('form'), '6', 'Disapprove')">Disapprove</button>
	   		@endif
        	<a class="btn default btn-sm" href="{{ $mod->url }}">{{ lang('common.back') }}</a>
      </div>
  </div>
</div>