<?php
/*
กรณีเวลาในระบบ ยังเหลืออยู่ ให้ทำการ แอด เวลาหมดอายุลง Tables  table_card_user  แทน

*/
$date_active_card=date("Y-m-d H:i:s");
mysql_query("INSERT INTO  table_card_user  (idcard,UserName,active,domain,onupdate)
		      values('$idcard','$a_name','0','$domain_name','$date_active_card')") or    die ("Add ข้อมูลลง Table ไม่ได้ ");
			  
update("card", "active='1' , UserName='$a_name' ,time_active='$date_active_card'   "," where idcard='$idcard'       "); 
// update("usergroup", "GroupName='$GroupName'  "," where UserName='$a_name'     "); 

 $texts="$domain_name: ผู้ใช้งาน $a_name เติมเลขบัตร $idcard ผ่าน   วันหมดอายุการใช้งาน คือ  $date_add_db (เป็นการเติมบัตรก่อนที่เวลาตนเองหมดอายุ) ";
 $b=date("Y-m-d H:i:s");
mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('$idcard', '$texts','$b'  ,'system','$domain_name' )") or trigger_error(mysql_error(),E_USER_ERROR);   
			  
 echo                  "<script type=text/javascript>";
 echo                  "alert('บันทึกข้อมูลเรียบร้อยแล้ว  ')";
 echo                  "</script>";
 
   	echo "<meta http-equiv=refresh content=0;URL=http://www.google.co.th>";
exit();
?>																																														   
