<?php

session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(isset($_POST['action'])){

            include 'connected.php';

            $output = '';

            if(isset($_SESSION['username'])){

                if($_POST['action'] == 'enroll_course'){

                    $id = $_POST['id'];
    
                    $username = $_SESSION['username'];
    
                    $id = convert_id('decrypt',$id);
    
    
                    $query_check = 'select * from profile where username = "'.$username.'" ';
    
                    $stmt_check = $conn->prepare($query_check);
    
                    $stmt_check->execute();
    
                    $result_check = $stmt_check->fetch();
            
                    $array = [];
    
                    $array_check_alter = explode(',',$result_check['watchlist']);
    
                    for($x=0;$x<count($array_check_alter);$x++){
    
                        array_push($array,$array_check_alter[$x]);
    
                    }
    
    
                    if(in_array($id,$array)) {
    
                        $output .= 'Course Already Added';
    
                    }
    
                    else{
    
                        if($result_check['watchlist'] == 0){
    
                            $watchlist_new =  $id ;
    
                            $query_insert = 'update profile set watchlist = ? where username = "'.$username.'" ';
    
                            $stmt_insert = $conn->prepare($query_insert);
    
                            $exe_array = array($watchlist_new);
    
                            $stmt_insert->execute($exe_array);
    
                            $output .= 'Course Added';    
                        }
    
                        else{
    
                            $watchlist_new = $result_check['watchlist'] . ',' . $id ;
    
                            $query_insert = 'update profile set watchlist = ? where username = "'.$username.'" ';
    
                            $stmt_insert = $conn->prepare($query_insert);
    
                            $exe_array = array($watchlist_new);
    
                            $stmt_insert->execute($exe_array);
    
                            $output .= 'Courses Added';
                        }
                        
                        
                    }
                }
                else{
                     $output .= 'Please LogIn To Add Course To Your Account';
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