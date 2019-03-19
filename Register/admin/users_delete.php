<?php
session_start();

include_once '../inc/function.php';
include_once '../inc/header.php';
include_once '../inc/db.php';
?>

<?php
$email = $_SESSION['auth']->email;
$query = $pdo->query("SELECT * FROM users WHERE email = '$email'");
$admin = $query->fetch(PDO::FETCH_OBJ);


if(($_SESSION["auth"]->admin == 1)){

    $id = $_GET['user_id'];
    $pdo->query("DELETE FROM users WHERE id = '$id'");
    //deleteUser($id);
    header('Location: admin.php');

}
else{
    header('Location: index.php');
    //    echo "toto";
} 