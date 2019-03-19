<?php 

function debug($var){
    echo '<pre>'. print_r($var, true) .'</pre>';
}

function str_random($length){
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet,$length)), 0, $length);

}


function deleteUser($email){

	include_once "db.php";


	return $delete = $pdo->query("DELETE FROM users WHERE email ='$email' ");

	return $pdo->query("DELETE FROM users WHERE email = '$email'");

}

function deleteProduct($id){

	include_once "db.php";
    $pdo->query("DELETE FROM products WHERE id = '$id'");
    //return 0;

}