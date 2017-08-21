<?php
ob_start();
session_start();
// print   $_SERVER["REQUEST_URI"];
extract($_POST);extract($_GET);extract($_REQUEST);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
 
<body>
 <?php
 
include_once( '../../Connections/conf.php' ); 
include_once( 'php-ofc-library/open-flash-chart.php' );
srand((double)microtime()*1000000);


$bar_red = new bar_3d( 75, '#D54C78' );
$bar_red->key( 'Online  ', 20 );

    $query_Recordset1 = "SELECT *   FROM gp_login_time   ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
 
 
   do {  
     $daygp=$row_Recordset1[daygp];	  	 	 	 	 	 	 
	$mountgp	=$row_Recordset1[mountgp];	    	 	 	 	 
	$year_gp	 	=$row_Recordset1[year_gp];	   	 	 	 	 	 	 
	 
   	} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); 

$datas=0;
For ($aa=0;$aa<=24;$aa++){
	$b=$aa+1;
 #ค่ารวมทั้งหมด  AcctOutputOctets
    $query_Recordset1 = "SELECT COUNT( radacct.UserName ) AS data_Upload 
FROM radacct
WHERE radacct.AcctStartTime
BETWEEN  ' $year_gp-$mountgp-$daygp $aa:00:00'
AND  '$year_gp-$mountgp-$daygp $b:00:00'
and radacct.UserName in (select UserName from register  where domain='$domain_name')
  ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
 
 
 
 
  //ใส่ค่าความสูงราฟ
  $bar_red->data[] =$row_Recordset1[data_Upload];
  $UserNamebar[$aa]="$aa";
  $a++;
  $datas=$row_Recordset1[data_Upload]+$datas;
   
  // print $query_Recordset1."<br>";
///////////////
}
  
# create the graph object:
$g = new graph();
$g->title( "Online Bar Chart  of  Time $year_gp-$mountgp-$daygp ", '{font-size:20px; color: #FFFFFF; margin: 5px; background-color: #505050; padding:5px; padding-left: 20px; padding-right: 20px;}' );
$g->data_sets[] = $bar_red;
$g->set_x_axis_3d( 24 );
$g->x_axis_colour( '#909090', '#ADB5C7' );
$g->y_axis_colour( '#909090', '#ADB5C7' );
 
  
     
 $g->set_x_labels( array( $UserNamebar[1],$UserNamebar[2] ,$UserNamebar[3] ,$UserNamebar[4],$UserNamebar[5],$UserNamebar[6],$UserNamebar[7],$UserNamebar[8],$UserNamebar[9],$UserNamebar[10],$UserNamebar[11],$UserNamebar[12],$UserNamebar[13],$UserNamebar[14],$UserNamebar[15],$UserNamebar[16],$UserNamebar[17],$UserNamebar[18],$UserNamebar[19],$UserNamebar[20],$UserNamebar[21],$UserNamebar[22],$UserNamebar[23],$UserNamebar[24])  ); 
 
             
$g->set_y_max( $datas );
$g->y_label_steps( $datas/5 );
$g->set_y_legend( 'Thaigqsoft.com', 12, '#736AFF' );
echo $g->render();
 

?>


</body>
</html>
