<?php require_once '../inc/header.php';
require_once '../inc/function.php';
require_once "../class/form.php";

if($_POST){
    echo "coucou ";
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
                
                echo "Email valide";
                $recupCode = str_random(8);
                $hash_code = password_hash($recupCode, PASSWORD_DEFAULT);
                $newMdp = $pdo->prepare("UPDATE users SET password = '$hash_code' WHERE email = '$email'");
                $newMdp->execute([$hash_code]);
                mail($email, "Nouveau mot de passe", "Voici votre nouveau mot de passe " . $recupCode .);
                //die(var_dump($recupCode)); pour test
                
            }
            else{
                echo "Cette adresse email n'est pas enregistré";
            }
        }
        else{
            echo "L'email n'est pas valide";
        }
    }
    else{
        echo "Veuillez entrer votre adresse mail";
    }
}
?>
<form action="" method="post">
<?php
        $recup = new Form($_POST);
        echo $recup->input("email", "email");
        echo $recup->submit();
?>
</form>
