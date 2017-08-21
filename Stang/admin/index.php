<?php  
header('Content-Type: text/html; charset=windows-874');
include("../include/chklogin.php");
     
  if($_SESSION["adminpass"]=='data1'){ 
    	         echo                  "<script type=text/javascript>";
		    echo                  "alert('������ҷ��ͺ�к����Ǩ�� ')";
	        echo                  "</script>";  
			     echo "<meta http-equiv=refresh content=0;URL=https://www.thaigqsoft.info/logout.php>"; 
				 exit();
  }
 if($_SESSION["adminpass"]=='demo'){ 
    	         echo                  "<script type=text/javascript>";
		    echo                  "alert('������ҷ��ͺ�к����Ǩ�� ')";
	        echo                  "</script>";  
			     echo "<meta http-equiv=refresh content=0;URL=https://www.thaigqsoft.info/logout.php>"; 
				 exit();
  }
  /*
   if($_SESSION["adminpass"]=='tlog'){ 
    	         echo                  "<script type=text/javascript>";
		    echo                  "alert('������ҷ��ͺ�к����Ǩ�� ')";
	        echo                  "</script>";  
			     echo "<meta http-equiv=refresh content=0;URL=http://t-voip0.zapto.org:99/logout.php>"; 
				 exit();
  }
 */
 ini_set('date.timezone ', 'Asia/Bangkok');
 if ($_SERVER['HTTP_CLIENT_IP']) { 
$IPLOGIN = $_SERVER['HTTP_CLIENT_IP'];
} elseif (preg_match("/[0-9]/",$_SERVER["HTTP_X_FORWARDED_FOR"] )) { 
$IPLOGIN = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else { 
$IPLOGIN = $_SERVER["REMOTE_ADDR"];
}
 
 function sqllog($sql,$domain,$username){
include("main_connect.php");
$connect_dbs= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc);
  mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
 mysql_select_db($database_edoc, $connect_dbs)  or trigger_error(mysql_error(),E_USER_ERROR);
 $sql = htmlspecialchars("$sql", ENT_QUOTES);
 $a=date("Y-m-d H:i:s");
 mysql_query("INSERT INTO  sql_log  (dates,sql,username,domain)
		      values('$a', '$sql','$username','$domain'   )", $connect_dbs) or die(mysql_error());
 }
 
 
 
/*
 
  if($_SESSION["adminpass"]=='tlog'){ 
 ini_set('date.timezone ', 'Asia/Bangkok');
  ini_set('display_errors', 1);
 error_reporting(E_ALL);
 }

 */
#���¡ cache-kit.php
include_once('../cache-kit.php');
extract($_POST);extract($_GET);extract($_REQUEST);
include_once('routeros_api.class.php'); //mikrotik api
# Config
$cache_active = true;
$cache_folder = 'cache/';
/* if( $_SERVER['SERVER_PORT'] == 80) {
 $link_to='https://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/'.basename($_SERVER['PHP_SELF']);
 echo  "<meta http-equiv=refresh content=0;URL=$link_to >";
 die();
 }
 */

?>

<HTML>
<HEAD>
<TITLE>TLOG CENTER SYSTEM</TITLE>

<style rel="stylesheet" type="text/css">
span.info {
display:block;
margin:15px 0;
padding:10px 10px 10px 65px;
  no-repeat scroll 10px 50% #D8E5F8;
border-bottom:3px solid #629DE3;
border-top:3px solid #629DE3;
color:#0055BB;
}
.menuhead {
display:block;
margin:1px 0;

no-repeat scroll 1px 50% #D8E5F8;
border-bottom:3px solid #629DE3;
border-top:3px solid #629DE3;
color:#0055BB;
}

a {
	text-decoration: none;
}
 body, td {
line-height:150%; }
</style>

<style type="text/css">

table.imagetable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #999999;
	border-collapse: collapse;
}
table.imagetable th {
	background:#b5cfd2 url('cell-blue.jpg');
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #999999;
}
table.imagetable td {
	background:#dcddc0 url('cell-grey.jpg');
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #999999;
}
</style>
<?php  //������� �ӹǹ���͹�Ź� 
/*
if($_SESSION['adminpass']!=NULL) {?>
<script type="text/javascript">
function AjaxOnlinemain(){
var xmlHttp;
 
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
		xmlHttp2=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
		 
	 
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		    xmlHttp2=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		     
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			    xmlHttp2=new ActiveXObject("Microsoft.XMLHTTP");
			    
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}

xmlHttp.onreadystatechange=function(){
	 
		if(xmlHttp.readyState==4){
		document.getElementById('onlinereface').innerHTML=xmlHttp.responseText;
	    setTimeout('AjaxOnlinemain()',10000);  //1000= 1 �Թҷ�
	}
	
}

 xmlHttp2.onreadystatechange=function(){
	<?php /*if(xmlHttp2.readyState==1){
		document.getElementById('onlinereface2').innerHTML='Loading ........';
	  }
	   
		if(xmlHttp2.readyState==4){
		document.getElementById('onlinereface2').innerHTML=xmlHttp2.responseText;
	    setTimeout('AjaxOnlinemain()',10000);  //1000= 1 �Թҷ�
	}
	
}

 

xmlHttp.open("GET","show_num_online.php?a=1",true);
xmlHttp.send(null);

xmlHttp2.open("GET","show_num_online.php?a=2",true);
xmlHttp2.send(null);

 
}

 

window.onload=function(){
	setTimeout('AjaxOnlinemain()',1000);
}
</script>


  
    } //������� �ӹǹ���͹�Ź�  
*/   ?>

