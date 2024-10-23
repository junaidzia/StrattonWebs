<?php

echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="'.SITE_NAME.'" />
    <meta name="description" content="Creating Digital Experiences That Drive Growth">
    <meta property="og:image" content="'.SITE_URL.'images/fav.png">
    <link rel="icon" type="image/png" href="'.SITE_URL.'images/fav.png">   
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Document title -->
    <title>'.TITLE_HEADER.' | '. (CONTROLER ? ucwords(CONTROLER) : 'Home') .'</title>
    <!-- Stylesheets & Fonts -->
    <link href="'.SITE_URL.'assets/css/plugins.css" rel="stylesheet">
    <link href="'.SITE_URL.'assets/css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" rel="stylesheet">
</head>

<body>
    <!-- Body Inner -->
    <div class="body-inner">';

?>