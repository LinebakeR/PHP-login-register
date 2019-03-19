<?php
require_once "inc/header.php";

if(isset($_SESSION["auth"])) {

}
else{
    header('location: /rush_php/Register/common/login.php');
}
require_once "inc/footer.php";