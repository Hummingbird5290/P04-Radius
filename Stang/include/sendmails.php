
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

<?php
function sendmails($userdb_id_mails,$book_titles) {
include ("PHPMailer/class.phpmailer.php");
include("Connections/dbconnect.php"); 
 
$query_Recordset1 = "SELECT *   FROM   userdb    where    userdb_id='$userdb_id_mails'  and userdb_rec_mail='1' ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
 

 

 if($totalRows_Recordset1 !=0 or $totalRows_Recordset1 != null )   //�ҡ�� user ��ԧ �зӡ��������
  {
     include_once('PHPMailer/class.phpmailer.php'); 
     $UserEmail = $row_Recordset1["userdb_email"];    
     $WebMaster="scicontact@nu.ac.th";
     $UserEmail="$UserEmail";
     $subject   ="�����͡����觶֧�س  ";
     $msg ="���͡����觶֧�س����ͧ $book_titles   �ô����к� �ҹ��ú�í ";
//#########################################
$mail    = new PHPMailer();
$mail->Host = "10.20.10.100";
 
$mail->Port = "25";
$mail->SMTPAuth = ture;
$mail->Username = 'tanakornp';
$mail->Password = '010464088';
$mail->Mailer = 'smtp';
$mail->IsHTML(true);
$mail->CharSet = 'windows-874';
$mail->From     = "tanakornp@nu.ac.th";
$mail->FromName = "�к����ʹ�����͡�èѴ��çҹ��ú�ó";

$mail->Subject = "�����͡����觶֧�س �ҡ   �к����ʹ�����͡�èѴ��çҹ��ú�ó ";

$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($msg);

$mail->AddAddress("$UserEmail");

if(!$mail->Send()) {   echo "Mailer Error: " . $mail->ErrorInfo;
                             echo                  "<script type=text/javascript>";
                             echo                  "alert('�������ö�� Mail ���سҵԴ��ͼ������к�   �������  3133')";
                             echo                  "</script>";
                             echo                  "<meta http-equiv='refresh' content='0; url=index.php?case_i=200'>" ;
} else {  }
//#####################################
 }  //����ǹ��Ǩ�ͺ����� user ��ԧ�������       

  
} //�� function	?>
	

 
 
 