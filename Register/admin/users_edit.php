<?php

include_once '../inc/function.php';
include_once '../inc/header.php';
include_once '../inc/db.php';
?>

<?php

$email = $_SESSION['auth']->email;
$query = $pdo->query("SELECT * FROM users WHERE email = '$email'");
$admin = $query->fetch(PDO::FETCH_OBJ);

if(($_SESSION["auth"]->admin == 1)){

	$id = $_GET['user_id'];
	$req = $pdo->Prepare("SELECT * FROM users WHERE id = '$id'");
	$req->execute();
	$user = $req->fetch();
	if($user->admin == 1){
		$user->admin = "Administrateur";
	}
	else{
		$user->admin = "Utilisateur";
	}
}
else{
	header('Location: index.php');
	//    echo "toto";
}

?>
<div class="container">
    <div class="container text-center">
	<h2>Utilisateur à modifier</h2>
    </div>
	<p></p>
	<table class="table table-hover">
		<thead>
		<tr>
			<th>Firstname</th>
			<th>Email</th>
			<th>Statut</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><?= $user->username ?></td>
			<td><?= $user->email?></td>
			<td><?= $user->admin ?></td>
		</tr>
		</tbody>
	</table>
</div>