<?php include("Connections/dbconnect.php"); 
 include("admin/config.php"); 
$log_ip=$REMOTE_ADDR; // ip login
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<title>Authen Online</title>


</head>

<body background="images/bg.jpg">
<?php if($Submit2==null) { ?>
<table width="65%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#FFFFFF"> 
    <td height="180" valign="middle"> <form name="questionform" method="post" action="problem.php">
        <table width="67%"  border="0" align="center" cellpadding="0" cellspacing="0">
          <tr> 
            <td width="17%" height="32" valign="middle">&nbsp;</td>
            <td colspan="2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
              <input name="name" type="text" id="name3">
              &nbsp;<font color="#FF0000"><strong>&nbsp;ชื่อผู้แจ้ง </strong> 
              </font></font></td>
          </tr>
          <tr> 
            <td height="30" valign="middle" class="style9">&nbsp;</td>
            <td colspan="2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
              <input name="email" type="text" id="email">
              &nbsp;<font color="#FF0000"><strong>&nbsp;Email ผู้แจ้ง</strong></font></font></td>
          </tr>
          <tr> 
            <td height="30" valign="middle">&nbsp;</td>
            <td><strong><font color="#FF0000" size="2" face="MS Sans Serif, Tahoma, sans-serif">ปัญหาที่พบ</font></strong></td>
            <td class="style4"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
          </tr>
          <tr> 
            <td height="30" valign="middle">&nbsp;</td>
            <td width="57%"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
              <textarea name="question" cols="45" rows="15" id="question"></textarea>
              </font></td>
            <td width="26%" class="style4"><font color="#FF0000" size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong> 
              </strong></font></td>
          </tr>
          <tr> 
            <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
            <td colspan="2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
              <input name="tel" type="text" id="tel" size="10">
              <strong><font color="#FF0000"> เบอร์ติดต่อ เพื่อเจ้าหน้าที่โทรกลับเมื่อแจ้งปัญหาเสร็จสิ้นแล้ว</font></strong></font></td>
          </tr>
          <tr> 
            <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
            <td colspan="2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
          </tr>
          <tr> 
            <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
            <td colspan="2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
              <input type="submit" name="Submit2" value="ส่งปัญหา">
              <input type="reset" name="Reset" value="เขียนใหม่">
              </font></td>
          </tr>
        </table>
      </form>
      <?php }
	if ($Submit2=="ส่งปัญหา") {  
		$name = $_POST["name"]; 
		$email =$_POST["email"];
		$question = $_POST["question"];
		$question1 = $_POST["question"];
		$question = $question ."[email : ".$email." ]";
		$tel =$_POST["tel"];
		

		
		if  (!$name) 
		{
				$Submit ="";
				echo "<div align='center'><span class='style10'>กรุณากรอกชื่อของผู้แจ้งปัญหาด้วยค่ะ</span><br><input type='button' value='กลับไปแก้ไขข้อมูล' onclick='history.back();'></div>";
				exit();
		}
		if  (!$question) 
		{
				$Submit ="";
				echo "<div align='center'><span class='style10'>กรุณากรอกปัญหา ที่พบครบด้วยค่ะ</span><br><input type='button' value='กลับไปแก้ไขข้อมูล' onclick='history.back();'></div>";
				exit();
		}
		//mysql_select_db($db) ;
		$n=date("Y-m-d H:i:s");
	mysql_query("insert into question  (name,question,ip,time_q,status,tel )  values('$name','$question','$log_ip','$n','0','$tel')") or  trigger_error(mysql_error(),E_USER_ERROR);
	 
		                                                                         echo                  "<script type=text/javascript>";
							                                                    echo                  "alert('ขณะนี้ระบบได้รับปัญหา หรือคำแนะนำเรียบร้อยแล้ว ')";
							                                                    echo                  "</script>";
																				
	
echo "<meta http-equiv='refresh' content='0; url=index.php'>" ;
	
		}
		?>
    </td>
  </tr>
  <tr> 
    <td height="10" valign="middle"><span class="style10"><u> </u></span></td>
  </tr>
  <tr> 
    <td></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
