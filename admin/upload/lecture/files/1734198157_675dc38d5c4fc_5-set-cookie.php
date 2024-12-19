<?php
// Set Cookie and MD5 Encryption Example
$password = "my_password";
$hashedPassword = md5($password);
setcookie("user", $hashedPassword, time() + 3600); // Expires in 1 hour
?>