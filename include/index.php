<?php
echo 
'<!-- Inspiro Slider -->
<div id="slider" class="inspiro-slider slider-fullscreen dots-creative" data-fade="true">
    <!-- Slide 1 -->
    <div class="slide kenburns" data-bg-image="assets/images/slider/1.jpg">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="slide-captions text-center text-light">
                        <!-- Captions -->
                        <h2>Crafting Digital Experiences to Propel Growth</h2>
                        <p>A technology-driven agency specializing in web design, development, and digital marketing, driven by a fervent conviction in technology\'s capacity to revolutionize business methodologies for the better.</p>
                        <div><a href="#welcome" class="btn scroll-to">Explore more</a></div>
                        </span>
                        <!-- end: Captions -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end: Slide 1 -->
    <!-- Slide 2 -->
    <div class="slide" data-bg-video="assets\video/1.mp4">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="slide-captions text-left text-light">
                <!-- Captions -->
                <h2>Crafting Digital Excellence</h2>
                <p class="text-small">Embarking on digital revolution, we forge the future web, shaping innovations, transcending boundaries, and empowering humanity.</p>
                <div><a href="#welcome" class="btn scroll-to">Explore more</a></div>
                <!-- end: Captions -->
            </div>
        </div>
    </div>
    <!-- end: Slide 2 -->
</div>
<!--end: Inspiro Slider -->';

// echo '
// <!-- WELCOME -->
// <section id="welcome" class="p-b-0">
//     <div class="container">
//         <div class="heading-text heading-section text-center m-b-40" data-animate="fadeInUp">
//             <h2>Working to build your success</h2>
//             <span class="lead">or over 25 years, AmericanWebsitedesignagnecy.com is dedicated to providing best-in-class web design, development, hosting, and digital marketing services.</span>
//         </div>
//         <div class="row" data-animate="fadeInUp">
//             <div class="col-lg-12">
//                 <img class="img-fluid" src="assets/images/other/1.png" alt="Welcome to POLO">
//             </div>
//         </div>
//     </div>
// </section>
// <!-- end: WELCOME -->';
$condition = array(
    'select'       =>  'service_title, service_title_support, service_icon, service_url'
   ,'where'        =>  array(
                                'service_status'    => 1
                               ,'is_deleted'        => 0
                           )
   ,'order_by'     =>  'service_id ASC LIMIT 8'
   ,'return_type'  =>  'all'
);
$services     = $dblms->getRows(SERVICES , $condition);
$delay = 0;
echo '
<!-- WHAT WE DO -->
<section id="welcome" class="background-grey">
    <div class="container-fluid">
        <div class="heading-text heading-section">
            <h2>WHAT WE DO</h2>
        </div>
        <div class="row">';
            foreach ($services as $service) {
                echo '
                <div class="col-lg-3 mb-4">
                    <div data-animate="fadeInUp" data-animate-delay="'.$delay.'">
                        <a href="'.SITE_URL.'service-detail/'.$service['service_url'].'">
                            <img src="images/services/icons/'.$service['service_icon'].'" width="45" alt="">
                            <h4>'.html_entity_decode($service['service_title']).'</h4>
                            <p>'.html_entity_decode($service['service_title_support']).'</p>
                            <h5>Learn More > </h5>
                        </a>
                    </div>
                </div>';
                $delay += 200;
            }
            echo '
            <div class="col-lg-3 mb-4">
                <div data-animate="fadeInUp" data-animate-delay="'.$delay.'">
                    <a href="'.SITE_URL.'service/digital-marketing">
                        <img src="images/services/digital-marketing/digital-marketing.png" width="45" alt="">
                        <h4>Digital Marketing</h4>
                        <p>Through SEO, content, email marketing and more, we develop strategies that grow your business.</p>
                        <h5>Learn More > </h5>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END WHAT WE DO -->';
