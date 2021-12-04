<?php

    session_start();

    ob_start();

    include 'Assets/connect/connected.php';

    strtolower($_SESSION['username']);

    $query = 'select * from users where username = "'.$_SESSION['username'].'" and status = ("user" or "moderator") and actived = 1';

    $stmt = $conn->prepare($query);

    $stmt->execute();

    $result = $stmt->fetch();

    $GLOBALS['username'] = strtolower($result['username']);

    if (isset($_SESSION['username'])) {
        if ($_SESSION['username'] == $GLOBALS['username']) {
            if (!$_GET['UN'] == $GLOBALS['username']) {
                header('Location: 404.php');

                ob_end_flush();
            }
        } else {
            header('Location: admin_Dashboard.php');

            ob_end_flush();
        }
    } else {
        header('Location: signIn.php');

        ob_end_flush();
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
    <!-- Favicon -->
    <title>Portfolio</title>
    <!-- Application-Name -->
    <meta name="application-name" content="Engineering Site">
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
    <?php echo include 'Assets/connect/headerPortfolio.php' ?>
<!--============= Header End =============-->


<?php

$query = 'select * from profile p join users u using(username) where username = "' . $_SESSION['username'] .'" ';

$stmt = $conn->prepare($query);

$stmt->execute();

$result = $stmt->fetchAll();

foreach ($result as $value) {
    $GLOBALS['name'] = ucwords($value['name']);

    $GLOBALS['username'] = $value['username'];

    $GLOBALS['joined_date'] = $value['joined_date'];

    $GLOBALS['address']  = $value['address'];

    $GLOBALS['birth_date'] = $value['birth_date'];

    $GLOBALS['face_un'] = $value['face_un'];

    $GLOBALS['website_url'] = $value['website_url'];

    $GLOBALS['twitter_un'] = $value['twitter_un'];

    $GLOBALS['linked_un'] = $value['linked_un'];

    $GLOBALS['insta_un'] = $value['insta_un'];

    $GLOBALS['website_url'] = $value['website_url'];

    $GLOBALS['avater_image'] = $value['avater_image'];

    $GLOBALS['background_image'] = $value['background_image'];

    $GLOBALS['watchlist'] = $value['watchlist'];

    $GLOBALS['watchlist'] = explode(',', $GLOBALS['watchlist']);
};

$name = $GLOBALS['name'];

$username = $GLOBALS['username'];

$joined = $GLOBALS['joined_date'];

$address = $GLOBALS['address'];

$birth_date = $GLOBALS['birth_date'];

$website_url = $GLOBALS['website_url'];
?>

<!--============= Avater Info =================-->
    <div class="avater-info">
    <div class="portfolio-background">

        <div class="portfolio-headerBg">
            <img src="<?php echo  $GLOBALS['background_image'] != '' ? 'images_users\background\\'. $_SESSION['username']. '\\' . $GLOBALS['background_image'] : 'Assets/images/profiles/default_background/default_background.png' ?>" alt="Background-images">
        </div>

        <div class="portfolio-change-background">

            <a href="settings.php?UN=<?php echo $_SESSION['username']?>" target="_self">
            <span class="cover-icon">
                <i class="fa fa-camera"></i>
            </span>
            <span class="cover-change">
                Update Cover Page
            </span>
            </a>
        </div>


    </div>

    <div class="portfolio-content">
        <div class="container">
            <div class="col-md-3 col-12 align-items-center">
                <div class="portfolio-avater">
                    <img src="<?php echo  $GLOBALS['avater_image'] != '' ? 'images_users\avaters\\'. $_SESSION['username']. '\\' . $GLOBALS['avater_image'] : 'Assets/images/profiles/default_avater/default_avater.png' ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="portfolio-details">
        <div class="container">
            <div class="col-md-9 col-12 justify-content-right ml-auto ">
                <div class="row align-items-center mx-auto ml-auto">

                    <div class="col-lg-3 col-md-6 col-12 ">
                        <div class="portfolio-details-content">
                            <h5>Watchlist Courses</h5>
                            <span><?php echo reset($GLOBALS['watchlist']) == null ? '0': count($GLOBALS['watchlist']) ?> Courses</span>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 ">
                        <div class="portfolio-details-content">
                            <h5>Completed Courses</h5>
                            <span>0 Courses</span>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="portfolio-details-content">
                            <?php
                                $query_review = 'select ID from users where username = "'.$_SESSION['username'].'"  ';

                                $stmt_review = $conn->prepare($query_review);

                                $stmt_review->execute();

                                $result_review = $stmt_review->fetchAll();

                                foreach ($result_review as $value_review) {
                                    $GLOBALS['review_id'] = $value_review['ID'];
                                }

                                $query_review1 = 'select * from courses_rating where user_id = "'.$GLOBALS['review_id'].'" ';

                                $stmt_review1 = $conn->prepare($query_review1);

                                $stmt_review1->execute();

                                $rowCount_review = $stmt_review1->rowCount();

                            ?>
                            <h5>Given Review</h5>
                            <span><?php echo ($rowCount_review  > 0) ? $rowCount_review .' review' : '0 review'?></span>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="portfolio-details-content">
                        <?php

                            function fetch_title($conn, $x)
                            {
                                $query_title = 'select depart_id from profile where username = "'.$x.'"';

                                $stmt_title = $conn->prepare($query_title);

                                $stmt_title->execute();

                                $result_title = $stmt_title->fetch();

                                if ($result_title['depart_id'] == null) {
                                    return '{N-P-M-C} Engineer';
                                } else {
                                    switch ($result_title['depart_id']) {

                                        case '1': return 'Preporatory Engineer';break;
                                        case '2': return 'Network Engineer';break;
                                        case '3': return 'Mechatronics Engineer';break;
                                        case '4': return 'Construction Engineer';break;
                                    }
                                }
                            }
                            
                        ?>
                            <h5>Your Title</h5>
                            <span><?php echo fetch_title($conn, $username)?></span>
                        </div>
                    </div>


                </div><!-- End Row -->
            </div>
        </div><!-- End container -->
    </div><!-- End portfolio-details -->

</div>
<!--============= Avater Info End =================-->

<!--============= Avater Info Content =================-->
<div class="avater-info-content">
    <div class="container">
        <div class="row">

            <div class="col-xl-3 col-md-5 col-12">
                <ul class="avater-info-content-left">

                    <h5 class="name"><?php echo $name ?></h5>

                    <div class="username enabled-color">@<?php echo $username; ?></div>
                    <ul>
                        <li class="place_user <?php echo $address == '' ? 'disabled-color':'enabled-color'; ?>">
                            <i class="fa fa-map-marker"></i>
                            <span><?php echo $address == '' ? 'El Sharkia, Egypt' : $address; ?></span>
                        </li>
                        <li class="site_user <?php echo $website_url == '' ? 'disabled-color':'enabled-color'; ?>">
                           <i class="fa fa-location-arrow"></i>
                            <span>
                                <a href="<?php echo $website_url == '' ? 'javascript:void(0)' :  $website_url; ?>" class="<?php echo $website_url == '' ? 'disabled-color':'enabled-color' . "\" ".'target="_self"'; ?>"><?php echo $website_url == '' ? 'azima.com' : $website_url; ?></a>   
                            </span>
                        </li>
                        <li class="enabled-color">
                            <i class="fa fa-calendar"></i>
                            <span>Joined  <?php echo $joined; ?></span>
                        </li>
                        <li class="birth_user <?php echo $birth_date == null ? 'disabled-color':'enabled-color'; ?>">
                            <i class="fa fa-soccer-ball-o"></i>
                            <span>Born  <?php echo $birth_date == null ? '1 July 1998' : $birth_date; ?></span>
                        </li>

                        <li class="social-links">
                            <ul class="social">
                                <li>
                                    <a href="<?php echo $GLOBALS['face_un'] == '' ? 'javascript:void(0)' . "\" "."target=_self" :  'https://www.facebook.com/' . $GLOBALS['face_un'] . "\" "."target='_blank'" ?>">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a href="<?php echo $GLOBALS['twitter_un'] == '' ? 'javascript:void(0)' . "\" "."target=_self":  'https://www.twitter.com/' . $GLOBALS['twitter_un']. "\" "."target='_blank'" ?>>
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                    <a href="<?php echo $GLOBALS['linked_un'] == '' ? 'javascript:void(0)' . "\" "."target=_self":  'https://www.linkedin.com/' . $GLOBALS['linked_un']. "\" "."target='_blank'" ?>>
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                    <a href="<?php echo $GLOBALS['insta_un'] == '' ? 'javascript:void(0)' . "\" "."target=_self":  'https://www.instagram.com/' . $GLOBALS['insta_un']. "\" "."target='_blank'" ?>>
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div><!-- End Column -->

                <div class="col-xl-9 col-md-7 col-12">
                <div class="student-course-tab">
                    <ul class="nav nav-tabs mt-lg-0 mt-5" role="tablist">

                        <li role="presentation" class="nav-item">
                            <a href="#completed-courses" aria-controls="completed-courses" role="tab" data-toggle="tab"  aria-selected="false">
                                Completed
                            </a>
                        </li>

                        <li role="presentation" class="nav-item">
                            <a href="#watchlist-courses" class="active show" aria-controls="watchlist-courses" role="tab" data-toggle="tab" aria-selected="true">
                                Watchlist
                            </a>
                        </li>

                    </ul>

                    <div class="clear-both"></div>

                    <div class="tab-content mt-50">

                        <div class="tab-pane fade" role="tabpanel" id="completed-courses">
                            <div class="row">
                                <?php

                                echo '<div class="no_course text-center w-100 mt-30">No Any Course You Are Completed </div>';
                                ?>
                            </div>
                            <!-- End Row -->
                        </div>


                        <div class="tab-pane fade active show" role="tabpanel" id="watchlist-courses">
                            <div class="row">
                                
                            <?php

                                    $username = $_SESSION['username'];

                                    $query_watchlist = 'select * from profile where username = "'.$username.'" ';

                                    $stmt_watchlist = $conn->prepare($query_watchlist);

                                    $stmt_watchlist->execute();

                                    $result_watchlist = $stmt_watchlist->fetch();

                                    $watchlist = $result_watchlist['watchlist'];

                                        $watchlist = explode(',', $watchlist);

                                        $reversed = array_reverse($watchlist);

                                        $array_watch = [];

                                        for ($x=0;$x<count($watchlist);$x++) {
                                            if ($x == 3) {
                                                break;
                                            } else {
                                                array_push($array_watch, $reversed[$x]);
                                            }
                                        }

                                        function sum_time($times)
                                        {
                                            $mins = 0;
                                            foreach ($times as $time) {
                                                list($hour, $min) = explode(':', $time);
                                                $mins += $hour * 60;
                                                $mins += $min;
                                            }

                                            $hours = floor($mins /60);
                                            $mins -= $hours * 60;

                                            return sprintf('%02dm:%02ds', $hours, $mins);
                                        };

                                        function total_visitors($conn, $x)
                                        {
                                            $query_check = 'select * from visitors_number where course_id = "'.$x.'"';
                                        
                                            $stmt_check = $conn->prepare($query_check);
                                        
                                            $stmt_check->execute();
                                        
                                            $rowCount_check = $stmt_check->rowCount();
                                        
                                            $rowCount_fetch = '';
                                        
                                            if ($rowCount_check > 0) {
                                                $rowCount_fetch .= $rowCount_check;
                                            } else {
                                                $rowCount_fetch .= 1;
                                            }
                                        
                                            return $rowCount_fetch;
                                        }

                                        function query_sum_lessons($conn, $id)
                                        {
                                            $query_course = 'select * from videos_files where course_id = ? and video_file_type = "video" ';

                                            $stmt_course = $conn->prepare($query_course);

                                            $execute_course = array($id);

                                            $stmt_course->execute($execute_course);

                                            $rowCount_course = $stmt_course->rowCount();

                                            return $rowCount_course;
                                        }

                                        function rating($conn, $id)
                                        {
                                            $query = 'select * from courses_rating where course_id = ?';

                                            $stmt = $conn->prepare($query);

                                            $execute = array($id);

                                            $stmt->execute($execute);

                                            $rowCount = $stmt->rowCount();

                                            if ($rowCount == 0) {
                                                return '0' . ' Review(s)';
                                            } else {
                                                return $rowCount . ' Review(s)';
                                            }
                                        }


                                    if (reset($array_watch) == 0) {
                                        echo '<div class="no_course text-center w-100 mt-30">No Course Added To WatchList </div>';
                                    } else {
                                        for ($x=0;$x<count($array_watch);$x++) {
                                            $query_select = 'select * from courses where course_id = "'.$array_watch[$x].'" ';

                                            $stmt_select = $conn->prepare($query_select);

                                            $stmt_select->execute();

                                            $result_fetch = $stmt_select->fetchAll();

                                            foreach ($result_fetch as $value) {
                                                $array = [];
                                                
                                                $query_sum = 'select * from videos_files where course_id = "'.$value['course_id'].'" and video_file_type = "video" ';

                                                $stmt_sum  = $conn->prepare($query_sum);

                                                $stmt_sum->execute();

                                                $result_sum = $stmt_sum->fetchAll();
                                                
                                                foreach ($result_sum as $value_video) {
                                                    array_push($array, $value_video['video_duration']);
                                                };

                                                echo '
                                                <div class="col-lg-6 col-xl-4 col-12 course_watchlist" data-id="'.convert_id('encrypt', $value['course_id']).'">
                                                <div class="courses-wrapper text-center mb-30">
                                                    <div class="courses-img">
                                                        <img src="courses_content/course_images/'.$value['course_title'].'/'.$value['course_image'].'" alt="course_image">
                                                    </div>
                                                    <div class="courses-text">
                                                        <h4><a href="single-course.php?id='.convert_id('encrypt', $value['course_id']) .'">'.$value['course_title'].'</a></h4>

                                                        <div class="feedback">
                                                            <span class="star d-inline-block">
                                                                <span class="yes"><i class="fa fa-star"></i></span>
                                                                <span class="yes"><i class="fa fa-star"></i></span>
                                                                <span class="yes"><i class="fa fa-star"></i></span>
                                                                <span class="yes"><i class="fa fa-star"></i></span>
                                                                <span class="yes"><i class="fa fa-star-half-o"></i></span>
                                                            </span>
                                                            <span>'.rating($conn, $value['course_id']).'</span>
                                                        </div>

                                                        <div class="course-meta">
                                                            <span><i class="fa fa-bookmark"></i>'.query_sum_lessons($conn, $value['course_id']).' Lesson</span>
                                                            <span><i class="fa fa-clock-o"></i>'.sum_time($array).'</span>
                                                            <span><i class="fa fa-users"></i>'.total_visitors($conn, $value['course_id']).'</span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        ';
                                            }
                                        }
                                    }
                                ?>
                            </div><!-- End Row -->
                            </div><!-- End Column -->
                            <div class="validate error"></div>
                                    <?php
                                        if (count($array_watch) == 3) {
                                            echo '<div class="show_more">
                                                    <button type="button" class="show_more_button">Show More</button>
                                                </div>';
                                        }
                                    ?>
                            

                        </div>
                    </div>
                    
                </div>
            </div>

           <!-- End Column -->

        </div><!-- End Row -->
    </div><!-- End Container -->
</div>
<!--============= Avater Info Content End =============-->


<?php
    include 'Assets/connect/footer.php';
?>

<script type="text/javascript">
    nicescroll();
    dropdown();
</script>
</body>

</html>