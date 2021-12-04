
<?php

    session_start();

    include'Assets/connect/connected.php';

    /*
    if (isset($_SESSION['username'])) {
        if ($_SESSION['username'] != 'admin') {
            $query1 = 'select * from users where username = "'.$_SESSION['username'].'" actived = 1 and status = "user" ';

            $stmt1 = $conn->prepare($query1);

            $stmt1->execute();

            $result1 = $stmt1->fetch();

            $user_name = $result1['username'];

            echo '<script>location.replace("signIn.php?UN='.$_SESSION['username'].'")</script>';
        }
    } else {

        //echo '<script>location.replace("signIn.php")</script>';
    }
*/

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
        .search_form{
            margin-top:150px;
            width:100%;
        }
        .fetch_search_user{
            min-height:700px;
        }
        .search_form input[type="search"]{
            width:100%;
            padding:10px 15px;
            border:1px solid #3b3e79;
            outline:0;
            border-radius:20px 0;
            font-weight:600;
            font-size:14px;
        }
        .details_fetch_user{
            margin:30px 0;
            font-size:14px;
            font-weight:600;
            overflow:hidden;
        }
        .details_fetch_user .user_info{
            padding:20px 10px;
            border:1px solid #45487d;
            border-radius:20px 0;
        }
        .details_fetch_user .user_info .user_image{
            position:relative;
            width:65px;
            height:65px;
            border-radius:50%;
            border:2px solid #45487d;
            overflow: hidden;
        }
        .details_fetch_user .user_info .user_image img{
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
        }
        .details_fetch_user .user_info .user_details *{
            font-weight:600;
        }
        .details_fetch_user .user_info .user_details h3{
            font-size:14px;
        }
        .details_fetch_user .user_info .user_details p{
            font-size:12px;
            color:gray;
        }
        @media(max-width:576px){
            .details_fetch_user .user_info{
                text-align:center;
            }
            .details_fetch_user .user_info .user_image{
                margin-bottom:30px;
            }

            .details_fetch_user {
                margin: 30px 0;
            }
            .option_select li:first-child{
                margin-top:40px;
            }
        }

        .button_option{
            position: absolute;
            z-index:123;
            top: 0;
            right: 0;
            width: 30px;
            height: 30px;
            background-color: #45487d;
            border-radius: 0 0 0 10px;
            text-align: center;
            color:white;
            cursor: pointer;
            font-weight:600;
            border:1px solid #45487d;
        }
        .button_option:hover{
            background: white;
            color:#45487d;
        }
        .option_select{
            top:0;
            left:0;
            height:100%;
            border:1px solid #45487d;
            border-radius:20px 0;
            background-color:#45487d;
            transform:translateX(100%);
            transform-origin: right;
        }
        .option_select.active{
            transform:translateX(0);
        }
        .option_select >li{
            width:100%;
            padding:10px 20px;
            border:0;
            color:white;
            cursor: pointer;
            font-size:13px;
            font-weight:600;
        }
        .option_select li:hover{
            background-color:white;
            color:#45487d;
        }
        .not_found{
            font-weight: 600;
            font-size: 13px;
            margin: 50px auto;
            padding: 10px 15px;
            text-align: center;
            background: #45487d;
            color:white;
            border-radius: 0 20px;
        }
    </style>
    </head>
