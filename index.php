<?php
include "include/dbsetting/classdbconection.php";
include "include/dbsetting/lms_vars_config.php";
$dblms = new dblms();
include "include/functions/functions.php";
include_once "include/head.php";
include_once "include/navbar.php";

// ADMIN REDIRECTION
if($control=="admin"){
  header("Location:index.php");
  exit();
}


// SITE REDIRECTIONS
if (CONTROLER == 'service' && $zone == "digital-marketing"){
  include ('include/services/digital.php'); 
} else if (CONTROLER == 'admin'){
  header('location: index.php'); 
} else if (CONTROLER == 'platform-detail'){
  include ('include/platform-detail.php'); 
} else if (CONTROLER == 'platform'){
  include ('include/platform.php'); 
} else if (CONTROLER == 'sub-service'){
  include ('include/sub-service.php'); 
} else if (CONTROLER == 'service-detail'){
  include ('include/service-detail.php'); 
} else if (CONTROLER == 'services'){
  include ('include/services.php'); 
} else if (CONTROLER == 'project-detail'){
  include ('include/project-detail.php'); 
} else if (CONTROLER == 'projects'){
  include ('include/projects.php'); 
} else if (CONTROLER == 'faqs'){
  include ('include/faqs.php'); 
} else if (CONTROLER == 'term-and-condition'){
  include ('include/term-and-condition.php'); 
} else if (CONTROLER == 'privacy'){
  include ('include/privacy.php'); 
} else if (CONTROLER == 'career'){
  include ('include/career.php'); 
} else if (CONTROLER == 'about'){
  include ('include/about.php'); 
} else if (CONTROLER == 'blog-detail'){
  include ('include/blog-detail.php'); 
} else if(CONTROLER == 'blog'){
  include ('include/blog.php'); 
} else if (CONTROLER == 'contact'){
  include ('include/contact_us.php'); 
} else if(empty(CONTROLER)){
  include ('include/index.php'); 
} else{
  header("location: ".SITE_URL);
}

include_once "include/footer.php";
include_once "include/script.php";
?>