$condition = array(
    'select'       =>  'project_title, project_title_support, project_img, project_url'
   ,'where'        =>  array(
                                'project_status'    => 1
                               ,'p.is_deleted'        => 0
                           )
   ,'order_by'     =>  'project_id ASC LIMIT 8'
   ,'return_type'  =>  'all'
);
$projects     = $dblms->getRows(PROJECTS . ' p' , $condition);
if($projects){
echo '
    <!-- PORTFOLIO -->
    <section class="p-b-4">
        <div class="col-lg-12 p-0 mb-5">
            <div class="row d-flex align-items-center">
                <div class="col-lg-6">
                    <img src="https://ameagle-assets-new.azureedge.net/aecom-blobs/images/default-source/default-album/tabletse850e69d51d9469e8fd7dbf54549c8b1.png" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6">
                    <div class="container">
                        <h1>Working to grow your business</h1>
                        <h4 class="font-weight-normal">For the past 9 years, Stratton Webs has been committed to delivering top-notch web design, development, hosting, and digital marketing services. Your success is our priority, and we collaborate with you to discover effective online solutions tailored to your requirements.</h4>
                        <a href="'.SITE_URL.'about" class="btn">More About Us</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="heading-text heading-section">
                <h2>Projects</h2>
                <span class="lead">Lorem ipsum dolor sit amet, coper suscipit lobortis nisl ut aliquip ex ea commodo
                    consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie
                    consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto.</span>
            </div>
        </div>
        <div class="container-fluid portfolio">
            <!-- Portfolio Items -->
            <div id="portfolio" class="grid-layout portfolio-4-columns">';
                foreach ($projects as $project) {
                    echo '
                    <a href="'.SITE_URL.'project-detail/'.$project['project_url'].'">
                        <!-- portfolio item -->
                        <div class="portfolio-item img-zoom ct-photography ct-media ct-branding ct-Media">
                            <div class="portfolio-item-wrap site-border">
                                <div class="portfolio-image">
                                    <a href="'.SITE_URL.'project-detail/'.$project['project_url'].'"><img src="'.SITE_URL.'images/projects/'.$project['project_img'].'" alt=""></a>
                                </div>
                                <div class="portfolio-description">
                                    <a href="'.SITE_URL.'project-detail/'.$project['project_url'].'">
                                        <h3>'.html_entity_decode($project['project_title']).'</h3>
                                        <h5><span>'.html_entity_decode($project['project_title_support']).'</span></h5>
                                        <button class="btn btn-rounded btn-xs">Case Study</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- end: portfolio item -->
                    </a>';
                }
                echo '
            </div>
            <!-- end: Portfolio Items -->
        </div>
    </section>
    <!-- end: PORTFOLIO -->';
}
// echo '
// <!-- SERVICES -->
// <section id="services" class="text-light">
//     <div class="bg-overlay" data-style="10"></div>
//     <div class="container">
//         <div class="heading-text heading-section text-center">
//             <h2>SERVICES</h2>
//             <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.
//             </p>
//         </div>
//         <div class="row">
//             <div class="col-lg-4 pb-4" data-animate="fadeInUp" data-animate-delay="0">
//                 <div class="portfolio-item bg-gradiant text-light no-overlay">
//                     <div class="portfolio-item-wrap">
//                         <div class="portfolio-image">
//                             <a href="#"><img src="assets/images/portfolio/70.jpg" alt=""></a>
//                         </div>
//                         <div class="portfolio-description">
//                             <a href="#">
//                                 <h3>Towel World</h3>
//                                 <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.</p>
//                             </a>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//             <div class="col-lg-4 pb-4" data-animate="fadeInUp" data-animate-delay="0">
//                 <div class="portfolio-item bg-gradiant text-light no-overlay">
//                     <div class="portfolio-item-wrap">
//                         <div class="portfolio-image">
//                             <a href="#"><img src="assets/images/portfolio/70.jpg" alt=""></a>
//                         </div>
//                         <div class="portfolio-description">
//                             <a href="#">
//                                 <h3>Towel World</h3>
//                                 <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.</p>
//                             </a>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//             <div class="col-lg-4 pb-4" data-animate="fadeInUp" data-animate-delay="0">
//                 <div class="portfolio-item bg-gradiant text-light no-overlay">
//                     <div class="portfolio-item-wrap">
//                         <div class="portfolio-image">
//                             <a href="#"><img src="assets/images/portfolio/70.jpg" alt=""></a>
//                         </div>
//                         <div class="portfolio-description">
//                             <a href="#">
//                                 <h3>Towel World</h3>
//                                 <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.</p>
//                             </a>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//             <div class="col-lg-4 pb-4" data-animate="fadeInUp" data-animate-delay="0">
//                 <div class="portfolio-item bg-gradiant text-light no-overlay">
//                     <div class="portfolio-item-wrap">
//                         <div class="portfolio-image">
//                             <a href="#"><img src="assets/images/portfolio/70.jpg" alt=""></a>
//                         </div>
//                         <div class="portfolio-description">
//                             <a href="#">
//                                 <h3>Towel World</h3>
//                                 <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.</p>
//                             </a>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//             <div class="col-lg-4 pb-4" data-animate="fadeInUp" data-animate-delay="0">
//                 <div class="portfolio-item bg-gradiant text-light no-overlay">
//                     <div class="portfolio-item-wrap">
//                         <div class="portfolio-image">
//                             <a href="#"><img src="assets/images/portfolio/70.jpg" alt=""></a>
//                         </div>
//                         <div class="portfolio-description">
//                             <a href="#">
//                                 <h3>Towel World</h3>
//                                 <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.</p>
//                             </a>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//             <div class="col-lg-4 pb-4" data-animate="fadeInUp" data-animate-delay="0">
//                 <div class="portfolio-item bg-gradiant text-light no-overlay">
//                     <div class="portfolio-item-wrap">
//                         <div class="portfolio-image">
//                             <a href="#"><img src="assets/images/portfolio/70.jpg" alt=""></a>
//                         </div>
//                         <div class="portfolio-description">
//                             <a href="#">
//                                 <h3>Towel World</h3>
//                                 <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.</p>
//                             </a>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//         </div>
//     </div>
// </section>
// <!-- end: SERVICES -->
// ';
$condition = array(
    'select'        =>  'blog_title, blog_title_support, blog_img, blog_date, blog_url'
    ,'where'        =>  array(
                                'blog_status' => '1'
                               ,'is_deleted' => '0'
                            )
    ,'order_by'     =>  'RAND() LIMIT 4'
    ,'return_type'  =>  'all'
);
$blogs     = $dblms->getRows(BLOGS, $condition);
echo '
<!-- BLOG -->
<div class="m-4 border mb-5 pt-2">
    <div class="col-lg-12">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-8">
                <h1>Platforms</h1>
                <p>We collaborate with top global technology providers, harnessing a diverse range of expertise to implement a wide array of solutions. Our approach is platform-agnostic, ensuring we offer the most effective recommendations tailored to drive success</p>
            </div>
            <div class="col-lg-4">
                <a href="'.SITE_URL.'platform" class="btn btn-lg">Explore Platforms</a>
            </div>
        </div>
    </div>
