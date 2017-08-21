<?php
 
/*
Author: Daniel Kassner
Website: http://www.danielkassner.com
*/
function getOS($userAgent) {
  // Create list of operating systems with operating system name as array key 
	$oses = array (
		'iPhone' => '(iPhone)',
		'Windows 3.11' => 'Win16',
		'Windows 95' => '(Windows 95)|(Win95)|(Windows_95)', // Use regular expressions as value to identify operating system
		'Windows 98' => '(Windows 98)|(Win98)',
		'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
		'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
		'Windows 2003' => '(Windows NT 5.2)',
		'Windows Vista' => '(Windows NT 6.0)|(Windows Vista)',
		'Windows 7' => '(Windows NT 6.1)|(Windows 7)',
		'Windows NT 4.0' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
		'Windows ME' => 'Windows ME',
		'Open BSD'=>'OpenBSD',
		'Sun OS'=>'SunOS',
		'Linux'=>'(Linux)|(X11)',
		'Safari' => '(Safari)',
		'Macintosh'=>'(Mac_PowerPC)|(Macintosh)',
		'QNX'=>'QNX',
		'BeOS'=>'BeOS',
		'OS/2'=>'OS/2',
		'Search Bot'=>'(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp/cat)|(msnbot)|(ia_archiver)'
	);

	foreach($oses as $os=>$pattern){ // Loop through $oses array
    // Use regular expressions to check operating system type
		if(eregi($pattern, $userAgent)) { // Check if a value in $oses array matches current user agent.
			return $os; // Operating system was matched so return $oses key
		}
	}
	return 'Unknown'; // Cannot find operating system so return Unknown
}
//echo getOS($_SERVER['HTTP_USER_AGENT']);
 
function clear($code) { return str_replace('\\\\', '\\', $code); }

   $mac=$_POST['mac'];
   $ip=$_POST['ip'];
   $username=$_POST['username'];
   $linklogin=$_POST['link-login'];
   $linkorig=$_POST['link-orig'];
   $error=$_POST['error'];
   $chapid=$_POST['chap-id'];
   $chapchallenge=$_POST['chap-challenge'];
   $linkloginonly=$_POST['link-login-only'];
   $linkorigesc=$_POST['link-orig-esc'];
   $macesc=$_POST['mac-esc'];
   $chapid=clear($_POST['chap-id']);
 $chapchallenge=clear($_POST['chap-challenge']);
 $os= getOS($_SERVER['HTTP_USER_AGENT']);
?>
<html>
<head>
<title>HISPEED WIFI</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<style type="text/css">
<!--
body {
	background-color: #000000;
}
-->
</style>

</head>
 
 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
	<form name="sendin" action="<?php echo $linkloginonly; ?>" method="post">
		<input type="hidden" name="username" />
		<input type="hidden" name="password" />
		<input type="hidden" name="dst" value="<?php echo $linkorig; ?>" />
		<input type="hidden" name="popup" value="true" />
		<input type="hidden" name="os" value="<?php print $os;?>" />
	</form>
	
	<script type="text/javascript" src="./md5.js"></script>
	<script type="text/javascript">
	<!--
	    function doLogin() {
                <?php if(strlen($chapid) < 1) echo "return true;\n"; ?>
		document.sendin.username.value = document.login.username.value;
		document.sendin.password.value = hexMD5('<?php echo $chapid; ?>' + document.login.password.value + '<?php echo $chapchallenge; ?>');
		document.sendin.submit();
		return false;
	    }
	//-->
	</script>
<!-- ImageReady Slices (THEME.psd) -->
<table width="1025" height="651" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="12">
			<img src="images/login_01.png" width="1024" height="152" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="152" alt=""></td>
	</tr>
	<tr>
		<td colspan="10" >
			<img src="images/login_02.png" width="310" height="150" alt=""></td>
		<td rowspan="12" width="586" height="429"  bgcolor="#FFFFFF"  valign="top">
<table width="586" height="429"  bgcolor="#FFFFFF">
<tr>
<td  valign="top"> <?php
 include("db.php");
 $query_Recordset1 = "SELECT   *   FROM news   where domain='wbcomputer'  ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
