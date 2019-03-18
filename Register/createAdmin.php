<?php
include "inc/header.php";
if(isset($_POST)) {
    if(!empty($_POST["email"]) && !empty($_POST["username"]) && !empty($_POST["password"])) {

        $pdo = new PDO('mysql:dbname=pool_php_rush;host=localhost', 'titi', '1234');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);


            $req =$pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, admin = 1");
            $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
            $req->execute([$_POST["username"], $password, $_POST["email"]]);

    }

}

?>



<h1>Se connecter</h1>


<form action="" method="post">

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" >
    </div>

    <div class="form-group">
        <label for="username">username</label>
        <input type="username" name="username" class="form-control" >
    </div>

    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" class="form-control" >
    </div>

    <button type="submit"class="btn btn-primary" >M'inscrire</button>

</form>
