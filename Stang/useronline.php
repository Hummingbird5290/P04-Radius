<?php
$hostname_edoc = "127.0.0.1";
$database_edoc = "tlog_huzzun";   
$username_edoc = "thaigqsoft";
$password_edoc = "logserver";

$connect_db= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc) or trigger_error(mysql_error(),E_USER_ERROR); 
    mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
 
$days= date("d");
$days2= date("d")-1;
$mount = date("m");
$year_gp= date("Y");
 mysql_select_db($database_edoc); mysql_query( $connect_db)  or trigger_error(mysql_error(),E_USER_ERROR);
$query_Recordset1 = " SELECT  count(*)   as Client_UP  FROM radacct  WHERE AcctStopTime = 0 and       MONTH(AcctStartTime)='$mount'  and  YEAR(AcctStartTime)='$year_gp'      and DAY(radacct.AcctStartTime) in ( '$days' , '$days2'  )  ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

putenv('GDFONTPATH=/var/www');
	$font = "CaflischScriptPro-Regular.otf"; //ไฟล์ font ที่จะใช้
	$image = imagecreate(40,26);	//สร้างภาพโดยการกำหนดขนาด ยาว(แกน x), กว้าง(แกน y)
	$bg = imagecolorallocate($image,200,220,220); //กำหนดสีพื้น (ภาพ,Red,Green,Blue)
	
	$black = imagecolorallocate($image, 0, 0, 0); //กำหดนค่าสีของสีดำซึ่งจะใช้เป็นสีของตัวอักษร
	
	imagettftext($image,16,0,3,18,$black,$font,$row_Recordset1[Client_UP]);  //นำตัวอักษรจากฟอร์มมาวาดเป็นรูป
	
	header("Content-type:image/png");	//กำหนดชนิดของภาพตอนแสดงผลผ่าน browser
	imagepng($image);   //แสดงผลภาพที่สร้าง
	imagedestroy($image); //เมื่อ browser ดึงไปแสดงแล้วก็คืนค่าหน่วยคืนค่าหน่วยความจำให้กับระบบ <br>												 
?>
 