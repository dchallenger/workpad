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
                <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4"><img src="assets/img/hdi_resource-logo.png" style="width: 160px;"></td>
                <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4;vertical-align:top;text-align:left"><span>ENTERPRISE CORE SERVICES</span> <br> <span>FORMS</span></td>
                <td style="border-bottom: 1px solid #e4e4e4;vertical-align:top;text-align:left"><span>Date Effective</span> <br> <span>{{date}}</span></td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">DEPARTMENT:{{department}}</td>
                <td>TITLE</td>
                <td style="border-bottom: 1px solid #e4e4e4;border-left: 1px solid #e4e4e4">FM_HRD_AHI_001.0</td>
            </tr>  
            <tr>
                <td style="border-right: 1px solid #e4e4e4">SECTION:{{section}}</td>
                <td>Personel Requisition Form</td>
                <td style="border-left: 1px solid #e4e4e4">Page 1 of 1</td>
            </tr>                        
        </table>
        <table align='center' cellpadding="2px" cellspacing="0" style='width: 95%; height: auto; background: #fff; margin-bottom: 10px;'>
             <tr>
                <td>&nbsp;</td>
                <td style="text-align:right"><strong>LEADTIME</strong></td>
            </tr>            
             <tr>
                <td>Copy I - HRD</td>
                <td style="text-align:right">Managerial - 45 working days</td>
            </tr>
            <tr>
                <td>Copy II - Requisitioning Dept. / SBU</td>
                <td style="text-align:right">Technical / Supervisory - 30 working days</td>
            </tr>  
            <tr>
                <td>&nbsp;</td>
                <td style="text-align:right">Staff - 20 working days</td>
            </tr>                         
        </table>    
        <table align='center' cellpadding="2px" cellspacing="0" style='width: 95%; height: auto; background: #fff; margin-bottom: 10px;'>
             <tr>
                <td style="text-align:center"><strong>PERSONNEL REQUISITION FROM (PRF)</strong></td>
            </tr>            
             <tr>
                <td>REQUISITIONING DEPT./PROPERTY<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
            </tr>                       
        </table>   
        <table align='center' cellpadding="2px" cellspacing="0" style='width: 95%; height: auto; background: #fff; border: 1px solid #e4e4e4;margin-bottom: 10px;'>
            <tr>
                <td style="border-bottom: 1px solid #e4e4e4" colspan="4">JOB SPECIFICATION:</td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4" colspan="2">Position: <br>{{position}}</td>
                <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">No. Required <br>{{quantity}}</td>
                <td style="border-bottom: 1px solid #e4e4e4">Age Range: <br>{{age_range}}</td>
            </tr> 
            <tr>
                <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">Sex: <br>{{gender}}</td>
                <td style="border-bottom: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4">Civil Status: <br>{{civil_status}}</td>
                <td style="border-bottom: 1px solid #e4e4e4" colspan="2">Approriate Educational Attainment <br>{{educ_attainment}}</td>
            </tr> 
            <tr>
                <td style="" colspan="4">COMPETENCY SPECIFICATION Knowledge/ Skills Experience Required:</td>
            </tr> 
            {{key_requirement}}                                   
            <tr>
                <td style="border-top: 1px solid #e4e4e4" colspan="4">JOB SPECIFICATION Job Summary/ Functions: </td>
            </tr>  
            {{specification}}                                                        
        </table>  
        <table align='center' cellpadding="2px" cellspacing="0" style='width: 95%; height: auto; background: #fff; border: 1px solid #e4e4e4;margin-bottom: 10px;'>
            <tr>
                <td style="border-right: 1px solid #e4e4e4;width:50%" colspan="2">Employment Status:</td>
                <td style="" colspan="3">&nbsp;</td>
            </tr> 
            <tr>
                <td style="">( {{prob}} ) Probationary</td>
                <td style="border-right: 1px solid #e4e4e4">( {{reg}} ) Regular</td>
                <td style="">( {{proj}} ) Project</td>
                <td style="">( {{cas}} ) Casual</td>
                <td style="">Duration<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>mos.</td>
            </tr>                                                                     
        </table>     
        <table align='center' cellpadding="2px" cellspacing="0" style='width: 95%; height: auto; background: #fff; border: 1px solid #e4e4e4;margin-bottom: 10px;'>
            <tr>
                <td style="width:50%">PURPOSE OF REQUISITION:</td>
                <td style="" colspan="3">&nbsp;</td>
            </tr> 
            <tr>
                <td style="width:50%" colspan="2">( {{new_position}} ) New Position</td>
                <td style="width:15%">( {{replacement}} ) Replacement for</td>
                <td style="border-bottom: 1px solid #e4e4e4;width:30%">{{replacement_employee}}</td>
                <td style="width:5%">&nbsp;</td>
            </tr> 
            <tr>
                <td style="width:50%" colspan="2">( {{additional}} ) Additional</td>
                <td style="width:50%" colspan="2">Due to: ( ) Resignation &nbsp;&nbsp;&nbsp;&nbsp;( ) Retirement &nbsp;&nbsp;&nbsp;&nbsp;( ) Termination</td>
            </tr>    
            <tr>
                <td style="width:50%" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Attachment:</td>
                <td style="width:50%" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ( ) Transfer to <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
            </tr>           
            <tr>
                <td style="width:50%" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(a) Table of Orgainization</td>
                <td style="width:50%" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ( ) Vacation / Sick / Maternity / Paternity Leave</td>
            </tr>   
            <tr>
                <td style="width:50%" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(b) JD/JS</td>
                <td style="width:50%" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;From <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{leave_date_from}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u> to <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{leave_date_to}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
            </tr>                                                                                                          
        </table>  
        <table align='center' cellpadding="2px" cellspacing="0" style='width: 95%; height: auto; background: #fff; border: 1px solid #e4e4e4;margin-bottom: 10px;'>
            <tr>
                <td style="border-right: 1px solid #e4e4e4;width:50%">Maximum no. personnel for this position:</td>
                <td style="width:50%">Total no. of incumbents for this position</td>
            </tr> 
            <tr>
                <td style="border-right: 1px solid #e4e4e4;width:50%">(as per approved budget in plantilla): {{max_personel}}</td>
                <td style="width:50%">Including current requisition: {{total_no_incumbent}}</td>
            </tr>                                                                                  
        </table> 
        <p style="padding-left:50px;margin:0">APPROVING SIGNATORIES</p> 
        <table align='center' cellpadding="2px" cellspacing="0" style='width: 95%; height: auto; background: #fff; border: 1px solid #e4e4e4;margin-bottom: 10px;'>
            <tr>
                <td style="border-right: 1px solid #e4e4e4;width:25%">Requested by:</td>
                <td style="border-right: 1px solid #e4e4e4;width:25%">Endorsed by:</td>
                <td style="border-right: 1px solid #e4e4e4;width:25%">Approved by:</td>
                <td style="width:25%">Reqviewed and Concurred by:</td>
            </tr>    
            <tr>
                <td style="border-right: 1px solid #e4e4e4;width:25%"><u>{{requested_by}}</u></td>
                <td style="border-right: 1px solid #e4e4e4;width:25%"><u>{{approver1}}</u></td>
                <td style="border-right: 1px solid #e4e4e4;width:25%"><u>{{approver2}}</u></td>
                <td style="width:25%"><u>{{approver3}}</u></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid #e4e4e4;width:25%">Immediate Superior</td>
                <td style="border-right: 1px solid #e4e4e4;width:25%">Department Head</td>
                <td style="border-right: 1px solid #e4e4e4;width:25%">SVU Head/VP/COO/CEO</td>
                <td style="width:25%">HRD Manager</td>
            </tr>           
            <tr>
                <td style="border-right: 1px solid #e4e4e4;width:25%">Date: {{requested_date}}</td>
                <td style="border-right: 1px solid #e4e4e4;width:25%">Date: {{approver1_date}}</td>
                <td style="border-right: 1px solid #e4e4e4;width:25%">Date: {{approver2_date}}</td>
                <td style="width:25%">Date: {{approver3_date}}</td>
            </tr>                                                                                                               
        </table>  
        <table align='center' cellpadding="2px" cellspacing="0" style='width: 95%; height: auto; background: #fff; border: 1px solid #e4e4e4;margin-bottom: 10px;'>
            <tr>
                <td style="border-right: 1px solid #e4e4e4;width:25%">Date Received:</td>
                <td style="border-right: 1px solid #e4e4e4;width:25%">Recived by:</td>
                <td style="border-right: 1px solid #e4e4e4;width:25%">Due date:</td>
                <td style="width:25%">Date served:</td>
            </tr>    
            <tr>
                <td style="border-right: 1px solid #e4e4e4;width:25%">&nbsp;</td>
                <td style="border-right: 1px solid #e4e4e4;width:25%">&nbsp;</td>
                <td style="border-right: 1px solid #e4e4e4;width:25%">&nbsp;</td>
                <td style="width:25%">&nbsp;</td>
            </tr>                                                                                                                         
        </table>  
        <p style="padding-left:50px;margin:0">FOR HRD USE ONLY</p> 
        <table align='center' cellpadding="2px" cellspacing="0" style='width: 95%; height: auto; background: #fff; border: 1px solid #e4e4e4;margin-bottom: 10px;'>
            <tr>
                <td style="border-right: 1px solid #e4e4e4;width:50%">Applicants Endorsed:</td>
                <td style="border-right: 1px solid #e4e4e4;width:25%">Hiring Date:</td>
                <td style="width:25%">Remarks:</td>
            </tr>  
            {{applicants}}                                                                                                              
        </table>                                                             
    </body>
<!-- BEGIN BODY -->
</html>
