<?php

$condition = array(
    'select'        =>  'platform_id, platform_status, platform_title, platform_title_support, platform_short_des, platform_long_des, platform_banner, platform_btn_title, platform_desimg'
    ,'where'        =>  array(
                                'platform_status'       => 1
                               ,'is_deleted'            => 0
                               ,'platform_url'          => $zone
                           )
    ,'order_by'     =>  'platform_id ASC'
    ,'return_type'  =>  'single'
);
$row     = $dblms->getRows(PLATFORMS , $condition);
if (!$row) {
    header("location: ".SITE_URL."platform");
}

echo '
<!-- Page title -->
<section id="page-title" data-bg-parallax="'.SITE_URL.'images/platforms/banner/'.$row['platform_banner'].'">
    <div class="container">
        <div class="page-title">
            <h1>'.html_entity_decode($row['platform_title']).'</h1>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="'.SITE_URL.'">Home</a> </li>
                <li><a href="'.SITE_URL.'Platform">Platform</a> </li>
                <li class="active"><a href="#">'.html_entity_decode($row['platform_title']).'</a> </li>
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
                    <div class="col-lg-12">
                        <h1>'.html_entity_decode($row['platform_title_support']).'</h1>
                        <p>'.html_entity_decode(html_entity_decode($row['platform_short_des'])).'</p>
                        <a href="'.SITE_URL.'contact" class="btn">'.html_entity_decode($row['platform_btn_title']).'</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <h2>Description</h2>
                        <p>'.html_entity_decode(html_entity_decode($row['platform_long_des'])).'</p>
                    </div>
                    <div class="col-lg-6">
                        <img src="'.SITE_URL.'images/platforms/image/'.$row['platform_desimg'].'" alt="" class="img-fluid">
                    </div>
                </div>';
                $condition = array(
                    'select'        =>  'pd_title, pd_des'
                    ,'where'        =>  array(
                                            'id_platform' => cleanvars($row['platform_id'])
                                        )
                    ,'return_type'  =>  'all'
                );
                $platformdetails     = $dblms->getRows(PLATFORMDETAIL, $condition);
                if ($platformdetails) {
                    foreach ($platformdetails as $detail) {
                        echo '
                        <h2>'.html_entity_decode(html_entity_decode($detail['pd_title'])).'</h2>
                        <p>'.html_entity_decode(html_entity_decode($detail['pd_des'])).'</p>';
                    }
                }
                echo '
            </div>
        </div>
    </div>
</section>
<!-- end: page content -->';

?>