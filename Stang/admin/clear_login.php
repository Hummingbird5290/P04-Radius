 <?php
 header('Content-type: text/html; charset=windows-874');
 include("../include/chklogin.php");
 include("../Connections/dbconnect.php");
 ?>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<?php
if($clear=="1")
{

   $UserName = htmlspecialchars("$UserName", ENT_QUOTES);
   $pattern = '/;/i';
  $replacement = NULL;
  $UserName= preg_replace($pattern, $replacement, $UserName);

	$stop_time=date("Y-m-d H:i:s");

	mysql_select_db($database_edoc);
	mysql_query( "update  radacct  set AcctStopTime  ='$stop_time'  , AcctTerminateCause='Admin-Reset' where   UserName='$UserName'   and  AcctStopTime='0000-00-00 00:00:00'  ");
	##############  ดีด user ออกจากเน็ต หาก เค้าต่ออยู่
 
	  echo "<script type=text/javascript>";
        echo "alert(' Clear Login $UserName OK ')";
        echo "</script>";
echo "<meta http-equiv=refresh content=0;URL=List_user_online_now.php>";
	exit();
	###########################################################################

}

if($clear=="alls") {
	$stop_time=date("Y-m-d H:i:s");
    mysql_select_db($database_edoc);
	mysql_query( "update  radacct  set AcctStopTime  ='$stop_time'  , AcctTerminateCause='Admin-Reset' where      AcctStopTime='0000-00-00 00:00:00'  ");
	echo "<meta http-equiv=refresh content=0;URL=index.php>";
	exit();
}
?>
 