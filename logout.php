<?php
session_start();
include("connection.php");
unset($_SESSION['sess_user']);
session_destroy();
header("Location:home.php");
?>