<link href="css/style.css" rel="stylesheet" type="text/css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-874">
 <style type="text/css">
.styled-button-2 {
	-webkit-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	-moz-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	border-bottom-color:#333;
	border:1px solid #61c4ea;
	background-color:#7cceee;
	border-radius:5px;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	color:#333;
	font-family:'Verdana',Arial,sans-serif;
	font-size:14px;
	text-shadow:#b2e2f5 0 1px 0;
	padding:5px
}
</style>
<style type="text/css">
/* <!--
body {
	background-color: #FFFFFF;
}
--> */
</style></HEAD>
<BODY LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 	MARGINHEIGHT=0 background="images/bg1.gif">
	<?php if($_SESSION["adminpass"]=='tlog'){ 
	echo "SYSTEM DEBUG MODE===";
	print_r($_SESSION);
	//	print_r($_SERVER);
	}
	?>
	<!-- ImageReady Slices (home2.psd) -->
	<TABLE WIDTH=1101 BORDER=0 CELLPADDING=0 CELLSPACING=0>
		<TR>

		  <TD COLSPAN=7><?php
			include("../Connections/conf.php");
			mysql_select_db($database_edoc) or trigger_error(mysql_error(),E_USER_ERROR);
			// mysql_query($connect_db) or trigger_error(mysql_error(),E_USER_ERROR);
			# �֧��Ҩҡ Cache �ҡ Key ���� IndexKey 㹪�ǧ 10000 �Թҷշ���ҹ��
			$logo = acmeCache::fetch('logo', 10000); // 1000=1 seconds

			# ��Ҽ�ҹ 10 �Թҷ�����ǡ����֧��Ҩҡ Loop ����ô֧�� MySQL �������õ�ҧ�����

			if(!$logo){
				$sql = "select  *  from logo   where types='main' "; // �ҡ��ͧ��ô֧੾�� Reccord � Record ˹�� ��������� where id='$�����'
				$Recordset1 = mysql_query($sql, $connect_db) or die(mysql_error());
				$row_Recordset1 = mysql_fetch_assoc($Recordset1);
				$logo= $row_Recordset1['logo'];
				# �ѧ������ŧ� Key ��������� IndexKey
				acmeCache::save('logo', $logo);

			} else { $cache="OK"; }

			$todays=date("Y-m-d");
			$to22=date("d");  $to22=$to22-1;
			$todays2=date("Y-m");
			$todays2 .="-$to22";

			 

	 
				$query_Recordset1 = " SELECT *  FROM    register   where     status='0'  and domain='$domian_name'  	   ";
				$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
				$totalRows_online_reg= mysql_num_rows($Recordset1);
		 


			//�ӹǹ ��Ҫԡ������ �����������Ѥ�
		 
				$query_Recordset1 = " SELECT *  FROM    register   where     status='1'   and domain='$domain_name' 	   ";
				$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
				$totalRows_online_acctive= mysql_num_rows($Recordset1);
				# �ѧ������ŧ� Key ��������� IndexKey
				 
 
  $query_Recordset1 = " Select  *  from  register  where   domain='$domian_name' and  status='1' ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
  do { ?>
  <script language="JavaScript">
function Conf<? echo "$row_Recordset1[UserName]" ?>(object) {
if (confirm("�׹�ѹ���ź�����ҹ [ <? echo "$row_Recordset1[fullname]       "      ?> ] ") ==true) {
return true;
}
return false;
}
</script>

<?php     } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
 
