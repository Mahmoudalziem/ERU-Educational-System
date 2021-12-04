<?php

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['action'])){

        require 'connected.php';

        if($_POST['action'] == 'submit_notify'){

            $depart_id = $_POST['depart_id'];

            $sem_id = $_POST['sem_id'];

            $query = 'update profile set depart_id = ? , sem_id = ? where username = "'.$_SESSION['username'].'" ';

            $stmt = $conn->prepare($query);

            $execute = array($depart_id,$sem_id);

            $stmt->execute($execute);
        }
    }
    else{
        header('Location: signIn.php');
    }
}
else{
    header('Location: signIn.php');
}