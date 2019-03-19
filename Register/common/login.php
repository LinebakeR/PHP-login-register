<?php
require_once '../inc/function.php';

if (!empty($_POST) && !empty($_POST["email"]) && !empty($_POST["password"])){

    require_once '../inc/db.php';
    session_start();
    $req = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $req->execute(["email" =>$_POST["email"]]);
    $user = $req->fetch();
    if (password_verify($_POST["password"], $user->password)){

        $_SESSION["auth"] = $user;
        $_SESSION["flash"]["success"] = "Vous etes bien connecté";
        $token = str_random(60);
        setcookie('remember', $user->id . '==' . $token, time()+60*60);
        header('location: account.php');
        exit();

    }else{

        $_SESSION["flash"]["danger"] = "Identifiant ou mot de passe incorrect";
    }
}
?>

<?php require_once '../inc/header.php';
      require_once '../class/form.php';
?>




<?php if(!empty($errors)):?>
    <div class="alert alert-danger">
        <p>Mauvais identifiant ou mot de passe</p>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?=$error;?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<div class="container col-sm-offset-4 col-sm-3">
    <h3>Se connecter</h3>
<form action="" method="post">

<?php
        $login = new Form($_POST);
        echo $login->input("email", "email", "Votre adresse email");
        echo $login->input("password", "password", "Mot de passe");
       // echo $login->input("password_confirm", "password");
        echo $login->submit();
?>
</form>
<form action="recupmdp.php" method="post">
<button class="btn btn-primary">Mot de passe oublié</button>
</form>
	<?php require_once '../inc/footer.php'; ?>

</div>