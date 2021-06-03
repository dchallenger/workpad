<html><head><meta charset="utf-8"></head>
<body>
<div style="font-size: 10px; font-weight: normal;">
    
    <p style="text-align:center"><img src="<?php echo ($logo != '' ? $logo : '') ?>" alt="Please enable images to load system logo" title="Please enable images"></p>
        
    <div class="clearfix"><br/></div>
    <div class="clearfix"><br/></div>

    <p style="text-align:center"><b><u>CERTIFICATE OF EMPLOYMENT</u></b></p>

    <div class="clearfix"><br/></div>
    <div class="clearfix"><br/></div>

    <p>This is to certify the following:</p> 

    <table>
        <tbody>
            <tr>
                <td style="width:10%;">&nbsp;</td>
                <td style="width:30%;text-align:left">Name of Employee</td>
                <td style="width:50%"><?php echo $employee_name ?></td>
            </tr>
            <tr>
                <td style="width:10%;">&nbsp;</td>
                <td style="width:30%;text-align:left">Position of Employee</td>
                <td style="width:50%"><?php echo $position ?></td>
            </tr>
            <tr>
                <td style="width:10%;">&nbsp;</td>
                <td style="width:30%;text-align:left">Residential Address</td>
                <td style="width:50%"><?php echo $address ?>, <?php echo $city ?></td>
            </tr>
            <tr>
                <td style="width:10%;">&nbsp;</td>
                <td style="width:30%;text-align:left">Employer name</td>
                <td style="width:50%"><?php echo $company ?></td>
            </tr>
            <tr>
                <td style="width:10%;">&nbsp;</td>
                <td style="width:30%;text-align:left">Employer Address</td>
                <td style="width:50%"><?php echo $company_address ?></td>
            </tr>
            <tr>
                <td style="width:10%;">&nbsp;</td>
                <td style="width:30%;text-align:left">Work Location</td>
                <td style="width:50%"><?php echo $location ?></td>
            </tr>
            <tr>
                <td style="width:10%;">&nbsp;</td>
                <td style="width:30%;text-align:left">Business</td>
                <td style="width:50%"></td>
            </tr>            
        </tbody>
    </table>

    <p style="text-align:justify">This certification is being issued to facilitate his travel to and from work and access through the PNP/AFP or any Government-designated checkpoints during the Modified Enhanced Community Quarantine.</p>

    <p style="text-align:justify">Issued on <?php echo $filled_date ?>, in the City of Pasig, Metro Manila, Philippines.</p>
    
    <div class="clearfix"><br/></div>

    <p><b><?php echo $company ?></b></p>
    
    <div class="clearfix"><br/></div>

    <p>By:</p>

    <p><b><?php echo $hrd ?></b><br/><?php echo $hrd_position ?></p>
    
    <div class="clearfix"><br/></div>

</div>
</body>
</html>
