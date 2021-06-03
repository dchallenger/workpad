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

        <p align="center">TRAINING REQUEST FORM</p><br>

		<table align='center' cellpadding="2px" cellspacing="0" style='width: 100%; height: auto; background: #fff'>
			<tbody>
				<tr>
					<td align="left" style="<?php echo $blt ?>;width:50%">Requested By</td>
					<td style="<?php echo $bltr ?>;width:50%"><?php echo $record['requested_by'] ?></td>
				</tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Training Type</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['training_type'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Date of Program (From)</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['date_from'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Date of Program (To)</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['date_to'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Training Course</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['training_course'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Training Provider</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['training_provider'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Venue</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['venue'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Total Training Hours</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['total_training_hour'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Estimate Investment (Subject for revision by HR)</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['subject_revision'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Areas for Development</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['areas_development'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">Competency</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['competency'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $blt ?>;width:50%">NOTE: (If Training will exceed in 1 Month)</td>
                    <td style="<?php echo $bltr ?>;width:50%"><?php echo $record['training_application_note'] ?></td>
                </tr>
                <tr>
                    <td align="left" style="<?php echo $bltb ?>;width:50%">Remarks</td>
                    <td style="<?php echo $bltrb ?>;width:50%"><?php echo $record['remarks'] ?></td>
                </tr>                
			</tbody>
		</table>
    </body>
<!-- BEGIN BODY -->
</html>
