<? 
include("../include/chklogin.php");  
include("../Connections/dbconnect.php");
 mysql_select_db($database_edoc);//  or trigger_error(mysql_error(),E_USER_ERROR);
include("../Connections/class.php");
include("class.php");
include("../include/function.php");
?>
<html>
<head>
<title>รายการบัตร</title>
   
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/style.css" rel="stylesheet" type="text/css">

<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="Carlendar/calendar.js"></script>
<link href="Carlendar/calendar-mos.css" rel="stylesheet" type="text/css">
<style type="text/css">

#lyrtooltip {
     position:absolute;
     border:1px solid #FFA500;
     background-color: white;
     padding:3px;
     text-align:left;
}
</style>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style2 {color: #000000}
.style3 {color: #000000; font-weight: bold; }
-->
</style>
<body>
<form name="form1" method="post" action="index.php?case_i=47">
  <?
	
		//$condition = "  ";
		if(trim($txt_search)<>''){
		 $txt_search = htmlspecialchars("$txt_search", ENT_QUOTES);
$pattern = '/;/i';
$replacement = NULL;
$txt_search= preg_replace($pattern, $replacement, $txt_search);
			$condition = "  and ( card.GroupName='$txt_search'  and    card.time_active BETWEEN   '$dstart'  and  '$dstop'   and  date_end='$HH'  and type_time='$HT'   )  ";
		}
		if (empty($offset) || $offset < 0) { 
		   $offset=0; 
		} 
		//    Set $limit,  $limit = Max number of results per 'page' 
		if(!$limit){
			$limit = 50;
		}
		//    Set $totalrows = total number of rows that unlimited query would return 
		//    (total number of records to display across all pages) 
		$sql = "SELECT  * FROM   card   where   card.active= '$aative'  $condition";

		$query_data = $db->query($sql);
		$rows = mysql_num_rows($query_data);
			// Set $begin and $end to record range of the current page 
		    $begin =($offset+1); 
		    $end = ($begin+($limit-1)); 
		    if ($end > $totalrows) { 
			   $end = $totalrows; 
		    } 
		$Show = $sql." ORDER BY   date_end  LIMIT $offset, $limit";
		$query_data = $db->query($Show);

?>
  <table width="85%" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr bgcolor="#FFFFFF"> 
      <td height="30" colspan="7"> <div align="right"><strong>แสดงรายการบัตร
        
        <select name="aative">
          <option value="1">ใช้งานแล้ว</option>
          <option value="0">ยังไม่ได้ใช้งาน</option>
        </select>
        
        แยกตามกลุ่มความเร็ว</strong>
          <?php
	            $query_Groups = "SELECT *   FROM   radgroupreply    group by GroupName     ";
				$Groups_db = mysql_query($query_Groups, $connect_db) or die(mysql_error());
				$row_Froupss = mysql_fetch_assoc($Groups_db);
				  ?>
        <select name="txt_search" id="txt_search"      >
      
          <?php
												do {  
														  ?>
          <option value="<?php echo $row_Froupss['GroupName']?>" ><?php echo $row_Froupss['GroupName']?></option>
          <?php
								} while ($row_Froupss = mysql_fetch_assoc($Groups_db));
								?>
        </select>
            <strong><br>
          ระหว่างวันที่</strong>
          <input name="dstart" type="text" value=""  id="dstart" onClick="showCalendar('dstart','YYYY-MM-DD')" size="20"   readonly="yes" >
          <strong>ถึง</strong>
          <input name="dstop" type="text" value=""  id="dstop" onClick="showCalendar('dstop','YYYY-MM-DD')" size="20"   readonly="yes" >
          <br>
          <strong>จำนวนวันที่กำหนดไว้ในระบบ</strong>
		    <?php
	            $query_Groups = "SELECT *   FROM   card    group by date_end   order by  date_end ";
				$Groups_db = mysql_query($query_Groups, $connect_db) or die(mysql_error());
				$row_Froupss = mysql_fetch_assoc($Groups_db);
				  ?>
        <select name="HH" id="HH"  >
      
          <?php
do {  
$type_time=	$row_Froupss['type_time'];
  if($type_time=='ชั่วโมง')
 {
 $tvalue=$row_Froupss['date_end']/60/60;
 }
  if($type_time=='นาที')
 {
 $tvalue=$row_Froupss['date_end']/60;
 }
   if($type_time=='วัน')
 {
 $tvalue=$row_Froupss['date_end'];
 }
											//	if($row_Froupss['date_end'] > 3600 ){ $tvalue= $row_Froupss['date_end']; $tvalue= $tvalue/60; } else { $tvalue= $row_Froupss['date_end'];}
														  ?>
          <option value="<?php echo $row_Froupss['date_end'];?>" ><?php echo $tvalue;?>  </option>
          <?php
								} while ($row_Froupss = mysql_fetch_assoc($Groups_db));
								?>
        </select>
        <select name="HT" id="HT"  >
          <option value="ชั่วโมง" >ชั่วโมง </option>
          <option value="นาที" >นาที </option>
           <option value="วัน" >วัน </option>
        </select>
          <input type="submit" name="Submit" value="  ค้นหา  ">
      </div></td>
    </tr>
    <tr bgcolor="#CCFFCC"> 
      <td colspan="7"> <div align="center" class="style1 style2"><font size="3" face="MS Sans Serif, Tahoma, sans-serif">
      <strong>รายการบัตรของกลุ่ม   <?php print $txt_search;?>&nbsp; เริ่มตั้งแต่วันที่ &nbsp; <?php print $dstart;?>   ถึงวันที่  &nbsp;<?php print $dstop;?></strong></font> </div></td>
    </tr>
    <tr bgcolor="#FFFFCC"> 
      <td width="6%"> <div align="center" class="style3"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ลำดับ</font></strong></div></td>
      <td width="10%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">เปิดใช้งาน</font></strong></td>
      <td width="24%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">หมายเลขบัตร</font></strong></td>
      <td width="15%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">อยู่ในกลุ่ม</font></strong></td>
      <td width="16%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">วันที่ทำการสร้าง</font></strong></td>
      <td width="12%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ราคา</font></strong></td>
      <td width="17%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">จำนวน</font></strong></td>
    </tr>
    <?
  if($rows<>0){
	  $i=1;
	  while($result_data = mysql_fetch_array($query_data)){
	  $check=$db->query(" SELECT  * FROM   card   where   card.active= '$aative'  $condition ");
	  	    $cli=$i%2;
		if($cli=="0")  {$cli="#AAD2FF" ;  } else {    $cli="#FFFFFF" ;   }
	    ?>
    <tr bgcolor="<?php echo "$cli"; ?>" > 
      <td height="21" align="center"> <font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?=($offset + $i);?>
        .</font></td>
      <td><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> &nbsp;&nbsp;
        <?  print   $result_data[active];   ?>
      </font></div></td>
      <td><div align="left"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
          &nbsp;&nbsp; 
          <?  print   $result_data[idcard];   ?>
          </font></div></td>
      <td><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> &nbsp;&nbsp;&nbsp;
          <?  print   $result_data[GroupName];   ?>
      </font></div></td>
      <td><div align="right"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">
        <?  print   $result_data[Time_build];   ?>
      &nbsp;&nbsp;</font></div></td>
      <td><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">
        <?  print   $result_data[cost];   ?>
      </font></div></td>
      <td><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
          <?php if($result_data[type_time]=="วัน")  {  print $result_data[date_end];  }  
		             if($result_data[type_time]=="ชั่วโมง")  {  $g=($result_data[date_end]/60)/60;   print $g;} 
					 if($result_data[type_time]=="นาที")  {  $g=($result_data[date_end]/60);           print $g;} 
					  ?>
          </font><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
          &nbsp;
          <?  print   $result_data[type_time];   ?>
          </font></div></td>
    </tr>
    <?
			$i++;
		}
	}else{
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td colspan="7"><div align="center"><strong><font color="#FF0000">ไม่พบข้อมูล</font></strong></div></td>
    </tr>
    <?
	}
  
 
  ?>
  </table>
<br><br>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
 
          <td bgcolor="#CCCCCC"><div align="right"></div></td>
    </tr>
  </table>
<? if($rows > 0){ ?>
	
<table width="81%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr> 
          <td><img src="../images/test.gif" width="16" height="16" border="0" align="absmiddle"> 
            <strong>หน้าที่</strong> <?php
// Begin Prev/Next Links 
// Don't display PREV link if on first page 
if ($offset !=0) {   
$prevoffset=$offset-$limit; 

echo   "<a href='index.php?case_i=47&offset=$prevoffset&txt_search=$txt_search&aative=$aative&dstart=$dstart&dstop=$dstop&HH=$HH&HT=$HT'>
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
                  echo  "<a href='index.php?case_i=47&offset=$newoffset&txt_search=$txt_search&aative=$aative&dstart=$dstart&dstop=$dstop&HH=$HH&HT=$HT' >
				  <font  color=\"black\">$i</font></a>\n\n"; 
        } 
    } 

    // Check to see if current page is last page 
   if (!((($offset/$limit)+1)==$pages) && $pages!=1) { 
        // Not on the last page yet, so display a NEXT Link 
        $newoffset=$offset+$limit; 
        echo   "<a href='index.php?case_i=47&offset=$newoffset&txt_search=$txt_search&aative=$aative&dstart=$dstart&dstop=$dstop&HH=$HH&HT=$HT'>
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
<p align="right">&nbsp;</p>
 
<div align="center"></div>
</body>
</html>
