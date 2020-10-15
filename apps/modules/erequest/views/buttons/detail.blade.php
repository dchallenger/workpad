<div class="form-actions fluid">
  <div class="row" align="center">
    <div class="col-md-12">
        @if( isset($permission['edit']) && $permission['edit'] )
          @if(in_array($record['request_status_id'], array(1)))
        	 <a type="button" class="btn green btn-sm" href="{{ $mod->url . '/edit/' . $record_id }}"><i class="fa fa-check"></i> {{ lang('common.edit') }}</a>
          @endif
        @endif
        <a class="btn default btn-sm" href="{{ $mod->url }}">{{ lang('common.back_to_list') }}</a>
    </div>
  </div>
</div>