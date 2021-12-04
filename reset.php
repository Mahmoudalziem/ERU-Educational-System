<?php 

ob_start();

require 'Assets/connect/connected.php';

    if(isset($_GET)){

        if(isset($_GET['id']) && isset($_GET['token']) && $_GET['time']){

            $id = convert_id('decrypt',$_GET['id']);

            $email = convert_string('decrypt',$_GET['token']);

            $time = convert_id('decrypt',$_GET['time']);

            $query_check = 'select data_id from users where ID = "'.$id.'" ';

            $stmt_check = $conn->prepare($query_check);

            $stmt_check->execute();

            $result_check = $stmt_check->fetch();

            $rowCount_check = $stmt_check->rowCount();

            if($rowCount_check > 0){
                
                $data_id = $result_check['data_id'];

                if($data_id != null){

                    parse_str($data_id,$_CHECK);
                    
                    $id_check = $_CHECK['id'];

                    $email_check = $_CHECK['token'];

                    $time_check = $_CHECK['time'];

                    if($id_check == $id && $email_check == $email && $time_check == $time);

                    else{

                        header('Location: signIn.php');

                        ob_end_flush();
                    }
                }
                else{

                    echo die('<div style="padding:20px;background-color:#3b3e79;color:#fff;font-size:14px;font-weight:600;font-family:monospace"class="rest_pass">Your Link Expired Please rest Your Password Again</div>');

                    exit();
                }
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
    else{
        header('Location: signIn.php');
        ob_end_flush();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>

    <!--Meta tags-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- First Mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
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
                <div class="delete_content_account">
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
                                            <label>New Password *</label>
                                            <div class="username-input">
                                                <input autofocus placeholder="New Password" type="password" name="newPassword">
                                            </div>
                                        </div>
        
                                        <div>
                                            <label>Confirm Password *</label>
                                            <div class="password-input">
                                                <input type="password" placeholder="Confirm Password" name="confirmPassword">
                                            </div>
                                        </div>
        
                                        <div style="text-align: center" class="signIn">
                                            <input type="submit" value="Reset Password" name="new_password">
                                        </div>
        
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

        <!-- Jquery ==== -->
        <script src="Assets/Js/jquery-3.3.1.js"></script>
        <!-- Bootstrap -->
        <script src="Assets/Js/bootstrap.min.js"></script>
        <script>
            $(document).on('click','input[name="new_password"]',function(event){

                event.preventDefault();

                let regExp = /^[a-zA-Z0-9@_.#@]{6,50}$/;

                let id = '<?php echo $_GET['id']?>', 
                
                    action = 'resetPassword',

                    newPassword = $('input[name="newPassword"]').val(),

                    confirmPassword = $('input[name="confirmPassword"]').val();

                    if(newPassword == '' || confirmPassword == ''){

                        $('form.form_delete_account .error').html('Both Fields Are Required').addClass('display_block').removeClass('display_none');
                    }
                    else if(!regExp.test(newPassword)){

                        $('form.form_delete_account .error').html('Enter Valid Password Min {6}').addClass('display_block').removeClass('display_none');
                    }
                    else if(!regExp.test(confirmPassword)){

                        $('form.form_delete_account .error').html('Enter Valid Confirm Password Min {6}').addClass('display_block').removeClass('display_none');
                    }
                    else if(newPassword != confirmPassword){

                        $('form.form_delete_account .error').html('Both Fields Not Matched').addClass('display_block').removeClass('display_none');
                    }
                    else{
                        $.ajax({
                            url:'Assets/connect/newPassword.php',
                            method:'POST',
                            data:{action:action,newPassword:newPassword,id:id},
                            beforeSend:function(){
                                $('form.form_delete_account .error').html('Waiting .... ').addClass('display_block').removeClass('display_none');
                            },
                            success:function(data){

                                $('form.form_delete_account .error').html(data).addClass('display_block').removeClass('display_none');

                                setTimeout(() => {
                                    
                                    location.replace('signIn.php');
                                }, 800);                                
                            }
                        });
                    }
            });
        </script>
    </body>
</html>
    

    