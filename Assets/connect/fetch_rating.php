<?php

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    require 'connected.php';

    if(isset($_POST['action'])){

        if($_POST['action'] == 'fetch_rating' ){

            if(isset($_SESSION['username'])){

                $user_name = $_SESSION['username'];

                $query = 'select ID from users where username = "'.$user_name.'" ';

                $stmt = $conn->prepare($query);

                $stmt->execute();

                $result = $stmt->fetchAll();

                foreach ($result as $value){}

                $user_id = @$value['ID'];
            }

            $course_id = $_POST['course_id'];

            $query1 = 'SELECT * FROM courses_rating  where course_id = "'.$course_id.'" ';

            $stmt1 = $conn->prepare($query1);

            $stmt1->execute();

            $stmt1->rowCount();

            $rowCount1 = $stmt1->rowCount();

            if(isset($_SESSION['username'])){

                $query = 'SELECT * FROM courses_rating where course_id = "'.$course_id.'" and user_id = "'.$user_id.'" order by id';

                $stmt = $conn->prepare($query);

                $stmt->execute();

                $result = $stmt->fetchAll();

                $rowCount = $stmt->rowCount();

                foreach ($result as $value){}

                $sum_rates[] = @$value['rating'];

                if($rowCount > 0){

                    $rating_number = $rowCount1;

                    $sum_rates = array_sum($sum_rates);

                    $rate_value = $sum_rates/$rating_number;

                    $rate_bg = round((($sum_rates)/5)*100);

                    if($rate_bg == 100){

                        $length = 2;
                    }
                    else{
                        $length = 1;
                    }
                    $output = array(

                        'width_rating' => $rate_bg .'%',

                        'rating_user' => substr($rate_bg,0,$length),

                        'number_rating' => $rating_number ." Review(s)",
                    );
                }

                else{


                    $rate_value = 0;

                    $rate_bg = 0;

                    $output = array(

                        'width_rating' => $rate_bg .'%',

                        'rating_user' => substr($rate_value,0,3),

                        'number_rating' =>  $rowCount1 . ' Review(s)',
                    );
                }
            }

            else{

                $rating_number = $rowCount1;

                $rate_value = 0;

                $rate_bg = 0;

                $output = array(

                    'number_rating' =>  $rating_number . ' Review(s)',

                    'notLogin'  => '',
                );
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