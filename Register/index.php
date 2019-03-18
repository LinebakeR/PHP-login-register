<?php
if(isset($_SESSION["auth"])) {
    require_once "inc/header.php";
}
else{
    header('location: login.php');
}
