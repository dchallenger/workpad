<div class="portlet">
	<div class="portlet-title">
		<div class="caption" id="education-category">{{ lang('applicants.affiliation') }}</div>
		<div class="actions">
            <a class="btn btn-default" onclick="add_form('affiliation', 'affiliation')">
                <i class="fa fa-plus"></i>
            </a>
		</div>
	</div>
</div>

<div id="personal_affiliation">
    <?php $affiliation_count = count($skill_tab); ?>
    <input type="hidden" name="affiliation_count" id="affiliation_count" value="{{ $affiliation_count }}" />
    <?php 
    $count_affiliation = 0;
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
    foreach($affiliation_tab as $index => $affiliation){ 
        $count_affiliation++;
?>
<div class="portlet">
	<div class="portlet-title">
		<!-- <div class="caption" id="education-category">Company Name</div> -->
		<div class="tools">
            <a class="text-muted" id="delete_affiliation-<?php echo $count_affiliation;?>" onclick="remove_form(this.id, 'affiliation', 'history')" href="#" style="margin-botom:-15px;"><i class="fa fa-trash-o"></i> Delete</a>
			<!-- <a class="collapse pull-right" href="javascript:;"></a> -->
		</div>
	</div>
	<div class="portlet-body form">
        <div class="form-horizontal">
            <div class="form-body">
		<!-- START FORM -->
               <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('applicants.affiliation_name') }}<span class="required">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="recruitment_personal_history[affiliation-name][]" id="recruitment_personal_history-affiliation-name" 
                        value="<?php echo (isset($affiliation['affiliation-name']) ? $affiliation['affiliation-name'] : ""); ?>" placeholder="Enter Name"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('applicants.position') }}<span class="required">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="recruitment_personal_history[affiliation-position][]" id="recruitment_personal_history-affiliation-position" 
                        value="<?php echo (isset($affiliation['affiliation-position']) ? $affiliation['affiliation-position'] : ""); ?>" placeholder="Enter Position"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('applicants.start_date') }}<span class="required">*</span></label>
                    <div class="col-md-9">
                            <div class="input-group input-medium pull-left">
                                <?php $affiliation_month_hired = (isset($affiliation['affiliation-month-start']) ? $affiliation['affiliation-month-start'] : ""); ?>
                        {{ form_dropdown('recruitment_personal_history[affiliation-month-start][]',$months_options, $affiliation_month_hired, 'class="form-control select2me" data-placeholder="Select..."') }}
                            </div>
                            <span class="pull-left padding-left-right-10">-</span>
                            <span class="pull-left">
                                <input type="text" class="form-control input-small" maxlength="4" name="recruitment_personal_history[affiliation-year-start][]" id="recruitment_personal_history-affiliation-year-start" 
                            value="<?php echo (isset($affiliation['affiliation-year-start']) ? $affiliation['affiliation-year-start'] : ""); ?>"placeholder="Year" data-inputmask="'mask': '9999'">
                            </span>                            
                        </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('applicants.end_date') }}<span class="required">*</span></label>
                    <div class="col-md-9">
                            <div class="input-group input-medium pull-left">
                                <?php $affiliation_month_end = (isset($affiliation['affiliation-month-end']) ? $affiliation['affiliation-month-end'] : ""); ?>
                        {{ form_dropdown('recruitment_personal_history[affiliation-month-end][]',$months_options, $affiliation_month_end, 'class="form-control select2me" data-placeholder="Select..."') }}
                            </div>
                            <span class="pull-left padding-left-right-10">-</span>
                            <span class="pull-left">
                                <input type="text" class="form-control input-small" maxlength="4" name="recruitment_personal_history[affiliation-year-end][]" id="recruitment_personal_history-affiliation-year-end" 
                            value="<?php echo (isset($affiliation['affiliation-year-end']) ? $affiliation['affiliation-year-end'] : ""); ?>"placeholder="Year" data-inputmask="'mask': '9999'">
                            </span>                            
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
