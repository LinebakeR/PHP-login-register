<?php
require_once 'inc/function.php';

if (!empty($_POST) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["password_confirm"])){

    require_once 'inc/db.php';
    session_start();
    $req = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $req->execute(["email" =>$_POST["email"]]);
    $user = $req->fetch();
    if (password_verify($_POST["password"], $user->password) && ($_POST["password_confirm"] == $_POST["password"])){

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
<?php require_once 'inc/header.php'; ?>

<h1>Se connecter</h1>


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


<form action="" method="post">

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" >
    </div>

    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" class="form-control" >
    </div>

    <div class="form-group">
        <label for="password_confirm">Confirmez votre mot de passe</label>
        <input type="password" name="password_confirm" class="form-control" >
    </div>

    <button type="submit"class="btn btn-primary" >Se connecter</button>

</form>

<?php require_once 'inc/footer.php'; ?>
