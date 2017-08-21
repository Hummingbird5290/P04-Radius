  <?php
  include("../include/chklogin.php");   
    include("../include/function.php");   
	 if($_SESSION["adminpass"]=='demo'){
 
      echo                  "<script type=text/javascript>";
		    echo                  "alert('ผู้ใช้งาน ทดสอบระบบ ไม่สามารถ แก้ไขข้อมูลได้ ')";
	        echo                  "</script>";  
  echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=2>";
 exit();
 
}
  ?>
 <meta http-equiv="Content-Type" content="text/html; charset=windows-874">
 <?php
include("../Connections/dbconnect.php");

 mysql_select_db($database_edoc); 

//กำหนด user ที่ลบ เป็น  88
 $UserName = htmlspecialchars("$UserName", ENT_QUOTES);
  $pattern = '/;/i';
$replacement = NULL;
$UserName= preg_replace($pattern, $replacement, $UserName);

update("register","status ='88'  "," where UserName='$UserName'    "); 
$stop_time=date("Y-m-d H:i:s");
$tb="radcheck";
$sql = "delete from $tb where UserName='$UserName'  and Attribute='MD5-Password' ";
$dbquery = mysql_query($sql);

##############  ดีด user ออกจากเน็ต หาก เค้าต่ออยู่
  
//$filename = '/data/command.sh';
//$somecontent = "#!/bin/sh \n  /bin/echo   User-Name=$UserName   |    /usr/bin/radclient     -x 127.0.0.1:3779 disconnect testing123 \n \necho '' >   /data/command.sh \n";
 ##########################################
 echo '<pre>';
// $last_line = system("/bin/echo   User-Name=$UserName   |    /usr/bin/radclient     -x 127.0.0.1:3779 disconnect testing123", $retval);
echo '
</pre>
<hr />Last line of the output: ' . $last_line . '
<hr />Return value: ' . $retval;
 
###########################################################################


#########################

            echo                  "<script type=text/javascript>";
		    echo                  "alert('เรียบร้อยแล้ว ')";
	        echo                  "</script>";
          echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=2>"; 
 
?>