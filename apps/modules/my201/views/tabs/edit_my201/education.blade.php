<?php
    $db->select('education_school_id,education_school');
    $db->where('deleted', '0');
    $db->where('status_id', '1');
    $db->order_by('education_school');
    $education_school = $db->get('users_education_school');
    $education_school_options = array('' => '');
    foreach($education_school->result() as $option) {
        $education_school_options[$option->education_school_id] = $option->education_school;
    }

    $db->select('education_degree_obtained_id,education_degree_obtained');
    $db->where('deleted', '0');
    $db->where('status_id', '1');
    $db->order_by('education_degree_obtained');
    $degree_obtained = $db->get('users_education_degree_obtained');
    $degree_obtained_options = array('' => '');
    foreach($degree_obtained->result() as $degree_option) {
        $degree_obtained_options[$degree_option->education_degree_obtained_id] = $degree_option->education_degree_obtained;
    }

    $editable = true;
?>

@if(in_array('education-type', $partners_keys))
 	@if($is_editable['education-type'])
 	<?php $editable = true?>
		<div class="portlet">
			<div class="portlet-title">
				<div class="caption" id="education-category">{{ lang('my201.educ_bg') }}</div>
				<div class="tools">
					<a class="collapse" href="javascript:;"></a>
				</div>
			</div>
			<div class="portlet-body form">
		        <div class="form-horizontal">
		            <div class="form-body">
				<!-- START FORM -->				
		                <div class="form-group">
		                	<label class="control-label col-md-3">{{ lang('my201.category') }}</label>
		                    <div class="col-md-6">
		                        <div class="input-group">
		                            <select  class="form-control select2me" data-placeholder="Select..." name="education_category" id="education_category">
		                            	<option value="Primary">{{ lang('partners.primary') }}</option>
		                                <option value="Secondary">{{ lang('partners.secondary') }}</option>
		                                <option value="Tertiary">{{ lang('partners.tertiary') }}</option>
		                                <option value="Vocational">{{ lang('partners.vocational') }}</option>
		                                <option value="Graduate Studies">{{ lang('partners.graduate') }}</option>
		                               <!--  <option value="Masters">Masters</option>
		                                <option value="Doctorate">Doctorate</option> -->
		                            </select>
		                        
		                            <span class="input-group-btn">
		                            <button type="button" class="btn btn-default" onclick="add_form('educational_background', 'education')"><i class="fa fa-plus"></i></button>
		                            </span>
		                        </div>
		                        <div class="help-block">
		                        	{{ lang('my201.add_education') }}
		                    	</div>
		                        <!-- /input-group -->
		                    </div>
		                </div>
					</div>
				</div>
			</div>
		</div>
	@endif
@endif


@if(sizeof($education_tab) == 0)
	<div class="portlet">
		<div class="portlet-title">
			<div id="employment-company[1]" class="caption">{{ lang('my201.education') }}</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body form">
			<!-- START FORM -->
			<div id="no_record" class="well" style="">
				<p class="bold"><i class="fa fa-exclamation-triangle"></i> {{ lang('common.no_record_found') }} </p>
				<span><p class="small margin-bottom-0">{{ lang('my201.no_info_educ') }}</p></span>
			</div>
		</div>
	</div>
