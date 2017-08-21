<? 
include("../include/chklogin.php");  
include("../Connections/dbconnect.php");
include("../Connections/class.php");
include("class.php");
if($clear=="1")
{
$stop_time=date("Y-m-d H:i:s");
 
mysql_select_db($database_edoc);
mysql_query( "update  radacct  set AcctStopTime  ='$stop_time'  , AcctTerminateCause='Admin-Reset' where   UserName='$UserName'   and  AcctStopTime='0000-00-00 00:00:00'  ");
 
}

function UData($name,$connect_db) {
 
     mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
$query_Max = "SELECT  *  from server  where   macaddress ='$name'     ";
 $Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
return  $row_Max[server_name];
}


$mdate1 = date("Y-m-d");
$days= date("d");
$days2= date("d")-1;
$mount = date("m");
$year_gp= date("Y");
?>
<html>
<head>
<title>รายชื่อผู้ที่ Online ขณะนี้</title>
      <script language="JavaScript">

function Conf<? echo "$result_data[fullname]" ?>(object) {
if (confirm("ยืนยันการลบผู้ใช้งาน [ <? echo "$result_data[fullname]       "      ?> ] ") ==true) {
return true;
}
return false;
}

</script>
      <script language="JavaScript">

function bad_user<? echo "$result_data[fullname]" ?>(object) {
if (confirm("ยืนยันการบล๊อกผู้ใช้งาน [ <? echo "$result_data[fullname]       "      ?> ] ") ==true) {
return true;
}
return false;
}

</script>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/style.css" rel="stylesheet" type="text/css">

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
<form name="form1" method="post" action="index.php?case_i=28">
  <?
	
		//$condition = "  ";
		if(trim($txt_search)<>''){
 $txt_search = htmlspecialchars("$txt_search", ENT_QUOTES);
$pattern = '/;/i';
$replacement = NULL;
$txt_search= preg_replace($pattern, $replacement, $txt_search);

			$condition = "   and  register.fullname    like'%$txt_search%'    or  register.room      like'%$txt_search%'    or  radacct.UserName      like'%$txt_search%'   or  per   like'%$txt_search%'  or  CallingStationId   like'%$txt_search%'    ";
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
		$sql = "SELECT 
		radacct.UserName,
       radacct.AcctStartTime,
       radacct.FramedIPAddress,
	    radacct.CallingStationId,
       register.fullname,
	    register.room ,
		radacct.UserName,
		 radacct.CalledStationId,
		 register.per  ,
		  register.site
		
FROM radacct
     INNER JOIN register ON (radacct.UserName = register.UserName) 
	 where 
          AcctStopTime='0000-00-00 00:00:00' 
	    and DAY(radacct.AcctStartTime) in ( '$days' , '$days2'  )   
	   and    MONTH (AcctStartTime) ='$mount' 
	   and YEAR (AcctStartTime) = '$year_gp'  
	  
    $condition";

		$query_data = $db->query($sql);
		$rows = mysql_num_rows($query_data);
			// Set $begin and $end to record range of the current page 
		    $begin =($offset+1); 
		    $end = ($begin+($limit-1)); 
		    if ($end > $totalrows) { 
			   $end = $totalrows; 
		    } 
		$Show = $sql." ORDER BY     radacct.AcctStartTime DESC  LIMIT $offset, $limit";
		$query_data = $db->query($Show);

?>
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr bgcolor="#FFFFFF"> 
      <td height="30" colspan="7"> <div align="right"><strong>ค้นหา Mac address</strong> 
          <input name="txt_search" type="text" value="<?=$txt_search;?>" size="40">
          <input type="submit" name="Submit" value="  ค้นหา  ">
        </div></td>
    </tr>
    <tr bgcolor="#6A90B5"> 
      <td colspan="7"> <div align="center" class="style1 style2"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><strong>ค้นหาผู้ใช้งานจาก 
          Mac Address</strong></font></div></td>
    </tr>
    <tr bgcolor="#6A90B5"> 
      <td width="4%"> <div align="center" class="style3"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>ลำดับ</strong></font></div></td>
      <td width="17%" align="center"><strong><span class="style3"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">ชื่อ-นามสกุล</font></span></strong></td>
      <td width="13%" align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>Mac 
        Address </strong></font></td>
      <td width="13%" align="center"><strong><span class="style3"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">เวลาเริ่มใช้</font></span></strong></td>
      <td width="12%" align="center"><strong><font size="1" face="MS Sans Serif, Tahoma, sans-serif">IP</font></strong></td>
      <td width="11%" align="center" bgcolor="#6A90B5"><strong><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><?php echo "$siteDB"; ?></font></strong></td>
      <td width="9%" align="center"><strong><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><?php echo "$roomsDB"; ?></font></strong></td>
    </tr>
    <?
  if($rows<>0){
	  $i=1;
	  while($result_data = mysql_fetch_array($query_data)){
	  $check=$db->query("SELECT radacct.UserName,
       radacct.AcctStartTime,
       radacct.FramedIPAddress,
	   radacct.CallingStationId,
       register.fullname,
	    radacct.CalledStationId,
	    register.room ,
		radacct.UserName,
		 register.per  ,
		  register.site
		
FROM radacct
     INNER JOIN register ON (radacct.UserName = register.UserName) 
     where    AcctStopTime='0000-00-00 00:00:00'  
	    and   MONTH (AcctStartTime) =      '$mount' 
	    and DAY(radacct.AcctStartTime) in ( '$days' , '$days2'  ) 
	   and YEAR (AcctStartTime) = '$year_gp'  
	   
  ORDER BY
  radacct.AcctStartTime DESC");
	  	    $cli=$i%2;
		if($cli=="0")  {$cli="#AAD2FF" ;  } else {    $cli="#FFFFFF" ;   }
	    ?>
    <tr bgcolor="<?php echo "$cli"; ?>" > 
      <td align="center"> <font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?=($offset + $i);?>
        .</font></td>
      <td height="21"  ><div align="left"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
          <a href="#search" onClick="newwindow=window.open('detail_user.php?id_edit=<? print $result_data[UserName];?>','detail_user','height=400,width=500,left=10,top=100,scrollbars=1');newwindow.focus();"> 
          <? print $result_data[fullname];?></a> </font></div></td>
      <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><?php print  $result_data[CallingStationId]; ?></font></td>
      <td> <div align="left"></div>
        <div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><? print $result_data[AcctStartTime];?></font></div></td>
      <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><? print $result_data[FramedIPAddress];?></font></td>
      <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><? print $result_data[site];?></font></td>
      <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><? print $result_data[room];?></font></td>
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
          <td  bgcolor="#6A90B5">&nbsp;</td>
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

echo   "<a href='index.php?case_i=28&offset=$prevoffset&txt_search=$txt_search'>
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
                  echo  "<a href='index.php?case_i=28&offset=$newoffset&txt_search=$txt_search'  
                  onMouseOver=\"window.status='Page $i'; return true\";><font  color=\"black\">$i</font></a>\n\n"; 
        } 
    } 

    // Check to see if current page is last page 
   if (!((($offset/$limit)+1)==$pages) && $pages!=1) { 
        // Not on the last page yet, so display a NEXT Link 
        $newoffset=$offset+$limit; 
        echo   "<a href='index.php?case_i=28&offset=$newoffset&txt_search=$txt_search'>
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
