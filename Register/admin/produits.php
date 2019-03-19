<?php
session_start();

include_once '../inc/function.php';
include_once '../inc/header.php';
include_once '../inc/db.php';
?>

<?php
$email = $_SESSION['auth']->email;
$query = $pdo->query("SELECT * FROM users WHERE email = '$email'");
$admin = $query->fetch(PDO::FETCH_OBJ);


if(($_SESSION["auth"]->admin == 1)){?>

<h1 class="text-center">Espace Produits</h1>

<?php //debug($_SESSION);

}
else{
    header('Location: index.php');
    //    echo "toto";
} ?>

<div class="container">

    <?php
        $connect = $pdo->prepare("SELECT products.id AS 'Id', products.name AS 'Name', price, categories.name 
                                 FROM products INNER JOIN categories 
                                 ON products.category_id = categories.id 
                                 ORDER BY products.name");
        $connect->execute();
        $table = $connect->fetchAll();

    ?>

    <table class="table table-striped table-bordered table-hover table-responsive">
        <thead class="thead-dark">

        <tr>
        <th scope="col" class="text-center">Nom</th>
        <th scope="col" class="text-center">Price</th>
        <th scope="col" class="text-center">Category</th>
        <th scope="col" class="text-center">Display</th>
        <th scope="col" class="text-center">Edit</th>
        <th scope="col" class="text-center">Delete</th>
        </tr>
        </thead>
        <tbody>

            <?php
                $i=0;
                while ($table[$i])
            {?>

            <tr>
                <td><?php echo $table[$i]->Name; ?></td>
                <td class="text-right"><?php echo $table[$i]->price; ?></td>
                <td class="text-center"><?php echo $table[$i]->name; ?></td>
                <td class="text-center col-sm-1"><a href="products_page.php?product_id=<?php echo $table[$i]->Id; ?>">
                <i class="material-icons">account_box</i></a></td>
                <td class="text-center col-sm-1"><a href="products_edit.php?product_id=<?php echo $table[$i]->Id; ?>">
                <i class="material-icons">edit</i></a></td>
                <td class="text-center col-sm-1"><a href="products_delete.php?product_id=<?php echo $table[$i]->Id; ?>">
                <i class="material-icons">delete</i></a></td>
            </tr>

            <?php
            $i++;    
            }?>


        </tbody>
    </table>

</div>


<div class="text-center">
    <form action="add_products.php">
    <button class="btn btn-primary" >Ajouter un produit</button>
    <button class="btn btn-primary" formaction="admin.php">Gestion des utilisteurs</button>
    </form>
</div>


<?php
include_once 'inc/footer.php';
?>