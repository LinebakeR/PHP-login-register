<?php require_once '../inc/header.php';
require_once '../inc/function.php';
require_once "../class/form.php";

if($_POST){
    echo "coucou ";
    if(!empty($_POST['email'])){
        echo"coucou2 ";
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            
            $email = $_POST['email'];
            
            //1ere requete trouver email dans BDD
            include_once "../inc/db.php";
            $confMail = $pdo->prepare('SELECT * FROM users WHERE email = ?');
            $confMail->execute([$email]);
            $mailverif = $confMail->fetch();
            echo"coucou 3"; 
/* 
            //2eme requete, ecrase ancien password dans BDD
              */
            
            //si mail OK, creation nouveau hash mdp
            if($mailverif){
            
                echo "Email valide";
                $recupCode = str_random(8);
                $hash_code = password_hash($recupCode, PASSWORD_DEFAULT);
                $newMdp = $pdo->prepare("UPDATE users SET password = '$hash_code' WHERE email = '$email'");
                $newMdp->execute([$hash_code]);
                //die(var_dump($recupCode)); pour test
                
            }
            else{
                echo "mail non existant";
            }
        }
        else{
            echo "mail non valide";
        }
    }
    else{
        echo "mail non entré";
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