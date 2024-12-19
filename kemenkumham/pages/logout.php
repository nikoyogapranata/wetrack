<?php
session_start();

// Destroy all sessions
session_unset();
session_destroy();

// Redirect to the landing page
header("Location: /wetrack/public/landing-page/index.php");
exit();
?>
