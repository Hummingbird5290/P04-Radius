<? 
  include("../include/chklogin.php");  
include("../Connections/dbconnect.php");
function date_to_thai_returnx($date_en)
{
     $date_thai_day = date('d',strtotime($date_en));
	 $date_thai_mont = date('m',strtotime($date_en));
	 $date_thai_year = date('Y',strtotime($date_en));
	 $date_thai_time = date('H:i',strtotime($date_en));
$date_thai_year =$date_thai_year +543;

if($date_thai_mont=="1"){ 	$date_thai_mont="�.�."; }
if($date_thai_mont=="2"){ 	$date_thai_mont="�.�."; }
if($date_thai_mont=="3"){ 	$date_thai_mont="��.�."; }
if($date_thai_mont=="4"){ 	$date_thai_mont="��.�."; }
if($date_thai_mont=="5"){ 	$date_thai_mont="�.�."; }
if($date_thai_mont=="6"){ 	$date_thai_mont="��.�."; }
if($date_thai_mont=="7"){ 	$date_thai_mont="�.�."; }
if($date_thai_mont=="8"){ 	$date_thai_mont="�.�."; }
if($date_thai_mont=="9"){ 	$date_thai_mont="�.�."; }
if($date_thai_mont=="10"){ 	$date_thai_mont="�.�."; }
if($date_thai_mont=="11"){ 	$date_thai_mont="�.�."; }
if($date_thai_mont=="12"){ 	$date_thai_mont="�.�."; }
	 
$time_thai=" $date_thai_day  $date_thai_mont  $date_thai_year   ";
return $time_thai;
}
 
 mysql_select_db($database_edoc); //  or trigger_error(mysql_error(),E_USER_ERROR);
include("../Connections/class.php");
include("class.php");
 if($delete=="1"   ) {
$tb="card";
		 $idcard = htmlspecialchars("$idcard", ENT_QUOTES);
		 $pattern = '/;/i';
$replacement = NULL;
$idcard= preg_replace($pattern, $replacement, $idcard);

$sql ="delete  from  card  where idcard='$idcard'  and  domain='$domian_name'  ";
  mysql_select_db($database_edoc); mysql_query($sql)   or trigger_error(mysql_error(),E_USER_ERROR);
}
?>
<html>
<head>
<title>��¡�úѵ�</title>
   
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
<form name="form1" method="post" action="index.php?case_i=38">
  <?
	
		//$condition = "  ";
		if(trim($txt_search)<>''){
		 		 $txt_search = htmlspecialchars("$txt_search", ENT_QUOTES);
		 $pattern = '/;/i';
$replacement = NULL;
$txt_search= preg_replace($pattern, $replacement, $txt_search);
			$condition = "   and       idcard      like'%$txt_search%'       ";
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
		$sql = "SELECT *  FROM   card    where   active='0'  and  domain='$domian_name' $condition";

		$query_data = $db->query($sql);
		$rows = mysql_num_rows($query_data);
			// Set $begin and $end to record range of the current page 
		    $begin =($offset+1); 
		    $end = ($begin+($limit-1)); 
		    if ($end > $totalrows) { 
			   $end = $totalrows; 
		    } 
		$Show = $sql." ORDER BY   No  LIMIT $offset, $limit";
		$query_data = $db->query($Show);

?>
  <table width="850" border="0" align="center" cellpadding="1" cellspacing="1"  class="imagetable">
    <tr bgcolor="#FFFFFF"> 
      <th height="30" colspan="7"> <div align="right"><strong>�������ʺѵ�</strong> 
          <input name="txt_search" type="text" value="<?=$txt_search;?>" size="40">
          <input type="submit" name="Submit" value="  ����  " class="styled-button-2"  >
        </div></th>
    </tr>
    <tr bgcolor="#CCFFCC"> 
      <th colspan="7"> <div align="center" class="style1 style2"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><strong>��¡�úѵ÷���ѧ����ա����ҹ</strong></font></div></th>
    </tr>
    <tr bgcolor="#FFFFCC"> 
      <th width="7%"> <div align="center" class="style3"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">�ӴѺ</font></strong></div></th>
      <th width="19%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">�����Ţ�ѵ�</font></strong></th>
      <th width="18%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">����㹡����</font></strong></th>
      <th width="19%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">�ѹ������ҧ</font></strong></th>
      <th width="14%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">�ѹ�������</font></strong></th>
      <th width="11%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">�ӹǹ</font></strong></th>
      <th width="12%" align="center"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ź</font></strong></div></th>
    </tr>
    <?
  if($rows<>0){
	  $i=1;
	  while($result_data = mysql_fetch_array($query_data)){
	  
	  	    $cli=$i%2;
		if($cli=="0")  {$cli="#AAD2FF" ;  } else {    $cli="#FFFFFF" ;   }
	    ?>
    <tr bgcolor="<?php echo "$cli"; ?>" > 
      <td height="21" align="center"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?=($offset + $i);?>
        .</font></td>
      <td><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          &nbsp;&nbsp; 
          <?  print   $result_data[idcard];   ?>
          </font></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?  print   $result_data[GroupName];   ?>
      </font></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        
        <?php  print  date_to_thai_returnx($result_data['Time_build']);?>
      </font></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        
        <?php  print date_to_thai_returnx($result_data['time_death']);?>
      </font></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          <?php if($result_data[type_time]=="�ѹ")              {  print $result_data[date_end];  }  
		                if($result_data[type_time]=="�������")       {  $g=($result_data[date_end]/60)/60;   print $g;} 
						   if($result_data[type_time]=="�ҷ�")       {  $g=($result_data[date_end]/60);   print $g;}  ?>
         
          <?  print   $result_data[type_time];   ?>
          </font></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=38&idcard=<?php echo $result_data[idcard] ;?>&delete=1" onClick="return cdelete(this)"><img src="dlete_xp_icon.png" width="35" height="35" border="0"> </a></font></div></td>
    </tr>
    <?
			$i++;
		}
	}else{
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td colspan="7"><div align="center"><strong><font color="#FF0000">��辺������</font></strong></div></td>
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
            <strong>˹�ҷ��</strong> <?php
// Begin Prev/Next Links 
// Don't display PREV link if on first page 
if ($offset !=0) {   
$prevoffset=$offset-$limit; 

echo   "<a href='index.php?case_i=38&offset=$prevoffset&txt_search=$txt_search'>
<font  color=\"red\"><< ��͹˹��</font></a>\n\n";
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
                  echo  "<a href='index.php?case_i=38&offset=$newoffset&txt_search=$txt_search'     >
				  <font  color=\"black\">$i</font></a>\n\n"; 
        } 
    } 

    // Check to see if current page is last page 
   if (!((($offset/$limit)+1)==$pages) && $pages!=1) { 
        // Not on the last page yet, so display a NEXT Link 
        $newoffset=$offset+$limit; 
        echo   "<a href='index.php?case_i=38&offset=$newoffset&txt_search=$txt_search'>
		  <font  color=\"red\">�Ѵ�>></font></a>\n"; 
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
