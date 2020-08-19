<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html lang="en">
    <!-- BEGIN HEAD-->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title></title>
        <style>
            body
            {
                font-family:Arial;
                font-size: 12px;
            }
        </style>        
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body bgcolor="#ffffff" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" style="-webkit-font-smoothing: antialiased; width: 100% !important; -webkit-text-size-adjust: none;">
        <table align='center' cellpadding="2px" cellspacing="0" style='width: 95%; height: auto; background: #fff; border: 1px solid #000;margin-bottom: 10px;'>
            <tr>
                <td style="border-bottom: 1px solid #000;border-right: 1px solid #000"><img src="{{logo}}" alt="Please enable images to load system logo" title="Please enable images"></td>
                <td style="border-bottom: 1px solid #000;border-right: 1px solid #000;vertical-align:top;text-align:center"><strong><span>ENTERPRISE CORE <br> SERVICES</span> <br> <span>FORMS</span></strong></td>
                <td style="border-bottom: 1px solid #000;vertical-align:top;text-align:left"><span>Date Effective</span> <br><span><strong>{{date}}</strong></span></td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid #000;border-right: 1px solid #000">DEPARTMENT:{{department}}</td>
                <td>TITLE</td>
                <td style="border-bottom: 1px solid #000;border-left: 1px solid #000">FM_HRD_AHI_007.0</td>
            </tr>  
            <tr>
                <td style="border-right: 1px solid #000">SECTION:{{section}}</td>
                <td>Interview Finding Sheet</td>
                <td style="border-left: 1px solid #000">&nbsp;</td>
            </tr>                        
        </table>
        <p align='center'><strong>INTERVIEW FINDING SHEET</strong></p>   
        <table align='center' cellpadding="2px" cellspacing="0" style='width: 95%; height: auto; background: #fff;'> 
            <tr>
                <td style="">Candidate:{{recipients}}</td>
                <td align='left'>Position:{{position}}</td>
            </tr>                        
        </table>  
        <table align='center' cellpadding="2px" cellspacing="0" style='width: 95%; height: auto; background: #fff; border: 1px solid #000;margin-bottom: 10px;'>
            <tr>
                <td colspan="2" align='center' style="border-bottom: 1px solid #000">JOB QUALIFICATION</td>
            </tr> 
            <tr>
                <td colspan="2" align='left' style="border-bottom: 1px solid #000">
                    <p>{{optional_requirements1}}</p>
                    <p>{{optional_requirements2}}</p>
                    <p>{{optional_requirements3}}</p>
                </td>
            </tr> 
            <tr>
                <td colspan="2" align='center' style="border-bottom: 1px solid #000">FINDINGS / COMMENTS / IMPRESSION</td>
            </tr>    
            {{comments}}                                                                          
        </table>                       
    </body>
<!-- BEGIN BODY -->
</html>
