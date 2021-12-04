<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

$mail = new PHPMailer();
$mail->Host = 'smtp.gmail.com';
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->CharSet = 'UTF-8';
$mail->Username = 'mbdalzym376@gmail.com';
$mail->Password = 'mbdalzym376@google.com';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->isHTML(true);
$mail->Subject = 'New Course From AskTheProff Site';

$output = '';

function test_input($input){

    trim($input);

    htmlspecialchars($input);

    stripcslashes($input);

    return $input;
}
require  'connected.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['action'])){

        $image_course = test_input($_POST['image_course']);

        $course_tages = test_input(implode($_POST['course_tages'],','));

        $learn_tabs = test_input(implode($_POST['learn_tabs'],','));

        $require_tabs = test_input(implode($_POST['require_tabs'],','));

        $course_language = test_input($_POST['course_language']);

        $course_depart = test_input($_POST['course_depart']);

        $course_semester = test_input($_POST['course_semester']);

        $description_content = test_input($_POST['description_content']);

        $base_name = strtolower(pathinfo($image_course,PATHINFO_BASENAME));

        $base_image = strtolower(pathinfo($image_course,PATHINFO_BASENAME));

        $array_section = [];

        $array_data_section_video = [];

        $array_data_section_file = [];

        $data_tr_video_id = [];

        $data_tr_file_id = [];

        $array_section_id = [];

        $video_url_id = [];

        $duration_video = [];

        $video_id = '';


        if(isset($_POST['video_url'])){

            for($x=0; $x<count($_POST['video_url']); $x++){


                $video_id = $_POST['video_url'][$x];

                preg_match('/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"\'>]+)/',$video_id,$result_video);

                array_push($video_url_id,'https://www.youtube.com/embed/' . $result_video[1]);
            }



            function getDuration($videoID,$apikey){
                $dur = 'https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id='.$videoID.'&key='.$apikey.'';
                $dur = file_get_contents($dur);
                $VidDuration =json_decode($dur, true);
                foreach ($VidDuration['items'] as $vidTime) {

                    @$VidDuration= $vidTime['contentDetails']['duration'];
                }
                preg_match_all('/(\d+)/',$VidDuration,$parts);

                if(@$parts[0][2] == null){
                    return @$parts[0][0]  . ":" .
                            @$parts[0][1];
                }
                else{
                    return @$parts[0][0]  . ":" .
                            @$parts[0][1] . ":".
                            @$parts[0][2] ;
                }
             }

            for($x=0; $x<count($_POST['video_url']); $x++){

                $video_id = $_POST['video_url'][$x];

                preg_match('/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"\'>]+)/',$video_id,$result_video);

                $apikey = 'AIzaSyA3IuX_rPlRtGTZLII23QuvnPsVacTSilc';

                $vidDuration_item = getDuration($result_video[1],$apikey);

                array_push($duration_video,$vidDuration_item);
            }

        };

        if(isset($_POST['section_content_id'])){

            for($x=0; $x<count($_POST['section_content_id']); $x++){

                array_push($array_section_id,$_POST['section_content_id'][$x]);
            }
        }

        if(isset($_POST['data_tr_video_id'])){

            for($x=0; $x<count($_POST['data_tr_video_id']); $x++){

                array_push($data_tr_video_id,$_POST['data_tr_video_id'][$x]);
            }
        }

        if(isset($_POST['data_tr_file_id'])){

            for($x=0; $x<count($_POST['data_tr_file_id']); $x++){

                array_push($data_tr_file_id,$_POST['data_tr_file_id'][$x]);
            }
        }

        if(isset($_POST['section_title'])){

            for($x=0; $x<count($_POST['section_title']); $x++){

                array_push($array_section,$_POST['section_title'][$x]);
            }
        }

        if(isset($_POST['data_section_video'])){

            for ($x=0; $x < (count($_POST['data_section_video'])); $x++){

                array_push($array_data_section_video,test_input($_POST['data_section_video'][$x]));
            }
        }

        if(isset($_POST['data_section_file'])){

            for ($x=0; $x < (count($_POST['data_section_file'])); $x++){

                array_push($array_data_section_file,test_input($_POST['data_section_file'][$x]));
            }
        };

        $query = 'select * from courses order by course_id';

        $stmt = $conn->prepare($query);

        $stmt->execute();

        $rowCount =  $stmt->rowCount();

        $result = $stmt->fetchAll();

        foreach($result as $value){

            $GLOBALS['course_id'] = $value['course_id'];
        };

        if(@$GLOBALS['course_id'] == 0){

            $course_id = 1;
        }
        else{

            $course_id = $GLOBALS['course_id'] + 1;
        }

        if($_POST['action'] == 'Add_Course'){

            $course_title = test_input($_POST['course_title']);

            if($base_name == 'default_course.png') {

                $output .= 'Please Insert Course Image';

            }
            else{

                $query_check_course = 'select  * from courses where course_title = "'.$course_title.'"';

                $stmt_check_course = $conn->prepare($query_check_course);

                $stmt_check_course->execute();

                $result_course = $stmt_check_course->rowCount();

                if($result_course > 0){

                    $output .= 'Course Name Deplicate With Another Course';
                }
                else{

                    /*******************Add Course To Depart Users  *************/

                    $query_check_user_depart = 'select * from profile where depart_id = ? and sem_id = ? ';

                    $stmt_check_depart_user = $conn->prepare($query_check_user_depart);

                    $execute_array_depart_user = array($course_depart,$course_semester);

                    $stmt_check_depart_user->execute($execute_array_depart_user);

                    $result_check_depart_user = $stmt_check_depart_user->fetchAll();

                    ///////////// Select Course_id

                    foreach($result_check_depart_user as $value_user){

                        $query_select_course_id = 'select * from courses order by course_id';

                        $stmt_slelect_course_id = $conn->prepare($query_select_course_id);

                        $stmt_slelect_course_id->execute();

                        $course_id = $stmt_slelect_course_id->rowCount();

                        $course_id = $course_id + 1;

                        if($value_user['courses_depart'] == 0){

                            $query_insert = 'update profile set courses_depart = ? , status_courses = ? where depart_id = "'.$course_depart.'" and sem_id = "'.$course_semester.'" ';

                            $stmt_insert = $conn->prepare($query_insert);

                            $exe_array = array($course_id,0);

                            $stmt_insert->execute($exe_array);

                        }else{

                            $course_id_value = $value_user['courses_depart'] . ',' . $course_id;

                            $status_value = $value_user['status_courses'] . ',' . 0;

                            $query_insert = 'update profile set courses_depart = ?  , status_courses = ? where depart_id = '.$course_depart.' and sem_id = '.$course_semester.' ';

                            $stmt_insert = $conn->prepare($query_insert);

                            $exe_array = array($course_id_value,$status_value);

                            $stmt_insert->execute($exe_array);

                        }
                    }

                    /*******************Add Course To Depart Users  *************/
                    
                    $query_insert_course = 'insert into courses values(?,?,?,?,?,?,?,?,?,?,?,?)';

                    $stmt_insert_course = $conn->prepare($query_insert_course);

                    $execute_course = array($course_id,$course_title,$course_tages,$course_language,$course_depart,$course_semester,$description_content,$learn_tabs,$require_tabs,date('d F Y'),$base_image,null);

                    $stmt_insert_course->execute($execute_course);
                    
                    for($x=0; $x<count($array_section); $x++){

                        $query = 'insert into sections values(null,?,?)';

                        $stmt = $conn->prepare($query);

                        $execute = array($course_id,$array_section[$x]);

                        $stmt->execute($execute);
                    }

                    if(isset($_POST['video_title'])){

                        for($y=0;$y<count($_POST['video_title']);$y++){

                            $query_video = 'insert into videos_files values(null,?,?,?,?,?,?,?)';

                            $stmt_video = $conn->prepare($query_video);

                            $execute_video = array($array_data_section_video[$y],$course_id,test_input($_POST['video_title'][$y]),test_input($_POST['video_date'][$y]),test_input($video_url_id[$y]),'video',$duration_video[$y]);

                            $stmt_video->execute($execute_video);
                        }
                    }

                    if(isset($_POST['file_title'])){

                        for($z=0;$z<count($_POST['file_title']);$z++){

                            $query_file = 'insert into videos_files values(null,?,?,?,?,?,?,"null")';

                            $stmt_file = $conn->prepare($query_file);

                            $execute_file = array($array_data_section_file[$z],$course_id,test_input($_POST['file_title'][$z]),test_input($_POST['file_date'][$z]),test_input($_POST['file_content'][$z]),'file');

                            $stmt_file->execute($execute_file);
                        }
                    }

                    /********************** Send Message To Subscribe People **************/


                    /****************Course_id **********/

                    $query_select_course_id = 'select * from courses order by course_id';

                        $stmt_slelect_course_id = $conn->prepare($query_select_course_id);

                        $stmt_slelect_course_id->execute();

                        $course_id = $stmt_slelect_course_id->rowCount();

                        $body = '<html lang="en">
                                    <head>
                                        <meta charset="UTF-8" />
                                        <title>Subscribe Courses</title>
                                        <style>

                                        .container{
                                            background-color:#f8f9fa;
                                        }
                                        .courses-wrapper {
                                            overflow:hidden;
                                            width:300px;
                                            height:auto;
                                            margin:10px auto;
                                        }

                                        .courses-wrapper img{
                                            width:100%;
                                            height:100%;
                                        }
                                        .askproff{
                                            font-weight:600;
                                            font-size:13px;
                                            text-align:center;
                                            padding:20px;
                                            opacity:.8;
                                            color:#45487d;
                                        }
                                        .courses-img{
                                            position: relative;
                                            height:120px;
                                            background: #fff;
                                        }

                                        .courses-text {
                                            padding-top:20px;
                                            background: #fff;
                                        }

                                        .courses-text h4 {
                                            font-size: 14px;
                                            font-weight: 600;
                                            line-height: 31px;
                                            margin-bottom: 0;
                                            text-align: left;
                                            padding: 0 10px 4px;
                                            overflow: hidden;
                                            height:auto !important;
                                        }

                                        .courses-text h4 a{
                                            text-decoration:none;
                                        }
                                        .ajU{
                                            padding:0 !important;
                                        }
                                        .courses-text h4>a {
                                            color: #3b3e79;
                                        }
                                        .courses-text .description{
                                            color: #fff;
                                            font-weight: 600;
                                            font-size: 13px;
                                            padding: 20px 10px 20px 20px;
                                            background-color: #3b3e79;
                                            line-height: 20px;
                                            margin-top: 33px;
                                        }
                                        </style>
                                    </head>
                                    <body dir="ltr">
                                       <div class="container">
                                        <div class="col-lg-6 col-xl-4 col-12 course_watchlist" data-id="'.convert_id('encrypt',$course_id).'">
                                            <div class="courses-wrapper text-center mb-30">
                                                <div class="courses-img">
                                                    <img src="cid:course_image" alt="course_image">
                                                </div>
                                                <div class="courses-text">
                                                    <h4><a href="http://'.$_SERVER['SERVER_NAME'].'/single-course.php?id='.convert_id('encrypt',$course_id) .'">'.$course_title.'</a></h4>
                                                    <div class="description">'.substr($description_content,1,100) . '....' .' </div>
                                                </div>
                                                <br><br>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="askproff">AskTheProff Team</div>
                                        </div>
                                    </body>
                                </html>';
                                
                                // End Body 
                                
                    $mail->addEmbeddedImage(dirname(__DIR__,2) . '/courses_content/course_images//' . $course_title .'//' . $base_image,'course_image');

                    $mail->Subject = $course_title;

                    $mail->Body = $body;
                    
                    $mail->setFrom('mbdalzym376@gmail.com', 'AskTheProff Team');
                    
                      /***********************/
                  
                    $query_send_scribe = 'select * from subscribe_people';
                    
                    $stmt_send_scribe = $conn->prepare($query_send_scribe);

                    $stmt_send_scribe->execute();

                    $result_send_count = $stmt_send_scribe->rowCount();
                        
                      for($x = $result_send_count; $x > 0; $x--){
                          
                          if($x == 0){
                              
                              break;
                              
                          }else{
                              
                              $query_select = 'select scribe_email from subscribe_people where scribe_id = "'.$x.'"';
                              $stmt_select = $conn->prepare($query_select);
                              
                              $stmt_select->execute();
                              
                                $result_select = $stmt_select->fetch();

                                $mail->addAddress($result_select['scribe_email']);     // Add a recipient
                             
                          }
                          
                      }
                          
                          if(!$mail->send()){
    
                                $output = 'Please Check Your connection';
                            }   
                            
                    $output .= '';
                }
            }
        }

        elseif ($_POST['action'] == 'Edit_course'){

            $course_id = $_POST['id'];

            $query = 'update courses set course_tages = ? , language = ? , depart_id = ? , sem_id = ? , description = ? , learn_tabs = ? , require_tabs = ? , course_image = ? , last_update = ? where course_id = "'.$course_id.'" ';

            $stmt = $conn->prepare($query);

            $execute = array($course_tages,$course_language,$course_depart,$course_semester,$description_content,$learn_tabs,$require_tabs,$base_image,date('d F Y'));

            $stmt->execute($execute);

            for($n=0; $n < count($array_section); $n++){

                $query_check_section = 'select * from sections where section_id = "'.$array_section_id[$n].'" and course_id = "'.$course_id.'" ';

                $stmt_check_section = $conn->prepare($query_check_section);

                $stmt_check_section->execute();

                $stmt_check_section_count= $stmt_check_section->rowCount();

                if($stmt_check_section_count > 0){

                    $query = 'update sections set section_name = ? where section_id = "'.$array_section_id[$n].'" and course_id = "'.$course_id.'" ';

                    $stmt = $conn->prepare($query);

                    $execute = array($array_section[$n]);

                    $stmt->execute($execute);

                }
                else{

                    $query = 'insert into sections values(null,?,?)';

                    $stmt = $conn->prepare($query);

                    $execute = array($course_id,$array_section[$n]);

                    $stmt->execute($execute);

                }
            }


            if(isset($_POST['video_title'])){

                for($y=0;$y<count($array_data_section_video);$y++){

                    $query_check_video = 'select * from videos_files where video_file_id = "'.test_input($data_tr_video_id[$y]).'" and video_file_type = "video" ';

                    $stmt_check_video = $conn->prepare($query_check_video);

                    $stmt_check_video->execute();

                    $stmt_check_count_video = $stmt_check_video->rowCount();

                    if($stmt_check_count_video > 0){

                        $query_video = 'update videos_files set section_name = ? , course_id = ? , video_file_name = ? , video_file_date = ? , video_file_content = ? , video_file_type = ? , video_duration = ? where video_file_type = "video" and video_file_id = "'.$data_tr_video_id[$y].'"  ';

                        $stmt_video = $conn->prepare($query_video);

                        $execute_video = array($array_data_section_video[$y],$course_id,test_input($_POST['video_title'][$y]),test_input($_POST['video_date'][$y]),test_input($video_url_id[$y]),'video',$duration_video[$y]);

                        $stmt_video->execute($execute_video);
                    }
                    else{

                        $query_video = 'insert into videos_files values(null,?,?,?,?,?,?,?)';

                        $stmt_video = $conn->prepare($query_video);

                        $execute_video = array($array_data_section_video[$y],$course_id,test_input($_POST['video_title'][$y]),test_input($_POST['video_date'][$y]),test_input($video_url_id[$y]),'video',$duration_video[$y]);

                        $stmt_video->execute($execute_video);
                    }

                }
            }

            if(isset($_POST['file_title'])){

                for($z=0;$z<count($array_data_section_file);$z++){

                    $query_check_file = 'select * from videos_files where video_file_id = "'.test_input($data_tr_file_id[$z]).'" and video_file_type = "file"  ';

                    $stmt_check_file = $conn->prepare($query_check_file);

                    $stmt_check_file->execute();

                    $stmt_check_count_file = $stmt_check_file->rowCount();

                    if($stmt_check_count_file > 0){

                        $query_file = 'update videos_files set section_name = ? , course_id = ? , video_file_name = ? , video_file_date = ? , video_file_content = ? , video_file_type = ? where video_file_type = "file" and video_file_id = "'.$data_tr_file_id[$z].'"  ';

                        $stmt_file = $conn->prepare($query_file);

                        $execute_file = array($array_data_section_file[$z],$course_id,test_input($_POST['file_title'][$z]),test_input($_POST['file_date'][$z]),test_input($_POST['file_content'][$z]),'file');

                        $stmt_file->execute($execute_file);
                    }

                    else{

                        $query_file = 'insert into videos_files values(null,?,?,?,?,?,?,"null")';

                        $stmt_file = $conn->prepare($query_file);

                        $execute_file = array($array_data_section_file[$z],$course_id,test_input($_POST['file_title'][$z]),test_input($_POST['file_date'][$z]),test_input($_POST['file_content'][$z]),'file');

                        $stmt_file->execute($execute_file);
                    }


                }
            }

            $output .= '';
        }

        echo json_encode($output);
    }
    else{
        header('Location: signIn.php');
    }
}
else{
    header('Location: signIn.php');
}
