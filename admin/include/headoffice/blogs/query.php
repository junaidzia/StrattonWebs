<?php
    // ADD RECORD
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "blog_id",
								'where' 	=> array( 
														 'blog_title'	=>	cleanvars($_POST['blog_title'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(BLOGS , $condition)) {
			sessionMsg('Error','Record Already Exists.','danger');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}else{

			$values = array(
							 	 'blog_status'  			=>	cleanvars($_POST['blog_status'])
							 	,'blog_title'				=>	cleanvars($_POST['blog_title'])
							 	,'blog_title_support'		=>	cleanvars($_POST['blog_title_support'])
							 	,'blog_des'					=>	cleanvars($_POST['blog_des'])
							 	,'blog_user'				=>	cleanvars($_POST['blog_user'])
							 	,'blog_date'				=>	cleanvars($_POST['blog_date'])
							 	,'blog_tags'				=>	cleanvars($_POST['blog_tags'])
							 	,'blog_url'					=>	cleanvars(to_seo_url($_POST['blog_title']))
								,'id_added'					=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'				=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms		=	$dblms->insert(BLOGS, $values);
			
			if($sqllms) { 
				$latestID   =	$dblms->lastestid();
				if(!empty($_FILES['blog_img']['name'])) {
					$img_dir = "../images/blogs/";
					$path_parts 			= pathinfo($_FILES["blog_img"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['blog_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['blog_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'blog_img' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(BLOGS, $dataImage, "WHERE blog_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['blog_img']['tmp_name'],$originalImage);
						}
					}
				}
				if(!empty($_FILES['blog_banner']['name'])) {
					$img_dir = "../images/blogs/banner/";
					$path_parts 			= pathinfo($_FILES["blog_banner"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['blog_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['blog_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'blog_banner' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(BLOGS, $dataImage, "WHERE blog_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['blog_banner']['tmp_name'],$originalImage);
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
								'select' 	=> "blog_id",
								'where' 	=> array( 
														 'blog_title'		=>	cleanvars($_POST['blog_title'])
														,'is_deleted'		=>	'0'	
													),
								'not_equal' 	=> array( 
														'blog_id'		=>	cleanvars($_POST['blog_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(BLOGS, $condition)) {
			sessionMsg('Error','Record Already Exists.','danger');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}else{
			$values = array(
								 'blog_status'  			=>	cleanvars($_POST['blog_status'])
								,'blog_title'				=>	cleanvars($_POST['blog_title'])
								,'blog_title_support'		=>	cleanvars($_POST['blog_title_support'])
								,'blog_des'					=>	cleanvars($_POST['blog_des'])
								,'blog_user'				=>	cleanvars($_POST['blog_user'])
								,'blog_date'				=>	cleanvars($_POST['blog_date'])
								,'blog_tags'				=>	cleanvars($_POST['blog_tags'])
								,'blog_url'					=>	cleanvars(to_seo_url($_POST['blog_title']))
								,'id_modify'				=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modify'				=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms = $dblms->Update(BLOGS, $values , "WHERE blog_id  = '".cleanvars($_POST['blog_id'])."'");
			if($sqllms) { 
				$latestID = $_POST['blog_id'];
				if(!empty($_FILES['blog_img']['name'])) {
					$img_dir = "../images/blogs/";
					$path_parts 			= pathinfo($_FILES["blog_img"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['blog_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['blog_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'blog_img' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(BLOGS, $dataImage, "WHERE blog_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['blog_img']['tmp_name'],$originalImage);
						}
					}
				}
				if(!empty($_FILES['blog_banner']['name'])) {
					$img_dir = "../images/blogs/banner/";
					$path_parts 			= pathinfo($_FILES["blog_banner"]["name"]);
					$extension 				= strtolower($path_parts['extension']);
					if(in_array($extension , array( 'png', 'jpg', 'jpeg'))) {
						$originalImage		= $img_dir.to_seo_url($_POST['blog_title'])."-".$latestID.".".($extension);
						$img_fileName		= to_seo_url($_POST['blog_title'])."-".$latestID.".".($extension);
						$dataImage 			= array( 'blog_banner' => $img_fileName );
						$sqlUpdateImg 		= $dblms->Update(BLOGS, $dataImage, "WHERE blog_id = '".$latestID."'");
						if ($sqlUpdateImg) {
							move_uploaded_file($_FILES['blog_banner']['tmp_name'],$originalImage);
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

		$sqlDel = $dblms->Update(BLOGS, $values , "WHERE blog_id  = '".cleanvars($_GET['deleteid'])."'");
		if($sqlDel) { 
			sendRemark('Deleted '.moduleName(0), '3' , cleanvars($_GET['deleteid']));
			sessionMsg('Warning', 'Record Successfully Deleted.', 'warning');
			header("Location: ".moduleName().".php", true, 301);
			exit();
		}
	}
?>