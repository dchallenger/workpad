<div class="form-actions fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-offset-4 col-md-9">
          @if(in_array($record['incident_status_id'], array(9,10,11)))
            <!-- <button onclick="save_record( $(this).closest('form'), 6)" class="btn green btn-sm" type="button"> Close Report</button> -->
          @endif
        <a class="btn btn-default btn-sm" href="{{ $mod->url }}">{{ lang('common.back_to_list') }}</a>
                                                                          
      </div>
    </div>
  </div>
</div>