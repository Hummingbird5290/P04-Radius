<?php   
    include("../include/chklogin.php");   
 
 header("Content-Type: application/vnd.ms-excel"); 
   header("Content-Disposition: attachment; filename=report.xls") ;
 header("Pragma: no-cache");
 header("Expires: 0");
 
                include("../Connections/dbconnect.php");
				include("../include/function.php");
				mysql_select_db($database_db, $connect_db);

 

$mdate_DAY1 = date("F");  
$mdate_DAY2= date("Y"); 
 mysql_select_db("syslog", $connect_db)  or trigger_error(mysql_error(),E_USER_ERROR);
//$date_view=preg_replace("-", null, $date_view);
$date_view = preg_replace("/-/i", "", $date_view);
$MM=base64_decode($MM);
$tb="log_$date_view";
$sql_cms ="SELECT host,       facility,       priority,       level,      tag,     datetime,       program,        DECODE(msg,'thaigqsoft')   as msg  ,       seq    FROM   $tb  
		                  where   $MM  and host='$host'  	 ";

$Recordset1 = mysql_query($sql_cms, $connect_db)  or trigger_error(mysql_error(),E_USER_ERROR);
$result_data = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

 $nuu=0;

?>
<html>
<head>
<title>รายงานการเข้าใช้งานประจำเดือน</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">


<body bgcolor="#99CCFF" >
 
<div align="center"><?php print "<b>รายงาน Log </b> "; ?> </div><br>
<center>
  <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> </font>
  <table width="2048" border="1" align="left" cellpadding="1" cellspacing="1" bgcolor="#FFFFCC">
    <tr bgcolor="#AFFFFF"> 
      <td colspan="5"> <div align="center" class="style1 style2"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">Log 
          System </font></strong></div></td>
    </tr>
    <tr bgcolor="#AFFFFF"> 
      <td width="6%"> <div align="center" class="style3"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ลำดับ</strong></font></div></td>
      <td width="9%" align="center" bgcolor="AFFFFF"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Server</strong></font></div></td>
      <td width="9%" align="center" bgcolor="AFFFFF"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><span class="style3">Program 
        </span></font></strong></td>
      <td width="12%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">เวลา</font></strong></td>
      <td width="64%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">Log 
        Msg </font></strong></td>
    </tr>
	<? do { ?>
    <tr   > 
      <td align="center"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
      <?php print $nuu; ?>
        .&nbsp;</font></td>
      <td  ><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> &nbsp;<? print $result_data[host];?> 
        </font></td>
      <td height="21"  ><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          <? print $result_data[program];?> </font></div></td>
      <td><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><? print $result_data[datetime];?></font></div></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;
	  <? 
$word=$result_data[msg];  
 
print  $word;
	  ?></font></td>
    </tr>
   <?php
   $nuu++;
    } while ($result_data = mysql_fetch_assoc($Recordset1)); 
	
	
	print  $query_Recordset1;?> 
  </table>
</center>

</body>
</html>
