<div class="form-actions fluid">
  <div class="row" align="center">
      <div>
        <?php
        	switch( $record['training_application_training_status_id'] ):
        		case '3':?>
        			<button type="button" class="btn green btn-sm" onclick="save_record( $(this).closest('form'), '7', 'approve')"><i class="fa fa-check"></i> {{ lang('common.approve') }}</button>
        			<button type="button" class="btn red btn-sm" onclick="save_record( $(this).closest('form'), '8', 'disapprove')">{{ lang('common.disapprove') }}</button> <?php
        			break;
        	endswitch;
        ?>
        <a class="btn default btn-sm" href="{{ $mod->url }}">{{ lang('common.back') }}</a>
      </div>
  </div>
</div>