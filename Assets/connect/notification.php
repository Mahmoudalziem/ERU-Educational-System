<?php

session_start();

    if(isset($_POST['view'])){

        include 'connected.php';

        $output = '';

        if($_POST['action'] == 'notification_fetch'){

            $username = $_SESSION['username'] ;

            $query_check = 'select * from profile where username = "'.$username.'" ';

            $stmt_check = $conn->prepare($query_check);

            $stmt_check->execute();

            $result_check = $stmt_check->fetch();

            $status_check =  explode(',' , $result_check['status_courses']);

            $query_fetch = 'select  * from profile where username = "'.$username.'"';

            $stmt_fetch = $conn->prepare($query_fetch);

            $stmt_fetch->execute();

            $result_fetch = $stmt_fetch->fetch();

            $courses_fetch =  explode(',' , $result_fetch['courses_depart']);

            $status_fetch =  explode(',' , $result_fetch['status_courses']);

            $unseen = '';

            for($x=0;$x<count($courses_fetch);$x++){

                if(reset($courses_fetch) == null){

                    $output .= '<li class="notify_no">No Courses Added yet</li>';
                }
                else{

                    if($status_fetch[$x] == 0){
                    
                        $array_check = [];
                        
                        if($_POST['view'] != ''){
    
                            for($x=0;$x<count($status_check);$x++){
            
                                array_push($array_check,1);
                            }
                            
                            $array_check = implode($array_check,',');
            
                            $query_fetch = 'update profile set status_courses = "'.$array_check.'" where username = "'.$username.'" ';
            
                            $stmt_fetch = $conn->prepare($query_fetch);
            
                            $stmt_fetch->execute();
                        }
    
                        $unseen++;
                    }
                    
                    $course_id = $courses_fetch[$x];

                    $query_fetch = 'select * from courses where course_id = "'.$course_id.'"';

                    $stmt_fetch = $conn->prepare($query_fetch);

                    $stmt_fetch->execute();

                    $result_fetch = $stmt_fetch->fetch();

                    $output .= '<li>
                                    <a href="single-course.php?id='.convert_id('encrypt',$result_fetch['course_id']).'" class="viewNotification" data-id ='.$result_fetch['course_id'].'>
                                        <div class="notification d-flex">
                                            <i class="notify-icon fa fa-envelope"></i>
                                            <div class="notify-message">
                                                <p>'.$result_fetch['course_title'].'</p>
                                                <small class="subject_content">'.$result_fetch['date_course'].'</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>';
                }
                
            }

            $data = array(
                'notification' => $output,
                'unseen_notification' => $unseen,
            );
              echo json_encode($data);
        }
        else{
            header('Location: signIn.php');
        }
    }
else{
    header('Location: signIn.php');
}