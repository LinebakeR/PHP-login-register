<?php
session_start();

include_once 'inc/function.php';
include_once 'inc/header.php';
include_once 'inc/db.php';
?>

<?php
$email = $_SESSION['auth']->email;
$query = $pdo->query("SELECT * FROM users WHERE email = '$email'");
$admin = $query->fetch(PDO::FETCH_OBJ);


if(($_SESSION["auth"]->admin == 1)){?>

<h1 class="text-center">Espace Administration</h1>

<?php //debug($_SESSION);

}
else{
    header('Location: index.php');
//    echo "toto";
} ?>

<?php
    $connect = $pdo->prepare("SELECT id, username, email FROM users WHERE admin = 0 ORDER BY username");
    $connect->execute();
    $table = $connect->fetchAll();
?>


<div class="container">


    <table class="table table-striped table-bordered table-hover table-responsive">
    <thead class="thead-dark">

    <table class="table table-striped table-bordered table-hover table-responsive">   
    <thead>

        <tr>
        <th scope="col" class="text-center">Nom</th>
        <th scope="col" class="text-center">Email</th>
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
                <td><?php echo $table[$i]->username; ?></td>
                <td><?php echo $table[$i]->email; ?></td>
                <td class="text-center col-sm-1"><a href="users_page.php?user_id=<?php echo $table[$i]->id; ?>">
                <i class="material-icons">account_box</i></a></td>
                <td class="text-center col-sm-1"><a href="users_edit.php?user_id=<?php echo $table[$i]->id; ?>">
                <i class="material-icons">edit</i></a></td>
                <td class="text-center col-sm-1"><a href="users_delete.php?user_id=<?php echo $table[$i]->id; ?>">
                <i class="material-icons">delete</i></a></td>
            </tr>

            <?php
            $i++;    
            }?>


        </tbody>
    </table>

</div>


<div class="text-center">
    <form action="add.php">
    <button class="btn btn-primary" >Ajouter un utilisateur</button>
    <button class="btn btn-primary" formaction="produits.php">Gestion des produits</button>
    </form>

</div>



<?php
include_once 'inc/footer.php';
?>
