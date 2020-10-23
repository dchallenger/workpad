<div class="portlet">
    <div class="portlet-title">
        <div class="caption" id="family-category">{{ lang('partners.family') }}</div>
        <div class="tools">
            <a class="collapse" href="javascript:;"></a>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="form-horizontal">
            <div class="form-body">
                <!-- START FORM -->             
                <div class="form-group">
                    <label class="control-label col-md-3">{{ lang('partners.relationship') }}</label>
                    <div class="col-md-6">
                        <?php   $db->select('family_relationship_id,family_relationship');
                                $db->where('deleted', '0');
                                $options = $db->get('partners_family_relationship');

                                $family_relationship_options = array('' => '');
                                foreach($options->result() as $option)
                                {
                                    $family_relationship_options[$option->family_relationship] = $option->family_relationship;
                                } ?>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-ul"></i>
                            </span>
                        {{ form_dropdown('family_category',$family_relationship_options, '', 'class="form-control select2me" id="family_category"') }}                   
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default" onclick="add_form('family', 'family', '', 'Relationship')"><i class="fa fa-plus"></i></button>
                            </span>
                        </div>
                        <div class="help-block">
                            {{ lang('partners.select_relationship') }}
                        </div>
                        <!-- /input-group -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="personal_family">
    <?php $family_count = count($family_tab); ?>
    <input type="hidden" name="family_count" id="family_count" value="{{ $family_count }}" />
    <?php  
    $count_family = 0;   
    foreach($family_tab as $index => $family){  
        $count_family++;

        //date in mm/dd/yyyy format; or it can be in other formats as well
        if (isset($family['family-birthdate'])) {
            if($family['family-birthdate'] == "" || $family['family-birthdate'] == '0000-00-00'){
                $family['family-birthdate']  = "";
                $family_age = "";
            }else{
                $birthDate = date('m/d/Y', strtotime($family['family-birthdate']));
                //explode the date to get month, day and year
                $birthDate = explode("/", $birthDate);
                //get age from date or birthdate
                $family_age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                        ? ((date("Y") - $birthDate[2]) - 1)
                        : (date("Y") - $birthDate[2]));

                $family['family-birthdate']  = date('F d, Y', strtotime($family['family-birthdate'] ));
            }
        }
        else {
            $family_age = "";
            $family['family-birthdate']  = "";            
        }
        ?>
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption" id="family-relationship">
                    <input type="hidden" name="partners_personal_history[family-relationship][]" id="partners_personal_history-family-relationship" 
                    value="<?php echo (isset($family['family-relationship']) ? $family['family-relationship'] : ""); ?>" />
                    <?php echo (isset($family['family-relationship']) ? $family['family-relationship'] : ""); ?></div>
                    <div class="tools">
                <a class="text-muted" id="delete_family-<?php echo $count_family;?>" onclick="remove_form(this.id, 'family', 'history')"  style="margin-botom:-15px;" href="#"><i class="fa fa-trash-o"></i> Delete</a>
                        <!-- <a class="collapse pull-right" href="javascript:;"></a> -->
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="form-horizontal">
                        <div class="form-body">
                            <!-- START FORM --> 
                            <div class="form-group">
                                <label class="control-label col-md-3">{{ lang('partners.name') }}<span class="required">*</span></label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="partners_personal_history[family-name][]" id="partners_personal_history-family-name<?php echo$count_family ?>" 
                                    value="<?php echo (isset($family['family-name']) ? $family['family-name'] : ""); ?>" placeholder="Enter Name"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">{{ lang('partners.bday') }}<span class="required">*</span></label>
                                <div class="col-md-5">
                                    <div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
                                        <input type="text" class="form-control" onchange="_calculateAge(this, <?php echo $count_family ?>);"
                                                name="partners_personal_history[family-birthdate][]" 
                                                id="partners_personal_history-family-birthdate<?php echo$count_family ?>" 
                                                value="{{ $family['family-birthdate'] }}" placeholder="Enter Birthday" >
                                        <span class="input-group-btn">
                                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Age</label>
                                <div class="col-md-5">
                                    <input disabled type="text" class="form-control" name="partners_personal_history[family-age][]" id="partners_personal_history-family-age<?php echo$count_family ?>" 
                                    value="<?php echo $family_age ?>" />
                                </div>
                            </div>
                            @if(in_array('dependent', $partners_keys))
                            <div class="form-group hidden">
                                <label class="control-label col-md-3">Dependent</label>
                                <div class="col-md-5">
                                    <div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
                                        <input type="checkbox" value="1" @if( isset($family['family-dependent']) ? $family['family-dependent'] : "" ) checked="checked" @endif name="partners_personal_history[family-dependent][temp][]" id="partners_personal_history-family-dependent-temp" class="dontserializeme toggle dependent"/>
                                        <input type="hidden" name="partners_personal_history[family-dependent][]" id="partners_personal_history-family-dependent" value="@if( isset($family['family-dependent'])) 1 else 0 @endif"/>
                                    </div> 
                                </div>
                            </div>
                            @endif
                            @if(in_array('family-dependent-hmo', $partners_keys))
                            <div class="form-group">
                                <label class="control-label col-md-3">{{$partners_labels['family-dependent-hmo']}}</label>
                                <div class="col-md-5">
                                    <div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
                                        <input type="checkbox" value="1" @if( isset($family['family-dependent-hmo']) ? $family['family-dependent-hmo'] : "" ) checked="checked" @endif name="partners_personal_history[family-dependent-hmo][temp][]" id="partners_personal_history-family-dependent-hmo-temp" class="dontserializeme toggle dependent"/>
                                        <input type="hidden" name="partners_personal_history[family-dependent-hmo][]" id="partners_personal_history-family-dependent-hmo" value="@if( isset($family['family-dependent-hmo'])) 1 else 0 @endif"/>
                                    </div> 
                                </div>
                            </div>                            
                            @endif
                            @if(in_array('family-dependent-insurance', $partners_keys))
                            <div class="form-group">
                                <label class="control-label col-md-3">{{$partners_labels['family-dependent-insurance']}}</label>
                                <div class="col-md-5">
                                    <div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
                                        <input type="checkbox" value="1" @if( isset($family['family-dependent-insurance']) ? $family['family-dependent-insurance'] : "" ) checked="checked" @endif name="partners_personal_history[family-dependent-insurance][temp][]" id="partners_personal_history-family-dependent-insurance-temp" class="dontserializeme toggle dependent"/>
                                        <input type="hidden" name="partners_personal_history[family-dependent-insurance][]" id="partners_personal_history-family-dependent-insurance" value="@if( isset($family['family-dependent-insurance'])) 1 else 0 @endif"/>
                                    </div> 
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
            <div class="row" align="center">
                <div class="col-md-12">
                    <button class="btn green btn-sm" type="button" onclick="save_partner( $(this).parents('form') )" ><i class="fa fa-check"></i> {{ lang('common.save') }}</button>
                    <button class="btn blue btn-sm form-undo" type="submit"><i class="fa fa-undo"></i> {{ lang('common.reset') }}</button>                               
                    <a href="<?php echo $back_url;?>" class="btn default btn-sm">{{ lang('common.back_to_list') }}</a>
                </div>
            </div>
        </div>