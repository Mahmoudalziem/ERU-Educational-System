<?php

$output = [];

function test_input($input){

    trim($input);

    htmlspecialchars($input);

    stripcslashes($input);

    return $input;
}

 if($_SERVER['REQUEST_METHOD'] == 'POST'){

     require 'connected.php';

     $file_name = test_input($_FILES['files']['name']);

     $file_size = test_input($_FILES['files']['size']);

     $file_tmp = test_input($_FILES['files']['tmp_name']);
     
     $course_title = $_POST['course_title'];

    $course_title = rtrim($course_title);
    
     $target_dir = dirname(__DIR__,2) . '/courses_content/courses_files//' . $course_title . '//';

     $maxSize = 5242880;  //5MB bytes size with bytes

     $file_extension =strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

     $file_name_new = time();

     $file_name_new = $file_name_new . '.' . $file_extension;

     $array_extensions = array("pdf","m","docx","doc","accdb","pptx","xlsx");

     if(in_array($file_extension,$array_extensions)){

         if($file_size >= $maxSize || $file_size == 0){

             $output = array(

                 'error' => 'File Too Large. File Must Be Less Than 5MB',
             );

         }
         else{

             if(!is_dir($target_dir)){

                 mkdir($target_dir);
             }

             $target_file = $target_dir . $file_name_new;

             move_uploaded_file($file_tmp,$target_file);

             $output = array(
                 'path' => $target_file,
                 'ok' => '',
             );
         }

     }
     else{

         $output = array(

             'error' => 'Invalid File Extension',
         );

     }


     echo json_encode($output);


 }
 else{
    header('Location: signIn.php');
}