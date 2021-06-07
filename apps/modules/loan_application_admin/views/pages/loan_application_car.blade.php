<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<?php
    $tl = "text-align:left";
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

        <p align="center"><b>REQUEST FOR CAR PLAN / LOAN<b></p><br>

		<table align='center' cellpadding="4px" cellspacing="0" style='width: 100%; height: auto; background: #fff'>
			<tbody>
				<tr>
					<td align="left" style="width:12%">Name:</td>
					<td style="<?php echo $bb?>;<?php echo $tl?>;width:31%"><?php echo $record['employee_name'] ?></td>
                    <td style="width:7%"></td>
                    <td align="left" style="width:14%">Date Requested:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:29%"><?php echo $record['date_requested'] ?></td>                    
                    <td style="width:7%"></td>
				</tr>
                <tr>
                    <td align="left" style="width:12%">Position:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:31%"><?php echo $record['position'] ?></td>
                    <td style="width:7%"></td>
                    <td align="left" style="width:14%">Department:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:29%"><?php echo $record['department'] ?></td>                    
                    <td style="width:7%"></td>
                </tr>
                <tr>
                    <td align="left" style="width:12%">Job level:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:31%"><?php echo $record['job_level'] ?></td>
                    <td style="width:10%"></td>
                    <td align="left" style="width:14%">Division:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:29%"><?php echo $record['division'] ?></td>                    
                    <td style="width:10%"></td>
                </tr>
                <tr>
                    <td align="left" style="width:100%" colspan="6">&nbsp;</td>
                </tr>                                
                <tr>
                    <td align="left" style="width:100%" colspan="6"><b>Entitlement: 
                        (<?php echo ($record['car_loan_application_car_entitlement_id'] == 1) ? '&nbsp;X&nbsp;' : '&nbsp;&nbsp;' ?>) Car Plan &nbsp;
                        (<?php echo ($record['car_loan_application_car_entitlement_id'] == 2) ? '&nbsp;X&nbsp;' : '&nbsp;&nbsp;' ?>) Car Plan - 50% &nbsp;
                        (<?php echo ($record['car_loan_application_car_entitlement_id'] == 3) ? '&nbsp;X&nbsp;' : '&nbsp;&nbsp;' ?>) Car Loan - P600k &nbsp;
                        (<?php echo ($record['car_loan_application_car_entitlement_id'] == 4) ? '&nbsp;X&nbsp;' : '&nbsp;&nbsp;' ?>) Car Loan -500k </b>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="width:100%" colspan="6">&nbsp;</td>
                </tr>                  
                <tr>
                    <td align="left" style="width:12%">Year Model:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:31%"><?php echo $record['car_year_model'] ?></td>
                    <td style="width:10%"></td>
                    <td align="left" style="width:14%">Car Type:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:29%"><?php echo $record['car_car_type'] ?></td>                    
                    <td style="width:10%"></td>
                </tr>
                <tr>
                    <td align="left" style="width:12%">Amount of Loan:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:31%"><?php echo $record['car_loan_amount'] ?></td>
                    <td style="width:10%"></td>
                    <td align="left" style="width:14%">Amortization ( X ) Mo. (&nbsp;&nbsp;) Semi-Mo.:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:29%"><?php echo $record['car_loan_terms'] ?></td>                    
                    <td style="width:10%"></td>
                </tr>
                <tr>
                    <td align="left" style="width:12%">Pay Period: From:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:31%"><?php echo $record['car_pay_period_from'] ?></td>
                    <td style="width:10%"></td>
                    <td align="left" style="width:14%">To:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:29%"><?php echo $record['car_pay_period_to'] ?></td>                    
                    <td style="width:10%"></td>
                </tr>                 
			</tbody>
		</table>
        <br/><br/>
        <table align='center' cellpadding="4px" cellspacing="0" style='width: 100%; height: auto; background: #fff'>
            <tbody>
                <tr>
                    <td align="left" style="width:40%">Requested by:</td>
                    <td style="width:20%">&nbsp;</td>
                    <td align="left" style="width:40%">Reviewed by:</td>
                </tr>
                <tr>
                    <td align="center" style="<?php echo $bb ?>;width:40%"><?php echo $record['employee_name'] ?></td>
                    <td style="width:20%">&nbsp;</td>
                    <td align="center" style="<?php echo $bb ?>;width:40%"><?php echo $approver1 ?></td>
                </tr>
                <tr>
                    <td align="center" style="width:40%">Employee's Signature over Printed Name</td>
                    <td style="width:20%">&nbsp;</td>
                    <td align="center" style="width:40%">Head of Human Resources</td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td align="left" style="width:40%">Endorsed by:</td>
                    <td style="width:20%">&nbsp;</td>
                    <td align="left" style="width:40%">Endorsed by:</td>
                </tr>
                <tr>
                    <td align="center" style="<?php echo $bb ?>;width:40%"><?php echo $approver2 ?></td>
                    <td style="width:20%">&nbsp;</td>
                    <td align="center" style="<?php echo $bb ?>;width:40%"><?php echo $approver3 ?></td>
                </tr>
                <tr>
                    <td align="center" style="width:40%">Division Head</td>
                    <td style="width:20%">&nbsp;</td>
                    <td align="center" style="width:40%">Chief Finance Officer</td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td align="left" style="width:40%">Approved by:</td>
                    <td style="width:20%">&nbsp;</td>
                    <td align="left" style="width:40%">&nbsp;</td>
                </tr>
                <tr>
                    <td align="center" style="<?php echo $bb ?>;width:40%"><?php echo $approver4 ?></td>
                    <td style="width:20%">&nbsp;</td>
                    <td align="center" style="width:40%">&nbsp;</td>
                </tr>
                <tr>
                    <td align="center" style="width:40%">President & CEO</td>
                    <td style="width:20%">&nbsp;</td>
                    <td align="center" style="width:40%">&nbsp;</td>
                </tr>                 
            </tbody>
        </table>
        <br>
        <p><b>Important Notes:</b></p>
        <p style="text-align:justify"><i>Approval of Car Plan & Car Loan Application shall be subject to the Employee's Agreement / Conformity to all the
