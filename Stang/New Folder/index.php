<HTML>
<HEAD>
<TITLE>Login TLOG  Logsystem  เก็บ Log ตาม พรบ   90 วัน  ตามกฏหมาย IT</TITLE>
<style type="text/css"> 
<!-- 

a:link {text-decoration:none;} 
a:hover { text-decoration:underline;} 
a:active { text-decoration:underline;} 
a:visited { text-decoration:none;} 

//--> 
</style>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=tis-620">
</HEAD>
<BODY BGCOLOR=#FFFFFF LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>
<!-- ImageReady Slices (home2.psd) -->
<TABLE WIDTH=860 BORDER=0 CELLPADDING=0 CELLSPACING=0>
	<TR>
		<TD COLSPAN=7>
		<?php
include("Connections/conf.php");
 mysql_select_db($database_edoc, $connect_db)  or trigger_error(mysql_error(),E_USER_ERROR);
$sql = "select  *  from logo  where types='main'    "; // หากต้องการดึงเฉพาะ Reccord ใด Record หนึ่ง ให้ใช้คำสั่ง where id='$ตัวแปร'
$Recordset1 = mysql_query($sql, $connect_db) or trigger_error(mysql_error(),E_USER_ERROR);
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$logo= $row_Recordset1['logo'];
?>
			 <IMG SRC="<?php print  "$logo"; ?>" WIDTH=860 HEIGHT=171 ALT=""> 
			 </TD>
		<TD>
			<IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=171 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=3 ROWSPAN=2>
			<IMG SRC="images/home2_02.jpg" WIDTH=226 HEIGHT=65 ALT=""></TD>
		<TD ROWSPAN=4>
			<IMG SRC="images/home2_03.jpg" WIDTH=6 HEIGHT=387 ALT=""></TD>
		<TD>
			<IMG SRC="images/home2_04.jpg" WIDTH=24 HEIGHT=30 ALT=""></TD>
		<TD>
			<IMG SRC="images/home2_05.jpg" WIDTH=577 HEIGHT=30 ALT=""></TD>
		<TD>
			<IMG SRC="images/home2_06.jpg" WIDTH=27 HEIGHT=30 ALT=""></TD>
		<TD>
			<IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=30 ALT=""></TD>
	</TR>
	<TR>
		<TD ROWSPAN=2>
			<IMG SRC="images/home2_07.jpg" WIDTH=24 HEIGHT=1536 ALT=""></TD>
		
    <TD ROWSPAN=2 valign="top" background="images/home2_08.jpg"><div align="center"> 
        <p align="left">
          <?php
                               switch ($case_i) { 
                                                       
													  case 1:
															include("list_userdb.php");
															break;
													  case 2:
												          include("register.php");
															break;													   
													  case 3:
												          include("problem.php");
															break;													 
													  case 4:
												          include("frm_mail.php");
															break;
													 case 5:
												          include("clear_login.php");
														  break;																	 											 									
													 case 6:
												          include("active.php");
														  break;
										default:
														{	 include("main.php");  
														break;}
														}
														?>
        </p>
        </div></TD>
		<TD ROWSPAN=2>
			<IMG SRC="images/home2_09.jpg" WIDTH=27 HEIGHT=1536 ALT=""></TD>
		<TD>
			<IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=35 ALT=""></TD>
	</TR>
	<TR>
		<TD>
			<IMG SRC="images/home2_10.jpg" WIDTH=19 HEIGHT=1500 ALT=""></TD>
		
    <TD valign="top"> <table width="190" height="393" border="0">
        <tr> 
          <td height="195" valign="top"><p> <a href="#search" onClick="newwindow=window.open('http://<?php echo $HTTP_HOST; ?>:3990/prelogin','chillispot_popup','height=300,width=400,left=10,top=100,scrollbars=1');newwindow.focus();"> 
              <img src="images/login.gif" alt="คลิกเข้าสู่ระบบ" width="167" height="73" border="0" align="top"></a></p>
            <p><a href="index.php?case_i=2"><img src="images/register.gif" alt="สมัครเข้าใช้งาน" width="167" height="73" border="0"></a></p></td>
        </tr>
        <tr> 
          <td height="46" valign="middle"><a href="index.php?case_i=6"><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><img src="images/active.gif" width="87" height="84" border="0"></strong></font></a></td>
        </tr>
        <tr> 
          <td height="22" valign="middle"><div align="left"><a href="index.php?case_i=6"><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>เปิดการใช้งาน</strong></font></a></div></td>
        </tr>
        <tr> 
          <td height="29" valign="middle"><div align="left"><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=5"><strong>Clear 
              Login</strong></a></font></div></td>
        </tr>
        <tr> 
          <td height="29" valign="middle"><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><a href="index.php?case_i=4">ลืมรหัสผ่านคลิกที่นี่</a></strong></font></td>
        </tr>
        <tr> 
          <td valign="middle"><p align="left"><font color="#0000FF" size="2"><strong><font face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=3"> 
              รับแจ้งปัญหาการใช้งาน</a></font></strong></font></p></td>
        </tr>
      </table>
      <p align="left"><font color="#0000FF"><strong><a href="admin/">Administrator</a></strong></font></p></TD>
		<TD>
			<IMG SRC="images/home2_12.jpg" WIDTH=17 HEIGHT=1500 ALT=""></TD>
		<TD>
			<IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=295 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=3 ROWSPAN=2>
			<IMG SRC="images/home2_13.jpg" WIDTH=226 HEIGHT=29 ALT=""></TD>
		<TD>
			<IMG SRC="images/home2_14.jpg" WIDTH=24 HEIGHT=27 ALT=""></TD>
		<TD ROWSPAN=2>
			<IMG SRC="images/home2_15.jpg" WIDTH=577 HEIGHT=29 ALT=""></TD>
		<TD>
			<IMG SRC="images/home2_16.jpg" WIDTH=27 HEIGHT=27 ALT=""></TD>
		<TD>
			<IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=27 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=2>
			<IMG SRC="images/home2_17.jpg" WIDTH=30 HEIGHT=2 ALT=""></TD>
		<TD>
			<IMG SRC="images/home2_18.jpg" WIDTH=27 HEIGHT=2 ALT=""></TD>
		<TD>
			<IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=2 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=7>
			<IMG SRC="images/home2_19.jpg" WIDTH=860 HEIGHT=128 ALT=""></TD>
		<TD>
			<IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=128 ALT=""></TD>
	</TR>
