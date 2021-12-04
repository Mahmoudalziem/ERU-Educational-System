<?php

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['action'])) {

        include 'connected.php';

        $output = '';

        $array = explode('/',$_POST['image_name']);

        $image_name = end($array);

        if (isset($_POST['avater']) == 'update_avater_image') {

            $query = 'update profile set avater_image = "'.$image_name.'" where username = "'.$_SESSION['username'].'" ';

            $stmt = $conn->prepare($query);

            $stmt->execute();

            $output .= 'Your Avater Image Update';
        }
        elseif (isset($_POST['background']) == 'update_background_image'){

            $query = 'update profile set background_image = "'.$image_name.'" where username = "'.$_SESSION['username'].'" ';

            $stmt = $conn->prepare($query);

            $stmt->execute();

            $output .= 'Your Background Image Update';
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