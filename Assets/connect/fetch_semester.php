<?php


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['action'])){

        if($_POST['action'] == 'fetch_semester'){

            $output = '';

             require  'connected.php';

             $id = $_POST['id'];

             $query = 'select * from semester where depart_id = "'.$id.'" ';

             $stmt = $conn->prepare($query);

             $stmt->execute();

             $result = $stmt->fetchAll();

             foreach ($result as $value){

                 $output = '<option value="'.$value['sem_id'].'">'.$value['semester_name'].'</option>';

                 echo $output;
             }
        }
    }
    else{
        header('Location: signIn.php');
    }
}
else{
    header('Location: signIn.php');
}