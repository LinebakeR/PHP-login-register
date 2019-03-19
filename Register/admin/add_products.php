<?php
include_once "../inc/header.php";
include_once "../class/form.php";

if(!isset($_POST) && !empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['category_id'])){


    require_once '../inc/db.php';


    $req = $pdo->prepare("SELECT id FROM products WHERE name = ?");
    $req->execute([$_POST["name"]]);
    $name = $req->fetch();

    if ($name) {
        $_SESSION['flash']['danger'] = "Ce nom est déja utilisé";
    }

    else{

        $req = $pdo->prepare("INSERT INTO products SET name = ?, price = ?, category_id = ?");
        $req->execute([$_POST["name"], $_POST["price"], $_POST["category_id"]]);
        header('location: produits.php');
        exit();
    }
   
}

else{
    $_SESSION['flash']['danger'] = "Tous les champs sont obligatoires.";
}


?>
<div class="container col-sm-offset-4 col-sm-3">
<h3>Ajouter un produit</h3>
<form action="" method="post">
<?php
if(($_SESSION["auth"]->admin == 1)){

    $add = new Form($_POST);

    echo $add->input("name", "text", "Nom du produit");
    echo $add->input("price", "number", "Prix");
    echo $add->input("category_id", "number", "Catégorie");
    echo $add->submit();

}

else{
    header("location: index.php");

} ?>
</form>
</div>