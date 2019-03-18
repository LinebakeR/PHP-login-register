<?php require 'inc/header.php';
require 'inc/function.php';
?>

<?php

if(isset($_POST['submit'])){
    if(!empty($_POST['email'])){

        if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            $email = $_POST["email"];

            include_once "inc/db.php";
            $confMail = $pdo->prepare('SELECT * FROM users WHERE email = ?');
            $confMail->execute([$email]);
            $mailverif = $confMail->fetch();
            if($mailverif){

                $_SESSION['flash']['success'] = "Email valide";
            }

            else{

                $_SESSION['flash']['danger'] = "Votre email n'existe pas";    
            }



        }else{

            {echo '<span style="color:red">' . "Veuillez entrer votre adresse email" . '</span>';}

        }

    }
}

?>
<h4 class="title-element"> Récupération du mot de passe</h4>
<form method="post" class="default-form">
    <input type="email" name="email" placeholder="Votre adresse mail" action="">
    <input type="submit" value="Submit" name="submit">
    </form>