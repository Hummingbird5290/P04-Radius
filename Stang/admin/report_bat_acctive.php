<?php   
  include("../include/chklogin.php");  
 header("Content-Type: application/vnd.ms-excel");    header("Content-Disposition: attachment; filename=�ѵ÷���ա��������Թ����.xls") ;
 

 header("Pragma: no-cache");
 header("Expires: 0");
 
                include("../Connections/dbconnect.php");
				include("../include/function.php");
				mysql_select_db($database_db, $connect_db);

$mounts=date("d-M-Y");
$mount=date("m");
$year_gp=date("Y");

 

?>
<html>
<head>
<title>��§ҹ���촷����ա����ҹ</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">


<body bgcolor="#FFFFFF" >

<div align="center"><strong><font size="4" face="MS Sans Serif, Tahoma, sans-serif">��¡��촷���ա�� 
  Active ���� &nbsp;
  <?php  print $dstart ;?>&nbsp;�֧
    <?php  print $dstop; ?>
  </font> </strong></div>
<br>
<center><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
  <table width="1053" border="1" bordercolor="#000000">
    <tr bgcolor="#FFFFCC"> 
      <td width="19%"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>�ӴѺ</strong></font></div></td>
      <td width="19%"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>�����Ţ����</strong></font></div></td>
      <td width="27%"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>�ӹǹ�ѹ����˹������к�</strong></font></div></td>
      <td width="14%"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>�ѹ�������Թ</strong></font></div></td>
      <td width="13%"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>�������������</strong></font></td>
      <td width="13%"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>�����ҹ������</strong></font></div></td>
      <td width="35%"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>�Ҥ�</strong></font></div></td>
      <td width="27%"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>�ѹ������ҧ�ѵ�</strong></font></div></td>
      <td width="27%"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>�ѹ������ء����ҹ�ͧ�����</strong></font></div></td>
    </tr>
    <?php

 mysql_select_db($database_db, $connect_db);
    $dstart = htmlspecialchars("$dstart", ENT_QUOTES);
	    $dstop = htmlspecialchars("$dstop", ENT_QUOTES);
$query_user = "SELECT 
							  register.fullname,
							  card.*,
							  radcheck.Attribute,
							  radcheck.Value
                      FROM
                              card
  INNER JOIN register ON (card.UserName = register.UserName)
  INNER JOIN radcheck ON (card.UserName = radcheck.UserName)
                                          where  card.active='1' 
										    and  radcheck.Attribute='Expiration'
and card.domain='$domain_name' 
											and 
											 card.time_active BETWEEN   '$dstart'  and  '$dstop'  ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$totalRows_user= mysql_num_rows($user_db);

if($totalRows_user==0  or $totalRows_user==null) {
echo "�ѧ����բ����� �����Ţ������к�";
} else {
 
do{
 ?>
    <tr bgcolor="#99FFFF"> 
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php print   $row_user[No];?></font></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php print   $row_user[idcard];?></font></td>
      <td height="18"><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp; 
          <?php if($row_user[type_time]=="�ѹ")  {  print $row_user[date_end];  }  
		             if($row_user[type_time]=="�������")  {  $g=($row_user[date_end]/60)/60;   print $g;}  
					 if($row_user[type_time]=="�ҷ�")  {  $g=($row_user[date_end]/60)/60;   print $g;}  
		  ?>
          &nbsp;<strong> 
          <?php  print $row_user[type_time]; ?>
          </strong> </font></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          <?php print   $row_user[time_active];?> </font></div></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <?php print   $row_user[GroupName];?> 
        </font></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          <?php print   $row_user[fullname];?> </font></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php print   $row_user[cost];?></font></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php print   $row_user[Time_build];?></font></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          <?php print   $row_user[Value];?> </font></div></td>
    </tr>
    <?php } while ($row_user = mysql_fetch_assoc($user_db)); 

 
  }
mysql_close($connect_db); ?>
  </table>
</font>
</center>
 
</body>
</html>
