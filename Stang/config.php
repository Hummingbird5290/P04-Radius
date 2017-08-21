<?php
/*
CREATE TABLE  `radius`.`tmconfig` (
`tmuser` VARCHAR( 300 ) NOT NULL ,
`tmpassword` VARCHAR( 300 ) NOT NULL ,
`trueuser` VARCHAR( 300 ) NOT NULL ,
`truepassword` VARCHAR( 300 ) NOT NULL
) ENGINE = MYISAM ;
*/
$hostname_edoc = "192.168.10.100";
$database_edoc = "radius";
$username_edoc = "thaigqsoft";
$password_edoc = "tlogsystem";

$connect_db= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc);
mysql_select_db($database_edoc, $connect_db)  or trigger_error(mysql_error(),E_USER_ERROR);
    mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
 $block_mac_sql2 = "SELECT *   FROM  tmconfig     ";
$mac_db = mysql_query($block_mac_sql2, $connect_db) or die(mysql_error());
$row_tm= mysql_fetch_assoc($mac_db);
 

// ไม่เข้าใจส่วนไหนโทรสอบถามได้ที่ 081-0329233
//ข้อมูล tmtopup.thaighost.net ผู้ให้บริการตัดบัตรทรู
$tmuser=$row_tm[tmuser]; // Username
$tmpassword=$row_tm[tmpassword];  // รหัสผ่าน

//ข้อมูล บัญชี True money ของเว็บ http://www.truemoney.co.th ต้องกรอกให้ถูกต้อง เพราะอาจทำให้บัญชี True money  ของท่านถูกระงับได้
$trueuser=$row_tm[trueuser];  // Username
$truepassword=$row_tm[truepassword];  // รหัสผ่าน

?>
