<?php 
include("../include/chklogin.php");  
if($a=="word") { header("Content-Type: application/msword");    header("Content-Disposition: attachment; filename=report.doc");  header("Pragma: no-cache");   }
if($a=="excel") { header("Content-Type: application/vnd.ms-excel"); header("Content-Disposition: attachment; filename=report.xls"); header("Pragma: no-cache");    }
if($a !="excel"  and  $a !="word" ) {  header("Pragma: no-cache");    }


header("Expires: 0");
                include("../Connections/dbconnect.php");
				include("../include/function.php");
				mysql_select_db($database_db, $connect_db);
				if($UserName==NULL) { print 'กรุณา เลือกชื่อผู้ใช้เสียก่อน';  exit();}
?>
<html>
<head>
<title>รายงานการเข้าใช้งาน </title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
 <style type="text/css">
.styled-button-2 {
	-webkit-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	-moz-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	border-bottom-color:#333;
	border:1px solid #61c4ea;
	background-color:#7cceee;
	border-radius:5px;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	color:#333;
	font-family:'Verdana',Arial,sans-serif;
	font-size:14px;
	text-shadow:#b2e2f5 0 1px 0;
	padding:5px
}
</style>
<style type="text/css">

table.imagetable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #999999;
	border-collapse: collapse;
}
table.imagetable th {
	background:#b5cfd2 url('cell-blue.jpg');
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #999999;
}
table.imagetable td {
	background:#dcddc0 url('cell-grey.jpg');
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #999999;
}
</style>
<body bgcolor="#FFFFFF" ><be>
<?
  $UserName = htmlspecialchars("$UserName", ENT_QUOTES);
if($day=="00") {  $list_data_login="$year-$mount"; }  else  { $list_data_login="$year-$mount-$day"; }



if($UserName  !=NULL)  {   $uname= " where UserName  ='$UserName' and domain='$domain_name' ";  } else { $uname=" where domain='$domain_name'"; }
 $query_Recordset100 = "SELECT   UserName,fullname     FROM register       $uname      ";    
 

$Recordset100 = mysql_query($query_Recordset100, $connect_db) or die(mysql_error());
$row_Recordset100 = mysql_fetch_assoc($Recordset100);
 

  do { 

$id_edit=$row_Recordset100['UserName'];
$name=$row_Recordset100['fullname'];
?>
<div align="center"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">รายงานการเข้าใช้งาน<?php print $name; ?> 
  </font></strong></div>
<br>
<center><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
  <table width="1024" border="0"  class="imagetable">
    <tr> 
      <th width="14%" bgcolor="#6A90B5"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">หมายเลขไอพี</font></strong></div></th>
         <th width="16%" bgcolor="#6A90B5"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">Mikrotik Link</font></strong></div></th>
      <th width="20%" bgcolor="#6A90B5"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">เวลาเข้าใช้งาน</font></strong></div></th>
      <th width="26%" bgcolor="#6A90B5"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">เวลาเลิกใช้งาน</font></strong></div></th>
      <th width="24%" bgcolor="#6A90B5"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">Mac-Address</font></strong></div></th>
      <th width="27%" bgcolor="#6A90B5"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">AcctTerminateCause</font></strong></div></th>
      <th width="30%" bgcolor="#6A90B5"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">Mikrotik Address</font></strong></div></th>
    </tr>
    <?php
 
$query_user = "SELECT *  FROM   radacct  where  UserName='$id_edit'     and    AcctStartTime  like  '%$list_data_login%'    ";
 
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$totalRows_user= mysql_num_rows($user_db);

if($totalRows_user==0  or $totalRows_user==null) {
echo "ไม่มีข้อมูลการเข้าใช้งาน ";
} else {
 
  do { 
 ?>
    <tr bgcolor="#FFFFCC" > 
      <td height="18"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp; 
        <?php  print $row_user[FramedIPAddress]; ?>
        </font></td>
 	  
	  <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?php   print $row_user['CalledStationId'];?>
      </font></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?php   date_to_thai($row_user['AcctStartTime']);?>
      </font></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        
        <?php   date_to_thai($row_user['AcctStopTime']);?>
      </font></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <?php  print $row_user[CallingStationId]; ?></font></div></td>
     <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <?php  print $row_user[AcctTerminateCause]; ?></font></div></td>
   <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <?php  print $row_user[NASIPAddress]; ?></font></div></td>
    </tr>
    <?php } while ($row_user = mysql_fetch_assoc($user_db)); 

  }
?>
  </table>
  <br>
</font>
</center>
 <?php } while ($row_Recordset100 = mysql_fetch_assoc($Recordset100)); 
 mysql_close($connect_db); ?>
</body>
</html>
