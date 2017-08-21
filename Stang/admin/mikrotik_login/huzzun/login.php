<?php
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
?>
<html>
<head>
<title>HUZZUNWIFI</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<style type="text/css">
<!--
body {
	background-color: #000000;
}
-->
</style></head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- $(if chap-id) -->

	<form name="sendin" action="<?php echo $linkloginonly; ?>" method="post">
		<input type="hidden" name="username" />
		<input type="hidden" name="password" />
		<input type="hidden" name="dst" value="http://www.google.co.th" />
		<input type="hidden" name="popup" value="true" />
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
<!-- $(endif) -->

       
<!-- ImageReady Slices (Tapsala.psd) -->
<table width="1025" height="651" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="11">
			<img src="images/login_01.png" width="1024" height="152" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="152" alt=""></td>
	</tr>
	<tr>
		<td colspan="9">
			<img src="images/login_02.png" width="310" height="150" alt=""></td>
		<td rowspan="10"  width="586" height="429" bgcolor="#FFFFFF" >
 <div class="notice"   align="center"> 
<a style="color: #0000FF;background-color: #FFFFFF;font-size: 25px" href="<?php echo $linkloginonly; ?>?dst=<?php echo $linkorigesc; ?>&username=T-<?php echo $macesc; ?>">คลิกที่นี่เพื่อทดลองเล่น  60  นาที</a> 
</div>
			<IFRAME name=main   src=http://www.thaigqsoft.info/show_new.php?domain_name=huzzun  width=586 height=350 frameborder=0 scrolling=yes></IFRAME></td>
		<td rowspan="11">
			<img src="images/login_04.png" width="128" height="498" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="150" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="8">
			<img src="images/login_05.png" width="51" height="160" alt=""></td>
		<td colspan="3">
		<a href="http://www.thaigqsoft.info/register1.php?domain_name=huzzun" target="_blank">
			<img src="images/login_06.png" width="185" height="27" alt="" border="0">
			</a></td>
		<td colspan="4" rowspan="2">
			<img src="images/login_07.png" width="74" height="37" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="27" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="images/login_08.png" width="185" height="10" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="10" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="2">
			<img src="images/login_09.png" width="4" height="37" alt=""></td>
		<td colspan="3">
		<a href="http://www.thaigqsoft.info/active.php?domain=huzzun" target="_blank">
			<img src="images/login_10.png" width="209" height="27" alt="" border="0">
			</a></td>
		<td colspan="2" rowspan="6">
			<img src="images/login_11.png" width="46" height="123" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="27" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="images/login_12.png" width="209" height="10" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="10" alt=""></td>
	</tr>
	<tr>
		<td rowspan="4">
			<img src="images/login_13.png" width="1" height="86" alt=""></td>
		<td colspan="4">
			<img src="images/login_14.png" width="212" height="31" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="31" alt=""></td>
	</tr>
	<tr>
		<td colspan="4">
			<img src="images/login_15.png" width="212" height="7" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="7" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="images/login_16.png" width="3" height="48" alt=""></td>
		<td colspan="2">
		<a href="http://www.thaigqsoft.info/problem.php?domain_name=huzzun" target="_blank">
			<img src="images/login_17.png" width="184" height="31" alt="" border="0">
			</a></td>
		<td rowspan="2">
			<img src="images/login_18.png" width="25" height="48" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="31" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/login_19.png" width="184" height="17" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="17" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="images/login_20.png" width="47" height="188" alt=""></td>
		<td colspan="7" rowspan="2" background="images/login_21.png" width="222" height="188" alt="">
			
		<form name="login" action="<?php echo $linkloginonly; ?>" method="post" onSubmit="return doLogin()" >
					

							<table width="183" style="background-color: #ffffff">
								<tr>
								  <td colspan="2" align="right"><div align="center">INTERNET LOGIN </div></td>
							  </tr>
								<tr><td align="right">login</td>
										<td><input style="width: 80px" name="username" type="text"  autocomplete="off"  value="<?php echo $username; ?>"></td>
								</tr>
								<tr><td align="right">password</td>
										<td><input style="width: 80px" name="password" type="password"  autocomplete="off" />   </td>
								</tr>
								<tr><td>	<input type="hidden" name="dst" value="http://www.google.o.th" />
			<input type="hidden" name="popup" value="true" />
						<input type="hidden" name="popup" value="true" /></td>
										<td><input type="submit" value="OK" /></td>
								</tr>
					  </table>
		  </form>
			</td>
		<td rowspan="2">
			<img src="images/login_22.png" width="41" height="188" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="119" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/login_23.png" width="586" height="69" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="69" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/spacer.gif" width="47" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="4" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="3" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="181" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="3" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="25" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="5" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="41" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="586" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="128" height="1" alt=""></td>
		<td></td>
	</tr>
</table><br>

<!-- End ImageReady Slices -->
</body>
</html>