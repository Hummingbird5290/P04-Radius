<?php
session_start();
include("../Connections/chacklogin.php");     
 include_once ("../Connections/dbconnect.php");
  include_once("FCKeditor/fckeditor.php") ; 
  exit();
  
?>
<html>
<head>
<title>....</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<style type="text/css">
<!--
body,td,th {
	font-family: MS Sans Serif;
	font-size: 14px;
}
a:link {
	color: #000000;
}
a:visited {
	color: #000000;
}
a:hover {
	color: #FF0000;
}
a:active {
	color: #000000;
}
.style1 {color: #FF0000}
-->
</style>
</head>
 
<body>
 
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="3" background="img/dot_icon.jpg"><img src="img/dot_icon.jpg" alt="�к��ҹ��ú�ó" width="3" height="3"></td>
    <td width="575" height="300"><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
        <tr bgcolor="#FFFFFF"> 
          <td colspan="2" valign="middle"> 
            <?php 
 
 
	if ($save=="save") { 
		if (!file_exists('/data/routing.sh')) {
    $last_line = system("/usr/bin/sudo /usr/bin/touch  /data/routing.sh ", $retval);
}  
	 $last_line = system("/usr/bin/sudo /bin/chown  www-data:www-data /data/routing.sh ", $retval);
	 
if($sssl==''){ $sssl='http' ; }
 				if($sssl=='http'){
	 ###################################################   
	// $a="/usr/bin/sudo  /bin/sed   -e 's/HS_UAMFORMAT=https:/HS_UAMFORMAT=http:/g'  -i  /etc/chilli/config ";
	// print $a;
	// exit;            
 echo '<pre>';
	$last_line = system("/usr/bin/sudo /bin/sed -e 's/HS_UAMFORMAT=https:/HS_UAMFORMAT=http:/g' -i /etc/chilli/config ", $retval);
	$last_line = system("/usr/bin/sudo /bin/sed -e 's/HS_UAMHOMEPAGE=https:/HS_UAMHOMEPAGE=http:/g' -i /etc/chilli/config ", $retval);
	
	echo '
</pre>
<hr />Last line of the output: ' . $last_line . '
<hr />Return value: ' . $retval;
##########################################
	} else {
	 ###################################################               
 echo '<pre>';
     $last_line = system("/usr/bin/sudo /bin/sed -e 's/HS_UAMFORMAT=http:/HS_UAMFORMAT=https:/g' -i /etc/chilli/config", $retval);
	 $last_line = system("/usr/bin/sudo /bin/sed -e 's/HS_UAMHOMEPAGE=http:/HS_UAMHOMEPAGE=https:/g' -i /etc/chilli/config ", $retval);
	echo '
</pre>
<hr />Last line of the output: ' . $last_line . '
<hr />Return value: ' . $retval;
##########################################
	}						
                                                         $setup_update=  "update  seting  set room ='$room' ,  
														                                                            site='$site' , 
																													idstd='$idstd' ,
																													allow_register='$allow_register1' ,
																													none_chk_idper='$none_chk_idper' ,
																													topdown='$topdown' ,
																													mailadmin='$mailadmin' ,
																													mailstatus='$mailstatus' ,
																													tbname='$tbname',
																													url='$url' ,
																													ddns='$ddns' ,
																													sssl='$sssl',
																													LL='$LL'  ,
																													sms='$sms',
																													gmail_user='$gmail_user',
																													gmail_pass='$gmail_pass',
																													showbm='$showbm',
																													Connectcount='$Connectcount',
																													Connectcount_mail='$Connectcount_mail'  "; 
					                                                 
																	   
																	   mysql_query($setup_update, $connect_db)   or trigger_error(mysql_error(),E_USER_ERROR);
 
          
	$query_Recordset1 ='		ALTER TABLE  `seting` ADD  `sssl` VARCHAR( 100 ) NOT NULL';
   @mysql_query($query_Recordset1, $connect_db);
   
 
   
   
 $query_Recordset2 = "SELECT   LL   FROM seting  ";
																		$Recordset2 = mysql_query($query_Recordset2, $connect_db) or die(mysql_error());
																		$row_Recordset2 = mysql_fetch_assoc($Recordset2);
	if($row_Recordset2[LL]==1){ 

	 // �����¹��������� Text File
	 $routings   ="/usr/bin/sudo /sbin/ifconfig eth2 192.168.2.10 \n";
     $routings  .="/sbin/route add -net 117.0.0.0/8  gw 192.168.2.1 \n";
	 $routings .="/sbin/route add -net 118.0.0.0/8  gw 192.168.2.1 \n";
	 $routings .="/sbin/route add -net 119.0.0.0/8  gw 192.168.2.1 \n";
	 $routings .="/sbin/route add -net  61.0.0.0/8  gw 192.168.2.1 \n";
	 $routings .="/sbin/route add -net  62.0.0.0/8  gw 192.168.2.1 \n";
	 $routings .="/sbin/route add -net  63.0.0.0/8  gw 192.168.2.1 \n";
	 $routings .="/sbin/route add -net  64.0.0.0/8  gw 192.168.2.1 \n";
	 $routings .="/sbin/route add -net  65.0.0.0/8  gw 192.168.2.1 \n";
	 $routings .="/sbin/route add -net  66.0.0.0/8  gw 192.168.2.1 \n";
     $routings .=" /sbin/route add -net 78.0.0.0/8 gw 192.168.2.1 \n";
	 $routings .=" /sbin/route add -net 58.0.0.0/8 gw 192.168.2.1 \n";
	 $routings .=" /sbin/route add -net 59.0.0.0/8 gw 192.168.2.1 \n";	 
     $routings .=" /sbin/route add -net 60.0.0.0/8 gw 192.168.2.1 \n";
	 $routings .=" /sbin/route add -net 112.0.0.0/8 gw 192.168.2.1 \n";
	 $routings .=" /sbin/route add -net 180.0.0.0/8 gw 192.168.2.1 \n";
     $routings .=" /sbin/route add -net 199.0.0.0/8 gw 192.168.2.1 \n";
	 $routings .=" /sbin/route add -net 74.0.0.0/8 gw 192.168.2.1 \n";
			 	$f=fopen("/data/routing.sh", "w"); 
				 fputs($f, $routings);
				 fclose($f);
				 
				 $last_line = system("/usr/bin/sudo /bin/sh /data/routing.sh ", $retval);
				 $last_line = system("/usr/bin/sudo /bin/chown www-data:www-data /data/routing.sh ", $retval);
	}				
		if($row_Recordset2[LL]==''  or $row_Recordset2[LL]=='0'){ 
	
	 // �����¹��������� Text File
	 $routings  ="";
			 	 $routings   ="/usr/bin/sudo /sbin/ifconfig eth2 192.168.2.10 \n";
  $routings  .="/sbin/route delete  -net 117.0.0.0/8    \n";
	 $routings .="/sbin/route delete  -net  118.0.0.0/8   \n";
	 $routings .="/sbin/route delete  -net  119.0.0.0/8    \n";
	 $routings .="/sbin/route delete  -net   61.0.0.0/8    \n";
	 $routings .="/sbin/route delete  -net   62.0.0.0/8    \n";
	 $routings .="/sbin/route delete  -net   63.0.0.0/8   \n";
	 $routings .="/sbin/route delete  -net   64.0.0.0/8   \n";
	 $routings .="/sbin/route delete  -net   65.0.0.0/8    \n";
	 $routings .="/sbin/route delete   -net  66.0.0.0/8    \n";
     $routings .=" /sbin/route delete  -net  78.0.0.0/8   \n";
	 $routings .=" /sbin/route delete   -net 58.0.0.0/8  \n";
	 $routings .=" /sbin/route delete   -net 59.0.0.0/8   \n";	 
     $routings .=" /sbin/route delete   -net 60.0.0.0/8   \n";
	 $routings .=" /sbin/route delete   -net 112.0.0.0/8  \n";
	 $routings .=" /sbin/route delete   -net 180.0.0.0/8   \n";
     $routings .=" /sbin/route delete   -net 199.0.0.0/8  \n";
	 $routings .=" /sbin/route delete   -net 74.0.0.0/8   \n";
			 
			 	$f=fopen("/data/routing.sh", "w"); 
				 fputs($f, $routings);
				 fclose($f);
				 $last_line = system("/usr/bin/sudo /bin/sh /data/routing.sh ", $retval);
	}								
		     echo                  "<script type=text/javascript>";
		    echo                  "alert('  Save OK ')";
	        echo                  "</script>"; 
			 echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=36>"; 
			 exit(); 
}
		
		?>
                 <?php 
				 ##l���ҧ���ҧ�ó������㹰ҹ������
$sql="CREATE TABLE IF NOT EXISTS   log_sendmail (
`time_send` DATETIME NOT NULL ,
`massges` VARCHAR( 300 ) NOT NULL
) ENGINE = MYISAM DEFAULT CHARSET=tis620 COLLATE=tis620_bin ;";
mysql_query($sql, $connect_db);
 
 $sql="CREATE TABLE IF NOT EXISTS `connection_counts` (
  `ipaddress` varchar(300) COLLATE tis620_bin NOT NULL,
  `counts` int(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620 COLLATE=tis620_bin ;";
mysql_query($sql, $connect_db);

	$query_Recordset1 ='		ALTER TABLE  `seting` ADD  `sssl` VARCHAR( 100 ) NOT NULL';
   @mysql_query($query_Recordset1, $connect_db);
   
 	$query_Recordset1 ='		ALTER TABLE  `seting` ADD  `sms` VARCHAR( 100 ) NOT NULL';
   @mysql_query($query_Recordset1, $connect_db);
    
	 	$query_Recordset1 ='		ALTER TABLE  `seting` ADD  `showbm` VARCHAR( 100 ) NOT NULL';
   @mysql_query($query_Recordset1, $connect_db);
    
	$query_Recordset1 ='		ALTER TABLE  `seting` ADD  `gmail_user` VARCHAR( 300 ) NULL ,
ADD  `gmail_pass` VARCHAR( 300 ) NULL ';
   @mysql_query($query_Recordset1, $connect_db);
	
	$query_Recordset1 ='ALTER TABLE  `seting` ADD  `Connectcount` INT( 20 ) NULL ,
ADD  `Connectcount_mail` INT NULL';
    @mysql_query($query_Recordset1, $connect_db);
   
$query_Recordset1 = "SELECT   *   FROM  seting      ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);


?>
            <form action="index.php?case_i=36" method="post" enctype="multipart/form-data" name="questionform">
              <table width="100%" height="99%"  border="1" align="center" cellpadding="0" cellspacing="0">
                <tr bgcolor="#FFFFCC"> 
                  <td colspan="2"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"> 
                    <strong>��Ѻ���к�</strong></font></td>
                </tr>
                <tr>
                  <td bgcolor="#FFCCCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Dynamix DNS</strong></font></td>
                  <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
                    http://
                    <input name="ddns" type="text" id="ddns" value="<?php print  $row_Recordset1[ddns];  ?>" size="30">
                  .thaigqsoft.com</font></td>
                </tr>
                                <tr>
                  <td bgcolor="#FFCCCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">˹����纷���ͧ�������������ѧ�ҡ Login</font></strong></td>
                  <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
                    <input name="url" type="text" id="url" value="<?php print  $row_Recordset1[url];  ?>" size="30">
                  </font></td>
                </tr>
                <tr>
                  <td bgcolor="#FFCCCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>�����;ѡ</strong></font></td>
                  <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
                    <input name="tbname" type="text" id="tbname" value="<?php print  $row_Recordset1[tbname];  ?>" size="30">
                  </font></td>
                </tr>
 
                <tr>
                  <td bgcolor="#FFCCCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">Email �������к� </font></strong></td>
                  <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
                    <input name="mailadmin" type="text" id="mailadmin" value="<?php print  $row_Recordset1[mailadmin];  ?>" size="30">
                  </font></td>
                </tr>
                <tr>
                  <td bgcolor="#FFCCCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>
				  �Դ�к������§ҹ��ػ��â�ºѵ���� E mail </strong></font></td>
                  <td><input name="mailstatus" type="checkbox" value="1"  <?php if($row_Recordset1[mailstatus]==1){ print  "checked";} ?>></td>
                </tr>
                <tr> 
                  <td width="36%" bgcolor="#FFCCCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>���Ϳ���� 
                    ���˹�� </strong></font></td>
                  <td width="64%"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    <input name="site" type="text" id="site" value="<?php print  $row_Recordset1[site];  ?>" size="30">
                    </font></td>
                </tr>
                <tr> 
                  <td bgcolor="#FFCCCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">���Ϳ���� 
                    ����ͧ</font></strong></td>
                  <td><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    <input name="room" type="text" id="room" value="<?php print  $row_Recordset1[room];  ?>" size="30">
                    </font></strong></td>
                </tr>
                <tr> 
                  <td bgcolor="#FFCCCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">���Ϳ���� 
                    ������</font></strong></td>
                  <td> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    <input name="idstd" type="text" id="idstd" value="<?php print  $row_Recordset1[idstd];  ?>" size="30">
                    </font></td>
                </tr>
                   
                
                <tr> 
                  <td bgcolor="#FFCCCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>�Դ�����ҹ��Ǩ�ͺ�����Ţ�ѵû�ЪҪ��ҡ�����þ��</strong></font></td>
                  <td> <br> <input name="none_chk_idper" type="radio" value="1" <?php if($row_Recordset1[none_chk_idper]=='1') { print  "checked";  }?>> 
                    &nbsp;�Դ�����ҹ<br> <br> <input type="radio" name="none_chk_idper" value="0"  <?php if($row_Recordset1[none_chk_idper]=='0') { print  "checked"; } ?>> 
                    &nbsp;�Դ�����ҹ��õ�Ǩ�ͺ�Ţ�ѵû�ЪҪ�</td>
                </tr>
                <tr> 
                  <td bgcolor="#FFCCCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>͹��ѵ���ѧ�ҡ��Ѥ���������ö��ҹ 
                    Internet �����</strong></font></td>
                  <td> <br> <input name="allow_register1" type="radio" value="0" <?php if($row_Recordset1[allow_register]=='0') { print  "checked";  }?>>
                    ���͹��ѵ�<strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    (��Ѥ����ǵ�ͧ�� Admin ͹��ѵ�)</font></strong><br> <br> <input type="radio" name="allow_register1" value="1"  <?php if($row_Recordset1[allow_register]=='1') { print  "checked"; } ?>> 
                    &nbsp;͹��ѵ�<strong><font color="#FF0000" size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    (��Ѥ����� ����ͧ�� Admin ͹��ѵ�)</font></strong></td>
                </tr>
                <tr>
                  <td bgcolor="#FFCCCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">�Դ�����ҹ ��Ŵ���ҹ</font></strong></td>
                  <td><input type="radio" name="LL" value="1"  <?php if($row_Recordset1[LL]=='1') { print  "checked"; } ?>>
                    <span class="style1">�Դ��ҹ</span>&nbsp;
                    <input type="radio" name="LL" value="0"  <?php if($row_Recordset1[LL]=='0') { print  "checked"; } ?>>
                    �Դ�����ҹ&nbsp;&nbsp;��͡�˹� �����������͡Ѻ eth2 ��ͧ��駤���;����������� 192.168.2.1</td>
                </tr>
                <tr>
                  <td bgcolor="#FFCCCC">
                  <font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong> ��ͧ������ Show ���������˹˹�� popup �������</strong></font></td>
                  <td><input name="showbm" type="radio" value="0" <?php if($row_Recordset1[showbm]=='1') { print  "checked";  }?>>
                  ��ͧ��� 
                  <input name="showbm" type="radio" value="0" <?php if($row_Recordset1[showbm]=='0') { print  "checked";  }?>>
                  ����ͧ���</td>
                </tr>
                <tr>
                  <td bgcolor="#FFCCCC">
                  <font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong> ��˹���� Connction Count �ͧ�١�����������Թ</strong></font>
                </td>
                  <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
                    <input name="Connectcount" type="text" id="Connectcount" value="<?php print  $row_Recordset1[Connectcount];  ?>" size="30">
                  </font></td>
                </tr>
                <tr>
                  <td bgcolor="#FFCCCC"> 
                  <font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong> ��ͧ�������� Email ��������ա���� Connect �Թ�������</strong></font>
            </td>
                  <td><input name="Connectcount_mail" type="radio" value="1" <?php if($row_Recordset1[Connectcount_mail]=='1') { print  "checked";  }?>>
                  ��ͧ��� 
                  <input name="Connectcount_mail" type="radio" value="0" <?php if($row_Recordset1[Connectcount_mail]=='0') { print  "checked";  }?>>
                  ����ͧ���</td>
                </tr>
                <tr>
                  <td bgcolor="#FFCCCC">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" bgcolor="#FFCCCC"></td>
                </tr>
                <tr>
                  <td colspan="2" bgcolor="#FFCCCC">&nbsp;</td>
                </tr>
                <tr> 
                  <td colspan="2" bgcolor="#FFCCCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">��ͤ��� 
                    Top Down ˹�ҵ�ҧ POPUP</font></strong></td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td colspan="2"><strong></strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    <?php
							$FCKeditor = new FCKeditor('topdown') ;
							 
							$FCKeditor->BasePath = 'FCKeditor/';
							$FCKeditor->Width = '550';
							$FCKeditor->Height = '200';
							$FCKeditor->Value =$row_Recordset1[topdown]; 
							$FCKeditor->Create() ;
                ?>
                    </font></td>
                </tr>
                  <tr bgcolor="#FFFFCC"> 
                  <td colspan="2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">��駤�ҵ���� E-MAIL(��ҹ��ͧ�� ���ʼ�ҹ�ͧ GMAIL �������駤���к����������ö�������)</font></td>
                </tr>
                <tr>
                  <td>
                  <strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">����������к� GMAIL</font></strong></td>
                  <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
                    <input name="gmail_user" type="text" id="gmail_user" value="<?php print  $row_Recordset1[gmail_user];  ?>" size="30">
                    ��� @gmail.com ���¹�Ф�Ѻ                </font></td>
                </tr>
                <tr>
                  <td><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">���ʼ�ҹ������к� GMAIL</font></strong></td>
                  <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
                    <input name="gmail_pass" type="password" id="gmail_pass" value="<?php print  $row_Recordset1[gmail_pass];  ?>" size="30">
                  </font></td>
                </tr>
                <tr>
                  <td><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">�Դ����Ѻ�駻ѭ�ҷҧ sms</font></strong></td>
                   
                  <td>
				  <select name="sms" id="sms"      >
                  <option value="<?php print $row_Recordset1['sms'];?>" selected="selected">
				  <?php if($row_Recordset1['sms']=='1') { print "�Դ��ҹ"; } else {print "�Դ��ҹ";}?>
				  </option>
				  <option value="1" >�Դ��ҹ</option>
				  <option value="0" >�Դ��ҹ</option>
                </select></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
                    <input name="save" type="submit" id="save" value="save">
                  </font></td>
                </tr>
              </table>
            </form>
      
          </td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td colspan="2"> 
      
      <div align="right"> </div>
      
       </td>
  </tr>
</table>
<?php  
$sql3="ALTER TABLE  seting  ADD  LL VARCHAR( 5 ) NULL DEFAULT  '0';";
@mysql_query($sql3, $connect_db) ;
$last_line = system("/usr/bin/sudo /bin/sed -e 's/255.255.255.0/255.255.0.0/g' -i /etc/chilli/config ", $retval);

 ?>
</body>
</html>
