<?php   
  include("../include/chklogin.php");   
 header("Content-Type: application/msword");    header("Content-Disposition: attachment; filename=report.doc") ;
 

 header("Pragma: no-cache");
 header("Expires: 0");
                include("../Connections/dbconnect.php");
				include("../include/function.php");
				mysql_select_db($database_db, $connect_db);

 

$mdate_DAY1 = date("F");  
$mdate_DAY2= date("Y"); 
 

?>
<html>
<head>
<title>��§ҹ��������ҹ��Ш���͹</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">


<body bgcolor="#99CCFF" >


  
    <?php

 
 
$mdate_DAY = date("Y-m");  
$mount= date("m")-1;  
$year_gp= date("Y");  
mysql_select_db($database_db, $connect_db);

if($mount==1) {  $mount_text="���Ҥ�";  }
if($mount==2) {  $mount_text="����Ҿѹ��";  }
if($mount==3) {  $mount_text="�չҤ�";  }
if($mount==4) {  $mount_text="����¹";  }
if($mount==5) {  $mount_text="����Ҥ�";  }
if($mount==6) {  $mount_text="�Զع�¹";  }
if($mount==7) {  $mount_text="�á�Ҥ�";  }
if($mount==8) {  $mount_text="�ԧ�Ҥ�";  }
if($mount==9) {  $mount_text="�ѹ��¹";  }
if($mount==10) {  $mount_text="���Ҥ�";  }
if($mount==11) {  $mount_text="��Ȩԡ�¹";  }
if($mount==12) {  $mount_text="�ѹ�Ҥ�";  }

  $query_user = "SELECT * FROM  card   where          MONTH(time_active)='$mount'   and 	YEAR(time_active)='$year_gp'   ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$totalRows_user= mysql_num_rows($user_db);
$i_counts=0;
if($totalRows_user==0  or $totalRows_user==null) {
echo "����բ����š�������ҹ ";
}  else {  ?> 
<div align="center"><?php print "<b>��§ҹ��â�ºѵ� ��Ш� ��͹ $mount_text   �� $year_gp "; ?> </div><br>
<center><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
 <table width="66%" border="0">
    <tr bgcolor="#FFFFCC">
      <td width="6%"><strong><font size="1" face="MS Sans Serif, Tahoma, sans-serif">�ӴѺ</font></strong></td>
      <td width="31%"><div align="center"><strong><font size="1" face="MS Sans Serif, Tahoma, sans-serif">�����Ţ�ѵ�</font></strong></div></td>
      <td width="20%"><div align="center"><strong><font size="1" face="MS Sans Serif, Tahoma, sans-serif">�ӹǹ����</font></strong></div></td>
      <td width="43%"><div align="center"><strong><font size="1" face="MS Sans Serif, Tahoma, sans-serif">�Ҥ�</font></strong></div></td>
    </tr>
    <?php  do { ?>
    <tr bgcolor="#99FFFF">
      <td><?php print   $i_counts;?></td>
      <td height="18"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">&nbsp; 
        <?php  print $row_user[idcard]; ?>
        </font></td>
      <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> &nbsp; 
        <?php    if($row_user[type_time]=="�ѹ")              {  print $row_user[date_end];  }  
		                if($row_user[type_time]=="�������")       {  $g=($row_user[date_end]/60)/60;   print $g;} 
						   if($row_user[type_time]=="�ҷ�")       {  $g=($row_user[date_end]/60);   print $g;} 
                           ?>&nbsp;<?php print $row_user[type_time]; ?>
        </font></td>
      <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> &nbsp; 
        <?php  print $row_user[cost]; ?>
        </font></td>
    </tr>
    <?php
	$i_counts++;
	} while ($row_user = mysql_fetch_assoc($user_db)); 

 
  }
mysql_close($connect_db); ?>
  </table>
</font>
</center>

</body>
</html>
