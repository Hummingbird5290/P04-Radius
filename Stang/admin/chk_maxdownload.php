<?php
ob_start();
@session_start(); 
extract($_POST);extract($_GET);extract($_REQUEST);
include("../Connections/dbconnect.php");
$domain_name=$_GET['domain_name'];
 $domain_system=$_GET['domain_name'];
 $username=$_GET[username];
 $HOTSPOT_IP=$_GET[HOTSPOT_IP];
 $todates_chk=date("Y-m-d");
 ?>
 <style type="text/css">
<!--
textarea,input,select {
	background-color: #FDFBFB;
	border: 1px #BBBBBB solid;
	padding: 2px;
	margin: 1px;
	font-size: 14px;
	color: #808080;
}

.tabula{
 
border-width: 1px; 
border-collapse: collapse; 
border-color: #c1c1c1; 
background-color: transparent;
font-family: verdana;
font-size: 11px;
}

body{ color: #737373; font-size: 12px; font-family: verdana; }

a, a:link, a:visited, a:active { color: #AAAAAA; text-decoration: none; font-size: 12px; }
a:hover { border-bottom: 1px dotted #c1c1c1; color: #AAAAAA; }
img {border: none;}
td { font-size: 12px; padding: 4px;}

-->
</style>
<?php
   	$query_Recordset1 = "SELECT 	sum(AcctOutputOctets) as t FROM radacct  where  UserName='$username'  and  AcctStartTime like '%$todates_chk%' ";
	$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	$a=$row_Recordset1[t];
 //LIMIT 3G

 
	
	function bytes2English($filesize)
	{
	if ($filesize<1048676)
		RETURN number_format($filesize/1024,1) . " KB";
	if ($filesize>=1048576 && $filesize<1073741824)
		RETURN number_format($filesize/1048576,1) . " MB";
	if ($filesize>=1073741824 && $filesize<1099511627776)
		RETURN number_format($filesize/1073741824,2) . " GB";
	if ($filesize>=1099511627776)
		RETURN number_format($filesize/1099511627776,2) . " TB";
	if ($filesize>=1125899906842624) //Currently, PB won't show due to PHP limitations
		RETURN number_format($filesize/1125899906842624,3) . " PB";
	}
	if($a > 0){
	 print  bytes2English($a);
	 } else {
 print $_GET[data];
	//print $a;
	 }
	if($a > 3221225472 ){
	 echo "<meta http-equiv=refresh content=0;URL=http://$HOTSPOT_IP/logout>";
	            	exit();
	}
	?>