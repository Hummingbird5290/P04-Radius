<?php
ob_start();
@session_start(); 
extract($_POST);extract($_GET);extract($_REQUEST);
//print_r($_SESSION);
/*
if($_SERVER['SERVER_PORT'] != 443) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    exit();

}
*/
if ($_SERVER['HTTP_CLIENT_IP']) {
$IP = $_SERVER['HTTP_CLIENT_IP'];
} elseif (preg_match("/[0-9]/",$_SERVER["HTTP_X_FORWARDED_FOR"] )) {
$IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else {
$IP = $_SERVER["REMOTE_ADDR"];
}
include("../Connections/dbconnect.php");
function re_date_radius_to_datedb($mounts)
{
  if($mounts=='Jan') { $num_rows="01"; }
  if($mounts=='Feb') { $num_rows="02"; } 
  if($mounts=='Mar') { $num_rows="03"; } 
  if($mounts=='Apr') { $num_rows="04"; } 
  if($mounts=='May') { $num_rows="05"; } 
  if($mounts=='Jun') { $num_rows="06"; } 
  if($mounts=='Jul') { $num_rows="07"; } 
  if($mounts=='Aug') { $num_rows="08"; } 
  if($mounts=='Sep') { $num_rows="09"; } 
  if($mounts=='Oct') { $num_rows="10"; } 
  if($mounts=='Nov') { $num_rows="11"; } 
  if($mounts=='Dec') { $num_rows="12"; } 
    return $num_rows;
}

//หาว่า ip นี้คือ mik ตัวใหน
if($_SESSION[adminpass] ==''){
$SMSSQL = " SELECT   link_name_config  from mikrotik_link   where gobal_ip='$IP'    ";
$Recordsetsms= mysql_query($SMSSQL, $connect_db) or die(mysql_error());
$row_sms = mysql_fetch_assoc($Recordsetsms);
$identity=$row_sms['link_name_config'];
}else 
{
$identity='admin_save';
}


 include("sms.php");
 $SMSSQL = " SELECT   * from mikrotik_link where gobal_ip='$IP'    ";
$Recordsetsms= mysql_query($SMSSQL, $connect_db) or die(mysql_error());
$row_sms = mysql_fetch_assoc($Recordsetsms);
 $sms = new thsms();
$sms->username   = $row_sms[users];
$sms->password   = $row_sms[pass];


 $SENDSMSNAME='020000000';
 $domain_name=$_GET['domain_name'];
 if($_GET['domain_name']!=NULL){
 $_SESSION['domain_name']=$_GET['domain_name'];
 }
 if($_GET['domain'] !=NULL){
 $_SESSION['domain_name']=$_GET['domain'];
  }
 
  $domain_name=$_SESSION['domain_name'];
if($domain_name==''){
	echo                  "<script type=text/javascript>";
		echo                  "alert('กรุณากรอกหมายเลขเติมเวลาใหม่')";
		echo                  "</script>";
		echo "<meta http-equiv=refresh content=0;URL=http://www.yahoo.com>";
		exit();
} 
 

function randomToken($len) {
	srand( date("s") );
	#$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	//$chars ="ABCDEFGHIJKLMQRSTUVWXYZ";
	$chars = "123456789"; // กำหนดอักขษะที่จะนำมา random แก้ได้นะ
	$ret_str = "";
	$num = strlen($chars);
	for($i=0; $i < $len; $i++) {
		$ret_str.= $chars[rand()%$num]; // ใช้ฟังชั่น rand() เข้ามาช่วยในการทำงาน
	}
	return $ret_str;
}
include("../include/function.php");
$date_active_card=date("Y-m-d H:i:s");

if($sumbit=='เติมเวลา'   ) {
$idcard = htmlspecialchars("$idcard", ENT_QUOTES);
$per = htmlspecialchars("$per", ENT_QUOTES);

	$per = preg_replace("/ /i", "", $per);
	$idcard = preg_replace("/ /i", "", $idcard);
	
 $pattern = '/;/i';
$replacement = NULL;
$per= preg_replace($pattern, $replacement, $per);
$idcard= preg_replace($pattern, $replacement, $idcard);

	if($chk_num !=$code1) {
		echo                  "<script type=text/javascript>";
		echo                  "alert('กรุณา กรอกข้อมูล รหัสรักษาความปลอดภัยให้ตรงกับรูปภาพ            ')";
		echo                  "</script>";
		echo "<meta http-equiv=refresh content=0;URL=active.php?domain_name=$domain_name&identity=$identity>";
		exit();
	}
	$time_active=date("H:i:s");

	if($per ==''  or $idcard=='' ) {
		echo                  "<script type=text/javascript>";
		echo                  "alert('กรุณา กรอกข้อมูล ให้ครบ             ')";
		echo                  "</script>";
		echo "<meta http-equiv=refresh content=0;URL=active.php?domain_name=$domain_name&identity=$identity>";
		exit();
	}
/*
 if($per==NULL){
 				echo                  "<script type=text/javascript>";
		            echo                  "alert(' ไม่มีชื่อผู้ใช้นี้ในระบบ ')";
		             echo                  "</script>";	   
 			 echo "<meta http-equiv=refresh content=0;URL=active.php?domain_name=$domain_name&identity=$identity>";
	            	exit();
 }
 */
 $passwds=md5($passwds);
	$todates_chk=date("Y-m-d");  //and  domain='$domain_name'
	if($_SESSION[adminpass] ==''){
	$query_user = "select  * from register      where UserName='$per'    and  password='$passwds'  "; // and idcard  not in  (    select  idcard  from table_card_user   )       ";
	}else {
	$query_user = "select  * from register      where UserName='$per'   "; 
	}
	$type_db = mysql_query($query_user, $connect_db) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($type_db);
	
	$TEL=$row_Recordset1[tel];
	$pattern = '/-/i';
$replacement = NULL;
$TEL= preg_replace($pattern, $replacement, $TEL);
$pattern = '/ /i';
$replacement = NULL;
$TEL= preg_replace($pattern, $replacement, $TEL);

	$UserName=$row_Recordset1[UserName];
	
	if($UserName==''){
				echo                  "<script type=text/javascript>";
		            echo                  "alert(' ไม่มีชื่อผู้ใช้นี้ในระบบ ')";
		             echo                  "</script>";	   
 			 echo "<meta http-equiv=refresh content=0;URL=active.php?domain_name=$domain_name&identity=$identity>";
	            	exit();
	}  //
 	$query_user = "select  * from card      where idcard='$idcard'   and  domain='$domain_name'  "; // and idcard  not in  (    select  idcard  from table_card_user   )       ";
	$type_db = mysql_query($query_user, $connect_db) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($type_db);
	$totalRows_user= mysql_num_rows($type_db);
	$GroupName=$row_Recordset1['GroupName'];

//กรณี พยายามเติมเลขบัตรผิดเกิน ห้าครั้งระบบ จะล๊อค ไอดีผู้ใช้งานทิ้งทันที
$stop_time=date("Y-m-d");
$query_user_chk_login = "select  count(id) as t  from noute_data      where texts like '%ชื่อผู้ใช้  $UserName  เติมเลขบัตรผิด%'  and  date_add='$stop_time'   "; 
$type_dblogon = mysql_query($query_user_chk_login, $connect_db) or die(mysql_error());
$row_chk_login = mysql_fetch_assoc($type_dblogon);

if($row_chk_login[t] == 4){	
 
///แจ้ง sms admin
 $texts="$domain_name: ระบบ บล๊อค ผู้ใช้งาน $UserName เนื่องจากกรอกเลขเติมเวลาบัตรผิดเกินห้าครั้ง ";
$TEL_admin='0878426256';
$cccc=  iconv('TIS-620', 'UTF-8', $texts);
$sms->send( "$SENDSMSNAME", $TEL_admin, $cccc);
}

if($row_chk_login[t] > 4){	
/*
update("register","status ='88'  "," where UserName='$UserName'    "); 
$tb="radcheck";
$sql_block = "delete from $tb where UserName='$UserName'  and Attribute='MD5-Password' ";
mysql_query($sql_block, $connect_db) or die(mysql_error());

 $texts="$domain_name: ระบบบล๊อค ผู้ใช้งาน $UserName เนื่องจากกรอกเลขเติมเวลาบัตรผิดเกินห้าครั้ง ";
 $b=date("Y-m-d H:i:s");
mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('$UserName', '$texts','$b'  ,'system','$domain_name' )") or trigger_error(mysql_error(),E_USER_ERROR);       

			  
          echo                  "<script type=text/javascript>";
		    echo                  "alert('$UserName กรอกรหัสผ่านผิดเกิน 5 ครั้ง ระบบจะบล๊อคไอของท่านทิ้งโปรดติดต่อผู้ดูแลระบบ ')";
	        echo                  "</script>";
  	*/	
	          echo                  "<script type=text/javascript>";
		    echo                  "alert('$UserName กรอกรหัสผ่านผิดเกิน 5 ครั้ง  โปรดระวัง การบล๊อคไอดีของท่าน ')";
	        echo                  "</script>";
	 echo "<meta http-equiv=refresh content=0;URL=active.php?domain_name=$domain_name&identity=$identity>";

	            	exit();
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	if($totalRows_user==0  ) {   //ตรวจสอบว่า มี cardid นี้อยุ่หรือไม่
		  
 $texts="$domain_name : ชื่อผู้ใช้  $UserName  เติมเลขบัตรผิด โดยใช้หมายเลข $idcard  ";
 $b=date("Y-m-d H:i:s");
mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('$UserName', '$texts','$b'  ,'system','$domain_name' )") or trigger_error(mysql_error(),E_USER_ERROR);       
			     
					echo                  "<script type=text/javascript>";
		            echo                  "alert(' ไม่มีหมายเลขบัตรนี้ในระบบ ')";
		             echo                  "</script>";	   
 			 echo "<meta http-equiv=refresh content=0;URL=active.php?domain_name=$domain_name&identity=$identity>";
	            	exit();
 }
 
	if($row_Recordset1[active]==1   ) {   //ตรวจสอบว่า มี cardid นี้อยุ่หรือไม่
		  
   echo "<h2><center>('บัตรนี้ ถูกใช้งานไปแล้ว  เมื่อ     ". date_to_thai_return($row_Recordset1[time_active])."   โดยผู้ใช้  $row_Recordset1[UserName] ')</center></h2><br>";
		        echo "<h1><center> <a href='active.php?domain_name=$domain_name'> กลับไปหน้าเติมบัตร</a></center></h1>";
					 
	            	exit();
 }  else {
 
 
		//      $query_user2 = "select  * from register      where per='$per'  and password=md5('$password')   and   status='1'     ";
		$query_user2 = "select  * from register      where UserName='$UserName'     and   status='1'  and  domain='$domain_name'    ";
		$type_user2 = mysql_query($query_user2, $connect_db) or die(mysql_error());
		$row_Recordset2 = mysql_fetch_assoc($type_user2);
		$a_name=$row_Recordset2[UserName];
		 
		$totalRows_user2= mysql_num_rows($type_user2);
		if($totalRows_user2 ==0   ) {
			echo                  "<script type=text/javascript>";
			echo                  "alert('ไม่มีผู้ใช้นี้ในระบบ  ')";
			echo                  "</script>";
			echo "<meta http-equiv=refresh content=0;URL=active.php?domain_name=$domain_name&identity=$identity>";
			exit();
		}   else {
//กรณีเป็นบัตรแบบชั่วโมง
if($row_Recordset1['type_time']=='ชั่วโมง'){
$total_day_from_card=$row_Recordset1['date_end'];
############### ดึงวันที่ หมดอายุในฐานข้อมูลมาอัพเดท ######
								$query_time= "select  *  from radcheck      where UserName='$a_name'   and Attribute='Expiration'              ";
				$type_time = mysql_query($query_time, $connect_db) or die(mysql_error());
				$row_time_db = mysql_fetch_assoc($type_time);
				$date_db=$row_time_db[Value];
                $date_dbFor_2=$row_time_db[Value];
				if($date_db !=''){
				#ทำการแยกวันที่ เวลา จากตัวแปร  $date_db มาเป็น array
				$a_time= explode(" ",$date_db) ;
				$a_time[0];  //วัน
				$a_time[1];  //เดือน
				$a_time[2];  //ปี
				#แปลง เดือน เป็น ตัวเลข
				$a_time[1]=re_name($a_time[1]);
				$date_db="$a_time[2]-$a_time[1]-$a_time[0]";
				$date_now=date("Y-m-d");
				$cal_date=(strtotime($date_now) - strtotime($date_db) ) / ( 60 * 60 * 24 );
				$cal_date2=(strtotime($date_db) - strtotime($date_now) ) / ( 60 * 60 * 24 );
				} else {
				$cal_date=0;
				}
				#ถ้า $cal_date  > 0  ต้องเอาผลต่างมาบวก เพื่อเพิ่มวัน แต่ ถ้า < 0 ก็แค่เพิ่มวัน register ไป
					if($cal_date > 0  ) {
			//กรณีมีวันเหลือในระบบ
			print "ท่านยังเหลือวันใช้งาน ไม่สามารถ ใช้คูปอง เติมเวลาแบบชั่วโมงได้ ต้องรอให้ เวลาของท่านหมดเสียก่อน";
			exit();
			}	
           if($cal_date < 0  or  $cal_date ==0 ) {
			//กรณี เวลาในระบบหมดแล้ว
               $query_time2= "select  *  from radcheck      where UserName='$a_name'   and Attribute='Max-All-Session'              ";
				$type_time2 = mysql_query($query_time2, $connect_db) or die(mysql_error());
				$row_time_db2 = mysql_fetch_assoc($type_time2);
				$date_dbTime=$row_time_db2[Value];
				
			$date_add_time=$row_Recordset1['date_end']+$date_dbTime;
                         mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Expiration'  ") ; //ลบฟิววันทิ้ง
						 mysql_query("delete   from   usergroup  where  UserName='$a_name'   ") ;
                        mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Max-All-Session'  ") ;
				       update("radacct", "AcctSessionTime='0'  "," where UserName='$a_name'     ");
					   mysql_query("INSERT INTO  table_card_user  (idcard,UserName,active,domain)   values('$idcard','$a_name','1','$domain_name')") or    die ("Add ข้อมูลลง Table ไม่ได้ ");
					   update("card", "active='1' , UserName='$a_name' ,time_active='$date_active_card' ,identity='$identity'    "," where idcard='$idcard'  and domain='$domain_name'     ");
                       mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)   values('$a_name','Max-All-Session',':=','$date_add_time')") or    die ("Add ข้อมูลลง Table ไม่ได้ ");
					   $date_add_time=($date_add_time/60)/60;
$msg_s=" $domain_name: เติมเวลา $a_name เรียบร้อยแล้ว วันหมดอายุการใช้งาน  $date_add_time ชั่วโมง   <br>";
print $msg_s;
exit();
			}		
}		
		
	// echo "วัน";
				############### ดึงวันที่ หมดอายุในฐานข้อมูลมาอัพเดท ######

				$query_time= "select  *  from radcheck      where UserName='$a_name'   and Attribute='Expiration'              ";
				$type_time = mysql_query($query_time, $connect_db) or die(mysql_error());
				$row_time_db = mysql_fetch_assoc($type_time);
				$date_db=$row_time_db[Value];
                $date_dbFor_2=$row_time_db[Value];
				#ทำการแยกวันที่ เวลา จากตัวแปร  $date_db มาเป็น array
				$a_time= explode(" ",$date_db) ;
				$a_time[0];  //วัน
				$a_time[1];  //เดือน
				$a_time[2];  //ปี
				#แปลง เดือน เป็น ตัวเลข
				$a_time[1]=re_name($a_time[1]);
				$date_db="$a_time[2]-$a_time[1]-$a_time[0]";
				$date_now=date("Y-m-d");
				$cal_date=(strtotime($date_now) - strtotime($date_db) ) / ( 60 * 60 * 24 );
				$cal_date2=(strtotime($date_db) - strtotime($date_now) ) / ( 60 * 60 * 24 );
				#ถ้า $cal_date  > 0  ต้องเอาผลต่างมาบวก เพื่อเพิ่มวัน แต่ ถ้า < 0 ก็แค่เพิ่มวัน register ไป
				#กรณียังมีวันเหลือในฐานข้อมูล แต่ซื้อเงินมาเติมวันเพิ่ม
				
				if($cal_date < 0  ) {
			//กรณีมีวันเหลือในระบบ
		 	// 	include("no_user_time.php");
			   $radius_time= explode(" ",$date_dbFor_2) ; //แปลงวันที่เดิมให้อยู่ในรูปแบบวันที่ใน DB
		 		$radius_time[2];    //ปี
			 	$radius_time[1];    //เดือน
		 		$radius_time[0];     //วัน
		 	 	$date_add_db_system=re_date_radius_to_datedb($radius_time[1]);
				$Hourts=date("H:i:s");
				$date_for_add_db="$radius_time[2]-$date_add_db_system-$radius_time[0] $Hourts"; //เป็นวันที่ ที่แปลงมาจากวันที่ที่ผู้ใช้เหลืออยู่ แล้วอยู่ในรูป ของ DB
                $date_active_card=date("Y-m-d H:i:s");
				$cal_date_total=(strtotime($date_for_add_db) - strtotime($date_now) ) / ( 60 * 60 * 24 ); //เอาวันที่เหลือ มาลบวันปัจจุบันเพื่อดูว่าเหลือกี่วัน
				$cal_date_total=number_format($cal_date_total,0); //ปัดเศษ
				$UPDAYS=$row_Recordset1[date_end]+$cal_date_total;	//บวกเวลาเพิ่มไปในการ์ด
  				$date_add_db=date('Y-m-d', mktime(0,0,0, date('m'),date('d')+  $UPDAYS,date('Y')));
		
				#แปลงวันที่ให้อยู่ในรูป radius
				$radius_time= explode("-",$date_add_db) ;
				$radius_time[2];  //วัน
				$radius_time[1];  //เดือน
				$radius_time[0];  //ปี
				$date_add_db2=re_name2($radius_time[1]);
				$Hourts=date("H:i:s");
				$date_add_db="$radius_time[2] $date_add_db2 $radius_time[0] $Hourts";
				//echo " +  $date_add_db";

				mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Expiration'  ") ;
				mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)   values('$a_name','Expiration',':=','$date_add_db')") or    die ("Add ข้อมูลลง Table ไม่ได้ ");

			//	update("usergroup", "GroupName='$GroupName'  "," where UserName='$a_name'  and domain='$domain_name'    ");
                mysql_query("delete   from   usergroup  where  UserName='$a_name'   ") ;
				mysql_query("INSERT INTO  usergroup  (UserName,GroupName,priority,domain)   values('$a_name','$GroupName','1','$domain_name')") or    die ("Add ข้อมูลลง Table ไม่ได้ ");
				
				update("card", "active='1' , UserName='$a_name' ,time_active='$date_active_card' ,identity='$identity'    "," where idcard='$idcard'  and domain='$domain_name'     ");

				###### ลบฟิว  ของ จำนวนชั่วโมงทิ้ง
				mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Max-All-Session'  ") ;
				update("radacct", "AcctSessionTime='0'  "," where UserName='$a_name'     ");
				$msg_s=" $domain_name: เติมเวลา $a_name เรียบร้อยแล้ว วันหมดอายุการใช้งาน อินเตอร์เน็ตคือ $date_add_db ";
				###########################
				mysql_query("INSERT INTO  table_card_user  (idcard,UserName,active,domain)   values('$idcard','$a_name','1','$domain_name')") or    die ("Add ข้อมูลลง Table ไม่ได้ ");
	  
$texts="$domain_name: ผู้ใช้งาน $a_name เติมเลขบัตร $idcard ผ่าน   วันหมดอายุการใช้งาน คือ  $date_add_db (เป็นการเติมบัตรก่อนที่เวลาตนเองหมดอายุ) ";
 $b=date("Y-m-d H:i:s");
mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('$idcard', '$texts','$b'  ,'system','$domain_name' )") or trigger_error(mysql_error(),E_USER_ERROR);   
 
 echo "<meta http-equiv=refresh content=0;URL=http://www.google.co.th>";
exit();
///จบการเติมแบบ เหลือวันในระบบ
				} 
 if($cal_date == 0  ) {
 //กรณีเติมเป็นวันเดียวกับวันที่หมดอายุ
	 	 $cal_date=50000;
				} 

				#########  ยังมีเวลาเหลือในระบบ ให้บวกเพิ่ม  ๒๒๒๒๒๒๒
				if($cal_date > 0   ) {  #upใน db เพิ่ม
				if($cal_date==50000){ $UPDAYS=$row_Recordset1[date_end]+1; } else { $UPDAYS=$row_Recordset1[date_end]+0;} //กรณีเติมเป็นวันเดียวกับวันที่หมดอายุ ก็บวกเพิ่มจากปกติหนึ่งวันให้เล่นได้เลย
					$date_add_db=date('Y-m-d', mktime(0,0,0, date('m'),date('d')+  $UPDAYS,date('Y')));
				#แปลงวันที่ให้อยู่ในรูป radius
				$radius_time= explode("-",$date_add_db) ;
				$radius_time[2];  //วัน
				$radius_time[1];  //เดือน
				$radius_time[0];  //ปี
				$date_add_db2=re_name2($radius_time[1]);
				$Hourts=date("H:i:s");
				$date_add_db="$radius_time[2] $date_add_db2 $radius_time[0] $Hourts";
				//echo " +  $date_add_db";

				mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Expiration'  ") ;
				mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)   values('$a_name','Expiration',':=','$date_add_db')") or    die ("Add ข้อมูลลง Table ไม่ได้ ");

			//	update("usergroup", "GroupName='$GroupName'  "," where UserName='$a_name'  and domain='$domain_name'    ");
                mysql_query("delete   from   usergroup  where  UserName='$a_name'   ") ;
				mysql_query("INSERT INTO  usergroup  (UserName,GroupName,priority,domain)   values('$a_name','$GroupName','1','$domain_name')") or    die ("Add ข้อมูลลง Table ไม่ได้ ");
				
				update("card", "active='1' , UserName='$a_name' ,time_active='$date_active_card' ,identity='$identity'    "," where idcard='$idcard'  and domain='$domain_name'     ");

				###### ลบฟิว  ของ จำนวนชั่วโมงทิ้ง
				mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Max-All-Session'  ") ;
				update("radacct", "AcctSessionTime='0'  "," where UserName='$a_name'     ");
				$msg_s=" $domain_name: เติมเวลา $a_name เรียบร้อยแล้ว วันหมดอายุการใช้งาน อินเตอร์เน็ตคือ  ";
				###########################
				mysql_query("INSERT INTO  table_card_user  (idcard,UserName,active,domain)   values('$idcard','$a_name','1','$domain_name')") or    die ("Add ข้อมูลลง Table ไม่ได้ ");
				echo                  "<script type=text/javascript>";
				echo                  "alert(' $msg_s  $date_add_db ')";
				echo                  "</script>";
 
 if($TEL !='')			{  
 //ส่ง sms ให้ลูกค้าทราบ  
 
  $cccc=  iconv('TIS-620', 'UTF-8',  "เติมเวลา $a_name วันหมดอายุการใช้งาน ");
  $pppppppppp=$cccc.'  '.$date_add_db;
// $sms->send( "$SENDSMSNAME", $TEL, "$pppppppppp");
 
  $texts="$domain_name: ส่ง  sms แจ้ง การเติมบัตร   $a_name ไปที่เบอร์ $TEL  ";
  


 $b=date("Y-m-d H:i:s");
mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('$idcard', '$texts','$b'  ,'system','$domain_name' )") or trigger_error(mysql_error(),E_USER_ERROR);       
 }
 
 $texts="$domain_name: ผู้ใช้งาน $a_name เติมเลขบัตร $idcard ผ่าน   วันหมดอายุการใช้งาน คือ  $date_add_db ";
 $b=date("Y-m-d H:i:s");
mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('$idcard', '$texts','$b'  ,'system','$domain_name' )") or trigger_error(mysql_error(),E_USER_ERROR);       
	echo "<meta http-equiv=refresh content=0;URL=active.php?domain_name=$domain_name&identity=$identity>";
exit();
			  
				// $aaaaaa=2;
				}


			
		}     // จบตรวจสอบว่า มี user นี้อยุ่หรือไม่
	}		 // จบตรวจสอบว่า มี cardid นี้อยุ่หรือไม่
	
 $b=date("Y-m-d H:i:s");
  $texts="<b>$domain_name: ผู้ใช้งาน $a_name เติมเลขบัตร $idcard ไม่ได้ </b>";
mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('$idcard', '$texts','$b'  ,'tlog','$domain_name' )") or trigger_error(mysql_error(),E_USER_ERROR);       	
			  
	echo "<meta http-equiv=refresh content=0;URL=active.php?domain_name=$domain_name&identity=$identity>";
	// print  $cal_date ;
exit();
} // sumbit
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<title>เติมเวลาการใช้งาน</title>

<link href="main.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style12 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}

body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
</head>

<body>
	<table width="530" height="445" border="0" align="center" cellpadding="0"
		cellspacing="0" background="verture.jpg">
		<tr >
			<td height="128">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td valign="top"><table width="501" border="0" align="center">
					<tr>
						<td width="418">
						 
						<form action="active.php?domain_name=<?php print $domain_name;?>&identity=<?php print $identity;?>" method="post" enctype="multipart/form-data">
								<table width="106%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td width="57%"><div align="right" class="style12">ชื่อเข้าใช้งานระบบ / User login::</div>									  </td>
										<td width="43%"><font size="3"
											face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<span
												class="style25"> 
										  <input name="per" type="text" class="input" value="<?php print $per;?>" id="per" size="20">
											</span>
									  </font></td>
									</tr>
								<?php	if($_SESSION[adminpass] ==''){ ?>
									<tr>
                                      <td><div align="right" class="style12">รหัสผ่าน / password login::</div></td>
									  <td><font size="3"
											face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<span
												class="style25">
                                        <input name="passwds" type="password" class="input" value="" id="passwds" size="20">
                                      </span> </font></td>
								  </tr>
								  <?php } ?>
									<tr>
										<td><div align="right" class="style12">หมายเลขบัตร บัตร Internet <?php print $domain_name;?>/ <br>
										  <?php print $_GET[domain_name];?>&nbsp;Card Internet number::</div></td>
										<td><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><span
												class="style25"> &nbsp; <input name="idcard" type="text" class="input" id="idcard" size="20">
											</span> </font></td>
									</tr>

									<tr>
										<td height="48"> <div align="right" class="style12">Security code::</div></td>
										<td><div align="left">
												<font color="#0000FF"> &nbsp; <?php   $ran_str = randomToken(4);    ?>
													<img src="pic_text_popup.php?str=<?php print $ran_str;?>" width="100" height="25">												</font>
											</div></td>
									</tr>
									<tr>
										<td><div align="right">
												<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Security code :</strong>												</font>
											</div></td>
										<td><font color="#0000FF"> &nbsp; <input name="code1" type="text" id="code1" size="10" />
										</font></td>
									</tr>
								 
				 
									<tr>
										<td colspan="2"><div align="center">
												<font size="3" face="MS Sans Serif, Tahoma, sans-serif"> <input
													name="chk_num" type="hidden" id="chk_num"
													value="<?php echo "$ran_str"; ?>" /> <input name="sumbit"
													type="submit" class="input" id="sumbit" value="เติมเวลา">
												</font>
											</div></td>
									</tr>
									<tr>
										<td colspan="2"></td>
									</tr>
						  </table>
						  </form></td>
					</tr>
				</table></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td height="129">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
</table>
	<br>
	</p>
	<p>&nbsp;</p>
</body>
</html>
