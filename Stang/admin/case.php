  <?php
                               switch ($case_i) { 
                                                       
    case 1:
   include("list_userdb.php");
		    break;     
     case 2:
    include("list_user_all.php"); 
            break;

     case 3:
   include("List_ip_bit.php");
		   break;
     case 4:
   include("edit_password.php");
   break;										                   
     case 5:
   include("list_syslog.php");
   break;
     case 6:
   include("list_user_bad.php"); //  ���ͼ����ҹ��� lock ���
   break;
     case 7:
   include("List_user_online.php");
   break;
 case 8:
   include("list_problem.php");
   break;   
 case 9:
   include("report_problem.php");
   break;   		   									
 case 10:
   include("choot_report.php");
   break;
 case 11:
   include("report_web_access_time.php");
	      break;
 case 12:
   include("add_admin.php");
   break;
     case 13:
 //  include("gen_report_squid.php");
      include("list_proxy.php");
   break;					
     case 14:
   include("block_web.php");
   break;   
     case 16:
   include("add_group.php");
   break;
     case 17:
   include("edit_group.php");
   break;
     case 18:
   include("register.php");
   break;   
     case 19:
   include("list_user_group.php");
   break;
     case 20:
  // include("add_server.php");
    include("mikrotik_link.php");
 //include("22.php");  
	      break;
     case 21:
   include("choose_report_log.php");
   break;
     case 22:
   include("edit_server.php");
   break;
     case 23:
   include("graph.php");
   break;
     case 24:
   include("report_web_access_time2.php");
   break;
     case 25:
   include("status.php");
   break;
     case 26:
   include("edit_admin.php");
   break;
     case 27:
   include("system.php");
   break;         										
     case 28:
   include("find_mac.php");
   break;
     case 29:
   include("list_files_bk.php");
   break;
	case  30:
   include("firewall.php");
   break;
	case  31:
   include("upload_excel.php");
   break;
	case  32:
   include("add_news.php");
   break;
	case  33:
   include("add_logo.php");
   break;   
	case  34:
   include("add_ipaddress.php");
   break;
	case  35:
   include("add_bat.php");
   break;
      case 36:
   include("seting.php");
   break;
      case 37:
   include("List_mac.php");
   break;
	   case 38:
   include("list_card.php");
   break;
	   case 39:
   include("list_card2.php");
   break;
	   case 45:
   include("block_mac.php");
   break;														
	   case 46:
   include("List_mac2.php");
   break;
	   case 47:
   include("list_card_user_Group_active.php");
   		 break;
	   case 48:
   include("choose_report_log-mail.php");
   break;
 	    case 49:
   include("choose_report_log-ssh.php");
   break;		
	    case 50:
   include("add_accesspoint.php");
   break;   			
	    case 51:
   include("limit_download.php");
   break;		
	    case 52:
   include("promotion_date.php");
   break;   	
		 case  53:
  // include("mac_reg.php");
  include("mikrotik_add_allow_mac.php");
  
   break;   	
 case 54:
   include("choose_report_log_hw.php");
   break;
 case 55:
   include("delete_user_unlogin.php");
   break;
 case 56:
   include("netstat.php");
   break;
 case 57:
   include("vnstat.php");
   break;   
 case 58:
   include("upload_sql.php");
   break;	
 case 59:
   include("view_statistics.php");
   break;	
 case 60:
   include("report_login.php");
   break;		
 case 61:
   include("frm_mail.php");
   break;	
 case 62:
   include("report_login_time.php");
   break;		
 case 63:
   include("report_login_time_week.php");
   break;   
 case 64:
   include("report_login_time_mouth.php");
   break;		   		 									   	 	                                                         case 65:
   include("report_login_time_year.php");
   break;	  
	    case 66:
   include("fixip.php");
   break;	
	   case 67:
   include("list_vpn.php");
   break;	                                                      
	   case 68:
   include("list_admin_login.php");
   break;	
	   case 69:
   include("add_phpmyadmin.php");
   break;	
   	   case 70:
   include("list_admin_login2.php");
   break;	
      	   case 71:
   include("truemoney.php");
   break;	
      case 72:
   include("mikrotik_user_online.php");
   break;	
         case 73:
   include("list_true_money.php");
   break;	
            case 74:
   include("truemoney_seting.php");
   break;	
               case 75:
   include("sms_seting.php");
   break;	
                case 76:
   include("admin_online.php");
   break;	
                 case 77:
   include("qos.php");
   break;	
                    case 78:
   include("mikrotik_user_online_all.php");
   break;	
                       case 79:
   include("list_true_money_all_domain.php");
   break;	
                case 80:
   include("mikrotik_neighbor.php");
   break;	
                 case 81:
   include("mikrotik_link_all.php");
   break;	
   
                    case 82:
   include("card_report_bat_shell.php");
   break;	
                    case 83:
   include("card_report_bat_shell_true.php");
   break;	   
 
                     case 84:
   include("mikrotik_profiles.php");
   break;	 
                       case 85:
   include("list_user_active_no_time.php");
   break;	  
   
 
   default:
														{	 include("main_admin.php");  
														break;}
														}
														?>