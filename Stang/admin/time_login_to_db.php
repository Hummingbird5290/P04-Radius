<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body>

<?php // include("../include/chklogin.php");  
$hostname_edoc = "127.0.0.1";
$database_edoc = "radius";
$username_edoc = "root";
$password_edoc = "010464088";
$connect_db= mysql_pconnect($hostname_edoc, $username_edoc, $password_edoc) or trigger_error(mysql_error(),E_USER_ERROR); 

mysql_select_db("radius", $connect_db)
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

<body background="images/bg1.gif">
<font size="2" face="MS Sans Serif, Tahoma, sans-serif">
<?php


 
$sql="TRUNCATE  `temp_login` ";  //ล้างข้อมูลเดิมทิ้งออกก่อน
$db_query= mysql_query($sql, $connect_db) or die(mysql_error()); 

 
//$mdate1="2008-06-14";
$query_user = "SELECT  *  FROM   radcheck       order by  UserName       ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$totalRows_user= mysql_num_rows($user_db);

 
 
$count_files=0;
 	do {   
 // echo $row_user['UserName'];
   $chk_char=$row_user['UserName'];
   $chk_char_F=substr($chk_char,0,1);  //ตัดเอาตัวอักษรตัวแรกมา
   $mdate1 = date("Ymd"); 
 
   //ดึงข้อมูล ไฟลืเข้าฐานข้อมูลให้ค้นหาสะดวก
  $filetempname="/var/log/freeradius/radacct/127.0.0.1/detail-$mdate1";
 
  if(is_file($filetempname)){   //ตรวจสอบไฟล์ ว่ามีจริงหรือไม่
  
$fp = fopen($filetempname,"r");
$data = fread($fp,filesize($filetempname));
fclose($fp);
$data = addslashes($data);

    
		    $a_ip = explode("\n",$data) ;
           $count_group=count($a_ip);

for($i_count=0;$i_count<$count_group;$i_count++)
{

  echo "$i_count====="; print  $a_ip[$i_count];  echo "<br>";
}  
/*
#################################################
############บันทึกลงฐานข้อมูล ##########################
$sql="insert into temp_login(UserName,data) values ('$chk_char','$data')";
$db_query= mysql_query($sql, $connect_db) or die(mysql_error());
   if($db_query)  {echo " $filetempname\n"; }
   $count_files++;
 */	        } //ตรวจสอบไฟล์
		 
		 
	} while ($row_user = mysql_fetch_assoc($user_db));  

	print "<br> $count_files ";

 
 ?>
 </font>
<?php  
mysql_close($connect_db);
?>
</body>
</html>


