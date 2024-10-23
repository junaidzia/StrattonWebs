<?php
include "../dbsetting/lms_vars_config.php";
include "../dbsetting/classdbconection.php";
include "../functions/functions.php";
$dblms = new dblms();
if (isset($_POST['git_email'])) {
    if($_POST['git_name'] && $_POST['git_email'] && $_POST['git_subject'] && $_POST['git_msg']){
        $values = array(
                             'git_name'  		=>	cleanvars($_POST['git_name'])
                            ,'git_email'		=>	cleanvars($_POST['git_email'])
                            ,'git_subject'		=>	cleanvars($_POST['git_subject'])
                            ,'git_msg'			=>	cleanvars($_POST['git_msg'])
                        ); 

        $sqllms		=	$dblms->insert(GETINTOUCH, $values);
        if ($sqllms) {
            $data['response'] = "success";
        } else {
            $data['response'] = "Server Error";
        }
    } else {
        $data['response'] = "Fill All The Fields";
    }
    header('Content-Type: application/json');
    echo json_encode($data);
}

?>