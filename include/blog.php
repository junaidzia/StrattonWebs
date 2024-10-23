<?php

$condition = array(
    'select'       =>  'blog_title, blog_title_support, blog_img, blog_date, blog_url'
    ,'where'        =>  array(
                                'blog_status' => '1'
                               ,'is_deleted' => '0'
                            )
   ,'return_type'  =>  'all'
);
$row     = $dblms->getRows(BLOGS, $condition);

echo '
<!-- Page title -->
<section id="page-title" data-bg-parallax="assets/images/parallax/5.jpg">
    <div class="container">
        <div class="page-title">
            <h1>Blog</h1>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="'.SITE_URL.'">Home</a> </li>
                <li class="active"><a href="#">Blog</a> </li>
            </ul>
        </div>
    </div>
</section>
<!-- end: Page title -->
<!-- Content -->
<section id="page-content">
    <div class="container">
        <!-- post content -->
        <!-- Blog -->
        <div id="blog" class="grid-layout post-3-columns m-b-30" data-item="post-item">';
            if($row){
                foreach ($row as $blog) {
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
        <!-- end: Blog -->';
        // echo '
        // <!-- Pagination -->
        // <ul class="pagination">
        //     <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
        //     <li class="page-item"><a class="page-link" href="#">1</a></li>
        //     <li class="page-item"><a class="page-link" href="#">2</a></li>
        //     <li class="page-item active"><a class="page-link" href="#">3</a></li>
        //     <li class="page-item"><a class="page-link" href="#">4</a></li>
        //     <li class="page-item"><a class="page-link" href="#">5</a></li>
        //     <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
        // </ul>
        // <!-- end: Pagination -->';
        echo '
    </div>
    <!-- end: post content -->
</section> <!-- end: Content -->';

?>