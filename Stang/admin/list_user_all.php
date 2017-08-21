<? 
include_once("../include/chklogin.php");  
//ini_set('date.timezone ', 'Asia/Bangkok');
 //   ini_set('display_errors', 1);
   
 //  error_reporting(E_ALL);
include_once("../Connections/dbconnect.php");
include_once("../include/function.php");
 mysql_select_db($database_edoc);  // or trigger_error(mysql_error(),E_USER_ERROR);
include_once("../Connections/class.php");
include_once("class.php");

function UDataCHK($name,$connect_db,$domain_name) {
 
     mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
	
$query_Max = "SELECT  *  from radcheck  where   UserName ='$name'  and Attribute='Expiration'   ";
 $Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
  
$times=$row_Max[Value];


$query_sum_t = "
SELECT 
sum(card.date_end) as tcard
FROM
  table_card_user
  INNER JOIN card ON (table_card_user.idcard = card.idcard)
  
  where   card.UserName='$name'   
 
                   and  table_card_user.active='0'  and  table_card_user.domain='$domain_name' ";
$user_time_end = mysql_query($query_sum_t, $connect_db) or die(mysql_error());
$row_tt_time= mysql_fetch_assoc($user_time_end);
### ดึงเวลาหมดอายุในระบบมาเพื่อ แจ้ง user
$date_dbs=$row_tt_time[tcard];
    #ทำการแยกวันที่ เวลา จากตัวแปร  $date_db มาเป็น array
			  $a_time= explode(" ",$times) ;
			  $a_time[0];  //วัน
			 $a_time[1];  //เดือน
			  $a_time[2];  //ปี
		  #แปลง เดือน เป็น ตัวเลข 
			 $a_time[1]=re_name($a_time[1]);
			 $date_db="$a_time[0]-$a_time[1]-$a_time[2]";

$dds1= explode("-",$date_db) ;
if($date_dbs=='') { $ttiomes='' ;} else {  
$ttiomes="<br>และที่เติมใหม่อีก  $date_dbs วัน ที่ยังไม่ใช้งาน";   }
$ftime=re_name4("$dds1[0]/$dds1[1]/$dds1[2]");
$dds2 ="$ftime  $ttiomes";
if($dds1[0]==''  and  $dds1[1]==''  and  $dds1[2]==''){
$dds2="ไม่มีรายการเติมบัตร";
}
return  $dds2;
}
  //ฟังชั่นคำนวนเวลา
//

function dateDiv($t1,$t2){ // ส่งวันที่ที่ต้องการเปรียบเทียบ ในรูปแบบ มาตรฐาน 2006-03-27 21:39:12

    $t1Arr=splitTime($t1);
    $t2Arr=splitTime($t2);
   
    $Time1=mktime($t1Arr["h"], $t1Arr["m"], $t1Arr["s"], $t1Arr["M"], $t1Arr["D"], $t1Arr["Y"]);
    $Time2=mktime($t2Arr["h"], $t2Arr["m"], $t2Arr["s"], $t2Arr["M"], $t2Arr["D"], $t2Arr["Y"]);
    $TimeDiv=abs($Time2-$Time1);

    $Time["D"]=intval($TimeDiv/86400); //  จำนวนวัน
    $Time["H"]=intval(($TimeDiv%86400)/3600); // จำนวน ชั่วโมง
    $Time["M"]=intval((($TimeDiv%86400)%3600)/60); // จำนวน นาที
    $Time["S"]=intval(((($TimeDiv%86400)%3600)%60)); // จำนวน วินาที
 return $Time;
}

 

function splitTime($time){ // เวลาในรูปแบบ มาตรฐาน 2006-03-27 21:39:12
 $timeArr["Y"]= substr($time,2,2);
 $timeArr["M"]= substr($time,5,2);
 $timeArr["D"]= substr($time,8,2);
 $timeArr["h"]= substr($time,11,2);
 $timeArr["m"]= substr($time,14,2);
    $timeArr["s"]= substr($time,17,2);
 return $timeArr;
}



