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
    </body>
<!-- BEGIN BODY -->
</html>
