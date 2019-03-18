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

<h1>Espace Administration</h1>

<?php debug($_SESSION);

}
else{
    header('Location: index.php');
//    echo "toto";
} ?>



<div class="container">

<table class="table table-striped table-bordered table-hover table-responsive">   
<thead class="thead-dark">
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Email</th>
      <th scope="col">Edit User</th>
      <th scope="col">Delete User</th>
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
                <td>button edit</td>
                <td>button delete</td>
            </tr>
            <?php
        }?>

</tbody>
</table>
</div>







<?php
include_once 'inc/footer.php';
?>
    