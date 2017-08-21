<?php
session_start();
 #เรียก cache-kit.php
include_once('cache-kit.php');
# Config 
$cache_active = true; 
$cache_folder = 'cache/';

if ($_SESSION["langs"] == '') {
    $_SESSION["langs"] = "th.php";
}
$ll = $_SESSION["langs"];

include("lang/$ll");
//print $ll;
?>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<?php

function randomToken($len) {
    srand(date("s"));
//$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
//$chars ="ABCDEFGHIJKLM";
    $chars = "123456789"; // กำหนดอักขษะที่จะนำมา random แก้ได้นะ 
    $ret_str = "";
    $num = strlen($chars);
    for ($i = 0; $i < $len; $i++) {
        $ret_str.= $chars[rand() % $num]; // ใช้ฟังชั่น rand() เข้ามาช่วยในการทำงาน 
    }
    return $ret_str;
}
?>

<?php
include("Connections/dbconnect.php");

if ($login == "login") {
    if ($chk_num != $code1) {
//กรุณา กรอกข้อมูล รหัสรักษาความปลอดภัยให้ตรงกับรูปภาพ
        echo "<script type=text/javascript>";
        echo "alert('  $text1 ')";
        echo "</script>";
        echo "<meta http-equiv=refresh content=0;URL=http://192.168.182.1:3990/prelogin>";

        exit();
    }
}
#บล๊อคแมค
$mac = $_GET[mac];

$block_mac_sql = "SELECT   *   FROM    block_mac    where  url='$mac'   ";
$mac_db = mysql_query($block_mac_sql, $connect_db) or die(mysql_error());
$totalRows_mac = mysql_num_rows($mac_db);

if ($totalRows_mac != 0) {
//$text2="acaddress ท่านโดนบล๊อค
    echo "<script type=text/javascript>";
    echo "alert(' $text2 ')";
    echo "</script>";
    exit();
}



#ดึงข้อความ popup มาจาก db

# ดึงค่าจาก Cache จาก Key ชื่อ IndexKey ในช่วง 10000 วินาทีที่ผ่านมา
$tail_data = acmeCache::fetch('tail_data', 2000); // 10000 seconds
$tail_ddns = acmeCache::fetch('tail_ddns', 2000); // 10000 seconds
$rbg = acmeCache::fetch('rbg', 2000); // 10000 seconds
# ถ้าผ่าน 10 วินาทีไปแล้วก็ให้ดึงค่าจาก Loop ที่ควรดึงเช่น MySQL หรืออะไรต่างๆใหม่
if(!$tail_ddns){
$query_user = "SELECT   *   FROM    seting       ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_seting = mysql_fetch_assoc($user_db);
$tail_data = $row_seting[topdown];
$tail_ddns = $row_seting[ddns];
$rbg = $row_seting[popupbg];
# ฝังข้อมูลลงใน Key ที่ชื่อว่า IndexKey
acmeCache::save('tail_data', $tail_data);
acmeCache::save('tail_ddns', $tail_ddns);
acmeCache::save('rbg', $rbg);
}

if ($rbg == '') {
    $rbg = "1.png";
}
$bgpopup = "bg/$rbg";

#ดึง เวลา ที่เค้าใช้งานในระบบทั้งหมดมา
print " <style type=\"text/css\">
body
{
background-image:url('$bgpopup');
background-repeat:no-repeat;
background-position:center top;
}
</style>"; 
if ($_GET['res'] != success and  $_GET['res'] !=popup2 ) {

    print "<body     text=\"#FFFFFF\"  	link=\"#FFFFFF\" vlink=\"#FFFFFF\" alink=\"#FFFFFF\">";
}
if ($_GET['res'] == success or  $_GET['res'] ==popup2 ) {
 print   "<body  onUnLoad=\"javascript:doOnUnLoad()\"     text=\"#FFFFFF\" 
	link=\"#FFFFFF\" vlink=\"#FFFFFF\" alink=\"#FFFFFF\">";
}


