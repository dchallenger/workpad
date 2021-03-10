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
        } else {
            $family_age = "";
            $family['family-birthdate']  = "";            
        }            
        ?>
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption" id="family-relationship">
                    <input type="hidden" name="recruitment_personal_history[family-relationship][]" id="recruitment_personal_history-family-relationship" 
                    value="<?php echo (isset($family['family-relationship']) ? $family['family-relationship'] : ""); ?>" />
                    <?php echo (isset($family['family-relationship']) ? $family['family-relationship'] : ""); ?></div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <!-- START FORM --> 
                        <div class="row">
                            <div class="col-md-12">                         
                                <div class="form-group">
                                    <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.name') }} :</label>
                                    <div class="col-md-5">
                                        <span>{{$family['family-name']}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">                                   
                                <div class="form-group">
                                    <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.bday') }} :</label>
                                    <div class="col-md-5">
                                        <span>{{ $family['family-birthdate'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">                                 
                                <div class="form-group">
                                    <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.age') }} :</label>
                                    <div class="col-md-5">
                                        <span>{{ $family_age }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">                        
                                <div class="form-group">
                                    <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.family_dependent_hmo') }}</label>
                                    <div class="col-md-5">
                                        <span>@if(isset($family['family-dependent-hmo']) && $family['family-dependent-hmo']) Yes @else No @endif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.family_dependent_insurance') }}</label>
                                    <div class="col-md-5">
                                        <span>@if(isset($family['family-dependent-insurance']) && $family['family-dependent-insurance']) Yes @else No @endif</span>
                                    </div>
                                </div>
                            </div>
                        </div>                                
                        <div class="row hidden">
                            <div class="col-md-12">                                 
                                <div class="form-group">
                                    <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.occupation') }} :</label>
                                    <div class="col-md-5">
                                        <span>{{ $family['family-occupation'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row hidden">
                            <div class="col-md-12">                                 
                                <div class="form-group">
                                    <label class="control-label text-right text-muted col-md-3">{{ lang('applicants.employer') }} :</label>
                                    <div class="col-md-5">
                                        <span>{{ $family['family-employer'] }}</span>
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