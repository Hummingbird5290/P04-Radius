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
 
	<head>
		<!-- Created by Artisteer v3.0.0.35414 Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional" //-->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
		<title>WIFIDIRECT</title>
		<link rel="stylesheet" href="./style.css" type="text/css" media="screen" />
		<!--[if IE 6]><link rel="stylesheet" href="./style.ie6.css" type="text/css" media="screen" /><![endif]-->
		<!--[if IE 7]><link rel="stylesheet" href="./style.ie7.css" type="text/css" media="screen" /><![endif]-->
		<script type="text/javascript" src="./jquery.js"></script>
		<script type="text/javascript" src="./script.js"></script>
    		<style type="text/css">
    		sf {font-weight: bold;}rr {color: #00F;}.style1 {font-size: medium}
            </style>
	</head>

    	<body>
        		<div id="art-page-background-middle-texture">
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
				<div id="art-main">
				<div class="art-sheet">
				<div class="art-sheet-tl"></div>
				<div class="art-sheet-tr"></div>
				<div class="art-sheet-bl"></div>
				<div class="art-sheet-br"></div>
				<div class="art-sheet-tc"></div>
				<div class="art-sheet-bc"></div>
				<div class="art-sheet-cl"></div>
				<div class="art-sheet-cr"></div>
				<div class="art-sheet-cc"></div>
				<div class="art-sheet-body">
				<div class="art-header">
				<div class="art-header-center">
				<div class="art-header-png"></div>
				<div class="art-header-jpeg"></div>
				</div>

		<script type="text/javascript" src="swfobject.js"></script>
				<div id="art-flash-area">
				<div id="art-flash-container">
				<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="590" height="100" id="art-flash-object">
				<param name="movie" value="container.swf" ></param>
				<param name="quality" value="high" ></param>
				<param name="scale" value="default" ></param>
				<param name="wmode" value="transparent" ></param>
				<param name="flashvars" value="color1=0xFFFFFF&amp;alpha1=.30&amp;framerate1=24&amp;loop=true&amp;wmode=transparent&amp;clip=images/flash.swf&amp;radius=17&amp;clipx=0&amp;clipy=-60&amp;initalclipw=900&amp;initalcliph=225&amp;clipw=885&amp;cliph=221&amp;width=590&amp;height=100&amp;textblock_width=0&amp;textblock_align=no" ></param>
				<param name="swfliveconnect" value="true" ></param>

				<!--[if !IE]>-->
				<object type="application/x-shockwave-flash" data="container.swf" width="590" height="100">
				<param name="quality" value="high" ></param>
				<param name="scale" value="default" ></param>
				<param name="wmode" value="transparent" ></param>
				<param name="flashvars" value="color1=0xFFFFFF&amp;alpha1=.30&amp;framerate1=24&amp;loop=true&amp;wmode=transparent&amp;clip=images/flash.swf&amp;radius=17&amp;clipx=0&amp;clipy=-60&amp;initalclipw=900&amp;initalcliph=225&amp;clipw=885&amp;cliph=221&amp;width=590&amp;height=100&amp;textblock_width=0&amp;textblock_align=no" ></param>
				<param name="swfliveconnect" value="true" ></param>
				<!--<![endif]-->

				<div class="art-flash-alt"><a href="https://www.adobe.com/go/getflashplayer"><img src="https://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></div>

				<!--[if !IE]>-->
				</object>
				<!--<![endif]-->

				</object>
				</div>
				</div>
				<script type="text/javascript">swfobject.switchOffAutoHideShow();swfobject.registerObject("art-flash-object", "9.0.0", "expressInstall.swf");</script>
				<div class="art-headerobject"></div>
				<div class="art-logo">
				<h1 id="name-text" class="art-logo-name"><a href="#">@WIFIHISPEED</a></h1>
				<h2 id="slogan-text" class="art-logo-text">โครงข่ายอินเทอร์เน็ตไร้สายความเร็วสูง มาตรฐานสากล</h2>
				</div>
				</div>  
		<tr>
		  <div align="center"><br />
	      <span class="style1">เพียงวันล่ะ 10 BATH          </span> </div>
		  <div align="center" class="notice" style="color: #c1c1c1; font-size: 25px">  
 <!-- $(if trial == 'yes') -->
ทดสอบเล่นฟรีคลิกที่นี่, <a style="color: #FF8080"href="<?php echo $linkloginonly; ?>?dst=<?php echo $linkorigesc; ?>&username=T-<?php echo $macesc; ?>">click here</a>.
<!-- $(endif) -->
</div>
		<tr>
        				<div class="art-content-layout">
				<div class="art-content-layout-row">
				<div class="art-layout-cell art-content">
				<div class="art-post">
				<div class="art-post-body">
				<div class="art-post-inner art-article">
				<div class="art-postcontent">
                	<form name="login" action="<?php echo $linkloginonly; ?>" method="post" onSubmit="return doLogin()" >
      
        <input type="hidden" name="dst" value="<?php echo $linkorig; ?>" />
						<input type="hidden" name="popup" value="true" />
                                             
	<p></p>
		<table class="art-article" border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
		<tbody>

		<tr class="even">
			<td  ><B>Username</B></td>
			<td  ><div align="center"><input style="width: 150px" border="0" name="username" type="text" value="<?php echo $username; ?>"/></div></td>
		</tr>

		<tr>
			<td  ><B>Password</B><br /></td>
			<td  ><div align="center"><input style="width: 150px" name="password" type="password"/></div></td>
		</tr>

		<tr class="even">
			<td height="40"><br /><br /></td>
			<td valign="bottom"><div  align="center">
                	<input style="width:150px" type="submit" value="เข้าสู่ระบบ"  />
            		</div></td>
		</tr>
		</tbody>
		</table></form>
		<p>&nbsp;</p>
		</div>
  	<div class="cleared"></div>
			</div>
			<div class="cleared"></div>
			</div>
			</div>
		<div class="cleared"></div>
		</div>
			<div class="art-layout-cell art-sidebar1"><br />
			<div class="art-block">
			<div class="art-block-tl"></div>
			<div class="art-block-tr"></div>
			<div class="art-block-bl"></div>
			<div class="art-block-br"></div>
			<div class="art-block-tc"></div>
			<div class="art-block-bc"></div>
			<div class="art-block-cl"></div>
			<div class="art-block-cr"></div>
			<div class="art-block-cc"></div>
			<div class="art-block-body">
                                        
			<div class="art-blockcontent">
                                            
			<div class="art-blockcontent-body">
			<div>
														
			<ul><B>ระบบInternetWiFi </B>
			
			<li>หรือซื้อ"บัตรTruemoney(ทรูมันนี่)"ได้ที่7-Eleven แล้วเติมเงินเข้าระบบทางหน้าเว็บLogin <a href="http://www.thaigqsoft.info/card_true_acctive.php?domain_name=test">คลิกที่นี่</a></li>
		  <ul><li></li>
			</ul>

			</div>

			<div class="cleared"></div>
		</div>
		</div>
			<div class="cleared"></div>
		</div>
		</div>
			<div class="cleared"></div>
		</div>
		</div>
		</div>
			<div class="cleared"></div>
			<div class="art-footer">
			<div class="art-footer-t"></div>
			<div class="art-footer-l"></div>
			<div class="art-footer-b"></div>
			<div class="art-footer-r"></div>
			<div class="art-footer-body"><a href="./#" class="art-rss-tag-icon" title="RSS"></a>
			<div class="art-footer-text"><br />  Copyright © 2013. All Rights Reserved.  </div>
			<div class="cleared"></div>
		</div>
		</div>
			<div class="cleared"></div>
		</div>
		</div>
			<div class="cleared"></div>
			<p class="art-page-footer">Powered by TLOG</p>
		</div>
		</div>
	</body>
</html>
