<? 
  include("../include/chklogin.php");  
include("../Connections/dbconnect.php");
 mysql_select_db($database_edoc);  //  or trigger_error(mysql_error(),E_USER_ERROR);
include("../Connections/class.php");
include("class.php");
 if($delete=="1"   ) {
$tb="card";
 $idcard = htmlspecialchars("$idcard", ENT_QUOTES);
$pattern = '/;/i';
$replacement = NULL;
$idcard= preg_replace($pattern, $replacement, $idcard);
$sql = "delete from card where idcard='$idcard' and domain='$domain_name' " ;
mysql_select_db($database_edoc); mysql_query($sql)  or trigger_error(mysql_error(),E_USER_ERROR);
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
<form name="form1" method="post" action="index.php?case_i=39">
  <?
	
		//$condition = "  ";
		if(trim($txt_search)<>''){
		 $txt_search = htmlspecialchars("$txt_search", ENT_QUOTES);
$pattern = '/;/i';
$replacement = NULL;
$txt_search= preg_replace($pattern, $replacement, $txt_search);
			$condition = "   and    (   card.idcard      like'%$txt_search%'     or   card.UserName  like'%$txt_search%'     )   ";
		}
		if (empty($offset) || $offset < 0) { 
		   $offset=0; 
		} 
		//    Set $limit,  $limit = Max number of results per 'page' 
		if(!$limit){
			$limit = 100;
		}
		//    Set $totalrows = total number of rows that unlimited query would return 
		//    (total number of records to display across all pages) 
		$sql = "SELECT 
							  register.fullname,
							  card.*,
							  radcheck.Attribute,
							  radcheck.Value
                      FROM
                              card
  INNER JOIN register ON (card.UserName = register.UserName)
  INNER JOIN radcheck ON (card.UserName = radcheck.UserName)
                                          where  card.active='1' 
										  and card.domain='$domian_name'   
										   $condition  group  by   card.idcard  ";

		$query_data = $db->query($sql);  
		$rows = mysql_num_rows($query_data);
			// Set $begin and $end to record range of the current page 
		    $begin =($offset+1); 
		    $end = ($begin+($limit-1)); 
		    if ($end > $totalrows) { 
			   $end = $totalrows; 
		    } 
		$Show = $sql." ORDER BY   card.time_active  desc LIMIT $offset, $limit";
		$query_data = $db->query($Show);

?>
  <table width="85%" border="0" align="center" cellpadding="1" cellspacing="1"  class="imagetable">
    <tr bgcolor="#FFFFFF"> 
      <th height="30" colspan="8"> <div align="right"><strong>ค้นหารหัสบัตร</strong> 
          <input name="txt_search" type="text" value="<?=$txt_search;?>" size="40">
          <input type="submit" name="Submit" value="  ค้นหา  " class="styled-button-2"  >
        </div></th>
    </tr>
    <tr bgcolor="#CCFFCC"> 
      <th colspan="8"> <div align="center" class="style1 style2"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><strong>รายการบัตรที่ทำการ Active</strong></font></div></th>
    </tr>
    <tr bgcolor="#FFFFCC"> 
      <th width="5%"> <div align="center" class="style3"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ลำดับ</font></strong></div></th>
      <th width="16%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">หมายเลขบัตร</font></strong></th>
      <th width="10%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ชื่อ Login</font></strong></th>
      <th width="11%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">อยู่ในกลุ่ม</font></strong></th>
      <th width="13%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">วันที่สร้าง</font></strong></th>
      <th width="19%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">วันที่เติมเลขใช้งาน</font></strong></th>
      <th width="11%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">จำนวน</font></strong></th>
      <th width="15%" align="center"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ลบ</font></strong></div></th>
    </tr>
    <?
  if($rows<>0){
	  $i=1;
	  while($result_data = mysql_fetch_array($query_data)){
	   
	  	    $cli=$i%2;
		if($cli=="0")  {$cli="#AAD2FF" ;  } else {    $cli="#FFFFFF" ;   }
	    ?>
    <tr bgcolor="<?php echo "$cli"; ?>" > 
      <td height="21" align="center"> <font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?=($offset + $i);?>
        .</font></td>
      <td><div align="left"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
          &nbsp;&nbsp; 
          <?  print   $result_data[idcard];   ?>
          </font></div></td>
      <td><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">
        <?  print   $result_data[UserName];   ?>
      </font></div></td>
      <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?  print   $result_data[GroupName];   ?>
        </font></td>
      <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif">
        <?  print   $result_data[Time_build];   ?>
        </font></td>
      <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif">
        <?  print   $result_data[time_active];   ?>
      </font></td>
      <td><div align="right"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
    <?php    if($result_data[type_time]=="วัน")              {  print $result_data[date_end];  }  
		                if($result_data[type_time]=="ชั่วโมง")       {  $g=($result_data[date_end]/60)/60;   print $g;} 
						   if($result_data[type_time]=="นาที")       {  $g=($result_data[date_end]/60);   print $g;} 
                           ?>
          </font><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
          <?  print   $result_data[type_time];   ?>
          </font></div></td>
      <td><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=39&idcard=<?php echo $result_data[idcard] ;?>&delete=1"  onClick="return cdelete(this)"> <img src="dlete_xp_icon.png" width="35" height="35" border="0"> </a>
      </font></div></td>
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

echo   "<a href='index.php?case_i=39&offset=$prevoffset&txt_search=$txt_search'>
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
                  echo  "<a href='index.php?case_i=39&offset=$newoffset&txt_search=$txt_search'     >
				  <font  color=\"black\">$i</font></a>\n\n"; 
        } 
    } 

    // Check to see if current page is last page 
   if (!((($offset/$limit)+1)==$pages) && $pages!=1) { 
        // Not on the last page yet, so display a NEXT Link 
        $newoffset=$offset+$limit; 
        echo   "<a href='index.php?case_i=39&offset=$newoffset&txt_search=$txt_search'>
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
<p align="right">&nbsp;</p>
 
<div align="center"></div>
</body>
</html>
