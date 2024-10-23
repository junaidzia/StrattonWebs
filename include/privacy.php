<?php

$condition = array(
    'select'       =>  'pp_title, pp_des'
    ,'where'        =>  array(
                                'pp_status' => '1'
                               ,'is_deleted' => '0'
                            )
   ,'return_type'  =>  'all'
);
$row     = $dblms->getRows(PRIVACYPOLICY, $condition);

echo '
<!-- Page title -->
<section id="page-title" data-bg-parallax="assets/images/parallax/5.jpg">
    <div class="container">
        <div class="page-title">
            <h1>Privacy Policy</h1>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="'.SITE_URL.'">Home</a> </li>
                <li class="active"><a href="#">Privacy Policy</a> </li>
            </ul>
        </div>
    </div>
</section>
<!-- end: Page title -->
<section id="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">';
                foreach ($row as $privacy) {
                    echo '<p>'.html_entity_decode(html_entity_decode($privacy['pp_des'])).'</p>';
                }
                // echo '
                // <div class="toggle accordion accordion-flat">';
                //     foreach ($row as $privacy) {
                //         echo '
                //         <div class="ac-item">
                //             <h5 class="ac-title">'.$privacy['pp_title'].'</h5>
                //             <div class="ac-content" style="display: none;">
                //                 <p>'.html_entity_decode(html_entity_decode($privacy['pp_des'])).'</p>
                //             </div>
                //         </div>';
                //     }
                //     echo '
                // </div>';
                echo '
            </div>
        </div>
    </div>
</section>
';

?>