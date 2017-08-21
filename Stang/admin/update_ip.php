 					<?php
extract($_POST);extract($_GET);extract($_REQUEST);
 $hostname_edoc = "127.0.0.1";
$database_edoc = "radius";
$username_edoc = "root";
$password_edoc = "System2002";
$connect_dbs= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc);
  mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
 mysql_select_db($database_edoc, $connect_dbs)  or trigger_error(mysql_error(),E_USER_ERROR);
 //print "update mikrotik_link  set gobal_ip='$gobal_ip'   where ip_vpn='$ip_vpn' ";
 $gobal_ip = htmlspecialchars("$gobal_ip", ENT_QUOTES);
 $pattern = '/;/i';
$replacement = NULL;
$gobal_ip= preg_replace($pattern, $replacement, $gobal_ip);
 mysql_query("update mikrotik_link  set gobal_ip='$gobal_ip'   where mk_id='$ip_vpn'  ", $connect_dbs);
 ?>
 <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
