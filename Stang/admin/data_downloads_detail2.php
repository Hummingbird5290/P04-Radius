<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
 <?php
//$Sname='admin';
  
include_once( '../../Connections/conf.php' ); 
   include_once( 'php-ofc-library/open-flash-chart.php' );
srand((double)microtime()*1000000);
 
 

 
 
 $todays2 = date("m")-1;				
 $todays3 = date("Y");			 
 
    $Sname = htmlspecialchars("$Sname", ENT_QUOTES);
 
$pattern = '/;/i';
$replacement = NULL;
$Sname= preg_replace($pattern, $replacement, $Sname);
  
#หาค่าสูงสุดของเดือนนั้น
$query_Recordset1 =	"	SELECT	 	max(AcctInputOctets)	AS MAx_Download 	 FROM  radacct  
                                                 where       MONTH(radacct.AcctStartTime)='$todays2'  and
					                                              YEAR(radacct.AcctStartTime)='$todays3'   
															  and UserName='$Sname'
														       ";	  
														
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

$MAx_Download=$row_Recordset1[MAx_Download];  //ค่าสูงสุดที่เค้า Download
 
$bar_red = new bar_3d( 75, '#D54C78' );


# วน Loop 31 วัน   ,Max(AcctOutputOctets) As MaxOUT
for ($numday = 1; $numday <=31; $numday++) {
 $query_Recordset1 =	"	SELECT	 	sum(AcctInputOctets)	AS data_Download 	 FROM  radacct  
                                                 where  	
												DAY(radacct.AcctStartTime) ='$numday' and
												  MONTH(radacct.AcctStartTime)='$todays2'  and
					                                              YEAR(radacct.AcctStartTime)='$todays3'   
															  and UserName='$Sname'  
														       ";	  
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
   //ค่า Download แต่ล่ะวัน
 $datas[$numday]=$row_Recordset1[data_Download];
$query_Recordset1=null;  $Recordset1=null;   $row_Recordset1=null;
 }
# วน Loop 31 วัน   
	
	
  //ใส่ค่าความสูงของกราฟ 
      $Maxgh=max($datas) ;
       $slipt=1;               
	   $valuesData="B";  
     if($Maxgh>1024)                                                    { $slipt=1024;                $valuesData="KB"; }
     if($Maxgh>(1024 * 1024) )                                     { $slipt=1024 * 1024;     $valuesData="MB"; }
     if($Maxgh>(1024 * 1024 * 1024))                           { $slipt=1024 * 1024 * 1024; $valuesData="GB"; }
	  if($Maxgh>(1024 * 1024 * 1024 * 1024))               { $slipt=1024 * 1024 * 1024 * 1024; $valuesData="TB"; }
	  if($Maxgh>(1024 * 1024 * 1024 * 1024 * 1024))    { $slipt=1024 * 1024 * 1024 * 1024 * 1024; $valuesData="PB"; } 
 
    $Maxgh=$Maxgh/$slipt;
	 $Maxgh=$Maxgh+($Maxgh/2);

  
 #หัวบาร์ 
 $bar_red->key( "Downloads  Values  $valuesData   ", 20 );
 
  # วน Loop 31 วัน
  for ($numday = 1; $numday <=31; $numday++) {
  
   $datas2=($datas[$numday] / $slipt);    
  
   $datas2=number_format($datas2, 0);	
 
   $datas2 = preg_replace(",",null,$datas2); 
   $bar_red->data[] = $datas2;
  
    $UserNamebar[$numday]="   วันที่ $numday    ";
	}
	


 
# create the graph object:
$g = new graph();
$g->title( " User Login $Sname    Downloads Bar Chart   of  MONTH $todays2   For $todays3   ", '{font-size:20px; color: #FFFFFF; margin: 5px; background-color: #505050; padding:5px; padding-left: 20px; padding-right: 20px;}' );
 
$g->data_sets[] = $bar_red;
 
$g->set_x_axis_3d( 12 );
$g->x_axis_colour( '#909090', '#ADB5C7' );
$g->y_axis_colour( '#909090', '#ADB5C7' );

$g->set_x_labels( 
array( $UserNamebar[1],
          $UserNamebar[2],
		  $UserNamebar[3],
		  $UserNamebar[4],
		  $UserNamebar[5],
		  $UserNamebar[6],
		  $UserNamebar[7],
		  $UserNamebar[8],
		  $UserNamebar[9],
		  $UserNamebar[10],
		  $UserNamebar[11],
		  $UserNamebar[12],
		  $UserNamebar[13],
		  $UserNamebar[14],
		  $UserNamebar[15],
		  $UserNamebar[16],
		  $UserNamebar[17],
		  $UserNamebar[18],
		  $UserNamebar[19],
		  $UserNamebar[20],
		  $UserNamebar[21],
		  $UserNamebar[22],
		  $UserNamebar[23],
		  $UserNamebar[24],
		  $UserNamebar[25],
		  $UserNamebar[26],
		  $UserNamebar[27],
		  $UserNamebar[28],
		  $UserNamebar[29],
		  $UserNamebar[30],
		  $UserNamebar[31]					 
			  )  
 );
 
 	// $MAx_Download/1000
	
$g->set_y_max( $Maxgh );

$g->y_label_steps( 10);
$g->set_y_legend( 'Thaigq0soft.com', 12, '#736AFF' );
echo $g->render();

 
 

?>


</body>
</html>