<body>
    
    <?php echo include 'Assets/connect/headerPortfolio.php'?>

    <div class="fetch_search_user">
    <div class="container">
        <div class="search_form">
            <form name="form" method="POST" action="">
                <input type="search" placeholder="Enter Username" name="search_user_name">
            </form>
        </div>

        <div class="fetch_users">
            <h3 class="wow fadeInLeft testmonials-header ml-auto">
                All Users
            </h3
            <div class="clear-both no-gutters"></div>
            <?php

            function showStatus($conn, $username)
            {
                $query = 'select status from users where username = ? and (actived = 1 or 0)';

                $stmt = $conn->prepare($query);


                $stmt->execute(array($username));

                $fetch = $stmt->fetch();
                
                if ($fetch['status'] == 'user') {
                    return 'make';
                } else {
                    return 'remove';
                }
            }
            
            function fetchProfile($conn)
            {
                $query = 'select username,name,avater_image,email from profile where username != "" order by ID';

                $fetch = $conn->prepare($query);

                $fetch->execute();

                $fetchAll = $fetch->fetchAll();

                $rowCount = $fetch->rowCount();

                if ($rowCount > 0) {
                    foreach ($fetchAll as $value) {
                        if (!function_exists('fetchImage')) {
                            function fetchImage($x)
                            {
                                return $x['avater_image'] != null ? "images_users/avaters/" . $x['username'] . '/' . $x['avater_image'] : "Assets/images/profiles/default_avater/default_avater.png";
                            }
                        }

                        if (!function_exists('show')) {
                            function show($conn, $x)
                            {
                                if (showStatus($conn, $x) == 'make') {
                                    return 'Do';
                                } else {
                                    return 'Undo';
                                }
                            }
                        }
                        
                        echo '<div class="col-xl-4 col-md-6 col-12">
                                        <div class="details_fetch_user position-relative">
                                            <div class="user_info d-md-flex">
                                                <div class="user_image mx-md-3 mx-auto mb-sm-4 mb-md-0">
                                                    <img src="'.fetchImage($value).'" alt="' . $value['username'] . '">
                                                </div>  
                                                <div class="user_details text-md-left text-center">
                                                    <h3 class="name">' . $value['name'] . '</h3>
                                                    <p class="username">@ ' . $value["username"] . '</p>
                                                    <p class="username text-center">'.$value['email']. '</p>
                                                </div>
                                            </div>
                                            
                                            <div class="button_option">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </div>
                                            
                                            <ul class="option_select w-100 position-absolute" data-user="'.convert_string('encrypt', $value['username']).'">
                                                <li class="'.showStatus($conn, $value['username']).'_mod">'.show($conn, $value['username']).' Moderator</li>
                                                <li class="delete_user">Delete User</li>
                                            </ul>
                                        </div>
                                    </div>';
                    }
                } else {
                    echo '<div class="not_found col-9">No Users Not Found</div>';
                }
            }

            ?>

        <div class="row user_search">
            <?php echo fetchProfile($conn); ?>
        </div>

        <div class="modal fade" id="Delete_make_user" tabindex="-1" role="dialog" aria-labelledby="Delete_make_user">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div id="delete_course" class="delete_user_or_make" data-user_name="">
                            <div>Do You Want To Delete Course ?</div>
                            <button class="button_delete_course">Yes</button>
                        </div>
                    </div><!-- end Body -->
                </div><!-- End content -->
            </div>
        </div>
    </div><!-- Container -->
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

            $('.search_form input[type="search"]').on('keydown',function(event){

                return event.key != "Enter";

            }).on('keyup', function (event) {    

                let  userName = $(this).val(),
                     action = 'fetchUser';
                $.ajax({
                    url: 'Assets/connect/userSearch.php',
                    method: 'POST',
                    data: { action: action,userName:userName },
                    success: function (data) {
                        $('.user_search').html(data);
                    }
                })

            });

            $(document).on('click','.button_option',function(){

               $(this).siblings('.option_select').toggleClass('active');
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

            var Delete_make_user = $('#Delete_make_user .modal-content .modal-body .delete_user_or_make'),

                change_text = $('#Delete_make_user .modal-content .modal-body .delete_user_or_make>div'),

                change_id_button = $('#Delete_make_user .modal-content .modal-body .delete_user_or_make>button');

            $(document).on('click','.option_select li.delete_user',function(){
                
                let username = $(this).parent().data('user');

                $('#Delete_make_user').modal('show');

                $(Delete_make_user).attr('data-user_name',username);

                $(change_text).text('Do You Want To Delete User ?');

                $(change_id_button).attr('id','delete_user');

            }).on('click','.option_select li.make_mod,.option_select li.remove_mod',function(){

                let username = $(this).parent().data('user');

                $('#Delete_make_user').modal('show');

                $(Delete_make_user).attr('data-user_name',username);

                if($(this).hasClass('make_mod')){

                        $(change_text).text('Do You Want To Do User Moderato ?');

                    }else{

                        $(change_text).text('Do You Want To Undo User Moderato ?');
                    }
                    

                $(change_id_button).attr('id','make_user_mod');
            });

            $(document).on('click', '#Delete_make_user #delete_user', function () {

                    let action = 'DeleteAccount',

                        username = $(this).parent().attr('data-user_name');

                    $.ajax({
                        url: 'Assets/connect/deleteAccount.php',
                        data: {
                            action: action,
                            username: username
                        },
                        method: 'POST',
                        beforeSend: function () {

                            $(this).text('Waiting');
                        },
                        success: function () {

                            $(this).text('Yes');

                            $('#Delete_make_user').modal('hide');

                            setTimeout(() => {

                                $('ul.option_select').each(function(){

                                    if($(this).data('user') == username){

                                        $(this).parent().parent().remove();
                                        
                                    }
                                });

                                if($('.fetch_search_user .user_search').children().length == 0){

                                    $('.user_search').append('<div class="not_found col-9">No Users Not Found</div>');    
                                }

                            },600);
                            
                        }
                    })
                }).on('click','#Delete_make_user #make_user_mod',function(){
                    
                    let username = $(this).parent().attr('data-user_name'),

                        status = '',

                        action = 'do_undo_mod';

                    $('ul.option_select').each(function(){

                        if($(this).data('user') == username){

                            if($(this).children('li:first').hasClass('make_mod')){

                                $(this).children('li:first').removeClass('make_mod').addClass('remove_mod');

                                $(this).children('li:first').text('Undo Moderator');

                                 status = 'make';

                            }else{

                                $(this).children('li:first').removeClass('remove_mod').addClass('make_mod');

                                $(this).children('li:first').text('Do Moderator');

                                status = 'remove';
                            }
                        }
                    });

                    $.ajax({
                        url:'Assets/connect/make_mod.php',
                        method:'POST',
                        data:{action:action,status:status,username:username},
                        beforeSend:function(){
                            $('this').text('Waiting');
                        },
                        success:function(){

                            $(this).text('Yes');

                            $('#Delete_make_user').modal('hide');
                        }
                    })
                });

        </script>
    </body>

</html>
    

    