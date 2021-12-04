<?php

    require 'Assets/connect/connected.php';

    include 'Assets/connect/header.php';
    
    ob_start();

    if (isset($_SESSION['username'])) {

        if ($_SESSION['username'] == 'admin') {

            header('Location: admin_Dashboard.php');

            ob_end_flush();

        } else {

            header('Location: portfolio.php?UN=' . $_SESSION['username']);

            ob_end_flush();

        }
}
?>

<!-- Favicon -->
<title>404 Error</title>

</head>
    <body>

<!--============= Header =================-->
    <?php echo include 'Assets/connect/headerPortfolio.php' ?>
<!--============= Header End =============-->


<!--============= error Page ===========-->
    <div class="error-page">
        <div class="container">
            <div class="col-md-12 col-12  align-self-center">
                <div id="particles-js"></div>
                <div class="error-body">
                    <div class="col-md-8 mx-auto col-12">
                        <div class="error-image animated fadeInDown">
                            <img src="Assets/images/404/404.svg">
                        </div>

                    </div>
                    <a href="index.php" target="_self" class="animated fadeInLeft">Visit Home Page</a>
                    <a href="contactUs.php" class="animated fadeInRight">Contact Us</a>
                </div>


            </div>
        </div>
    </div>
<!--============= error Page End =======-->


<?php
    include 'Assets/connect/footer.php';
?>

    </body>
</html>

