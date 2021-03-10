<!-- Previous Trainings : start doing the loop-->
<div id="personal_skills">
    <?php $skills_count = count($skill_tab); ?>
    <input type="hidden" name="skills_count" id="skills_count" value="{{ $skills_count }}" />
    <?php 
    $count_skills = 0;
    foreach($skill_tab as $index => $skill){ 
        $count_skills++;
?>
<div class="portlet">
    @if ($count_skills > 1)
    	<div class="portlet-title">
    		<!-- <div class="caption" id="education-category">Company Name</div> -->
    		<div class="tools">
    			<!-- <a class="collapse pull-right" href="javascript:;"></a> -->
    		</div>
    	</div>
    @endif
	<div class="portlet-body form">
        <div class="form-body">
	       <!-- START FORM -->
            <div class="row">
                <div class="col-md-12">       
                   <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.skills_type') }} :</label>
                        <div class="col-md-6">
                            <span>@if (isset($skill['skill-type'])) {{ $skill['skill-type'] }} @endif</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.skills_name') }} :</label>
                        <div class="col-md-6">
                            <span>@if (isset($skill['skill-name'])) {{ $skill['skill-name'] }} @endif</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.proficiency_level') }} :</label>
                        <div class="col-md-6">
                            <span>@if (isset($skill['skill-level'])) {{ $skill['skill-level'] }} @endif</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('common.remarks') }} :</label>
                        <div class="col-md-6">
                            <span>@if (isset($skill['skill-remarks'])) {{ $skill['skill-remarks'] }} @endif</span>
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