global $a, $b;
# File: hotspotlogin.php
# working with chillispot_0.97
# last change 2004-10-01
# this is forked from original chillispot.org's hotspotlogin.cgi by Kanne
# uamsecret enabled by Cedric
# logoff when closing logoff window added by Lorenzo Allori <lallori_A.T_medici.org>
#<h1 style=\"text-align: center;\">$headline</h1>
# Shared secret used to encrypt challenge with. Prevents dictionary attacks.
# You should change this to your own shared secret.

$uamsecret = "thaigqsoft";



# Uncomment the following line if you want to use ordinary user-password
# for radius authentication. Must be used together with $uamsecret.

$userpassword = 1;



$loginpath = "/ddwrt_login.php";



# possible Cases:	
# attempt to login                          login=login
# 1: Login successful                       res=success
# 2: Login failed                           res=failed
# 3: Logged out                             res=logoff
# 4: Tried to login while already logged in res=already
# 5: Not logged in yet                      res=notyet
#11: Popup                                  res=popup1
#12: Popup                                  res=popup2
#13: Popup                                  res=popup3
# 0: It was not a form request              res=""
#Read query parameters which we care about
# $_GET['res'];
# $_GET['challenge'];
# $_GET['uamip'];
# $_GET['uamport'];
# $_GET['reply'];
# $_GET['userurl'];
# $_GET['timeleft'];
# $_GET['redirurl'];
#Read form parameters which we care about
# $_GET['username'];
# $_GET['password'];
# $_GET['chal'];
# $_GET['login'];
# $_GET['logout'];
# $_GET['prelogin'];
# $_GET['res'];
# $_GET['uamip'];
# $_GET['uamport'];
# $_GET['userurl'];
# $_GET['timeleft'];
# $_GET['redirurl'];



$titel = 'TLog Syslog';

$headline = '';

$bodytext = '';

$body_onload = '';

$footer_text = "<center>
                             <font color=\"#FFFFFF\"><b>$tail_data</b> </font>
                           </center>";



$footer_textz = ' ';



# attempt to login

if ($_GET['login'] == login) {



    $hexchal = pack("H32", $_GET['chal']);



    if (isset($uamsecret)) {

        $newchal = pack("H*", md5($hexchal . $uamsecret));
    } else {

        $newchal = $hexchal;
    }



    $response = md5("\0" . $_GET['Password'] . $newchal);



    $newpwd = pack("a32", $_GET['Password']);

    $pappassword = implode("", unpack("H32", ($newpwd ^ $newchal)));



//  $titel = 'กำลังตรวจสอบรหัสผ่าน'; 
    $titel = "$text3";
    $headline = "$text3";

    $bodytext = '';



    print_header();



    if ((isset($uamsecret)) && isset($userpassword)) {

        $_SESSION["ulogin_pass"] = $_GET['UserName'];
        $_SESSION["plogin_pass"] = $_GET['Password'];
        $a = $_SESSION["ulogin_pass"];
        $b = $_SESSION["plogin_pass"];
        print '<meta http-equiv="refresh" content="0;url=http://' . $_GET['uamip'] . ':' . $_GET['uamport'] . '/logon?username=' . $_GET['UserName'] . '&password=' . $pappassword . '">';
    } else {
        $_SESSION["ulogin_pass"] = $_GET['UserName'];
        $_SESSION["plogin_pass"] = $_GET['Password'];
        $a = $_SESSION["ulogin_pass"];
        $b = $_SESSION["plogin_pass"];
        print '<meta http-equiv="refresh" content="0;url=http://' . $_GET['uamip'] . ':' . $_GET['uamport'] . '/logon?username=' . $_GET['UserName'] . '&response=' . $response . '&userurl=' . $_GET['userurl'] . '">';
    }



    print_body();

    print_footer();
}



# 1: Login successful

