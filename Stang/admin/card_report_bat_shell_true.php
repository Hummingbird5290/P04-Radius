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
 
 $total_cost=0;
  
?>
<html>
<head>
<title>รายงานการขายบัตร</title>
 
 
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
 <script language="JavaScript" src="Carlendar/calendar.js"></script>
<link href="Carlendar/calendar-mos.css" rel="stylesheet" type="text/css">
<script language="Javascript" type="text/javascript" src="script/tooltip.js"></script>
<script language="Javascript" type="text/javascript" src="script/ajax.js"></script>
<body>
<form name="form1" method="post" action="index.php?case_i=83">
  <?
	

		if (empty($offset) || $offset < 0) { 
		   $offset=0; 
		} 
		//    Set $limit,  $limit = Max number of results per 'page' 
		if(!$limit){
			$limit = 1000;
		}
		//    Set $totalrows = total number of rows that unlimited query would return 
		//    (total number of records to display across all pages) 
		$sql = "SELECT *  FROM   card_true    where           domain='$domian_name'  and identity='$identity'  and  date_add  BETWEEN '$date_view1' AND '$date_view2'";

		$query_data = $db->query($sql);
		$rows = mysql_num_rows($query_data);
			// Set $begin and $end to record range of the current page 
		    $begin =($offset+1); 
		    $end = ($begin+($limit-1)); 
		    if ($end > $totalrows) { 
			   $end = $totalrows; 
		    } 
		$Show = $sql." ORDER BY    date_add desc  LIMIT $offset, $limit";
		$query_data = $db->query($Show);

?>
  <table width="852" border="0" align="center" cellpadding="1" cellspacing="1" class="imagetable">
    <tr bgcolor="#FFFFFF"> 
      <th height="30" colspan="9"> <div align="right"><strong>โปรดเลือก&nbsp; Mikrotik Link zone<select name="identity" >
	        <option value="admin_save">ผู้ดูแลระบบเติมให้</option>	
		  <?php
  $query_server_HOST = "SELECT  *  FROM   mikrotik_link  where domain='$domain_name'  ";
 $Recordset_server_HOST = mysql_query($query_server_HOST, $connect_db) or trigger_error(mysql_error(),E_USER_ERROR); 
$row_Recordset_server_HOST = mysql_fetch_assoc($Recordset_server_HOST);
do {
?>
            <option value="<?php print "$domain_name.".$row_Recordset_server_HOST[mk_id];?>"><?php print $row_Recordset_server_HOST[link_name];?></option>
      <?php  }   while ($row_Recordset_server_HOST = mysql_fetch_assoc($Recordset_server_HOST));    ?>   
          </select> </strong> 
          ตั้งแต่วันที่
		  <input name="date_view1" type="text" value="<?php print date("Y-m-d");?>"  id="date_view1" onClick="showCalendar('date_view1','YYYY-MM-DD')" size="20"   readonly="yes" >
		  ถึงวันที่
		  <input name="date_view2" type="text" value="<?php print date("Y-m-d");?>"  id="date_view2" onClick="showCalendar('date_view2','YYYY-MM-DD')" size="20"   readonly="yes" >
          <input type="submit" name="Submit" value="  ค้นหา  " class="styled-button-2"  >
        </div></td>
  </tr>
    <tr bgcolor="#CCFFCC"> 
      <th colspan="9" align="center" class="scimenu">รายการบัตรที่ทำการขาย&nbsp;
	  <?php
	  if($identity !='admin_save'){
 $query_server_HOST = "SELECT  *  FROM   mikrotik_link  where link_name_config='$identity'  ";
 $Recordset_server_HOST = mysql_query($query_server_HOST, $connect_db) or trigger_error(mysql_error(),E_USER_ERROR); 
$row_Recordset_server_HOST = mysql_fetch_assoc($Recordset_server_HOST);  
print $row_Recordset_server_HOST[link_name];
} else {
print "ผู้ดูแลระบบเติมเลขบัตรให้";
}
print  "&nbsp;&nbsp;$date_view1  -  $date_view2";
	  ?></th>
    </tr>
    <tr bgcolor="#FFFFCC"> 
      <th width="15%" align="center" class="scimenu"> <div align="center">ลำดับ</div></th>
      <th width="27%" align="center" bgcolor="#FFFFCC" class="scimenu"> <div align="center">card number </div></th>
      <th width="20%" align="center" bgcolor="#FFFFCC" class="scimenu"> <div align="center">user active </div></th>
      <th width="25%" align="center" class="scimenu"> <div align="center">Time active  </div></th>
 
      <th width="13%" align="center" class="scimenu">ราคา</th>
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
 <td height="21" class="ข้อความในตาราง" > <div align="center"> <? print $result_data[idcard];?></div></td>
 <td height="21" class="ข้อความในตาราง" > <div align="center">      <a href="#search" onClick="newwindow=window.open('detail_user.php?id_edit=<? print $result_data[UserName];?>','detail_user','height=600,width=600,left=10,top=100,scrollbars=1');newwindow.focus();">  <? print $result_data[UserName];?></a></div></td>
 <td height="21" class="ข้อความในตาราง" > <div align="center"> <? print $result_data[date_add];?></div></td>
 
 <td height="21" class="ข้อความในตาราง" > <div align="center"> <? print number_format($result_data[cost],2)."&nbsp;บาท";   $total_cost=$result_data[cost]+$total_cost;?></div></td>
    </tr>
    <?
			$i++;
		}
}

	}else{
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td colspan="9"><div align="center"><strong><font color="#FF0000">ไม่พบข้อมูล</font></strong></div></td>
    </tr>
    <?
	}
  
 
  ?>
  </table>
  <div align="center"><br>
  <h1>  รวมราคา <?php print number_format($total_cost,2);?>&nbsp;บาท</h1><br>
  </div>
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

echo   "<a href='index.php?case_i=83&offset=$prevoffset&identity=$identity&date_view1=$date_view1&date_view2=$date_view2'>
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
                  echo  "<a href='index.php?case_i=83&offset=$newoffset&identity=$identity&date_view1=$date_view1&date_view2=$date_view2'     >
				  <font  color=\"black\">$i</font></a>\n\n"; 
        } 
    } 

    // Check to see if current page is last page 
   if (!((($offset/$limit)+1)==$pages) && $pages!=1) { 
        // Not on the last page yet, so display a NEXT Link 
        $newoffset=$offset+$limit; 
        echo   "<a href='index.php?case_i=83&offset=$newoffset&identity=$identity&date_view1=$date_view1&date_view2=$date_view2'>
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
//print $sql;
?>
<p align="right"><a href="index.php"><font color="#0000FF">กลับหน้าหลักผู้ดูแลระบบ</font></a> 
</p>
 
<div align="center"></div>
</body>
</html>
