<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=tis-620">
<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
 include("conf.php");
 


 
 ########## PATH  INSTALL Program ########
 $PATH_INSTALL="/var/www"; 
 
 
 
 
if (!function_exists('consyslog')) {
function consyslog() {
	
 global $username_syslog, $password_syslog,$hostname_syslog;
	 
 
$database_syslog = "syslog";   
 
$connect_db_syslog= mysql_connect($hostname_syslog, $username_syslog, $password_syslog) or trigger_error(mysql_error(),E_USER_ERROR); 
  mysql_select_db($database_syslog, $connect_db_syslog)  or trigger_error(mysql_error(),E_USER_ERROR);
    mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
  return $connect_db_syslog;
  }
}
  
  
  if (function_exists('CutLongText')) {
  function CutLongText($text,$num){      //(ข้อความ,จำนวนตัวอักษร)
	if ( strlen($text) > $num ) 
	{
		return $text = substr($text,0,$num)."...";
	} else {
		return $text;
	};
}
                       }
?>