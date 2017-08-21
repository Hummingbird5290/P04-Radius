<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body>
<?php
$hostname_edoc = "127.0.0.1";
$database_edoc = "syslog";   
$username_edoc = "thaigqsoft";
$password_edoc = "logserver";

 $connect_db_syslog= mysql_connect($hostname_edoc, $username_edoc, $password_edoc) or trigger_error(mysql_error(),E_USER_ERROR); 

    mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
   
 
  mysql_select_db("syslog", $connect_db_syslog)  or trigger_error(mysql_error(),E_USER_ERROR);
  
#########ลบวันที่ เกินกำหนด

for($i=0;$i<=200;$i++)
{
	$count_d=$i+120;

	 
 
$db  = mktime(0, 0, 0, date("m")  , date("d")-$count_d, date("Y"));
$db = date("Ymd", $db); 
$sql = "drop table  log_$db   ";
 
$dbquery = mysql_query($sql, $connect_db_syslog);

 


}

$a=rand(0,10);
if($a==5){
	 mysql_select_db("tlog_huzzun", $connect_db_syslog)  or trigger_error(mysql_error(),E_USER_ERROR);
$rr="REPAIR TABLE  `access_point` ,  `admin` ,  `arp` ,  `badusers` ,  `block_mac` ,  `block_web` ,  `card` ,  `client_online` ,  `config` ,  `datasize` ,  `delete_user` ,  `firewall` ,  `frox` ,  `login_fail` ,  `login_pass` ,  `logo` ,  `macauthen` , `mtotacct` ,  `nas` ,  `news` ,  `question` ,  `radacct` ,  `radcheck` ,  `radgroupcheck` ,  `radgroupreply` ,  `radippool` ,  `radpostauth` ,  `radreply` ,  `register` ,  `server` ,  `server_status` ,  `seting` ,  `squid` , `squid_limit_download` ,  `table_card_user` ,  `temp_login` ,  `totacct` ,  `usergroup` ,  `userinfo` ";
 
$dbquery = mysql_query($rr, $connect_db_syslog);
}


mysql_close($connect_db_syslog);
?>
</body>
</html>
