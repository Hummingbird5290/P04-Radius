
<?php
include_once("../include/chklogin.php");

?>

<meta	http-equiv="Content-Type" content="text/html; charset=windows-874">
<link	href="../css/style.css" rel="stylesheet" type="text/css">

<table width="100%" border="0" align="left" class="imagetable">
	<?php if($_SESSION["adminpass"]=='tlog'){ ?>
	
	<tr>
		<th align="left" valign="top" bgcolor="#66CCFF"  ><div align="left"> 
		<font size="4" face="MS Sans Serif, Tahoma, sans-serif"> <img src="../images/users.png" alt="" width="22" height="22" /> 
		�������к��٧�ش		</font> </div></th>
	</tr>
	<?php
$query_Recordset_mk_online = " Select  count(user_mk_online) as t,sum(user_mk_online) as y ,sum(connects) as r  from  mikrotik_link  where   status='1' and ip_vpn <>'0'       ";
$Recordset1 = mysql_query($query_Recordset_mk_online, $connect_dbs) or die(mysql_error());
$row_Recordset_online_mk = mysql_fetch_assoc($Recordset1);
?>
			<tr>
		<td align="left" valign="top">
		<font size="2"  face="MS Sans Serif, Tahoma, sans-serif"> <a href="index.php?case_i=78">ALL  ONLINE </a>
		&nbsp;[<?php print $row_Recordset_online_mk[y] ;?>],[<?php print $row_Recordset_online_mk[r] ;?>]</font></td>
	</tr>
				<tr>
		<td align="left" valign="top">
		<font size="2"  face="MS Sans Serif, Tahoma, sans-serif"> <a href="index.php?case_i=81">Mikrotik_online </a>  </font></td>
	</tr>
	
		<tr>
		<td align="left" valign="top">
		<font size="2"  face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=79">��¡������Թ�ҡ�ѵ÷�ٷ���ѧ�����Ѵ�ʹ</a></font></td>
	</tr>
			<tr>
		<td align="left" valign="top">
		<font size="2"  face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=76">Admin online</a></font></td>
	</tr>

	
			<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=84">Profiles</a> </font></td>
	</tr>
			<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=85">��Ѻ���Ҽ��������ѵá�͹�������</a> </font></td>
	</tr>
	<?php } ?>
	<tr>
		<th align="left" valign="top" bgcolor="#66CCFF"  ><div align="left"> 
		<font size="4" face="MS Sans Serif, Tahoma, sans-serif"> <img src="../images/users.png" alt="" width="22" height="22" /> 
		�Ѵ�����Ҫԡ		</font> </div></th>
	</tr>
	<?php /* if($domain_name=='huzzun'){ ?>
	<tr>
	<td><a href="List_user_online_now.php" target="_blank"><font size="2" 	face="MS Sans Serif, Tahoma, sans-serif">
<?php 	 
$hostname_edoc5 = "192.168.10.100";
$database_edoc5 = "radius";
$username_edoc5 = "thaigqsoft";
$password_edoc5 = "tlogsystem";
$connect_dbs= mysql_connect ($hostname_edoc5, $username_edoc5, $password_edoc5);
mysql_select_db($database_edoc5,$connect_dbs);  //  or trigger_error(mysql_error(),E_USER_ERROR);
    mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
$days= date("d");
$days2= date("d")-1;
$mount = date("m");
$year_gp= date("Y");

$todays=date("Y-m-d");
$to22=date("d");  $to22=$to22-1;
$todays2=date("Y-m");
$todays2 .="-$to22";

$query_Recordset1 = "
SELECT 
		radacct.UserName,
       radacct.AcctStartTime,
       radacct.FramedIPAddress,
       register.fullname,
	    register.room ,
		radacct.UserName,
		 radacct.CalledStationId,
		 register.per  ,
		  register.site
 FROM radacct
     INNER JOIN register ON (radacct.UserName = register.UserName) 
	 where 
    AcctStopTime='0000-00-00 00:00:00' 
	and register.domain='$domain_name'
	   ";
$Recordset1 = mysql_query($query_Recordset1, $connect_dbs) or die(mysql_error());?>
������͹�Ź�-��й��<?php print ' [ '.$totalRows_online= mysql_num_rows($Recordset1).'<img src="../images/login_user.gif" width="17"
	height="17" > �� ]'; ?></font></a></td>
	</tr>
	<?php }  */
	
 
