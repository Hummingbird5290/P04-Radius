<?php    
 include("config.php");
  include("$PATH_INSTALL/Connections/dbconnect.php");

mysql_select_db("radius", $connect_db)
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

<body background="images/bg1.gif">
<font size="2" face="MS Sans Serif, Tahoma, sans-serif">
<?php


 
 
 
$sql="TRUNCATE  `temp_login` ";  //��ҧ�������������͡��͹
$db_query= mysql_query($sql, $connect_db) or die(mysql_error()); 

 
//$mdate1="2008-06-14";
$query_user = "SELECT  *  FROM   radcheck    group by   UserName   order by  UserName       ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$totalRows_user= mysql_num_rows($user_db);

 
 
$count_files=0;
 	do {   
 // echo $row_user['UserName'];
   $chk_char=$row_user['UserName'];
   $chk_char_F=substr($chk_char,0,1);  //�Ѵ��ҵ���ѡ�õ���á��
   $mdate1 = date("Ymd"); 
 
   //�֧������ �����Ұҹ�������������дǡ
  $filetempname="$PATH_INSTALL/admin/radius-report/$chk_char_F/$chk_char.html";
 
  if(is_file($filetempname)){   //��Ǩ�ͺ��� ����ը�ԧ�������
  
$fp = fopen($filetempname,"r");
$data = fread($fp,filesize($filetempname));
fclose($fp);
$data = addslashes($data);
 
#################################################
############�ѹ�֡ŧ�ҹ������ ##########################
$sql="insert into temp_login(UserName,data) values ('$chk_char','$data')";
$db_query= mysql_query($sql, $connect_db) or die(mysql_error());
   if($db_query)  {echo " $filetempname\n"; }
   $count_files++;
         } //��Ǩ�ͺ���
		 
		 
	} while ($row_user = mysql_fetch_assoc($user_db));  
	
	print "<br> $count_files ";
	?>
 

 </font>
<?php  
mysql_close($connect_db);
?>
</body>
</html>
