<? 
 
include("Connections/dbconnect.php");
include("Connections/class.php");
$db = new DB;
?>
<html>
<head>
<title>ผู้ใช้งานที่สมัครเข้ามาใช้งาน</title>
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
<form name="form1" method="post" action="index.php?case_i=1">
  <?
	
		//$condition = "  ";
		if(trim($txt_search)<>''){
			$condition = "   where register.UserName    like'%$txt_search%'    or  room      like'%$txt_search%'    or  fullname      like'%$txt_search%'   or  per   like'%$txt_search%'  ";
		}
		if (empty($offset) || $offset < 0) { 
		   $offset=0; 
		} 
		//    Set $limit,  $limit = Max number of results per 'page' 
		if(!$limit){
			$limit = 35;
		}
		//    Set $totalrows = total number of rows that unlimited query would return 
		//    (total number of records to display across all pages) 
		$sql = "SELECT *  FROM    register          $condition";

		$query_data = $db->query($sql);
		$rows = mysql_num_rows($query_data);
			// Set $begin and $end to record range of the current page 
		    $begin =($offset+1); 
		    $end = ($begin+($limit-1)); 
		    if ($end > $totalrows) { 
			   $end = $totalrows; 
		    } 
		$Show = $sql." ORDER BY fullname  LIMIT $offset, $limit";
		$query_data = $db->query($Show);

?>
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#A400F2">
    <tr bgcolor="#FFFFFF"> 
      <td height="30" colspan="3"> <div align="right"><strong>ค้นหารหัส/ชื่อผู้ใช้งาน</strong> 
          <input name="txt_search" type="text" value="<?=$txt_search;?>" size="40">
          <input type="submit" name="Submit" value="  ค้นหา  ">
        </div></td>
    </tr>
    <tr bgcolor="#D784FF"> 
      <td colspan="3"> <div align="center" class="style1 style2"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><strong>ชื่อผู้ใช้งานที่สมัครเข้ามา</strong></font></div></td>
    </tr>
    <tr bgcolor="#D784FF"> 
      <td width="4%"> <div align="center" class="style3"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ลำดับ</strong></font></div></td>
      <td width="29%" align="center" bgcolor="#D784FF"><strong><span class="style3"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ชื่อ-นามสกุล</font></span></strong></td>
      <td width="51%" align="center"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>เปิดให้ใช้งาน</strong></font></div></td>
    </tr>
    <?
  if($rows<>0){
	  $i=1;
	  while($result_data = mysql_fetch_array($query_data)){
	  $check=$db->query("SELECT *  FROM    register    order by fullname  asc ");
	  	    $cli=$i%2;
		if($cli=="0")  {$cli="#F0D2FF" ;  } else {    $cli="#FFFFFF" ;   }
	    ?>
    <tr bgcolor="<?php echo "$cli"; ?>" > 
      <td align="center"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?=($offset + $i);?>
        .</font></td>
      <td height="21"  ><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          <? print $result_data[fullname];?> </font></div></td>
      <td> <div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp; 
          <?php  if($result_data[status]=="1"  and  $result_data[status]!="99") { echo "<font color=#DD0BB0>สามารถใช้งานได้แล้ว</font>";} else { echo "<font color=#FF0000>รอผู้ดูแลระบบดำเนินการ</font>";}?>
          </font></div></td>
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

echo   "<a href='index.php?case_i=1&offset=$prevoffset&txt_search=$txt_search'>
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
                  echo  "<a href='index.php?case_i=1&offset=$newoffset&txt_search=$txt_search' 
                   onMouseOver=\"window.status='Page $i'; return true\";><font  color=\"black\">$i</font></a>\n\n"; 
        } 
    } 

    // Check to see if current page is last page 
   if (!((($offset/$limit)+1)==$pages) && $pages!=1) { 
        // Not on the last page yet, so display a NEXT Link 
        $newoffset=$offset+$limit; 
        echo   "<a href='index.php?case_i=1&offset=$newoffset&txt_search=$txt_search'>
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
<div align="right">
  <p>&nbsp;</p>
 
</div>
</body>
</html>
