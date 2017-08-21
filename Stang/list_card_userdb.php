<?php  
session_start(); 
include("Connections/dbconnect.php");
include("include/function.php");
$UserName=$_SESSION["ulogin_pass"];
if($UserName==''){
$UserName=$_GET[UserName];
}

$query_user = "SELECT  * FROM   register  WHERE  UserName='$UserName'  ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user_se = mysql_fetch_assoc($user_db);


if($Submit_login =='1'     ) {
    $todates_chk=date("Y-m-d");
    $query_user = "select  *   from card      where   idcard
  in  (    select  idcard  from table_card_user  where active='0'  and UserName='$UserName'  and idcard='$idcard'    )         ";
    $type_db = mysql_query($query_user, $connect_db) or die(mysql_error());
    $row_Recordset1 = mysql_fetch_assoc($type_db);
    $totalRows_user= mysql_num_rows($type_db);
    $GroupName=$row_Recordset1['GroupName'];

    if($row_Recordset1[type_time]=='ชั่วโมง' or $row_Recordset1[type_time]=='นาที') {
        $query_time= "select  *  from radcheck      where UserName='$UserName'   and Attribute='Expiration'              ";
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
        $ddtodays=date("Y-m-d");
        if($cal_date < 0  or ( $cal_date == 0 or  $date_db  <=$ddtodays )   ) {

            ###### ลบฟิว  ของ จำนวนชั่วโมงทิ้ง
            mysql_query("delete   from   radcheck  where  UserName='$UserName'     and  Attribute='Max-All-Session'  ") ;
            ###### ลบฟิว  ของ จำนวนวันทิ้ง
            mysql_query("delete   from   radcheck  where  UserName='$UserName'     and  Attribute='Expiration'  ") ;
            #ดึงเวลาปัจจุบันมา เพื่อ กำหนดวันสุดท้ายที่จะใช้ระบบได้
            $date_add_db=date('Y-m-d', mktime(0,0,0, date('m'),date('d')+ $row_Recordset1[H_end],date('Y')));
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

            mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)   values('$UserName','Max-All-Session',':=','$H_end_times')")
                    or    die ("Add ข้อมูลลง Table ไม่ได้ ");
            update("usergroup", "GroupName='$GroupName'  "," where UserName='$UserName'     ");
            update("radacct", "AcctSessionTime='0'  "," where UserName='$UserName'     ");
            update("card", "active='1' , UserName='$UserName'     "," where idcard='$idcard'       ");
            update("table_card_user", "active='1'       "," where idcard='$idcard'       ");
        } //จบชั่วโมง

    }
    if($row_Recordset1[type_time]=='วัน') {
        ############### ดึงวันที่ หมดอายุในฐานข้อมูลมาอัพเดท ######
        $query_time= "select  *  from radcheck      where UserName='$UserName'   and Attribute='Expiration'              ";
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

                #########  ยังมีเวลาเหลือในระบบ ให้บวกเพิ่ม  ๒๒๒๒๒๒๒
                if($cal_date > 0   or  $cal_date ==0) {  #upใน db เพิ่ม
                    $date_add_db=date('Y-m-d', mktime(0,0,0, date('m'),date('d')+ $row_Recordset1[date_end],date('Y')));
                    #แปลงวันที่ให้อยู่ในรูป radius
                    $radius_time= explode("-",$date_add_db) ;
                    $radius_time[2];  //วัน
                    $radius_time[1];  //เดือน
                    $radius_time[0];  //ปี
                    $date_add_db2=re_name2($radius_time[1]);
                    $Hourts=date("H:i:s");
                    $date_add_db="$radius_time[2] $date_add_db2 $radius_time[0] $Hourts";
                    //echo " +  $date_add_db";

                    mysql_query("delete   from   radcheck  where  UserName='$UserName'     and  Attribute='Expiration'  ") ;
                    mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)   values('$UserName','Expiration',':=','$date_add_db')") or    die ("Add ข้อมูลลง Table ไม่ได้ ");

                    update("usergroup", "GroupName='$GroupName'  "," where UserName='$UserName'     ");
                    update("card", "active='1' , UserName='$UserName' ,time_active='$date_active_card'   "," where idcard='$idcard'       ");
 update("table_card_user", "active='1'       "," where idcard='$idcard'       ");
                    ###### ลบฟิว  ของ จำนวนชั่วโมงทิ้ง
                    mysql_query("delete   from   radcheck  where  UserName='$UserName'     and  Attribute='Max-All-Session'  ") ;
                    update("radacct", "AcctSessionTime='0'  "," where UserName='$UserName'     ");
                    ###########################

}
        echo                  "<script type=text/javascript>";
        echo                  "alert('เรียบร้อยแล้ว วันหมดอายุการใช้งาน คือ  $date_add_db  ')";
        echo                  "</script>";
        echo "<meta http-equiv=refresh content=0;URL=list_card_userdb.php>";

        exit();


    }

}

