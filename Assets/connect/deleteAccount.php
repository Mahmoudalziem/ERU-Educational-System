<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'DeleteAccount') {
                require 'connected.php';

                $username = convert_string('decrypt', $_POST['username']);

                $username = strtolower($username);

                
                $path_account_avater = dirname(__DIR__, 2) . '/images_users/avaters//'. $username;

                $path_account_background = dirname(__DIR__, 2) . '/images_users/background//'. $username;

                if (file_exists($path_account_avater) && file_exists($path_account_background)) {
                    function delete_dir($dir)
                    {
                        foreach (glob($dir . '/' . '*') as $file) {
                            if (is_dir($file)) {
                                if (count($file) == 10) {
                                    delete_dir($file);
                                }
                            } else {
                                unlink($file);
                            }
                        }
                    }

                    delete_dir($path_account_avater);

                    rmdir($path_account_avater);

                    delete_dir($path_account_background);

                    rmdir($path_account_background);
                }

                $query_delete_profile = 'delete from profile where username = "'.$username.'"';

                $query_delete_profile = $conn->prepare($query_delete_profile);

                $query_delete_profile->execute();

                /******************** Users  ***************/

                $query_delete_users = 'delete from users where username = "'.$username.'"';

                $query_delete_users = $conn->prepare($query_delete_users);

                $query_delete_users->execute();
            }
        } else {
            header('Location: signIn.php');
        }
    } else {
        header('Location: signIn.php');
    }
