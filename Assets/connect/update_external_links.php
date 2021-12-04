<?php

session_start();

function test_input($data,$filter){

    $data = trim($data);

    $data = stripcslashes($data);

    $data = htmlspecialchars($data);

    $data = filter_var($data,$filter);

    return $data;
}


if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['action'])) {

        if ($_POST['action'] == 'Update_Links') {

            $output = '';

            include 'connected.php';

            parse_str($_POST['form_submit'],$_POST);

            $facebook_username = test_input($_POST['facebook_url'],FILTER_SANITIZE_STRIPPED);

            $twitter_url = test_input($_POST['twitter_url'],FILTER_SANITIZE_STRIPPED);

            $linkedin_url = test_input($_POST['linkedin_url'],FILTER_SANITIZE_STRIPPED);

            $instagram_url = test_input($_POST['instagram_url'],FILTER_SANITIZE_STRIPPED);

            $website_url = test_input($_POST['website_url'],FILTER_SANITIZE_STRIPPED);



            if ($facebook_username != '') {

                if(preg_match('/^[a-zA-Z0-9@_.]{5,15}$/', $facebook_username)){

                    $query = 'update profile set face_un = "'.$facebook_username.'" where username = "'.$_SESSION['username'].'" ';

                    $stmt = $conn->prepare($query);

                    $stmt->execute();

                    $output .= '';

                }
                else{
                    $output .= 'Please Enter Correct Facebook Username' . '<br>';
                }

            }
            if ($twitter_url != '') {

                if(preg_match('/^[a-zA-Z0-9@_.]{5,15}$/', $twitter_url)){

                    $query = 'update profile set twitter_un = "'.$twitter_url.'" where username = "'.$_SESSION['username'].'" ';

                    $stmt = $conn->prepare($query);

                    $stmt->execute();

                    $output .= '';

                }
                else{
                    $output .= 'Please Enter Correct Twitter Username' . '<br>';
                }

            }
            if ($linkedin_url != '') {

                if(preg_match('/^[a-zA-Z0-9@_.]{5,15}$/', $linkedin_url)){

                    $query = 'update profile set linked_un = "'.$linkedin_url.'" where username = "'.$_SESSION['username'].'" ';

                    $stmt = $conn->prepare($query);

                    $stmt->execute();

                    $output .= '';
                }
                else{
                    $output .= 'Please Enter Correct Linkedin Username' . '<br>';
                }

            }

            if ($instagram_url != '') {

                if(preg_match('/^[a-zA-Z0-9@_.]{5,15}$/', $instagram_url)){

                    $query = 'update profile set insta_un = "'.$instagram_url.'" where username = "'.$_SESSION['username'].'" ';

                    $stmt = $conn->prepare($query);

                    $stmt->execute();

                    $output .= '';
                }
                else{
                    $output .= 'Please Enter Correct Instagram Username' . '<br>';
                }

            }

            if ($website_url != '') {

                if(preg_match('/^(?:http?:|https?:\/\/)(?:www\.)(?:[a-zA-Z0-9_]{3,15})(?:\.com|\.online|\.eg)$/', $website_url)){

                    $query = 'update profile set website_url = "'.$website_url.'" where username = "'.$_SESSION['username'].'" ';

                    $stmt = $conn->prepare($query);

                    $stmt->execute();

                    $output .= '';
                }
                else{
                    $output .= 'Please Enter Correct Url Website' ;
                }

            }
            echo json_encode($output);
        }
    }
}
else{
    header('Location: index.php');
}