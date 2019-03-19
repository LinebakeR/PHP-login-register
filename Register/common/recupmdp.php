<?php require_once '../inc/header.php';
require_once '../inc/function.php';
require_once "../class/form.php";

$sujet = "Nouveau mot de passe";
$message = "Voici votre nouveau mot de passe" . $recupCode;


if($_POST){
    if(!empty($_POST['email'])){
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            
            $email = $_POST['email'];
            
            //1ere requete trouver email dans BDD
            include_once "../inc/db.php";
            $confMail = $pdo->prepare('SELECT * FROM users WHERE email = ?');
            $confMail->execute([$email]);
            $mailverif = $confMail->fetch(); 
            
            
            //si mail OK, creation nouveau hash mdp
            if($mailverif){
                
                $_SESSION['flash']['success'] = "Votre nouveau mot de passe vous a été envoyé !";
                $recupCode = str_random(8);
                $hash_code = password_hash($recupCode, PASSWORD_DEFAULT);
                $newMdp = $pdo->prepare("UPDATE users SET password = '$hash_code' WHERE email = '$email'");
                $newMdp->execute([$hash_code]);
                mail($email, $sujet, $message);
                
                //die(var_dump($recupCode)); pour teste
                
            }
            else{
                $_SESSION['flash']['danger'] = "Cette adresse email n'est pas enregistré";
            }
        }
        else{
            $_SESSION['flash']['danger'] = "L'email n'est pas valide";
        }
    }
    else{
        $_SESSION['flash']['danger'] = "Veuillez entrer votre adresse mail";
    }
}
?>
<div class="container col-sm-offset-4 col-sm-3">
    <h3>Mot de passe oublié ?</h3>
<form action="" method="post">
<?php
        $recup = new Form($_POST);
        echo $recup->input("email", "email", "Votre adresse email ?");
        echo $recup->submit();
?>
</form>
    <?php include_once "Register/inc/footer.php"; ?>
</div>