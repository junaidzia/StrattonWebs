<?php
$condition = array(
    'select'        =>  'ss_id, ss_title, service_title, service_url, ss_titlesupport, ss_banner'
    ,'join'         =>  'inner join '.SERVICES.' s on s.service_id = ss.id_service'
    ,'where'        =>  array(
                               'ss.is_deleted'  => 0,
                               'ss_url'         => cleanvars($zone)
                           )
   ,'return_type'   =>  'single'
);
$row     = $dblms->getRows(SUBSERVICES . ' ss', $condition);
if (!$row) {
    header("location: ".SITE_URL."services");
}
$condition = array(
    'select'        =>  'ssc_title, ssc_image, ssc_des'
    ,'where'        =>  array(
                            'id_ss' => cleanvars($row['ss_id'])
                        )
    ,'return_type'  =>  'all'
);
$subservicecontent     = $dblms->getRows(SUBSERVICECONTENT, $condition);
echo '
<!-- Page title -->
<section id="page-title" data-bg-parallax="'.SITE_URL.'images/services/sub_services/banner/'.$row['ss_banner'].'">
    <div class="container">
        <div class="page-title">
            <h1>'.html_entity_decode($row['ss_title']).'</h1>
            <span>'.html_entity_decode($row['ss_titlesupport']).'</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="'.SITE_URL.'">Home</a> </li>
                <li><a href="'.SITE_URL.'Services">Services</a> </li>
                <li><a href="'.SITE_URL.'service-detail/'.$row['service_url'].'">'.html_entity_decode($row['service_title']).'</a> </li>
                <li class="active"><a href="#">'.html_entity_decode($row['ss_title']).'</a> </li>
            </ul>
        </div>
    </div>
</section>
<!-- end: Page title -->
<!-- page content -->
<section id="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">';
                foreach ($subservicecontent as $key => $detail) {                    
                    echo '
                    <div class="row mt-4">
                        <div class="col-lg-6 '.($key%2 == 1 ? 'order-lg-2' : '').'">
                            <h1>'.html_entity_decode($detail['ssc_title']).'</h1>
                            <p>'.html_entity_decode(html_entity_decode($detail['ssc_des'])).'</p>
                        </div>
                        <div class="col-lg-6 text-center m-auto">
                            <img src="'.SITE_URL.'images/services/sub_services/image/'.$detail['ssc_image'].'"  class="img-fluid" alt="">
                        </div>
                    </div>';
                }
                echo '
            </div>
        </div>
    </div>';
    $condition = array(
        'select'        =>  'ssd_title, ssd_des'
        ,'where'        =>  array(
                                'id_ss' => cleanvars($row['ss_id'])
                            )
        ,'return_type'  =>  'all'
    );
    $subservicedetails     = $dblms->getRows(SUBSERVICEDETAIL, $condition);
    $condition['return_type']   = 'count';
    $countsub        = $dblms->getRows(SUBSERVICEDETAIL, $condition);
    if($subservicedetails){
        echo '
        <h1 class="text-center pt-5 pb-4">'.html_entity_decode($row['ss_title']).' Services</h1>
        <section class="no-padding equalize mb-4" data-equalize-item=".text-box">
            <div class="row col-no-margin">';
                $subcount = 0;
                foreach ($subservicedetails as $subservice) {
                    ++$subcount;
                    echo '
                    <div class="col p-0" style="background-color: '.($subcount%2 == 1 ? '#506681' : '#41566f').';">
                        <div class="text-box hover-effect">
                            <a href="javascript:void(0)"> 
                                <img src="" alt="">
                                <h3>'.html_entity_decode($subservice['ssd_title']).'</h3>
                                <p>'.html_entity_decode($subservice['ssd_des']).'</p>
                            </a>
                        </div>
                    </div>';
                    if($countsub % 4 == 0 && $countsub != $subcount){
                        echo '</div><div class="row col-no-margin">';
                    }
                }
                echo '
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