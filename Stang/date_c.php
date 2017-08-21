<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body>
<?php 
                    include("Connections/dbconnect.php");
					       $query_user2 = "select  * from register      where UserName='1'              ";
       $type_user2 = mysql_query($query_user2, $connect_db) or die(mysql_error());
	   $row_Recordset2 = mysql_fetch_assoc($type_user2);
					  $a_name=$row_Recordset2[UserName];
						  $query_time= "select  *  from radcheck      where UserName='$a_name'   and Attribute='Expiration'              ";
                     $type_time = mysql_query($query_time, $connect_db) or die(mysql_error());
	                     $row_time_db = mysql_fetch_assoc($type_time);
						  $date_db=$row_time_db[Value];
							  #ทำการแยกวันที่ เวลา จากตัวแปร  $date_db มาเป็น array
								   $a_time= explode(" ",$date_db) ;
									  $a_time[0];  //วัน
									 $a_time[1];  //เดือน
										  $a_time[2];  //ปี
										  print  $a_time[0].$a_time[1].$a_time[2]; 
										  print "<br>";
										  
     $date0 = date("Y-m-d");
     $date1 = "2008-12-30";
      echo  "ยังไม่หมดอายุ<br>";
     echo "$date0   -  $date1 ==".( strtotime($date0) - strtotime($date1) ) / ( 60 * 60 * 24 ); // 7
     echo "<br>";
	 echo  " หมดอายุ<br>";
     echo "$date1   -  $date0 ==". ( strtotime($date1) - strtotime($date0) ) / ( 60 * 60 * 24 ); // -25
     echo "<br>";
	 #วันนี้อีก+ 45 วัน
echo date('Y-m-d', mktime(0,0,0, date('m'),date('d')+45,date('Y')));
echo "<br>";
$a=1;
$b=-2;
echo $a+$b;
?>
</body>
</html>
