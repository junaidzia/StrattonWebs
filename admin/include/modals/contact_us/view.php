<?php
include "../../dbsetting/lms_vars_config.php";
include "../../dbsetting/classdbconection.php";
include "../../functions/functions.php";
$dblms = new dblms();
include "../../functions/login_func.php";
checkCpanelLMSALogin();
$condition = array(
    'select'       =>  'cu_name, cu_email, cu_requirment, cu_need, cu_business, cu_industry, cu_weblive, cu_budget, cu_hiring, cu_detail'
    ,'where'        =>  array(
                               'cu_id' => cleanvars($_GET['view_id'])
                           )
   ,'return_type'  =>  'single'
);
$row     = $dblms->getRows(CONTACTUS , $condition);

echo '
<div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Contact Us Detail</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="overflow-hidden">
    <div data-simplebar style="height: calc(100vh - 100px);">
        <div class="offcanvas-body">
            <h6 class="text-muted text-uppercase fw-semibold"><b>Name:</b></h6>
            <p>'.$row['cu_name'].'</p>
            <hr>
            <h6 class="text-muted text-uppercase fw-semibold"><b>Email:</b></h6>
            <p>'.$row['cu_email'].'</p>
            <hr>
            <h6 class="text-muted text-uppercase fw-semibold"><b>What is the Web Design Requirment</b></h6>
            <p>'.$row['cu_requirment'].'</p>
            <hr>
            <h6 class="text-muted text-uppercase fw-semibold"><b>What are the Website Need</b></h6>
            <p>'.$row['cu_need'].'</p>
            <hr>
            <h6 class="text-muted text-uppercase fw-semibold"><b>What type of business is this for</b></h6>
            <p>'.$row['cu_business'].'</p>
            <hr>
            <h6 class="text-muted text-uppercase fw-semibold"><b>What industry do he operate in</b></h6>
            <p>'.$row['cu_industry'].'</p>
            <hr>
            <h6 class="text-muted text-uppercase fw-semibold"><b>What he like to the website to live/be updated</b></h6>
            <p>'.$row['cu_weblive'].'</p>
            <hr>
            <h6 class="text-muted text-uppercase fw-semibold"><b>What is the budget for this project</b></h6>
            <p>'.$row['cu_budget'].'</p>
            <hr>
            <h6 class="text-muted text-uppercase fw-semibold"><b>Who like are he want to hire</b></h6>
            <p>'.$row['cu_hiring'].'</p>
            <hr>
            <h6 class="text-muted text-uppercase fw-semibold"><b>Detail</b></h6>
            <p>'.$row['cu_detail'].'</p>
        </div>
    </div>
</div>';
?>