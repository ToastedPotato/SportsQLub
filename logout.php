<?php
//http://www.php.net/manual/en/function.session-destroy.php
//code from the php manual to completely destroy a session
session_start();

// Unset all of the session variables.
$_SESSION = array();

// delete session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

//destroy session then redirect to login page
session_destroy();

header("Location: login.html");
?>
