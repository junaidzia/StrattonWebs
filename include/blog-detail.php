<?php

$condition = array(
    'select'       =>  'blog_title, blog_title_support, blog_des, blog_img, blog_banner, blog_user, blog_date, blog_tags'
    ,'where'        =>  array(
                                'blog_status'   => '1'
                               ,'is_deleted'    => '0'
                               ,'blog_url'      => $zone
                            )
   ,'return_type'  =>  'single'
);
$row     = $dblms->getRows(BLOGS, $condition);
echo '
<!-- Page title -->
<section id="page-title" class="page-title-center text-light" style="background-image:url('.SITE_URL.'images/blogs/banner/'.$row['blog_banner'].');">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="page-title">
            <h1>'.$row['blog_title'].'</h1>
            <p>'.html_entity_decode($row['blog_title_support']).'</p>
            <div class="small m-b-20">'.date('M d, Y',strtotime($row['blog_date'])).' | <a href="#">by '.$row['blog_user'].'</a> </div>
        </div>
    </div>
</section>
<!-- end: Page title -->
<!-- Page Content -->
<section id="page-content" class="sidebar-right">
    <div class="container">
        <div id="blog" class="single-post col-lg-10 center">
            <!-- Post single item-->
            <div class="post-item">
                <div class="post-item-wrap">
                    <div class="post-item-description text-dark" data-animate="fadeInUp" data-animate-delay="0">
                        '.html_entity_decode(html_entity_decode($row['blog_des'])).'
                    </div>
                    <div class="post-tags">';
                        $tags = explode(',',$row['blog_tags']);
                        if($tags){
                            foreach ($tags as $value) {
                                echo'<a href="#">'.$value.'</a> ';
                            }
                        }
                    echo '
                    </div>
                </div>
            </div>
            <!-- end: Post single item-->
        </div>
    </div>
</section>
<!-- end: Page Content -->';

?>