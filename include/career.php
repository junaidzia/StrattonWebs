<?php

$condition = array(
    'select'        =>  'cd_title'
    ,'join'         =>  'inner join '.CAREERS.' c ON cd.id_career = c.career_id'
    ,'where'        =>  array(
                                'cd_highlight'      => '1'
                                ,'is_deleted'       => '0'
                                ,'career_status'    => '1'
                            )
   ,'return_type'   =>  'all'
);
$highlights         = $dblms->getRows(CAREERDETAIL . ' cd', $condition);

$condition = array(
    'select'        =>  'career_title, career_id, career_des'
    ,'where'        =>  array(
                                'career_status' => '1'
                               ,'is_deleted'    => '0'
                            )
   ,'return_type'  =>  'all'
);
$careers     = $dblms->getRows(CAREERS, $condition);

echo '
<!-- Page title -->
<section id="page-title" data-bg-parallax="assets/images/parallax/5.jpg">
    <div class="container">
        <div class="page-title">
            <h1>Careers</h1>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="'.SITE_URL.'">Home</a> </li>
                <li class="active"><a href="#">Careers</a> </li>
            </ul>
        </div>
    </div>
</section>
<!-- end: Page title -->
<!-- Page Content -->
<section id="page-content" class="bg-light">
    <div class="container">
        <div class="row">
            <div class="content col-lg-12">
                <div class="toggle accordion accordion-shadow">
                    <div class="ac-item ac-active">
                        <h1 class="ac-title">Higlights</h1>
                        <div class="ac-content">
                            <h4>Positions</h4>
                            <div class="row">';
                                foreach ($highlights as $high) {
                                    echo '
                                    <div class="col-lg-6">
                                        <a class="btn btn-rounded btn-block d-flex justify-content-between">
                                            <span>'.$high['cd_title'].'</span>    
                                            <span>Apply Now > </span>    
                                        </a>
                                    </div>';
                                }
                                echo '
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="heading-text heading-section text-right mt-5">
                    <h1>Light Section</h1>
                    <p>Nulla varius consequat magna, id molestie ipsum volutpat quis. A true story, that never been told!. Fusce id mi diam, non ornare orci. Pellentesque ipsum erat, facilisis ut venenatis eu, sodales vel dolor.</p>
                    <a class="btn" href="'.SITE_URL.'contact">Contact Us</a>
                </div>
            </div>
            <div class="col-lg-5"> <img alt="" src="https://img.freepik.com/free-vector/hand-drawn-career-cushioning-concept_23-2150852768.jpg"> </div>
        </div>
        <div class="row">
            <div class="content col-lg-12">
                <div class="toggle accordion accordion-shadow">';
                    foreach ($careers as $career) {
                        $condition = array(
                            'select'        =>  'cd_title'
                            ,'where'        =>  array(
                                                        'id_career' => $career['career_id']
                                                    )
                           ,'return_type'  =>  'all'
                        );
                        $details     = $dblms->getRows(CAREERDETAIL, $condition);
                        echo '
                        <div class="ac-item">
                            <h1 class="ac-title">'.$career['career_title'].'</h1>
                            <div class="ac-content">
                                <h4>'.html_entity_decode(html_entity_decode($career['career_des'])).'</h4>
                                <h4>Positions</h4>
                                <div class="row">';
                                    if($details){
                                        foreach ($details as $detail) {
                                            echo '
                                            <div class="col-lg-6">
                                                <a class="btn btn-rounded btn-block d-flex justify-content-between">
                                                    <span>'.$detail['cd_title'].'</span>    
                                                    <span>Apply Now > </span>    
                                                </a>
                                            </div>';
                                        }
                                    }
                                    echo '
                                </div>
                            </div>
                        </div>';
                    }
                    echo '
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: Page Content -->';

?>