##########ค้นหาวันเวลาหมดอายุของแอคเค้า
function utimes($UserName,$connect_db,$domain_name) {
 //ค้นหา เวลาหมดอายุ กรณี เป็นชั่วโมง
$chk_Max_All_Session=mysql_query("SELECT  Value   FROM  radcheck     WHERE  Attribute='Max-All-Session'  and UserName='$UserName' ", $connect_db) or die(mysql_error());
$row_All_Session= mysql_fetch_assoc($chk_Max_All_Session);
$totalMax_All_Session = mysql_num_rows($chk_Max_All_Session);
if($totalMax_All_Session >0){



$AcctSessionTime_sql1 = "SELECT  AcctStartTime   FROM  radacct     WHERE UserName='$UserName'   order by RadAcctId desc   ";
$AcctSessionTime_sql_db1 = mysql_query($AcctSessionTime_sql1, $connect_db) or die(mysql_error());
$row_setingz1= mysql_fetch_assoc($AcctSessionTime_sql_db1);

$now_times=date("Y-m-d H:i:s");


$timess=dateDiv($row_setingz1[AcctStartTime],$now_times);


$AcctSessionTime_sql = "SELECT sum(AcctSessionTime) as tt  FROM  radacct     WHERE UserName='$UserName'     ";
$AcctSessionTime_sql_db = mysql_query($AcctSessionTime_sql, $connect_db) or die(mysql_error());
$row_setingz= mysql_fetch_assoc($AcctSessionTime_sql_db);

#ชั่วโมงใช้งาน  ที่เหลือ
$dayta_times=$row_All_Session[Value]-$row_setingz[tt]+$timess[S];
if($dayta_times > 3600){
$dayta_times=$dayta_times/60;
$dayta_times=$dayta_times/60;
 $ustime="ชั่วโมง";
}else{
$dayta_times=$dayta_times/60;
 $ustime="นาที";
}
//$dayta_times=$dayta_times/60;
$dayta_times=round($dayta_times, 0);
 if( $dayta_times < 0 ) { $dayta_times =0; }
##################
$bat_time= "เหลือชั่วโมงใช้งาน  $dayta_times   $ustime"; 

} else

{
$bat_time= UDataCHK($UserName,$connect_db,$domain_name);
}
  return $bat_time;
  }
#####################################
 function Ugroup($name,$connect_db) {

     mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
$query_Max = "SELECT  *  from usergroup   where   UserName='$name'     ";
 $Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
if($row_Max[GroupName] =='') { $row_Max[GroupName]='ยังไม่เปิดใช้งาน';}
return  $row_Max[GroupName];
}

 function UNday($name,$connect_db) {

      mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
$query_Max = "SELECT  *  from radcheck  where   UserName ='$name'  and Attribute='Expiration'   ";
 $Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
  
$times=$row_Max[Value];
$query_sum_t = "
SELECT 
sum(card.date_end) as tcard
FROM
  table_card_user
  INNER JOIN card ON (table_card_user.idcard = card.idcard)
  
  where   card.UserName='$name'   
                   and  table_card_user.active='0'   ";
$user_time_end = mysql_query($query_sum_t, $connect_db) or die(mysql_error());
$row_tt_time= mysql_fetch_assoc($user_time_end);
### ดึงเวลาหมดอายุในระบบมาเพื่อ แจ้ง user
$date_dbs=$row_tt_time[tcard];
//print $date_dbs;
    #ทำการแยกวันที่ เวลา จากตัวแปร  $date_db มาเป็น array
			  $a_time= explode(" ",$times) ;
			  $a_time[0];  //วัน
			 $a_time[1];  //เดือน
			  $a_time[2];  //ปี
		  #แปลง เดือน เป็น ตัวเลข 
			 $a_time[1]=re_name($a_time[1]);
			 $date_db="$a_time[0]-$a_time[1]-$a_time[2]";

$dds1= explode("-",$date_db) ;
if($date_dbs=='') { $ttiomes='' ;} else {  $ttiomes="<br>และที่เติมใหม่อีก  $date_dbs วัน ที่ยังไม่ใช้งาน";   }
$dds2 ="    $dds1[0]/$dds1[1]/$dds1[2]  (วัน/เดือน/ปี)  $ttiomes";
return  $dds2;
}

