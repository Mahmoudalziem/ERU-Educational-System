<?php

    require 'Assets/connect/connected.php';

    include 'Assets/connect/header.php';

?>

<!-- Favicon -->
<title>All courses</title>

</head>
    <body>

<!--============= Header =================-->
    <?php echo include 'Assets/connect/headerPortfolio.php' ?>
<!--============= Header End =============-->

<!--============= Header banner ==================-->
    <div class="courses-show">
        <div class="show-content">
            <div class="container">
                <h3>
                    All Courses
                </h3>
                <ul class="content-nav">
                    <li>
                        <a href="index.php" target="_self">
                            <i class="fa fa-home"></i> Home
                        </a>
                    </li>
                    <li>
                        <div>
                            <i class="fa fa-long-arrow-right"></i> Courses List
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<!--============= Header banner End ===============-->

<!--============= Courses Content ===============-->
    <div class="all-courses-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-2 order-md-1">

                    <div id="overlay">
                        <div>
                            <img src="Assets/images/courses_loading/loading.gif" width="64px" height="64px"/>
                        </div>
                    </div>
                    
                    <div class="row" id="courses-wrapper">

                        <input type="hidden" name="rowcount" id="rowcount" />

                    </div><!-- End Row -->

                </div>
                <!-- End Column -->

                <div class="col-lg-3 col-12 order-1 order-md-2">

                    <div class="category-list sidebar-box" id="category-list">

                        <h3 class="widget_course_title">All Categories</h3>

                        <ul>

                            <li>
                                <a data-collapse="collapse" href="#collapse0" data-toggle="collapse" data-target="#collapse0" aria-expanded="true" class="active all">All Department</a>
                                <div class="collapse" id="collapse0" data-parent="#category-list" style="padding-left: 22px;"></div>
                            </li>

                            <?php
                                $query_department = 'select * from department order by depart_id';

                                $stmt_depart = $conn->prepare($query_department);

                                $stmt_depart->execute();

                                $result_depart = $stmt_depart->fetchAll();

                                foreach ($result_depart as $value_depart){

                                    echo '<li data-depart="'.convert_id('encrypt',$value_depart['depart_id']).'">
                                            <a data-collapse="collapse" href="#collapse'.$value_depart['depart_id'].'" data-toggle="collapse" data-target="#collapse'.$value_depart['depart_id'].'" aria-expanded="false">
                                                '.$value_depart['department_name'].'
                                                <i class="fa fa-angle-down"></i>
                                            </a>
                                            <div class="collapse collapse_semester" id="collapse'.$value_depart['depart_id'].'" data-parent="#category-list" style="padding-left: 22px;">';

                                    $query_semester = 'select * from semester where depart_id = "'.$value_depart['depart_id'].'"';

                                    $stmt_sem = $conn->prepare($query_semester);

                                    $stmt_sem->execute();

                                    $result_sem= $stmt_sem->fetchAll();

                                    foreach ($result_sem as $value_sem){
                                        echo '<a href="javascript:void(0)" data-semester="'.convert_id('encrypt',$value_sem['sem_id']).'">'.$value_sem['semester_name'].'</a>';
                                    }
                                }

                                echo '</div></li>';
                            ?>

                        </ul>
                    </div>




                        <?php
                            $query_popular = 'select * from courses order by RAND() limit 3 ';

                            $stmt_popular = $conn->prepare($query_popular);

                            $stmt_popular->execute();

                            $result_popular = $stmt_popular->fetchAll();

                            $rowCount_poplar = $stmt_popular->rowCount();

                            if($rowCount_poplar > 0){

                                echo '<div class="widget mb-45 latest_courses d-none d-md-block">

                                        <h3 class="widget_course_title">Popular Courses</h3>
                
                                        <ul class="latest-Posts">';

                                foreach ($result_popular as $value_popular){
                                    echo '<li>
                                        <div class="posts-image">
                                            <img src="courses_content/course_images/'.$value_popular['course_title'].'/'.$value_popular['course_image'].'" alt="popular_course">
                                        </div>
                                        <div class="posts-body">
                                            <h4><a href="single-course.php?id='.convert_id('encrypt',$value_popular['course_id']).'">'.$value_popular['course_title'].'</a></h4>
                                            <span>'.$value_popular['date_course'].'</span>
                                        </div>
                                    </li>';
                                }

                                echo '</ul>
                                        </div>';
                            }


                            ?>


                            <?php

                            if($rowCount_poplar > 0){
                                echo '<div class="widget popular_tages d-none d-md-block">

                                        <h3 class="widget_course_title">Popular Tags</h3>
                
                                        <ul class="tag">';

                                $array_tages = explode(',',$value_popular['course_tages']);

                                $count_array_tages = count($array_tages);

                                for ($x = 0; $x<$count_array_tages; $x++){

                                    echo '<li>'.'<a href="javascript:void(0)">'.@$array_tages[$x].'</a>' .'</li>';
                                };

                                echo '</ul>
                                         </div>';
                            }

                            ?>



                </div>
            </div>
        </div>
    </div>
<!--============= Courses Content End ============-->


<?php
    include 'Assets/connect/footer.php';
?>
<!-- MatchHeight -->
<script src="Assets/Js/jquery.matchHeight-min.js"></script>

    <script type="text/javascript">
        nicescroll();
        matchHeight();
        $('.all-courses-area .category-list ul li>a').on('click',function () {
         $(this).siblings().children().removeClass('active');
         $(this).addClass('active').parent().siblings().children('a').removeClass('active');
        });

        function getresult(url) {
            $.ajax({
                url: url,
                type: "GET",
                data:  {rowcount:$("div#courses-wrapper #rowcount").val()},
                beforeSend: function(){$("#overlay").show();},
                success: function(data){
                $("div#courses-wrapper").html(data);
                setInterval(function() {
                    $("#overlay").hide(); 
                },500);
            }

        });
        }

        getresult('Assets/connect/fetchCourses.php');
    </script>

    </body>
</html>