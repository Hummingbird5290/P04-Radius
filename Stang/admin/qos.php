 <?php
  include("../include/chklogin.php");
  function ConvertSize($bytes)
{
	$size = $bytes / 1000;

	if($size < 1000)
	{
		$size = number_format($size, 0);

		$size .= 'K';
	}
	else
	{
		if($size / 1000 < 1000)
		{
			$size = number_format($size / 1000, 0);

			$size .= 'M';
		}
		else if ($size / 1000 / 1000 < 1000)
		{
			$size = number_format($size / 1000 / 1000, 0);

			$size .= 'G';
		}
	}

	return $size;
}

/// ini_set('display_errors', 1);
// error_reporting(E_ALL);
//require_once('routeros_api.class.php'); //mikrotik api
  if($Submit =='update'){
 
   if($_SESSION["adminpass"]=='demo'){ 
      echo                  "<script type=text/javascript>";
		    echo                  "alert('����� ���ͺ�к� ��䢢���������� ��� :P ')";
	        echo                  "</script>";  
echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=77>";
exit();
}

  $webdata = preg_replace("[^0-9]","", $webdata); 
  $tdata = preg_replace("[^0-9]","", $tdata); 
  $otherdata = preg_replace("[^0-9]","", $otherdata); 
  
 $webdata = htmlspecialchars("$webdata", ENT_QUOTES);
 $tdata = htmlspecialchars("$tdata", ENT_QUOTES);
 $otherdata = htmlspecialchars("$otherdata", ENT_QUOTES);
		
  if($webdata ==""  or  $tdata=='' or $otherdata=='' )
{
 
 echo  "<meta http-equiv=refresh content=0;URL=index.php?case_i=77&mk_links=$mk_links>";
exit();
}
  if($webdata  >8 ) { $webdata=8;   }
    if($tdata  >8 ) { $webdata=8;   }
	  if($otherdata  >8 ) { $webdata=8;   }
  $query_Recordset1ccc = " Select  *  from  mikrotik_link  where domain='$domain_name'  and mk_id='$mk_links'";
$Recordset1ccc = mysql_query($query_Recordset1ccc, $connect_db) or die(mysql_error());
$row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc);
$d=1;
 
$ipmk=$row_Recordset1ccc[ip_vpn];
$usermk=$row_Recordset1ccc[user];
$pmk=$row_Recordset1ccc[pass];
$gobal_ip=$row_Recordset1ccc[gobal_ip];

 $API = new routeros_api();  
 $API->debug = false ;
 if ($API->connect($ipmk,$usermk ,$pmk )) {
 
 $API->comm("/queue/tree/remove", array(
  ".id"=> "$webid",
));

  $API->comm("/queue/tree/remove", array(
  ".id"=> "$tid",
));

  $API->comm("/queue/tree/remove", array(
  ".id"=> "$otherid",
));

  $API->comm("/queue/tree/add", array(
  "name"=> "web",
   "parent"=> "global",
   "packet-mark"=> "web",
   "priority"=> "$webdata",
 "queue"=> "default",
 ));
  $tmaxlimit = htmlspecialchars("$tmaxlimit", ENT_QUOTES);
   $API->comm("/queue/tree/add", array(
  "name"=> "torrents",
   "parent"=> "global",
   "packet-mark"=> "torrents",
   "priority"=> "$tdata",
 "queue"=> "default",
 "max-limit"=> "$tmaxlimit",

 ));
   $omaxlimit = htmlspecialchars("$omaxlimit", ENT_QUOTES);
   $API->comm("/queue/tree/add", array(
  "name"=> "others",
   "parent"=> "global",
   "packet-mark"=> "others",
   "priority"=> "$otherdata",
 "queue"=> "default",
  "max-limit"=> "$omaxlimit",
 ));
 } //api connect
 echo  "<meta http-equiv=refresh content=0;URL=index.php?case_i=77&mk_links=$mk_links>";
exit();
 
 }

 
  ?>
 <link href="../css/style.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<style rel="stylesheet" type="text/css">
a {
	text-decoration: none;
}
 
.styleax {
	font-family: "MS Sans Serif", Tahoma, sans-serif;
	font-size: 16px;
}
</style>


