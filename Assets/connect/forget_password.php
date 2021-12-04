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
    $mail->Subject = 'Reset Your Password';


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['action'])){

        $output = '';

        if($_POST['action'] == 'forget_password'){

            include 'connected.php';

            $forget_password = $_POST['forget_password'];

                if(preg_match('/^[a-zA-Z0-9@_.]{5,40}$/',$forget_password)){

                $query = 'select * from users join profile using(username) where (email = "'.$forget_password.'" or username = "'.$forget_password.'") and actived = 1 ';

                $stmt = $conn->prepare($query);

                $stmt->execute();

                $result = $stmt->fetchAll();

                $row = $stmt->rowCount();

                foreach ($result as $url){

                    $id = convert_id('encrypt',$url['ID']);

                    $token = convert_string('encrypt',$url['email']);

                    $time = convert_id('encrypt',date('h'));

                    $GLOBALS['username'] = $url['username'];

                    $GLOBALS['ID'] = $url['ID'];

                    $GLOBALS['email'] = $url['email'];

                    $url = 'http://' . $_SERVER['SERVER_NAME'] . '/reset.php?'. 'id=' . $id . '&token=' . $token .'&time=' . $time ;

                    $mail->addEmbeddedImage('../images/logo/favicon.ico','logo_site');

                    $html ='
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8" />
                        <title>Account recovery password</title>
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
                                line-height: 25px;
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
                                font-size: 13px;
                                font-weight: 600;
                                padding:10px;
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
                                            <h4>Dear '.$GLOBALS['username'].' </h4>
                                            <p>We received a request to reset Your password if you Want To Reset Password Please Click To Button Down :</p>
                                            <a href="'.$url.'" target="_blank">Click Here</a>
                                            <p>If you did not request this code, it is possible that someone else is trying to access Your Account .
                                                Do not forward or give this link to anyone.
                                            </p>
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
                }

                if(preg_match('/^[a-zA-z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]{2,4}$/',$forget_password)){

                    if($row > 0){
                        
                        foreach ($result as $value){

                            try{

                                $mail->setFrom('mbdalzym376@gmail.com', 'AskTheProff');

                                $mail->addAddress($value['email']);

                                $mail->Body = $html;

                                if($mail->send()){

                                    $url_api = '&id='. $GLOBALS['ID'] .'&token='. $GLOBALS['email'] . '&time=' . date('h');

                                    $query_check = 'update users set data_id = "'.$url_api.'" where username = "'.$GLOBALS['username'].'" and actived = 1';

                                    $conn->exec($query_check);

                                    $output .= 'Please Check Your Account To reset Your Password';
                                }
                                else{

                                    $output .= 'Please Check Your connection';
                                }

                            }catch (Exception $e){

                                $output .= 'Please Check Your connection';

                            };
                        }
                    }
                    else{

                        $output .= 'Email Not found';
                    }


                }
                else{

                    if($row > 0){

                        
                        foreach ($result as $value){

                            try{

                                $mail->setFrom('mbdalzym376@gmail.com', 'AskTheProff Team');

                                $mail->addAddress($value['email']);

                                $mail->Body = $html;

                                if($mail->send()){

                                    $url_api = '&id='. $GLOBALS['ID'] .'&token='. $GLOBALS['email'] . '&time=' . date('h');

                                    $query_check = 'update users set data_id = "'.$url_api.'" where username = "'.$GLOBALS['username'].'" and actived = 1';

                                    $conn->exec($query_check);
                                    
                                    $output .= 'Please Check Your Account To reset Your Password';
                                }
                                else{

                                    $output .= 'Please Check Your connection';
                                }

                            }catch (\Exception $e){

                                $output .= 'Please Check Your connection';
                            }
                        }
                    }

                    else{
                        $output .= 'UserName Not Found';
                    }
                }

            }

            else{
                $output .= 'Please Enter Valid Username Or Email';
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
