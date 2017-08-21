 
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
 <table width="800" border="0" class="imagetable">
  <tr>
    <th>Login Name</th>
    <th>Domain</th>
    <th>IP</th>
   <th>หน้า</th>
  </tr>
 <?php
    include("../include/chklogin.php");
 
$hostname_edoc = "127.0.0.1";
$database_edoc = "radius";
$username_edoc = "root";
$password_edoc = "System2002";
$connect_db2= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc);
if(!$connect_db2){
 echo 'ไม่สามารถเชือมต่อฐานข้อมูลได้ ';
 exit();
}
   mysql_query("SET character_set_results=tis620", $connect_db2) or die(mysql_error());
    mysql_query("SET character_set_client=tis620", $connect_db2) or die(mysql_error());
    mysql_query("SET character_set_connection=tis620", $connect_db2) or die(mysql_error());
    mysql_query("SET collation_connection = tis620_thai_ci", $connect_db2) or die(mysql_error());
    mysql_query("SET collation_database = tis620_thai_ci", $connect_db2) or die(mysql_error());
    mysql_query("SET  collation_server = tis620_thai_ci", $connect_db2) or die(mysql_error());
	 mysql_select_db($database_edoc, $connect_db2)  or trigger_error(mysql_error(),E_USER_ERROR);
 
 print 'Admin online ==>';			
 
	  $query_adminonline = "select  uname,domain,ips,case_i from  admin_online   ";
$Recordset_admin_online = mysql_query($query_adminonline, $connect_db) or die(mysql_error());
$row_Recordset_adminonline= mysql_fetch_assoc($Recordset_admin_online);			
	do{
	?>
	  <tr>
    <td><div align="center"><?php print $row_Recordset_adminonline[uname];?></div></td>
    <td><div align="center"><?php print $row_Recordset_adminonline[domain];?></div></td>
    <td><div align="center"><?php print $row_Recordset_adminonline[ips];?></div></td>
   <td><div align="center"><a href="index.php?case_i=<?php print $row_Recordset_adminonline[case_i];?>"><?php print $row_Recordset_adminonline[case_i];?> </a></div></td>
  </tr>
  <?php 
  //print "$row_Recordset_adminonline[uname] ($row_Recordset_adminonline[domain]-$row_Recordset_adminonline[ips],$row_Recordset_adminonline[case_i] )<br>";
 } while ($row_Recordset_adminonline = mysql_fetch_assoc($Recordset_admin_online)); 			
 ?>
</table>
