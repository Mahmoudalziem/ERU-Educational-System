<?php

session_start();

if(isset($_POST['action'])) {

    include 'connected.php';

    if ($_POST['action'] == 'insert_notification') {

        $number_of_country = $_POST['number_of_country'];

        $country_name = $_POST['country_name'];

        $subject = $_POST['subject'];

        $message = $_POST['message'];

        $f1 = 'select username from users where username = "' . $_SESSION['username'] . '" and actived = 1 and groupID = 1';

        $f2 = $conn->prepare($f1);

        $f2->execute();

        $f3 = $f2->fetchAll();

        foreach ($f3 as $item) {

            $insert = 'insert into notification(username,number_of_country,country_name,subject_content,message_content,time_message) values(?,?,?,?,?,CURRENT_TIMESTAMP )';

            $exe = array($item['username'], $number_of_country, $country_name, $subject, $message,);

            $stmt2 = $conn->prepare($insert);

            $stmt2->execute($exe);
        }

    } else{
        header('Location: signIn.php');
    }
}else{
    header('Location: signIn.php');
}