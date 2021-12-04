<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //
        if (isset($_POST['action'])) {
            //
            if ($_POST['action'] == 'do_undo_mod') {
                require 'connected.php';
                
                $status = $_POST['status'];

                $username = $_POST['username'];

                $username = convert_string('decrypt', $username);

                ///
                if ($status == 'make') {
                    //
                    $status = 'moderator';
                //
                } elseif ($status == 'remove') {
                    //
                    $status = 'user';
                }
                
                $query = 'update users set status = ? where username = ?';

                $stmt = $conn->prepare($query);

                $sourse = [$status,$username];

                $stmt->execute($sourse);

                $rowCount = $stmt->rowCount();
            }
        }
    }
