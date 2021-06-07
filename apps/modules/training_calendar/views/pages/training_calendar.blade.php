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

        <p align="center">TRAINING CALENDAR FORM</p><br>

		<table align='center' cellpadding="2px" cellspacing="0" style='width: 100%; height: auto; background: #fff'>
			<tbody>
                <tr>
                    <td align="left" colspan="2" style="<?php echo $bltr ?>"><b>Training Calendar Details<b></td>
                </tr>                
				<tr>
					<td align="left" style="<?php echo $blt ?>;width:50%">Training Title</td>
					<td style="<?php echo $bltr ?>;width:50%"><?php echo $record['training_title'] ?></td>
				</tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Training Course</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['course'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Training Type</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['training_type'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Training Provider</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['training_provider'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Training Category</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['category'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Minimum Trainee Capacity</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['min_capacity'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Maximum Trainee Capacity</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['max_capacity'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Venue</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['venue'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Training Course Description</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['description'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">To Be Announce</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['to_be_announced'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Equipment</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['equipment'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Registration Date</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['registration_date'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Cost Per Pax</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['cost_per_pax'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Last Registration Date</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['last_registration_date'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Publish Date</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['publish_date'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Certification</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['with_certification'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Evaluation Date</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['revalida_date'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $bltb ?>;width:50%">Planned?</td>
                    <td style="<?php echo $bltrb ?>;width:50%"><?php echo $record['with_certification'] ?></td>
                </tr>
			</tbody>
		</table>
        <br>
        <table align='center' cellpadding="2px" cellspacing="0" style='width: 100%; height: auto; background: #fff'>
            <tbody>
                <tr>
                    <td align="left" colspan="7" style="<?php echo $bltr ?>"><b>Training Session<b></td>
                </tr>
                <?php 
                    if (!empty($session_tab)) {
                ?>
                        <tr>
                            <td align="center" style="<?php echo $blt ?>;width:10%"><b>Session No.</b></td>
                            <td align="center" style="<?php echo $blt ?>;width:15%"><b>Instructor</b></td>
                            <td align="center" style="<?php echo $blt ?>;width:15%"><b>Training Date</b></td>                    
                            <td align="center" style="<?php echo $blt ?>;width:15%"><b>Session Time From</b></td>
                            <td align="center" style="<?php echo $blt ?>;width:15%"><b>Session Time To</b></td>
                            <td align="center" style="<?php echo $blt ?>;width:15%"><b>Break Time From</b></td>
                            <td align="center" style="<?php echo $bltr ?>;width:15%"><b>Break Time To</b></td>
                        </tr>
                <?php 
                        $last = 0;        
                        foreach ($session_tab as $key => $session) {
                            if ($key == end(array_keys($session_tab)))
                                $last = 1;
                ?>
                            <tr>
                                <td align="left" style="<?php echo (!$last ? $blt : $bltb) ?>;width:10%"><?php echo $session['session_no'] ?></td>
                                <td align="left" style="<?php echo (!$last ? $blt : $bltb) ?>;width:15%"><?php echo $session['instructor'] ?></td>
                                <td align="center" style="<?php echo (!$last ? $blt : $bltb) ?>;width:15%"><?php echo general_date($session['session_date']) ?></td>                    
                                <td align="center" style="<?php echo (!$last ? $blt : $bltb) ?>;width:15%"><?php echo date('h:i A',strtotime($session['sessiontime_from']));  ?></td>
                                <td align="center" style="<?php echo (!$last ? $blt : $bltb) ?>;width:15%"><?php echo date('h:i A',strtotime($session['sessiontime_to']));  ?></td>
                                <td align="center" style="<?php echo (!$last ? $blt : $bltb) ?>;width:15%"><?php echo date('h:i A',strtotime($session['breaktime_from']));  ?></td>
                                <td align="center" style="<?php echo (!$last ? $bltr : $bltrb) ?>;width:15%"><?php echo date('h:i A',strtotime($session['breaktime_to']));  ?></td>
                            </tr>                                
                <?php
                        }                

                    } 
                ?>
            </tbody>
        </table>
        <br>
        <table align='center' cellpadding="2px" cellspacing="0" style='width: 100%; height: auto; background: #fff'>
            <tbody>
                <tr>
                    <td align="left" colspan="7" style="<?php echo $bltr ?>"><b>Training Cost<b></td>
                </tr>
                <?php 
                    if (!empty($training_cost_tab)) {
                ?>
                        <tr>
                            <td align="center" style="<?php echo $blt ?>;width:20%"><b>Source</b></td>
                            <td align="center" style="<?php echo $blt ?>;width:20%"><b>Remarks</b></td>
                            <td align="center" style="<?php echo $blt ?>;width:20%"><b>Cost</b></td>                    
                            <td align="center" style="<?php echo $blt ?>;width:20%"><b>No. of Pax</b></td>
                            <td align="center" style="<?php echo $blt ?>;width:20%"><b>Total</b></td>
                        </tr>
                <?php 
                        $last = 0;        
                        foreach ($training_cost_tab as $key => $training_cost) {
                            if ($key == end(array_keys($training_cost_tab)))
                                $last = 1;
                ?>
                            <tr>
                                <td align="left" style="<?php echo (!$last ? $blt : $bltb) ?>;width:20%"><?php echo $training_cost['cost_name'] ?></td>
                                <td align="left" style="<?php echo (!$last ? $blt : $bltb) ?>;width:20%"><?php echo $training_cost['remarks'] ?></td>
                                <td align="right" style="<?php echo (!$last ? $blt : $bltb) ?>;width:20%"><?php echo $training_cost['cost'] ?></td>
                                <td align="center" style="<?php echo (!$last ? $blt : $bltb) ?>;width:20%"><?php echo $training_cost['pax'] ?></td>
                                <td align="right" style="<?php echo (!$last ? $bltr : $bltrb) ?>;width:20%"><?php echo $training_cost['total'] ?></td>
                            </tr>                                
                <?php
                        }                

                    } 
                ?>
            </tbody>
        </table>
        <br>
        <table align='center' cellpadding="2px" cellspacing="0" style='width: 100%; height: auto; background: #fff'>
            <tbody>
                <tr>
                    <td align="left" colspan="7" style="<?php echo $bltr ?>"><b>Training Participants<b></td>
                </tr>
                <?php 
                    if (!empty($participant_tab)) {
                ?>
                        <tr>
                            <td align="center" style="<?php echo $blt ?>;width:25%"><b>Employee Name</b></td>
                            <td align="center" style="<?php echo $blt ?>;width:25%"><b>Nominate</b></td>
                            <td align="center" style="<?php echo $blt ?>;width:25%"><b>Status</b></td>                    
                            <td align="center" style="<?php echo $blt ?>;width:25%"><b>Attendance</b></td>
                        </tr>
                <?php 
                        $last = 0;        
                        foreach ($participant_tab as $key => $participant) {
                            if ($key == end(array_keys($participant_tab)))
                                $last = 1;
                ?>
                            <tr>
                                <td align="left" style="<?php echo (!$last ? $blt : $bltb) ?>;width:25%"><?php echo $participant['alias'] ?></td>
                                <td align="center" style="<?php echo (!$last ? $blt : $bltb) ?>;width:25%"><?php echo ($participant['nominate'] ? 'Yes' : 'No') ?></td>
                                <td align="center" style="<?php echo (!$last ? $blt : $bltb) ?>;width:25%"><?php echo $participant['participant_status'] ?></td>
                                <td align="center" style="<?php echo (!$last ? $bltr : $bltrb) ?>;width:25%"><?php echo ($participant['no_show'] ? 'Yes' : 'No') ?></td>
                            </tr>                                
                <?php
                        }                

                    } 
                ?>
            </tbody>
        </table>        
    </body>
<!-- BEGIN BODY -->
</html>