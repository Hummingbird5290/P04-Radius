<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body>
<?php
$hostname_edoc = "127.0.0.1";
$database_edoc = "radius";   
$username_edoc = "thaigqsoft";
$password_edoc = "logserver";

$connect_db= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc) or trigger_error(mysql_error(),E_USER_ERROR); 
    mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
 mysql_select_db($database_edoc, $connect_db)  or trigger_error(mysql_error(),E_USER_ERROR);
$sql = "select  *  from logo  where types='block'  "; // หากต้องการดึงเฉพาะ Reccord ใด Record หนึ่ง ให้ใช้คำสั่ง where id='$ตัวแปร'
$Recordset1 = mysql_query($sql, $connect_db) or trigger_error(mysql_error(),E_USER_ERROR);
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$logo= $row_Recordset1['logo'];
?>
<div align="center"><IMG SRC="<?php print  "$logo"; ?>" > </div>
</body>
</html>
