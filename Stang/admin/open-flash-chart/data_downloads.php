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
$bar_red->key( 'Upload  % ', 20 );

// ใส่ค่าความสูงของกราฟโดยดึงมาจาก Database
 /* WHERE
      MONTH(radacct.AcctStartTime)='7'   
					                       and             YEAR(radacct.AcctStartTime)='$todays3'   
 */
 $todays2 = date("m");
 $todays3 = date("Y");			 
 
 #ค่ารวมทั้งหมด
   $query_Recordset1 = "SELECT      sum(radacct.AcctInputOctets)   AS data_Download   
                                              FROM  radacct  
											   WHERE   MONTH(radacct.AcctStartTime)='$todays2'   
					                                   and             YEAR(radacct.AcctStartTime)='$todays3'   
													    group by          radacct.UserName
                                  ORDER BY  sum(radacct.AcctInputOctets) DESC  LIMIT 5 ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$datas=0;
    do {  
   
  $datas=$row_Recordset1[data_Download]+$datas;
   	} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
	
	
  $query_Recordset1 = "SELECT   radacct.UserName,  radacct.AcctStartTime,  sum(radacct.AcctInputOctets)   AS data_Download   
                                              FROM  radacct     
											  	  WHERE   MONTH(radacct.AcctStartTime)='$todays2'   
					                                   and             YEAR(radacct.AcctStartTime)='$todays3'   
													   group by          radacct.UserName
                                  ORDER BY
                                  sum(radacct.AcctInputOctets) DESC  LIMIT 5 ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
 $a=1;
   do {  
  //ใส่ค่าความสูงราฟ
  $datas2=($row_Recordset1[data_Download] *100)/$datas;
  $datas2 = eregi_replace(",",'',$datas2); 
  $bar_red->data[] =$datas2; 
  $UserNamebar[$a]=$row_Recordset1[UserName];
  $a++;
  	} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));  

 
  
# create the graph object:
$g = new graph();
$g->title( 'UPload Bar Chart   of  MONTH ', '{font-size:20px; color: #FFFFFF; margin: 5px; background-color: #505050; padding:5px; padding-left: 20px; padding-right: 20px;}' );
 
$g->data_sets[] = $bar_red;
 
$g->set_x_axis_3d( 12 );
$g->x_axis_colour( '#909090', '#ADB5C7' );
$g->y_axis_colour( '#909090', '#ADB5C7' );

$g->set_x_labels( array( $UserNamebar[1],$UserNamebar[2],$UserNamebar[3],$UserNamebar[4],$UserNamebar[5]  )   );
$g->set_y_max( 100 );
$g->y_label_steps( 5 );
$g->set_y_legend( 'Thaigqsoft.com', 12, '#736AFF' );
echo $g->render();


?>


</body>
</html>
