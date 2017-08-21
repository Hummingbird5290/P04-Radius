<?php    include("../include/chklogin.php");  
  if($_SESSION["adminpass"]!='tlog'){ 
 
exit();
 }
 ?> 
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body>
<?php	
//สมมุติวันนี้คือ วันที่ 28 เดือน 5 ปี 2007 จะเขียนได้ว่า 

//date("Y-m-d", mktime(0, 0, 0, 05, 28-10, 2007)); 

//ฟังก์ชั่นนี้ใช้คำนวนวันกับข้อมูล data type ประเภท date, timestamp ได้เท่านั้น หากคุณมีการคำนวนวันที่บ่อยๆ ผมแนะนำว่าให้ fortmat รูปแบบเป็น timestamp คับผม
$year=date("Y");
$mont=date("m");
$day=date("d");

 
$data= date("Ymd", mktime(0, 0, 0, $mont, $day-100, $year)); 
$tb ="log_$data";
 $connect_db=consyslog();
//check  ว่า  tbl มีจริงหรือไม่  
 include_once ("../Connections/dbconnect.php");
include_once("../include/function.php");
 if (!mysql_is_table($tb))  {   

 $query_user1="drop tables  $tb ";
 mysql_query($query_user1);
									           } else {  
 }





?>
</body>
</html>
