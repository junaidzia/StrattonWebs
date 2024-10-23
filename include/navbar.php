<?php

$condition = array(
    'select'        =>  'platform_title, platform_url'
    ,'where'        =>  array(
                                'platform_status'       => 1
                               ,'is_deleted'            => 0
                           )
    ,'order_by'     =>  'platform_id ASC'
    ,'return_type'  =>  'all'
);
$platforms     = $dblms->getRows(PLATFORMS , $condition);

$condition = array(
    'select'       =>  'service_title, service_url'
   ,'where'        =>  array(
                                'service_status'    => 1
                               ,'is_deleted'        => 0
                           )
   ,'order_by'     =>  'service_id ASC LIMIT 4'
   ,'return_type'  =>  'all'
);
$servicess     = $dblms->getRows(SERVICES , $condition);

echo '
<!-- Header -->
<header id="header" data-transparent="true" data-fullwidth="true" class="'.(CONTROLER ? 'dark' : 'bg-light').' submenu-light">
    <div class="header-inner">
        <div class="container">
            <!--Logo-->
            <div id="logo">
                <a href="'.SITE_URL.'">
                    <span class="logo-default"><img width="60" src="'.SITE_URL.'images/logo.png" alt="Logo" class="img-fluid"></span>
                    <span class="logo-dark"><img width="60" src="'.SITE_URL.'images/logo.png" alt="Logo" class="img-fluid"></span>
                </a>
            </div>
            <!--End: Logo-->
            <!-- Search -->
            <div id="search"><a id="btn-search-close" class="btn-search-close" aria-label="Close search form"><i class="icon-x"></i></a>
                <form class="search-form" action="https://inspirothemes.com/polo/search-results-page.html" method="get">
                    <input class="form-control" name="q" type="text" placeholder="Type & Search..." />
                    <span class="text-muted">Start typing & press "Enter" or "ESC" to close</span>
                </form>
            </div>
            <!-- end: search -->
            <!--Header Extras-->
            <div class="header-extras">
                <ul>';
                    // echo '
                    // <!--<li>
                    //     <a id="btn-search" href="#"> <i class="icon-search"></i></a>
                    // </li>-->';
                    // echo '
                    // <!--<li>
                    //     <div class="p-dropdown">
                    //         <a href="#"><i class="icon-globe"></i><span>EN</span></a>
                    //         <ul class="p-dropdown-content">
                    //             <li><a href="#">French</a></li>
                    //             <li><a href="#">Spanish</a></li>
                    //             <li><a href="#">English</a></li>
                    //         </ul>
                    //     </div>
                    // </li>-->';
                    echo '
                </ul>
            </div>
            <!--end: Header Extras-->
            <!--Navigation Resposnive Trigger-->
            <div id="mainMenu-trigger">
                <a class="lines-button x"><span class="lines"></span></a>
            </div>
            <!--end: Navigation Resposnive Trigger-->
            <!--Navigation-->
            <div id="mainMenu">
                <div class="container">
                    <nav>
                        <ul>
                            <li><a href="'.SITE_URL.'">Home</a></li>
                            <li class="dropdown"><a href="'.SITE_URL.'services">Services</a>
                                <ul class="dropdown-menu">
                                <li><a href="'.SITE_URL.'service/digital-marketing">Digital Marketing</a></li>';
                                    if ($servicess) {
                                        foreach ($servicess as $service) {
                                            echo '<li><a href="'.SITE_URL.'service-detail/'.$service['service_url'].'">'.html_entity_decode($service['service_title']).'</a></li>';
                                        }
                                    }
                                    echo '
                                </ul>
                            </li>
                            <li><a href="'.SITE_URL.'platform">Platforms</a></li>';
                            // echo '
                            // <li class="dropdown"><a href="'.SITE_URL.'platform">Platforms</a>
                            //     <ul class="dropdown-menu">';
                            //         if ($platforms) {
                            //             foreach ($platforms as $platform) {
                            //                 echo '<li><a href="'.SITE_URL.'platform-detail/'.$platform['platform_url'].'">'.html_entity_decode($platform['platform_title']).'</a></li>';
                            //             }
                            //         }
                            //         echo '
                            //     </ul>
                            // </li>';
                            echo '
                            <li><a href="'.SITE_URL.'projects">Projects</a></li>
                            <li><a href="'.SITE_URL.'career">Careers</a></li>
                            <li class="dropdown"><a href="#">Insights</a>
                                <ul class="dropdown-menu">
                                    <li><a href="'.SITE_URL.'blog">Blogs</a></li>
                                    <li><a href="'.SITE_URL.'about">About Us</a></li>
                                    <li><a href="'.SITE_URL.'privacy">Privacy Policy</a></li>
                                    <li><a href="'.SITE_URL.'term-and-condition">Terms and Conditions</a></li>
                                    <li><a href="'.SITE_URL.'faqs">FAQ\'S</a></li>
                                </ul>
                            </li>
                            <li><a href="'.SITE_URL.'contact">Contact Us</a></li>
                            <li>
                                <a href="#modalLogin" data-lightbox="inline" class="btn btn-rounded text-white">Get A Quote</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!--end: Navigation-->
        </div>
    </div>
</header>
<!-- end: Header -->';

?>