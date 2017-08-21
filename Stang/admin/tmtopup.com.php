 <?php
header("Content-type: text/html; charset=tis-620");
extract($_POST);extract($_GET);extract($_REQUEST);
require_once('AES.php');
include("../include/function.php");
// กำหนด API Passkey
define('API_PASSKEY', 'tlogsystem2001');
//tmtopup.com.php?request=_b9hO9l999-aGEMpsNaFRt4ka5ZjDZU2Qjtkq-mXzKXyujsSZn-fn0DPK2E-HU1YaJCit2_IXFpSkKlkJzrT-oi0OBXc0Yj8Pie2uMXQc0Ymqn7L8737LqmodfWOsnHGFopKk9qUeOy2LSVKX-Nd6_D_x5ReU0WHZ-r-535vU5PM5NGnkY2EQAMK30gEatf_CbcUsCRAqpz97KgtAN_GzamBnpgVoceY-b0Q-Du2YSvLJ7C3hVGi_vz3OD0iF2HvJ_Xr0tR7P-GdDAEFNm5g


if($_SERVER['REMOTE_ADDR'] == '203.146.127.115' && isset($_GET['request']))
//if(  isset($_GET['request']))
{
    $aes = new Crypt_AES();
    $aes->setKey(API_PASSKEY);
    $_GET['request'] = base64_decode(strtr($_GET['request'], '-_,', '+/='));
    $_GET['request'] = $aes->decrypt($_GET['request']);
    if($_GET['request'] != false)
    {
        parse_str($_GET['request'],$request);
        $request['Ref1'] = base64_decode($request['Ref1']);
		
              $IP =$request['client_ip'];
	  	$uid=  base64_decode($request['Ref2']);
	  	$tels= base64_decode($request['Ref3']);
		 $money_total=$request['cardcard_amount'] ;
  $idcard=$request['cardcard_password'];
 
		$pattern = '/ /i';
$replacement = NULL;
$tels= preg_replace($pattern, $replacement, $tels);
		$pattern = '/-/i';
$replacement = NULL;
$tels= preg_replace($pattern, $replacement, $tels);




$hostname_edoc = "127.0.0.1";
$database_edoc = "radius";
$username_edoc = "root";
$password_edoc = "System2002";

$connect_db= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc);
mysql_select_db($database_edoc, $connect_db)  or trigger_error(mysql_error(),E_USER_ERROR);
    mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
 
        // เริ่มต้นการทำงานของระบบของท่าน
     
      // mysql_query('UPDATE users SET balance=balance+' . $request['cardcard_amount'] . ' WHERE username=\' . $request['Ref1'] . '\')
   if($_SESSION["adminpass"] ==NULL ){
$SMSSQL = " SELECT   link_name_config  from mikrotik_link   where gobal_ip='$IP'    ";
$Recordsetsms= mysql_query($SMSSQL, $connect_db) or die(mysql_error());
$row_sms = mysql_fetch_assoc($Recordsetsms);
$identity=$row_sms['link_name_config'];
}else 
{
$identity='admin_save';
}    

$query_Recordset1 = "SELECT   *   FROM register  where   UserName='$uid' ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
  $domain_name=$row_Recordset1['domain'];

$query_Recordset1 = "SELECT   *   FROM truemonet_setup  where   domain='$domain_name' ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
				$query_time= "select  *  from radcheck      where UserName='$uid'   and Attribute='Expiration'              ";
				$type_time = mysql_query($query_time, $connect_db) or die(mysql_error());
				$row_time_db = mysql_fetch_assoc($type_time);
				$date_db=$row_time_db[Value];
								#ทำการแยกวันที่ เวลา จากตัวแปร  $date_db มาเป็น array
				$a_time= explode(" ",$date_db) ;
				$a_time[0];  //วัน
				$a_time[1];  //เดือน
				$a_time[2];  //ปี
				#แปลง เดือน เป็น ตัวเลข
				$a_time[1]=re_name($a_time[1]);
				$date_db="$a_time[2]-$a_time[1]-$a_time[0]";
				$date_now=date("Y-m-d");
				$cal_date=(strtotime($date_now) - strtotime($date_db) ) / ( 60 * 60 * 24 );
				$cal_date2=(strtotime($date_db) - strtotime($date_now) ) / ( 60 * 60 * 24 );
				#ถ้า $cal_date  > 0  ต้องเอาผลต่างมาบวก เพื่อเพิ่มวัน แต่ ถ้า < 0 ก็แค่เพิ่มวัน register ไป
				#กรณียังมีวันเหลือในฐานข้อมูล แต่ซื้อเงินมาเติมวันเพิ่ม
  if($money_total=='50')			{  $H_end= $row_Recordset1[d50];  }		 if($money_total > '40')    {  $H_end= $row_Recordset1[d50];  }	
 if($money_total=='90')			{  $H_end= $row_Recordset1[d90];  }		 if($money_total > '80')    {  $H_end= $row_Recordset1[d90];  }		
 if($money_total=='150')			{  $H_end= $row_Recordset1[d150];  }      if($money_total > '120')   {  $H_end= $row_Recordset1[d150];  }		
 if($money_total=='300')			{  $H_end= $row_Recordset1[d300];  }		 if($money_total > '280')   {  $H_end= $row_Recordset1[d300];  }	

					###### ลบฟิว  ของ จำนวนชั่วโมงทิ้ง
					mysql_query("delete   from   radcheck  where  UserName='$uid'     and  Attribute='Max-All-Session'  ") ;
					###### ลบฟิว  ของ จำนวนวันทิ้ง
					mysql_query("delete   from   radcheck  where  UserName='$uid'     and  Attribute='Expiration'  ") ;
					#ดึงเวลาปัจจุบันมา เพื่อ กำหนดวันสุดท้ายที่จะใช้ระบบได้
					$date_add_db=date('Y-m-d', mktime(0,0,0, date('m'),date('d')+ $H_end,date('Y')));
					#แปลงวันที่ให้อยู่ในรูป radius
					$radius_time= explode("-",$date_add_db) ;
					$radius_time[2];  //วัน
					$radius_time[1];  //เดือน
					$radius_time[0];  //ปี
			 		$date_add_db2=re_name2($radius_time[1]);
					$Hourts=date("H:i:s");
					$date_add_db="$radius_time[2] $date_add_db2 $radius_time[0] $Hourts";
					$H_end=$row_Recordset1[date_end]*60*60;
			 		$H_end_times=$row_Recordset1[date_end];
					


mysql_query("update    usergroup   set   GroupName='Truemoney'  where UserName='$uid'    ")or    die ("Add ข้อมูลลง Table ไม่ได้ ");
mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)
								values('$uid','Expiration',':=','$date_add_db')")  	or    die ("Add ข้อมูลลง Table ไม่ได้ ");
													
