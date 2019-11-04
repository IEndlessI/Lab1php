<?php
session_start();
unset($_SESSION["auth"]);
unset($_SESSION["first_name"]);
unset($_SESSION["password"]);
unset($_SESSION["email"]);
header('Location: logindb.php');
?>