<?php
/*
CREATE TABLE  `radius`.`tmconfig` (
`tmuser` VARCHAR( 300 ) NOT NULL ,
`tmpassword` VARCHAR( 300 ) NOT NULL ,
`trueuser` VARCHAR( 300 ) NOT NULL ,
`truepassword` VARCHAR( 300 ) NOT NULL
) ENGINE = MYISAM ;
*/
$hostname_edoc = "127.0.0.1";
$database_edoc = "radius";
$username_edoc = "root";
$password_edoc = "010464088";

$connect_db= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc);
mysql_select_db($database_edoc, $connect_db)  or trigger_error(mysql_error(),E_USER_ERROR);
    mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
	
 $block_mac_sql2 = "SELECT *   FROM  tmconfig     ";
$mac_db = mysql_query($block_mac_sql2, $connect_db) or die(mysql_error());
$row_tm= mysql_fetch_assoc($mac_db);
 

// ���������ǹ�˹���ͺ������� 081-0329233
//������ tmtopup.thaighost.net �������ԡ�õѴ�ѵ÷��
$tmuser=$row_tm[tmuser]; // Username
$tmpassword=$row_tm[tmpassword];  // ���ʼ�ҹ

//������ �ѭ�� True money �ͧ��� http://www.truemoney.co.th ��ͧ��͡���١��ͧ �����Ҩ�����ѭ�� True money  �ͧ��ҹ�١�ЧѺ��
$trueuser=$row_tm[trueuser];  // Username
$truepassword=$row_tm[truepassword];  // ���ʼ�ҹ

$tmuser= 'thaigqsoft';
$tmpassword= '010464088';

//������ �ѭ�� True money �ͧ��� http://www.truemoney.co.th ��ͧ��͡���١��ͧ �����Ҩ�����ѭ�� True money  �ͧ��ҹ�١�ЧѺ��
$trueuser= '3180400474';
$truepassword= '010464088';

?>