if($uis==1)
{
 if($_SESSION["adminpass"]=='demo'){
 
      echo                  "<script type=text/javascript>";
		    echo                  "alert('ผู้ใช้งาน ทดสอบระบบ ไม่สามารถ แก้ไขข้อมูลได้ ')";
	        echo                  "</script>";  
  echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=2>";
 exit();
 
}
$sql ="delete  from  radcheck  where Attribute in('Expiration','Max-All-Session') and   UserName ='$id_edit'  ";
 mysql_select_db($database_edoc);
 mysql_query ($sql)   or trigger_error(mysql_error(),E_USER_ERROR);
 
  mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)   values('$id_edit','Expiration',':=','5 Mar 2008 01:00:00')") or    die ("Add ข้อมูลลง Table ไม่ได้ ");
echo "<script type=text/javascript>";
echo "alert('บันทึกข้อมูลเสร็จสิ้น    ')";
 echo "</script>";
 echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=2>";
exit();
}
?>
<html>
<head>
<title>ผู้ใช้งานที่ในระบบ</title>
 
<script language="JavaScript">

	function Confsms<? echo "$row_Recordset1[UserName]" ?>(object) {
if (confirm("ยืนยันการส่ง sms แจ้งรหัสผ่าน") ==true) {
return true;
}
return false;
}
    </script>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="../css/style.css" rel="stylesheet" type="text/css">


<style type="text/css">

#lyrtooltip {
     position:absolute;
     border:1px solid #FFA500;
     background-color: white;
     padding:3px;
     text-align:left;
}
</style>
 
<body>
<form name="form1" method="post" action="index.php?case_i=2">
  <?
	
		//$condition = "  ";
		if(trim($txt_search)<>''){
		  $txt_search = htmlspecialchars("$txt_search", ENT_QUOTES);
		  
$pattern = '/;/i';
$replacement = NULL;
$txt_search= preg_replace($pattern, $replacement, $txt_search);
			$condition = "   and    (   fullname      like'%$txt_search%'   or  per   like'%$txt_search%'   or  UserName    like'%$txt_search%'    or  email    like'%$txt_search%' 
			or  tel   like'%$txt_search%' )";
		}
		if (empty($offset) || $offset < 0) { 
		   $offset=0; 
		} 
		//    Set $limit,  $limit = Max number of results per 'page' 
		if(!$limit){
			$limit = 15;
		}
		//    Set $totalrows = total number of rows that unlimited query would return 
		//    (total number of records to display across all pages) 
		$sql = "SELECT *  FROM   register    where   register.`status`  not in ('0','88','99')     and domain='$domian_name'   $condition";

		$query_data = $db->query($sql);
		$rows = mysql_num_rows($query_data);
			// Set $begin and $end to record range of the current page 
		    $begin =($offset+1); 
		    $end = ($begin+($limit-1)); 
		    if ($end > $totalrows) { 
			   $end = $totalrows; 
		    } 
		$Show = $sql." ORDER BY    register.UserName   LIMIT $offset, $limit";
		$query_data = $db->query($Show);

