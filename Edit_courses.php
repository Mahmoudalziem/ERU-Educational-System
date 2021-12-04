<?php

    session_start();
    
    include'Assets/connect/connected.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--Meta tags-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- First Mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Description -->
    <meta name="description" content="Engineering Site">
    <!-- Application-Name -->
    <meta name="application-name" content="Engineering Site">
    <!-- Author Name -->
    <meta name="author" content="Azima">
    <link rel="icon" href="Assets/images/logo/favicon.ico">
    <!--BootStrap -->
    <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
    <!-- animate -->
    <link rel="stylesheet" href="Assets/css/animate.css">
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

<?php echo include 'Assets/connect/headerPortfolio.php';?>

<div class="edit_courses">
    <div class="container">
    <div class="row">
            <?php

        $query = 'select * from courses order by course_id';

        $stmt = $conn->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll();

        $rowCount = $stmt->rowCount();

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
        

        if ($rowCount > 0) {
            foreach ($result as $course) {
                $array = [];
                
                $query_sum = 'select * from videos_files where course_id = "'.$course['course_id'].'" and video_file_type = "video" ';

                $stmt_sum  = $conn->prepare($query_sum);

                $stmt_sum->execute();

                $result_sum = $stmt_sum->fetchAll();
                    
                foreach ($result_sum as $value_video) {
                    array_push($array, $value_video['video_duration']);
                };
                    
                echo '
                       <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="courses-wrapper text-center mb-30">
                                <div class="courses-img">
                                    <img src="courses_content/course_images/'.$course['course_title'].'/'.$course['course_image'].'" alt="course_image">
                                    <div class="course_modify">
                                        <a href="admin_Dashboard.php?id='.convert_id('encrypt', $course['course_id']).'">Edit Course</a>
                                        <a href="javascript:void(0)" class="delete_course" data-toggle="modal" data-target="#Delete_course" role="button" type="button" data-course_id="'.$course['course_id'].'">Delete Course</a>
                                    </div>
                                </div>
                                <div class="courses-text">
                                    <h4><a href="javascript:void(0)">'.$course['course_title'].'</a></h4>
                                    <div class="feedback">
                                        <span class="star d-inline-block">
                                        <span class="yes"><i class="fa fa-star"></i></span>
                                        <span class="yes"><i class="fa fa-star"></i></span>
                                        <span class="yes"><i class="fa fa-star"></i></span>
                                        <span class="yes"><i class="fa fa-star"></i></span>
                                        <span class="yes"><i class="fa fa-star-half-o"></i></span>
                                        </span>
                                        <span>'.rating($conn, $course['course_id']).'</span>
                                    </div>

                                    <div class="course-meta">
                                        <span><i class="fa fa-bookmark"></i>'.query_sum_lessons($conn, $course['course_id']).' Lesson</span>
                                        <span><i class="fa fa-clock-o"></i>'.sum_time($array).'</span>
                                        <span><i class="fa fa-users"></i>'.total_visitors($conn, $course['course_id']).'</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    ';
            }
        } else {
            echo '<div>No Courses Yet Added</div>';
        }

        ?>
        </div>


        <div class="modal fade" id="Delete_course" tabindex="-1" role="dialog" aria-labelledby="Delete_course">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div id="delete_course">
                            <div>Do You Want To Delete Course ?</div>
                            <button class="button_delete_course">Yes</button>
                        </div>
                    </div><!-- end Body -->
                </div><!-- End content -->
            </div>
        </div>

</div>
</div>

<!-- ========== Footer Section ============-->
<div class="footer-section">
        <span>All right Reserved <?php echo date('Y')?> @ Ask The Proff </span>
        <span>Desgined With Love By @ <a href="https://www.facebook.com/Alziem2" target="_blank" title="Developper Page 
        Facebook">Eng/AZIMA</a></span>
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
<!-- Bootstrap -->
<script src="Assets/Js/bootstrap.min.js"></script>
<!-- NiceScroll -->
<script src="Assets/Js/jquery.nicescroll.js"></script>
<!-- Contact Send -->
<script src="Assets/Js/contact_send.js"></script>
<!-- MatchHeight -->
<script src="Assets/Js/jquery.matchHeight-min.js"></script>
<!-- Plugins -->
<script src="Assets/Js/plugin.js"></script>
<!-- corp image -->
<script type="text/javascript">
    nicescroll();
    matchHeight();
</script>
</body>

</html>     