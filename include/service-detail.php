<?php
$condition = array(
    'select'        =>  'service_id, service_status, service_img, service_title, service_title_support, service_bgdes, service_subtitle, service_des, service_bg, service_banner, service_btn_title'
    ,'where'        =>  array(
                               'is_deleted'  => 0,
                               'service_url' => cleanvars($zone)
                           )
   ,'return_type'   =>  'single'
);
$row     = $dblms->getRows(SERVICES, $condition);
if (!$row) {
    header("location: ".SITE_URL."services");
}
echo '
<!-- Page title -->
<section id="page-title" data-bg-parallax="'.SITE_URL.'images/services/banner/'.$row['service_banner'].'">
    <div class="container">
        <div class="page-title">
            <h1>'.html_entity_decode($row['service_title']).'</h1>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="'.SITE_URL.'">Home</a> </li>
                <li><a href="'.SITE_URL.'Services">Services</a> </li>
                <li class="active"><a href="#">'.html_entity_decode($row['service_title']).'</a> </li>
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
                    <div class="col-lg-6 m-auto">
                        <h1>'.html_entity_decode($row['service_title_support']).'</h1>
                        '.html_entity_decode(html_entity_decode($row['service_des'])).'
                        <a href="'.SITE_URL.'contact" class="btn">'.$row['service_btn_title'].'</a>
                    </div>
                    <div class="col-lg-6 m-auto">
                        <img src="'.SITE_URL.'images/services/'.$row['service_img'].'" class="img-fluid" alt="" srcset="">
                    </div>
                </div>
            </div>
        </div>
    </div>';
    if($row['service_bg']){
        echo '
        <section class="p-t-200 p-b-200 mb-4 mt-4" data-bg-parallax="'.SITE_URL.'images/services/backgrounds/'.$row['service_bg'].'">
            <div class="bg-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 center text-center text-light">
                        <p class="lead">'.htmlspecialchars_decode(html_entity_decode($row['service_bgdes'])).'</p>
                    </div>
                </div>
            </div>
        </section>';
    }
    $condition = array(
        'select'        =>  'ss_id, ss_title, ss_titlesupport, ss_url, ss_icon'
        ,'where'        =>  array(
                                'id_service' => cleanvars($row['service_id'])
                            )
        ,'return_type'  =>  'all'
    );
    $subservices     = $dblms->getRows(SUBSERVICES, $condition);
    $condition['return_type']   = 'count';
    $countsub        = $dblms->getRows(SUBSERVICES, $condition);
    if ($subservices) {
        echo '
        <h1 class="text-center pt-4 pb-4">'.html_entity_decode($row['service_subtitle']).'</h1>
        <section class="no-padding equalize mb-4" data-equalize-item=".text-box">
            <div class="row col-no-margin">';
                $subcount = 0;
                foreach ($subservices as $subservice) {
                    $condition = array(
                        'select'        =>  'ssc_id'
                        ,'where'        =>  array(
                                                'id_ss' => cleanvars($subservice['ss_id'])
                                            )
                        ,'return_type'  =>  'all'
                    );
                    $content     = $dblms->getRows(SUBSERVICECONTENT, $condition);
                    if ($content) {
                        $url = SITE_URL.'sub-service/'.$subservice['ss_url'];
                    } else {
                        $url = "javascript:void(0)";
                    }
                    ++$subcount;
                    echo '
                    <div class="col p-0" style="background-color: '.($subcount%2 == 1 ? '#506681' : '#41566f').';">
                        <div class="text-box hover-effect">
                            <a href="'.$url.'"> 
                                <img src="'.SITE_URL.'images/services/sub_services/'.$subservice['ss_icon'].'" width="55" class="img-fluid" alt="">
                                <h3>'.html_entity_decode($subservice['ss_title']).'</h3>
                                <p>'.html_entity_decode($subservice['ss_titlesupport']).'</p>
                            </a>
                        </div>
                    </div>';
                    if($subcount % 3 == 0 && $countsub != $subcount){
                        echo '</div><div class="row col-no-margin">';
                    }
                }
                echo '
            </div>
        </section>';
    }
    echo '
    <div class="container">
        <div class="row">
            <div class="col-lg-12">';
                $condition = array(
                    'select'        =>  'sd_title, sd_des'
                    ,'where'        =>  array(
                                            'id_service' => cleanvars($row['service_id'])
                                        )
                ,'return_type'   =>  'all'
                );
                $servicedetails     = $dblms->getRows(SERVICEDETAIL, $condition);
                foreach ($servicedetails as $sdetail) {
                    echo '
                    <h1>'.html_entity_decode($sdetail['sd_title']).'</h1>
                    <p>'.html_entity_decode(html_entity_decode($sdetail['sd_des'])).'</p>';
                }
                echo '
            </div>
        </div>
    </div>';
    $condition	=	array ( 
                                'select' 	=> "service_title, service_icon ,service_url",
                                'where' 	=> array( 
                                                         'service_status'	=>	cleanvars(1)
                                                        ,'is_deleted'	    =>	'0'	
                                                    ),
                                'not_equal' 	=> array( 
                                                        'service_id'		=>	cleanvars($row['service_id'])
                                                    ),		
                                'order_by'      => 'service_id LIMIT 5',			
                                'return_type' 	=> 'all' 
                            ); 
    $services     = $dblms->getRows(SERVICES, $condition);
    if($services){
        echo '
        <section class="background-grey mt-4">
            <div class="container">
                <h1 class="mb-5 text-center">Explore Our Other Services</h1>
                <div class="row">';
                    foreach ($services as $service) {
                        echo '
                        <div class="col">
                            <div class="icon-box mb-0 effect medium center">
                                <a href="'.SITE_URL.'service-detail/'.$service['service_url'].'"><img src="'.SITE_URL.'images/services/icons/'.$service['service_icon'].'" width="55" alt=""></a>
                                <h3>'.html_entity_decode($service['service_title']).'</h3>
                            </div>
                        </div>';
                    }
                    echo '
                </div>
            </div>
        </section>';
    }
    echo '
    <div class="container pt-5 text-center">
        <h1 class="">Get Answer About Service</h1>
        <a href="'.SITE_URL.'contact" class="btn">Get Answer</a>
    </div>
</section>
<!-- end: page content -->';

?>