<?
 $query_Recordset1 = " Select  *  from  register where domain='$domian_name'   ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
  do { ?>
  <script language="JavaScript">
function bad_user<? echo "$row_Recordset1[UserName]" ?>(object) {
if (confirm("�׹�ѹ��ú��͡�����ҹ [ <? echo "$row_Recordset1[fullname]       "      ?> ] ") ==true) {
return true;
}
return false;
}
</script> 
<?php     } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>

<?
 $query_Recordset1 = " Select  *  from  register  where domain='$domian_name'  ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
  do { ?>
  <script language="JavaScript">
function timeout<? echo "$row_Recordset1[UserName]" ?>(object) {
if (confirm("�׹�ѹ��úѧ�Ѻ���������ҹ [ <? echo "$row_Recordset1[fullname]       "      ?> ] ") ==true) {
return true;
}
return false;
}
</script>
<?php     } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
 <script language="JavaScript">
 function  cdelete(object) {
if (confirm("��ҹ���������Ҩ�ź������ ") ==true) {
return true;
}
return false;
}
 </script> 
 <?
 $query_Recordset1ccc = " Select  *  from  register  where domain='$domian_name'  ";
$Recordset1ccc = mysql_query($query_Recordset1ccc, $connect_db) or die(mysql_error());
$row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc);
  do { ?>
  <script language="JavaScript">
 function  cclear<? echo "$row_Recordset1ccc[UserName]" ?>(object) {
if (confirm("��ҹ���������Ҩ�������� login �ͧ �����ҹ [ <? echo "$row_Recordset1ccc[fullname]"; ?> ") ==true) {
return true;
}
return false;
} 
</script> 
<?php     } while ($row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc)); ?>
<?php
				   $query_Recordset1ccc = "update usergroup  set domain='$domain_name'     where domain=''  and  UserName in (select  UserName  from register  where domain='$domain_name')";
$Recordset1ccc = mysql_query($query_Recordset1ccc, $connect_db) or die(mysql_error());
?>			<img src="<?php print  "$logo"; ?> " width=1055 height=171 alt="" style="border: 1px solid #CCCCCC; padding: 5px;"></TD>
			<TD width="22"><IMG SRC="../images/spacer.gif" WIDTH=1 HEIGHT=171
				ALT=""></TD>
		</TR>
		<TR>
			<TD COLSPAN=3 ROWSPAN=2><IMG SRC="../images/home2_02.jpg" WIDTH=234
				HEIGHT=65 ALT=""></TD>
			<TD width="7" ROWSPAN=4><IMG SRC="../images/home2_03.jpg" WIDTH=6
				HEIGHT=387 ALT=""></TD>
			<TD width="24"><IMG SRC="../images/home2_04.jpg" WIDTH=24 HEIGHT=30
				ALT=""></TD>

			<TD width="791" background="../images/home2_05.jpg">&nbsp;</TD>
			<TD width="27"><IMG SRC="../images/home2_06.jpg" WIDTH=27 HEIGHT=30
				ALT=""></TD>
			<TD><IMG SRC="../images/spacer.gif" WIDTH=1 HEIGHT=30 ALT=""></TD>
		</TR>
		<TR>
			<TD ROWSPAN=2 valign="top"><IMG SRC="../images/home2_07.jpg" WIDTH=24
				HEIGHT=1780 ALT=""></TD>

			<TD ROWSPAN=2 valign="top" background="../images/home2_08.jpg">
				<p align="left">
				<?php include("case.php"); ?>
				</p>			</TD>
			<TD ROWSPAN=2 valign="top"><IMG SRC="../images/home2_09.jpg" WIDTH=27
				HEIGHT=1780 ALT=""></TD>
			<TD><IMG SRC="../images/spacer.gif" WIDTH=1 HEIGHT=35 ALT=""></TD>
		</TR>
		<TR>
			<TD width="22" height="1115" valign="top"><IMG
				SRC="../images/home2_10.jpg" WIDTH=17 HEIGHT=1750 ALT=""></TD>

			<TD width="191" valign="top" bgcolor="#CCCCCC">
				<table width="109%" height="213" border="0">
					<tr>
						<td height="61" valign="top" bgcolor="#CCCCCC"><p align="center">
								<font color="#FF0000" size="3"
									face="MS Sans Serif, Tahoma, sans-serif"><strong><a
										href="index.php">˹���á�������к�</a> </strong> </font><font
									size="2" face="MS Sans Serif, Tahoma, sans-serif"> </font>
							</p>
							<p align="center"><b><?php print $domain_name;?>(<?php print $IPLOGIN;?>)<br>