@endif
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
                <input type="hidden" name="partners_personal_history[education-type][]" id="partners_personal_history-education-type" 
                            value="<?php echo (isset($education['education-type']) ? $education['education-type'] : ""); ?>" />
                <?php echo $education_type = (isset($education['education-type']) ? $education['education-type'] : ""); ?>
            </div>
            @if($editable)
    		<div class="tools">
    			<a class="text-muted" id="delete_education-<?php echo $count_education;?>" onclick="remove_form(this.id, 'education', 'history')"  style="margin-botom:-15px;" href="#"><i class="fa fa-trash-o"></i> {{ lang('common.delete') }}</a>
    			<!-- <a class="collapse pull-right" href="javascript:;"></a> -->
    		</div>
    		@endif
    	</div>
    	<div class="portlet-body form">
            <div class="form-horizontal">
                <div class="form-body">
    		<!-- START FORM -->	
    		 		@if(in_array('education-school', $partners_keys))
    				<div class="form-group">
                        <label class="control-label col-md-3">{{ lang('my201.school') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" {{ ($is_editable['education-school'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal_history[education-school][]" id="partners_personal_history-education-school" 
                            value="<?php echo (isset($education['education-school']) ? $education['education-school'] : ""); ?>" placeholder="{{ lang('common.enter') }} {{ lang('my201.school') }}"/>
                        </div>
                    </div>
                    @endif
                    @if(in_array('education-year-from', $partners_keys))
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('my201.start_year') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" {{ ($is_editable['education-year-from'] == 1) ? '' : 'readonly="readonly"' }}  class="form-control" name="partners_personal_history[education-year-from][]" id="partners_personal_history-education-year-from" 
                            value="<?php echo (isset($education['education-year-from']) ? $education['education-year-from'] : ""); ?>" placeholder="{{ lang('common.enter') }} {{ lang('my201.start_year') }}"/>
                        </div>
                    </div>
                    @endif
                    @if(in_array('education-year-to', $partners_keys))
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('my201.end_year') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" {{ ($is_editable['education-year-to'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal_history[education-year-to][]" id="partners_personal_history-education-year-to" 
                            value="<?php echo (isset($education['education-year-to']) ? $education['education-year-to'] : ""); ?>" placeholder="{{ lang('common.enter') }} {{ lang('my201.end_year') }}"/>
                        </div>
                    </div>
                    @endif
                    <?php if(in_array(strtolower($education_type), $type_with_degree)) { ?>
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('partners.degree') }}</label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-list-ul"></i>
                                </span>                            
                                {{ form_dropdown('partners_personal_history[education-degree][]',$degree_obtained_options, (isset($education['education-degree']) ? $education['education-degree'] : ''), 'class="form-control select2me" data-placeholder="Select..."') }}
                            </div>
                        </div>
                    </div>
                    <?php 
                    }else{
                    ?>
                    <div class="form-group" style="display:none;">
                        <label class="control-label col-md-3">{{ lang('partners.start_year') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="hidden" class="form-control" name="partners_personal_history[education-degree][]" id="partners_personal_history-education-degree" 
                            value="" placeholder="{{ lang('common.enter') }} {{ lang('partners.degree') }}"/>
                        </div>
                    </div>
                    <?php
                        } 
                    ?>
                    @if(in_array('education-honors_awards', $partners_keys))
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('partners.honors_receive') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="partners_personal_history[education-honors_awards][]" id="partners_personal_history-education-honors_awards" 
                            value="<?php echo (isset($education['education-honors_awards']) ? $education['education-honors_awards'] : ""); ?>" placeholder="{{ lang('common.enter') }} {{ lang('partners.honors_receive') }}"/>
                        </div>
                    </div>                    
                    @endif
                    @if(in_array('education-status', $partners_keys))
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ lang('common.status') }}<span class="required">*</span></label>
                        <div class="col-md-7 checkbox-list">
                            <label class="checkbox-inline">
                                <?php $education_status = (isset($education['education-status']) ? $education['education-status'] : ""); ?>
                                <input type="checkbox" {{ ($is_editable['education-status'] == 1) ? '' : 'disabled' }}  name="partners_personal_history[education-status][]" id="partners_personal_history-education-status-graduate-<?php echo $count_education;?>" 
                                 value="Graduated" <?php echo strtolower($education_status) == 'graduated' ? "checked" : "" ?> onclick="check_graduate_status(this, <?php echo $count_education;?>);"/>
                                {{ lang('my201.grad') }}
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox"  {{ ($is_editable['education-status'] == 1) ? '' : 'disabled' }} name="partners_personal_history[education-status][]" id="partners_personal_history-education-status-undergraduate-<?php echo $count_education;?>" 
                                 value="Undergrad" <?php echo strtolower($education_status) != 'graduated' ? "checked" : "" ?> onclick="check_graduate_status(this, <?php echo $count_education;?>);"> 
                                 {{ lang('my201.ungrad') }}
                            </label>
                        </div>
                    </div>
                    @endif
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
                @if($editable)
                    <button class="btn green btn-sm" type="button" onclick="save_partner( $(this).parents('form') )" ><i class="fa fa-check"></i> {{ lang('common.save') }}</button>
                    <button class="btn blue btn-sm" type="submit"><i class="fa fa-undo"></i> {{ lang('common.reset') }}</button>                               
                @endif                    
            </div>
        </div>
    </div>
</div>