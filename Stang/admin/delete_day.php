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
//���ص��ѹ����� �ѹ��� 28 ��͹ 5 �� 2007 ����¹����� 

//date("Y-m-d", mktime(0, 0, 0, 05, 28-10, 2007)); 

//�ѧ���蹹����ӹǹ�ѹ�Ѻ������ data type ������ date, timestamp ����ҹ�� �ҡ�س�ա�äӹǹ�ѹ������� ���й������� fortmat �ٻẺ�� timestamp �Ѻ��
$year=date("Y");
$mont=date("m");
$day=date("d");

 
$data= date("Ymd", mktime(0, 0, 0, $mont, $day-100, $year)); 
$tb ="log_$data";
 $connect_db=consyslog();
//check  ���  tbl �ը�ԧ�������  
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
