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
    <title>SingIn</title>
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

            <?php

              if(isset($_COOKIE['User_ID'])){

                  require 'Assets/connect/connected.php';

                  $query = 'select * from users where ID ="'.base64_decode($_COOKIE['User_ID']).'" ';

                  $stmt = $conn->prepare($query);

                  $stmt->execute();

                  $result = $stmt->fetchAll();

                  foreach ($result as $value){

                      $GLOBALS['username'] = $value['username'];

                      $GLOBALS['password'] = $value['password'];

                      $GLOBALS['ID'] = $value['ID'];
                  }

              }
            ?>
            <div class="col-lg-5 col-12 order-2 order-lg-1 bg-color ">
                    <div class="login">
                        <div class="logo-site mx-auto">
                            <a href="index.php" target="_self">
                                <img src="Assets/images/logo/icon.png" class="align-items-center" alt="avater_sigIn_image">
                            </a>
                        </div>
                        <h3>We Are The Mentors</h3>
                            <p>Welcome back, please login to your account.</p>
                            <form method="POST" role="form" id="signIn" action="">
                                <div class="error validate"></div>
                                <div>
                                    <label>User Name *</label>
                                    <div class="username-input">
                                        <input autofocus placeholder="UserName" type="text" name="username" value="<?php echo isset($_COOKIE['User_ID']) != '' ? $GLOBALS['username'] : '' ?>">
                                        <span><i class="fa fa-user"></i></span>
                                    </div>
                                </div>

                                <div>
                                    <label>Password *</label>
                                    <div class="password-input">
                                        <input type="password" placeholder="Password" name="password" value="<?php echo isset($_COOKIE['User_ID']) != '' ? base64_decode($GLOBALS['password']) : '' ?>">
                                        <span><i class="fa fa-lock"></i></span>
                                    </div>
                                </div>

                                <div>
                                    <div class="custom-control custom-checkbox d-inline-block" style="margin-top:30px">
                                        <input type="checkbox" class="custom-control-input remember" id="custom_check"<?php echo isset($_COOKIE['User_ID']) != ''  ? 'checked' : ''?> >
                                        <label class="custom-control-label mt-0" for="custom_check">Remember Me</label>
                                    </div>

                                    <a href="forgetPassword.php" class="forget">Forget Password ?</a>
                                </div>

                                <div style="text-align: center" class="signIn">
                                    <input type="submit" value="Sign In" name="submitForm">
                                </div>

                                <div class="signup">
                                    <span>Don't have an account ?</span>
                                    <a href="signUp.php">Sign Up</a>
                                </div>

                                <input type="hidden" id="token" class="token" name="token">
                            </form>
                    </div><!-- End Login -->
            </div><!-- End Column -->

            <div class="col-lg-7 col-12  order-1 order-lg-2 bg-color1 d-lg-block d-none">
                <div class="signIn_image">
                    <div id="particles-js"></div>
                </div>
            </div>
        </div><!-- End Row -->
    </div><!-- End container -->
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
            grecaptcha.execute('6LcTyrgUAAAAAEhVcUyKZRYYsxfUAWVB7PyVjkgB', {action: 'homepage'}).then(function(token) {
               $('input[name="token"].token').val(token);
            });
        });
    </script>
    <script type="text/javascript">
        nicescroll();
    </script>

    </body>
</html>