@if($appraisee->performance_status_id <= 1)
<button type="button" class="btn blue btn-sm" onclick="change_status( $(this).closest('form'), '1')"> {{ lang('common.save_draft') }}</button>
@endif
@if($appraisee->performance_status_id == 6)
<button type="button" class="btn blue btn-sm" onclick="change_status( $(this).closest('form'), '6')"> {{ lang('common.save_back') }}</button>
@endif
<button type="button" class="btn yellow btn-sm" onclick="change_status( $(this).closest('form'), 2 )"><i class="fa fa-check"></i> {{ lang('appraisal_individual_planning.send_to_approver') }}</button>
<!-- <button type="button" class="btn green btn-sm" onclick="change_status( $(this).closest('form'), 4 )"><i class="fa fa-check"></i> {{ lang('appraisal_individual_planning.approved') }}</button>
<button type="button" class="btn red btn-sm" onclick="change_status( $(this).closest('form'), 11 )"><i class="fa fa-check"></i> {{ lang('appraisal_individual_planning.disapprove') }}</button> -->
