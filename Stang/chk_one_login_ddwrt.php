 <?
 @session_start(); 
  header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header ("Cache-Control: no-cache, must-revalidate");
  header ("Pragma: no-cache");
  
  header("content-type: application/x-javascript; charset=utf-8");
  extract($_POST);extract($_GET);extract($_REQUEST);
   ini_set('date.timezone ', 'Asia/Bangkok');
  #########################################################
 
 if($_SESSION["langs"]=='') {
$_SESSION["langs"]="th.php";
} 
$ll=$_SESSION["langs"];

include("lang/$ll");

?>
<style type="text/css">
<!--
.timelogin {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #FF00AA;
}
-->
</style>
<?
  include("include/function.php");
  
     $SERVERNAMES= '192.168.182.1';

function UDataCHK($name,$connect_db) {
global  $ll;
 include("lang/$ll");
     mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
	
$query_Max = "SELECT  *  from radcheck  where   UserName ='$name'  and Attribute='Expiration'   ";
 $Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
  
$times=$row_Max[Value];




$query_sum_t = "
SELECT 
sum(card.date_end) as tcard
FROM
  table_card_user
  INNER JOIN card ON (table_card_user.idcard = card.idcard)
  
  where   card.UserName='$name'   
                   and  table_card_user.active='0'   ";
$user_time_end = mysql_query($query_sum_t, $connect_db) or die(mysql_error());
$row_tt_time= mysql_fetch_assoc($user_time_end);
### ดึงเวลาหมดอายุในระบบมาเพื่อ แจ้ง user
$date_dbs=$row_tt_time[tcard];
    #ทำการแยกวันที่ เวลา จากตัวแปร  $date_db มาเป็น array
			  $a_time= explode(" ",$times) ;
			  $a_time[0];  //วัน
			 $a_time[1];  //เดือน
			  $a_time[2];  //ปี
		  #แปลง เดือน เป็น ตัวเลข 
			 $a_time[1]=re_name($a_time[1]);
			 $date_db="$a_time[0]-$a_time[1]-$a_time[2]";

$dds1= explode("-",$date_db) ;
if($date_dbs=='') { $ttiomes='' ;} else {  $ttiomes="$text42"; /* "<br>และที่เติมใหม่อีก  $date_dbs วัน ที่ยังไม่ใช้งาน"; */  }
$dds2 ="    $dds1[0]/$dds1[1]/$dds1[2]  $text43  $ttiomes"; /*"    $dds1[0]/$dds1[1]/$dds1[2]  (วัน/เดือน/ปี)  $ttiomes"; */
return  $dds2;
}
  //ฟังชั่นคำนวนเวลา
//

function dateDiv($t1,$t2){ // ส่งวันที่ที่ต้องการเปรียบเทียบ ในรูปแบบ มาตรฐาน 2006-03-27 21:39:12
global  $ll;
 include("lang/$ll");
 
    $t1Arr=splitTime($t1);
    $t2Arr=splitTime($t2);
   
    $Time1=mktime($t1Arr["h"], $t1Arr["m"], $t1Arr["s"], $t1Arr["M"], $t1Arr["D"], $t1Arr["Y"]);
    $Time2=mktime($t2Arr["h"], $t2Arr["m"], $t2Arr["s"], $t2Arr["M"], $t2Arr["D"], $t2Arr["Y"]);
    $TimeDiv=abs($Time2-$Time1);

    $Time["D"]=intval($TimeDiv/86400); //  จำนวนวัน
    $Time["H"]=intval(($TimeDiv%86400)/3600); // จำนวน ชั่วโมง
    $Time["M"]=intval((($TimeDiv%86400)%3600)/60); // จำนวน นาที
    $Time["S"]=intval(((($TimeDiv%86400)%3600)%60)); // จำนวน วินาที
 return $Time;
}

 

function splitTime($time){ // เวลาในรูปแบบ มาตรฐาน 2006-03-27 21:39:12
 $timeArr["Y"]= substr($time,2,2);
 $timeArr["M"]= substr($time,5,2);
 $timeArr["D"]= substr($time,8,2);
 $timeArr["h"]= substr($time,11,2);
 $timeArr["m"]= substr($time,14,2);
    $timeArr["s"]= substr($time,17,2);
 return $timeArr;
}




#############
    function getuserips()
{

   if (isset($_SERVER)) {

      if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
         return $_SERVER["HTTP_X_FORWARDED_FOR"];
      
      if (isset($_SERVER["HTTP_CLIENT_IP"]))
         return $_SERVER["HTTP_CLIENT_IP"];

      return $_SERVER["REMOTE_ADDR"];
   }

   if (getenv('HTTP_X_FORWARDED_FOR'))
      return getenv('HTTP_X_FORWARDED_FOR');

   if (getenv('HTTP_CLIENT_IP'))
      return getenv('HTTP_CLIENT_IP');

   return getenv('REMOTE_ADDR');
} 

######################################################

