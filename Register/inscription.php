<?php require 'inc/header.php'; ?>
<?php require 'inc/footer.php'; ?>
<?php require 'inc/function.php'; ?>
<?php

if(!empty($_POST)){

    $errors = array();

    require_once 'inc/db.php';
    if(empty($_POST["username"]) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST["username"])){

        $errors["username"] = "votre pseudo n'est pas valide";
    }
    
    
    if(empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){

        $errors["email"] = "votre email n'est pas valide";
    }else {

        $req = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $req->execute([$_POST["email"]]);
        $user = $req->fetch();
        if ($user) {
            $errors["email"] = "Cet email est déja utilisé";
        }
    }

    if(empty($_POST["password"]) || $_POST["password"] != $_POST["password_confirm"]){

        $errors["password"] = "votre mot de passe n'est pas valide";
    }

    if(empty($errors)){

    $req =$pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, admin = 0");
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $req->execute([$_POST["username"], $password, $_POST["email"]]);
    $req->fetchAll();
    header('location: account.php');
    }
}
?>
<h1>S'inscrire</h1>

<?php if(!empty($errors)):?>
<div class="alert alert-danger">
    <p>Vous n'avez pas rempli le formulaire correctement</p>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?=$error;?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>


<form action="" method="post">

    <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input type="text" name="username" class="form-control" >
    </div>

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

    <button type="submit"class="btn btn-primary" >M'inscrire</button>

</form>