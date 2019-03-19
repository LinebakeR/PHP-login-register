<?php
include_once "../inc/header.php";
include_once "../class/form.php";


$id = $_GET['product_id'];
$nom = $_POST['name'];
$prix = $_POST['price'];

if(!empty($_POST)){

    $errors = array();

    if (empty($_POST['name'])) {

        $errors['name'] = "Le nom du produit est obligatoire";

    }
    if (empty($_POST['price'])){

        $errors['price'] = "Le prix du produit est obligatoire";

    }
    
    if (empty($_POST['category_id'])){

        $errors['category_id'] = "La catégorie est obligatoire";
    }

    if (empty($errors)) {


        require_once '../inc/db.php';


        $req = $pdo->prepare("SELECT id FROM products WHERE name = ?");
        $req->execute([$_POST["name"]]);
        $name = $req->fetch();
    }
//var_dump($name);
    if (isset($name->id)) {
        ?>
            <div class="container alert alert-danger">Ce nom est déjà utilisé.</div>   
        <?php
        
    }
    else{

        $req = $pdo->prepare("UPDATE products SET name = '$nom', price = '$prix' WHERE category_id = '".$id."'");
        echo $_GET['name'];
        $req->execute();
         ?>
            <div class="container alert alert-danger">Votre produit a bien été modifié !</div>   
        <?php
        header('location: produits.php');    
    }
}

?>

<?php if(!empty($errors)):?>
<div class="container alert alert-danger">
    <p>Vous n'avez pas rempli le formulaire correctement</p>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?=$error;?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>


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