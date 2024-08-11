<?php

session_unset();

// Destroy the session


// Optionally, you can also remove the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, 
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]
    );
}


echo'<script>window.location.href="auth.php"</script>';

?>