<?php
// Set Cookie Example
setcookie("user", "JohnDoe", time() + 3600); // Expires in 1 hour
if (isset($_COOKIE['user'])) {
    echo "User: " . $_COOKIE['user'];
}
?>