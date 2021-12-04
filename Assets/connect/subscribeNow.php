<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(isset($_POST['action'])){

            if($_POST['action'] == 'sendScribe'){

                require 'connected.php';

                $output = '';

                $user_name = $_POST['user_scribe'];

                $user_email = $_POST['email_scribe'];

                $query_check = 'select * from subscribe_people where scribe_email = ?';

                $stmt_check = $conn->prepare($query_check);

                $execute_check = array($user_email);

                $stmt_check->execute($execute_check);

                $rowCount_check = $stmt_check->rowCount();

                if($rowCount_check > 0){

                    $output .= '';
                }
                else{

                    $query = 'insert into subscribe_people values(null,?,?)';

                    $stmt = $conn->prepare($query);

                    $execute = array($user_name,$user_email);

                    $stmt->execute($execute);

                    $output .= 'Done Subscribe';
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