?>
  <table width="778" border="0" align="center" cellpadding="1" cellspacing="1" class="imagetable">
    <tr bgcolor="#FFFFFF"> 
      <th height="30" colspan="14"> <div align="right"><strong>ค้นหารหัสบัตรประชาชน/ชื่อผู้ใช้งาน/ชื่อเข้าใช้ระบบ/e-mail/เบอร์โทร</strong> 
          <input name="txt_search" type="text" value="<?=$txt_search;?>" size="18">
          <input type="submit" name="Submit" value="  ค้นหา  " class="styled-button-2"  >
        </div></tdth
    ></tr>
    <tr bgcolor="#CCFFCC"> 
      <th colspan="14" align="center" class="scimenu"> ชื่อผู้ใช้งานในระบบ</th>
    </tr>
    <tr bgcolor="#FFFFCC"> 
      <th width="6%" align="center" class="scimenu"> <div align="center">ลำดับ</div></th>
      <th width="17%" align="center" bgcolor="#FFFFCC" class="scimenu"> <div align="center">Full Name  </div></th>
      <th width="12%" align="center" class="scimenu"> <div align="center">user login  </div></th>
 
      <th width="9%" align="center" bgcolor="#FFFFCC" class="scimenu"> <div align="center">ปรับเพิ่ม<br>
      วันหมดอายุ </div></th>
      <th width="12%" align="center" class="scimenu"> <div align="center">วันหมดอายุ </div></th>
      <th width="12%" align="center" class="scimenu"> <div align="center">ระงับ<br>
      การใช้งาน </div></th>
      <th width="9%" align="center" class="scimenu"> <div align="center">แก้ไข<br>
      รหัสผ่าน </div></th>
      <th width="9%" align="center" class="scimenu">ส่งรหัส<br>
        ผ่านทาง<br> 
      SMS </th>
      <th width="7%" align="center" class="scimenu"> <div align="center">Time <br>
      login </div></th>
      <th width="10%" align="center" class="scimenu"> <div align="center">บังคับ<br>
      หมดอายุ </div></th>
      <th width="9%" align="center" class="scimenu"> <div align="center">ลบ </div></th>
    </tr>
    <?
  if($rows<>0){
	  $i=1;
	  while($result_data = mysql_fetch_array($query_data)){
	 if($result_data[domain]==$domain_name){
	  	    $cli=$i%2;
		if($cli=="0")  {$cli="#AAD2FF" ;  } else {    $cli="#AFFFCA" ;   }
	    ?>
    <tr bgcolor="<?php echo "$cli"; ?>" > 
      <td align="center" class="ข้อความในตาราง"> <font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?=($offset + $i);?>
        .</font></td>
      <td height="21" class="ข้อความในตาราง"   title="<?  print   $result_data[UserName];   ?> อยู่ในกลุ่มผู้ใช้ <?   $d_g=Ugroup($result_data[UserName],$connect_db);   print  $d_g;  ?>"> 
          <div align="center"><a href="#search" onClick="newwindow=window.open('detail_user.php?id_edit=<? print $result_data[UserName];?>','detail_user','height=600,width=600,left=10,top=100,scrollbars=1');newwindow.focus();"> 
    <?  print   $result_data[fullname];   ?>
          </a> </div></td>
      <td class="ข้อความในตาราง"><? print $udate_name=$result_data[UserName];?>      </td>
     
      <td class="ข้อความในตาราง" align="center"> 
                                              <a href="<?php echo $editFormAction; ?>?case_i=52&uedit=<?php print $result_data[UserName];?>" >
                                                            <img src="pic/calendar.jpg" width="23" height="22" border="0" >                                               </a>       </td>
      <td class="ข้อความในตาราง">   <?php $unday=utimes($result_data[UserName],$connect_db,$domain_name);  print  $unday;   ?>  </td>
      <td align="center"> <a href="block_user_ok.php?UserName=<?echo $result_data[UserName] ;?>&delete=1" onClick="return bad_user<? echo "$result_data[UserName]" ?>(this)"> 
          <img src="ban.jpg" width="30" height="30" border="0"> </a> </td>
      <td align="center"> <a href="index.php?case_i=4&UserName=<?echo $result_data[UserName] ;?>"><img src="edit_icon.jpg" width="30" height="30" border="0"></a> </td>
      <td align="center">
	  <a href="http://www.thaigqsoft.info/sms_password.php?domain_name=<?php print $domain_name;?>&mail_send=<?php echo $result_data[UserName] ;?>&adminOK=OK"   onClick="return Confsms(this)">
	  <img src="sms.png" width="30" height="30" border="0">	  </a></td>
      <td align="center"> <a href="show_login.php?id_edit=<? print $result_data[UserName];?>&name=<? print $result_data[fullname];?>" target="_blank">
      <img src="../images/icon/Sony%20Ericsson%20PC%20Suite.png" alt="ดูเวลาการใช้งานของผู้ใช้งาน" width="30" height="30" border="0"></a> </td>
      <td align="center"> <a href="index.php?case_i=2&id_edit=<? print $result_data[UserName];?>&uis=1" onClick="return timeout<? echo "$result_data[UserName]" ?>(this)"><img src="../images/icon/Foobar.png" alt="บังคับให้หมดอายุการใช้งาน" width="30" height="30" border="0"></a></td>
      <td align="center"><a href="delete_user.php?UserName=<?echo $result_data[UserName] ;?>&delete=1"
	  onClick="return Conf<? echo "$result_data[UserName]" ?>(this)">
	    <img src="dlete_xp_icon.png" width="35" height="35" border="0"></a></td>
    </tr>
    <?
			$i++;
		}
}

	}else{
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td colspan="14"><div align="center"><strong><font color="#FF0000">ไม่พบข้อมูล</font></strong></div></td>
    </tr>
    <?
	}
  
