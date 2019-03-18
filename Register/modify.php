<?php
include_once "inc/header.php";

$errors = array();

require_once 'inc/db.php';
    if(empty($_POST["username"]) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST["username"])){

        $errors["username"] = "votre pseudo n'est pas valide";
    }

    if(empty($_POST["password"]) || $_POST["password"] != $_POST["password_confirm"]){

        $errors["password"] = "votre mot de passe n'est pas valide";
    }

    if(empty($errors)){
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
        $req =$pdo->prepare("UPDATE users SET username = '$username', password = '$hash' WHERE email = '$email'");
        $req->execute();
        $_SESSION["flash"]["succes"] =  "Votre compte a bien été modifié";
        header('location: account.php');
    }

?>


<h1>Modifier son compte</h1>

<form action="" method="post">

    <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input type="text" name="username" class="form-control" value="<?php echo $_SESSION["auth"]->username; ?>">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" value="<?php echo $_SESSION["auth"]->email; ?>" class="form-control" disabled>
    </div>

    <div class="form-group">
        <label for="password">Votre nouveau mot de pase</label>
        <input type="password" name="password" class="form-control" >
    </div>

    <div class="form-group">
        <label for="password">Confirmez votre nouveau mot de passe</label>
        <input type="password" name="password_confirm" class="form-control" >
    </div>

    <button type="submit"class="btn btn-primary" >Modifier mon compte</button>

</form>
