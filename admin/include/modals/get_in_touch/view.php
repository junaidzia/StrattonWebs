<?php
include "../../dbsetting/lms_vars_config.php";
include "../../dbsetting/classdbconection.php";
include "../../functions/functions.php";
$dblms = new dblms();
include "../../functions/login_func.php";
checkCpanelLMSALogin();
$condition = array(
    'select'       =>  'git_name, git_email, git_subject, git_msg'
    ,'where'        =>  array(
                               'git_id' => cleanvars($_GET['view_id'])
                           )
   ,'return_type'  =>  'single'
);
$row     = $dblms->getRows(GETINTOUCH , $condition);

echo '
<div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Contact Us Detail</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="overflow-hidden">
    <div data-simplebar style="height: calc(100vh - 100px);">
        <div class="offcanvas-body">
            <h6 class="text-muted text-uppercase fw-semibold"><b>Name:</b></h6>
            <p>'.$row['git_name'].'</p>
            <hr>
            <h6 class="text-muted text-uppercase fw-semibold"><b>Email:</b></h6>
            <p>'.$row['git_email'].'</p>
            <hr>
            <h6 class="text-muted text-uppercase fw-semibold"><b>Subject:</b></h6>
            <p>'.$row['git_subject'].'</p>
            <hr>
            <h6 class="text-muted text-uppercase fw-semibold"><b>Message:</b></h6>
            <p>'.$row['git_msg'].'</p>
        </div>
    </div>
</div>';
?>