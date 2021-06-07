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

        <p align="center"><b>APPLICATION FOR MOBILE POSTPAID PLAN/PREPAID CELL CARD<b></p><br>

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
                    <td align="left" style="width:100%" colspan="6"><b>TYPE OF ENROLLMENT: </b></td>
                </tr>
                <tr>
                    <td align="center" style="width:12%">(&nbsp;<?php echo ($record['mobile_loan_application_mobile_enrollment_type_id'] == 1) ? 'X' : '&nbsp;&nbsp;' ?>&nbsp;)</td>
                    <td style="<?php echo $tl?>;width:31%">New line</td>
                    <td style="width:7%"></td>
                    <td align="center" style="width:14%">(&nbsp;<?php echo ($record['mobile_loan_application_mobile_enrollment_type_id'] == 4) ? 'X' : '&nbsp;&nbsp;' ?>&nbsp;)</td>
                    <td style="<?php echo $tl?>;width:29%">Transfer of Cost Center </td>                    
                    <td style="width:7%"></td>
                </tr>
                <tr>
                    <td align="center" style="width:12%">(&nbsp;<?php echo ($record['mobile_loan_application_mobile_enrollment_type_id'] == 2) ? 'X' : '&nbsp;&nbsp;' ?>&nbsp;)</td>
                    <td style="<?php echo $tl?>;width:31%">Upgrade of current/existing plan</td>
                    <td style="width:7%"></td>
                    <td align="center" style="width:14%">(&nbsp;<?php echo ($record['mobile_loan_application_mobile_enrollment_type_id'] == 5) ? 'X' : '&nbsp;&nbsp;' ?>&nbsp;)</td>
                    <td style="<?php echo $tl?>;width:29%">Termination of current/existing plan</td>                    
                    <td style="width:7%"></td>
                </tr>
                <tr>
                    <td align="center" style="width:12%">(&nbsp;<?php echo ($record['mobile_loan_application_mobile_enrollment_type_id'] == 3) ? 'X' : '&nbsp;&nbsp;' ?>&nbsp;)</td>
                    <td style="<?php echo $tl?>;width:31%">Transfer of Personal Line to Corporate Plan</td>
                    <td style="width:7%"></td>
                    <td align="center" style="width:14%">&nbsp;</td>
                    <td style="<?php echo $tl?>;width:29%">&nbsp;</td>                    
                    <td style="width:10%"></td>
                </tr>
                <tr>
                    <td align="left" style="width:100%" colspan="6">&nbsp;</td>
                </tr>                                
                <tr>
                    <td align="left" style="width:100%" colspan="6"><b>PLAN LIMIT (Based on company policy) </b></td>
                </tr>
                <tr>
                    <td align="center" style="width:12%">(&nbsp;<?php echo ($record['mobile_loan_application_mobile_plan_limit_id'] == 1) ? 'X' : '&nbsp;&nbsp;' ?>&nbsp;)</td>
                    <td style="<?php echo $tl?>;width:31%">Plan Php2,500.00 per month</td>
                    <td style="width:7%"></td>
                    <td align="center" style="width:14%">(&nbsp;<?php echo ($record['mobile_loan_application_mobile_plan_limit_id'] == 4) ? 'X' : '&nbsp;&nbsp;' ?>&nbsp;)</td>
                    <td style="<?php echo $tl?>;width:29%">Plan Php 999.00 per month</td>                    
                    <td style="width:7%"></td>
                </tr>
                <tr>
                    <td align="center" style="width:12%">(&nbsp;<?php echo ($record['mobile_loan_application_mobile_plan_limit_id'] == 2) ? 'X' : '&nbsp;&nbsp;' ?>&nbsp;)</td>
                    <td style="<?php echo $tl?>;width:31%">Plan Php1,800.00 per month</td>
                    <td style="width:7%"></td>
                    <td align="center" style="width:14%">(&nbsp;<?php echo ($record['mobile_loan_application_mobile_plan_limit_id'] == 5) ? 'X' : '&nbsp;&nbsp;' ?>&nbsp;)</td>
                    <td style="<?php echo $tl?>;width:29%">Cell Card worth Php 300.00 per month</td>                    
                    <td style="width:7%"></td>
                </tr>
                <tr>
                    <td align="center" style="width:12%">(&nbsp;<?php echo ($record['mobile_loan_application_mobile_plan_limit_id'] == 3) ? 'X' : '&nbsp;&nbsp;' ?>&nbsp;)</td>
                    <td style="<?php echo $tl?>;width:31%">Plan Php1,499.00 per month</td>
                    <td style="width:7%"></td>
                    <td align="center" style="width:14%">&nbsp;</td>
                    <td style="<?php echo $tl?>;width:29%">&nbsp;</td>                    
                    <td style="width:10%"></td>
                </tr>
                <tr>
                    <td align="left" style="width:100%" colspan="6">&nbsp;</td>
                </tr>                                
                <tr>
                    <td align="left" style="width:100%" colspan="6"><b>SPECIAL FEATURES NEEDED: </b></td>
                </tr>
                <tr>
                    <td align="center" style="width:12%">(&nbsp;<?php echo ($record['mobile_loan_application_mobile_special_feature_id'] == 1) ? 'X' : '&nbsp;&nbsp;' ?>&nbsp;)</td>
                    <td style="<?php echo $tl?>;width:31%">Super duo (with landline number)</td>
                    <td style="width:7%"></td>
                    <td align="center" style="width:14%">(&nbsp;<?php echo ($record['mobile_loan_application_mobile_special_feature_id'] == 3) ? 'X' : '&nbsp;&nbsp;' ?>&nbsp;)</td>
                    <td style="<?php echo $tl?>;width:29%">Data Plan</td>                    
                    <td style="width:7%"></td>
                </tr>
                <tr>
                    <td align="center" style="width:12%">(&nbsp;<?php echo ($record['mobile_loan_application_mobile_special_feature_id'] == 2) ? 'X' : '&nbsp;&nbsp;' ?>&nbsp;)</td>
                    <td style="<?php echo $tl?>;width:31%">Unlimited text </td>
                    <td style="width:7%"></td>
                    <td align="center" style="width:14%">&nbsp;</td>
                    <td style="<?php echo $tl?>;width:29%">&nbsp;</td>                    
                    <td style="width:10%"></td>
                </tr>                 
			</tbody>
		</table>
        <br/><br/>
        <table align='center' cellpadding="4px" cellspacing="0" style='width: 100%; height: auto; background: #fff'>
            <tbody>
                <tr>
                    <td align="left" style="width:40%">Prepared by:</td>
                    <td style="width:20%">&nbsp;</td>
                    <td align="left" style="width:40%">Endorsed by:</td>
                </tr>
                <tr>
                    <td align="center" style="<?php echo $bb ?>;width:40%">&nbsp;</td>
                    <td style="width:20%">&nbsp;</td>
                    <td align="center" style="<?php echo $bb ?>;width:40%"><?php echo $record['dept_head'] ?></td>
                </tr>
                <tr>
                    <td align="center" style="width:40%">Employee Signature</td>
                    <td style="width:20%">&nbsp;</td>
                    <td align="center" style="width:40%">Department Head</td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td align="left" style="width:40%">Validated and Reviewed by:</td>
                    <td style="width:20%">&nbsp;</td>
                    <td align="left" style="width:40%">Approved by:</td>
                </tr>
                <tr>
                    <td align="center" style="<?php echo $bb ?>;width:40%"><?php echo $approver1 ?></td>
                    <td style="width:20%">&nbsp;</td>
                    <td align="center" style="<?php echo $bb ?>;width:40%"><?php echo $approver2 ?></td>
                </tr>
                <tr>
                    <td align="center" style="width:40%">BC&A Finance Manager/HR Head</td>
                    <td style="width:20%">&nbsp;</td>
                    <td align="center" style="width:40%">Division Head / President & CEO (if applicable)</td>
                </tr>                                  
            </tbody>
        </table>
        <br>
        <p><b>Important Notes:</b></p>
        <p style="text-align:justify"><i>Transactions which do not exceed the billing statement or amount allotted for a user need not be itemized or included in the attachment. If the employee exceeds the maximum limit, all excess charges shall be paid by the employee directly to the service provider or at any authorized payment centers. 
Should the employee declare that all of the transactions causing the maximum limit to be exceeded are official transactions, he/she is expected to itemize and positively identify all calls made. All reimbursements are subject to approval by Management. 
In the event that the mobile plan has been disconnected due to unpaid charges caused by the employee, all applicable fees for its reconnection shall be shouldered by the employee. 
All costs related to the replacement or repair of the mobile phone shall be for the account of the employee.
</i></p>
    </body>
<!-- BEGIN BODY -->
</html>