</TABLE>
<?php

 $connect_db_syslog= mysql_connect($hostname_syslog, $username_syslog, $password_syslog) or trigger_error(mysql_error(),E_USER_ERROR); 
   mysql_select_db($database_syslog, $connect_db_syslog)  or trigger_error(mysql_error(),E_USER_ERROR);
$database_edoc="$database_syslog";
  mysql_select_db($database_edoc, $connect_db_syslog)  or trigger_error(mysql_error(),E_USER_ERROR);
$db  = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));

$db = date("Ymd", $db); 

 
 
 
$sql = "CREATE TABLE IF NOT EXISTS  log_$db  (
   host  varchar(32) default NULL,
  facility   varchar(10) default NULL,
   priority  varchar(10) default NULL,
   level  varchar(10) default NULL,
   tag  varchar(10) default NULL,
  datetime  datetime default NULL,
   program  varchar(15) default NULL,
  msg  text,
   seq  bigint(20) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (seq),
  KEY host (host),
  KEY  program (program),
  KEY  datetime (datetime),
  KEY  priority  (priority),
  KEY  facility (facility)
) ENGINE=InnoDB ;   ";
$dbquery = mysql_db_query($database_syslog, $sql) or trigger_error(mysql_error(),E_USER_ERROR);


$db  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));

$db = date("Ymd", $db); 

 
 
 
$sql = "CREATE TABLE IF NOT EXISTS  log_$db  (
   host  varchar(32) default NULL,
  facility   varchar(10) default NULL,
   priority  varchar(10) default NULL,
   level  varchar(10) default NULL,
   tag  varchar(10) default NULL,
  datetime  datetime default NULL,
   program  varchar(15) default NULL,
  msg  text,
   seq  bigint(20) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (seq),
  KEY host (host),
  KEY  program (program),
  KEY  datetime (datetime),
  KEY  priority  (priority),
  KEY  facility (facility)
) ENGINE=InnoDB ;   ";
$dbquery = mysql_db_query($database_edoc, $sql) or trigger_error(mysql_error(),E_USER_ERROR);



?>
<!-- End ImageReady Slices -->
</BODY>
</HTML>