if ($_GET['res'] == success) {



    $result = 1;

    $titel = 'ยินดีต้อนรับ';

    $s_name = $_GET['uid'];



#๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒ 
  $data_name = "<IFRAME name=\"IFRAME\"   src=\"showtime_ddwrt.php?UserName=$s_name&mac=$mac\"   width=\"300\" height=\"130\" frameborder=\"0\"  scrolling=\"yes\"></IFRAME>";
 //   $data_name.="<IFRAME name=\"IFRAME\"   src=\"http://dns.thaigqsoft.com/getip.php?hostname=$tail_ddns&type=ddns\"   width=\"1\" height=\"1\" frameborder=\"0\" scrolling=\"yes\"></IFRAME>";


    $query_user = "SELECT   *  FROM    register   where       UserName='$s_name'   ";
    $user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
    $row_seting = mysql_fetch_assoc($user_db);
    $name_full = $row_seting[fullname];

    $headline = "
  <body  onUnLoad=\"javascript:doOnUnLoad()\"   background=\"$bgpopup\"   text=\"#FFFFFF\" 
	link=\"#FFFFFF\" vlink=\"#FFFFFF\" alink=\"#FFFFFF\">  ";

    $bodytext = '
<table width=\"100%\" border=\"0\">
  <tr> 
    <td bgcolor=#FFFFFF><div align="center"><font color="#000000" size=2 face=MS Sans Serif, Tahoma, sans-serif Sans Serif, Tahoma, sans-serif\">
	   ' . $text4 . '&nbsp;' . $name_full . '
        </font></div></td>
  </tr>
  <tr> 
    <td bgcolor=#0000CC><div align="center"><font color="#000000" size=2 face=MS Sans Serif, Tahoma, sans-serif Sans Serif, Tahoma, sans-serif\"><a href=edit_user.php target=\"_blank\">' . $text5 . '</a> 
        </font></div></td>
  </tr>
  <tr> 
    <td bgcolor=#0000CC><div align="center"><font color="#000000" size=2 face=MS Sans Serif, Tahoma, sans-serif Sans Serif, Tahoma, sans-serif\"><a href="index.php?case_i=3" target=\"_blank\">' . $text6 . '</a> 
        </font></div></td>
  </tr>
  <tr> 
    <td bgcolor=#FFFFFF><div align="center"></div></td>
  </tr>
  <tr> 
    <td bgcolor=#FFFFFF><div align="center"><font color="#000000" size=2 face=MS Sans Serif, Tahoma, sans-serif Sans Serif, Tahoma, sans-serif\">
	' . $text7 . ' 
        </font></div></td>
  </tr>
  <tr> 
    <td bgcolor=#FFFFFF><div align="center"><font color="#000000"  size=2 face=MS Sans Serif, Tahoma, sans-serif Sans Serif, Tahoma, sans-serif\">
	' . $text8 . '    </font> </div></td>
  </tr>
 
</table>';
    $bodytext .=$data_name;


  //  $body_onload = 'onLoad="javascript:popUp(' . $loginpath . '?res=popup&uamip=' . $_GET['uamip'] . '&uamport=' . $_GET['uamport'] . '&timeleft=' . $_GET['timeleft'] . '&username=' . $a . ')"';









    print_header();

    print_body();


    if ($reply) {

        print '<center>' . $reply . '</BR></BR></center>';
    }
    print '<center><a href=http://' . $_GET['uamip'] . ':' . $_GET['uamport'] . '/logoff>Logout</a></center>';
  
		if ($_GET['res'] != popup2 and $_GET['res'] ==success ) { 
	            echo "<meta http-equiv=refresh content=0;URL=http://www.google.com>";
            exit();
			  }
			    print_footer();
}



# 2: Login failed

if ($_GET['res'] == failed) {
    $result = 2;
    $titel = "$text9";
    $headline = '<font color="#FFFFFF" size="2" face="MS Sans Serif, Tahoma, sans-serif">' . $text9 . '</font>';

    if ($_GET['reply'] == "Password Has Expired\r\n") {
        print_header();
        print_body_Expired();
        exit();
    }
    if ($_GET['reply'] == "\r\nYou are already logged in - access denied\r\n\n") {
        print_header();
        print_body_already_logged();
        exit();
    }
    print_header();
    print_body();

    if ($_GET['reply']) {
        print '<center>' . $_GET['reply'] . '</center><br>';
        //  print '<font color="#FFFFFF" size="2" face="MS Sans Serif, Tahoma, sans-serif"><center><a href="http://192.168.182.1/index.php?case_i=5" target="_blank"><b>ชื่อท่านยังอยู่ในระบบ โปรด คลิก Clear Login<b></a></center></font>';
        print ' <br>';
    }
    print_login_form();
    print_footer();
}



