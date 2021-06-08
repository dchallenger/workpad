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

        <p align="center"><b>OMNIBUS LOAN APPLICATION<b></p><br>

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
                    <td align="left" style="width:12%">Emp No.:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:31%"><?php echo $record['id_number'] ?></td>                    
                    <td style="width:7%"></td>                    
                    <td align="left" style="width:14%">Position:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:29%"><?php echo $record['position'] ?></td>
                    <td style="width:7%"></td>
                </tr>
                <tr>
                    <td align="left" style="width:12%">Department:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:31%"><?php echo $record['department'] ?></td>                    
                    <td style="width:7%"></td>                    
                    <td align="left" style="width:14%">Job level:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:29%"><?php echo $record['job_level'] ?></td>
                    <td style="width:7%"></td>
                </tr>
                <tr>
                    <td align="left" style="width:12%">Division:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:31%"><?php echo $record['division'] ?></td>                    
                    <td style="width:7%"></td>
                    <td align="left" style="width:14%">Loan Amount:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:29%"><?php echo $record['omnibus_loan_amount'] ?></td>
                    <td style="width:7%"></td>

                </tr>
                <tr>
                    <td align="left" style="width:12%">Terms:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:31%"><?php echo $record['omnibus_loan_terms'] ?></td>                    
                    <td style="width:7%"></td>                    
                    <td align="left" style="width:14%">Start of Amortization:</td>
                    <td style="<?php echo $bb?>;<?php echo $tl?>;width:29%"><?php echo $record['omnibus_loan_deduction_start'] ?></td>
                    <td style="width:7%"></td>
                </tr>
			</tbody>
		</table>
        <br>
        <p style="text-align:justify">I would like to apply for a loan equivalent to <u>&nbsp;&nbsp;&nbsp;<?php echo convert_number_to_words($record['omnibus_loan_amount']) ?> pesos only&nbsp;&nbsp;&nbsp;</u>(P<?php echo $record['omnibus_loan_amount']?>). The said loan will be used for the following purpose(s):</p>
        <br>
        <p style="<?php echo $bb ?>">&nbsp;</p>
        <p align="center"><b>AUTHORITY TO DEDUCT</b></p>
        <p style="text-align:justify">This is to acknowledge my availment of an Omnibus Loan from <?php echo $record['company']  ?>. in the amount of (P<?php echo $record['omnibus_loan_amount']?>) at zero interest, payable in equal semi-monthly installments equivalent to (P<?php echo $record['omnibus_loan_start_amortization'] ?>) per payday.</p>
        <p style="text-align:justify">In payment for the above, I hereby authorize <?php echo $record['company_initial'] ?> to deduct the amount of semi-monthly installments from my salary effective <?php echo $record['omnibus_loan_deduction_start'] ?> payday until <?php echo $record['omnibus_loan_deduction_end'] ?>, or until the full amount has been paid, whichever comes first.</p>
        <p style="text-align:justify">In the event of my separation from the company, I agree that the remaining balance shall be deductible from my last salary and whatever applicable benefits due me from the company.</p>
        <br>
        <table align='center' cellpadding="4px" cellspacing="0" style='width: 100%; height: auto; background: #fff'>
            <tbody>
                <tr>
                    <td align="center" style="<?php echo $bb ?>;width:40%">&nbsp;</td>
                    <td style="width:20%">&nbsp;</td>
                    <td align="center" style="<?php echo $bb ?>;width:40%"><?php echo $approver1 ?></td>
                </tr>
                <tr>
                    <td align="center" style="width:40%">Employee Signature</td>
                    <td style="width:20%">&nbsp;</td>
                    <td align="center" style="width:40%">Department / Division Head</td>
                </tr>                               
            </tbody>
        </table>
        <br>
        <p align="center">(FOR HR USE)</p>
        <p align="center"><b>CERTIFICATION OF LOAN ELIGIBILITY</b></p>
        <p>This is to confirm that the Employee has met the requirements for Omnibus Loan availment.</p>
        <p>(&nbsp;<?php echo ($record['omnibus_loan_with_outstanding'] == 'No' ? 'X' : '&nbsp;') ?>&nbsp;) No outstanding OL amortization as of</p>
        <p>(&nbsp;&nbsp;&nbsp;&nbsp;) % of OL paid as of</p>
        <p>(&nbsp;&nbsp;&nbsp;&nbsp;) Net Pay Base Limit requirement complied with</p>
        <br>
        <p>Checked by:</p>
        <table align='center' cellpadding="4px" cellspacing="0" style='width: 100%; height: auto; background: #fff'>
            <tbody>
                <tr>
                    <td align="center" style="<?php echo $bb ?>;width:40%"><?php echo $approver2 ?></td>
                    <td style="width:20%">&nbsp;</td>
                    <td align="center" style="<?php echo $bb ?>;width:40%"><?php echo $approver3 ?></td>
                </tr>
                <tr>
                    <td align="center" style="width:40%">Reviewed and endorsed by:</td>
                    <td style="width:20%">&nbsp;</td>
                    <td align="center" style="width:40%">Approved by:</td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td align="center" style="<?php echo $bb ?>;width:40%"></td>
                    <td style="width:20%">&nbsp;</td>
                    <td align="center" style="<?php echo $bb ?>;width:40%"></td>
                </tr>
                <tr>
                    <td align="center" style="width:40%">Check released on:</td>
                    <td style="width:20%">&nbsp;</td>
                    <td align="center" style="width:40%">by:</td>
                </tr>                                  
            </tbody>
        </table>        
    </body>
<!-- BEGIN BODY -->
</html>
