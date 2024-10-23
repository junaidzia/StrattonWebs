<?php

$condition = array(
    'select'       =>  'service_title, service_title_support, service_img, service_url'
   ,'where'        =>  array(
                                'service_status'    => 1
                               ,'is_deleted'        => 0
                           )
   ,'order_by'     =>  'service_id ASC'
   ,'return_type'  =>  'all'
);
$services     = $dblms->getRows(SERVICES , $condition);
echo '
<!-- Page title -->
<section id="page-title" data-bg-parallax="'.SITE_URL.'assets/images/parallax/5.jpg">
    <div class="container">
        <div class="page-title">
            <h1>Services</h1>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="'.SITE_URL.'">Home</a> </li>
                <li class="active"><a href="#">Services</a> </li>
            </ul>
        </div>
    </div>
</section>
<section id="services" class="text-light">
    <div class="container">
        <div class="row">';
            foreach ($services as $service) {
                echo '
                <div class="col-lg-4 pb-4" data-animate="fadeInUp" data-animate-delay="0">
                    <div class="portfolio-item bg-gradiant text-light no-overlay site-border">
                        <div class="portfolio-item-wrap site-border">
                            <div class="portfolio-image">
                                <a href="'.SITE_URL.'service-detail/'.$service['service_url'].'"><img src="'.SITE_URL.'images/services/'.$service['service_img'].'" alt=""></a>
                            </div>
                            <div class="portfolio-description pb-0 pr-4 pl-4">
                                <a href="'.SITE_URL.'service-detail/'.$service['service_url'].'">
                                    <h3>'.html_entity_decode($service['service_title']).'</h3>
                                    <p>'.html_entity_decode($service['service_title_support']).'</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            echo '
        </div>
    </div>
</section>';

?>