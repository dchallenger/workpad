<style type="text/css">
    .number{
        padding-right: 10px;
    }
    .next_pa {
        margin-left: 20px;
    }
    .no-margin {
        margin: 0 ! important;
    }
</style>
<?php
    if ($bi && $bi->num_rows() > 0){
        $bi_header = $bi->row();
    }
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
            <span class="pull-right margin-bottom-15"><div class="btn btn-success btn-xs" onclick="add_prev_work_row()">+ Add Previous Work </div></span>
            <br clear="all">
        </div>
        <div class="portlet-body form">
            <!-- START FORM -->
            <form action="#" class="form-horizontal" name="bi-form" id="bi-form">
                <input type="hidden"  name="process_id" value="<?php echo $process_id?>">
                <?php
                    if ($bi && $bi->num_rows() > 0){
                        foreach ($bi->result() as $row) {
                ?>
                            <div class="bi_form_header">
                                <div class="form-bordered">
                                    <h3 class="form-group"></h3>
                                    <span class="pull-right margin-top-15 margin-bottom-15"><div class="btn btn-xs text-muted delete_sched_row"><i class="fa fa-trash-o"></i> Delete</div></span>
                                    <br clear="all">    
                                </div>
                                <div class="form-body">
                                    <div class="portlet">
                                        <div class="portlet-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td width="50%">Name of Character Reference</td>
                                                            <td width="50%"><input type="text" class="form-control" name="reference_person[]" id="reference_person" value="<?php echo $row->reference_person ?>"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Position</td>
                                                            <td><input type="text" class="form-control" name="position[]" id="position" value="<?php echo $row->position ?>"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Company</td>
                                                            <td><input type="text" class="form-control" name="company[]" id="company" value="<?php echo $row->company ?>"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p class="no-margin"><span class="number">1.</span>Relationship</p>
                                                                <p class="next_pa">How did you know the candidate?</p>
                                                            </td>
                                                            <td>
                                                                <input type="text" size="16" class="form-control" name="ans1[]" value="<?php echo $row->ans1 ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p class="no-margin"><span class="number">2.</span>Efficiency at work</p>
                                                                <p class="next_pa">What can you say about his/her attendance (absence/tardiness)?</p>
                                                            </td>
                                                            <td>
                                                                <input type="text" size="16" class="form-control" name="ans2[]" value="<?php echo $row->ans2 ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p class="next_pa">How closely was he/she supervised?</p>
                                                            </td>
                                                            <td>
                                                                <input type="text" size="16" class="form-control" name="ans3[]" value="<?php echo $row->ans3 ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p class="next_pa">How would you describe the QUALITY of work he/she does?</p>
                                                            </td>
                                                            <td>
                                                                <input type="text" size="16" class="form-control" name="ans4[]" value="<?php echo $row->ans4 ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p class="next_pa">How would you describe the QUANTITY of work he/she does?</p>
                                                            </td>
                                                            <td>
                                                                <input type="text" size="16" class="form-control" name="ans5[]" value="<?php echo $row->ans5 ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p class="next_pa">How would you describe his/her management style? (handling of multiple responsibilities/stress)</p>
                                                            </td>
                                                            <td>
                                                                <input type="text" size="16" class="form-control" name="ans6[]" value="<?php echo $row->ans6 ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p class="next_pa">How would you rate his/her communication skills?</p>
                                                            </td>
                                                            <td>
                                                                <input type="text" size="16" class="form-control" name="ans7[]" value="<?php echo $row->ans7 ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p class="no-margin"><span class="number">3.</span>Interpersonal skills</p>
                                                                <p class="next_pa">How would you describe her performance when working with others/ a team?</p>
                                                            </td>
                                                            <td>
                                                                <input type="text" size="16" class="form-control" name="ans8[]" value="<?php echo $row->ans8 ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p class="no-margin"><span class="number">4.</span>Strengths/Technical Knowledge</p>
                                                                <p class="next_pa">Would there be any specific technical/product knowledge or skills, you think, that he/she can contribute to his/her prospective employer?</p>
                                                            </td>
                                                            <td>
                                                                <input type="text" size="16" class="form-control" name="ans9[]" value="<?php echo $row->ans9 ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p class="no-margin"><span class="number">5.</span>Weaknesses/Candidate’s Potentials</p>
                                                                <p class="next_pa">Could you identify any areas of development that the prospective employer should look into?</p>
                                                            </td>
                                                            <td>
                                                                <input type="text" size="16" class="form-control" name="ans10[]" value="<?php echo $row->ans10 ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p class="no-margin"><span class="number">6.</span>Integrity</p>
                                                                <p class="next_pa">Would you be aware of any issues/controversy that he/she has been involved with? Can you provide details?</p>
                                                            </td>
                                                            <td>
                                                                <input type="text" size="16" class="form-control" name="ans11[]" value="<?php echo $row->ans11 ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p class="next_pa">Can you describe his/her way of handling sensitive/confidential information/materials?</p>
                                                            </td>
                                                            <td>
                                                                <input type="text" size="16" class="form-control" name="ans12[]" value="<?php echo $row->ans12 ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p class="no-margin"><span class="number">7.</span>If applicable</p>
                                                                <p class="next_pa">What would you consider as his/her biggest contribution to the company?</p>
                                                            </td>
                                                            <td>
                                                                <input type="text" size="16" class="form-control" name="ans13[]" value="<?php echo $row->ans13 ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p class="next_pa">Would you know the reason why he/she left your company?</p>
                                                            </td>
                                                            <td>
                                                                <input type="text" size="16" class="form-control" name="ans14[]" value="<?php echo $row->ans14 ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p class="next_pa">If given the opportunity, would you consider re-hiring him/her? Why?</p>
                                                            </td>
                                                            <td>
                                                                <input type="text" size="16" class="form-control" name="ans15[]" value="<?php echo $row->ans15 ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p class="next_pa">Is there anything else you would like to add to help us further evaluate his/her application?</p>
                                                            </td>
                                                            <td>
                                                                <input type="text" size="16" class="form-control" name="ans16[]" value="<?php echo $row->ans16 ?>">
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
    <button type="button" data-dismiss="modal" class="btn btn-default btn-sm" onclick="print_bi(<?php echo $process_id?>)"><?=lang('common.print_only')?></button>
    <button type="button" data-loading-text="Loading..." onclick="save_bi()" class="demo-loading-btn btn btn-success btn-sm"><?=lang('common.save')?></button>
    <button type="button" onclick="move_to_final_interview(<?php echo $process_id?>)" class="demo-loading-btn btn btn-success btn-sm"><?=lang('applicant_monitoring.move_to_final_interview')?></button>
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