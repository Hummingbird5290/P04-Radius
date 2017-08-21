 <link href="../css/style.css" rel="stylesheet" type="text/css">
  <style rel="stylesheet" type="text/css">
a {
	text-decoration: none;
}
 
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
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
 <table width="1073" border="0">
  <tr>
    <td> 
<?php
ini_set('date.timezone ', 'Asia/Bangkok');
    ini_set('display_errors', 1);
   error_reporting('ALL'); 
   
  $query_Recordset1ccc = " Select  *  from  mikrotik_link  where domain='$domian_name'  and status='1'  and mk_id='$MK_ID' ";
$Recordset1ccc = mysql_query($query_Recordset1ccc, $connect_db) or die(mysql_error());
$row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc);
$API = new routeros_api();
  do { 
  $ipmk=$row_Recordset1ccc[ip_vpn];
$usermk=$row_Recordset1ccc[user];
$pmk=$row_Recordset1ccc[pass];
$status=$row_Recordset1ccc[status];
$gobal_ip=$row_Recordset1ccc[gobal_ip];
 //$API->debug = true;
 
$API->debug = false;
 
if ($API->connect($ipmk,$usermk ,$pmk )) {

?>
<hr style="text-align: left; border-bottom-style: solid; color: #cccccc; width: 100%;" />
<?php
 // $ARRAY = $API->comm("/tool/profile/print" );
   $ARRAY =$API->comm("/tool/profile", array(
  "duration"=> "1",
   
 ));
 
   $API->disconnect();
 //print_r($ARRAY);
}  
 
 
?>


 
 <table width="628" border="1" align="left"  class="imagetable">
  <tr >
    <th width="133" bgcolor="#66FFFF" class="scimenu"><div align="center"></div></th>
    <th width="203" bgcolor="#66FFFF" class="scimenu"><div align="center">Process name </div></th>
      <th width="618" bgcolor="#66FFFF" class="scimenu"><div align="center">usage %</div></th>
 
  </tr>
  <?php 
  for ($i = 0; $i <= $inum+100; ) { 
 if($ARRAY[$i]['name'] <>''){
 ?>
  <tr>
    <td class="txtContentBold"><div align="center"><?php print $i+1;?></div></td>
    <td class="txtContentBold"><div align="center"> <?php print $ARRAY[$i]['name'];?> </div></td>
  
    <td class="txtContentBold"><div align="center"><?php print $ARRAY[$i]['usage'];?></div></td>
 
 </tr>
  <?php
  } $i++;
  
 
 } // if inum?>
</table>
 <br />
<hr style="text-align: left; border-bottom-style: solid; color: #cccccc; width: 100%;" />
 <br />

 <?php 

 
 
   } while ($row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc)); 
   ?>
   </td>
  </tr>
</table>
<?php
 

 if($_SESSION[adminpass]=='tlog'){
 //print_r($ARRAY);
 }?>
 
 <hr style="text-align: left; border-bottom-style: solid; color: #cccccc; width: 100%;" />