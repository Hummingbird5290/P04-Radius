<?php
include("include/function.php");


$a_name=$_SESSION["ulogin_pass"];
$p_name=$_GET['Password'];
  
$p_name=md5($p_name);
$date_active_card=("Y-m-d H:i:s");

$query_CHK_user = "SELECT   *   FROM   register   where UserName = '$a_name'    ";
$Recordset_UUU = mysql_query($query_CHK_user, $connect_db) or die(mysql_error());
 $totalRows_Recordset1000 = mysql_num_rows($Recordset_UUU);
 //echo "$query_CHK_user";
if($totalRows_Recordset1000 > 0)  {
$query_cade_t = "
SELECT 
  table_card_user.idcard,
  table_card_user.active As tactive,
  card.idcard,
  card.date_end,
  card.type_time,
  card.UserName,
  card.active,
  card.time_active,
  card.GroupName,
  card.time_death,
  card.cost,
    card.idcard
FROM
  table_card_user
  INNER JOIN card ON (table_card_user.idcard = card.idcard)
  
  where   card.UserName='$a_name'   
                   and  table_card_user.active='0'  
				     ";
$Q_time = mysql_query($query_cade_t, $connect_db) or trigger_error(mysql_error(),E_USER_ERROR); 
$row_Ttime= mysql_fetch_assoc($Q_time);
$totalRows_Recordset_Time = mysql_num_rows($Q_time);
$GroupName=$row_Ttime[GroupName];
$Time_Plus=$row_Ttime[date_end];
$idcard=$row_Ttime[idcard];
$date_add_db=date('Y-m-d', mktime(0,0,0, date('m'),date('d')+ $row_Ttime[date_end],date('Y')));

#�ŧ�ѹ������������ٻ radius
$radius_time= explode("-",$date_add_db) ;
$radius_time[2];  //�ѹ
$radius_time[1];  //��͹
$radius_time[0];  //��
$date_add_db2=re_name2($radius_time[1]);
$Hourts=date("H:i:s");
$date_add_db="$radius_time[2] $date_add_db2 $radius_time[0] $Hourts";
//echo " +  $date_add_db";
if($totalRows_Recordset_Time >0  and $row_Ttime[type_time]=='�ѹ'  ) {
      mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Max-All-Session'  ") or    die ("Add ������ŧ Table 1 ����� ");
	  mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Expiration'  ") or    die ("Add ������ŧ  Table  2 ����� ");
	  mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)   values('$a_name','Expiration',':=','$date_add_db')") or    die ("Add ������ŧ Table  3 ����� ");
																																													 

 
 mysql_query("update        usergroup set  GroupName='$GroupName'   where UserName='$a_name' ")
	 or    die ("Add ������ŧ Table  usergroup ����� ");

 mysql_query("update        card set  active='1' ,UserName='$a_name'  ,time_active='$date_active_card'   where idcard='$idcard'  ") or    die ("Add ������ŧ Table  card ����� ");

  mysql_query("update        table_card_user  set  active='1' ,UserName='$a_name'  where idcard='$idcard'  ")
	  or    die ("Add ������ŧ Table  table_card_user ����� ");

  mysql_query("update        radacct  set  AcctSessionTime='0000-00-00 00:00:00'     where UserName='$a_name'   ") or    die (" Add ������ŧ Table �ҹ���������  "); 
 
}

if($totalRows_Recordset_Time >0  and $row_Ttime[type_time]=='�������'  ) {
	
	$date_add_db=$row_Ttime[date_end];

      mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Max-All-Session'  ") or    die ("Add ������ŧ Table 1 ����� ");
	  mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Expiration'  ") or    die ("Add ������ŧ  Table  2 ����� ");
	  mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)   values('$a_name','Max-All-Session',':=','$date_add_db')") or    die ("Add ������ŧ Table  3 ����� ");
																																													 

 
 mysql_query("update        usergroup set  GroupName='$GroupName'   where UserName='$a_name' ")
	 or    die ("Add ������ŧ Table  usergroup ����� ");

 mysql_query("update        card set  active='1' ,UserName='$a_name'  ,time_active='$date_active_card'   where idcard='$idcard'  ") or    die ("Add ������ŧ Table  card ����� ");

  mysql_query("update        table_card_user  set  active='1' ,UserName='$a_name'  where idcard='$idcard'  ")
	  or    die ("Add ������ŧ Table  table_card_user ����� ");

  mysql_query("update        radacct  set  AcctSessionTime='0000-00-00 00:00:00'     where UserName='$a_name'   ") or    die (" Add ������ŧ Table �ҹ���������  "); 
 
}
 

 
 
}		
 

   	         echo                  "<script type=text/javascript>";
		    echo                  "alert('�к�����������������س���� �ô Login �ա����˹��  ')";
	        echo                  "</script>";  
			   echo "<meta http-equiv=refresh content=0;URL=http://10.0.0.1:3990/prelogin>"; 
																						   ?>