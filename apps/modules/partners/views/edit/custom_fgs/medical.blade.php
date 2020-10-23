<div class="portlet">
	<div class="portlet-title">
		<div class="caption" id="education-category">{{ lang('partners.medical_records') }}</div>
		<div class="actions">
            <a class="btn btn-default" onclick="add_form('medical', 'medical')">
                <i class="fa fa-plus"></i>
            </a>
		</div>
	</div>
</div>

<!-- Previous Trainings : start doing the loop-->
<div id="personal_medical">
    <?php $medical_count = count($medical_tab); ?>
    <input type="hidden" name="medical_count" id="medical_count" value="{{ $medical_count }}" />
    <?php 
    $count_medical = 0;
    foreach($medical_tab as $index => $medical){ 
        $count_medical++;
?>
<div class="portlet">
	<div class="portlet-title">
		<!-- <div class="caption" id="education-category">Company Name</div> -->
		<div class="tools">
            <a class="text-muted" id="delete_medical_tab-<?php echo $count_medical;?>" onclick="remove_form(this.id, 'medical_tab', 'history')" href="#" style="margin-botom:-15px;"><i class="fa fa-trash-o"></i> Delete</a>
			<!-- <a class="collapse pull-right" href="javascript:;"></a> -->
		</div>
	</div>
	<div class="portlet-body form">
        <div class="form-horizontal">
            <div class="form-body">
		<!-- START FORM -->
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.medical_exam_type') }}</label>
                    <div class="col-md-6">
                        <?php   $db->select('medical_exam_type_id,medical_exam_type');
                                $db->where('deleted', '0');
                                $db->order_by('medical_exam_type');
                                $options = $db->get('partners_medical_exam_type');

                                $partners_medical_exam_type_options = array('' => '');
                                foreach($options->result() as $option)
                                {
                                    $partners_medical_exam_type_options[$option->medical_exam_type_id] = $option->medical_exam_type;
                                } ?>                        
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-list-ul"></i>
                             </span>
                        {{ form_dropdown('partners_personal_history[medical-exam-type][]',$partners_medical_exam_type_options, $medical['medical-exam-type'], 'class="form-control select2me" data-placeholder="Select..."') }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.medical_date_exam') }}<span class="required">*</span></label>
                    <div class="col-md-5">
                        <div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
                            <input type="text" class="form-control" name="partners_personal_history[medical-date-exam][]" id="partners-medical-date-exam" value="{{(isset($medical['medical-date-exam']) ? $medical['medical-date-exam'] : "")}}" placeholder="{{ lang('common.enter') }} {{ lang('partners.medical_date_exam') }}">
                            <span class="input-group-btn">
                            <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
                        </div>
                    </div>
                </div>                        
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.medical_clinic_hospital') }}</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="partners_personal_history[medical-clinic-hospital][]" id="partners_personal_history-medical-clinic-hospital" 
                        value="<?php echo (isset($medical['medical-clinic-hospital']) ? $medical['medical-clinic-hospital'] : ""); ?>" placeholder="{{ lang('common.enter') }} {{ lang('partners.medical_clinic_hospital') }}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.medical_pre_existing') }}</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="partners_personal_history[medical-pre-existing][]" id="partners_personal_history-medical-pre-existing" 
                        value="<?php echo (isset($medical['medical-pre-existing']) ? $medical['medical-pre-existing'] : ""); ?>" placeholder="{{ lang('common.enter') }} {{ lang('partners.medical_pre_existing') }}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.medical_findings') }}</label>
                    <div class="col-md-6">
                        <textarea rows="3" class="form-control" name="partners_personal_history[medical-findings][]" id="partners_personal_history-medical-findings" ><?php echo (isset($medical['medical-findings']) ? $medical['medical-findings'] : ""); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.medical_status') }}</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="partners_personal_history[medical-status][]" id="partners_personal_history-medical-status" 
                        value="<?php echo (isset($medical['medical-status']) ? $medical['medical-status'] : ""); ?>" placeholder="{{ lang('common.enter') }} {{ lang('partners.medical_status') }}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.medical_cost') }}</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="partners_personal_history[medical-cost][]" id="partners_personal_history-medical-cost" 
                        value="<?php echo (isset($medical['medical-cost']) ? $medical['medical-cost'] : ""); ?>" placeholder="{{ lang('common.enter') }} {{ lang('partners.medical_cost') }}" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
<?php } ?>
</div>
<div class="form-actions fluid">
    <div class="row" align="center">
        <div class="col-md-12">
            <button class="btn green btn-sm" type="button" onclick="save_partner( $(this).parents('form') )" ><i class="fa fa-check"></i> {{ lang('common.save') }}</button>
            <button class="btn blue btn-sm form-undo" type="submit"><i class="fa fa-undo"></i> {{ lang('common.reset') }}</button>                               
            <a href="<?php echo $back_url;?>" class="btn default btn-sm">{{ lang('common.back_to_list') }}</a>
        </div>
    </div>
</div>
