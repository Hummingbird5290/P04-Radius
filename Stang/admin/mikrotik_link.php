 <?php
  include("../include/chklogin.php");
 
/// ini_set('display_errors', 1);
// error_reporting(E_ALL);
//require_once('routeros_api.class.php'); //mikrotik api

?>
 
<?php

 if($reboot=='yes'){
 

  
			  
 $query_Recordset1ccc = " Select  *  from  mikrotik_link  where     mk_id='$linkid'  and status='1'";
$Recordset1ccc = mysql_query($query_Recordset1ccc, $connect_db) or die(mysql_error());
$row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc);
  $ipmk=$row_Recordset1ccc[ip_vpn];
$usermk=$row_Recordset1ccc[user];
$pmk=$row_Recordset1ccc[pass];
$link_name=$row_Recordset1ccc[link_name];
$API = new routeros_api();

//$API->debug = true;
$API->debug = false;
if ($API->connect($ipmk,$usermk ,$pmk )) {
 $ARRAY = $API->comm("/system/reboot");
 $API->disconnect();
 
 $b=date("Y-m-d H:i:s"); 
  $adminsss=$_SESSION["adminpass"];
$texts="$_SESSION[domain] ผู้ดูแลระบบ $adminsss   สั่ง REBOOT $link_name  $b";	
mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('system', '$texts','$b'  ,'system','$domain' )") or trigger_error(mysql_error(),E_USER_ERROR);   
			  
echo  "<meta http-equiv=refresh content=5;URL=index.php?case_i=20>";
exit();
}
}



$query_Recordset1ccc = " Select  *  from  mikrotik_link  where domain='$domian_name' and status='1'  order by   link_name  ";
$Recordset1ccc = mysql_query($query_Recordset1ccc, $connect_db) or die(mysql_error());
$row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc);
 
  ?>
 <link href="../css/style.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<style rel="stylesheet" type="text/css">
a {
	text-decoration: none;
}
 
</style>


<body>
<table width="1172" border="1" align="center" class="imagetable">
  <tr>
    <th height="40" colspan="15" bgcolor="#66FFFF"><div align="center" class="scimenu"><strong>รายการ mikrotik zone <?php print $domian_name;?></strong></div></th>
  </tr>
  <tr>
    <th width="56" bgcolor="#66FFFF" class="scimenu"><div align="center">ลำดับ</div></th>
    <th width="79" bgcolor="#66FFFF" class="scimenu">edit</th>
    <th width="78" bgcolor="#66FFFF" class="scimenu"><div align="center">ชื่อ</div></th>
  <th width="96" bgcolor="#66FFFF" class="scimenu"><div align="center">VPN IP </div></th>  
    <th width="49" bgcolor="#66FFFF" class="scimenu"><div align="center">User <br>
    online </div></th>
    <th width="55" bgcolor="#66FFFF" class="scimenu">HOSTS CONNECT</th>
    <th width="52" bgcolor="#66FFFF" class="scimenu"><div align="center">Online</div></th>
    <th width="129" bgcolor="#66FFFF" class="scimenu"><div align="center">Total,Free memory  </div></th>
    <th width="78" bgcolor="#66FFFF" class="scimenu"><div align="center">CPU USE <br>
    Click View Process </div></th>
    <th width="75" bgcolor="#66FFFF" class="scimenu"><div align="center">Board</div></th>
    <th width="83" bgcolor="#66FFFF" class="scimenu">Public IP </th>
    <th width="84" bgcolor="#66FFFF" class="scimenu"><div align="center">Uptime  </div></th>
    <th width="74" bgcolor="#66FFFF" class="scimenu"> <div align="center">lastupdate  </div></th>
    <th width="32" bgcolor="#66FFFF" class="scimenu"><div align="center">TF</div></th>
    <th width="58" bgcolor="#66FFFF" class="scimenu"><div align="center">Reboot</div></th>
  </tr>
  <?php
