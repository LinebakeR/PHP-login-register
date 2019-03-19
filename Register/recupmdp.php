<?php require_once 'inc/header.php';
require_once 'inc/function.php';
require_once "class/form.php";

if(isset($_POST)){
    echo "coucou ";
    if(!empty($_POST['email'])){
        echo"coucou2 ";
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            
            $email = $_POST['email'];
            
            //1ere requete trouver email dans BDD
            include_once "inc/db.php";
            $confMail = $pdo->prepare('SELECT * FROM users WHERE email = ?');
            $confMail->execute([$email]);
            $mailverif = $confMail->fetch();
            echo"coucou 3";

            //2eme requete, ecrase ancien password dans BDD
            $newMdp = $pdo->prepare('UPDATE users SET password = "'.$hash_code.'" WHERE password = ?');
            $newMdp->execute($hash_code);
            $update_mdp = $newMdp->fetch();
            
            //si mail OK, creation nouveau hash mdp
            if($mailverif){
                echo "Email valide";
                $_SESSION['email'] = $recupMail;
                $recupCode = "";
                $_SESSION['recupCode'] = $recupCode ;
                
                    $recupCode = str_random(8);
                    $hash_code = password_hash($recupCode, PASSWORD_DEFAULT);
                    var_dump($hash_code);
            } else{
                    echo "Votre email n'existe pas";    
                }
        } else{
                echo "Votre email email n'est pas valide";
            }
    } else{
            echo "Entrez votre adresse Email";
        } 
} 


?>

<form action="" method="post">

<?php
        $recup = new Form($_POST);
        echo $recup->input("email", "email");
        echo $recup->submit("envoyer");
?>
</form>