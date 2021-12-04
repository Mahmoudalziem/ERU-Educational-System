<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

$mail = new PHPMailer();
$mail->Host = 'smtp.gmail.com';
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->CharSet = 'UTF-8';
$mail->Username = 'mbdalzym376@gmail.com';
$mail->Password = 'mbdalzym376@google.com';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->setFrom('mbdalzym376@gmail.com', 'AskTheProff Team');
$mail->isHTML(true);
$mail->Subject = 'Confirm Your Email';

    function test_input($data,$filter){

        $data = trim($data);

        $data = stripcslashes($data);

        $data = htmlspecialchars($data);

        $data = filter_var($data,$filter);

        return $data;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(isset($_POST['action'])){

            if($_POST['action'] == 'addUser'){

                $output = '';

                include 'connected.php';

                $username = test_input($_POST['username'],FILTER_SANITIZE_STRING);

                $name = test_input($_POST['name'],FILTER_SANITIZE_STRING);

                $email = test_input($_POST['email'],FILTER_SANITIZE_EMAIL);

                $password = test_input($_POST['password'],FILTER_SANITIZE_STRING);

                $joined_date = date('d F Y');

                if(!preg_match('/^[a-zA-Z0-9@_.]{5,15}$/',$username)){

                    $output .= 'Please Enter correct Username';
                }

                elseif(!preg_match('/^[a-zA-Z0-9 ]{5,40}$/',$name)){

                    $output .= 'Please Enter Your name Up 5 chars';
                }

                elseif(!preg_match('/^[a-zA-Z0-9_]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,4}$/',$email)){

                    $output .= 'Please Enter Correct Email';
                }
                elseif(!preg_match('/^[a-zA-Z0-9@_.#@]{6,50}$/',$password)){

                    $output .= 'Please Enter Correct Password';
                }

                else {

                    /*============ Validate UserName =============*/

                    $unique_username = 'select * from users where username = "'.$username.'" ';

                    $unique_username_stmt = $conn->prepare($unique_username);

                    $unique_username_stmt->execute();

                    $unique_username_result = $unique_username_stmt->rowCount();

                    /*============ Validate Email ===============*/

                    $unique_email = 'select * from profile where email = "'.$email.'"';

                    $unique_email_stmt = $conn->prepare($unique_email);

                    $unique_email_stmt->execute();

                    $unique_email_result = $unique_email_stmt->rowCount();


                    if($unique_username_result > 0){

                        $output .= 'UserName already Used';

                    }

                    elseif($unique_email_result > 0){

                        $output .= 'E-Mail already Used';
                    }
                    else {

                        ////*******************************
                        $query = 'insert Into users values(NULL,?,?,"user",0,null,"'.$joined_date.'" )';

                        $stmt = $conn->prepare($query);

                        $value = array(strtolower($username),base64_encode($password));

                        $stmt->execute($value);

                        $lastId = $conn->lastInsertId();

                        ////*******************************
                        $query1 = 'insert Into profile(ID,username,name,email) values(NULL,?,?,?)';

                        $stmt1 = $conn->prepare($query1);

                        $value1 = array(strtolower($username),$name,$email);

                        $stmt1->execute($value1);

                        $lastId = convert_id('encrypt',$lastId);

                        $token = convert_string('encrypt',$username);

                        $url = 'http://' . $_SERVER['SERVER_NAME'] . '/verify.php?id=' . $lastId . '&token=' . $token;

                        $mail->addEmbeddedImage('../images/logo/favicon.ico','logo_site');

                        $html = $html ='<html lang="en">
                            <head>
                                <meta charset="UTF-8" />
                                <title>Confirm Email</title>
                                <style>
                                .container{
                                width:500px;
                                height:auto;
                                margin:10px auto;
                                }
                                    .content_message .title_image{
                                        width:100%;
                                        height:100px;
                                        background-color:#101461b8;
                                        text-align: center;
                                        line-height:100px;
                                        position: relative;
                                        z-index: 1;
                                        color:#fff;
                                    }
                                    .content_message .title_image img{
                                        width:40px;
                                        height:40px;
                                        margin-top:29px;
                                    }
                                    .content_message .content_body{
                                        font-weight:600;
                                        font-size:14px;
                                        padding:20px;
                                    }
                                    
                                    .content_message .content_body h4{
                                        font-weight:600;
                                        color:#52558d;
                                    }
                                    .content_message .content_body p{
                                        opacity: .8;
                                        margin-top:10px;
                                        font-size:13px;
                                        font-weight:600;
                                    }

                                    .content_message .content_body a{
                                        margin-bottom: 10px;
                                        display: inline-block;
                                        text-decoration: none;
                                        outline: 0;
                                    }
                                    .content_message .content_footer {
                                        text-align: center;
                                        font-size: 14px;
                                        font-weight: 600;
                                        opacity: .8;
                                        color:#52558d;
                                    }
                                </style>
                            </head>
                            <body dir="ltr">
                                <div class="container">
                                    <div class="row">

                                        <div class="col-lg-5 col-12 mx-auto justify-content-center mt-5">

                                            <div class="content_message">
                                                <div class="title_image">
                                                    <img src="cid:logo_site" alt="image_title" />
                                                </div>

                                                <div class="content_body">
                                                    <h4> Hello '.$username.' </h4>
                                                    <p> Thanks for registration please click to this link To complete Registration  </p>
                                                    <a href="'.$url.'" target="_blank">Click Here</a>
                                                </div>
                                                <hr>
                                                <div class="content_footer">
                                                    <p>AskTheProff Team</p>
                                                </div>
                                            </div><!-- End Content Message -->
                                        </div><!-- End Columns -->
                                    </div>
                                </div>
                            </body>
                        </html>';

                        try {

                            $mail->addAddress($email);

                            $mail->Body = $html;

                            if ($mail->send() ) {

                                $output .= '';


                            } else {

                                $output .= 'Please Check Your Connection';
                            }

                        }catch(Exception $e){

                            $output .= 'Please Check Your Connection';
                        }

                    }
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