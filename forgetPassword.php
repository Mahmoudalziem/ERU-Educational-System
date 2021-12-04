<?php

include 'Assets/connect/header.php';

    if(isset($_SESSION['username'])){

        header('Location: portfolio.php');
    }

?>

<!-- Favicon -->
<title>Forget Password</title>

</head>
    <body>

<!--============= Header =================-->
    <div class="container-fluid p-0">
    <div class="row no-gutters">

        <div class="col-lg-5 col-12 order-2 order-lg-1 bg-color">
            <div class="login forget">
                <div class="logo-site mx-auto">
                    <a href="index.php" target="_self">
                        <img src="Assets/images/logo/icon.png" class="align-items-center" alt="">
                    </a>
                </div>
                <h3>We Are The Mentors</h3>
                <p>Please enter your username or email address.
                    You will receive a link to create a new password via email.
                </p>

                <form action method="POST" role="form" id="forgetPassword">
                    <div class="error validate"></div>

                    <div>
                        <label>Username or Email Address *</label>
                        <div class="forget-input">
                            <input autofocus placeholder="UserName Or Email" type="text">
                            <span><i class="fa fa-user"></i></span>
                        </div>
                    </div>

                    <div style="text-align: center" class="forget_password">
                        <input type="submit" value="Get New Password">
                    </div>
                </form>
            </div><!-- End Login -->
        </div><!-- End Column -->

        <div class="col-lg-7 col-12  order-1 order-lg-2 bg-color1 d-lg-block d-none">
            <div class="forget_image">
                <div id="particles-js"></div>
            </div>
        </div>

    </div>
</div>
<!--============= Header End =============-->


<!--========= Loader ====================-->
    <div class="preloader">
        <div class="loader loader-1">
            <div class="loader-outter"></div>
            <div class="loader-inner"></div>
        </div>
    </div>
<!--========= End Loader ====================-->


<!--=========== Jquery ============ -->
<script src="Assets/Js/jquery-3.3.1.js"></script>
<!-- Bootstrap -->
<script src="Assets/Js/bootstrap.min.js"></script>
<!-- NiceScroll -->
<script src="Assets/Js/jquery.nicescroll.js"></script>
<!-- Wow -->
<script src="Assets/Js/wow.min.js"></script>
<!-- Contact Send -->
<script src="Assets/Js/contact_send.js"></script>
<!-- Plugins -->
<script src="Assets/Js/plugin.js"></script>
<script type="text/javascript">
    nicescroll();
</script>

    </body>
</html>