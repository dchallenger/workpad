<link rel="stylesheet" type="text/css" href="<?php echo theme_path() ?>plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css"/>

<script type="text/javascript" src="<?php echo theme_path() ?>plugins/bootstrap-tagsinput/typeahead.js"></script>
<script src="<?php echo theme_path() ?>plugins/bootstrap-switch/static/js/bootstrap-switch.min.js" type="text/javascript" ></script> 
<?php 
    $hidden = "";
    $disabled = "";
    if($is_interviewer == 1){
        $hidden = "style='display:none'";
        $disabled = "disabled";
    }
?>
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title margin-bottom-5"><?php echo $recruit->firstname . ' ' . $recruit->lastname?></h4> 
        <p class="margin-bottom-10 text-muted"><?php echo $position?></p> 
        <ul class="list-inline text-muted"><?php
            if(!empty($phone)): ?>
                <li class="small">
                <i class="fa fa-phone"></i>
                <span><?php echo $phone?></span>
                </li> <?php
            endif;
            if(!empty($mobile)): ?>
                <li class="small">
                <i class="fa fa-mobile"></i>
                <span><?php echo $mobile?></span>
                </li> <?php
            endif;
             if(!empty($recruit->email)): ?>
                <li class="small">
                <i class="fa fa-envelope"></i>
                <span><?php echo $recruit->email?></span>
                </li> <?php
            endif; ?>
        </ul>

    </div>
    <div class="modal-body padding-bottom-0">
        <div class="">
            <ul class="nav nav-tabs ">
                <?php
                    if ($process->status_id == 5){
                ?>
                        <li class="<?php if($process->status_id == 5) echo 'active' ?>"><a data-toggle="tab" href="#tab_final_interview"><?=lang('applicant_monitoring.final_interview')?></a></li>
                <?php
                    }
                    else{
                ?>
                        <li class="<?php if($process->status_id == 1) echo 'active' ?>"><a data-toggle="tab" href="#tab_schedule"><?=lang('applicant_monitoring.schedule')?></a></li>
                        <li class="<?php if($process->status_id == 2) echo 'active' ?>"><a data-toggle="tab" href="#tab_interview"><?=lang('applicant_monitoring.interview')?></a></li>
                        <li class="<?php if($process->status_id == 3) echo 'active' ?>"><a data-toggle="tab" href="#tab_examination">Examination</a></li>       
                        <li class="<?php if($process->status_id == 4) echo 'active' ?>"><a data-toggle="tab" href="#tab_bi">BI</a></li>                
                <?php
                    }
                ?>
                <li class="<?php if($process->status_id == 6) echo 'active' ?>"><a data-toggle="tab" href="#tab_jo"><?=lang('applicant_monitoring.job_order')?></a></li>

            </ul>
            <div class="tab-content margin-top-20" style="min-height:300px;">
                <div id="tab_schedule" class="tab-pane">
                    <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption"><?=lang('applicant_monitoring.interview_sched')?></div>
                            <div class="tools">
                                <a class="collapse" href="javascript:;"></a>
                            </div>
                        </div>
                        <p><?=lang('applicant_monitoring.note_add_interview')?></p>

                        <div class="portlet-body form">
                            <?php
                                if($process->status_id > 1){
                                    $disabled = "disabled";  
                                    $hidden = "style='display:none'"; 
                                }                            
                            ?>                             
                            <!-- START FORM -->
                            <form action="#" class="form-horizontal" name="schedule-form">
                                <input type="hidden"  name="process_id" value="<?php echo $process_id?>">
                                <input type="hidden"  name="type" value="1">
                                <div class="form-body">
                                    <div class="portlet">

                                        <span class="pull-right margin-bottom-15" <?=$hidden?>><div class="btn btn-success btn-xs" onclick="add_sched_row()">+ <?=lang('applicant_monitoring.add_interviewer')?></div></span>
                                        <div class="portlet-body" >
                                            <table class="table table-condensed table-striped table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th width="29%" class="padding-top-bottom-10" ><?=lang('applicant_monitoring.date')?></th>
                                                        <th width="31%" class="padding-top-bottom-10 hidden-xs" ><?=lang('applicant_monitoring.interviewer')?></th>
                                                        <th width="25%" class="padding-top-bottom-10" >Location</th>
                                                        <th width="25%" class="padding-top-bottom-10" ><?=lang('common.actions')?></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="saved-scheds">
                                                <?php                        
                                                    $option = $this->db->get_where('recruitment_interview_location', array('deleted' => 0));
                                                    $options = array('' => 'Select...');
                                                    foreach ($option->result() as $opt) {
                                                        $options[$opt->interview_location_id] = $opt->interview_location;
                                                    }
                                                    if( $saved_scheds ):
                                                        foreach( $saved_scheds as $sched ): ?>
                                                            <tr>
                                                                <td>
                                                                    <!-- <div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
                                                                        <input name="sched_date[]" type="text" size="16" class="form-control" value="<?php echo date('M d, Y', strtotime($sched->date))?>">
                                                                        <span class="input-group-btn">
                                                                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                                        </span>
                                                                    </div> -->
                                                                    <div class="input-group date form_datetime">                                       
                                                                        <input type="text" size="16" readonly class="form-control sched_datetime" name="sched_date[]" value="<?php echo date('F d, Y - H:i', strtotime($sched->date))?>" />
                                                                        <span class="input-group-btn" >
                                                                            <button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
                                                                        </span>
                                                                    </div>
                                                                </td> 
                                                                <td>
                                                                    <input type="hidden"  name="sched_user_id[]" value="<?php echo $sched->user_id?>" class="form-control">
                                                                    <input type="text" <?=$disabled?> name="partner_name" value="<?php echo $sched->full_name?>" type="text" class="form-control" autocomplete="off">
                                                                </td>
                                                                <td>
                                                                    <!-- <input type="text" name="location[]" id="location" type="text" class="form-control" value="<?php echo $sched->location ?>"> -->
                                                                <?php 
                                                                    echo form_dropdown('location_id[]',$options, $sched->location_id, $disabled.' class="form-control select2me" data-placeholder="Select..."');
                                                                ?>
                                                                </td>
                                                                <td >
                                                                    <a <?=$hidden?> class="btn btn-xs text-muted" href="javascript:void(0)" onclick="send_email(<?php echo $process_id?>, <?php echo $sched->user_id?>)"><i class="fa fa-envelope-o"></i> <?=lang('common.send_email')?></a>
                                                                    <a <?=$hidden?> class="btn btn-xs text-muted" href="javascript:void(0)" onclick="delete_row($(this))"><i class="fa fa-trash-o"></i> <?=lang('common.delete')?></a>
                                                                </td>
                                                            </tr> <?php
                                                        endforeach;
                                                    endif;
                                                ?></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer margin-top-0">
                        <button type="button" data-dismiss="modal" class="btn btn-default btn-sm"><?=lang('common.close')?></button>
                        <button <?=$hidden?> type="button" data-loading-text="Loading..." onclick="save_schedule()" class="demo-loading-btn btn btn-success btn-sm"><?=lang('common.save')?></button>
                    </div>
                </div>
                <div id="tab_interview" class="tab-pane <?php if($process->status_id == 2) echo 'active' ?>">
                    <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption"><?=lang('applicant_monitoring.interview_details')?></div>
                            <div class="tools">
                                <a class="collapse" href="javascript:;"></a>
                            </div>
                        </div>
                        <p><?=lang('applicant_monitoring.note_interview_result')?></p>

                        <div class="portlet-body form">
                            <?php
                                if($process->status_id > 2){
                                    $disabled = "disabled";  
                                    $hidden = "style='display:none'"; 
                                }                            
                            ?>                            
                            <!-- <form action="#" class="form-horizontal"> -->
                            <div class="form-body">
                                <div class="portlet">
                                    <div class="portlet-body" >
                                        <table class="table table-condensed table-striped table-hover" >
                                            <thead>
                                                <tr>
                                                    <th width="35%" class="padding-top-bottom-10" ><?=lang('applicant_monitoring.interviewer')?></th>
                                                    <th width="22%" class="padding-top-bottom-10 "><?=lang('applicant_monitoring.date')?></th>
                                                    <th width="20%" class="padding-top-bottom-10 "><?=lang('applicant_monitoring.result')?></th>
                                                    <th width="23%" class="padding-top-bottom-10" ><?=lang('common.actions')?></th>
                                                </tr>
                                            </thead>
                                            <tbody id="saved-interviews"><?php
                                                $interview_success = 1;
                                                if( $saved_scheds ):
                                                    foreach( $saved_scheds as $sched ): 
                                                        if($sched->result == "Hold")
                                                        {
                                                            $interview_success = 9;
                                                        }
                                                        elseif($sched->result == "Reject"){
                                                           $interview_success = 10;
                                                        }
                                                        elseif($sched->result == "Pending"){
                                                           $interview_success = 0;
                                                        }                                                        
                                                            ?>
                                                        <tr rel="0">
                                                            <td style="font-size:13px !important;">
                                                                <?php echo $sched->full_name ?><br>
                                                                <span class="small text-muted"><?php echo $sched->position?></span>
                                                            </td> 
                                                            <td style="font-size:13px !important;">
                                                                <?php echo date('M-d', strtotime( $sched->date )) ?>
                                                                <span class="text-muted small"><?php echo date('D', strtotime( $sched->date ))?></span>
                                                                <br>
                                                                <span class="text-muted small"><?php echo date('Y', strtotime( $sched->date ))?></span>
                                                            </td>
                                                            <td>
                                                                <?php 
                                                                    if( empty( $sched->result ) ):
                                                                        echo '<span class="badge badge-warning">Pending</span>';
                                                                    else:
                                                                        echo '<span class="badge '.$sched->class.'">'.$sched->result.'</span>';
                                                                    endif;
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php if($sched->interviewer == $login_user && $interview_success != 1):?>
                                                                <div class="btn-group">
                                                                    <a class="btn btn-xs text-muted" href="javascript:edit_interview_result(<?php echo $sched->schedule_id?>);"><i class="fa fa-pencil"></i> <?=lang('common.edit')?></a>
                                                                </div>
                                                                <?php else:?>
                                                                <div class="btn-group">
                                                                    <a class="btn btn-xs text-muted" href="javascript:view_interview_result(<?php echo $sched->schedule_id?>);"><i class="fa fa-search"></i> <?=lang('common.view')?></a>
                                                                </div>
                                                                <?php endif;?>
                                                                <div class="btn-group">
                                                                    <a class="btn btn-xs text-muted" href="javascript:print_interview(<?php echo $sched->process_id?>,<?php echo $sched->type?>);"><i class="fa fa-print"></i> <?=lang('applicant_monitoring.print')?></a>
                                                                </div>
                                                            </td>
                                                        </tr> <?php
                                                    endforeach;
                                                endif;
                                            ?></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <!-- </form> -->
                        </div>
                    </div>
                    <div class="modal-footer margin-top-0">
                        <button type="button" data-dismiss="modal" class="btn btn-default btn-sm"><?=lang('common.close')?></button>
                        <button type="button" data-dismiss="modal" class="btn btn-default btn-sm hidden" onclick="print_interview(<?php echo $process_id?>)"><?=lang('common.print_only')?></button>
                        <?php if( $process->status_id == 2 && $process->from_seting_final_interview == 1) {
                        ?>
                            <button <?=$hidden?> type="button" onclick="move_to_exam(<?php echo $process_id?>,<?php echo $interview_success ?>)" class="demo-loading-btn btn btn-success btn-sm"><?=lang('applicant_monitoring.move_to_exam')?></button>
                        <?php
                            }
                            else{
                        ?>
                            <button <?=$hidden?> type="button" onclick="move_to_jo(<?php echo $process_id?>,<?php echo $interview_success ?>)" class="demo-loading-btn btn btn-success btn-sm"><?=lang('applicant_monitoring.move_to_jo')?></button>
                        <?php
                            }
                        ?>
                    </div>
                </div> 
                <div id="tab_final_interview" class="tab-pane <?php if($process->status_id == 5) echo 'active' ?>">
                    <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption"><?=lang('applicant_monitoring.interview_sched')?></div>
                            <div class="tools">
                                <a class="collapse" href="javascript:;"></a>
                            </div>
                        </div>
                        <p><?=lang('applicant_monitoring.note_add_interview')?></p>

                        <div class="portlet-body form">
                            <!-- START FORM -->
                            <form action="#" class="form-horizontal" name="schedule-form">
                                <input type="hidden"  name="process_id" value="<?php echo $process_id?>">
                                <input type="hidden"  name="type" value="2">
                                <div class="form-body">
                                    <div class="portlet">

                                        <span class="pull-right margin-bottom-15" <?=$hidden?>><div class="btn btn-success btn-xs" onclick="add_sched_row(2)">+ <?=lang('applicant_monitoring.add_interviewer')?></div></span>
                                        <div class="portlet-body" >
                                            <table class="table table-condensed table-striped table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th width="29%" class="padding-top-bottom-10" ><?=lang('applicant_monitoring.date')?></th>
                                                        <th width="31%" class="padding-top-bottom-10 hidden-xs" ><?=lang('applicant_monitoring.interviewer')?></th>
                                                        <th width="25%" class="padding-top-bottom-10" >Location</th>
                                                        <th width="25%" class="padding-top-bottom-10" ><?=lang('common.actions')?></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="saved-scheds-final">
                                                <?php                        
                                                    $option = $this->db->get_where('recruitment_interview_location', array('deleted' => 0));
                                                    $options = array('' => 'Select...');
                                                    foreach ($option->result() as $opt) {
                                                        $options[$opt->interview_location_id] = $opt->interview_location;
                                                    }
                                                    if( $saved_scheds ):
                                                        foreach( $saved_scheds as $sched ): ?>
                                                            <tr>
                                                                <td>
                                                                    <!-- <div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
                                                                        <input name="sched_date[]" type="text" size="16" class="form-control" value="<?php echo date('M d, Y', strtotime($sched->date))?>">
                                                                        <span class="input-group-btn">
                                                                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                                        </span>
                                                                    </div> -->
                                                                    <div class="input-group date form_datetime">                                       
                                                                        <input type="text" size="16" readonly class="form-control sched_datetime" name="sched_date[]" value="<?php echo date('F d, Y - H:i', strtotime($sched->date))?>" />
                                                                        <span class="input-group-btn" >
                                                                            <button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
                                                                        </span>
                                                                    </div>
                                                                </td> 
                                                                <td>
                                                                    <input type="hidden"  name="sched_user_id[]" value="<?php echo $sched->user_id?>" class="form-control">
                                                                    <input type="text" <?=$disabled?> name="partner_name" value="<?php echo $sched->full_name?>" type="text" class="form-control" autocomplete="off">
                                                                </td>
                                                                <td>
                                                                    <!-- <input type="text" name="location[]" id="location" type="text" class="form-control" value="<?php echo $sched->location ?>"> -->
                                                                <?php 
                                                                    echo form_dropdown('location_id[]',$options, $sched->location_id, $disabled.' class="form-control select2me" data-placeholder="Select..."');
                                                                ?>
                                                                </td>
                                                                <td >
