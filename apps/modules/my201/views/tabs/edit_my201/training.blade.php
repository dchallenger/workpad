<?php $editable = false?>
<div class="portlet">
    <div class="portlet-title">
        <div class="caption" id="training-category">{{ lang('my201.training') }}</div>
    </div>
    @if(in_array('training-category', $partners_keys))
        @if($is_editable['training-category'])
            <div class="portlet-body form">
                <div class="form-horizontal">
                    <div class="form-body">
                        <!-- START FORM -->   

                        <div class="form-group">
                            <label class="control-label col-md-3">{{ lang('my201.category') }}</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select  class="form-control select2me" data-placeholder="Select..." name="training_category" id="training_category">
                                        <option value="Training">{{ lang('my201.train') }}</option>
                                        <option value="Seminar">{{ lang('my201.seminar') }}</option>
                                    </select>

                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default" onclick="add_form('training_seminar', 'training')"><i class="fa fa-plus"></i></button>
                                    </span>
                                </div>
                                <div class="help-block">
                                    {{ lang('my201.add_training') }}
                                </div>
                                <!-- /input-group -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>

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
            @if($editable)
            <div class="portlet-title">
                <div class="caption" id="training-category">
                    <input type="hidden" name="partners_personal_history[training-category][]" id="partners_personal_history-training-category" 
                    value="<?php echo (isset($training['training-category']) ? $training['training-category'] : ""); ?>" />
                    <?php echo (isset($training['training-category']) ? $training['training-category'] : ""); ?></div>
                    <div class="tools">
                     <a class="text-muted" id="delete_training-<?php echo $count_training;?>" onclick="remove_form(this.id, 'training', 'history')"  style="margin-botom:-15px;" href="#"><i class="fa fa-trash-o"></i> Delete</a>
                    <!-- <a class="collapse pull-right" href="javascript:;"></a> -->
                </div>
            </div>
            @endif

            <div class="portlet-body form">
                <div class="form-horizontal">
                    <div class="form-body">
                        <!-- START FORM --> 
                        @if(in_array('training-title', $partners_keys))
                        <div class="form-group">
                            <label class="control-label col-md-3">{{ lang('my201.title') }}<span class="required">*</span></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" {{ ($is_editable['training-title'] == 1) ? '' : 'readonly="readonly"' }} name="partners_personal_history[training-title][]" id="partners_personal_history-training-title" 
                                value="<?php echo (isset($training['training-title']) ? $training['training-title'] : ""); ?>" placeholder="Enter Title"/>
                            </div>
                        </div>
                        @endif
                        @if(in_array('training-venue', $partners_keys))
                        <div class="form-group">
                            <label class="control-label col-md-3">Venue<span class="required">*</span></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" {{ ($is_editable['training-venue'] == 1) ? '' : 'readonly="readonly"' }} name="partners_personal_history[training-venue][]" id="partners_personal_history-training-venue" 
                                value="<?php echo (isset($training['training-venue']) ? $training['training-venue'] : ""); ?>" placeholder="Enter Venue"/>
                            </div>
                        </div>
                        @endif
                        @if(in_array('training-provider', $partners_keys))
                        <div class="form-group">
                            <label class="control-label col-md-3">{{ lang('partners.training_provider') }}</label>
                            <div class="col-md-6">
                                <input type="text" {{ ($is_editable['training-provider'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal_history[training-provider][]" id="partners_personal_history-training-provider" 
                                value="<?php echo (isset($training['training-provider']) ? $training['training-provider'] : ""); ?>" placeholder="Enter {{lang('partners.training_provider')}}"/>
                            </div>
                        </div>                            
                        @endif
                        @if(in_array('training-cost', $partners_keys))
                        <div class="form-group">
                            <label class="control-label col-md-3">{{ lang('partners.training_cost') }}</label>
                            <div class="col-md-6">
                                <input type="text" {{ ($is_editable['training-cost'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal_history[training-cost][]" id="partners_personal_history-training-cost" 
                                value="<?php echo (isset($training['training-cost']) ? $training['training-cost'] : ""); ?>" placeholder="Enter {{lang('partners.training_cost')}}" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>
                            </div>
                        </div>                            
                        @endif
                        @if(in_array('training-budgeted', $partners_keys))
                        <div class="form-group">
                            <label class="control-label col-md-3">{{ lang('partners.budgeted') }}</label>
                            <div class="col-md-6">
                                <div class="make-switch" data-on="success" data-off="danger" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
                                    <?php $budgeted = (isset($training['training-budgeted']) ? $training['training-budgeted'] : ""); ?>
                                    <input type="checkbox" {{ ($is_editable['training-budgeted'] == 1) ? '' : 'disabled' }} value="1" @if( $budgeted ) checked="checked" @endif name="partners_personal_history[training-budgeted][temp][]" id="partners_personal_history-training-budgeted-temp" class="dontserializeme toggle"/>
                                    <input type="hidden" name="partners_personal_history[training-budgeted][]" id="partners_personal_history-training-budgeted" 
                                    value="<?php echo (isset($training['training-budgeted']) ? $training['training-budgeted'] : 0); ?>"/>
                                </div> 
                            </div>
                        </div>
                        @endif                          
                        <div class="form-group">
                            <label class="control-label col-md-3">{{ lang('my201.start_date') }}<span class="required">*</span></label>                                
                            <div class="col-md-9">
                                @if(in_array('training-start-month',$partners_keys))
                                    <div class="input-group input-medium pull-left">
                                        <?php $training_month_hired = (isset($training['training-start-month']) ? $training['training-start-month'] : ""); 
                                            $disabled = ($is_editable['training-start-month'] == 1) ? '' : 'disabled';
                                        ?>
                                        {{ form_dropdown('partners_personal_history[training-start-month][]',$months_options, $training_month_hired, 'class="form-control select2me" '.$disabled.' data-placeholder="Select..."') }}
                                    </div>
                                @endif
                                @if(in_array('training-start-year',$partners_keys))
                                    <span class="pull-left padding-left-right-10">-</span>
                                    <span class="pull-left">
                                        <input type="text" {{ ($is_editable['training-start-year'] == 1) ? '' : 'readonly="readonly"' }} class="form-control input-small" maxlength="4" name="partners_personal_history[training-start-year][]" id="partners_personal_history-training-start-year" 
                                    value="<?php echo (isset($training['training-start-year']) ? $training['training-start-year'] : ""); ?>"placeholder="Year">
                                    </span>  
                                @endif                         
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">{{ lang('my201.end_date') }}<span class="required">*</span></label>
                            <div class="col-md-9">
                                @if(in_array('training-end-month',$partners_keys))
                                    <div class="input-group input-medium pull-left">
                                        <?php $training_month_end = (isset($training['training-end-month']) ? $training['training-end-month'] : ""); 
                                                $disabled = ($is_editable['training-end-month'] == 1) ? '' : 'disabled';
                                        ?>
                                        {{ form_dropdown('partners_personal_history[training-end-month][]',$months_options, $training_month_end, 'class="form-control select2me" '.$disabled.' data-placeholder="Select..."') }}
                                    </div>
                                @endif
                                @if(in_array('training-end-year',$partners_keys))
                                    <span class="pull-left padding-left-right-10">-</span>
                                    <span class="pull-left">
                                        <input type="text" {{ ($is_editable['training-end-year'] == 1) ? '' : 'readonly="readonly"' }} class="form-control input-small" maxlength="4" name="partners_personal_history[training-end-year][]" id="partners_personal_history-training-end-year" 
                                    value="<?php echo (isset($training['training-end-year']) ? $training['training-end-year'] : ""); ?>"placeholder="Year">
                                    </span> 
                                @endif                           
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Remarks</label>
                            <div class="col-md-6">
                                <textarea rows="3" {{ ($is_editable['training-remarks'] == 1) ? '' : 'readonly="readonly"' }} class="form-control"name="partners_personal_history[training-remarks][]" id="partners_personal_history-training-remarks" ><?php echo (isset($training['training-remarks']) ? $training['training-remarks'] : ""); ?></textarea>
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
                        @if($editable)
                            <button class="btn green btn-sm" type="button" onclick="save_partner( $(this).parents('form') )" ><i class="fa fa-check"></i> {{ lang('common.save') }}</button>
                            <button class="btn blue btn-sm form-undo" type="submit"><i class="fa fa-undo"></i> {{ lang('common.reset') }}</button>                               
                        @endif                            
                    </div>
                </div>
            </div>
        </div>