<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<?php
    $bl = "border-left: 1px solid #000";
    $br = "border-right: 1px solid #000";
    $bt = "border-top: 1px solid #000";
    $bb = "border-bottom: 1px solid #000";
    $blt = "border-left: 1px solid #000;border-top: 1px solid #000";
    $bltb = "border-left: 1px solid #000;border-top: 1px solid #000;border-bottom: 1px solid #000";
    $bltr = "border-left: 1px solid #000;border-top: 1px solid #000;border-right: 1px solid #000";
    $bltrb = "border-left: 1px solid #000;border-top: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000";
?>
<html lang="en">
    <!-- BEGIN HEAD-->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title></title>
        <style>
            body, p
            {
                font-weight: normal;
                font-size: 10px;
            }
        </style>
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body bgcolor="#ffffff" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" style="-webkit-font-smoothing: antialiased; width: 100% !important; -webkit-text-size-adjust: none;">
        <p align="center"><img src="<?php echo $logo ?>"></p><br>

        <p align="center">PERFORMANCE APPRAISAL FORM</p><br>

		<table align='center' cellpadding="2px" cellspacing="0" style='width: 100%; height: auto; background: #fff'>
			<tbody>
				<tr>
					<td align="left" style="<?php echo $blt ?>;width:20%">Appraisee</td>
					<td style="<?php echo $blt ?>;width:30%"><?php echo $appraisee->fullname ?></td>
					<td align="left" style="<?php echo $blt ?>;width:20%">Planning Period</td>
					<td style="<?php echo $bltr ?>;width:30%"><?php echo general_short_date( $record['date_from'] ) ?> to <?php echo general_short_date ( $record['date_to'] ) ?></td>							
				</tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>">Rank</td>
                    <td style="<?php echo $blt ?>"><?php echo $appraisee->v_job_grade ?></td>
                    <td align="left" style="<?php echo $blt ?>">Planning Date</td>
                    <td style="<?php echo $bltr ?>"><?php echo general_short_date( $appraisee->created_on )?></td>                         
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>">Job Title</td>
                    <td style="<?php echo $blt ?>"><?php echo $appraisee->position ?></td>
                    <td align="left" style="<?php echo $blt ?>">Appraisal Date</td>
                    <td style="<?php echo $bltr ?>"><?php echo general_short_date( $appraisee->created_on )?></td>                         
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>">Reports To</td>
                    <td style="<?php echo $blt ?>"><?php echo $appraisee->v_reports_to ?></td>
                    <td align="left" style="<?php echo $blt ?>">Tenure</td>
                    <td style="<?php echo $bltr ?>"><?php echo $tenure ?></td>                         
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>">Department</td>
                    <td style="<?php echo $blt ?>"><?php echo $appraisee->v_department ?></td>
                    <td align="left" style="<?php echo $blt ?>">Department Head</td>
                    <td style="<?php echo $bltr ?>"><?php echo $appraisee->dept_head ?></td>                         
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>">Division</td>
                    <td style="<?php echo $blt ?>"><?php echo $appraisee->v_division ?></td>
                    <td align="left" style="<?php echo $blt ?>">Division Head</td>
                    <td style="<?php echo $bltr ?>"><?php echo $appraisee->div_head ?></td>                         
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>">Company</td>
                    <td style="<?php echo $blt ?>"><?php echo $appraisee->company ?></td>
                    <td align="left" style="<?php echo $blt ?>">Level</td>
                    <td style="<?php echo $bltr ?>"><?php echo $appraisee->employment_type ?></td>                         
                </tr>
                <tr>
                    <td align="left" style="<?php echo $bltb ?>">Coach Rating</td>
                    <td style="<?php echo $bltb ?>"><?php echo $appraisee->coach_rating ?></td>
                    <td align="left" style="<?php echo $bltb ?>">Committee Rating</td>
                    <td style="<?php echo $bltrb ?>"><?php echo $appraisee->committee_rating ?></td>                         
                </tr>
			</tbody>
		</table>
        <br>
        <table align='center' cellpadding="2px" cellspacing="0" style='width: 100%; height: auto; background: #fff'>
            <tbody>
                <tr>
                    <td colspan="4" style="<?php echo $bltr ?>"><b>Rating Scale<b></td>
                </tr>
                <tr>
                    <td width="20%" style="<?php echo $blt ?>">Qualitative Rating</td>
                    <td width="20%" style="<?php echo $blt ?>">Quantitative Rating</td>
                    <td width="20%" style="<?php echo $blt ?>">Total Weighted Score</td>
                    <td width="40%" style="<?php echo $bltr ?>">Criteria / Standard</td>
                </tr>
                <tr>
                    <td style="<?php echo $blt ?>">Requires Improvement</td>
                    <td style="<?php echo $blt ?>"><center>2.00</center></td>
                    <td style="<?php echo $blt ?>"><center>65-79</center></td>
                    <td style="<?php echo $bltr ?>">Some critical performance objectives are not met or falls below the minimum standards; Needs to show improvement over the next cycle to demonstrate that he/she can be an effective contributor to the firm.</td>
                </tr>
                <tr>
                    <td style="<?php echo $blt ?>">Effective Contributor</td>
                    <td style="<?php echo $blt ?>"><center>3.00</center></td>
                    <td style="<?php echo $blt ?>"><center>80-94</center></td>
                    <td style="<?php echo $bltr ?>">Performance is consistent and satisfactory, meeting the most important objectives; Solid Contributor.</td>
                </tr>
                <tr>
                    <td style="<?php echo $blt ?>">Strong Contributor</td>
                    <td style="<?php echo $blt ?>"><center>4.00</center></td>
                    <td style="<?php echo $blt ?>"><center>95-109</center></td>
                    <td style="<?php echo $bltr ?>">Performance meets all and exceeds some of the objectives; Strong potential to broaden current capabilities and scope.</td>
                </tr>
                <tr>
                    <td style="<?php echo $bltb ?>">Exceptional Contributor</td>
                    <td style="<?php echo $bltb ?>"><center>5.00</center></td>
                    <td style="<?php echo $bltb ?>"><center>110-150</center></td>
                    <td style="<?php echo $bltrb ?>">Performance consistently exceeds all of the objectives; Shows strong potential for career advancement and greater contribution.</td>
                </tr>                                
            </tbody>
        </table>

        <!-- BEGIN OF FORM-->
        <div class="portlet"><?php
            //get the template
            $sections = $template->build_sections( $appraisee->template_id );
            foreach( $sections as $section ):?>
                    <br>
                    <div><b><?php echo $section->template_section ?> <?php echo ($section->weight > 0 ? '(' + $section->weight + ')' : '') ?></b></div><br>
                    <div class="portlet-body">
                        <div class="clearfix"> <?php
                            foreach( $section->children as $child ):
                                $section_id = $child->template_section_id;
                                $appraisee_user_id = $appraisee->user_id;
                                $library_id = $child->library_id;

                                $qry = "select a.*, b.uitype
                                FROM {$db->dbprefix}performance_template_section_column a
                                LEFT JOIN {$db->dbprefix}performance_template_section_column_uitype b on b.uitype_id = a.uitype_id
                                WHERE a.deleted = 0 AND a.template_section_id = {$section_id}
                                ORDER BY a.sequence";
                                $columns = $db->query( $qry );

                                $qry1 = "select *
                                FROM {$db->dbprefix}performance_setup_library_value
                                WHERE deleted = 0 AND library_id = {$library_id}";
                                $competencies_columns = $db->query( $qry1 );

                                $no_approver = 0;
                                if($list_approver && $list_approver->num_rows() > 0)
                                    $no_approver = 1;

                                switch( $child->section_type_id )
                                {
                                    case 2: //balance Scorecard ?>
                                        <table align='center' cellpadding="2px" cellspacing="0" style='width: 100%; height: auto; background: #fff'>
                                            <thead>
                                                <tr>
                                                    <th colspan="12" align="left" style="<?php echo $bltr ?>"><?php echo $child->template_section ?> (<?php echo $child->weight ?>%)</th>
                                                </tr>
                                                <tr>
                                                    <?php foreach($columns->result_array() as $key => $val) { ?>
                                                        <th width="" class="bold" align="left" style="<?php echo $blt ?>">
                                                            <span><?php echo $val['title'] ?></span>
                                                        </th>
                                                    <?php } ?>
                                                    <th class="bold" style="<?php echo $blt ?>">Self Rating</th>
                                                    <th class="bold" style="<?php echo $blt ?>">% Achieved</th>
                                                    <th class="bold" style="<?php echo ($no_approver ? $blt : $bltr) ?>">% Weight Average</th>
                                                    <?php if(!$self_rating && $list_approver && $list_approver->num_rows() > 0) {?>
                                                        <?php foreach($list_approver->result() as $row) { ?>
                                                            <th class="bold" style="<?php echo $blt ?>">Coach Rating</th>
                                                            <th class="bold" style="<?php echo $blt ?>">% Achieved</th>
                                                            <th class="bold" style="<?php echo $bltr ?>">% Weight Average</th>                  
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <?php if($self_rating && $performance_status_id == 4) { ?>
                                                            <?php foreach($list_approver->result() as $row) { ?>
                                                                <th class="bold" style="<?php echo $blt ?>">Coach Rating</th>
                                                                <th class="bold" style="<?php echo $blt ?>">% Achieved</th>
                                                                <th class="bold" style="<?php echo $bltr ?>">% Weight Average</th>                  
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(isset($balance_score_card) && $balance_score_card->num_rows() > 0) { ?>
                                                    <?php $key_weight_arr = array(); ?>
                                                    <?php foreach($balance_score_card->result_array() as $key => $val) { ?>
                                                        <?php 
                                                            $end_of_line_bot = 0;
                                                            if (end(array_keys($balance_score_card->result_array())) == $key)
                                                                $end_of_line_bot = 1;
                                                        ?>
                                                        <tr>
                                                            <td style="<?php echo ($end_of_line_bot ? $bltb : $blt) ?>">
                                                                <?php echo $key+1 . ". " . $val['scorecard'] ?>&nbsp;
                                                            </td>
                                                            <?php
                                                                if (isset($template_section_column) && !empty($template_section_column))
                                                                {
                                                                    foreach ($template_section_column[$section_id] as $key => $value) {
                                                                        $planning_value = '';
                                                                        if (isset($planning_applicable_fields[$val['scorecard_id']][1][$value->section_column_id])) {
                                                                            $planning_value = $planning_applicable_fields[$val['scorecard_id']][1][$value->section_column_id]['value'];

                                                                            if ($planning_applicable_fields[$val['scorecard_id']][1][$value->section_column_id]['class'] == 'key_weight')
                                                                                $key_weight_arr[$val['scorecard_id']] = $planning_value;
                                                                        }

                                                                        $end_of_line = 0;
                                                                        if (end(array_keys($template_section_column[$section_id])) == $key)
                                                                            $end_of_line = 1;

                                                                        $bl_tmp = $blt;
                                                                        if ($end_of_line_bot && !$end_of_line)
                                                                            $bl_tmp = $bltb;
                                                                        else if ($end_of_line_bot && $end_of_line)
                                                                            $bl_tmp = $bltb;
                                                                        else if (!$end_of_line_bot && $end_of_line)
                                                                            $bl_tmp = $blt;    

                                                                        switch( $value->uitype_id ) {
                                                                            case 2:
                                                            ?>
                                                                                <td width="" style="<?php echo $bl_tmp ?>">
                                                                                    <?php echo $planning_value ?>
                                                                                </td>
                                                            <?php
                                                                            break;
                                                                            case 3:
                                                            ?>
                                                                                <td width="" rowspan="" style="<?php echo $bl_tmp ?>">
                                                                                    <?php echo $planning_value ?>
                                                                                </td>                                       
                                                            <?php                                           
                                                                            break;
                                                                        }
                                                                    }
                                                            ?>
                                        <!--                                Fixed the section column id for appraisal 
                                                                    100 = self rating, 101 = self achieved, 102 = self weight average
                                                                    103 = coach rating, 104 = coach achieved, 105 = coach weight average -->
                                                                    <?php
                                                                        $self_rate_val = isset($appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][100][1]) ? $appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][100][1] : '';
                                                                        $self_achieve_val = isset($appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][101][1]) ? $appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][101][1] : '';
                                                                        $self_weight_ave_val = isset($appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][102][1]) ? $appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][102][1] : '';
                                                                        $coach_rate_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][103][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][103][1] : '';
                                                                        $coach_achieve_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][104][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][104][1] : '';
                                                                        $coach_weight_ave_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][105][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][105][1] : '';                                  

                                                                        $disabled = '';
                                                                        if ($performance_status_id >= 4 || (isset($approver_approved) && $approver_approved) || $hr_appraisal_admin)
                                                                            $disabled = 'disabled';

                                                                        $blt_tmp = $blt;
                                                                        $bltr_tmp = $bltr;
                                                                        if ($end_of_line_bot) {
                                                                            $blt_tmp = $bltb;
                                                                            $bltr_tmp = $bltrb;
                                                                        }
                                                                    ?>
                                                                    <td style="<?php echo ($end_of_line_bot ? $bltb : $blt) ?>"><?php echo $self_rate_val ?></td>
                                                                    <td style="<?php echo ($end_of_line_bot ? $bltb : $blt) ?>"><?php echo $self_weight_ave_val ?></td>
                                                                    <td style="<?php echo ($no_approver ? $blt_tmp : $bltr_tmp) ?>"><?php echo $self_weight_ave_val ?></td>
                                                                    <?php if(!$self_rating && $list_approver && $list_approver->num_rows() > 0) { ?>
                                                                        <?php foreach($list_approver->result() as $row) { ?>
                                                                            <td style="<?php echo ($end_of_line_bot ? $bltb : $blt) ?>"><?php echo $coach_rate_val ?></td>
                                                                            <td style="<?php echo ($end_of_line_bot ? $bltb : $blt) ?>"><?php echo $coach_achieve_val ?></td>
                                                                            <td style="<?php echo ($end_of_line_bot ? $bltrb : $bltr) ?>"><?php echo $coach_weight_ave_val ?></td>
                                                                        <?php } ?>
                                                                    <?php } else { ?>
                                                                        <?php if($self_rating && $performance_status_id == 4) { ?>
                                                                            <?php foreach($list_approver->result() as $row) { ?>
                                                                                <td style="<?php echo ($end_of_line_bot ? $bltb : $blt) ?>"><?php echo $coach_rate_val ?></td>
                                                                                <td style="<?php echo ($end_of_line_bot ? $bltb : $blt) ?>"><?php echo $coach_achieve_val ?></td>
                                                                                <td style="<?php echo ($end_of_line_bot ? $bltrb : $bltr) ?>"><?php echo $coach_weight_ave_val ?></td>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                            <?php
                                                                }
                                                            ?>
                                                        </tr>
                                                        <?php foreach($planning_applicable_fields[$val['scorecard_id']] as $key1 => $val1) { ?>
                                                            <?php if($key1 > 1) { ?>
                                                                <tr>
                                                                    <td style="<?php echo $blt ?>">&nbsp;</td>
                                                                    <?php
                                                                        if (isset($template_section_column) && !empty($template_section_column))
                                                                        {
                                                                            foreach ($template_section_column[$section_id] as $key => $value) {
                                                                                $planning_value = '';
                                                                                $can_add_row = 0;
                                                                                $column_sequence = 0;

                                                                                if (isset($planning_applicable_fields[$val['scorecard_id']][$key1][$value->section_column_id])) {
                                                                                    $planning_value = $planning_applicable_fields[$val['scorecard_id']][$key1][$value->section_column_id]['value'];
                                                                                    $can_add_row = $planning_applicable_fields[$val['scorecard_id']][$key1][$value->section_column_id]['can_add_row'];
                                                                                    $column_sequence = $planning_applicable_fields[$val['scorecard_id']][$key1][$value->section_column_id]['column_sequence'];
                                                                                }

                                                                                switch( $value->uitype_id ) {
                                                                                    case 2:
                                                                                        if ($can_add_row) {
                                                                    ?>
                                                                                            <td width="" style="<?php echo ($end_of_line ? $bltb : $blt) ?>">
                                                                                                <?php echo $planning_value ?>
                                                                                            </td>
                                                                    <?php
                                                                                        } else {
                                                                    ?>
                                                                                            <td width="" style="<?php echo ($end_of_line ? $bltb : $blt) ?>;vertical-align:middle;text-align:center">
                                                                                                &nbsp;
                                                                                            </td>
                                                                    <?php                                                           
                                                                                        }
                                                                                    break;
                                                                                    case 3:
                                                                                        if ($can_add_row) {
                                                                    ?>
                                                                                            <td width="" rowspan="" style="<?php echo ($end_of_line ? $bltb : $blt) ?>">
                                                                                                <?php echo $planning_value ?>
                                                                                            </td>                                       
                                                                    <?php                   
                                                                                        } else {
                                                                    ?>
                                                                                            <td style="<?php echo ($end_of_line ? $bltb : $blt) ?>">
                                                                                                &nbsp;
                                                                                            </td>               
                                                                    <?php                                                                                               
                                                                                        }                       
                                                                                    break;
                                                                                }
                                                                            }
                                                                    ?>
                                            <!--                                Fixed the section column id for appraisal 
                                                                            100 = self rating, 101 = self achieved, 102 = self weight average
                                                                            103 = coach rating, 104 = coach achieved, 105 = coach weight average -->                                
                                                                            <?php
                                                                                $self_rate_val = isset($appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][100][1]) ? $appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][100][$key1] : '';
                                                                                $self_achieve_val = isset($appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][101][1]) ? $appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][101][$key1] : '';
                                                                                $self_weight_ave_val = isset($appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][102][1]) ? $appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][102][$key1] : '';
                                                                                $coach_rate_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][103][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][103][$key1] : '';
                                                                                $coach_achieve_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][104][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][104][$key1] : '';
                                                                                $coach_weight_ave_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][105][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][105][$key1] : '';                                  

                                                                                $disabled = '';
                                                                                if ($performance_status_id >= 4 || (isset($approver_approved) && $approver_approved) || $hr_appraisal_admin)
                                                                                    $disabled = 'disabled';                                         
                                                                            ?>  
                                                                            <td style="<?php echo ($end_of_line ? $bltb : $blt) ?>"><?php echo $self_rate_val ?></td>
                                                                            <td style="<?php echo ($end_of_line ? $bltb : $blt) ?>"><?php echo $self_achieve_val ?></td>
                                                                            <td style="<?php echo ($no_approver ? $blt : $bltr) ?>"><?php echo $self_weight_ave_val ?></td>
                                                                            <?php if(!$self_rating && $list_approver && $list_approver->num_rows() > 0) { ?>
                                                                                <?php foreach($list_approver->result() as $row) { ?>
                                                                                    <td style="<?php echo $blt ?>"><?php echo $coach_rate_val ?></td>
                                                                                    <td style="<?php echo $blt ?>"><?php echo $coach_achieve_val ?></td>
                                                                                    <td style="<?php echo $bltr ?>"><?php echo $coach_weight_ave_val ?></td>
                                                                                <?php } ?>
                                                                            <?php } else { ?>
                                                                                <?php if($self_rating && $performance_status_id == 4) { ?>
                                                                                    <?php foreach($list_approver->result() as $row) { ?>
                                                                                        <td style="<?php echo $blt ?>"><?php echo $coach_rate_val ?></td>
                                                                                        <td style="<?php echo $blt ?>"><?php echo $coach_achieve_val ?></td>
                                                                                        <td style="<?php echo $bltr ?>"><?php echo $coach_weight_ave_val ?></td>
                                                                                    <?php } ?>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                    <?php                                       
                                                                        }
                                                                    ?>
                                                                </tr>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>                                            
                                        <?php 
                                        break;
                                    case 3: //core competencies?>
                                        <?php
                                            $colspan = $columns->num_rows() + ($list_approver->num_rows() * 2);
                                        ?>
                                        <br>
                                        <table align='center' cellpadding="2px" cellspacing="0" style='width: 100%; height: auto; background: #fff'>
                                            <thead>
                                                <tr>
                                                    <th colspan="<?php echo $colspan ?>" align="left" style="<?php echo $bltr ?>"><?php echo $child->template_section ?> (<?php echo $child->weight ?>%)</th>
                                                </tr>
                                                <tr>
                                                    <?php foreach($columns->result_array() as $key => $val) { ?>  
                                                        <?php 
                                                            $end_of_line = 0;
                                                            if (end(array_keys($columns->result_array())) == $key)
                                                                $end_of_line = 1;
                                                        ?>                                                                                                         
                                                        <th width="" class="bold" align="left" style="<?php echo ($no_approver ? $blt : ($end_of_line ? $bltr : $blt)) ?>">
                                                            <span><?php echo $val['title'] ?></span>
                                                        </th>
                                                    <?php } ?>
                                                    <?php if(!$self_rating && $list_approver && $list_approver->num_rows() > 0) {?>
                                                        <?php foreach($list_approver->result() as $row) { ?>
                                                            <th class="bold" style="<?php echo $blt ?>">Coach Rating</th>
                                                            <th class="bold" style="<?php echo $bltr ?>">Coach Comment</th>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <?php if($self_rating && $performance_status_id == 4) { ?>
                                                            <?php foreach($list_approver->result() as $row) { ?>
                                                                <th class="bold" style="<?php echo $blt ?>">Coach Rating</th>
                                                                <th class="bold" style="<?php echo $bltr ?>">Coach Comment</th>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(isset($competencies_columns) && $competencies_columns->num_rows() > 0) { ?>
                                                    <?php foreach($competencies_columns->result_array() as $key => $val) { ?>                                                  
                                                        <?php 
                                                            $end_of_line_bot = 0;
                                                            if (end(array_keys($competencies_columns->result_array())) == $key)
                                                                $end_of_line_bot = 1;
                                                        ?>
                                                        <tr>
                                                            <td style="<?php echo ($end_of_line_bot ? $bltb : $blt) ?>" width="60%">
                                                                <?php echo $key+1 . ". " . $val['library_value'] ?>&nbsp;
                                                                <br>
                                                                <?php echo $val['library_value_description'] ?>
                                                            </td>
                                                            <?php
                                                                if (isset($template_section_column) && !empty($template_section_column))
                                                                {
                                                                    foreach ($template_section_column[$section_id] as $key => $value) {
                                                                        $planning_value = '';
                                                                        if (isset($planning_applicable_fields[$val['library_value_id']][1][$value->section_column_id])) {
                                                                            $planning_value = $planning_applicable_fields[$val['library_value_id']][1][$value->section_column_id]['value'];
                                                                        }

                                                                        $self_rate_val = isset($appraisal_applicable_fields[$appraisee_user_id][$section_id][$library_id][$val['library_value_id']][1]) ? $appraisal_applicable_fields[$appraisee_user_id][$section_id][$library_id][$val['library_value_id']][1] : '';
                                                                        $self_comment_val = isset($appraisal_applicable_fields[$appraisee_user_id][$section_id][$library_id][$val['library_value_id']][2]) ? $appraisal_applicable_fields[$appraisee_user_id][$section_id][$library_id][$val['library_value_id']][2] : '';

                                                                        $end_of_line = 0;
                                                                        if (end(array_keys($template_section_column[$section_id])) == $key)
                                                                            $end_of_line = 1;

                                                                        $bl_tmp = $blt;
                                                                        if ($end_of_line_bot && !$end_of_line)
                                                                            $bl_tmp = $bltb;
                                                                        else if ($end_of_line_bot && $end_of_line)
                                                                            $bl_tmp = $bltb;
                                                                        else if (!$end_of_line_bot && $end_of_line)
                                                                            $bl_tmp = $blt;                                                                        

                                                                        switch( $value->uitype_id ) {
                                                                            case 2:
                                                            ?>
                                                                                <td width="" style="<?php echo $bl_tmp ?>">
                                                                                    <?php echo $self_comment_val ?>
                                                                                </td>
                                                            <?php
                                                                            break;
                                                                            case 3:
                                                            ?>
                                                                                <td width="" rowspan="" style="<?php echo $bl_tmp ?>">
                                                                                    <?php echo $self_comment_val ?>
                                                                                </td>                                       
                                                            <?php                                           
                                                                            break;
                                                                            case 9:
                                                            ?>
                                                                                <td width="" rowspan="" style="<?php echo $bl_tmp ?>">
                                                                                    <?php echo $self_rate_val ?>
                                                                                </td> 
                                                            <?php                                                            
                                                                        }
                                                                    }
                                                            ?>
                                                                    <?php if(!$self_rating && $list_approver && $list_approver->num_rows() > 0) { ?>
                                                                        <?php foreach($list_approver->result() as $row) { ?>
                                                                            <?php foreach ($template_section_column[$section_id] as $key => $value) {
                                                                                $planning_value = '';
                                                                                if (isset($planning_applicable_fields[$val['library_value_id']][1][$value->section_column_id])) {
                                                                                    $planning_value = $planning_applicable_fields[$val['library_value_id']][1][$value->section_column_id]['value'];
                                                                                }

                                                                                $coach_rate_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$library_id][$val['library_value_id']][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$library_id][$val['library_value_id']][1] : '';
                                                                                $coach_comment_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$library_id][$val['library_value_id']][2]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$library_id][$val['library_value_id']][2] : '';

                                                                                $end_of_line = 0;
                                                                                if (end(array_keys($template_section_column[$section_id])) == $key)
                                                                                    $end_of_line = 1;

                                                                                $bl_tmp = $blt;
                                                                                if ($end_of_line_bot && !$end_of_line)
                                                                                    $bl_tmp = $bltb;
                                                                                else if ($end_of_line_bot && $end_of_line)
                                                                                    $bl_tmp = $bltrb;
                                                                                else if (!$end_of_line_bot && $end_of_line)
                                                                                    $bl_tmp = $bltr;  

                                                                                switch( $value->uitype_id ) {
                                                                                    case 2:
                                                            ?>
                                                                                        <td width="" style="<?php echo $bl_tmp ?>">
                                                                                            <?php echo $coach_comment_val ?>
                                                                                        </td>
                                                            <?php
                                                                                    break;
                                                                                    case 3:
                                                            ?>
                                                                                        <td width="" rowspan="" style="<?php echo $bl_tmp ?>">
                                                                                            <?php echo $coach_comment_val ?>
                                                                                        </td>                                       
                                                            <?php                                           
                                                                                    break;
                                                                                    case 9:
                                                            ?>
                                                                                        <td width="" rowspan="" style="<?php echo $bl_tmp ?>">
                                                                                            <?php echo $coach_rate_val ?>
                                                                                        </td>
                                                            <?php
                                                                                    break;
                                                                                }
                                                                            }
                                                            ?>
                                                                        <?php } ?>
                                                                    <?php } else { ?>
                                                                        <?php if($self_rating && $performance_status_id == 4) { ?>
                                                                            <?php foreach($list_approver->result() as $row) { ?>
                                                                                <?php foreach ($template_section_column[$section_id] as $key => $value) {
                                                                                    $planning_value = '';
                                                                                    if (isset($planning_applicable_fields[$val['library_value_id']][1][$value->section_column_id])) {
                                                                                        $planning_value = $planning_applicable_fields[$val['library_value_id']][1][$value->section_column_id]['value'];
                                                                                    }

                                                                                    $coach_rate_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$library_id][$val['library_value_id']][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$library_id][$val['library_value_id']][1] : '';
                                                                                    $coach_comment_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$library_id][$val['library_value_id']][2]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$library_id][$val['library_value_id']][2] : '';

                                                                                    $end_of_line = 0;
                                                                                    if (end(array_keys($template_section_column[$section_id])) == $key)
                                                                                        $end_of_line = 1;

                                                                                    $bl_tmp = $blt;
                                                                                    if ($end_of_line_bot && !$end_of_line)
                                                                                        $bl_tmp = $bltb;
                                                                                    else if ($end_of_line_bot && $end_of_line)
                                                                                        $bl_tmp = $bltrb;
                                                                                    else if (!$end_of_line_bot && $end_of_line)
                                                                                        $bl_tmp = $bltr; 

                                                                                    switch( $value->uitype_id ) {
                                                                                        case 2:
                                                                ?>
                                                                                            <td width="" style="<?php echo $bl_tmp ?>">
                                                                                                <?php echo $coach_comment_val ?>
                                                                                            </td>
                                                                <?php
                                                                                        break;
                                                                                        case 3:
                                                                ?>
                                                                                            <td width="" rowspan="" style="<?php echo $bl_tmp ?>">
                                                                                                <?php echo $coach_comment_val ?>
                                                                                            </td> 
                                                                <?php                                           
                                                                                        break;
                                                                                        case 9:
                                                                ?>
                                                                                            <td width="" rowspan="" style="<?php echo $bl_tmp ?>">
                                                                                                <?php echo $coach_rate_val ?>
                                                                                            </td>                                                                                
                                                                <?php
                                                                                        break;
                                                                                    }
                                                                                }
                                                                ?>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                            <?php } ?>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>                                            
                                        <?php 
                                        break;
                                        case 9: //IDP?>
                                            <br>
                                            <table align='center' cellpadding="2px" cellspacing="0" style='width: 100%; height: auto; background: #fff'>
                                                <thead>
                                                    <tr>
                                                        <th colspan="5" align="left" style="<?php echo $bltr ?>"><?php echo $child->template_section ?> (<?php echo $child->weight ?>%)</th>
                                                    </tr>
                                                    <tr>
                                                        <?php foreach($columns->result_array() as $key => $val) { ?>  
                                                            <?php 
                                                                $end_of_line = 0;
                                                                if (end(array_keys($columns->result_array())) == $key)
                                                                    $end_of_line = 1;
                                                            ?>                                                                                                         
                                                            <th width="" class="bold" align="left" style="<?php echo ($end_of_line ? $bltr : $blt) ?>">
                                                                <span><?php echo $val['title'] ?></span>
                                                            </th>
                                                        <?php } ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($planning_applicable_fields[0])) { ?>
                                                        <?php foreach($planning_applicable_fields[0] as $key1 => $val1) { ?>
                                                            <?php 
                                                                $end_of_line_bot = 0;
                                                                if (end(array_keys($planning_applicable_fields[0])) == $key1)
                                                                    $end_of_line_bot = 1;
                                                            ?>                                                        
                                                            <tr class="">
                                                                <?php
                                                                    if (isset($template_section_column) && !empty($template_section_column))
                                                                    {
                                                                        foreach ($template_section_column[$section_id] as $key => $value) {
                                                                            
                                                                            $planning_value = isset($planning_applicable_fields[0][$key1][$value->section_column_id]['value']) ? $planning_applicable_fields[0][$key1][$value->section_column_id]['value'] : "";

                                                                            $end_of_line = 0;
                                                                            if (end(array_keys($template_section_column[$section_id])) == $key)
                                                                                $end_of_line = 1;

                                                                            $bl_tmp = $blt;
                                                                            if ($end_of_line_bot && !$end_of_line)
                                                                                $bl_tmp = $bltb;
                                                                            else if ($end_of_line_bot && $end_of_line)
                                                                                $bl_tmp = $bltrb;
                                                                            else if (!$end_of_line_bot && $end_of_line)
                                                                                $bl_tmp = $bltr; 

                                                                            switch( $value->uitype_id ) {
                                                                                case 12:
                                                                ?>
                                                                                    <td style="<?php echo $bl_tmp ?>" width="20%">
                                                                                        <?php if($areas_development && $areas_development->num_rows() > 0) { ?>
                                                                                            <?php foreach($areas_development->result() as $row) { ?>
                                                                                                <?php
                                                                                                    if($planning_value == $row->appraisal_areas_development_id)
                                                                                                        echo $row->appraisal_areas_development
                                                                                                ?>
                                                                                            <?php } ?>
                                                                                        <?php } ?>
                                                                                    </td>   
                                                                <?php
                                                                                break;
                                                                                case 13:
                                                                ?>
                                                                                    <td style="<?php echo $bl_tmp ?>" width="20%">
                                                                                        <?php if($learning_mode && $learning_mode->num_rows() > 0) { ?>
                                                                                            <?php foreach($learning_mode->result() as $row) { ?>
                                                                                                <?php
                                                                                                    if($planning_value == $row->learning_mode_id)
                                                                                                        echo $row->learning_mode
                                                                                                ?>
                                                                                            <?php } ?>
                                                                                        <?php } ?>
                                                                                    </td>                                       
                                                                <?php                                           
                                                                                break;
                                                                                case 14:
                                                                ?>
                                                                                    <td style="<?php echo $bl_tmp ?>" width="20%">
                                                                                        <?php if($competencies && $competencies->num_rows() > 0) { ?>
                                                                                            <?php foreach($competencies->result() as $row) { ?>
                                                                                                <?php
                                                                                                    if($planning_value == $row->category_id)
                                                                                                        echo $row->category
                                                                                                ?>
                                                                                            <?php } ?>
                                                                                        <?php } ?>
                                                                                    </td>                                                                                   
                                                                <?php
                                                                                break;
                                                                                case 15:
                                                                ?>
                                                                                    <td style="<?php echo $bl_tmp ?>" width="20%">
                                                                                        <?php if($target_completion && $target_completion->num_rows() > 0) { ?>
                                                                                            <?php foreach($target_completion->result() as $row) { ?>
                                                                                                <?php
                                                                                                    if($planning_value == $row->target_completion_id)
                                                                                                        echo $row->target_completion
                                                                                                ?>
                                                                                            <?php } ?>
                                                                                        <?php } ?>
                                                                                    </td>
                                                                <?php
                                                                                break;
                                                                                case 3:
                                                                ?>
                                                                                    <td style="<?php echo $bl_tmp ?>" width="20%">
                                                                                        <?php echo $planning_value ?>
                                                                                    </td>                                       
                                                                <?php                                           
                                                                                break;                              
                                                                            }
                                                                        }
                                                                    }
                                                                ?>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </tbody>
                                            </table>                                            
                                            <?php 
                                            break;                                          
                                    default:
                                }
                            endforeach; ?>                    
                        </div>
                    </div><?php
            endforeach; ?>
        </div>
        <br>
        <table align='center' cellpadding="2px" cellspacing="0" style='width: 100%; height: auto; background: #fff'>
            <thead>
                <tr>
                    <th colspan="9" align="left" style="<?php echo $bltr ?>">OVERALL RATING</th>
                </tr>
                <tr>
                    <th style="<?php echo $blt ?>">GENERAL CRITERIA</th>
                    <th style="<?php echo $blt ?>">KEY IN WEIGHT (%)</th>
                    <th style="<?php echo $blt ?>">SELF RATING</th>
                    <th style="<?php echo $blt ?>">COACH'S RATING</th>
                    <th style="<?php echo $blt ?>">TOTAL WEIGHTED / AVERAGE</th>
                    <th style="<?php echo $blt ?>">COACH'S SECTION RATING</th>
                    <th style="<?php echo $blt ?>">WEIGH IN (%)</th>
                    <th style="<?php echo $blt ?>">TOTAL WEIGHTED SCORE</th>
                    <th style="<?php echo $bltr ?>">COACH'S TOTAL WEIGHTED SCORE</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($template_section) && $template_section->num_rows() > 0) { ?>
                    <?php foreach($template_section->result_array() as $key1 => $val1) { ?>
                        <?php if($val1['parent_id'] > 0 &&  $val1['section_type_id'] != 9) { ?>
                            <?php
                                $total_weighted_average = (isset($appraisal_applicable_section_ratings[$val1['template_section_id']]) ? $appraisal_applicable_section_ratings[$val1['template_section_id']]['total_weight_average'] : '');
                                $coach_total_weighted_average = (isset($appraisal_applicable_section_ratings[$val1['template_section_id']]) ? $appraisal_applicable_section_ratings[$val1['template_section_id']]['coach_section_rating'] : '');
                                $total_weighted_score = (isset($appraisal_applicable_section_ratings[$val1['template_section_id']]) ? $appraisal_applicable_section_ratings[$val1['template_section_id']]['total_weighted_score'] : '');
                                $coach_total_weighted_score = (isset($appraisal_applicable_section_ratings[$val1['template_section_id']]) ? $appraisal_applicable_section_ratings[$val1['template_section_id']]['coach_total_weighted_score'] : '');
                            ?>
                            <?php if($val1['is_core'] == 0) { ?>
                                <tr>
                                    <td colspan="4" class="bold" style="<?php echo $blt ?>" width="20%">
                                        <b><?php echo $val1['template_section'] ?></b>
                                    </td>
                                    <td style="<?php echo $blt ?>">
                                        <?php echo ($total_weighted_average != '' ? $total_weighted_average : '&nbsp;') ?>
                                    </td>
                                    <td style="<?php echo $blt ?>">
                                        <?php echo ($coach_total_weighted_average != '' ? $coach_total_weighted_average : '&nbsp;') ?>
                                    </td>
                                    <td style="<?php echo $blt ?>">
                                        <?php echo $val1['weight'] ?>
                                    </td>
                                    <td style="<?php echo $blt ?>">
                                        <?php echo ($total_weighted_score != '' ? $total_weighted_score : '&nbsp;') ?>
                                    </td>
                                    <td style="<?php echo $bltr ?>">
                                        <?php echo ($coach_total_weighted_score != '' ? $coach_total_weighted_score : '&nbsp;') ?>
                                    </td>
                                </tr>                                                   
                                <?php if(isset($balance_score_card) && $balance_score_card->num_rows() > 0) { ?>
                                    <?php foreach($balance_score_card->result_array() as $key => $val) { ?>
                                        <?php
                                            $none_core_score_car_library_self_rating = (isset($appraisal_applicable_score_library_ratings[$val1['template_section_id']][$val['scorecard_id']]) ? $appraisal_applicable_score_library_ratings[$val1['template_section_id']][$val['scorecard_id']]['self_rating'] : '');
                                            $none_core_score_car_library_coach_rating = (isset($appraisal_applicable_score_library_ratings[$val1['template_section_id']][$val['scorecard_id']]) ? $appraisal_applicable_score_library_ratings[$val1['template_section_id']][$val['scorecard_id']]['coach_rating'] : '');
                                        ?>                                                              
                                        <tr>
                                            <td style="<?php echo $blt ?>">
                                                <div class="padding-left-10"><?php echo $val['scorecard'] ?></div>
                                            </td>
                                            <td style="<?php echo $blt ?>"><?php echo $key_weight_arr[$val['scorecard_id']] ?></td>
                                            <td style="<?php echo $blt ?>"><?php echo $none_core_score_car_library_self_rating ?></td>
                                            <td style="<?php echo $blt ?>"><?php echo $none_core_score_car_library_coach_rating ?></td>
                                            <td style="<?php echo $blt ?>"></td>
                                            <td style="<?php echo $blt ?>"></td>
                                            <td style="<?php echo $blt ?>"></td>
                                            <td style="<?php echo $blt ?>"></td>
                                            <td style="<?php echo $bltr ?>"></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="4" class="bold" style="<?php echo $blt ?>" width="20%">
                                        <b><?php echo $val1['template_section'] ?></b>
                                    </td>
                                    <td style="<?php echo $blt ?>">
                                        <?php echo ($total_weighted_average != '' ? $total_weighted_average : '&nbsp;') ?>
                                    </td>
                                    <td style="<?php echo $blt ?>">
                                        <?php echo ($coach_total_weighted_average != '' ? $coach_total_weighted_average : '&nbsp;') ?>
                                    </td>                                                               
                                    <td style="<?php echo $blt ?>">
                                        <?php echo $val1['weight'] ?>
                                    </td>
                                    <td style="<?php echo $blt ?>">
                                        <?php echo ($total_weighted_score != '' ? $total_weighted_score : '&nbsp;') ?>
                                    </td>
                                    <td style="<?php echo $bltr ?>">
                                        <?php echo ($coach_total_weighted_score != '' ? $coach_total_weighted_score : '&nbsp;') ?>
                                    </td>
                                </tr>
                                <?php if(isset($library_competencies) && !empty($library_competencies)) { ?>
                                    <?php foreach($library_competencies[$val1['library_id']] as $key2 => $val2) { ?>
                                        <?php
                                            $core_score_car_library_self_rating = (isset($appraisal_applicable_score_library_ratings[$val1['template_section_id']][$val2->library_value_id]) ? $appraisal_applicable_score_library_ratings[$val1['template_section_id']][$val2->library_value_id]['self_rating'] : '');
                                            $core_score_car_library_coach_rating = (isset($appraisal_applicable_score_library_ratings[$val1['template_section_id']][$val2->library_value_id]) ? $appraisal_applicable_score_library_ratings[$val1['template_section_id']][$val2->library_value_id]['coach_rating'] : '');
                                        ?>                                                                                                                              
                                        <tr>
                                            <td style="<?php echo $blt ?>">
                                                <div class="padding-left-10"><?php echo ucwords(strtolower($val2->library_value)) ?></div>
                                            </td>
                                            <td style="<?php echo $blt ?>"></td>
                                            <td style="<?php echo $blt ?>"><?php echo $core_score_car_library_self_rating ?></td>
                                            <td style="<?php echo $blt ?>"><?php echo $core_score_car_library_coach_rating ?></td>
                                            <td style="<?php echo $blt ?>"></td>
                                            <td style="<?php echo $blt ?>"></td>
                                            <td style="<?php echo $blt ?>"></td>
                                            <td style="<?php echo $blt ?>"></td>
                                            <td style="<?php echo $bltr ?>"></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                    <tr>
                        <td class="bold" style="<?php echo $blt ?>"><b>Total Weighted Score</b></td>
                        <td class="total_weighted_score" style="<?php echo $blt ?>"><?php echo array_sum($key_weight_arr) ?>%</td>
                        <td style="<?php echo $blt ?>"></td>
                        <td style="<?php echo $blt ?>"></td>
                        <td style="<?php echo $blt ?>"></td>
                        <td style="<?php echo $blt ?>"></td>
                        <td style="<?php echo $blt ?>"></td>
                        <td class="bold" style="<?php echo $blt ?>"><b>Selft Rating</b></td>
                        <td class="self_rating" style="<?php echo $bltr ?>"><?php echo $appraisee->self_rating ?></td>
                    </tr>
                    <tr>
                        <td style="<?php echo $bltb ?>"></td>
                        <td style="<?php echo $bltb ?>"></td>
                        <td style="<?php echo $bltb ?>"></td>
                        <td style="<?php echo $bltb ?>"></td>
                        <td style="<?php echo $bltb ?>"></td>
                        <td style="<?php echo $bltb ?>"></td>
                        <td style="<?php echo $bltb ?>"></td>
                        <td class="bold" style="<?php echo $bltb ?>"><b>Coach Rating</b></td>
                        <td class="coach_rating" style="<?php echo $bltrb ?>"><?php echo $appraisee->coach_rating ?></td>                                                           
                    </tr>
                <?php } ?>
            </tbody>                                
        </table>
    </table>        
    </body>
<!-- BEGIN BODY -->
</html>
