<? 
 include("../include/chklogin.php");    
include("../Connections/dbconnect.php");
include("../Connections/class.php");
include("class.php");
?>
<html>
<head>
<title>ชื่อผู้ใช้งานที่ lock ไว้</title>
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
<form name="form1" method="post" action="index.php?case_i=6">
  <?
	
		//$condition = "  ";
		if(trim($txt_search)<>''){
 
		  $txt_search = htmlspecialchars("$txt_search", ENT_QUOTES);
$pattern = '/;/i';
$replacement = NULL;
$txt_search= preg_replace($pattern, $replacement, $txt_search);
			$condition = "      and     (  fullname      like'%$txt_search%'   or  per   like'%$txt_search%' ) ";
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
		$sql = "SELECT *  FROM    register    where   status='88'  and domain='$domain_name'    $condition  group by  UserName";

		$query_data = $db->query($sql);
		$rows = mysql_num_rows($query_data);
			// Set $begin and $end to record range of the current page 
		    $begin =($offset+1); 
		    $end = ($begin+($limit-1)); 
		    if ($end > $totalrows) { 
			   $end = $totalrows; 
		    } 
		$Show = $sql."   LIMIT $offset, $limit";
		$query_data = $db->query($Show);

?>
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1"   class="imagetable">
    <tr bgcolor="#CCFFCC"> 
      <th height="30" colspan="6"> <div align="right"><strong>ค้นหารหัสบัตรประชาชน/ชื่อผู้ใช้งาน</strong> 
          <input name="txt_search" type="text" value="<?=$txt_search;?>" size="40">
          <input type="submit" name="Submit" value="  ค้นหา  " class="styled-button-2"  >
        </div></th>
    </tr>
    <tr bgcolor="#CCFFCC"> 
      <th colspan="6"> <div align="center" class="style1 style2"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><strong>ชื่อผู้ใช้งานที่ 
          lock ไว้</strong></font></div></th>
    </tr>
    <tr bgcolor="#FFFFCC"> 
      <th width="9%"> <div align="center" class="style3"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>ลำดับ</strong></font></div></th>
      <th width="26%" align="center"><strong><span class="style3"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">ชื่อ-นามสกุล</font></span></strong></th>
      <th width="19%" align="center" bgcolor="#FFFFCC"><strong><span class="style3"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">หมายเลขบัตรประชาชน</font></span></strong></th>
      <th width="21%" align="center"><strong><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><?php echo "$siteDB"; ?></font></strong></th>
      <th width="15%" align="center"><strong><font size="1" face="MS Sans Serif, Tahoma, sans-serif">ชื่อล๊อกอิน</font></strong></th>
      <th width="10%" align="center"><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>เปิดให้ใช้งาน</strong></font></div></th>
    </tr>
    <?
  if($rows<>0){
	  $i=1;
	  while($result_data = mysql_fetch_array($query_data)){
	  $check=$db->query("SELECT *  FROM    register        where   status='88'   group by  UserName  ");
	  	    $cli=$i%2;
		if($cli=="0")  {$cli="#F0D2FF" ;  } else {    $cli="#FFFFFF" ;   }
	    ?>
    <tr bgcolor="#FFFFFF" > 
      <td align="center"> <font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?=($offset + $i);?>
        .</font></td>
      <td height="21"  ><div align="left"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
          <a href="#search" onClick="newwindow=window.open('detail_user.php?id_edit=<? print $result_data[UserName];?>','detail_user','height=450,width=500,left=10,top=100,scrollbars=1');newwindow.focus();"> 
      <? print $result_data[fullname];?></a> </font></div></td>
      <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><? print $result_data[per];?> 
        </font></td>
      <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><? print $result_data[site];?></font></td>
      <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><? print $result_data[UserName];?></font></td>
      <td><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><a href="unlock_bad_user.php?pass=<?echo $result_data[password] ;?>&UserName=<?echo $result_data[UserName] ;?>"><img src="../images/icon_sturegis_small.gif" width="16" height="16" border="0"></a></font></div></td>
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
      <td colspan="6"><div align="center"><strong><font color="#FF0000">ไม่พบข้อมูล</font></strong></div></td>
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

echo   "<a href='index.php?case_i=6&offset=$prevoffset&txt_search=$txt_search'>
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
                  echo  "<a href='index.php?case_i=6&offset=$newoffset&txt_search=$txt_search'  >
				 <font  color=\"black\">$i</font></a>\n\n"; 
        } 
    } 

    // Check to see if current page is last page 
   if (!((($offset/$limit)+1)==$pages) && $pages!=1) { 
        // Not on the last page yet, so display a NEXT Link 
        $newoffset=$offset+$limit; 
        echo   "<a href='index.php?case_i=6&offset=$newoffset&txt_search=$txt_search'>
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
  <p><a href="index.php"><font color="#0000FF">กลับหน้าหลักผู้ดูแลระบบ</font></a> 
  </p>
 
</div>
</body>
</html>
