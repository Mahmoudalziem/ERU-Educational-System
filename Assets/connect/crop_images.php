<?php

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['action'])){

        require 'connected.php';

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
        
        $output = '';

        $max_size = 5242880;

        if(isset($_POST['avater']) == 'Avater_Corp'){

            $image = $_POST['image'];

            $image_array_1 = explode(';',$image);

            $image_array_2 = explode(',',$image_array_1[1]);

            $data = base64_decode($image_array_2[1]);

            $imageName = time() . '.jpg';

            $path = dirname(__DIR__,2) . '/images_users/avaters//' . $_SESSION['username'];

            if(is_dir($path)){

                delete_dir($path);

                rmdir($path);

                if(!file_exists($path)){

                    mkdir($path);
                };
            }

            else{
                mkdir($path);
            }


            $path_image = dirname(__DIR__,2) . '/images_users/avaters//'.$_SESSION['username'].'//' . $imageName;

            file_put_contents($path_image, $data);

            if(filesize($path_image) >= $max_size){

                $output .= 'File Too large . File Must Be Less Than 5MB ';
            }
            else{

                $image_show = 'images_users/avaters//'.$_SESSION['username'].'//' . $imageName;

                $output .= $image_show;
            }
        }

        elseif(isset($_POST['background']) == 'Background_Corp'){

            $image = $_POST['image'];

            $image_array_1 = explode(';',$image);

            $image_array_2 = explode(',',$image_array_1[1]);

            $data = base64_decode($image_array_2[1]);

            $imageName = time() . '.png';

            $path = dirname(__DIR__,2) . '/images_users/background//' . $_SESSION['username'];

            if(is_dir($path)){

                delete_dir($path);

                rmdir($path);

                if(!file_exists($path)){

                    mkdir($path);
                };
            }
            else{
                mkdir($path);
            }

            $path_image = $path .'//' . $imageName;

            file_put_contents($path_image, $data);

            if(filesize($path_image) >= $max_size){

                $output .= 'File Too large . File Must Be Less Than 5MB ';
            }
            else{

                $image_show = 'images_users/background//'.$_SESSION['username'].'//' . $imageName;

                $output .= $image_show;
            }
        }

        elseif (isset($_POST['course_image']) == 'course_image'){

            $image = $_POST['image'];

            $course_title = $_POST['course_title'];

            $course_title = rtrim($course_title);
            
            $image_array_1 = explode(';',$image);

            $image_array_2 = explode(',',$image_array_1[1]);

            $data = base64_decode($image_array_2[1]);

            $imageName = time() .'.jpg';

            $path = dirname(__DIR__,2) . '/courses_content/course_images//' . $course_title ;

            if(is_dir($path)){

                delete_dir($path);

                rmdir($path);

                if(!file_exists($path)){

                    mkdir($path);
                };
            }

            else{

                

                mkdir($path);
            }


            $path_image = $path .'//' . $imageName;

            file_put_contents($path_image , $data);

            if(filesize($path_image) >= $max_size){

                $output .= 'File Too large . File Must Be Less Than 5MB ';
            }
            else{

                $image_show = 'courses_content/course_images//' . $course_title .'//' . $imageName;

                $output .= $image_show;
            }


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