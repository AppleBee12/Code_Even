<?php
// PHP Advanced Example
session_start();
$_SESSION['user'] = "JohnDoe";
if (isset($_SESSION['user'])) {
    echo "User is logged in as " . $_SESSION['user'];
}
?>