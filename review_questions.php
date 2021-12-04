
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

    </head>
        <body>


        <div class="table_view_accept">
            <div class="container">
                <table class="table w-100 table_content table table-bordered table-sm table_content_video_file" style="border-collapse: separate; margin-top:30px; border:0">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th role="columnheader" scope="col">Question Title</th>
                            <th role="columnheader" scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            $query_fetch = 'select * from question_details where status="wait"';

                            $stmt = $conn->prepare($query_fetch);

                            $stmt ->execute();

                            $fetchAll = $stmt->fetchAll();

                            $rowCount = $stmt->rowCount();

                            if ($rowCount > 0) {
                                foreach ($fetchAll as $value_fetch) {
                                    echo '
                                        <tr data_username="'.convert_string('encrypt', $value_fetch['Q_title']).'">
                                            <td class="question_title">
                                                <a href="view_question.php?q_id='.convert_string('encrypt', $value_fetch['Q_title']).'" class="q_link" title="'.$value_fetch['Q_title'].'">'.$value_fetch['Q_title'].'</a>
                                            </td>
                                            <td class="text-center">
                                                <div class="action_button" data-q_user="'.convert_string('encrypt', $value_fetch['Q_title']).'">
                                                    <button class="accept_button">Accept</button>
                                                    <button class="reject_button">Reject</button>
                                                </div>
                                            </td>
                                        </tr>
                                    ';
                                }
                            } else {
                                echo '<tr class="empty_accept" class="text-center">
                                        <td colspan="2" class="dataTables_empty">No Questions Are Waiting yet</td>  
                                    </tr>';
                            }
                        ?>
                    </tbody>
                </table>

                <div class="modal fade" id="accept_q_reject" tabindex="-1" role="dialog" aria-labelledby="accept_q_reject">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div id="delete_course" class="accept_or_reject_question" data-user_name="">
                                    <div>Do You Want To Undo User Moderato ?</div>
                                    <button class="button_delete_course" id="accept_reject_button">Yes</button>
                                </div>
                            </div><!-- end Body -->
                        </div><!-- End content -->
                    </div>
                </div><!-- End Modal -->

            </div>
        </div>

        <?php echo include 'Assets/connect/headerPortfolio.php';?>

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
                    <!-- Bootstrap -->
                    <script src="Assets/Js/bootstrap.min.js"></script>
                    <!-- NiceScroll -->
                    <script src="Assets/Js/jquery.nicescroll.js"></script>
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
            
            <script>

                let change_text = $('div#accept_q_reject .modal-body div.accept_or_reject_question>div'),

                    change_id_button = $('div#accept_q_reject .modal-body div.accept_or_reject_question>button'),

                    accept_or_reject = $('div#accept_q_reject .modal-body div.accept_or_reject_question');

                $(document).on('click','div.action_button button.accept_button',function(){
                
                let username = $(this).parent().data('q_user');

                $('#accept_q_reject').modal('show');

                $(accept_or_reject).attr('data-user_name',username);

                $(change_text).text('Do You Want To Accept This Question ?');

                $(change_id_button).attr('id','accept_q_button');

                }).on('click','div.action_button button.reject_button',function(){

                    let username = $(this).parent().data('q_user');

                    $('#accept_q_reject').modal('show');

                    $(accept_or_reject).attr('data-user_name',username);

                    $(change_text).text('Do You Want To Delete This Question ?');

                    $(change_id_button).attr('id','reject_q_button');

                }).on('click','div.accept_or_reject_question button.button_delete_course',function(){

                    let username = $(this).parent().attr('data-user_name');
                    
                    if($(this).attr('id') == 'reject_q_button'){

                        let action = 'rejectQuestion';

                        $.ajax({
                            url:'Assets/connect/accept_reject.php',
                            method:'POST',
                            data:{action:action,username:username},
                            beforeSend:function(){

                                $(this).text('Waiting');
                            },
                            success:function(data){

                                if(data == ''){
                                 
                                    $('#accept_q_reject').modal('hide');

                                    $('div.table_view_accept table tbody tr').each(function(){

                                        if($(this).attr('data_username') == username){

                                            $(this).remove();
                                        }
                                    });
                                }

                                if($('div.table_view_accept table tbody').children('tr').length == 0){

                                    $('div.table_view_accept table tbody').html('<tr class="empty_accept"><td class="dataTables_empty" colspan="2">No Questions Are Waiting yet</td></tr>')
                                }
                            }
                        });
                    }
                    else if($(this).attr('id') == 'accept_q_button'){

                        let action = 'acceptQuestion';

                        $.ajax({
                            url:'Assets/connect/accept_reject.php',
                            method:'POST',
                            data:{action:action,username:username},
                            beforeSend:function(){
                                $(this).text('Waiting');
                            },
                            success:function(data){

                                if(data == ''){
                                 
                                    $('#accept_q_reject').modal('hide');

                                    $('div.table_view_accept table tbody tr').each(function(){

                                        if($(this).attr('data_username') == username){

                                            $(this).remove();
                                        }
                                    });
                                }

                                if($('div.table_view_accept table tbody').children('tr').length == 0){

                                    $('div.table_view_accept table tbody').html('<tr class="empty_accept"><td class="dataTables_empty" colspan="2">No Questions Are Waiting yet</td></tr>')
                                }

                            }
                        });
                    }
                })

            </script>
            </body>
    </html>