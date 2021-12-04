<?php

 if($_SERVER['REQUEST_METHOD'] == 'POST'){

     if(isset($_POST['action'])){

         require 'connected.php';

         if($_POST['action'] == 'delete_section'){

             $section_name = $_POST['section_name'];

             $query = 'delete from sections where section_name = "'.$section_name.'" ';

             $conn->exec($query);

             $query2 = 'delete from videos_files where section_name = "'.$section_name.'" ';

             $conn->exec($query2);
         }

         elseif ($_POST['action'] == 'delete_field'){

             $id = $_POST['id'];

             $section_name = $_POST['section_name'];

             $field_name = $_POST['field_name'];

              /*************** Fetch course Name ***************/
             
              $query_course_name = 'select course_title from courses where course_id = "'.$id.'"';

              $stmt_course_name = $conn->prepare($query_course_name);
 
              $stmt_course_name->execute();
 
              $result_course_name = $stmt_course_name->fetch();
 
              $course_name = $result_course_name['course_title'];

              /************ delete file form Directory **************/

             $query = 'select * from videos_files where section_name = "'.$section_name.'" and course_id = "'.$id.'" and video_file_name = "'.$field_name.'"';

             $stmt = $conn->prepare($query);

             $stmt->execute();

             $result = $stmt->fetch();

             $file_type = $result['video_file_type'];

             $file_path = $result['video_file_content'];

             $file_name = strtolower(pathinfo($file_path,PATHINFO_BASENAME));

             $file_path = dirname(__DIR__,2) . '/courses_content/courses_files//' . $course_name . '//' . $file_name;     

             if($file_type == 'file'){

                 if(file_exists($file_path)){

                     unlink($file_path);

                     $query = 'delete from videos_files where section_name = "'.$section_name.'"  and course_id = "'.$id.'" and video_file_name = "'.$field_name.'" ';

                    $stmt = $conn->prepare($query);
    
                    $stmt->execute();
                 }   
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