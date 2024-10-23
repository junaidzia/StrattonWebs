<?php
    // ADD RECORD
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "service_id",
								'where' 	=> array( 
														 'service_title'=>	cleanvars($_POST['service_title'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(SERVICES , $condition)) {
			sessionMsg('Error','Record Already Exists.','danger');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}else{

			$values = array(
							 	 'service_status'  			=>	cleanvars($_POST['service_status'])
							 	,'service_title'			=>	cleanvars($_POST['service_title'])
							 	,'service_title_support'	=>	cleanvars($_POST['service_title_support'])
							 	,'service_subtitle'			=>	cleanvars($_POST['service_subtitle'])
							 	,'service_des'				=>	cleanvars($_POST['service_des'])
							 	,'service_bgdes'			=>	cleanvars($_POST['service_bgdes'])
							 	,'service_btn_title'		=>	cleanvars($_POST['service_btn_title'])
							 	,'service_url'				=>	cleanvars(to_seo_url($_POST['service_title']))
								,'id_added'					=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'				=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms		=	$dblms->insert(SERVICES, $values);
			
			if($sqllms) { 
				$latestID   =	$dblms->lastestid();
				if(!empty($_FILES['service_icon']['name'])) {
					$img_dir = "../images/services/icons/";
					$path_parts 			= pathinfo($_FILES["service_icon"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['service_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['service_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'service_icon' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(SERVICES, $dataImage, "WHERE service_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['service_icon']['tmp_name'],$originalImage);
						}
					}
				}
				if(!empty($_FILES['service_bg']['name'])) {
					$img_dir = "../images/services/backgrounds/";
					$path_parts 			= pathinfo($_FILES["service_bg"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['service_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['service_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'service_bg' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(SERVICES, $dataImage, "WHERE service_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['service_bg']['tmp_name'],$originalImage);
						}
					}
				}
				if(!empty($_FILES['service_img']['name'])) {
					$img_dir = "../images/services/";
					$path_parts 			= pathinfo($_FILES["service_img"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['service_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['service_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'service_img' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(SERVICES, $dataImage, "WHERE service_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['service_img']['tmp_name'],$originalImage);
						}
					}
				}
				if(!empty($_FILES['service_banner']['name'])) {
					$img_dir = "../images/services/banner/";
					$path_parts 			= pathinfo($_FILES["service_banner"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['service_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['service_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'service_banner' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(SERVICES, $dataImage, "WHERE service_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['service_banner']['tmp_name'],$originalImage);
						}
					}
				}
				foreach ($_POST['sd_title'] as $key => $value) {					
						$values = array(
							 'sd_title'			=>	cleanvars($_POST['sd_title'][$key])
							,'sd_des'			=>	cleanvars($_POST['sd_des'][$key])
							,'id_service'		=>	cleanvars($latestID)
						); 
						$sqllms_detial	=	$dblms->insert(SERVICEDETAIL, $values);
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
								'select' 	=> "service_id",
								'where' 	=> array( 
														'service_title'		=>	cleanvars($_POST['service_title'])
														,'is_deleted'	=>	'0'	
													),
								'not_equal' 	=> array( 
														'service_id'		=>	cleanvars($_POST['service_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(SERVICES, $condition)) {
			sessionMsg('Error','Record Already Exists.','danger');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}else{
			$values = array(
								 'service_status'  			=>	cleanvars($_POST['service_status'])
								,'service_title'			=>	cleanvars($_POST['service_title'])
								,'service_title_support'	=>	cleanvars($_POST['service_title_support'])
								,'service_subtitle'			=>	cleanvars($_POST['service_subtitle'])
								,'service_des'				=>	cleanvars($_POST['service_des'])
								,'service_bgdes'			=>	cleanvars($_POST['service_bgdes'])
								,'service_btn_title'		=>	cleanvars($_POST['service_btn_title'])
								,'service_url'				=>	cleanvars(to_seo_url($_POST['service_title']))
								,'id_modify'				=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modify'				=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms = $dblms->Update(SERVICES, $values , "WHERE service_id  = '".cleanvars($_POST['service_id'])."'");
			if($sqllms) { 
				$latestID = $_POST['service_id'];
				if(!empty($_FILES['service_icon']['name'])) {
					$img_dir = "../images/services/icons/";
					$path_parts 			= pathinfo($_FILES["service_icon"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['service_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['service_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'service_icon' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(SERVICES, $dataImage, "WHERE service_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['service_icon']['tmp_name'],$originalImage);
						}
					}
				}
				if(!empty($_FILES['service_bg']['name'])) {
					$img_dir = "../images/services/backgrounds/";
					$path_parts 			= pathinfo($_FILES["service_bg"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['service_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['service_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'service_bg' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(SERVICES, $dataImage, "WHERE service_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['service_bg']['tmp_name'],$originalImage);
						}
					}
				}
				if(!empty($_FILES['service_img']['name'])) {
					$img_dir = "../images/services/";
					$path_parts 			= pathinfo($_FILES["service_img"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['service_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['service_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'service_img' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(SERVICES, $dataImage, "WHERE service_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['service_img']['tmp_name'],$originalImage);
						}
					}
				}
				if(!empty($_FILES['service_banner']['name'])) {
					$img_dir = "../images/services/banner/";
					$path_parts 			= pathinfo($_FILES["service_banner"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['service_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['service_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'service_banner' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(SERVICES, $dataImage, "WHERE service_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['service_banner']['tmp_name'],$originalImage);
						}
					}
				}
				$dblms->querylms("DELETE FROM ".SERVICEDETAIL." WHERE id_service=".$latestID);

				foreach ($_POST['sd_title'] as $key => $value) {					
						$values = array(
							 'sd_title'			=>	cleanvars($_POST['sd_title'][$key])
							,'sd_des'			=>	cleanvars($_POST['sd_des'][$key])
							,'id_service'		=>	cleanvars($latestID)
						); 
						$sqllms_detial	=	$dblms->insert(SERVICEDETAIL, $values);
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

		$sqlDel = $dblms->Update(SERVICES, $values , "WHERE service_id  = '".cleanvars($_GET['deleteid'])."'");
		if($sqlDel) { 
			sendRemark('Deleted '.moduleName(0), '3' , cleanvars($_GET['deleteid']));
			sessionMsg('Warning', 'Record Successfully Deleted.', 'warning');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}
	}
?>