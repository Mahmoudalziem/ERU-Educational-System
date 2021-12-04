<?php
    ob_start();
?>
<!DOCTYPE html>

<html lang="en">
    <head>

        <!--Meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- First Mobile -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Delete Account</title>
        <!--BootStrap -->
        <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
        <style>
            .delete_content_account{
                justify-content:center;
                align-items:center;
                margin-top:60px;
            }
            .delete_content_account div.logo-site{
                width: 60px;
                height: 60px;
                border-radius: 50%;
                border: 3px solid #101461b8;
                overflow: hidden;
                margin-top:60px;
            }
            .delete_content_account div.logo-site a{
                text-decoration:none;
                background-color:transparent;
                display:block;
                width:100%;
                height:100%;
            }
            img {
                max-width: 100%;
                pointer-events: none;
                width:37px;
                margin-top:5px;
                margin-left:9px;
            }
            .delete_content_account .form_delete_account{
                text-align: left;
                padding: 0 20px;
                width: 100%;
                height: 100%;
            }
            .error {
                    width: 80%;
                    background-color: #3b3e79;
                    margin: 10px auto 0;
                    text-align: center;
                    line-height: 40px;
                    color: #fff;
                    font-size: 13px;
                    display: none;
                    font-weight: 600;
                }
            .delete_content_account .form_delete_account div{
                position:relative;
                margin-top:10px;
            }
            .delete_content_account .form_delete_account div label{
                margin-top: 10px;
                font-weight:600;
                font-size:14px;
                color: #3b3e79;
                
            }
            .display_block{
                display:block;
            }
            .display_none{
                display:none;
            }
            .delete_content_account .form_delete_account input{
                width: 100%;
                padding: 10px 15px;
                margin-top: 5px;
                border: 1px solid #3b3e79;
                font-weight:600;
                font-size:14px;
                outline:0;
                border-radius:20px 0;
            }
            .delete_content_account .form_delete_account input[type="submit"]{
                margin-top:20px;
                color:#3b3e79;
            }
            .delete_content_account .form_delete_account input[type="submit"]:hover{
                background-color: #3b3e79;
                color:#fff;
                cursor:pointer;
            }
        </style>
    </head>
    <body>
        <?php

            include 'Assets/connect/connected.php';

            if($_SERVER['REQUEST_METHOD'] == 'GET'){

                if(isset($_GET['id']) && isset($_GET['token'])){

                    $id = convert_id('decrypt',$_GET['id']);

                    $username = convert_string('decrypt',$_GET['token']);

                    $username = strtolower($username);

                    $query_check = 'select * from users where ID = ? and username = ? and actived = 1 and status = "user"';

                    $stmt_check = $conn->prepare($query_check);

                    $execute_check = array($id,$username);

                    $stmt_check->execute($execute_check);

                    $rowCount_check = $stmt_check->rowCount();

                    if($rowCount_check > 0){

                        header('Location: signIn.php');

                        ob_end_flush();
                    }
                    else{

                        $query_user = 'select * from users where ID = ? and username = ? and actived = 0 and status = "user"';

                        $stmt_user = $conn->prepare($query_user);

                        $execute_user = array($id,$username);

                        $stmt_user->execute($execute_user);

                        $rowCount_user = $stmt_user->rowCount();
                        
                        $result_user = $stmt_user->fetch();

                        if($result_user['ID'] == $id && $result_user['username'] == $username){

                            if($rowCount_user > 0){

                                $query_update = 'update users set actived = 1 where ID  = ? and username = ? ';

                                $stmt_update = $conn->prepare($query_update);

                                $execute_update = array($id,$username);

                                $stmt_update->execute($execute_update);

                                echo die('<div style="padding:20px;background-color:#3b3e79;color:#fff;font-size:14px;font-weight:600;font-family:monospace"class="rest_pass">Your Account Now Actived Please Login To Enter Your Profile</div>');

                                exit();
                            }
                            else{

                                header('Location: signIn.php');

                                ob_end_flush();
                            }

                        }
                        else{
                            header('Location: signIn.php');

                            ob_end_flush();
                        }   
                    }
                }if(isset($_GET['id']) && isset($_GET['name'])){

                    /********************Delete Account  ***********/

                    $username = convert_id('decrypt',$_GET['id']);

                    $email = convert_string('decrypt',$_GET['name']);

                    $query_check = 'select * from profile where username = ? and email = ?';

                    $stmt_check = $conn->prepare($query_check);

                    $execute_check = array($username,$email);

                    $stmt_check->execute($execute_check);

                    $rowCount_check = $stmt_check->rowCount();
                    
                    $result_user = $stmt_check->fetch();

                if( $email == $result_user['email'] && $username == $result_user['username']){

                    echo '<div class="delete_content_account">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-md-5 col-12 justify-content-center">
                    
                                            <div class="logo-site mx-auto">
                                                <a href="index.php" target="_self">
                                                    <img src="Assets/images/logo/icon.png" class="align-items-center" alt="avater_sigIn_image">
                                                </a>
                                            </div>
                    
                                            <form class="form_delete_account" name="form_delete_account">
                                                    <div class="error validate"></div>
                    
                                                    <div>
                                                        <label>UserName *</label>
                                                        <div class="username-input">
                                                            <input autofocus placeholder="UserName" type="text" name="username_delete">
                                                        </div>
                                                    </div>
                    
                                                    <div>
                                                        <label>Password *</label>
                                                        <div class="password-input">
                                                            <input type="password" placeholder="Password" name="password_delete">
                                                        </div>
                                                    </div>
                    
                                                    <div style="text-align: center" class="signIn">
                                                        <input type="submit" value="Delete Account" name="delete_account">
                                                    </div>
                    
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            }else{

                                header('Location: signIn.php');

                                ob_end_flush();
                            }
                        }
                        if(isset($_GET['id']) && isset($_GET['email'])){

                            $username = convert_id('decrypt',$_GET['id']);

                            $email = convert_string('decrypt',$_GET['email']);

                            if(preg_match('/^[a-zA-Z0-9_]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,4}$/', $email)){

                                $query_update = 'update profile set email = "'.$email.'" where username = "'.$username.'"';

                                $conn->exec($query_update);

                                echo die('<div style="padding:20px;background-color:#3b3e79;color:#fff;font-size:14px;font-weight:600;font-family:monospace"class="rest_pass">Your Email Updated</div>');

                                exit();

                            }else{

                                session_start();
                                
                                if(isset($_SESSION['username']) != 'admin'){

                                    header('Location: portfolio.php?UN=' . $_SESSION['username']);

                                    ob_end_flush();
                                }
                                else{

                                    header('Location: signIn.php');

                                    ob_end_flush();
                                }
                            }

                            
                        }
                    }

                    else{

                        header('Location: signIn.php');

                        ob_end_flush();
                    }
                    
        ?>


        <!-- Jquery ==== -->
        <script src="Assets/Js/jquery-3.3.1.js"></script>
        <!-- Bootstrap -->
        <script src="Assets/Js/bootstrap.min.js"></script>
        <script>
            $(document).on('click','input[name="delete_account"]',function(event){

                event.preventDefault();

                
                let regExp_username = /^[a-zA-Z0-9@_.]{5,18}$/,

                    regExp_password = /^[a-zA-Z0-9@_.#@]{6,50}$/;

                let action = 'DeleteAccount',

                    username_delete = $('input[name="username_delete"]').val(),

                    password_delete = $('input[name="password_delete"]').val();

                    if(username_delete == '' || password_delete == ''){

                        $('form.form_delete_account .error').html('Both Fields Are Required').addClass('display_block').removeClass('display_none');
                    }
                    else if(!regExp_username.test(username_delete)){

                        $('form.form_delete_account .error').html('Enter Valid UserName Min {5} chars').addClass('display_block').removeClass('display_none');
                    }
                    else if(!regExp_password.test(password_delete)){

                        $('form.form_delete_account .error').html('Enter Valid Password Min {6}').addClass('display_block').removeClass('display_none');
                    }
                    else{
                        $.ajax({
                            url:'Assets/connect/deleteAccount.php',
                            method:'POST',
                            dataType:'JSON',
                            data:{action:action,username_delete:username_delete,password_delete:password_delete},
                            beforeSend:function(){
                                $('form.form_delete_account .error').html('Waiting .... ').addClass('display_block').removeClass('display_none');
                            },
                            success:function(data){
                                if(data == '')   {
                                    
                                    $('form.form_delete_account .error').html('Account Deleted Success').addClass('display_block').removeClass('display_none');

                                    setTimeout(() => {
                                        
                                        location.replace('signIn.php');
                                    }, 800);

                                }
                                else{

                                    $('form.form_delete_account .error').html(data).addClass('display_block').removeClass('display_none');

                                }
                                
                            }
                        });
                    }
            });
        </script>
    </body>
</html>