<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<?php
include("Connections/dbconnect.php");

function thaiIDCheck($stringID){
/*
function coded by Sarun101
return:
1, 0, -1 (positive, zero, negative)
(ต้องการ php5 หรือ php4 ก็อาจจะได้ + zlib + curl + pcre)
ผลที่ได้มี 3 แบบ
 1= positive (ผ่านการตรวจสอบ)
 0= ไม่รู้แน่ชัด เนื่องจาก server ฐานข้อมูลล่ม หรือ มีการเปลี่ยนแปลงโครงสร้างข้อมูล
-1= negative (ไม่มีบัตรประชาชนนี้อยู่จริง)
*/
$evaler=
'jZNLa9tAEMfvBn+HPYisBLLkVRNIW3QoiQKGNA6y3EtIjSqtLRE9'.
'FmmNUoI/TEzBxdfWLX1cXGPai6Hu45BbDj3E0A/RtfyIHNy6i2Bm'.
'Z3/z1zI7w0WYPjE9tfgwn3PrPFJVEuFGzTep5fBQfnqCCrunJ8XC'.
'/dMLpLQ4GYqAi2nkBo3SviBc5HOc1Yy8mqOmxg1cygtMKt3FmIaE'.
'8nNCBHtV/bB8bNSYEQF0KCUPZDlJEunMCQPqmK5khb48dTwzsBsm'.
'xYn5XA5w4gY2PichkYhD4Eb543LFEAGNmvi/0IOSdrhfEUE+B4kZ'.
'xxGuq1BiHA6s0MY8/DIYv/r0uz0ajN93++3JqH81hIIEt6A0zXBt'.
'xPC4+YwVhV9WRgRFEaAspaylkAi2s9S9tdQO+7LU9not9ksli+2s'.
'x5Q7N2PU8ngRxj4hiYrYmu2ZjO/S1br0LocdKORzG4tslB5r5Sp7'.
'kt2NqK4ZVf3I0B8dVQ40/fYROcvB1hkxG3jWZ/gcW4vspajlhTHO'.
'Rrm0i9FqR3/88frFYDzpvP15I/vTbl5K36YoqynXw/aHwdeX33vj'.
'z8x2v3Xf/erfvLm67E1Gnb9qIJVfOCrKSvMLZxZmQzfn0mmajyNi'.
'Jy3sxTgDKFmALxbS9JYsa4EN3Pqc/xfyBw==';
eval(gzinflate(base64_decode($evaler)));unset($evaler);
return $retVal;
}//End function


 

$query_Recordset1 = "select  *  from register  ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

  do {   
  $strID=$row_Recordset1['per'];  
  $UserName=$row_Recordset1['UserName'];
  $a=thaiIDCheck($strID); 
 if($a !=1) {
                        print  $row_Recordset1['fullname'];  print "<br>\n";
						 $tb="register";
$sql = "delete from $tb where UserName='$UserName'  ";
$dbquery = mysql_db_query($database_edoc, $sql);
$tb="radcheck";
$sql = "delete from $tb where UserName='$UserName'  ";
$dbquery = mysql_db_query($database_edoc, $sql);
                  }
 } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>

 

 
