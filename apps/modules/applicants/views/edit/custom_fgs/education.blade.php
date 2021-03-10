<?php
    $db->select('education_school_id,education_school');
    $db->where('deleted', '0');
    $db->order_by('education_school');
    $education_school = $db->get('users_education_school');
    $education_school_options = array('' => '');
    foreach($education_school->result() as $option) {
        $education_school_options[$option->education_school_id] = $option->education_school;
    }

    $db->select('education_degree_obtained_id,education_degree_obtained');
    $db->where('deleted', '0');
    $db->order_by('education_degree_obtained');
    $degree_obtained = $db->get('users_education_degree_obtained');
    $degree_obtained_options = array('' => '');
    foreach($degree_obtained->result() as $degree_option) {
        $degree_obtained_options[$degree_option->education_degree_obtained_id] = $degree_option->education_degree_obtained;
    }      
?>
<div class="portlet">
	<div class="portlet-title">
		<div class="caption" id="education-category">{{ lang('applicants.educ_bg') }}</div>
		<div class="tools">
			<a class="collapse" href="javascript:;"></a>
		</div>
	</div>
	<div class="portlet-body form">
        <div class="form-horizontal">
            <div class="form-body">
		<!-- START FORM -->				
                <div class="form-group">
                	<label class="control-label col-md-3">{{ lang('applicants.category') }}</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <select  class="form-control select2me" data-placeholder="Select..." name="education_category" id="education_category">
                            	<option value="Primary">{{ lang('applicants.primary') }}</option>
                                <option value="Secondary">{{ lang('applicants.secondary') }}</option>
                                <option value="Tertiary">{{ lang('applicants.tertiary') }}</option>
                                <option value="Vocational">{{ lang('applicants.vocational') }}</option>
                                <option value="Graduate Studies">{{ lang('applicants.graduate') }}</option>
                               <!--  <option value="Masters">Masters</option>
                                <option value="Doctorate">Doctorate</option> -->
                            </select>
                        
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-default" onclick="add_form('educational_background', 'education')"><i class="fa fa-plus"></i></button>
                            </span>
                        </div>
                        <div class="help-block">
                        	{{ lang('applicants.add_education') }}
                    	</div>
                        <!-- /input-group -->
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
<!-- Education : start doing the loop-->
<div id="personal_education">
    <?php $education_count = count($education_tab); ?>
    <input type="hidden" name="education_count" id="education_count" value="{{ $education_count }}" />
    <?php 
    $type_with_degree = array('tertiary', 'graduate studies', 'vocational');
    $count_education = 0;
    foreach($education_tab as $index => $education){  
        $count_education++;
?>
    <div class="portlet">
    	<div class="portlet-title">
    		<div class="caption" id="education-category">
                <input type="hidden" name="recruitment_personal_history[education-type][]" id="recruitment_personal_history-education-type" 
                            value="<?php echo (isset($education['education-type']) ? $education['education-type'] : ""); ?>" />
                <?php echo $education_type = (isset($education['education-type']) ? $education['education-type'] : ""); ?>
            </div>
    		<div class="tools">
    			<a class="text-muted" id="delete_education-<?php echo $count_education;?>" onclick="remove_form(this.id, 'education', 'history')"  style="margin-botom:-15px;" href="#"><i class="fa fa-trash-o"></i> {{ lang('common.delete') }}</a>
    			<!-- <a class="collapse pull-right" href="javascript:;"></a> -->
    		</div>
    	</div>
    	<div class="portlet-body form">
            <div class="form-horizontal">
                <div class="form-body">
    		<!-- START FORM -->	
    				<div class="form-group">
                        <label class="control-label col-md-3">{{ lang('applicants.school') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-list-ul"></i>
                                </span>
                                {{ form_dropdown('recruitment_personal_history[education-school][]',$education_school_options, (isset($education['education-school']) ? $education['education-school'] : ''), 'class="form-control select2me" data-placeholder="Select..."') }}
                            </div>                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('applicants.start_year') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="recruitment_personal_history[education-year-from][]" id="recruitment_personal_history-education-year-from" 
                            value="<?php echo (isset($education['education-year-from']) ? $education['education-year-from'] : ""); ?>" placeholder="Enter Year From"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('applicants.end_year') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="recruitment_personal_history[education-year-to][]" id="recruitment_personal_history-education-year-to" 
                            value="<?php echo (isset($education['education-year-to']) ? $education['education-year-to'] : ""); ?>" placeholder="Enter Year To"/>
                        </div>
                    </div>
                    <?php if(in_array(strtolower($education_type), $type_with_degree)) { ?>
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('applicants.degree') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-list-ul"></i>
                                </span>                            
                                {{ form_dropdown('recruitment_personal_history[education-degree][]',$degree_obtained_options, (isset($education['education-degree']) ? $education['education-degree'] : ''), 'class="form-control select2me" data-placeholder="Select..."') }}
                            </div>                            
                        </div>
                    </div>
                    <?php 
                    }else{
                    ?>
                    <div class="form-group" style="display:none;">
                        <label class="control-label col-md-3">{{ lang('applicants.degree') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="hidden" class="form-control" name="recruitment_personal_history[education-degree][]" id="recruitment_personal_history-education-degree" 
                            value="" placeholder="Enter Degree"/>
                        </div>
                    </div>
                    <?php
                        } 
                    ?>                    
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('applicants.honors_receive') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="recruitment_personal_history[education-honors_awards][]" id="recruitment_personal_history-education-honors_awards" 
                            value="<?php echo (isset($education['education-honors_awards']) ? $education['education-honors_awards'] : ""); ?>" placeholder="Enter Honors/Awards"/>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('common.status') }}<span class="required">*</span></label>
                        <div class="col-md-7 checkbox-list">
                            <label class="checkbox-inline">
                                <?php $education_status = (isset($education['education-status']) ? $education['education-status'] : ""); ?>
                                <input type="checkbox" name="recruitment_personal_history[education-status][]" id="recruitment_personal_history-education-status-graduate-<?php echo $count_education;?>" 
                                 value="Graduated" <?php echo strtolower($education_status) == 'graduated' ? "checked" : "" ?> onclick="check_graduate_status(this, <?php echo $count_education;?>);"/>
                                {{ lang('applicants.grad') }}
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="recruitment_personal_history[education-status][]" id="recruitment_personal_history-education-status-undergraduate-<?php echo $count_education;?>" 
                                 value="Undergrad" <?php echo strtolower($education_status) != 'graduated' ? "checked" : "" ?> onclick="check_graduate_status(this, <?php echo $count_education;?>);"> 
                                 {{ lang('applicants.ungrad') }}
                            </label>
                        </div>
                    </div>
                    <div class="form-group hidden">
                        <label class="control-label col-md-3">{{ lang('applicants.last_sy_attended') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="recruitment_personal_history[education-lastsem-attended][]" id="recruitment_personal_history-education-lastsem-attended-<?php echo $count_education;?>" 
                            value="<?php echo (isset($education['education-lastsem-attended']) ? $education['education-lastsem-attended'] : ""); ?>" placeholder="Enter Last SY and Sem Attended"/>
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