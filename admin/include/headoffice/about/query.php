<?php

    // EDIT RECORD
	if(isset($_POST['submit_edit'])) {
		$condition	=	array ( 
								'select' 	=> "about_id",
								'where' 	=> array( 
														'about_title'		=>	cleanvars($_POST['about_title'])
													),
								'not_equal' 	=> array( 
														'about_id'		=>	cleanvars($_POST['about_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(ABOUT, $condition)) {
			sessionMsg('Error','Record Already Exists.','danger');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}else{
			$values = array(
								 'about_title'			=>	cleanvars($_POST['about_title'])
								,'about_des'			=>	cleanvars($_POST['about_des'])
						   ); 

			$sqllms = $dblms->Update(ABOUT, $values , "WHERE about_id  = '".cleanvars($_POST['about_id'])."'");
			if($sqllms) { 
				$latestID   =	$_POST['about_id'];
				if(!empty($_FILES['about_banner']['name'])) {
					$img_dir = "../images/banner/";
					$path_parts 			= pathinfo($_FILES["about_banner"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir."about-banner.".($extension);
						$img_fileName		= "about-banner.".($extension);
						$dataImage 			= array( 'about_banner' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(ABOUT, $dataImage, "WHERE about_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['about_banner']['tmp_name'],$originalImage);
						}
					}
				}
				$dblms->querylms("DELETE FROM ".ABOUTLANGUAGE." WHERE id_about=".$latestID);

				foreach ($_POST['al_name'] as $key => $value) {					
					$values = array(
						 'al_name'		=>	cleanvars($_POST['al_name'][$key])
						,'al_per'		=>	cleanvars($_POST['al_per'][$key])
						,'id_about'		=>	cleanvars($latestID)
					); 
					$sqllms_detial	=	$dblms->insert(ABOUTLANGUAGE, $values);
				}
				sendRemark(moduleName(0).' Updates ID:', '2',cleanvars($latestID));
				sessionMsg('Successfully', 'Record Successfully Updated.', 'info');
				header("Location: ".moduleName().".php", true, 301);
				exit();
			}
		}
	}

?>