<?php

// Inialize session
session_start();

// Delete certain session
unset($_SESSION["login_user"]);
// Deletes all session variables
echo "You are successfully logged out!";

header('Location: index.php'); // Jump to login page
?>