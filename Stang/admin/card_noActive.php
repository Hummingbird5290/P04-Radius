
<?php include("../include/chklogin.php");

header("Content-Type: application/vnd.ms-excel");    header("Content-Disposition: attachment; filename=�ѵ÷���ѧ����ա��������Թ.xls") ;


header("Pragma: no-cache");
header("Expires: 0");
include("../Connections/dbconnect.php");
include("../include/function.php");
mysql_select_db($database_db, $connect_db);





?>
<html>
<head>
<title>��§ҹ���촷���ѧ����ա����ҹ</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">


<body bgcolor="#FFFFFF">

	<div align="center">
		<font size="4" face="MS Sans Serif, Tahoma, sans-serif"><strong>��§ҹ���촷���ѧ����ա����ҹ
		</strong> </font>
	</div>
	<br>
	<center>
		<font size="2" face="MS Sans Serif, Tahoma, sans-serif">
			<table width="84%" border="1" bordercolor="#000000">
				<tr bgcolor="#FFFFCC">
					<td width="19%"><div align="center">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>�ӴѺ</strong>
							</font>
						</div></td>
					<td width="23%"><div align="center">
							<font size="2"><strong><font
									face="MS Sans Serif, Tahoma, sans-serif">�����Ţ����</font> </strong>
							</font>
						</div></td>
					<td width="14%"><div align="center">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>�����</strong>
							</font>
						</div></td>
					<td width="34%"><div align="center">
							<font size="2"><strong><font
									face="MS Sans Serif, Tahoma, sans-serif">�ӹǹ�ѹ����˹������к�</font>
							</strong> </font>
						</div></td>
					<td width="18%"><font size="2"
						face="MS Sans Serif, Tahoma, sans-serif"><strong>�ѹ�������(�������)</strong>
					</font></td>
					<td width="18%"><div align="center">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>�ѹ�������</strong>
							</font>
						</div></td>
					<td width="27%"><div align="center">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>�ѹ������ҧ�ѵ�</strong>
							</font>
						</div></td>
					<td width="11%"><div align="center">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>�Ҥ�</strong>
							</font>
						</div></td>
				</tr>
				<?php

				mysql_select_db($database_db, $connect_db);

				$query_user = "SELECT * FROM card    where      active='0'   and domain='$domain_name'  ";
				$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
				$row_user = mysql_fetch_assoc($user_db);
				$totalRows_user= mysql_num_rows($user_db);

				if($totalRows_user==0  or $totalRows_user==null) {
					echo "�ѧ����բ����� �����Ţ������к� ";
				} else {

					do{
						?>
				<tr bgcolor="#99FFFF">
					<td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php print   $row_user[No];?>
					</font></td>
					<td><div align="center">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php print   $row_user[idcard];?>&nbsp;&nbsp;</font>
						</div></td>
					<td><div align="center">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php print   $row_user[GroupName];?>
							</font>
						</div></td>
					<td height="18"><div align="right">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp; <?php  
							if($row_user[type_time]=="�ѹ")  {  print $row_user[date_end];  }  
							if($row_user[type_time]=="�������"){  $g=($row_user[date_end]/60)/60;   print $g;} 
							if($row_user[type_time]=="�ҷ�"){  $g=($row_user[date_end]/60);   print $g;} ?>
								&nbsp;<strong> <?php  print $row_user[type_time]; ?>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> </font>
						</div></td>
					<td><div align="center">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>
							<?php if($row_user[type_time]=="�ѹ") {  print $row_user[H_end]; } else  { echo "������������� ���������ǹ��� "; } ?>
							</strong> </font>
						</div></td>
					<td><div align="center">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php print   $row_user[time_death];?>
							</font>
						</div></td>
					<td><div align="center">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php print   $row_user[Time_build];?>
							</font>
						</div></td>
					<td><div align="center">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php print   $row_user[cost];?>
							</font>
						</div></td>
				</tr>
				<?php } while ($row_user = mysql_fetch_assoc($user_db)); 

 
  }
mysql_close($connect_db); ?>
			</table> </font>
	</center>

</body>
</html>
