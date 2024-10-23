<?php

$condition = array(
    'select'        =>  'project_id, project_title, project_title_support, project_des, project_challanges, project_solutions, project_banner, project_btn_title, project_desimg, project_web, id_services , id_platform'
    ,'where'        =>  array(
                                'project_status'        => 1
                               ,'p.is_deleted'          => 0
                               ,'p.project_url'         => $zone
                           )
    ,'order_by'     =>  'project_id ASC'
    ,'return_type'  =>  'single'
);
$row       = $dblms->getRows(PROJECTS . ' p' , $condition);
if (!$row) {
    header("location: ".SITE_URL."projects");
}
echo '
<!-- Page title -->
<section id="page-title" data-bg-parallax="'.SITE_URL.'images/projects/banner/'.$row['project_banner'].'">
    <div class="container">
        <div class="page-title">
            <h1>'.html_entity_decode($row['project_title']).'</h1>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="'.SITE_URL.'">Home</a> </li>
                <li><a href="'.SITE_URL.'Projects">Projects</a> </li>
                <li class="active"><a href="#">'.html_entity_decode($row['project_title']).'</a> </li>
            </ul>
        </div>
    </div>
</section>
<!-- end: Page title -->
<!-- page content -->
<section id="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>'.html_entity_decode($row['project_title_support']).'</h3>
                        <p>'.html_entity_decode(html_entity_decode($row['project_des'])).'</p>
                        <a href="'.SITE_URL.'contact" class="btn">'.html_entity_decode($row['project_btn_title']).'</a>
                    </div>
                    <div class="col-lg-3">
                        <h3>Project</h3>
                        <h5><a href="'.$row['project_web'].'" target="_blank">'.$row['project_web'].'</a></h5>
                        <h3>Platform</h3>';
                        if($row['id_platform']){
                            $platform = explode(",",$row['id_platform']);
                            foreach ($platform as $p) {
                                echo '<h5>'.html_entity_decode($p).'</h5>';
                            }
                        }
                        echo '
                    </div>
                    <div class="col-lg-3">
                        <h3>Serivces</h3>';
                        if($row['id_services']){
                            $services = explode(",",$row['id_services']);
                            foreach ($services as $service) {
                                echo '<h5>'.html_entity_decode($service).'</h5>';
                            }
                        }
                        echo '
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <h2>Challenges</h2>
                        <p>'.html_entity_decode(html_entity_decode($row['project_challanges'])).'</p>
                    </div>
                    <div class="col-lg-6">
                        <img src="'.SITE_URL.'images/projects/image/'.$row['project_desimg'].'" alt="" class="img-fluid">
                    </div>
                </div>
                <h2>Solutions</h2>
                <p>'.html_entity_decode(html_entity_decode($row['project_solutions'])).'</p>
            </div>
        </div>
    </div>
</section>
<!-- end: page content -->';

?>