mysql_select_db($database_edoc);  
include("Connections/class.php");
include("admin/class.php");

?>
<html>
    <head>
        <title>รายการบัตรที่ท่านได้ใช้งาน</title>

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
        <form name="form1" method="post" action="list_card_user_active.php">
            <?

            //$condition = "  ";
            if(trim($txt_search)<>'') {
                $condition = "   and       idcard      like'%$txt_search%'       ";
            }
            if (empty($offset) || $offset < 0) {
                $offset=0;
            }
            //    Set $limit,  $limit = Max number of results per 'page'
            if(!$limit) {
                $limit = 1000;
            }
            //    Set $totalrows = total number of rows that unlimited query would return
            //    (total number of records to display across all pages)
            $sql = "SELECT
		  card.idcard,
  card.date_end,
  card.type_time,
  card.UserName,
  table_card_user.UserName,
  table_card_user.active   as  tacive,
  card.GroupName,
  card.time_active,
  card.active
FROM
  table_card_user
  INNER JOIN card ON (table_card_user.idcard = card.idcard)
  AND (table_card_user.UserName = card.UserName)
    
  where     
   card.UserName='$UserName'  
  and table_card_user.active ='0'
                    $condition";

            $query_data = $db->query($sql);
            $rows = mysql_num_rows($query_data);
            // Set $begin and $end to record range of the current page
            $begin =($offset+1);
            $end = ($begin+($limit-1));
            if ($end > $totalrows) {
                $end = $totalrows;
            }
            $Show = $sql." ORDER BY   time_active  LIMIT $offset, $limit";
            $query_data = $db->query($Show);

            ?>
            <table width="85%" border="0" align="center" cellpadding="1" cellspacing="1">

                <tr bgcolor="#CCFFCC">
                    <td colspan="6"> <div align="center" class="style3"><font size="3" face="MS Sans Serif, Tahoma, sans-serif">
                                <strong>รายการบัตรที่ทำการ Active ของ <?php print $UserName;?></strong></font> กรุณาคลิกที่รายการบัตร (เครื่องหมายถูก) เพื่อดึงเวลามาใช้ </div></td>
                </tr>
                <tr bgcolor="#FFFFCC">
                    <td width="7%" class="style2"> <div align="center" class="style3"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ลำดับ</font></strong></div></td>
                    <td width="19%" align="center" class="style2"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">หมายเลขบัตร</font></strong></td>
                    <td width="16%" align="center" class="style2"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">อยู่ในกลุ่ม</font></strong></td>
                    <td width="18%" align="center" class="style2"><strong><font size="2">วันที่เติม</font></strong></td>
                    <td width="13%" align="center" class="style2"><strong><font size="2">เปิดใช้งาน</font></strong></td>
                    <td width="13%" align="center" class="style2"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">จำนวน</font></strong></td>
                </tr>
                <?
                if($rows<>0) {
                    $i=1;
                    while($result_data = mysql_fetch_array($query_data)) {
                        $check=$db->query(" SELECT
  card.idcard,
  card.date_end,
  card.type_time,
  card.UserName,
  table_card_user.UserName,
  table_card_user.active,
  card.GroupName,
  card.time_active,
  card.active
FROM
  table_card_user
  INNER JOIN card ON (table_card_user.idcard = card.idcard)
  AND (table_card_user.UserName = card.UserName)
 
  where      table_card_user.active ='0' and  card.UserName='$UserName' $condition ");
                        $cli=$i%2;
                        if($cli=="0") {
                            $cli="#AAD2FF" ;
                        } else {
                            $cli="#FFFFFF" ;
                        }
                        ?>
                <tr bgcolor="<?php echo "$cli"; ?>" >
                    <td height="21" align="center"> <font size="1" face="MS Sans Serif, Tahoma, sans-serif">
                                    <?=($offset + $i);?>
                            .</font></td>
                    <td><div align="left"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">
                                &nbsp;&nbsp;
                                        <?  print   $result_data[idcard];   ?>
                            </font></div></td>
                    <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif">
                            &nbsp;&nbsp;&nbsp;
                                    <?  print   $result_data[GroupName];   ?>
                        </font></td>
                    <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif">
                            &nbsp;&nbsp;&nbsp;
                                    <?   date_to_thai($result_data[time_active])?>
                        </font></td>
                    <td><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">

                                <a href="list_card_userdb.php?Submit_login=1&idcard=<?  print   $result_data[idcard];   ?>&UserName=<?php print $UserName; ?>"><img src="images/check.gif" border="0"></a>
                            </font></div></td>
                    <td><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">
                                        <?php if($result_data[type_time]=="วัน") { print $result_data[date_end]; }  
										           if($result_data[type_time]=="ชั่วโมง")    {  $g=($result_data[date_end]/60)/60;   print $g;   }  
												    if($result_data[type_time]=="นาที")    {  $g=($result_data[date_end]/60);   print $g;   }  
												   ?>
                            </font><font size="1" face="MS Sans Serif, Tahoma, sans-serif">
                                &nbsp;
                                        <?  print   $result_data[type_time];   ?>
                            </font></div></td>
                </tr>
                        <?
                        $i++;
                    }
                }else {
                    ?>
                <tr bgcolor="#FFFFFF">
                    <td colspan="6"><div align="center"><strong><font color="#FF0000">ไม่พบข้อมูล</font></strong></div></td>
                </tr>
                    <?
                }


                ?>
            </table>
            <br><br>
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>

                    <td bgcolor="#CCCCCC"><div align="right"></div></td>
                </tr>
            </table>
            <? if($rows > 0) { ?>

            <table width="81%" border="0" align="center" cellpadding="3" cellspacing="0">
                <tr>
                    <td><img src="../images/test.gif" width="16" height="16" border="0" align="absmiddle">
                        <strong>หน้าที่</strong> <?php
// Begin Prev/Next Links 
// Don't display PREV link if on first page 
                            if ($offset !=0) {
                                $prevoffset=$offset-$limit;

                                echo   "<a href='list_card_userdb.php?offset=$prevoffset&txt_search=$txt_search&UserName=$UserName'>
<font  color=\"red\"><< ก่อนหน้า</font></a>\n\n";
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
                                    echo  "<a href='list_card_userdb.php?offset=$newoffset&txt_search=$txt_search&UserName=$UserName'     >
				  <font  color=\"black\">$i</font></a>\n\n"; 
                                }
                            }

                            // Check to see if current page is last page
                            if (!((($offset/$limit)+1)==$pages) && $pages!=1) {
                                // Not on the last page yet, so display a NEXT Link
                                $newoffset=$offset+$limit;
                                echo   "<a href='list_card_userdb.php?offset=$newoffset&txt_search=$txt_search&UserName=$UserName'>
		  <font  color=\"red\">ถัดไป>></font></a>\n"; 
                            }
                            ?></td>
                </tr>
            </table>
                <?	 } ?>
        </form>
        <?php
        mysql_close($connect_db);
        ?>
        <p align="right"><?php //print $sql;?></p>

        <div align="center"></div>
    </body>
</html>
