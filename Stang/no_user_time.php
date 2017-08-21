<?php
/*
กรณีเวลาในระบบ ยังเหลืออยู่ ให้ทำการ แอด เวลาหมดอายุลง Tables  table_card_user  แทน

*/
$date_active_card=date("Y-m-d H:i:s");
mysql_query("INSERT INTO  table_card_user  (idcard,UserName,active)
		      values('$idcard','$a_name','0')") or    die ("Add ข้อมูลลง Table ไม่ได้ ");
			  
update("card", "active='1' , UserName='$a_name' ,time_active='$date_active_card'   "," where idcard='$idcard'       "); 
// update("usergroup", "GroupName='$GroupName'  "," where UserName='$a_name'     "); 
 echo                  "<script type=text/javascript>";
 echo                  "alert('บันทึกข้อมูลเรียบร้อยแล้ว  ')";
 echo                  "</script>";
 
    echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=200>"; 
exit();
?>																																														   
