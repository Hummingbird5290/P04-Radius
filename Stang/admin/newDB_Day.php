<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<?php
 
 include("config.php");
 include("$PATH_INSTALL/Connections/dbconnect.php");

 $connect_db_syslog= mysql_connect($hostname_syslog, $username_syslog, $password_syslog) or trigger_error(mysql_error(),E_USER_ERROR); 
   mysql_select_db($database_syslog, $connect_db_syslog)  or trigger_error(mysql_error(),E_USER_ERROR);
$database_edoc="syslog";
  mysql_select_db($database_edoc); mysql_query($connect_db_syslog)  or trigger_error(mysql_error(),E_USER_ERROR);
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
) ENGINE=MyISAM DEFAULT CHARSET=tis620;   ";
 mysql_select_db($database_edoc); $dbquery =mysql_query($sql) or trigger_error(mysql_error(),E_USER_ERROR);


 
echo  " CREATE TABLE  log_$db";
?>
 