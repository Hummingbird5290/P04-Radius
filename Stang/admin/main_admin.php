<?php    include("../include/chklogin.php");
include("../include/function.php");
#เรียก cache-kit.php
include_once('../cache-kit.php');
//     ini_set('display_errors', 1);
  // error_reporting(ALL);  
# Config
$cache_active = true;
$cache_folder = 'cache/';
?>
<?php

/* get disk space free (in bytes) */
$df = disk_free_space("/data/squid/");



/* and get disk space total (in bytes)  */
$dt = disk_total_space("/data/squid/");

/* now we calculate the disk space used (in bytes) */
$du = $dt - $df;

/* percentage of disk used - this will be used to also set the width % of the progress bar */
$dp = sprintf('%.2f',($du / $dt) * 100);

/* and we formate the size from bytes to MB, GB, etc. */
$df = formatSize($df);
$du = formatSize($du);
$dt = formatSize($dt);

function formatSize( $bytes )
{
	$types = array( 'B', 'KB', 'MB', 'GB', 'TB' );
	for( $i = 0; $bytes >= 1024 && $i < ( count( $types ) -1 ); $bytes /= 1024, $i++ );
	return( round( $bytes, 2 ) . " " . $types[$i] );
}

?>

<meta
	http-equiv="Content-Type" content="text/html; charset=windows-874">
<style type='text/css'>
.progress {
	border: 2px solid #5E96E4;
	height: 32px;
	width: 540px;
	margin: 30px auto;
}

.progress .prgbar {
	background: #A7C6FF;
	width: <?php echo $dp; ?>%;
	position: relative;
	height: 32px;
	z-index: 999;
}

.progress .prgtext {
	color: #286692;
	text-align: center;
	font-size: 13px;
	padding: 9px 0 0;
	width: 540px;
	position: absolute;
	z-index: 1000;
}

.progress .prginfo {
	margin: 3px 0;
}
</style>

<link href="../css/style.css" rel="stylesheet" type="text/css">
<p align="center">
 
<?php if ($domain_name !=NULL) { 
include("main_connect.php");
$connect_db2= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc);
if(!$connect_db2){
 echo 'ไม่สามารถเชือมต่อฐานข้อมูลได้ ';
 exit();
}
   mysql_query("SET character_set_results=tis620", $connect_db2) or die(mysql_error());
    mysql_query("SET character_set_client=tis620", $connect_db2) or die(mysql_error());
    mysql_query("SET character_set_connection=tis620", $connect_db2) or die(mysql_error());
    mysql_query("SET collation_connection = tis620_thai_ci", $connect_db2) or die(mysql_error());
    mysql_query("SET collation_database = tis620_thai_ci", $connect_db2) or die(mysql_error());
    mysql_query("SET  collation_server = tis620_thai_ci", $connect_db2) or die(mysql_error());
	 mysql_select_db($database_edoc, $connect_db2)  or trigger_error(mysql_error(),E_USER_ERROR);
   
 
if($_SESSION["adminpass"] !='tlog'){  $CS="  domain='$domain_name'    and ";  } else { $CS="  ";   }
 $query_Recordset101PQ = "SELECT   *   FROM question  where  $CS  status ='0'   order by id desc   limit 0,10 ";
 $Recordset10QPR = mysql_query($query_Recordset101PQ, $connect_db2) or die(mysql_error());
 $row_RecordsetPR = mysql_fetch_assoc($Recordset10QPR);
 $totalRows_PR = mysql_num_rows($Recordset10QPR);
 if($totalRows_PR > 0 ) {
 ?>
<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" class="imagetable">
    
   <tr bgcolor="#FFFF99"> 
      <th colspan="5"> <div align="center" class="style1 style2">
	  <font size="3" face="MS Sans Serif, Tahoma, sans-serif"><strong>รายการปัญหาที่ยังไม่ได้รับการแก้ไข(<?php print $totalRows_PR; ?>)</strong></font></div></th>
  </tr>
    <tr bgcolor="#FFFF99"> 
      <th width="9%"> <div align="center" class="style3"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ลำดับ</strong></font></div></th>
      <th width="47%" align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ชื่อผู้แจ้ง</strong></font></th>
      <th width="33%" align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Time </strong></font></th>
      <th width="11%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ลบ</font></strong></th>
      <th width="11%" align="center"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>บันทึกแก้ไขแล้ว</strong></font></div></th>
    </tr>
     
	<?php

$i=0;
 
	 do { 
	 if($row_RecordsetPR[name] !=NULL){
 	    ?>
    <tr bgcolor="<?php echo "$cli"; ?>" > 
      <td height="21" align="center"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?=($offset + $i);?>
        .</font></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
	  <a href="#search" onClick="newwindow=window.open('detail_problem.php?id=<? print $row_RecordsetPR[id];?>','detail_user','height=500,width=530,left=10,top=100,scrollbars=1');newwindow.focus();">
	  <<<<? print $row_RecordsetPR[name];?>>>></a>< <? print $row_RecordsetPR[domain];?> ></font></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><? print  date_to_thai($row_RecordsetPR[time_q]);?></font></div></td>
        <td><div align="center"><a href="index.php?case_i=8&chk_delete=1&id=<? print $row_RecordsetPR[id];?>"><img src="../images/delete.gif" width="16" height="16" border="0"></a></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><a href="clear_problem.php?id=<?echo $result_data[id] ;?>&delete=1" ><img src="../images/icon_infon.jpg" width="13" height="13" border="0"></a></font></div></td>
    </tr>
    <?
			$i++;
			}
  } while ($row_RecordsetPR = mysql_fetch_assoc($Recordset10QPR));  ?>
 
</table>
 
<?php }  } ?>
 
