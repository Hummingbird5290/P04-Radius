<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
 
<?php
  
  $_SESSION["ulogin_pass"]=$_GET['UserName'];
  $_SESSION["plogin_pass"]=$_GET['Password'];
  $a=$_SESSION["ulogin_pass"] ;
  $b=$_SESSION["plogin_pass"];
  
 global  $a,$b;
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

$userpassword=1;



$loginpath = "/hotspotlogin.php";



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

$footer_text = '<center>
                             <font color="#FFFFFF"><b><a href="http://www.thaigqsoft.com" target="_blank">[www.thaigqsoft.com]</a>   </b> </font>
                           </center>';

                

$footer_textz  = ' ';                 



# attempt to login

if ($_GET['login'] == login) {



  $hexchal = pack ("H32", $_GET['chal']);



  if (isset ($uamsecret)) {

    $newchal = pack ("H*", md5($hexchal.$uamsecret));

  } else {

    $newchal = $hexchal;

  }



  $response = md5("\0".$_GET['Password'].$newchal);



  $newpwd = pack("a32", $_GET['Password']);

  $pappassword = implode ("", unpack("H32", ($newpwd ^ $newchal)));

    

  $titel = 'กำลังตรวจสอบรหัสผ่าน'; 

  $headline = 'กำลังตรวจสอบรหัสผ่าน';

  $bodytext = ''; 



  print_header();



  if ((isset ($uamsecret)) && isset($userpassword)) {

  $_SESSION["ulogin_pass"]=$_GET['UserName'];
  $_SESSION["plogin_pass"]=$_GET['Password'];
  $a=$_SESSION["ulogin_pass"] ;
  $b=$_SESSION["plogin_pass"];
    print '<meta http-equiv="refresh" content="0;url=http://'.$_GET['uamip'].':'.$_GET['uamport'].'/logon?username='.$_GET['UserName'].'&password='.$pappassword. '">';

  } else {
  $_SESSION["ulogin_pass"]=$_GET['UserName'];
  $_SESSION["plogin_pass"]=$_GET['Password'];
  $a=$_SESSION["ulogin_pass"] ;
  $b=$_SESSION["plogin_pass"];
    print '<meta http-equiv="refresh" content="0;url=http://'.$_GET['uamip'].':'.$_GET['uamport'].'/logon?username='.$_GET['UserName']. '&response='.$response.'&userurl='.$_GET['userurl'].'">';

  }



   print_body();

   print_footer();



}



# 1: Login successful

if ($_GET['res'] == success) {



  $result = 1;

  $titel = 'ยินดีต้อนรับ';

  $headline = '<font color="#FFFFFF" size="2" face="MS Sans Serif, Tahoma, sans-serif">ท่านสามารถเข้าสู Internet ได้แล้ว</font>';

  $bodytext = ' <br>
<table width=\"100%\" border=\"0\">
  <tr> 
    <td bgcolor=#0000CC><div align="center"><font color="#000000" size=2 face=MS Sans Serif, Tahoma, sans-serif Sans Serif, Tahoma, sans-serif\"><a href=edit_user.php target=\"_blank\">แก้ไขข้อมูลส่วนตัว</a> 
        </font></div></td>
  </tr>
  <tr> 
    <td bgcolor=#FFFFFF><div align="center"></div></td>
  </tr>
  <tr> 
    <td bgcolor=#FFFFFF><div align="center"><font color="#000000" size=2 face=MS Sans Serif, Tahoma, sans-serif Sans Serif, Tahoma, sans-serif\">กรุณาอย่าปิดหน้าจอนี้ 
        </font></div></td>
  </tr>
  <tr> 
    <td bgcolor=#FFFFFF><div align="center"><font color="#000000"  size=2 face=MS Sans Serif, Tahoma, sans-serif Sans Serif, Tahoma, sans-serif\">หากท่านปิดหน้าจอนี้ 
        ระบบจะตัดการเชื่อมต่อ Internet ของท่านทันที</font> </div></td>
  </tr>
</table>
 ';

 $body_onload = 'onLoad="javascript:popUp('.$loginpath.'?res=popup&uamip='.$_GET['uamip'].'&uamport='.$_GET['uamport'].'&timeleft='.$_GET['timeleft'].'&username='.$a.')"';

  
 
 

  

  print_header();

  print_body();

   

  if ($reply) { 

    print '<center>'.$reply.'</BR></BR></center>';

  }



  print '<center><a href=http://10.0.0.1:3990/logoff>Logout</a></center>';



  print_footer();

}



# 2: Login failed

