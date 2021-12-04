<?php

session_start();

ob_start();

if(isset($_SESSION['username'])){

    if($_SESSION['username'] == 'admin'){

        header('Location: admin_Dashboard.php');

        ob_end_flush();

    }
    else{

        header('Location: portfolio.php?UN=' . $_SESSION['username']);

        ob_end_flush();

    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--Meta tags-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- First Mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Application-Name -->
    <meta name="application-name" content="Engineering Site">
    <!-- Favicon -->
    <title>SingUp</title>
    <!-- Author Name -->
    <meta name="author" content="Azima">
    <link rel="icon" href="Assets/images/logo/favicon.ico">
    <!--BootStrap -->
    <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
    <!-- Font-Awesome -->
    <link rel="stylesheet" href="Assets/css/font-awesome.css">
    <!--[if lt IE 9>
        <script src="Assets/Js/html5shiv.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="Assets/css/main.css">
    <!-- responsive --> 
    <link rel="stylesheet" href="Assets/css/responsive.css">

</head>
    <body>

<!--============= Header =================-->
    <div class="container-fluid p-0">
    <div class="row no-gutters">

        <div class="col-lg-5 col-12 order-2 order-lg-1 bg-color">
            <div class="login register">
                <div class="logo-site mx-auto">
                    <a href="index.php" target="_self">
                        <img src="Assets/images/logo/icon.png" class="align-items-center" alt="signUp_image">
                    </a>
                </div>
                <h3>We Are The Mentors</h3>
                <p>Welcome , Please create your account.</p>
                <form action="" method="POST" id="signUp_form" role="form">
                    <div class="error validate"></div>

                    <div>
                        <label>User Name *</label>
                        <div class="username-input">
                            <input type="text" placeholder="UserName" autofocus>
                            <span><i class="fa fa-user"></i></span>
                        </div>
                    </div>

                    <div>
                        <label>Name *</label>
                        <div class="name-input">
                            <input type="text" placeholder="Your Name" autofocus>
                            <span><i class="fa fa-user"></i></span>
                        </div>
                    </div>

                    <div>
                        <label>Email *</label>
                        <div class="Email-input">
                            <input type="email" placeholder="E-mail">
                            <span><i class="fa fa-telegram"></i></span>
                        </div>
                    </div>

                    <div>
                        <label>Password *</label>
                        <div class="password-input">
                            <input type="password" placeholder="Password">
                            <span><i class="fa fa-lock"></i></span>
                        </div>
                    </div>

                    <div>
                        <label>Confirm *</label>
                        <div class="confirm-input">
                            <input type="password" placeholder="Confirm Password">
                            <span><i class="fa fa-lock"></i></span>
                        </div>
                    </div>

                    <div style="text-align: center" class="signUp">
                        <input type="submit" value="Sign Up">
                    </div>

                    <div class="signup">
                        <span>Do have an account ?</span>
                        <a href="signIn.php">Sign In</a>
                    </div>
                </form>
            </div><!-- End Login -->
        </div><!-- End Column -->

        <div class="col-lg-7 col-12  order-1 order-lg-2 bg-color1 d-lg-block d-none position-relative">
            <div class="signUp_image">
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
    <!-- Contact Send -->
    <script src="Assets/Js/contact_send.js"></script>
    <!-- Plugins -->
    <script src="Assets/Js/plugin.js"></script>
    <!-- reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js?render=6LcTyrgUAAAAAEhVcUyKZRYYsxfUAWVB7PyVjkgB"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LcTyrgUAAAAAEhVcUyKZRYYsxfUAWVB7PyVjkgB', {action: 'homepage'}).then(function(token) {});
        });
    </script>
    <script type="text/javascript">
        nicescroll();
    </script>

    </body>
</html>