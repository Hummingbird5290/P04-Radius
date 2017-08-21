<?php
ob_start();
session_start();
// print   $_SERVER["REQUEST_URI"];
extract($_POST);extract($_GET);extract($_REQUEST);
//print_r($_SESSION);
$www=$HTTP_HOST;
$doname_login=$_SESSION["domain"];
$domian_name=$_SESSION["domain"];
$domain_name=$_SESSION["domain"];
?><html>
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
<IFRAME name=main   src=http://radius.t-voip0.zapto.org:81/show_new.php?domain_name=<?php print $_SESSION["domain"];?>  width=587 height=428 frameborder=0 scrolling=yes></IFRAME>

		 </td>
		<td rowspan="13">
			<img src="images/login_04.png" width="128" height="498" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="150" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="10">
			<img src="images/login_05.png" width="51" height="188" alt=""></td>
		<td colspan="4">
			<a href="http://radius.t-voip0.zapto.org:81/register1.php?domain_name=<?php print $_SESSION["domain"];?>" target="_blank">
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
		<a href="http://radius.t-voip0.zapto.org:81/active.php?domain=<?php print $_SESSION["domain"];?>" target="_blank">
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
		<a href="http://radius.t-voip0.zapto.org:81/card_true_acctive.php?domain_name=<?php print $_SESSION["domain"];?>" target="_blank">
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
		<a href="http://t-voip0.zapto.org:81/problem.php?domain_name=<?php print $_SESSION["domain"];?>" target="_blank">
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
			<a href="http://t-voip0.zapto.org:81/forget_pass.php?domain_name=<?php print $_SESSION["domain"];?>" target="_blank">
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
						<form name="login" action="$(link-login-only)" method="post"
					    $(if chap-id) onSubmit="return doLogin()" $(endif) >
					
<div class="notice"  font-size: 14px">  
<a style="color: #0000FF;background-color: #FFFFFF" href="$(link-login-only)?dst=$(link-orig-esc)&username=T-$(mac-esc)">คลิกที่นี่เพื่อทดลองเล่น  15  นาที</a> 
</div>
							<table width="183" style="background-color: #ffffff">
								<tr>
								  <td colspan="2" align="right"><div align="center">INTERNET LOGIN </div></td>
							  </tr>
								<tr><td align="right">login</td>
										<td><input style="width: 80px" name="username" type="text" value="$(username)"/></td>
								</tr>
								<tr><td align="right">password</td>
										<td><input style="width: 80px" name="password" type="password"/></td>
								</tr>
								<tr><td>	<input type="hidden" name="dst" value="$(link-orig)" />
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