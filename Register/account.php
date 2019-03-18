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
<?php  echo ($users[0]->admin);
?>
</pre>

<?php //endif; ?>
<div>
    <form action="modify.php">
     <button class="btn btn-primary">Modifier le compte</button>
    </form>
<?php include_once 'inc/footer.php'; ?>