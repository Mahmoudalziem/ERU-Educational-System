<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['action'])){

        if($_POST['action'] == 'logoOut'){

            session_start();
            
            $_SESSION['username'] = '';
            
            $_SESSION = array();
            // Swipe via memory
            if (ini_get("session.use_cookies")) {
                // Prepare and swipe cookies
                $params = session_get_cookie_params();
                // clear cookies and sessions
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            // Just in case.. swipe these values too
            ini_set('session.gc_max_lifetime', 0);
            ini_set('session.gc_probability', 1);
            ini_set('session.gc_divisor', 1);
            // Completely destroy our server sessions..
            session_destroy();
        }
    }
    else{
        header('Location: signIn.php');
    }
}
else{
    header('Location: signIn.php');
}