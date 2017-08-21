 <?php
  include("../include/chklogin.php");
  ?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<table width="1172" border="1" align="center" class="imagetable">
  <tr>
    <th height="40" colspan="9" bgcolor="#66FFFF"><div align="center" class="scimenu"><strong>รายการ mikrotik zone <?php print $domian_name;?></strong></div></th>
  </tr>
  <tr>
    <th width="56" bgcolor="#66FFFF" class="scimenu"><div align="center">ลำดับ</div></th>
    <th width="79" bgcolor="#66FFFF" class="scimenu">edit</th>
    <th width="78" bgcolor="#66FFFF" class="scimenu"><div align="center">ชื่อ</div></th>
    <th width="96" bgcolor="#66FFFF" class="scimenu"><div align="center">VPN IP </div></th>
    <th width="49" bgcolor="#66FFFF" class="scimenu"><div align="center">User <br />online </div></th>
    <th width="55" bgcolor="#66FFFF" class="scimenu">HOSTS CONNECT</th>
    <th width="52" bgcolor="#66FFFF" class="scimenu"><div align="center">Online</div></th>
    <th width="83" bgcolor="#66FFFF" class="scimenu">Public IP </th>
    <th width="74" bgcolor="#66FFFF" class="scimenu"> <div align="center">lastupdate </div></th>
  </tr>
 <?php
 $query_Recordset1ccc = " Select  *  from  mikrotik_link  where domain='$domian_name'  order by   link_name  ";
$Recordset1ccc = mysql_query($query_Recordset1ccc, $connect_db) or die(mysql_error());
$row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc);
 $x=1;
  $datess=date('Y-m-d H:i:s',strtotime("-1 days"));
  $date2=date('Y-m-d H:i:s');
do { 
$mkid=$row_Recordset1ccc[mk_id];
$ipmk=$row_Recordset1ccc[ip_vpn];
$usermk=$row_Recordset1ccc[user];
$pmk=$row_Recordset1ccc[pass];
$gobal_ip=$row_Recordset1ccc[gobal_ip];
$status=$row_Recordset1ccc[status];
 $domainmik=$row_Recordset1ccc[domain];
 $link_name_config=$row_Recordset1ccc[link_name_config];


  $querys= " Select  *  from  radacct  where domainmik='$domian_name'  and  AcctStopTime='0000-00-00 00:00:00'  and  ( AcctStartTime  between '$datess' and '$date2' ) 
  and CalledStationId like '%$domainmik%' ";
  $Recs = mysql_query($querys, $connect_db) or die(mysql_error());
  $inum=  mysql_num_rows($Recs);
 
?>
  <tr>
   <td class="txtContentBold"><div align="center"><?php print $x;?></div></td>
    <td bgcolor="<?php print $BG_ART;?>" class="txtContentBold"  ><div align="center"><a href="#search" onclick="newwindow=window.open('mikrotik_edit_link_name.php?linkid=<?php print $mkid;?>','detail_user','height=70,width=300,left=300,top=100,scrollbars=0');newwindow.focus();"> edit</a></div></td>
    <td bgcolor="<?php print $BG_ART;?>" class="txtContentBold"  ><div align="center" id="<?php print $mkid;?>"><?php print $row_Recordset1ccc[link_name];?></div></td>
    <td class="txtContentBold"><div align="center"><?php print $identity;?><br />
            <?php print $row_Recordset1ccc[ip_vpn];?> </div></td>
    <td class="txtContentBold"><div align="center"><a href="index.php?case_i=72&amp;MK_ID=<?php print $row_Recordset1ccc[mk_id];?>"><?php print $inum;?></a></div></td>
    <?php	if($inum > 0 ){ $IMGS='online.gif';  }else   { $IMGS='offline.gif'; } ?>
    <?php	if($inum_online_all > 0 ){ $IMGS='online.gif';  }else   { $IMGS='offline.gif'; } ?>
    <td class="txtContentBold"><div align="center"><?php print $inum_online_all;?></div></td>
    <td class="txtContentBold"><div align="center"> <img src='<?php print $IMGS;?>' /></div></td>
    <td class="txtContentBold"><div align="center">(<?php print $gobal_ip;?>)</div></td>
    <td class="txtContentBold"><div align="center"><?php print $row_Recordset1ccc[lastupdate];?></div></td>
    </tr>
	<?php 
$x++;	  } while ($row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc)); 
	  ?>
</table>
</body>
</html>
