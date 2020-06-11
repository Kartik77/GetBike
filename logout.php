<?php
session_start(); 
unset($_SESSION['login']);
session_destroy(); // destroy session
header("location:index.php"); 
?>

