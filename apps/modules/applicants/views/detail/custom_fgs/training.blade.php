<div id="personal_training">
    <?php $training_count = count($training_tab); ?>
    <input type="hidden" name="training_count" id="training_count" value="{{ $training_count }}" />
    <?php 
    $type_with_degree = array('tertiary', 'graduate studies', 'vocational');
    $count_training = 0;
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
    foreach($training_tab as $index => $training){  
        $count_training++;
        ?>
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption" id="training-category">
                    <input type="hidden" name="recruitment_personal_history[training-category][]" id="recruitment_personal_history-training-category" 
                    value="<?php echo (isset($training['training-category']) ? $training['training-category'] : ""); ?>" />
                    <?php echo (isset($training['training-category']) ? $training['training-category'] : ""); ?></div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <!-- START FORM -->
                        <div class="row">
                            <div class="col-md-12">                         
                                <div class="form-group">
                                    <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.title') }} :</label>
                                    <div class="col-md-6">
                                        <span>@if (isset($training['training-title'])) {{$training['training-title']}} @endif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">                                
                                <div class="form-group">
                                    <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.venue') }} :</label>
                                    <div class="col-md-6">
                                        <span>@if (isset($training['training-venue'])) {{$training['training-venue']}} @endif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">                                   
                                <div class="form-group">
                                    <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.training_provider') }} :</label>
                                    <div class="col-md-6">
                                        <span>@if (isset($training['training-provider'])) {{$training['training-provider']}} @endif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">                                   
                                <div class="form-group">
                                    <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.training_cost') }} :</label>
                                    <div class="col-md-6">
                                        <span>@if (isset($training['training-cost'])) {{$training['training-cost']}} @endif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">                                   
                                <div class="form-group">
                                    <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.budgeted') }} :</label>
                                    <div class="col-md-6">
                                        <span>@if($training['training-budgeted']) Yes @else No @endif</span>

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
                                            <span>@if (isset($training['training-start-month'])) {{ $training['training-start-month'] }} @endif</span>
                                        </div>
                                        <span class="pull-left padding-left-right-10">-</span>
                                        <span class="pull-left">
                                            <span>@if (isset($training['training-start-year'])) {{ $training['training-start-year'] }} @endif</span>
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
                                            <span>@if (isset($training['training-end-month'])) {{ $training['training-end-month'] }} @endif</span>
                                        </div>
                                        <span class="pull-left padding-left-right-10">-</span>
                                        <span class="pull-left">
                                            <span>@if (isset($training['training-end-year'])) {{ $training['training-end-year'] }} @endif</span>
                                        </span>                            
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">                                   
                                <div class="form-group">
                                    <label class="control-label text-right text-muted col-md-3">Remarks :</label>
                                    <div class="col-md-6">
                                        <span>@if (isset($training['training-remarks'])) {{$training['training-remarks']}} @endif</span>
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