<?php


if($_SERVER['REQUEST_METHOD'] == 'GET'){

    if(isset($_GET['id'])){

        require 'connected.php';

        $id_down = convert_id('decrypt',$_GET['id']);

        $query = 'select * from videos_files where video_file_id = "'.$id_down.'" and video_file_type = "file" ';

        $stmt = $conn->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll();

        foreach ($result as $value){

            $query_course_name = 'select course_title from courses where course_id = "'.$value['course_id'].'" ';

            $stmt_course_name = $conn->prepare($query_course_name);

            $stmt_course_name->execute();

            $result_course = $stmt_course_name->fetch();

            $course_name = $result_course['course_title'];

            $file_name = $value['video_file_content'];

            $file_name = strtolower(pathinfo($file_name,PATHINFO_BASENAME));
            
            $file_extension = strtolower(pathinfo($value['video_file_content'],PATHINFO_EXTENSION));

            $file_path = dirname(__DIR__,2) . '/courses_content/courses_files//'. $course_name .'//' . $file_name;
        
            if(!file_exists($file_path) && !is_file($file_name)) {
                
                header('HTTP/1.0 404 Not Found');

                die('File not found!');

                exit;
                
            }
            else {
                header('Content-Type: text/'.$file_extension.'; charset=utf-8');
                header('Content-Description: File transfer');
                header('Pragma: public');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Cache-Control: private',false);
                header('Content-Transfer-Encoding: binary');
                header('Content-Disposition: attachment;filename= '.$file_name.'');
                header('Content-Length: '.filesize($file_path).'');
                header('Connection: close');
                $file = readfile($file_path);
                json_decode($file);
                exit;
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


