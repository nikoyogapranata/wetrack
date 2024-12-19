<?php
$password = 'admin123';  // The default password for the admin
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
echo $hashed_password;  // This will output the hashed password
?>