<?php print	$_SESSION["adminpass"];?></b></p><br>
						
							<?php
include("main_connect.php");
$connect_dbs= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc);
  mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
 mysql_select_db($database_edoc, $connect_dbs)  or trigger_error(mysql_error(),E_USER_ERROR);
							//������� ��ͤ�Թ����
$session=session_id();
$time=time();
$time_check=$time-600; //��˹�����㹷�������˹� 10 �ҷ�
$uns=$_SESSION["adminpass"];
$session_db = mysql_query("select count(uname) as t from  admin_online  where session='$session'  and uname='$uns'  and domain='$doname_login'  ", $connect_dbs);
$session_check = mysql_fetch_assoc($session_db);
 
if ($session_check[t] == "0" or $session_check[t]=='') {
mysql_query("insert into admin_online  (uname,domain,session,time,ips) values ('$uns','$doname_login','$session',$time,'$IPLOGIN')", $connect_dbs);
} else { 
mysql_query("update admin_online  set time='$time',case_i='$case_i' where session='$session'  and uname='$uns' and domain='$doname_login' and ips='$IPLOGIN' ", $connect_dbs);
} 
   if($_SESSION["adminpass"]=='tlog'){ 
// print  "delete from admin_online  where time < $time_check ";
  mysql_query("delete from admin_online  where time < $time_check ", $connect_dbs)  or trigger_error(mysql_error(),E_USER_ERROR);
}
/////////////////////////////////////////////////////////////////////////
	  if($_SESSION["adminpass"]=='tlog'){ 
		if($_POST[domainsystem]!=''){
		$_SESSION["domain"]=$_POST[domainsystem];
		echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=20>"; 
           exit();  
		}

		?>
			<form name="seadmin" action="" method="post">
			<select name="domainsystem">
          <option value="<?php print $domain_name;?>" selected><?php print $domain_name;?></option>
   <?php     $query_server = "SELECT   domain   FROM   mikrotik_link   where  domain <>'$domain_name' group by  domain order by  domain      ";
 $Recordset_server = mysql_query($query_server, $connect_dbs) or trigger_error(mysql_error(),E_USER_ERROR); 
$row_Recordset_server = mysql_fetch_assoc($Recordset_server);

  do { ?>
      <option value="<?php print $row_Recordset_server[domain];?>"  ><?php print $row_Recordset_server[domain];?></option>
<?php	   } while ($row_Recordset_server = mysql_fetch_assoc($Recordset_server));   ?>
        </select><br>

		<input type="submit" name="Submit" value="���͡ Sections">
			</form>

			<?	 }  ?>
				
			<?php if($_SESSION["adminpass"]=='atomwifi'){ 
		if($_POST[domainsystem]!=''){
		$_SESSION["domain"]=$_POST[domainsystem];
		echo "<meta http-equiv=refresh content=0;URL=index.php>"; 
           exit();  
		}

		
 ?>
 
			<form name="seadmin" action="" method="post">
 <select name="domainsystem">
     <option value="atomwifi"  >atomwifi �Ң� 1</option>
 <option value="atomwifi2"  >atomwifi �Ң� 2</option>
 <option value="atomwifi3"  >atomwifi  3</option>
 <option value="atomwifi4"  >atomwifi  4</option>
        </select><br>

		<input type="submit" name="Submit" value="���͡ Sections">
			</form>
				<?php }  ?>


			<?php if($_SESSION["domain"]=='stangwifi' or $_SESSION["domain"]=='stangwifi2') { 
		if($_POST[domainsystem]!=''){
		$_SESSION["domain"]=$_POST[domainsystem];
		echo "<meta http-equiv=refresh content=0;URL=index.php>"; 
           exit();  
		}

		
 ?>
 
			<form name="seadmin" action="" method="post">
 <select name="domainsystem">
     <option value="stangwifi"  >office</option>
 <option value="stangwifi2"  >home</option>
        </select><br>

		<input type="submit" name="Submit" value="���͡ Sections">

			</form>
				<?php }  ?>						</td>
					</tr>
					<tr>
						<td valign="top"> 
								  <?php include("menu_admin.php"); ?>					  </td>
					</tr>
				</table>
		 </TD>
			<TD width="17" valign="top"><IMG SRC="../images/home2_12.jpg"
				WIDTH=17 HEIGHT=1750 ALT=""></TD>
			<TD><IMG SRC="../images/spacer.gif" WIDTH=1 HEIGHT=295 ALT=""></TD>
		</TR>
		<TR>
			<TD COLSPAN=3 ROWSPAN=2><IMG SRC="../images/home2_13.jpg" WIDTH=231
				HEIGHT=29 ALT=""></TD>
			<TD><IMG SRC="../images/home2_14.jpg" WIDTH=24 HEIGHT=27 ALT=""></TD>
			<TD ROWSPAN=2 background="../images/home2_15.jpg"></TD>
			<TD><IMG SRC="../images/home2_16.jpg" WIDTH=27 HEIGHT=27 ALT=""></TD>
			<TD><IMG SRC="../images/spacer.gif" WIDTH=1 HEIGHT=27 ALT=""></TD>
		</TR>
		<TR>
			<TD COLSPAN=2><IMG SRC="../images/home2_17.jpg" WIDTH=30 HEIGHT=2
				ALT=""></TD>
			<TD><IMG SRC="../images/home2_18.jpg" WIDTH=27 HEIGHT=2 ALT=""></TD>
			<TD><IMG SRC="../images/spacer.gif" WIDTH=1 HEIGHT=2 ALT=""></TD>
		</TR>
		<TR>
			<TD COLSPAN=7><IMG SRC="../images/home2_19.jpg" WIDTH=1080 HEIGHT=128
				ALT=""></TD>
			<TD><IMG SRC="../images/spacer.gif" WIDTH=1 HEIGHT=128 ALT=""></TD>
		</TR>
	</TABLE>
	<?php
	/*
	$JavaScript = acmeCache::fetch('JavaScript', 1000); // 10000 seconds
	if(!$JavaScript){
		# �ѧ������ŧ� Key ��������� IndexKey
		acmeCache::save('JavaScript', 'admin');
		@include_once ("../Connections/dbconnect.php");
		$connect_db_syslog= mysql_connect($hostname_syslog, $username_syslog, $password_syslog) or trigger_error(mysql_error(),E_USER_ERROR);
		@ mysql_select_db($database_syslog, $connect_db_syslog)  or trigger_error(mysql_error(),E_USER_ERROR);
		@$database_edoc="syslog";
		@ mysql_select_db($database_edoc);  ;// or trigger_error(mysql_error(),E_USER_ERROR);
		$db  = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));

		$db = date("Ymd", $db);

		$sql = "CREATE TABLE IF NOT EXISTS  log_$db  (
   host  varchar(32) default NULL,
  facility   varchar(10) default NULL,
   priority  varchar(10) default NULL,
   level  varchar(10) default NULL,
   tag  varchar(10) default NULL,
  datetime  datetime default NULL,
   program  varchar(15) default NULL,
  msg  text,
   seq  bigint(20) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (seq),
  KEY host (host),
  KEY  program (program),
  KEY  datetime (datetime),
  KEY  priority  (priority),
  KEY  facility (facility)
) ENGINE=MyISAM ;   ";
		mysql_select_db($database_syslog);
		$dbquery = mysql_query( $sql) ;


		$db  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));

		$db = date("Ymd", $db);




		$sql = "CREATE TABLE IF NOT EXISTS  log_$db  (
   host  varchar(32) default NULL,
  facility   varchar(10) default NULL,
   priority  varchar(10) default NULL,
   level  varchar(10) default NULL,
   tag  varchar(10) default NULL,
  datetime  datetime default NULL,
   program  varchar(15) default NULL,
  msg  text,
   seq  bigint(20) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (seq),
  KEY host (host),
  KEY  program (program),
  KEY  datetime (datetime),
  KEY  priority  (priority),
  KEY  facility (facility)
) ENGINE=MyISAM ;   ";
		mysql_select_db($database_syslog);
		$dbquery = mysql_query( $sql) ;
include("delete_day.php");

}
 
*/
 
 ?>
	<!-- End ImageReady Slices -->
</BODY>
</HTML>
