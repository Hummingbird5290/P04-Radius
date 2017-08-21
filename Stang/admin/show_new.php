<?php
ob_start();
@session_start(); 
extract($_POST);extract($_GET);extract($_REQUEST);
include("../Connections/dbconnect.php");
?>
 <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
 <?php
 $query_Recordset1 = "SELECT   *   FROM news   where domain='$domain_name'  ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
print $row_Recordset1[news];
?>
