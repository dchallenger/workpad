<div class="form-actions fluid">
  <div class="row" align="center">
      <div>
        <?php
        	switch( $record['training_application.status_id'] ):
        		case '':
        		case '0':
        		case '1':?>
        			<button type="button" class="btn blue btn-sm" onclick="save_record( $(this).closest('form'), '1', 'save')"> {{ lang('common.save_draft') }}</button>
        			<button type="button" class="btn green btn-sm" onclick="save_record( $(this).closest('form'), '4', 'submit')"><i class="fa fa-check"></i> {{ lang('common.submit') }} Request</button> <?php
        			break;
        	endswitch;
        ?>
        <a class="btn default btn-sm" href="{{ $mod->url }}">{{ lang('common.back') }}</a>
      </div>
  </div>
</div>