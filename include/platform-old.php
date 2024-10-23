<?php

$condition = array(
    'select'        =>  'platform_title, platform_title_support, platform_img, platform_url'
    ,'where'        =>  array(
                                'platform_status'       => 1
                               ,'is_deleted'            => 0
                           )
    ,'order_by'     =>  'platform_id ASC'
    ,'return_type'  =>  'all'
);
$platforms     = $dblms->getRows(PLATFORMS , $condition);

echo '
<!-- Page title -->
<section id="page-title" data-bg-parallax="assets/images/parallax/5.jpg">
    <div class="container">
        <div class="page-title">
            <h1>Platform</h1>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="'.SITE_URL.'">Home</a> </li>
                <li class="active"><a href="#">Platform</a> </li>
            </ul>
        </div>
    </div>
</section>
<!-- end: Page title -->
<section id="page-content">
    <div class="container">
        <div class="row">';
            if ($platforms) {
                foreach ($platforms as $platform) {
                    echo '
                    <div class="col-lg-3">
                        <div class="portfolio-item overlay-links mb-4">
                            <div class="portfolio-item-wrap site-border">
                                <div class="portfolio-image">
                                    <img src="'.SITE_URL.'images/platforms/'.$platform['platform_img'].'" alt="">
                                    <div class="portfolio-links">
                                        <a title="'.html_entity_decode($platform['platform_title']).'" data-lightbox="image" href="'.SITE_URL.'images/platforms/'.$platform['platform_img'].'"><i class="icon-maximize"></i></a>
                                        <a href="'.SITE_URL.'platform-detail/'.$platform['platform_url'].'"><i class="icon-link"></i></a>
                                    </div>
                                </div>
                                <div class="portfolio-description">
                                    <a href="'.SITE_URL.'platform-detail/'.$platform['platform_url'].'">
                                        <h3>'.html_entity_decode($platform['platform_title']).'</h3>
                                        <span>'.html_entity_decode($platform['platform_title_support']).'</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
            }
            echo '
        </div>
    </div>
</section>
';

?>