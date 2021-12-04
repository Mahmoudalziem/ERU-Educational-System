<?php

    require 'Assets/connect/connected.php';

    include 'Assets/connect/header.php';

?>

<!-- Favicon -->
<title>Contact Us</title>

</head>
    <body>

<!--============= Header =================-->
    <?php echo include 'Assets/connect/headerPortfolio.php' ?>
<!--============= Header End =============-->

<!--============= Header banner ==================-->
    <div class="courses-show contact_us">
    <div class="show-content">
        <div class="container">
            <h3>
                Contact Us
            </h3>
            <ul class="content-nav">
                <li>
                    <a href="index.php" target="_self">
                        <i class="fa fa-home"></i> Home
                    </a>
                </li>
                <li>
                    <div>
                        <i class="fa fa-long-arrow-right"></i> Contact Us
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--============= Header banner End ===============-->

<!--=============== contact Page ===========-->
    <div class="contact-page">
    <div class="container">
        <div class="row">
        <div class="col-md-4 col-12">

            <div class="contact-page-info d-flex">
                <span>
                    <i class="fa fa-send-o"></i>
                </span>
                <div class="contact-page-details">
                    <h3>Office Location</h3>
                    <p>Egyptian Russian University</p>
                </div>
            </div>

            <div class="contact-page-info d-flex">
                <span>
                    <i class="fa fa-envelope"></i>
                </span>
                <div class="contact-page-details">
                    <h3>Contact E-Mail</h3>
                    <p>iser4440@gmail.com</p>
                </div>
            </div>

            <div class="contact-page-info d-flex">
                <span>
                    <i class="fa fa-phone"></i>
                </span>
                <div class="contact-page-details">
                    <h3>Contact Number</h3>
                    <p>[ +02 ] 01111694896</p>
                </div>
            </div>


            <div class="contact-page-info d-flex">
                <span>
                    <i class="fa fa-tv"></i>
                </span>
                <div class="contact-page-details">
                    <h3>Our Website</h3>
                    <p>www.AskTheProff.com</p>
                </div>
            </div>

        </div><!-- End Column -->

        <div class="col-md-8 col-12">

            <div class="contact-page-title">
                <h3>Have You any Questions?</h3>
                <p>
                    If You Have a Problem In SomeThing , You Want To Add Special Courses In
                    Site, Or You Need Some Feathers In This Site Don't Worry Send Us A Message 
                    and we'll respond as soon as possible . 
                </p>
            </div>

            <form action="" class="form_contact_us" role="form" method="POST">

                <div class="validate error"></div>

                <div class="form-name">
                    <div class="row">

                        <div class="col-md-6 col-12">
                            <div data-validate="First Name Required" class="position-relative">
                                <input class="input_100" type="text" name="f_name" placeholder="First Name" autocomplete />
                            </div>
                        </div>

                        <div class="col-md-6 col-12 pt-4 pt-sm-0">

                            <div data-validate="Last Name Required" class="position-relative">
                                <input class="input_100" name="l_name" type="text" placeholder="Last Name">
                            </div>

                        </div>

                    </div><!-- End Row -->
                </div><!-- End Name -->

                    <div data-validate="Email Is Required">
                        <input class="input_100" name="email_name" type="email" placeholder="Email">
                    </div>

                <div class="form-message" data-validate="Message Is Required">
                    <textarea class="input_100 message_area" placeholder="Message"></textarea>
                </div>

                <div class="form-button mr-auto mx-auto">
                    <input type="submit" value="Submit" class="submit_message_send">
                </div>
            </form>
        </div>
        </div>
    </div><!-- End Container -->
</div>
<!--=============== contact Page End ========-->

<!--=================== Map Section ==========-->

<section class="map-contact-section">
        <iframe id="map"src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7184.66932628105!2d31.722438427278387!3d30.142539701256123!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb5662c78d46bcf91!2sFaculty+Of+Engineering!5e0!3m2!1sar!2seg!4v1562726986385!5m2!1sar!2seg" width="600" height="450" frameborder="0" style="border:0" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</section>

<!--=================== End Map Section ==========-->

<?php
    include 'Assets/connect/footer.php';
?>

<script type="text/javascript">
    nicescroll();
</script>

    </body>
</html>