function getservername($macaddrss_server,$connect_db)
 {
// $macaddrss_server = strtolower($macaddrss_server);
//$macaddrss_server = str_replace("-",":" ,$macaddrss_server);

     mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
$query_sum_t = "  SELECT  server_name ,ip FROM   server   where   macaddress='$macaddrss_server'       ";
$user_time_end = mysql_query($query_sum_t, $connect_db) or die(mysql_error());
$row_tt_time= mysql_fetch_assoc($user_time_end);
return $row_tt_time[server_name];
	}

######################################################	
	
if($UserName==null){
exit();
}
include("Connections/dbconnect.php");


#ค้นหาไอพีเครื่อง
$AcctSessionTime_sql = "SELECT * FROM  radacct     WHERE UserName='$UserName' ORDER By RadAcctId desc   ";
$AcctSessionTime_sql_db = mysql_query($AcctSessionTime_sql, $connect_db) or die(mysql_error());
$row_setingz= mysql_fetch_assoc($AcctSessionTime_sql_db);
$meip=$row_setingz[FramedIPAddress];	

 

//$rec1Arr = explode('.', $meip);
//$SERVER_NAME=$rec1Arr[0].".".$rec1Arr[1].".".$rec1Arr[2].".1"; 
 $SERVER_NAME='192.168.182.1';
 
  $block_mac_sql = "SELECT UserName,CallingStationId,AcctStopTime,FramedIPAddress,CalledStationId
                                                                                                 FROM  radacct 
                                                                                                         WHERE UserName='$UserName'  
                                                                                                                              and    (   AcctStopTime = '0000-00-00 00:00:00'    
																															            or   AcctStopTime = ''  
																																		or   AcctStopTime = '0'  
																																		or   AcctStopTime = null  )  ";

$mac_db = mysql_query($block_mac_sql, $connect_db) or die(mysql_error());
$row_setingz= mysql_fetch_assoc($mac_db);
$totalRows_mac = mysql_num_rows($mac_db);
 
#ค้นหากลุ่มการใช้งาน
 $list_groups = "SELECT
radgroupreply.Attribute,
usergroup.UserName,
radgroupreply.Value,
radgroupreply.GroupName
FROM
usergroup
Inner Join radgroupreply ON usergroup.GroupName = radgroupreply.GroupName 
where radgroupreply.Attribute='WISPr-Bandwidth-Max-Down' 
and   usergroup.UserName='$UserName'
";
$groups_db = mysql_query($list_groups, $connect_db) or die(mysql_error());
$row_groupsDownload= mysql_fetch_assoc($groups_db);
 $MaxDownload=$row_groupsDownload[Value] / 1000;
if($MaxDownload > 1000){
$MaxDownload=$MaxDownload / 1000;
$MaxDownload= "$MaxDownload MiB";
}else 
{
$MaxDownload= "$MaxDownload KiB";
}
 /*
if($row_setingz['CallingStationId'] !=$mac)
{
 	print  "<IFRAME name=\"IFRAME\"   src=\"http://$SERVER_NAME:3990/logoff \"   width=\"300\" height=\"130\" frameborder=\"0\" scrolling=\"yes\"></IFRAME>";

 
}
 
 */				 


if(  $totalRows_mac  != "1" )
												{  
													 ##############  ´Õ´ user ÍÍ¡¨Ò¡à¹çµ ËÒ¡ à¤éÒµèÍÍÂ
													 
	 
	
 	print  "<IFRAME name=\"IFRAME\"   src=\"http://$SERVER_NAME:3990/logoff \"   width=\"300\" height=\"130\" frameborder=\"0\"   scrolling=\"yes\"></IFRAME>";

														

}  


 //ค้นหา เวลาหมดอายุ กรณี เป็นชั่วโมง
$chk_Max_All_Session=mysql_query("SELECT Value   FROM  radcheck     WHERE Attribute='Max-All-Session'  and UserName='$UserName' ", $connect_db) ;
$row_All_Session= mysql_fetch_assoc($chk_Max_All_Session);
$totalMax_All_Session = mysql_num_rows($chk_Max_All_Session);
 

