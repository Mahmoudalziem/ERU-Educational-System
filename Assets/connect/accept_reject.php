<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //
        if (isset($_POST['action'])) {
            //
            require_once 'connected.php';

            $output = '';

            $username = $_POST['username'];

            $username = convert_string('decrypt', $username);
            

            class accept_reject
            {
                //properties

                public $username = '';

                //Method

                public function accept($conn)
                {
                    $query = 'update question_details set status = "accept" where Q_title = ?';

                    $stmt = $conn->prepare($query);

                    $source = array($this->username);

                    $stmt->execute($source);

                    return $output = '';
                }
                public function reject($conn)
                {
                    $query = 'delete from question_details where q_title = ?';

                    $stmt = $conn->prepare($query);

                    $source = array($this->username);

                    $stmt->execute($source);

                    return $output = '';
                }
            }

            $object = new accept_reject();

            $object->username = $username;

            if ($_POST['action'] == 'acceptQuestion') {
                //
                $object->accept($conn);
            }
            if ($_POST['action'] == 'rejectQuestion') {
                //
                $object->reject($conn);
            }
        }
    }
