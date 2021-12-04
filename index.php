<?php

    session_start();

    ob_start();

    if(isset($_SESSION['username'])){

        if($_SESSION['username'] == 'admin'){

            header('Location: admin_Dashboard.php');

            ob_end_flush();
        }
    }
    require 'Assets/connect/connected.php';
    
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
    <meta name="application-name" content="Engineering Site To Help Each Other To In The Study To Getting High Markts In All Subjects">
    <!-- Author Name -->
    <meta name="author" content="Eng/Azima">
    <!-- Favicon -->
    <title>Home</title>
    <link rel="icon" href="Assets/images/logo/favicon.ico">
    <!--BootStrap -->
    <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
    <!-- Font-Awesome -->
    <link rel="stylesheet" href="Assets/css/font-awesome.css">
    <!--[if lt IE 9>
        <script src="Assets/Js/html5shiv.min.js"></script>
    <![endif]-->
    <!-- animate -->
    <link rel="stylesheet" href="Assets/css/animate.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="Assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="Assets/css/owl.theme.default.min.css">
    <!-- main Style -->
    <link rel="stylesheet" href="Assets/css/main.css">
    <!-- responsive -->
    <link rel="stylesheet" href="Assets/css/responsive.css">
</head>
<body>

<!--============= Header =================-->
    <?php echo include 'Assets/connect/headerPortfolio.php' ?>
<!--============= Header End =============-->

<!--=============== Home Slider ==============-->
    <section class="home-slider owl-carousel owl-loaded owl-theme" id="home-slider">
    <div class="item item1">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="home-content">
                        <h5 class="wow fadeInUp" data-wow-delay=".1s">
                        We work hard to prepare you to be a perfect engineer with us 
                        </h5>
                        <p class="wow fadeInUp" data-wow-delay=".2s">
                            We are students that their goal is to help each other in the study, 
                            to enhance teaching and learning and getting higher marks in all subjects until
                            getting a full mark in all subjects.
                        </p>
                        <a href="<?php echo isset($_SESSION['username']) ? 'portfolio.php?UN='. $_SESSION['username'] : 'signIn.php' ?>" class="button wow fadeInUp" data-wow-delay=".3s">Get Started Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="item item2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="home-content">
                        <h5>
                            All what you want is here in this site don’t worry
                        </h5>
                        <p>
                            In This Site You Will Find All What You Need From materials In Engineering Science,
                            Videos with excellent professors in teaching, All Slides in all subjects … etc.
                        </p>
                        <a href="signIn.php" class="button">Get Started Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!--=============== Home Slider End ==============-->

<!--================= About Us ====================-->
<section class="about-header">
        <div class="container">
            <div class="row">

            <div class="col-lg-3 col-md-6 col-12  wow fadeInLeft">
                    <div class="header-body item">
                        <div class="body-image">
                            <img src="Assets/images/About Us/icon1.png" alt="image Body">
                        </div>
                        <h3>All What You want</h3>
                        <p>Notification system,courses with Perfect Doctors, All Slides in all Semesters</p>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6 col-12 wow fadeInUp" data-wow-delay=".1s">
                    <div class="header-body item">
                        <div class="body-image">
                            <img src="Assets/images/About Us/icon3.png" alt="image Body">
                        </div>
                        <h3>Best E-learning System</h3>
                        <p>
                            Get a Full Marks In All Subjects With Fantastic Teaching And Perfect Materials 
                        </p>
                    </div>
                </div>



                <div class="col-lg-3 col-md-6 col-12 wow fadeInUp" data-wow-delay=".1s">
                    <div class="header-body item">
                        <div class="body-image">
                            <img src="Assets/images/About Us/icon4.png" alt="image Body">
                        </div>
                        <h3>Be a Perfect Engineer</h3>
                        <p>Intro to all Materials In Each Semester With Joy In Watching Videos</p>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6 col-12 wow fadeInRight" data-wow-delay=".1s">
                    <div class="header-body item">
                        <div class="body-image">
                            <img src="Assets/images/About Us/icon2.png" alt="image Body">
                        </div>
                        <h3>Help Us</h3>
                        <p>
                            Help Us by sharing your data with us to help others to get higher marks in all subjects
                        </p>
                    </div>
                </div>

            </div>
            <!-- End Row -->
        </div>
        <!-- Container -->
    </section>

<!--===============================================-->
    <section class="about-body mt-50">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-12">
                    <div class="body-content">
                        <h3 class="wow fadeInLeft">What AsK The PRoFF</h3>
                        <div class="body-details wow fadeInLeft" data-wow-delay=".2s">

                            <p>
                                <strong>Ask Proff</strong> Students are a community of global learners united in a shared goal of uplifting 
                                and enhancing the learning process. Our unique learning model enables an unprecedented
                                degree of engagement with our students, and we are with them through every step of their 
                                learning journey.
                            </p>

                            <p>
                                Our emblem is Students First and this is the light that guides us as we continue 
                                our mission to receive the highest quality in learning process to as many students 
                                as we can possibly reach .
                            </p>
                        
                            <p>
                                Ask the prof helps organizations of all kinds to prepare for the ever-evolving future of work. 
                                Our curated collection of top-rated business and technical courses gives companies, governments
                                and nonprofits the power to develop in-house expertise and satisfy employees’ hunger for 
                                learning and development.
                            </p>

                        </div>
                        <!-- End Body Details -->
                    </div>
                    <!-- End Body -->
                </div>
                <!-- End Column -->

                <div class="col-md-5 col-12 wow fadeInRight" data-wow-delay=".1s">
                    <div class="body-image mx-auto col-11">
                        <img src="Assets/images/About Us/site.png" alt="body Image">
                    </div>
                </div>
            </div>
            <!-- end Row -->
        </div>
        <!-- End Container-->
    </section>
<!--================ End About Us =================-->



<!-- Subscribe With Us --> 
<h3 class="scribe_h3">Subscribe In New Courses</h3>
    <div class="section_scribe">
        <div class="container">
            <form class="form_subscribe" method="POST" action="" name="form_scribe">
                    <div class="row justify-content-center">

                            <div class="col-md-4 col-12">
                                <div data-validate="Name Is Required" class="position-relative">
                                    <input type="text" class="name_user input_100 name-input" placeholder="Your Name" name="name_scribe">
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div data-validate="E-mail Is Required" class="position-relative">
                                    <input type="email" placeholder="Your E-mail" name="email_scribe" class="email_scribe input_100 Email-input"/>
                                </div>
                            </div>

                            <div class="col-md-2 col-12 button_scribe">
                                <input type="submit" value="Subscribe" name="button_scribe"/>
                                <span class="tooltip_course" id="tooltip_course">
                                    Subscribe Now
                                </span>
                            </div>  

                    </div>
            </form>
        </div>
    </div>
<!-- End Subscribe With Us -->
<!--=========== Achieve Site =============-->

<div class="achieve-site">
        <div class="container">
            <div class="achieve-header mx-auto col-md-7 col-12 wow fadeInUp">
            <h3 class="achieve_h3">Our Achieves</h3>
                <p>
                    In This Site You Will Find All What You Need From Materials In Engineering Science , Videos To excellent Professors in Teaching
                     ,All Slides in all subjects and you have the ability to watch them or save them in your profile
                </p>
            </div>
            <div class="achieve-body">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12 wow fadeInLeft">
                        <i class="fa fa-users"></i>
                        <?php 

                            $query_visitors = 'select * from visitors_number order by visitor_id';

                            $stmt_visitors = $conn->prepare($query_visitors);

                            $stmt_visitors->execute();

                            $rowCount_visitors = $stmt_visitors->rowCount();

                        ?>
                        <h3 class="counter"><?php echo isset($rowCount_visitors) == null ? 0 : $rowCount_visitors;?></h3>
                        <p>Visitors</p>
                    </div>


                    <div class="col-lg-3 col-md-6 col-12 wow fadeInUp" data-wow-delay=".1s">
                        <i class="fa fa-play-circle"></i>
                        <?php

                            function sum_time($times){
                                $mins = 0;
                                foreach($times as $time){
                                    list($hour, $min) = explode(':',$time);
                                    $mins += $hour * 60;
                                    $mins += $min;
                                }

                                $hours = floor($mins /60);
                                $mins -= $hours * 60;

                                return $hours + $mins;
                            }  
                            
                            $array = [];

                            $query_sum = 'select * from videos_files where video_file_type = "video"';

                            $stmt_sum = $conn->prepare($query_sum);

                            $stmt_sum->execute();

                            $result_sum = $stmt_sum->fetchAll();

                            $rowCount_videos = $stmt_sum->rowCount();

                            foreach($result_sum as $value_video){

                                array_push($array,$value_video['video_duration']);
                            }
                        ?>
                        <h3 class="counter"><?php echo sum_time($array) == null ? 0 : sum_time($array);?></h3>
                        <p> Minutes of video</p>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 wow fadeInUp" data-wow-delay=".2s">
                        <i class="fa fa-briefcase"></i>
                        <?php 

                            $query_courses = 'select * from courses order by course_id';

                            $stmt_courses = $conn->prepare($query_courses);

                            $stmt_courses->execute();

                            $rowCount_courses = $stmt_courses->rowCount();

                        ?>
                        <h3 class="counter"><?php echo isset($rowCount_courses) == null ? 0: $rowCount_courses;?></h3>
                        <p>Coursers</p>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 wow fadeInRight">
                        <i class="fa fa-graduation-cap"></i>
                        <h3 class="counter"><?php echo isset($rowCount_videos) == null ? 0 : $rowCount_videos;?></h3>
                        <p>Videos</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
<!--=========== Achieve Site End=============-->

<?php
include 'Assets/connect/footer.php';
?>
    <!-- Wow -->
    <script src="Assets/Js/wow.min.js"></script>
    <!-- Owl Carousel -->
    <script src="Assets/Js/owl.carousel.min.js"></script>
<script type="text/javascript">
    nicescroll();
    dropdown();
    home_slider();
    $('input[name="button_scribe"]').hover(function(){
        $(this).siblings('.tooltip_course').css({
            'visibility':'visible',
            'opacity':'1',
        });
    }).mouseout(function(){
        $(this).siblings('.tooltip_course').css({
            'visibility':'hidden',
            'opacity':'0',
        })
    });
    if ($(window).width() > 767) {
        var wow = new WOW({
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 0,
            mobile: false,
            live: true
        });
        new WOW().init();
    }
</script>

    </body>
</html>