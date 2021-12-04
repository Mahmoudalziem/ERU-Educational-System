<!--suppress HtmlUnknownTarget -->

<!-- ========== Footer Section ============-->
    <div class="footer-section">
        <span>All right Reserved <?php echo date('Y')?> @ Ask The Proff </span>
        <span>Desgined With Love By @ <a href="https://www.facebook.com/Alziem2" target="_blank" title="Developper Page 
        Facebook">ENG/AZIMA</a></span>
    </div>
<!--========== End Footer Section ==========-->

<!--============== Loader Start ==============-->
    <div class="preloader">
        <div class="loader loader-1">
            <div class="loader-outter"></div>
            <div class="loader-inner"></div>
        </div>
    </div>
<!--============== Loader End ==============-->

<!-- Jquery ==== -->
<script src="Assets/Js/jquery-3.3.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<!-- propper -->
<script src="Assets/Js/popper.js"></script>
<script src="Assets/Js/tooltip.js"></script>
<!-- Bootstrap -->
<script src="Assets/Js/bootstrap.min.js"></script>
<!-- NiceScroll -->
<script src="Assets/Js/jquery.nicescroll.js"></script>
<!-- Contact Send -->
<script src="Assets/Js/contact_send.js"></script>
<!-- tooken faield -->
<script src="Assets/Js/bootstrap-tokenfield.min.js"></script>
<!-- Plugins -->
<script src="Assets/Js/plugin.js"></script>
<script>$('#search_input,#search_input_phone').tokenfield();</script>

<?php
    if (isset($_SESSION['username'])) {
        echo '<script>

                notification_insert();

                    $("html").mouseenter(function () {
                    
                        var id =  setInterval(function () {
                    
                                notification_insert();
                                
                            },2000);
                    
                            $(this).mouseleave(function () {
                    
                                clearInterval(id);
                            });
                    
                    });

                </script>';
    };
?>
