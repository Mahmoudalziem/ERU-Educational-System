<?php

    session_start();
    
    require 'Assets/connect/connected.php';

    $decrypt_id = convert_id('decrypt',$_GET['id']);

    $query = 'select * from courses where course_id = ? order by course_id';

    $stmt = $conn->prepare($query);

    $execute = array($decrypt_id);

    $stmt->execute($execute);

    $result = $stmt->fetchAll();

    foreach ($result as $value){};
    
    $GLOBALS['course_title'] = $value['course_title'];
    
    $rowCount = $stmt->rowCount();

    if(!isset($_GET['id'])){

        header('Location: Courses.php');
    }
    else{

        if($rowCount == 0){

            header('Location: Courses.php');
        }
        else{

            $visitor_ip = $_SERVER['REMOTE_ADDR'];

            $query_visitors = 'insert into visitors_number values(?,?,?,?)';

            $stmt_visitor = $conn->prepare($query_visitors);

            $execute_visitor = array(null,$visitor_ip,date('his'),$decrypt_id);

            $stmt_visitor->execute($execute_visitor);
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
    <!-- Author Name -->
    <meta name="author" content="Azima">
    <!-- Description -->
    <meta name="description" content="<?php echo $value['description']?>">
    <!-- title-->
    <title><?php echo $value['course_title']?></title>
    <!-- Favicon -->
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
    <!-- Js Social-->
    <link rel="stylesheet" href="Assets/css/jssocials-theme-flat.css">
    <link rel="stylesheet" href="Assets/css/jssocials-theme-plain.css">
    <!-- Fancy Box-->
    <link rel="stylesheet" href="Assets/css/jquery.fancybox.min.css">
</head>
    <body onload="fetch_rating()">
<!--============= Header =================-->
    <?php echo include 'Assets/connect/headerPortfolio.php' ?>
<!--============= Header End =============-->

<!--============= Header banner ==================-->
    <div class="courses-show single-course">

        <div class="show-content ">
            <div class="container">
                <h3>
                    Course Details
                </h3>
                <ul class="content-nav">
                    <li>
                        <a href="index.php" target="_self">
                            <i class="fa fa-home"></i> Home
                        </a>
                    </li>
                    <li>
                        <div>
                            <i class="fa fa-long-arrow-right"></i> Course Details
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<!--============= Header banner End ===============-->

    <!-- Header FloatBox-->
    <div class="header-floatbox">
        <div class="container">
            <div class="col-12">
                <div class="course-portfolio">
                    <div class="container">
                        <div class="row">


                            <div class="review col-md-4">       
                                <p>Course Name</p>
                                <div class="box-result">
                                    <h5 stype="padding:0 25px;line-height:20px;margin-top:20px;"><?php echo $value['course_title']?></h5>
                                </div>
                            </div>

                            

                            <?php
                                if(isset($_SESSION['username'])){
                                    echo '<div class="review col-md-4">
                                                <p>Your Review</p>
                                                <div class="box-result">
                                                    <div class="result-container">
                                                        <div class="rate-bg"></div>
                                                        <div class="rate-stars"></div>
                                                    </div>
                
                                                    <h5>Rated
                                                        <span class="rating_user d-inline-block"></span>
                                                        out of 10
                                                    </h5>
                                                </div>
                                            </div>
                                            ';
                                }
                                else{
                                    echo '<div class="review col-md-4">
                                                <p>Your Review</p>
                                                <div class="box-result">
                                                    <div class="result-container">
                                                        <div class="rate-bg"></div>
                                                        <div class="rate-stars"></div>
                                                    </div>
                
                                                    <h5>Rated 0 out of 10
                                                    </h5>
                                                </div>
                                            </div>
                                            ';
                                }

                            ?>


                            <div class="review col-md-4">
                                <p>Last Modified</p>
                                <div class="box-result">
                                
                                    <h5 stype="margin-top:20px"><?php echo $value['last_update'] == 0 ? $value['date_course']: $value['last_update'];?></h5>
                                </div>
                            </div>

                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header FootBox-->

<!--============ Course details Section ==============-->
    <section class="section-details">
        <div class="container">
            <div class="course-info ">
                <div class="row">

                    <div class="col-lg-2 col-sm-4 col-6">
                        <div class="course-infobox">
                            <div class="course-info-icon">
                                <i class="fa fa-file-video-o"></i>
                            </div>
                            <?php

                                $query_sum = 'select * from videos_files where course_id = "'.$decrypt_id.'" and video_file_type = "video" ';

                                $stmt_sum  = $conn->prepare($query_sum);

                                $stmt_sum->execute();

                                $result_sum = $stmt_sum->fetchAll();

                                function sum_time($times){
                                    $mins = 0;
                                    foreach($times as $time){
                                        list($hour, $min) = explode(':',$time);
                                        $mins += $hour * 60;
                                        $mins += $min;
                                    }

                                    $hours = floor($mins /60);
                                    $mins -= $hours * 60;

                                    return sprintf('%02dm:%02ds',$hours,$mins);
                                }            
                            ?>
                            <p class="course-info-name">Duration</p>
                            <h4 class="course-info-value">
                                <?php

                                    $array = [];

                                    foreach($result_sum as $value_video){

                                        array_push($array,$value_video['video_duration']);
                                    }
                                    echo sum_time($array);
                                ?>
                            </h4>
                        </div>
                    </div>

                    <div class="col-lg-2 col-sm-4 col-6">
                        <div class="course-infobox">
                            <div class="course-info-icon">
                                <i class="fa fa-file-word-o"></i>
                            </div>
                            <p class="course-info-name">Lessons</p>
                            <?php
                                function query_lesson_file($conn,$id,$x){

                                    $query_course = 'select * from videos_files where course_id = ? and video_file_type = ?';

                                    $stmt_course = $conn->prepare($query_course);

                                    $execute_course = array($id,$x);

                                    $stmt_course->execute($execute_course);

                                    $rowCount_course = $stmt_course->rowCount();

                                    return $rowCount_course;
                                }
                            ?>
                            <h4 class="course-info-value">
                                <?php echo query_lesson_file($conn,$decrypt_id,'video') ?>
                                videos
                            </h4>
                        </div>
                    </div>

                    <div class="col-lg-2 col-sm-4 col-6">
                        <div class="course-infobox">
                            <div class="course-info-icon">
                                <i class="fa fa-book"></i>
                            </div>
                            <p class="course-info-name">Resources</p>
                            <h4 class="course-info-value">
                                <?php echo query_lesson_file($conn,$decrypt_id,'file') ?>
                                Files
                            </h4>
                        </div>
                    </div>

                    <div class="col-lg-2 col-sm-4 col-6">
                        <div class="course-infobox">
                            <div class="course-info-icon">
                                <i class="fa fa-calendar-times-o"></i>
                            </div>
                            <p class="course-info-name">Date</p>
                            <h4 class="course-info-value" ><?php echo @$value['date_course'];?></h4>
                        </div>
                    </div>

                    <div class="col-lg-2 col-sm-4 col-6">
                        <div class="course-infobox">
                            <div class="course-info-icon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <p class="course-info-name">Access</p>
                            <h4 class="course-info-value">Lifetime</h4>
                        </div>
                    </div>

                    <div class="col-lg-2 col-sm-4 col-6">
                        <div class="course-infobox">
                            <div class="course-info-icon">
                                <i class="fa fa-language"></i>
                            </div>
                            <p class="course-info-name">Language</p>
                            <h4 class="course-info-value"><?php echo @$value['language'];?></h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
<!--============ Course details End  ==============-->

<!--============ Course Body Details ==============-->
    <div class="course-body">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12 order-md-1 order-2">
                    <div class="course-body-content">

                        <div class="course-body-section">
                            <h3>What I will Learn!</h3>
                            <ul>
                                <?php

                                $array_learn = explode(',',$value['learn_tabs']);

                                $count_array_learn = count($array_learn);

                                if($count_array_learn > 1){

                                    for($x=0; $x<$count_array_learn; $x++){

                                        echo '<li>'.$array_learn[$x].'</li>';
                                    }
                                }
                                else{

                                    echo '<li>Nothing Course Will Learn You</li>';
                                }

                                ?>
                            </ul>
                        </div>

                        <div class="course-body-section">
                            <h3>Requirements</h3>
                            <ul>
                                <?php
                                $array_require = explode(',',$value['require_tabs']);

                                $count_array_require = count($array_require);

                                if($count_array_require > 1){
                                    for($x=0; $x<$count_array_require; $x++){
                                        echo '<li>'.$array_require[$x].'</li>';
                                    }
                                }
                                else{
                                    echo '<li>No Requirement For This Course</li>';
                                }

                                ?>
                            </ul>
                        </div>


                        <div class="course-body-section">
                            <h3>Description</h3>
                            <div class="post-entry">

                                <?php
                                    $description = $value['description'];

                                    if(strlen($description) > 0 ){

                                        echo '<p>' . $description . '</p>';
                                    }
                                ?>
                            </div>
                        </div>




                    </div>
                    <!-- End Course Body -->
                    <div class="course-body-content">
                        <div class="tab-body-content">
                            <h3>Course Play</h3>
                            <div class="panel-group category-list sidebar-box" id="tab-panel">

                                <?php
                                    $query1 = 'select * from sections where course_id = ? order by section_id';

                                    $stmt1 = $conn->prepare($query1);

                                    $execute1 = array($decrypt_id);

                                    $stmt1->execute($execute1);

                                    $result1 = $stmt1->fetch();

                                    $rowCount1 = $stmt1->rowCount();

                                function fetch_video_file($conn,$id,$section_name){

                                    $query2 = 'select * from videos_files where course_id = ? and section_name = ? order by video_file_id';

                                    $stmt2 = $conn->prepare($query2);

                                    $execute2 = array($id,$section_name);

                                    $stmt2->execute($execute2);

                                    $result2 = $stmt2->fetchAll();

                                    $output = '';

                                    foreach ($result2 as $value2){

                                        if($value2['video_file_type'] == 'file'){

                                            $output .= ' <li class="lesson_list_content" data-type="file">
            
                                                                    <span class="video_file_title">
                                                                        <i class="fa fa-book"></i>
                                                                        '.$value2['video_file_name'].'
                                                                    </span>
                                                                    <span class="preview-details">
                                                                        <a href="https://docs.google.com/gview?url=http://'.$_SERVER['SERVER_NAME'].'/courses_content/courses_files/'.$GLOBALS['course_title']."/".pathinfo($value2['video_file_content'],PATHINFO_BASENAME).'&embedded=true" target="_blank">
                                                                            <span class="preview">
                                                                                <i class="fa fa-eye"></i>
                                                                                show
                                                                            </span>
                                                                        </a>
                        
                        
                                                                        <span class="download">
                                                                            <a href="Assets/connect/download.php?id='.convert_id('encrypt',$value2['video_file_id']).'" data-id="'.convert_id('encrypt',$value2['video_file_id']).'">
                                                                                <i class="fa fa-download"></i>
                                                                                Download
                                                                            </a>
                                                                        </span>
                        
                                                                    </span>
                                                                </li>
                                                                ';
                                        }

                                        elseif ($value2['video_file_type'] == 'video'){

                                            

                                            if(!function_exists('cal_time')){

                                        
                                                function cal_time($x){

                                                    $video_duration = explode(':',$x);

                                                    for($x=0;$x<count($video_duration); $x++){
    
                                                        $vido_dur = '';

                                                        if($x == 0){

                                                            @$video_dur .= $video_duration[$x] . 'm : ';
                                                        }
                                                        elseif($x == 1){

                                                            $video_dur .= $video_duration[$x] . 's';
                                                        }
                                                        else{

                                                            $video_dur = $$video_dur . ' : ';
                                                            
                                                            $video_dur .= $video_duration[$x] . 'h';
                                                        }

                                                    }

                                                    return $video_dur;
                                                }
                                            }
                                            

                                            $output .= '
                                                    <li class="lesson_list_content" data-type="video">
                                                        <span class="video_file_title">
                                                            <i class="fa fa-play-circle"></i>
                                                            '.$value2['video_file_name'].'
                                                        </span>
            
                                                        <span class="preview-details">
            
                                                            <a href="'.$value2['video_file_content'].'" data-fancybox id="player">
                                                                <span class="preview">
                                                                    <i class="fa fa-eye"></i>
                                                                    show
                                                                </span>
                                                            </a>
            
                                                            <span class="time_video">
                                                                '.cal_time($value2['video_duration']).'
                                                            </span>
            
                                                        </span>
                                                    </li>
            
                                                    ';
                                        }
                                    }

                                    return $output;
                                }




                                for($x=1; $x<=$rowCount1;$x++){

                                    if($x == 1){

                                        echo '<div class="panel">
                                                        <a data-collapse="collapse" href="#dropdown_show_videos_'.$result1['section_id'].'" data-toggle="collapse" data-target="#dropdown_show_videos_'.$result1['section_id'].'" aria-expanded="false" class="collapsed">
                                                            <span class="panel_header">
                                                                '.$result1['section_name'].'
                                                            </span>
                                                            <span>
                                                                <i class="fa fa-arrow-circle-down"></i>
                                                            </span>
                                                        </a>
                        
                                                        <div class="panel-body collapse show" id="dropdown_show_videos_'.$result1['section_id'].'" data-parent="#tab-panel">
                        
                                                            <ul class="lesson-list">
                                                                '.fetch_video_file($conn,$decrypt_id,$result1['section_name']).'
                                                            </ul><!-- End Lesson List -->
                                                        </div><!-- End Panel Body -->
                                                    </div><!-- End Panel -->
                                                    ';
                                    }
                                    else{
                                        $result1 = $stmt1->fetchAll();

                                        foreach($result1 as $value1){
                                                echo '<div class="panel">
                                                        <a data-collapse="collapse" href="#dropdown_show_videos_'.$value1['section_id'].'" data-toggle="collapse" data-target="#dropdown_show_videos_'.$value1['section_id'].'" aria-expanded="false" class="collapsed">
                                                            <span class="panel_header">
                                                                '.$value1['section_name'].'
                                                            </span>
                                                            <span>
                                                                <i class="fa fa-arrow-circle-down"></i>
                                                            </span>
                                                        </a>
                        
                                                        <div class="panel-body collapse" id="dropdown_show_videos_'.$value1['section_id'].'" data-parent="#tab-panel">
                        
                                                            <ul class="lesson-list">
                                                                '.fetch_video_file($conn,$decrypt_id,$value1['section_name']).'
                                                            </ul><!-- End Lesson List -->
                                                        </div><!-- End Panel Body -->
                                                    </div><!-- End Panel -->
                                                    ';   
                                        }
                                    }

                                    }
                                    
                                ?>

                            </div>
                        </div>
                    </div>


                    <div class="review_content">
                        <h3>Review-Course</h3>

                        <?php
                            function rating($rate,$conn){

                                $query = 'select * from courses_rating where course_id = ? and rating = ?';

                                $stmt = $conn->prepare($query);

                                $execute = array(convert_id('decrypt',$_GET['id']),$rate);

                                $stmt->execute($execute);

                                $rowCount = $stmt->rowCount();

                                echo $rowCount;
                            }

                        ?>

                        <div class="row no-gutters">
                            <div class="col-md-5 col-12 order-md-1 order-2 column_review">

                                <div class="review mt-md-4">
                                    <h5 class="number_rating"></h5>
                                </div>

                                <div class="review mt-md-5">
                                    <p>Review</p>
                                    <div class="rate" data-course="<?php echo convert_id('decrypt',$_GET['id']);?>">
                                        <div id="1" class="btn-1 rate-btn"></div>
                                        <div id="2" class="btn-2 rate-btn"></div>
                                        <div id="3" class="btn-3 rate-btn"></div>
                                        <div id="4" class="btn-4 rate-btn"></div>
                                        <div id="5" class="btn-5 rate-btn"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7 col-12 order-md-2 order-1 column_review">

                                <div class="review_number_count">
                                    <span class="count_review" id="review_5">(<?php echo rating(5,$conn)?>) Reviews</span>
                                    <div class="result_review_count d-inline-block">
                                        <div class="rate-bg1" style="width: 100%;"></div>
                                        <div class="rate-stars1"></div>
                                    </div>
                                    <div class="percent d-inline-block">100%</div>
                                </div>

                                <div class="review_number_count">
                                    <span class="count_review" id="review_4">(<?php echo rating(4,$conn)?>) Reviews</span>
                                    <div class="result_review_count d-inline-block">
                                        <div class="rate-bg1" style="width: 80%;"></div>
                                        <div class="rate-stars1"></div>
                                    </div>
                                    <div class="percent d-inline-block">80%</div>
                                </div>

                                <div class="review_number_count">
                                    <span class="count_review" id="review_3">(<?php echo rating(3,$conn)?>) Reviews</span>
                                    <div class="result_review_count d-inline-block">
                                        <div class="rate-bg1" style="width: 60%;"></div>
                                        <div class="rate-stars1"></div>
                                    </div>
                                    <div class="percent d-inline-block">60%</div>
                                </div>

                                <div class="review_number_count">
                                    <span class="count_review" id="review_2">(<?php echo rating(2,$conn)?>) Reviews</span>
                                    <div class="result_review_count d-inline-block">
                                        <div class="rate-bg1" style="width: 40%;"></div>
                                        <div class="rate-stars1"></div>
                                    </div>
                                    <div class="percent d-inline-block">40%</div>
                                </div>

                                <div class="review_number_count">
                                    <span class="count_review" id="review_1">(<?php echo rating(1,$conn)?>) Reviews</span>
                                    <div class="result_review_count d-inline-block">
                                        <div class="rate-bg1" style="width: 20%;"></div>
                                        <div class="rate-stars1"></div>
                                    </div>
                                    <div class="percent d-inline-block">20%</div>
                                </div>

                            </div>
                        </div>

                        <div class="review_alert">Please SignUp Or LogIn To Leave Comment And Review</div>
                    </div>

                    <?php
                        if(isset($_SESSION['username'])){
                            echo    '<div class="facebook_content">
                                     <!-- Facebook SDK -->
                                        <div id="fb-root"></div>
                                        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3&appId=305851363183262&autoLogAppEvents=1"></script>
                                        <div class="fb-comments" data-href="http://localhost/engineer/single-course.phphttp://localhost/engineer/single-course.php" data-width="auto" data-numposts="5"></div>
                                     </div>
                                     ';
                        }
                    ?>


                    <?php

                        $query_related = 'select * from courses order by RAND() limit 2 ';

                        $stmt_related = $conn->prepare($query_related);

                        $stmt_related->execute();

                        $result_related = $stmt_related->fetchAll();

                        $rowCount_related = $stmt_related->rowCount();

                        if($rowCount_related > 1){
            
                            $array_related = [];

                        function sum_time_related($times){
                            $mins = 0;
                            foreach($times as $time){
                                list($hour, $min) = explode(':',$time);
                                $mins += $hour * 60;
                                $mins += $min;
                            }
        
                            $hours = floor($mins /60);
                            $mins -= $hours * 60;
        
                            return sprintf('%02dm:%02ds',$hours,$mins);
                        };


                        function query_sum_lessons_related($conn,$id){
    
                            $query_course = 'select * from videos_files where course_id = ? and video_file_type = "video" ';
        
                            $stmt_course = $conn->prepare($query_course);
        
                            $execute_course = array($id);
        
                            $stmt_course->execute($execute_course);
        
                            $rowCount_course = $stmt_course->rowCount();
        
                            return $rowCount_course;
                        }
            
                        function rating_related($conn,$id){
    
                            $query = 'select * from courses_rating where course_id = ?';
        
                            $stmt = $conn->prepare($query);
        
                            $execute = array($id);
        
                            $stmt->execute($execute);
        
                            $rowCount = $stmt->rowCount();
        
                            if($rowCount == 0){
        
                                return '0' . ' Review(s)';
                            }
                            else{
        
                                return $rowCount . ' Review(s)';
                            }
                        }
                            

                        function total_visitors_related($conn,$x){
    
                            $query_check = 'select * from visitors_number where course_id = "'.$x.'"'; 
        
                            $stmt_check = $conn->prepare($query_check);
        
                            $stmt_check->execute();
        
                            $rowCount_check = $stmt_check->rowCount();
        
                            $rowCount_fetch = '';
        
                            if($rowCount_check > 0){
        
                                $rowCount_fetch .= $rowCount_check;
                            }
                            else{
        
                                $rowCount_fetch .= 1;
                            }
        
                            return $rowCount_fetch;
                        }
                        
                            echo '<div class="course-body-content">
                                    <div class="tab-body-content">
                                        <h3>Related-Courses</h3>    
                                     <div class="row justify-content-center">
                                        ';
                            foreach ($result_related as $value_related){

                                $query_sum = 'select * from videos_files where course_id = "'.$value_related['course_id'].'" and video_file_type = "video" ';

                                $stmt_sum  = $conn->prepare($query_sum);

                                $stmt_sum->execute();

                                $result_sum = $stmt_sum->fetch();

                                array_push($array_related,$result_sum['video_duration']);

                                echo '<div class="col-lg-5 col-12">
                            <div class="courses-wrapper text-center mb-30">
                                <div class="courses-img">
                                    <img src="courses_content/course_images/'.$value_related['course_title'].'/'.$value_related['course_image'].'" alt="">
                                </div>
                                <div class="courses-text">
                                    <h4 style="min-height: 66px;"><a href="single-course.php?id='.convert_id('encrypt',$value_related['course_id']).'">'.$value_related['course_title'].'</a></h4>

                                    <div class="feedback">
                                        <span class="star d-inline-block">
                                            <span class="yes"><i class="fa fa-star"></i></span>
                                            <span class="yes"><i class="fa fa-star"></i></span>
                                            <span class="yes"><i class="fa fa-star"></i></span>
                                            <span class="yes"><i class="fa fa-star"></i></span>
                                            <span class="yes"><i class="fa fa-star-half-o"></i></span>
                                        </span>
                                        <span>'.rating_related($conn,$value_related['course_id']).'</span>
                                    </div>

                                    <div class="course-meta">
                                        <span><i class="fa fa-bookmark"></i>'.query_sum_lessons_related($conn,$value_related['course_id']).' Lesson</span>
                                        <span><i class="fa fa-clock-o"></i>'.sum_time_related($array).'</span>
                                        <span><i class="fa fa-users"></i>'.total_visitors_related($conn,$value_related['course_id']).'</span>
                                    </div>

                                </div>
                            </div>
                        </div>';
                            }

                            echo '</div>
                                   <!-- End Row -->
                                        </div>
                                    </div>';
                        }

                        ?>

                </div>
                <!-- End Column -->

                <div class="col-lg-4 col-12 order-md-2 order-1">



                    <div class="widget-details">
                        <h3 class="widget-title">
                            Course Info
                        </h3>
                        <div class="widget-body">
                            <div class="widget-meta">
                                <table>
                                    <tbody>

                                    <tr>
                                        <td>
                                            Course Start Date
                                        </td>
                                        <td>
                                            <?php echo $value['date_course']?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            Course End Date
                                        </td>

                                        <td>
                                            <?php
                                              if($value['last_update'] == 0){

                                                echo $value['date_course'];
                                              }
                                              else{
                                                echo $value['last_update'];
                                              }
                                             ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            For Who
                                        </td>
                                        <?php
                                            function fetch_title($conn,$x,$y){

                                                $query_title = 'select depart_id from courses where course_id = ? and depart_id = ?';
                
                                                $stmt_title = $conn->prepare($query_title);
                
                                                $execute_array = array($x,$y);

                                                $stmt_title->execute($execute_array);

                                                $result_title = $stmt_title->fetch();
                
                                                switch($result_title['depart_id']){
                
                                                    case '1' : return 'Preporatory Engineer';break;
                                                    case '2' : return 'Network Engineer';break;
                                                    case '3' : return 'Mechatronics Engineer';break;
                                                    case '4' : return 'Construction Engineer';break; 
                                                }
                                            }
                                        ?>
                                        <td>
                                            <?php echo fetch_title($conn,$decrypt_id,$value['depart_id'])?>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            Level
                                        </td>

                                        <td>
                                            standard
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <!-- Widget-meta -->

                            <?php
                            if(isset($_SESSION['username'])){
                                echo '<div class="enroll" data-id="'.convert_id('encrypt',$value['course_id']).'">
                                        <a href="javascript:void(0)">Saved This Course </a>
                                        <span class="tooltip_course" id="tooltip_course">
                                            Add In Watchlist
                                        </span>
                                    </div>';
                            }
                            ?>


                        </div>
                    </div>

                    <div class="share-course">
                            <h3 class="share-title">
                                Social Share
                            </h3>
                        <div class="read_url_course">

                            <div class="shortcut_link">

                                <?php

                                $url_share = 'http://' . $_SERVER['SERVER_NAME'] . '/single-course.php?id=' . $_GET['id'];
                                ?>

                                <input type="text" readonly value="<?php echo $url_share?>">

                                <span class="selectAll" onclick="selectAll()" onmouseout="blurSelect()">
                                    <i class="fa fa-copy"></i>
                                    <span class="tooltiptext" id="mytooltip">Copy To Clipboard</span>    
                                </span>

                            </div>
                            
                        </div>

                        <div id="shareIcons"></div>

                        </div>

                    <div class="tages_course d-none d-md-block">
                        <h3 class="tage-title">
                            Custom Tages
                        </h3>
                        <ul class="tag">
                            <?php
                                $array_tages = explode(',',$value['course_tages']);

                                $count_array_tages = count($array_tages);

                                for ($x = 0; $x<$count_array_tages; $x++){

                                    echo '<li>'.'<a href="javascript:void(0)">'.@$array_tages[$x].'</a>' .'</li>';
                                };
                            ?>
                        </ul>
                    </div>

                </div>
                <!-- End Column -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Container-->
    </div>
<!--============ Course Body End ==============-->


<?php
    include 'Assets/connect/footer.php';
?>
    <!-- JsSocial -->
    <script src="Assets/Js/jssocials.min.js"></script>
    <!-- FancyBox -->
    <script src="Assets/Js/jquery.fancybox.min.js"></script>
    <!-- MatchHeight -->
    <script src="Assets/Js/jquery.matchHeight-min.js"></script>
<!--============= Scripts Function Page ===========-->

    <script type="text/javascript">
        nicescroll();
        fancybox();
        $('#shareIcons').jsSocials({
            url:'<?php echo $url_share?>',
            text:'Share Course',
            showLabel:false ,
            showCount:false,
            shareIn:'popup',
            shares:["facebook","linkedin","twitter","whatsapp"],
        });
        function selectAll(){

            var myInput = $('div.shortcut_link').children('input'),

                toolTip = $('div.shortcut_link span').children('#mytooltip');

            myInput.select();
        
            document.execCommand('copy');

            $(toolTip).text('Copied');
        }

        function blurSelect(){

            let toolTip = $('div.shortcut_link span').children('#mytooltip');

            $(toolTip).text('Copy To Clipboard');
        }

        $('div.enroll a').hover(function(){
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
    </script>

<!--============= Scripts Function Page End ========-->

    </body>
</html>     