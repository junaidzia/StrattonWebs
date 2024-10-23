<?php
    // ADD RECORD
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "pp_id",
								'where' 	=> array( 
														 'pp_title'	=>	cleanvars($_POST['pp_title'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(PRIVACYPOLICY , $condition)) {
			sessionMsg('Error','Record Already Exists.','danger');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}else{

			$values = array(
							 	 'pp_status'  		=>	cleanvars($_POST['pp_status'])
							 	,'pp_title'		=>	cleanvars($_POST['pp_title'])
							 	,'pp_des'			=>	cleanvars($_POST['pp_des'])
								,'id_added'			=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'		=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms		=	$dblms->insert(PRIVACYPOLICY, $values);
			
			if($sqllms) { 
				$latestID   =	$dblms->lastestid();

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
								'select' 	=> "pp_id",
								'where' 	=> array( 
														'pp_title'		=>	cleanvars($_POST['pp_title'])
														,'is_deleted'	=>	'0'	
													),
								'not_equal' 	=> array( 
														'pp_id'		=>	cleanvars($_POST['pp_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(PRIVACYPOLICY, $condition)) {
			sessionMsg('Error','Record Already Exists.','danger');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}else{
			$values = array(
								 'pp_status'  		=>	cleanvars($_POST['pp_status'])
								,'pp_title'		=>	cleanvars($_POST['pp_title'])
								,'pp_des'			=>	cleanvars($_POST['pp_des'])
								,'id_modify'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modify'		=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms = $dblms->Update(PRIVACYPOLICY, $values , "WHERE pp_id  = '".cleanvars($_POST['pp_id'])."'");
			if($sqllms) { 
				$latestID   =	$_POST['pp_id'];

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

		$sqlDel = $dblms->Update(PRIVACYPOLICY, $values , "WHERE pp_id  = '".cleanvars($_GET['deleteid'])."'");
		if($sqlDel) { 
			sendRemark('Deleted '.moduleName(0), '3' , cleanvars($_GET['deleteid']));
			sessionMsg('Warning', 'Record Successfully Deleted.', 'warning');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}
	}
?>