<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=tis-620">
<?
$hostname_edoc = "127.0.0.1";
$database_edoc = "radius";
$username_edoc = "root";
$password_edoc = "010464088";
 
######################################################################### 
/*
$hostname_syslog ="61.19.73.174" ;
$database_syslog = "syslog";   
$username_syslog ="trlog'" ;
$password_syslog="trlog";
*/
$hostname_syslog = "127.0.0.1";
$database_syslog = "syslog";
$username_syslog = "root";
$password_syslog = "010464088";


$connect_db= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc);
if(!$connect_db){
 echo '�������ö������Ͱҹ��������  ��س��ͤ���˹�� �к���������������������';
 echo "<meta http-equiv=refresh content=5;URL=index.php?case_i=$case_i>";
exit();
 
}
    mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");

 mysql_select_db($database_edoc, $connect_db)  or trigger_error(mysql_error(),E_USER_ERROR);
$query_seting = "SELECT   *   FROM seting      ";
$seting_q= mysql_query($query_seting, $connect_db) or die(mysql_error());
$row_seting = mysql_fetch_assoc($seting_q);

$roomsDB=$row_seting[room];
$siteDB=$row_seting[site];
$idstdDB=$row_seting[idstd];
$allow_register=$row_seting[allow_register];
$none_chk_idperdb=$row_seting[none_chk_idper];
# ��Դ��� ���§�ӴѺ���¡�� �����
$order_by="register.site   ,   register.room    ,  register.fullname   ";



//�óյ�ͧ�����蹿������ѧ��Ѥ�˹�觪�����
/*
$nexp_h=date('H:i:s', strtotime('+1 hours'));
$data_datessss=date("d M Y");
$data_datessss .=" $nexp_h";
*/
#Email admin
$mails_admin="thaigqsoft@gmail.com";
#���� ��� ����ͧ����ʴ��˹�� popup
$web_logo="www.thaigqsoft.com";
#�ѹ������ؤ����á
$data_datessss="31 Jul 2012 23:50:00";
 
	?>
