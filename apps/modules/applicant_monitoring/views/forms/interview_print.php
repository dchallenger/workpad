<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html lang="en">
    <!-- BEGIN HEAD-->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title></title>
        <style>
            body, p
            {
                font-weight: normal;
                font-size: 12px;
            }
        </style>
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body bgcolor="#ffffff" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" style="-webkit-font-smoothing: antialiased; width: 100% !important; -webkit-text-size-adjust: none;">
        <p align="center"><img src="{{logo}}"></p><br>

        <p align="center">INTERVIEW EVALUATION FORM</p><br>

        <table align='center' cellpadding="2px" cellspacing="0" style='width: 100%; height: auto; background: #fff'> 
            <tr>
                <td colspan="6" style="border: 1px solid #000;"><b>Personal Information</b></td>
            </tr>
            <tr>
                <td style="border-left: 1px solid #000;border-bottom: 1px solid #000;border-right: 1px solid #000;"><b>First Name</b></td>
                <td style="border-bottom: 1px solid #000;border-right: 1px solid #000;"><b>Middle Initial</B></td>
                <td colspan="2" style="border-bottom: 1px solid #000;border-right: 1px solid #000;"><b>Last Name</b></td>
                <td colspan="2" style="border-bottom: 1px solid #000;border-right: 1px solid #000;"><b>Nickname</b></td>
            </tr>
            <tr>
                <td style="border-left: 1px solid #000;border-bottom: 1px solid #000;border-right: 1px solid #000;">{{firstname}}</td>
                <td style="border-bottom: 1px solid #000;border-right: 1px solid #000;">{{middleinitial}}</td>
                <td colspan="2" style="border-bottom: 1px solid #000;border-right: 1px solid #000;">{{lastname}}</td>
                <td colspan="2" style="border-bottom: 1px solid #000;border-right: 1px solid #000;">{{nickname}}</td>
            </tr>
            <tr>
                <td style="border-left: 1px solid #000;border-bottom: 1px solid #000;border-right: 1px solid #000;"><b>Position Applied For:</b></td>
                <td colspan="5" style="border-bottom: 1px solid #000;border-right: 1px solid #000;">{{position}}</td>
            </tr>
            <tr>
                <td style="border-left: 1px solid #000;border-bottom: 1px solid #000;border-right: 1px solid #000;"><b>Competency</b></td>
                <td colspan="5" style="border-bottom: 1px solid #000;border-right: 1px solid #000;" align="center"><b>Rating Scale</b></td>
            </tr>
            <tr>
                <td style="width:25%;border-left: 1px solid #000;border-right: 1px solid #000;">&nbsp;</td>
                <td style="width:15%;border-bottom: 1px solid #000;border-right: 1px solid #000;" align="center"><b>1 <br> Well Below Standard</b></td>
                <td style="width:15%;border-bottom: 1px solid #000;border-right: 1px solid #000;" align="center"><b>2 <br> Below Standard</b></td>
                <td style="width:15%;border-bottom: 1px solid #000;border-right: 1px solid #000;" align="center"><b>3 <br> Meets Standard</b></td>
                <td style="width:15%;border-bottom: 1px solid #000;border-right: 1px solid #000;" align="center"><b>4 <br> Above Standard</b></td>
                <td style="width:15%;border-bottom: 1px solid #000;border-right: 1px solid #000;" align="center"><b>5 <br> Well Above Standard</b></td>
            </tr>
            <tr>
                <td style="width:25%;border-left: 1px solid #000;border-bottom: 1px solid #000;border-right: 1px solid #000;">&nbsp;</td>
                <td style="width:15%;border-bottom: 1px solid #000;border-right: 1px solid #000;" align="center"><b>Score</b></td>
                <td colspan="2" style="width:15%;border-bottom: 1px solid #000;border-right: 1px solid #000;" align="center"><b>HR Comments</b></td>
                <td colspan="2" style="width:15%;border-bottom: 1px solid #000;border-right: 1px solid #000;" align="center">Date : {{interviewer_date}}</td>
            </tr>
            {{comments}}
            <tr>
                <td style="width:25%;border-left: 1px solid #000;border-bottom: 1px solid #000;border-right: 1px solid #000;"><b>Total Score</b><br> (Passing Score: 10)</td>
                <td style="width:15%;border-bottom: 1px solid #000;border-right: 1px solid #000;" align="center">{{total_score}}</td>
                <td style="border-bottom: 1px solid #000;border-right: 1px solid #000;" colspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td style="width:25%;border-left: 1px solid #000;border-bottom: 1px solid #000;border-right: 1px solid #000;"><b>Results</b></td>
                <td colspan="5" style="width:15%;border-bottom: 1px solid #000;border-right: 1px solid #000;">&nbsp;&nbsp;{{recommendation}}</td>
            </tr>
            <tr>
                <td style="width:25%;border-left: 1px solid #000;border-bottom: 1px solid #000;border-right: 1px solid #000;"><b>Other Comments</b></td>
                <td colspan="5" style="width:15%;border-bottom: 1px solid #000;border-right: 1px solid #000;">&nbsp;&nbsp;{{remarks}}</td>
            </tr>
            <tr>
                <td style="width:25%;border-left: 1px solid #000;border-bottom: 1px solid #000;border-right: 1px solid #000;"><b>Interviewer Name and Signature</b></td>
                <td colspan="5" style="width:15%;border-bottom: 1px solid #000;border-right: 1px solid #000;">&nbsp;&nbsp;{{interviewer}}</td>
            </tr>            
        </table>       
    </body>
<!-- BEGIN BODY -->
</html>