$query_Recordset_mk_online = " Select  count(user_mk_online) as t,sum(user_mk_online) as y ,sum(connects) as r  from  mikrotik_link  where   status='1' and ip_vpn <>'0'   and domain='$domain_name' ";
$Recordset1 = mysql_query($query_Recordset_mk_online, $connect_dbs) or die(mysql_error());
$row_Recordset_online_mk = mysql_fetch_assoc($Recordset1);

	?>
	<?php if($_SESSION["adminpass"]=='admin'  or $_SESSION["adminpass"]=='tlog' ){ ?>
		<tr>
		<td align="left" valign="top">
		<font size="2"  face="MS Sans Serif, Tahoma, sans-serif"><a href="SMS/main.php" target="_blank" alt=''> �� SMS</a></font></td>
	</tr>
	<?php }?>
	<tr>
		<td align="left" valign="top">
		<font size="2"  face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=72" alt='�ӹǹ���͹�Ź�,����ͧ���͹�������'>Mikrotik User online[ <?php print $row_Recordset_online_mk[y]  ;?>],[ <?php print $row_Recordset_online_mk[r]  ;?>]</a></font></td>
	</tr>
		<tr>
		<td align="left" valign="top">  <font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=20" target="_parent">Mikrotik Link zone [ <?php print $row_Recordset_online_mk[t] ;?>]</a>  </font> 		</td>
	</tr>
 
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=1">��¡�ü����Ѥ������ҹ
					&nbsp; [<?php print $totalRows_online_reg;?> ��]</a> </font></td>
	</tr>
 

	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=2">��¡����Ҫԡ��к�&nbsp;
					[<?php print $totalRows_online_acctive;?> ��]</a> </font></td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=7">��Ҫԡ���ź���</a>
		</font></td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=18">���������</a> </font></td>
	</tr>
	<?php if($domain_name=='bether'){ ?>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"> <a
				href="index.php?case_i=53">Authen By Mac address</a> </font></td>
	</tr>
<?php } ?>
    <tr>
		<td valign="top"><font size="2" 	face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=31">���������ҡ Excel</a> </font></td>
	</tr>  
	
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=6"
				target="_parent">Unlock User</a> </font></td>
	</tr>
 
	<tr>
		<td align="left" valign="top"><font size="2" 	face="MS Sans Serif, Tahoma, sans-serif"><a 	href="index.php?case_i=55" target="_parent">ź������������ Login �����ҹҹ</a> </font></td>
	</tr>
 
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a 	href="index.php?case_i=61" target="_parent">�� Email �֧��Ҫԡ</a>
		</font></td>
	</tr>
	
		<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a href="http://www.thaigqsoft.info/forget_pass.php?domain_name=<?php print $domain_name;?>" target="_blank">�� SMS �͡���ʼ�ҹ��Ҫԡ</a>
		</font></td>
	</tr>
	<tr>
		<th align="left" valign="top" bgcolor="#66CCFF"  >
		 
		<font size="4" face="MS Sans Serif, Tahoma, sans-serif"><img src="./images/veryhot_post.gif" alt="" width="22" height="22" /> 
			�ѵ��������		</font> </div>	 </th>
	</tr>
 
<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"> <a 	href="/active.php?domain_name=<?php print $domain_name;?>" target="_blank">�����������١��� (�ѵ÷�����ҧ�ͧ)</a> </font></td>
  </tr>
  <tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"> 
			<a href="/card_true_acctive.php?domain_name=<?php print $domain_name;?>" target="_blank">�����������١��� (�ѵ÷���ѹ���)</a> </font></td>
  </tr>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"> <a 	href="index.php?case_i=73" target="_parent">�ѵ÷��</a> </font></td>
	</tr>
 
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"> <a 	href="index.php?case_i=35" target="_parent">���ҧ�ѵ���������Թ������</a> </font></td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <a 	href="index.php?case_i=38" target="_parent">�ѵ�������ҷ������ա����ҹ</a>
		</font></td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <a href="index.php?case_i=39" target="_parent">�ѵ�������ҷ���ա����ҹ����</a>
		</font></td>
	</tr>
	
	 	<tr>
		<td align="left" valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <a href="index.php?case_i=82" target="_parent">��§ҹ��â�ºѵ� ������ҧ�ͧ</a>
		</font></td>
	</tr>
		 	<tr>
		<td align="left" valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <a href="index.php?case_i=83" target="_parent">��§ҹ��â�ºѵ� true money</a>
		</font></td>
	</tr>
		<tr>
		<td align="left" valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <a href="index.php?case_i=74" target="_parent">��駤�Һѭ�� Truemoney</a>
		</font></td>
	</tr>
