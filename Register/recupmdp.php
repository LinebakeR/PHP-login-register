<?php require_once 'inc/header.php';
require_once 'inc/function.php';

if(isset($_POST['submit'])){
    if(!empty($_POST['email'])){

        if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            $email = htmlspecialchars($_POST["email"]);

            include_once "inc/db.php";
            $confMail = $pdo->prepare('SELECT * FROM users WHERE email = ?');
            $confMail->execute([$email]);
            $mailverif = $confMail->fetch();

            $newMdp = $pdo->prepare('UPDATE users SET password = "'.$hash_code.'" WHERE password = ?');
            $newMdp->execute($hash_code);
            $update_mdp = $newMdp->fetch();
            

            if($mailverif){
                $_SESSION['flash']['success'] = "Email valide";
                $_SESSION['email'] = $recupMail;
                $recupCode = "";
                $_SESSION['recupCode'] = $recupCode;
                
                    $recupCode = str_random(8);
                    $hash_code = password_hash($recupCode, PASSWORD_DEFAULT);
                    var_dump($hash_code);
                }
            }

                    else{

                        $_SESSION['flash']['danger'] = "Votre email n'existe pas";    
                    }
        }
        else
            {
            $_SESSION['flash']['danger'] = "Veuillez entrer votre adresse email";
            }
}

?>
<h4 class="title-element"> Récupération du mot de passe</h4>
<form method="post" action
      class="default-form">
    <input type="email" name="email" placeholder="Votre adresse mail" action="">
    <input type="submit" value="Submit" name="submit">
    </form>