<!--                                                                     <a <?=$hidden?> class="btn btn-xs text-muted" href="javascript:void(0)" onclick="send_email(<?php echo $process_id?>, <?php echo $sched->user_id?>)"><i class="fa fa-envelope-o"></i> <?=lang('common.send_email')?></a> -->
                                                                    <a <?=$hidden?> class="btn btn-xs text-muted" href="javascript:void(0)" onclick="delete_row($(this))"><i class="fa fa-trash-o"></i> <?=lang('common.delete')?></a>
                                                                </td>
                                                            </tr> <?php
                                                        endforeach;
                                                    endif;
                                                ?></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer margin-top-0" <?=$hidden?>>
                        <button type="button" data-dismiss="modal" class="btn btn-default btn-sm"><?=lang('common.close')?></button>
                        <button type="button" data-loading-text="Loading..." onclick="save_schedule()" class="demo-loading-btn btn btn-success btn-sm"><?=lang('common.save')?></button>
                    </div>
                </div>
                <div id="tab_examination" class="tab-pane <?php if($process->status_id == 3) echo 'active' ?>">
                <?php require 'exam.php'; ?>
                </div>
                <div id="tab_bi" class="tab-pane <?php if($process->status_id == 4) echo 'active' ?>">
                <?php require 'bi_forms_view.php'; ?>
                </div>
                <div id="tab_jo" class="tab-pane <?php if($process->status_id == 6) echo 'active' ?>">
                    <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption">Job Offer</div>
                            <div class="tools">
                                <a class="collapse" href="javascript:;"></a>
                            </div>
                        </div>
                        <p><?=lang('applicant_monitoring.note_jo_details')?></p>

                        <div class="portlet-body form margin-top-25">
                            <?php
                                if($process->status_id > 6){
                                    $disabled = "disabled";  
                                    $hidden = "style='display:none'"; 
                                }                         
                                else{
                                    $disabled = "";  
                                    $hidden = "";                                     
                                }   
                            ?>                            
                            <!-- BEGIN FORM-->
                            <form class="form-horizontal" name="jo-form" method="post"> 
                                <input type="hidden" value="<?php echo $process->process_id?>" name="process_id" id="process_id">
                                <input type="hidden" value="<?php echo $recruit->recruit_id?>" name="recruit_id" id="recruit_id">                               
                                <div class="form-group">
                                    <label class="control-label col-md-4"><?=lang('applicant_monitoring.template')?>
                                    </label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <?php
                                                $option = $this->db->get_where('recruitment_process_offer_template', array('deleted' => 0));
                                                $options = array('' => 'Select...');
                                                foreach ($option->result() as $opt) {
                                                    $options[$opt->template_id] = $opt->template_name;
                                                }

                                                echo form_dropdown('jo[template_id]',$options, $template_id, $disabled.' class="form-control select2me template_id" data-placeholder="Select..."');
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
                                <div class="form-group">
                                    <label class="control-label col-md-4">&nbsp;
                                    </label>                                    
                                    <div class="col-md-8">
                                        <textarea class="wysihtml5 form-control template_val" name="jo[template_value]" placeholder="" rows="6"></textarea>
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <label class="control-label col-md-4"><?=lang('applicant_monitoring.reports_to')?>
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <?php
                                            $option = $this->db->query("SELECT users.* FROM users
                                                                        LEFT JOIN users_profile ON users.user_id = users_profile.user_id
                                                                        WHERE users.active = 1 AND users.deleted = 0 AND users.user_id != 0
                                                                        ORDER BY full_name");
                                            $options = array('' => 'Select...');
                                            foreach ($option->result() as $opt) {
                                                $options[$opt->user_id] = $opt->full_name;
                                            }

                                            echo form_dropdown('jo[reports_to]',$options, $reports_to, $disabled.' class="form-control select2me" data-placeholder="Select..."');
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4"><?=lang('applicant_monitoring.employee_status')?>
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <?php
                                            $option = $this->db->get_where('partners_employment_status', array('active' => 1, 'deleted' => 0));
                                            $options = array('' => 'Select...');
                                            foreach ($option->result() as $opt) {
                                                $options[$opt->employment_status_id] = $opt->employment_status;
                                            }

                                            echo form_dropdown('jo[employment_status_id]',$options, $employment_status_id, $disabled.' class="form-control select2me" data-placeholder="Select..." id="applicant_status"');
                                        ?>
                                    </div>
                                </div>
                                <div id="nonregular">
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
<!--                                 <div class="form-group">
                                    <label class="control-label col-md-4"><?=lang('applicant_monitoring.work_sched')?>
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <?php
                                            // $option = $this->db->get_where('partners_employment_status', array('active' => 1, 'deleted' => 0));
                                            $options = array('' => 'Select...', 1 => 'Mon - Fri', 2 => 'Mon - Sat');
                                            // foreach ($option->result() as $opt) {
                                            //     $options[$opt->employment_status_id] = $opt->employment_status;
                                            // }

                                            echo form_dropdown('jo[work_schedule]',$options, $work_schedule, $disabled.' class="form-control select2me" data-placeholder="Select..."');
                                        ?>
                                    </div>
                                </div> -->
                                <!-- <div class="form-group">
                                    <label class="control-label col-md-4"><?=lang('applicant_monitoring.time_sched')?>
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <?php
                                            $option = $this->db->query("SELECT * FROM {$this->db->dbprefix}time_shift WHERE deleted = 0 AND default_calendar >= 0 ORDER BY shift");
                                            $options = array('' => 'Select...');
                                            foreach ($option->result() as $opt) {
                                                $options[$opt->shift_id] = $opt->shift;
                                            }

                                            echo form_dropdown('jo[shift_id]',$options, $shift_id, $disabled.' class="form-control select2me" data-placeholder="Select..."');
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4"><?=lang('applicant_monitoring.lunch_break')?>
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <?php
                                            $options = array('' => 'Select...', 1 => '12 - 1 PM', 2 => '1 - 2 PM');
                                            echo form_dropdown('jo[lunch_break]',$options, $lunch_break, $disabled.' class="form-control select2me" data-placeholder="Select..."');
                                        ?>
                                    </div>
                                </div> -->
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

                                <br><br>
                                
                                <!--Compensation and Benefits-->
                                <div class="portlet ">
                                    <div class="portlet-title">
                                        <div class="caption"><?=lang('applicant_monitoring.compben')?></div>
                                        <div class="pull-right" <?=$hidden?>>
                                            <a class="btn btn-success btn-xs pull-right" href="javascript:add_benefit_row();">+ Add Item</a>
                                        </div>
                                    </div>
                                    
                                    <div class="portlet-body form">
                                        <div class="form-body">
                                            <div class="portlet">
                                                <div class="portlet-body" >
                                                    <!-- Table -->
                                                    <table class="table table-condensed table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                
                                                                <th width="25%" class="padding-top-bottom-10" ><?=lang('applicant_monitoring.items')?></th>
                                                                <th width="25%" class="padding-top-bottom-10 hidden-xs" ><?=lang('applicant_monitoring.amount')?></th>
                                                                <th width="25%" class="padding-top-bottom-10"><?=lang('applicant_monitoring.mode')?></th>
                                                                <th width="5%" class="padding-top-bottom-10"><?=lang('applicant_monitoring.permanent')?></th>
                                                                <th width="10%" class="padding-top-bottom-10" ><?=lang('common.actions')?></th>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                            $this->db->order_by('transaction_label');
                                                            $compben = $this->db->get_where('payroll_transaction', array('deleted' => 0, 'show_in_recruitment' => 1));
                                                            $cbopt = array('' => 'Select...');
                                                            foreach( $compben->result() as $cb )
                                                            {
                                                                $cbopt[$cb->transaction_id] = $cb->transaction_label;
                                                            }

                                                            $rates = $this->db->get_where('payroll_rate_type', array('deleted' => 0));
                                                            $rateopt = array('' => 'Select...');
                                                            foreach( $rates->result() as $rate )
                                                            {
                                                                $rateopt[$rate->payroll_rate_type_id] = $rate->payroll_rate_type;
                                                            }
                                                        ?>
                                                        <tbody id="saved-benefits">
                                                        <?php
                                                            $qry = "SELECT a.*, b.transaction_label
                                                            FROM {$this->db->dbprefix}recruitment_process_offer_compben a
                                                            LEFT JOIN {$this->db->dbprefix}payroll_transaction b on b.transaction_id = a.benefit_id
                                                            WHERE a.process_id = {$process->process_id}";
                                                            $benefits = $this->db->query($qry);
                                                            foreach( $benefits->result() as $benefit ): ?>
                                                                <tr class="combenefits">
                                                                    <td>
                                                                        <?php echo form_dropdown('compben[benefit_id][]',$cbopt, $benefit->benefit_id, $disabled.' class="form-control select2me" data-placeholder="Select..."')?>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control" name="compben[amount][]" <?=$disabled?> value="<?php echo $benefit->amount?>" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false">
                                                                    </td>
                                                                    <td>
                                                                        <?php echo form_dropdown('compben[rate_id][]',$rateopt, $benefit->rate_id, $disabled.' class="form-control select2me" data-placeholder="Select..."')?>
                                                                    </td>
                                                                    <td>
                                                                        <div class="make-switch" data-off="success" data-on="danger" data-on-label="&nbsp;No&nbsp;&nbsp;" data-off-label="&nbsp;Yes&nbsp;">
                                                                            <input type="checkbox" <?=$disabled?>  value="1" <?php if( $benefit->permanent ) echo 'checked="checked"'; ?> name="" id="" class="dontserializeme toggle"/>
                                                                            <input type="hidden" name="compben[permanent][]" value="<?php echo ( $benefit->permanent ) ? 1 : 0 ; ?>"/>
                                                                        </div> 
                                                                    </td>                                                                    
                                                                    <td>
                                                                        <a <?=$hidden?> class="btn btn-xs text-muted" href="javascript:void(0)" onclick="delete_benefit_row($(this))"><i class="fa fa-trash-o"></i> <?=lang('common.delete')?></a>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            endforeach;
                                                        ?>    
                                                        </tbody>
                                                    </table>

                                                     <div id="no_record" class="well" style="display:none;">
                                                        <p class="bold"><i class="fa fa-exclamation-triangle"></i> <?php echo lang('common.no_record_found') ?></p>
                                                        <span><p class="small margin-bottom-0"><?php echo 'Zero (0) was found. Click Add button to add an item.' ?></p></span>
                                                    </div>
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
                        <button class="btn btn-default btn-sm" data-dismiss="modal" type="button"><?=lang('common.close')?></button>
                        <?php 
                            $show_hidden = (isset($reports_to) && !empty($reports_to)) ? '' : 'hidden'; 
                            $show_hidden = (isset($accept_offer) && $accept_offer == 1) ? '' : 'hidden';
                        ?>
                        <span <?=$hidden?>>
                            <button type="button" onclick="save_jo()" class="demo-loading-btn btn btn-success btn-sm"><?=lang('applicant_monitoring.save_jo_details')?></button>
                            <button id="email_job_offer" type="button" onclick="email_jo(<?php echo $process->process_id?>)" class="demo-loading-btn btn btn-warning btn-sm <?php echo $show_hidden;?>"><?=lang('applicant_monitoring.email_jo')?></button>
                            <button id="move_pre_em" class="demo-loading-btn btn btn-success btn-sm <?php echo $show_hidden;?>" onclick="move_to_preemp(<?php echo $process->process_id?>)" type="button">Move to Pre-Employment</button>
                        </span>
                    </div>
                </div>
            </div>                        
        </div>
    </div>
</div>

<table style="display:none" id="sched-row">
    <tbody>
        <tr>
            <td>
                <div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
                    <input name="sched_date[]" type="text" size="16" class="form-control">
                    <span class="input-group-btn">
                    <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                    </span>
                </div>
            </td> 
            <td>
                <input type="hidden"  name="sched_user_id[]" class="form-control">
                <input type="text" name="partner_name" type="text" class="form-control" autocomplete="off">
            </td>
            <td>
                <a class="btn btn-xs text-muted" href="javascript:void(0)" onclick="delete_row($(this))"><i class="fa fa-trash-o"></i> <?=lang('common.delete')?></a>
            </td>
        </tr>
    </tbody>
</table>

<table style="display:none" id="benefit-row">
    <tbody>
        <tr>
            <td>
                <?php echo form_dropdown('compben[benefit_id][]',$cbopt, '', 'class="form-control select2me3" data-placeholder="Select..."')?>
            </td>
            <td>
                <input type="text" class="form-control" name="compben[amount][]" value="" >
            </td>
            <td>
                <?php echo form_dropdown('compben[rate_id][]',$rateopt, '', 'class="form-control select2me3" data-placeholder="Select..."')?>
            </td>
            <td>
                <a class="btn btn-xs text-muted" href="javascript:void(0)" onclick="delete_row($(this))"><i class="fa fa-trash-o"></i> <?=lang('common.delete')?></a>
            </td>
        </tr>
    </tbody>
</table>

<script type="text/javascript">

    $(document).ready(function(){

        $('.recruitment-permanent-temp').change(function(){
            if( $(this).is(':checked') ){
                $(this).parent('div').next().val(0);
            }
            else{
                $(this).parent('div').next().val(1);
            }
        });   
                
        if($('#jo-accept_offer').val() == 1){
            $('.declined_blacklisted').hide();
        }else{
            $('.declined_blacklisted').show();
        }
        $('#jo-accept_offer-temp').change(function(){
            if( $(this).is(':checked') ){
                $('#jo-accept_offer').val('1');
                $('.declined_blacklisted').hide();
            }
            else{
                $('.declined_blacklisted').show();
                $('#jo-accept_offer').val('0');
            }
        });

        $('#recruitment-blacklisted-temp').change(function(){
            if( $(this).is(':checked') ){
                $('#recruitment-blacklisted').val('1');
            }
            else{
                $('#recruitment-blacklisted').val('0');
            }
        });
        // $( "#applicant_status" ).change(function() {
        //     //contractual or probi - show # of months, start/end date
        //     if( $(this).val() == 2 || $(this).val() == 5 || $(this).val() == 6){

        //     }
        // });
        var comben = $('.combenefits').length;
        if( !(comben > 0) ){
            $("#no_record").show();
        }

        $('#jo-start_date').change(function(){
            if ($(this).val() != ''){
                var duration = parseInt($('#no_months').val());
                var date1 = new Date($(this).val());
                var month;

                // "+7" = + 6 months    
                if( (date1.getMonth() + 1 + duration) > 12 ){ 
                    date1.setMonth( (date1.getMonth() + 1 + duration)-12); 
                    date1.setFullYear( date1.getFullYear() + 1);
                    month = date1.getMonth();
                } else if ((date1.getMonth() + 1 + duration) == 12) {
                    date1.setMonth(date1.getMonth() + 1 + duration);
                    date1.setFullYear( date1.getFullYear() - 1);
                    month = 12 ;
                } else {
                    date1.setMonth(date1.getMonth() + 1 + duration);
                    month = date1.getMonth();
                }

                $('#jo-end_date').datepicker({
                        format: 'MM dd yyyy'
                    });
                // Timeout is needed calendar does not update when two instances are open.
                setTimeout(function () {
                   $('#jo-end_date').datepicker('setDate', new Date (month + '/' + date1.getDate() + '/' + date1.getFullYear())).trigger('change');
                }, 100);

               
            }
        })


    });

</script>