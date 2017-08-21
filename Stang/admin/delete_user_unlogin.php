<?php
  include("../include/chklogin.php");   
  $nexp_a=date('Y-m-d H:i:s', strtotime('-42 month'));
  $nexp_h=date('Y-m-d H:i:s', strtotime('-4 month'));
  
    $nexp_showa=date('d-m-Y', strtotime('-42 month'));
    $nexp_showb=date('d-m-Y', strtotime('-4 month'));
	$today=date('Y-m-d H:i:s');  
  ?>
  
 <?php
include("../Connections/dbconnect.php");
 include("../include/function.php");
if($delete=='1')
{
$UserName = htmlspecialchars("$UserName", ENT_QUOTES);
 $pattern = '/;/i';
$replacement = NULL;
$UserName= preg_replace($pattern, $replacement, $UserName);

$query_user = "select  *  from register   where UserName='$UserName'  ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$A_UserName=$row_user['UserName'];
$A_password=$row_user['password'];
$A_per=$row_user['per'];
$A_room=$row_user['room'];
$A_tel=$row_user['tel'];
$A_fullname=$row_user['fullname'];
$A_status="0";
$A_email=$email=$row_user['email'];
 
 $tb="register";
$sql = "update    $tb set status='99' where UserName='$UserName'  ";
 mysql_select_db($database_edoc);  $dbquery =mysql_query($sql);

$tb="radcheck";
$sql = "delete from $tb where UserName='$UserName'  and  Attribute='MD5-Password' ";
 mysql_select_db($database_edoc);  $dbquery =mysql_query($sql);
$tb="radcheck";
$sql = "delete from $tb where UserName='$UserName'  and  Attribute='Simultaneous-Use' ";
 mysql_select_db($database_edoc);$dbquery = mysql_query($sql);

$tb="usergroup";
$sql = "delete from $tb where UserName='$UserName'  ";
 mysql_select_db($database_edoc); $dbquery =mysql_query($sql);

            echo                  "<script type=text/javascript>";
		    echo                  "alert('ลบออกเรียบร้อยแล้ว ')";
	        echo                  "</script>";
           echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=55>"; 
 exit();
 
}
?><HEAD>
<TITLE>Login TLOG</TITLE>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<style rel="stylesheet" type="text/css">
a { text-decoration: none; }
</style>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=tis-620">

</HEAD>
  

<table width="806" border="1" align="center" class="imagetable">
  <tr>
    <th colspan="5" class="scimenu" align="center">ลบผู้ใช้งานที่ไม่ได้ login เกิน 4 เดือน  นับจากวันที่ <?php print $nexp_showb; ?> ถึง ปัจจุบัน</th>
  </tr>
        <tr>
          <th class="scimenu"><div align="center">ลบ</div></th>
           <th class="scimenu"><div align="center">ชื่อ</div></th>
           <th class="scimenu"><div align="center">ชื่อเข้าใช้ระบบ</div></th>
           <th class="scimenu"><div align="center">เข้าใช้งานครั้งสุดท้าย</div></th>
           <th class="scimenu"><div align="center">วันที่สมัครเข้าใช้</div></th>
</tr>
    
    <?php 
     $query_Recordset1 = " Select  *  from  register  where  UserName  not in  (  Select UserName from  radacct  where AcctStartTime  between         '$nexp_h' and  '$today' ) 
	 and  domain='$domian_name'  and status ='1' ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
  do {
$query_Recordset2 = "  Select * from  radacct  where  UserName='$row_Recordset1[UserName]'   order by RadAcctId desc";
$Recordset2 = mysql_query($query_Recordset2, $connect_db) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);  
  ?>

    <tr>
    <td width="58" align="center" class="txtContentBold">  
    <a href="delete_user.php?UserName=<?php print  $row_Recordset1[UserName];?>&delete=1" onClick="return Conf<? echo "$row_Recordset1[UserName]" ?>(this)">
    <img src="dlete_xp_icon.png" width="35" height="35" border="0"></a>     </td>
    <td width="184" class="txtContentBold"><?php print  $row_Recordset1[fullname];?></td>
    <td width="139" class="txtContentBold"> <span class="tableCool"><?php print  $row_Recordset1[UserName];?> </span></td>
   <td width="172" class="txtContentBold"> <span class="tableCool"> <? 
                                  if($row_Recordset2[AcctStartTime] !='')
								                 { print date_to_thai($row_Recordset2[AcctStartTime]); }
												 else { print "ไม่มีข้อมูลในระบบ";} ?> </span></td>
     <td width="219" class="txtContentBold"> <span class="tableCool"> <? print   date_to_thai($row_Recordset1[register_day]);   ?></span></td>
  </tr>
<?php     } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
