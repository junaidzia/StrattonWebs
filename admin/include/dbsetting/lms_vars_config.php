<?php
// error_reporting(0);
ob_start();
ob_clean();
date_default_timezone_set("Asia/Karachi");

define('LMS_HOSTNAME'			    , 'localhost');
// define('LMS_NAME'				    , 'strakqpy_s');
// define('LMS_USERNAME'			    , 'strakqpy_s');
// define('LMS_USERPASS'			    , 'PBcYsyjE756uD@8');
define('LMS_NAME'				    , 'ameresfr_website');
define('LMS_USERNAME'			    , 'root');
define('LMS_USERPASS'			    , '');

// DB Tables
define('ADMINS'					    , 'admin');
define('LOGIN_HISTORY'			    , 'login_history');
define('LOGS'			            , 'logfile');
define('SERVICES'     				, 'services');
define('SERVICEDETAIL'     			, 'service_detail');
define('SUBSERVICES'     			, 'service_sub');
define('SUBSERVICEDETAIL'  			, 'service_subdetail');
define('SUBSERVICECONTENT' 			, 'service_subcontent');
define('PLATFORMS'     				, 'platforms');
define('PLATFORMDETAIL'     		, 'platform_detail');
define('PROJECTS'        		    , 'projects');
define('CAREERS'        		    , 'careers');
define('CAREERDETAIL'      		    , 'career_detail');
define('BLOGS'      		        , 'blogs');
define('ABOUT'      		        , 'about');
define('ABOUTLANGUAGE' 		        , 'about_language');
define('CONTACT' 		            , 'contact');
define('FAQS' 		                , 'faqs');
define('PRIVACYPOLICY'              , 'privacy_policy');
define('TERMANDCONDITIONS'          , 'term_and_conditions');
define('TEAMS'                      , 'teams');
define('GETINTOUCH'                 , 'get_in_touch');
define('CONTACTUS'                  , 'contact_us');

$control 		                    = (isset($_REQUEST['control']) && $_REQUEST['control'] != '') ? $_REQUEST['control'] : '';
$zone 	 		                    = (isset($_REQUEST['zone']) && $_REQUEST['zone'] != '') ? $_REQUEST['zone'] : '';
$ip	  			                    = (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] != '') ? $_SERVER['REMOTE_ADDR'] : '';
$do	  			                    = (isset($_REQUEST['do']) && $_REQUEST['do'] != '') ? $_REQUEST['do'] : '';
$view 			                    = (isset($_REQUEST['view']) && $_REQUEST['view'] != '') ? $_REQUEST['view'] : '';
$page			                    = (isset($_REQUEST['page']) && $_REQUEST['page'] != '') ? $_REQUEST['page'] : '';
$current_page	                    = (isset($_REQUEST['page']) && $_REQUEST['page'] != '') ? $_REQUEST['page'] : 1;
$Limit			                    = (isset($_REQUEST['Limit']) && $_REQUEST['Limit'] != '') ? $_REQUEST['Limit'] : '';

define('TITLE_HEADER'		        , 'Stratton Webs');
define("SITE_NAME"			        , "Stratton Webs");
define("SITE_PHONE"			        , "+32 60 87 78 29");
define("SITE_WHATSAPP"		        , "+92 326 087 7829");
define("SITE_EMAIL"			        , "apportionfoundation@gmail.com");
define("SITE_ADDRESS"		        , "Signature plaza Civil defense road near bikes market, Township Lahore.");
define("SITE_BIO"			        , "Empowering society, reducing dependency & improving lives");
// define("SITE_URL"	    	        , "https://strattonwebs.com/");
define("SITE_URL"	    	        , "http://localhost/projects/strattonwebs/");
define('LMS_IP'				        , $ip);
define('LMS_DO'				        , $do);
define('LMS_EPOCH'			        , date("U"));
define('LMS_VIEW'			        , $view);
define("COPY_RIGHTS"		        , "Stratton Webs");
define("COPY_RIGHTS_ORG"	        , "Copyright &copy; ".date("Y")." - All Rights Reserved.");
define("COPY_RIGHTS_URL"	        , "https://strattonwebs.com/");
define("COMPANY_ID"	                , 0);
define("MANAGER_ID"	                , 0);

?>