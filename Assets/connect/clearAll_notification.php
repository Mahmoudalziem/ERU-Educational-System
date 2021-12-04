<?php

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['action'])){

        if($_POST['action'] == 'clear_all_notification'){

            include 'connected.php';

            $username = $_SESSION['username'];

            $query = 'update profile set courses_depart = "'.null.'" , status_courses = "'.null.'" where username = "'.$username.'"';

            $stmt = $conn->prepare($query);

            $stmt->execute();
        }
    }
    else{
        header('Location: signIn.php');
    }
}
else{
    header('Location: signIn.php');
}