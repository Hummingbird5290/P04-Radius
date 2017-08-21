 <?php
  include("../include/chklogin.php");   
  ?>
 <meta http-equiv="Content-Type" content="text/html; charset=windows-874">
 <?php
include("../Connections/dbconnect.php");

   $UserName = htmlspecialchars("$UserName", ENT_QUOTES);
 $pattern = '/;/i';
$replacement = NULL;
$UserName= preg_replace($pattern, $replacement, $UserName);

 $query_user = "select  *  from register   where UserName='$UserName' and domain='$domain_name' ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$A_UserName=$row_user['UserName'];
$A_password=$row_user['password'];
$A_per=$row_user['per'];
$A_room=$row_user['room'];
$A_tel=$row_user['tel'];
$A_fullname=$row_user['fullname'];
$A_status="0";
$A_email=$email=$row_user['email'];

 if($A_UserName==''){
 exit();
 }


//mysql_query("INSERT INTO  delete_user     (UserName,password,per,room,tel,fullname,status,email)
//		      values('$A_UserName','$A_password','$A_per','$A_room','$A_tel','$A_fullname','$A_status','$A_email')") or die(mysql_error());  //ย้าย user ที่ลบไป tables ลบ user
			  
 $tb="register";
$sql = "update    $tb set status='99' where UserName='$UserName'  ";
 mysql_select_db($database_edoc);  $dbquery =mysql_query($sql);

$tb="radcheck";
$sql = "delete from $tb where UserName='$UserName'  and  Attribute='MD5-Password' ";
 mysql_select_db($database_edoc);  $dbquery =mysql_query($sql);
$tb="radcheck";
$sql = "delete from $tb where UserName='$UserName'  and  Attribute='Simultaneous-Use' ";
 mysql_select_db($database_edoc);$dbquery = mysql_query($sql);

$tb="usergroup";
$sql = "delete from $tb where UserName='$UserName'  ";
 mysql_select_db($database_edoc); $dbquery =mysql_query($sql);

############## รัน chilli ใหม่
echo '<pre>';

// Outputs all the result of shellcommand "ls", and returns
// the last output line into $last_line. Stores the return value
// of the shell command in $retval.
//$last_line = system("/usr/local/bin/sudo    /bin/echo   User-Name=$UserName   /usr/bin/radclient     -x 127.0.0.1:3779 disconnect testing123", $retval);

// Printing additional info
echo '
</pre>
<hr />Last line of the output: ' . $last_line . '
<hr />Return value: ' . $retval;
###################
            echo                  "<script type=text/javascript>";
		    echo                  "alert('ลบออกเรียบร้อยแล้ว ')";
	        echo                  "</script>";
           echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=2>"; 
 
?>