<?php

	include_once ("../Connections/dbconnect.php");
	mysql_select_db($database_edoc);  

  $sql = "update   usergroup  set   domain='$domain_name'  where  UserName in (   select  UserName from register  where  domain='$domain_name' ) ";
mysql_query($sql);

$days= date("d");
$days2= date("d")-1;
$mount = date("m");
$year_gp= date("Y");
mysql_select_db($database_edoc);  // or trigger_error(mysql_error(),E_USER_ERROR);
$todays=date("Y-m-d");
$to22=date("d");  $to22=$to22-1;
$todays2=date("Y-m");
$todays2 .="-$to22";
 
?><br />

 <table width="800" border="0" align="center" class="imagetable">
	<tr>
		<th colspan="5"><div align="center">
			<span class="scimenu"><strong>Last  admin login</strong>		    </span></div></th>
	</tr>
	<tr>
		<th width="271"><div align="left">	  <span class="scimenu"><strong>ชื่อเข้าใช้</strong>      </span></div></th>
		<th width="271"><div align="left">	  <span class="scimenu"><strong>domain</strong>      </span></div></th>
		<th width="244"><div align="center">
	  <span class="scimenu"><strong>เวลาเข้าใช้</strong>      </span></div></th>
		<th width="271"><div align="center">
	  <span class="scimenu"><strong>IP</strong>      </span></div></th>
	</tr>
	<?php
	  if($_SESSION["adminpass"]=='tlog'){ 
	  $domainsss=NULL;
	  }else {
$domainsss=	"  where    domain='$domain_name' ";
	  }
	$query_Recordset1 = "SELECT *  FROM   login_pass  $domainsss  order by time_login desc  limit 0,10 ";
	$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$i=0;
	if($row_Recordset1[domain]!=NULL) {
		do { 
			$cli=$i%2;
					if($cli=="0")  {$cli="#AAD2FF" ;  } else {    $cli="#FFFFFF" ;   }
				$i++;	?>

	<tr bgcolor="<?php echo "$cli"; ?>" class="ข้อความในตาราง"> 
		<td><?php print $row_Recordset1[userdb_user];?></td>
			<td><?php print $row_Recordset1[domain];?></td>
		<td><?php  date_to_thai($row_Recordset1[time_login]) ?></td>
		<td><?php print $row_Recordset1[ip];?></td>
	</tr>
	<?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));  }?>
</table>
	 
<br />
<table width="800" border="0" align="center" class="imagetable">
	<tr>
		<th colspan="4"><div align="center">
				<span class="scimenu"><strong>Last log system </strong>
		    </span></div></th>
	</tr>
	<tr>
		<th width="496"><div align="left">
				<span class="scimenu"><strong>MSG</strong>
		    </span></div></th>
		<th width="214"><div align="center">
				<span class="scimenu"><strong>Time</strong>
		    </span></div></th>
		<th width="76"><div align="center">
				<span class="scimenu"><strong>Admin</strong>
		    </span></div></th>
	</tr>
	<?php
	$query_Recordset1 = "SELECT   *   FROM noute_data  $domainsss   order by date_add desc   limit 0,20 ";
	$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$i=0;
	if($row_Recordset1[date_add]!=NULL) {
		do { 
			$cli=$i%2;
					if($cli=="0")  {$cli="#AAD2FF" ;  } else {    $cli="#FFFFFF" ;   }
				$i++;	?>

	<tr bgcolor="<?php echo "$cli"; ?>" class="ข้อความในตาราง"> 
		<td><?php print $row_Recordset1[texts];?></td>
		<td><?php  date_to_thai($row_Recordset1[date_add]) ?></td>
		<td><?php print $row_Recordset1[admin];?></td>
	</tr>
	<?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));  }?>
</table>

	 
 
 