provisions on company's Car Plan and Car Loan Policy.
</i></p>
        <br>
        <p style="border-top:1px dashed black">(For Previously owned Vehicle)</p>
        <table align='center' cellpadding="4px" cellspacing="0" style='width: 100%; height: auto; background: #fff'>
            <tbody>
                <tr>
                    <td align="left" style="width:12%">Market Value:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:31%"></td>
                    <td style="width:10%"></td>
                    <td align="left" style="width:14%">Insurance:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:29%"></td>                    
                    <td style="width:10%"></td>
                </tr>
                <tr>
                    <td align="left" style="width:12%"></td>
                    <td style="width:31%"></td>
                    <td style="width:10%"></td>
                    <td align="left" style="width:14%"></td>
                    <td align="center" style="width:29%">Admin. Head</td>                    
                    <td style="width:10%"></td>
                </tr>
                <tr>
                    <td align="left" style="width:12%">Assessed By:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:31%"></td>
                    <td style="width:10%"></td>
                    <td align="left" style="width:14%">Date:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:29%"></td>                    
                    <td style="width:10%"></td>
                </tr>
                <tr>
                    <td align="left" style="width:12%">&nbsp;</td>
                    <td align="center "style="width:31%">Procurement Head</td>
                    <td style="width:10%"></td>
                    <td align="left" style="width:14%"></td>
                    <td style="width:29%"></td>                    
                    <td style="width:10%"></td>
                </tr>
                <tr>
                    <td align="left" style="width:12%">Date:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:31%"></td>
                    <td style="width:10%"></td>
                    <td align="left" style="width:14%"></td>
                    <td style="width:29%"></td>                    
                    <td style="width:10%"></td>
                </tr>                
            </tbody>
        </table>    
    </body>
<!-- BEGIN BODY -->
</html>