$texts="ผู้ใช้งาน $uid เติมเลขบัตรทรู $idcard จำนวนเงิน $money_total   วันหมดอายุการใช้งาน คือ  $date_add_db ";

$b=date("Y-m-d H:i:s");
mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('$idcard', '$texts','$b'  ,'system','$domain_name' )") or trigger_error(mysql_error(),E_USER_ERROR);       		
			  
 $money_db=$money_total-($money_total*0.11);		  
 $b=date("Y-m-d H:i:s");
mysql_query("INSERT INTO  card_true  (UserName,date_add,idcard,domain,cost,TF,identity)
		      values('$uid','$b'  ,'$idcard','$domain_name','$money_db' ,'0','$identity')") or trigger_error(mysql_error(),E_USER_ERROR);   			  			
	 echo "<p><h4 style='color:green'>เรียบร้อย / Finish</h4></p>
		<p>จำนวนเงิน คือ $money_total บาท  /  Amount is $money_total THB</p>
		<p>ขอบคุณที่ใช้บริการครับ  / Thank you for using it.<br>
	         เรียบร้อยแล้ว วันหมดอายุการใช้งาน คือ  $date_add_db ! / Already The expiration date is $date_add_db!</p>";
			 echo "<br> ท่านสามารถกรอกรหัสผ่านเพื่อเข้าเล่นอินเตอร์เน็ตได้เลย <a href='http://www.google.co.th'> คลิก</a>";
		 
  			 
 $texts="ผู้ใช้งาน $uid เติมเลขบัตรทรู $idcard จำนวนเงิน $money_total   วันหมดอายุการใช้งาน คือ  $date_add_db ";


 
 
 

 $MAXSMS=  iconv('TIS-620', 'UTF-8'," WIFI  Login id $uid  วันหมดอายุการใช้งาน คือ  $date_add_db ");
 // $sms->send( "$SENDSMSNAME", '$tels', $MAXSMS);
  // กำหนด UID ของท่าน
define('UID', '31678');

// กำหนด API Token ของท่าน
define('TOKEN', '7ab89a13c207c05ddd801b379b09f8a4');

$postfields = 'uid=' . UID . '&token=' . TOKEN . '&msisdn='.$tels.'&message=' . rawurlencode($MAXSMS);

$curl = curl_init('https://www.tmtopup.com/sendsms_api.php');
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_TIMEOUT, 10);
curl_setopt($curl, CURLOPT_HEADER, FALSE);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($curl, CURLOPT_POST, TRUE);
curl_setopt($curl, CURLOPT_POSTFIELDS, $postfields);
$curl_content = curl_exec($curl);
curl_close($curl);

			 
        echo 'SUCCEED';
    }
    else
    {
        echo 'ERROR|INVALID_PASSKEY';
    }
}
else
{
    echo 'ERROR|ACCESS_DENIED';
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />