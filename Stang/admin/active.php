<?php
ob_start();
@session_start(); 
extract($_POST);extract($_GET);extract($_REQUEST);
//print_r($_SESSION);
/*
if($_SERVER['SERVER_PORT'] != 443) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    exit();

}
*/
if ($_SERVER['HTTP_CLIENT_IP']) {
$IP = $_SERVER['HTTP_CLIENT_IP'];
} elseif (preg_match("/[0-9]/",$_SERVER["HTTP_X_FORWARDED_FOR"] )) {
$IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else {
$IP = $_SERVER["REMOTE_ADDR"];
}
include("../Connections/dbconnect.php");
function re_date_radius_to_datedb($mounts)
{
  if($mounts=='Jan') { $num_rows="01"; }
  if($mounts=='Feb') { $num_rows="02"; } 
  if($mounts=='Mar') { $num_rows="03"; } 
  if($mounts=='Apr') { $num_rows="04"; } 
  if($mounts=='May') { $num_rows="05"; } 
  if($mounts=='Jun') { $num_rows="06"; } 
  if($mounts=='Jul') { $num_rows="07"; } 
  if($mounts=='Aug') { $num_rows="08"; } 
  if($mounts=='Sep') { $num_rows="09"; } 
  if($mounts=='Oct') { $num_rows="10"; } 
  if($mounts=='Nov') { $num_rows="11"; } 
  if($mounts=='Dec') { $num_rows="12"; } 
    return $num_rows;
}

//����� ip ����� mik ����˹
if($_SESSION[adminpass] ==''){
$SMSSQL = " SELECT   link_name_config  from mikrotik_link   where gobal_ip='$IP'    ";
$Recordsetsms= mysql_query($SMSSQL, $connect_db) or die(mysql_error());
$row_sms = mysql_fetch_assoc($Recordsetsms);
$identity=$row_sms['link_name_config'];
}else 
{
$identity='admin_save';
}


 include("sms.php");
 $SMSSQL = " SELECT   * from mikrotik_link where gobal_ip='$IP'    ";
$Recordsetsms= mysql_query($SMSSQL, $connect_db) or die(mysql_error());
$row_sms = mysql_fetch_assoc($Recordsetsms);
 $sms = new thsms();
$sms->username   = $row_sms[users];
$sms->password   = $row_sms[pass];


 $SENDSMSNAME='020000000';
 $domain_name=$_GET['domain_name'];
 if($_GET['domain_name']!=NULL){
 $_SESSION['domain_name']=$_GET['domain_name'];
 }
 if($_GET['domain'] !=NULL){
 $_SESSION['domain_name']=$_GET['domain'];
  }
 
  $domain_name=$_SESSION['domain_name'];
if($domain_name==''){
	echo                  "<script type=text/javascript>";
		echo                  "alert('��سҡ�͡�����Ţ�����������')";
		echo                  "</script>";
		echo "<meta http-equiv=refresh content=0;URL=http://www.yahoo.com>";
		exit();
} 
 

function randomToken($len) {
	srand( date("s") );
	#$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	//$chars ="ABCDEFGHIJKLMQRSTUVWXYZ";
	$chars = "123456789"; // ��˹��ѡ��з��й��� random �����
	$ret_str = "";
	$num = strlen($chars);
	for($i=0; $i < $len; $i++) {
		$ret_str.= $chars[rand()%$num]; // ��ѧ��� rand() ����Ҫ���㹡�÷ӧҹ
	}
	return $ret_str;
}
include("../include/function.php");
$date_active_card=date("Y-m-d H:i:s");

if($sumbit=='�������'   ) {
$idcard = htmlspecialchars("$idcard", ENT_QUOTES);
$per = htmlspecialchars("$per", ENT_QUOTES);

	$per = preg_replace("/ /i", "", $per);
	$idcard = preg_replace("/ /i", "", $idcard);
	
 $pattern = '/;/i';
$replacement = NULL;
$per= preg_replace($pattern, $replacement, $per);
$idcard= preg_replace($pattern, $replacement, $idcard);

	if($chk_num !=$code1) {
		echo                  "<script type=text/javascript>";
		echo                  "alert('��س� ��͡������ �����ѡ�Ҥ�����ʹ������ç�Ѻ�ٻ�Ҿ            ')";
		echo                  "</script>";
		echo "<meta http-equiv=refresh content=0;URL=active.php?domain_name=$domain_name&identity=$identity>";
		exit();
	}
	$time_active=date("H:i:s");

	if($per ==''  or $idcard=='' ) {
		echo                  "<script type=text/javascript>";
		echo                  "alert('��س� ��͡������ ���ú             ')";
		echo                  "</script>";
		echo "<meta http-equiv=refresh content=0;URL=active.php?domain_name=$domain_name&identity=$identity>";
		exit();
	}
/*
 if($per==NULL){
 				echo                  "<script type=text/javascript>";
		            echo                  "alert(' ����ժ��ͼ��������к� ')";
		             echo                  "</script>";	   
 			 echo "<meta http-equiv=refresh content=0;URL=active.php?domain_name=$domain_name&identity=$identity>";
	            	exit();
 }
 */
 $passwds=md5($passwds);
	$todates_chk=date("Y-m-d");  //and  domain='$domain_name'
	if($_SESSION[adminpass] ==''){
	$query_user = "select  * from register      where UserName='$per'    and  password='$passwds'  "; // and idcard  not in  (    select  idcard  from table_card_user   )       ";
	}else {
	$query_user = "select  * from register      where UserName='$per'   "; 
	}
	$type_db = mysql_query($query_user, $connect_db) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($type_db);
	
	$TEL=$row_Recordset1[tel];
	$pattern = '/-/i';
$replacement = NULL;
$TEL= preg_replace($pattern, $replacement, $TEL);
$pattern = '/ /i';
$replacement = NULL;
$TEL= preg_replace($pattern, $replacement, $TEL);

	$UserName=$row_Recordset1[UserName];
	
	if($UserName==''){
				echo                  "<script type=text/javascript>";
		            echo                  "alert(' ����ժ��ͼ��������к� ')";
		             echo                  "</script>";	   
 			 echo "<meta http-equiv=refresh content=0;URL=active.php?domain_name=$domain_name&identity=$identity>";
	            	exit();
	}  //
 	$query_user = "select  * from card      where idcard='$idcard'   and  domain='$domain_name'  "; // and idcard  not in  (    select  idcard  from table_card_user   )       ";
	$type_db = mysql_query($query_user, $connect_db) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($type_db);
	$totalRows_user= mysql_num_rows($type_db);
	$GroupName=$row_Recordset1['GroupName'];

//�ó� ����������Ţ�ѵüԴ�Թ ��Ҥ����к� ����ͤ �ʹռ����ҹ��駷ѹ��
$stop_time=date("Y-m-d");
$query_user_chk_login = "select  count(id) as t  from noute_data      where texts like '%���ͼ����  $UserName  ����Ţ�ѵüԴ%'  and  date_add='$stop_time'   "; 
$type_dblogon = mysql_query($query_user_chk_login, $connect_db) or die(mysql_error());
$row_chk_login = mysql_fetch_assoc($type_dblogon);

if($row_chk_login[t] == 4){	
 
///�� sms admin
 $texts="$domain_name: �к� ���ͤ �����ҹ $UserName ���ͧ�ҡ��͡�Ţ������ҺѵüԴ�Թ��Ҥ��� ";
$TEL_admin='0878426256';
$cccc=  iconv('TIS-620', 'UTF-8', $texts);
$sms->send( "$SENDSMSNAME", $TEL_admin, $cccc);
}

if($row_chk_login[t] > 4){	
/*
update("register","status ='88'  "," where UserName='$UserName'    "); 
$tb="radcheck";
$sql_block = "delete from $tb where UserName='$UserName'  and Attribute='MD5-Password' ";
mysql_query($sql_block, $connect_db) or die(mysql_error());

 $texts="$domain_name: �к����ͤ �����ҹ $UserName ���ͧ�ҡ��͡�Ţ������ҺѵüԴ�Թ��Ҥ��� ";
 $b=date("Y-m-d H:i:s");
mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('$UserName', '$texts','$b'  ,'system','$domain_name' )") or trigger_error(mysql_error(),E_USER_ERROR);       

			  
          echo                  "<script type=text/javascript>";
		    echo                  "alert('$UserName ��͡���ʼ�ҹ�Դ�Թ 5 ���� �к��к��ͤ�ͧ͢��ҹ����ô�Դ��ͼ������к� ')";
	        echo                  "</script>";
  	*/	
	          echo                  "<script type=text/javascript>";
		    echo                  "alert('$UserName ��͡���ʼ�ҹ�Դ�Թ 5 ����  �ô���ѧ ��ú��ͤ�ʹբͧ��ҹ ')";
	        echo                  "</script>";
	 echo "<meta http-equiv=refresh content=0;URL=active.php?domain_name=$domain_name&identity=$identity>";

	            	exit();
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	if($totalRows_user==0  ) {   //��Ǩ�ͺ��� �� cardid ��������������
		  
 $texts="$domain_name : ���ͼ����  $UserName  ����Ţ�ѵüԴ ���������Ţ $idcard  ";
 $b=date("Y-m-d H:i:s");
mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('$UserName', '$texts','$b'  ,'system','$domain_name' )") or trigger_error(mysql_error(),E_USER_ERROR);       
			     
					echo                  "<script type=text/javascript>";
		            echo                  "alert(' ����������Ţ�ѵù����к� ')";
		             echo                  "</script>";	   
 			 echo "<meta http-equiv=refresh content=0;URL=active.php?domain_name=$domain_name&identity=$identity>";
	            	exit();
 }
 
	if($row_Recordset1[active]==1   ) {   //��Ǩ�ͺ��� �� cardid ��������������
		  
   echo "<h2><center>('�ѵù�� �١��ҹ�����  �����     ". date_to_thai_return($row_Recordset1[time_active])."   �¼����  $row_Recordset1[UserName] ')</center></h2><br>";
		        echo "<h1><center> <a href='active.php?domain_name=$domain_name'> ��Ѻ�˹������ѵ�</a></center></h1>";
					 
	            	exit();
 }  else {
 
 
		//      $query_user2 = "select  * from register      where per='$per'  and password=md5('$password')   and   status='1'     ";
		$query_user2 = "select  * from register      where UserName='$UserName'     and   status='1'  and  domain='$domain_name'    ";
		$type_user2 = mysql_query($query_user2, $connect_db) or die(mysql_error());
		$row_Recordset2 = mysql_fetch_assoc($type_user2);
		$a_name=$row_Recordset2[UserName];
		 
		$totalRows_user2= mysql_num_rows($type_user2);
		if($totalRows_user2 ==0   ) {
			echo                  "<script type=text/javascript>";
			echo                  "alert('����ռ��������к�  ')";
			echo                  "</script>";
			echo "<meta http-equiv=refresh content=0;URL=active.php?domain_name=$domain_name&identity=$identity>";
			exit();
		}   else {
//�ó��繺ѵ�Ẻ�������
if($row_Recordset1['type_time']=='�������'){
$total_day_from_card=$row_Recordset1['date_end'];
############### �֧�ѹ��� �������㹰ҹ���������Ѿഷ ######
								$query_time= "select  *  from radcheck      where UserName='$a_name'   and Attribute='Expiration'              ";
				$type_time = mysql_query($query_time, $connect_db) or die(mysql_error());
				$row_time_db = mysql_fetch_assoc($type_time);
				$date_db=$row_time_db[Value];
                $date_dbFor_2=$row_time_db[Value];
				if($date_db !=''){
				#�ӡ���¡�ѹ��� ���� �ҡ�����  $date_db ���� array
				$a_time= explode(" ",$date_db) ;
				$a_time[0];  //�ѹ
				$a_time[1];  //��͹
				$a_time[2];  //��
				#�ŧ ��͹ �� ����Ţ
				$a_time[1]=re_name($a_time[1]);
				$date_db="$a_time[2]-$a_time[1]-$a_time[0]";
				$date_now=date("Y-m-d");
				$cal_date=(strtotime($date_now) - strtotime($date_db) ) / ( 60 * 60 * 24 );
				$cal_date2=(strtotime($date_db) - strtotime($date_now) ) / ( 60 * 60 * 24 );
				} else {
				$cal_date=0;
				}
				#��� $cal_date  > 0  ��ͧ��Ҽŵ�ҧ�Һǡ ���������ѹ �� ��� < 0 ���������ѹ register �
					if($cal_date > 0  ) {
			//�ó����ѹ�������к�
			print "��ҹ�ѧ������ѹ��ҹ �������ö ��ٻͧ �������Ẻ��������� ��ͧ����� ���Ңͧ��ҹ������¡�͹";
			exit();
			}	
           if($cal_date < 0  or  $cal_date ==0 ) {
			//�ó� ������к��������
               $query_time2= "select  *  from radcheck      where UserName='$a_name'   and Attribute='Max-All-Session'              ";
				$type_time2 = mysql_query($query_time2, $connect_db) or die(mysql_error());
				$row_time_db2 = mysql_fetch_assoc($type_time2);
				$date_dbTime=$row_time_db2[Value];
				
			$date_add_time=$row_Recordset1['date_end']+$date_dbTime;
                         mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Expiration'  ") ; //ź����ѹ���
						 mysql_query("delete   from   usergroup  where  UserName='$a_name'   ") ;
                        mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Max-All-Session'  ") ;
				       update("radacct", "AcctSessionTime='0'  "," where UserName='$a_name'     ");
					   mysql_query("INSERT INTO  table_card_user  (idcard,UserName,active,domain)   values('$idcard','$a_name','1','$domain_name')") or    die ("Add ������ŧ Table ����� ");
					   update("card", "active='1' , UserName='$a_name' ,time_active='$date_active_card' ,identity='$identity'    "," where idcard='$idcard'  and domain='$domain_name'     ");
                       mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)   values('$a_name','Max-All-Session',':=','$date_add_time')") or    die ("Add ������ŧ Table ����� ");
					   $date_add_time=($date_add_time/60)/60;
$msg_s=" $domain_name: ������� $a_name ���º�������� �ѹ������ء����ҹ  $date_add_time �������   <br>";
print $msg_s;
exit();
			}		
}		
		
	// echo "�ѹ";
				############### �֧�ѹ��� �������㹰ҹ���������Ѿഷ ######

				$query_time= "select  *  from radcheck      where UserName='$a_name'   and Attribute='Expiration'              ";
				$type_time = mysql_query($query_time, $connect_db) or die(mysql_error());
				$row_time_db = mysql_fetch_assoc($type_time);
				$date_db=$row_time_db[Value];
                $date_dbFor_2=$row_time_db[Value];
				#�ӡ���¡�ѹ��� ���� �ҡ�����  $date_db ���� array
				$a_time= explode(" ",$date_db) ;
				$a_time[0];  //�ѹ
				$a_time[1];  //��͹
				$a_time[2];  //��
				#�ŧ ��͹ �� ����Ţ
				$a_time[1]=re_name($a_time[1]);
				$date_db="$a_time[2]-$a_time[1]-$a_time[0]";
				$date_now=date("Y-m-d");
				$cal_date=(strtotime($date_now) - strtotime($date_db) ) / ( 60 * 60 * 24 );
				$cal_date2=(strtotime($date_db) - strtotime($date_now) ) / ( 60 * 60 * 24 );
				#��� $cal_date  > 0  ��ͧ��Ҽŵ�ҧ�Һǡ ���������ѹ �� ��� < 0 ���������ѹ register �
				#�ó��ѧ���ѹ�����㹰ҹ������ ������Թ������ѹ����
				
				if($cal_date < 0  ) {
			//�ó����ѹ�������к�
		 	// 	include("no_user_time.php");
			   $radius_time= explode(" ",$date_dbFor_2) ; //�ŧ�ѹ���������������ٻẺ�ѹ���� DB
		 		$radius_time[2];    //��
			 	$radius_time[1];    //��͹
		 		$radius_time[0];     //�ѹ
		 	 	$date_add_db_system=re_date_radius_to_datedb($radius_time[1]);
				$Hourts=date("H:i:s");
				$date_for_add_db="$radius_time[2]-$date_add_db_system-$radius_time[0] $Hourts"; //���ѹ��� ����ŧ�Ҩҡ�ѹ������������������ ����������ٻ �ͧ DB
                $date_active_card=date("Y-m-d H:i:s");
				$cal_date_total=(strtotime($date_for_add_db) - strtotime($date_now) ) / ( 60 * 60 * 24 ); //����ѹ�������� ��ź�ѹ�Ѩ�غѹ���ʹ��������͡���ѹ
				$cal_date_total=number_format($cal_date_total,0); //�Ѵ���
				$UPDAYS=$row_Recordset1[date_end]+$cal_date_total;	//�ǡ���������㹡���
  				$date_add_db=date('Y-m-d', mktime(0,0,0, date('m'),date('d')+  $UPDAYS,date('Y')));
		
				#�ŧ�ѹ������������ٻ radius
				$radius_time= explode("-",$date_add_db) ;
				$radius_time[2];  //�ѹ
				$radius_time[1];  //��͹
				$radius_time[0];  //��
				$date_add_db2=re_name2($radius_time[1]);
				$Hourts=date("H:i:s");
				$date_add_db="$radius_time[2] $date_add_db2 $radius_time[0] $Hourts";
				//echo " +  $date_add_db";

				mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Expiration'  ") ;
				mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)   values('$a_name','Expiration',':=','$date_add_db')") or    die ("Add ������ŧ Table ����� ");

			//	update("usergroup", "GroupName='$GroupName'  "," where UserName='$a_name'  and domain='$domain_name'    ");
                mysql_query("delete   from   usergroup  where  UserName='$a_name'   ") ;
				mysql_query("INSERT INTO  usergroup  (UserName,GroupName,priority,domain)   values('$a_name','$GroupName','1','$domain_name')") or    die ("Add ������ŧ Table ����� ");
				
				update("card", "active='1' , UserName='$a_name' ,time_active='$date_active_card' ,identity='$identity'    "," where idcard='$idcard'  and domain='$domain_name'     ");

				###### ź���  �ͧ �ӹǹ����������
				mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Max-All-Session'  ") ;
				update("radacct", "AcctSessionTime='0'  "," where UserName='$a_name'     ");
				$msg_s=" $domain_name: ������� $a_name ���º�������� �ѹ������ء����ҹ �Թ�����絤�� $date_add_db ";
				###########################
				mysql_query("INSERT INTO  table_card_user  (idcard,UserName,active,domain)   values('$idcard','$a_name','1','$domain_name')") or    die ("Add ������ŧ Table ����� ");
	  
$texts="$domain_name: �����ҹ $a_name ����Ţ�ѵ� $idcard ��ҹ   �ѹ������ء����ҹ ���  $date_add_db (�繡������ѵá�͹������ҵ��ͧ�������) ";
 $b=date("Y-m-d H:i:s");
mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('$idcard', '$texts','$b'  ,'system','$domain_name' )") or trigger_error(mysql_error(),E_USER_ERROR);   
 
 echo "<meta http-equiv=refresh content=0;URL=http://www.google.co.th>";
exit();
///��������Ẻ ������ѹ��к�
				} 
 if($cal_date == 0  ) {
 //�ó�������ѹ���ǡѺ�ѹ����������
	 	 $cal_date=50000;
				} 

				#########  �ѧ�������������к� ���ǡ����  �������
				if($cal_date > 0   ) {  #up� db ����
				if($cal_date==50000){ $UPDAYS=$row_Recordset1[date_end]+1; } else { $UPDAYS=$row_Recordset1[date_end]+0;} //�ó�������ѹ���ǡѺ�ѹ���������� ��ǡ�����ҡ����˹���ѹ�����������
					$date_add_db=date('Y-m-d', mktime(0,0,0, date('m'),date('d')+  $UPDAYS,date('Y')));
				#�ŧ�ѹ������������ٻ radius
				$radius_time= explode("-",$date_add_db) ;
				$radius_time[2];  //�ѹ
				$radius_time[1];  //��͹
				$radius_time[0];  //��
				$date_add_db2=re_name2($radius_time[1]);
				$Hourts=date("H:i:s");
				$date_add_db="$radius_time[2] $date_add_db2 $radius_time[0] $Hourts";
				//echo " +  $date_add_db";

				mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Expiration'  ") ;
				mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)   values('$a_name','Expiration',':=','$date_add_db')") or    die ("Add ������ŧ Table ����� ");

			//	update("usergroup", "GroupName='$GroupName'  "," where UserName='$a_name'  and domain='$domain_name'    ");
                mysql_query("delete   from   usergroup  where  UserName='$a_name'   ") ;
				mysql_query("INSERT INTO  usergroup  (UserName,GroupName,priority,domain)   values('$a_name','$GroupName','1','$domain_name')") or    die ("Add ������ŧ Table ����� ");
				
				update("card", "active='1' , UserName='$a_name' ,time_active='$date_active_card' ,identity='$identity'    "," where idcard='$idcard'  and domain='$domain_name'     ");

				###### ź���  �ͧ �ӹǹ����������
				mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Max-All-Session'  ") ;
				update("radacct", "AcctSessionTime='0'  "," where UserName='$a_name'     ");
				$msg_s=" $domain_name: ������� $a_name ���º�������� �ѹ������ء����ҹ �Թ�����絤��  ";
				###########################
				mysql_query("INSERT INTO  table_card_user  (idcard,UserName,active,domain)   values('$idcard','$a_name','1','$domain_name')") or    die ("Add ������ŧ Table ����� ");
				echo                  "<script type=text/javascript>";
				echo                  "alert(' $msg_s  $date_add_db ')";
				echo                  "</script>";
 
 if($TEL !='')			{  
 //�� sms ����١��ҷ�Һ  
 
  $cccc=  iconv('TIS-620', 'UTF-8',  "������� $a_name �ѹ������ء����ҹ ");
  $pppppppppp=$cccc.'  '.$date_add_db;
// $sms->send( "$SENDSMSNAME", $TEL, "$pppppppppp");
 
  $texts="$domain_name: ��  sms �� �������ѵ�   $a_name 价������ $TEL  ";
  


 $b=date("Y-m-d H:i:s");
mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('$idcard', '$texts','$b'  ,'system','$domain_name' )") or trigger_error(mysql_error(),E_USER_ERROR);       
 }
 
 $texts="$domain_name: �����ҹ $a_name ����Ţ�ѵ� $idcard ��ҹ   �ѹ������ء����ҹ ���  $date_add_db ";
 $b=date("Y-m-d H:i:s");
mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('$idcard', '$texts','$b'  ,'system','$domain_name' )") or trigger_error(mysql_error(),E_USER_ERROR);       
	echo "<meta http-equiv=refresh content=0;URL=active.php?domain_name=$domain_name&identity=$identity>";
exit();
			  
				// $aaaaaa=2;
				}


			
		}     // ����Ǩ�ͺ��� �� user ��������������
	}		 // ����Ǩ�ͺ��� �� cardid ��������������
	
 $b=date("Y-m-d H:i:s");
  $texts="<b>$domain_name: �����ҹ $a_name ����Ţ�ѵ� $idcard ����� </b>";
mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('$idcard', '$texts','$b'  ,'tlog','$domain_name' )") or trigger_error(mysql_error(),E_USER_ERROR);       	
			  
	echo "<meta http-equiv=refresh content=0;URL=active.php?domain_name=$domain_name&identity=$identity>";
	// print  $cal_date ;
exit();
} // sumbit
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<title>������ҡ����ҹ</title>

<link href="main.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style12 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}

body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
</head>

<body>
	<table width="530" height="445" border="0" align="center" cellpadding="0"
		cellspacing="0" background="verture.jpg">
		<tr >
			<td height="128">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td valign="top"><table width="501" border="0" align="center">
					<tr>
						<td width="418">
						 
						<form action="active.php?domain_name=<?php print $domain_name;?>&identity=<?php print $identity;?>" method="post" enctype="multipart/form-data">
								<table width="106%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td width="57%"><div align="right" class="style12">���������ҹ�к� / User login::</div>									  </td>
										<td width="43%"><font size="3"
											face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<span
												class="style25"> 
										  <input name="per" type="text" class="input" value="<?php print $per;?>" id="per" size="20">
											</span>
									  </font></td>
									</tr>
								<?php	if($_SESSION[adminpass] ==''){ ?>
									<tr>
                                      <td><div align="right" class="style12">���ʼ�ҹ / password login::</div></td>
									  <td><font size="3"
											face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<span
												class="style25">
                                        <input name="passwds" type="password" class="input" value="" id="passwds" size="20">
                                      </span> </font></td>
								  </tr>
								  <?php } ?>
									<tr>
										<td><div align="right" class="style12">�����Ţ�ѵ� �ѵ� Internet <?php print $domain_name;?>/ <br>
										  <?php print $_GET[domain_name];?>&nbsp;Card Internet number::</div></td>
										<td><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><span
												class="style25"> &nbsp; <input name="idcard" type="text" class="input" id="idcard" size="20">
											</span> </font></td>
									</tr>

									<tr>
										<td height="48"> <div align="right" class="style12">Security code::</div></td>
										<td><div align="left">
												<font color="#0000FF"> &nbsp; <?php   $ran_str = randomToken(4);    ?>
													<img src="pic_text_popup.php?str=<?php print $ran_str;?>" width="100" height="25">												</font>
											</div></td>
									</tr>
									<tr>
										<td><div align="right">
												<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Security code :</strong>												</font>
											</div></td>
										<td><font color="#0000FF"> &nbsp; <input name="code1" type="text" id="code1" size="10" />
										</font></td>
									</tr>
								 
				 
									<tr>
										<td colspan="2"><div align="center">
												<font size="3" face="MS Sans Serif, Tahoma, sans-serif"> <input
													name="chk_num" type="hidden" id="chk_num"
													value="<?php echo "$ran_str"; ?>" /> <input name="sumbit"
													type="submit" class="input" id="sumbit" value="�������">
												</font>
											</div></td>
									</tr>
									<tr>
										<td colspan="2"></td>
									</tr>
						  </table>
						  </form></td>
					</tr>
				</table></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td height="129">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
</table>
	<br>
	</p>
	<p>&nbsp;</p>
</body>
</html>
