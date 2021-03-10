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
<!-- Education : start doing the loop-->
<div id="personal_education">
    <?php $education_count = count($education_tab); ?>
    <input type="hidden" name="education_count" id="education_count" value="{{ $education_count }}" />
    <?php 
    $type_with_degree = array('tertiary', 'graduate studies', 'vocational');
    $count_education = 0;
    foreach($education_tab as $index => $education){  
        $count_education++;

        $school = '';
        $degree = '';

        if (isset($education['education-school']))
            $school = (isset($education_school_options[$education['education-school']]) ? $education_school_options[$education['education-school']] : "");

        if (isset($education['education-degree']))
            $degree = $degree_obtained_options[$education['education-degree']];        
?>
    <div class="portlet">
    	<div class="portlet-title">
    		<div class="caption" id="education-category">
                <input type="hidden" name="recruitment_personal_history[education-type][]" id="recruitment_personal_history-education-type" 
                            value="<?php echo (isset($education['education-type']) ? $education['education-type'] : ""); ?>" />
                <?php echo $education_type = (isset($education['education-type']) ? $education['education-type'] : ""); ?>
            </div>
    	</div>
    	<div class="portlet-body form">
            <div class="form-body">
		      <!-- START FORM -->
                <div class="row">
                    <div class="col-md-12">
        				<div class="form-group">
                            <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.school') }} :</label>
                            <div class="col-md-6">
                                <span>{{ $school }}</span>                          
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.start_year') }} :</label>
                            <div class="col-md-6">
                                <span>@if (isset($education['education-year-from'])) {{$education['education-year-from']}} @endif</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">                        
                        <div class="form-group">
                            <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.end_year') }} :</label>
                            <div class="col-md-6">
                                <span>@if (isset($education['education-year-to'])) {{$education['education-year-to']}} @endif</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">                        
                        <div class="form-group">
                            <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.honors') }} :</label>
                            <div class="col-md-6">
                                <span>@if (isset($education['education-honors_awards'])) {{$education['education-honors_awards']}} @endif</span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(in_array(strtolower($education_type), $type_with_degree)) { ?>
                <div class="row">
                    <div class="col-md-12">                                                
                        <div class="form-group">
                            <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.degree') }} :</label>
                            <div class="col-md-6">
                                <span>{{ $degree }}</span>                         
                            </div>
                        </div>
                    </div>
                </div>                                                
                <?php } else { ?>
                <div class="row">
                    <div class="col-md-12">                
                        <div class="form-group" style="display:none;">
                            <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.degree') }} :</label>
                            <div class="col-md-6">
                                <input type="hidden" class="form-control" name="recruitment_personal_history[education-degree][]" id="recruitment_personal_history-education-degree" 
                                value="" placeholder="Enter Degree"/>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    } 
                ?>
                <div class="row">
                    <div class="col-md-12">                 
                        <div class="form-group">
                            <label class="control-label text-right text-muted col-md-3">{{ lang('common.status') }} :</label>
                            <div class="col-md-6">
                                <span>@if (isset($education['education-status'])) {{ $education['education-status'] }} @endif</span>                         
                            </div>
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
            <div align="center">
                <a class="btn default btn-sm" href="{{ $mod->url }}" type="button" >{{ lang('common.back_to_list') }}</a>                            
            </div>
        </div>
    </div>
</div>