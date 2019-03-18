<?php
include_once "inc/header.php";
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

    if(empty($errors)) {
        if ($_POST["is_admin"]) {
            $req = $pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, admin = 1");
            $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
            $req->execute([$_POST["username"], $password, $_POST["email"]]);
            $req->fetchAll();
            header('location: index.php');
        } else {
            $req = $pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, admin = 0");
            $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
            $req->execute([$_POST["username"], $password, $_POST["email"]]);
            $req->fetchAll();
            header('location: index.php');
        }
    }
}
?>
<?php if(($_SESSION["auth"]->admin == 1)){?>
<h1>Ajouter un utilisateur</h1>

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
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name ="is_admin">
        <label class="form-check-label" for="is_admin">Administrateur</label>
    </div>


    <button type="submit"class="btn btn-primary" >Créer l'utilisateur</button>
</form>
<?php} else{
    header('location: index.php');
}
