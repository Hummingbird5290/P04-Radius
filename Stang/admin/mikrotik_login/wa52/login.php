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
<!DOCTYPE html>
<!-- saved from url=(0055)http://twitter.github.com/bootstrap/examples/fluid.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<meta charset="utf-8">
    <title>HISPEED  Hotspot</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
	padding-top: 60px;
	padding-bottom: 40px;
	background-color:#f76d03;
	background-image: 
	background-attachment:fixed;
      }
      .sidebar-nav {
	padding: 9px 0;
	text-align: center;
      }
    .row-fluid .span3 .well.sidebar-nav .nav.nav-list li table tr td form table {
	text-align: center;
}
    .a {
	font-weight: bold;
}
    </style>
<link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="icon/16x16.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="icon/144x144.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="icon/114x144.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="icon/72x72.png">
    <link rel="apple-touch-icon-precomposed" href="icon/57x57.png">
    <style type="text/css">
<!--
.style4 {font-size: 36px}
-->
    </style>
    </head>

<body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
          <a class="brand" href="http://www.thaigqsoft.info/register1.php?domain_name=wa52">  Hotspot �к��׹�ѹ��ǵ��Թ������������</a>
          <div class="btn-group pull-right">
            <a class="btn btn-inverse" data-toggle="dropdown"
               ><i class="icon-signal icon-white"></i> IP: $(ip) MAC: $(mac)            </a>          </div>
          <div class="nav-collapse"></div><!--/.nav-collapse -->
      </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header"> 
                <form name="sendin" action="<?php echo $linkloginonly; ?>" method="post">
                  <input type="hidden" name="username" />
                  <input type="hidden" name="password" />
                  <input type="hidden" name="dst" value="http://www.google.co.th"/>
                  <input type="hidden" name="popup" value="true" />
                </form>
                <script type="text/javascript" src="/md5.js"></script>
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
                </li>
              <li class="active"><a href="http://www.thaigqsoft.info/register1.php?domain_name=wa52" target="_blank">ŧ����������ҹ�Թ������</a><br>
			   <li class="active"><a href="http://www.thaigqsoft.info/active.php?domain=wa52" target="_blank">��������������ѵäٻͧ</a><br>
			   <li class="active"><a href="http://www.thaigqsoft.info/card_true_acctive.php?domain_name=wa52" target="_blank">��������������ѵ÷���ѹ���</a><br>
			   <li class="active"><a href="http://www.thaigqsoft.info/problem.php?domain_name=wa52" target="_blank">�駻ѭ�ҡ����ҹ</a><br>
			   
                <tr>
                    <td align="center" valign="bottom" height="90" colspan="2">	<form name="login" action="<?php echo $linkloginonly; ?>" method="post" onSubmit="return doLogin()" >
                      <input type="hidden" name="dst3" value="$(link-orig)" />
                      <input type="hidden" name="popup2" value="true" />
                        <tr>
                          <td width="208"><p>������ҹ</p>
                            <p>&nbsp;
                              <input style="width: 120px" name="username" type="text" value="" id="username"/>
                            </p></td>
                        </tr>
                        <tr>
                          <td><p>���ʼ�ҹ &nbsp;</p>
                            <p>
  <input style="width: 120px" name="password" type="password" id="password"/>
                            </p></td>
                        </tr>
                        <tr>
                          <td height="43"><p>
                           <input class="btn btn-info" type="submit" value="Login">
                          </p></td>
                        </tr>
                     </form></td>
                  </tr>
                  <tr>
                    <td height="54" align="center"> 
                     
                      <script type="text/javascript">
      var error = "$(error)";

      if (error == "no valid profile found") {
         document.write("�ѵù�����������ҹ���Ǥ�� �ͺ�س������ԡ�� ");
         }
</script></td>
                  </tr>
              </li>
              <li></li>
              <li><center>
                <div id="myModal" class="modal hide fade">
                  <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h3>�������</h3>
                  </div>
                  <div class="modal-body">
                    <h4>WISP_HOTSPOT</h4>
					<h4>��ࡨ����ѹ</h4>
                    <p>
                      <center>
                        <font size="" color="#66cc00">100 �ҷ = 5 �ѹ���ӡѴ ��.<br>
                        </font> <font size="" color="#ff00cc">200 �ҷ = 15 �ѹ���ӡѴ ��.<br>
                        </font> <font size="" color="#ffcc00">300 �ҷ = 30 �ѹ���ӡѴ ��.<br>
                        </font>
                      </center>
                    </p>
                    <p><font size="" color="#3300cc">��ѧ�ҡ��ҹ����͡�ҡ�к��ء����  ����� user ��� password ����繤����Ѻ  �����ѡ�ҼŻ���ª��ͧ��ҹ�ͧ</font></p>
                    <hr>
                  </div>
                  <div class="modal-footer"><a class="btn btn-large btn-block btn btn btn-danger" href="">�ͺ�س������ԡ��&nbsp;</a>              						</div>
                </div>
                </center>
             </li>
              <li></li>
              <li><br>
                <center>
                </center>
                <center>
                </center>
              </li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="hero-unit">
<center><div class="alert alert-error">
  <button type="button" class="close" data-dismiss="alert">?</button>
  <h4><i class="icon-warning-sign"></i> �ô���ѧ !!</h4>
  <font size="" color="#ff0066"><b>�ҧ�к����ա���红����š����ҹ������ ��� �ú. ���������� � . � . 2550 ���ͻ�ͧ�ѹ��á�зӷ��Դ������
</b></font></div></center>
            <center>
              <br><br><br>
</center>
<center>

<div id="myCarousel" class="carousel slide">
  <!-- Carousel items -->
  <div class="carousel-inner">
    <div class="active item"> 
	 <?php
	 $hostname_edoc = "127.0.0.1";
$database_edoc = "radius";
$username_edoc = "root";
$password_edoc = "010464088";
$connect_db= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc);
 
    mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");

 mysql_select_db($database_edoc, $connect_db)  or trigger_error(mysql_error(),E_USER_ERROR);
 $query_Recordset1 = "SELECT   *   FROM news   where domain='wa52'  ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
print $row_Recordset1[news];
?>
</IFRAME>
	</div>
    <div class="item">... </div>
	<div class="item"> ..</div>
  </div>
  <!-- Carousel nav -->
  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a></div>
</center>


</p></font>
        </td></p>  
      <hr>
      <div align="center"><span class="alert-info style4"><strong>�������ͷء�Ե�ҡ��        </strong></span></div>
          </div>
          <!--/row-->
      <hr>
      <footer>
        <p>
          <button class="btn" type="button"> TLOG SYSTEM AUTHEN</button></p>
      </footer>
    </div>
	<!--/.fluid-container-->
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/jquery.js"></script>
    <script src="./js/bootstrap-transition.js"></script>
    <script src="./js/bootstrap-alert.js"></script>
    <script src="./js/bootstrap-modal.js"></script>
    <script src="./js/bootstrap-dropdown.js"></script>
    <script src="./js/bootstrap-scrollspy.js"></script>
    <script src="./js/bootstrap-tab.js"></script>
    <script src="./js/bootstrap-tooltip.js"></script>
    <script src="./js/bootstrap-popover.js"></script>
    <script src="./js/bootstrap-button.js"></script>
    <script src="./js/bootstrap-collapse.js"></script>
    <script src="./js/bootstrap-carousel.js"></script>
    <script src="./js/bootstrap-typeahead.js"></script>

</body></html>