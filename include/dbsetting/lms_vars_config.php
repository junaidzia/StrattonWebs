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

// Variables
$ip	  		                = (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] != '') ? $_SERVER['REMOTE_ADDR'] : '';
$control 	                = (isset($_REQUEST['control']) && $_REQUEST['control'] != '') ? $_REQUEST['control'] : '';
$zone 	 	                = (isset($_REQUEST['zone']) && $_REQUEST['zone'] != '') ? $_REQUEST['zone'] : '';
$view 		                = (isset($_REQUEST['view']) && $_REQUEST['view'] != '') ? $_REQUEST['view'] : '';
$slug 		                = (isset($_REQUEST['slug']) && $_REQUEST['slug'] != '') ? $_REQUEST['slug'] : '';
$page    	                = (isset($_REQUEST['page']) && $_REQUEST['page'] != '') ? $_REQUEST['page'] : '1';
$pg    		                = (isset($_REQUEST['pg']) && $_REQUEST['pg'] != '') ? $_REQUEST['pg'] : '1';
$wrds    	                = (isset($_REQUEST['wrds']) && $_REQUEST['wrds'] != '') ? $_REQUEST['wrds'] : '';
$do = '';

define('LMS_IP'			    , 		$ip);
define('ZONE'			    , 		$zone);
define('CONTROLER'			, 		strtolower($control));
define('LMS_DO'			    , 		$do);
define('LMS_EPOCH'		    , 		date("U"));
define('LMS_VIEW'		    , 		$view);
// define("ADMIN_URL"	  		, 		"https://strattonwebs.com/admin/");
// define("SITE_URL"			,		"https://strattonwebs.com/");
define("ADMIN_URL"	  		, 		"http://localhost/projects/strattonwebs/admin/");
define("SITE_URL"			,		"http://localhost/projects/strattonwebs/");
define('TITLE_HEADER'		, 		'Stratton Webs');
define("SITE_NAME"			, 		"Stratton Webs");
define("COPY_RIGHTS"		, 		"Stratton Webs.");
define("COPY_RIGHTS_ORG"	, 		"&copy; ".date("Y")." - All Rights Reserved.");
define("COPY_RIGHTS_URL"	, 		"https://strattonwebs.com/");
?>