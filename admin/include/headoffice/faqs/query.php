<?php
    // ADD RECORD
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "faq_id",
								'where' 	=> array( 
														 'faq_title'	=>	cleanvars($_POST['faq_title'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(FAQS , $condition)) {
			sessionMsg('Error','Record Already Exists.','danger');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}else{

			$values = array(
							 	 'faq_status'  		=>	cleanvars($_POST['faq_status'])
							 	,'faq_title'		=>	cleanvars($_POST['faq_title'])
							 	,'faq_des'			=>	cleanvars($_POST['faq_des'])
								,'id_added'			=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'		=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms		=	$dblms->insert(FAQS, $values);
			
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
								'select' 	=> "faq_id",
								'where' 	=> array( 
														'faq_title'		=>	cleanvars($_POST['faq_title'])
														,'is_deleted'	=>	'0'	
													),
								'not_equal' 	=> array( 
														'faq_id'		=>	cleanvars($_POST['faq_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(FAQS, $condition)) {
			sessionMsg('Error','Record Already Exists.','danger');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}else{
			$values = array(
								 'faq_status'  		=>	cleanvars($_POST['faq_status'])
								,'faq_title'		=>	cleanvars($_POST['faq_title'])
								,'faq_des'			=>	cleanvars($_POST['faq_des'])
								,'id_modify'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modify'		=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms = $dblms->Update(FAQS, $values , "WHERE faq_id  = '".cleanvars($_POST['faq_id'])."'");
			if($sqllms) { 
				$latestID   =	$_POST['faq_id'];

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

		$sqlDel = $dblms->Update(FAQS, $values , "WHERE faq_id  = '".cleanvars($_GET['deleteid'])."'");
		if($sqlDel) { 
			sendRemark('Deleted '.moduleName(0), '3' , cleanvars($_GET['deleteid']));
			sessionMsg('Warning', 'Record Successfully Deleted.', 'warning');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}
	}
?>