$sql_num= "select   count(UserName) As Num    from   register  where  register.`status`  ='1'  and domain='$domian_name'  ";
$dbquery_num = mysql_query($sql_num);
$result_num = mysql_fetch_array($dbquery_num);
  ?>
  </table>
<br><br>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
 
          <td bgcolor="#6699CC"><div align="right"><font color="#FFFF00" size="2" face="MS Sans Serif, Tahoma, sans-serif">มีผู้ใช้งานในระบบทั้งหมด 
          &nbsp; <?php print  $result_num['Num'];   ?> &nbsp;คน</font></div></td>
    </tr>
  </table>
<? if($rows > 0){ ?>
	
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr> 
          <td><img src="../images/test.gif" width="16" height="16" border="0" align="absmiddle"> 
            <strong>หน้าที่</strong> <?php
// Begin Prev/Next Links 
// Don't display PREV link if on first page 
if ($offset !=0) {   
$prevoffset=$offset-$limit; 

echo   "<a href='index.php?case_i=2&offset=$prevoffset&txt_search=$txt_search'>
<font  color=\"red\"><< ก่อนหน้า</font></a>\n\n";
    }
    // Calculate total number of pages in result 
    $pages = intval($rows/$limit); 
     
    // $pages now contains total number of pages needed unless there is a remainder from division  
    if ($rows%$limit) { 
        // has remainder so add one page  
        $pages++; 
    } 
     
    // Now loop through the pages to create numbered links 
    // ex. 1 2 3 4 5 NEXT 
    for ($i=1;$i<=$pages;$i++) { 
        // Check if on current page 
        if (($offset/$limit) == ($i-1)) { 
            // $i is equal to current page, so don't display a link 
            echo "$i "; 
        } else { 
            // $i is NOT the current page, so display a link to page $i 
            $newoffset=$limit * ($i-1); 
                  echo  "<a href='index.php?case_i=2&offset=$newoffset&txt_search=$txt_search'     >
				  <font  color=\"black\">$i</font></a>\n\n"; 
        } 
    } 

    // Check to see if current page is last page 
   if (!((($offset/$limit)+1)==$pages) && $pages!=1) { 
        // Not on the last page yet, so display a NEXT Link 
        $newoffset=$offset+$limit; 
        echo   "<a href='index.php?case_i=2&offset=$newoffset&txt_search=$txt_search'>
		  <font  color=\"red\">ถัดไป>></font></a>\n"; 
    }
?></td>
    </tr>
  </table>
  <?
	 }
?>
</form>
<?php
mysql_close($connect_db);
?>
<p align="right"><a href="index.php"><font color="#0000FF">กลับหน้าหลักผู้ดูแลระบบ</font></a> 
</p>
 
<div align="center"></div>
</body>
</html>
