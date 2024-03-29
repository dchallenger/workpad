<div class="portlet">
	<div class="portlet-title">
		<div class="caption" id="employment-category">{{ lang('applicants.employment_history') }}</div>
		<div class="actions">
            <a class="btn btn-default" onclick="add_form('employment_history', 'employment')">
                <i class="fa fa-plus"></i>
            </a>
		</div>
	</div>
</div>

<div id="personal_employment">
    <?php $employment_count = count($employment_tab); ?>
    <input type="hidden" name="employment_count" id="employment_count" value="{{ $employment_count }}" />
    <?php 
    $count_employment = 0;
    $months_options = array(
        '' => 'Select...',
        'January' => 'January', 
        'February' => 'February', 
        'March' => 'March', 
        'April' => 'April', 
        'May' => 'May', 
        'June' => 'June', 
        'July' => 'July', 
        'August' => 'August', 
        'September' => 'September', 
        'October' => 'October', 
        'November' => 'November', 
        'December' => 'December'
        );
    foreach($employment_tab as $index => $employment){ 
        $count_employment++;
    ?>
    <div class="portlet">
    	<div class="portlet-title">
    		<!-- <div class="caption" id="education-category">Company Name</div> -->
    		<div class="tools">
    			<a class="text-muted" id="delete_employment-<?php echo $count_employment;?>" onclick="remove_form(this.id, 'employment', 'history')" href="#" style="margin-botom:-15px;"><i class="fa fa-trash-o"></i> {{ lang('common.delete') }}</a>
    			<!-- <a class="collapse pull-right" href="javascript:;"></a> -->
    		</div>
    	</div>
    	<div class="portlet-body form">
            <div class="form-horizontal">
                <div class="form-body">
    		<!-- START FORM -->	
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('applicants.comp_name') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="recruitment_personal_history[employment-company][]" id="recruitment_personal_history-employment-company" 
                            value="<?php echo (isset($employment['employment-company']) ? $employment['employment-company'] : ""); ?>" placeholder="Enter Company"/>
                        </div>
                    </div>
<!--                     <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('applicants.industry') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="recruitment_personal_history[employment-nature-of-business][]" id="recruitment_personal_history-employment-nature-of-business" 
                            value="<?php echo (isset($employment['employment-nature-of-business']) ? $employment['employment-nature-of-business'] : ""); ?>" placeholder="Enter Industry"/>
                        </div>
                    </div> -->
    				<div class="form-group">
                        <label class="control-label col-md-3">{{ lang('applicants.pos_title') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="recruitment_personal_history[employment-position-title][]" id="recruitment_personal_history-employment-position-title" 
                            value="<?php echo (isset($employment['employment-position-title']) ? $employment['employment-position-title'] : ""); ?>" placeholder="Enter Position"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('applicants.location') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="recruitment_personal_history[employment-location][]" id="recruitment_personal_history-employment-location" 
                            value="<?php echo (isset($employment['employment-location']) ? $employment['employment-location'] : ""); ?>" placeholder="Enter Location"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('applicants.reason_leaving') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="recruitment_personal_history[employment-reason-for-leaving][]" id="recruitment_personal_history-employment-reason-for-leaving"  value="<?php echo (isset($employment['employment-reason-for-leaving']) ? $employment['employment-reason-for-leaving'] : ""); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('applicants.latest_salary') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="recruitment_personal_history[employment-latest-salary][]" id="recruitment_personal_history-employment-latest-salary" 
                            value="<?php echo (isset($employment['employment-latest-salary']) ? $employment['employment-latest-salary'] : ""); ?>" placeholder="<?php echo lang('applicants.latest_salary') ?>" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('applicants.name_immediate_superior') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="recruitment_personal_history[employment-supervisor][]" id="recruitment_personal_history-employment-supervisor" 
                            value="<?php echo (isset($employment['employment-supervisor']) ? $employment['employment-supervisor'] : ""); ?>" placeholder="<?php echo lang('applicants.name_immediate_superior') ?>"/>
                        </div>
                    </div>                     
<!--                     <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('applicants.contact_no') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="recruitment_personal_history[employment-contact-number][]" id="recruitment_personal_history-employment-contact-number" 
                            value="<?php echo (isset($employment['employment-contact-number']) ? $employment['employment-contact-number'] : ""); ?>" placeholder="Enter Contact Number"/>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('applicants.hire_date') }}<span class="required">*</span></label>
                        <div class="col-md-9">
                            <div class="input-group input-medium pull-left">
                                <?php $employment_month_hired = (isset($employment['employment-month-hired']) ? $employment['employment-month-hired'] : ""); ?>
                        {{ form_dropdown('recruitment_personal_history[employment-month-hired][]',$months_options, $employment_month_hired, 'class="form-control select2me" data-placeholder="Select..."') }}
                            </div>
                            <span class="pull-left padding-left-right-10">-</span>
                            <span class="pull-left">
                                <input type="text" class="form-control input-small" maxlength="4" name="recruitment_personal_history[employment-year-hired][]" id="recruitment_personal_history-employment-year-hired" 
                            value="<?php echo (isset($employment['employment-year-hired']) ? $employment['employment-year-hired'] : ""); ?>"placeholder="Year">
                            </span>                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('applicants.end_date') }}<span class="required">*</span></label>
                        <div class="col-md-9">
                            <div class="input-group input-medium pull-left">
                                <?php $employment_month_end = (isset($employment['employment-month-end']) ? $employment['employment-month-end'] : ""); ?>
                        {{ form_dropdown('recruitment_personal_history[employment-month-end][]',$months_options, $employment_month_end, 'class="form-control select2me" data-placeholder="Select..."') }}
                            </div>
                            <span class="pull-left padding-left-right-10">-</span>
                            <span class="pull-left">
                                <input type="text" class="form-control input-small" maxlength="4" name="recruitment_personal_history[employment-year-end][]" id="recruitment_personal_history-employment-year-end" 
                            value="<?php echo (isset($employment['employment-year-end']) ? $employment['employment-year-end'] : ""); ?>"placeholder="Year">
                            </span>                            
                        </div>
                    </div>
<!--                     <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('applicants.immediate_position') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="recruitment_personal_history[employment-supervisor][]" id="recruitment_personal_history-employment-supervisor" 
                            value="<?php echo (isset($employment['employment-supervisor']) ? $employment['employment-supervisor'] : ""); ?>" placeholder="Enter Supervisor/Position"/>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('applicants.duties') }}</label>
                        <div class="col-md-6">
                            <textarea rows="3" class="form-control"name="recruitment_personal_history[employment-duties][]" id="recruitment_personal_history-employment-duties" ><?php echo (isset($employment['employment-duties']) ? $employment['employment-duties'] : ""); ?></textarea>
                        </div>
                    </div>
    			</div>
    		</div>
    	</div>
    </div>
    <?php } ?>
</div>
<div class="form-actions fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-offset-3 col-md-8">
                <button class="btn green btn-sm" type="button" onclick="save_partner( $(this).parents('form') )" ><i class="fa fa-check"></i> {{ lang('common.save') }}</button>
                <button class="btn blue btn-sm" type="submit"><i class="fa fa-undo"></i> {{ lang('common.reset') }}</button>
                <a class="btn default btn-sm" href="{{ $mod->url }}" type="button" >{{ lang('common.back_to_list') }}</a>                              
            </div>
        </div>
    </div>
</div>

