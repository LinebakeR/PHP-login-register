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



<div class="container">

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
        $connect = $pdo->prepare("SELECT username, email FROM users ORDER BY username");
        $connect->execute();
        $table = $connect->fetchAll();

        //print_r($table);?>

        
        <?php
    
        foreach($table as $object)
        {?>
        
        <tr>
        <?php
        foreach($object as $values)
            {?>
                <td><?php echo $values; ?></td>
            <?php
            }?>
                <td style="width:80px" class="text-center"><i class="material-icons">account_box</i></td>
                <td style="width:80px" class="text-center"><i class="material-icons">edit</i></td>
                <td style="width:80px" class="text-center"><i class="material-icons">delete</i></td>

            </tr>
            <?php
        }?>

</tbody>
</table>

<div class="text-center">
<form action="add.php">
<button class="btn btn-primary">Ajouter un utilisateur</button>
</form>
</div>
</div>


<?php
include_once 'inc/footer.php';
?>
    