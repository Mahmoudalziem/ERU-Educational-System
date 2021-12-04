    <?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(isset($_POST['action'])){

            require 'connected.php';

            if($_POST['action'] == 'resetPassword'){

                $id = convert_id('decrypt',$_POST['id']);

                $newPassword = $_POST['newPassword'];

                $query_check = 'select * from users where ID = "'.$id.'"';

                $stmt_check = $conn->prepare($query_check);

                $stmt_check->execute();

                $result_check = $stmt_check->fetch();

                $rowCount_check = $stmt_check->rowCount();

                if($rowCount_check > 0){

                    $query_update = 'update users set password = ? , data_id = ? where ID = ? and actived = 1 and status = "user"';

                    $stmt_update = $conn->prepare($query_update);

                    $newPassword = base64_encode($newPassword);

                    $execute_array = array($newPassword,null,$id);

                    $stmt_update->execute($execute_array);

                    session_start();

                    $destory = array_keys($_SESSION);

                    foreach($destory as $unset){

                        unset($_SESSION[$unset]);
                    }

                    session_destroy();
                    
                    session_write_close();

                    setcookie(session_name(),'',0,'/');
                    
                }
            }
            if($_POST['action'] == 'resetPasswordAdmin'){

                 parse_str($_POST['form'],$_POST);

                 $output = '';

                $current = $_POST['current_password'];

                $current = base64_encode($current);

                $newPassword = $_POST['new_password'];

                $query_check = 'select * from users where actived = "2" and status = "admin"';

                $stmt_check = $conn->prepare($query_check);

                $stmt_check->execute();

                $result_check = $stmt_check->fetch();

                $rowCount_check = $stmt_check->rowCount();

                if($rowCount_check > 0){

                    if($result_check['password'] == $current){

                        $newPassword = base64_encode($newPassword);

                        $query_update = 'update users set password = "'.$newPassword.'" where username = "admin" and actived = 2';

                        $conn->exec($query_update);

                        $output .= '';

                    }
                    else{
                        
                        $output .= "Current Password Not valid";
                    }    
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