if($totalMax_All_Session >0){



$AcctSessionTime_sql1 = "SELECT  AcctStartTime   FROM  radacct     WHERE UserName='$UserName'   order by RadAcctId desc   ";
$AcctSessionTime_sql_db1 = mysql_query($AcctSessionTime_sql1, $connect_db) or die(mysql_error());
$row_setingz1= mysql_fetch_assoc($AcctSessionTime_sql_db1);

$now_times=date("Y-m-d H:i:s");


$timess=dateDiv($row_setingz1[AcctStartTime],$now_times);


$AcctSessionTime_sql = "SELECT sum(AcctSessionTime) as tt  FROM  radacct     WHERE UserName='$UserName'     ";
$AcctSessionTime_sql_db = mysql_query($AcctSessionTime_sql, $connect_db) or die(mysql_error());
$row_setingz= mysql_fetch_assoc($AcctSessionTime_sql_db);



#ชั่วโมงใช้งาน  ที่เหลือ
$dayta_times=$row_All_Session[Value]-$row_setingz[tt]+$timess[S];
$dayta_times=$dayta_times/60;
$dayta_times=$dayta_times/60;
 
$dayta_times=round($dayta_times, 3);
##################
$bat_time= "$text44 $dayta_times   Hour/ชั่วโมง<br>"; /* "ท่านเหลือชั่วโมงใช้งาน  $dayta_times   ชั่วโมง<br>"; */

 if( ($row_setingz[tt]+$timess[S])  >   $row_All_Session[Value] )
 {
	    mysql_query("delete   from   radcheck  where  UserName='$UserName'     and  Attribute='Expiration'  ") ;
		mysql_query("delete   from   radcheck  where  UserName='$UserName'     and  Attribute='Max-All-Session'  ") ;
		mysql_query("update       radacct  set AcctSessionTime='0'  where  UserName='$UserName'        ") ;
	    mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)   values('$UserName','Expiration',':=','5 Mar 2008 01:00:00')");
		                       

  	print  "<IFRAME name=\"IFRAME\"   src=\"http://$SERVER_NAME:3990/logoff \"   width=\"300\" height=\"130\" frameborder=\"0\"  scrolling=\"yes\"></IFRAME>";
 }
 
 
 //ทำการดึงค่าเวลา ที่ใช้ทั้งหมด มาคำนวน เพื่อกัน การใช้โมดูล Max-All-Session ผิดพลาด
//ดึงเวลา

$select_sql = "SELECT  sum(AcctSessionTime) as alltime FROM  radacct       WHERE UserName='$UserName'    
                                        and ( AcctSessionTime !=''  and  AcctSessionTime !='0'    ) ";
$select_sql_db = mysql_query($select_sql, $connect_db) or die(mysql_error());
$row_select_sql= mysql_fetch_assoc($select_sql_db);
$alltime=$row_select_sq[a];


$select_sql = "SELECT  *  FROM  radacct       WHERE UserName='$UserName'    
                                        and ( AcctStopTime =''  or  AcctStopTime ='0'  or  AcctStopTime ='0000-00-00 00:00:00' ) ";
$select_sql_db = mysql_query($select_sql, $connect_db) or die(mysql_error());
$row_select_sql= mysql_fetch_assoc($select_sql_db);

$date_now=date('Y-m-d H:i:s');
$cal_date= (strtotime($row_select_sql[AcctStartTime]) - strtotime($date_now) ) / ( 60 * 60 * 24 );
 
$cal_date=$alltime+$cal_date; //เวลาที่ใช้ทั้งหมด เป็นวินาที

if($row_All_Session[Value]<$cal_date)   //หากเวลาในระบบ น้อยกว่าเวลาที่ใช้ให้เด้งออก
{
	    mysql_query("delete   from   radcheck  where  UserName='$UserName'     and  Attribute='Expiration'  ") ;
		mysql_query("delete   from   radcheck  where  UserName='$UserName'     and  Attribute='Max-All-Session'  ") ;
		mysql_query("update       radacct  set AcctSessionTime='0'  where  UserName='$UserName'        ") ;
	    mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)   values('$UserName','Expiration',':=','5 Mar 2008 01:00:00')");
		                        
 	     print  "<IFRAME name=\"IFRAME\"   src=\"http://$SERVERNAMES:3990/logoff \"   width=\"300\" height=\"130\" frameborder=\"0\"  scrolling=\"yes\"></IFRAME>";
}else

{
//ทำการแยก เวลา ออกมา แปลงเป็นวินาที
 $date_nows=date('Y-m-d H:i:s', strtotime("+$alltime secs"));
//date('s',$alltime)
$rty= (strtotime($date_nows) - strtotime($row_select_sql[AcctStartTime]) );

list($db_year, $db_time) = explode(" ", $row_select_sql[AcctStartTime]);
list($db_h, $db_i,$db_s) = explode(":", $db_time);

if($db_h==date('H')){  $rty=date('i:s',$rty);  } else {  $a=date('H')-$db_h; $rty="$a:".date('i:s',$rty); }

//  $bat_time="$UserName=".$row_select_sql[AcctStartTime];

 $bat_time= "Count time $rty  Minute  <br>";  //บัตรที่ท่านกำลังใช้งานอยู่จะหมดอายุวันที่
}
  

//$ssThame= $timess[S]+$totalMax_All_Session/60;
//print "if( ($row_setingz[tt]+$timess[S])  <   $row_All_Session[Value] )";
} 

											
 
$ser_ip=getservername($row_setingz['CalledStationId'],$connect_db);


$showbm_sql = "SELECT showbm    FROM  seting         ";
$showbm_sql_db = mysql_query($showbm_sql, $connect_db) or die(mysql_error());
$row_showbm_sql= mysql_fetch_assoc($showbm_sql_db);


print '<center><table><tr><td bgcolor=FFFFFF><center><span class="timelogin">';
print "You IP address=".$meip."<br>";
print  $bat_time;

if($row_showbm_sql[showbm]==1) {print "$text46 <br> <b>$MaxDownload   </b>";}

print "</span></center></td></tr></table></center>   ";	


mysql_close($connect_db);
?>
 
