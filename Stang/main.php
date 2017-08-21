<meta http-equiv="Content-Type" content="text/html; charset=windows-874">


<link href="css/style.css" rel="stylesheet" type="text/css">
	<?php
include_once('cache-kit.php');
  $cache_active = true; 
  $cache_folder = 'cache/';
# ดึงค่าจาก Cache จาก Key ชื่อ IndexKey ในช่วง 1000 วินาทีที่ผ่านมา
$newsss = acmeCache::fetch('newsss', 10); // 250 seconds
if(!$newsss){
	 include_once ("Connections/dbconnect.php");
	  mysql_select_db($database_db, $connect_db);
	   $query_Recordset1 = "SELECT   *   FROM   news    ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$newsss = $row_Recordset1[news];
# ฝังข้อมูลลงใน Key ที่ชื่อว่า IndexKey
acmeCache::save('newsss', $newsss);
}  
print   $newsss
?>


    
  

      