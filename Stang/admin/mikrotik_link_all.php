 <?php
  include("../include/chklogin.php");
/// ini_set('display_errors', 1);
// error_reporting(E_ALL);
//require_once('routeros_api.class.php'); //mikrotik api
 if($reboot=='yes'){
 

  
			  
 $query_Recordset1ccc = " Select  *  from  mikrotik_link  where     mk_id='$linkid'  and status='1'  and ip_vpn <>'0'  ";
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
$texts="$_SESSION[domain] �������к� $adminsss   ��� REBOOT $link_name  $b";	
mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('system', '$texts','$b'  ,'system','$domain' )") or trigger_error(mysql_error(),E_USER_ERROR);   
			  
echo  "<meta http-equiv=refresh content=5;URL=index.php?case_i=20>";
exit();
}
}



$query_Recordset1ccc = " Select  *  from  mikrotik_link     where  status='1'  and ip_vpn <> '0' order by  domain, link_name  ";
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
    <th height="40" colspan="14" bgcolor="#66FFFF"><div align="center" class="scimenu"><strong>��¡�� mikrotik zone <?php print $domian_name;?></strong></div></th>
  </tr>
  <tr>
    <th width="60" bgcolor="#66FFFF" class="scimenu"><div align="center">�ӴѺ</div></th>
    <th width="86" bgcolor="#66FFFF" class="scimenu"><div align="center">����</div></th>
 <?php if($_SESSION["adminpass"]=='tlog'){ ?>    <th width="105" bgcolor="#66FFFF" class="scimenu"><div align="center">VPN IP </div></th> <? } ?>
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
$API = new routeros_api();
$DD=1;
do { 
$mkid=$row_Recordset1ccc[mk_id];
$ipmk=$row_Recordset1ccc[ip_vpn];
$usermk=$row_Recordset1ccc[user];
$pmk=$row_Recordset1ccc[pass];
$gobal_ip=$row_Recordset1ccc[gobal_ip];
$status=$row_Recordset1ccc[status];
 
 
 if($ipmk<>0){
$API->debug = false;
if ($API->connect($ipmk,$usermk ,$pmk )) {
$ARRAY = $API->comm("/ip/hotspot/active/print" );
   $inum= count ( $ARRAY );
   $ARRAY2 = $API->comm("/ip/hotspot/host/print" );
   $inum_online_all= count ( $ARRAY2 );
   
$ARRAY3 = $API->comm("/system/resource/print");
 $first = $ARRAY3['0'];
$memperc = ($first['free-memory']/$first['total-memory']);
$hddperc = ($first['free-hdd-space']/$first['total-hdd-space']);
$mem = ($memperc*100);
$hdd = ($hddperc*100);


  $ARRAY4 = $API->comm("/system/identity/print" );
 $identity=$ARRAY4[0]['name'];
 /*
 if($identity <> NULL){
 
 $query_Recordset1idd= " Select domain  from  mikrotik_link     where mk_id='$mkid'  ";
$Recordset1cccss = mysql_query($query_Recordset1idd, $connect_db) or die(mysql_error());
$row_Recordset1iden = mysql_fetch_assoc($Recordset1cccss);
$DDNS=$row_Recordset1iden[domain];
 $query_identity = " update mikrotik_link set  link_name_config='$identity'   where mk_id='$mkid'  ";
 mysql_query($query_identity, $connect_db) or die(mysql_error());

  $API->comm("/system/identity/set", array(
  "name"=> "$DDNS.$mkid",
    ));
$DDNS=NULL;
}  //

*/

   $API->disconnect();
  // print_r($ARRAY );
} // connect mik

 
 
 
 ?>
   <tr>
  <?php if($online >($row_Recordset1ccc[MAXUSER]-10)){ $BG_ART='#FF0066';  $AG='����� �͹�Ź� �Թ���Ҩӹǹ ����к� ���취��Ѻ���'; } else
   { $BG_ART='#FFFFFF'; $AG='�к� ����';} 
   ?>
    <td class="txtContentBold"><div align="center"><?php print $DD;?></div></td>
    <td bgcolor="<?php print $BG_ART;?>" class="txtContentBold" align=" <?php print $AG;?>"><div align="center"><?php print $row_Recordset1ccc[link_name];?></div></td>
 <?php if($_SESSION["adminpass"]=='tlog'){  ?>  <td class="txtContentBold"><div align="center"><?php print $identity."<br>".$row_Recordset1ccc[ip_vpn];?> </div></td> <?php } ?>
    <td class="txtContentBold"><div align="center"><a href="index.php?case_i=72&MK_ID=<?php print $row_Recordset1ccc[mk_id];?>"><?php print $inum;?></a></div></td>
	
    <td class="txtContentBold"><div align="center"><?php print $inum_online_all;?></div></td>
    <td class="txtContentBold"><div align="center"> <img src='online.gif'></div></td>
    <td class="txtContentBold"><div align="center"><?php print  number_format($first['total-memory']/1024,0) . "Mb - " . number_format($first['free-memory']/1024,0) . "Mb - " . number_format($mem,3) . "%"; ?></div></td>
    <td class="txtContentBold"><div align="center"><?php print $first['cpu-load'] .'%'; ?></div></td>
	<td class="txtContentBold"><div align="center"><?php print    $first['board-name'] . " V "  . $first['version'] ;?></div></td>
	<td class="txtContentBold"><div align="center">(<?php print $gobal_ip;?>)</div></td>
	<td class="txtContentBold"><div align="center"><?php print  $first['uptime'] . " (hh/mm/ss)" ;?></div></td>
    <td class="txtContentBold"> <div align="center"><?php print $row_Recordset1ccc[lastupdate];?></div></td>
    <td class="txtContentBold"><a href="http://<?php print $ipmk;?>.t-voip0.zapto.org:81/graphs/" target="_blank">VIEW</a></td>
  <td class="txtContentBold"><div align="center" ><a href="index.php?case_i=20&reboot=yes&linkid=<?php print $row_Recordset1ccc[mk_id];?>">Reboot</a></div></td>
  </tr>
  <?php  
 
   } else { // if($ipmk<>0)?>
      <tr>
 
    <td class="txtContentBold"><div align="center"><?php print $i;?></div></td>
    <td bgcolor="#FFFFFF" class="txtContentBold" align=" <?php print $AG;?>"><div align="center"><?php print $row_Recordset1ccc[link_name];?></div></td>
  <?php if($_SESSION["adminpass"]=='tlog'){   ?>   <td class="txtContentBold"><div align="center">-</div></td> <?php } ?>
    <td class="txtContentBold"><div align="center"><a href="index.php?case_i=72&MK_ID=<?php print $row_Recordset1ccc[mk_id];?>">0</a></div></td>
	
    <td class="txtContentBold"><div align="center">0</div></td>
    <td class="txtContentBold"><div align="center"> <img src='offline.gif'></div></td>
    <td class="txtContentBold"><div align="center">0</div></td>
    <td class="txtContentBold"><div align="center">0</div></td>
	<td class="txtContentBold"><div align="center">0</div></td>
	<td class="txtContentBold"><div align="center">0</div></td>
	<td class="txtContentBold"><div align="center">0</div></td>
    <td class="txtContentBold"> <div align="center"><?php print $row_Recordset1ccc[lastupdate];?></div></td>
    <td class="txtContentBold"><a href="http://<?php print $ipmk;?>.t-voip0.zapto.org:81/graphs/" target="_blank">VIEW</a></td>
  <td class="txtContentBold"><div align="center" ><a href="index.php?case_i=20&reboot=yes&linkid=<?php print $row_Recordset1ccc[mk_id];?>">Reboot</a></div></td>
  </tr>
  <?php }
  $DD++;
   } while ($row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc)); 

 ?>
 <?php  ?>
</table>
</body>
</html>