<body>
<?php  if($mk_links==NULL){  ?>
<form name="selecthost" method="post" action="index.php?case_i=77"> 
 �ô���͡ mikrotik link<select name="mk_links" >
		
		  <?php
 
 $query_server_HOST = "SELECT  *   FROM   mikrotik_link  where domain='$domain_name'  ";
 $Recordset_server_HOST = mysql_query($query_server_HOST, $connect_db) or trigger_error(mysql_error(),E_USER_ERROR); 
$row_Recordset_server_HOST = mysql_fetch_assoc($Recordset_server_HOST);
do {
?>
            <option value="<?php print $row_Recordset_server_HOST[mk_id];?>"><?php print $row_Recordset_server_HOST[link_name];?> </option>
      <?php  }   while ($row_Recordset_server_HOST = mysql_fetch_assoc($Recordset_server_HOST));    ?>   
          </select>
<input type="submit" name="Submit" value="Select"  class="styled-button-2"  >
</form>
 
  <?php } else {
  
  $query_Recordset1ccc = " Select  *  from  mikrotik_link  where domain='$domain_name'  and status='1'  and mk_id='$mk_links'";
$Recordset1ccc = mysql_query($query_Recordset1ccc, $connect_db) or die(mysql_error());
$row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc);
$d=1;
  do { 
$ipmk=$row_Recordset1ccc[ip_vpn];
$usermk=$row_Recordset1ccc[user];
$pmk=$row_Recordset1ccc[pass];
$gobal_ip=$row_Recordset1ccc[gobal_ip];
   $API = new routeros_api();
 
     $API->debug = false ;
 
 
if ($API->connect($ipmk,$usermk ,$pmk )) {
   $ARRAY1 = $API->comm("/queue/tree/print" , array(
  "?name" => "web",
));
 $ARRAY2 = $API->comm("/queue/tree/print" , array(
  "?name" => "torrents",
));

 $ARRAY3 = $API->comm("/queue/tree/print" , array(
  "?name" => "others",
));


 $API->disconnect();
 
 } 
if($row_Recordset1ccc[link_name]!=NULL){  
//print_r($ARRAY2);
print '<br>';
$qosdata['web']['id']= $ARRAY1[0]['.id'];
$qosdata['torrents']['id']= $ARRAY2[0]['.id'];
$qosdata['others']['id']= $ARRAY3[0]['.id'];
$qosdata['web']['priority']= $ARRAY1[0][priority];
$qosdata['torrents']['priority']= $ARRAY2[0][priority];  $qosdata['torrents']['max-limit']= $ARRAY2[0]['max-limit'];
$qosdata['others']['priority']= $ARRAY3[0][priority];     $qosdata['others']['max-limit']= $ARRAY3[0]['max-limit'];


  }
 ?>
   <h1>SET Priority <?php print $row_Recordset1ccc['link_name'];?></h1>
   <span class="styleax"><br>
����˹������Ţ�ӴѺ�����Ӥѭ ������Ţ 1-8 ���Ţ 1 �դ����Ӥѭ�٧�ش<br>
��Ҥ������� ����˹� �ҡ��˹���ҡ���Ҥ������ǡ���� �к� �ШӡѴ������������Թ��ҷ�������㹤������ǡ����������� � <br>
����й� ��á�˹� torrent  �� 8 �����������觼š�з��Ѻ���������<br>
�ҡ��ͧ��ú��ͤ torrent ����˹� �Ţ�� 1</span><br>

<br><br>

  <form name="qos" action="index.php?case_i=77"   method="post">
 <table width="603" border="0" class="imagetable">
  <tr>
    <th width="193">QOS NAME</th>
    <th width="347">Priority</th>
  </tr>
  <tr>
    <td>WEB(Port 80,443)</td>
    <td>
	 <input name="webdata"   type="text"  id="webdata" value="<?php print $qosdata['web'][priority];?>" size="4">
	 <input type="hidden" name="webid" value="<?php print $qosdata['web']['id'];?>" >
	  </td>
  </tr>
  <tr>
    <td>Torrents( P2P)</td>
    <td>	 <input name="tdata"   type="text"  id="webdata" value="<?php print $qosdata['torrents'][priority];?>" size="4">
	 <input type="hidden" name="tid" value="<?php print $qosdata['torrents']['id'];?>" >
	 B/W&nbsp;
	 <input name="tmaxlimit"   type="text"  id="tmaxlimit" value="<?php print ConvertSize($qosdata['torrents']['max-limit']);?>" size="4"> 
	 ������Ţ �� 800k ���� 5M </td>
  </tr>
    <tr>
    <td>Others (Port rang 1000-65535) </td>
    <td>
	 <input name="otherdata"   type="text"  id="webdata" value="<?php print $qosdata['others'][priority];?>" size="4">
	 <input type="hidden" name="otherid" value="<?php print $qosdata['others']['id'];?>" >&nbsp;
	  B/W&nbsp;
	 <input name="omaxlimit"   type="text"  id="omaxlimit" value="<?php print ConvertSize($qosdata['others']['max-limit']);?>" size="4">
	 ������Ţ �� 800k ���� 5M  
	 
	 </td>
  </tr>
    <tr>
      <td>&nbsp;<input type="hidden" name="mk_links" value="<?php print $row_Recordset1ccc['mk_id'];?>" ></td>
      <td><input type="submit" name="Submit" value="update"  class="styled-button-2"  ></td>
    </tr>
</table>
</form><br>

<hr>
<?php
  } while ($row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc)); 
  }  //select ?>
</body>
</html>
