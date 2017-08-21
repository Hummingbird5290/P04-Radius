<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body>
<?php
function rmdirr($dirname)
{
    // Sanity check
    if (!file_exists($dirname)) {
        return false;
    }

    // Simple delete for a file
    if (is_file($dirname) || is_link($dirname)) {
        return unlink($dirname);
    }

    // Loop through the folder
    $dir = dir($dirname);
    while (false !== $entry = $dir->read()) {
        // Skip pointers
        if ($entry == '.' || $entry == '..') {
            continue;
        }

        // Recurse
        rmdirr($dirname . DIRECTORY_SEPARATOR . $entry);
    }

    // Clean up
    $dir->close();
    return rmdir($dirname);
}

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
)   DEFAULT CHARSET=tis620 COLLATE=tis620_bin;   ";


$dbquery = mysql_db_query("syslog", $sql) or trigger_error(mysql_error(),E_USER_ERROR);




for ($data_add_log=120; $data_add_log<=260; $data_add_log++)
{
 $db  = mktime(0, 0, 0, date("m")  , date("d")-$data_add_log, date("Y"));
 $db2 = date("Y-m-d", $db);
 $db = date("Ymd", $db); 

@unlink("/var/www/log/log_$db.sql.gz");
//Tlog_
@unlink("/var/www/log/Tlog_$db.sql.gz");
 
 $lightsquid="/var/www/lightsquid/report/$db";
 rmdirr($lightsquid);
print "<br>\r\n";


@mysql_db_query("radius", " delete  from radacct where AcctStartTime > '$db2 00:00:00' ") ;
@mysql_db_query("syslog", " drop tables log_$db ");
 
#print " delete  from radacct where AcctStartTime > '$db2 00:00:00' ";
}
?>
</body>
</html>

