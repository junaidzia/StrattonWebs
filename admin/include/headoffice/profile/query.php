<?php
    // ADD ADMIN PROFILE
	if(isset($_POST['submit_profile'])) {

		$adm_id =	$_SESSION['userlogininfo']['LOGINIDA'];

		$values = array(
							 'adm_fullname'				=>	cleanvars($_POST['adm_fullname'])
							,'adm_email'				=>	cleanvars($_POST['adm_email'])
							,'adm_phone'				=>	cleanvars($_POST['adm_phone'])
							,'id_modify'				=>	$adm_id
							,'date_modify'				=>	date('Y-m-d h:i:s')
						); 

		$sqllms = $dblms->Update(ADMINS , $values , "WHERE adm_id  = '".$adm_id."'");

		if($sqllms) { 

			// UPDATE PROFILE IMAGE
			if(!empty($_FILES['adm_photo']['name'])) {

				$path_parts 	= pathinfo($_FILES["adm_photo"]["name"]);
				$extension 		= strtolower($path_parts['extension']);
				if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG'))) {
					$img_dir 		= '../images/admin/';
					$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['adm_fullname'])).'-'.$adm_id.".".($extension);
					$img_fileName	= to_seo_url(cleanvars($_POST['adm_fullname'])).'-'.$adm_id.".".($extension);
					$dataImage = array(
										'adm_photo'	=>	$img_fileName, 
									  );
					$sqllmsUpdateCNIC = $dblms->Update(ADMINS, $dataImage, "WHERE adm_id = '".$adm_id."'");
					unset($sqllmsUpdateCNIC);
					$mode = '0644';
					if (move_uploaded_file($_FILES['adm_photo']['tmp_name'],$originalImage))
					{
						$_SESSION['userlogininfo']['LOGINPHOTO']	=	$img_fileName;
					}
					chmod ($originalImage, octdec($mode));
				}

			}

			$_SESSION['userlogininfo']['LOGINMAIL'] 	=	$_POST['adm_email'];
			$_SESSION['userlogininfo']['LOGINPHONE'] 	=	$_POST['adm_phone'];
			$_SESSION['userlogininfo']['LOGINNAME'] 	=	$_POST['adm_fullname'];
			sendRemark("Profile Setting Has Changed",'2',$adm_id);
			sessionMsg('Successfully','Record Suuccessfully Added','success');
			header("Location: profile.php", true, 301);
			exit();
		}
	}
	//CHANGE PASSWORD
	if(isset($_POST['chnage_pass'])) { 
		//HASHING
		$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
		$pass = $_POST['cnfrm_pass'];
		$password = hash('sha256', $pass . $salt);
		for ($round = 0; $round < 65536; $round++) {
			$password = hash('sha256', $password . $salt);
		}
		echo $password;
		$values = array(
							 'adm_salt'		=>	cleanvars($salt)
							,'adm_userpass'	=>	cleanvars($password)
							,'id_modify'	=> 	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_modify'	=>	date('Y-m-d H:i:s')
					);   
		$sqllms = $dblms->Update(ADMINS , $values , " WHERE adm_id  = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'");	
		if($sqllms) { 
			sendRemark("Password Has Changed",'2',cleanvars($_SESSION['userlogininfo']['LOGINIDA']));
			sessionMsg('Successfully','Password Changed','success');
			header("Location: profile.php", true, 301);
			exit();
		}
	}
?>