<?php

    session_start();

    require 'Assets/connect/connected.php';
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--Meta tags-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- First Mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <title>Portfolio</title>
    <!-- Application-Name -->
    <meta name="application-name" content="Engineering Site">
    <!-- Author Name -->
    <meta name="author" content="Azima">
    <link rel="icon" href="Assets/images/logo/favicon.ico">
    <!--BootStrap -->
    <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
    <!-- Font-Awesome -->
    <link rel="stylesheet" href="Assets/css/font-awesome.css">
    <!--DataTable -->
    <link rel="stylesheet" href="Assets/css/jquery.dataTables.min.css">
    <!-- Editor Css -->
    <link rel="stylesheet" href="Assets/css/editor.css">
    <!--[if lt IE 9>
        <script src="Assets/Js/html5shiv.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="Assets/css/main.css">
    <!-- responsive -->
    <link rel="stylesheet" href="Assets/css/responsive.css">
</head>
    <body>

    
<!--============= Header =================-->
    <?php echo include 'Assets/connect/headerPortfolio.php' ?>
<!--============= Header End =============-->

    <div class="questions">
        <div class="container">
            <div class="q_content">

                <div class="row_question">
                    <div class="ask_question">
                        <button class="question_button">Ask Question</button>
                    </div>

                    <div class="question_option">
                        <select class="form-control" name="depart_name_notify">
                            <option value="<?php echo convert_string('encrypt', 'all');?>" selected="">All Department</option>
                            <option value="<?php echo convert_string('encrypt', 1)?>">Preporatory</option>
                            <option value="<?php echo convert_string('encrypt', 2)?>">Telecomunication</option>
                            <option value="<?php echo convert_string('encrypt', 3)?>">Mechatronics</option>
                            <option value="<?php echo convert_string('encrypt', 4)?>">Construction</option>                                                            
                        </select>
                    </div>
                </div><!-- End Row -->

                <table id="q_table" class="hover table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Q Title</th>
                            <th>Q Field</th>
                            <th>Q username</th>
                        </tr>
                    </thead>

                    <tbody class="text-center">

                        <?php

                            function fetch_depart($x)
                            {
                                switch ($x) {
                                    case '1':return 'Preporatory';break;
                                    case '2':return 'Telecomunication';break;
                                    case '3':return 'Mechatronics';break;
                                    case '4':return 'Construction';break;
                                }
                            }
                            $output = '';

                            $query_all = 'select * from question_details where status = "accept" order by Q_ID';

                            $stmt_all = $conn->prepare($query_all);

                            $stmt_all->execute();

                            $fetch_all = $stmt_all->fetchAll();

                            $rowCount = $stmt_all->rowCount();

                            if ($rowCount > 0) {
                                foreach ($fetch_all as $fetch_value) {
                                    $output .= '<tr>
                                                <td class="td_q_link">
                                                    <a href="view_question.php?q_id='.convert_string('encrypt', $fetch_value['Q_title']).'" class="q_link" title="'.$fetch_value['Q_title'].'">'.$fetch_value['Q_title'].'</a>
                                                </td>
                                                <td class="q_field">'.fetch_depart($fetch_value['Q_field']).'</td>
                                                <td class="q_username">'.$fetch_value['Q_username'].'</td>         
                                            </tr>';
                                }
                            } else {
                                $output .= '<tr>
                                                <td valign="top" colspan="3" class="dataTables_empty">No record Are found</td>  
                                                <td></td>
                                                <td></td>
                                            </tr>';
                            }

                            echo $output;
                        ?>
                    </tbody>
                </table>
            </div>
        </div><!-- end container -->
    </div>
    

                        <div class="container_ask_question">
                            <div class="back_overflow"></div>
                            <div class="question_push mx-auto">
                                <div class="q_close">
                                    <i class="fa fa-times"  aria-hidden="true"></i>
                                </div>
                                <div class="clear-both"></div>
                                <form class="form_question_push" name="form_question_push" method="POST" action="">
                                    <div class="error validate"></div>

                                    <div class="course_title">
                                        <label for="title" class="control-label">Question Title *</label>
                                        <div class="form-control-counter-container question_title_input">
                                            <input  type="text" placeholder="Insert Question Title" onkeyup="limit(this)"  name="title" maxlength="120" id="title" class="form-control" value="">
                                            <div class="form_control_counter counter" data-purpose="form-control-counter">
                                                120
                                            </div>
                                        </div>
                                    </div>

                                    <div class="sub_info">
                                        <label for="sub_info" class="control-label"> Question Info *</label>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <select class="form-control language question_lang_select" name="language_course">
                                                        <option value="select_language" selected="">-- Language --</option>
                                                        <option value="english">English</option>
                                                        <option value="arabic">Arabic</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <select class="form-control question_depart_select" name="depart_name">
                                                        <option value="-- Select Depart --" selected="">-- Select Depart --</option>
                                                        <option value="<?php echo convert_string('encrypt', 1)?>">Preporatory</option>
                                                        <option value="<?php echo convert_string('encrypt', 2)?>">Telecomunication</option>
                                                        <option value="<?php echo convert_string('encrypt', 3)?>">Mechatronics</option>
                                                        <option value="<?php echo convert_string('encrypt', 4)?>">Construction</option>
                                                                                                            
                                                    </select>
                                                </div>

                                                
                                            </div><!-- End Row -->
                                        </div><!-- End Column -->
                                    </div><!-- End Sub_info -->


                                    <div class="form-group ">
                                        <label for="question_content" class="control-label">Question Content *</label>
                                        <textarea id="question_content" class="question_content" placeholder="Your Message"></textarea>
                                    </div>

                                    <div class="form-group align-items-center text-center">
                                        <input type="submit" value="Publish" class="publish_question">
                                    </div>
                                </form>
                            </div>
                        </div>
            <?php
                if ($_SESSION['username'] != 'admin') {
                    include 'Assets/connect/footer.php';

                    echo '<script type="text/javascript">
                                nicescroll();
                                dropdown();
                            </script>';
                } else {
                    echo '
                    <!-- Jquery ==== -->
                    <script src="Assets/Js/jquery-3.3.1.js"></script>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
                    <!-- propper -->
                    <script src="Assets/Js/popper.js"></script>
                    <script src="Assets/Js/tooltip.js"></script>
                    <!-- Bootstrap -->
                    <script src="Assets/Js/bootstrap.min.js"></script>
                    <!-- NiceScroll -->
                    <script src="Assets/Js/jquery.nicescroll.js"></script>
                    <script src="Assets/Js/contact_send.js"></script>
                    <script>

                    $(window).on("load", function() {

                        $(".preloader").fadeOut(300);

                    });        

                    $(".navbar-header .menu-left .menu-left-dropdown").on("click",function () {

                        $(".navbar-header .menu-left .column").toggleClass("show");

                    });
                    $("html").niceScroll({
                        zindex: 13253252,
                        cursorborder: 0,
                        background: "white",
                        cursorcolor: "#3b3e79",
                        cursorwidth: "10px",
                        border: 0,
                        overflowX: "hidden",
                        cursorborderradius: 0,
                    });


                        $(document).on("click", "a#logoOut,li.logo_out_admin", function () {

                            let action = "logoOut";

                            $.ajax({
                                url: "Assets/connect/logoOut.php",
                                method: "POST",
                                data: { action: action },
                                success: function () {
                                    location.replace("signIn.php");
                                }
                            });
                        });
                    </script>';
                }
            ?>   
            
            <script src="Assets/Js/jquery.dataTables.min.js"></script>  
            <!-- Editor -->
            <script src="Assets/Js/editor.js"></script>
            <script>

                $("#question_content").Editor();

                ///////////

                $('#q_table').DataTable();

                $('.row_question .ask_question button.question_button, .container_ask_question .back_overflow, .question_push .q_close').on('click',function(){

                    $('.container_ask_question .back_overflow').toggleClass('active');
                    
                    $('.container_ask_question .question_push').toggleClass('active');
                });


                function limit(limit) {

                let max_title = 120;

                len = $(limit).val().length;

                if (len >= max_title) {

                    if($(limit).attr('maxlength') == 120){

                        $('.form_control_counter').text(0);
                    }

                } else {

                    let char_title = max_title - len;

                    if($(limit).attr('maxlength') == 120){

                        $('.form_control_counter').text(char_title);
                    }
                }
            }   
            //$('#menuBarDiv_question_content .btn-group:nth-child(1)').remove();
            //$('#menuBarDiv_question_content .btn-group:nth-child(5)').remove();
            //$('#menuBarDiv_question_content .btn-group:nth-child(3)').remove();
            </script>        
    </body>

</html>