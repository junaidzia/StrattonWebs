<?php

    // EDIT RECORD
	if(isset($_POST['submit_edit'])) {
		$condition	=	array ( 
								'select' 	=> "contact_id",
								'where' 	=> array( 
														'contact_title'		=>	cleanvars($_POST['contact_title'])
													),
								'not_equal' 	=> array( 
														'contact_id'		=>	cleanvars($_POST['contact_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(CONTACT, $condition)) {
			sessionMsg('Error','Record Already Exists.','danger');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}else{
			$contact_social = array();
			foreach ($_POST['socialkey'] as $key => $value) {
				$contact_social[$value] = $_POST['social'][$key];
			}
			$contact_countries = array();
			foreach ($_POST['contactkey'] as $key => $value) {
				if($_POST['contact_countries'][$key] || $_POST['contact_countrie'][$key]){
					$contact_countries[$value][0] = $_POST['contact_countries'][$key];
					$contact_countries[$value][1] = $_POST['contact_countrie'][$key];
				}
			}
			$values = array(
								 'contact_title'			=>	cleanvars($_POST['contact_title'])
								,'contact_getintouch'		=>	cleanvars($_POST['contact_getintouch'])
								,'contact_countries'		=>	cleanvars(base64_encode(serialize($contact_countries)))
								,'contact_map'				=>	cleanvars($_POST['contact_map'])
								,'contact_social'			=>	cleanvars(base64_encode(serialize($contact_social)))
						   ); 

			$sqllms = $dblms->Update(CONTACT, $values , "WHERE contact_id  = '".cleanvars($_POST['contact_id'])."'");
			if($sqllms) { 
				$latestID   =	$_POST['contact_id'];
				if(!empty($_FILES['contact_banner']['name'])) {
					$img_dir = "../images/banner/";
					$path_parts 			= pathinfo($_FILES["contact_banner"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir."contact-banner.".($extension);
						$img_fileName		= "contact-banner.".($extension);
						$dataImage 			= array( 'contact_banner' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(CONTACT, $dataImage, "WHERE contact_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['contact_banner']['tmp_name'],$originalImage);
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

?>