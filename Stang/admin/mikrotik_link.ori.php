 <?php
  include("../include/chklogin.php");
/// ini_set('display_errors', 1);
// error_reporting(E_ALL);
//require_once('routeros_api.class.php'); //mikrotik api
 if($reboot=='yes'){
 
  if($_SESSION["adminpass"]=='demo'){ 
      echo                  "<script type=text/javascript>";
		    echo                  "alert('ผู้ใช้ ทดสอบระบบ สั่งรีบูตไม่ได้น่ะ จ๊ะ :P ')";
	        echo                  "</script>";  
echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=20>";
exit();
}
  
			  
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
$query_Recordset1ccc = " Select  *  from  mikrotik_link  where domain='$domian_name'  and status='1' ";
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
<table width="1080" border="1" align="center" class="imagetable">
  <tr>
    <th height="40" colspan="14" bgcolor="#66FFFF"><div align="center" class="scimenu"><strong>รายการ mikrotik zone <?php print $domian_name;?></strong></div></th>
  </tr>
  <tr>
    <th width="60" bgcolor="#66FFFF" class="scimenu"><div align="center">ลำดับ</div></th>
    <th width="86" bgcolor="#66FFFF" class="scimenu"><div align="center">ชื่อ</div></th>
    <th width="105" bgcolor="#66FFFF" class="scimenu"><div align="center">Mac</div></th>
    <th width="51" bgcolor="#66FFFF" class="scimenu"><div align="center">User <br>
    online </div></th>
    <th width="53" bgcolor="#66FFFF" class="scimenu">HOSTS CONNECT</th>
    <th width="53" bgcolor="#66FFFF" class="scimenu"><div align="center">Online</div></th>
    <th width="154" bgcolor="#66FFFF" class="scimenu"><div align="center">Total,Free memory  </div></th>
    <th width="41" bgcolor="#66FFFF" class="scimenu"><div align="center">CPU USE </div></th>
    <th width="108" bgcolor="#66FFFF" class="scimenu"><div align="center">Board</div></th>
    <th width="89" bgcolor="#66FFFF" class="scimenu">Public IP </th>
    <th width="89" bgcolor="#66FFFF" class="scimenu"><div align="center">Uptime  </div></th>
    <th width="25" bgcolor="#66FFFF" class="scimenu"> <div align="center">lastupdate  </div></th>
    <th width="25" bgcolor="#66FFFF" class="scimenu"><div align="center">TF</div></th>
    <th width="53" bgcolor="#66FFFF" class="scimenu"><div align="center">Reboot</div></th>
  </tr>
  <?php
$d=1;
  do { 
$ipmk=$row_Recordset1ccc[ip_vpn];
$usermk=$row_Recordset1ccc[user];
$pmk=$row_Recordset1ccc[pass];
$gobal_ip=$row_Recordset1ccc[gobal_ip];
   $API = new routeros_api();
  $API2 = new routeros_api();
     $API->debug = false;
	$API2->debug = false;
 
if ($API->connect($ipmk,$usermk ,$pmk )) {
   $ARRAY = $API->comm("/ip/hotspot/host/print" );
   $inum_host_all= count ( $ARRAY );
   $ARRAY = $API->comm("/ip/hotspot/active/print" );
   $inum= count ( $ARRAY );
   //COU RAM USE
   $API2->connect($ipmk,$usermk ,$pmk );
$ARRAY2 = $API2->comm("/system/resource/print");
 $first = $ARRAY2['0'];
$memperc = ($first['free-memory']/$first['total-memory']);
$hddperc = ($first['free-hdd-space']/$first['total-hdd-space']);
$mem = ($memperc*100);
$hdd = ($hddperc*100);

   $API->disconnect();
    $API2->disconnect();
   $online= 'online.gif';
}else {
$online= 'offline.gif';
$inum=0;
$memperc =0;
$hddperc = 0;
$mem =0;
$hdd = 0;
}
if($row_Recordset1ccc[link_name]!=NULL){ ?>
  <tr>
  <?php if($online >($row_Recordset1ccc[MAXUSER]-10)){ $BG_ART='#FF0066';  $AG='ผู้ใช้ ออนไลน์ เกินกว่าจำนวน ที่ระบบ บอร์ทจะรับไหว'; } else
   { $BG_ART='#FFFFFF'; $AG='ระบบ ปกติ';} 
   ?>
    <td class="txtContentBold"><div align="center"><?php print $d;?></div></td>
    <td bgcolor="<?php print $BG_ART;?>" class="txtContentBold" align=" <?php print $AG;?>"><div align="center"><?php print $row_Recordset1ccc[link_name];?></div></td>
    <td class="txtContentBold"><div align="center"><?php print $row_Recordset1ccc[mac];?> </div></td>
    <td class="txtContentBold"><div align="center"><a href="index.php?case_i=72&MK_ID=<?php print $row_Recordset1ccc[mk_id];?>"><?php print $inum;?></a></div></td>
	
    <td class="txtContentBold"><div align="center"><?php print $inum_host_all;?></div></td>
    <td class="txtContentBold"><div align="center"> <?php echo "<img src='$online'>"; ?></div></td>
    <td class="txtContentBold"><div align="center"><?php print  number_format($first['total-memory']/1024,0) . "Mb - " . number_format($first['free-memory']/1024,0) . "Mb - " . number_format($mem,3) . "%"; ?></div></td>
    <td class="txtContentBold"><div align="center"><?php print $first['cpu-load'] .'%'; ?></div></td>
	<td class="txtContentBold"><div align="center"><?php print    $first['board-name'] . " V "  . $first['version'] ;?></div></td>
	<td class="txtContentBold"><div align="center">(<?php print $gobal_ip;?>)</div></td>
	<td class="txtContentBold"><div align="center"><?php print  $first['uptime'] . " (hh/mm/ss)" ;?></div></td>
    <td class="txtContentBold"> <div align="center"><?php print $row_Recordset1ccc[lastupdate];?></div></td>
    <td class="txtContentBold"><a href="http://<?php print $ipmk;?>.t-voip0.zapto.org:81/graphs/" target="_blank">VIEW</a></td>
  <td class="txtContentBold"><div align="center" ><a href="index.php?case_i=20&reboot=yes&linkid=<?php print $row_Recordset1ccc[mk_id];?>">Reboot</a></div></td>
  </tr>
  <?php    $d++;   }
   } while ($row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc)); ?>
</table>
</body>
</html>
