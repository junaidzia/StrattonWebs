<?php
    // ADD RECORD
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "team_id",
								'where' 	=> array( 
														 'team_name'	=>	cleanvars($_POST['team_name'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(TEAMS , $condition)) {
			sessionMsg('Error','Record Already Exists.','danger');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}else{
			$contact_social = array();
			foreach ($_POST['socialkey'] as $key => $value) {
				if($_POST['social'][$key]){
					$contact_social[$value] = $_POST['social'][$key];
				}
			}

			$values = array(
							 	 'team_status'  			=>	cleanvars($_POST['team_status'])
							 	,'team_name'				=>	cleanvars($_POST['team_name'])
							 	,'team_position'			=>	cleanvars($_POST['team_position'])
							 	,'team_des'					=>	cleanvars($_POST['team_des'])
							 	,'team_social'				=>	cleanvars(base64_encode(serialize($contact_social)))
								,'id_added'					=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'				=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms		=	$dblms->insert(TEAMS, $values);
			
			if($sqllms) { 
				$latestID   =	$dblms->lastestid();
				if(!empty($_FILES['team_img']['name'])) {
					$img_dir = "../images/teams/";
					$path_parts 			= pathinfo($_FILES["team_img"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['team_name'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['team_name'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'team_img' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(TEAMS, $dataImage, "WHERE team_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['team_img']['tmp_name'],$originalImage);
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
								'select' 	=> "team_id",
								'where' 	=> array( 
														 'team_name'		=>	cleanvars($_POST['team_name'])
														,'is_deleted'		=>	'0'	
													),
								'not_equal' 	=> array( 
														'team_id'		=>	cleanvars($_POST['team_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(TEAMS, $condition)) {
			sessionMsg('Error','Record Already Exists.','danger');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}else{
			$contact_social = array();
			foreach ($_POST['socialkey'] as $key => $value) {
				if($_POST['social'][$key]){
					$contact_social[$value] = $_POST['social'][$key];
				}
			}
			$values = array(
								 'team_status'  			=>	cleanvars($_POST['team_status'])
								,'team_name'				=>	cleanvars($_POST['team_name'])
								,'team_position'			=>	cleanvars($_POST['team_position'])
								,'team_des'					=>	cleanvars($_POST['team_des'])
								,'team_social'				=>	cleanvars(base64_encode(serialize($contact_social)))
								,'id_modify'				=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modify'				=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms = $dblms->Update(TEAMS, $values , "WHERE team_id  = '".cleanvars($_POST['team_id'])."'");
			if($sqllms) { 
				$latestID = $_POST['team_id'];
				if(!empty($_FILES['team_img']['name'])) {
					$img_dir = "../images/teams/";
					$path_parts 			= pathinfo($_FILES["team_img"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['team_name'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['team_name'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'team_img' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(TEAMS, $dataImage, "WHERE team_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['team_img']['tmp_name'],$originalImage);
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

		$sqlDel = $dblms->Update(TEAMS, $values , "WHERE team_id  = '".cleanvars($_GET['deleteid'])."'");
		if($sqlDel) { 
			sendRemark('Deleted '.moduleName(0), '3' , cleanvars($_GET['deleteid']));
			sessionMsg('Warning', 'Record Successfully Deleted.', 'warning');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}
	}
?>