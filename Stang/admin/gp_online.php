<?php 
 include('phpgraphlib_v2.31/phpgraphlib.php');
 $hostname_edoc = "127.0.0.1";
$database_edoc = "radius";   
$username_edoc = "root";
$password_edoc = "010464088";
 
 
 
$connect_db= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc);
 mysql_select_db($database_edoc, $connect_db)  or trigger_error(mysql_error(),E_USER_ERROR);
 
 
$todays=date('Y-m-d', strtotime("-1 days"));
$a=1; $c=1;
for ($i = 0; $i <= 23; $i++) {
 $b=$a+1;   
 $DDT="$todays $a:00";
$todays2="$todays $b:00";
      $SQL="  SELECT    sum(AcctInputOctets) as a  FROM radacct  where   AcctStartTime BETWEEN '$DDT' AND '$todays2'     ";
 	$Recordset1 = mysql_query($SQL, $connect_db) or die(mysql_error());
	$row_download = mysql_fetch_assoc($Recordset1);
     	  $data[$c]= round($row_download[a]/1073741824 ,2) ;
	 
 
	$a++;  $c++;
} 
 
$graph = new PHPGraphLib(650,200);

 /*
$data = array(
"1" => $totalRows_online[0], 
"2" => $totalRows_online[1], 
"3" =>$totalRows_online[2],
"4" => $totalRows_online[3], 
"5" => $totalRows_online[4], 
"6" => $totalRows_online[5], 
"7" => $totalRows_online[6], 
"8" =>$totalRows_online[7], 
"9" => $totalRows_online[8], 
"10" => $totalRows_online[9], 
"11" => $totalRows_online[10], 
"12" => $totalRows_online[11], 
"13" => $totalRows_online[12], 
"14" => $totalRows_online[13],
 "15" => $totalRows_online[14],
  "16" => $totalRows_online[15],
   "17" => $totalRows_online[16],
    "18" => $totalRows_online[17],
	 "19" => $totalRows_online[18],
	  "20" => $totalRows_online[19],
	   "21" => $totalRows_online[20],
	    "22" => $totalRows_online[21],
		 "23" => $totalRows_online[22],
		  "24" => $totalRows_online[23],
);
 
 */
$graph->addData($data);
$graph->setTitle("Clients Per Max (Gigabyte ) Download $todays  ");
$graph->setBarColor('255,255,204');
$graph->setTextColor('gray');
$graph->setDataValues(true);
$graph->createGraph();
 
?>