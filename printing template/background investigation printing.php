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
        <table align='center' cellpadding="2px" cellspacing="0" style='width: 95%; height: auto; background: #fff; border: 1px solid #e4e4e4;margin-bottom: 10px;'>
            <tr>
                <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4"><img src="{{logo}}" alt="Please enable images to load system logo" title="Please enable images"></td>
                <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4;vertical-align:top;text-align:center"><strong><span>ENTERPRISE CORE <br> SERVICES</span> <br> <span>FORMS</span></strong></td>
                <td style="border-bottom: 1px solid #e4e4e4;vertical-align:top;text-align:left"><span>Date Effective</span> <br> <span><strong>{{date}}</strong></span></td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">DEPARTMENT:{{department}}</td>
                <td>TITLE</td>
                <td style="border-bottom: 1px solid #e4e4e4;border-left: 1px solid #e4e4e4">FM_HRD_AHI_007.0</td>
            </tr>  
            <tr>
                <td style="border-right: 1px solid #e4e4e4">SECTION:{{section}}</td>
                <td>Background Investigation Form</td>
                <td style="border-left: 1px solid #e4e4e4">&nbsp;</td>
            </tr>                        
        </table>  
        <table align='center' cellpadding="2px" cellspacing="0" style='width: 95%; height: auto; background: #fff; margin-bottom: 10px;'> 
            <tr>
                <td style="width:25%">Name</td>
                <td>{{dear}}</td>
            </tr> 
            <tr>
                <td stye="width:25%">Position Applied for:</td>
                <td>{{position}}</td>
            </tr>   
            <tr>
                <td stye="width:25%">Date:</td>
                <td>{{date_created}}</td>
            </tr>                                   
        </table>   
        <br>
        <table align='center' cellpadding="2px" cellspacing="0" style='width: 95%; height: auto; background: #fff; margin-bottom: 10px;'>
            <tr>
                <td><STRONG>PREVIOUS WORK RELATED INFORMATION</STRONG></td>
            </tr>      
        </table>
        <br /> <br />
        {{prev_work_related}}                
    </body>
<!-- BEGIN BODY -->
</html>
