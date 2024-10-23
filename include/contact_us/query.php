<?php
include "../dbsetting/lms_vars_config.php";
include "../dbsetting/classdbconection.php";
include "../functions/functions.php";
$dblms = new dblms();
if (isset($_POST['cu_email'])) {
    $values = array(
                         'cu_name'  		=>	cleanvars($_POST['cu_name'])
                        ,'cu_email'		    =>	cleanvars($_POST['cu_email'])
                        ,'cu_requirment'	=>	cleanvars($_POST['cu_requirment'])
                        ,'cu_need'			=>	cleanvars($_POST['cu_need'])
                        ,'cu_business'		=>	cleanvars($_POST['cu_business'])
                        ,'cu_industry'		=>	cleanvars($_POST['cu_industry'])
                        ,'cu_weblive'		=>	cleanvars($_POST['cu_weblive'])
                        ,'cu_budget'		=>	cleanvars($_POST['cu_budget'])
                        ,'cu_hiring'		=>	cleanvars($_POST['cu_hiring'])
                        ,'cu_detail'		=>	cleanvars($_POST['cu_detail'])
                    ); 

    $sqllms		=	$dblms->insert(CONTACTUS, $values);
    if ($sqllms) {
        $data['response'] = "success";
    } else {
        $data['response'] = "Server Error";
    }
    header('Content-Type: application/json');
    echo json_encode($data);
}

?>