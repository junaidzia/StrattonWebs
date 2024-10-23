<?php

$condition = array(
    'select'       =>  'contact_social, contact_countries'
    ,'where'        =>  array(
                               'contact_id' => cleanvars(1)
                           )
   ,'return_type'  =>  'single'
);
$row     = $dblms->getRows(CONTACT, $condition);
$contactcountries = unserialize(base64_decode($row['contact_countries']));
$socialmedia = unserialize(base64_decode($row['contact_social']));

echo '

<!-- Footer -->
<footer id="footer">
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="widget">
                        <div class="widget-title">'.SITE_NAME.'</div>
                        <p>Built with love in Fort Worth, Texas, USA<br> All rights reserved. Copyright © 2019. INSPIRO.</p>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="mb-4 social-icons social-icons-medium social-icons-colored">
                                    <ul>';
                                        foreach (social_media() as $key => $value) {
                                            if ($socialmedia[$key]) {
                                                echo'<li class="social-'.strtolower($value[0]).'"><a href="'.$socialmedia[$key].'" target="_blank"><i class="fab fa-'.$value[1].'"></i></a></li>';
                                            }
                                        }
                                        echo '
                                    </ul>
                                </div>
                            </div>    
                        </div>
                        <a href="#modalLogin" data-lightbox="inline" class="btn btn-inverted">Get a Quote</a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="widget">
                                <div class="widget-title">Services</div>
                                <ul class="list">';
                                    if ($servicess) {
                                        foreach ($servicess as $service) {
                                            echo '<li><a href="'.SITE_URL.'service-detail/'.$service['service_url'].'">'.html_entity_decode($service['service_title']).'</a></li>';
                                        }
                                    }
                                    echo '
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="widget">
                                <div class="widget-title">Insights</div>
                                <ul class="list">
                                    <li><a href="'.SITE_URL.'blog">Blogs</a></li>
                                    <li><a href="'.SITE_URL.'about">About Us</a></li>
                                    <li><a href="'.SITE_URL.'privacy">Privacy Policy</a></li>
                                    <li><a href="'.SITE_URL.'term-and-condition"    >Term & Condition</a></li>
                                    <li><a href="'.SITE_URL.'faqs">FAQ\'s</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="widget">
                                <div class="widget-title">Address</div>
                                <ul class="list">';
                                    foreach (contact_countries() as $key => $value) {
                                        if (isset($contactcountries[$key][0])) {
                                            echo'<li>'.$contactcountries[$key][0].'</li>';
                                        }
                                    }
                                    echo '
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="widget">
                                <div class="widget-title">Contact Info</div>
                                <ul class="list">';
                                    foreach (contact_countries() as $key => $value) {
                                        if (isset($contactcountries[$key][1])) {
                                            echo '<li><a href="tel:'.$contactcountries[$key][1].'"><img src="'.SITE_URL.'images/countries/'.$value[1].'" width="25"> '.$contactcountries[$key][1].'</a></li>';
                                        }
                                    }
                                    echo '
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-content">
        <div class="container">
            <div class="copyright-text text-center">'.COPY_RIGHTS_ORG.'<a href="'.COPY_RIGHTS_URL.'" target="_blank" rel="noopener"> '.COPY_RIGHTS.'</a> </div>
        </div>
    </div>
</footer>
<!-- end: Footer -->
<!-- Modal -->
<div id="modalLogin" class="modal'.(CONTROLER?'':'').' no-padding" data-delay="0" style="max-width: 1024px;">
    <div class="row">
        <div class="col-md-6 no-padding" style="background: transparent url('.SITE_URL.'assets/images/login-bg.jpg) no-repeat scroll center top / cover;">
        </div>
        <div class="col-md-6">
            <div class="p-20 p-t-60 p-xs-20">
                <h3>Get In Touch</h3>
                <form class="widget-contact-form" novalidate action="'.SITE_URL.'include/get_in_touch/query.php" role="form" method="post">    
                    <div class="form-group">
                        <label class="sr-only">Name</label>
                        <input placeholder="Name" class="form-control required name" required name="git_name" type="text">
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Email</label>
                        <input placeholder="Email" class="form-control required email" required name="git_email" type="email">
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Subject</label>
                        <input placeholder="Subject" class="form-control required" required name="git_subject" type="text">
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Subject</label>
                        <textarea type="text" name="git_msg" required rows="5" class="form-control required" placeholder="Enter your Message"></textarea>
                    </div>
                    <div class="text-left form-group">
                        <button class="btn" type="submit" id="form-submit">Send Message</button>
                    </div>
                </form>
                </p>
            </div>
        </div>
    </div>
</div>
<!--end: Modal -->';

?>