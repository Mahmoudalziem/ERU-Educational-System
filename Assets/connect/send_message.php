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
$mail->isHTML(true);
$mail->Subject = 'Contact Us Message';


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['action'])){

        $output = '';

        $f_name = $_POST['f_name'];

        $l_name = $_POST['l_name'];

        $email_name = $_POST['email_name'];

        $message_send= $_POST['message_area'];

        if($_POST['action'] == 'send_message'){
            
            include 'connected.php';

            if(preg_match('/^[a-zA-z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]{2,4}$/',$email_name)){

                try{

                    $mail->addEmbeddedImage('../images/logo/favicon.ico','logo_site');

                        $html = $html ='<html lang="en">
                            <head>
                                <meta charset="UTF-8" />
                                <title>Contact Us Message</title>
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
                                    .details_user{
                                        width:100%;
                                        height:70px;
                                        padding-top:13px;
                                        background-color:#101461b8;
                                        z-index: 1;
                                        color:#fff;
                                        margin-bottom:30px;
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
                                        color:#52558d;
                                    }
                                    .content_message .content_body span{
                                        display:inline-block;
                                        width:70px;
                                    }
                                    
                                    .content_message .content_body p{
                                        margin-top:10px;
                                        font-size:13px;
                                        font-weight:600;
                                        display:flex;
                                        text-align:left;
                                    }
                                    .content_message .content_body p span{
                                        width:350px;
                                    }
                                    .details_user div{
                                        padding:0 20px;
                                        font-weight:600;
                                        font-size:13px;
                                        text-decoration:none;
                                        line-height:25px;
                                    }
                                    .details_user div a{
                                        color:#fff;
                                    }
                                    .details_user div span{
                                        display:inline-block;
                                        width:80px;
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
                                                    <h4> <span>From :</span> '.$f_name . ' ' . $l_name.'</h4>
                                                    <p><span>Message :</span> '.$message_send.'</p>
                                                </div>

                                                <div class="details_user">
                                                    <div class="username"><span>UserName :</span> '.$f_name.'</div>
                                                    <div class="uEmail"><span>Email : </span>'.$email_name.'</div>
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

                    $mail->setFrom($email_name, $f_name . ' ' . $l_name);

                    $mail->addAddress('mbdalzym376@gmail.com','AskTheProff Team');

                    $mail->Body = $html;

                    if($mail->send()){

                        $output .= 'ok';
                    }

                    else{
                        $output .= 'Please Check Your connection';
                    }

                }catch (Exception $e){

                    $output .= 'Please Check Your connection';
                };

            } else{

                $output .= 'Please Enter correct Email';
            }
        }


        echo json_encode($output);
    }else{
        header('Location: signIn.php');
    }
}

else{
    header('Location: signIn.php');
}
