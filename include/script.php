<?php

echo '
    </div>
    <!-- end: Body Inner -->
    <!-- Scroll top -->
    <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
    <!--Plugins-->
    <script src="'.SITE_URL.'assets/js/jquery.js"></script>
    <script src="'.SITE_URL.'assets/js/plugins.js"></script>
    <!--Template functions-->
    <script src="'.SITE_URL.'assets/js/functions.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!--Google Maps files-->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOksKHb9HyydVB-mcrqKUVfA_LeB79jcQ"></script>
    <script type="text/javascript" src="'.SITE_URL.'assets/plugins/gmap3/gmap3.min.js"></script>
    <script type="text/javascript" src="'.SITE_URL.'assets/plugins/gmap3/map-styles.js"></script>
    <script src="https://kit.fontawesome.com/81e1402dbd.js" crossorigin="anonymous"></script>
    <script>    
    $(".owl-carousel-owl").owlCarousel({
        loop:true,
        dots:true,
        nav : false,
        dotsContainer: "#dots",
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:1,
                nav:false
            },
            1000:{
                items:1,
                nav:true,
                loop:false
            }
        }
    }) 
    var dotsContainer = $("#dots");
    var dotItems = $(".owl-dot", dotsContainer);

    </script>
</body>

</html>';
    
?>