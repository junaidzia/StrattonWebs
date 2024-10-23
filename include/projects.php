<?php

$condition = array(
    'select'       =>  'project_title, project_img, project_title_support, project_url'
   ,'where'        =>  array(
                                'project_status'        => 1
                               ,'p.is_deleted'          => 0
                           )
   ,'order_by'     =>  'project_id ASC'
   ,'return_type'  =>  'all'
);
$projects     = $dblms->getRows(PROJECTS . ' p' , $condition);
echo '
<section id="page-title" data-bg-parallax="assets/images/parallax/5.jpg">
    <div class="container">
        <div class="page-title">
            <h1>Projects</h1>
            <span>The most happiest time of the day!.</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="'.SITE_URL.'">Home</a> </li>
                <li class="active"><a href="#">Projects</a> </li>
            </ul>
        </div>
    </div>
</section>
<section id="page-content">
    <div class="container">
        <div class="m-b-40">';
            echo '<h2 align="center">We Build Business</h2>';
            // echo '
            //     <div class="col-lg-4">
            //         <div class="order-select">
            //             <h6>Sort by </h6>
            //             <form method="get">
            //                 <select class="form-control">
            //                     <option value="" selected="selected">Services</option>
            //                     <option value="popularity">Sort by popularity</option>
            //                     <option value="rating">Sort by average rating</option>
            //                     <option value="date">Sort by newness</option>
            //                     <option value="price">Sort by price: low to high</option>
            //                     <option value="price-desc">Sort by price: high to low</option>
            //                 </select>
            //             </form>
            //         </div>
            //     </div>
            //     <div class="col-lg-4">
            //         <div class="order-select">
            //             <h6>Sort by </h6>
            //             <form method="get">
            //                 <select class="form-control">
            //                     <option value="order" selected="selected">Platforms</option>
            //                     <option value="popularity">Sort by popularity</option>
            //                     <option value="rating">Sort by average rating</option>
            //                     <option value="date">Sort by newness</option>
            //                     <option value="price">Sort by price: low to high</option>
            //                     <option value="price-desc">Sort by price: high to low</option>
            //                 </select>
            //             </form>
            //         </div>
            //     </div>
            //     <div class="col-lg-4">
            //         <div class="order-select">
            //             <h6>Sort by </h6>
            //             <form method="get">
            //                 <input type="text" placeholder="Enter you keyword" class="form-control">
            //             </form>
            //         </div>
            //     </div>';
            echo '
        </div>
    </div>
    <div class="container-fluid portfolio">
        <div id="portfolio" class="grid-layout portfolio-4-columns">';
            foreach ($projects as $project) {
                echo '
                <a href="'.SITE_URL.'project-detail/'.$project['project_url'].'">
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
                </a>';
            }
            echo '
        </div>
    </div>
</section>';

?>