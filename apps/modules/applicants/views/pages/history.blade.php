<script type="text/javascript" src="{{ theme_path() }}plugins/bootstrap-tagsinput/typeahead.js"></script>
<script src="{{ theme_path() }}plugins/bootstrap-switch/static/js/bootstrap-switch.min.js" type="text/javascript" ></script>
<link href="{{ theme_path() }}plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css" rel="stylesheet" type="text/css"/>
<script src="{{ theme_path() }}plugins/select2/select2.min.js" type="text/javascript" ></script>
<link href="{{ theme_path() }}plugins/select2/select2_metro.css" rel="stylesheet" type="text/css"/>
<link href="{{ theme_path() }}plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{ theme_path() }}plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
<script type="text/javascript" src="{{ theme_path() }}plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

<div class="modal fade modal-extra" tabindex="-1" aria-hidden="true"></div>

<div class="modal-body padding-bottom-0">
	<div class="">
		<ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab_schedule">{{ lang('applicant_monitoring.schedule') }}</a></li>
            <li><a data-toggle="tab" href="#tab_interview">{{ lang('applicant_monitoring.interview') }}</a></li>            
            <li><a data-toggle="tab" href="#tab_assessment">Examination</a></li>
            <li><a data-toggle="tab" href="#tab_bi">BI</a></li>
            <li><a data-toggle="tab" href="#tab_jo">{{ lang('applicant_monitoring.jo') }}</a></li>
            <!-- <li><a data-toggle="tab" href="#tab_cs">{{ lang('applicant_monitoring.cs') }}</a></li> -->
            <li><a data-toggle="tab" href="#tab_preemp">{{ lang('applicant_monitoring.preemp') }}</a></li>
        </ul>
        <div class="tab-content margin-top-20" style="min-height:300px;">
            <!-- SCHEDULE -->
        	<div id="tab_schedule" class="tab-pane active">
        		<div class="portlet">
        			<div class="portlet-title">
        				<div class="caption">{{ lang('applicant_monitoring.interview_sched') }}</div>
                            <div class="tools">
                                <a class="collapse" href="javascript:;"></a>
                            </div>
                    </div>
                    <p>{{ lang('applicant_monitoring.note_add_interview') }}</p>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="portlet">
                                <div class="portlet-body" >
                                    <table class="table table-condensed table-striped table-hover" >
                                        <thead>
                                            <tr>
                                                <th width="33%" class="padding-top-bottom-10" >{{ lang('applicant_monitoring.date') }}</th>
                                                <th width="33%" class="padding-top-bottom-10 hidden-xs" >{{ lang('applicant_monitoring.interviewer') }}</th>
                                                <th width="34%" class="padding-top-bottom-10 hidden-xs" >{{ lang('applicant_monitoring.location') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="saved-scheds">
                                            @if( $saved_scheds )
                                                @foreach( $saved_scheds as $sched )
                                                    <tr>
                                                        <td>
                                                            {{ date('M d, Y - h:i a', strtotime($sched->date)) }}
                                                        </td> 
                                                        <td>
                                                            {{ $sched->full_name }}
                                                        </td>
                                                        <td>
                                                            {{ $sched->interview_location }}
                                                        </td>
                                                    </tr> 
                                                @endforeach
                                           @endif
                                         </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer margin-top-0">
                    <button type="button" data-dismiss="modal" class="btn btn-default btn-sm">{{ lang('common.close') }}</button>
                </div>
            </div>
            <!-- SCHEDULE -->
            <!-- ASSESSMENT -->
            <div id="tab_assessment" class="tab-pane">
                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption">Assessment List</div>
                        <div class="tools">
                            <a class="collapse" href="javascript:;"></a>
                        </div>
                    </div>
                    <p>This section manage to add exams and show summary of results.</p>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="portlet">
                                <div class="portlet-body" >
                                    <!-- Table -->
                                    <table class="table table-condensed table-striped table-hover" >
                                        <thead>
                                            <tr>
                                                <th width="25%" class="padding-top-bottom-10" >Exam Name</th>
                                                <th width="25%" class="padding-top-bottom-10" >Date</th>
                                                <th width="25%" class="padding-top-bottom-10 hidden-xs" >Score</th>
                                                <th width="25%" class="padding-top-bottom-10 hidden-xs" >Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="saved-exams">
                                            @if( !empty($exams) )
                                                @foreach( $exams as $exam )
                                            <tr class="exam_assessment">
                                                <!--  shows the exam items -->
                                                <td>{{ $exam['exam_name'] }}</td>
                                                <td>{{ date( 'F d, Y', strtotime($exam['date_taken']) ) }}</td>
                                                <td>{{ $exam['score'] }}</td> 
                                                <td>{{ ( $exam['status_id'] ) ? '<span class="badge badge-success">Passed</span>' : '<span class="badge">Failed</span>'  }}</td>
                                            </tr>                                            
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                     <div id="no_record_exam" class="well" style="display:none">
                                        <p class="bold"><i class="fa fa-exclamation-triangle"></i> {{ lang('common.no_record_found') }}</p>
                                        <span><p class="small margin-bottom-0">Zero (0) was found. Click Add Exam button to add to exam assessment.</p></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ASSESSMENT -->
            <!-- INTERVIEW -->
            <div id="tab_interview" class="tab-pane">
                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption">{{ lang('applicant_monitoring.interview_details') }}</div>
                        <div class="tools"><a class="collapse" href="javascript:;"></a></div>
                    </div>
                    <p>{{ lang('applicant_monitoring.note_interview_result') }}</p>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="portlet">
                                <div class="portlet-body" >
                                    <table class="table table-condensed table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th width="30%" class="padding-top-bottom-10" ><?=lang('applicant_monitoring.interviewer')?></th>
                                                <th width="25%" class="padding-top-bottom-10 "><?=lang('applicant_monitoring.date')?></th>
                                                <th width="20%" class="padding-top-bottom-10 "><?=lang('applicant_monitoring.result')?></th>
                                            </tr>
                                        </thead>
                                        <tbody id="saved-interviews">
                                            @if( $saved_scheds )
                                                @foreach( $saved_scheds as $sched )
                                                    <tr>
                                                        <td>{{ $sched->full_name }}<br>
                                                            <span class="small text-muted">{{  $sched->position }}</span>
                                                        </td> 
                                                        <td> {{ date('M-d', strtotime( $sched->date )) }}
                                                            <span class="text-muted small">{{ date('D', strtotime( $sched->date )) }}</span><br>
                                                            <span class="text-muted small">{{ date('Y', strtotime( $sched->date )) }}</span>
                                                        </td>
                                                        <td>
                                                            @if( empty( $sched->result ) )
                                                                <span class="badge badge-warning">Pending</span>
                                                            @else
                                                                <span class="badge {{ $sched->class }}">{{ $sched->result }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a class="btn btn-xs text-muted" href="javascript:view_interview_result({{ $sched->schedule_id }}, '{{ $monitoring_route }}');"><i class="fa fa-search"></i>{{ lang('common.view') }}</a>
                                                            </div>
                                                            <div class="btn-group">
                                                                <a class="btn btn-xs text-muted" href="javascript:print_interview(<?php echo $process_id ?>);"><i class="fa fa-print"></i>{{ lang('applicant_monitoring.print') }}</a>
                                                            </div>
                                                        </td>
                                                        </tr> 
                                                    @endforeach
                                                @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- INTERVIEW -->
            <!-- BI -->
            <div id="tab_bi" class="tab-pane ">
                <?php
                    if ($bi && $bi->num_rows() > 0){
                        $bi_header = $bi->row();
                    }
                    $disabled = "disabled";
                ?>
                <div class="tab-pane active" id="tab_2-2">
                    <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption">Previous Work Related Information
                            </div>
                            <div class="tools">
                                <a class="collapse" href="javascript:;"></a>
                            </div>
                        </div>
                        <div>
                            <span class="pull-left">This section manage to add conducted background investigation.</span>
                            <!-- <span class="pull-right margin-bottom-15"><div class="btn btn-success btn-xs" onclick="add_prev_work_row()">+ Add Previous Work </div></span> -->
                            <br clear="all">
                        </div>
                        <div class="portlet-body form">
                            <!-- START FORM -->
                            <form action="#" class="form-horizontal" name="bi-form" id="bi-form">
                                <?php
                                    if ($bi && $bi->num_rows() > 0){
                                        foreach ($bi->result() as $row) {
                                ?>
                                            <div class="bi_form_header">
                                                <div class="form-body">
                                                    <div class="portlet">
                                                        <div class="portlet-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="50%">Name of Character Reference</td>
                                                                            <td width="50%"><input <?php echo $disabled ?> type="text" class="form-control" name="reference_person[]" id="reference_person" value="<?php echo $row->reference_person ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Position</td>
                                                                            <td><input <?php echo $disabled ?> type="text" class="form-control" name="position[]" id="position" value="<?php echo $row->position ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Company</td>
                                                                            <td><input <?php echo $disabled ?> type="text" class="form-control" name="company[]" id="company" value="<?php echo $row->company ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p class="no-margin"><span class="number">1.</span>Relationship</p>
                                                                                <p class="next_pa">How did you know the candidate?</p>
                                                                            </td>
                                                                            <td>
                                                                                <input <?php echo $disabled ?> type="text" size="16" class="form-control" name="ans1[]" value="<?php echo $row->ans1 ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p class="no-margin"><span class="number">2.</span>Efficiency at work</p>
                                                                                <p class="next_pa">What can you say about his/her attendance (absence/tardiness)?</p>
                                                                            </td>
                                                                            <td>
                                                                                <input <?php echo $disabled ?> type="text" size="16" class="form-control" name="ans2[]" value="<?php echo $row->ans2 ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p class="next_pa">How closely was he/she supervised?</p>
                                                                            </td>
                                                                            <td>
                                                                                <input <?php echo $disabled ?> type="text" size="16" class="form-control" name="ans3[]" value="<?php echo $row->ans3 ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p class="next_pa">How would you describe the QUALITY of work he/she does?</p>
                                                                            </td>
                                                                            <td>
                                                                                <input <?php echo $disabled ?> type="text" size="16" class="form-control" name="ans4[]" value="<?php echo $row->ans4 ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p class="next_pa">How would you describe the QUANTITY of work he/she does?</p>
                                                                            </td>
                                                                            <td>
                                                                                <input <?php echo $disabled ?> type="text" size="16" class="form-control" name="ans5[]" value="<?php echo $row->ans5 ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p class="next_pa">How would you describe his/her management style? (handling of multiple responsibilities/stress)</p>
                                                                            </td>
                                                                            <td>
                                                                                <input <?php echo $disabled ?> type="text" size="16" class="form-control" name="ans6[]" value="<?php echo $row->ans6 ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p class="next_pa">How would you rate his/her communication skills?</p>
                                                                            </td>
                                                                            <td>
                                                                                <input <?php echo $disabled ?> type="text" size="16" class="form-control" name="ans7[]" value="<?php echo $row->ans7 ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p class="no-margin"><span class="number">3.</span>Interpersonal skills</p>
                                                                                <p class="next_pa">How would you describe her performance when working with others/ a team?</p>
                                                                            </td>
                                                                            <td>
                                                                                <input <?php echo $disabled ?> type="text" size="16" class="form-control" name="ans8[]" value="<?php echo $row->ans8 ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p class="no-margin"><span class="number">4.</span>Strengths/Technical Knowledge</p>
                                                                                <p class="next_pa">Would there be any specific technical/product knowledge or skills, you think, that he/she can contribute to his/her prospective employer?</p>
                                                                            </td>
                                                                            <td>
                                                                                <input <?php echo $disabled ?> type="text" size="16" class="form-control" name="ans9[]" value="<?php echo $row->ans9 ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p class="no-margin"><span class="number">5.</span>Weaknesses/Candidate’s Potentials</p>
                                                                                <p class="next_pa">Could you identify any areas of development that the prospective employer should look into?</p>
                                                                            </td>
                                                                            <td>
                                                                                <input <?php echo $disabled ?> type="text" size="16" class="form-control" name="ans10[]" value="<?php echo $row->ans10 ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p class="no-margin"><span class="number">6.</span>Integrity</p>
                                                                                <p class="next_pa">Would you be aware of any issues/controversy that he/she has been involved with? Can you provide details?</p>
                                                                            </td>
                                                                            <td>
                                                                                <input <?php echo $disabled ?> type="text" size="16" class="form-control" name="ans11[]" value="<?php echo $row->ans11 ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p class="next_pa">Can you describe his/her way of handling sensitive/confidential information/materials?</p>
                                                                            </td>
                                                                            <td>
                                                                                <input <?php echo $disabled ?> type="text" size="16" class="form-control" name="ans12[]" value="<?php echo $row->ans12 ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p class="no-margin"><span class="number">7.</span>If applicable</p>
                                                                                <p class="next_pa">What would you consider as his/her biggest contribution to the company?</p>
                                                                            </td>
                                                                            <td>
                                                                                <input <?php echo $disabled ?> type="text" size="16" class="form-control" name="ans13[]" value="<?php echo $row->ans13 ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p class="next_pa">Would you know the reason why he/she left your company?</p>
                                                                            </td>
                                                                            <td>
                                                                                <input <?php echo $disabled ?> type="text" size="16" class="form-control" name="ans14[]" value="<?php echo $row->ans14 ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p class="next_pa">If given the opportunity, would you consider re-hiring him/her? Why?</p>
                                                                            </td>
                                                                            <td>
                                                                                <input <?php echo $disabled ?> type="text" size="16" class="form-control" name="ans15[]" value="<?php echo $row->ans15 ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p class="next_pa">Is there anything else you would like to add to help us further evaluate his/her application?</p>
                                                                            </td>
                                                                            <td>
                                                                                <input <?php echo $disabled ?> type="text" size="16" class="form-control" name="ans16[]" value="<?php echo $row->ans16 ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="2">Thank you very much for your time, and rest assured that we will be keeping all this information confidential. Have a very good day sir/ma’am!</td>
                                                                        </tr>                            
                                                                    </tbody>                        
                                                                </table>                      
                                                            </div>
                                                        </div>                                                                                                                       
                                                    </div>
                                                </div>                                                
                                            </div>
                                <?php
                                        }
                                    }
                                ?>
                            </form>
                        </div>           
                    </div>      
                </div>

                <div class="modal-footer margin-top-0">
                    <button type="button" data-dismiss="modal" class="btn btn-default btn-sm"><?=lang('common.close')?></button>
                    <button type="button" data-dismiss="modal" class="btn btn-info btn-sm" onclick="print_bi(<?php echo $process_id?>)"><i class="fa fa-print"></i><?=lang('common.print_only')?></button>
                <!--     <button <?=$hidden?> type="button" data-loading-text="Loading..." onclick="save_bi()" class="demo-loading-btn btn btn-success btn-sm"><?=lang('common.save')?></button>
                    <button <?=$hidden?> type="button" onclick="move_to_final_interview(<?php echo $process_id?>)" class="demo-loading-btn btn btn-success btn-sm"><?=lang('applicant_monitoring.move_to_final_interview')?></button> -->
                </div>


                <table style="display:none" id="bi-row">
                    <tbody>
                        <tr class="bi_form">
                            <!--  shows the bi items -->
                            <td>
                                <input type="text" class="form-control" maxlength="64" name="bi_name[]" >
                            </td>
                            <td>
                                <div class="input-group date date-picker" data-date-format="MM dd, yyyy">
                                    <input type="text" size="16" class="form-control" name="date_taken[]">
                                    <span class="input-group-btn">
                                    <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <input type="text" class="form-control" maxlength="64" name="score[]" >
                            </td> 
                            <td>
                                <div class="make-switch" data-off="danger" data-on="success" data-on-label="&nbsp;Yes&nbsp;&nbsp;" data-off-label="&nbsp;No&nbsp;">
                                 <input type="checkbox" value="0" checked="checked" name="status[temp][]" class="dontserializeme toggle bi_status"/>
                                <input type="hidden" name="status[]" value="1"/>
                                </div>
                            </td>
                            <!-- <td>
                            <a class="btn btn-xs text-muted" href="javascript:void(0)" onclick="delete_bi_row($(this))"><i class="fa fa-trash-o"></i> <?=lang('common.delete')?></a>
                            </td> -->
                        </tr>
                    </tbody>
                </table>


                <script type="text/javascript">
                    var bi_form = $('.bi_form').length;
                    if( !(bi_form > 1) ){
                        $("#no_record_bi").show();
                    }

                    $('.q').change(function(){
                        if( $(this).is(':checked') ){
                            $(this).parent().next().val(1);
                        }
                        else{
                            $(this).parent().next().val(0);
                        }
                    });    
                </script>
            </div>
            <!-- BI -->
            <!-- JOBOFFER -->
            <?php
            $disabled = "disabled";
            ?>
            <div id="tab_jo" class="tab-pane">
                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption">{{ lang('applicant_monitoring.jo_details') }}</div>
                        <div class="tools"><a class="collapse" href="javascript:;"></a></div>
                    </div>
                    <p>{{ lang('applicant_monitoring.note_jo_details') }}</p>
                    <div class="portlet-body form margin-top-25">
                        <form class="form-horizontal" name="jo-form" method="post"> 
                            <input type="hidden" value="<?php echo $process->process_id?>" name="process_id" id="process_id">
                            <input type="hidden" value="<?php echo $recruit->recruit_id?>" name="recruit_id" id="recruit_id">                                                       
                            <input type="hidden" value="<?php echo $template_id?>" name="recruit_id" id="template_id">
                            <div class="row">
                                <div class="col-md-12">                        
                                    <div class="form-group">
                                        <label class="control-label col-md-4"><?=lang('applicant_monitoring.template')?>
                                        </label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <?php
                                                    echo form_dropdown('jo[template_id]',$jo_template_options, $template_id, $disabled.' class="form-control select2me template_id" data-placeholder="Select..."');
                                                ?>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-info" onclick="print_jo(<?php echo $process->process_id?>)"><i class="fa fa-print"></i> <?=lang('applicant_monitoring.print')?></button>
                                                </span>
                                            </div>
                                            <div class="help-block small">
                                                <?=lang('applicant_monitoring.note_print')?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                                
                            <div class="row">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label class="control-label col-md-4">&nbsp;
                                        </label>                                    
                                        <div class="col-md-8">
                                            <textarea <?php echo $disabled ?> class="wysihtml5 form-control template_val" name="jo[template_value]" placeholder="" rows="6"></textarea>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">                             
                                    <div class="form-group">
                                        <label class="control-label col-md-4"><?=lang('applicant_monitoring.reports_to')?>
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <?php
                                                echo form_dropdown('jo[reports_to]',$reports_to_options, $reports_to, $disabled.' class="form-control select2me" data-placeholder="Select..."');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>                                
                            <div class="row">
                                <div class="col-md-12">                                  
                                    <div class="form-group">
                                        <label class="control-label col-md-4"><?=lang('applicant_monitoring.employee_status')?>
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <?php
                                                echo form_dropdown('jo[employment_status_id]',$employment_status_options, $employment_status_id, $disabled.' class="form-control select2me" data-placeholder="Select..." id="applicant_status"');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>                                                               
                            <div id="nonregular">
                                <div class="row">
                                    <div class="col-md-12">                                       
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><?=lang('applicant_monitoring.month_no')?>
                                                <!-- <span class="required">*</span> -->
                                            </label>
                                            <div class="col-md-6">
                                                <div class="input-icon">
                                                    <input type="text" class="form-control" id="no_months" name="jo[no_months]" <?=$disabled?> value="<?php echo $no_months?>">
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="row">
                                    <div class="col-md-12">                                      
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><?=lang('applicant_monitoring.start_date')?>
                                                <!-- <span class="required">*</span> -->
                                            </label>
                                            <div class="col-md-6">
                                                <div class="input-group input-medium date date-picker" data-date-format="MM dd yyyy">
                                                    <input type="text" name="jo[start_date]" id="jo-start_date" class="form-control" <?=$disabled?> value="<?php echo $start_date?>" >
                                                    <span class="input-group-btn">
                                                    <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-12">                                                                
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><?=lang('applicant_monitoring.end_date')?></label>
                                            <div class="col-md-6">
                                                <div class="input-group input-medium date date-picker" data-date-format="MM dd yyyy">
                                                    <input type="text" name="jo[end_date]" id="jo-end_date"  class="form-control" <?=$disabled?> value="<?php echo $end_date?>" >
                                                    <span class="input-group-btn">
                                                    <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                    
                            </div>
                            <div class="row">
                                <div class="col-md-12">                          
                                    <div class="form-group">
                                        <label class="control-label col-md-4"><?=lang('common.status')?></label>
                                        <div class="col-md-7">
                                            <div class="make-switch" data-off="danger" data-on="success" data-on-label="&nbsp;Accept&nbsp;&nbsp;" data-off-label="&nbsp;Decline&nbsp;">
                                                <input type="checkbox" <?=$disabled?> value="0" <?php if( $accept_offer ) echo 'checked="checked"'; ?> name="jo[accept_offer][temp]" id="jo-accept_offer-temp" class="dontserializeme toggle"/>
                                                <input type="hidden" name="jo[accept_offer]" id="jo-accept_offer" value="<?php echo ( $accept_offer ) ? 1 : 0 ; ?>"/>
                                            </div> 
                                            <small class="help-block">
                                            <?=lang('applicant_monitoring.note_status')?>
                                            </small>
                                        </div>
                                    </div>
                                </div>                                    
                            </div>
                            <div class="row">
                                <div class="col-md-12">                                 
                                    <div class="form-group declined_blacklisted">
                                        <label class="control-label col-md-4"><?=lang('applicant_monitoring.blacklisted')?></label>
                                        <div class="col-md-7">
                                            <div class="make-switch" data-off="success" data-on="danger" data-on-label="&nbsp;Yes&nbsp;&nbsp;" data-off-label="&nbsp;No&nbsp;">
                                                <input type="checkbox" <?=$disabled?>  value="1" <?php if( $blacklisted ) echo 'checked="checked"'; ?> name="recruitment[blacklisted][temp]" id="recruitment-blacklisted-temp" class="dontserializeme toggle"/>
                                                <input type="hidden" name="recruitment[blacklisted]" id="recruitment-blacklisted" value="<?php echo ( $blacklisted ) ? 1 : 0 ; ?>"/>
                                            </div> 
                                            <small class="help-block">
                                            <?=lang('applicant_monitoring.note_blacklist')?>
                                            </small>
                                        </div>
                                    </div>
                                </div>                                    
                            </div>
                        </form>
                        
                        <br><br>
                            
                            <!--Compensation and Benefits-->
                            <div class="portlet ">
                                <div class="portlet-title">
                                    <div class="caption">{{ lang('applicant_monitoring.compben') }}</div>
                                </div>                                
                                <div class="portlet-body form">
                                    <div class="form-body">
                                        <div class="portlet">
                                            <div class="portlet-body" >
                                                <!-- Table -->
                                                <table class="table table-condensed table-striped table-hover">
                                                    <thead>
                                                        <tr>                                                            
                                                            <th width="30%" class="padding-top-bottom-10" ><?=lang('applicant_monitoring.benefits')?></th>
                                                            <th width="25%" class="padding-top-bottom-10 hidden-xs" ><?=lang('applicant_monitoring.amount')?></th>
                                                            <th width="35%" class="padding-top-bottom-10"><?=lang('applicant_monitoring.mode')?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="saved-benefits">
                                                        @foreach( $benefits->result() as $benefit )
                                                            <tr>
                                                                <td>
                                                                    <?php echo form_dropdown('compben[benefit_id]',$cbopt, $benefit->benefit_id, 'disabled class="form-control select2me" data-placeholder="Select..."')?>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" disabled name="compben[amount]" value="<?php echo number_format($benefit->amount, 2, '.', ',')?>" >
                                                                </td>
                                                                <td>
                                                                    <?php echo form_dropdown('compben[rate_id]',$rateopt, $benefit->rate_id, 'disabled class="form-control select2me" data-placeholder="Select..."')?>
                                                                </td>
                                                            </tr>
                                                        @endforeach    
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                         <!-- END FORM--> 
                    </div>
                </div>
                <div class="modal-footer margin-top-0">
                    <button class="btn btn-default btn-sm" data-dismiss="modal" type="button">{{ lang('common.close') }}</button>
                </div>
            </div>
            <!-- JOBOFFER -->
            <!-- CS -->
<!--              <div id="tab_cs" class="tab-pane">
                    <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption">Contract Signing</div>
                            <div class="tools">
                                <a class="collapse" href="javascript:;"></a>
                            </div>
                        </div>
                        <p>This section manages contract signing template.</p>

                        <div class="portlet-body form margin-top-25"> -->
                            <!-- BEGIN FORM-->
<!--                             <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 text-right text-muted">Template : </label>
                                        <div class="col-md-7 col-sm-7"><span >{{  $template_cs }}</span>
                                            <span class="help-block small">
                                                Click button to print template.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 text-right text-muted">Status : </label>
                                        <div class="col-md-7 col-sm-7"><span >{{ ($signing_accepted)  ? '<span class="event-block label label-success">Accepted</span>' : '<span class="event-block label label-default">Decline</span>' }}</span>
                                            <span class="help-block small">The status if the applicant sign or accept the offer.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 text-right text-muted">BlackListed : </label>
                                        <div class="col-md-7 col-sm-7"><span >{{ ($blacklisted)  ? '<span class="event-block label label-danger">Yes</span>' : '<span class="event-block label label-success">No</span>' }}</span>
                                            <span class="help-block small"> Mark as block listed if applicant rejects the offer.</span>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                             <!-- END FORM--> 
<!--                         </div>
                    </div>
                    <div class="modal-footer margin-top-0">
                        <button class="btn btn-default btn-sm" data-dismiss="modal" type="button">Close</button>                       
                        <button type="button" class="btn btn-sm btn-info"><i class="fa fa-print"></i> Print</button>                       
                    </div>
                </div> -->
            <!-- CS -->
            <!-- PRE-EMPLOYMENT -->
            <div id="tab_preemp" class="tab-pane">
                <div class="portlet">
                    <div class="portlet-body" >
                        <!-- Table -->
                        <table class="table table-condensed table-striped table-hover" >
                            <thead>
                                <tr>                                        
                                    <th width="47%" class="padding-top-bottom-10" >{{ lang('applicant_monitoring.requirements') }}</th>
                                    <th width="32%" class="padding-top-bottom-10 ">{{ lang('applicant_monitoring.completed') }}</th>
                                    
                                </tr>
                            </thead>
                            <tbody>                     
                                @foreach( $checklist->result() as $list )
                                <tr rel="0">
                                    <!-- this first column shows the year of this holiday item -->
                                    <td>{{ $list->checklist  }}</td> 
                                    <td>
                                        @if($list->for_submission == 1)
                                            @if($list->submitted)  
                                             <span ><i class="fa fa-check text-success"></i> {{ lang('applicant_monitoring.done') }}</span>
                                             @else
                                             <span class="badge badge-danger" >No</span>
                                            @endif
                                        @else
                                            <span ><i class="fa fa-check text-success"></i> {{ lang('applicant_monitoring.done') }}</span>
                                        @endif

                                        <small class="help-block small">

                                        <?php if($list->submitted == 1){ 
                                                if(strtotime($list->modified_on)){
                                                    echo date('d M Y h:ia', strtotime($list->modified_on));
                                                }else if(strtotime($list->created_on)){
                                                    echo date('d M Y h:ia', strtotime($list->created_on));
                                                }
                                            }else{
                                                if(strtotime($list->modified_on)){
                                                    echo date('d M Y h:ia', strtotime($list->modified_on));
                                                }
                                            } ?>

                                        </small>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer margin-top-0">
                    <button class="btn btn-default btn-sm" data-dismiss="modal" type="button">{{ lang('common.close') }}</button>
                </div>
            </div>
            <!-- PRE-EMPLOYMENT -->

        </div>
	</div>
</div>