<? 
  include("../include/chklogin.php");  
    include("../include/function.php");  
include("../Connections/dbconnect.php");
 

?>
<title>รายงานการใช้เว็บ</title>
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
.style4 {
	font-family: "Microsoft Sans Serif";
	font-size: 16px;
	font-weight: bold;
	color: #FF0000;
}
-->
</style>

<body bgcolor="#FFFFCC">
<?php
$date_view_select=$_POST[date_view];
if($date_view_select=="")  {  $date_view = date("Y-m-d");   }

if($web ==null) {$web="/lightsquid/"; }  
	if($date_view !=null   and  $txt_search ==null )  {       
		    $date = explode("-",$date_view) ;
            $YYYY = $date[0];
			$mm=$date[1];
			$dd=$date[2];
			
		$web="/lightsquid/day_detail.cgi?year=$YYYY&month=$mm&day=$dd";
			}
  if($date_view !=null   and  $txt_search !=null )  {       
		    $date = explode("-",$date_view) ;
            $YYYY = $date[0];
			$mm=$date[1];
			$dd=$date[2];
			
		$web="/lightsquid/user_detail.cgi?year=$YYYY&month=$mm&day=$dd&user=$txt_search";
		}	
            
?>
<table width="800" border="1" align="center">
  <tr> 
    <td bgcolor="#FFFFFF"><form name="form1" method="post" action="squid.php">
        <div align="right"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">แสดงรายงานการเข้าเว็บของ 
          โปรดใส่ IP &nbsp;&nbsp; </font> </strong> 
          <input name="txt_search" type="text" value="<?=$txt_search;?>" size="15">
          <strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">โดยค้นหาจากวันที่</font></strong> 
          <input name="date_view" type="text" value=""  id="date_view" onClick="showCalendar('date_view','YYYY-MM-DD')" size="20"   readonly="yes" >
          <input type="submit" name="Submit" value="  ค้นหา  ">
        </div>
      </form></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">
	<form name="form1009" method="post" action="list_user_logl.php"  target="_blank">
        <div align="right"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ค้นหาว่าใครเป็นผู้ใช้ 
          ip 
          <input type="text" name="txt_search">
          </strong> 
          <input name="ค้นหา" type="submit"  id="submit" value="ค้นหา">
          </font></div>
      </form></td>
  </tr>
    <tr> 
    <td bgcolor="#CCFFFF"> <div align="center" class="style4"><a href="/lightsquid/" target="_blank">ดูหน้ารายงานสรุป</a> </div></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFF99"> <IFRAME name=lightsquid  ของคุณ src=<?php echo "$web"; ?>     width=800  height=1000  frameborder=0  scrolling=yes></IFRAME> 
    </td>
  </tr>
</table>
<div align="center"></div>
</body>
</html>
