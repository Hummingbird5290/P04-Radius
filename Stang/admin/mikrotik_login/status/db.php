<?php
$hostname_edoc = "127.0.0.1";
$database_edoc = "radius";   
$username_edoc = "root";
$password_edoc = "System2002";

$connect_db= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc);
    mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");

 mysql_select_db($database_edoc, $connect_db)  or trigger_error(mysql_error(),E_USER_ERROR);
 ?>
