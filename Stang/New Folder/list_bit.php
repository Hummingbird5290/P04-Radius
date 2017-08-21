<? 
 
include("include/function.php");  
include("Connections/dbconnect.php");
include("Connections/class.php");
$db = new DB;
$mdate1 = date("Y-m-d"); 

 
 $connect_db_syslog=$connect_db_syslog;
 
 if($date_view !=null) {  $date_view=eregi_replace("-", null, $date_view);      $tb="$date_view";  $date_view_day=$date_view ; } else {$tb = date("Ymd");    $date_view_day=$tb; }

$tb ="list_bit_$tb";
//check  ว่า  tbl มีจริงหรือไม่ 
if (!mysql_is_table($tb))  {

                                             echo                  "<script type=text/javascript>";
                                             echo                  "alert('ไม่มีข้อมูลในวันที่  $date_view  ')";
	                                         echo                  "</script>";
									         $tb = date("Ymd"); 
											  $tb ="log_$tb";
											 }
?>
<html>
<head>
<title>SYSTEMLOG_<?php echo "$date_view"; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="Carlendar/calendar.js"></script>
<link href="Carlendar/calendar-mos.css" rel="stylesheet" type="text/css">
<script language="Javascript" type="text/javascript" src="script/tooltip.js"></script>
<script language="Javascript" type="text/javascript" src="script/ajax.js"></script>
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
<form name="form1" method="post" action="index.php?case_i=3">
  <?
	
		//$condition = "  ";
		if(trim($txt_search)<>''){
			$condition = "    and (   DECODE(msg,'thaigqsoft')    like  '%$txt_search%'   or    program   like  '%$txt_search%'    )";
		}
		if (empty($offset) || $offset < 0) { 
		   $offset=0; 
		} 
		//    Set $limit,  $limit = Max number of results per 'page' 
		if(!$limit){
			$limit = 20;
		}
		//    Set $totalrows = total number of rows that unlimited query would return 
		//    (total number of records to display across all pages) 
		$sql = "SELECT   * ,DECODE(msg,'thaigqsoft') as msg  FROM   $tb   where  msg like '%torrent%'      $condition";

		$query_data = $db->query($sql);
		$rows = mysql_num_rows($query_data);
			// Set $begin and $end to record range of the current page 
		    $begin =($offset+1); 
		    $end = ($begin+($limit-1)); 
		    if ($end > $totalrows) { 
			   $end = $totalrows; 
		    } 
		$Show = $sql."  ORDER BY   datetime  DESC  LIMIT $offset, $limit";
		$query_data = $db->query($Show);

?>
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFCC">
    <tr bgcolor="#FFFFFF"> 
      <td height="30" colspan="3"> <div align="right"><strong>ค้นหา</strong> 
          <input name="txt_search" type="text" value="<?=$txt_search;?>" size="40">
          โดยค้นหาจากวันที่ 
          <input name="date_view" type="text" value=""  id="date_view" onClick="showCalendar('date_view','YYYY-MM-DD')" size="20"   readonly="yes" >
          <input type="submit" name="Submit" value="  ค้นหา  ">
        </div></td>
    </tr>
    <tr bgcolor="#AFFFFF"> 
      <td colspan="3"> <div align="center" class="style1 style2"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><strong>Log 
          System For Load Bit Report วันที่ &nbsp; <?php echo "$date_view_day"; ?> 
          </strong></font></div></td>
    </tr>
    <tr bgcolor="#AFFFFF"> 
      <td width="4%"> <div align="center" class="style3"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ลำดับ</strong></font></div></td>
      <td width="25%" align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>เวลา</strong></font></td>
      <td width="71%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">msg 
        </font></strong></td>
    </tr>
    <?
  if($rows<>0){
	  $i=1;
	  while($result_data = mysql_fetch_array($query_data)){
	  $check=$db->query("SELECT   *,DECODE(msg,'thaigqsoft') as msg  FROM   $tb    where  DECODE(msg,'thaigqsoft') like '%torrent%'    ORDER BY    datetime  DESC          ");
	  	    $cli=$i%2;
		if($cli=="0")  {$cli="#F0D2FF" ;  } else {    $cli="#FFFFFF" ;   }
	    ?>
    <tr bgcolor="<?php echo "$cli"; ?>" > 
      <td height="21" align="center"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?=($offset + $i);?>
        .</font></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<? print $result_data[datetime];?></font></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><? print $result_data[msg];?></font></td>
      <script language="JavaScript">

function Conf<? echo "$result_data[fullname]" ?>(object) {
if (confirm("ยืนยันการลบผู้ใช้งาน [ <? echo "$result_data[fullname]       "      ?> ] ") ==true) {
return true;
}
return false;
}

</script>
    </tr>
    <?
			$i++;
		}
	}else{
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td colspan="3"><div align="center"><strong><font color="#FF0000">ไม่พบข้อมูล</font></strong></div></td>
    </tr>
    <?
	}
  ?>
  </table>
<br><br>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
          <td background="images/line.jpg">&nbsp;</td>
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

echo   "<a href='index.php?case_i=3&offset=$prevoffset&txt_search=$txt_search'>
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
	# ไม่ให้เกิน ร้อยหน้า 
	if($pages > 100) {  $pages =100; } 
    for ($i=1;$i<=$pages;$i++) { 
        // Check if on current page 
        if (($offset/$limit) == ($i-1)) { 
            // $i is equal to current page, so don't display a link 
            echo "$i "; 
        } else { 
            // $i is NOT the current page, so display a link to page $i 
            $newoffset=$limit * ($i-1); 
                  echo  "<a href='index.php?case_i=3&offset=$newoffset&txt_search=$txt_search' ". 
                  "onMouseOver=\"window.status='Page $i'; return true\";><font  color=\"black\">$i</font></a>\n\n"; 
        } 
    } 

    // Check to see if current page is last page 
   if (!((($offset/$limit)+1)==$pages) && $pages!=1) { 
        // Not on the last page yet, so display a NEXT Link 
        $newoffset=$offset+$limit; 
        echo   "<a href='index.php?case_i=3&offset=$newoffset&txt_search=$txt_search'>
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
<p align="right"><a href="index.php"><font color="#0000FF">กลับหน้าหลัก</font></a> 
</p>
 
<div align="center"></div>
</body>
</html>
