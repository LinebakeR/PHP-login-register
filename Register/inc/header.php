<?php
if (session_status() == PHP_SESSION_NONE){
session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link rel="canonical" href="https://getbootstrap.com/docs/3.3/examples/starter-template/">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Mon projet</title>

    <!-- Bootstrap core CSS -->
      <link rel="stylesheet" href="../css/app.css">

      <link rel="stylesheet" href="../Register/css/app.css">
  </head>

  <body>

    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/rush_php/Register/index.php">Le site de la Dream Team</a>
        </div>
          <div>
              <a href="" class="navbar-brand"></a>
          </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <?php if($_SESSION["auth"]->admin == 1){?>
              <li><a href="/rush_php/Register/admin/admin.php">Administration</a></li>
              <?php } ?>
                  <?php if(isset($_SESSION['auth'])): ?>
                  <li><a href="/rush_php/Register/common/account.php">Mon compte</a></li>
                      <li><a href="/rush_php/Register/common/logout.php">Se déconnecter</a></li>
                  <?php else: ?>
            <li><a href="/rush_php/Register/common/inscription.php">S'inscrire</a></li>
            <li><a href="/rush_php/Register/common/login.php">Se connecter</a></li>
              <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


  <div class="container">
      <?php if(isset($_SESSION["flash"])): ?>
        <?php foreach($_SESSION["flash"] as $type => $message): ?>
          <div class="alert alert-<?=$type; ?>">
              <?= $message ?>
          </div>
      <?php endforeach; ?>
      <?php unset($_SESSION["flash"]); ?>
      <?php endif; ?>
  </div>
