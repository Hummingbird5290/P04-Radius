<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
$cc=1;
$datas=0;
For ($aa=1;$aa<=12;$aa++){
 
 #ค่ารวมทั้งหมด  AcctOutputOctets
    $query_Recordset1 = "SELECT COUNT( radacct.UserName ) AS data_Upload 
FROM radacct
WHERE radacct.AcctStartTime
BETWEEN  ' $year_gp-$aa-01 00:00:00'
AND  '$year_gp-$aa-31 00:00:00'
  ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
 
 
  //ใส่ค่าความสูงราฟ
  $bar_red->data[] =$row_Recordset1[data_Upload];
  $UserNamebar[$aa]="Month $aa";
  $a++; $cc++;
  $datas=$row_Recordset1[data_Upload]+$datas;
   
  // print $query_Recordset1."<br>";
///////////////
 
}
  
# create the graph object:
$g = new graph();
$g->title( "Online Bar Chart  of  Month $year_gp  ", '{font-size:20px; color: #FFFFFF; margin: 10px; background-color: #505050; padding:10px; padding-left: 25px; padding-right: 25px;}' );
$g->data_sets[] = $bar_red;
$g->set_x_axis_3d( 30 );
$g->x_axis_colour( '#909090', '#ADB5C7' );
$g->y_axis_colour( '#909090', '#ADB5C7' );
 
  
     
 $g->set_x_labels( array( $UserNamebar[1],$UserNamebar[2] ,$UserNamebar[3] ,$UserNamebar[4],$UserNamebar[5],$UserNamebar[6],$UserNamebar[7],$UserNamebar[8],$UserNamebar[9],$UserNamebar[10],$UserNamebar[11],$UserNamebar[12]
 )  ); 
 
             
$g->set_y_max( $datas );
$g->y_label_steps(10);
$g->set_y_legend( 'Thaigqsoft.com', 12, '#736AFF' );
echo $g->render();
 

?>


</body>
</html>
