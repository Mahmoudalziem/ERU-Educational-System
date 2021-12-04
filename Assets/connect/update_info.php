<?php

session_start();

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

function test_input($data,$filter){

    $data = trim($data);

    $data = stripcslashes($data);

    $data = htmlspecialchars($data);

    $data = filter_var($data,$filter);

    return $data;
}
include 'connected.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['action'])) {

        if ($_POST['action'] == 'update_info') {

            $output = '';

            $name = test_input($_POST['name'], FILTER_SANITIZE_STRING);

            $address = test_input($_POST['address'],FILTER_SANITIZE_STRING);

            $birth_date = $_POST['day_value'] . ' '.  $_POST['month_value'] . ' '. $_POST['year_value'];

            ///********* Check Email *****************///

            $query = 'select * from profile where username = "'.$_SESSION['username'].'" ';

            $stmt = $conn->prepare($query);

            $stmt->execute();

            $result = $stmt->fetchAll();

            foreach ($result as $check){

                $GLOBALS['email'] = $check['email'];
            }

            if (!preg_match('/^[a-zA-Z0-9 ]{5,40}$/', $name)) {

                $output .= 'Please Enter Name Up 5 chars';

            }

            elseif ($_POST['email'] != $GLOBALS['email']) {

                if(preg_match('/^[a-zA-Z0-9_]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,4}$/', $_POST['email'])){

                    $query_check_email = 'select * from profile where email = "'.$_POST['email'].'" ';

                    $stmt_check = $conn->prepare($query_check_email);

                    $stmt_check->execute();

                    $row_count_check = $stmt_check->rowCount();

                    if($row_count_check > 0){

                        $output .= 'Email Already Used';
                    }

                    else{

                        $mail->addEmbeddedImage('../images/logo/favicon.ico','logo_site');

                        $encrypt_id = convert_id('encrypt',$_SESSION['username']);

                        $email_user_encrypt = convert_string('encrypt',$_POST['email']);

                        $url = 'http://' . $_SERVER['SERVER_NAME'] . '/engineer/verify.php?id=' .$encrypt_id . '&email='. $email_user_encrypt;

                        $html = $html ='<html lang="en">
                            <head>
                                <meta charset="UTF-8" />
                                <title>Change Email</title>
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
                                               
                                                    <h4> Hello '.$_SESSION['username'].' </h4>
                                                    
                                                    <p> You Have Request To Change Email Please Click To Button Down To Submit change :</p>
                        
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
                            
                            $mail->addAddress($_POST['email']);
                            $mail->Subject = 'Change Your Email';
                            $mail->Body = $html;

                            if ($mail->send() ) {

                                $output .= 'Go To Account To Submit E-mail';

                            } else {
                                $output .= 'Please Check Your Connection';
                            }

                        }catch(Exception $e){

                            $output .= 'Please Check Your Connection';
                        }

                    }
                }

                else{
                    $output .= 'Please Enter Valid E-Mail';
                }

            }

            elseif($address != ''){

                if(preg_match('/^[a-zA-Z0-9 ]{5,40}$/', $address)){

                    $query1 = 'update profile set name = "'.$name.'",address="'.$address.'",birth_date="'.$birth_date.'" where username = "'.$_SESSION['username'].'" ';

                    $stmt1 = $conn->prepare($query1);

                    $stmt1->execute();

                    $output .= '';
                }
                else{
                    $output .= 'Please Enter Address Up 5 Chars';
                }
            }

            else{

                $query1 = 'update profile set name = "'.$name.'",address="'.$address.'",birth_date="'.$birth_date.'" where username = "'.$_SESSION['username'].'" ';

                $stmt1 = $conn->prepare($query1);

                $stmt1->execute();

                $output .= '';
            }

            echo json_encode($output);
        }

        if($_POST['action'] == 'Update_Password'){

            $output = '';

            filter_var(parse_str($_POST['form'],$_POST),FILTER_SANITIZE_STRING);

            $query_check = 'select password from users where username = "'.$_SESSION['username'].'"';

            $stmt_check = $conn->prepare($query_check);

            $stmt_check->execute();

            $result_check = $stmt_check->fetchAll();

            foreach ($result_check as $check_password){

                if($check_password['password'] == base64_encode($_POST['current_password'])){

                    $query = 'update users set password = ? where username = "'.$_SESSION['username'].'" ';

                    $stmt = $conn->prepare($query);

                    $exe = array(base64_encode($_POST['new_password']));

                    $stmt->execute($exe);

                    $output .= '';
                }
                else{

                    $output .= 'Please Enter Correct Password';

                }
            };

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