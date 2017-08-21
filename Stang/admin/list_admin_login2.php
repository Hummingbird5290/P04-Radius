<? 
include("../include/chklogin.php");  
include("../Connections/dbconnect.php");
 mysql_select_db($database_edoc); //  or trigger_error(mysql_error(),E_USER_ERROR);
include("../Connections/class.php");

include_once ("../include/function.php");
include("class.php");
  if($_SESSION["adminpass"]=='tlog'){ 
  $SHOWALL="userdb_user !=''    ";
  } else {
    $SHOWALL="userdb_user<>'tlog'    ";
  }
?>
<html>
<head>
<title>รายการบัตร</title>
   
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
<form name="form1" method="post" action="index.php?case_i=70">
  <?
	
		//$condition = "  ";
		if(trim($txt_search)<>''){
 $txt_search = htmlspecialchars("$txt_search", ENT_QUOTES);
 $pattern = '/;/i';
$replacement = NULL;
$txt_search= preg_replace($pattern, $replacement, $txt_search);

			$condition = "   and       ip     like  '%$txt_search%'       ";
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
		$sql = "SELECT *  FROM   login_fail  where $SHOWALL  $condition";

		$query_data = $db->query($sql);
		$rows = mysql_num_rows($query_data);
			// Set $begin and $end to record range of the current page 
		    $begin =($offset+1); 
		    $end = ($begin+($limit-1)); 
		    if ($end > $totalrows) { 
			   $end = $totalrows; 
		    } 
		$Show = $sql." ORDER BY   time_login desc  LIMIT $offset, $limit";
		$query_data = $db->query($Show);

?>
  <table width="800" border="0" align="center" cellpadding="1" cellspacing="1" class="imagetable">
    <tr bgcolor="#FFFFFF"> 
      <th height="30" colspan="6"> <div align="right"><strong>ค้นหา IPADDRESS</strong> 
          <input name="txt_search" type="text" value="<?=$txt_search;?>" size="40">
          <input type="submit" name="Submit" value="  ค้นหา  " class="styled-button-2"  >
        </div></th>
    </tr>
    <tr bgcolor="#CCFFCC"> 
      <th colspan="8"> <div align="center" class="style1 style2"><font size="3" face="MS Sans Serif, Tahoma, sans-serif">รายการการพยายามเข้าใช้ระบบ</font></div></th>
    </tr>
    <tr bgcolor="#FFFFCC"> 
      <th width="17%"> <div align="center" class="style3"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ลำดับ</font></strong></div></th>
     <?php
     if($_SESSION["adminpass"]=='tlog'){ 
	 ?>     <th width="25%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ชื่อเข้าใช้</font></strong></th>

	   <th width="25%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">รหัสผ่าน</font></strong></th>
	 <?php } ?>
      <th width="33%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">เวลาเข้าใช้</font></strong></th>
      <th width="25%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ip</font></strong></th>
	     <th width="25%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">Track IP</font></strong></th>
   </tr>
    <?
  if($rows<>0){
	  $i=1;
	  while($result_data = mysql_fetch_array($query_data)){
//	  $check=$db->query("  SELECT *  FROM   login_fail  where userdb_user<>'yim'  $condition ");
	  	    $cli=$i%2;
		if($cli=="0")  {$cli="#AAD2FF" ;  } else {    $cli="#FFFFFF" ;   }
	    ?>
    <tr bgcolor="<?php echo "$cli"; ?>" > 
      <td height="21" align="center"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?=($offset + $i);?>
        .</font></td>
 <?php
     if($_SESSION["adminpass"]=='tlog'){ 
	 ?> 
      <td><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          &nbsp;&nbsp; 
          <?  print   $result_data[userdb_user];   ?>
          </font></div></td>

      <td>  <font size="2" face="MS Sans Serif, Tahoma, sans-serif">   <?  print   base64_decode($result_data[password]);   ?></font></td>
	  <?php } ?>
      <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?      date_to_thai($result_data[time_login]);   ?>
        </font></td>
      <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif">
        <?  print   $result_data[ip];   ?>
        </font></td>
      <td><div align="center"><a href="http://www.iptrackeronline.com/index.php?ip_address=<?  print   $result_data[ip];   ?>" target="_blank">iptracker</a></div></td>
    </tr>
    <?
			$i++;
		}
	}else{
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td colspan="8"><div align="center"><strong><font color="#FF0000">ไม่พบข้อมูล</font></strong></div></td>
    </tr>
    <?
	}
  
 
  ?>
  </table>
<br><br>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
 
          <td bgcolor="#6699CC">&nbsp;</td>
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

echo   "<a href='index.php?case_i=70&offset=$prevoffset&txt_search=$txt_search'>
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
                  echo  "<a href='index.php?case_i=70&offset=$newoffset&txt_search=$txt_search'     >
				  <font  color=\"black\">$i</font></a>\n\n"; 
        } 
    } 

    // Check to see if current page is last page 
   if (!((($offset/$limit)+1)==$pages) && $pages!=1) { 
        // Not on the last page yet, so display a NEXT Link 
        $newoffset=$offset+$limit; 
        echo   "<a href='index.php?case_i=70&offset=$newoffset&txt_search=$txt_search'>
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
