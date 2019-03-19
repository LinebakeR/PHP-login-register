<?php
include_once "../inc/header.php";
include_once "../class/form.php";

if(!empty($_POST)){

    $errors = array();

    require_once '../inc/db.php';
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
            header('location: admin.php');
            exit();
        } else {
            $req = $pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, admin = 0");
            $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
            $req->execute([$_POST["username"], $password, $_POST["email"]]);
            header('location: admin.php');
            exit();
        }
    }
}
?>
<div class="container col-sm-offset-4 col-sm-3">
<h3>Ajouter un utilisateur</h3>
<form action="" method="post">
<?php
if(($_SESSION["auth"]->admin == 1)){

    $add = new Form($_POST);

    echo $add->input("username", "text", "Nom d'utilisateur");
    echo $add->input("email", "email", "Adresse email");
    echo $add->input("password", "password", "Mot de passe");
    echo $add->input("password_confirm", "password", "Confirmez le mot de passe");
    echo $add->submit();
    echo $add->checkbox("Administrateur");

}

else{
    header("location: index.php");

} ?>
</form>
</div>