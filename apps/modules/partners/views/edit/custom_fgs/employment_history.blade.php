<div class="portlet">
	<div class="portlet-title">
		<div class="caption" id="employment-category">{{ lang('partners.employment_history') }}</div>
		<div class="actions">
            <a class="btn btn-default" onclick="add_form('employment_history', 'employment', '', '')">
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
        '' => '',
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
    			<a class="text-muted" id="delete_employment-<?php echo $count_employment;?>" onclick="remove_form(this.id, 'employment', 'history')" href="#" style="margin-botom:-15px;"><i class="fa fa-trash-o"></i> Delete</a>
    			<!-- <a class="collapse pull-right" href="javascript:;"></a> -->
    		</div>
    	</div>
    	<div class="portlet-body form">
            <div class="form-horizontal">
                <div class="form-body">
    		<!-- START FORM -->	
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('partners.comp_name') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="partners_personal_history[employment-company][]" id="partners_personal_history-employment-company" 
                            value="<?php echo (isset($employment['employment-company']) ? $employment['employment-company'] : ""); ?>" placeholder="Enter Company"/>
                        </div>
                    </div>
    				<div class="form-group">
                        <label class="control-label col-md-3">{{ lang('partners.pos_title') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="partners_personal_history[employment-position-title][]" id="partners_personal_history-employment-position-title" 
                            value="<?php echo (isset($employment['employment-position-title']) ? $employment['employment-position-title'] : ""); ?>" placeholder="Enter Position"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('partners.location') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="partners_personal_history[employment-location][]" id="partners_personal_history-employment-location" 
                            value="<?php echo (isset($employment['employment-location']) ? $employment['employment-location'] : ""); ?>" placeholder="Enter Location"/>
                        </div>
                    </div>
                    @if(in_array('employment-reason-for-leaving', $partners_keys))
                        <div class="form-group">
                            <label class="control-label col-md-3">{{ lang('partners.reason_leaving') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="partners_personal_history[employment-reason-for-leaving][]" id="partners_personal_history-employment-reason-for-leaving" 
                                value="<?php echo (isset($employment['employment-reason-for-leaving']) ? $employment['employment-reason-for-leaving'] : ""); ?>" placeholder="Enter {{lang('partners.reason_leaving')}}"/>
                            </div>
                        </div>
                    @endif
                    @if(in_array('employment-latest-salary', $partners_keys))
                        <div class="form-group">
                            <label class="control-label col-md-3">{{ lang('partners.latest_salary') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="partners_personal_history[employment-latest-salary][]" id="partners_personal_history-employment-latest-salary" 
                                value="<?php echo (isset($employment['employment-latest-salary']) ? $employment['employment-latest-salary'] : ""); ?>" placeholder="{{ lang('partners.latest_salary') }}" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>
                            </div>
                        </div>
                    @endif
                    @if(in_array('employment-supervisor', $partners_keys))
                        <div class="form-group">
                            <label class="control-label col-md-3">{{ lang('partners.name_immediate_superior') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="partners_personal_history[employment-supervisor][]" id="partners_personal_history-employment-supervisor" 
                                value="<?php echo (isset($employment['employment-supervisor']) ? $employment['employment-supervisor'] : ""); ?>" placeholder="{{ lang('partners.name_immediate_superior') }}"/>
                            </div>
                        </div>                    
                    @endif                                        
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('partners.hire_date') }}<span class="required">*</span></label>
                        <div class="col-md-9">
                            <div class="input-group input-medium pull-left">
                                <?php $employment_month_hired = (isset($employment['employment-month-hired']) ? $employment['employment-month-hired'] : ""); ?>
                                {{ form_dropdown('partners_personal_history[employment-month-hired][]',$months_options, $employment_month_hired, 'class="form-control select2me" data-placeholder="Select..."') }}
                            </div>
                            <span class="pull-left padding-left-right-10">-</span>
                            <span class="pull-left">
                                <input type="text" class="form-control input-small" maxlength="4" name="partners_personal_history[employment-year-hired][]" id="partners_personal_history-employment-year-hired" 
                            value="<?php echo (isset($employment['employment-year-hired']) ? $employment['employment-year-hired'] : ""); ?>"placeholder="Year" data-inputmask="'mask': '9999'">
                            </span>                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('partners.end_date') }}<span class="required">*</span></label>
                        <div class="col-md-9">
                            <div class="input-group input-medium pull-left">
                                <?php $employment_month_end = (isset($employment['employment-month-end']) ? $employment['employment-month-end'] : ""); ?>
                                {{ form_dropdown('partners_personal_history[employment-month-end][]',$months_options, $employment_month_end, 'class="form-control select2me" data-placeholder="Select..."') }}
                            </div>
                            <span class="pull-left padding-left-right-10">-</span>
                            <span class="pull-left">
                                <input type="text" class="form-control input-small" maxlength="4" name="partners_personal_history[employment-year-end][]" id="partners_personal_history-employment-year-end" 
                            value="<?php echo (isset($employment['employment-year-end']) ? $employment['employment-year-end'] : ""); ?>"placeholder="Year" data-inputmask="'mask': '9999'">
                            </span>                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('partners.duties') }}</label>
                        <div class="col-md-6">
                            <textarea rows="3" class="form-control"name="partners_personal_history[employment-duties][]" id="partners_personal_history-employment-duties" ><?php echo (isset($employment['employment-duties']) ? $employment['employment-duties'] : ""); ?></textarea>
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

