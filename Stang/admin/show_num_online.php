<?php header('Content-type: text/html; charset=windows-874');
 include("../include/chklogin.php");
?>
<meta	http-equiv="Content-Type" content="text/html; charset=windows-874" />
<link	href="../css/style.css" rel="stylesheet" type="text/css">
<?php
include_once ("../Connections/dbconnect.php");
mysql_select_db($database_edoc);  //  or trigger_error(mysql_error(),E_USER_ERROR);
$days= date("d");
$days2= date("d")-1;
$mount = date("m");
$year_gp= date("Y");

$todays=date("Y-m-d");
$to22=date("d");  $to22=$to22-1;
$todays2=date("Y-m");
$todays2 .="-$to22";

$query_Recordset1 = "
SELECT 
		radacct.UserName,
       radacct.AcctStartTime,
       radacct.FramedIPAddress,
       register.fullname,
	    register.room ,
		radacct.UserName,
		 radacct.CalledStationId,
		 register.per  ,
		  register.site
 FROM radacct
     INNER JOIN register ON (radacct.UserName = register.UserName) 
	 where 
    AcctStopTime='0000-00-00 00:00:00' 
	and register.domain='$domain_name'
	   ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
//$row_Recordset1 = mysql_fetch_assoc($Recordset1);
?>
<font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
<a  href="List_user_online_now.php?lan=10.0." target="_blank">ผู้ที่ออนไลน์-ขณะนี้<?php
 

if($_GET[a]==1)  {
print ' [ '.$totalRows_online= mysql_num_rows($Recordset1).'<img src="../images/login_user.gif" width="17"
	height="17" > คน ]';
 } 
 if($_GET[a]==2)  {
	 print ' [ '.$totalRows_online= mysql_num_rows($Recordset1).'<img src="../images/login_user.gif" width="17"
	height="17" > คน ]   ';
	 print 'update time  '.date('H:i:s');
 }
  ?></a> </font>