$API = new routeros_api();
$x=1;
do { 
$mkid=$row_Recordset1ccc[mk_id];
$ipmk=$row_Recordset1ccc[ip_vpn];
$usermk=$row_Recordset1ccc[user];
$pmk=$row_Recordset1ccc[pass];
$gobal_ip=$row_Recordset1ccc[gobal_ip];
$status=$row_Recordset1ccc[status];
 $domainmik=$row_Recordset1ccc[domain];
 
 if( ($ipmk<>0) and  (  $status==1)   ){
$API->debug = false;
if ($API->connect($ipmk,$usermk ,$pmk )) {
$ARRAY = $API->comm("/ip/hotspot/active/print" );
   $inum= count ( $ARRAY );
   $ARRAY2 = $API->comm("/ip/hotspot/host/print" );
   $inum_online_all= count ( $ARRAY2 );
   $inum_online_all=$inum_online_all+1;
   $ARRAY3 = $API->comm("/system/resource/print");
 $first = $ARRAY3['0'];
$memperc = ($first['free-memory']/$first['total-memory']);
$hddperc = ($first['free-hdd-space']/$first['total-hdd-space']);
$mem = ($memperc*100);
$hdd = ($hddperc*100);
  
  $ARRAY4 = $API->comm("/system/identity/print" );
 $identity=$ARRAY4[0]['name'];
 
 if($identity <> NULL){
  $API->comm("/system/identity/set", array(
  "name"=> "$domainmik.$mkid",
));

 $query_identity = " update mikrotik_link set  link_name_config='$domainmik.$mkid'   where mk_id='$mkid'  ";
  mysql_query($query_identity, $connect_db) or die(mysql_error());
 }
 
if($inum==NULL) {$inum=1;}
   $API->disconnect();
  // print_r($ARRAY );
} else { 
$first['cpu-load']=0;  $first['board-name'] =NULL;  $gobal_ip=0;   $first['uptime']=0;
} // connect mik

 
 
 
 ?>
   <tr>
  <?php if($online >($row_Recordset1ccc[MAXUSER]-10)){ $BG_ART='#FF0066';  $AG='ผู้ใช้ ออนไลน์ เกินกว่าจำนวน ที่ระบบ บอร์ทจะรับไหว'; } else
   { $BG_ART='#FFFFFF'; $AG='ระบบ ปกติ';} 
   ?>
    <td class="txtContentBold"><div align="center"><?php print $x;?></div></td>
    <td bgcolor="<?php print $BG_ART;?>" class="txtContentBold" align=" <?php print $AG;?>"><div align="center"><a href="#search" onClick="newwindow=window.open('mikrotik_edit_link_name.php?linkid=<?php print $mkid;?>','detail_user','height=70,width=300,left=300,top=100,scrollbars=0');newwindow.focus();"> edit</a></div></td>
    <td bgcolor="<?php print $BG_ART;?>" class="txtContentBold" align=" <?php print $AG;?>"><div align="center" id="<?php print $mkid;?>"><?php print $row_Recordset1ccc[link_name];?></div></td>
   <td class="txtContentBold"><div align="center"><?php print $identity;?><br><?php print $row_Recordset1ccc[ip_vpn];?> </div></td>  
    <td class="txtContentBold"><div align="center"><a href="index.php?case_i=72&MK_ID=<?php print $row_Recordset1ccc[mk_id];?>"><?php print $inum;?></a></div></td>
<?php	//if($inum > 0 ){ $IMGS='online.gif';  }else   { $IMGS='offline.gif'; }
if($row_Recordset1ccc[ip_vpn] !=0){ $IMGS='online.gif';  }else   { $IMGS='offline.gif'; }  ?>
<?php //	if($inum_online_all > 0 ){ $IMGS='online.gif';  }else   { $IMGS='offline.gif'; } ?>
    <td class="txtContentBold"><div align="center"><?php print $inum_online_all;?></div></td>
    <td class="txtContentBold"><div align="center"> <img src='<?php print $IMGS;?>'></div></td>
    <td class="txtContentBold"><div align="center"><?php print  number_format($first['total-memory']/1024,0) . "Mb - " . number_format($first['free-memory']/1024,0) . "Mb - " . number_format($mem,3) . "%"; ?></div></td>
    <td class="txtContentBold"><div align="center"><a href="index.php?case_i=84&MK_ID=<?php print $mkid;?>"> <?php print $first['cpu-load'] .'%'; ?></a></div></td>
	<td class="txtContentBold"><div align="center"><?php print    $first['board-name'] . " V "  . $first['version'] ;?></div></td>
	<td class="txtContentBold"><div align="center">(<?php print $gobal_ip;?>)</div></td>
	<td class="txtContentBold"><div align="center"><?php print  $first['uptime'] . " (hh/mm/ss)" ;?></div></td>
    <td class="txtContentBold"> <div align="center"><?php print $row_Recordset1ccc[lastupdate];?></div></td>
    <td class="txtContentBold"><a href="http://<?php print $ipmk;?>.t-voip0.zapto.org:99/" target="_blank">VIEW</a></td>
  <td class="txtContentBold"><div align="center" ><a href="index.php?case_i=20&reboot=yes&linkid=<?php print $row_Recordset1ccc[mk_id];?>">Reboot</a></div></td>
  </tr>
  <?php  
 
   } else { // if($ipmk<>0)?>
      <tr>
 
    <td class="txtContentBold"><div align="center"><?php print $x;?></div></td>
     <td bgcolor="<?php print $BG_ART;?>" class="txtContentBold" align=" <?php print $AG;?>"><div align="center"><a href="#search" onClick="newwindow=window.open('mikrotik_edit_link_name.php?linkid=<?php print $mkid;?>','detail_user','height=70,width=300,left=300,top=100,scrollbars=0');newwindow.focus();"> edit</a></div></td>
    <td bgcolor="#FFFFFF" class="txtContentBold" align=" <?php print $AG;?>"><div align="center" id="<?php print $mkid;?>"><?php print $row_Recordset1ccc[link_name];?></div></td>
    <td class="txtContentBold"><div align="center">-</div></td>  
    <td class="txtContentBold"><div align="center"><a href="index.php?case_i=72&MK_ID=<?php print $row_Recordset1ccc[mk_id];?>">0</a></div></td>
	
    <td class="txtContentBold"><div align="center">0</div></td>
    <td class="txtContentBold"><div align="center"> <img src='offline.gif'></div></td>
    <td class="txtContentBold"><div align="center">0</div></td>
    <td class="txtContentBold"><div align="center">0</div></td>
	<td class="txtContentBold"><div align="center">0</div></td>
	<td class="txtContentBold"><div align="center">0</div></td>
	<td class="txtContentBold"><div align="center">0</div></td>
    <td class="txtContentBold"> <div align="center"><?php print $row_Recordset1ccc[lastupdate];?></div></td>
    <td class="txtContentBold"><a href="http://<?php print $ipmk;?>.t-voip0.zapto.org:99/" target="_blank">VIEW</a></td>
  <td class="txtContentBold"><div align="center" ><a href="index.php?case_i=20&reboot=yes&linkid=<?php print $row_Recordset1ccc[mk_id];?>">Reboot</a></div></td>
  </tr>
  <?php }
 $x++; 
 $identity=NULL;
  } while ($row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc)); 

 ?>
 <?php  ?>
</table>
<?php
echo  "<meta http-equiv=refresh content=300;URL=index.php?case_i=20>";
   if($_SESSION["adminpass"]=='tlog'){ 
// print_r($ARRAY4);
 //print $ARRAY4[0]['name'];
 }
?>
</body>
</html>
