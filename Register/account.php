<?php
session_start();
include_once 'inc/function.php'; ?>
<?php include_once 'inc/header.php'; ?>

<?php // if(isset($_SESSION['auth'])): ?>

<h1>Votre compte</h1>
<?php debug($_SESSION); ?>

<?php //else: ?>
<?php
    include_once 'inc/db.php';
    $query = $pdo->query("SELECT * FROM users");
    $users = $query->fetchAll(PDO::FETCH_OBJ);

?>
<pre>
<?php  print_r($users[0]->username);
 ?>
</pre>
<pre>
<?php  echo ($users[1]->password);
?>
</pre>
<?php include_once 'inc/footer.php'; ?>
<?php //endif; ?>
<button class="btn btn-primary">Voir les utilisateurs</button>