print $row_Recordset1[news];
?>
</td>
</tr>
</table>		 </td>
		<td rowspan="13">
			<img src="images/login_04.png" width="128" height="498" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="150" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="10">
			<img src="images/login_05.png" width="51" height="188" alt=""></td>
		<td colspan="4">
			<a href="http://www.thaigqsoft.info/register1.php?domain_name=wbcomputer" target="_blank">
			<img src="images/login_06.png" width="185" height="27" alt="" border="0">
			</a>
			</td>
		<td colspan="4" rowspan="2">
			<img src="images/login_07.png" width="74" height="37" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="27" alt=""></td>
	</tr>
	<tr>
		<td colspan="4">
			<img src="images/login_08.png" width="185" height="10" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="10" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="2">
			<img src="images/login_09.png" width="4" height="37" alt=""></td>
		<td colspan="4">
		<a href="http://www.thaigqsoft.info/active.php?domain=wbcomputer" target="_blank">
			<img src="images/login_10.png" width="209" height="27" alt="" border="0">
			</a></td>
		<td colspan="2" rowspan="8">
			<img src="images/login_11.png" width="46" height="151" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="27" alt=""></td>
	</tr>
	<tr>
		<td colspan="4">
			<img src="images/login_12.png" width="209" height="10" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="10" alt=""></td>
	</tr>
	<tr>
		<td rowspan="6">
			<img src="images/login_13.png" width="1" height="114" alt=""></td>
		<td colspan="5">
		<a href="http://www.thaigqsoft.info/card_true_acctive.php?domain_name=wbcomputer" target="_blank">
			<img src="images/login_14.png" width="212" height="31" alt="" border="0">
			</a></td>
		<td>
			<img src="images/spacer.gif" width="1" height="31" alt=""></td>
	</tr>
	<tr>
		<td colspan="5">
			<img src="images/login_15.png" width="212" height="7" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="7" alt=""></td>
	</tr>
	<tr>
		<td rowspan="4">
			<img src="images/login_16.png" width="3" height="76" alt=""></td>
		<td colspan="3">
		<a href="http://www.thaigqsoft.info/problem.php?domain_name=wbcomputer" target="_blank">
			<img src="images/login_17.png" width="184" height="31" alt="" border="0">
			</a></td>
		<td rowspan="2">
			<img src="images/login_18.png" width="25" height="38" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="31" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="images/login_19.png" width="184" height="7" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="7" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="images/login_20.png" width="1" height="38" alt=""></td>
		<td colspan="3">
			<a href="http://www.thaigqsoft.info/forget_pass.php?domain_name=wbcomputer" target="_blank">
			<img src="images/login_21.png" width="208" height="31" alt="" border="0">
			</a></td>
		<td>
			<img src="images/spacer.gif" width="1" height="31" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="images/login_22.png" width="208" height="7" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="7" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="images/login_23.png" width="46" height="160" alt=""></td>
		<td colspan="8" rowspan="2" background="images/login_24.png" width="222" height="160">
					<form name="login" action="<?php echo $linkloginonly; ?>" method="post" onSubmit="return doLogin()" >
					
<!--<div class="notice"  font-size: "14px"> $(if trial == 'yes')  
<a style="color: #0000FF;background-color: #FFFFFF" href="$(link-login-only)?dst=$(link-orig-esc)&username=T-$(mac-esc)">คลิกที่นี่เพื่อทดลองเล่น  15  นาที</a>$(endif)
</div>-->
							<table width="183" style="background-color: #ffffff">
								<tr>
								  <td colspan="2" align="right"><div align="center">INTERNET LOGIN </div></td>
							  </tr>
								<tr><td align="right">login</td>
										<td><input style="width: 80px" name="username" type="text" autocomplete="off"  ></td>
								</tr>
								<tr><td align="right">password</td>

										<td><input style="width: 80px" name="password" type="password" autocomplete="off" /> </td>
								</tr>
								<tr><td>	<input type="hidden" name="dst" value="<?php echo $linkorig; ?>" />
						<input type="hidden" name="popup" value="true" /></td>
										<td><input type="submit" value="OK" /></td>
								</tr>
					  </table>
		  </form>
			</td>
		<td rowspan="2">
			<img src="images/login_25.png" width="42" height="160" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="91" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/login_26.png" width="586" height="69" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="69" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/spacer.gif" width="46" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="5" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="3" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="180" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="3" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="25" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="4" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="42" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="586" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="128" height="1" alt=""></td>
		<td></td>
	</tr>
</table>
<br>
   
    
            
 
<!-- End ImageReady Slices -->
</body>
</html>