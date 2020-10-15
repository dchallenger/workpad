<div class="form-actions fluid" align="center">
  <div class="row" align="center">
    <div class="col-md-12">
        <button type="button" class="btn blue btn-sm" onclick="save_record( $(this).closest('form'), 1)"> {{ lang('common.save_draft') }}</button>
        <button type="button" class="btn green btn-sm" onclick="save_record( $(this).closest('form'), 2)"><i class="fa fa-check"></i> {{ lang('common.submit') }}</button>
        <button type="button" class="btn red btn-sm" onclick="save_record( $(this).closest('form'), 6)"> {{ lang('common.cancel') }}</button>
        <!-- <button type="button" class="btn blue btn-sm" onclick="save_record( $(this).closest('form'), 'new')"> Save &amp; Add New</button> -->
        <a class="btn default btn-sm" href="{{ $mod->url }}">{{ lang('common.back_to_list') }}</a>
    </div>
  </div>
</div>