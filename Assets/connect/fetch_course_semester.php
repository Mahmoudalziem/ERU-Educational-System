<?php


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['action'])){

        require  'connected.php';

        $output = '';

        $array = [];

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

        if($_POST['action'] == 'Fetch_Course_Semester'){

            $id_semester = convert_id('decrypt',$_POST['id_semester']);

            $id_depart = convert_id('decrypt',$_POST['id_department']);

            $query = 'select * from courses where sem_id = ? and depart_id = ? order by course_id';

            $stmt = $conn->prepare($query);

            $execute = array($id_semester,$id_depart);

            $stmt->execute($execute);

            $result = $stmt->fetchAll();

            $rowCount = $stmt->rowCount();

            if($rowCount > 0){

                foreach ($result as $value){

                    $query_sum = 'select * from videos_files where course_id = "'.$value['course_id'].'" and video_file_type = "video" ';

                        $stmt_sum  = $conn->prepare($query_sum);

                        $stmt_sum->execute();

                        $result_sum = $stmt_sum->fetchAll();
                        
                        foreach($result_sum as $value_video){

                            array_push($array,$value_video['video_duration']);
                        };

                    $output .= '
                        <div class="col-lg-6 col-xl-4 col-12 ">
                            <div class="courses-wrapper text-center mb-30">
                                <div class="courses-img">
                                    <img src="courses_content/course_images/'.$value['course_title'].'/'.$value['course_image'].'" alt="course_image">
                                </div>
                                <div class="courses-text">
                                    <h4><a href="single-course.php?id='.convert_id('encrypt',$value['course_id']) .'">'.$value['course_title'].'</a></h4>

                                    <div class="feedback">
                                        <span class="star d-inline-block">
                                        <span class="yes"><i class="fa fa-star"></i></span>
                                        <span class="yes"><i class="fa fa-star"></i></span>
                                        <span class="yes"><i class="fa fa-star"></i></span>
                                        <span class="yes"><i class="fa fa-star"></i></span>
                                        <span class="yes"><i class="fa fa-star-half-o"></i></span>
                                        </span>
                                        <span>'.rating($conn,$value['course_id']).'</span>
                                    </div>

                                    <div class="course-meta">
                                        <span><i class="fa fa-bookmark"></i>'.query_sum_lessons($conn,$value['course_id']).' Lesson</span>
                                        <span><i class="fa fa-clock-o"></i>'.sum_time($array).'</span>
                                        <span><i class="fa fa-users"></i>'.total_visitors($conn,$value['course_id']).'</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    ';
                }
            }

            else{
                $output .= '<div class="no_course text-center w-100">No Course Yet Added To This Semester</div>';
            }
        }

        echo $output;
    }
    else{
        header('Location: signIn.php');
    }
}
else{
    header('Location: signIn.php');
}