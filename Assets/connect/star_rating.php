<?php

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    include 'connected.php';

    if(isset($_POST['action'])){

        if($_POST['action'] == 'rating_star'){

            $output = [];

            if(isset($_SESSION['username'])){

                $user_name = $_SESSION['username'];

                $query = 'select ID from users where username = "'.$user_name.'" ';

                $stmt = $conn->prepare($query);

                $stmt->execute();

                $result = $stmt->fetchAll();

                foreach ($result as $value){}

                $user_id = @$value['ID'];

                $course_id = $_POST['course_id'];

                $rating = $_POST['rating_id'];

                $query = 'SELECT * FROM courses_rating where user_id = "'.$user_id.'" and course_id = "'.$course_id.'" ';

                $stmt = $conn->prepare($query);

                $stmt->execute();

                $rowCount = $stmt->rowCount();

                if($rowCount > 0){

                    $query = 'UPDATE courses_rating SET rating = "'.$rating.'" WHERE user_id = "'.$user_id.'" ';

                    $conn->exec($query);
                }
                else{

                    $query = 'INSERT INTO courses_rating (user_id, course_id, rating)VALUES(?, ?, ?)';

                    $stmt =$conn->prepare($query);

                    $execution = array($user_id,$course_id,$rating);

                    $stmt->execute($execution);
                }

                $array = [];

                for($x=1; $x <=5; $x++){

                    $query = 'select * from courses_rating where course_id = ? and rating = ?';

                    $stmt = $conn->prepare($query);

                    $execute = array($course_id,$x);

                    $stmt->execute($execute);

                    $rowCount = $stmt->rowCount();

                    array_push($array, '(' . $rowCount . ') Reviews');
                }

             $output = $array;
            }

            else{
                $output = [];
            }

           echo json_encode($output);
        }
    }
    else{
        header('Location: signIn.php');
    }
}
else{
    header('Location: signIn.php');
}
