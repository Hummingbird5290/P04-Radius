 <?php  session_start();  include("../include/chklogin.php");   ?> 
<?php

 include("../Connections/dbconnect.php");
 include("../include/function.php");
?>
<html>
<head>
<title>....</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<style type="text/css">
<!--
.style1 {	font-family: "MS Sans Serif";
	font-size: 12px;
}
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
-->
</style>
</head>
<?php  include("FCKeditor/fckeditor.php") ; ?>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="3" background="img/dot_icon.jpg"><img src="img/dot_icon.jpg" alt="ระบบงานสารบรรณ" width="3" height="3"></td>
    <td width="575" height="300"><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
        <tr bgcolor="#FFFFFF"> 
          <td colspan="2" valign="middle"> 
            <?php 
 
 
	if ($Submit=="เพิ่มข่าวสารหน้าเว็บ") { 
	 
 
		if($_SESSION["adminpass"]=='demo'){
      echo                  "<script type=text/javascript>";
		    echo                  "alert('ผู้ใช้ ทดสอบระบบ ไม่สามารถแก้ไขข้อมูลได้ :P ')";
	        echo                  "</script>";  
 
exit();
}

		
 
 
		//mysql_select_db($db) ;
 
 if($html ==NULL) {
 $SQL1=removesql("update  news set news ='$news'  where domain='$domain_name'  ");
 	                 mysql_query("$SQL1")
					                                                   or trigger_error(mysql_error(),E_USER_ERROR);
                              }	
										
		     echo                  "<script type=text/javascript>";
		    echo                  "alert('  เพิ่มสารสารเรียบร้อยแล้ว ')";
	        echo                  "</script>"; 
			 echo "<meta http-equiv=refresh content=0;URL=index.php?a=200>"; 
			 exit(); 
}
		
		?>
            <?php 	if($Submit==NULL ) { 
$query_Recordset1 = "SELECT   *   FROM news   where domain='$domain_name'  ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
			?>
            <form action="index.php?case_i=32" method="post" enctype="multipart/form-data" name="questionform">
              <table width="100%" height="99%"  border="0" align="center" cellpadding="0" cellspacing="0">
                <tr> 
                  <td colspan="2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    &nbsp;&nbsp; 
                    <?php
							$FCKeditor = new FCKeditor('news') ;
					  $FCKeditor->ToolbarSet ="Basic" ; 
							$FCKeditor->BasePath = 'FCKeditor/';
							$FCKeditor->Width = '480';
							$FCKeditor->Height = '300';
							$FCKeditor->Value =$row_Recordset1[news];
							$FCKeditor->Create() ;
                ?>
                    </font></td>
                </tr>
               
                <tr> 
                  <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
                  <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp; 
                    </font></td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp; 
                    <input name="Submit" type="submit" id="Submit" value="เพิ่มข่าวสารหน้าเว็บ">
                    <input type="reset" name="Reset" value="เขียนใหม่">
                    </font></td>
                </tr>
              </table>
            </form>
            <?php } ?>
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
</body>
</html>
