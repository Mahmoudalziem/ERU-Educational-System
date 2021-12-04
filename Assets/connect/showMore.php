<?php

session_start();

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
    };

    function total_visitors($conn,$x){

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
    function query_sum_lessons($conn,$id){

        $query_course = 'select * from videos_files where course_id = ? and video_file_type = "video" ';

        $stmt_course = $conn->prepare($query_course);

        $execute_course = array($id);

        $stmt_course->execute($execute_course);

        $rowCount_course = $stmt_course->rowCount();

        return $rowCount_course;
    }

    function rating($conn,$id){

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
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(isset($_POST['action'])){

            if($_POST['action'] == 'ShowMoreButton'){

                $output = '';

                require 'connected.php';

                $last_id = $_POST['id'];

                $last_id = convert_id('decrypt',$last_id);

                $username = $_SESSION['username'];

                $query_check_more = 'select * from profile where username = "'.$username.'" ';

                $stmt_check_more = $conn->prepare($query_check_more);

                $stmt_check_more->execute();

                $result_check_more = $stmt_check_more->fetch();

                $check_more = $result_check_more['watchlist'];

                $check_more = explode(',',$check_more);

                $reversed_more = array_reverse($check_more);

                $array_more = [];

                for($x=0;$x<count($check_more);$x++){

                    array_push($array_more,$reversed_more[$x]);

                }

                $key_last_id = array_keys($array_more,$last_id);

                $key_last_id =  implode($key_last_id,'');

                for($x=0;$x<3;$x++){

                    $key_last_id++;

                    if(array_key_exists($key_last_id,$array_more)){

                        $id_fetch =  $array_more[$key_last_id];
                    }
                    else{
                        $id_fetch = 0;
                    }
                    
                    if($id_fetch == 0){

                        $output .= '';

                        break;
                    }
                    else{

                        
                        $query_fetch = 'select * from courses where course_id = "'.$id_fetch.'" ';

                        $stmt_fetch = $conn->prepare($query_fetch);

                        $stmt_fetch->execute();

                        $result_fetch = $stmt_fetch->fetch();
                        
                        $array = [];
                
                        $query_sum = 'select * from videos_files where course_id = "'.$result_fetch['course_id'].'" and video_file_type = "video" ';

                        $stmt_sum  = $conn->prepare($query_sum);

                        $stmt_sum->execute();

                        $result_sum = $stmt_sum->fetchAll();
                        
                        foreach($result_sum as $value_video){
                            
                            array_push($array,$value_video['video_duration']);
                        };
                             $output .= '
                                <div class="col-lg-6 col-xl-4 col-12 course_watchlist" data-id="'.convert_id('encrypt',$result_fetch['course_id']).'">
                                <div class="courses-wrapper text-center mb-30">
                                    <div class="courses-img">
                                        <img src="courses_content/course_images/'.$result_fetch['course_title'].'/'.$result_fetch['course_image'].'" alt="course_image">
                                    </div>
                                    <div class="courses-text">
                                        <h4><a href="single-course.php?id='.convert_id('encrypt',$result_fetch['course_id']) .'">'.$result_fetch['course_title'].'</a></h4>

                                        <div class="feedback">
                                            <span class="star d-inline-block">
                                                <span class="yes"><i class="fa fa-star"></i></span>
                                                <span class="yes"><i class="fa fa-star"></i></span>
                                                <span class="yes"><i class="fa fa-star"></i></span>
                                                <span class="yes"><i class="fa fa-star"></i></span>
                                                <span class="yes"><i class="fa fa-star-half-o"></i></span>
                                            </span>
                                            <span>'.rating($conn,$result_fetch['course_id']).'</span>
                                        </div>

                                        <div class="course-meta">
                                            <span><i class="fa fa-bookmark"></i>'.query_sum_lessons($conn,$result_fetch['course_id']).' Lesson</span>
                                            <span><i class="fa fa-clock-o"></i>'.sum_time($array).'</span>
                                            <span><i class="fa fa-users"></i>'.total_visitors($conn,$result_fetch['course_id']).'</span>
                                        </div>

                                    </div>
                                </div>
                            </div>';
                        }
                    }

                echo $output;
            }
        }
        else{
            header('Location: signIn.php');
        }
    }
    else{
        header('Location: signIn.php');
    }