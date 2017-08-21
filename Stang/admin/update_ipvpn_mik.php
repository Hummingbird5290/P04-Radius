<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<?php
 ini_set('date.timezone ', 'Asia/Bangkok');
$hostname_edoc = "127.0.0.1";
$database_edoc = "radius";
$username_edoc = "root";
$password_edoc = "System2002";
$connect_db= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc);
$bbb=date("Y-m-d H:i:s");
  mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
 mysql_select_db($database_edoc, $connect_db)  or trigger_error(mysql_error(),E_USER_ERROR);
 
 $imk=$_GET[imk];
 $mid=$_GET[mid];
 $div = explode('/',$imk);
 $imk=$div[0];
 
 $NOWS=date("Y-m-d H:i:s");

 mysql_select_db($database_edoc) or trigger_error(mysql_error(),E_USER_ERROR);
 $query_Recordset1ccc = " update mikrotik_link set  ip_vpn='$imk'  ,status='1' ,lastupdate='$NOWS' where mk_id='$mid'  ";
$Recordset1ccc = mysql_query($query_Recordset1ccc, $connect_db) or die(mysql_error());
 
echo "$imk";
?>
 
