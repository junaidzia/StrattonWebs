<?php
    // ADD RECORD
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "platform_id",
								'where' 	=> array( 
														 'platform_title'=>	cleanvars($_POST['platform_title'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(PLATFORMS , $condition)) {
			sessionMsg('Error','Record Already Exists.','danger');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}else{

			$values = array(
							 	 'platform_status'  		=>	cleanvars($_POST['platform_status'])
							 	,'platform_title'			=>	cleanvars($_POST['platform_title'])
							 	,'platform_title_support'	=>	cleanvars($_POST['platform_title_support'])
							 	,'platform_short_des'		=>	cleanvars($_POST['platform_short_des'])
							 	,'platform_long_des'		=>	cleanvars($_POST['platform_long_des'])
							 	,'platform_btn_title'		=>	cleanvars($_POST['platform_btn_title'])
							 	,'platform_url'				=>	cleanvars(to_seo_url($_POST['platform_title']))
								,'id_added'					=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'				=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms		=	$dblms->insert(PLATFORMS, $values);
			
			if($sqllms) { 
				$latestID   =	$dblms->lastestid();
				if(!empty($_FILES['platform_img']['name'])) {
					$img_dir = "../images/platforms/";
					$path_parts 			= pathinfo($_FILES["platform_img"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['platform_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['platform_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'platform_img' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(PLATFORMS, $dataImage, "WHERE platform_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['platform_img']['tmp_name'],$originalImage);
						}
					}
				}
				if(!empty($_FILES['platform_banner']['name'])) {
					$img_dir = "../images/platforms/banner/";
					$path_parts 			= pathinfo($_FILES["platform_banner"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['platform_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['platform_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'platform_banner' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(PLATFORMS, $dataImage, "WHERE platform_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['platform_banner']['tmp_name'],$originalImage);
						}
					}
				}
				if(!empty($_FILES['platform_desimg']['name'])) {
					$img_dir = "../images/platforms/image/";
					$path_parts 			= pathinfo($_FILES["platform_desimg"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['platform_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['platform_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'platform_desimg' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(PLATFORMS, $dataImage, "WHERE platform_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['platform_desimg']['tmp_name'],$originalImage);
						}
					}
				}
				foreach ($_POST['pd_title'] as $key => $value) {					
						$values = array(
							 'pd_title'			=>	cleanvars($_POST['pd_title'][$key])
							,'pd_des'			=>	cleanvars($_POST['pd_des'][$key])
							,'id_platform'		=>	cleanvars($latestID)
						); 
						$sqllms_detial	=	$dblms->insert(PLATFORMDETAIL, $values);
						$latest_ID   =	$dblms->lastestid();
				}

				sendRemark(moduleName(0).' Added', '1',"$latestID");
				sessionMsg('Successfully', 'Record Successfully Added.', 'success');
				header("Location: ".moduleName().".php", true, 301);
				exit();
			}
		}
	}

    // EDIT RECORD
	if(isset($_POST['submit_edit'])) {
		$condition	=	array ( 
								'select' 	=> "platform_id",
								'where' 	=> array( 
														'platform_title'		=>	cleanvars($_POST['platform_title'])
														,'is_deleted'			=>	'0'	
													),
								'not_equal' 	=> array( 
														'platform_id'		=>	cleanvars($_POST['platform_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(PLATFORMS, $condition)) {
			sessionMsg('Error','Record Already Exists.','danger');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}else{
			$values = array(
								'platform_status'  		=>	cleanvars($_POST['platform_status'])
								,'platform_title'			=>	cleanvars($_POST['platform_title'])
								,'platform_title_support'	=>	cleanvars($_POST['platform_title_support'])
								,'platform_short_des'		=>	cleanvars($_POST['platform_short_des'])
								,'platform_long_des'		=>	cleanvars($_POST['platform_long_des'])
								,'platform_btn_title'		=>	cleanvars($_POST['platform_btn_title'])
								,'platform_url'				=>	cleanvars(to_seo_url($_POST['platform_title']))
								,'id_modify'				=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modify'				=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms = $dblms->Update(PLATFORMS, $values , "WHERE platform_id  = '".cleanvars($_POST['platform_id'])."'");
			if($sqllms) { 
				$latestID = $_POST['platform_id'];
				if(!empty($_FILES['platform_img']['name'])) {
					$img_dir = "../images/platforms/";
					$path_parts 			= pathinfo($_FILES["platform_img"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['platform_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['platform_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'platform_img' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(PLATFORMS, $dataImage, "WHERE platform_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['platform_img']['tmp_name'],$originalImage);
						}
					}
				}
				if(!empty($_FILES['platform_banner']['name'])) {
					$img_dir = "../images/platforms/banner/";
					$path_parts 			= pathinfo($_FILES["platform_banner"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['platform_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['platform_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'platform_banner' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(PLATFORMS, $dataImage, "WHERE platform_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['platform_banner']['tmp_name'],$originalImage);
						}
					}
				}
				if(!empty($_FILES['platform_desimg']['name'])) {
					$img_dir = "../images/platforms/image/";
					$path_parts 			= pathinfo($_FILES["platform_desimg"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['platform_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['platform_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'platform_desimg' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(PLATFORMS, $dataImage, "WHERE platform_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['platform_desimg']['tmp_name'],$originalImage);
						}
					}
				}
				$dblms->querylms("DELETE FROM ".PLATFORMDETAIL." WHERE id_platform=".$latestID);

				foreach ($_POST['pd_title'] as $key => $value) {					
						$values = array(
							 'pd_title'			=>	cleanvars($_POST['pd_title'][$key])
							,'pd_des'			=>	cleanvars($_POST['pd_des'][$key])
							,'id_platform'		=>	cleanvars($latestID)
						); 
						$sqllms_detial	=	$dblms->insert(PLATFORMDETAIL, $values);
						$latest_ID   =	$dblms->lastestid();
				}
				sendRemark(moduleName(0).' Updates ID:', '2',cleanvars($latestID));
				sessionMsg('Successfully', 'Record Successfully Updated.', 'info');
				header("Location: ".moduleName().".php", true, 301);
				exit();
			}
		}
	}

	// DELETE RECORD
	if(isset($_GET['deleteid'])) {
		$values = array(
						 'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')
					   );   

		$sqlDel = $dblms->Update(PLATFORMS, $values , "WHERE platform_id  = '".cleanvars($_GET['deleteid'])."'");
		if($sqlDel) { 
			sendRemark('Deleted '.moduleName(0), '3' , cleanvars($_GET['deleteid']));
			sessionMsg('Warning', 'Record Successfully Deleted.', 'warning');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}
	}
?>