<?php  /*	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"> <a 	href="index.php?case_i=47" target="_parent">��ػ�ѵ���Ҫԡ�¡����������������</a>
		</font></td>
	</tr>
*/
?>

 
	<tr>
		<th align="left" valign="top" bgcolor="#66CCFF" >
 	<font size="4" face="MS Sans Serif, Tahoma, sans-serif"><img src="./images/report.png" alt="" width="22" height="22" /> 
			��§ҹ Log		</font> </div>		</th>
 </tr>
	 
 
	<?php /*
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=3">IP
					�����Ŵ�Ե</a> </font></td>
	</tr>
	*/ ?>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif">
		<?php //	<a href="index.php?case_i=21">��§ҹ Log System</a> ?>
		<a href="list_syslog.php" target="_blank">��§ҹ Log System </a> </font></td>
	</tr>
<?php	/*
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=48">��§ҹ Log Mail System</a> </font></td>
	</tr>
	*/
	?>
 
	<?php /*
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=54">��§ҹ Log �ػ�ó�� Network</a> </font>
		</td>
	</tr>
	*/?>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=37">��¡��&nbsp;Mac ��Ҫԡ��� Login</a> </font>		</td>
	</tr>

 
<!--	<tr>
		<td align="left" valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <a 	href="list_proxy.php" target="_blank">��§ҹ���������</a></font>			</td>
	</tr>-->
	<tr>
		<th align="left" valign="top" bgcolor="#66CCFF"  > 
 	 
		<font size="4" face="MS Sans Serif, Tahoma, sans-serif"><img src="./images/docs.png" alt="" width="22" height="22" /> 
		��§ҹ �����		</font> </div></th>
	</tr>
	<?php /*
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=23">��§ҹ��ػ��ҿ</a> </font></td>
	</tr>

	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a href="msword_shot.php">��§ҹ��������<br>
					(��Ш���͹)</a> </font></td>
	</tr>
	*/	?>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=10">��§ҹ��� Login �ͧ��Ҫԡ</a> </font></td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=60">��§ҹ�ӹǹ�͹�Ź��¡����ѹ</a> </font></td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=62">��§ҹ�ӹǹ�͹�Ź��¡�������</a> </font></td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=63">��§ҹ��������¡����ѻ����</a> </font>		</td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=64">��§ҹ��������¡�����͹</a> </font></td>
	</tr>
	<?php /* 
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=67">��§ҹ����� VPN</a> </font></td>
	</tr>
*/	?>
	<tr>
		<th align="left" valign="top" bgcolor="#66CCFF"> 
	 
		<font size="4" face="MS Sans Serif, Tahoma, sans-serif"><img src="./images/url.gif" alt="" width="22" height="22" /> 
			�Ǻ������������Թ������		</font> </div>		</th>
	</tr>
	<?php /*
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=14">���ͤ���</a> </font></td>
	</tr>
	<?php /*
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=51">Limit Download Files</a> </font></td>
	</tr>
	
 
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=45">���ͤ Macaddress</a> </font></td>
	</tr>
	*/ ?>
 
 	<tr>
		<td align="left" valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><a 	href="index.php?case_i=80">Neighbor</a> </font></td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><a 	href="index.php?case_i=16">����/��䢡������������</a> </font></td>
	</tr>
<!-- <tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=77">��駤���к� QOS</a> </font></td>
	</tr>-->
	<tr>
		<th align="left" valign="top" bgcolor="#66CCFF"> 
  
		<font size="4" face="MS Sans Serif, Tahoma, sans-serif"><img src="./images/document.png" alt="" width="22" height="22" /> 
		��駤��		</font> </div>		</th>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=32">����˹���á</a> </font></td>
	</tr>
		<?php /*
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=33">�Ѵ��� LOGO</a> </font></td>
	</tr>

 
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=36">�ѧ��� �к� </a> </font></td>
	</tr>	
	*/?>
 <tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=8">�Ѻ�駻ѭ��</a>
		</font></td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=9">��§ҹ�ѭ��
			</a> </font></td>
	</tr>
 		<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=75">��駤���к��� sms</a> </font></td>
	</tr>
		<th align="left" valign="top" bgcolor="#66CCFF"> 
		 
		<font size="4" face="MS Sans Serif, Tahoma, sans-serif"><img src="./images/MSN.gif" alt="" width="22" height="22" /> 
	�������к�		</font></div>		</th>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=12">�����������к�</a> </font></td>
	</tr>
	<?php 
	/*<tr>
		<td align="left" valign="top"><a href="index.php?case_i=29"><font
				size="2" face="MS Sans Serif, Tahoma, sans-serif">���ͧ������</font>
		</a></td>
	</tr>
	*/
	?>

	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=68">��§ҹ �����ҹ�ͧ�ʹ�Թ</a> </font></td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=70">��¡�á�þ�����������к�</a> </font>		</td>
	</tr>
	<tr>
		<td align="left" valign="top" bgcolor="#FFFFCC"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a href="logout.php">�͡�ҡ�к�</a>
		</font></td>
	</tr>
</table>

