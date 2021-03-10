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
    @if ($count_affiliation > 1)
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
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.affiliation_name') }} :</label>
                        <div class="col-md-6">
                            <span>@if (isset($affiliation['affiliation-name'])) {{ $affiliation['affiliation-name'] }} @endif</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">               
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.position') }} :</label>
                        <div class="col-md-6">
                            <span>@if (isset($affiliation['affiliation-position'])) {{ $affiliation['affiliation-name'] }} @endif</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                       
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.start_date') }} :</label>
                        <div class="col-md-9">
                                <div class="input-group pull-left">
                                    <span>@if (isset($affiliation['affiliation-month-start'])) {{ $affiliation['affiliation-month-start'] }} @endif</span>
                                </div>
                                <span class="pull-left padding-left-right-10">-</span>
                                <span class="pull-left">
                                    <span>@if (isset($affiliation['affiliation-year-start'])) {{ $affiliation['affiliation-year-start'] }} @endif</span>
                                </span>                            
                            </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                       
                    <div class="form-group">
                        <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.end_date') }} :</label>
                        <div class="col-md-9">
                                <div class="input-group input-medium pull-left">
                                    <span>@if (isset($affiliation['affiliation-month-end'])) {{ $affiliation['affiliation-month-end'] }} @endif</span>
                                </div>
                                <span class="pull-left padding-left-right-10">-</span>
                                <span class="pull-left">
                                    <span>@if (isset($affiliation['affiliation-year-end'])) {{ $affiliation['affiliation-year-end'] }} @endif</span>
                                </span>                            
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
            <div class="col-md-offset-3 col-md-8">
                <button class="btn green btn-sm" type="button" onclick="save_partner( $(this).parents('form') )" ><i class="fa fa-check"></i> {{ lang('common.save') }}</button>
                <button class="btn blue btn-sm" type="submit"><i class="fa fa-undo"></i> {{ lang('common.reset') }}</button>
                <a class="btn default btn-sm" href="{{ $mod->url }}" type="button" >{{ lang('common.back_to_list') }}</a>                                
            </div>
        </div>
    </div>
</div>
