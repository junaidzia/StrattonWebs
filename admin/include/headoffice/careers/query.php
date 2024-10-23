<?php
    // ADD RECORD
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "career_id",
								'where' 	=> array( 
														 'career_title'	=>	cleanvars($_POST['career_title'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(CAREERS , $condition)) {
			sessionMsg('Error','Record Already Exists.','danger');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}else{

			$values = array(
							 	 'career_status'  		=>	cleanvars($_POST['career_status'])
							 	,'career_title'			=>	cleanvars($_POST['career_title'])
							 	,'career_des'			=>	cleanvars($_POST['career_des'])
								,'id_added'				=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'			=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms		=	$dblms->insert(CAREERS, $values);
			
			if($sqllms) { 
				$latestID   =	$dblms->lastestid();
				foreach ($_POST['cd_title'] as $key => $value) {					
						$values = array(
							 'cd_title'			=>	cleanvars($_POST['cd_title'][$key])
							,'cd_highlight'		=>	cleanvars($_POST['cd_highlight'][$key])
							,'id_career'		=>	cleanvars($latestID)
						); 
						$sqllms_detial	=	$dblms->insert(CAREERDETAIL, $values);
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
								'select' 	=> "career_id",
								'where' 	=> array( 
														'career_title'		=>	cleanvars($_POST['career_title'])
														,'is_deleted'		=>	'0'	
													),
								'not_equal' 	=> array( 
														'career_id'		=>	cleanvars($_POST['career_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(CAREERS, $condition)) {
			sessionMsg('Error','Record Already Exists.','danger');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}else{
			$values = array(
								 'career_status'  		=>	cleanvars($_POST['career_status'])
								,'career_title'			=>	cleanvars($_POST['career_title'])
								,'career_des'			=>	cleanvars($_POST['career_des'])
								,'id_modify'			=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modify'			=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms = $dblms->Update(CAREERS, $values , "WHERE career_id  = '".cleanvars($_POST['career_id'])."'");
			if($sqllms) { 
				$latestID   =	$_POST['career_id'];
				$dblms->querylms("DELETE FROM ".CAREERDETAIL." WHERE id_career=".$latestID);

				foreach ($_POST['cd_title'] as $key => $value) {					
					$values = array(
						 'cd_title'			=>	cleanvars($_POST['cd_title'][$key])
						,'cd_highlight'		=>	cleanvars($_POST['cd_highlight'][$key])
						,'id_career'		=>	cleanvars($latestID)
					); 
					$sqllms_detial	=	$dblms->insert(CAREERDETAIL, $values);
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

		$sqlDel = $dblms->Update(CAREERS, $values , "WHERE career_id  = '".cleanvars($_GET['deleteid'])."'");
		if($sqlDel) { 
			sendRemark('Deleted '.moduleName(0), '3' , cleanvars($_GET['deleteid']));
			sessionMsg('Warning', 'Record Successfully Deleted.', 'warning');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}
	}
?>