</div>
<section class="content background-grey m-b-0 border-bottom">
    <div class="container-fluid">
        <div class="heading-text heading-section text-center">
            <h2>OUR BLOG</h2>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div id="blog" class="grid-layout post-4-columns m-b-30" data-item="post-item">';
                    if($blogs){
                        foreach ($blogs as $blog) {
                            echo '
                            <!-- Post item-->
                            <div class="post-item border">
                                <div class="post-item-wrap">
                                    <div class="post-image">
                                        <a href="'.SITE_URL.'blog-detail/'.$blog['blog_url'].'">
                                            <img alt="" src="images/blogs/'.$blog['blog_img'].'">
                                        </a>
                                    </div>
                                    <div class="post-item-description">
                                        <span class="post-meta-date"><i class="fa fa-calendar-o"></i>'.date('M d, Y',strtotime($blog['blog_date'])).'</span>
                                        <h2><a href="'.SITE_URL.'blog-detail/'.$blog['blog_url'].'">'.$blog['blog_title'].'</a></h2>
                                        <p>'.html_entity_decode($blog['blog_title_support']).'</p>
                                        <a href="'.SITE_URL.'blog-detail/'.$blog['blog_url'].'" class="item-link">Read More <i class="icon-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- end: Post item-->';
                        }
                    }
                echo '
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: BLOG -->';
include 'team.php';
echo '
<div class="container mt-5 mb-5">
    <h3 class="text-uppercase">Contact Us</h3>
    <div class="m-t-30">
        <form class="widget-contact-form1" novalidate action="'.SITE_URL.'include/contact_us/query.php" role="form" method="post">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label class="sr-only">Name</label>
                        <input placeholder="Name" class="form-control required name" required name="cu_name" type="text">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="sr-only">Email</label>
                        <input placeholder="Email" class="form-control required email" required name="cu_email" type="email">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="sr-only">What is your web design requirement?</label>
                <input placeholder="What is your web design requirement?" required name="cu_requirment" class="form-control required" type="text">
            </div>
            <div class="form-group">
                <label class="sr-only">What are your website needs?</label>
                <input placeholder="What are your website needs?" required name="cu_need" class="form-control required" type="text">
            </div>
            <div class="form-group">
                <label class="sr-only">What type of business is this for?</label>
                <input placeholder="What type of business is this for?" required name="cu_business" class="form-control required" type="text">
            </div>
            <div class="form-group">
                <label class="sr-only">What industry do you operate in?</label>
                <input placeholder="What industry do you operate in?" required name="cu_industry" class="form-control required" type="text">
            </div>
            <div class="form-group">
                <label class="sr-only">When would you like the website to go live/be updated?</label>
                <input placeholder="When would you like the website to go live/be updated?" required name="cu_weblive" class="form-control required" type="text">
            </div>
            <div class="form-group">
                <label class="sr-only">What is your budget for this project?</label>
                <input placeholder="What is your budget for this project?" required name="cu_budget" class="form-control required" type="text">
            </div>
            <div class="form-group">
                <label class="sr-only">How likely are you to make a hiring decision?</label>
                <input placeholder="How likely are you to make a hiring decision?" required name="cu_hiring" class="form-control required" type="text">
            </div>
            <div class="form-group m-b-5">
                <label class="sr-only">Additional Details</label>
                <textarea required name="cu_detail" placeholder="Additional Details" class="form-control required" rows="5"></textarea>
            </div>
            <button class="btn" type="submit" id="form-submit1"><i class="fa fa-paper-plane"></i>&nbsp;Send message</button>
        </form>
    </div>
</div>';
?>        