# 3: Logged out

if ($_GET['res'] == logoff) {
    $result = 3;
    $titel = "$text10";
    $headline = '<font color="#FFFFFF" size="2" face="MS Sans Serif, Tahoma, sans-serif">ลงชื่อออกจาก Internet แล้ว</font> ';
    $bodytext = "$text11";
    print_header();
    print_body();
    print_footer();
}
# 3: Logged out

if ($_GET['res'] == "Password Has Expired\r\n") {
    $result = 3;
    $titel = "$text12";

    $headline = '<font color="#FFFFFF" size="2" face="MS Sans Serif, Tahoma, sans-serif">' . $text12 . '</font>';
// print_header();
    // print_body();
    print $titel;
    print_footer();
}


# 4: Tried to login while already logged in

if ($_GET['res'] == already) {
    $result = 4;
    $titel = "$text13";
    $headline = '<font color="#FFFFFF" size="2" face="MS Sans Serif, Tahoma, sans-serif">' . $text13 . '</font> ';
    $bodytext = " <center><a href=http://192.168.182.1:3990/logoff>Logout</a></center>";
    print_header();
    print_body();
    print_footer();
}



# 5: Not logged in yet

if ($_GET['res'] == notyet) {



    $result = 5;

    $titel = "$text14";

    $headline = '<font color="#FFFFFF" size="2" face="MS Sans Serif, Tahoma, sans-serif">' . $text14 . '</font> ';

    $bodytext = 'please log in<br>';





    print_header();

    print_body();

    print_login_form();

    print_footer();
}



#11: Popup1

if ($_GET['res'] == popup1) {



    $result = 11;

    $titel = "$text3";

    $headline = '<font color="#FFFFFF" size="2" face="MS Sans Serif, Tahoma, sans-serif">' . $text3 . '</font>';

    $bodytext = 'please wait...';





    print_header();

    print_body();

    print_footer();
}



#12: Popup2

if ($_GET['res'] == popup2) {



    $result = 12;

#๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒๒ 
$s_name=$_SESSION[ulogin_pass];
  $data_name = "<IFRAME name=\"IFRAME\"   src=\"showtime_ddwrt.php?UserName=$s_name&mac=$mac\"   width=\"300\" height=\"130\" frameborder=\"0\"  scrolling=\"yes\"></IFRAME>";
 //   $data_name.="<IFRAME name=\"IFRAME\"   src=\"http://dns.thaigqsoft.com/getip.php?hostname=$tail_ddns&type=ddns\"   width=\"1\" height=\"1\" frameborder=\"0\" scrolling=\"yes\"></IFRAME>";


    $query_user = "SELECT   *  FROM    register   where       UserName='$s_name'   ";
    $user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
    $row_seting = mysql_fetch_assoc($user_db);
    $name_full = $row_seting[fullname];

 

    $bodytext = '
<table width=\"100%\" border=\"0\">
  <tr> 
    <td bgcolor=#FFFFFF><div align="center"><font color="#000000" size=2 face=MS Sans Serif, Tahoma, sans-serif Sans Serif, Tahoma, sans-serif\">
	   ' . $text4 . '&nbsp;' . $name_full . '
        </font></div></td>
  </tr>
  <tr> 
    <td bgcolor=#0000CC><div align="center"><font color="#000000" size=2 face=MS Sans Serif, Tahoma, sans-serif Sans Serif, Tahoma, sans-serif\"><a href=edit_user.php target=\"_blank\">' . $text5 . '</a> 
        </font></div></td>
  </tr>
  <tr> 
    <td bgcolor=#0000CC><div align="center"><font color="#000000" size=2 face=MS Sans Serif, Tahoma, sans-serif Sans Serif, Tahoma, sans-serif\"><a href="index.php?case_i=3" target=\"_blank\">' . $text6 . '</a> 
        </font></div></td>
  </tr>
  <tr> 
    <td bgcolor=#FFFFFF><div align="center"></div></td>
  </tr>
  <tr> 
    <td bgcolor=#FFFFFF><div align="center"><font color="#000000" size=2 face=MS Sans Serif, Tahoma, sans-serif Sans Serif, Tahoma, sans-serif\">
	' . $text7 . ' 
        </font></div></td>
  </tr>
  <tr> 
    <td bgcolor=#FFFFFF><div align="center"><font color="#000000"  size=2 face=MS Sans Serif, Tahoma, sans-serif Sans Serif, Tahoma, sans-serif\">
	' . $text8 . '    </font> </div></td>
  </tr>
 
 
</table>';
    $bodytext .=$data_name;

print_header();
print  "<center>".$bodytext."</center><br>";
print  " <center><a href=http://192.168.182.1:3990/logoff>Logout</a></center>";

// print_r($_SESSION);
 print_footer();
}



