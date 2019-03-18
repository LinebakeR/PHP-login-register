<?php
session_start();

include_once 'inc/function.php';
include_once 'inc/header.php';
include_once 'inc/db.php';
?>

<?php
$query = $pdo->query("SELECT * FROM users");
$admin = $query->fetchAll(PDO::FETCH_OBJ);

if(/*isset($_SESSION['auth']) && */($admin->admin == 1))
echo "bonjour";
else{
    //header('Location: index.php');
} ?>

<h1>Votre compte</h1>
<?php debug($_SESSION); ?>

<?php //else: ?>
<?php


?>
<pre>
<?php  print_r($admin);
?>
</pre>
<pre>
<?php  echo ($admin->admin);
?>
</pre>
<?php include_once 'inc/footer.php'; ?>
<?php //endif; ?>
<button class="btn btn-primary">Voir les utilisateurs</button>