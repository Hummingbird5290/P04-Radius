<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body>
  <?php 
  
  function chk_ip_input($text) 
{
 
if (preg_match("/SRC=192.168.3./", $text)) {
   $text=1;
} else {
  $text=0;
}

return  $text;
}


 include("config.php");
 include("$PATH_INSTALL/Connections/dbconnect.php");
  include("$PATH_INSTALL/include/function.php");   

update("usergroup","GroupName ='defult'"," where GroupName='bit'    "); 
 

 $tb="radcheck";
$sql = "delete from $tb where Value=null  ";
 mysql_select_db($database_edoc);$dbquery = mysql_query($sql);

 $tb="radgroupreply";
$sql = "delete from $tb where Value=null   or  GroupName=null ";
 mysql_select_db($database_edoc);  $dbquery =mysql_query($sql);



 
$connect_db_syslog= mysql_connect($hostname_syslog, $username_syslog, $password_syslog) or trigger_error(mysql_error(),E_USER_ERROR); 
   mysql_select_db($database_syslog, $connect_db_syslog)  or trigger_error(mysql_error(),E_USER_ERROR);
 
$mdate_DAY = date("Y-m-d H:");  
 
 
$tb = date("Ymd");    
$date_view_day=$tb;
$tb ="list_bit_$tb";
$query_Recordset1 = "SELECT  msg,datetime FROM   $tb   where      msg like '%SRC=192.168.3.%'   and  datetime like '$mdate_DAY%'     ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db_syslog) or trigger_error(mysql_error(),E_USER_ERROR); 
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

 echo "$query_Recordset1  \r\n";
print  $row_Recordset1['msg'];
 echo "   \r\n";
 
            $User_ip_post=$row_Recordset1['msg']; 
		    $a_ip = explode(" ",$User_ip_post) ;
			
			
         
          $num_array=count($a_ip);
 
     for ($x = 1; $x <=18; $x++) {
       echo " $x =          $a_ip[$x]    \r\n";
   }

$chk_data_bit=chk_ip_input($a_ip[1]);  if($chk_data_bit==1)  {  $ip_load_bit=$a_ip[1]; }
$chk_data_bit=chk_ip_input($a_ip[2]);  if($chk_data_bit==1)  {  $ip_load_bit=$a_ip[2]; }
$chk_data_bit=chk_ip_input($a_ip[3]);  if($chk_data_bit==1)  {  $ip_load_bit=$a_ip[3]; }
$chk_data_bit=chk_ip_input($a_ip[4]);  if($chk_data_bit==1)  {  $ip_load_bit=$a_ip[4]; }  
$chk_data_bit=chk_ip_input($a_ip[5]);  if($chk_data_bit==1)  {  $ip_load_bit=$a_ip[5]; }
$chk_data_bit=chk_ip_input($a_ip[6]);  if($chk_data_bit==1)  {  $ip_load_bit=$a_ip[6]; }
$chk_data_bit=chk_ip_input($a_ip[7]);  if($chk_data_bit==1)  {  $ip_load_bit=$a_ip[7]; }
$chk_data_bit=chk_ip_input($a_ip[8]);  if($chk_data_bit==1)  {  $ip_load_bit=$a_ip[8]; }
$chk_data_bit=chk_ip_input($a_ip[9]);  if($chk_data_bit==1)  {  $ip_load_bit=$a_ip[9]; }
$chk_data_bit=chk_ip_input($a_ip[10]);  if($chk_data_bit==1)  {  $ip_load_bit=$a_ip[10]; }
$chk_data_bit=chk_ip_input($a_ip[11]);  if($chk_data_bit==1)  {  $ip_load_bit=$a_ip[11]; }
$chk_data_bit=chk_ip_input($a_ip[12]);  if($chk_data_bit==1)  {  $ip_load_bit=$a_ip[12]; }
$chk_data_bit=chk_ip_input($a_ip[13]);  if($chk_data_bit==1)  {  $ip_load_bit=$a_ip[13]; }
$chk_data_bit=chk_ip_input($a_ip[14]);  if($chk_data_bit==1)  {  $ip_load_bit=$a_ip[14]; }
$chk_data_bit=chk_ip_input($a_ip[15]);  if($chk_data_bit==1)  {  $ip_load_bit=$a_ip[15]; }
$chk_data_bit=chk_ip_input($a_ip[16]);  if($chk_data_bit==1)  {  $ip_load_bit=$a_ip[16]; }
$chk_data_bit=chk_ip_input($a_ip[17]);  if($chk_data_bit==1)  {  $ip_load_bit=$a_ip[17]; }
$chk_data_bit=chk_ip_input($a_ip[18]);  if($chk_data_bit==1)  {  $ip_load_bit=$a_ip[18]; }

  echo "\r\n\r\n   IP Load Bit   ==$chk_data_bit   \r\n\r\n ";

  $ip_load_bit=preg_replace(" ", null, $ip_load_bit); 
 $ip_load_bit=preg_replace("SRC=", null, $ip_load_bit);
 
 $connect_db= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc) or trigger_error(mysql_error(),E_USER_ERROR); 
 
 
 mysql_select_db($database_edoc);  //  or trigger_error(mysql_error(),E_USER_ERROR);
 #กำหนดค่าเริ่มต้น =0;
  $totalRows_Recordset1=0;
  
  if ( ($ip_load_bit  != ""   and  $ip_load_bit  !=null) ) {
$query_Recordset1 = "SELECT 
  radcheck.UserName,
  register.fullname,
  register.room,
  radacct.FramedIPAddress,
  radacct.AcctStartTime,
 radacct.CallingStationId
FROM
  radacct
  INNER JOIN radcheck ON (radacct.UserName = radcheck.UserName)
  INNER JOIN register ON (radcheck.UserName = register.UserName)  
  where     radacct.FramedIPAddress   like  '%$ip_load_bit%'
  ORDER BY radacct.AcctStartTime  DESC   LIMIT 1";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$uname_quary=$row_Recordset1[UserName]; 
echo  "$query_Recordset1";
} // เช็ค $totalRows_Recordset1

if($totalRows_Recordset1==1    )
 {
######## block  user  ที่เจอ
$query_user = "select  *  from register   where UserName='$uname_quary'  ";
echo "$query_user \r\n";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$A_UserName=$row_user['UserName'];
$A_password=$row_user['password'];
$A_per=$row_user['per'];
$A_room=$row_user['room'];
$A_tel=$row_user['tel'];
$A_fullname=$row_user['fullname'];
$A_status="99";
$A_email=$email=$row_user['email'];

 


			  
 
 

update("usergroup","GroupName ='bit'"," where UserName='$uname_quary'    "); 




##############  ดีด user ออกจากเน็ต หาก เค้าต่ออยู่



$b="";
$command ="/usr/bin/sudo   /bin/echo    User-Name=$uname_quary  |   /usr/bin/radclient     -x 127.0.0.1:3779 disconnect testing123";
 


exec($command, $result, $rval);
for ($i = 0; $i < sizeof($result); $i++) {
echo "$result[$i]<br>";
$b .="$result[$i]";
}


}
  ?> 
   
 
</body>
</html>