#13: Popup3

if ($_GET['res'] == popup3) {



    $result = 13;

    $titel = 'Logged out from Internet';

    $headline = '<font color="#FFFFFF" size="2" face="MS Sans Serif, Tahoma, sans-serif">Logout</font>';

    $bodytext = '<a href="http://' . $_GET['uamip'] . ':' . $_GET['uamport'] . '/prelogin">Login</a>';





    print_header();

    print_body();

    print_footer();
}



# 0: It was not a form request
# Send out an error message

/* i
  f ($_GET['res'] == "") {



  //$result = 0;

  $result = 1;
  $titel = 'คุณต้องเข้าผ่าน https?';

  $headline = 'คุณต้องเข้าผ่าน https';

  $bodytext = 'Login must be performed through TLog daemon!';



  print_header();

  print_body();

  print_footer();



  }


 */
# functions

function print_header() {


    global $titel, $loginpath, $ll;
    include("lang/$ll");
    $a = $_SESSION["ulogin_pass"];
    $b = $_SESSION["plogin_pass"];

    $uamip = $_GET['uamip'];

    $uamport = $_GET['uamport'];



    print "

  <html>

    <head>


      <title>$titel</title>

        <meta http-equiv=\"Cache-control\" content=\"no-cache\">

        <meta http-equiv=\"Pragma\" content=\"no-cache\">

        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-874\">

        <SCRIPT LANGUAGE=\"JavaScript\">

    var blur = 0;

    var starttime = new Date();

    var startclock = starttime.getTime();

    var mytimeleft = 0;



    function doTime() {
	

      window.setTimeout( \"doTime()\", 1000 );

      t = new Date();

      time = Math.round((t.getTime() - starttime.getTime())/1000);

      if (mytimeleft) {

        time = mytimeleft - time;

        if (time <= 0) {

          window.location = \"$loginpath?res=popup3&uamip=$uamip&uamport=$uamport&username=$a\";

        }

      }

      if (time < 0) time = 0;

      hours = (time - (time % 3600)) / 3600;

      time = time - (hours * 3600);

      mins = (time - (time % 60)) / 60;

      secs = time - (mins * 60);

      if (hours < 10) hours = \"0\" + hours;

      if (mins < 10) mins = \"0\" + mins;

      if (secs < 10) secs = \"0\" + secs;

      title = \"Online time: \" + hours + \":\" + mins + \":\" + secs;

      if (mytimeleft) {

        title = \"Remaining time: \" + hours + \":\" + mins + \":\" + secs;

      }

      if(document.all || document.getElementById){

         document.title = title;

      }

      else {   

        self.status = title;

      }

    }



    function popUp(URL) {

      if (self.name != \"chillispot_popup\") {chillispot_popup = window.open(URL, 'chillispot_popup', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=400,height=400');

      }

    }



    function doOnLoad(result, URL, userurl, redirurl, timeleft) {

      if (timeleft) {

        mytimeleft = timeleft;

      }

      if ((result == 1) && (self.name == \"chillispot_popup\")) {

        doTime();

      }

      if ((result == 1) && (self.name != \"chillispot_popup\")) {chillispot_popup = window.open(URL, 'chillispot_popup', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=400,height=400');

      }

      if ((result == 2) || result == 5) {

        document.form1.UserName.focus()

      }

      if ((result == 2) && (self.name != \"chillispot_popup\")) {chillispot_popup = window.open('', 'chillispot_popup', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=400,height=400');chillispot_popup.close();

      }

      if ((result == 12) && (self.name == \"chillispot_popup\")) {

        doTime();

        if (redirurl) {

          opener.location = redirurl;

        }

        else if (opener.home) {

          opener.home();

        }

        else {

          opener.location = \"about:home\";

        }

        self.focus();

        blur = 0;

      }

      if ((result == 13) && (self.name == \"chillispot_popup\")) {

        self.focus();

        blur = 1;

      }

    }



    function doOnBlur(result) {

      if ((result == 12) && (self.name == \"chillispot_popup\")) {

        if (blur == 0) {

          blur = 1;

          self.focus();

        }

      }

    }

    function popup_logoff(url, name)

    {

    MyNewWindow=window.open(\"http://\"+url,name);

    }

 


       function doOnUnLoad() {
            
            var browser=navigator.appName;
            var b_version=navigator.appVersion;
            var version=parseFloat(b_version);
            if (browser!=\"Microsoft Internet Explorer\") {
               self.opener.location = 'http://" . $_GET['uamip'] . ":" . $_GET['uamport'] . "/logoff';
            } else {
               self.location = 'http://" . $_GET['uamip'] . ":" . $_GET['uamport'] . "/logoff';
            }
         alert(\"$text15 \");
            self.close();
         }
      </script>";
}

function print_body() {

    global $headline, $bodytext, $body_onload, $result, $loginpath, $UserName, $ll;


    include("lang/$ll");
    $uamip = $_GET['uamip'];

    $uamport = $_GET['uamport'];

    $userurl = $_GET['userurl'];

    $redirurl = $_GET['redirurl'];

    $userurldecode = $_GET['userurl'];

    $redirurldecode = $_GET['redirurl'];

    $timeleft = $_GET['timeleft'];



    print "

  </head>
 
    <body onLoad=\"javascript:doOnLoad($result, '$loginpath?res=popup2&username=$a&uamip=$uamip&uamport=$uamport&userurl=$userurl&redirurl=$redirurl&timeleft=$timeleft','$userurldecode', '$redirurldecode', '$timeleft')\" onBlur = \"javascript:doOnBlur($result)\" bgColor = '#c0d8f4'>

   <div align=center><font color=#0000FF size=3 face=MS Sans Serif, Tahoma, sans-serif><strong>$headline 
  </strong></font></div>

      <center>$bodytext</center><br>";



# begin debugging
#  print '<center>THE INPUT (for debugging):<br>';
#    foreach ($_GET as $key => $value) {
#      print $key.'='.$value.'<br>';
#    }
#  print '<br></center>';
# end debugging
}

function print_bodyz() {

    global $headline, $bodytext, $body_onload, $result, $loginpath, $a, $b, $ll;

    $a = $_SESSION["ulogin_pass"];
    $b = $_SESSION["plogin_pass"];

    include("lang/$ll");

    $uamip = "192.168.182.1";

    $uamport = $_GET['uamport'];

    $userurl = $_GET['userurl'];

    $redirurl = $_GET['redirurl'];

    $userurldecode = $_GET['userurl'];

    $redirurldecode = $_GET['redirurl'];

    $timeleft = $_GET['timeleft'];


//onLoad=\"javascript:doOnLoad($result, '$loginpath?res=popup2&username=$a&uamip=$uamip&uamport=$uamport&userurl=$userurl&redirurl=$redirurl&timeleft=$timeleft','$userurldecode', '$redirurldecode', '$timeleft')\" onBlur = \"javascript:doOnBlur($result)\" bgColor = '#c0d8f4'
    //print "  </head>
	 

    echo "
   <body  onUnLoad=\"javascript:doOnUnLoad()\" background=\"$bgpopup\"   text=\"#FFFFFF\" 
	link=\"#FFFFFF\" vlink=\"#FFFFFF\" alink=\"#FFFFFF\">

<table width=\"100%\" border=\"0\">
    <tr> 
      <td bgcolor=\"#FFFFFF\"><div align=\"center\"><strong>$headline </strong></div></td>
    </tr>
    <tr> 
      <td bgcolor=\"#0099CC\"><div align=\"center\"><font size=\"2\" face=\"MS Sans Serif, Tahoma, sans-serif\">
	  <a href=\"edit_user.php?UserName=$a&password=$b\" target=\"_blank\">$text5</a> 
          </font></div></td>
    </tr>
	    <tr> 
      <td bgcolor=\"#0099CC\"><div align=\"center\"><font size=\"1\" face=\"MS Sans Serif, Tahoma, sans-serif\">
	                  <a href=\"http://192.168.182.1/index.php?case_i=3\" target=\"_blank\">$text6</a> 
          </font></div></td>
    </tr>
	
    <tr> 
      <td bgcolor=\"#0099CC\"><div align=\"center\"><font size=\"2\" face=\"MS Sans Serif, Tahoma, sans-serif\">$bodytext</font></div></td>
    </tr>
    <tr> 
      <td bgcolor=\"#0099CC\"><div align=\"center\"><font size=\"2\" face=\"MS Sans Serif, Tahoma, sans-serif\">$text7 
          </font></div></td>
    </tr>
    <tr> 
      <td bgcolor=\"#0099CC\"><div align=\"center\"><font  size=\"2\" face=\"MS Sans Serif, Tahoma, sans-serif\">$text8</font> </div></td>
    </tr>
 
	
  </table><br>
  
     ";








# begin debugging
#  print '<center>THE INPUT (for debugging):<br>';
#    foreach ($_GET as $key => $value) {
#      print $key.'='.$value.'<br>';
#    }
#  print '<br></center>';
# end debugging
}

function print_login_form() {

    global $loginpath, $ll;
    $ran_str = randomToken(3);
    include("lang/$ll");
	

 
 
    print '
<FORM name="form1" METHOD="get" action="' . $loginpath . '?">

          <INPUT TYPE="HIDDEN" NAME="chal" VALUE="' . $_GET['challenge'] . '">

          <INPUT TYPE="HIDDEN" NAME="uamip" VALUE="' . $_GET['uamip'] . '">

          <INPUT TYPE="HIDDEN" NAME="uamport" VALUE="' . $_GET['uamport'] . '">

          <INPUT TYPE="HIDDEN" NAME="userurl" VALUE="' . $_GET['userurl'] . '">
		

          <center>
    <table width="348" border="0" cellpadding="5" cellspacing="0" >
      <tbody>
        <tr bgcolor="#FFFFCC"> 
          <td width="169" align="right"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif" >' . $text17 . ':</font></strong></td>
          <td width="144" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
            <input type="text" name="UserName" size="20" maxlength="255" autocomplete="off">
            </font></td>
        </tr>
        <tr bgcolor="#FFFFCC"> 
          <td align="right"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">' . $text18 . ':</font></strong></td>
          <td bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
            <input type="password" name="Password" size="20" maxlength="255">
            </font></td>
        </tr>
		
		
	  <tr bgcolor="#FFFFCC"> 
          <td align="right"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">Code  :</font></strong></td>
          <td bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
           <img src="pic_text_popup.php?str=' . $ran_str . '" width="115" height="30" >
            </font></td>
        </tr>
		
				
	  <tr bgcolor="#FFFFCC"> 
          <td align="right"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">input code:</font></strong></td>
          <td bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
           <input name="code1" type="text" id="code1" size="10" />
            </font></td>
        </tr>
        <tr bgcolor="#FFFFCC"> 
          <td height="34" colspan="2" align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
		  <input name="chk_num"  type="hidden" id="chk_num" value="' . $ran_str . '"  />
            <input type="submit" name="login" value="login">
            </font></td>
        </tr>
			  <tr bgcolor="#FF99CC"> 
          <td align="right" colspan="2" > <font size="3" face="MS Sans Serif, Tahoma, sans-serif"> 
         <a href="/index.php?case_i=5"><center> Login ผ่านแต่เล่นเน็ตไม่ได้ คลิก Clear ที่นี่ </a><br>
		  <a href="/index.php?case_i=800">  เติมเวลาเล่นเน็ตคลิกที่นี่</a>
            </font></center></td>
        </tr>
      </tbody>
    </table>
    </center>

      </form>
';

}

function print_footer() {

    global $footer_text, $ll;


    print $footer_text . '</body></html>';

    exit(0);
}

function print_footerz() {

    global $footer_textz, $ll;

    print $footer_textz . '</body></html>';

    exit(0);
}

$block_mac_sql = "SELECT UserName,CallingStationId
                                                                                                 FROM  radacct 
                                                                                                         WHERE UserName='$UserName'  
                                                                                                                              and    (   AcctStopTime = '0000-00-00 00:00:00'    
																															            or   AcctStopTime = ''  
																																		or   AcctStopTime = null  )  ";

$mac_db = mysql_query($block_mac_sql, $connect_db) or die(mysql_error());
$row_setingz = mysql_fetch_assoc($mac_db);
$totalRows_mac = mysql_num_rows($mac_db);
if ($totalRows_mac > 1 or $row_setingz[CallingStationId] != "$mac") {
    echo "<meta http-equiv=refresh content=1;URL=http://192.168.182.1:3990/logoff > ";
    exit();
}

function print_body_Expired() {

    global $headline, $bodytext, $body_onload, $result, $loginpath, $UserName, $ll;

    include("lang/$ll");

    $uamip = $_GET['uamip'];

    $uamport = $_GET['uamport'];

    $userurl = $_GET['userurl'];

    $redirurl = $_GET['redirurl'];

    $userurldecode = $_GET['userurl'];

    $redirurldecode = $_GET['redirurl'];

    $timeleft = $_GET['timeleft'];



    print "

  </head>
 
    <body onLoad=\"javascript:doOnLoad($result, '$loginpath?res=popup2&username=$a&uamip=$uamip&uamport=$uamport&userurl=$userurl&redirurl=$redirurl&timeleft=$timeleft','$userurldecode', '$redirurldecode', '$timeleft')\" onBlur = \"javascript:doOnBlur($result)\" bgColor = '#c0d8f4'>

   <div align=center><font color=#0000FF size=3 face=MS Sans Serif, Tahoma, sans-serif><strong>$text12</strong></font></div>

       <br>
	  <center><a href='list_card_userdb.php?UserName=$username'  target='_blank'>$text19</a></center><br>
	  ";
}

function print_body_already_logged() {

    global $headline, $bodytext, $body_onload, $result, $loginpath, $UserName, $ll;
    include("lang/$ll");


    $uamip = $_GET['uamip'];

    $uamport = $_GET['uamport'];

    $userurl = $_GET['userurl'];

    $redirurl = $_GET['redirurl'];

    $userurldecode = $_GET['userurl'];

    $redirurldecode = $_GET['redirurl'];

    $timeleft = $_GET['timeleft'];



    print "

  </head>
 
    <body onLoad=\"javascript:doOnLoad($result, '$loginpath?res=popup2&username=$a&uamip=$uamip&uamport=$uamport&userurl=$userurl&redirurl=$redirurl&timeleft=$timeleft','$userurldecode', '$redirurldecode', '$timeleft')\" onBlur = \"javascript:doOnBlur($result)\" bgColor = '#c0d8f4'>

   <div align=center><font color=#0000FF size=3 face=MS Sans Serif, Tahoma, sans-serif><strong>$text20</strong></font></div>

       <br>
	  <center><a href='http://192.168.182.1/index.php?case_i=5'  target='_blank'>$text21</a></center><br>
	  ";
}

exit(0);
?>
 
