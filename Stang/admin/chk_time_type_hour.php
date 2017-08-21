 
 <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
 <?php
extract($_POST);extract($_GET);extract($_REQUEST);
include("/var/www/html/mk/Connections/dbconnect.php");
include_once('/var/www/html/mk/admin/routeros_api.class.php'); //mikrotik api

 

function TimeDiff($UserName,$connect_db)
 { 
  $AcctStopTime=date("Y-m-d H:i:s");
 $query_Recordset1 = " select TIME_TO_SEC(TIMEDIFF('$AcctStopTime',AcctStartTime))  as ttc  FROM  radacct    where   UserName='$UserName'  and AcctStopTime='0000-00-00 00:00:00' ";
 
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_time= mysql_fetch_assoc($Recordset1);
return $row_time['ttc'];
 }

function chk_type_time($UserName,$connect_db){
  $query_Recordset1 = "SELECT   *   FROM radcheck  where   UserName='$UserName'  and Attribute='Max-All-Session' ";
 $Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_time= mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);


  $totalRows_Recordset1;
if( $totalRows_Recordset1 > 0  ){
return "ชั่วโมง";
} else {
return "วัน";
}

} //function chk_type_time




//ดึงจำนวนคนออนไลน์ ขณะนั้นขึ้นมา
$query_Recordset1 = "SELECT   *   FROM radacct  where   AcctStopTime='0000-00-00 00:00:00' ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

  do { 
   $row_Recordset1['UserName'];
$b= chk_type_time($row_Recordset1['UserName'],$connect_db) ;
     $UserName=$row_Recordset1['UserName'];
    
  $timeUser= TimeDiff($row_Recordset1['UserName'],$connect_db);
 print  $row_Recordset1['UserName']."==$timeUser \r\n";
 if($b=='ชั่วโมง'){
 //กรณีเป็นชั่วโมง ระบบ จะทำการเช็คว่า หมดอายุการใช้งาน หรือยัง
 $chk_Max_All_Session=mysql_query("SELECT  Value   FROM  radcheck     WHERE Attribute='Max-All-Session'  and UserName='$UserName' ", $connect_db) or die(mysql_error());
$row_All_Session= mysql_fetch_assoc($chk_Max_All_Session);
$totalMax_All_Session = mysql_num_rows($chk_Max_All_Session);  //จำนวนชั่วโมงการใช้งานของผู้ใช่ที่เล่นได้

//หาชั่วโมงการใช้งาน ที่เหลือของคนใช้
 	$AcctSessionTime_sql = "SELECT sum(AcctSessionTime) as tt  FROM  radacct     WHERE UserName='$UserName'   and   AcctStopTime <> '0000-00-00 00:00:00'  ";
   
	$AcctSessionTime_sql_db = mysql_query($AcctSessionTime_sql, $connect_db) or die(mysql_error());
	$row_setingz= mysql_fetch_assoc($AcctSessionTime_sql_db);
	$User_use_internet=$row_setingz[tt]+ $timeUser;  //เวลาทั้งหมดที่เล่นไปแล้ว
	
	$AcctSessionTime_sql = "SELECT *  FROM  radacct     WHERE UserName='$UserName'   and   AcctStopTime='0000-00-00 00:00:00' order by  RadAcctId desc ";
	$AcctSessionTime_sql_db = mysql_query($AcctSessionTime_sql, $connect_db) or die(mysql_error());
	$row_setingz= mysql_fetch_assoc($AcctSessionTime_sql_db);
	
//ถ้าหมดเวลาก็บังคับเค้าออกจากเน็ตเลย	
/*
$totalMax_All_Session เวลาที่ระบบ กำหนดไว้
$User_use_internet  เวลาที่ผู้ใช้เล่น
*/
if($totalMax_All_Session < $User_use_internet){
$userid=$UserName;
$ipclient=$row_setingz[FramedIPAddress];

$query_nas = "SELECT   *   FROM mikrotik_link  where   status='1'  ";
$nasqr = mysql_query($query_nas, $connect_db) or die(mysql_error());
$row_nas = mysql_fetch_assoc($nasqr);
  do {
 $ipnas=$row_nas[ip_vpn];
 
$API = new routeros_api();
$API->debug = false;
$API->connect($ipnas,'web' ,'010464088' );
$ARRAY = $API->comm("/ip/hotspot/active/print" );
  $inum= count ( $ARRAY );
    for ($i = 0; $i <= $inum+100; ) { 
	print $ARRAY[$i]['user'];   print "\r\n";
					  if($ARRAY[$i]['user']==$userid){
				                 	$a= '/bin/echo  "User-Name='.$userid.',Framed-IP-Address='.$ipclient.'" | /usr/bin/radclient -x '.$ipnas.':3799 disconnect  tlogsystem ';
					               print $a;
					                   print "\r\n";
                                      system($a, $retval); 
	 					  
									  //พอดีดแล้วก็ทำการ  แอดหมดอายุการใช้งานเค้าซะ
		mysql_query("delete   from   radcheck  where  UserName='$UserName'     and  Attribute='Expiration'  ", $connect_db) or die(mysql_error());
        mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)   values('$UserName','Expiration',':=','5 Mar 2008 01:00:00')", $connect_db) or die(mysql_error());
		mysql_query("delete   from   radcheck  where  UserName='$UserName'     and  Attribute='Max-All-Session'  ", $connect_db) or die(mysql_error());
		mysql_query("update       radacct  set AcctSessionTime='0'  where  UserName='$UserName'        ", $connect_db) or die(mysql_error());
$stop_time=date("Y-m-d H:i:s");
mysql_query( "update  radacct  set AcctStopTime  ='$stop_time'  , AcctTerminateCause='หมดเวลาเล่นแบบชั่วโมง' where   UserName='$UserName'   and  
( AcctStopTime='0000-00-00 00:00:00'  or AcctStopTime=''   or AcctStopTime=NULL ) ");


																		 }
	print "$ipnas  $i";			   print "\r\n";														 
   $i=$i+1;                                          
} //for

  $API->disconnect();
   unset($API);
 } while ($row_nas = mysql_fetch_assoc($nasqr));


 
}


 }
  } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  
  
  ?>