if ($_GET['res'] == failed) {



  $result = 2;

  $titel = 'รหัสผ่านท่านผิดพลาดโปรดกรอกใหม่';

  $headline = '<font color="#FFFFFF" size="2" face="MS Sans Serif, Tahoma, sans-serif">รหัสผ่านท่านผิดพลาดโปรดกรอกใหม่</font>';

  $bodytext = ' ';



   

  print_header();

  print_body();



  if ($_GET['reply']) {

    print '<center>'.$_GET['reply'].'</center>';

  }

   

  print_login_form();

  print_footer();



}



# 3: Logged out

if ($_GET['res'] == logoff) {



  $result = 3;

  $titel = 'ลงชื่อออกจาก Internet';

  $headline = '<font color="#FFFFFF" size="2" face="MS Sans Serif, Tahoma, sans-serif">ลงชื่อออกจาก Internet แล้ว</font> ';

  $bodytext = '<a href="http://10.0.0.1:3990/prelogin">Login</a>';



   

  print_header();

  print_body();

  print_footer();



}



# 4: Tried to login while already logged in

if ($_GET['res'] == already) {



  $result = 4;

  $titel = 'Login เสร็จเรียบร้อย';

  $headline = '<font color="#FFFFFF" size="2" face="MS Sans Serif, Tahoma, sans-serif">Login เสร็จเรียบร้อย</font> ';

  $bodytext = '<a href=http://10.0.0.1:3990/logoff>Logout</a>';



  

   

  print_header();

  print_body();

  print_footer();



}



# 5: Not logged in yet

if ($_GET['res'] == notyet) {



  $result = 5;

  $titel = 'กรุณาใส่รหัสผ่าน';

  $headline = '<font color="#FFFFFF" size="2" face="MS Sans Serif, Tahoma, sans-serif">กรุณาใส่รหัสผ่าน เพื่อเข้าสู่ระบบ Internet</font> ';

  $bodytext = 'please log in<br>';



   

  print_header();

  print_body();

  print_login_form();

  print_footer();



}



#11: Popup1

if ($_GET['res'] == popup1) {



  $result = 11;

  $titel = 'กำลังเข้าสู่ระบบ';

  $headline = '<font color="#FFFFFF" size="2" face="MS Sans Serif, Tahoma, sans-serif">กำลังเข้าสู่ระบบ</font>';

  $bodytext = 'please wait...';



   

  print_header();

  print_body();

  print_footer();

}



#12: Popup2

if ($_GET['res'] == popup2) {



  $result = 12;

  $titel = 'กรุณาอย่าปิดหน้าจอนี้!';

  $headline = '<font color="#FFFFFF" size="2" face="MS Sans Serif, Tahoma, sans-serif">กรุณาอย่าปิดหน้า Popup</font>';

  $bodytext =     '<center><a href=http://10.0.0.1:3990/logoff>Logout</a></center>';



   

  print_header();

  print_bodyz();

  print_footer();

  

}



#13: Popup3

if ($_GET['res'] == popup3) {



  $result = 13;

  $titel = 'Logged out from Internet';

  $headline = '<font color="#FFFFFF" size="2" face="MS Sans Serif, Tahoma, sans-serif">Logout</font>';

  $bodytext = '<a href="http://'.$_GET['uamip'].':'.$_GET['uamport'].'/prelogin">Login</a>';



   

  print_header();

  print_body();

  print_footer();



}



# 0: It was not a form request

# Send out an error message

if ($_GET['res'] == "") {



  //$result = 0;
  
$result = 1;
  $titel = 'คุณต้องเข้าผ่าน https?';

  $headline = 'คุณต้องเข้าผ่าน https';

  $bodytext = 'Login must be performed through TLog daemon!';

  

  print_header();

  print_body();

  print_footer();



}



# functions



