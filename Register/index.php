<?php
require_once "inc/header.php";


if(isset($_SESSION["auth"])) {

}
else{
    header('location: login.php');
}
