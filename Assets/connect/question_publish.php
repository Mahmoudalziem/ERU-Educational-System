<?php

    session_start();

    $output = '';

    function filter($x)
    {
        $output = trim($x);

        $output = stripcslashes($x);

        $output = htmlspecialchars($x);

        return  $output;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'Q_publish') {
                require_once 'connected.php';

                $q_title = $_POST['q_title'];

                $q_title = filter($q_title);

                $q_lang = filter($_POST['q_lang']);

                $q_depart = filter($_POST['q_depart']);

                $q_depart = convert_string('decrypt', $q_depart);
                
                $q_username = $_SESSION['username'];

                $q_content = filter($_POST['q_content']);

                if (strlen($q_title) > 120) {
                    $output .= 'Title Must Be Less Than 120 chars';
                } else {
                    $query = 'insert into question_details values(NULL,?,?,?,?,?,?)';

                    $stmt = $conn->prepare($query);

                    $source = array($q_title,$q_lang,$q_depart,$q_username,$q_content,'wait');

                    $stmt->execute($source);

                    $output .= 'Thanks For Question Waiting For Accept From Moderator';
                }

                echo $output;
            }
        }
    }
