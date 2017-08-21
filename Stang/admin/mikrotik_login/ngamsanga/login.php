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
?><html>
<head>
<title>WIFI HISPEED</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<style type="text/css">
<!--
body {
	background-color: #000000;
}
-->
</style></head>
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
<!-- ImageReady Slices (Tapsala.psd) -->
<table width="1025" height="650" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="4">
			<img src="images/Tapsala_01.png" width="1024" height="118" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="118" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/Tapsala_02.png" width="264" height="178" alt=""></td>
		<td rowspan="2">
			<img src="images/Tapsala_03.png" width="675" height="457" alt=""></td>
		<td rowspan="4">
			<img src="images/Tapsala_04.png" width="85" height="532" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="178" alt=""></td>
	</tr>
	<tr>
		<td rowspan="3">
			<img src="images/Tapsala_05.png" width="47" height="354" alt=""></td>
		<td  width="217" height="287" rowspan="2" valign="top" background="images/Tapsala_06.png" >
	 
		<table width="100%" height="86%" style="margin-top: 10%;">
	<tr>
	<td align="center" valign="middle">
		
		<table width="179" height="130" style="border: 1px solid #cccccc; padding: 0px;" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center" valign="bottom" height="15" colspan="2">
				<form name="login" action="<?php echo $linkloginonly; ?>" method="post" onSubmit="return doLogin()" >
						<input type="hidden" name="dst" value="http://www.google.co.th" />
					<input type="hidden" name="popup" value="true" />
						
							<table width="183" style="background-color: #ffffff">
								<tr><td align="right">login</td>
										<td><input style="width: 80px" name="username" type="text" autocomplete="off"  value="<?php echo $username; ?>"></td>
								</tr>
								<tr><td align="right">password</td>
										<td><input style="width: 80px" name="password" type="password" autocomplete="off" /></td>
								</tr>
								<tr><td>&nbsp;</td>
										<td><input type="submit" value="OK" /></td>
								</tr>
					  </table>
					</form>
				</td>
			</tr>
	 
	  </table>
	
 
	
	</td>
	</tr>
</table>
<script type="text/javascript">
<!--
  document.login.username.focus();
//-->
</script>
	  </td>
		<td>
			<img src="images/spacer.gif" width="1" height="279" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="images/Tapsala_07.png" width="675" height="75" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="8" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/Tapsala_08.png" width="217" height="67" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="67" alt=""></td>
	</tr>
</table>
 
</body>
</html>