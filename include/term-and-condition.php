<?php
$condition = array(
    'select'        =>  'term_des'
    ,'where'        =>  array(
                                'term_status'   => '1'
                               ,'is_deleted'    => '0'
                            )
   ,'return_type'  =>  'all'
);
$row     = $dblms->getRows(TERMANDCONDITIONS, $condition);

echo '
<!-- Page title -->
<section id="page-title" data-bg-parallax="assets/images/parallax/5.jpg">
    <div class="container">
        <div class="page-title">
            <h1>Term And Conditions</h1>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="'.SITE_URL.'">Home</a> </li>
                <li class="active"><a href="#">Term And Conditions</a> </li>
            </ul>
        </div>
    </div>
</section>
<!-- end: Page title -->
<section id="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">';
                    foreach ($row as $term) {
                        echo html_entity_decode(html_entity_decode($term['term_des']));
                    }
                echo '
            </div>
        </div>
    </div>
</section>
';

?>