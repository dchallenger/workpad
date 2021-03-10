<?php
    $number = '&nbsp;&nbsp;';
    $next_pa = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    if ($result && $result->num_rows() > 0){
        $ctr = 1;
        foreach ($result->result() as $row) {
            if ($ctr > 1){
?>
                <div style="page-break-before: always;">&nbsp;</div>
<?php
            }            
?>
            <table align='center' cellpadding="2px" cellspacing="0" style='width: 95%; height: auto; background: #fff; margin-bottom: 10px;'> 
                <tr>
                    <td style="width:25%">Reference Person</td>
                    <td><?php echo $row->reference_person ?></td>
                </tr>
                <tr>
                    <td style="width:25%">Position</td>
                    <td><?php echo $row->position ?></td>
                </tr>                 
                <tr>
                    <td style="width:25%">Company</td>
                    <td><?php echo $row->company ?></td>
                </tr>                                                                                   
            </table>
            <table align='center' cellpadding="2px" cellspacing="0" style='border:1px solid #e4e4e4; width: 95%; height: auto; background: #fff; margin-bottom: 10px;'> 
                <tbody>
                    <tr>
                        <td colspan="2" width="50%" style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">Name of Character Reference</td>
                        <td width="50%" style="border-bottom: 1px solid #e4e4e4;"><?php echo $row->reference_person ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">Position</td>
                        <td style="border-bottom: 1px solid #e4e4e4;"><?php echo $row->position ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">Company</td>
                        <td style="border-bottom: 1px solid #e4e4e4;"><?php echo $row->company ?></td>
                    </tr>
                    <tr>
                        <td width="4%" style="border-bottom: 1px solid #e4e4e4" valign="top">1.</td>
                        <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">
                            <p>Relationship</p>
                            <p>How did you know the candidate?</p>
                        </td>
                        <td style="border-bottom: 1px solid #e4e4e4;">
                            <?php echo $row->ans1 ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="4%" style="border-bottom: 1px solid #e4e4e4" valign="top">2.</td>
                        <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">
                            <p>Efficiency at work</p>
                            <p>What can you say about his/her attendance (absence/tardiness)?</p>
                        </td>
                        <td style="border-bottom: 1px solid #e4e4e4;">
                            <?php echo $row->ans2 ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="4%" style="border-bottom: 1px solid #e4e4e4">&nbsp;</td>
                        <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">
                            <p>How closely was he/she supervised?</p>
                        </td>
                        <td style="border-bottom: 1px solid #e4e4e4;">
                            <?php echo $row->ans3 ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="4%" style="border-bottom: 1px solid #e4e4e4">&nbsp;</td>
                        <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">
                            <p>How would you describe the QUALITY of work he/she does?</p>
                        </td>
                        <td style="border-bottom: 1px solid #e4e4e4;">
                            <?php echo $row->ans4 ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="4%" style="border-bottom: 1px solid #e4e4e4">&nbsp;</td>
                        <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">
                            <p>How would you describe the QUANTITY of work he/she does?</p>
                        </td>
                        <td style="border-bottom: 1px solid #e4e4e4;">
                            <?php echo $row->ans5 ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="4%" style="border-bottom: 1px solid #e4e4e4">&nbsp;</td>
                        <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">
                            <p>How would you describe his/her management style? (handling of multiple responsibilities/stress)</p>
                        </td>
                        <td style="border-bottom: 1px solid #e4e4e4;">
                            <?php echo $row->ans6 ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="4%" style="border-bottom: 1px solid #e4e4e4">&nbsp;</td>
                        <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">
                            <p>How would you rate his/her communication skills?</p>
                        </td>
                        <td style="border-bottom: 1px solid #e4e4e4;">
                            <?php echo $row->ans7 ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="4%" style="border-bottom: 1px solid #e4e4e4" valign="top">3.</td>
                        <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">
                            <p>Interpersonal skills</p>
                            <p>How would you describe her performance when working with others/ a team?</p>
                        </td>
                        <td style="border-bottom: 1px solid #e4e4e4;">
                            <?php echo $row->ans8 ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="4%" style="border-bottom: 1px solid #e4e4e4" valign="top">4.</td>
                        <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">
                            <p>Strengths/Technical Knowledge</p>
                            <p>Would there be any specific technical/product knowledge or skills, you think, that he/she can contribute to his/her prospective employer?</p>
                        </td>
                        <td style="border-bottom: 1px solid #e4e4e4;">
                            <?php echo $row->ans9 ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="4%" style="border-bottom: 1px solid #e4e4e4" valign="top">5.</td>
                        <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">
                            <p>Weaknesses/Candidate’s Potentials</p>
                            <p>Could you identify any areas of development that the prospective employer should look into?</p>
                        </td>
                        <td style="border-bottom: 1px solid #e4e4e4;">
                            <?php echo $row->ans10 ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="4%" style="border-bottom: 1px solid #e4e4e4" valign="top">6.</td>
                        <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">
                            <p>Integrity</p>
                            <p>Would you be aware of any issues/controversy that he/she has been involved with? Can you provide details?</p>
                        </td>
                        <td style="border-bottom: 1px solid #e4e4e4;">
                            <?php echo $row->ans11 ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="4%" style="border-bottom: 1px solid #e4e4e4">&nbsp;</td>
                        <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">
                            <p>Can you describe his/her way of handling sensitive/confidential information/materials?</p>
                        </td>
                        <td style="border-bottom: 1px solid #e4e4e4;">
                            <?php echo $row->ans12 ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="4%" style="border-bottom: 1px solid #e4e4e4" valign="top">7.</td>
                        <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">
                            <p>If applicable</p>
                            <p>What would you consider as his/her biggest contribution to the company?</p>
                        </td>
                        <td style="border-bottom: 1px solid #e4e4e4;">
                            <?php echo $row->ans13 ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="4%" style="border-bottom: 1px solid #e4e4e4">&nbsp;</td>
                        <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">
                            <p>Would you know the reason why he/she left your company?</p>
                        </td>
                        <td style="border-bottom: 1px solid #e4e4e4;">
                            <?php echo $row->ans14 ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="4%" style="border-bottom: 1px solid #e4e4e4">&nbsp;</td>
                        <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">
                            <p>If given the opportunity, would you consider re-hiring him/her? Why?</p>
                        </td>
                        <td style="border-bottom: 1px solid #e4e4e4;">
                            <?php echo $row->ans15 ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="4%" style="border-bottom: 1px solid #e4e4e4">&nbsp;</td>
                        <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">
                            <p>Is there anything else you would like to add to help us further evaluate his/her application?</p>
                        </td>
                        <td style="border-bottom: 1px solid #e4e4e4;">
                            <?php echo $row->ans16 ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">Thank you very much for your time, and rest assured that we will be keeping all this information confidential. Have a very good day sir/ma’am!</td>
                    </tr>                            
                </tbody>                        
            </table>  
<?php
            $ctr++;
        }
    }
?>            