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
        <div class="portlet-body form">
            <div class="form-body">
            <!-- START FORM --> 
                <div class="row">
                    <div class="col-md-12">            
                        <div class="form-group">
                            <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.comp_name') }} :</label>
                            <div class="col-md-6">
                                <span>@if (isset($employment['employment-company'])) {{ $employment['employment-company'] }} @endif</span>
                            </div>
                        </div>
                    </div>
                </div>                    
                <div class="row">
                    <div class="col-md-12">                          
                        <div class="form-group">
                            <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.pos_title') }} :</label>
                            <div class="col-md-6">
                                <span>@if (isset($employment['employment-position-title'])) {{ $employment['employment-position-title'] }} @endif</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">                 
                        <div class="form-group">
                            <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.location') }} :</label>
                            <div class="col-md-6">
                                <span>@if (isset($employment['employment-location'])) {{ $employment['employment-location'] }} @endif</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">                         
                        <div class="form-group">
                            <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.reason_leaving') }} :</label>
                            <div class="col-md-6">
                                <span>@if (isset($employment['employment-reason-for-leaving'])) {{ $employment['employment-reason-for-leaving'] }} @endif</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">                         
                        <div class="form-group">
                            <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.latest_salary') }} :</label>
                            <div class="col-md-6">
                                <span>@if (isset($employment['employment-latest-salary'])) {{ $employment['employment-latest-salary'] }} @endif</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">                         
                        <div class="form-group">
                            <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.name_immediate_superior') }} :</label>
                            <div class="col-md-6">
                                <span>@if (isset($employment['employment-supervisor'])) {{ $employment['employment-supervisor'] }} @endif</span>
                            </div>
                        </div>
                    </div>
                </div>                                            
                <div class="row">
                    <div class="col-md-12">                          
                        <div class="form-group">
                            <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.hire_date') }} :</label>
                            <div class="col-md-9">
                                <div class="input-group pull-left">
                                    <span>@if (isset($employment['employment-month-hired'])) {{ $employment['employment-month-hired'] }} @endif</span>
                                </div>
                                <span class="pull-left"> - </span>
                                <span class="pull-left">
                                    <span>@if (isset($employment['employment-year-hired'])) {{ $employment['employment-year-hired'] }} @endif</span>
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
                                <div class="input-group pull-left">
                                    <span>@if (isset($employment['employment-month-end'])) {{ $employment['employment-month-end'] }} @endif</span>
                                </div>
                                <span class="pull-left padding-left-right-10">-</span>
                                <span class="pull-left">
                                    <span>@if (isset($employment['employment-year-end'])) {{ $employment['employment-year-end'] }} @endif</span>
                                </span>                            
                            </div>
                        </div>
                    </div>
                </div>                        
                <div class="row">
                    <div class="col-md-12">                         
                        <div class="form-group">
                            <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.duties') }} :</label>
                            <div class="col-md-6">
                                <span>@if (isset($employment['employment-duties'])) {{ $employment['employment-duties'] }} @endif</span>
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

