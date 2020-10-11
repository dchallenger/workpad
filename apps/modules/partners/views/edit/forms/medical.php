<?php
$db->select('medical_exam_type_id,medical_exam_type');
$db->where('deleted', '0');
$db->order_by('medical_exam_type');
$options = $db->get('partners_medical_exam_type');

$partners_medical_exam_type_options = array('' => '');
foreach($options->result() as $option)
{
    $partners_medical_exam_type_options[$option->medical_exam_type_id] = $option->medical_exam_type;
}

?>
<div class="portlet">
	<div class="portlet-title">
		<!-- <div class="caption" id="education-category">Company Name</div> -->
		<div class="tools">
            <a class="text-muted" id="delete_medical_tab-<?php echo $count;?>" onclick="remove_form(this.id, 'medical_tab', 'history')" href="#" style="margin-botom:-15px;"><i class="fa fa-trash-o"></i> Delete</a>
			<!-- <a class="collapse pull-right" href="javascript:;"></a> -->
		</div>
	</div>
	<div class="portlet-body form">
        <div class="form-horizontal">
            <div class="form-body">
		<!-- START FORM -->
                <div class="form-group">
                    <label class="control-label col-md-3"><?php echo lang('partners.medical_exam_type') ?></label>
                    <div class="col-md-6">                      
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-list-ul"></i>
                            </span>
                            <select  class="form-control form-select" data-placeholder="Select..." name="partners_personal_history[medical-exam-type][]" id="partners_personal_history-medical-exam-type">
                                <option value=""></option>
                            <?php
                                foreach($options->result() as $option) {
                            ?>
                                    <option value="<?php echo $option->medical_exam_type_id ?>"><?php echo $option->medical_exam_type ?></option>
                            <?php
                                }
                            ?>                                
                            </select>                               
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3"><?php echo lang('partners.medical_date_exam') ?><span class="required">*</span></label>
                    <div class="col-md-5">
                        <div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
                            <input type="text" class="form-control" name="partners_personal_history[medical-date-exam][]" id="partners-medical-date-exam" placeholder="<?php echo lang('common.enter') ?> <?php echo lang('partners.medical_date_exam') ?>">
                            <span class="input-group-btn">
                            <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
                        </div>
                    </div>
                </div>                        
                <div class="form-group">
                    <label class="control-label col-md-3"><?php echo lang('partners.medical_clinic_hospital') ?></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="partners_personal_history[medical-clinic-hospital][]" id="partners_personal_history-medical-clinic-hospital" 
                        value="" placeholder="<?php echo lang('common.enter') ?> <?php echo lang('partners.medical_clinic_hospital') ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3"><?php echo lang('partners.medical_pre_existing') ?></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="partners_personal_history[medical-pre-existing][]" id="partners_personal_history-medical-pre-existing" 
                        value="" placeholder="<?php echo lang('common.enter') ?> <?php echo lang('partners.medical_pre_existing') ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3"><?php echo lang('partners.medical_findings') ?></label>
                    <div class="col-md-6">
                        <textarea rows="3" class="form-control" name="partners_personal_history[medical-findings][]" id="partners_personal_history-medical-findings" ></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3"><?php echo lang('partners.medical_status') ?></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="partners_personal_history[medical-status][]" id="partners_personal_history-medical-status" 
                        value="" placeholder="<?php echo lang('common.enter') ?> <?php echo lang('partners.medical_status') ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3"><?php echo lang('partners.medical_cost') ?></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="partners_personal_history[medical-cost][]" id="partners_personal_history-medical-cost" 
                        value="" placeholder="<?php echo lang('common.enter') ?> <?php echo lang('partners.medical_cost') ?>" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
<script language="javascript">
jQuery(document).ready(function() { 
    $('select.form-select').select2({
        placeholder: "Select an option",
        allowClear: true        
    });  
    
    customHandleUniform();
});
</script>
