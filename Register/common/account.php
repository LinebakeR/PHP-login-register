<?php

include_once '../inc/function.php';
include_once '../inc/header.php'; ?>

<?php if(isset($_SESSION['auth'])): ?>

<h2>Votre compte</h2>

<?php
    include_once '../inc/db.php';
    $query = $pdo->query("SELECT * FROM users");
    $users = $query->fetchAll(PDO::FETCH_OBJ);
    $username = $_SESSION["auth"]->username;
?>


<pre>
<h3>Hello <?= $username ?>, how are you ? <br> your email is <?= $_SESSION["auth"]->email ?></h3>
</pre>
<div>
    <form action="modify.php">
     <button class="btn btn-primary">Modifier le compte</button>
    </form>
</div>

<?php include_once '../inc/footer.php'; ?>

    <?php else: ?>
    <?php header("location: login.php");?>
    <?php endif; ?>
