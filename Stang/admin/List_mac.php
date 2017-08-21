<? 
  include("../include/chklogin.php");  
include("../Connections/dbconnect.php");
 mysql_select_db($database_edoc); //  or trigger_error(mysql_error(),E_USER_ERROR);
include("../Connections/class.php");
include("class.php");
 function date_to_thai($date_en)
{
     $date_thai_day = date('d',strtotime($date_en));
	 $date_thai_mont = date('m',strtotime($date_en));
	 $date_thai_year = date('Y',strtotime($date_en));
	 $date_thai_time = date('H:i',strtotime($date_en));
$date_thai_year =$date_thai_year +543;

if($date_thai_mont=="1"){ 	$date_thai_mont="ม.ค."; }
if($date_thai_mont=="2"){ 	$date_thai_mont="ก.พ."; }
if($date_thai_mont=="3"){ 	$date_thai_mont="มี.ค."; }
if($date_thai_mont=="4"){ 	$date_thai_mont="เม.ย."; }
if($date_thai_mont=="5"){ 	$date_thai_mont="พ.ค."; }
if($date_thai_mont=="6"){ 	$date_thai_mont="มิ.ย."; }
if($date_thai_mont=="7"){ 	$date_thai_mont="ก.ค."; }
if($date_thai_mont=="8"){ 	$date_thai_mont="ส.ค."; }
if($date_thai_mont=="9"){ 	$date_thai_mont="ก.ย."; }
if($date_thai_mont=="10"){ 	$date_thai_mont="ต.ค."; }
if($date_thai_mont=="11"){ 	$date_thai_mont="พ.ย."; }
if($date_thai_mont=="12"){ 	$date_thai_mont="ธ.ค."; }
	 
$time_thai=" $date_thai_day&nbsp;$date_thai_mont&nbsp;$date_thai_year เวลา  $date_thai_time นาที  ";
echo $time_thai;
}
?>
<html>
<head>
<title>รายงาน MAC address</title>
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
<form name="form1" method="post" action="index.php?case_i=37">
  <?
 $pattern = '/:/i';
$replacement = '-';
$txt_search= preg_replace($pattern, $replacement, $txt_search);
$txt_search=strtoupper ($txt_search);
		//$condition = "  ";
		if(trim($txt_search)<>''){
		$txt_search=   strtoupper($txt_search);
		 $txt_search = htmlspecialchars("$txt_search", ENT_QUOTES);
			$condition = "     and       macaddress       like'%$txt_search%'      ";
		}
		if (empty($offset) || $offset < 0) { 
		   $offset=0; 
		} 
		//    Set $limit,  $limit = Max number of results per 'page' 
		if(!$limit){
			$limit = 30;
		}
		//    Set $totalrows = total number of rows that unlimited query would return 
		//    (total number of records to display across all pages) 
		$sql = " SELECT *  FROM   radpostauth    where  user in (select UserName as user  from register where  domain='$domain_name')    $condition ";

		$query_data = $db->query($sql);
		$rows = mysql_num_rows($query_data);
			// Set $begin and $end to record range of the current page 
		    $begin =($offset+1); 
		    $end = ($begin+($limit-1)); 
		    if ($end > $totalrows) { 
			   $end = $totalrows; 
		    } 
		$Show = $sql." ORDER BY   date desc    LIMIT $offset, $limit";
		$query_data = $db->query($Show);

?>
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="imagetable">
    <tr bgcolor="#FFFFFF"> 
      <th height="30" colspan="6"> <div align="right"><strong>ค้นหา&nbsp;Mac&nbsp;address</strong> 
          <input name="txt_search" type="text" value="<?=$txt_search;?>" size="40">
          <input type="submit" name="Submit" value="  ค้นหา  " class="styled-button-2"  >
        </div></th>
    </tr>
    <tr bgcolor="#CCFFCC"> 
      <th colspan="6"> <div align="center" class="style1 style2"><font size="3" face="MS Sans Serif, Tahoma, sans-serif">รายการ MAC Address ที่ ผู้ใช้งาน Login เข้าระบบ </font></div></th>
    </tr>
    <tr bgcolor="#FFFFCC"> 
      <th width="9%"> <div align="center" class="style3"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ลำดับ</strong></font></div></th>
      <th width="17%" align="center"><strong><span class="style3"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ชื่อ-นามสกุล</font></span></strong></th>
      <th width="14%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">UserLogin</font></strong></th>
      <th width="22%" align="center"><strong><span class="style3"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">Macaddress</font></span></strong></th>
      <th width="27%" align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Time</strong></font></th>
      <th width="11%" align="center"><strong><span class="style3"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ระงับการใช้งาน</font></span></strong></th>
    </tr>
    <?
  if($rows<>0){
	  $i=1;
	  while($result_data = mysql_fetch_array($query_data)){
	 
	  	    $cli=$i%2;
		if($cli=="0")  {$cli="#AAD2FF" ;  } else {    $cli="#FFFFFF" ;   }
		
$uu=$result_data[user];

$query_Recordset1 = "SELECT   *   FROM  register  where    UserName = '$uu'   ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	    ?>
    <tr bgcolor="<?php echo "$cli"; ?>" > 
      <td align="center"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?=($offset + $i);?>
        .</font></td>
      <td height="21"  ><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          <a href="#search" onClick="newwindow=window.open('detail_user.php?id_edit=<? print $row_Recordset1[UserName];?>','detail_user','height=450,width=500,left=10,top=100,scrollbars=1');newwindow.focus();"> 
          <? print $row_Recordset1[fullname];?></a> </font></div></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><a href="#search" onClick="newwindow=window.open('detail_user.php?id_edit=<? print $row_Recordset1[UserName];?>','detail_user','height=450,width=500,left=10,top=100,scrollbars=1');newwindow.focus();"><? print $uu;?></a></font></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          <? print $result_data[macaddress];?></font></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?    date_to_thai($result_data[date]);?></font></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><a href="block_user_ok.php?UserName=<?echo $row_Recordset1[UserName] ;?>&delete=1"  onClick="return bad_user<? echo "$result_data[UserName]" ?>(this)"> 
          <img src="../images/keys.jpg" width="20" height="20" border="0"> </a></font></div></td>
    </tr>
    <?
			$i++;
		}
	}else{
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td colspan="6"><div align="center"><strong><font color="#FF0000">ไม่พบข้อมูล</font></strong></div></td>
    </tr>
    <?
	}
  
 
  ?>
  </table>
<br><br>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
 
          <td bgcolor="#6699CC"><div align="right"> </div></td>
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

echo   "<a href='index.php?case_i=37&offset=$prevoffset&txt_search=$txt_search'>
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
                  echo  "<a href='index.php?case_i=37&offset=$newoffset&txt_search=$txt_search'     >
				  <font  color=\"black\">$i</font></a>\n\n"; 
        } 
    } 

    // Check to see if current page is last page 
   if (!((($offset/$limit)+1)==$pages) && $pages!=1) { 
        // Not on the last page yet, so display a NEXT Link 
        $newoffset=$offset+$limit; 
        echo   "<a href='index.php?case_i=37&offset=$newoffset&txt_search=$txt_search'>
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
 
<div align="center"> </div>
</body>
</html>
