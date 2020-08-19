@if($appraisee->status_id != 6)
<button type="button" class="btn blue btn-sm" onclick="change_status( $(this).closest('form'), '99')"> {{ lang('common.save_draft') }}</button>
<button type="button" class="btn green btn-sm" onclick="change_status( $(this).closest('form'), 6 )"><i class="fa fa-check"></i> {{ lang('appraisal_individual_planning.send_back_to_employee') }}</button>
<button type="button" class="btn green btn-sm" onclick="change_status( $(this).closest('form'), 4 )"><i class="fa fa-check"></i> {{ lang('appraisal_individual_planning.approved') }}</button>
@endif