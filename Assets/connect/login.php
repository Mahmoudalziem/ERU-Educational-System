<?php

    session_start();

    function test_input($data, $filter)
    {
        $data = trim($data);

        $data = stripcslashes($data);

        $data = htmlspecialchars($data);

        $data = filter_var($data, $filter);

        return $data;
    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'login_site') {
                $output = '';

                include 'connected.php';

                $username = test_input($_POST['username'], FILTER_SANITIZE_STRING);

                $username = strtolower($username);

                $password = test_input($_POST['password'], FILTER_SANITIZE_STRING);

                $rememberMe =  $_POST['rememberMe'];

                $shaPassword = base64_encode($password);

                if (!preg_match('/^[a-zA-Z0-9@_.]{5,15}$/', $username)) {
                    $output .= 'Please Enter correct Username';
                } elseif (!preg_match('/^[a-zA-Z0-9@_.#@]{6,50}$/', $password)) {
                    $output .= 'Password Must Be min 6 chars';
                } else {

                // user validate
                
                    $query = 'select * from users where username = "'.$username.'" and password = "'.$shaPassword.'" and actived = 1 and status = ("user" or "moderator")';

                    $stmt = $conn->prepare($query);

                    $stmt->execute();

                    $countUser= $stmt->rowCount();

                    $result_user = $stmt->fetchAll();

                    foreach ($result_user as $value) {
                        $GLOBALS['ID'] = $value['ID'];
                    }
                    // admin validate

                    $query1 = 'select * from users where username = "'.$username.'" and password = "'.$shaPassword.'" and actived = 2 and status = "admin" ';

                    $stmt1 = $conn->prepare($query1);

                    $stmt1->execute();

                    $countAdmin= $stmt1->rowCount();

                    if ($countUser > 0) {
                        $_SESSION['username'] = strtolower($username);

                        $output .= 'user';

                        if ($rememberMe == 'true') {
                            setcookie('User_ID', base64_encode($GLOBALS['ID']), time() + (10 * 365), '/');
                        } else {
                            setcookie('username', '', time() + (10 * 365), '/');

                            setcookie('User_ID', '', time() + (10 * 365), '/');
                        }
                    } elseif ($countAdmin > 0) {
                        setcookie('username', '', time() + (10 * 365), '/');

                        setcookie('User_ID', '', time() + (10 * 365), '/');

                        $_SESSION['username'] = 'admin';

                        $output .= 'admin';
                    } else {
                        $query1 = 'select username,password from users where username = "'.$username.'" and password = "'.$shaPassword.'" and actived = 0 and status = "user" ';

                        $stmt1 = $conn->prepare($query1);

                        $stmt1->execute();

                        $result1 = $stmt1->rowCount();

                        if ($result1 > 0) {
                            $output .= 'Please Active Your Account';
                        } else {
                            $output .= 'Username Or Password Not valid';
                        }
                    }
                }

                $data = array(

                'output' => $output,
            );

                echo json_encode($data);
            }
        } else {
            header('Location: signIn.php');
        }
    } else {
        header('Location: signIn.php');
    }