function print_header(){

  global $titel, $loginpath;

  $a=$_SESSION["ulogin_pass"] ;
  $b=$_SESSION["plogin_pass"];

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

      if (self.name != \"chillispot_popup\") {chillispot_popup = window.open(URL, 'chillispot_popup', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=350,height=300');

      }

    }



    function doOnLoad(result, URL, userurl, redirurl, timeleft) {

      if (timeleft) {

        mytimeleft = timeleft;

      }

      if ((result == 1) && (self.name == \"chillispot_popup\")) {

        doTime();

      }

      if ((result == 1) && (self.name != \"chillispot_popup\")) {chillispot_popup = window.open(URL, 'chillispot_popup', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=350,height=300');

      }

      if ((result == 2) || result == 5) {

        document.form1.UserName.focus()

      }

      if ((result == 2) && (self.name != \"chillispot_popup\")) {chillispot_popup = window.open('', 'chillispot_popup', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=400,height=200');chillispot_popup.close();

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

  </script>";

}



function print_body(){

  global $headline, $bodytext, $body_onload,$result, $loginpath,$UserName;

  

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



function print_bodyz(){

  global $headline, $bodytext, $body_onload, $result, $loginpath,$a,$b;

    $a=$_SESSION["ulogin_pass"] ;
    $b=$_SESSION["plogin_pass"];

  $uamip = "10.0.0.1";

  $uamport = $_GET['uamport'];

  $userurl = $_GET['userurl'];

  $redirurl = $_GET['redirurl'];

  $userurldecode = $_GET['userurl'];

  $redirurldecode = $_GET['redirurl'];

  $timeleft = $_GET['timeleft'];
  
  
//onLoad=\"javascript:doOnLoad($result, '$loginpath?res=popup2&username=$a&uamip=$uamip&uamport=$uamport&userurl=$userurl&redirurl=$redirurl&timeleft=$timeleft','$userurldecode', '$redirurldecode', '$timeleft')\" onBlur = \"javascript:doOnBlur($result)\" bgColor = '#c0d8f4'
  //print "  </head>

 
echo "
   <body  onUnLoad = \"javascript:popup_logoff('10.0.0.1:3990/logoff','Error')\"  background=\"bg.jpg\"   text=\"#FFFFFF\" 
	link=\"#FFFFFF\" vlink=\"#FFFFFF\" alink=\"#FFFFFF\">

<table width=\"100%\" border=\"0\">
    <tr> 
      <td bgcolor=\"#FFFFFF\"><div align=\"center\"><strong>$headline </strong></div></td>
    </tr>
    <tr> 
      <td bgcolor=\"#0099CC\"><div align=\"center\"><font size=\"2\" face=\"MS Sans Serif, Tahoma, sans-serif\"><a href=\"edit_user.php?UserName=$a&password=$b\" target=\"_blank\">แก้ไขข้อมูลส่วนตัว</a> 
          </font></div></td>
    </tr>
    <tr> 
      <td bgcolor=\"#0099CC\"><div align=\"center\"><font size=\"2\" face=\"MS Sans Serif, Tahoma, sans-serif\">$bodytext</font></div></td>
    </tr>
    <tr> 
      <td bgcolor=\"#0099CC\"><div align=\"center\"><font size=\"2\" face=\"MS Sans Serif, Tahoma, sans-serif\">กรุณาอย่าปิดหน้าจอนี้ 
          </font></div></td>
    </tr>
    <tr> 
      <td bgcolor=\"#0099CC\"><div align=\"center\"><font  size=\"2\" face=\"MS Sans Serif, Tahoma, sans-serif\">หากท่านปิดหน้าจอนี้ 
          ระบบจะตัดการเชื่อมต่อ Internet ของท่านทันที</font> </div></td>
    </tr>
  </table>"; 
  

      

            



# begin debugging

#  print '<center>THE INPUT (for debugging):<br>';



#    foreach ($_GET as $key => $value) {

#      print $key.'='.$value.'<br>';

#    }



#  print '<br></center>';

# end debugging



}







function print_login_form(){

  global $loginpath;
 
print '

<body background="bg.jpg"  text="#FFFFFF" link="#FFFFFF" vlink="#FFFFFF" alink="#FFFFFF">

<FORM name="form1" METHOD="get" action="'.$loginpath.'?">

          <INPUT TYPE="HIDDEN" NAME="chal" VALUE="'.$_GET['challenge'].'">

          <INPUT TYPE="HIDDEN" NAME="uamip" VALUE="'.$_GET['uamip'].'">

          <INPUT TYPE="HIDDEN" NAME="uamport" VALUE="'.$_GET['uamport'].'">

          <INPUT TYPE="HIDDEN" NAME="userurl" VALUE="'.$_GET['userurl'].'">
		

          <center>
    <table width="333" border="0" cellpadding="5" cellspacing="0" >
      <tbody>
        <tr bgcolor="#FFFFCC"> 
          <td width="123" align="right"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif" >ชื่อเข้าใช้งาน:</font></strong></td>
          <td width="257" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
            <input type="text" name="UserName" size="20" maxlength="255" autocomplete="off">
            </font></td>
        </tr>
        <tr bgcolor="#FFFFCC"> 
          <td align="right"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">รหัสผ่าน:</font></strong></td>
          <td bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
            <input type="password" name="Password" size="20" maxlength="255">
            </font></td>
        </tr>
        <tr bgcolor="#FFFFCC"> 
          <td height="34" colspan="2" align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
            <input type="submit" name="login" value="login">
            </font></td>
        </tr>
      </tbody>
    </table>
    </center>

      </form>';
 
   
}



function print_footer(){

  global $footer_text;

  print $footer_text.'</body></html>';

  exit(0);

}



function print_footerz(){

  global $footer_textz;

  print $footer_textz.'</body></html>';

  exit(0);

}



exit(0);



?>

