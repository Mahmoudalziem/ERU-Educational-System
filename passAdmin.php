
<?php

    session_start();
    
    include'Assets/connect/connected.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--Meta tags-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- First Mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Description -->
    <meta name="description" content="Engineering Site">
    <!-- Application-Name -->
    <meta name="application-name" content="Engineering Site">
    <!-- Author Name -->
    <meta name="author" content="Azima">
    <link rel="icon" href="Assets/images/logo/favicon.ico">
    <!--BootStrap -->
    <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
    <!-- Font-Awesome -->
    <link rel="stylesheet" href="Assets/css/font-awesome.css">
    <!--[if lt IE 9>
        <script src="Assets/Js/html5shiv.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="Assets/css/main.css">
    <!-- responsive -->
    <link rel="stylesheet" href="Assets/css/responsive.css">
    <style>
        .navbar-header{
            top:0
        }
        .delete_content_account{
            justify-content:center;
            align-items:center;
            padding:100px 0;
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
        .delete_content_account .update_password_admin{
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
            .alert-validate::after,
            .alert-validate::before{
                top:11px;
            }
        .delete_content_account .update_password_admin div{
            position:relative;
            margin-top:10px;
        }
        .delete_content_account .update_password_admin div label{
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
        .delete_content_account .update_password_admin input{
            width: 100%;
            padding: 7px 15px;
            margin-top: 5px;
            border: 1px solid #3b3e79;
            font-weight:600;
            font-size:14px;
            outline:0;
            border-radius:20px 0;
        }
        .delete_content_account .update_password_admin input[type="submit"]{
            margin-top:20px;
            color:#3b3e79;
        }
        .delete_content_account .update_password_admin input[type="submit"]:hover{
            background-color: #3b3e79;
            color:#fff;
            cursor:pointer;
        }
    </style>
    </head>
<body>
    <?php echo include 'Assets/connect/headerPortfolio.php';?>

        <div class="delete_content_account">

            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-md-6 col-12 justify-content-center">

                        <div class="logo-site mx-auto">
                            <a href="javascript:void(0)" target="_self">
                                <img src="Assets/images/logo/icon.png" class="align-items-center" alt="avater_sigIn_image">
                            </a>
                        </div>

                        <form class="update_password_admin" name="update_password_admin">

                            <div class="validate_password error"></div>
                            <div class="">
                                <label>Current Password</label>
                                <div class="position-relative" data-validate="Password Is Required">
                                    <input class="input_100" name="current_password" type="password" placeholder="Current Password">
                                </div>
                            </div>

                            <div class="new_password">
                                <label>New Password</label>
                                <div class="position-relative" data-validate="New Password Required">
                                    <input class="input_100" name="new_password" type="password" placeholder="New Password (min 6 chars)">
                                </div>
                            </div>


                            <div class="confirm+password">
                                <label>Confirm New Password</label>
                                <div class="position-relative" data-validate="Confirm Password Required">
                                    <input class="input_100" name="confirm_password" type="password" placeholder="Confirm New Password">
                                </div>
                            </div>

                            <div class="button_submit">
                                <input type="submit" value="Save & Update" name="update_password">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>



<!-- ========== Footer Section ============-->
<div class="footer-section">
        <span>All right Reserved <?php echo date('Y')?> @ Ask The Proff </span>
        <span>Desgined With Love By @ <a href="https://www.facebook.com/Alziem2" target="_blank" title="Developper Page 
        Facebook">Eng/AZIMA</a></span>
    </div>
<!--========== End Footer Section ==========-->

<!--============== Loader Start ==============-->
    <div class="preloader">
        <div class="loader loader-1">
            <div class="loader-outter"></div>
            <div class="loader-inner"></div>
        </div>
    </div>
<!--============== Loader End ==============-->

    <!-- Jquery ==== -->
    <script src="Assets/Js/jquery-3.3.1.js"></script>
    <!-- Bootstrap -->
    <script src="Assets/Js/bootstrap.min.js"></script>
    <!-- NiceScroll -->
    <script src="Assets/Js/jquery.nicescroll.js"></script>
    <script>

        $(window).on('load', function() {

        $('.preloader').fadeOut(300);

        });

        $('.input_100').each(function(){

        $(this).on('blur', function(){

            if($(this).val().trim() !== "") {

                $(this).addClass('has-val');
            }

            else {
                $(this).removeClass('has-val');
            }
        })
        });


        let input = $('div .input_100');

        $(input).each(function(){

        $(this).focus(function(){

            hideValidate(this);

        });
        });

        function showValidate(input) {

        let thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
        };

        function hideValidate(input) {

        let thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
        }

        $('html').niceScroll({
            zindex: 13253252,
            cursorborder: 0,
            background: "white",
            cursorcolor: "#3b3e79",
            cursorwidth: "10px",
            border: 0,
            overflowX: 'hidden',
            cursorborderradius: 0,
        });

        $('.navbar-header .menu-left .menu-left-dropdown').on('click',function () {

        $('.navbar-header .menu-left .column').toggleClass('show');

        });


        $(document).on('click', '.button_submit input[name="update_password"]', function (event) {

            event.preventDefault();

            let action = 'resetPasswordAdmin',

                form = $('form.update_password_admin').serialize(),

                check = true;

            for (let i = 0; i < input.length; i++) {

                if ($(input[i]).val().trim() === '') {

                    showValidate(input[i]);

                    check = false;
                }

                else {

                    hideValidate(input[i]);

                    check = true;
                }
            }

            if (check == false) {

                $('.validate_password').addClass('display_none').removeClass('display_block');

                $('.validate_password').addClass('display_none').removeClass('display_block');
            }
            else {
                let new_password = $('input[name="new_password"]').val(),

                    con_password = $('input[name="confirm_password"]').val(),

                    regExp = /^[a-zA-Z0-9._@#]{6,20}$/;

                if (regExp.test(new_password)) {

                    if (new_password != con_password) {

                        $('.validate_password').html('New And Confirm Must Be Matched').addClass('display_block').removeClass('display_none');
                    }
                    else {
                        $.ajax({
                            url: 'Assets/connect/newPassword.php',
                            method: 'POST',
                            dataType: 'JSON',
                            data: { action: action, form: form},
                            beforeSend: function () {

                                $('.validate_password').html('Waiting ... ').addClass('display_block').removeClass('display_none');
                            },
                            success: function (data) {
                                if (data == '') {

                                    $('.validate_password').html('Password Updated').addClass('display_block').removeClass('display_none');

                                    $('input[name="new_password"]').val('');

                                    $('input[name="confirm_password"]').val('');

                                    $('input[name="current_password"]').val('');

                                    setTimeout(() => {

                                        $('.validate_password').html('').addClass('display_none').removeClass('display_block');

                                    }, 800);
                                }
                                else {
                                    $('.validate_password').html(data).addClass('display_block').removeClass('display_none');
                                }

                            }
                        });
                    }
                }
                else {
                    $('.validate_password').html('New Password At Least 6 Chars').addClass('display_block').removeClass('display_none');
                }


            }

            });

            $(document).on('click', 'a#logoOut,li.logo_out_admin', function () {

                let action = 'logoOut';

                $.ajax({
                    url: 'Assets/connect/logoOut.php',
                    method: 'POST',
                    data: { action: action },
                    success: function () {
                        location.replace('signIn.php');
                    }
                });
            });
        </script>
    </body>
</html>
    

    