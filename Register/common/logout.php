<?php

session_start();
unset($_SESSION["auth"]);
setcookie('remember', NULL, -1);
$_SESSION["flash"]["success"] = "Vous etes bien déconnecté";
header('location: login.php');
session_start();