<?php

$condition = array(
    'select'       =>  'about_title, about_des, about_banner'
    ,'where'        =>  array(
                               'about_id' => cleanvars(1)
                           )
   ,'return_type'  =>  'single'
);
$row     = $dblms->getRows(ABOUT, $condition);

$condition = array(
    'select'       =>  'al_name, al_per'
    ,'where'        =>  array(
                                'id_about' => '1'
                            )
   ,'return_type'  =>  'all'
);
$aboutlanguages     = $dblms->getRows(ABOUTLANGUAGE, $condition);

echo '
<!-- Page title -->
<section id="page-title" data-bg-parallax="images/banner/'.$row['about_banner'].'">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="page-title">
            <h1 class="text-uppercase text-medium">ABOUT US</h1>
            <span>'.$row['about_title'].'</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="'.SITE_URL.'">Home</a> </li>
                <li class="active"><a href="#">About Us</a> </li>
            </ul>
        </div>
    </div>
</section>
<!-- end: Page title -->
<section class="p-b-10">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="heading-text heading-section">
                    <h2>THE COMPANY</h2>
                    <span class="lead">'.html_entity_decode($row['about_des']).'</span>
                </div>
            </div>
            <div class="col-lg-6 m-t-60">';
                foreach ($aboutlanguages as $lang) {
                    echo '
                    <div class="p-progress-bar-container title-up small extra-small color">
                        <div class="p-progress-bar" data-percent="'.$lang['al_per'].'" data-delay="100" data-type="%">
                            <div class="progress-title">'.$lang['al_name'].'</div>
                        </div>
                    </div>';
                }
                echo '
            </div>
        </div>
    </div>
</section>';
include 'team.php';
// echo '
// <section>
//     <div class="container">
//         <div class="heading-text heading-section text-center">
//             <h2>WHAT WE DO</h2>
//             <span class="lead">Create amaThe most happiest time of the day!.</span>
//         </div>
//         <div class="row">
//             <div class="col-lg-4">
//                 <div>
//                     <h4>Web Development</h4>
//                     <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
//                 </div>
//             </div>
//             <div class="col-lg-4">
//                 <div>
//                     <h4>Social Marketing</h4>
//                     <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
//                 </div>
//             </div>
//             <div class="col-lg-4">
//                 <div>
//                     <h4>Graphic Design</h4>
//                     <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
//                 </div>
//             </div>
//             <div class="col-lg-4">
//                 <div>
//                     <h4>Web Design</h4>
//                     <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
//                 </div>
//             </div>
//             <div class="col-lg-4">
//                 <div>
//                     <h4>App Development</h4>
//                     <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
//                 </div>
//             </div>
//             <div class="col-lg-4">
//                 <div>
//                     <h4>Hosting services</h4>
//                     <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
//                 </div>
//             </div>
//         </div>
//     </div>
// </section>';

?>