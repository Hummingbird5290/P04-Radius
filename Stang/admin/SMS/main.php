<?php
 @session_start();
 if($_SESSION["adminpass"]==NULL){
  echo "<meta http-equiv=refresh content=0;URL=../index.php>"; 
  	exit(); 
}
$domain_name= $_SESSION['domain'];
$hostname_edoc = "127.0.0.1";
$database_edoc = "radius";
$username_edoc = "root";
$password_edoc = "System2002";
$connect_db2= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc);
if(!$connect_db2){
 echo 'ไม่สามารถเชือมต่อฐานข้อมูลได้ ';
 exit();
}
   mysql_query("SET character_set_results=tis620", $connect_db2) or die(mysql_error());
    mysql_query("SET character_set_client=tis620", $connect_db2) or die(mysql_error());
    mysql_query("SET character_set_connection=tis620", $connect_db2) or die(mysql_error());
    mysql_query("SET collation_connection = tis620_thai_ci", $connect_db2) or die(mysql_error());
    mysql_query("SET collation_database = tis620_thai_ci", $connect_db2) or die(mysql_error());
    mysql_query("SET  collation_server = tis620_thai_ci", $connect_db2) or die(mysql_error());
	 mysql_select_db($database_edoc, $connect_db2)  or trigger_error(mysql_error(),E_USER_ERROR);
	 
	 
 if ($_SERVER['HTTP_CLIENT_IP']) { 
$IP = $_SERVER['HTTP_CLIENT_IP'];
} elseif (preg_match("/[0-9]/",$_SERVER["HTTP_X_FORWARDED_FOR"] )) { 
$IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else { 
$IP = $_SERVER["REMOTE_ADDR"];
}


if($_POST[SMS] !=NULL and $_POST['USERS_TEL'] !=NULL ){
 include("sms.php");  
 $texts=$_POST[SMS];
 
 	$SMSSQL = " SELECT   * from sms_seting where domain='$domain_name'    ";
	$Recordsetsms= mysql_query($SMSSQL, $connect_db) or die(mysql_error());
	$row_sms = mysql_fetch_assoc($Recordsetsms);
	
 $sms = new thsms();
$sms->username   = $row_sms[users];
$sms->password   = $row_sms[pass];

 
//$sms->username   = 'thaigqsoft';
//$sms->password   = '64a677';
$cccc=  iconv('TIS-620', 'UTF-8', $texts);
 $sms->send( "020000000", $_POST['USERS_TEL'], $cccc);

  	         echo                  "<script type=text/javascript>";
		    echo                  "alert('ส่งข้อความเรียบร้อยแล้ว ')";
	        echo                  "</script>";  

   
 $bb=date("Y-m-d H:i:s");
 $tels=$_POST['USERS_TEL'];
 
 $texts = htmlspecialchars("$texts", ENT_QUOTES);
 $bb = htmlspecialchars("$bb", ENT_QUOTES);
 $IP = htmlspecialchars("$IP", ENT_QUOTES);
 $tels = htmlspecialchars("$tels", ENT_QUOTES);
 
 $query_Recordset101PQ = "INSERT INTO  smsdata   (sms,dates,ip,tel,domain_name)
		      values('$texts','$bb','$IP','$tels','$domain_name')";
 $Recordset10QPR = mysql_query($query_Recordset101PQ, $connect_db2) or die(mysql_error());
  echo  "<meta http-equiv=refresh content=0;URL=main.php>";
exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>SMS SYSTEM</title>
</head>

<body>
<form action="" method="post">
<table width="673" border="0" align="center">
  <tr>
    <td colspan="2"><div align="center">SYSTEM SMS SENDER </div></td>
  </tr>
  <tr>
    <td>หมายเลขโทรศัพท์ที่ต้องการส่งถึง</td>
    <td><input type="text" name="USERS_TEL" /></td>
  </tr>
  <tr>
    <td>ข้อความที่ต้องการส่ง</td>
    <td> 
	<textarea name="SMS" cols="50"   wrap="virtual"></textarea>	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Submit" />
    *ไม่สามารถส่งข้อความยาว ๆ ได้ </td>
  </tr>
</table>
 
</form><br />
<br />
<table width="800" border="0" align="center" class="imagetable">
	<tr>
		<th colspan="5"><div align="center">
			<span class="scimenu"><strong>Last SNED SMS  (
			<?php
 $ch = curl_init("http://www.thsms.com/api/rest?method=credit&username=$row_sms[users]&password=$row_sms[pass]&from=0000");
	curl_setopt($ch,CURLOPT_POST,1);
	@curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$server_true_ip=curl_exec($ch);
$pattern = '/success/i';
$replacement = NULL;
print $server_true_ip= preg_replace($pattern, $replacement, $server_true_ip); ?>
)</strong>		    </span></div></th>
	</tr>
	<tr>
		<th width="271"><div align="left">	  <span class="scimenu"><strong>เบอร์ที่ ส่ง</strong>      </span></div></th>
		<th width="271"><div align="left">	  <span class="scimenu"><strong>ข้อความ</strong>      </span></div></th>
		<th width="244"><div align="center">
	  <span class="scimenu"><strong>เวลาเข้าใช้</strong>      </span></div></th>
		<th width="271"><div align="center">
	  <span class="scimenu"><strong>IP</strong>      </span></div></th>
	</tr>
	<?php
	 
	$query_Recordset1 = "SELECT *  FROM   smsdata    where domain_name='$domain_name'  order by dates desc  limit 0,10 ";
	$Recordset1 = mysql_query($query_Recordset1, $connect_db2) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$i=0;
 
		do { 
			$cli=$i%2;
					if($cli=="0")  {$cli="#AAD2FF" ;  } else {    $cli="#FFFFFF" ;   }
				$i++;	?>

	<tr bgcolor="<?php echo "$cli"; ?>" class="ข้อความในตาราง"> 
		<td><?php print $row_Recordset1[tel];?></td>
			<td><?php print $row_Recordset1[sms];?></td>
		<td><?php  print $row_Recordset1[dates]; ?></td>
		<td><?php print $row_Recordset1[ip];?></td>
	</tr>
	<?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));  ?>
</table>
</body>
</html>
