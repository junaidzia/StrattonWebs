<?php
    // ADD RECORD
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "ss_id",
								'where' 	=> array( 
														 'ss_title'=>	cleanvars($_POST['ss_title'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(SUBSERVICES , $condition)) {
			sessionMsg('Error','Record Already Exists.','danger');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}else{

			$values = array(
							 	 'ss_status'  			=>	cleanvars($_POST['ss_status'])
							 	,'ss_title'				=>	cleanvars($_POST['ss_title'])
							 	,'ss_titlesupport'		=>	cleanvars($_POST['ss_titlesupport'])
							 	,'id_service'			=>	cleanvars($_POST['id_service'])
							 	,'ss_url'				=>	cleanvars(to_seo_url($_POST['ss_title']))
								,'id_added'				=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'			=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms		=	$dblms->insert(SUBSERVICES, $values);
			
			if($sqllms) { 
				$latestID   =	$dblms->lastestid();
				if(!empty($_FILES['ss_icon']['name'])) {
					$img_dir = "../images/services/sub_services/";
					$path_parts 			= pathinfo($_FILES["ss_icon"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['ss_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['ss_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'ss_icon' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(SUBSERVICES, $dataImage, "WHERE ss_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['ss_icon']['tmp_name'],$originalImage);
						}
					}
				}
				if(!empty($_FILES['ss_banner']['name'])) {
					$img_dir = "../images/services/sub_services/banner/";
					$path_parts 			= pathinfo($_FILES["ss_banner"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['ss_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['ss_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'ss_banner' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(SUBSERVICES, $dataImage, "WHERE ss_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['ss_banner']['tmp_name'],$originalImage);
						}
					}
				}
				foreach ($_POST['ssd_title'] as $key => $value) {					
						$values = array(
							 'ssd_title'		=>	cleanvars($_POST['ssd_title'][$key])
							,'ssd_des'			=>	cleanvars($_POST['ssd_des'][$key])
							,'id_ss'			=>	cleanvars($latestID)
						); 
						$sqllms_detial	=	$dblms->insert(SUBSERVICEDETAIL, $values);
						$latest_ID   =	$dblms->lastestid();
				}
				foreach ($_POST['ssc_title'] as $key => $value) {					
						$values = array(
							 'ssc_title'		=>	cleanvars($_POST['ssc_title'][$key])
							,'ssc_des'			=>	cleanvars($_POST['ssc_des'][$key])
							,'id_ss'			=>	cleanvars($latestID)
						); 
						$sqllms_detial	=	$dblms->insert(SUBSERVICECONTENT, $values);
						$latest_ID   =	$dblms->lastestid();
						if(!empty($_FILES['ssc_image']['name'][$key])) {
							$img_dir = "../images/services/sub_services/image/";
							$path_parts 			= pathinfo($_FILES['ssc_image']["name"][$key]);
							$extension 				= strtolower($path_parts['extension']);
							if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
								$originalImage		= $img_dir.to_seo_url($_POST['ss_title'])."-".$latest_ID.".".($extension);
								$img_fileName		= to_seo_url($_POST['ss_title'])."-".$latest_ID.".".($extension);
								$dataImage 			= array( 'ssc_image' => $img_fileName );
								$sqlUpdateImg 		= $dblms->Update(SUBSERVICECONTENT, $dataImage, "WHERE ssc_id = '".$latest_ID."'");
								if ($sqlUpdateImg) {
									move_uploaded_file($_FILES['ssc_image']['tmp_name'][$key],$originalImage);
								}
							}
						}
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
								'select' 	=> "ss_id",
								'where' 	=> array( 
														'ss_title'		=>	cleanvars($_POST['ss_title'])
														,'is_deleted'	=>	'0'	
													),
								'not_equal' 	=> array( 
														'ss_id'		=>	cleanvars($_POST['ss_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(SUBSERVICES, $condition)) {
			sessionMsg('Error','Record Already Exists.','danger');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}else{
			$values = array(
								 'ss_status'  			=>	cleanvars($_POST['ss_status'])
								,'ss_title'				=>	cleanvars($_POST['ss_title'])
								,'ss_titlesupport'		=>	cleanvars($_POST['ss_titlesupport'])
								,'id_service'			=>	cleanvars($_POST['id_service'])
								,'ss_url'				=>	cleanvars(to_seo_url($_POST['ss_title']))
								,'id_modify'			=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modify'			=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms = $dblms->Update(SUBSERVICES, $values , "WHERE ss_id  = '".cleanvars($_POST['ss_id'])."'");
			if($sqllms) { 
				$latestID = $_POST['ss_id'];
				if(!empty($_FILES['ss_icon']['name'])) {
					$img_dir = "../images/services/sub_services/";
					$path_parts 			= pathinfo($_FILES["ss_icon"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['ss_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['ss_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'ss_icon' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(SUBSERVICES, $dataImage, "WHERE ss_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['ss_icon']['tmp_name'],$originalImage);
						}
					}
				}
				if(!empty($_FILES['ss_banner']['name'])) {
					$img_dir = "../images/services/sub_services/banner/";
					$path_parts 			= pathinfo($_FILES["ss_banner"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['ss_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['ss_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'ss_banner' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(SUBSERVICES, $dataImage, "WHERE ss_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['ss_banner']['tmp_name'],$originalImage);
						}
					}
				}
				$dblms->querylms("DELETE FROM ".SUBSERVICEDETAIL." WHERE id_ss=".$latestID);
				$dblms->querylms("DELETE FROM ".SUBSERVICECONTENT." WHERE id_ss=".$latestID);

				foreach ($_POST['ssd_title'] as $key => $value) {					
					$values = array(
						 'ssd_title'		=>	cleanvars($_POST['ssd_title'][$key])
						,'ssd_des'			=>	cleanvars($_POST['ssd_des'][$key])
						,'id_ss'			=>	cleanvars($latestID)
					); 
					$sqllms_detial	=	$dblms->insert(SUBSERVICEDETAIL, $values);
					$latest_ID   =	$dblms->lastestid();
				}
				foreach ($_POST['ssc_title'] as $key => $value) {					
						$values = array(
							 'ssc_title'		=>	cleanvars($_POST['ssc_title'][$key])
							,'ssc_des'			=>	cleanvars($_POST['ssc_des'][$key])
							,'ssc_image'		=>	cleanvars($_POST['ssc_imageold'][$key])
							,'id_ss'			=>	cleanvars($latestID)
						); 
						$sqllms_detial	=	$dblms->insert(SUBSERVICECONTENT, $values);
						$latest_ID   =	$dblms->lastestid();
						if(!empty($_FILES['ssc_image']['name'][$key])) {
							$img_dir = "../images/services/sub_services/image/";
							$path_parts 			= pathinfo($_FILES['ssc_image']["name"][$key]);
							$extension 				= strtolower($path_parts['extension']);
							if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
								$originalImage		= $img_dir.to_seo_url($_POST['ss_title'])."-".$latest_ID.".".($extension);
								$img_fileName		= to_seo_url($_POST['ss_title'])."-".$latest_ID.".".($extension);
								$dataImage 			= array( 'ssc_image' => $img_fileName );
								$sqlUpdateImg 		= $dblms->Update(SUBSERVICECONTENT, $dataImage, "WHERE ssc_id = '".$latest_ID."'");
								if ($sqlUpdateImg) {
									move_uploaded_file($_FILES['ssc_image']['tmp_name'][$key],$originalImage);
								}
							}
						}
				}
				sendRemark(moduleName(0).' Updates ID:', '2',cleanvars($latestID));
				sessionMsg('Successfully', 'Record Successfully Updated.', 'info');
				header("Location: ".moduleName().".php", true, 301);
				exit();
			}else{
			    exit;
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

		$sqlDel = $dblms->Update(SUBSERVICES, $values , "WHERE ss_id  = '".cleanvars($_GET['deleteid'])."'");
		if($sqlDel) { 
			sendRemark('Deleted '.moduleName(0), '3' , cleanvars($_GET['deleteid']));
			sessionMsg('Warning', 'Record Successfully Deleted.', 'warning');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}
	}
?>