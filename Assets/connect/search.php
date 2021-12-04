<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        require 'connected.php';

        $output = '';

        function test_input($input){

            trim($input);
        
            htmlspecialchars($input);
        
            stripcslashes($input);
        
            return $input;
        }

        if(isset($_POST['action'])){

            if($_POST['action'] == 'searchInput'){

                @$array_tags_input = test_input($_POST['tags_input']);

                $array = [];

                if(is_array($array_tags_input)){

                    foreach($array_tags_input as $key=>$value){

                        $array[] = filter_var($value,FILTER_SANITIZE_STRING);
                    }
                }

                if($array_tags_input == null){

                    $output .= '<li>Please Enter Course Tags</li>';
                    
                }
                else{
                    $array_tags = implode($array_tags_input,'|');

                    $query_check = 'select * from courses where course_tages  regexp "'.$array_tags.'"';

                    $stmt_check = $conn->prepare($query_check);

                    $stmt_check->execute();

                    $result_check = $stmt_check->fetchAll();

                    $rowCount = $stmt_check->rowCount();

                    if($rowCount == 0){
                        $output .= '<li>No course found</li>';
                    }
                    else{

                        function rating($conn,$id){

                            $query = 'select * from courses_rating where course_id = ?';

                            $stmt = $conn->prepare($query);

                            $execute = array($id);

                            $stmt->execute($execute);

                            $rowCount = $stmt->rowCount();

                            if($rowCount == 0){

                                return '0' . ' Review(s)';
                            }
                            else{

                                return $rowCount . ' Review(s)';
                            }
                            
                        }

                        foreach($result_check as $value){

                            $output .='<li>
                                        <div class="posts-image">
                                            <img src="courses_content/course_images/'.$value['course_title'].'/'.$value['course_image'].'" alt="popular_course">
                                        </div>
                                        <div class="posts-body">
                                            <h4><a href="single-course.php?id='.convert_id('encrypt',$value['course_id']).'">'.$value['course_title'].'</a></h4>
                                            <div class="review_search">
                                                <span class="star d-inline-block">
                                                    <span class="yes"><i class="fa fa-star"></i></span>
                                                    <span class="yes"><i class="fa fa-star"></i></span>
                                                    <span class="yes"><i class="fa fa-star"></i></span>
                                                    <span class="yes"><i class="fa fa-star"></i></span>
                                                    <span class="yes"><i class="fa fa-star-half-o"></i></span>
                                                </span>
                                                <span>'.rating($conn,$value['course_id']).'</span>
                                            </div>
                                            <span>'.$value['date_course'].'</span>
                                        </div>
                                    </li>';
                        }
                    }
                }
            }
                

            echo $output;
        }
        else{
            header('Location: signIn.php');
        }
    }
    else{
        header('Location: signIn.php');
    }