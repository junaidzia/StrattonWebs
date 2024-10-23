<?php

$condition = array(
    'select'       =>  'contact_title, contact_banner, contact_getintouch, contact_countries, contact_map'
    ,'where'        =>  array(
                               'contact_id' => cleanvars(1)
                           )
   ,'return_type'  =>  'single'
);
$row     = $dblms->getRows(CONTACT, $condition);
$contactcountries = unserialize(base64_decode($row['contact_countries']));
echo '
<!-- Page title -->
<section id="page-title" data-bg-parallax="images/banner/'.$row['contact_banner'].'">
    <div class="container">
        <div class="page-title">
            <h1>Contact Us</h1>
            <span>'.$row['contact_title'].'</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="'.SITE_URL.'">Home</a> </li>
                <li class="active"><a href="#">Contact Us</a> </li>
            </ul>
        </div>
    </div>
</section>
<!-- end: Page title -->
<!-- CONTENT -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="text-uppercase">Contact Us</h3>
                <p>'.html_entity_decode($row['contact_getintouch']).'</p>
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
            </div>
            <div class="col-lg-6">
                <h3 class="text-uppercase">Address & Map</h3>
                <div class="row">';
                    foreach (contact_countries() as $key => $value) {
                        if (isset($contactcountries[$key])) {
                            echo '
                            <div class="col">
                                <address>
                                    <strong>'.$value[0].'</strong><br>
                                    '.$contactcountries[$key][0].'<br>
                                    <abbr title="Phone">P:</h4> '.$contactcountries[$key][1].'
                                </address>
                            </div>';
                        }
                    }
                    echo '
                </div>
                <!-- Google Map -->
                <iframe src="https://www.google.com/maps/embed?'.$row['contact_map'].'" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <!-- end: Google Map -->
            </div>
        </div>
    </div>
</section> <!-- end: Content -->';

?>