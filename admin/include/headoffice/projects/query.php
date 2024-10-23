<?php
    // ADD RECORD
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "project_id",
								'where' 	=> array( 
														 'project_title'=>	cleanvars($_POST['project_title'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(PROJECTS , $condition)) {
			sessionMsg('Error','Record Already Exists.','danger');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}else{

			$values = array(
							 	 'project_status'  			=>	cleanvars($_POST['project_status'])
							 	,'project_title'			=>	cleanvars($_POST['project_title'])
							 	,'project_title_support'	=>	cleanvars($_POST['project_title_support'])
							 	,'project_des'				=>	cleanvars($_POST['project_des'])
							 	,'project_challanges'		=>	cleanvars($_POST['project_challanges'])
							 	,'project_solutions'		=>	cleanvars($_POST['project_solutions'])
							 	,'project_btn_title'		=>	cleanvars($_POST['project_btn_title'])
							 	,'project_web'				=>	cleanvars($_POST['project_web'])
							 	,'id_platform'				=>	cleanvars($_POST['id_platform'])
							 	,'id_services'				=>	cleanvars($_POST['id_services'])
							 	,'project_url'				=>	cleanvars(to_seo_url($_POST['project_title']))
								,'id_added'					=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'				=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms		=	$dblms->insert(PROJECTS, $values);
			
			if($sqllms) { 
				$latestID   =	$dblms->lastestid();
				if(!empty($_FILES['project_img']['name'])) {
					$img_dir = "../images/projects/";
					$path_parts 			= pathinfo($_FILES["project_img"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['project_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['project_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'project_img' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(PROJECTS, $dataImage, "WHERE project_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['project_img']['tmp_name'],$originalImage);
						}
					}
				}
				if(!empty($_FILES['project_banner']['name'])) {
					$img_dir = "../images/projects/banner/";
					$path_parts 			= pathinfo($_FILES["project_banner"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['project_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['project_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'project_banner' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(PROJECTS, $dataImage, "WHERE project_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['project_banner']['tmp_name'],$originalImage);
						}
					}
				}
				if(!empty($_FILES['project_desimg']['name'])) {
					$img_dir = "../images/projects/image/";
					$path_parts 			= pathinfo($_FILES["project_desimg"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['project_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['project_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'project_desimg' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(PROJECTS, $dataImage, "WHERE project_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['project_desimg']['tmp_name'],$originalImage);
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
								'select' 	=> "project_id",
								'where' 	=> array( 
														'project_title'		=>	cleanvars($_POST['project_title'])
														,'is_deleted'			=>	'0'	
													),
								'not_equal' 	=> array( 
														'project_id'		=>	cleanvars($_POST['project_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(PROJECTS, $condition)) {
			sessionMsg('Error','Record Already Exists.','danger');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}else{
			$values = array(
								 'project_status'  			=>	cleanvars($_POST['project_status'])
								,'project_title'			=>	cleanvars($_POST['project_title'])
								,'project_title_support'	=>	cleanvars($_POST['project_title_support'])
								,'project_des'				=>	cleanvars($_POST['project_des'])
								,'project_challanges'		=>	cleanvars($_POST['project_challanges'])
								,'project_solutions'		=>	cleanvars($_POST['project_solutions'])
								,'project_btn_title'		=>	cleanvars($_POST['project_btn_title'])
								,'project_web'				=>	cleanvars($_POST['project_web'])
								,'id_platform'				=>	cleanvars($_POST['id_platform'])
								,'id_services'				=>	cleanvars($_POST['id_services'])
								,'project_url'				=>	cleanvars(to_seo_url($_POST['project_title']))
								,'id_modify'				=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modify'				=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms = $dblms->Update(PROJECTS, $values , "WHERE project_id  = '".cleanvars($_POST['project_id'])."'");
			if($sqllms) { 
				$latestID = $_POST['project_id'];
				if(!empty($_FILES['project_img']['name'])) {
					$img_dir = "../images/projects/";
					$path_parts 			= pathinfo($_FILES["project_img"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['project_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['project_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'project_img' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(PROJECTS, $dataImage, "WHERE project_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['project_img']['tmp_name'],$originalImage);
						}
					}
				}
				if(!empty($_FILES['project_banner']['name'])) {
					$img_dir = "../images/projects/banner/";
					$path_parts 			= pathinfo($_FILES["project_banner"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['project_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['project_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'project_banner' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(PROJECTS, $dataImage, "WHERE project_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['project_banner']['tmp_name'],$originalImage);
						}
					}
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

		$sqlDel = $dblms->Update(PROJECTS, $values , "WHERE project_id  = '".cleanvars($_GET['deleteid'])."'");
		if($sqlDel) { 
			sendRemark('Deleted '.moduleName(0), '3' , cleanvars($_GET['deleteid']));
			sessionMsg('Warning', 'Record Successfully Deleted.', 'warning');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}
	}
?>