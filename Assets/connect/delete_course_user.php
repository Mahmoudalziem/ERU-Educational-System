<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
        if(isset($_POST['action'])){

            require  'connected.php';

            if($_POST['action'] == 'deleteCourse'){

                $course_id = $_POST['course_id'];

                /**** Select dir Name***/

                $query_dir = 'select * from courses Where course_id = "'.$course_id.'" ';

                $stmt_dir = $conn->prepare($query_dir);

                $stmt_dir->execute();

                $result_dir = $stmt_dir->fetch();

                $course_name = $result_dir['course_title'];

                $path_dir_file = dirname(__DIR__,2) . '/courses_content/courses_files//'. $course_name;

                $path_dir_image = dirname(__DIR__,2) . '/courses_content/course_images/'. $course_name;

                if(file_exists($path_dir_image) || file_exists($path_dir_file)){

                    function delete_dir($dir){

                        foreach (glob($dir . '/' . '*') as $file){
            
                            if(is_dir($file)){
            
                                if(count($file) == 10){
            
                                    delete_dir($file);
                                }
                            }
                            else{
                                unlink($file);
                            }
                        }
                    }

                    if(file_exists($path_dir_file)){

                        delete_dir($path_dir_file);

                        rmdir($path_dir_file);
                    }
                        
                    if(file_exists($path_dir_image)){

                        delete_dir($path_dir_image);

                        rmdir($path_dir_image);
                    }

                    $query_delete_course_base = 'delete from courses where course_id = "'.$course_id.'"';

                    $conn->exec($query_delete_course_base);

                    $query_delete_course_files = 'delete from videos_files where course_id = "'.$course_id.'"';

                    $conn->exec($query_delete_course_files);

                    $query_delete_course_sections = 'delete from sections where course_id = "'.$course_id.'"';

                    $conn->exec($query_delete_course_sections);

                    $query_delete_course_rating = 'delete from courses_rating where course_id = "'.$course_id.'"';

                    $conn->exec($query_delete_course_rating);

                    $query_delete_vistors_number = 'delete from visitors_number where course_id = "'.$course_id.'"';

                    $conn->exec($query_delete_vistors_number);
                }
            }
            
        }
        else{
            header('Location: signIn.php');
        }
    }
    else{
        header('Location: signIn.php');
    }