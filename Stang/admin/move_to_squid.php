<?php    
 
 include("config.php");
  include("$PATH_INSTALL/Connections/dbconnect.php");

$connect_db_syslog=consyslog();
$database_edoc="syslog";
  mysql_select_db($database_edoc); mysql_query($connect_db_syslog)  or trigger_error(mysql_error(),E_USER_ERROR);
$db  = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));

 
############# Åº  system mÕèäÁèà¡ÕèÂÇ¢éÍ§·Ôé§à¾×èÍÅ´»ÃÔÁ³¢éÍÁÙÅÅ§ 

 $sql = " DELETE FROM    log_$db    WHERE    program = '/USR/SBIN/CRON'   or  program= 'CRON'   or  program= 'snmpd'   or  DECODE(msg,'thaigqsoft')   like  '%layer7: couldn%'    or   DECODE(msg,'thaigqsoft')  like '%get conntrack%'   ";
mysql_select_db($database_edoc);  $dbquery = mysql_query($sql) or trigger_error(mysql_error(),E_USER_ERROR);

 $sql = " DELETE FROM  log_$db   WHERE  priority  like '%warning%' ";
mysql_select_db($database_edoc);  $dbquery = mysql_query($sql) or trigger_error(mysql_error(),E_USER_ERROR);

 $sql = " DELETE FROM  log_$db   WHERE  program='named' ";
mysql_select_db($database_edoc);  $dbquery = mysql_query($sql) or trigger_error(mysql_error(),E_USER_ERROR);

 $sql = " DELETE FROM  log_$db   WHERE  program='sudo' ";
mysql_select_db($database_edoc);  $dbquery = mysql_query($sql) or trigger_error(mysql_error(),E_USER_ERROR);


 $sql = " DELETE FROM  log_$db   WHERE   priority  like  '%err%' ";
mysql_select_db($database_edoc);  $dbquery = mysql_query($sql) or trigger_error(mysql_error(),E_USER_ERROR);

 $sql = " DELETE FROM  log_$db   WHERE  facility='mail' ";
mysql_select_db($database_edoc);  $dbquery = mysql_query($sql) or trigger_error(mysql_error(),E_USER_ERROR);

 $sql = " DELETE FROM    log_$db    WHERE     DECODE(msg,'thaigqsoft')   like  '%get conntrack%'   and   DECODE(msg,'thaigqsoft')   like  '%layer7%'  ";
mysql_select_db($database_edoc);  $dbquery = mysql_query($sql) or trigger_error(mysql_error(),E_USER_ERROR);

$sql = " DELETE FROM    log_$db    WHERE       priority = 'err'  ";
mysql_select_db($database_edoc);  $dbquery = mysql_query($sql) or trigger_error(mysql_error(),E_USER_ERROR);

 $sql = " DELETE FROM    log_$db    WHERE    program = 'snmpd'        ";
mysql_select_db($database_edoc);  $dbquery = mysql_query($sql) or trigger_error(mysql_error(),E_USER_ERROR);
############# òòòòòòòòòòòòòòòòòòòòòòòòòòòòòòòòò

$sql = "CREATE TABLE IF NOT EXISTS  proxy_$db  (
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
) ENGINE=InnoDB;    ";
mysql_select_db($database_edoc);  $dbquery = mysql_query($sql) or trigger_error(mysql_error(),E_USER_ERROR);
 
$sql = "insert into   proxy_$db  
                                  select  *  from  log_$db  where  program ='squid'    ";
mysql_select_db($database_edoc);  $dbquery = mysql_query($sql) or trigger_error(mysql_error(),E_USER_ERROR);
if($dbquery) {
 
$sql = " DELETE FROM    log_$db    WHERE program ='squid'  ";
mysql_select_db($database_edoc);  $dbquery = mysql_query($sql) or trigger_error(mysql_error(),E_USER_ERROR);
}

#################################·Ó view ÊÓËÃÑº ´ÙÇÔÇ ºÔµ
$sql = "CREATE TABLE IF NOT EXISTS   list_bit_$db   (
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
) ENGINE=InnoDB;    ";
mysql_select_db($database_edoc);  $dbquery = mysql_query($sql) or trigger_error(mysql_error(),E_USER_ERROR);

 
 

$sql = "insert into list_bit_$db
                                 SELECT *  FROM   log_$db   where DECODE(msg,'thaigqsoft')   like '%torrent%'     and   program != 'squid'       ";
mysql_select_db($database_edoc);  $dbquery = mysql_query($sql) or trigger_error(mysql_error(),E_USER_ERROR);
 
$sql = " DELETE FROM    log_$db    where DECODE(msg,'thaigqsoft')   like '%torrent%'     and   program != 'squid'    ";
mysql_select_db($database_edoc);  $dbquery = mysql_query($sql) or trigger_error(mysql_error(),E_USER_ERROR);
 

 
?>
 <meta http-equiv="Content-Type" content="text/html; charset=windows-874">